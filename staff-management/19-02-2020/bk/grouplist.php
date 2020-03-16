<div class="content-wrapper">

<div class="row">
    <div class="col-md-10">&nbsp;</div>
    <div class="col-sm-2" align="right">
        <!--<a href="<?php //echo base_url();?>download/groupexcel" style="text-decoration:none;">
          <img src="<?php //echo base_url();?>assets/images/excel.png" border="0"/>
        </a>-->
        <a href="<?php echo base_url();?>dashboard/addgroup" class="btn btn-success btn-md">Add New</a>
    </div>
</div>
<script language="javascript">
function remove(id)
{
	var x = window.confirm("Are you sure to delete?");
	if(x==true)
	{
		window.location.href='<?php echo base_url();?>dashboard/deleteGroup/'+id;
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
                <th width="46%">Group name</th>
                <th width="45%" align="left">Parent Group</th>
                <th width="9%">Action</th>
              </tr>
            </thead>
            <tbody>
            
             <?php
              $query = $this->db->query("select * from `group_master`");
			  $numrow = $query->num_rows();
			  
			  if($numrow!="")
			  {
			    foreach ($query->result() as $row)
			    {
		     ?>
              <tr>
                <td><?=$row->group_title;?></td>
                <td>
                   <?php
				     $g_id = $row->parent_group;
					
					 if($g_id)
					 {
						 $this->db->where('id', $row->parent_group);
						 $query = $this->db->get('group_master');
						 
						 $record = $query->row();
						 echo $record->group_title;
					 }
				   ?>
                </td>
                <td>
                  <a href="<?php echo base_url();?>dashboard/editgroup/<?=$row->id;?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;  
                  <a href="javascript:remove(<?=$row->id;?>)"><i class="fa fa-trash" aria-hidden="true"></i></a> 
                </td>
              </tr>
              <?php
                 }
				}
				else
				{
			  ?>
              <tr><td colspan="3" align="center"> No Records Found! </td></tr>
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