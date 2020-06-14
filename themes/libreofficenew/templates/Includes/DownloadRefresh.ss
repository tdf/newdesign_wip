<div class="dl_outer_green_box">
<img style="float:right; margin-top:5px;" alt="Download icon" src="https://www.libreoffice.org/assets/Uploads/download-block-icon-large.png" width="42" height="42" />
<span class="dl_outer_green_box_header_text"><%t DownloadRefresh.BoxHeader "Download LibreOffice" %></span>
<% with $VersionFresh %>
<div class="dl_inner_white_box">
  <div class="dl_grey_floating_box">
    <span class="dl_choose_your_os_text"><%t DownloadRefresh.ChooseOS "Choose your operating system:" %></span>
    <select style="font-size:14px;" name="os" onchange="location = this.value;"><% loop $Top.PlatformsList($Version) %>
        <option value="$Top.Link?type=$Type&version=$Top.VersionFresh.Version&lang=$Top.Lang"<% if $Top.Type == $Type %> selected<% end_if %>>$NicePlatformShort</option><% end_loop %>
    </select>
<noscript><small><% loop $Top.PlatformsList($Version) %>
        <% if $Top.Type == $Type %><strong><% else %><a href="$Top.Link?type=$Type&version=$Top.VersionFresh.Version&lang=$Top.Lang"><% end_if %>$NicePlatformShort<% if $Top.Type == $Type %></strong><% else %></a><% end_if %><br/><% end_loop %></small></noscript>
<% if $Top.Type == "rpm-x86" || $Top.Type == "deb-x86" %></div><!-- no 32bit anymore for 6.3 --><p>The Document Foundation doesn't provide 32bit binaries for Linux for 6.3.0 anymore.<br/>Please pick a 64bit variant from the dropdown if your system supports it or get LibreOffice from your Linux distribution's repositories instead.</p><% else %>
<% with $Up.getMainDownloads($Version, $Top.Type).Filter('Type', 'stable').First %>
    <a class="dl_download_link" href="$Link($Top.Lang)"><span class="dl_yellow_download_button"><strong><%t DownloadRefresh.DownloadLinkText "DOWNLOAD" %></strong></span></a>
<a href="{$Link}.torrent" title="<%t DownloadRefresh.TorrentLinkTitle "Download using BitTorrent" %>"><%t DownloadRefresh.TorrentLinkText "Torrent" %></a>, <a href="{$Link}.mirrorlist" title="<%t DownloadRefresh.InfoLinkTitle "Checksums and additional info" %>"><%t DownloadRefresh.InfoText "Info" %></a>
  </div>

  <img style="margin-bottom:-1px;" alt="LibreOffice logo" src="https://www.libreoffice.org/assets/Uploads/download-block-logo-large.png" width="265" height="52" /><span class="dl_version_number">$Version</span><br />
  <span class="dl_description_text">$Top.FreshText</span>
  <span class="dl_release_notes_link_text"><a href="https://wiki.documentfoundation.org/ReleaseNotes/$Version.LimitCharacters(3,'')"><%t DownloadRefresh.RelnotesLinkText "LibreOffice {version} release notes" version=$Version %></a></span>
