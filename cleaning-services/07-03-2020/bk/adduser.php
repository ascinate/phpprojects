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
	return false;
	} 
	else 
	{  	
		if($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val().match(special_characters)) 
		{            
		$('#password-strength-status').removeClass();
		$('#password-strength-status').addClass('strong-password');
		$('#password-strength-status').html("Strong");
		return false;
		} 
		else 
		{
		$('#password-strength-status').removeClass();
		$('#password-strength-status').addClass('medium-password');
		$('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
		return false;
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
                <h4 class="card-title">Add Users</h4>
                
                <p align="center" style="color:#F00;"><?php if($this->input->get('err')){ echo 'Registration Failed. Email Address Already Exists!';}?></p>
                
                <form action="<?php echo base_url();?>dashboard/insertUser" method="post" class="forms-sample" enctype="multipart/form-data" onsubmit="javascript: return valid();">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" name="name" class="form-control" required>
                  </div>
                  
                  <div class="form-group col-md-6">
                       <label for="exampleInputEmail3">Email address</label>
                      <input type="email" name="email" class="form-control" required>
                    </div>
                 </div>
                  
                  <div class="row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword4">Password</label>
                        <input type="password" name="password" class="form-control" id="password" onkeyup="javascript:mark();" required>
                        <div id="password-strength-status"></div>
                      </div>
                      
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword4">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" required>
                      </div>
                  </div>
                  
                  <div class="row"> 
                      <div class="form-group col-md-6">
                        <label>File upload</label>
                        <input type="file" name="fileToUpload" class="form-control">
                      </div>
                      
                      <div class="form-group col-md-6">
                        <label for="exampleTextarea1">Note</label>
                        <textarea class="form-control" id="exampleTextarea1" rows="4" name="description"></textarea>
                      </div>
                  </div>
                 
                  <div class="row"> 
                      <div class="form-group col-md-12"> 
                          <button type="submit" class="btn btn-primary mr-2">Submit</button>
                          <button type="button" class="btn btn-light" onclick="javascript:history.go(-1)">Cancel</button>
                      </div>
                  </div>
                </form>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      
