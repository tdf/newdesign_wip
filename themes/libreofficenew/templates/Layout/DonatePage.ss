<section id="content1" class="section">
<div class="container">
    <article>
    <div class="row col-sm-8 margin-20">
        <% include BreadCrumbs %>
        <h3>$Title</h3>
        <p class="lead_libre"><%t DonatePage.LeadText "LibreOffice is Free Software and is made available free of charge. <br/>Your donation, which is purely optional, supports our worldwide community.<br/>If you like the software, please consider a donation." is "subtitle style lead text on donate page" %></p>
        $Content
    </div>

    <div class="col-sm-4 margin-20">
        <%-- <div id="translations"><form name="translations"><p><strong>Available translations of this page:</strong>
                <select class="form-control" name="SelectURL" onchange="document.location.href=document.translations.SelectURL.options[document.translations.SelectURL.selectedIndex].value">
                    <option value="ru/">Русский</option>
                    <option value="he/">עברית</option>
                    <option value="fa/">فارسى</option>
                    <option value="ja/">日本語</option>
                    <option value="cs/">če&scaron;tina</option>
                    <option value="de/">Deutsch</option>
                    <option value="nl/">Nederlands</option>
                    <option value="tr/">T&uuml;rk&ccedil;e</option>
                    <option value="ca/">catal&agrave;</option>
                    <option value="es/">espa&ntilde;ol</option>
                    <option value="fr/">fran&ccedil;ais</option>
                    <option value="it/">italiano</option>
                    <option value="pl/">polski</option>
                    <option value="pt/">portugu&ecirc;s (Brasil)</option>
                    <option value="sl/">sloven&scaron;čina</option>
                    <option value="zh-TW/">中文 (正體)</option>
            </select></p></form>
        </div>
        --%>
        $Customsidebar

        <% include SideBar %>
    </div>
    </article>
</div>
</section>
