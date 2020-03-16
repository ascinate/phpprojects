<?php 
/**

 * Template Name: Landowner

 *

 * This is the template that displays all pages by default.

 * Please note that this is the WordPress construct of pages

 * and that other 'pages' on your WordPress site will use a

 * different template.

 *


 */

include('include/header-inc.php'); ?>
<!-- start hunter banner -->
<div class="landowner-banner">
  <div class="container">
    <h1 class="text-center"> Do you have hunting land that is sitting empty a majority of the year? <br>
      <span>Sign up now,</span> and turn the land into cash while keeping full control!</h1>
  </div>
</div>
<!-- end hunter banner --> 

<!-- founder -->
<div class="founder"></div>
<!-- founder -->
<section class="flat-row flat-text-title hunter-get-started">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-title center">
          <div class="sx3"> <span>east central minnesota</span> wooded lot with private <span>pond and food source</span> .</div>
        </div>
        <p class="land-owner"> just over 150acres of huntable area near harris, 
          minnesota available to hunt whitetail deer, 
          pheasants, grouse, geese and turkey. lot includes two private ponds,
          25acres of planted corn, and about 100acres of woods. </p>
        <h4 class="text-center landowner-h4">this lot is home to great <span>whitetail genetics</span> !</h4>
        <p class="land-owner">Lots to Hunt is looking for interested landowners to sign up and post their property.</p>
        <div class="center">
          <button type="button" class="start">Get Started</button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12"></div>
    </div>
  </div>
</section>


<div class="landowner-objectives">
        <div class="container landowner-heading wow fadeInUp">
          <h1 class="text-center title-heading"><span>Why should I</span> sign up as a Landowner?</h1>
        </div>
        <div class="container">
          <div class="row no-gutters charges">
            <div class="col-md-6 why-partner wow fadeInLeft">
              <h1><i class="fa fa-paw"></i></h1>
              <h2>why <span>partner</span> with us?</h2>
              <p class="why-partner-p"><i class="fa fa-check"></i>Landowners maintain full control over their own property by setting availability and terms.</p>
              <p class="why-partner-p"><i class="fa fa-check"></i>No sign-up fees.</p>
              <p class="why-partner-p"><i class="fa fa-check"></i>Secure Marketplace.</p>
              <p class="why-partner-p"><i class="fa fa-check"></i>Low commission rate - take home 93% of your list price.</p>
            </div>
            
            <div class="col-md-6 landowner-benefits wow fadeInRight">
              <h1><i class="fa fa-paw"></i></h1>
              <h2>landowner benefits</h2>
              <p class="why-partner-p"><i class="fa fa-check"></i>Earn income with minimal effort.</p>
              <p class="why-partner-p"><i class="fa fa-check"></i>Utilize land during offpeak seasons.</p>
              <p class="why-partner-p"><i class="fa fa-check"></i>No hassle scheduling.</p>
              <p class="why-partner-p"><i class="fa fa-check"></i>Gain comfort and peace of mind know who is using property.</p>
              <p class="why-partner-p"><i class="fa fa-check"></i>Landowners can approve each hunter before the booking is confirmed.</p>
              <p class="why-partner-p"><i class="fa fa-check"></i>Ability to develop individual lot restrictions.</p>
            </div>
          </div>
        </div>
      </div>

<?php
		if ( have_posts() ) :

		/* Start the Loop */
		while ( have_posts() ) : the_post();

			the_content();
		
		endwhile;
		
		endif;

		?>

<!-- /.flat-subscibe -->

<?php include('include/footer-inc.php'); ?>