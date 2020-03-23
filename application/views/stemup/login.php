<!DOCTYPE html>
<html lang="en">
  <?php $this->load->view('stemup/head');?>
  <body class="bg-body">
	<?php $this->load->view('stemup/header');?>
	<main class="container MT70 mb-20 m-height480">
	
	<form class="box-bor w350 mt-40" method="post" action="<?php echo site_url('/login/stemupverifylogin');?>">
		 <h3 class="text-xanh1 mb-20"><a href="">Học sinh đăng nhập</a></h3>
		   <?php if($this->session->flashdata('message_r')){ ?>
		  <div class="alert-danger" style="padding:5px">
		  
				 <?php
					echo $this->session->flashdata('message_r');
                ?>					
				
			
		  
		  </div>
		  <?php } ?>
		  
		  
		 
		  <div class="form-group">
			<label for="email">Email Phụ huynh:</label>
			<input type="email" class="form-control" id="emailph" name="emailph">
		  </div>
		  <div class="form-group">
			<label for="email">Tên đăng nhập học sinh:</label>
			<input type="text" class="form-control" id="namehs" name="namehs">
		  </div>
		  <div class="form-group">
			<label for="pwd">Mật khẩu:</label>
			<input type="password" class="form-control" id="pwd" name= "password">
		  </div>
		  <div class="checkbox">
			<label><input type="checkbox" name="remember"> Tự động đăng nhập</label>
		  </div>
		  <button type="submit" class="btn btn-danger btn-block"><span class="text-H">Đăng nhập</span></button>
	</form> 
 </main>
  	<?php $this->load->view('stemup/footer');?>
</body>
</html>