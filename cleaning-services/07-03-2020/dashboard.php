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

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>

</head>
<body ng-app="myApp">

<div class="container-scroller">

<!-- partial:partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center"> 
  <a class="navbar-brand brand-logo" href="#!/"><img src="<?php echo base_url();?>assets/images/logo.png" alt="logo"/></a> 
  <a class="navbar-brand brand-logo-mini" href="#!/"><img src="<?php echo base_url();?>assets/images/logo.png" alt="logo"/></a> </div>
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
     <?php }?> 
     
      <!--<li class="nav-item dropdown d-flex mr-4"> <a href="#" class=" nav-link">Welcome Admin!</a></li>-->
      <!--<li class="nav-item dropdown d-flex mr-4">
       <i class="icon-inbox"></i> <a href="<?php //echo base_url();?>login/user_logout" class="nav-link">Logout</a>
      </li>-->
      
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
<?php $dept = $this->session->userdata('department');?>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="user-profile">
      <div class="user-image"> 
        <?php if($this->session->userdata('photo')!="") {?>
        <img src="<?php echo base_url();?>uploads/<?=$this->session->userdata('photo')?>" border="0"> 
        <?php } else {?>
        <img src="<?php echo base_url();?>assets/images/avatar.png" alt="image" width="50" height="50"/>
        <?php }?>
      </div>
      <!--<div class="user-name"> Edward Spence </div>-->
      <div class="user-designation"> 
        <?php if($dept=='Admin'){echo 'Administrator';} else { echo $this->session->userdata('name');}?> 
      </div>
    </div>
  
    <ul class="nav">
      <li class="nav-item" id="si">
       <a class="nav-link" href="<?php echo base_url();?>dashboard#!/">
        <i class="icon-head menu-icon"></i> <span class="menu-title">Dashboard</span>
       </a>
      </li>
      <li class="nav-item" id="hw">
       <a class="nav-link" href="<?php echo base_url();?>dashboard/users">
        <i class="icon-drop menu-icon"></i> <span class="menu-title">Manage Customers</span>
       </a>
      </li>
      <li class="nav-item" id="sb">
       <a class="nav-link" href="<?php echo base_url();?>dashboard/cleaners">
        <i class="icon-drop menu-icon"></i> <span class="menu-title">Manage Cleaners</span>
       </a>
      </li>
      <li class="nav-item" id="pt">
       <a class="nav-link" href="<?php echo base_url();?>dashboard/schedules">
        <i class="icon-drop menu-icon"></i> <span class="menu-title">Manage Schedules</span>
       </a>
      </li>
     <li class="nav-item" id="pt">
      <div style="width:240px;">&nbsp;</div>
     </li>
    </ul>
  </nav>
  
  <!-- partial -->
  <div class="main-panel">
  
    <div ng-view></div>
    
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between"> 
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block" style="font-size:0.975rem;">Copyright © 2019. All rights reserved.</span> 
      </div>
    </footer>
    <!-- partial -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- base:js -->
<script src="<?php echo base_url();?>assets/vendors/base/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="<?php echo base_url();?>assets/js/off-canvas.js"></script>
<script src="<?php echo base_url();?>assets/js/hoverable-collapse.js"></script>
<script src="<?php echo base_url();?>assets/js/template.js"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="<?php echo base_url();?>assets/vendors/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url();?>assets/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
<script src="<?php echo base_url();?>assets/js/dashboard.js"></script>
<!-- End custom js for this page-->

