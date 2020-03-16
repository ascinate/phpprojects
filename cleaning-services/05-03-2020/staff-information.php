<?php
   $groups = $this->session->userdata('user_group');
   $depart = $this->session->userdata('department');
   
   $this->db->select("*");
   $this->db->from("role_master");
   $this->db->where('sector', 'Staff Information');
   $this->db->where_in('group_id', $groups);
   $query = $this->db->get();
   $row = $query->row();
   
   //echo $this->db->last_query();
   $role = $row->privilege;
   
   if(($role=='no') || ($role=='N'))
   {
?>
<div class="content-wrapper">
  <div class="row">
        <div class="col-sm-12 mb-4 mb-xl-0">
          <div class="card">
            <div class="card-body" align="center"><h5>DASHBOARD</h5></div>
           </div> 
        </div>
      </div>
      
   <div class="row mt-3">
      
      <div class="col-sm-12 mb-4 mb-xl-0" style="height:545px;">
          <div class="card">
            <div class="card-body" align="center">
              Access Restricted
            </div>
      </div>
     </div>
   </div>
   
</div>
<?php
   }
   else
   {
 ?>
<div class="content-wrapper">
      <div class="row">
        <div class="col-sm-12 mb-4 mb-xl-0">
          <div class="card">
            <div class="card-body" align="center"><h5>DASHBOARD</h5></div>
           </div> 
        </div>
      </div>
      
      <div class="row mt-3">
        <div class="col-md-12">&nbsp;</div>
      </div>

      <div class="row mt-3">
      
      <div class="col-xl-4 d-flex grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
            <div class="row">
              <div class="col-lg-10">
              <h4 class="card-title mb-3 title" align="center">Staff Updates</h4>
             </div>
              <div class="col-lg-2" align="right">
               <?php if($role=='fc') { ?>
               <a href="<?php echo base_url();?>dashboard/staffupdates" class="btn btn-info btn-sm">Edit</a>
               <?php } else if($role=='rw') {?>
               <a href="<?php echo base_url();?>dashboard/staffupdates" class="btn btn-info btn-sm">Edit</a>
               <?php } else if($depart=='Admin') {?>
               <a href="<?php echo base_url();?>dashboard/staffupdates" class="btn btn-info btn-sm">Edit</a>
               <?php }?>
             </div>
            </div>
             
              <?php
                 $query = $this->db->query("select * from `staff_updates` order by id desc");
				 foreach ($query->result() as $row)
			     {
			  ?>
              <div class="row mt-3 border-bottom">
                <div class="col-md-12">
                  <div class="font-weight-bold mr-sm-4"><?=$row->title?></div>
                  <?php $ex = explode("-",$row->post_date); $mk = mktime(12,0,0, $ex[1],$ex[2],$ex[0]); echo date('F j, Y',$mk);?>
                 <div style="padding-top:5px; padding-bottom:5px; font-size:17px;"><?=strip_tags($row->description)?></div>
                </div>
              </div>
              <?php 
				 }
			  ?>  
              
            </div>
            
          </div>
        </div>
      
        <div class="col-xl-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-lg-10">
              <h4 class="card-title mb-3 title" align="center">Policies, Forms & Applications</h4>
             </div>
              <div class="col-lg-2" align="right">
               <?php if($role=='fc') { ?>
               <a href="<?php echo base_url();?>dashboard/policy" class="btn btn-info btn-sm">Edit</a>
               <?php } else if($role=='rw') {?>
               <a href="<?php echo base_url();?>dashboard/policy" class="btn btn-info btn-sm">Edit</a>
               <?php } else if($depart=='Admin') {?>
               <a href="<?php echo base_url();?>dashboard/policy" class="btn btn-info btn-sm">Edit</a>
               <?php }?>
              </div>
            </div>

              <div class="row">
                <div class="col-sm-12">
                  <div class="text-dark">
                  <p>&nbsp;</p>
                   <?php
					 $query = $this->db->query("select * from `policy_master` order by id desc");
					 foreach ($query->result() as $row)
					 {
				   ?>
                    <div class="d-flex pb-3 border-bottom justify-content-between">
                      <div class="font-weight-bold mr-sm-4">
                        <div><?=$row->policy?></div>
                      </div>
                      <div style="margin-top:10px;">
                        <a href="<?php echo base_url();?>uploads/<?=$row->policy_file;?>" target="_blank" class="btn btn-secondary btn-sm">View</a>
                      </div>
                    </div>
                    <?php
					 }
					 ?>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
        
        <div class="col-xl-4 flex-column d-flex grid-margin stretch-card">
          <div class="row flex-grow">
            <div class="col-sm-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                  <div class="col-lg-10">
                  <h4 class="card-title mb-3 title" align="center">Upcoming Events</h4>
                  </div>
                  <div class="col-lg-2" align="right">
				   <?php if($role=='fc') { ?>
                   <a href="<?php echo base_url();?>dashboard/event" class="btn btn-info btn-sm">Edit</a>
                   <?php } else if($role=='rw') {?>
                   <a href="<?php echo base_url();?>dashboard/event" class="btn btn-info btn-sm">Edit</a>
                   <?php } else if($depart=='Admin') {?>
                   <a href="<?php echo base_url();?>dashboard/event" class="btn btn-info btn-sm">Edit</a>
                   <?php }?>
                  </div>
                  </div>
                  <p>&nbsp;</p>
                   <?php
					 $query = $this->db->query("select * from `event_master` order by id desc");
					 foreach ($query->result() as $row)
					 {
				  ?>
                  <div class="border-bottom">
				  <div class="font-weight-bold mr-sm-4">
				  <?php $ex = explode("-",$row->event_date); $mk = mktime(12,0,0, $ex[1],$ex[2],$ex[0]); echo date('F j',$mk);?> :
				  <?=$row->event_title?></div>
                  <div style="padding-top:5px; padding-bottom:5px; font-size:17px;"><?=strip_tags($row->note)?></div>
                  </div>
                  
                  <?php
					 }
				  ?>
                </div>
              </div>
            </div>
            
            <div class="col-sm-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                  <div class="col-lg-10">
                  <h4 class="card-title mb-3 title" align="center">Important Phone Numbers</h4>
                  </div>
                  <div class="col-lg-2" align="right">
                   <?php if($role=='fc') { ?>
                   <a href="<?php echo base_url();?>dashboard/contact" class="btn btn-info btn-sm">Edit</a>
                   <?php } else if($role=='rw') {?>
                   <a href="<?php echo base_url();?>dashboard/contact" class="btn btn-info btn-sm">Edit</a>
                   <?php } else if($depart=='Admin') {?>
                   <a href="<?php echo base_url();?>dashboard/contact" class="btn btn-info btn-sm">Edit</a>
                   <?php }?>
                  </div>
                  </div>
                   <p>&nbsp;</p>
                    <?php
					 $query = $this->db->query("select * from `contact_master` order by name asc");
					 foreach ($query->result() as $row)
					 {
				    ?>
                       <p class="border-bottom" style="font-size:17px;"><?=$row->name;?>: <?=$row->contact;?></p>
                   <?php
					 }
				   ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
     }
   ?>