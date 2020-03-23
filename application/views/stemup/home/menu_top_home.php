
				<div class="menu_n collapse navbar-collapse pad-0" id="defaultNavbar1">		  

					<ul class="nav navbar-nav">
						<li class="active"><a href="<?php echo site_url(); ?>">Trang chủ</a></li>
						<!-- <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Về stemup<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#loiich">Lợi ích khi dùng STEMUP</a></li>
								<li><a href="#nguoidung">Người dùng nói về STEMUP</a></li>
								<li><a href="#baochi">Báo chí nói về STEMUP</a></li>

							</ul>
						</li>        -->
						<li><a href="<?php echo site_url('home/guide');?>">Hướng dẫn</a></li>
						<li><a href="<?php echo site_url('home/faq');?>">Câu hỏi thường gặp</a></li>
						<li><a href="<?php echo site_url('home/setup');?>">Cài đặt</a></li>
						<li><a href="<?php echo site_url('home/news');?>">Tin tức</a></li>
						<!-- <li><a href="<?php echo site_url('home/contact')?>">Liên hệ</a></li> -->
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