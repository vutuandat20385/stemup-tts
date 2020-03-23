<!DOCTYPE html>
<html lang="en">
<head>
	<title>STEMUP | CÀI ĐẶT</title>
	<?php $this->load->view('stemup/head_not_login');?>
	<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
</head>
<body class="bg-body">
	<header class="container-fluid bg-stemup ">
		<div class="container">	<?php $this->load->view('stemup/home/home_header');?>	</div>
	</header>
		<nav class="navbar navbar-default mb-6">
		<div class="container">
			<?php $this->load->view('stemup/home/home_header_mobile');?>
			<?php $this->load->view('stemup/home/menu_top_home'); ?>			
		</div>
	</nav>
	<section id="caidat" class="container-fluid pd-30">
		<div class="container">
			<h1 class="tle1">Cài đặt STEMUP</h1>
			<h4 class="text-center mb-30">Để sử dụng được STEMUP, bạn cần cài đặt STEMUP Phụ huynh cho mình và STEMUP Học sinh cho con.</h4>
			<div class="row">
				<div class="col-md-6 text-center">
					<a href="https://apps.apple.com/us/app/stemup/id1446403154"><img class="mb-6" src="<?php echo base_url('images/stemup_images/iphone-02.svg')?>" width="300" alt=""></a>
				</div>
				<div class="col-md-6 text-center">
					<a href="https://play.google.com/store/apps/details?id=vn.dtt.stemup.student"><img class="mb-6" src="<?php echo base_url('images/stemup_images/google-01.svg')?> " width="300" alt=""></a>
				</div>
			</div>
		</div>
	</section>
	<section>			
		<?php $this->load->view('stemup/footer');?> 
	</section>
</body>

</html>
<script type="text/javascript">
   $("#setup_").attr("class","active");
</script>