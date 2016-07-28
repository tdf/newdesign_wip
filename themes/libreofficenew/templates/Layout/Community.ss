    <section id="content1" class="section">
        <div class="container">
       <article>
         <div class="row margin-20">
          <div class="col-sm-12">
 <% include BreadCrumbs %>
       <h3>$Title</h3>
            <p class="lead">$Subtitle</p>
            <p>$Content</p>
          </div>
        </div>
        
        <!--First Row-->
        <div class="row">
        
          <div class="col-sm-6 margin-20 community">
            <div class="row">
              <div class="col-sm-3 service-icons text-center">
               <a href="$CommunityLink1"><i class="fa fa-$CommunityIcon1 fa-3x green"></i></a>
              </div>
              
              <div class="col-sm-9 text-left">
                <a href="$CommunityLink1"><h3>$CommunityTitle1</h3></a>
                <p>$CommunityText1</p>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 margin-20 community">
            <div class="row">
              <div class="col-sm-3 community-icons text-center">
               <a href="$CommunityLink4"><i class="fa fa-$CommunityIcon4 fa-3x green"></i></a>
              </div>
              
              <div class="col-sm-9 text-left">
                <a href="$CommunityLink4"><h3>$CommunityTitle4</h3></a>
                <p>$CommunityText4</p>
              </div>
            </div>
          </div>
          
          </div>
          
        
          <!--Second Row-->
       <div class="row">
        
          <div class="col-sm-6 margin-20 community">
            <div class="row">
              <div class="col-sm-3 service-icons text-center">
               <a href="$CommunityLink2"><i class="fa fa-$CommunityIcon2 fa-3x green"></i></a>
              </div>
              
              <div class="col-sm-9 text-left">
                <a href="$CommunityLink2"><h3>$CommunityTitle2</h3></a>
                <p>$CommunityText2</p>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 margin-20 community">
            <div class="row">
              <div class="col-sm-3 community-icons text-center">
               <a href="$CommunityLink5"><i class="fa fa-$CommunityIcon5 fa-3x green"></i></a>
              </div>
              
              <div class="col-sm-9 text-left">
                <a href="$CommunityLink5"><h3>$CommunityTitle5</h3></a>
                <p>$CommunityText5</p>
              </div>
            </div>
          </div>
          
          </div>
        
        <!--Third Row-->
       <div class="row">
        
          <div class="col-sm-6 margin-20 community">
            <div class="row">
              <div class="col-sm-3 service-icons text-center">
               <% if $CommunityLink3 %><a href="$CommunityLink3"><i class="fa fa-$CommunityIcon3 fa-3x green"></i></a><% else %><i class="fa fa-$CommunityIcon3 fa-3x green"></i><% end_if %>
              </div>
              
              <div class="col-sm-9 text-left">
                <% if $CommunityLink3 %><a href="$CommunityLink3"><h3>$CommunityTitle3</h3></a><% else %><h3>$CommunityTitle3</h3><% end_if %>
                <p>$CommunityText3</p>
              </div>
            </div>
          </div>
          
          <div class="col-sm-6 margin-20 community">
            <div class="row">
              <div class="col-sm-3 community-icons text-center">
               <a href="$CommunityLink6"><i class="fa fa-$CommunityIcon6 fa-3x green"></i></a>
              </div>
              
              <div class="col-sm-9 text-left">
                <a href="$CommunityLink6"><h3>$CommunityTitle6</h3></a>
                <p>$CommunityText6</p>
              </div>
            </div>
          </div>
          
          </div>

      </article>
      </div>
    </section>
