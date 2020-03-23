<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>STEMUP</title>
	<!-- Bootstrap -->
	<link href="<?php echo base_url('css/stemup_css/bootstrap-3.4.1.css');?>" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
	<!-- <link href="<?php echo base_url('css/stemup_css/all.css');?>" rel="stylesheet" integrity="" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="" crossorigin="anonymous">

	<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('scrollspy/css/style.css');?>">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="<?php echo base_url('js/stemup_js/jquery-1.12.4.min.js');?>"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo base_url('js/stemup_js/bootstrap-3.4.1.js');?>"></script>
	<script src="<?php echo base_url('js/stemup_js/script.js');?>"></script>

	<script type="text/javascript" src="<?php echo base_url('scrollspy/js/popper.min.js');?>"></script>
	<script src="<?php echo base_url('scrollspy/js/jquery.easing.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('scrollspy/js/script.js');?>"></script>

</head>
<body>
	<header class="container-fluid bg-stemup hidden-xs">
		<div class="container">

			<a class="logo" href=""><img class="" src="<?php echo base_url('images/stemup_images/logo_stemsup.svg');?>" height="60" alt=""></a>
			<form class="navbar-form pull-right mt-15 pad-0" role="search">
				<div class="form-group mt-5">
					<input type="text" class="form-control" id="emailph" name="emailph" placeholder="Email phụ huynh">
					<input type="text" class="form-control" id="namehs" name="namehs" placeholder="Tên học sinh">
					<input type="password" class="form-control" id="pwd" name= "password" placeholder="Mật khẩu"><br>
					<a class="quenmk" href=""><small class="">Quên mật khẩu?</small></a>
				</div>
				<button type="submit" class="btn btn-success mt-am10">Đăng nhập</button>
			</form>

			
		</div>
	</header>
	<nav class="navbar navbar-default mb-6">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<button type="submit" class="btn btn-success visible-xs-block pull-right mr-5 mt-8">Đăng nhập</button>
				<a class="navbar-brand visible-xs-block" href="#"><img class="" src="images/logo_stemsup.svg" height="40" alt=""></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse pad-0" id="defaultNavbar1">		  

				<ul class="nav navbar-nav">
					<li class="active"><a href="<?php echo site_url('home/');?>">Trang chủ</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Về stemup<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="#loiich">Lợi ích khi dùng STEMUP</a></li>
							<li><a href="#nguoidung">Người dùng nói về STEMUP</a></li>
							<li><a href="#baochi">Báo chí nói về STEMUP</a></li>
							<li><a href="#lienhe">Liên hệ</a></li>
						</ul>
					</li>       
					<li><a href="<?php echo site_url('home/guide');?>">Hướng dẫn</a></li>
					<li><a href="<?php echo site_url('home/faq');?>">Câu hỏi thường gặp</a></li>
					<li><a href="<?php echo site_url('home/setup');?>">Cài đặt</a></li>
					<li><a href="<?php echo site_url('home/news');?>">Tin tức</a></li>

				</ul>
				<form class="navbar-form navbar-right" role="search">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Tìm kiếm">
						<div class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<i class="glyphicon glyphicon-search"></i>
							</button>
						</div>
					</div>


				</form>
			  <!--<ul class="nav navbar-nav navbar-right">
				 <li><button type="submit" class="btn btn-danger mr-15 bt-caidat">Cài đặt STEMUP</button></li>
				</ul>-->

			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
	<section class="container-fluid">
		<h2>Nội dung đang phát triển</h2>
	</section>


		<section id="lienhe" class="container-fluid bg-stemup pd-30">
			<div class="container">
				<div class="row padTB15">
					<div class="col-md-7 boL1 text-center767">
						<p class="text-trang">© 2019 DTT. Inc. All Rights Reserved.</p>
					</div>
					<div class="col-md-5 text-right">
						<div class="mb-20"><a class="text-trang" href="">www.facebook.com/stemupapp</a><br></div>
						<a href=""><img src="<?php echo base_url('images/stemup_images/google-01.svg')?>" height="25" alt=""></a>
						<a href=""><img src="<?php echo base_url('images/stemup_images/iphone-02.svg')?>" height="25" alt=""></a>
					</div>
				</div>
			</div>
		</section>


		<!-- body code goes here -->
		<script type="text/javascript">
			jQuery(document).ready(function($) {

				$('#myCarousel').carousel({
					interval: 5000
				});

        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
        	var id_selector = $(this).attr("id");
        	try {
        		var id = /-(\d+)$/.exec(id_selector)[1];
        		console.log(id_selector, id);
        		jQuery('#myCarousel').carousel(parseInt(id));
        	} catch (e) {
        		console.log('Regex failed!', e);
        	}
        });
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
        	var id = $('.item.active').data('slide-number');
        	$('#carousel-text').html($('#slide-content-'+id).html());
        });
    });
</script>

</body>
</html>