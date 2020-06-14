<section id="content1" class="section">
<div class="container">
    <article>
<% if $RefreshTarget %><% include DonateDownload %><% end_if %>$InvalidDownload
    <div class="row">
    <div class="col-sm-8 margin-20">
    <div class="row margin-20">
        <% include BreadCrumbs %>
<h3<% if $UseDonateBanner %> style="color:#1C99E0"<% end_if %>><% if $RefreshTarget %><%t DonatePage.WhileYouDownload "While you are downloading, please consider supporting LibreOffice with a donation" %><% else %><% if $UseDonateBanner %>Support us - be a Friend of LibreOffice!<% else %><% if $ReverseLayout %><%t DonatePage.ReverseLayoutTitle "Support LibreOffice" %><% else %>$Title<% end_if %><% end_if %><% end_if %></h3>
<!-- DonationProceed form -->
<% if not $useNewDonate %>
        <p class="lead_libre"><%t DonatePage.LeadText "LibreOffice is Free Software and is made available free of charge. Your donation supports our worldwide community of hundreds of contributors and volunteers, serving tens of millions of users." is "subtitle style lead text on donate page" %></p>
        $Content
<% else %>
<% require themedCSS('donate') %>
<% require themedCSS('jquery-ui') %>
<% require javascript("themes/libreofficenew/js/jquery-1.10.1.min.js") %>
<% require javascript('https://code.jquery.com/ui/1.12.1/jquery-ui.js') %>
$DonationProceed
<div id="donateaccordion">
<h3><%t DonatePage.BankHeader "Bank transfers, and additional information for US residents" %></h3>
<div id="banktransfer" class="well">
<h4><%t DonatePage.Bank "You can transfer a donation to our bank account" %></h4>
<p><%t DonatePage.BankDetails "<strong>Owner</strong>: {owner}<br/><strong>Purpose</strong>: Donation<br/><strong>Account</strong>: {accountNumber}<br/><strong>Bank Code</strong>: {bankCode}<br/><strong>IBAN</strong>: {IBAN}, BIC: {BIC}<br/><strong>Address of recipient</strong>: {tdfAddress}<br/><strong>Address of bank</strong>: {bankAddress}" owner="The Document Foundation" accountNumber="3497390" bankCode="66690000" IBAN="DE12666900000003497390" BIC="VBPFDE66" tdfAddress="The Document Foundation, Kurfürstendamm 188, 10707 Berlin, Germany" bankAddress="Volksbank Pforzheim eG, Westliche-Karl-Friedrich-Str. 53, 75172 Pforzheim, Germany" %></p>
<hr style="border-top:1px solid grey;" />
<h4><%t DonatePage.Spi "LibreOffice is an SPI-associated project" %></h4>
<p><%t DonatePage.SpiDetails "You can also <a href='https://www.spi-inc.org/donations/'>donate from the US</a> by mentioning \"LibreOffice\" with your donation. Note that donations through SPI can be deducted from US taxes." %></p>
</div>
<h3><%t DonatePage.BitcoinHeader "Digital currencies (eg Bitcoin) and Flattr" %></h3>
<div id="bitcoin" class="well">
<% include BitPay %>
<hr style="border-top:1px solid grey;" />
<h4><%t DonatePage.Flattr "You can <a href='{flattrlink}'>Flattr</a> us" flattrlink="https://flattr.com/thing/256305/tdf-on-Flattr" %></h4>
</div>
<h3><%t DonatePage.TaxHeader "Tax deductions" %></h3>
<p><%t DonatePage.TaxHint "<strong>Donations to The Document Foundation are tax-deductible in several countries.<br/>Please refer to your local tax office for details.</strong><br/><strong>For residents of Germany:</strong> <em>\"{germanLegalText}\"</em>" germanLegalText="Für Spenden bis zu 200 € pro Jahr akzeptiert das Finanzamt den Kontoauszug als Spendenbescheinigung. Zusätzlich teilen Sie dem Finanzamt bitte mit, aufgrund welcher Bescheinigung und Steuernummer »The Document Foundation« als gemeinnützig anerkannt ist. <em>'Wir sind wegen Förderung von Wissenschaft und Forschung; der Volks- und Berufsbildung einschließlich der Studentenhilfe; des bürgerschaftlichen Engagements nach dem Freistellungsbescheid bzw. nach der Anlage zum Körperschaftsteuerbescheid des Finanzamtes Berlin StNr 27/641/01975, vom 14.04.2020 für den letzten Veranlagungszeitraum 2016-2018 nach § 5 Abs. 1 Nr. 9 des Körperschaftsteuergesetzes von der Körperschaftsteuer und nach § 3 Nr. 6 des Gewerbesteuergesetzes von der Gewerbesteuer befreit.'</em><br /><br />Einen vereinfachten Zuwendungsnachweis nach § 50 Abs. 2 Nr. 2 b EStDV können Sie <a href='https://www.libreoffice.org/assets/Uploads/German-Files/pdf/Zuwendungsnachweis.pdf'>hier herunterladen</a>. Damit sparen Sie uns Arbeit und Porto, welches stattdessen unserer Projektarbeit zugute kommen kann. Für Beträge über 200 €, oder falls Sie dennoch eine Spendenbescheinigung wünschen, senden uns bitte eine E-Mail an <a href='mailto:treasurer@documentfoundation.org'>treasurer@documentfoundation.org</a>" %></p>
    </div>
