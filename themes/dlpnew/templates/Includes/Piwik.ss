<!-- Start Piwik Code -->
<script type="text/javascript">
  var _paq = _paq || [];

  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);

  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://piwik.documentfoundation.org/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
    _paq.push(["setSiteId", "<% if $Subsite.PiwikID %>$Subsite.PiwikID<% else %>2<% end_if %>"]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();
</script><!-- let's see how many visitors have js disabled -->
<noscript><img src="https://piwik.documentfoundation.org/piwik.php?idsite=<% if $Subsite.PiwikID %>$Subsite.PiwikID<% else %>2<% end_if %>&amp;rec=1&action_name=nojs" style="border:0" alt="" /></noscript>
<!-- End Piwik Code -->
