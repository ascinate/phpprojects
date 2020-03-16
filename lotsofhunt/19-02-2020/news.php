<?php 
/**

 * Template Name: News

 *

 * This is the template that displays all pages by default.

 * Please note that this is the WordPress construct of pages

 * and that other 'pages' on your WordPress site will use a

 * different template.

 *

 */

include('include/header-inc.php'); ?>
<!-- start hunter banner -->
<div class="news-banner">
  <div class="container">
    <h1 class="text-center">Outdoor News<br>
      Blog<span> Posts!</span></h1>
  </div>
</div>
<!-- end hunter banner --> 


<div class="expand-range">
  <div class="container">
    <!--<h1 class="text-center">explore hunting</h1>-->
    <div class="row">
      <div class="col-md-12">
        
        <?php
       while ( have_posts() ) : the_post();

        the_content();
      
      endwhile; // End of the loop.
     
    ?>
      </div>
      
    </div>
  </div>
</div>
<!-- /.flat-subscibe -->
<?php include('include/footer-inc.php'); ?>