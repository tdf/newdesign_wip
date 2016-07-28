<!DOCTYPE html>
    <% require javascript("themes/libreofficenew/js/jquery-1.10.1.min.js") %>
    <% require javascript("themes/libreofficenew/js/bootstrap.min.js") %>
    <% require javascript("themes/libreofficenew/js/jquery.flexslider.js") %>
    <% require javascript("themes/libreofficenew/js/jquery.tablesorter.min.js") %>
    <%-- require javascript("themes/libreofficenew/js/main.js") --%>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="$ContentLocale"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="$ContentLocale"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="$ContentLocale"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="$ContentLocale"> <!--<![endif]-->
    <head>
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
        <title><% if MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> | $SiteConfig.Title<% if SiteConfig.Tagline %> - $SiteConfig.Tagline<% end_if %></title>
        $MetaTags(false)
        $Subsite.GoogleSiteVerification
        <% base_tag %>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<%-- google is blocked in China --%><% if SubsiteID != 8 %>
        <link href='//fonts.googleapis.com/css?family=Lato:100,300,400,700,900,300italic,400italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'><% else %><% require themedCSS('Lato2') %><% end_if %>
        <link rel="shortcut icon" href="/$ThemeDir/favicon.ico" />

        <% require themedCSS('bootstrap.min') %>
        <% require themedCSS('responsive') %>
        <% require themedCSS('main') %>
        <% require themedCSS('font-awesome.min') %>
        <% require themedCSS('flexslider') %>
        <%-- require themedCSS('Lato2') --%>
   <script src="$ThemeDir/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<% if ClassName = "DonatePage" %><script src="https://www.google.com/recaptcha/api.js" async defer></script><% end_if %>
    </head>
    <body class="$ClassName<% if not $Menu(2) %> no-sidebar<% end_if %>" id="$URLSegment">
        <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <% include Navigation %>
		 
           $Layout
	
            <% include Footer %>

<script type="text/javascript">
      !function ($) {
        $(function(){
          $('#header').carousel()
        })
      }(window.jQuery)
    
$(window).load(function() {

  $('.flexslider').flexslider({
    animation: "slide"
  });
});
$(document).ready(function()
  {
     $('.tablesorter').each(function() {
       $(this).tablesorter();
     });
  }
);
</script>

    </body>
</html>
