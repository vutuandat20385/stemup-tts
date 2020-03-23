<!DOCTYPE html>
<html lang="en">
<?php
    $this->load->view("stemup/head");
?>
<body>
    <header class="container-fluid bg-stemup hidden-xs">
		<div class="container">
			<a class="logo" href=""><img class="" src="<?php echo base_url('images/stemup_images/logo_stemsup.svg')?>" height="60" alt=""></a>
			<form class="navbar-form pull-right mt-15 pad-0" role="search" method="post" action="<?php echo site_url('/login/stemupverifylogin');?>">
				<div class="form-group mt-5">
					<input type="text" class="form-control" id="emailph" name="emailph" placeholder="Email phụ huynh">
					<input type="text" class="form-control" id="namehs" name="namehs" placeholder="Tên học sinh">
					<input type="password" class="form-control" id="pwd" name= "password" placeholder="Mật khẩu"><br>
					<a class="quenmk" href=""><small class="">Quên tài khoản?</small></a>

					<!---Thong bao neu co loi xay ra--->
					<?php if($this->session->flashdata('message_r')){ ?>
					  <div class="alert-danger" style="padding:5px">
					  
							 <?php
								echo $this->session->flashdata('message_r');
			                ?>					
							
						
					  
					  </div>
					<?php } ?>
					 <!--- End thong bao--->
				</div>
				<button type="submit" class="btn btn-success mt-am10">Đăng nhập</button>
			</form>
		</div>
	</header>
	
</body>
</html>