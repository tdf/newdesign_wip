<%--Include SidebarMenu recursively --%>
<% if $Children %>
<% loop $Children %>
<li>
    <a href="$Link" class="$LinkingMode" title="$Title.XML">
        $MenuTitle.XML
    </a>
  <% if $Children %>
     <!-- <ul>
        <% include SidebarMenu %>
    </ul>-->
    <% end_if %> 
</li>
<% end_loop %>
<% end_if %>
