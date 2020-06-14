<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="$ContentLocale"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="$ContentLocale"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="$ContentLocale"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="$ContentLocale"> <!--<![endif]-->
    <head>
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
        <title><% if MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> | $SiteConfig.Title<% if SiteConfig.Tagline %> - $SiteConfig.Tagline<% end_if %></title>
        $MetaTags(false)
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='//fonts.googleapis.com/css?family=Lato:100,300,400,700,900,300italic,400italic' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="//www.libreoffice.org/$ThemeDir/favicon.ico" />

       <link rel="stylesheet" type="text/css" href="//www.libreoffice.org/themes/libreofficenew/css/bootstrap.min.css"/>
       <link rel="stylesheet" type="text/css" href="//www.libreoffice.org/themes/libreofficenew/css/main.css"/>
       <link rel="stylesheet" type="text/css" href="//www.libreoffice.org/themes/libreofficenew/css/font-awesome.min.css"/>
       <link rel="stylesheet" type="text/css" href="//www.libreoffice.org/themes/libreofficenew/css/flexslider.css"/>
   <script src="//www.libreoffice.org/$ThemeDir/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body class="$ClassName<% if not $Menu(2) %> no-sidebar<% end_if %>" id="$URLSegment">
        <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> or <a href="https://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand img-responsive" href="$Page(/).Link"><img src="//www.libreoffice.org/$ThemeDir/img/logo.png" alt="logo"></a>
        </div>
        <% if not $HideNavigation %><div class="navbar-collapse collapse">
           <ul class="nav navbar-nav navbar-right">
<% loop $Menu(1) %>
<li>
<% if $Children %>
<a href="$Link" class="$LinkingMode dropdown-toggle" data-toggle="dropdown">$MenuTitle<% if $Children %><b class="caret"></b><% end_if %></a>
<ul class="dropdown-menu"><% loop $Children %><li><a href="$Link" class="$LinkingMode">$MenuTitle</a></li><% end_loop %></ul>
<% else %>
<a href="$Link" class="$LinkingMode">$MenuTitle</a>
<% end_if %>
</li>
<% end_loop %></ul> 
        </div><% end_if %>
      </div>
      </div>
		 
           $Layout
	
    <!--Footer -->
    
    <section id="footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center">
            <p><a href="https://www.libreoffice.org/imprint" target="_blank">Impressum (Legal Info)</a> | <a href="https://www.libreoffice.org/privacy" target="_blank">Privacy Policy</a> | <a href="https://www.documentfoundation.org/statutes.pdf" target="_blank">Statutes (non-binding English translation)</a> - <a href="https://www.documentfoundation.org/satzung.pdf" target="_blank">Satzung (binding German version)</a> | Copyright information: Unless otherwise specified, all text and images on this website are licensed under the <a href="https://creativecommons.org/licenses/by-sa/3.0/" target="_blank">Creative Commons Attribution-Share Alike 3.0 License</a>. This does not include the source code of LibreOffice, which is licensed under the GNU <a href="https://www.libreoffice.org/download/license/" target="_blank">Lesser General Public License (LGPLv3)</a>. “LibreOffice” and “The Document Foundation” are registered trademarks of their corresponding registered owners or are in actual use as trademarks in one or more countries. Their respective logos and icons are also subject to international copyright laws. Use thereof is explained in our <a href="https://wiki.documentfoundation.org/TradeMark_Policy" target="_blank">trademark policy</a>.</p>
          </div>
        </div>
      </div>
    </section>
<script type="text/javascript" src="//www.libreoffice.org/themes/libreofficenew/js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="//www.libreoffice.org/themes/libreofficenew/js/bootstrap.min.js"></script>
    </body>
</html>
