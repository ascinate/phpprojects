<style>
input[type=text], input[type=email], select, input[type=date]
{
	font-weight: normal!important;
    color: #000 !important;
    font-size: 0.875rem;
}
</style>

<div class="content-wrapper">
      <form action="<?php echo base_url();?>dashboard/insertSchedule" method="post" class="forms-sample" enctype="multipart/form-data">
       <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">HOME INFORMATION <hr /></h4>
                        
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="exampleInputName1">Customer</label>
                            <select name="customer_id" class="form-control" required> 
                            <?php 
                              $query = $this->db->query("select * from `user_master` where `name`!='Admin' order by name asc");
                              foreach ($query->result() as $row)
                              {
                            ?>
                                <option value="<?=$row->id;?>"><?=$row->name;?></option>
                            <?php 
                               }
                            ?>
                            </select>
                          </div>
                  
                           <div class="form-group col-md-6">
                            <label for="exampleInputName1">Address</label>
                            <input type="text" name="address" class="form-control" required>
                           </div>
                        </div>
                        
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="exampleInputName1">Apartment</label>
                            <input type="text" name="apartment" class="form-control" required>
                          </div>
                  
                           <div class="form-group col-md-6">
                            <label for="exampleInputName1">Buzzer</label>
                            <input type="text" name="buzzer" class="form-control" required>
                           </div>
                        </div>
                        
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="exampleInputName1">City</label>
                            <input type="text" name="city" class="form-control" required>
                          </div>
                  
                           <div class="form-group col-md-6">
                            <label for="exampleInputName1">State</label>
                            <input type="text" name="state" class="form-control" required>
                           </div>
                        </div>
                        
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="exampleInputName1">Zip Code</label>
                            <input type="text" name="zipcode" class="form-control" required>
                          </div>
                  
                           <div class="form-group col-md-6">
                            <label for="exampleInputName1">Sqft</label>
                            <input type="text" name="sqft" class="form-control" required>
                           </div>
                        </div>
                        
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="exampleInputName1">Bedrooms</label>
                            <input type="text" name="bedrooms" class="form-control" required>
                          </div>
                  
                           <div class="form-group col-md-6">
                            <label for="exampleInputName1">Bathrooms</label>
                            <input type="text" name="bathrooms" class="form-control" required>
                           </div>
                        </div>
                        
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="exampleInputName1">Do you have any dogs?</label>
                            <select name="if_dog" class="form-control"> 
                                <option value="Yes">YES</option>
                                <option value="No">NO</option>
                            </select>
                          </div>
                  
                           <div class="form-group col-md-6">
                            <label for="exampleInputName1">Do you have any cats?</label>
                            <select name="if_cat" class="form-control"> 
                                <option value="Yes">YES</option>
                                <option value="No">NO</option>
                            </select>
                           </div>
                        </div>
                        
                     </div>
                </div>
            </div>
        </div>  
            
        <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">SCHEDULE APPOINTMENT <HR /></h4>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputName1">Frequency of Appointment</label>
                    <select name="frequency_appointment" class="form-control"> 
  						<option value="Bi-Weekly">Bi-Weekly</option>
  						<option value="Weekly">Weekly</option>
  						<option value="Monthly">Monthly</option>
  						<option value="Once">Once</option>
                    </select>
                  </div>
                  
                  <div class="form-group col-md-6">
                      <label for="exampleInputEmail3">Hours of Cleaning</label>
                      <input type="text" name="cleaning_charge" class="form-control" required>
                  </div>

                 </div>
                  
                  <div class="row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword4">Provide Supplies</label>
                        <select name="if_supplies" class="form-control"> 
	  						<option value="Yes">Yes</option>
	  						<option value="No">No</option>
                        </select>
                      </div>
                      
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword4">Required Days</label>
                        <select name="required_days" class="form-control" multiple required> 
	  						<option value="Sunday">Sunday</option>
	  						<option value="Monday">Monday</option>
	  						<option value="Tuesday">Tuesday</option>
	  						<option value="Wednesday">Wednesday</option>
	  						<option value="Thursday">Thursday</option>
	  						<option value="Friday">Friday</option>
	  						<option value="Saturday">Saturday</option>
                    	</select>
                      </div>
                  </div>
                  
                 <div class="row"> 
                      <div class="form-group col-md-6">
                        <label>Times</label>
                         <select name="required_times" class="form-control" multiple required> 
	  						<option value="Morning">Morning</option>
	  						<option value="Afternoon">Afternoon</option>
	  						<option value="Evening">EveningEvening</option>
                    	</select>
                      </div>
                      
                      <div class="form-group col-md-6">
                        <label for="exampleTextarea1">Cleaning and timing notes</label>
                        <textarea class="form-control" id="exampleTextarea1" rows="4" name="cleaning_timing_note"></textarea>
                      </div>
                  </div>

                  <div class="row"> 
                      <div class="form-group col-md-6">
                        <label>Parking Note</label>
                        <textarea class="form-control" id="exampleTextarea1" rows="4" name="parking_note"></textarea>
                      </div>
                      
                      <div class="form-group col-md-6">
                        <label for="exampleTextarea1">Garbage Note</label>
                        <textarea class="form-control" id="exampleTextarea1" rows="4" name="garbage_note"></textarea>
                      </div>
                  </div>
                  
                  <div class="row"> 
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Extra Time</label>
                        <select name="extra_time" class="form-control"> 
                            <option value="15">15 Minutes</option>
                            <option value="30">30 Minutes</option>
                            <option value="45">45 Minutes</option>
                            <option value="60">60 Minutes</option>
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
        
      </div>
      
