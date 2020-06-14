<?php
class DonatePage extends Page {
    private static $db = array(
        'Customsidebar' => 'HTMLText',
    );

    function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', new HTMLEditorField('Customsidebar', "Custom Sidebar"));
        return $fields;
    }
}
class DonatePage_Controller extends Page_Controller {
    private static $passphrase = 'concardissecret';
    private static $passphrase_incoming = 'concardissecret_incoming';

    private static $url_handlers = array(
            'dl//$type!/$version!/$lang!/$file!' => 'donatedl',
        );

    private static $allowed_actions = array(
        'DonationProceed',
        'nonav',
        'donatedl',
        'thankyou',
        'thanksbut',
        'cancel',
        'oops',
        'ConcardisTemplate'
    );

    private static $donate_ab = array(
        array('amount' => 9),
        array('amount' => 19),
        array('amount' => 29),
        array('amount' => 39)
    );
    // keep values in sync with the above, used to skew probabilities
    private static $donate_ab_probs = array(
        array('amount' => 19),
        array('amount' => 29),
        array('amount' => 39)
    );
    // recurring donations default values
    // note this is only for switching defaults - live switching is done by javascript in Layout/DonatePage.ss
    // right now default is monthly
    private static $donate_ab_recurring = array(
        'monthly' => 4,
        'quarterly' => 14,
        'yearly' => 49
    );
    private static $piwik_goal = 9;

    static $defaultvars = array(
        'Amount'       => 13,
        'action_paymenttype' => "dummy",
        'accepturl'    => "https://www.libreoffice.org/DonationProceed/thankyou",
        'declineurl'   => "https://www.libreoffice.org/DonationProceed/oops",
        'exceptionurl' => "https://www.libreoffice.org/DonationProceed/thanksbut",
        'cancelurl'    => "https://www.libreoffice.org/DonationProceed/cancel",
        'homeurl'      => "http://www.libreoffice.org",
        'tp'           => "https://www.libreoffice.org/DonationProceed/ConcardisTemplate",
        'typ'          => "prod",
        'currency'     => "EUR",
        'com'          => "Donation to The Document Foundation",
        'complus'      => "en_US",
        'email'        => "",
        'language'     => "en_US",
        'operation'    => "SAL",
        'pmlisttype'   => "2",
        'pspid'        => "paymentserviceproviderid",
        'win3ds'       => "MAINW"
    );
    private static $nodecimal_currencies = array('CLP', 'JPY', 'KRW', 'PYG');
    private static $paypal_currencies = array(
        "AUD" => "AUD",
        "CAD" => "CAD",
        "CHF" => "CHF",
        "CZK" => "CZK",
        "DKK" => "DKK",
        "EUR" => "EUR",
        "GBP" => "GBP",
        "HKD" => "HKD",
        "HUF" => "HUF",
        "ILS" => "ILS",
        "JPY" => "JPY",
        "MXN" => "MXN",
        "NOK" => "NOK",
        "NZD" => "NZD",
        "PHP" => "PHP",
        "PLN" => "PLN",
        "SEK" => "SEK",
        "SGD" => "SGD",
        "THB" => "THB",
        "TWD" => "TWD",
        "USD" => "USD");

    private static $cc_only_currencies = array(
        "AED" => "AED (*)",
        "ANG" => "ANG (*)",
        "ARS" => "ARS (*)",
        "AWG" => "AWG (*)",
        "AZN" => "AZN (*)",
        "BGN" => "BGN (*)",
        "BOB" => "BOB (*)",
        "BRL" => "BRL (*)",
        "CLP" => "CLP (*)",
        "CNY" => "CNY (*)",
        "COP" => "COP (*)",
        "EGP" => "EGP (*)",
        "HRK" => "HRK (*)",
        "IDR" => "IDR (*)",
        "INR" => "INR (*)",
        "ISK" => "ISK (*)",
        "KES" => "KES (*)",
        "KRW" => "KRW (*)",
        "KZT" => "KZT (*)",
        "LTL" => "LTL (*)",
        "LVL" => "LVL (*)",
        "MAD" => "MAD (*)",
        "MDL" => "MDL (*)",
        "MKD" => "MKD (*)",
        "MYR" => "MYR (*)",
        "PEN" => "PEN (*)",
        "PYG" => "PYG (*)",
        "QAR" => "QAR (*)",
        "RON" => "RON (*)",
        "RSD" => "RSD (*)",
        "RUB" => "RUB (*)",
        "SAR" => "SAR (*)",
        "SRD" => "SRD (*)",
        "SYP" => "SYP (*)",
        "TRY" => "TRY (*)",
        "UAH" => "UAH (*)",
        "UYU" => "UYU (*)",
        "VEF" => "VEF (*)",
        "VER" => "VER (*)",
        "ZAR" => "ZAR (*)");

    private function landinglang() {
        // https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_html_Appx_websitestandard_htmlvariables#id08A6HI0709B
        $landinglang='US';
        switch(i18n::get_locale_from_lang($this->ContentLocale())) {
        case "de_DE": $landinglang = "DE"; break;
        case "fr_FR": $landinglang = "FR"; break;
        case "he_IL": $landinglang = "he_IL"; break;
        case "it_IT": $landinglang = "IT"; break;
        case "es_ES": $landinglang = "ES"; break;
        case "nl_NL": $landinglang = "NL"; break;
        case "ja_JP": $landinglang = "jp_JP"; break;
        case "pl_PL": $landinglang = "PL"; break;
        case "pt_BR": $landinglang = "BR"; break;
        case "ru_RU": $landinglang = "RU"; break;
        case "tr_TR": $landinglang = "tr_TR"; break;
        case "zh_CN": $landinglang = "zh_CN"; break;
        case "zh_TW": $landinglang = "zh_TW"; break;
        }
        return $landinglang;
    }