<p><%t DownloadRefresh.SupplementaryDownloads "Supplementary Downloads:" %></p>
<ul>
<% if $Langpack($Top.Lang) %><% with $Langpack($Top.Lang) %>
$Top.TranslatedText
<li><a href="http:$Link" title="<%t DownloadRefresh.LangpackLinkTitle "Download the Languagepack" %>"><%t DownloadRefresh.LangpackLinkText "Translated User Interface" %>: <strong>$NiceLang</strong></a> <span class="thin">(<a href="{$Link}.torrent" title="<%t DownloadRefresh.TorrentLinkTitle "Download using BitTorrent" %>"><%t DownloadRefresh.TorrentLinkText "Torrent" %></a>, <a href="{$Link}.mirrorlist" title="<%t DownloadRefresh.InfoLinkTitle "Checksums and additional info" %>"><%t DownloadRefresh.InfoText "Info" %></a>)</span></li>
<% end_with %><% end_if %>
<% if $Helppack($Top.Lang) %><% with $Helppack($Top.Lang) %>
<li><a href="http:$Link" title="<%t DownloadRefresh.HelppackLinkTitle "Download helpcontent for offline use" %>"><%t DownloadRefresh.HelppackButtonLabel "Help for offline use" %>: <strong>$NiceLang</strong></a> <span class="thin">(<a href="{$Link}.torrent" title="<%t DownloadRefresh.TorrentLinkTitle "Download using BitTorrent" %>"><%t DownloadRefresh.TorrentLinkText "Torrent" %></a>, <a href="{$Link}.mirrorlist" title="<%t DownloadRefresh.InfoLinkTitle "Checksums and additional info" %>"><%t DownloadRefresh.InfoText "Info" %></a>)</span></li>
<% end_with %><% else_if $Helppack("en-US") %><% with $Helppack("en-US") %>
<li><a href="http:$Link" title="<%t DownloadRefresh.HelppackLinkTitle "Download helpcontent for offline use" %>"><%t DownloadRefresh.HelppackButtonLabel "Help for offline use" %>: (English fallback)</a> <span class="thin">(<a href="{$Link}.torrent" title="<%t DownloadRefresh.TorrentLinkTitle "Download using BitTorrent" %>"><%t DownloadRefresh.TorrentLinkText "Torrent" %></a>, <a href="{$Link}.mirrorlist" title="<%t DownloadRefresh.InfoLinkTitle "Checksums and additional info" %>"><%t DownloadRefresh.InfoText "Info" %></a>)</span></li>
<% end_with %><% end_if %>
<% if $Platform == "win" || $Platform == "mac" %><li><a href="<% if $Platform == "win" %>https://www.gpg4win.org/<% else %>https://gpgtools.org/<% end_if %>" target="_blank">Key management software</a> for the new OpenPGP feature (external site)</li><% end_if %>
</ul>
<p><a href='$Top.Link?type=$Top.Type&version=$Version&lang=pick' title="<%t DownloadRefresh.ChangeLanguageLinkTitle "Pick another language" %>"><%t DownloadRefresh.ChangeLanguageLinkText "need another language?" %></a><p>
<% end_with %>
<% end_if %><%-- no 32bit anymore --%>
</div>
<% end_with %>
<% with $VersionStill %><% if $Version %>
<div class="dl_inner_white_box">
  <div class="dl_grey_floating_box">
    <span class="dl_choose_your_os_text"><%t DownloadRefresh.ChooseOS "Choose your operating system:" %></span>
    <select style="font-size:14px;" name="os" onchange="location = this.value;"><% loop $Top.PlatformsList($Version) %>
        <option value="$Top.Link?type=$Type&version=$Top.VersionStill.Version&lang=$Top.Lang"<% if $Top.Type == $Type %> selected<% end_if %>>$NicePlatformShort</option><% end_loop %>
    </select>
<noscript><small><% loop $Top.PlatformsList($Version) %>
        <% if $Top.Type == $Type %><strong><% else %><a href="$Top.Link?type=$Type&version=$Top.VersionFresh.Version&lang=$Top.Lang"><% end_if %>$NicePlatformShort<% if $Top.Type == $Type %></strong><% else %></a><% end_if %><br/><% end_loop %></small></noscript>
<% with $Up.getMainDownloads($Version, $Top.Type).Filter('Type', 'stable').First %>
    <a class="dl_download_link" href="$Link($Top.Lang)"><span class="dl_yellow_download_button"><strong><%t DownloadRefresh.DownloadLinkText "DOWNLOAD" %></strong></span></a>
