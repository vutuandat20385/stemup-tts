<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tìm kiếm</title>
	<?php $this->load->view('stemup/head_not_login');?>
	<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
	<style type="text/css">
		table.table tr td a{
			text-decoration: none;
		}
	</style>
</head>
<body>
	<script>
		window.fbAsyncInit = function() {
			FB.init({
				xfbml            : true,
				version          : 'v3.3'
			});
		};

		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<div id="wrapwrap" class="">
		<header class="container-fluid bg-stemup hidden-xs">
			<div class="container">	<?php $this->load->view('stemup/home/home_header');?>	</div>
		</header>
		<nav class="navbar navbar-default mb-6">
			<div class="container">
				<?php $this->load->view('stemup/home/home_header_mobile');?>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div id="div-mobile" class="collapse navbar-collapse pad-0 hidden-sm hidden-md hidden-lg">
					
					<form class="login-form" style="" role="search" method="post" action="<?php echo site_url('/login/stemupverifylogin');?>">
						<div class="form-group mt-5">
							<input type="text" class="login-input" id="emailph" name="emailph" placeholder="Email phụ huynh">
							<input type="text" class="login-input" id="namehs" name="namehs" placeholder="Tên học sinh">

							<input type="password" class="login-input" id="pwd" name= "password" placeholder="Mật khẩu"><br>
							
						</div>
						<button type="submit" class="btn btn-success btn-login-mobile">Đăng nhập</button>
						
					</form>
				</div>
				<!-- <div class="menu_n collapse navbar-collapse pad-0" id="defaultNavbar1">		   -->

					<div class="menu_n collapse navbar-collapse pad-0" id="defaultNavbar1">		  

						<ul class="nav navbar-nav">
							<li class="active"><a href="<?php echo site_url(); ?>">Trang chủ</a></li>
							<li class="dropdown">
								<!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Về stemup<span class="caret"></span>
								</a> -->
								<ul class="dropdown-menu">
									<li><a href="#loiich">Lợi ích khi dùng STEMUP</a></li>
									<li><a href="#nguoidung">Người dùng nói về STEMUP</a></li>
									<li><a href="#baochi">Báo chí nói về STEMUP</a></li>

								</ul>
							</li>       
							<li><a href="<?php echo site_url('home/guide');?>">Hướng dẫn</a></li>
							<li><a href="<?php echo site_url('home/faq');?>">Câu hỏi thường gặp</a></li>
							<li><a href="<?php echo site_url('home/setup');?>">Cài đặt</a></li>
							<li><a href="<?php echo site_url('home/news');?>">Tin tức</a></li>
							<li><a href="<?php echo site_url('home/contact')?>">Liên hệ</a></li>
						</ul>
						<form method="get" class="navbar-form navbar-right" role="search" action="<?php echo site_url('home/search_n') ?>">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Tìm kiếm" name="timkiem" id="search_n_timkiem">
								<!-- <div id="error_n" style="color: red;"></div> -->
								<div class="input-group-btn">
									<button class="btn btn-default" type="submit">
										<i class="glyphicon glyphicon-search" id="glyphicon"></i>
									</button>
								</div>
							</div>
							<script type="text/javascript">
								$('#glyphicon').on('click',function(){
									var timkiem = $('#search_n_timkiem').val();
								// var error_n = $("#error_n");
								// error_n.html("");
								if(timkiem==''){
									alert('Mời bạn nhập nội dung cần tìm kiếm');
									// error_n.html("<i>Mời bạn nhập nội dung cần tìm kiếm</i>");
									return false;
								}

							});
						</script>
					</form>
					<!-- <?php //echo "<pre>";
					//var_dump($_GET['timkiem']) ;
					//echo "</pre>"; ?>
				-->
			</script>
			  <!--<ul class="nav navbar-nav navbar-right">
				 <li><button type="submit" class="btn btn-danger mr-15 bt-caidat">Cài đặt STEMUP</button></li>
				</ul>-->

			</div>
			<!-- /.navbar-collapse -->			
		</div>
		<!-- /.container-fluid -->
	</nav>

	<main class="container MT70">
		<section class="row">
			<?php if($post['status']==0){ ?>

				<h3 class="bNg8Rb timkiem">Không tìm thấy '<?php echo $timkiem;?>' trong tài liệu nào.</h3>
			<?php }else{ ?>

				<h2 class="bNg8Rb timkiem">Kết quả tìm kiếm '<?php echo $timkiem;?>'.</h2>
			<?php } ?>
			<table class="table table-hover">
				<tbody>
					<?php foreach ($post['slide'] as $key => $value) {?>

						<tr>
							<td class="col-md-12">
								<img class="search_n" src="<?php echo $value['avatar'] ?>" style="float: left; padding-right: 7px">

								<a class="thum-top2" href="<?php echo site_url('home/tintuc'.'/'.$value['url_name'])?>" >
									<h4 class="LC20lb LC20lbb"><?php echo $value['name']; ?></h4>
									<div class="TbwUpd TbwUpd1">
										<!-- <cite class="iUh30 bc" style="color: #006621"><?php //echo site_url('home/search_n').'/'.$value['url_name'] ?></cite> -->
									</div>
								</a>
								<div class="TbwUpd2" >
									<cite class="iUh30 bc nhat"><?php echo $value['description'] ?></cite>
								</div>
								<div class="TbwUpd2 time_n" style="font-size: 15px;color: #000000">
									<?php 
									$timeEng = ['Sunday','Monday','Tuesday','Wednesday', 'Thursday', 'Friday', 'Saturday', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
									$timeVie = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy','Một', 'Hai', 'Ba', 'Tư', 'Năm', 'Sáu', 'Bảy', 'Tám', 'Chín', 'Mười', 'Mười Một', 'Mười Hai'];
									$time =strtotime($value['modify_date']);
									$time=date('l, d/m/Y H:i:s',$time);
									$time = str_replace( $timeEng, $timeVie, $time);
									echo '('.$time.')';
									?>
								</div>
							</td>
						</tr>
					<?php } ?>

				</tbody>
			</table>
			<ul class="pagination" style="margin-left: 34%;margin-top: -1%;">
				<?php echo $links ?>
			</ul>
		</section>	
	</main>
	<footer>
		<div class="oe_structure" id="footer">
			<section>
				<?php $this->load->view('stemup/footer');?>
			</section>
		</div>
	</footer>
</div>
</body>
</html>

<script type="text/javascript">
	$('#search_n_timkiem').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (keycode == '13') {
			// alert('Bạn vừa nhấn phím "enter" trong thẻ input');

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
<!-- <script id="tracking_code">
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', _.str.trim(' UA-101093405-2'), 'auto');
	ga('send','pageview');
</script> -->
