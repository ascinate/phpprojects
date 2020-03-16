<div class="content-wrapper">
<div class="row">
    <div class="col-md-10">&nbsp;</div>
    <div class="col-sm-2" align="right">
        <a href="<?php echo base_url();?>dashboard/addschedule" class="btn btn-success btn-md">Add New</a>
    </div>
</div>
<script language="javascript">
function remove(id)
{
	var x = window.confirm("Are you sure to delete?");
	if(x==true)
	{
		window.location.href='<?php echo base_url();?>dashboard/deleteSchedule/'+id;
		return false;
	}
	return true;
}
</script>
<div class="row mt-3">
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
    <p align="center" style="color:#F00;"><?php echo $this->session->flashdata('msg');?></p>
      <div class="table-responsive">
        <table width="100%" class="table table-striped table-hover" id="example">
          <thead>
            <tr>
              <th width="10%">Serial</th>
              <th width="24%">Name</th>
              <th width="17%">Hours</th>
              <th width="17%">Appointment</th>
              <th width="17%">Days</th>
              <th width="39%">Home</th>
              <th width="10%">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
               $query = $this->db->query("select * from `schedule_master`");
               
               $i=1;
        			 foreach ($query->result() as $row)
        			 {
                 $qry = $this->db->get_where('user_master', array('id' => $row->customer_id));
                 $rec = $qry->row();
  		      ?>
            <tr>
              <td class="py-1"><?php echo $i++;?></td>
              <td><?=$rec->name;?></td>
              <td><?=$row->cleaning_charge;?></td>
              <td><?=$row->frequency_appointment;?></td>
              <td><?=$row->required_days;?></td>
              <td>
                <a href="<?php echo base_url();?>dashboard/details/<?=$row->id;?>">
                  <i class="fa fa-home" style="font-size:22px;"></i>
                </a>
              </td>
              <td align="left">
                <a href="<?php echo base_url();?>dashboard/editschedule/<?=$row->id;?>/<?=$row->customer_id;?>/<?=$row->home_id;?>"><i class="fa fa-edit"></i></a>
                 &nbsp;&nbsp;
                <a href="javascript:remove(<?=$row->id;?>)"><i class="fa fa-trash" aria-hidden="true"></i></a>
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


</div>

