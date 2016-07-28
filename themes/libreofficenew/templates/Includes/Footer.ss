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
            <li><a class="btn btn-libre_office_green" href="https://twitter.com/tdforg" target="_blank"><i class="fa fa-twitter fa-2x"></i>@tdforg</a></li>
            <li><a class="btn btn-libre_office_green" href="https://twitter.com/libreoffice" target="_blank"><i class="fa fa-twitter fa-2x"></i>@libreoffice</a></li>
            <li><a class="btn btn-libre_office_green" href="https://www.facebook.com/libreoffice.org" target="_blank"><i class="fa fa-facebook fa-2x"></i></a></li>
            <li><a class="btn btn-libre_office_green" href="https://plus.google.com/+libreoffice/" target="_blank"><i class="fa fa-google-plus fa-2x"></i></a></li>
            <li><a class="btn btn-libre_office_green" href="//www.youtube.com/channel/UCQAClQkZEm2rkWvU5bvCAXQ" target="_blank"><i class="fa fa-youtube fa-2x"></i></a></li>
            <li><a class="btn btn-libre_office_green" href="https://twitter.com/AskLibreOffice" target="_blank"><i class="fa fa-twitter fa-2x"></i>@AskLibreOffice</a>
            <li><a class="btn btn-libre_office_green" href="https://twitter.com/LibreOfficeBugs" target="_blank"><i class="fa fa-twitter fa-2x"></i>@LibreOfficeBugs</a></li>
            <li><a class="btn btn-libre_office_green" href="https://twitter.com/LOcommits" target="_blank"><i class="fa fa-twitter fa-2x"></i>@LOcommits</a></li>
            <li><a class="btn btn-libre_office_green" href="http://www.reddit.com/r/libreoffice" target="_blank"><img src="$ThemeDir/img/reddit.png" width="36" alt="Reddit" /></a></li>
			</ul>
            <!-- end Social links-->     
          </div>
          </div>
          <!-- End Row -->
          </div>
          </section>
          <!-- end Section Social-->   
 
<%-- Twitter is blocked in China --%><% if SubsiteID != 8 %>
    <!--Twitter Feed-->
    <section id="bottom">
      <div class="container">
         <!-- Row -->
          <div class="row">
          <div class="col-sm-12 text-center">
          <h3><%t Social.LatestTweets "Latest Tweets" is "latest tweets headline" %></h3>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 text-center">
          <h5>@libreoffice</h5>
          </div>
             <div class="col-sm-6 text-center">
          <h5>@tdforg</h5>
          </div>
        </div>
        
        <div class="row">
    
        
          <div class="col-sm-6 text-center">
            <div class="latest-twitter"><%-- height on a is invalid, but needed by twitter widget... --%>
         <a class="twitter-timeline" href="https://twitter.com/libreoffice" height="250" data-link-color="#00A500" data-chrome="transparent"  data-border-color="#444" data-widget-id="423827266318000128">Tweets by @libreoffice</a>

</div>   
</div>
           <div class="col-sm-6 text-center">
            <div class="latest-twitter">
            <a class="twitter-timeline" href="https://twitter.com/tdforg" height="250" data-link-color="#00A500" data-chrome="transparent" data-border-color="#444" data-widget-id="423829327612887040">Tweets by @tdforg</a>
</div>   
</div>

         
        </div>
        </div>
        
</section><% end_if %>
<% end_if %>
    
    <!--Footer -->
    
    <section id="footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center">
            <p><a href="http://www.libreoffice.org/imprint" target="_blank">Impressum (Legal Info)</a> | <a href="http://www.libreoffice.org/privacy" target="_blank">Privacy Policy</a> | <a href="http://www.documentfoundation.org/statutes.pdf" target="_blank">Statutes (non-binding English translation)</a> - <a href="http://www.documentfoundation.org/satzung.pdf" target="_blank">Satzung (binding German version)</a> | Copyright information: Unless otherwise specified, all text and images on this website are licensed under the <a href="http://creativecommons.org/licenses/by-sa/3.0/" target="_blank">Creative Commons Attribution-Share Alike 3.0 License</a>. This does not include the source code of LibreOffice, which is licensed under the <a href="http://www.libreoffice.org/download/license/" target="_blank">Mozilla Public License v2.0</a>. “LibreOffice” and “The Document Foundation” are registered trademarks of their corresponding registered owners or are in actual use as trademarks in one or more countries. Their respective logos and icons are also subject to international copyright laws. Use thereof is explained in our <a href="http://wiki.documentfoundation.org/TradeMark_Policy" target="_blank">trademark policy</a>.</p>
          </div>
        </div>
      </div>
    </section>
<%-- Twitter is blocked in China --%><% if SubsiteID != 8 %>
   <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<% end_if %>
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
