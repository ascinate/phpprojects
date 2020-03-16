<style>
table {
	width:100%;
	border-collapse:collapse;
	margin: auto;
	background-color: #fff;
	border: none !important;
}
table td {
 	position: relative;
	text-align: center;
	border: none;
	padding: 0px !important;
	margin: 0px !important;  
	height:40px !important;
}

input[type=text]{ border:none!important; font-weight:normal!important; width:95%; padding:0px 2px 0px 2px; height:35px;}
input[type=date]{ border:none!important; font-weight:normal!important; font-size:12px; text-transform:uppercase; width:95%; padding:0px 6px 0px 4px; height:35px; }

@media print
{
body * { visibility: hidden; }
#printcontent * { visibility: visible; }
#printcontent { position: absolute; top: 40px; left: 30px; }
#prnt { display:none; }
}
</style>
<?php
    $user_id = $this->session->userdata('id');
	$name = $this->session->userdata('name');
	
	$id = $this->input->post('user_id');
	
	if(($user_id=="") && ($id==""))
	{
		redirect('/');
	}

	$groups = $this->session->userdata('user_group');
    $depart = $this->session->userdata('department');
	
	$this->db->select("*");
    $this->db->from("group_master");
	$this->db->where('parent_group', $groups);
	$query = $this->db->get();
	//$record = $query->row();
	$arr = array();
	
	foreach($query->result() as $record)
	{
		$child = $record->id;
		$arr[] = $child;
	}
	
	$childgrp = implode(",",$arr);
	
	$this->db->select("*");
    $this->db->from("role_master");
    $this->db->where('sector', 'Personnel Training');
    $this->db->where_in('group_id', $groups);
    $query = $this->db->get();
    $row = $query->row();
	
    $role = $row->privilege;

	if(isset($_POST['btnSubmit']))
	{
	   $result = $this->db->query('select * from `user_master` where `id` = '. $id.'');
	   $name = $result->row();

	   $data = array('user_id' => $id , 'name' => $name->name);
	   $this->db->insert('personnel_training', $data);
	}
	
	if(isset($_POST['btnSave']))
	{
	   /*$this->db->select('*');
	   $this->db->from('personnel_training');
	   $this->db->where('user_id',$id);*/
	   
	   $sql = $this->db->query("select * from `personnel_training` where `user_id` = '".$id."'");
	   
	   foreach($sql->result() as $rec)
	   {
	     $data = array(
					'course' => $this->input->post('course'.$rec->id),
					'mandatory_opt' => $this->input->post('mandatory_opt'.$rec->id),
					'due_date' => $this->input->post('due_date'.$rec->id),
					'scheduled_date' => $this->input->post('scheduled_date'.$rec->id),
					'scheduled_time' => $this->input->post('scheduled_time'.$rec->id),
					'venue' => $this->input->post('venue'.$rec->id),
					'status' => $this->input->post('status'.$rec->id),
					'completion_date' => $this->input->post('completion_date'.$rec->id),
					'expiry_date' => $this->input->post('expiry_date'.$rec->id));
					
		 $this->db->where('id', $rec->id);	  
	     $this->db->where('user_id', $id);
		 
		 $update = $this->db->update('personnel_training',$data);
		// echo $this->db->last_query();
	   }
	}

    if(($role=='no') || ($role=='N'))
    {
?>
<div class="content-wrapper">
  <div class="row">
        <div class="col-sm-12 mb-4 mb-xl-0">
          <div class="card">
            <div class="card-body" align="center"><h5>PERSONNEL TRAINING</h5></div>
           </div> 
        </div>
      </div>
      
   <div class="row mt-3">
      
      <div class="col-sm-12 mb-4 mb-xl-0" style="height:445px;">
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
<style>
.table.table-header-bg th { font-weight:bold; color:#000; font-size:13.5px !important;}
</style>
<div class="content-wrapper" id="printcontent">
      <div class="row">
        <div class="col-sm-12 mb-4 mb-xl-0">
          <div class="card">
            <div class="card-body" align="center"><h5>PERSONNEL TRAINING</h5></div>
           </div> 
        </div>
      </div>
     
     
      <div class="row mt-3">
        <div class="col-xl-12 grid-margin-lg-0 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
            <p align="center" style="color:#F00;"><?php echo $this->session->flashdata('msg');?></p>
            <form name="frm" action="" method="post">
             <div class="row">
                  <div class="col-md-6">
                      <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">User</span>
                      </div>
                       <?php if(($role=='fc') || ($role=='rw') || ($depart=='Admin')) { ?>
                      <select name="user_id" class="form-control" style="height:45px;" onchange="javascript:document.frm.submit();">
                      <option value="<?=$user_id?>" <?php if($uId==$user_id){echo 'selected';}?>><?=$name?></option>
						  <?php
                             if($groups=='Administrator')
							 {
							   $query = $this->db->query('select * from `user_master` where user_group!="Administrator"');
							 }
							 else
							 {
                               $query = $this->db->query('select * from `user_master` where user_group in('.$childgrp.')');
							 }
							 
                             foreach ($query->result() as $row)
                             {
								 if($id!="")
								 {
                           ?>
                            <option value="<?=$row->id?>" <?php if($id==$row->id){echo 'selected';}?>>&nbsp;&nbsp;&nbsp;&nbsp;<?=$row->name?></option>
                          <?php
								 }
							  else
							  {
							?>
                            <option value="<?=$row->id?>" <?php if($user_id==$row->id){echo 'selected';}?>>&nbsp;&nbsp;&nbsp;&nbsp;<?=$row->name?></option>
                            <?php	  
							  }
                             }
                          ?>
                    </select>
                    <?php } else {?>
               <!--<input type="text" name="user_id" class="form-control" value="<?php //echo $name;?>" style="height:55px; background:#fff; padding-left:10px; border:1px solid #000;" disabled>-->
                 <span style="background:#fff; padding-left:10px; border:1px solid #ccc;" class="form-control">
				 <?php echo $name;?>
                 </span>
                    <?php }?>

                   </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row" id="prnt">
                      <div class="col-md-6">&nbsp;</div>
                      <div class="col-md-6" align="right">
                      
                      <?php 
						 if(($id!="") && ($id!=$user_id)) 
						 { 
							if(($role=='fc') || ($role=='rw'))
							{ 
						?>
						<button type="submit" name="btnSave" class="btn btn-success">Save</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" name="btnSubmit" class="btn btn-info">Add</button>&nbsp;&nbsp;&nbsp;&nbsp;
						<?php
							}
						  }
						 if($depart=='Admin') 
						  {
						?>
						<button type="submit" name="btnSave" class="btn btn-success btn-md">Save</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" name="btnSubmit" class="btn btn-info">Add</button>&nbsp;&nbsp;&nbsp;&nbsp;
						<?php 
						  }
						?>
                      
                      <a href="javascript: print();" class="btn btn-danger">Print</a>
                      </div>
                    </div>
                  </div>
             </div>
      <script language="javascript">
		function remove(id)
		{
			var x = window.confirm("Are you sure to delete?");
			if(x==true)
			{
				window.location.href='<?php echo base_url();?>dashboard/deletetraining/'+id;
				return false;
			}
			return true;
		}
		</script>      
             
            <div class="table-responsive mt-3">
                <table width="100%" class="table table-header-bg table-bordered">
                  <thead>
                    <tr align="center">
                      <th align="center">Training/Course/Certification</th>
                      <th align="center">Mandatory Optional</th>
                      <th align="center">Due Date</th>
                      <th align="center">Scheduled Date</th>
                      <th align="center">Time</th>
                      <th align="center">Venue</th>
                      <th align="center">Status</th>
                      <th align="center">Completion Date</th>
                      <th align="center">Expiry Date</th>
                      <?php if(($role=='fc') || ($role=='rw') || ($depart=='Admin')) { ?>
                      <th align="center">&nbsp;</th>
                      <?php }?>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php
					  if(($id!='')) 
					  {
						  $query = $this->db->query("select * from `personnel_training` where `user_id` = '".$id."'");
					  }
					  else
					  {
						  $query = $this->db->query("select * from `personnel_training` where `user_id` = '".$user_id."'");
					  }
					  //echo $this->db->last_query();
					  $num = $query->num_rows();
					  
					  if($num!='')
					  {
					   foreach($query->result() as $row)
					   {
						   
						   if(($role=='fc') || ($role=='rw') || ($depart=='Admin'))
							{ 
					?>
                    <tr>
                      <td>
                      <input type="text" name="course<?=$row->id?>" value="<?php echo $row->course;?>" rows="4">
                      </td>
                      <td>
                      <input type="text" name="mandatory_opt<?=$row->id?>" value="<?php echo $row->mandatory_opt;?>" rows="4">
                      </td>
                      <td>
                        <input name="due_date<?=$row->id?>" value="<?=$row->due_date?>" onfocus="(this.type='date')" placeholder=''
                         class="dtx"/>
                      </td>
                      <td>
                      <input name="scheduled_date<?=$row->id?>" value="<?=$row->scheduled_date?>" onfocus="(this.type='date')" placeholder='' class="dtx"/>
                      </td>
                      <td>
                      <input type="text" name="scheduled_time<?=$row->id?>" value="<?=$row->scheduled_time?>"/>
                      </td>
                      <td><input type="text" name="venue<?=$row->id?>" value="<?php echo $row->venue;?>" style="width:100px;"/></td>
                      <td><input type="text" name="status<?=$row->id?>" value="<?php echo $row->status;?>" style="width:100px;"/></td>
                      <td><input name="completion_date<?=$row->id?>" value="<?php echo $row->completion_date;?>" onfocus="(this.type='date')" placeholder=''  class="dtx"/></td>
                      <td><input name="expiry_date<?=$row->id?>" value="<?php echo $row->expiry_date;?>" onfocus="(this.type='date')" placeholder=''  class="dtx"></td>
                      <td>
                        <?php if(($id!="") && ($id!=$user_id)) {?>
                        <a href="javascript:remove(<?=$row->id;?>)">
                          <img src="<?php echo base_url();?>assets/images/remove.png" border="0" />
                        </a>
                        <?php }?>
                      </td>
                    </tr>
                    <?php
						 }
						else
						{
					  ?>
                      
                      <tr>
                      <td><?php echo $row->course;?></td>
                      <td><?php echo $row->mandatory_opt;?></td>
                      <td><?=$row->due_date?></td>
                      <td><?=$row->scheduled_date?></td>
                      <td><?=$row->scheduled_time?></td>
                      <td><?php echo $row->venue;?></td>
                      <td><?php echo $row->status;?></td>
                      <td><?php echo $row->completion_date;?></td>
                      <td><?php echo $row->expiry_date;?></td>
                    </tr>
                      
                      <?php
						}
					   } /// End Foreach
					  }
					  else
					  {
					?>
                    <tr><td colspan="10" align="center" height="55px">No Records Found.</td></tr>
                    <?php
					  }
					?>

                  </tbody>
                </table>
              </div>
              </form>
              
              
            </div>
          </div>
        </div>
        
      </div>
    </div>
     <?php } ?>