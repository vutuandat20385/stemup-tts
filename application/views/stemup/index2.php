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

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="<?php echo base_url('js/stemup_js/jquery-1.12.4.min.js');?>"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo base_url('js/stemup_js/bootstrap-3.4.1.js');?>"></script>
	<script src="<?php echo base_url('js/stemup_js/script.js');?>"></script>

</head>
<body>
	<!-- import header -->
	<?php
        $this->load->view("stemup/headerNav");
	?>
	
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
				<a class="navbar-brand visible-xs-block" href="#"><img class="" src="<?php echo base_url('images/stemup_images/logo_stemsup.svg')?>" height="40" alt=""></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse pad-0" id="defaultNavbar1">		  

				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Trang chủ</a></li>
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
								<div class="slide-1" style="background-image: url(<?php echo base_url('images/stemup_images/Carousel_Placeholder4.png')?>)">
									<div class="carousel-caption carousel-caption1">
										<h1 class="tle-slide"><a class="text-tintop" href="">100 tài khoản miễn phí trọn đời dành tặng phụ huynh</a></h1>
									</div>
								</div>
							</div>
							<div class="item slides">
								<div class="slide-2" style="background-image: url(<?php echo base_url('images/stemup_images/Carousel_Placeholder1.png')?>)">
									<div class="carousel-caption carousel-caption1">
										<h1 class="tle-slide"><a class="text-tintop" href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a></h1>
									</div>
								</div>
							</div>
							<div class="item slides">
								<div class="slide-3" style="background-image: url(<?php echo base_url('images/stemup_images/Carousel_Placeholder2.png')?>)">
									<div class="carousel-caption carousel-caption1">
										<h1 class="tle-slide"><a class="text-tintop" href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a></h1>
									</div>
								</div>
							</div>
						</div>
						<a class="left carousel-control carousel-control-nghechoi" href="#thumbnail-preview-indicators" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
						<a class="right carousel-control carousel-control-nghechoi" href="#thumbnail-preview-indicators" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
					</div> <!--end slide-->
					
					<a class="left carousel-control" href="#carousel1" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel1" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-xs-6 pl-1 pr-1">
							<a class="thum-top1" href="" style="background-image: url(<?php echo base_url('images/stemup_images/Carousel_Placeholder.png')?>)">
								<span class="text-top1">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
							</a>
						</div>
						<div class="col-xs-6 pl-1 pr-1">
							<a class="thum-top1" href="" style="background-image: url(<?php echo base_url('images/stemup_images/Carousel_Placeholder.png')?>)">
								<span class="text-top1">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 pl-1 pr-1">
							<a class="thum-top1" href="" style="background-image: url(<?php echo base_url('images/stemup_images/Carousel_Placeholder1.png')?>)">
								<span class="text-top1">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
							</a>
						</div>
						<div class="col-xs-6 pl-1 pr-1">
							<a class="thum-top1" href="" style="background-image: url(<?php echo base_url('images/stemup_images/Carousel_Placeholder.png')?>)">
								<span class="text-top1">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="loiich" class="container-fluid bg-xanh pd-30">
			<div class="container">
				<h1 class="tle">Lợi ích khi dùng STEMUP</h1>
				<div class="row">
					<div class="col-md-3 text-center">
						<p class="text-trang" href="">
							<span class="vongtrong"><i class="fab fa-steam-symbol fa-4x"></i></span><br>
							Học sinh được luyện kỹ năng STEM - yếu tố sống còn để cạnh tranh trong Kỷ nguyên 4.0; rèn kỹ năng sống nhờ kho bài tập trắc nghiệm video hấp dẫn do Bộ GD&ĐT và VTV sản xuất
						</p>
					</div>
					<div class="col-md-3 text-center">
						<p class="text-trang" href="">
							<span class="vongtrong"><i class="fa fa-users fa-3x"></i></span><br>
							Tăng kết nối cha mẹ - con cái. Bạn chỉ cần vài phút mỗi ngày để học cùng con, biết rõ con thích môn gì, yếu kỹ năng nào…
						</p>
					</div>
					<div class="col-md-3 text-center">
						<p class="text-trang" href="">
							<span class="vongtrong"><i class="fa fa-spell-check fa-3x"></i></span><br>
							STEMUP không tạo thêm gánh nặng bài tập cho học sinh, giúp học sinh vui học thông qua trả lời câu hỏi trắc nghiệm thú vị.
						</p>
					</div>
					<div class="col-md-3 text-center">
						<p class="text-trang" href="">
							<span class="vongtrong"><i class="fa fa-chalkboard-teacher fa-3x"></i></span><br>
							Học sinh sử dụng smartphone, máy tính, internet một cách hiệu quả, lành mạnh.
						</p>
					</div>
				</div>
			</div>
		</section>
		<section id="nguoidung" class="container-fluid bg1 pd-30" style="background-image: url(<?php echo base_url('images/stemup_images/bg1.png')?>)">
			<div class="container">
				<h1 class="tle">Người dùng nói về STEMUP</h1>
				<div class="carousel-reviews broun-block">
					<div class="container">
						<div class="row">
							<div id="carousel-reviews" class="carousel slide" data-ride="carousel">

								<div class="carousel-inner">
									<div class="item active">
										<div class="col-md-4 col-sm-6">
											<div class="block-text rel zmin">
												<a title="" href="#">Bùi Phan Vĩnh</a>
												<div class="mark">Đánh giá: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
												<p>Ứng dụng rất hay.  Tôi có thể giao bài tập cho con hàng ngày. Nội dung bài kiểm ra rất đa dạng có cả video và bài đọc trong mỗi bài kiểm tra. Cháu nhà tôi rất thích.</p>
												<ins class="ab zmin sprite sprite-i-triangle block"></ins>
											</div>
											<div class="person-text rel">
												<img alt="" src="<?php echo base_url('images/stemup_images/img14.png')?>">
												<a title="" href="#">Bùi Phan Vĩnh</a>
												<i>Lê Thanh Nghị, Hai Bà trưng, Hà Nội</i>
											</div>
										</div>
										<div class="col-md-4 col-sm-6 hidden-xs">
											<div class="block-text rel zmin">
												<a title="" href="#">anh Trần Việt Anh</a>
												<div class="mark">Đánh giá: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star-empty"></span><span data-value="3" class="glyphicon glyphicon-star-empty"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
												<p>"Dùng STEMUP đúng là học cùng con thật. Nhiều kiến thức mình đã quên từ đời nảo đời nào, giờ như được học lại, rồi chém gió với con, khỏi sợ mất hình tượng"</p>
												<ins class="ab zmin sprite sprite-i-triangle block"></ins>
											</div>
											<div class="person-text rel">
												<img alt="" src="<?php echo base_url('images/stemup_images/img13.png')?>">
												<a title="" href="#">anh Trần Việt Anh</a>
												<i>thành phố Vinh, Nghệ An</i>
											</div>
										</div>
										<div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
											<div class="block-text rel zmin">
												<a title="" href="#"> bà Trần Quế Phương</a>
												<div class="mark">Đánh giá: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star"></span><span data-value="5" class="glyphicon glyphicon-star"></span>  </span></div>
												<p>"Con gái tôi là mẹ đơn thân, buôn bán bận tối mắt mà vẫn phải kèm con học, tôi muốn giúp nhưng ngày xưa học không giỏi, biết gì đâu mà dạy cháu. Thế rồi con tải cái STEMUP này về điện thoại của tôi, hướng dẫn tôi chỉ cần làm thế này thế này là được. Giờ thì ngoài lướt Facebook, tôi còn ra bài tập cho cháu rồi nhận xét kết quả rành rọt nữa"</p>
												<ins class="ab zmin sprite sprite-i-triangle block"></ins>
											</div>
											<div class="person-text rel">
												<img alt="" src="<?php echo base_url('images/stemup_images/img15.png')?>">
												<a title="" href="#"> bà Trần Quế Phương</a>
												<i>Thanh Hóa</i>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="col-md-4 col-sm-6">
											<div class="block-text rel zmin">
												<a title="" href="#">chị Trần Hồng</a>
												<div class="mark">Đánh giá: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
												<p>"Bà cụ non lớp Sáu nhà tôi hôm qua bảo, nếu bài tập các cô giáo cho cũng click nhoắng một lát là xong thế này thì bọn con khỏe. Đúng thật, cũng chừng ấy kiến thức mà làm kiểu STEMUP thì nhanh hơn nhiều"</p>
												<ins class="ab zmin sprite sprite-i-triangle block"></ins>
											</div>
											<div class="person-text rel">
												<img alt="" src="<?php echo base_url('images/stemup_images/img13.png')?>">
												<a title="" href="#">chị Trần Hồng</a>
												<i>Linh Đàm, Hà Nội</i>
											</div>
										</div>
										<div class="col-md-4 col-sm-6 hidden-xs">
											<div class="block-text rel zmin">
												<a title="" href="#">chị Hoa Nguyễn</a>
												<div class="mark">Đánh giá: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star-empty"></span><span data-value="3" class="glyphicon glyphicon-star-empty"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
												<p>“Mình giao hẹn với cậu cả là nếu làm xong bài trắc nghiệm mẹ giao qua STEMUP sẽ được chơi game 30 phút. Cậu ấy mặc cả 60 phút, cuối cùng chốt deal là 40 phút. Hôm nào về muộn mải làm việc nhà chưa kịp giao bài là cậu ấy giục. Hai bên đều phấn khởi” </p>
												<ins class="ab zmin sprite sprite-i-triangle block"></ins>
											</div>
											<div class="person-text rel">
												<img alt="" src="<?php echo base_url('images/stemup_images/img14.png')?>">
												<a title="" href="#">chị Hoa Nguyễn</a>
												<i>quận Hai Bà Trưng, Hà Nội</i>
											</div>
										</div>
										<div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
											<div class="block-text rel zmin">
												<a title="" href="#">anh Nguyễn Chính</a>
												<div class="mark">Đánh giá: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star"></span><span data-value="5" class="glyphicon glyphicon-star"></span>  </span></div>
												<p>"Con tôi không chăm học lắm. Cháu thường nhăn nhó khi được giao bài tập. Nhưng với bài tập trên STEMUP thì anh chàng khá vui vẻ vì ‘không tốn nhiều thời gian của con’. Đây cũng là lý do tôi dám dùng thử STEMUP vì nếu mất thời gian thì tôi đành chịu vì quá bận"</p>
												<ins class="ab zmin sprite sprite-i-triangle block"></ins>
											</div>
											<div class="person-text rel">
												<img alt="" src="<?php echo base_url('images/stemup_images/img15.png')?>">
												<a title="" href="#">anh Nguyễn Chính</a>
												<i>Mỹ Đình, Hà Nội</i>
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
		<section id="baochi" class="container-fluid bg-xam pd-30">
			<div class="container">
				<h1 class="tle1">Báo chí nói về STEMUP</h1>
				<div class="carousel-reviews broun-block">
					<div class="container">
						<div class="row">
							<div class="col-md-10 col-md-offset-1">
								<div id="carousel-reviews12" class="carousel slide" data-ride="carousel">

									<div class="carousel-inner">
										<div class="item active">
											<div class="col-xs-3">
												<a class="bn-bao" href=""><img class="img-responsive mb-6" src="<?php echo base_url('images/stemup_images/khpt-DT.png')?>" alt=""></a>
											</div>
											<div class="col-xs-3">
												<a class="bn-bao" href=""><img class="img-responsive mb-6" src="<?php echo base_url('images/stemup_images/dnvn-logo.png')?>" alt=""></a>
											</div>
											<div class="col-xs-3">
												<a class="bn-bao" href=""><img class="img-responsive mb-6" src="<?php echo base_url('images/stemup_images/session13-4.png')?>" alt=""></a>
											</div>
											<div class="col-xs-3">
												<a class="bn-bao" href=""><img class="img-responsive" src="<?php echo base_url('images/stemup_images/logo_header.png')?>" alt=""></a>
											</div>
										</div>
										<div class="item">
											<div class="col-xs-3">
												<a class="bn-bao" href=""><img class="img-responsive mb-6" src="<?php echo base_url('images/stemup_images/khpt-DT.png')?>" alt=""></a>
											</div>
											<div class="col-xs-3">
												<a class="bn-bao" href=""><img class="img-responsive mb-6" src="<?php echo base_url('images/stemup_images/dnvn-logo.png')?>" alt=""></a>
											</div>
											<div class="col-xs-3">
												<a class="bn-bao" href=""><img class="img-responsive mb-6" src="<?php echo base_url('images/stemup_images/session13-4.png')?>" alt=""></a>
											</div>
											<div class="col-xs-3">
												<a class="bn-bao" href=""><img class="img-responsive" src="<?php echo base_url('images/stemup_images/logo_header.png')?>" alt=""></a>
											</div>
										</div>                  
									</div>
									<a class="left carousel-control left1" href="#carousel-reviews12" role="button" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left top36"></span>
									</a>
									<a class="right carousel-control right1" href="#carousel-reviews12" role="button" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right top36"></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- import footer -->
		<?php
			$this->load->view("stemup/footerBottom");
		?>




	</body>
	</html>