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

    private static $allowed_actions = array(
        'DonationProceed',
        'nonav',
        'thankyou',
        'thanksbut',
        'cancel',
        'oops',
        'ConcardisTemplate'
    );
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
        $newrecaptcha = LiteralField::create('norecaptcha', '<div class="g-recaptcha" data-sitekey="'.RecaptchaField::$public_api_key.'"></div>');
        $fields = new FieldList( $subsite, $fromurl, $language, $complus, $groups, $email, $newrecaptcha);
        $actions = new FieldList(
            FormAction::create("paypal")->setTitle(_t("DonatePage.BUTTON_PAYPAL", "Donate via PayPal")),
            FormAction::create("concardis")->setTitle(_t("DonatePage.BUTTON_CARD",   "Donate via Credit Card")));
        $proceedform = new Form($this, "DonationProceed", $fields, $actions, $requiredFields = new RequiredFields(array("Amount","customValue")));

        return $proceedform;
    }

    function nonav($request) {
        $this->HideNavigation = true;
        return $this;
        //return index($request);
    }
    /* form action paypal - ignores the captcha */
    function paypal($data, $form) {
            return $this->verifyPOST($this->request);
    }
    /* form action concardis - requires the captcha */
    function concardis($data, $form) {
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
    private static function verify_captcha($response, $remoteIP) {
            $apiURL = 'https://www.google.com/recaptcha/api/siteverify';
            $postVars = array('secret' => RecaptchaField::$private_api_key,
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
            if ($request->postVar('toggle_custom') == "custom") {
                /* TODO: Do some more validation */
                $post_data['Amount'] = str_replace(',', '.', $request->postVar('customValue'));
            } else {
                i18n::set_locale($post_data['language']);
                $post_data['Amount'] = _t("DonatePage.DEFAULT_AMOUNT_EUR".$post_data['Amount']);
            }
            Requirements::customScript(<<<JS
jQuery(document).ready(function() {
jQuery("#autosubmit").submit();
 });
JS
        );
        } else {
            return $this->httpError(400);
        }

        if ($request->postVar('action_concardis')) {
            return self::proceedConcardis($post_data,null);
        } else {
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
}
