<%-- Disable social buttons for de --%><% if SubsiteID != 20 %>
 <!-- Section Social-->   
 <section id="social">
      <div class="container">
      
      <!-- Row -->
      <div class="row">
          <div class="col-sm-12 text-center dark-gray">
          
        <div class="margin-20">
        <h3><%t Social.FollowUs "Follow Us" is "Follow Us headline" %></h3>
        </div>
 <!--Social links-->
            <ul class="social-icons">
            <li><a class="btn btn-libre_office_green" href="https://blog.documentfoundation.org" target="_blank"><i class="fa fa-comment fa-2x"></i> Our blog</a></li>
            <li><a class="btn btn-libre_office_green" href="https://twitter.com/tdforg" target="_blank"><i class="fa fa-twitter fa-2x"></i>@tdforg</a></li>
            <li><a class="btn btn-libre_office_green" href="https://twitter.com/libreoffice" target="_blank"><i class="fa fa-twitter fa-2x"></i>@libreoffice</a></li>
            <li><a class="btn btn-libre_office_green" href="https://www.facebook.com/libreoffice.org" target="_blank"><i class="fa fa-facebook fa-2x"></i></a></li>
            <li><a class="btn btn-libre_office_green" href="https://fosstodon.org/@libreoffice" target="_blank"><i class="fa fa-comments fa-2x"></i> Mastodon</a></li>
            <li><a class="btn btn-libre_office_green" href="//www.youtube.com/channel/UCQAClQkZEm2rkWvU5bvCAXQ" target="_blank"><i class="fa fa-youtube-play fa-2x"></i></a></li>
            <li><a class="btn btn-libre_office_green" href="https://twitter.com/AskLibreOffice" target="_blank"><i class="fa fa-twitter fa-2x"></i>@AskLibreOffice</a>
            <li><a class="btn btn-libre_office_green" href="https://twitter.com/LibreOfficeBugs" target="_blank"><i class="fa fa-twitter fa-2x"></i>@LibreOfficeBugs</a></li>
            <%-- <li><a class="btn btn-libre_office_green" href="https://twitter.com/LOcommits" target="_blank"><i class="fa fa-twitter fa-2x"></i>@LOcommits</a></li> --%>
            <li><a class="btn btn-libre_office_green" href="https://www.reddit.com/r/libreoffice" target="_blank"><img src="$ThemeDir/img/reddit.png" width="36" alt="Reddit" /></a></li>
			</ul>
            <!-- end Social links-->
            <!-- Mastodon verification: -->
            <a rel="me" href="https://fosstodon.org/@libreoffice">Mastodon</a>
          </div>
          </div>
          <!-- End Row -->
          </div>
          </section>
          <!-- end Section Social-->   
 
<%-- Twitter is blocked in China --%><% if SubsiteID != 8 && Classname != "DonatePage" %>
    <!--Twitter Feed-->
    <section id="bottom">
      <div class="container">
         <!-- Row -->
          <div class="row">
          <div class="col-sm-12 text-center">
          <h3><%t Social.LatestTweets "Latest Tweets" is "latest tweets headline" %></h3>
          </div>
        </div>
<% with $SiteConfig %>
        <div class="row">
          <div class="col-sm-6 text-center">
          <h5>@<% if $TwitterLeftHandle %>$TwitterLeftHandle<% else %>libreoffice<% end_if %></h5>
          </div>
             <div class="col-sm-6 text-center">
          <h5>@<% if $TwitterRightHandle %>$TwitterRightHandle<% else %>tdforg<% end_if %></h5>
          </div>
        </div>

        <div class="row">


          <div class="col-sm-6 text-center">
            <div class="latest-twitter"><%-- height on a is invalid, but needed by twitter widget... --%>
         <a class="twitter-timeline" href="https://twitter.com/<% if $TwitterLeftHandle %>$TwitterLeftHandle<% else %>libreoffice<% end_if %>" height="250" data-link-color="#00A500" data-chrome="transparent"  data-border-color="#444" data-widget-id="<% if $TwitterLeftWID %>$TwitterLeftWID<% else %>423827266318000128<% end_if %>">Tweets by @<% if $TwitterLeftHandle %>$TwitterLeftHandle<% else %>libreoffice<% end_if %></a>

