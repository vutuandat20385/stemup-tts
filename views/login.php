 
<div class="row" style="margin-top:20px;">
<div class="container" >   
 
 
 



<div class="col-md-8">
 
</div>
<div class="col-md-4">

	<div class="login-panel panel panel-default">
		<div class="panel-body"> 
		<center>
		<a href="<?php echo base_url();?>"><img src="<?php echo base_url('images/logo.png');?>"></a><br>
<?php echo $this->lang->line('login_tagline');?>
		</center>

			
					<h4 class="form-signin-heading"><?php echo $this->lang->line('login');?> or Register</h4>
		<?php 
		if($this->session->flashdata('message')){
			?>
			<div class="alert alert-danger">
			<?php echo str_replace('{resend_url}',site_url('login/resend'),$this->session->flashdata('message'));?>
			</div>
		<?php	
		}
		?>	


<form class="form-signin" method="post" action="<?php echo site_url('login/verifylogin2');?>">		

		<label for="inputEmail" class="sr-only">Mobile No.</label> 
		<fieldset class="page-signin-form-group form-group form-group-lg">
                  <div class="page-signin-icon text-muted"><i class="fa fa-phone"></i></div>
                  <input class="page-signin-form-control form-control" name="mobile"  placeholder="Mobile No." id="mobileno" type="text" required autofocus>
                </fieldset>
                <div id="message"></div>
<div id="otp" style="display:none;">
		<label for="inputEmail" class="sr-only">OTP</label> 
		<fieldset class="page-signin-form-group form-group form-group-lg">
                  <div class="page-signin-icon text-muted"><i class="fa fa-star"></i></div>
                  <input class="page-signin-form-control form-control" name="otp"  placeholder="OTP" type="text" required autofocus>
                </fieldset>
                                <div class="form-group">	  
					 
					<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
			</div>
			</form>
 
</div>
<div id="preotp" ><div class="form-group">	  
					 
					<button class="btn btn-lg btn-primary btn-block" onClick="sendotp();">Send OTP</button>
			</div>


</div>


<!--<div class="form-group" >
<a class="btn"  style="background:#3C66C4;color:#ffffff;" href="<?php echo  site_url('hauth/login/Facebook');?>" > <i class="fa fa-facebook"></i> Login with facebook </a>
<a class="btn btn-danger"  href="<?php echo  site_url('hauth/login/Google');?>" > <i class="fa fa-google"></i> Login with google </a>
</div>-->
<button class="btn btn-default btn-block" onClick="toogleid('login-email');">Login with email</button>

<div class="" id="login-email" style="display:none;padding-top:20px;">
<form class="form-signin" method="post" action="<?php echo site_url('login/verifylogin');?>">		

		<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('email_address');?></label> 
		<fieldset class="page-signin-form-group form-group form-group-lg">
                  <div class="page-signin-icon text-muted"><i class="fa fa-user"></i></div>
                  <input class="page-signin-form-control form-control" name="email"  placeholder="<?php echo $this->lang->line('email_address');?>" type="text" required autofocus>
                </fieldset>
                
                <label for="inputPassword" class="sr-only"><?php echo $this->lang->line('password');?></label>
  		<fieldset class="page-signin-form-group form-group form-group-lg">
                  <div class="page-signin-icon text-muted"><i class="fa fa-star"></i></div>
                  <input class="page-signin-form-control form-control" name="password"  id="inputPassword" placeholder="<?php echo $this->lang->line('password');?>" type="password" required  >
                </fieldset>
                <div class="form-group">	  
					 
					<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $this->lang->line('login');?></button>
			</div>
                <a href="<?php echo site_url('login/forgot');?>"><?php echo $this->lang->line('forgot_password');?></a>
                </form>	
                			  
</div>

<div>		 
			
<?php 
if($this->config->item('user_registration')){
	?> 
	<br>
	<a href="<?php echo site_url('login/pre_registration');?>"><?php echo $this->lang->line('register_new_account');?> with email</a>
	&nbsp;&nbsp;&nbsp;&nbsp;
<?php
}
?>
	

			
			
<?php 
if($this->config->item('open_quiz')){
	?>			<p>
			<a href="<?php echo site_url('quiz/open_quiz/0');?>"  ><?php echo $this->lang->line('open_quizzes');?></a>
			</p>
			<?php 
			}
			?>
</div>
			
		</div>
	</div>

</div>
 

</div>

</div>


<script>

function sendotp(){

$("#message").html("<div class='alert alert-warning'>Sending otp...</div>");
	 var mobileno=$('#mobileno').val();
	var formData = {mobileno:mobileno};
	$.ajax({
		 type: "POST",
		 data : formData,
			url: base_url + "index.php/login/sendotp/",
		success: function(data){
		$("#message").html(data);
			
			},
		error: function(xhr,status,strErr){
			//alert(status);
			}	
		});

toogleid('otp');

toogleid('preotp');

}

</script>
