<style>
input[type=text], input[type=email], select, input[type=date]
{
	font-weight: normal!important;
    color: #000 !important;
    font-size: 0.875rem;
}
</style>

<div class="content-wrapper">
	 <?php
 		 foreach($details as $detail)
		  {
	  ?>
      <form action="<?php echo base_url();?>dashboard/updateHome" method="post" class="forms-sample">
      <input type="hidden" name="id" value="<?php echo $this->uri->segment(3);?>">
       <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">HOME INFORMATION <hr /></h4>
                        
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="exampleInputName1">Customer</label>
                            <select name="customer_id" class="form-control" disabled> 
                            <?php 
                              $query = $this->db->query("select * from `user_master` where `name`!='Admin' order by name asc");
                              foreach ($query->result() as $row)
                              {
                            ?>
                                <option value="<?=$row->id;?>"<? if($detail->customer_id==$row->id){ echo 'selected';}?>>
                                	<?=$row->name;?>
                            	</option>
                            <?php 
                               }
                            ?>
                            </select>
                          </div>
                  
                           <div class="form-group col-md-6">
                            <label for="exampleInputName1">Address</label>
                            <input type="text" name="address" value="<?=$detail->address?>" class="form-control" required>
                           </div>
                        </div>
                        
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="exampleInputName1">Apartment</label>
                            <input type="text" name="apartment" value="<?=$detail->apartment?>" class="form-control" required>
                          </div>
                  
                           <div class="form-group col-md-6">
                            <label for="exampleInputName1">Buzzer</label>
                            <input type="text" name="buzzer" value="<?=$detail->buzzer?>" class="form-control" required>
                           </div>
                        </div>
                        
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="exampleInputName1">City</label>
                            <input type="text" name="city" value="<?=$detail->city?>" class="form-control" required>
                          </div>
                  
                           <div class="form-group col-md-6">
                            <label for="exampleInputName1">State</label>
                            <input type="text" name="state" value="<?=$detail->state?>" class="form-control" required>
                           </div>
                        </div>
                        
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="exampleInputName1">Zip Code</label>
                            <input type="text" name="zipcode" value="<?=$detail->zipcode?>" class="form-control" required>
                          </div>
                  
                           <div class="form-group col-md-6">
                            <label for="exampleInputName1">Sqft</label>
                            <input type="text" name="sqft" value="<?=$detail->sqft?>" class="form-control" required>
                           </div>
                        </div>
                        
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="exampleInputName1">Bedrooms</label>
                            <input type="text" name="bedrooms" value="<?=$detail->bedrooms?>" class="form-control" required>
                          </div>
                  
                           <div class="form-group col-md-6">
                            <label for="exampleInputName1">Bathrooms</label>
                            <input type="text" name="bathrooms" value="<?=$detail->bathrooms?>" class="form-control" required>
                           </div>
                        </div>
                        
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="exampleInputName1">Do you have any dogs?</label>
                            <select name="if_dog" class="form-control"> 
                                <option value="Yes"<?php if($detail->if_dog=='Yes') { echo 'selected'; }?>>YES</option>
                                <option value="No"<?php if($detail->if_dog=='No') { echo 'selected'; }?>>NO</option>
                            </select>
                          </div>
                  
                           <div class="form-group col-md-6">
                            <label for="exampleInputName1">Do you have any cats?</label>
                            <select name="if_cat" class="form-control"> 
                                <option value="Yes"<?php if($detail->if_cat=='Yes') { echo 'selected'; }?>>YES</option>
                                <option value="No"<?php if($detail->if_cat=='No') { echo 'selected'; }?>>NO</option>
                            </select>
                           </div>
                        </div>

	                     <div class="row"> 
	                      <div class="form-group col-md-12"> 
	                          <button type="submit" class="btn btn-primary mr-2">Submit</button>
	                          <button type="button" class="btn btn-light" onclick="javascript:history.go(-1)">Cancel</button>
	                      </div>
	                  	</div>
	                        
                     </div>
                </div>
            </div>
        </div>  

        </form>

        <?php 
		    }
		 ?>
        
      </div>
      