<a href="{$Link}.torrent" title="<%t DownloadRefresh.TorrentLinkTitle "Download using BitTorrent" %>"><%t DownloadRefresh.TorrentLinkText "Torrent" %></a>, <a href="{$Link}.mirrorlist" title="<%t DownloadRefresh.InfoLinkTitle "Checksums and additional info" %>"><%t DownloadRefresh.InfoText "Info" %></a>
  </div>

  <img style="margin-bottom:-1px;" alt="LibreOffice logo" src="https://www.libreoffice.org/assets/Uploads/download-block-logo-large.png" width="265" height="52" /><span class="dl_version_number">$Version</span><br />
  <span class="dl_description_text">$Top.StillText</span>
  <span class="dl_release_notes_link_text"><a href="https://wiki.documentfoundation.org/ReleaseNotes/$Version.LimitCharacters(3,'')"><%t DownloadRefresh.RelnotesLinkText "LibreOffice {version} release notes" version=$Version %></a></span>
<p><%t DownloadRefresh.SupplementaryDownloads "Supplementary Downloads:" %></p>
<ul>
<% if $Langpack($Top.Lang) %><% with $Langpack($Top.Lang) %>
$Top.TranslatedText
<li><a href="http:$Link" title="<%t DownloadRefresh.LangpackLinkTitle "Download the Languagepack" %>"><%t DownloadRefresh.LangpackLinkText "Translated User Interface" %>: <strong>$NiceLang</strong></a> <span class="thin">(<a href="{$Link}.torrent" title="<%t DownloadRefresh.TorrentLinkTitle "Download using BitTorrent" %>"><%t DownloadRefresh.TorrentLinkText "Torrent" %></a>, <a href="{$Link}.mirrorlist" title="<%t DownloadRefresh.InfoLinkTitle "Checksums and additional info" %>"><%t DownloadRefresh.InfoText "Info" %></a>)</span></li>
<% end_with %><% end_if %>
<% if $Helppack($Top.Lang) %><% with $Helppack($Top.Lang) %>
<li><a href="http:$Link" title="<%t DownloadRefresh.HelppackLinkTitle "Download helpcontent for offline use" %>"><%t DownloadRefresh.HelppackButtonLabel "Help for offline use" %>: <strong>$NiceLang</strong></a> <span class="thin">(<a href="{$Link}.torrent" title="<%t DownloadRefresh.TorrentLinkTitle "Download using BitTorrent" %>"><%t DownloadRefresh.TorrentLinkText "Torrent" %></a>, <a href="{$Link}.mirrorlist" title="<%t DownloadRefresh.InfoLinkTitle "Checksums and additional info" %>"><%t DownloadRefresh.InfoText "Info" %></a>)</span></li>
<% end_with %><% else_if $Helppack("en-US") %><% with $Helppack("en-US") %>
<li><a href="http:$Link" title="<%t DownloadRefresh.HelppackLinkTitle "Download helpcontent for offline use" %>"><%t DownloadRefresh.HelppackButtonLabel "Help for offline use" %>: (English fallback)</a> <span class="thin">(<a href="{$Link}.torrent" title="<%t DownloadRefresh.TorrentLinkTitle "Download using BitTorrent" %>"><%t DownloadRefresh.TorrentLinkText "Torrent" %></a>, <a href="{$Link}.mirrorlist" title="<%t DownloadRefresh.InfoLinkTitle "Checksums and additional info" %>"><%t DownloadRefresh.InfoText "Info" %></a>)</span></li>
<% end_with %><% end_if %>
<% if $Platform == "win" || $Platform == "mac" %><li><a href="<% if $Platform == "win" %>https://www.gpg4win.org/<% else %>https://gpgtools.org/<% end_if %>" target="_blank">Key management software</a> for the new OpenPGP feature (external site)</li><% end_if %>
</ul>
<p><a href='$Top.Link?type=$Top.Type&version=$Version&lang=pick' title="<%t DownloadRefresh.ChangeLanguageLinkTitle "Pick another language" %>"><%t DownloadRefresh.ChangeLanguageLinkText "need another language?" %></a><p>
<% end_with %>
</div>
<% end_if %><% end_with %>
</div> <!-- Ends outer green box -->
 <script>
$(document).ready(function() {
                             $('select').show();
                             });
</script>