<script type="text/javascript">
function showOneTimeForm() {
    jQuery("div.CompositeField:not(.hidden) select.donate_frequency").attr("name", "frequency_disabled");
    jQuery("div.CompositeField.hidden select.donate_frequency").attr("name", "frequency");
    jQuery("div.CompositeField:not(.hidden) input.donate_input").attr("id", "Form_DonationProceed_customValue_disabled");
    jQuery("div.CompositeField.hidden input.donate_input").attr("id", "Form_DonationProceed_customValue");
    jQuery("div.CompositeField:not(.hidden) select.donate_currency").attr("id", "Form_DonationProceed_currency_disabled");
    jQuery("div.CompositeField.hidden select.donate_currency").attr("id", "Form_DonationProceed_currency");
    jQuery("div.CompositeField:not(.hidden) input.donate_input").attr("name", "customValue_disabled");
    jQuery("div.CompositeField.hidden input.donate_input").attr("name", "customValue");
    jQuery("div.CompositeField:not(.hidden) select.donate_currency").attr("name", "currency_disabled");
    jQuery("div.CompositeField.hidden select.donate_currency").attr("name", "currency");
    jQuery("div.CompositeField:not(.hidden) input[type='hidden']").attr("name", "Amount_disabled");
    jQuery("div.CompositeField.hidden input[type='hidden']").attr("name", "Amount");
    jQuery(".toggle").toggleClass("hidden");
}
(function($) {
  $("#Form_DonationProceed_frequency").change(function() {
        switch($("#Form_DonationProceed_frequency").val()) {
            case "monthly": $("#Form_DonationProceed_customValue").val("4"); break;
            case "quarterly": $("#Form_DonationProceed_customValue").val("14"); break;
            case "yearly": $("#Form_DonationProceed_customValue").val("39"); break;
        }
    });

  $("#donateaccordion").accordion({
      collapsible: true,
      heightStyle: "content",
      active: false
  });
  $(".sidebaraccordion").accordion({
      collapsible: true,
      heightStyle: "content",
      active: false
  });
})(jQuery);
</script>
<% end_if %>
</div>
<div class="row margin-20">
<h3>or you may also want to donate your time</h3>
    <div style="border: 2px solid #babdb7; padding: 10px; text-align: center; margin-bottom: 1em; font-family:'Lato',sans-serif;">
        <div class="donate_intro_text">Please visit our dedicated site to learn <a href="https://whatcanidoforlibreoffice.org/">what you can do for LibreOffice</a>.<br/>You'll discover how much fun you may have with us!</div>
    </div>
</div>
</div>
    <div class="col-sm-4 margin-20">
        <%-- <div id="translations"><form name="translations"><p><strong>Available translations of this page:</strong>
                <select class="form-control" name="SelectURL" onchange="document.location.href=document.translations.SelectURL.options[document.translations.SelectURL.selectedIndex].value">
                    <option value="ru/">Русский</option>
                    <option value="he/">עברית</option>
                    <option value="fa/">فارسى</option>
                    <option value="ja/">日本語</option>
                    <option value="cs/">če&scaron;tina</option>
                    <option value="de/">Deutsch</option>
                    <option value="nl/">Nederlands</option>
                    <option value="tr/">T&uuml;rk&ccedil;e</option>
                    <option value="ca/">catal&agrave;</option>
                    <option value="es/">espa&ntilde;ol</option>
                    <option value="fr/">fran&ccedil;ais</option>
                    <option value="it/">italiano</option>
                    <option value="pl/">polski</option>
                    <option value="pt/">portugu&ecirc;s (Brasil)</option>
                    <option value="sl/">sloven&scaron;čina</option>
                    <option value="zh-TW/">中文 (正體)</option>
            </select></p></form>
        </div>
        --%>
<% if $UseButtons %><p><img style="display: block; margin-left: auto; margin-right: auto;" title="" src="https://www.libreoffice.org/assets/Uploads/PhotoShuffler/rmll3mecsFR.jpg" alt="" width="300"></p><% end_if %>
        $Customsidebar

        <% include SideBar %>
    </div>
    </div>
    </article>
</div>
</section>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script type="text/javascript">
var handler = StripeCheckout.configure({
  key: '$StripePubkey',
  image: 'https://www.libreoffice.org/themes/libreofficenew/img/lopaperclip.png',
  locale: 'auto',
  token: function(token) {
    jQuery("#Form_DonationProceed_email").val(token.email);
    jQuery('#Form_DonationProceed_action_stripe').val(token.id).click();
  }
});
var nodecimals = ['CLP', 'JPY', 'KRW', 'PYG'];    
function showstripeform() {
  <%-- setTimeout as workaround to focus-bug in firefox on Mac --%>
setTimeout(function() {
  handler.open({
    name: 'Donation',
    description: 'Donation to The Document Foundation',
    zipCode: true,
    panelLabel: "Donate {{amount}}",
    allowRememberMe: false,
    currency: jQuery("#Form_DonationProceed_currency").val(),
    amount: Math.floor(jQuery("#Form_DonationProceed_customValue").val()*(nodecimals.indexOf(jQuery("#Form_DonationProceed_currency").val()) > -1 ? 1 : 100))
  });
  }, 100);
}
// Close Checkout on page navigation:
window.addEventListener('popstate', function() {
  handler.close();
});
  var _paq = _paq || [];
  _paq.push(['setCustomDimension', 1, '<% if $UseButtons %>radiobuttons$OptionSlider$OptionSorting<% else %>dropdown<% end_if %>$ReverseLayout<% if $UseDonateBanner %>_banner<% end_if %>']);
  _paq.push(['setCustomDimension', 2, '$PreselectedAmount']);
</script>
