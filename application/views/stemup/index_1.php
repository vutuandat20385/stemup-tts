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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/slick.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/slick-theme.css');?>">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins)  -->
	<script src="<?php echo base_url('js/stemup_js/jquery-1.12.4.min.js');?>"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo base_url('js/stemup_js/bootstrap-3.4.1.js');?>"></script>
	<script src="<?php echo base_url('js/stemup_js/script.js');?>"></script>

	<script type="text/javascript" src="<?php echo base_url('scrollspy/js/popper.min.js');?>"></script>
	<script src="<?php echo base_url('scrollspy/js/jquery.easing.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('scrollspy/js/script.js');?>"></script>

	<script src="<?php echo base_url('js/slick.js') ?>"></script>
	<script src="<?php echo base_url('js/jquery-migrate-1.2.1.min.js') ?>"></script>

</head>
<body>
	<header class="container-fluid bg-stemup hidden-xs">
		<div class="container">

			<a class="logo" href="<?php echo site_url(); ?>"><img class="" src="<?php echo base_url('images/stemup_images/logo_stemsup.svg');?>" height="60" alt=""></a>
			<form class="navbar-form pull-right mt-15 pad-0" role="search" method="post" >
				<div class="form-group mt-5">
					<input type="text" class="form-control" id="emailph" name="emailph" placeholder="Email ph? huynh">
					<input type="text" class="form-control" id="namehs" name="namehs" placeholder="T�n h?c sinh">
					<input type="password" class="form-control" id="pwd" name= "password" placeholder="M?t kh?u"><br>
					<div id="error" style="color: white;"></div>
					<div id="ok" style="color: green"></div>
					<?php if($this->session->flashdata('message_r')){ ?>
						<div class="alert-danger" style="padding:5px">
							
							<?php
							echo $this->session->flashdata('message_r');
							?>					
							
							
							
						</div>
					<?php } ?>
				</div>
				<button type="submit" class="btn btn-success mt-5" id="button12">�ang nh?p</button>
				<script type="text/javascript">
					$('#button11').on('click',function(){
						var emailph = $("#emailph").val();
						var namehs = $("#namehs").val();
						var password = $("#pwd").val();
						var error = $("#error");
						var ok = $("#ok");
		 				// resert 2 th? div th�ng b�o tr? v? r?ng m?i khi click n�t dang nh?p
		 				error.html("");
						//ok.html("");
						
						// Ki?m tra n?u username r?ng th� b�o l?i
						if (emailph == "") {
							console.log('wetgw rthwrth5555');
							error.html("�?a ch? Email kh�ng du?c d? tr?ng");
							return false;
						}
						if (namehs == "") {
							console.log('wetgw rthwrth5555');
							error.html("T�n h?c sinh kh�ng du?c d? tr?ng ");
							return false;
						}
						if (password == "") {
							console.log('wetgw rthwrth5555');
							error.html("Password kh�ng du?c d? tr?ng");
							return false;
						}

					});
				</script>
			</form>

			
		</div>
	</header>
	<nav class="navbar navbar-default mb-6">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<a class="logo logo-mobile hidden-sm hidden-md hidden-lg" href=""><img class="" src="<?php echo base_url('images/stemup_images/logo_stemsup.svg');?>" height="40" alt=""></a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>

					
				</button>
				<button type="button" class="navbar-toggle collapsed btn-login-mobile" data-toggle="collapse" data-target="#div-mobile" aria-expanded="false">
					�ang Nh?p
				</button>
				<div id="error" style="color: white;" class="hidden-sm hidden-md hidden-lg"></div>
				<div id="ok" style="color: green" class="hidden-sm hidden-md hidden-lg"></div>
				<?php if($this->session->flashdata('message_r')){ ?>
					<div class="alert-danger hidden-sm hidden-md hidden-lg" style="padding:5px">
						
						<?php
						echo $this->session->flashdata('message_r');
						?>					
						
						
						
					</div>
				<?php } ?>


				
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div id="div-mobile" class="collapse navbar-collapse pad-0 hidden-sm hidden-md hidden-lg">
				
				<form method="post" class="login-form" style="" role="search" method="post" action="<?php echo site_url('/login/stemupverifylogin');?>">
					<div class="form-group mt-5">
						<input type="text" class="login-input" id="emailph" name="emailph" placeholder="Email ph? huynh">
						<input type="text" class="login-input" id="namehs" name="namehs" placeholder="T�n h?c sinh">
						<input type="password" class="login-input" id="pwd" name= "password" placeholder="M?t kh?u"><br>
						
					</div>
					<button type="submit" class="btn btn-success btn-login-mobile">�ang nh?p</button>
					
				</form>
			</div>
			<!-- <div class="menu_n collapse navbar-collapse pad-0" id="defaultNavbar1">		   -->
				<div class="menu_n " id="defaultNavbar1">		  

					<ul class="nav navbar-nav">
						<li class="active"><a href="<?php echo site_url(); ?>">Trang ch?</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">V? stemup<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#loiich">L?i �ch khi d�ng STEMUP</a></li>
								<li><a href="#nguoidung">Ngu?i d�ng n�i v? STEMUP</a></li>
								<li><a href="#baochi">B�o ch� n�i v? STEMUP</a></li>

							</ul>
						</li>       
						<li><a href="<?php echo site_url('home/guide');?>">Hu?ng d?n</a></li>
						<li><a href="<?php echo site_url('home/faq');?>">C�u h?i thu?ng g?p</a></li>
						<li><a href="<?php echo site_url('home/setup');?>">C�i d?t</a></li>
						<li><a href="<?php echo site_url('home/news');?>">Tin t?c</a></li>
						<li><a href="<?php echo site_url('home/contact')?>">Li�n h?</a></li>
					</ul>
					<form method="post" class="navbar-form navbar-right" role="search" action="<?php echo site_url('home/search_n') ?>">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="T�m ki?m" name="timkiem" id="search_n_timkiem">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit">
									<i class="glyphicon glyphicon-search" id="glyphicon"></i>
								</button>
							</div>
						</div>
					</form>


			  <!--<ul class="nav navbar-nav navbar-right">
				 <li><button type="submit" class="btn btn-danger mr-15 bt-caidat">C�i d?t STEMUP</button></li>
				</ul>-->

			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
	<section class="container-fluid">
		<div class="row">
			<div class="col-md-6 pr-1 pl-1">
				<div id="carousel1" class="carousel slide mb-6" data-ride="carousel">
					<div id="thumbnail-preview-indicators" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="item slides active">
								<div class="slide-1" style="background-image: url(<?php echo $post['slide'][0]['avatar'] ?>)">
									<div class="carousel-caption carousel-caption1">
										<h1 class="tle-slide">
											<a class="text-tintop" href="<?php echo site_url('home/tintuc'.'/'.$post['slide'][0]['url_name'])?>">
												<?php echo $post['slide'][0]['name'] ?></a>
											</h1>
										</div>
									</div>
								</div>
								<div class="item slides">
									<div class="slide-3" style="background-image: url(<?php echo $post['slide'][1]['avatar'] ?>)">
										<div class="carousel-caption carousel-caption1">
											<h1 class="tle-slide"><a class="text-tintop" href="<?php echo site_url('home/tintuc'.'/'.$post['slide'][1]['url_name'])?>"><?php echo $post['slide'][1]['name'] ?></a></h1>
										</div>
									</div>
								</div>
							</div>
							<a class="left carousel-control carousel-control-nghechoi" href="#thumbnail-preview-indicators" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
							<a class="right carousel-control carousel-control-nghechoi" href="#thumbnail-preview-indicators" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
						</div> <!--end slide-->

						<a class="left carousel-control" href="#carousel1" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel1" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>
					</div>

				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-xs-6 pl-1 pr-1">
							<a class="thum-top1" href="<?php echo site_url('home/tintuc'.'/'.$rand['rand'][0]['url_name'])?>" style="background-image: url(<?php echo $rand['rand'][0]['avatar'] ?>)">
								<span class="text-top1"><?php echo $rand['rand'][0]['name'] ?></span>
							</a>
						</div>
						<div class="col-xs-6 pl-1 pr-1">
							<a class="thum-top1" href="<?php echo site_url('home/tintuc'.'/'.$rand['rand'][1]['url_name'])?>" style="background-image: url(<?php echo $rand['rand'][1]['avatar'] ?>)">
								<span class="text-top1"><?php echo $rand['rand'][1]['name'] ?></span>
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 pl-1 pr-1">
							<a class="thum-top1" href="<?php echo site_url('home/tintuc'.'/'.$rand['rand'][2]['url_name'])?>" style="background-image: url(<?php echo $rand['rand'][2]['avatar'] ?>)">
								<span class="text-top1"><?php echo $rand['rand'][2]['name'] ?></span>
							</a>
						</div>
						<div class="col-xs-6 pl-1 pr-1">
							<a class="thum-top1" href="<?php echo site_url('home/tintuc'.'/'.$rand['rand'][3]['url_name'])?>" style="background-image: url(<?php echo $rand['rand'][3]['avatar'] ?>)">
								<span class="text-top1"><?php echo $rand['rand'][3]['name'] ?></span>
							</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<section id="loiich" class="container-fluid bg-xanh pd-30">
		<div class="container">
			<h1 class="tle">L?i �ch khi d�ng STEMUP</h1>
			<div class="row">
				<div class="col-md-3 text-center">
					<p class="text-trang" href="">
						<span class="vongtrong"><i class="fab fa-steam-symbol fa-4x"></i></span><br>
						H?c sinh du?c luy?n k? nang STEM - y?u t? s?ng c�n d? c?nh tranh trong K? nguy�n 4.0; r�n k? nang s?ng nh? kho b�i t?p tr?c nghi?m video h?p d?n do B? GD&�T v� VTV s?n xu?t
					</p>
				</div>
				<div class="col-md-3 text-center">
					<p class="text-trang" href="">
						<span class="vongtrong"><i class="fas fa-users fa-3x"></i></span><br>
						Tang k?t n?i cha m? - con c�i. B?n ch? c?n v�i ph�t m?i ng�y d? h?c c�ng con, bi?t r� con th�ch m�n g�, y?u k? nang n�o�
					</p>
				</div>
				<div class="col-md-3 text-center">
					<p class="text-trang" href="">
						<span class="vongtrong"><i class="fas fa-spell-check fa-3x"></i></span><br>
						STEMUP kh�ng t?o th�m g�nh n?ng b�i t?p cho h?c sinh, gi�p h?c sinh vui h?c th�ng qua tr? l?i c�u h?i tr?c nghi?m th� v?.
					</p>
				</div>
				<div class="col-md-3 text-center">
					<p class="text-trang" href="">
						<span class="vongtrong"><i class="fas fa-chalkboard-teacher fa-3x"></i></span><br>
						H?c sinh s? d?ng smartphone, m�y t�nh, internet m?t c�ch hi?u qu?, l�nh m?nh.
					</p>
				</div>
			</div>
		</div>
	</section>
	<section id="nguoidung" class="container-fluid bg1 pd-30" style="background-image: url(<?php echo base_url('images/stemup_images/bg1.png')?>)">
		<div class="container">
			<h1 class="tle">Ngu?i d�ng n�i v? STEMUP</h1>
			<div class="carousel-reviews broun-block">
				<div class="container">
					<div class="row">
						<div id="carousel-reviews" class="carousel slide" data-ride="carousel">

							<div class="carousel-inner">
								<div class="item active">
									<div class="col-md-4 col-sm-6">
										<div class="block-text rel zmin">
											<a title="" href="#">B�i Phan Vinh</a>
											<div class="mark">��nh gi�: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
											<p>?ng d?ng r?t hay.  T�i c� th? giao b�i t?p cho con h�ng ng�y. N?i dung b�i ki?m ra r?t da d?ng c� c? video v� b�i d?c trong m?i b�i ki?m tra. Ch�u nh� t�i r?t th�ch.</p>
											<ins class="ab zmin sprite sprite-i-triangle block"></ins>
										</div>
										<div class="person-text rel">
											<img class="user-image" alt="" src="<?php echo base_url('images/stemup_images/buiphanvinh.jpg')?>">
											<a title="" href="#" class="word_n">B�i Phan Vinh</a>
											<i>L� Thanh Ngh?, Hai B� trung, H� N?i</i>
										</div>
									</div>
									<div class="col-md-4 col-sm-6 hidden-xs">
										<div class="block-text rel zmin">
											<a title="" href="#">anh Tr?n Vi?t Anh</a>
											<div class="mark">��nh gi�: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star-empty"></span><span data-value="3" class="glyphicon glyphicon-star-empty"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
											<p>"D�ng STEMUP d�ng l� h?c c�ng con th?t. Nhi?u ki?n th?c m�nh d� qu�n t? d?i n?o d?i n�o, gi? nhu du?c h?c l?i, r?i ch�m gi� v?i con, kh?i s? m?t h�nh tu?ng"</p>
											<ins class="ab zmin sprite sprite-i-triangle block"></ins>
										</div>
										<div class="person-text rel">
											<img class="user-image" alt="" src="<?php echo base_url('images/stemup_images/tranvietanh.png')?>">
											<a title="" href="#" class="word_n">anh Tr?n Vi?t Anh</a>
											<i>th�nh ph? Vinh, Ngh? An</i>
										</div>
									</div>
									<div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
										<div class="block-text rel zmin">
											<a title="" href="#"> b� Tr?n Qu? Phuong</a>
											<div class="mark">��nh gi�: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star"></span><span data-value="5" class="glyphicon glyphicon-star"></span>  </span></div>
											<p>"Con g�i t�i l� m? don th�n, bu�n b�n b?n t?i m?t m� v?n ph?i k�m con h?c, t�i mu?n gi�p nhung ng�y xua h?c kh�ng gi?i, bi?t g� d�u m� d?y ch�u. Th? r?i con t?i c�i STEMUP n�y v? di?n tho?i c?a t�i, hu?ng d?n t�i ch? c?n l�m th? n�y th? n�y l� du?c. Gi? th� ngo�i lu?t Facebook, t�i c�n ra b�i t?p cho ch�u r?i nh?n x�t k?t qu? r�nh r?t n?a"</p>
											<ins class="ab zmin sprite sprite-i-triangle block"></ins>
										</div>
										<div class="person-text rel">
											<img class="user-image" alt="" src="<?php echo base_url('images/stemup_images/trranquephuong.jpg')?>">
											<a title="" href="#" class="word_n"> b� Tr?n Qu? Phuong</a>
											<i>Thanh H�a</i>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="col-md-4 col-sm-6">
										<div class="block-text rel zmin">
											<a title="" href="#">ch? Tr?n H?ng</a>
											<div class="mark">��nh gi�: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
											<p>"B� c? non l?p S�u nh� t�i h�m qua b?o, n?u b�i t?p c�c c� gi�o cho cung click nho?ng m?t l�t l� xong th? n�y th� b?n con kh?e. ��ng th?t, cung ch?ng ?y ki?n th?c m� l�m ki?u STEMUP th� nhanh hon nhi?u"</p>
											<ins class="ab zmin sprite sprite-i-triangle block"></ins>
										</div>
										<div class="person-text rel">
											<img class="user-image" alt="" src="<?php echo base_url('images/stemup_images/tranhong.jpg')?>">
											<a title="" href="#" class="word_n">ch? Tr?n H?ng</a>
											<i>Linh ��m, H� N?i</i>
										</div>
									</div>
									<div class="col-md-4 col-sm-6 hidden-xs">
										<div class="block-text rel zmin">
											<a title="" href="#">ch? Hoa Nguy?n</a>
											<div class="mark">��nh gi�: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star-empty"></span><span data-value="3" class="glyphicon glyphicon-star-empty"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
											<p>�M�nh giao h?n v?i c?u c? l� n?u l�m xong b�i tr?c nghi?m m? giao qua STEMUP s? du?c choi game 30 ph�t. C?u ?y m?c c? 60 ph�t, cu?i c�ng ch?t deal l� 40 ph�t. H�m n�o v? mu?n m?i l�m vi?c nh� chua k?p giao b�i l� c?u ?y gi?c. Hai b�n d?u ph?n kh?i� </p>
											<ins class="ab zmin sprite sprite-i-triangle block"></ins>
										</div>
										<div class="person-text rel">
											<img class="user-image" alt="" src="<?php echo base_url('images/stemup_images/hoanguyen.jpg')?>">
											<a title="" href="#" class="word_n">ch? Hoa Nguy?n</a>
											<i>qu?n Hai B� Trung, H� N?i</i>
										</div>
									</div>
									<div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
										<div class="block-text rel zmin">
											<a title="" href="#">anh Nguy?n Ch�nh</a>
											<div class="mark">��nh gi�: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star"></span><span data-value="5" class="glyphicon glyphicon-star"></span>  </span></div>
											<p>"Con t�i kh�ng cham h?c l?m. Ch�u thu?ng nhan nh� khi du?c giao b�i t?p. Nhung v?i b�i t?p tr�n STEMUP th� anh ch�ng kh� vui v? v� �kh�ng t?n nhi?u th?i gian c?a con�. ��y cung l� l� do t�i d�m d�ng th? STEMUP v� n?u m?t th?i gian th� t�i d�nh ch?u v� qu� b?n"</p>
											<ins class="ab zmin sprite sprite-i-triangle block"></ins>
										</div>
										<div class="person-text rel">
											<img class="user-image" alt="" src="<?php echo base_url('images/stemup_images/nguyenchinh.jpg')?>">
											<a title="" href="#" class="word_n">anh Nguy?n Ch�nh</a>
											<i>M? ��nh, H� N?i</i>
										</div>
									</div>
								</div>

							</div>
							<a class="left carousel-control left1" href="#carousel-reviews" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left top36"></span>
							</a>
							<a class="right carousel-control right1" href="#carousel-reviews" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right top36"></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="caidat" class="container-fluid pd-30">
		<div class="container">
			<h1 class="tle1">C�i d?t STEMUP</h1>
			<h4 class="text-center mb-30">�? s? d?ng du?c STEMUP, b?n c?n c�i d?t STEMUP Ph? huynh cho m�nh v� STEMUP H?c sinh cho con.</h4>
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
	<section id="baochi" class="container-fluid bg-xam pd-30">
		<div class="container">
			<h1 class="tle1">B�o ch� n�i v? STEMUP</h1>
			<div class="carousel-reviews broun-block">
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div id="carousel-reviews12" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<div class="autoplay-slide">
										<div class="col-xs-12 col-md-3 text-center" >
											<a class="bn-bao" href=""><img class="img-responsive mb-6" src="<?php echo base_url('images/stemup_images/khpt-DT.png')?>" alt=""></a>
										</div>
										<div class="col-xs-12 col-md-3 text-center">
											<a class="bn-bao" href=""><img class="img-responsive mb-6" src="<?php echo base_url('images/stemup_images/dnvn-logo.png')?>" alt=""></a>
										</div>
										<div class="col-xs-12 col-md-3 text-center">
											<a class="bn-bao" href=""><img class="img-responsive mb-6" src="<?php echo base_url('images/stemup_images/session13-4.png')?>" alt=""></a>
										</div>
										<div class="col-xs-12 col-md-3 text-center">
											<a class="bn-bao" href=""><img class="img-responsive" src="<?php echo base_url('images/stemup_images/logo_header.png')?>" alt=""></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>
<script type="text/javascript">
	$('#search_n_timkiem').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (keycode == '13') {
			// alert('B?n v?a nh?n ph�m "enter" trong th? input');

			var timkiem = $('#search_n_timkiem').val();
			$.ajax({
				type: 'POST',
				data: {timkiem:timkiem},
				url: "<?php  echo site_url('/home/search_n') ?>",
				success: function(data){

				},
				error: function(){
					
				}
			});
		}
	});
</script>