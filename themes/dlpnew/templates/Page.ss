<!DOCTYPE html>
<html lang="en">
    <head>
        <% base_tag %>
        $MetaTags(false)
        <title>$Title</title>
        <link rel="shortcut icon" href="$ThemeDir/images/favicon.ico" />
        <% require themedCSS('form') %>
        <% require themedCSS('layout') %>
        <% require themedCSS('typography') %>
        <% require themedCSS('fontawesome.min) %>
    </head>
    <body>
        <div id="Container">
            <div id="Header">
                <h1>Document <span class="liberation">Liberation</span> Project</h1>
            </div>
            <div id="Navigation">
                <% if $Menu(1) %>
                    <ul>
                        <% loop $Menu(1) %>   
                        <li><a href="$Link" title="Go to the $Title page" class="$LinkingMode"><span>$MenuTitle</span></a></li>
                        <% end_loop %>
                    </ul>
                <% end_if %>
            </div>
            <div id="Layout" class="typography">
                $Layout
            </div>
            <div id="Footer">
                <table>
                    <tr>
                        <td>
                            The Document Liberation Project is brought to you by <a target="_blank" href="http://www.documentfoundation.org/">The Document Foundation</a> | <a target="_blank" href="http://www.documentfoundation.org/privacy">Privacy policy</a> | <a target="_blank" href="http://www.documentfoundation.org/imprint">Impressum (legal info)</a> | Copyright information: Unless otherwise specified, all text and images on this site are licensed under a <a href="http://creativecommons.org/licenses/by-sa/3.0/legalcode" target="_blank">Creative Commons Attribution Share Alike 3.0</a> license. This does not include the project logos, icons and name.
                        </td>
                        <td>
                            <a target="_blank" href="http://creativecommons.org/licenses/by-sa/3.0/legalcode"><img src="/themes/dlp/images/cc-by-sa.png" title="cc-by-sa" alt="cc-by-sa" /></a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
<% include Piwik %>
    </body>
</html>
