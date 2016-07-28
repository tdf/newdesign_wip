<!-- $RSSTitle --><% loop $Feed %>
<div class="col-sm-3 text-center">
    <div class="latest-article">
        <div class="latest-article-title">$Title</div>
        <div class="latest-article-date">$Date</div>
        <p>$Description</p>
        <p><a class="more" href="$Link" target="_blank"><%t RSS.ReadMore "read more »" is "read more link text" %></a></p>
    </div>
</div><% end_loop %>