    /* the donation form - it would also be possible to do it with a self-written template, but doing it
     * within silverstipe will automatically add validation to field-inputs as well as automatically add
     * the CSRF-protection (but as there is not much to verify...)
     */
    function DonationProceed() {
        if($this->useNewDonate()) {
            return $this->DonationProceed_new();
        } else {
            return $this->DonationProceed_old();
        }
    }
    private function DonationProceed_old() {
        $currency = DropdownField::create("currency")->setSource(array(
            "AED" => "AED",
            "ANG" => "ANG",
            "ARS" => "ARS",
            "AUD" => "AUD (*)",
            "AWG" => "AWG",
            "AZN" => "AZN",
            "BGN" => "BGN",
            "BOB" => "BOB",
            "BRL" => "BRL",
            "CAD" => "CAD (*)",
            "CHF" => "CHF (*)",
            "CLP" => "CLP",
            "CNY" => "CNY",
            "COP" => "COP",
            "CZK" => "CZK (*)",
            "DKK" => "DKK (*)",
            "EGP" => "EGP",
            "EUR" => "EUR (*)",
            "GBP" => "GBP (*)",
            "HKD" => "HKD (*)",
            "HRK" => "HRK",
            "HUF" => "HUF (*)",
            "IDR" => "IDR",
            "ILS" => "ILS (*)",
            "INR" => "INR",
            "ISK" => "ISK",
            "JPY" => "JPY (*)",
            "KES" => "KES",
            "KRW" => "KRW",
            "KZT" => "KZT",
            "LTL" => "LTL",
            "LVL" => "LVL",
            "MAD" => "MAD",
            "MDL" => "MDL",
            "MKD" => "MKD",
            "MXN" => "MXN (*)",
            "MYR" => "MYR",
            "NOK" => "NOK (*)",
            "NZD" => "NZD (*)",
            "PEN" => "PEN",
            "PHP" => "PHP (*)",
            "PLN" => "PLN (*)",
            "PYG" => "PYG",
            "QAR" => "QAR",
            "RON" => "RON",
            "RSD" => "RSD",
            "RUB" => "RUB",
            "SAR" => "SAR",
            "SEK" => "SEK (*)",
            "SGD" => "SGD (*)",
            "SRD" => "SRD",
            "SYP" => "SYP",
            "THB" => "THB (*)",
            "TRY" => "TRY",
            "TWD" => "TWD (*)",
            "UAH" => "UAH",
            "USD" => "USD (*)",
            "UYU" => "UYU",
            "VEF" => "VEF",
            "VER" => "VER",
            "ZAR" => "ZAR"
        ))->setValue(_t("DonatePage.DEFAULT_CURRENCY", "USD"))->setTitle(null);
        /* can be used to set custom back to site, cancel, etc URLs, and of course to determine the language */
        $subsite  = HiddenField::create("subsite")->setValue($this->SubsiteID);
        $fromurl  = HiddenField::create("homeurl")->setValue($this->AbsoluteLink());
        $language = HiddenField::create("language")->setValue(i18n::get_locale_from_lang($this->ContentLocale()));
        $complus  = HiddenField::create("complus")->setValue(i18n::get_locale_from_lang($this->ContentLocale()));
        $predefined = OptionsetField::create('Amount')->setTitle(null)->setSource(
            array("05" => _t("DonatePage.DEFAULT_AMOUNT_EUR05",  "5")." "._t("DonatePage.DEFAULT_CURRENCY"),
            "10" => _t("DonatePage.DEFAULT_AMOUNT_EUR10", "10")." "._t("DonatePage.DEFAULT_CURRENCY"),
            "20" => _t("DonatePage.DEFAULT_AMOUNT_EUR20", "20")." "._t("DonatePage.DEFAULT_CURRENCY"),
            "50" => _t("DonatePage.DEFAULT_AMOUNT_EUR50", "50")." "._t("DonatePage.DEFAULT_CURRENCY")))->setValue("10");
        $defaultChoices = _t("DonatePage.CHOICE_DEFAULT", "Select one of the default values");
        $customAmount = _t("DonatePage.CUSTOM_CHOICE", "Or enter a custom amount and currency<br/>(only those marked with * are also available via PayPal)");
        $groups = new SelectionGroup("toggle_custom",array("predefined//".$defaultChoices => $predefined,
            "custom//".$customAmount => new FieldGroup(NumericField::create("customValue")->setValue(_t("DonatePage.CUSTOM_AMOUNT_VALUE", "25"))->setMaxLength(10)->setTitle(null), $currency)));
        $groups->setValue("predefined");
        $email = EmailField::create("email")->setTitle(null)
                                            ->setRightTitle(_t("DonatePage.BC_EMAIL_LABEL", "optional Email"))
                                            ->setDescription(_t("DonatePage.BC_EMAIL_DESC", "if you want confirmation mail for credit card payments"));
        $newrecaptcha = LiteralField::create('norecaptcha', '<div class="g-recaptcha" data-sitekey="'.Config::inst()->get('RecaptchaField', 'public_api_key').'"></div>');
        // the button that is displayed
        $stripeAction = FormAction::create("stripe_old")->setTitle(_t("DonatePage.BUTTON_Stripe", "Donate via Stripe"))->addExtraClass('donate_submit');
        // the action that is triggered after the stripe form passes
        $stripeActionReal = FormAction::create("stripe")->setTitle(_t("DonatePage.BUTTON_Stripe", "Donate via Stripe"))->addExtraClass('hidden');
        $fields = new FieldList( $subsite, $fromurl, $language, $complus, $groups, $email, $newrecaptcha);
            //FormAction::create("concardis")->setTitle(_t("DonatePage.BUTTON_CARD",   "Donate via Credit Card")));
        $actions = new FieldList(
            FormAction::create("paypal")->setTitle(_t("DonatePage.BUTTON_PAYPAL", "Donate via PayPal")),
            $stripeAction, $stripeActionReal);
        $proceedform = new Form($this, "DonationProceed", $fields, $actions, $requiredFields = new RequiredFields(array("Amount","customValue")));

        return $proceedform;
    }
    private function newDonateCurrencies() {
        $currencies = array_merge(self::$paypal_currencies, str_replace('(*)', _t("DonatePage.CardOnly", '(card only)'), self::$cc_only_currencies));
        ksort($currencies);
        return  $currencies;
    }
    private function formDonationChoicesButtons() {
        $optionvalues = array_column(self::$donate_ab, 'amount', 'amount');
        if($this->OptionSorting) {
            $this->OptionSorting = "_descending";
            $optionvalues = array_reverse($optionvalues, True);
        }
        $ab_ID = array_rand(self::$donate_ab);
        $frequency = OptionsetField::create("frequency")->setSource(array(
            "oneshot"   => _t("DonatePage.FreqOneshot", "One-time donation"),
            "monthly"   => _t("DonatePage.FreqMonthly", "Monthly donation"),
            "quarterly" => _t("DonatePage.FreqQuarterly", "Quarterly donation"),
            "yearly"    => _t("DonatePage.FreqYearly", "Yearly donation")
        ))->setValue("oneshot")->setTitle(null)->addExtraClass('donate_frequency_radio');
        //Debug::dump(array_reduce(self::$donate_ab, function($arr, $entry) { $arr[$entry['amount']] = $entry['amount']; return $arr; }));
        //Debug::dump(array_column(self::$donate_ab, 'amount', 'amount'));
        $amount_choicelist = OptionsetField::create("customValue")->setSource($optionvalues
            )->setValue($this->PreselectedAmount)->setTitle(null)->addExtraClass('donate_input_radio');

        $currencies = $this->newDonateCurrencies();
        $currency = DropdownField::create("currency")->setSource($currencies)
            ->setValue(_t("DonatePage.DEFAULT_CURRENCY", "USD"))->setTitle(null)->addExtraClass('donate_currency');

        $amount = NumericField::create("customValue");

        if($this->OptionSlider) {
            $amount->setMaxLength(3)->setTitle(_t("DonatePage.SLIDERLABEL", "Amount (drag the slider below to change): "))->addExtraClass('donate_input_slider')->setReadonly(true)->setValue($this->PreselectedAmount)->setDescription('<div id="slider-range-min"></div>');
            $amount_choices = new FieldGroup(
                // rework validation to make it happy...
                HiddenField::create("customValue")->setValue($this->PreselectedAmount)->setTitle(null),
                $amount,
                LiteralField::create("customValue_slider", '<div id="slider-range-min"></div><br/>'),
                $currency
            );
        } else {
            $amount->setMaxLength(10)->setTitle(null)->addExtraClass('donate_input')->setAttribute('placeholder', _t("DonatePage.OtherAmount", "Other Amount"));
            $amount_choices = new CompositeField(
                $amount_choicelist,
                $amount,
                $currency
            );
        }

        //$amount = NumericField::create("customAmount")->setMaxLength(10)->setTitle(null)->addExtraClass('donate_input')->setAttribute('placeholder', _t("DonatePage.OtherAmount", "Other Amount"));
        $defaultAmount  = HiddenField::create("Amount")->setValue($this->PreselectedAmount);
        $freq_val_curr = CompositeField::create($frequency, $amount_choices, $defaultAmount)->setFieldHolderTemplate('FormField_holder_nodiv');
        return $freq_val_curr;
    }
    private function formDonationChoices() {
        $ab_ID = array_rand(self::$donate_ab);
        $frequency = DropdownField::create("frequency")->setSource(array(
            "oneshot"   => _t("DonatePage.FreqOneshot", "One-time donation"),
            "monthly"   => _t("DonatePage.FreqMonthly", "Monthly donation"),
            "quarterly" => _t("DonatePage.FreqQuarterly", "Quarterly donation"),
            "yearly"    => _t("DonatePage.FreqYearly", "Yearly donation")
        ))->setValue("oneshot")->setTitle(null)->addExtraClass('donate_frequency');
        $amount = NumericField::create("customValue")->setValue($this->PreselectedAmount)->setMaxLength(10)->setTitle(null)->addExtraClass('donate_input');
        $defaultAmount  = HiddenField::create("Amount")->setValue($this->PreselectedAmount);
        $currencies = $this->newDonateCurrencies();
        $currency = DropdownField::create("currency")->setSource($currencies)
            ->setValue(_t("DonatePage.DEFAULT_CURRENCY", "USD"))->setTitle(null)->addExtraClass('donate_currency');
        $freq_val_curr = CompositeField::create($frequency, $amount, $currency, $defaultAmount)->setFieldHolderTemplate('FormField_holder_nodiv');
        return $freq_val_curr;
    }

