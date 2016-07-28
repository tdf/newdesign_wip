<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand img-responsive" href="$Page(/).Link"><img src="$ThemeDir/img/logo.png" alt="logo"></a>
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
