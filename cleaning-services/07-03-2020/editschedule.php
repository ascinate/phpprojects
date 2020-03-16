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
        foreach($schedules as $schedule)
        {
          $days = explode(",",$schedule->required_days);
          $times = explode(",",$schedule->required_times);
      ?>
      <form action="<?php echo base_url();?>dashboard/updateSchedule" method="post" class="forms-sample">
        <input type="hidden" name="id" value="<? echo $this->uri->segment(3);?>">
        <input type="hidden" name="customer_id" value="<? echo $this->uri->segment(4);?>">
        <input type="hidden" name="home" value="<? echo $this->uri->segment(5);?>">
        <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">SCHEDULE APPOINTMENT <HR /></h4>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputName1">Frequency of Appointment</label>
                    <select name="frequency_appointment" class="form-control" required> 
          						<option value="Bi-Weekly"<? if($schedule->frequency_appointment=='Bi-Weekly'){ echo 'selected';}?>>Bi-Weekly</option>
          						<option value="Weekly"<? if($schedule->frequency_appointment=='Weekly'){ echo 'selected';}?>>
                      Weekly</option>
          						<option value="Monthly"<? if($schedule->frequency_appointment=='Monthly'){ echo 'selected';}?>>Monthly</option>
          						<option value="Once"<? if($schedule->frequency_appointment=='Once'){ echo 'selected';}?>>Once</option>
                    </select>
                  </div>
                  
                  <div class="form-group col-md-6">
                      <label for="exampleInputEmail3">Hours of Cleaning</label>
                      <input type="text" name="cleaning_charge" value="<?=$schedule->cleaning_charge?>" class="form-control" required>
                  </div>

                 </div>
                  
                  <div class="row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword4">Provide Supplies</label>
                        <select name="if_supplies" class="form-control" required> 
          	  						<option value="Yes"<? if($schedule->if_supplies=='Yes'){ echo 'selected';}?>>Yes</option>
          	  						<option value="No"<? if($schedule->if_supplies=='No'){ echo 'selected';}?>>No</option>
                        </select>
                      </div>
                      
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword4">Required Days</label>
                        <select name="required_days[]" class="form-control" multiple required> 
          	  						<option value="Sunday"<? if(in_array('Sunday', $days)){ echo 'selected';}?>>Sunday</option>
          	  						<option value="Monday"<? if(in_array('Monday', $days)){ echo 'selected';}?>>Monday</option>
          	  						<option value="Tuesday"<? if(in_array('Tuesday', $days)){ echo 'selected';}?>>Tuesday</option>
          	  						<option value="Wednesday"<? if(in_array('Wednesday', $days)){ echo 'selected';}?>>Wednesday</option>
          	  						<option value="Thursday"<? if(in_array('Thursday', $days)){ echo 'selected';}?>>Thursday</option>
          	  						<option value="Friday"<? if(in_array('Friday', $days)){ echo 'selected';}?>>Friday</option>
          	  						<option value="Saturday"<? if(in_array('Saturday', $days)){ echo 'selected';}?>>Saturday</option>
                    	</select>
                      </div>
                  </div>
                  
                 <div class="row"> 
                      <div class="form-group col-md-6">
                        <label>Times</label>
                         <select name="required_times[]" class="form-control" multiple required> 
          	  						<option value="Morning"<? if(in_array('Morning', $times)){ echo 'selected';}?>>Morning</option>
          	  						<option value="Afternoon"<? if(in_array('Afternoon', $times)){ echo 'selected';}?>>Afternoon</option>
          	  						<option value="Evening"<? if(in_array('Evening', $times)){ echo 'selected';}?>>Evening</option>
                    	  </select>
                      </div>
                      
                      <div class="form-group col-md-6">
                        <label for="exampleTextarea1">Cleaning and timing notes</label>
                        <textarea class="form-control" rows="4" name="cleaning_timing_note" required><?=$schedule->cleaning_timing_note?></textarea>
                      </div>
                  </div>

                  <div class="row"> 
                      <div class="form-group col-md-6">
                        <label>Parking Note</label>
                        <textarea class="form-control" rows="4" name="parking_note" required><?=$schedule->parking_note?></textarea>
                      </div>
                      
                      <div class="form-group col-md-6">
                        <label for="exampleTextarea1">Garbage Note</label>
                        <textarea class="form-control" rows="4" name="garbage_note" required><?=$schedule->garbage_note?></textarea>
                      </div>
                  </div>
                  
                  <div class="row"> 
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Extra Time</label>
                        <select name="extra_time" class="form-control" required> 
                            <option value="15"<? if($schedule->extra_time=='15'){ echo 'selected';}?>>15 Minutes</option>
                            <option value="30"<? if($schedule->extra_time=='30'){ echo 'selected';}?>>30 Minutes</option>
                            <option value="45"<? if($schedule->extra_time=='45'){ echo 'selected';}?>>45 Minutes</option>
                            <option value="60"<? if($schedule->extra_time=='60'){ echo 'selected';}?>>60 Minutes</option>
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
      
