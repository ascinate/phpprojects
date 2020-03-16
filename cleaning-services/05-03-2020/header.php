<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Cleaning Services</title>
<!-- base:css -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/feather/feather.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/base/vendor.bundle.base.css">
<!-- endinject -->
<!-- plugin css for this page -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/flag-icon-css/css/flag-icon.min.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/jquery-bar-rating/fontawesome-stars-o.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/jquery-bar-rating/fontawesome-stars.css">
<!-- End plugin css for this page -->

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<!-- inject:css -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
<!-- endinject -->
<link rel="shortcut icon" href="images/favicon.png" />

</head>
<body>

<div class="container-scroller">
<!-- partial:partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row noprint">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center"> 
  <a class="navbar-brand brand-logo" href="<?php echo base_url();?>dashboard">
  	<img src="<?php echo base_url();?>assets/images/logo.png" alt="logo"/></a> 
  <a class="navbar-brand brand-logo-mini" href="<?php echo base_url();?>dashboard"><img src="<?php echo base_url();?>assets/images/logo.png" alt="logo"/></a> </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize"> <span class="icon-menu"></span> </button>
    <ul class="navbar-nav navbar-nav-right">
      
     <?php if($this->session->userdata('department') == 'Admin') {?> 
      <li class="nav-item dropdown d-flex mr-4 "> 
      <a class="nav-link count-indicator dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown"> 
       <i class="fa fa-cog fa-lg"></i> Settings </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          <a href="<?php echo base_url();?>dashboard/users" class="dropdown-item preview-item">Users</a> 
          <a href="<?php echo base_url();?>dashboard/grouplist" class="dropdown-item preview-item">Groups</a> 
          <a href="<?php echo base_url();?>dashboard/rolemanager" class="dropdown-item preview-item">Role Manager</a>
          <a href="<?php echo base_url();?>dashboard/backup" class="dropdown-item preview-item">Backup</a>
          <a href="<?php echo base_url();?>dashboard/restore" class="dropdown-item preview-item">Restore</a>
          <!--<a href="<?php //echo base_url();?>dashboard/editprofile" class="dropdown-item preview-item">Edit Profile</a>-->
        </div>
      </li>
      <?php } ?>
      
      <!--<li class="nav-item dropdown d-flex mr-4"> <a href="#" class=" nav-link">Welcome Admin!</a></li>-->
      <li class="nav-item dropdown d-flex mr-4">
      <a class="nav-link count-indicator dropdown-toggle" href="javascript:void(0);" data-toggle="dropdown"> 
       <i class="icon-inbox"></i> Account </a>
       <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          <a href="<?php echo base_url();?>dashboard/changepassword" class="dropdown-item preview-item">Change Password</a> 
          <a href="<?php echo base_url();?>login/user_logout" class="dropdown-item preview-item">Logout</a> 
       </div>
      </li>
      
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas"> 
    <span class="icon-menu"></span> 
    </button>
  </div>
</nav>

<?php
  $user_id = $this->session->userdata('id');
   
   if($user_id=="")
	{
		redirect('/');
	}
?>