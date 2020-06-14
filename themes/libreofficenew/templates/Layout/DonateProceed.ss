<section id="content1" class="section">
<div class="container">
<% if type == "paypal" %>
<p><% if $useNewDonate %>To process your <% if $data.frequency %>recurring ($data.frequency) <% end_if %>donation of <strong>$data.Amount $data.currency</strong>,  you are now forwarded to PayPal's website to complete the payment.<br/>If you are not forwarded automatically, please click the button named Continue below.<% else %><%t DonatePage.ProceedPayPal "To process your donation of <strong>{amount} {currency}</strong>, you are now forwarded to PayPal's website to complete the payment.<br/>If you are not forwarded automatically, please click the button named Continue below." is "paypal proceed message" amount=$data.Amount currency=$data.currency %><% end_if %>
<form id="autosubmit" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input name="charset" value="utf-8" type="hidden">
<input name="image_url" value="https://www.libreoffice.org/themes/libreofficenew/img/logo_color.png" type="hidden">
<input name="lc" value="$paypallang" type="hidden">
<input name="no_shipping" value="0" type="hidden">
<input name="return" value="https://www.documentfoundation.org" type="hidden">
<input name="cancel_return" value="https://www.documentfoundation.org" type="hidden">
<input name="currency_code" value="$data.currency" type="hidden">
<input name="business" value="donations@documentfoundation.org" type="hidden">
<% if $useNewDonate %>
<% if $data.frequency %>
<input name="cmd" value="_xclick-subscriptions" type="hidden">
<input name="src" value="1" type="hidden"><%-- active until manually cancelled --%>
<input name="a3" value="$data.Amount" type="hidden">
<% if $data.frequency == "monthly" %><input name="item_name" value="Monthly donation to The Document Foundation" type="hidden">
<input name="p3" value="1" type="hidden"><input name="t3" value="M" type="hidden">
<% else_if $data.frequency == "quarterly" %><input name="item_name" value="Quaterly donation to The Document Foundation" type="hidden">
<input name="p3" value="3" type="hidden"><input name="t3" value="M" type="hidden">
<% else %><%-- yearly, acts as a fallback as well --%><input name="item_name" value="Yearly donation to The Document Foundation" type="hidden">
<input name="p3" value="1" type="hidden"><input name="t3" value="Y" type="hidden">
<% end_if %>
<% else %><%-- oneshot --%>
<input name="item_name" value="Donation to The Document Foundation" type="hidden">
<input name="cmd" value="_donations" type="hidden">
<input name="amount" value="$data.Amount" type="hidden">
<% end_if %>
<% else %>
<input name="item_name" value="Donation to The Document Foundation" type="hidden">
<input name="cmd" value="_donations" type="hidden">
<input name="amount" value="$data.Amount" type="hidden">
<% end_if %>
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
<% else_if type = "stripe" %>
    <p><%t DonatePage.ProceedStripe "To process your <strong>{frequency}</strong> donation of <strong>{amount} {currency}</strong>, you are now forwarded to Stripe's website to complete the payment.<br/>If you are not forwarded automatically, please click the button named Continue below." is "stripe proceed message" frequency=$data.frequency amount=$data.customValue currency=$data.currency %></p>
    <input id="submit" name="donatebutton" type="submit" value="<%t DonatePage.ContinueLabel "Continue" is "donate proceed submit-button label" %>">
    <script src="https://js.stripe.com/v3/"></script>
<% end_if %>
</div>
</section>
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  // you can set up to 5 custom variables for each action (page view, download, click, site search)
  _paq.push(["setCustomVariable", 1, "dp", "$type<% if $useInvisibleCaptcha %>-invisible<% end_if %>", "page"]);
  _paq.push(["setCustomVariable", 2, "currency", "$data.currency", "page"]);
  _paq.push(["setCustomVariable", 3, "defaultAmount", "$data.defaultAmount", "page"]);
  _paq.push(["setCustomVariable", 4, "frequency", "$data.frequency", "page"]);
  _paq.push(["setCustomVariable", 5, "customAmount", "$data.Amount", "page"]);
  _paq.push(["disableCookies"]);
  _paq.push(["trackPageView"]);
<% if $useNewDonate %><% with data %><% if $currency = "USD" || $currency = "EUR" %>_paq.push(['trackGoal', $piwikGoal, $Amount]);<% else %>_paq.push(['trackGoal', 7, $Amount]);<% end_if %><% end_with %><% else %>_paq.push(['trackGoal', 8, $data.Amount]);<% end_if %>
  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://piwik.documentfoundation.org/";
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
    <% if type = "stripe" %><%-- stripe checkout newstyle https://stripe.com/docs/payments/checkout/api --%>
		<%-- session is created in backend, then that session just is used to trigger the display --%>
        var stripe = Stripe('$StripePubkey');
        window.setTimeout(function(){

            stripe.redirectToCheckout({
                sessionId: '$stripesessionid' ,
            }).then(function (result) {
                // Display result.error.message to your customer
            });
        }, 5000);
        document.getElementById('submit').addEventListener('click', function(e) {
            stripe.redirectToCheckout({
                sessionId: '$stripesessionid' ,
            }).then(function (result) {
                // Display result.error.message to your customer
            });
        });
	<% else %>
    window.setTimeout(function(){
        jQuery("#autosubmit").submit();
                                       }, 5000);
	<% end_if %>
  })();
</script>
<!-- End Piwik Code -->
