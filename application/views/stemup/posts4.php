<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Liên hệ</title>
	<?php $this->load->view('stemup/head'); ?>
	<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="" crossorigin="anonymous">
	
	<script type="text/javascript" src="/web/content/2286-7cda5ba/web.assets_common.js"></script>
	<script type="text/javascript" src="/web/content/10113-ebd264e/web.assets_frontend.js"></script>
	
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
			<div class="container">

				<a class="logo" href=""><img class="" src="<?php echo base_url('images/stemup_images/logo_stemsup.svg');?>" height="60" alt=""></a>
				<form class="navbar-form pull-right mt-15 pad-0" role="search" method="post" action="<?php echo site_url('/login/stemupverifylogin');?>">
					<div class="form-group mt-5">
						<input type="text" class="form-control" id="emailph" name="emailph" placeholder="Email phụ huynh">
						<input type="text" class="form-control" id="namehs" name="namehs" placeholder="Tên học sinh">
						<input type="password" class="form-control" id="pwd" name= "password" placeholder="Mật khẩu"><br>
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
					<button type="submit" class="btn btn-success mt-5" id="button12">Đăng nhập</button>
					<script type="text/javascript">
						$('#button11').on('click',function(){
							var emailph = $("#emailph").val();
							var namehs = $("#namehs").val();
							var password = $("#pwd").val();
							var error = $("#error");
							var ok = $("#ok");
		 				// resert 2 thẻ div thông báo trở về rỗng mỗi khi click nút đăng nhập
		 				error.html("");
						//ok.html("");
						
						// Kiểm tra nếu username rỗng thì báo lỗi
						if (emailph == "") {
							console.log('wetgw rthwrth5555');
							error.html("Địa chỉ Email không được để trống");
							return false;
						}
						if (namehs == "") {
							console.log('wetgw rthwrth5555');
							error.html("Tên học sinh không được để trống ");
							return false;
						}
						if (password == "") {
							console.log('wetgw rthwrth5555');
							error.html("Password không được để trống");
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
					Đăng Nhập
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

				<form class="login-form" style="" role="search" method="post" action="<?php echo site_url('/login/stemupverifylogin');?>">
					<div class="form-group mt-5">
						<input type="text" class="login-input" id="emailph" name="emailph" placeholder="Email phụ huynh">
						<input type="text" class="login-input" id="namehs" name="namehs" placeholder="Tên học sinh">
						<input type="password" class="login-input" id="pwd" name= "password" placeholder="Mật khẩu"><br>

					</div>
					<button type="submit" class="btn btn-success btn-login-mobile">Đăng nhập</button>

				</form>
			</div>
			<div class="collapse navbar-collapse pad-0" id="defaultNavbar1">		  

				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Trang chủ</a></li>
					<li><a href="<?php echo site_url('home/guide');?>">Hướng dẫn</a></li>
					<li><a href="<?php echo site_url('home/faq');?>">Câu hỏi thường gặp</a></li>
					<li><a href="<?php echo site_url('home/setup');?>">Cài đặt</a></li>
					<li><a href="<?php echo site_url('home/news');?>">Tin tức</a></li>
					<li><a href="<?php echo site_url('home/contact')?>">Liên hệ</a></li>
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

	<main>
		<div class="js_blog website_blog" id="wrap">
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<ol class="breadcrumb">
							<li><a href="/blog/hoc-vien-stem-1"><span>Stemup</span></a></li>


							<li class="active"><span>Vì sao hoa tre lại bị coi là hoa của nạn đói?</span></li>
						</ol>
					</div>
					
				</div>
				<div class="container text-muted">
					<div class="blog_title text-center">
						<h1 id="blog_post_name" placeholder="Blog Post Title" data-blog-id="160">Vì sao hoa tre lại bị coi là hoa của nạn đói? </h1>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-1"></div>
					<div class="col-sm-10">
						<div class="">
							<img class="picture_n" src="<?php echo base_url('images/stemup_images11/pic4.jpg')?>" >
						</div>
					</div>
					<div class="col-sm-1"></div>
				</div>
			</div>
			
		</div>

		<div class="container text-muted">
			<div class="blog_title text-center">
				<h2 placeholder="Subtitle" style="font-size:160%;">Bạn có rất ít cơ hội nhìn thấy tre ra hoa, kết quả,  ít đến nỗi thậm chí nhiều người còn không tin là trên đời có hoa tre hay quả tre. Và vì thế, ít người biết rằng ở một số xứ sở, tre bị coi là loài chết chóc vì sự kiện tre nở hoa thường đi kèm với nạn đói. Vì sao vậy?</h2>
				<p class="post-meta text-muted text-center" name="blog_post_data"></p>

			</div>
		</div>
		<div class="blog_content mt32 js_comment" id="blog_content">
			<section class="s_text_block">
				<div class="container">
					<div class="row">
						<div class="col-md-12 mb16 mt16">
							<p class="o_default_snippet_text">Tre sinh trưởng rất nhanh, chỉ 5 đến 8 năm đã trưởng thành, nhưng trong chuyện ra hoa thì thuộc hàng chậm chạp nhất thế giới thực vật. Theo Tri Thức Trẻ, phải mất 60 đến 130 năm, cây tre mới ra hoa một lần. Kỳ lạ hơn, tất cả tre nở hoa cùng một lúc trên khắp thế giới, bất kể vị trí địa lý và khí hậu, bởi các cá thể tre ở các khu vực địa lý khác nhau vẫn mang bộ gene từ cùng một cây mẹ. Do đó, một cây tre ở Bắc Mỹ có thể ra hoa cùng lúc với cây tre anh em nó ở châu Á. Điều này giống như cây tre có một đồng hồ sinh học bên trong, cài sẵn báo thức để bừng nở cùng lúc. Hiện tượng ra hoa hàng loạt này được gọi là ra hoa theo quần thể.</p><p class="o_default_snippet_text">Tre chỉ nở hoa và kết quả một lần duy nhất trong đời, sau đó sẽ chết. Có giả thuyết cho rằng việc sản sinh hạt giống đòi hỏi một năng lượng khổng lồ khiến cây kiệt quệ. </p><p class="o_default_snippet_text">Việc tre nở hoa sẽ làm gia tăng các loài này gặm nhấm trong khu vực. Sự sẵn có đột ngột của thức ăn số lượng lớn đã thu hút hàng loạt con chuột đói ăn, và chúng tăng trưởng theo cấp số nhân. Lũ chuột đông đúc sau khi chén hết chỗ thức ăn này sẽ ăn sang các cây trồng khác gần đó, bao gồm cây lương thực. Do đó những lần tre ra hoa gần như luôn kéo theo nạn đói và bệnh tật ở các làng gần đó. Điều này đã xảy ra ở bang Mizoram, miền đông bắc Ấn Độ, vào năm 2006 đến năm 2008 khi loài tre Melocanna baccifera ra hoa kết trái. Hiện tượng này trong tiếng địa phương được gọi là “mautam”, có nghĩa là "loài tre chết chóc". </p><p class="o_default_snippet_text">Thông tin trên có làm bạn thích thú không? Hãy kể cho con bạn và cùng trẻ tiếp tục nội dung về hoa tre trên app STEMUP nhé. Bạn tải app theo link sau: http://stemup.app. Có 2 loại app: STEMUP dành cho phụ huynh ( màu đỏ) và STEMUP dành cho học sinh (màu cam). Sau khi cài đặt app, bạn chỉ cần đăng nhập tài khoản “đi theo” của con mình là đã có thể giao bài cho con.    </p>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
</main>
<footer>
	<div class="oe_structure" id="footer">
		<section>
			<?php $this->load->view('stemup/footer');?>
		</section>
	</div>
</footer>
</div>
<!-- <script>
	document.addEventListener("DOMContentLoaded", function(event) {
		odoo.define('im_livechat.livesupport', function (require) {
		});
	});
</script>
<script id="tracking_code">
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', _.str.trim(' UA-101093405-2'), 'auto');
	ga('send','pageview');
</script> -->
<div id="trans_div" style="display: none;"></div></body>
</body>
</html>