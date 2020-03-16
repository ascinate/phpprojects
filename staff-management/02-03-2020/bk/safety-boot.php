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

td input[type=text]{ border:none!important; font-weight:normal!important; width:100%; padding:0px 2px 0px 2px; height:35px;}
td input[type=date]{ border:none!important; font-weight:normal!important; text-transform:uppercase; width:100%; padding:0px 5px 0px 2px; height:35px; }

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
	$term = $this->session->userdata('term');
	$hired = $this->session->userdata('hired_date');

 	$id = $this->input->post('user_id');
	
	if(($user_id=="") && ($id==""))
	{
		redirect('/');
	}
	
	/*if($user_id!="") { $id = $this->session->userdata('id');}
	else { $id = $this->input->post('user_id'); }*/

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
    $this->db->where('sector', 'Boots Allowance');
    $this->db->where_in('group_id', $groups);
    $query = $this->db->get();
    $row = $query->row();
	
    $role = $row->privilege;
   
    $year = $this->input->post('year');
	if($this->input->post('year')) { $year = $this->input->post('year'); } else { $year = 2020; }

	if($year!="") { $yr = $year; } else { $yr = date('Y'); }
	/////////////// Specific ID
    if($id!="") { $uId = $id;  } else { $uId = $user_id; }
  
    //////////////// 
    if(($role=='fc') || ($role=='rw') || ($depart=='Admin')) 
	{
      $query = $this->db->query("select * from `user_master` where `id`= '".$uId."'");
	}
	else
	{
	  $query = $this->db->query("select * from `user_master` where `id`= '".$uId."'");	
	}
    $rec = $query->row();
	
	///////////////
	if(($role=='fc') || ($role=='rw') || ($depart=='Admin')) {
	$sum = $this->db->query("select sum(amount) as tot from `safety_boots` where `user_id`= '".$uId."' and `year` = '".$yr."'");
	}
	else
	{
	$sum = $this->db->query("select sum(amount) as tot from `safety_boots` where `user_id`= '".$uId."' and `year` = '".$yr."'");
	}
	$tamt = $sum->row()->tot;
	
	////////////////////
	if(($role=='fc') || ($role=='rw') || ($depart=='Admin')) {
	$tot = $this->db->query("select sum(paid_amount) as amt from `safety_boots` where `user_id`= '".$uId."' and `year` = '".$yr."'");
	}
	else
	{
	$tot = $this->db->query("select sum(paid_amount) as amt from `safety_boots` where `user_id`= '".$uId."' and `year` = '".$yr."'");
	}
    $samt = $tot->row()->amt;
	
	$sql2 = $this->db->query("select * from `boot_points` where `user_id` = '".$uId."' and `year` = '".$yr."'");
	$qry2 = $sql2->row();
	
	$bot = $this->db->query("select carried_points from `boot_points` where `user_id` = '".$uId."' and `year` = '".($yr - 1)."'");
	$record = $bot->row();

	if(isset($_POST['btnSave']))
	{
	  $sql = $this->db->query("select * from `safety_boots` where `user_id` = '".$id."' and `year` = '".$yr."'");
	  $carried_points = $this->input->post('carried_points');

	  foreach($sql->result() as $val)
	  {
	   // echo 'purchase_date'.$val;
		
	    $data = array(
			  'purchase_date' => $this->input->post('purchase_date'.$val->id),
			  'item' => $this->input->post('item'.$val->id),
			  'amount' => $this->input->post('amount'.$val->id),
			  'remarks' => $this->input->post('remarks'.$val->id),
			  'item' => $this->input->post('item'.$val->id)
			  ); 

		$this->db->where('id', $val->id);	  
	    $this->db->where('user_id', $id);
		$this->db->where('year', $yr);
		$update = $this->db->update('safety_boots',$data);
		
		/*if($update)
		{
		      $arr = array('carried_points' => $this->input->post('carried_points'),
							'available_amt' => $this->input->post('available_amt'),
							'paid_amt' => $this->input->post('paid_amt'));
				  
			  $this->db->where('user_id', $id);
			  $this->db->where('year', $yr);
			  $this->db->update('boot_points',$arr);
			  
			 // echo $this->db->last_query();
			  
			  redirect("dashboard/safety_boot");
		}*/
		//echo $this->db->last_query();
	  }
	  
	  if($update)
	  {
		   if($term=='Permanent') { $tamount = 150; }
		   if($term=='Term') { $tamount = 150;}
		   if($term=='Seasonal(R)') { $tamount = 75;}
		   if($term=='Seasonal(S)') { $tamount = 75;}
		   
		   if($record->carried_points == "" && $yr!=2019)
		   {
			  $carried_points = $qry2->available_amt;
		   }
		   else if($record->carried_points==0)
		   {
			  $carried = 0;
		   }
		   else
		   {
			   $carried_points = $record->carried_points;
		   }
		   
		   $crpoints = ($carried_points + $qry2->available_amt) - $this->input->post('paid_amt');
		  
		   if($crpoints > $qry2->available_amt)
		   {
			 $cpoints = $qry2->available_amt;  
		   }
		   else
		   {
			  $cpoints = $crpoints;
		   }
		  
		  $arr = array( 'carried_points' => $cpoints,
						'available_amt' => $this->input->post('available_amt'),
						'paid_amt' => $this->input->post('paid_amt'));
		 
		  $this->db->where('year', $yr);	  
		  $this->db->where('user_id', $id);
		  $this->db->update('boot_points',$arr);
		  
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
            <div class="card-body" align="center"><h5>SAFETY BOOT ALLOWANCE</h5></div>
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
<div class="content-wrapper" id="printcontent">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<!-- inject:css -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">

      <div class="row">
        <div class="col-sm-12 mb-4 mb-xl-0">
          <div class="card">
            <div class="card-body" align="center"><h5>SAFETY BOOT ALLOWANCE</h5></div>
           </div> 
        </div>
      </div>
      
      <form name="frm" action="" method="post">
      <input type="hidden" value="<?=$id?>" name="id" />
      <div class="row mt-3"  id="prnt">
        <div class="col-md-8">&nbsp;</div>
        <div class="col-md-4" align="right">
         
          <?php 
		     if(($id!="") && ($id!=$user_id)) 
			 { 
			    if(($role=='fc') || ($role=='rw'))
				{ 
			?>
            <button type="submit" name="btnSave" class="btn btn-success btn-md">Save</button>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php
		        }
		      }
		     if($depart=='Admin') 
			  {
			?>
            <button type="submit" name="btnSave" class="btn btn-success btn-md">Save</button>&nbsp;&nbsp;&nbsp;&nbsp;
			<?php 
			  }
			?>
        
            <a href="javascript: print();" class="btn btn-danger btn-md">Print</a>
        </div>
      </div>
      
      <div class="row mt-3" id="prc">
        <div class="col-xl-12 grid-margin-lg-0 grid-margin stretch-card">
          <div class="card">
           <div class="card-body topbg">
            
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
							   $query = $this->db->query('select * from `user_master` where user_group!="Administrator" ORDER BY `name` ASC');
							 }
							 else
							 {
                               $query = $this->db->query('select * from `user_master` where user_group in('.$childgrp.') ORDER BY `name` ASC');
							 }
                             foreach ($query->result() as $row)
                             {
                           ?>
                          <option value="<?=$row->id?>" <?php if($uId==$row->id){echo 'selected';}?>>&nbsp;&nbsp;&nbsp;&nbsp;<?=$row->name?></option>
                          <?php
                             }
                          ?>
                     </select>
                     <?php } else {?>
                      <input type="text" name="user_id" class="form-control" value="<?php echo $name;?>" style="background:#fff;" disabled>
                     <?php }?>
                   </div>
                  </div>
                  
                 <div class="col-md-6">
                      <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">Select Year</span>
                      </div>
                      <select name="year" class="form-control" style="font-size:0.975rem;" onchange="javascript:document.frm.submit();">
                        <?php  for($i=2019; $i<=2030; $i++) { ?>
                          <option value="<?=$i?>" <?php if($year==$i){echo 'selected';}?>><?=$i?></option>
                         <?php } ?>
                      </select>
                   </div>
                  </div>
             </div>
             
             <div class="row">
                  <div class="col-md-6">
                      <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">Term</span>
                      </div>
                      <input type="text" class="form-control" value="<?php echo $rec->term;?>" style="background:#fff;" disabled>
                   </div>
                  </div>
                  
                 <div class="col-md-6">
                      <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">Hired Date</span>
                      </div>
                      <?php if(($role=='fc') || ($role=='rw') || ($depart=='Admin')){ ?>
                      <input type="date" class="form-control" value="<?php echo $rec->hired_date;?>" style="text-transform:uppercase;">
                      <?php } else { ?>
                      <input type="date" class="form-control" value="<?php echo $rec->hired_date;?>" style="background:#fff;" disabled>
                      <?php }?>
                   </div>
                  </div>
             </div>
             
             <div class="row">
                  <div class="col-md-6">
                      <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">Carried Over Amount</span>
                      </div>
                      <?php 
					     $sql = $this->db->get_where('boot_points', array('user_id' => $uId, 'year' => ($yr-1)));
						 $records = $sql->row();
						 
						  /*if($yr==2020)
						  {
						     $carr_point = $records->carried_points;
						  }
						  if($yr==2019)
						  {
							 $carr_point = '0.00';
						  }
						  if($yr!=2019 &&  $yr!=date('Y'))
						  {
						     $carr_point = $records->available_amt;
						  }*/
						  
						  if($yr==2019)
						  {
							  $carr_point = '0.00';
						  }
						  else if($records->carried_points=="")
						  {
							  $carr_point = $qry2->available_amt;
						  }
						  else
						  {
							  $carr_point = $records->carried_points;
						  }
						  
						  /*else
						  {
							 $carr_point = '0.00';
						  }*/

					     if(($role=='fc') || ($role=='rw') || ($depart=='Admin'))
						 { 
					  ?>
                      <input type="text" name="carried_points" class="form-control" value="<?=$carr_point?>" style="text-align:right;">
                      <?php } else { ?>
                      <input type="text" name="carried_points" class="form-control" value="<?=$carr_point?>"
                       style="text-align:right; background:#fff;" readonly>
                      <?php }?>
                   </div>
                  </div>
                 
                 <div class="col-md-6">
                      <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">Available Amount for Current Year</span>
                      </div>
                       <input type="text" name="available_amt" class="form-control" value="<?=$qry2->available_amt?>" style="text-align:right;">
                   </div>
                </div> 
             </div>
            </div>
             
             <div class="card-body"> 
              <div class="table-responsive mt-3">
              <?php
				  if($id!="") { $uId = $id;  } else { $uId = $user_id; }
				   
				  if($year!='')
				  {
				   $sql = $this->db->query("select * from `safety_boots` where `user_id`= '".$uId."' and `year` = '".$year."'");
				  }
				  else
				  {
				   $sql = $this->db->query("select * from `safety_boots` where `user_id`= '".$uId."' and `year` = '".$yr."'");
				  }
				  
				  $numrow = $sql->num_rows();
				  
				  if($numrow!=0)
				  {
			  ?>
                <table class="table table-header-bg table-bordered">
                
                  <thead>
                     <tr>
                      <td colspan="3" align="center" height="45px"><strong>Purchase History</strong></th>
                      <td rowspan="2" valign="middle" align="center"><strong>Remarks</strong></th>
                    </tr>
                    
                    <tr>
                      <td width="17%" height="55px" align="center"><strong>Date</strong></th>
                      <td width="33%" height="55px" align="center"><strong>Item</strong></th>
                      <td width="12%" height="55px" align="center"><strong>Amount</strong></th>
                    </tr>
                  </thead>
                  
                  <tbody>
                   <?php

					   foreach($sql->result() as $value)
					   {
						   if(($role=='fc') || ($role=='rw') || ($depart=='Admin'))
							{
				    ?>

                    <tr>
                      <td>
                      <input value="<?=$value->purchase_date?>" name="purchase_date<?=$value->id?>"  onfocus="(this.type='date')"
                       class="dtx" style="text-align:center;"/>
                      </td>
                      <td>
					   <input type="text" value="<?php echo $value->item;?>" name="item<?=$value->id?>"/>
                      </td>
                      <td align="right"><input type="text" value="<?php echo $value->amount;?>" name="amount<?=$value->id?>" style="text-align:center;"/></td>
                      <td><input type="text" value="<?php echo $value->remarks;?>" name="remarks<?=$value->id?>"/></td>
                    </tr>
                    
                   <?php
						 }
						else
						{
					?>
                    <tr>
                      <td><?=$value->purchase_date?></td>
                      <td><?php echo $value->item;?></td>
                      <td align="center"><?php echo $value->amount;?></td>
                      <td><?php echo $value->remarks;?></td>
                    </tr>
                    <?php
						}
					   } /// End Foreach
					
					 if($numrow!="") 
					 {
				    ?> 
                    <tr>
                      <td align="right" colspan="2" height="55" style="font-size:18px; font-weight:bold; background:#e4e6f6;">Total Purchase Amount</td>
                      <td width="12%" align="right" height="55" style="font-size:18px; font-weight:bold; background:#e4e6f6;">
                       <?php
					     $sumamt = $this->db->query("select sum(amount) as tot from `safety_boots` 
												 where `user_id`= '".$uId."' and `year` = '".$yr."'");
						 $totamt = $sumamt->row()->tot;
						 echo '<strong> '.$totamt.'</strong>';
					   ?>
                      </td>
                      <td width="38%" rowspan="2" height="55" align="left" style="background:#CDCDCD;">
                      <?php
					    $points = $this->db->query("select * from `boot_points` where 
												 `user_id` = '".$uId."' and 
												 `year` = '".$yr."'");
												 
						$qryboot = $points->row();
					  ?>
                      Amount Paid: <input type="text" name="paid_amt" class="safety-txt" value="<?=$qryboot->paid_amt?>" style="background:#CDCDCD;" required> 
                      </td>
                  </tr>
                  
                   <tr>
                      <td width="50%" colspan="2" align="right" height="55" style="font-size:18px; font-weight:bold; background:#fdd889;">Balance</td>
                      <td align="right" style="font-size:18px; font-weight:bold; background:#fdd889;">
					    <?php echo (($qryboot->available_amt+$carr_point) - $qryboot->paid_amt);?>
                      </td>
                    </tr>
                    <?php
					 }
					 ?>
                    </tbody>
                </table>
                <?php 
				  }
				?>
                
              </div>
              
            </div>
          </div>
        </div>
      </div>
      </form>
      
    </div>
    <?php } ?>