		<nav class="navbar navbar-stem navbar-fixed-top">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand navbar-brand1" href="<?php echo site_url('home_user') ?>">
						<img class="hidden-xs" src="<?php echo base_url('images/hu_logo_home1.png');?>" alt="">
						<img class="visible-xs-block logo-s" src="<?php echo base_url('images/hu_logo_home1.png');?>" height="32" alt="">
					</a>
					<div class="pull-right text-trang-mobile visible-xs-block">
						<a class="text-trang hover text-center text-l" href="<?php echo site_url('library/video'); ?>">
							<i class="mr-5 fas fa-cloud"></i>
							<br class="hidden-xs">
						</a>
						<a class="text-trang hover text-center text-l"  href="<?php echo site_url('home_user/notifications') ?>">
							<i class="far fa-bell"></i>
							<span class="badge badge-sm up bg-pink count ncount mr-5"></span>
							<!-- <i class="mr10 fa fa-angle-right"></i> -->
						</a>
						<a href="#" class="text-trang hover " data-toggle="collapse" data-target="#search_top" id="icosearch_top">
							<i class="fas fa-search"></i>
						</a>
					</div>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="panel-collapse collapse" id="search_top">
					<form class="navbar-form navbar-left" role="search">
						<div class="input-group">
							<input id="inpsearch_top"  class="form-control form-TK1 w350" placeholder="Tìm kiếm" type="text">
							<a  class="input-group-addon addon-TK1  searchbt"><i class="fa fa-search" aria-hidden="true"></i></a>
						</div>
					</form>
				</div>
				<div class="panel-collapse" id="search_top_dt">
					<form class="navbar-form navbar-left" role="search">
						<div class="input-group">
							<input id="inpsearch_top_dt"  onkeyup="search_question(this, event)" class="form-control form-TK1 w350" placeholder="Tìm kiếm" type="text">
							<a  class="input-group-addon addon-TK1 pointer searchbt"><i class="fa fa-search" aria-hidden="true"></i></a>
						</div>
					</form>
				</div>
				<div class="collapse navbar-collapse" id="defaultNavbar1">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user'); ?>"><i class="mr-5 fas fa-home"></i><br class="hidden-xs">Trang chủ</a>
						</li>
						<li>
							<a class="text-trang hover text-center text-l" href="<?php  echo site_url('home_user/assign_quiz')?>"><i class="mr-5 far fa-calendar-check"></i><br class="hidden-xs">Nhiệm vụ</a>
						</li>
						<li>
							<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user/results'); ?>" ><i class="mr-5 far fa-chart-bar"></i><br class="hidden-xs">Kết quả</a>
						</li>
						<li>
							<a class="text-trang hover text-center text-l" href="<?php echo site_url('library/video'); ?>"><i class="mr-5 fas fa-cloud"></i><br class="hidden-xs">Thư viện</a>
						</li>
			<!--<li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('message'); ?>"><i class="far fa-envelope"></i><span class="badge badge-sm up bg-pink count mcount"></span><br  class="hidden-xs">Tin nhắn</a>
			</li>-->
			<li class="dropdown ndropdown pointer">
				<a class="text-trang hover text-center text-l" data-toggle="dropdown">
					<i class="far fa-bell"></i>
					<span class="badge badge-sm up bg-pink count ncount mr-5"></span>
					<br  class="hidden-xs">Thông báo
				</a>
				<div  class="dropdown-menu" id="notifications">
					<!-- <h3>Notifications</h3> -->
					<header class="dropdown__header fx-lt">
						<div class="dropdown__title fx mr10"> 
							<span translate="">
								<span>Thông báo</span>
							</span> 
						</div>
						<a class="dropdown__setting">
							<i class="udi fas fa-cog"></i>
						</a>
					</header>
					<div class="notification__list">
					</div>
					<div class="dropdown__footer">
						<a class="link--dropdown-footer link--see-all" href="<?php echo site_url('home_user/notifications') ?>">
							Xem tất cả
							<i class="mr10 fa fa-angle-right"></i>
						</a>
					</div>
				</div>
			</li>
			<li class="dropdown"><a href="#" class="dropdown-toggle bt-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				<?php if($link_photo) { ?>
					<img id="avt" class=" img-circle MR5" src="<?php echo $link_photo;?> " alt="" width="32" height="32">
				<?php } else{ ?>   
					<img id="avt" class=" img-circle MR5" src="<?php echo base_url('upload/avatar/default.png');?> " alt="" width="32">
				<?php } ?> 
				<span class="caret caret_e"></span></a>
				<ul class="dropdown-menu dropdown-menu1">
  	           <!-- <li><a href="#"><i class="MR10 far fa-file-alt text-primary" aria-hidden="true"></i>Bảng tin</a></li>
  	            <li><a href="#"><i class="MR10 far fa-comments text-danger" aria-hidden="true"></i>Tin nhắn</a></li>
  	            <li><a href="#"><i class="MR10 fas fa-th-large text-success" aria-hidden="true"></i>Khóa học</a></li>
  	            <li><a href="#"><i class="MR10 fas fa-calendar text-danger" aria-hidden="true"></i>Sự kiện</a></li>
  	            <li><a href="#"><i class="MR10 fas fa-users text-info" aria-hidden="true"></i>Nhóm</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-address-book text-warning" aria-hidden="true"></i>Dánh sách bạn bè</a></li> -->
  	            <li><a data-toggle="modal" data-target="#transferModal" href="#"><i class="MR10 fas fa-exchange-alt text-warning" aria-hidden="true"></i>Chuyển điểm</a></li>
  	            <li><a href="<?php echo site_url('profile')?>"><i class="MR10 fas fa-user text-success" aria-hidden="true"></i>Thông tin cá nhân</a></li>
  	            <li><a data-toggle="modal" data-target="#changepwdModal" href="#"><i class="MR10 fas fa-cog" aria-hidden="true"></i>Đổi mật khẩu</a></li>
  	            <li><a href="<?php echo site_url('user/logout');?>"><i class="MR10 fas fa-sign-out-alt"></i> Đăng xuất</a></li>
  	        </ul>
  	    </li>
				<!-- <li>
				<a class="text-trang hover text-center text-TV" href="#">Mời thành viên</a>
			</li> -->
		</ul>
	</div>
	<!-- /.navbar-collapse -->