    private function formDonationChoicesRecurring() {
        $ab_ID = array_rand(self::$donate_ab);
        $frequency = DropdownField::create("frequency")->setSource(array(
            "oneshot"   => _t("DonatePage.FreqOneshot", "One-time donation"),
            "monthly"   => _t("DonatePage.RecMonthly", "Monthly recurring donation"),
            "quarterly" => _t("DonatePage.RecQuarterly", "Quarterly recurring donation"),
            "yearly"    => _t("DonatePage.RecYearly", "Yearly recurring donation")
        ))->setValue("monthly")->setTitle(null)->addExtraClass('donate_frequency');
        $amount = NumericField::create("customValue")->setValue(self::$donate_ab_recurring["monthly"])->setMaxLength(10)->setTitle(null)->addExtraClass('donate_input');
        $defaultAmount  = HiddenField::create("Amount")->setValue(self::$donate_ab_recurring["monthly"]);
        // recurring donations only supported with paypal
        $currency = DropdownField::create("currency")->setSource(self::$paypal_currencies)
            ->setValue(_t("DonatePage.DEFAULT_CURRENCY", "USD"))->setTitle(null)->addExtraClass('donate_currency');
        $freq_val_curr = CompositeField::create($frequency, $amount, $currency, $defaultAmount)->setFieldHolderTemplate('FormField_holder_nodiv');
        return $freq_val_curr;
    }

