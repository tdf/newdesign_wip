<% require themedCSS('downloadframe') %>
<% uncached "download", $SubsiteID, $ID, $Lang, $Type, $Version %>
      <section id="content1" class="section">
      <div class="container">
<% if $Lang == 'pick' %>
<h3><%t Download.PickLanguage "Please select your language" is "pick your language heading" %></h3>
<table class="columns" border="0"><tbody><tr valign="top">
<% loop $LanguagePicklist %><td><ul class="languages">
<% loop $Chunk %><li><a href="$Top.Link?type=$Top.Type&amp;version=$Top.Version&amp;lang=$Lang">$Name</a> $NativeName</li><% end_loop %>
</ul></td><% end_loop %>
</tr></tbody></table>
<% else %>
	  <article>
 <% include BreadCrumbs %>
		<div class="row col-sm-8 margin-20">
            <% if $Subtitle %><p class="lead_libre">$Subtitle</p><% end_if %>
<!-- $Top.Version - $VersionFresh.Version -->
<% if $useNewStyle %><% if $Top.Version == $VersionFresh.Version || $Top.Version == $VersionStill.Version %>
<% if $useNewStyle %><!-- using newstyle --><% end_if %>
<% include DownloadRefresh %>
<% end_if %><% end_if %>
<!--  $VersionStill.Version $VersionFresh.Version $DebugInfo -->
<% if $Download %>
$MainInstallerText
<% with $Download %>
<% if $Top.useNewStyle && $Top.Version == $Top.VersionFresh.Version %><%-- nothing, skip the block --%>
<% else_if $Top.useNewStyle && $Top.Version == $Top.VersionStill.Version %><%-- nothing, skip as well --%>
<% else %>
<!-- regular download style $Top.useNewStyle -->
       <h3>$Top.Title</h3>
