<!DOCTYPE html>
<html lang="en">
<head>

	<?php $this->load->view('stemup/head');?>
	<link href="<?php echo base_url('css/login.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('js/signup.js');?>"></script>


</head>
<body>
<?php $this->load->view('stemup/header');?>
   
	
	
		

<nav class="container" >
   <?php if($this->session->flashdata('message_r')){echo $this->session->flashdata('message_r');} ?>
	<div class="col-md-6 col-md-offset-3">
     	<form class="resetpwd" method="post" action="<?php echo site_url('home/resetpassword3/'.$token);?>">
		    <table style="margin-top:120px;" >
				<tr >
					<td style="padding:10px;">Email:</td>
					<td style="padding:10px;"><?php echo $user['email'] ?></td>
				</tr>
				<tr>
					<td style="padding:10px;">Nhập mật khẩu:</td>
					<td style="padding:10px;"><input type="password" class="form-control form-TK1 "  name="rpwd"  placeholder="Nhập mật khẩu" required autofocus /></td>
				</tr>
				<tr>
					<td style="padding:10px;">Xác nhận mật khẩu:</td>
					<td style="padding:10px;width:70%;"><input type="password" class="form-control form-TK1 " name="crpwd"  placeholder="Nhập lại mật khẩu"  /></td>
				</tr>
			</table>
			<div style="margin-left:20%"> <div class="g-recaptcha" data-sitekey="6LfzlKMUAAAAAMv6fJ1q3p57pOxeKpSRRw8cHyxt"></div></div>
			<div style="margin-left:20%; margin-top:10px"> <button type="submit" class="btn btn-primary" style="margin-left:30px; margin-bottom:100px;">Xác nhận</button></siv>
		</form>
    </div>
</nav>

             
<?php $this->load->view('stemup/footer');?>

</body>
</html>
