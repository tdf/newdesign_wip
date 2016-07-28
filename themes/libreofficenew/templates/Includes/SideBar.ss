<aside>
	<% if $Menu(2) %>
		<nav class="secondary">
			<% with $Level(1) %>
				<h3>
					$MenuTitle
				</h3>
				<ul class="list-unstyled side-links">
				<% include SidebarMenu %>
				</ul>
			<% end_with %>
		</nav>
<!--<% loop $Menu(2) %>
<p>$MenuTitle</p>
<% end_loop %>-->
	<% end_if %>
</aside>