$MainInstallerText
<h2><%t Download.MainInstaller "Main Installer" is "heading for full/main installer" %></h2>
<p><%t Download.PlatformChange "Selected: LibreOffice {version} for {os} - <a href='{curr_page}#change'>change?</a>" is "change platform/os string" version=$Top.DisplayVersion os=$NicePlatform curr_page=$Top.fullLink %></p> 
<p><a class="btn-main" href="$Link($Top.Lang)" title="<%t Download.MainLinkTitle "Download LibreOffice {version} for {os}" is "link title for main download" version=$Version os=$NicePlatform %>"><%t Download.MainButtonLabel "Download Version {version}" is "button label for main download link" version=$Top.DisplayVersion %></a></p><p class="torrent thin">$Size.Nice (<a href="{$Link}.torrent" title="<%t Download.TorrentLinkTitle "Download using BitTorrent" is "link title for torrent link" %>"><%t Download.TorrentLinkText "Torrent" is "link text for Torrent download" %></a>, <a href="{$Link}.mirrorlist" title="<%t Download.InfoLinkTitle "Checksums and additional info" is "link title for info link" %>"><%t Download.InfoText "Info" is "link text for info" %></a>)</p>
<p>&nbsp;</p>
<% if $Langpack($Top.Lang) %><% with $Langpack($Top.Lang) %>
<h2><%t Download.Langpack "Get LibreOffice interface translated in <strong>{language}</strong>" is "langpack-dl heading" language=$NiceLang %></h2>
<p><a href='$Top.Link?type=$Top.Type&version=$Top.Version&lang=pick' title="<%t Download.ChangeLanguageLinkTitle "Pick another language" is "change the language link title" %>"><%t Download.ChangeLanguageLinkText "need another language?" is "change langauge link text" %></a><p>
$Top.TranslatedText
<p><a class="btn-other" href="http:$Link" title="<%t Download.LangpackLinkTitle "Download the Languagepack" %>"><%t Download.LangpackButtonLabel "Translated User Interface" %></a></p><p class="thin">$Size.Nice (<a href="{$Link}.torrent" title="<%t Download.TorrentLinkTitle "Download using BitTorrent" is "link title for torrent link" %>"><%t Download.TorrentLinkText "Torrent" is "link text for Torrent download" %></a>, <a href="{$Link}.mirrorlist" title="<%t Download.InfoLinkTitle "Checksums and additional info" is "link title for info link" %>"><%t Download.InfoText "Info" is "link text for info" %></a>)</p>
<p>&nbsp;</p>
<% end_with %><% end_if %>
<% if $Helppack($Top.Lang) %><% with $Helppack($Top.Lang) %>
<h2><%t Download.Helppack "LibreOffice Built in help in <strong>{language}</strong>" language=$NiceLang %></h2>
<p><a href='$Top.Link?type=$Top.Type&version=$Top.Version&lang=pick' title="<%t Download.ChangeLanguageLinkTitle "Pick another language" is "change the language link title" %>"><%t Download.ChangeLanguageLinkText "need another language?" is "change langauge link text" %></a><p>
$Top.BIHText
<p><a class="btn-other" href="http:$Link" title="<%t Download.HelppackLinkTitle "Download helpcontent for offline use" is "link title for helppack download" %>"><%t Download.HelppackButtonLabel "Help for offline use" is "link text for helppack download" %></a></p><p class="thin">$Size.Nice (<a href="{$Link}.torrent" title="<%t Download.TorrentLinkTitle "Download using BitTorrent" is "link title for torrent link" %>"><%t Download.TorrentLinkText "Torrent" is "link text for Torrent download" %></a>, <a href="{$Link}.mirrorlist" title="<%t Download.InfoLinkTitle "Checksums and additional info" is "link title for info link" %>"><%t Download.InfoText "Info" is "link text for info" %></a>)</p>
<% end_with %><% else_if $Helppack("en-US") %><% with $Helppack("en-US") %>
<h2><%t Download.HelppackFallback "LibreOffice Built in help <strong>English fallback</strong>" is "fallback to english help text" %></h2>
<p><a href='$Top.Link?type=$Top.Type&version=$Top.Version&lang=pick' title="<%t Download.ChangeLanguageLinkTitle "Pick another language" is "change the language link title" %>"><%t Download.ChangeLanguageLinkText "need another language?" is "change langauge link text" %></a><p>
$Top.BIHText
<p><a class="btn-other" href="http:$Link" title="<%t Download.HelppackLinkTitle "Download helpcontent for offline use" is "link title for helppack download" %>"><%t Download.HelppackButtonLabel "Help for offline use" is "link text for helppack download" %></a></p><p class="thin">$Size.Nice (<a href="{$Link}.torrent" title="<%t Download.TorrentLinkTitle "Download using BitTorrent" is "link title for torrent link" %>"><%t Download.TorrentLinkText "Torrent" is "link text for Torrent download" %></a>, <a href="{$Link}.mirrorlist" title="<%t Download.InfoLinkTitle "Checksums and additional info" is "link title for info link" %>"><%t Download.InfoText "Info" is "link text for info" %></a>)</p>
<% end_with %><% end_if %>
<% end_if %><%-- id != 20 --%>
<h3><%t Download.SDKandSource "SDK and source code (for developers)" is "main heading text for SDK and Source section" %></h3>
<% if $SDK %><% with $SDK %>
<h4><%t Download.SDKDownload "Download the SDK" is "header for SDK download section" %></h4>
<p><a href="$Link($Top.Lang)">$Filename</a><br/><span class="thin">$Size.Nice (<a href="{$Link}.torrent" title="<%t Download.TorrentLinkTitle "Download using BitTorrent" is "link title for torrent link" %>"><%t Download.TorrentLinkText "Torrent" is "link text for Torrent download" %></a>, <a href="{$Link}.mirrorlist" title="<%t Download.InfoLinkTitle "Checksums and additional info" is "link title for info link" %>"><%t Download.InfoText "Info" is "link text for info" %></a>)</span></p>
<% end_with %><% end_if %>
<% if $Sources %><h4><%t Download.SourceDownload "Download the Sourcecode" is "header for Source download section" %></h4><ul><% loop $Sources %>
    <li><a href="$Link($Top.Lang)?idx=$Pos">$Filename</a><br/><span class="thin">$Size.Nice (<a href="{$Link}.torrent" title="<%t Download.TorrentLinkTitle "Download using BitTorrent" is "link title for torrent link" %>"><%t Download.TorrentLinkText "Torrent" is "link text for Torrent download" %></a>, <a href="{$Link}.mirrorlist" title="<%t Download.InfoLinkTitle "Checksums and additional info" is "link title for info link" %>"><%t Download.InfoText "Info" is "link text for info" %></a>)</span></li>
