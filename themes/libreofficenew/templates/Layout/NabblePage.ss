    <section id="content1" class="section">
      <div class="container">
	  
	  <article>
	  <div class="row">
		<div class="row col-sm-10 margin-20">
 <% include BreadCrumbs %>
       <h3>$Title</h3>
		$Content
<a id="nabblelink"
href="http://nabble.documentfoundation.org/Users-f<% if NabbleForum %>$NabbleForum<% else %>1639498<% end_if %>.html">Users</a>
<script>
{
	var nabble_id="a.f<% if NabbleForum %>$NabbleForum<% else %>1639498<% end_if %>";
	var link=document.getElementById("nabblelink");
	if (window.nabble_id && link != null) {
		link.style.display="none";
		if ('https:' == window.location.protocol) {
			document.write("<p>nabble doesn't support https. Make sure you either have configured an exception in your browser or <a href='http:" + window.location.href.substring(window.location.protocol.length) + "'>access this page using plain http</a></p>");
		}
		document.write("<div id='nabbleforum' style='width:100%'><div style='height:700px'><img src='http://n3.nabble.com/images/loading.png' width=94 height=33 alt='Loading...'></div></div>");
		var e = document.createElement("script");
		e.src = 'http://n3.nabble.com/embed/JsEmbed.jtp?site=969070&node=<% if NabbleForum %>$NabbleForum<% else %>1639498<% end_if %>&url=' + encodeURIComponent(location.href);
		e.type="text/javascript";
		document.getElementsByTagName("head")[0].appendChild(e);
	}
}
</script>
		$PageComments
</div>
        
      
       <div class="col-sm-2">
            <% include SideBar %>
</div>
        </div>
          
          </article>
        </div>
        </section>