</div>
</nav><!--end nav-->
<div class="modal fade" id="transferModal" role="dialog">
			<div class="modal-dialog">	 
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Chuyển điểm</h4>

					</div>
					<div class="modal-body">
						<form method="post" action="<?php echo site_url('tranfer_point/tranfer_1/');?>">
							<div class="col-md-12">
								<p class="col-md-4">Chuyển tới:</p>
								<input  class="col-md-8" type="text" class="form-control" name="user_received" value="" placeholder="Nhập vào email của người bạn muốn cho điểm"  required />
							</div>
							<div class="col-md-12">
								<p class="col-md-4">Số điểm cần chuyển:</p>
								<input  class="col-md-8"  type="number" class="form-control" name="point_tranfer" value="" placeholder="Nhập số điểm cần chuyển" min=0 required />
							</div>
							<div class="col-md-12">
								<p class="col-md-4">Mật khẩu:</p>
								<input class="col-md-8" type="password" class="form-control" name="pwd_tranfer" value="" placeholder="Nhập mật khẩu tài khoản của bạn"  required />
							</div> 
							<div class="col-md-12">
								<p class="col-md-4">Nhập lại mật khẩu:</p>
								<input class="col-md-8" type="password" class="form-control" name="cmf_pwd_tranfer" value="" placeholder="Nhập lại mật khẩu tài khoản của bạn"  required />
							</div> 
							<div class="col-md-offset-10">
								<button  style="margin-top:30px" class="btn btn-success" type="submit">Xác nhận</button>
							</div>
						</form>

					</div>

				</div>

			</div>
		</div>