    /* the donation form - it would also be possible to do it with a self-written template, but doing it
     * within silverstipe will automatically add validation to field-inputs as well as automatically add
     * the CSRF-protection (but as there is not much to verify...)
     */
    private function DonationProceed_new()
    {
        $freq_val_curr = $this->UseButtons ? $this->formDonationChoicesButtons() : $this->formDonationChoices();
        $introtext = LiteralField::create("intro", '<div class="donate_intro_text">' . _t("DonatePage.LeadText", 'LibreOffice is Free Software and is made available free of charge. Your donation supports our worldwide community of hundreds of contributors and volunteers, serving tens of millions of users.') . '</div>');
        $banner = LiteralField::create("banner", '<img style="max-width:100%;padding-bottom:20px;" src="https://www.libreoffice.org/assets/Uploads/donate-page-community-banner.jpg">');
        // FYI: empty PrivacyDisclaimer text to not show anything (i.e. no english fallback) when there's no translation
        // FYI2: changed our mind, so add the privacydisclaimertext...
        $footer = LiteralField::create("footer", '<div class="donate_footer_text">' . _t("DonatePage.FooterText", 'Other ways to give: Bitcoin, Flattr, bank transfer - click the boxes below<br/>Questions about your donation? <a href="mailto:info@documentfoundation.org">Send us an email</a>') . '<br/>' . _t("DonatePage.PrivacyDisclaimer", 'During processing of your donation, your payment data will be transferred to a financial service provider. For further information, see our <a href="{privacypolicyurl}">privacy policy</a>.', array('privacypolicyurl' => 'https://www.libreoffice.org/privacy')) . '</div>');
        $paypal_logo = LiteralField::create("paypal_logo", '<img onclick="(function(){jQuery(\'#Form_DonationProceed_action_paypal\').click();})()" src="https://www.libreoffice.org/assets/Uploads/donate-paypal-logo.png" height="41" style="margin-top:-3px; margin-right: 20px;" />');
        $credit_card_logo = LiteralField::create("credit_card_logo", '<i onclick="(function(){jQuery(\'#Form_DonationProceed_action_stripe\').click();})()" class="fa fa-credit-card toggle" aria-hidden="true" style="font-size:36pt;margin-top:-4px; margin-left: 20px;"></i>');
        /* can be used to set custom back to site, cancel, etc URLs, and of course to determine the language */
        $subsite = HiddenField::create("subsite")->setValue($this->SubsiteID);
        $fromurl = HiddenField::create("homeurl")->setValue($this->AbsoluteLink());
        $language = HiddenField::create("language")->setValue(i18n::get_locale_from_lang($this->ContentLocale()));
        $complus = HiddenField::create("complus")->setValue(i18n::get_locale_from_lang($this->ContentLocale()));
        $piwikGoal = HiddenField::create("piwikGoal")->setValue(self::$piwik_goal);
        //$predefined = OptionsetField::create('Amount')->setTitle(null)->setSource(
        //    array("05" => _t("DonatePage.DEFAULT_AMOUNT_EUR05",  "5")." "._t("DonatePage.DEFAULT_CURRENCY"),
        //    "10" => _t("DonatePage.DEFAULT_AMOUNT_EUR10", "10")." "._t("DonatePage.DEFAULT_CURRENCY"),
        //    "20" => _t("DonatePage.DEFAULT_AMOUNT_EUR20", "20")." "._t("DonatePage.DEFAULT_CURRENCY"),
        //    "50" => _t("DonatePage.DEFAULT_AMOUNT_EUR50", "50")." "._t("DonatePage.DEFAULT_CURRENCY")))->setValue("10");
        //$defaultChoices = _t("DonatePage.CHOICE_DEFAULT", "Select one of the default values");
        //$customAmount = _t("DonatePage.CUSTOM_CHOICE", "Or enter a custom amount and currency<br/>(only those marked with * are also available via PayPal)");
        //$groups = new SelectionGroup("toggle_custom",array("predefined//".$defaultChoices => $predefined,
        //    "custom//".$customAmount => new FieldGroup(NumericField::create("customValue")->setValue(_t("DonatePage.CUSTOM_AMOUNT_VALUE", "25"))->setMaxLength(10)->setTitle(null), $currency)));
        //$groups->setValue("predefined");
        //$email = EmailField::create("email")->setTitle(null)
        //                                    ->setRightTitle(_t("DonatePage.OPTIONAL_EMAIL", "optional Email"))
        //                                    ->setDescription(_t("DonatePage.OPTIONAL_EMAIL_DES", "if you want confirmation mail for credit card payments"));
        $email = HiddenField::create("email")->setTitle(null)
            ->setRightTitle(_t("DonatePage.OPTIONAL_EMAIL", "optional Email"))
            ->setDescription(_t("DonatePage.OPTIONAL_EMAIL_DES", "if you want confirmation mail for credit card payments"));
        $concardisAction = FormAction::create("concardis")->setTitle(_t("DonatePage.BUTTON_CARD", "Donate via Credit Card"))->addExtraClass('donate_submit');
        // the button that is displayed
        $stripeAction = FormAction::create("stripebutton")->setTitle(_t("DonatePage.BUTTON_CARD", "Donate via Credit Card"))->addExtraClass('donate_submit');
        // the action that is triggered after the stripe form passes
        $stripeActionReal = FormAction::create("stripe")->setTitle(_t("DonatePage.BUTTON_CARD", "Donate via Credit Card"))->addExtraClass('donate_submit');
        //->addExtraClass("hidden");
        $newrecaptcha = LiteralField::create('norecaptcha', '<div><!-- empty --></div>');
        if (self::useCaptcha()) {
            if ($this->useInvisibleCaptcha()) {
                $concardisAction->setAttribute('data-sitekey', self::config()->invisiblePubKey)
                    ->setAttribute('data-callback', 'submittheform')
                    ->setAttribute('data-error-callback', 'recaptchaerror')
                    ->addExtraClass('g-recaptcha');
                $stripeAction->setAttribute('data-sitekey', self::config()->invisiblePubKey)
                    ->setAttribute('data-callback', 'showstripeform')
                    ->addExtraClass('g-recaptcha');
                $newrecaptcha->setContent('<input type="submit" class="hidden" name="action_concardis" value="indirectly triggered via recaptcha" id="submittrigger">');
                Requirements::customScript('function recaptchaerror() {jQuery("#Form_DonationProceed_action_concardis").hide(); } function submittheform() { jQuery("#submittrigger").click(); }');
            } else {
                $newrecaptcha->setContent('<div class="g-recaptcha" data-sitekey="' . Config::inst()->get('RecaptchaField', 'public_api_key') . '"></div>');
            }
        }
        $fields = new FieldList($subsite, $fromurl, $language, $complus, $piwikGoal, $email, $introtext, $newrecaptcha, $freq_val_curr);
            //$credit_card_logo,
            //$concardisAction,
        $actions = new FieldList(
            FormAction::create("paypal")->setTitle(_t("DonatePage.BUTTON_PAYPAL", "Donate via PayPal"))->addExtraClass('donate_submit'),
            $paypal_logo, $credit_card_logo, $stripeActionReal, 
            $introtext,
            $footer);

        if ($this->ReverseLayout == "_reversed_icons_recurring") {
             // recurring stuff
            $freq_val_curr_rec = $this->formDonationChoicesRecurring();
            $freq_val_curr->fieldByName('Amount')->setName('Amount_disabled');
            // don't reset source to just oneshot, that breaks validation...
            $freq_val_curr->fieldByName('frequency')->setName('frequency_disabled')->setValue("oneshot")->addExtraClass("hidden")->setHasEmptyDefault(true);
            $freq_val_curr->fieldByName('customValue')->setName('customValue_disabled');
            // provide default value tonot trigger validation error...
            $freq_val_curr->fieldByName('currency')->setName('currency_disabled')->setHasEmptyDefault(true);
            //$paypal_logo->setContent(str_replace('toggle','toggle hidden', $paypal_logo->getContent()));
            $credit_card_logo->setContent(str_replace('toggle', 'toggle hidden', $credit_card_logo->getContent()));
            $introtext_rec = LiteralField::create("intro_rec", '<div class="donate_intro_text toggle" style="text-align:center;">' . _t("DonatePage.RecurringText", 'Recurring donation') . '</div>');
            $introtext_onetime = LiteralField::create("intro_rec", '<div class="donate_intro_text hidden toggle" style="text-align:center;">' . _t("DonatePage.OnetimeText", 'One-time donation') . '</div>');
            $toggle_recurring = LiteralField::create("toggle", '<input class="toggle" id="one-time-button" type="button" name="answer" value="Click here to donate via credit card / make a one-time donation" style="margin:27px auto 0 auto;display:block;" onclick="showOneTimeForm()" />');
            //$toggle_recurring2 = LiteralField::create("toggle", '<input class="hidden toggle" id="one-time-button" type="button" name="answer" value="Click here to make a recurring donation instead" style="margin:0 auto;display:block;" onclick="showOneTimeForm()" />');
            $fields->add($introtext_rec);
            $fields->insertAfter($introtext_onetime, 'norecaptcha');
            $fields->add($freq_val_curr_rec);
            $actions->insertBefore($toggle_recurring, "intro");
            //$actions->insertBefore($toggle_recurring2, "intro");
            $concardisAction->addExtraClass('hidden toggle');
            //$stripeAction->addExtraClass('hidden toggle');
            $freq_val_curr->addExtraClass('hidden toggle');
            $freq_val_curr_rec->addExtraClass('toggle');
            //$credit_card_logo->addExtraClass('hidden');
        }

        if ($this->UseDonateBanner) {
            $fields->insertBefore($banner, 'subsite');
        }
        if($this->ReverseLayout) {
            $fields->remove($introtext);
        } else {
            $actions->remove($introtext);
        }
//        if($this->ReverseLayout != "_reversed_icons") {
//            $actions->remove($paypal_logo);
//            $actions->remove($credit_card_logo);
//        }
        $proceedform = new Form($this, "DonationProceed", $fields, $actions, $requiredFields = new RequiredFields(array("Amount","customValue")));

        return $proceedform;
    }
    function nonav($request) {
        $this->HideNavigation = true;
        return $this;
        //return index($request);
    }
    function StripePubkey() {
        return Config::inst()->get('StripePayments', 'publishable');
    }
	function stripe($data, $form) {
		\Stripe\Stripe::setApiKey(Config::inst()->get('StripePayments', 'secret'));

		if ($data['frequency'] == 'oneshot') {
			// theoretically the checkout js already does the checks for us, so we should never get
			// a bad result (at least not with credit card method)
            $data['frequency'] = "one-time"; // relabel to more user-friendly value
			try {
                // statement_descriptor is limited to 22 characters
				$result = \Stripe\Checkout\Session::create([
					'submit_type' => 'donate',
					'success_url' => 'https://www.libreoffice.org/donate/thankyou',
					'cancel_url' =>  'https://www.libreoffice.org/donate/cancel',
					'payment_intent_data' => ['description' => 'Donation to The Document Foundation/LibreOffice'],
					'payment_method_types' => ['card'],
					'line_items' => [[
						'amount' => floor($data["customValue"]*(in_array($data["currency"], self::$nodecimal_currencies) ? 1 : 100)),
						'quantity' => 1,
						'name' => 'Donation to The Document Foundation',
						'currency' => strtolower($data["currency"])
					]]
                ]);

			} catch (Exception $e) {
				// Something else happened, completely unrelated to Stripe
				//Debug::dump($e);
			}
		} else {
			// recurring donation, check for existing plan
			$plan = null;
			if ($data['frequency'] == 'monthly') {
				try {
					$plan = \Stripe\Plan::retrieve("plan_monthly_".strtolower($data['currency']));
				} catch(Exception $e) {
					       SS_Log::log(serialize(array("plan does not exist", $e)), SS_Log::WARN);

					try {
						// plan doesn't exist yet, create it
						$plan = \Stripe\Plan::create([
							"amount" => in_array($data["currency"], self::$nodecimal_currencies) ? 1 : 100,
							"interval" => "month",
							"product" => "prod_Fk7hlgiphUkZpi",
							"currency" => strtolower($data['currency']),
							"nickname" => "monthly_".strtolower($data['currency']),
							"id" => "plan_monthly_".strtolower($data['currency'])
						]);
					} catch(Exception $e) {
						SS_Log::log(serialize(array("plan create failed", $e)), SS_Log::WARN);
					}
				}
			}
			if ($data['frequency'] == 'quarterly') {
				try {
					$plan = \Stripe\Plan::retrieve("plan_quarterly_".strtolower($data['currency']));
				} catch(Exception $e) {
					       SS_Log::log(serialize(array("plan does not exist", $e)), SS_Log::WARN);

					try {
						// plan doesn't exist yet, create it
						$plan = \Stripe\Plan::create([
							"amount" => in_array($data["currency"], self::$nodecimal_currencies) ? 1 : 100,
							"interval" => "month",
							"interval_count" => 3,
							"product" => "prod_Fk7hlgiphUkZpi",
							"currency" => strtolower($data['currency']),
							"nickname" => "quarterly_".strtolower($data['currency']),
							"id" => "plan_quarterly_".strtolower($data['currency'])
						]);
					} catch(Exception $e) {
						SS_Log::log(serialize(array("plan create failed", $e)), SS_Log::WARN);
					}
				}
			}
			if ($data['frequency'] == 'yearly') {
				try {
					$plan = \Stripe\Plan::retrieve("plan_yearly_".strtolower($data['currency']));
				} catch(Exception $e) {
					       SS_Log::log(serialize(array("plan does not exist", $e)), SS_Log::WARN);

					try {
						// plan doesn't exist yet, create it
						$plan = \Stripe\Plan::create([
							"amount" => in_array($data["currency"], self::$nodecimal_currencies) ? 1 : 100,
							"interval" => "year",
							"product" => "prod_Fk7hlgiphUkZpi",
							"currency" => strtolower($data['currency']),
							"nickname" => "yearly_".strtolower($data['currency']),
							"id" => "plan_yearly_".strtolower($data['currency'])
						]);
					} catch(Exception $e) {
						SS_Log::log(serialize(array("plan create failed", $e)), SS_Log::WARN);
					}
				}
			}
			if ($plan) {
				try {
					$result = \Stripe\Checkout\Session::create([
						'success_url' => 'https://www.libreoffice.org/donate/thankyou',
						'cancel_url' =>  'https://www.libreoffice.org/donate/cancel',
						'payment_method_types' => ['card'],
						'subscription_data' => [ 'items' => [['plan' => $plan->id, 'quantity' => floor($data["customValue"])]] ]
                    ]);

				} catch (Exception $e) {
					SS_Log::log(serialize($e), SS_Log::WARN);
				}
			}
		}
		return $this->renderWith(array("DonateProceed", "Page"),
			array('MetaTitle' => "Donate", 'type' => "stripe", 'stripesessionid' => $result->id, 'data' => new ArrayData($data)));
	}

