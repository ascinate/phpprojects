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

      <div class="user-designation"> <?php if($dept=='Admin'){echo 'Administrator';} else {echo $this->session->userdata('name');}?>  </div>
    </div>
    <ul class="nav">
      <li class="nav-item" id="si">
       <a class="nav-link" href="<?php echo base_url();?>dashboard#!/">
        <i class="icon-head menu-icon"></i> <span class="menu-title">Dashboard</span>
       </a>
      </li>
      
      <li class="nav-item">
       <a class="nav-link" href="<?php echo base_url();?>dashboard/users">
        <i class="icon-drop menu-icon"></i> <span class="menu-title">Manage Customers</span>
       </a>
      </li>

      <li class="nav-item">
       <a class="nav-link" href="<?php echo base_url();?>dashboard/cleaners">
        <i class="icon-drop menu-icon"></i> <span class="menu-title">Manage Cleaners</span>
       </a>
      </li>

     <li class="nav-item">
      <div style="width:240px;">&nbsp;</div>
     </li>
    </ul>
    
  </nav>