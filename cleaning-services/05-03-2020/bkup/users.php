<div class="content-wrapper">
<div class="row">
    <div class="col-md-10">&nbsp;</div>
    <div class="col-sm-2" align="right">
        <!--<a href="<?php //echo base_url();?>download/excel">
          <img src="<?php //echo base_url();?>assets/images/excel.png" border="0"/>
        </a>-->
        <a href="<?php echo base_url();?>dashboard/adduser" class="btn btn-success btn-md">Add New</a>
    </div>
</div>
<script language="javascript">
function remove(id)
{
	var x = window.confirm("Are you sure to delete?");
	if(x==true)
	{
		window.location.href='<?php echo base_url();?>dashboard/deleteUser/'+id;
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
              <th width="10%">Photo</th>
              <th width="24%">Name</th>
              <th width="17%">Email</th>
              <th width="39%">Assigned Groups</th>
              <th width="10%">Action</th>
            </tr>
          </thead>
          <tbody>
           <?php
             $query = $this->db->query("select * from `user_master` where `name`!='Admin' order by name asc");
			 foreach ($query->result() as $row)
			 {
		    ?>
            <tr>
              <td class="py-1">
                <?php if($row->photo!="") {?>
                <img src="<?php echo base_url();?>uploads/<?=$row->photo;?>" alt="image" width="50" height="50"/>
                <?php } else {?>
                <img src="<?php echo base_url();?>assets/images/avatar.png" alt="image" width="50" height="50"/>
                <?php }?>
              </td>
              <td><?=$row->name;?></td>
              <td><?=$row->email;?></td>
              <td><?=$row->phone;?></td>
              <td align="left">
                <a href="<?php echo base_url();?>dashboard/edituser/<?=$row->id;?>"><i class="fa fa-edit"></i></a> &nbsp; &nbsp;
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

