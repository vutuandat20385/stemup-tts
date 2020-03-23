<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Resetpassword</title>
<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
	<!-- Web fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<!-- Bootstrap -->

	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/login.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-home.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('js/signup.js');?>"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
   <!-- <script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->
</head>
<body>
<header class="bg-den">
   <?php     
	            if($this->session->flashdata('message_r')){echo $this->session->flashdata('message_r');} 
				if($this->session->flashdata('message')){
					?>
					
					<?php echo str_replace('{resend_url}',site_url('login/resend'),$this->session->flashdata('message'));?>
					
				<?php	
				}
				?>	
	<div class="container">
		 
		<div class="row">
				
			<div class="col-md-7 col-xs-6">
			<button class="btview" data-toggle="collapse" data-target="#relatedsite">Hệ sinh thái STEM</button>
				<!--<button class="btview" data-toggle="collapse" data-target="#demo">View related sites</button>

				<div id="demo" class="collapse">
					<div class="row">
						<ul class="col-md-4">
							<li><a href="">Toán vui cho người thông minh: Thay dấu hỏi bằng số nào? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate quisquam dolor eligendi sint commodi iusto quibusdam nihil id. In sunt dolorem aspernatur. Quis ratione quisquam illum facilis, adipisci in eum.</a></li>
							<li><a href="">Thiết kế Kỹ thuật Sáng tạo</a></li>
							<li><a href="">Trong cơ thể người, cơ quan nào lớn nhất? </a></li>
							<li><a href="">Trên thế giới có bao nhiêu người mắt xanh lá cây? </a></li>
							<li><a href="">Các mô hình giáo dục stem hiện nay? </a></li>
						</ul>
					</div>
				</div> -->
			</div>
				<?php if($clogin == 0) { ?>
			
			<div class="col-md-5 col-xs-6">
				<div class="row" style="float:right">
					<!-- <div class="col-md-4"> -->
						<!-- <div class="input-group-sm mb-5">
						  <input type="text" class="form-control" placeholder="Username">
						</div> -->
		
				 
					<div class="form-group col-md-3 col-xs-6">	  
						 
						<!--<button class="btn btn-sm btn-default btn-primary pull-right mb-5" type="submit">Đăng nhập</button>-->
						<button class="btn btn-sm btn-default btn-primary pull-right mb-5 dropdown-toggle" type="button" data-toggle="dropdown">Đăng nhập</button>
						 <div class="dropdown-menu" style="margin-left:-260px">
						     <div class="arrow_box arrow-box-top"></div>
							 <div style="padding:10px">
								<form class="form-signin" method="post" action="<?php echo site_url('login/verifylogin');?>">
								     
									 <input class="page-signin-form-control form-control" name="email" style="width:350px;margin:10px" placeholder="<?php echo $this->lang->line('email_address');?>" type="text" required autofocus>
									 <input class="page-signin-form-control form-control" name="password" style="width:270px;margin:10px" id="inputPassword" placeholder="<?php echo $this->lang->line('password');?>" type="password" required  >
		                           	<input style="margin: 10px;" name="remember" type="checkbox">Tự động đăng nhập
									 <button style="z-index:2; margin-top:-42px; margin-right:17px"class="btn btn-sm btn-default btn-primary pull-right mb-5" type="submit">Đăng nhập</button>
									 
									 <!--<table>
										 <tr>
											<td style="padding:10px">
												<a class="btn"  style="background:#3C66C4;color:#ffffff;" href="<?php echo  site_url('hauth/login/Facebook');?>" > <i class="fab fa-facebook-f"></i> Đăng nhập với Facebook </a>
											 </td>
											 <td style="padding:10px">
												<a class="btn btn-danger"  href="<?php echo  site_url('sso/login');?>" > <i class="fab fa-google"></i> Đăng nhập với Itrithuc.vn</a>
											 </td>
										 </tr>
									 </table>-->
									 <a href="#" data-toggle="modal" data-target="#resetpwdModal" style="float:right; padding:10px"> Quên mật khẩu</a>
								 </form>
							 </div>
							 
						 </div>
					</div>


					<button type="submit" class="btn btn-sm btn-default btn-success" onclick="signup()">Đăng ký</button>
					
				</div>
			</div>
				<?php }  else {?>
			    <div class="col-md-offset-9">
					<div class="col-xs-2"><a href="<?php echo site_url('home_user/');?>">
					<?php if($link_photo) { ?>
    			    <img id="avt" class=" img-circle MR5" src="<?php echo $link_photo;?> " alt="" width="32" height="32">
    			<?php } else{ ?>   
    			   <img id="avt" class=" img-circle MR5" src="<?php echo base_url('upload/avatar/default.png');?> " alt="" width="32">
    			<?php } ?> 
					</a></div>
					<div class="col-xs-9">
						  <a href="<?php echo site_url('home_user/');?>" class="border-B1" style="color:#FFF"><?php echo $user_name; ?></a>
					</div>
			     </div>
			<?php } ?>
		</div>
	</div>

	<div id="relatedsite" class="collapse">
		<div class="row">
			<div class="col-md-4" style="margin-left:100px;">
				<ul>
					<li>
						<i class="fas fa- 
caret caret_e 
-right" style="color:#9E9E9E"></i>
				       <a class="rellink" href="https://stem.vn" target="_blank">Trang chính thức stem.vn</a>
				   </li>
				   <li>
                        <i class="fas fa- 
caret caret_e 
-right" style="color:#9E9E9E"></i>
				        <a class="rellink" href="https://vui.stem.vn" target="_blank">Trang Vui</a>
				    </li>
					 <li>
                        <i class="fas fa- 
caret caret_e 
-right" style="color:#9E9E9E"></i>
				        <a class="rellink" href="https://www.stem.vn/vi_VN/all-courses" target="_blank">Trang Học</a>
				    </li>
					 <li>
                        <i class="fas fa- 
caret caret_e 
-right" style="color:#9E9E9E"></i>
				        <a class="rellink" href="https://www.stem.vn/vi_VN/forum/stem-forum-2" target="_blank">Trang Hỏi</a>
				    </li>
			    </ul>
			</div>
		</div>
	</div>
</header>
	<!--nav-->
<nav class="container" >
   <?php if($this->session->flashdata('message_r')){echo $this->session->flashdata('message_r');} ?>
	<div class="col-md-8 col-md-offset-2">
     	<form class="resetpwd" method="post" action="<?php echo site_url('home/resetpassword3/'.$token);?>">
		    <table style="margin:30px;" >
				<tr >
					<td style="padding:10px;">Email :</td>
					<td style="padding:10px;"><?php echo $user['email'] ?></td>
				</tr>
				<tr>
					<td style="padding:10px;">Nhập mật khẩu:</td>
					<td style="padding:10px;"><input type="password" class="form-control form-TK1 "  name="rpwd"  placeholder="Nhập mật khẩu" required autofocus /></td>
				</tr>
				<tr>
					<td style="padding:10px;">Xác nhận mật khẩu:</td>
					<td style="padding:10px;width:500px;"><input type="password" class="form-control form-TK1 " name="crpwd"  placeholder="Nhập lại mật khẩu"  /></td>
				</tr>
			</table>
			<div style="margin-left:20%"> <div class="g-recaptcha" data-sitekey="6LfzlKMUAAAAAMv6fJ1q3p57pOxeKpSRRw8cHyxt"></div></div>
			<div style="margin-left:20%; margin-top:10px"> <button type="submit" class="btn btn-primary" style="margin-left:30px; margin-bottom:100px;">Xác nhận</button></siv>
		</form>
    </div>
</nav>

             


</body>
</html>
