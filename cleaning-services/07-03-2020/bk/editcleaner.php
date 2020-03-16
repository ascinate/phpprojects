<div class="main-panel">
<style>
input[type=text], input[type=email], select, input[type=date]
{
	font-weight: normal!important;
    color: #000 !important;
    font-size: 0.875rem;
}
</style>
<script language="javascript">
 function mark() 
 {
	var number = /([0-9])/;
	var alphabets = /([a-zA-Z])/;
	var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
	if($('#password').val().length<8) 
	{
	$('#password-strength-status').removeClass();
	$('#password-strength-status').addClass('weak-password');
	$('#password-strength-status').html("Weak (should be atleast 8 characters.)");
	$('#password').focus();
	} 
	else 
	{  	
		if($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val().match(special_characters)) 
		{            
		$('#password-strength-status').removeClass();
		$('#password-strength-status').addClass('strong-password');
		$('#password-strength-status').html("Strong");
		} 
		else 
		{
		$('#password-strength-status').removeClass();
		$('#password-strength-status').addClass('medium-password');
		$('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
		}
	}
	return true;
}

function valid()
{
	var number = /([0-9])/;
	var alphabets = /([a-zA-Z])/;
	var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;

	if($('#password').val().length<8) 
	{
		alert('Password should be atleast 8!');
		$('#password').focus();
		return false;
	}
    if((!$('#password').val().match(number))) 
	{ 
	   alert('Password is not strong enough!');
		$('#password').focus();
		return false;
	}
	if((!$('#password').val().match(alphabets))) 
	{ 
	   alert('Password is not strong enough!');
		$('#password').focus();
		return false;
	}
	if((!$('#password').val().match(special_characters))) 
	{ 
	   alert('Password is not strong enough!');
		$('#password').focus();
		return false;
	}
	
	return true;
}

</script>
<div class="content-wrapper">
        <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Edit Users</h4>
                
                <p align="center"><?php $this->session->flashdata('msg');?></p>
                <?php
                  foreach($cleaners as $cleaner)
				  {
				?>
                <form action="<?php echo base_url();?>dashboard/updateCleaner" method="post" class="forms-sample" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$cleaner->id?>" />
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" name="name" class="form-control" value="<?=$cleaner->name?>" required>
                  </div>
                  
                  <div class="form-group col-md-6">
                       <label for="exampleInputEmail3">Email address</label>
                      <input type="email" name="email" class="form-control" value="<?=$cleaner->email?>" required>
                    </div>
                 </div>
                  
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword4">Password</label>
		                <input type="password" name="password" class="form-control" id="password" value="<?=$cleaner->password?>" required>
                      </div>
                    
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword4">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="<?=$cleaner->phone?>" required>
                      </div>
                  </div>

                   <div class="row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword4">Address</label>
                    <input type="text" name="address" class="form-control" id="address" value="<?=$cleaner->address?>" required>
                      </div>
                    
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword4">City</label>
                        <input type="text" name="city" class="form-control" id="city" value="<?=$cleaner->city?>" required>
                      </div>
                  </div>

                   <div class="row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword4">State</label>
                    <input type="text" name="state" class="form-control" id="state" value="<?=$cleaner->state?>" required>
                      </div>
                    
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword4">Zipcode</label>
                        <input type="text" name="zipcode" class="form-control" id="phone" value="<?=$cleaner->phone?>" required>
                      </div>
                  </div>
                  
                  <div class="row"> 
                      <div class="form-group col-md-6">
                        <label>File upload</label>
                        <input type="file" name="photo" class="form-control">
                        <?php if($user->photo!="") {?>
                        <img src="<?php echo base_url();?>uploads/<?=$cleaner->photo;?>" border="0" width="100" height="100" />
                        <?php } else {?>
                        <img src="<?php echo base_url();?>assets/images/avatar.png" alt="image" width="50" height="50"/>
                        <?php }?>
                      </div>
                      
                      <div class="form-group col-md-6">
                        <label for="exampleTextarea1">Note</label>
                        <textarea class="form-control" id="exampleTextarea1" rows="4" name="description"><?=$cleaner->description?></textarea>
                      </div>
                  </div>
                 
                  <div class="row"> 
                      <div class="form-group col-md-12"> 
                          <button type="submit" class="btn btn-primary mr-2">Submit</button>
                          <button type="button" class="btn btn-light" onclick="javascript:history.go(-1)">Cancel</button>
                      </div>
                  </div>
                </form>
                
                 <?php 
				    }
				  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      
       <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between"> 
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block" style="font-size:0.975rem;">Copyright © 2019. All rights reserved.</span> 
      </div>
    </footer>
    <!-- partial -->
  </div>