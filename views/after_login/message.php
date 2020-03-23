<!DOCTYPE html>
<html lang="en">
  	<head>
	    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Tin nhắn</title>
		<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
		<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('css/message.css');?>" rel="stylesheet">
		<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
		<script src="<?php echo base_url('js/bootstrap.js');?>"></script> 
		<script>
			var base_url="<?php echo base_url();?>";
			var site_url="<?php echo site_url();?>";
		</script>
		<script src="<?php echo base_url('js/left-menu.js');?>"></script>
		<script src="<?php echo base_url('js/notification.js');?>"></script>
		<script src="<?php echo base_url('js/message.js');?>"></script>
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
		<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
		<script src="<?php echo base_url('js/jquery.nicescroll.min.js');?> "></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
			<![endif]-->
  	</head>
	<body class="bg-body">
		<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
			  <a class="navbar-brand navbar-brand1" href="#">
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
			    <input id="inpsearch_top" class="form-control form-TK1 w350" placeholder="Tìm kiếm" type="text">
			    <a href="#" class="input-group-addon addon-TK1 searchbt"><i class="fa fa-search" aria-hidden="true"></i></a>
			  </div>
			</form>
		</div>
		<div class="panel-collapse" id="search_top_dt">
			 <form class="navbar-form navbar-left" role="search">
			  <div class="input-group">
			    <input id="inpsearch_top_dt" class="form-control form-TK1 w350" placeholder="Tìm kiếm" type="text">
			    <a href="#" class="input-group-addon addon-TK1 searchbt"><i class="fa fa-search" aria-hidden="true"></i></a>
			  </div>
			</form>
		</div>
  	    <div class="collapse navbar-collapse" id="defaultNavbar1">
  	       
 	        <ul class="nav navbar-nav navbar-right">
  	        <li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user'); ?>"><i class="mr-5 fas fa-home"></i><br class="hidden-xs">Trang chủ</a>
			</li>
			<li>
				<a class="text-trang hover text-center text-l" href="#assign_quiz" onclick="quizAssignTo(event);"><i class="mr-5 far fa-calendar-check"></i><br class="hidden-xs">Nhiệm vụ</a>
			</li>
			<li>
				<a class="text-trang hover text-center text-l" href="#result" onclick="resultItem(event);" ><i class="mr-5 far fa-chart-bar"></i><br class="hidden-xs">Kết quả</a>
			</li>
			<!-- <li>
				<a class="text-trang hover text-center" href="#"><i class="fas fa-cloud"></i><br>Thư viện</a>
			</li>-->
			<li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('message'); ?>"><i class="far fa-envelope"></i><span class="badge badge-sm up bg-pink count mcount"></span><br  class="hidden-xs">Tin nhắn</a>
			</li>
			<li class="dropdown ndropdown">
				<a class="text-trang hover text-center text-l" data-toggle="dropdown">
					<i class="far fa-bell"></i>
					<span class="badge badge-sm up bg-pink count ncount mr-5" "></span>
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
  	        	<span class=" 
caret caret_e 
"></span></a>
  	          <ul class="dropdown-menu dropdown-menu1">
				<li><a data-toggle="modal" data-target="#transferModal" href="#"><i class="MR10 fas fa-exchange-alt text-warning" aria-hidden="true"></i>Chuyển điểm</a></li>
  	            <li><a href="<?php echo site_url('profile')?>"><i class="MR10 fas fa-user text-success" aria-hidden="true"></i>Thông tin cá nhân</a></li>
				<li><a data-toggle="modal" data-target="#changepwdModal" href="#"><i class="MR10 fas fa-cog" aria-hidden="true"></i>Đổi mật khẩu</a></li>
  	            <li><a href="<?php echo site_url('user/logout');?>"><i class="MR10 fas fa-sign-out-alt"></i> Đăng xuất</a></li>
              </ul>
            </li>
          </ul>
        </div>
  	    <!-- /.navbar-collapse -->
  	</div>
  </nav><!--end nav-->
  <script type="text/javascript">
  	$(function(){
		$('.chat-list-wrapper, .message-list-wrapper').niceScroll();
	})
  </script>
	<div class="MT70 mess">
		<div class="list-friend">
			<div class="banner-chat mbc" role="banner">
				<div class="setting-chat">
				</div>
				<h1 class="title-chat">Tin nhắn</h1>
				<a aria-label="Tin nhắn mới" class="new-msg newmsg" role="button" tabindex="0" title="Tin nhắn mới" data-href="#"></a>
			</div>
			<div class="friend-main">
				<div class="friend-main-content" style="height: 550px;">
					<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 550px;">
						<div class="searchbox_">
							<span class="search-friend">
								<label class="search-friend-label">
									<input class="search-friend-input" type="text" name="search-friend-input" placeholder="Tìm kiếm tin nhắn" autocomplete="off" value="" spellcheck="false" />
								</label>
							</span>
							<i class="hidden_elem clear-search-input"></i>
							<span class="search-value" aria-hidden="true">Send messenger</span>
						</div>
						<div id="js_msg" aria-label="Conversations" class="" role="navigation">
							<div>
								<h2 class="accessible_elem">Conversation List</h2>
								<ul class="clist" aria-label="Conversation List" role="grid">
									<li class="d-flex c-item">
										<div class="d-flex f-one" role="gridcell">
											<a class="d-flex f-one cpdl" data-href="#">
												<div class="avt d-flex">
													<div>
														<div class="po-re d-img">
															<div class="c-imgd d-img">
																<div class="dimg d-img">
																	<img src="https://scontent.fhan3-3.fna.fbcdn.net/v/t1.0-1/p50x50/35924315_645069149159168_127382798649524224_n.jpg?_nc_cat=0&amp;oh=619b3c99eac2cb1a6dee19c9751afb5b&amp;oe=5BA02409" alt="" class="img" width="50" height="50">
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="dflex-col c-item-content">
													<div class="_jcontk d-flex">
														<span class="c-uname c-new"><span>Em gái yêu quý</span></span>
														<div>
															<dodd class="_1ht7 timestamp">Tue</dodd>
														</div>
													</div>
													<div class="_jcontk d-flex">
														<span class="c-msg c-new"><span>You sent a sticker.</span></span>
													</div>
												</div>
											</a>
										</div>
										<div role="gridcell">
											<div class="c-action d-flex"></div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="slimScrollBar" style=" position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px;  background: rgb(0, 0, 0);"></div>
						<div class="slimScrollRail" style="  position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div>
					</div>
				</div>
			</div>
		</div>
		<div id="js_mainc" class="chat-main" role="main">
			<span class="chat-main-content">
				<div class="chat-main-header">
					<div class="chat-main-title">
						<h2 class="titlex"><span class="titlexsp">Chuong Trinh</span></h2>
						<span class="timeonline"></span>
						<ul class="_fl2"></ul>
					</div>
				</div>
				<div class="_20bp"></div>
			</span>
		</div>
	</div>
	<div class="modal fade" id="newMsgModal" role="dialog">
		<div class="modal-dialog">	 
			 <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-footer convers-body">
					<div>
						<span class="search-friend">
							<label class="search-friend-label">
								<input class="search-friend-input" type="text" name="search-friend-input" placeholder="Tìm kiếm" autocomplete="off" value="" spellcheck="false" />
							</label>
						</span>
						<i class="hidden_elem clear-search-input" style="top: 70px;"></i>
						<span class="search-value" aria-hidden="true">Send messenger</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>