<script>
$(document).ready(function(){
	
  var pageURL = $(location).attr("href");
  var explode = pageURL.split("#!/");
  
  var result = explode[1];
  
  if(result=='')
  {
   $("#aw").removeClass("active");
	 $("#si").addClass("active");
	 $("#hw").removeClass("active");
	 $("#sb").removeClass("active");
	 $("#pt").removeClass("active");
  }
  else if(result=='safety_awards')
  {
     $("#aw").addClass("active");
	 $("#si").removeClass("active");
	 $("#hw").removeClass("active");
	 $("#sb").removeClass("active");
	 $("#pt").removeClass("active");
  }
  else if(result=='health_wellness')
  {
     $("#hw").addClass("active");
     $("#aw").removeClass("active");
	 $("#si").removeClass("active");
	 $("#sb").removeClass("active");
	 $("#pt").removeClass("active");
  }
  else if(result=='safety_boot')
  {
     $("#hw").removeClass("active");
     $("#aw").removeClass("active");
	 $("#si").removeClass("active");
	 $("#sb").addClass("active");
	 $("#pt").removeClass("active");
  }
  
  else if(result=='personnel_training')
  {
     $("#hw").removeClass("active");
     $("#aw").removeClass("active");
	 $("#si").removeClass("active");
	 $("#sb").removeClass("active");
	 $("#pt").addClass("active");
  }
  
  else
  {
     $("#hw").removeClass("active");
     $("#aw").removeClass("active");
	 $("#si").removeClass("active");
	 $("#sb").removeClass("active");
	 $("#pt").removeClass("active");
  }
  

  $("#si").click(function(){
     $("#aw").removeClass("active");
	 $("#si").addClass("active");
	 $("#hw").removeClass("active");
	 $("#sb").removeClass("active");
	 $("#pt").removeClass("active");
  });
  
  $("#aw").click(function(){
     $("#aw").addClass("active");
	 $("#si").removeClass("active");
	 $("#hw").removeClass("active");
	 $("#sb").removeClass("active");
	 $("#pt").removeClass("active");
  });
  
  $("#hw").click(function(){
     $("#hw").addClass("active");
     $("#aw").removeClass("active");
	 $("#si").removeClass("active");
	 $("#sb").removeClass("active");
	 $("#pt").removeClass("active");
  });
  
   $("#sb").click(function(){
     $("#hw").removeClass("active");
     $("#aw").removeClass("active");
	 $("#si").removeClass("active");
	 $("#sb").addClass("active");
	 $("#pt").removeClass("active");
  });
  
   $("#pt").click(function(){
     $("#hw").removeClass("active");
     $("#aw").removeClass("active");
	 $("#si").removeClass("active");
	 $("#sb").removeClass("active");
	 $("#pt").addClass("active");
  });

});

var app = angular.module("myApp", ["ngRoute"]);
app.config(function($routeProvider) {
    $routeProvider

    .when("/", {
        templateUrl : "<?php echo base_url();?>dashboard/staff"
    })
	
	.when("/users", {
        templateUrl : "<?php echo base_url();?>dashboard/users"
    })
	.when("/staffupdates", {
        templateUrl : "<?php echo base_url();?>dashboard/staffupdates"
    })
	.when("/addstaffupdate", {
        templateUrl : "<?php echo base_url();?>dashboard/addstaffupdate"
    })
	.when("/policy", {
        templateUrl : "<?php echo base_url();?>dashboard/policy"
    })
	.when("/addpolicy", {
        templateUrl : "<?php echo base_url();?>dashboard/addpolicy"
    })
	.when("/event", {
        templateUrl : "<?php echo base_url();?>dashboard/event"
    })
	.when("/addevent", {
        templateUrl : "<?php echo base_url();?>dashboard/addevent"
    })
	.when("/contact", {
        templateUrl : "<?php echo base_url();?>dashboard/contact"
    })
	.when("/addcontact", {
        templateUrl : "<?php echo base_url();?>dashboard/addcontact"
    })
	.when("/addsafety", {
        templateUrl : "<?php echo base_url();?>dashboard/addsafety"
    })
	.when("/groups", {
        templateUrl : "<?php echo base_url();?>dashboard/grouplist"
    })
	.when("/addgroup", {
        templateUrl : "<?php echo base_url();?>dashboard/addgroup"
    })
	.when("/adduser", {
        templateUrl : "<?php echo base_url();?>dashboard/adduser"  
    })
	.when("/edituser/:param", {
        templateUrl : "<?php echo base_url();?>dashboard/edituser", 
		controller: 'RouteController'
    });

});

 module.controller("RouteController", function($scope, $routeParams) {
        $scope.param = $routeParams.param;
    })
</script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function() {

    $('#example').DataTable();
} );
</script>
</body>
</html>