<% end_loop %></ul><% end_if %>
<% end_with %>
<p id="change" class="lead_libre"><%t Download.OS "Operating Systems" %></p>
<p><%t Download.OSList "LibreOffice {version} is available for the following operating systems/architectures:" version=$Version %></p>
<ul class="fa-ul"><% loop PlatformsList %><li><a href='$Top.Link?type=$Type&version=$Top.Version&lang=$Top.Lang'><i class="fa-li fa fa-check-square"></i>$NicePlatform</a></li><% end_loop %></ul>
<% else %>
<div class="bs-callout bs-callout-danger"><h4>No download is available for the requested version $Version.</h4><p><strong>Please pick one of the available verions below.</strong><br/>
<small>You can find obsolete versions in our <a href="https://downloadarchive.documentfoundation.org/libreoffice/old/" target="_blank">downloadarchive</a></small></p></div>
<% end_if %>
<p class="lead_libre"><%t Download.Versions "Available Versions" %></p>
<p><%t Download.VersionListReleased "LibreOffice is available in the following <strong>released</strong> versions:" %><br/><ul class="fa-ul"><% loop $VersionsList() %><li><a href='$Top.Link?type=$Top.Type&version=$Version&lang=$Top.Lang'><i class="fa-li fa fa-check-square-o"></i>$Version</a></li><% end_loop %></ul></p>
<% if $VersionsList("testing") %>
<p class="dark-gray"><%t Download.VersionListTesting "LibreOffice is available in the following <strong>prerelease</strong> versions:" %><br/><ul class="fa-ul"><% loop $VersionsList("testing") %><% if $Version %><li><a href='$Top.Link?type=$Top.Type&version=$Version&lang=$Top.Lang' class='dark-gray'><i class="fa-li fa fa-square-o dark-gray"></i>$Version</a></li><% end_if %><% end_loop %></ul></p>
<% end_if %>
<p class="dark-gray"><%t Download.Archive "Older versions of LibreOffice (no longer updated!) are available <a href='https://downloadarchive.documentfoundation.org/libreoffice/old/'>in the archive</a>" %></p>

$Content
		</div>
             
<div class="col-sm-4 margin-20">
<% if $TranslatedNotes %>$TranslatedNotes<% else %>
<%-- <a class="btn2 btn-libre_office_green" href="https://www.libreoffice.org/download/android-viewer/"><i class="fa fa-android fa-2x"></i>&nbsp;LibreOffice for Android</a> --%>
 <a class="btn2 btn-libre_office_green" href="http://documentation.libreoffice.org"><i class="fa fa-book fa-2x"></i>&nbsp;Documentation</a>
 <a class="btn2 btn-libre_office_green" href="https://www.libreoffice.org/get-help/feedback/"><i class="fa fa-envelope fa-2x"></i>&nbsp;Provide feedback</a>
 <a class="btn2 btn-libre_office_green" href="https://www.libreoffice.org/community/get-involved/"><i class="fa fa-heart fa-2x"></i>&nbsp;Join The Project!</a>
 <a class="btn2 btn-libre_office_green" href="https://www.libreoffice.org/events/"><i class="fa fa-users fa-2x"></i>&nbsp;Meet us at events</a>
 <a class="btn2 btn-libre_office_green" href="https://www.libreoffice.org/discover/libreoffice/"><i class="fa fa-plus fa-2x"></i>&nbsp;Discover LibreOffice</a>
 <a class="btn2 btn-libre_office_green" href="https://www.libreoffice.org/discover/templates-and-extensions/"><i class="fa fa-smile-o fa-2x"></i>&nbsp;Good looking documents</a>
<% end_if %>
</div>
			<div class="col-sm-4 margin-20">
$Customsidebar

      <% if not $useNewStyle %><% include SideBar %><% end_if %>
</div>
          
          </article>
<% end_if %>
        </div>
        </section>
<% end_cached %>
