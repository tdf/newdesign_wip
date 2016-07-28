<% require javascript("themes/libreofficenew/js/jquery-1.10.1.min.js") %><%-- specify to make sure order is right --%>
<% require javascript("themes/libreofficenew/js/feedback.js") %>
    <section id="content1" class="section">
      <div class="container">
	  
	  <article>
         <div class="row margin-20">
          <div class="col-sm-12">
      <% include BreadCrumbs %>
            <h3>$Title</h3>
            <p class="lead">$Subtitle1</p>
            <p>$Fullwidthtext1</p>
          </div>
        </div>
          
          <!-- Main Column -->
		 <div class="row">
		 <div class="col-sm-6 margin-20">
            
            <!--Article-->
            
            <div class="row">
              <div class="col-sm-2 service-icons text-center">
                <i class="fa fa-$FeedbackIcon1 fa-3x green"></i>
              </div>
              <div class="col-sm-10 text-left">
                <h3><a href="$FeedbackLink1">$FeedbackTitle1</a></h3>
               <p>$FeedbackText1</p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-2 service-icons text-center">
                <i class="fa fa-$FeedbackIcon2 fa-3x green"></i>
              </div>
              <div class="col-sm-10 text-left">
                <h3><a href="$FeedbackLink2">$FeedbackTitle2</a></h3>
               <p>$FeedbackText2</p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-2 service-icons text-center">
                <i class="fa fa-$FeedbackIcon3 fa-3x green"></i>
              </div>
              <div class="col-sm-10 text-left">
                <h3><a href="$FeedbackLink3">$FeedbackTitle3</a></h3>
               <p>$FeedbackText3</p>
              </div>
            </div>
           
            <div class="row">
            $Content
          </div>
           <!--End Article-->
        </div>
          <!--End Main Column -->
        
      
       <div class="col-sm-6">
            $Feedbacksidebar
</div>
     
        </div>
        <!--End Row-->
             
          </article>
        </div>
        </section>