    function stripe_old($data, $form) {
        \Stripe\Stripe::setApiKey(Config::inst()->get('StripePayments', 'secret'));
        $captcha_result = self::verify_captcha($data['g-recaptcha-response'], $this->request->getIP());
        if( $captcha_result !== true) {
            $form->addErrorMessage('norecaptcha', 'google thinks you are a robot, please try again later', 'bad');
            return $this->redirectBack();
        }
        if($data['toggle_custom'] == 'predefined') {
            $data['customValue'] = _t("DonatePage.DEFAULT_AMOUNT_EUR".$data['Amount']);
        }
        #Debug::dump($data);

            $data['frequency'] = "one-time"; // relabel to more user-friendly value
			try {
                // statement_descriptor is limited to 22 characters
				$result = \Stripe\Checkout\Session::create([
					'submit_type' => 'donate',
					'success_url' => 'https://www.libreoffice.org/donate/thankyou',
					'cancel_url' =>  'https://www.libreoffice.org/donate/cancel',
					'payment_intent_data' => ['description' => 'Donation to The Document Foundation/LibreOffice'],
					'payment_method_types' => ['card'],
					'line_items' => [[
						'amount' => floor($data["customValue"]*(in_array($data["currency"], self::$nodecimal_currencies) ? 1 : 100)),
						'quantity' => 1,
						'name' => 'Donation to The Document Foundation',
						'currency' => strtolower($data["currency"])
					]]
                ]);
		return $this->renderWith(array("DonateProceed", "Page"),
			array('MetaTitle' => "Donate", 'type' => "stripe", 'stripesessionid' => $result->id, 'data' => new ArrayData($data)));

			} catch (Exception $e) {
				// Something else happened, completely unrelated to Stripe
				//Debug::dump($e);
            }


        // theoretically the checkout js already does the checks for us, so we should never get
        // a bad result (at least not with credit card method)
        try {
            $result = \Stripe\Charge::create(array(
                "capture" => true,
                "amount" => floor($data["customValue"]*(in_array($data["currency"], self::$nodecimal_currencies) ? 1 : 100)),
                "currency" => strtolower($data["currency"]),
                "source" => $data["action_stripe"], // obtained with Stripe.js
                "receipt_email" => $data["email"], // obtained with Stripe.js
                "description" => "Donation to The Document Foundation"
            ));
        } catch(\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            $body = $e->getJsonBody();
            $err  = $body['error'];
            //Debug::dump($err);

        } catch (\Stripe\Error\RateLimit $e) {
            // Too many requests made to the API too quickly
            Debug::dump($e);
        } catch (\Stripe\Error\InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
            Debug::dump($e);
        } catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            Debug::dump($e);
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
            Debug::dump($e);
        } catch (\Stripe\Error\Base $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            Debug::dump($e);
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            Debug::dump($e);
        }
        //Debug::dump($result);
        return $this->renderWith(array("DonatePage_thankyou", "Page"));
        //return $this->redirectBack();
    }
    /* form action paypal - ignores the captcha */
    function paypal($data, $form) {
            if ($data['customAmount'] != "" && !is_numeric(str_replace(',', '.', $data['customAmount']))) {
                    //$form->addErrorMessage('customAmount', 'Sorry, failed to parse the value', 'bad');
                    $form->addErrorMessage('customValue', 'Sorry, failed to parse the value', 'bad');
                    $form->addErrorMessage('customAmount', 'Sorry, failed to parse the value', 'bad');
                    return $this->redirectBack();
            }
            return $this->verifyPOST($this->request);
    }
    /* form action concardis - requires the captcha */
    function concardis($data, $form) {
            if( $this->useNewDonate() && $data['frequency'] != 'oneshot') {
                    $form->addErrorMessage('composite', 'Sorry, Recurring donations are only available using PayPal', 'bad');
                    return $this->redirectBack();
            }
            if ($data['customAmount'] != "" && !is_numeric(str_replace(',', '.', $data['customAmount']))) {
                    $form->addErrorMessage('customAmount', 'Sorry, you need to enter a number', 'bad');
                    return $this->redirectBack();
            }
            if(!self::useCaptcha()) { return $this->verifyPOST($this->request); }
            // did the user bother to use the captcha at all?
            if( !isset($data['g-recaptcha-response']) || empty($data['g-recaptcha-response'])) {
                    $form->addErrorMessage('norecaptcha', 'please confirm that you are not a robot', 'bad');
                    return $this->redirectBack();
            }
            $captcha_result = self::verify_captcha($data['g-recaptcha-response'], $this->request->getIP());
            if( $captcha_result === true) {
                    return $this->verifyPOST($this->request);
            }
            $form->addErrorMessage('norecaptcha', 'google thinks you are a robot, please try again later', 'bad');
            return $this->redirectBack();
    }
    /* verifies the new-style no-challenge recaptcha */
    private function verify_captcha($response, $remoteIP) {
            $apiURL = 'https://www.google.com/recaptcha/api/siteverify';
            $captcha_secret = Config::inst()->get('RecaptchaField', 'private_api_key');
            if ($this->useInvisibleCaptcha()) {
                $captcha_secret = self::config()->invisibleSecret;
            }
            $postVars = array('secret' => $captcha_secret,
                            'response' => $response,
                            'remoteip' => $remoteIP);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiURL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_REFERER, "https://donate.libreoffice.org/");
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postVars));
            $googleJSON = curl_exec($ch);
            curl_close($ch);
            if($googleJSON) {
                    $google_parsed = json_decode($googleJSON,true);
                    if($google_parsed['success'] === true) {
                            return true;
                    }
            }
            return false;
    }

    /* helper function to sanity-check the submission before it is handed over to the payment-provider */
    private function verifyPOST($request) {
        //Debug::dump($request->postVars());
        if(!SecurityToken::inst()->checkRequest($request)) {
            return $this->httpError(400);
        }
        if ($request->postVar('action_paypal') xor $request->postVar('action_concardis')) {
            /* filter out not-essential stuff */
            $post_data = array_intersect_key($request->postVars(), self::$defaultvars);
            if ($request->postVar('toggle_custom') == "predefined") {
                i18n::set_locale($post_data['language']);
                $post_data['Amount'] = _t("DonatePage.DEFAULT_AMOUNT_EUR".$post_data['Amount']);
            } else {
                /* TODO: Do some more validation */
                if ($request->postVar('customAmount') != "") {
                    $post_data['Amount'] = str_replace(',', '.', $request->postVar('customAmount'));
                } else {
                    $post_data['Amount'] = str_replace(',', '.', $request->postVar('customValue'));
                }
                $post_data['defaultAmount'] = str_replace(',', '.', $request->postVar('Amount'));
                $post_data['piwikGoal'] = $request->postVar('piwikGoal');
            }
        } elseif ($request->postVar('action_stripe')) {
            $post_data = array_intersect_key($request->postVars(), self::$defaultvars);
            if ($request->postVar('toggle_custom') == "predefined") {
                i18n::set_locale($post_data['language']);
                $post_data['Amount'] = _t("DonatePage.DEFAULT_AMOUNT_EUR".$post_data['Amount']);
            } else {
                /* TODO: Do some more validation */
                if ($request->postVar('customAmount') != "") {
                    $post_data['Amount'] = str_replace(',', '.', $request->postVar('customAmount'));
                } else {
                    $post_data['Amount'] = str_replace(',', '.', $request->postVar('customValue'));
                }
                $post_data['defaultAmount'] = str_replace(',', '.', $request->postVar('Amount'));
                $post_data['piwikGoal'] = $request->postVar('piwikGoal');
            }

        } else {
            return $this->httpError(400);
        }

        if ($request->postVar('action_concardis')) {
            return self::proceedConcardis($post_data,null);
        } elseif ($request->postVar('action_stripe')) {
            return self::proceedStripe($post_data,null);
        } else {
            if($request->postVar('frequency') != 'oneshot') {
                $post_data['frequency'] = $request->postVar('frequency');
            }
            return self::proceedPaypal($post_data,null);
        }
    }
    /* create the form that auto-submits to the payment operator */
    private function proceedPaypal($data, $form) {
        $this->Locale = $data['language'];
        return $this->renderWith(array("DonateProceed", "Page"),
            array('MetaTitle' => "Donate", 'type' => "paypal", 'paypallang' => $this->landinglang(), 'data' => new ArrayData($data)));
    }
    private function proceedConcardis($data, $form) {
        $data["centamount"]=$data['Amount']*100;
        return $this->renderWith(array("DonateProceed", "Page"),
            array('MetaTitle' => "Donate", 'type' => "concardis", 'data' => self::form_sign($data)));
    }
    /* create the form that auto-submits to the payment operator */
    private function proceedStripe($data, $form) {
        // no need to redirect to intermediate page, we can charge directly
    }
    /* post-data to Concardis needs to be hashed as a security measure
     * keys that are only set to a value must not be included
     * make sure it is alphabetically sorted
     */
    private static function form_sign($input_array) {
        /* TODO: conditionalize email, etc */
        $input_array['orderid'] = uniqid("LIBODONATE-");
        $output_array = array_merge(self::$defaultvars, $input_array);
        //"CATALOGURL=".  $output_array['catalogurl']  .self::$passphrase.
        //"EMAIL=".       $output_array['email']       .self::$passphrase.
        $output_array['sign'] = strtoupper(hash('sha512',
            "ACCEPTURL=".   $output_array['accepturl']   .self::$passphrase.
            "AMOUNT=".      $output_array['centamount']  .self::$passphrase.
            "CANCELURL=".   $output_array['cancelurl']   .self::$passphrase.
            "COM=".         $output_array['com']         .self::$passphrase.
            "COMPLUS=".     $output_array['language']    .self::$passphrase.
            "CURRENCY=".    $output_array['currency']    .self::$passphrase.
            "DECLINEURL=".  $output_array['declineurl']  .self::$passphrase.
            (empty($output_array['email']) ? "" :
                   "EMAIL=".$output_array['email']       .self::$passphrase
            ).
            "EXCEPTIONURL=".$output_array['exceptionurl'].self::$passphrase.
            "HOMEURL=".     $output_array['homeurl']     .self::$passphrase.
            "LANGUAGE=".    $output_array['language']    .self::$passphrase.
            "OPERATION=".   $output_array['operation']   .self::$passphrase.
            "ORDERID=".     $output_array['orderid']     .self::$passphrase.
            "PMLISTTYPE=".  $output_array['pmlisttype']  .self::$passphrase.
            "PSPID=".       $output_array['pspid']       .self::$passphrase.
            "TP=".          $output_array['tp']          .self::$passphrase.
            "WIN3DS=".      $output_array['win3ds']      .self::$passphrase,
            FALSE));

        return new ArrayData($output_array);
    }
    /* handle download-requests */
    public function donatedl($request) {
        $dlType = array_key_exists($request->param("type"), DownloadObject::$typenames) ? $request->param("type") : null;
        $dlVersion = preg_match('/^\d+(\.\d+){2,3}$/', $request->param("version")) ? $request->param("version") : null;
        $dlLang = preg_match('/^(multi|[a-z]{2,3}(-[A-Za-z]{2,8})?)$/', $request->param("lang")) ? $request->param("lang") : null;

        if ($dlType && $dlLang && $dlVersion) {
            $osarch = explode('-', $dlType);
            $download = MainDownload::get()->filter(array('Platform' => $osarch[0],
                                                              'Arch' => $osarch[1],
                                                              'Version:StartsWith' => $dlVersion))->sort('Version', 'DESC')->first();
            if (!$download) {
                $this->InvalidDownload = '<p class="bs-callout bs-callout-danger">' . _t("DonateDownload.Outdated", "Download requested seems to be outdated? Please go to <a href='//www.libreoffice.org/download'>our downloadpage</a> and pick a current version.<br/>For technical problems with the download itself, please write to <a href='mailto:download@libreoffice.org?subject=Problem with download - outdated'>download@libreoffice.org</a>. Be advised that we <strong>do not</strong> provide technical support at this address.") .'</p>';
                 return $this;
             }
            $this->Downloads = new ArrayData(array('full' => $download ));
            $langpack = $download->LangPack($dlLang);
            $helppack = $download->HelpPack($dlLang);
            if($langpack) $this->Downloads->setField('langpack', $langpack);
            if($helppack) $this->Downloads->setField('helppack', $helppack);
            $this->RefreshTarget = $download;
        }
        if ($this->RefreshTarget->Filename != $request->param("file").".".$request->getExtension()) {
 $this->RefreshTarget = Null;
                $this->InvalidDownload = '<p class="bs-callout bs-callout-danger">' . _t("DonateDownload.Invalid", "Download requested seems invalid. Please go to <a href='//www.libreoffice.org/download'>our downloadpage</a> and pick a current version.<br/>For technical problems with the download itself, please write to <a href='mailto:download@libreoffice.org?subject=Problem with download - malformed'>download@libreoffice.org</a>. Be advised that we <strong>do not</strong> provide technical support at this address.") .'</p>';
}
        return $this;
    }
    /* start download via meta-refresh when pass-through via downloadpage */
    public function Metatags($includeTitle = true) {
        $metatags = parent::Metatags($includeTitle);
        if ($this->RefreshTarget) {
            $metatags.= '<meta http-equiv="Refresh" content="0; url=https://download.documentfoundation.org/'.$this->RefreshTarget->Fullpath.'"/>';
        }
        return $metatags;
    }

    public function init() {
        parent::init();
        // rdm#2371
        $this->ReverseLayout = "_reversed_icons";
        if ($this->ID == 28) {
            switch (mt_rand(0,3)) {
            case 0:
                // reversed without banner
                break;
            case 1:
                // reversed with donate banner
                // disabled as per mail from Nov 26  $this->UseDonateBanner = 1;
                break;
            case 2:
                // twice the probability for reversed variant
                $this->ReverseLayout = "_reversed_icons_recurring";
                break;
            case 3:
                // intentionally duplicated, see above
                $this->ReverseLayout = "_reversed_icons_recurring";
                break;
            }
        }
        //switch (mt_rand(0,2)) {
        //case 0:
        //    // radiobuttons_reversed;
        //    $this->UseButtons = 1;
        //    break;
        //case 1:
        //    // dropdown_reversed
        //    $this->UseButtons = 0;
        //    break;
        //case 2:
        //    // radiobuttons_slider_reversed;
        //    $this->UseButtons = 1;
        //    $this->OptionSlider = "_slider";
        //    break;
        //}
        // 04-19 reduce to one variant: dropdown_reversed
        $this->UseButtons = 0;
        $this->PreselectedAmount = self::$donate_ab_probs[array_rand(self::$donate_ab_probs)]['amount'];
    }

    /* let it compare to a fantasy-number to disable (use == 28 to enable for www.libreoffice.org/donate ) */
    function useNewDonate() {
        // 28 →  en, 1526 → fr, 3894 → es, 1748 → de, 503 → pt_BR, 3302 → ro, 2192 → it
        return in_array($this->ID, array(28,
            1526,
            3894,
            1748,
            503,
            3302,
            2192,
            "zendlocale5579", //hsb
            "zendlocale5655", //dsb
            3820, // Slovenian
            1082, // Danish - translated but still olddesign
            3154, // Portuguese
            942, // Czech
            1156, // Dutch
            4486, // Welsh
            742, // zh-CN
            834, // zh-TW
            4116, // Turkish
            2414, // Korean
            111111 //to make array copy'n'paste of lines less error prone
        ));
    }
    /* enable or disable captcha */
    private static function useCaptcha() {
        return TRUE;
    }
    public function useInvisibleCaptcha() {
        return $this->useNewDonate() && TRUE; /* nur auf neuem Design, also extra ausschalter */
    }
}
