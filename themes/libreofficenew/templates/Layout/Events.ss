<section id="content1" class="section">
<div class="container">
	<div class="row col-sm-12">
		<% include BreadCrumbs %>
		<h3>$Title</h3>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="flexslider">
				<ul class="slides">
					<li><a href="$SliderLink1"><% with $SliderImg1 %><img src="$URL" class="img-responsive"<% if $Title != " " %> alt="$Title"<% end_if %>/><% end_with %><div class="flex-caption-small">$SliderText1</div></a></li>
					<li><a href="$SliderLink2"><% with $SliderImg2 %><img src="$URL" class="img-responsive"<% if $Title != " " %> alt="$Title"<% end_if %>/><% end_with %><div class="flex-caption-small">$SliderText2</div></a></li>
					<li><a href="$SliderLink3"><% with $SliderImg3 %><img src="$URL" class="img-responsive"<% if $Title != " " %> alt="$Title"<% end_if %>/><% end_with %><div class="flex-caption-small">$SliderText3</div></a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="row margin-40">
		<div class="col-sm-10">
			<p class="lead">$Subtitle</p>
			<p>$Content</p>
		</div>

		<div class="col-sm-2">
			$Customsidebar
		</div>
	</div>
</div>
</section>
