			<!-- Collect the nav links, forms, and other content for toggling -->
			<div id="div-mobile" class="collapse navbar-collapse pad-0 hidden-sm hidden-md hidden-lg">

				<form class="login-form" style="" role="search" method="post" action="<?php echo site_url('/login/stemupverifylogin'); ?>">
					<div class="form-group mt-5">
						<input type="text" class="login-input" id="emailph" name="emailph" placeholder="Email phụ huynh">
						<input type="text" class="login-input" id="namehs" name="namehs" placeholder="Tên học sinh">
						<input type="password" class="login-input" id="pwd" name="password" placeholder="Mật khẩu"><br>

					</div>
					<button type="submit" class="btn btn-success btn-login-mobile">Đăng nhập</button>

				</form>
			</div>
			<!-- <div class="menu_n collapse navbar-collapse pad-0" id="defaultNavbar1">		   -->

			<div class="menu_n collapse navbar-collapse pad-0" id="defaultNavbar1">

				<ul class="nav navbar-nav">
					<li class="home_"><a href="<?php echo site_url(); ?>">Trang chủ</a></li>
					<li id="guide_"><a href="<?php echo site_url('home/guide'); ?>">Hướng dẫn</a></li>
					<li id="faq_"><a href="<?php echo site_url('home/faq'); ?>">Câu hỏi thường gặp</a></li>
					<li id="setup_"><a href="<?php echo site_url('home/setup'); ?>">Cài đặt</a></li>
					<li id="news_"><a href="<?php echo site_url('home/news'); ?>">Tin tức</a></li>
					<!-- <li id="contact_"><a href="<?php echo site_url('home/contact') ?>">Liên hệ</a></li> -->
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
						$('#glyphicon').on('click', function() {
							var timkiem = $('#search_n_timkiem').val();
							// var error_n = $("#error_n");
							// error_n.html("");
							if (timkiem == '') {
								alert('Mời bạn nhập nội dung cần tìm kiếm');
								// error_n.html("<i>Mời bạn nhập nội dung cần tìm kiếm</i>");
								return false;
							}

						});
					</script>
				</form>
				<!--<ul class="nav navbar-nav navbar-right">
				 <li><button type="submit" class="btn btn-danger mr-15 bt-caidat">Cài đặt STEMUP</button></li>
				</ul>-->

			</div>
			<!-- /.navbar-collapse -->