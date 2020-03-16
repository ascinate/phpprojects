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
td div input[type=text]{ border:none!important; font-weight:bold!important; width:100%; padding:0px 2px 0px 2px; height:35px;}
td input[type=date]{ border:none!important; font-weight:normal!important; text-transform:uppercase; width:90%; padding:0px 5px 0px 2px; height:35px; }

@media print
{
body * { visibility: hidden; }
#printcontent * { visibility: visible; }
#printcontent { position: absolute; top: 40px; left: 30px; }
#prnt { display:none; }
}
</style>
<?php
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
    $this->db->where('sector', 'Safety Awards');
    $this->db->where_in('group_id', $groups);
    $query = $this->db->get();
    $row = $query->row();

    $role = $row->privilege;
	
	$user_id = $this->session->userdata('id');
	$name = $this->session->userdata('name');
	$term = $this->session->userdata('term');
	$hired = $this->session->userdata('hired_date');
   
    $id = $this->input->post('user_id');
    $year = $this->input->post('year');
	
	if($this->input->post('year')) { $year = $this->input->post('year'); } else { $year = 2020; }
	
	if(($user_id=="") && ($id==""))
	{
		redirect('/');
	}
	
	/*if($user_id!="") { $id = $this->session->userdata('id');}
	else { $id = $this->input->post('user_id'); }*/

	if($year!="") { $yr = $year; } else { $yr = date('Y'); }
	
   /////////////// Specific ID
    if($id!="") { $uId = $id;  } else { $uId = $user_id; }
	
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
	
	$sum = $this->db->query("select sum(point_earn) as tot from `safety_awards` where 
							`user_id`= '".$uId."' and `year` = '".$yr."'");
	}
	else
	{
	$sum = $this->db->query("select sum(point_earn) as tot from `safety_awards` where 
							`user_id`= '".$uId."' and `year` = '".$yr."'");
	}
	$tamt = $sum->row()->tot;
	
	
	////////////////////
	if(($role=='fc') || ($role=='rw') || ($depart=='Admin')) {
		
	$tot = $this->db->query("select sum(point_deduct) as amt from `safety_awards` 
							where `user_id`= '".$uId."' and `year` = '".$yr."'");
	}
	else
	{
	 $tot = $this->db->query("select sum(point_deduct) as amt from `safety_awards` 
							where `user_id`= '".$uId."' and `year` = '".$yr."'");
	}
    $samt = $tot->row()->amt;
	
	//////////////////////
	if(($role=='fc') || ($role=='rw') || ($depart=='Admin')) {
	
	$point = $this->db->query("select sum(point_used) as pmt from `safety_awards` 
							 where `user_id`= '".$uId."' and `year` = '".$yr."'");
	}
	else
	{
	$point = $this->db->query("select sum(point_used) as pmt from `safety_awards` 
							 where `user_id`= '".$uId."' and `year` = '".$yr."'");	
	}
	$pamt = $point->row()->pmt;
	
	if($yr!='2019') {
	$this->db->select("*");
	$this->db->from("safety_award_points");
	$this->db->where('user_id', $uId);
	$this->db->where('year', $yr);
	$res = $this->db->get();
	$rx = $res->row();
	}
	
	if(isset($_POST['btnSave']))
	{
	  //print_r($_POST); exit();
	   for($m=1; $m<=12; ++$m)
	   {
		   $month = date('F', mktime(0, 0, 0, $m, 1));
		 
			$data = array(
					'point_earn' => $this->input->post('point_earn'.$month),
					'point_deduct' => $this->input->post('point_deduct'.$month),
					'deduction_reason' => $this->input->post('deduction_reason'.$month),
					'point_used' => $this->input->post('point_used'.$month),
					'used_date' => $this->input->post('used_date'.$month),
					'point_used_for' => $this->input->post('point_used_for'.$month),
			); 
			
			$this->db->where('user_id', $id);
			$this->db->where('month', $month);
			$this->db->where('year', $yr);
			$update = $this->db->update('safety_awards',$data);
			
			/*if($update)
			{
			  $arr = array('carried_points' => $this->input->post('carried_points'));
			  
			  $this->db->where('user_id', $id);
			  $this->db->where('year', $yr);
			  $this->db->update('safety_award_points',$arr);
			  
			  redirect("dashboard/safety_awards");
			}*/
	     }
		  
     	 if($update)
	      {
			  $sum = $this->db->query("select sum(point_earn) as tot, 
			  						   sum(point_deduct) as amt, 
									   sum(point_used) as pmt from `safety_awards` 
									   where `user_id`= '".$uId."' and `year` = '".$yr."'");
									   
			  $tamt = $sum->row()->tot;
			  $samt = $sum->row()->amt;
			  $pamt = $sum->row()->pmt;
			  
			  //$record = $tamt - ($samt + $pamt);
			  if($yr!=2019 && $yr!=2020)
			  {
				  /*$carr = $this->db->query("SELECT SUM(`point_earn`) as total, 
				  							SUM(`point_deduct`) as deduct,
											SUM(`point_used`) as used
				                            FROM `safety_awards` WHERE 
									        `user_id` = '".$uId."' and `year` IN(".($yr - 1).",".($yr - 2).")");
											
				  $carr = $this->db->query("select * from `safety_award_points` WHERE 
									        `user_id` = '".$uId."' and `year` = ".($yr - 1)."");
									
				  $earn = $carr->row()->total;
				  $deduct = $carr->row()->deduct;
				  $used = $carr->row()->used;
				 
				  $result = $earn - ($deduct + $used);*/
				  
				  $result = $rx->carried_points;
				  
				  if($result >= 360)
				  {
					  $carr_points = 360;   
				  }
				  else
				  {
					  $carr_points = $result;
				  }
				  
				  $sumbal = (($tamt+$carr_points) - ($samt+$pamt));
				  //$balance = (($tamt+$carr_points) - ($samt+$pamt));
				  
				  if($sumbal>= 360) { $balance = 360; } else { $balance = $sumbal; }
			  }
			  else
			  {
				//echo '2019/20';
				 $sumbal = (($tamt+$rx->carried_points) - ($samt+$pamt));
				 if($sumbal>= 360) { $balance = 360; } else { $balance = $sumbal; }
			  }
						  
			  //$balance = (($tamt+$rx->carried_points) - ($samt+$pamt));
			  
			 /* if($balance >= 360)
			  {
			    $bal = 360;
			  }
			  else
			  {
			    $bal = $balance;
			  }*/
			  
			  $arr = array('carried_points' => $balance, 
			  			   'total_points' => $tamt, 
						   'balance' => $balance,
						   'total_deducted' => $samt,
						   'total_used' => $pamt );
			  
			  $this->db->where('year', $yr);  
			  $this->db->where('user_id', $id);
			  $this->db->update('safety_award_points',$arr); 
		  }
	}
	
    if(($role=='no') || ($role=='N'))
    {
?>
<div class="content-wrapper">

<div class="row">
    <div class="col-sm-12 mb-4 mb-xl-0">
      <div class="card">
        <div class="card-body" align="center"><h5>SAFETY AWARDS</h5></div>
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
      
      <div class="row">
        <div class="col-sm-12 mb-4 mb-xl-0">
          <div class="card">
            <div class="card-body" align="center"><h5>SAFETY AWARDS</h5></div>
           </div> 
        </div>
      </div>
     <!--<script language="javascript">
	    function addData()
		{
		   var x = confirm('Are you want to switch the data!');
		   
		   if(x)
		   {
		     /*document.frm.mode.value="add";	*/
		     document.frm.submit();
			 return false;
		   }
		   return true;
		}
	  </script>-->
      <form name="frm" action="" method="post">
      <input type="hidden" name="mode" value="add" />
      <input type="hidden" value="<?=$id?>" name="id" />
      <div class="row mt-3" id="prnt">
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
            <a href="javascript:print();" class="btn btn-danger btn-md">Print</a>
        </div>
      </div>
      
      <div class="row mt-3">
        <div class="col-xl-12 grid-margin-lg-0 grid-margin stretch-card">
          <div class="card">
            <div class="card-body topbg">
            
             <div class="row">
                  <div class="col-md-6">
                      
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">User</span>
                      </div>
                      <?php 
					      if(($role=='fc') || ($role=='rw') || ($depart=='Admin')) 
						  { 
					  ?>
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
                    <?php 
					   }
					  else 
					  {
				     ?>
                      <input type="text" name="user_id" class="form-control" value="<?php echo $name;?>" style="background:#fff;" disabled>
                    <?php 
					   }
					?>
                   </div>
                      
                  </div>
                  
                 <div class="col-md-6">

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">Select Year</span>
                      </div>
                     <select name="year" class="form-control" style="font-size:0.975rem;" onchange="javascript:document.frm.submit();">
                      <?php
                       for($i=2019; $i<=2030; $i++)
			           {
					   ?>
                        <option value="<?=$i?>" <?php if($year==$i){echo 'selected';}?>><?=$i?></option>
                      <?php
					    }
					   ?>
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
                    <input type="date" class="form-control" value="<?php echo $rec->hired_date;?>" style="text-transform:uppercase; background:#fff;" disabled>
                       <?php }?>
                   </div>
                 </div>
             </div>
             
             <?php
			     /*$carr = $this->db->query("SELECT SUM(`point_earn`) as total, 
				  							SUM(`point_deduct`) as deduct,
											SUM(`point_used`) as used
				                            FROM `safety_awards` WHERE 
									        `user_id` = '".$uId."' and `year` IN(".($yr - 1).",".($yr - 2).")");
				  $cnt = $carr->num_rows();

				  if($cnt!=0)
				  {					
					  $earn = $carr->row()->total;
					  $deduct = $carr->row()->deduct;
					  $used = $carr->row()->used;
					  
					  $result = $earn - ($deduct + $used);
				  }*/
				  
				  $carr_p = $this->db->query("select * from `safety_award_points` WHERE 
									         `user_id` = '".$uId."' and `year` = ".($yr - 1)."");
				  $cnt = $carr_p->num_rows();
				 
				  if($cnt!=0)
				  {
					 $result = $carr_p->row()->carried_points;
				  }
			 ?>
             <div class="row">
                  <div class="col-md-6">

                      <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">Carried Over Points</span>
                      </div>
                      
                      <?php if(($role=='fc') || ($role=='rw') || ($depart=='Admin')){ ?>
                       <input type="text" name="carried_points" class="form-control" value="<?php echo $result;?>" style="text-align:right;">
                       <?php } else { ?>
                       <input type="text" name="carried_points" class="form-control" value="<?php echo $result;?>" style="text-align:right; background:#fff;" readonly>
                       <?php }?>
                   </div>
                      
                  </div>
                  
                  <div class="col-md-6">

                      <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">Balance</span>
                      </div>
                        <input type="text" name="current_year_points" class="form-control" value="<?php echo (($tamt+$result) - ($samt+$pamt));?>" 
                        style="text-align:right; background:#fff;" readonly>
                   </div>
                      
                  </div>
             </div>
        </div> 
            
            <div class="card-body"> 
              <div class="table-responsive mt-3">
                <table width="100%" class="table table-header-bg table-bordered">
                  <thead>
                    <tr>
                      <th class="thdx" width="10%">Month</th>
                      <th class="thdx" width="10%">Points Earned</th>
                      <th class="thdx" width="10%">Points Deducted</th>
                      <th class="thdx" width="30%">Points Deduction Reason</th>
                      <th class="thdx" width="10%">Points Used</th>
                      <th class="thdx" width="10%">Date</th>
                      <th class="thdx" width="20%">Points Used For</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                    <?php
					  if($id!="") { $uId = $id;  } else { $uId = $user_id; }
					  
					  if($year!='')
					  {
                       $sql = $this->db->query("select * from `safety_awards` where `user_id`= '".$uId."' and `year` = '".$yr."'");
					  }
					  else
					  {
					   $sql = $this->db->query("select * from `safety_awards` where `user_id`= '".$uId."' and `year` = '".$yr."'");
					  }
					  //echo $this->db->last_query();
					  
					  $numrow = $sql->num_rows();
					  
					  if($numrow)
					  {
					   foreach($sql->result() as $value)
					   {
						   /*if($value->used_date!="")
						   {
							 $ex = explode("-",$value->used_date); $mk = mktime(12,0,0, $ex[1],$ex[2],$ex[0]); $edate = date('M j, Y',$mk);
						   }*/
					   
					    if(($role=='fc') || ($role=='rw') || ($depart=='Admin'))
						{
					 ?>
                <tr>
				 <td>
                   <input type="text" value="<?php echo $value->month;?>" name="month" style="text-align:center;" readonly/>
                 </td>
				 <td align="right">
                 <input type="text" value="<?php echo $value->point_earn;?>" name="point_earn<?php echo $value->month;?>" style="text-align:right;"/>
                 </td>
				 <td align="right">
                 <input type="text" value="<?php echo $value->point_deduct;?>" name="point_deduct<?=$value->month;?>" style="text-align:right;"/>
                 </td>
				 <td><input type="text" value="<?php echo $value->deduction_reason;?>" name="deduction_reason<?=$value->month;?>"/></td>
				 <td align="right">
                 <input type="text" value="<?php echo $value->point_used;?>" name="point_used<?=$value->month;?>" style="text-align:right;" />
                 </td>
			 <td><input onfocus="(this.type='date')" placeholder='' class="dtx"  value="<?=$value->used_date?>" name="used_date<?=$value->month;?>" style="text-align:center;" /></td>
                 <td><input type="text" value="<?php echo $value->point_used_for;?>" name="point_used_for<?=$value->month;?>" /></td>
				</tr>
					<?php
					  }
					  else
					  {
					 ?>
                      <tr>
                         <td><?php echo $value->month;?></td>
                         <td align="right">
                           <input type="text" value="<?php echo $value->point_earn;?>" style="text-align:right;" readonly/>
                         </td>
                         <td align="right">
                           <input type="text" value="<?php echo $value->point_deduct;?>" style="text-align:right;" readonly/>
                         </td>
                         <td><?php echo $value->deduction_reason;?></td>
                         <td align="right"><?php echo $value->point_used;?></td>
                         <td><?=$value->used_date?></td>
                         <td><?php echo $value->point_used_for;?></td>
                     </tr>
                     <?php
						  }
					    }  /// End Foreach
					  }
					  else
					  {
					 ?>
                     <tr><td colspan="7" align="center" height="55px">No Records Found.</td></tr>
                     <?php 
					  }
					  if($numrow)
					  {
						  $sum = $this->db->query("select sum(point_earn) as tot from `safety_awards` 
						  				where `user_id`= '".$uId."' and `year` = '".$yr."'");
							
						  $tot = $this->db->query("select sum(point_deduct) as amt from `safety_awards` 
										where `user_id`= '".$uId."' and `year` = '".$yr."'");
							
						  $point = $this->db->query("select sum(point_used) as pmt from `safety_awards` 
							 	        where `user_id`= '".$uId."' and `year` = '".$yr."'");
					  ?>

                     <tr>
                      <td class="tdbg">Total</td>
                      <td align="right">
                      <div>
                      <input type="text" value="<?php echo $tamt = $sum->row()->tot;?>" name="total" style="text-align:right;"/>
                      </div>
                      </td>
                      <td align="right">
                      <div>
                       <input type="text" value="<?php echo $samt = $tot->row()->amt;?>" name="total_point_deducted" style="text-align:right;"/>
                      </div>
                      </td>
                      <td>&nbsp;</td>
                      <td align="right">
                      <div>
                      <input type="text" value="<?php echo $pamt = $point->row()->pmt;?>" name="point_used" style="text-align:right;"/>
                      </div>
                      </td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    
                    <tr>
                      <td class="tdbg">Balance</td>
                      <td align="right">
                      <div>
                       <input type="text" value="<?php echo (($tamt+$result) - ($samt+$pamt));?>" name="balance" style="text-align:right;"/>
                       </div>
                      </td>
                      <td>&nbsp;</td>
                      <td colspan="4" align="right">
                        <!--<input type="submit" class="btn btn-success" value="Save" />&nbsp;
                        <input type="button" class="btn btn-danger" value="Print" />-->
                      </td>
                    </tr>
                    <?php
					  }
					 ?>
                  </tbody>
                </table>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      </form>
    </div>
    <?php
    }
   ?>
   
