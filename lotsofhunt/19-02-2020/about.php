<?php 
/**
 * Template Name: About Us

 *

 * This is the template that displays all pages by default.

 * Please note that this is the WordPress construct of pages

 * and that other 'pages' on your WordPress site will use a

 * different template.

 *
 */

include('include/header-inc.php'); ?>
<!-- start hunter banner -->
<div class="about-banner">
    <div class="container">
      <h1 class="text-center">we are here <span>to help</span></h1>
      <h3 class="text-center"><span>contact us </span>with your <span>questions</span></h3>
    </div>
</div>
<!-- end hunter banner -->

<!-- description -->
    <div class="landowner-objectives">
        <div class="container landowner-heading wow fadeInUp">
          <h1 class="text-center title-heading"><span>mission</span> and vision</h1>
          <p class="text-center">
            We strive to bring the captivating experiences of the great outdoors to everyone, by connecting landowners and outdoor enthusiasts who want to share in the beauty of the world. Lots to Hunt is a platform to facilitate these connections and provide win-win opportunities that are safe and sustainable for all.
          </p>
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
<!-- description -->

<!-- start founded -->
<div class="how-it-works">
    <div class="container">
      <h1 class="text-center title-heading">how it all <span>began</span> ?</h1>
      <div class="row">
        <div class="col-md-4 second">
          <div class="founder-box">
            <img src="<?php echo bloginfo('stylesheet_directory')?>/images/about/founder-deer.png" alt="">
            <div class="founder-border"></div>
          </div>
        </div>
        <div class="col-md-8 first">
          <div class="how-it-works-text text-right">
            <h3>If you are interested in joining
                Lots to Hunt, or want more
                information please reach out to
                Eric.</h3>
            <h1>Eric <span>Mueller</span>, CEO & <span>Founder</span></h1>
            <p class="how-it-works-info"><i class="fa fa-envelope mr-4"></i>Eric.Mueller@lotstohunt.com</p>
            <p class="how-it-works-info"><i class="fa fa-phone mr-4"></i> (763)607-1089</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end founded -->

<!-- start founded -->
<div class="founder">
  <div class="container">
    <h1 class="text-center title-heading"><span>founder</span></h1>
    <div class="row">
      <div class="col-md-4">
        <div class="founder-box">
          <img src="<?php echo bloginfo('stylesheet_directory')?>/images/about/founder-deer.png" alt="">
          <div class="founder-border"></div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="founder-text">
          <h3>If you are interested in joining
              Lots to Hunt, or want more
              information please reach out to
              Eric.</h3>
          <h1>Eric <span>Mueller</span>, CEO & <span>Founder</span></h1>
          <p class="founder-info"><i class="fa fa-envelope mr-4"></i>Eric.Mueller@lotstohunt.com</p>
          <p class="founder-info"><i class="fa fa-phone mr-4"></i> (763)607-1089</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end founded -->



<div class="faq">
  <div class="container">
    <h1 class="text-center">questions and answers</h1>
      <div class="row custom-faq-margin">
          <div class="col-md-6">
            <div class="faq-left">
              <img src="<?php echo bloginfo('stylesheet_directory')?>/images/about/founder.png" class="img-fluid d-block mx-auto" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="faq-right">
                <h4>What do I need to become<br>a <span>registered hunter</span>?</h4>
              <p>t is free to register on our site as a hunter<br/> and you only pay a booking 
                fee when you<br/> pay for your confirmed reservation.</p>
              <a href="#">know-more</a>
            </div>
          </div>
        </div>

    <a class="faq-anchor" href="faq.html">see deatailed faq</a>
  </div>
  
</div>

<section class="flat-row flat-text-title hunter-get-started">
  <div class="container">
  
    <div class="row">
      <div class="col-md-12">
        <div class="text-title center">
          <div class="sx3"> what is <span style="color:#000;">lots to hunt</span> ?</div>
        </div>
        <p align="center">     Lots to Hunt is an online marketplace platform that allows landowners to sell the hunting privileges of their property on a short-term basis to interested hunters. </p>
         <div class="center">
           <button type="button" class="start">Get Started</button>
         </div> 
      </div>
    </div>
</section>
<?php include('include/footer-inc.php'); ?>