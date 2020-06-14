<% with Downloads %>
<div  class="DownloadsLeft row col-sm-8 margin-20">
<p class="bs-callout"><%t DonateDownload.LinkStartText "Your download <a href='{link}'>{filename} ({size})</a> should begin shortly. Please click the link if it doesn't start." link=$full.Link() filename=$full.Filename size=$full.Size.Nice %><br/>
<small><%t DonateDownload.ManualMirror "You can also <a href='{link}.mirrorlist'>manually pick a mirror</a>" link=$full.Link() %>. <%t DonateDownload.NeedAnotherLang "Or <a href='https://www.libreoffice.org/download/download/?lang=pick'>choose another language</a>." %></small></p>
<% if langpack || helppack %>
<ul>
    <% if langpack %><% with langpack %><li><h2><a href="$Link()"><%t DonateDownload.Langpack "Translated User Interface" %></a></h2>$Size.Nice (<a href="{$Link()}.torrent" title="<%t DonateDownload.TorrentLinkTitle "Download the file using BitTorrent" %>"><%t DonateDownload.TorrentLinkText "Torrent" %></a>, <a href="{$Link()}.mirrorlist" title="<%t DonateDownload.InfoLinkTitle "See the checksums and list of download mirrors for this file" %>"><%t DonateDownload.InfoLinkText "Info" %></a>)</li><% end_with %><% end_if %>
    <% if helppack %><% with helppack %><li><h2><a href="$Link()"><%t DonateDownload.Helppack "LibreOffice built-in help" %></a></h2>$Size.Nice (<a href="{$Link()}.torrent" title="<%t DonateDownload.TorrentLinkTitle "Download the file using BitTorrent" %>"><%t DonateDownload.TorrentLinkText "Torrent" %></a>, <a href="{$Link()}.mirrorlist" title="<%t DonateDownload.InfoLinkTitle "See the checksums and list of download mirrors for this file" %>"><%t DonateDownload.InfoLinkText "Info" %></a>)</li><% end_with %><% end_if %>
  </ul><% end_if %>
<% if $full.Platform == "win" || $full.Platform == "mac" %><p>To use the new OpenPGP feature, you might want to download the corresponding <a href="<% if $full.Platform == "win" %>https://www.gpg4win.org/<% else %>https://gpgtools.org/<% end_if %>" target="_blank">Key management software</a> (external site)</p><% end_if %>   
</div>
<div class="DownloadsLeft col-sm-4" style="float:right; margin-right: 30px;">
<p class="bs-callout bs-callout-danger"><%t DonateDownload.DownloadProblemContact "Having problems <strong>downloading</strong> LibreOffice? Note that we <strong>do not provide technical support</strong> for installing or using the software. If you need help, please visit <a href='https://ask.libreoffice.org/'>Ask LibreOffice</a>.<br /><br />But if your question is about <strong>downloading</strong> LibreOffice from our website, let us know: (1) Your operating system version; (2) Your web browser; (3) Error message(s) you see. Send these to <a href='mailto:download@libreoffice.org'>download@libreoffice.org</a> and we will try to help." %></p></div>
<% end_with %>
