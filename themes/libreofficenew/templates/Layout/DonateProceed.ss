<section id="content1" class="section">
<div class="container">
<% if type == "paypal" %>
<p><%t DonatePage.ProceedPayPal "To process your donation of <strong>{amount} {currency}</strong>, you are now forwarded to PayPal's website to complete the payment.<br/>If you are not forwarded automatically, please click the button named Continue below." is "paypal proceed message" amount=$data.Amount currency=$data.currency %>
<form id="autosubmit" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input name="lc" value="$paypallang" type="hidden">
<input name="cmd" value="_donations" type="hidden">
<input name="business" value="treasurer@documentfoundation.org" type="hidden">
<input name="return" value="http://www.documentfoundation.org" type="hidden">
<input name="undefined_quantity" value="0" type="hidden">
<input name="item_name" value="Donation to The Document Foundation" type="hidden">
<input name="amount" size="4" maxlength="10" value="$data.Amount" style="text-align: right;" type="hidden">
<input name="currency_code" value="$data.currency" type="hidden">
<input name="charset" value="utf-8" type="hidden">
<input name="no_shipping" value="1" type="hidden">
<input name="image_url" value="https://www.libreoffice.org/themes/libo/images/logo.png" type="hidden">
<input name="cancel_return" value="http://www.documentfoundation.org" type="hidden">
<input name="no_note" value="1" type="hidden">
<input src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" name="donatebutton" value="<%t DonatePage.ContinueLabel "Continue" is "donate proceed submit-button label" %>" alt="PayPal secure payments." type="submit">
</form>
</p>
<% else_if type = "concardis" %>
<% with data %>
<p><%t DonatePage.ProceedConcardis "To process your donation of <strong>{amount} {currency}</strong>, you are now forwarded to ConCardis' website to complete the payment.<br/>If you are not forwarded automatically, please click the button named Continue below." is "concardis proceed message" amount=$Amount currency=$currency %>
<form id="autosubmit" name="donateform" method="post" action="https://secure.payengine.de/ncol/$typ/orderstandard.asp">
<input type="hidden" name="accepturl" value="$accepturl">
<input type="hidden" name="amount" value="$centamount">
<input type="hidden" name="cancelurl" value="$cancelurl">
<%-- input type="hidden" name="catalogurl" value="$catalogurl" --%>
<input type="hidden" name="com" value="$com">
<input type="hidden" name="complus" value="$language">
<input type="hidden" name="currency" value="$currency">
<input type="hidden" name="declineurl" value="$declineurl">
<input type="hidden" name="email" value="$email">
<input type="hidden" name="exceptionurl" value="$exceptionurl">
<input type="hidden" name="homeurl" value="$homeurl">
<input type="hidden" name="language" value="$language">
<input type="hidden" name="operation" value="$operation">
<input type="hidden" name="orderid" value="$orderid">
<input type="hidden" name="pmlisttype" value="$pmlisttype">
<input type="hidden" name="pspid" value="$pspid">
<input type="hidden" name="shasign" value="$sign">
<input type="hidden" name="tp" value="$tp">
<input type="hidden" name="win3ds" value="$win3ds">
<input name="donatebutton" type="submit" value="<%t DonatePage.ContinueLabel "Continue" is "donate proceed submit-button label" %>">
</form>
<% end_with %>
<% end_if %>
</div>
</section>
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  // you can set up to 5 custom variables for each action (page view, download, click, site search)
  _paq.push(["setCustomVariable", 1, "dp", "$type", "page"]);
  _paq.push(["setCustomVariable", 2, "currency", "$data.currency", "page"]);
  _paq.push(["setCustomVariable", 3, "amount", "$data.Amount", "page"]);
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);
<% with data %><% if currency = "USD" %>_paq.push(['trackGoal', 1, $Amount]);<% else_if currency = "EUR" %>_paq.push(['trackGoal', 1, $Amount]);<% else %>_paq.push(['trackGoal', 1]);<% end_if %><% end_with %>
  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://piwik.documentfoundation.org/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
    _paq.push(["setSiteId", "54"]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->

