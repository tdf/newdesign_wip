<% cached 'homepage', $SubsiteID, $ID, $LastEdited %>
<% include Slider %>
 <section id="highlights" class="section">
<% include Banner %>
      <div class="container">
         <div class="row text-center homepage">
        
          <div class="col-sm-12 margin-20">
         <h3>$HomepageTitleMain</h3>
         $HomepageFullwidthtext1
        </div>
          
          <!--Section 1-->
          <div class="col-sm-4 service margin-20">
            <a href="$HomepageIconLink1"><span class="fa-stack fa-lg fa-3x green">
  <i class="fa fa-circle fa-stack-2x"></i>
  <i class="fa fa-$HomepageIcon1 fa-stack-1x fa-inverse"></i></span>
            </a>

<h3>$HomepageTitle1</h3>
              <p>$HomepageText1.NoHTML</p>
<p><a href="$HomepageLink1" class="green bold">$HomepageCall1</a></p>
          </div>
          
          <!--Section 2-->
          <div class="col-sm-4 service margin-20">
              <a href="$HomepageIconLink2"><span class="fa-stack fa-lg fa-3x green">
  <i class="fa fa-circle fa-stack-2x"></i>
  <i class="fa fa-$HomepageIcon2 fa-stack-1x fa-inverse"></i></span>
            </a><h3>$HomepageTitle2</h3>
 <p>$HomepageText2.NoHTML</p>
<p><a href="$HomepageLink2" class="green bold">$HomepageCall2</a></p>
          

          </div>
          
          <!--Section 3-->
           <div class="col-sm-4 service margin-20">
                <a href="$HomepageIconLink3"><span class="fa-stack fa-lg fa-3x green">
  <i class="fa fa-circle fa-stack-2x"></i>
  <i class="fa fa-$HomepageIcon3 fa-stack-1x fa-inverse"></i></span>
            </a><h3>$HomepageTitle3</h3>
              <p>$HomepageText3.NoHTML</p>
<p><a href="$HomepageLink3" class="green bold">$HomepageCall3</a></p>
          </div>
          
        </div>
      </div>
    </section>
    
   
   
    <section id="quote" class="section">
      <div class="container">
        <div class="row">
          <div class="col-sm-3 margin-30">
            <img src="$ThemeDir/img/quote-img.png" alt=" ">
          </div>
          
          <div class="col-sm-9">
            <h2>$QuoteText</h2>
            <a href="$QuoteLink"><div class="quote-source pull-right">$QuoteCall</div></a>
          </div>
        </div>
      </div>
    </section>
    
    
    <!--Latest News-->
    <section id="latest-news" class="section">
      <div class="container">
      
        <div class="row margin-20">
            <div class="col-sm-6 text-center">
            <h3>$PrimaryFeed.RSSHeader</h3>
            <h5>$PrimaryFeed.ConnectionWord<a href="$PrimaryFeed.RSSLink" target="_blank">$PrimaryFeed.RSSTitle</a></h5>
          </div> <div class="col-sm-6 text-center">
            <h3>$SecondaryFeed.RSSHeader</h3>
            <h5>$SecondaryFeed.ConnectionWord<a href="$SecondaryFeed.RSSLink" target="_blank">$SecondaryFeed.RSSTitle</a></h5>
          </div>
        </div>
        
        <div class="row">
         <% cached "PrimaryFeed", $PrimaryFeed.ID, $ContentLocale %>$PrimaryFeed<% end_cached %>
         <% cached "SecondaryFeed", $SecondaryFeed.ID, $ContentLocale %>$SecondaryFeed<% end_cached %>
        </div>
        </div>
        </section>
<% end_cached %>