</div>
</div>
           <div class="col-sm-6 text-center">
            <div class="latest-twitter">
            <a class="twitter-timeline" href="https://twitter.com/<% if $TwitterRightHandle %>$TwitterRightHandle<% else %>tdforg<% end_if %>" height="250" data-link-color="#00A500" data-chrome="transparent" data-border-color="#444" data-widget-id="<% if $TwitterRightWID %>$TwitterRightWID<% else %>423829327612887040<% end_if %>">Tweets by @<% if $TwitterRightHandle %>$TwitterRightHandle<% else %>tdforg<% end_if %></a>
</div>
</div>

        </div>
<% end_with %>
        </div>
        
</section><% end_if %>
<% end_if %>
    
    <!--Footer -->
    
    <section id="footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center">
            <p><a href="https://www.libreoffice.org/imprint" target="_blank">Impressum (<%t Footer.Imprint "Legal Info" %>)</a> | <a href="https://www.libreoffice.org/privacy" target="_blank">Datenschutzerklärung (<%t Footer.PrivacyPolicy "Privacy Policy" %>)</a> | <a href="https://www.documentfoundation.org/statutes.pdf" target="_blank">Statutes (non-binding English translation)</a> - <a href="https://www.documentfoundation.org/satzung.pdf" target="_blank">Satzung (binding German version)</a> | Copyright information: Unless otherwise specified, all text and images on this website are licensed under the <a href="https://creativecommons.org/licenses/by-sa/3.0/" target="_blank">Creative Commons Attribution-Share Alike 3.0 License</a>. This does not include the source code of LibreOffice, which is licensed under the <a href="https://www.libreoffice.org/download/license/" target="_blank">Mozilla Public License v2.0</a>. “LibreOffice” and “The Document Foundation” are registered trademarks of their corresponding registered owners or are in actual use as trademarks in one or more countries. Their respective logos and icons are also subject to international copyright laws. Use thereof is explained in our <a href="https://wiki.documentfoundation.org/TradeMark_Policy" target="_blank">trademark policy</a>. LibreOffice was based on OpenOffice.org.</p>
          </div>
        </div>
      </div>
    </section>
<%-- Twitter is blocked in China --%><% if SubsiteID != 8  && Classname != "DonatePage" %>
   <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<% end_if %>
<!-- Start Piwik Code -->
<script type="text/javascript">
  var _paq = _paq || [];

  _paq.push(["disableCookies"]);
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);

  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://piwik.documentfoundation.org/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
    _paq.push(["setSiteId", "<% if $Subsite.PiwikID %>$Subsite.PiwikID<% else %>2<% end_if %>"]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
    <%-- shuffle elements around --%>
    <%--  Collect swap-able nodes --%>
    var classes = [".swap", ".swap-developer", ".swap-migration", ".swap-training"];
    for (var classIndex = 0; classIndex < classes.length; classIndex++) {
        var swapable = document.querySelectorAll(classes[classIndex]);
        var random = [];
        for (var i = 0;i < swapable.length; i++) {
            swapable[i].setAttribute('sortKey', Math.random());
            random[i] = swapable[i].cloneNode(true);
        }
        random.sort(function(a,b) { return a.getAttribute('sortKey') - b.getAttribute('sortKey'); });
        <%-- replace with sorted nodes ... --%>
        for (var i = 0;i < swapable.length; i++) {
            swapable[i].parentNode.replaceChild(random[i], swapable[i]);
        }
    }
    var ul = document.querySelector('ul.shuffle');
    for (var i = ul.children.length; i >= 0; i--) {
             ul.appendChild(ul.children[Math.random() * i | 0]);
             }
  })();
</script><!-- let's see how many visitors have js disabled -->
<noscript><img src="https://piwik.documentfoundation.org/piwik.php?idsite=<% if $Subsite.PiwikID %>$Subsite.PiwikID<% else %>2<% end_if %>&amp;rec=1&action_name=nojs" style="border:0" alt="" /></noscript>
<!-- End Piwik Code -->
