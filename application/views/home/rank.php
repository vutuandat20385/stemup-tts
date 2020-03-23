<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang chủ</title>
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
    <!-- Bootstrap -->
	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
	  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	 <script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>

	<script src="<?php echo base_url('js/newpage.js');?>"></script>
	<script src="<?php echo base_url('js/signup.js');?>"></script>
	
 
    	<script src="<?php echo base_url('js/rank.js');?>"></script>
	<script>
		var base_url = "<?php echo base_url();?>";
		var site_url = "<?php echo site_url();?>";
		var su = "<?php echo $su ?>";
		var id_mcq_fun = "";
		var id_quiz_fun = "";
		$(document).ready(function(){
			$.datepicker.regional["vi-VN"] =
	{
		closeText: "Đóng",
		prevText: "Trước",
		nextText: "Sau",
		currentText: "Hôm nay",
		monthNames: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
		monthNamesShort: ["Một", "Hai", "Ba", "Bốn", "Năm", "Sáu", "Bảy", "Tám", "Chín", "Mười", "Mười một", "Mười hai"],
		dayNames: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"],
		dayNamesShort: ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"],
		dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
		weekHeader: "Tuần",
		dateFormat: "dd/mm/yy",
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ""
	};

	$.datepicker.setDefaults($.datepicker.regional["vi-VN"]);
	
	$( "#datepicker_event" ).datepicker({
    	dateFormat:"dd/mm/yy",
		maxDate: "+0D"
	});
		})
	</script>
   <script>	
	var base_url="<?php echo base_url();?>";
    var site_url="<?php echo site_url();?>";
	var su="<?php echo $su ?>";
	var id_mcq_fun="";
	var id_quiz_fun="";
	</script>
		  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> <script> (adsbygoogle = window.adsbygoogle || []).push({ google_ad_client: "ca-pub-3948834986570227", enable_page_level_ads: true }); </script>
  </head>
  <body class="bg-body">
  <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php     
	            if($this->session->flashdata('message_r')){echo '<script>$(document).ready(function(){$("#error_login").modal();});</script>';} 
				
				?>	

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
			  <a class="navbar-brand navbar-brand1" href="<?php echo site_url('home') ?>">
					<img class="hidden-xs" src="<?php echo base_url('images/hu_logo_home1.png');?>" alt="">
					<img class="visible-xs-block logo-s" src="<?php echo base_url('images/hu_logo_home1.png');?>" height="32" alt="">
			  </a>
			<div class="pull-right text-trang-mobile visible-xs-block">
				
				
				<a class="text-trang hover" data-toggle="dropdown">
					<i class="far fa-bell"></i>
					<span class="badge badge-sm up bg-pink count ncount"></span>
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
			    <input id="inpsearch_top_dt" class="form-control form-TK1 w350" placeholder="Tìm kiếm" type="text" onkeyup="search_question(this, event)" >
			    <a href="#" class="input-group-addon addon-TK1 searchbt"><i class="fa fa-search" aria-hidden="true"></i></a>
			  </div>
			</form>
		</div>
  	    <div class="collapse navbar-collapse" id="defaultNavbar1">
  	         <div class="row" style="float:right; margin-top:10px">
					
		
				 
					<div class="form-group col-md-3 col-xs-6 hidden-xs">	  
						 
					
						<button class="btn btn-sm btn-default btn-primary pull-right mb-5 dropdown-toggle" type="button" data-toggle="dropdown">Đăng nhập</button>
						 <div class="dropdown-menu " style="margin-left:-260px;">
						     <div class="arrow_box arrow-box-top"></div>
							 <div style="padding:10px">
								<form class="form-signin" method="post" action="<?php echo site_url('login/verifylogin');?>">
								     <div id="error" style="color: red;"></div>
								     <div id="ok" style="color: green"></div>
									 <input class="page-signin-form-control form-control" name="email" style="width:350px;margin:10px" placeholder="<?php echo $this->lang->line('email_address');?>" type="text" required autofocus id="email">
									 <input class="page-signin-form-control form-control" name="password" style="width:270px;margin:10px" id="inputPassword" placeholder="<?php echo $this->lang->line('password');?>" type="password" required>
		                           	<input style="margin: 10px;" name="remember" type="checkbox">Tự động đăng nhập
									 <button style="z-index:2; margin-top:-42px; margin-right:17px"class="btn btn-sm btn-default btn-primary pull-right mb-5" type="submit" id="btn_subit">Đăng nhập</button>
									 
									<!-- <table>
										 <tr>
											<td style="padding:10px">
												<a class="btn"  style="background:#3C66C4;color:#ffffff;" href="<?php echo  site_url('hauth/login/Facebook');?>" > <i class="fab fa-facebook-f"></i> Đăng nhập với Facebook </a>
											 </td>
											 <td style="padding:10px">
												<a class="btn btn-danger"  href="<?php echo  site_url('sso/login');?>" > <i class="fab fa-google"></i> Đăng nhập với Itrithuc.vn </a>
											 </td>
										 </tr>
									 </table>-->
									 <a href="#" data-toggle="modal" data-target="#resetpwdModal" style="float:right; padding:10px"> Quên mật khẩu</a>
									 <script type="text/javascript">
									 	$('#btn_subit').on('click',function(){
									 		var username = $("#email").val();
									 		var password = $("#inputPassword").val();
									 		var error = $("#error");
									 		var ok = $("#ok");
							 				// resert 2 thẻ div thông báo trở về rỗng mỗi khi click nút đăng nhập
											error.html("");
											//ok.html("");
 
											// Kiểm tra nếu username rỗng thì báo lỗi
											if (username == "") {
												console.log('wetgw rthwrth5555');
												error.html("Địa chỉ Email không được để trống");
												return false;
											}
											if (password == "") {
												console.log('wetgw rthwrth5555');
												error.html("Password không được để trống");
												return false;
											}
											
											// Kiểm tra nếu password rỗng thì báo lỗi
											/*if (password == "") {
												console.log('mat khau khong de trng');
												error.html("Mật khẩu không được để trống");
												return false;
											}*/

											// Chạy ajax gửi thông tin username và password về server check_dang_nhap.php
											// để kiểm tra thông tin đăng nhập hợp lệ hay chưa
											/*$.ajax({

											  url: "Signup/create_user",
											  method: "POST",
											  data: { email : username, password : password },
											  success : function(response){
											  	if (response == "1") {
											  		ok.html("Đăng nhập thành công!");
											  	console.log('agadfdafgsdfg');
											  	}else{
											  		error.html("Password không được để trống!");
											  		console.log('da33333333333333333');
											  	}
											  }
											});*/
										});
									 </script>
								 </form>
							 </div>
							 
						 </div>
					</div>

                    <button class="btn btn-sm btn-default btn-primary mb-5 hidden-dt" type="button" onclick="login()">Đăng nhập</button>
					<button type="submit" class="btn btn-sm btn-default btn-success" onclick="signup()">Đăng ký</button>
 	        
          
        </div>
  	    <!-- /.navbar-collapse -->
  </div>
  	  <!-- /.container-fluid -->
	<section class="visible-xs-block nav-mobile">
			<ul class="ul-mobile list-unstyled">
				<li><a href="<?php echo site_url("home")?>">Câu hỏi vui</a></li>
				<li><a  href="<?php echo site_url("home/quiz_list")?>">Trắc nghiệm</a></li>
				<li><a  href="<?php echo site_url("home/about")?>">Giới thiệu</a></li>
				<li><a  class="pointer" data-toggle="collapse" data-target="#more_menu">...</a></li>
			</ul>  
		<ul id="more_menu" class="panel-collapse collapse ul-mobile list-unstyled">	
	         <li><a  href="<?php echo site_url("home/about")?>">Hướng dẫn</a></li>
			 <li><a href="<?php echo site_url("home/about")?>">Điều khoản sử dụng</a></li>
		</ul>
	</section>
	  
  </nav><!--end nav-->
<main class="container MT70">
   
    
	<section class="row">
  	  <aside class="col-md-2 hidden-xs">
	  
	     <div style="margin-top:-20px;" class="div-leftbar-home">
			<?php if($level_categ_list){?>
		         <div style="margin-top:20px">			   
				    <div class="list-group hidden-xs" >
					  <a href="<?php echo site_url('page/category/'.$category_permalink)?>"> <h3 class="list-group-item active1"><?php echo $category_name;?></h3></a>
					 <?php foreach($level_categ_list as $lv){?>
					    
						 <a href="<?php echo site_url('page/category/'.$category_permalink.'/'.$lv['permalink']);?>"  class="list-group-item <?php if($lv['lid']==$level_id){?> active <?php } ?>">  <?php echo $lv['level_name'];?></a>
					 <?php }?>
					</div>
			<?php } else{?>
			<div style="position:sticky;top:70px">
			<?php }?>
				<div class="list-group hidden-xs" >
					 <h3 class="list-group-item active1">Trắc nghiệm</h3>
					 <a href="<?php echo site_url("home")?>"  class="list-group-item"> <i class="fas fa-question-circle" style="margin-right:5px"></i> Câu hỏi vui</a>
					
					  <a href="<?php echo site_url('home/quiz_list') ?>"  class="list-group-item"><i class="fas fa-book" style="margin-right:5px"></i> Bài trắc nghiệm</a>
				  
				</div>
				<div class="list-group hidden-xs" >
					 <h3 class="list-group-item active1">Về chúng tôi</h3>
					 <a href="<?php echo site_url('home/about') ?>"  class="list-group-item"><i class="fas fa-bullseye" style="margin-right:5px"></i> Giới thiệu</a>
					 <a href="<?php echo site_url('home/detail/user_terms') ?>"  class="list-group-item"><i class="fas fa-object-group" style="margin-right:5px"></i> Điều khoản sử dụng</a>
					 <a href="<?php echo site_url('home/detail/guidelines') ?>"  class="list-group-item"><i class="fas fa-folder-open" style="margin-right:5px"></i> Hướng dẫn</a>
				  
			    </div>
			</div>
		  
       </div> 
  	  </aside>  
	   <aside class="col-md-7" id="mainbar">
		
		 
		 
		<div class="modal fade" id="loginmodal" role="dialog">
			<div class="modal-dialog" style="width:30%">	
              <div class="box-popup1">			
				 <div class="modal-content">
					<form class="form-signin" method="post" action="<?php echo site_url('login/verifylogin');?>">
					 
					 <input class="page-signin-form-control form-control login-email" name="email" placeholder="<?php echo $this->lang->line('email_address');?>" type="text" required autofocus>
					 <input class="page-signin-form-control form-control login-pwd" name="password" id="inputPassword" placeholder="<?php echo $this->lang->line('password');?>" type="password" required  >
					<input style="margin: 10px;" name="remember" type="checkbox">Tự động đăng nhập
					 <button style="z-index:2; margin-top:-42px; margin-right:17px"class="btn btn-sm btn-default btn-primary pull-right mb-5" type="submit">Đăng nhập</button>
					 
					<!-- <table>
						 <tr>
							<td style="padding:10px">
								<a class="btn social-login"  style="background:#3C66C4;color:#ffffff;" href="<?php echo  site_url('hauth/login/Facebook');?>" > <i class="fab fa-facebook-f"></i> Đăng nhập với Facebook </a>
							 </td>
							 <td style="padding:10px">
								<a class="btn btn-danger social-login"  href="<?php echo  site_url('hauth/login/Google');?>" > <i class="fab fa-google"></i> Đăng nhập với Google </a>
							 </td>
						 </tr>
					 </table>-->
					 
					 <a href="#" data-toggle="modal" data-target="#resetpwdModal" style=" padding:10px"> Quên mật khẩu</a>
				 </form>
				 </div>	
			   </div>
			  
			</div>
		</div>
		
		<div class="modal fade" id="loginmodal2" role="dialog">
			<div class="modal-dialog" style="width:30%">	 
				 <div class="modal-content">
				 <div class="box-popup1">
					<form class="form-signin" method="post" action="<?php echo site_url('login/verifylogin2');?>">
					 <input type="text" style="display:none" id="model" name="model" value=""/>
					  <input type="text" style="display:none" id="id_login" name="id_login" value="0"/>
					   <input type="text" style="display:none" id="opt_choice" name="opt_choice" value=""/>
					 <input class="page-signin-form-control form-control login-email" name="email" placeholder="<?php echo $this->lang->line('email_address');?>" type="text" required autofocus>
					 <input class="page-signin-form-control form-control login-pwd" name="password" id="inputPassword" placeholder="<?php echo $this->lang->line('password');?>" type="password" required  >
					<input style="margin: 10px;" name="remember" type="checkbox">Tự động đăng nhập
					 <button style="z-index:2; margin-top:-42px; margin-right:17px"class="btn btn-sm btn-default btn-primary pull-right mb-5" type="submit">Đăng nhập</button>
					 <!--<table>
						 <tr>
							<td style="padding:10px">
								<a class="btn social-login fb-login"  style="background:#3C66C4;color:#ffffff;" href="<?php echo  site_url('hauth/login/Facebook');?>" > <i class="fab fa-facebook-f"></i> Đăng nhập với Facebook </a>
							 </td>
							 <td style="padding:10px">
								<a class="btn btn-danger social-login gp-login"  href="<?php echo  site_url('hauth/login/Google');?>" > <i class="fab fa-google"></i> Đăng nhập với Google </a>
							 </td>
						 </tr>
					 </table>-->
					 <a href="#" data-toggle="modal" data-target="#resetpwdModal" style=" padding:10px"> Quên mật khẩu</a>
				 </form>
				 </div>	
				 </div>
			  
			</div>
		</div>
		
         
		<div class="modal fade" id="popup_require_login" role="dialog" onclick="dismiss_modal(this)">
			<div class="modal-dialog">	 
				 <div class="modal-content">
						<div class="box-popup">
					<div class="bg-xanhnhat">
						<div class="icon">
							<img src="<?php echo base_url();?>images/thongbao.png" alt="">
						</div>
					</div>
					<div class="box-chon">
						<h4 class="text-center mb-20 mt-0">Vui lòng <button class="btn btn-info smlg ">Đăng nhập</button> hoặc <button class="btn btn-success smsn">Đăng ký</button> để thực hiện thao tác này!</h4>
					</div>

				</div>

					
				 </div>
				  
			</div>
		</div>
	      
		
		<div class="box-bor1 mb-20">
			<div role="tabpanel">
				<ul class="nav nav-tabs">
					<li class="active"><a class="f21" href="#home1" data-toggle="tab" role="tab" aria-controls="tab1">
							Bảng xếp hạng (
							<span id="day_ev">
								<?php echo $today;?></span>)</a></li>
					<li><a href="#paneTwo1" data-toggle="tab" role="tab" aria-controls="tab2">
							Bảng xếp hạng Tuần
							<?php echo $no_week_of_month ?> tháng
							<?php echo $month ?></a></li>
					<li><a href="#paneTwo2" data-toggle="tab" role="tab" aria-controls="tab2">
							Bảng xếp hạng tổng</a></li>
				</ul>
				<div id="tabContent1" class="tab-content">
				<div style="width:100%;text-align:right;padding-left:2px;margin-bottom:5px;margin-top:5px">
					<span class="glyphicon glyphicon-star"></span>
					<select id="slCid" onchange="allrankcategory(this)">
					<option value="default" selected disabled>Xếp hạng</option>
					<option value="0">Tất cả</option>
						<?php foreach($category_list as $ctgr){
							?>	
							<option value="<?php echo $ctgr['cid'] ?>"><?php echo $ctgr['category_name'] ?></option>
							<?php
						} ?>
					</select>
					<div style="display:none">
						<input type="text" id="inf_rank_ctgr" value='0'>
					</div>
				</div>
					<div class="tab-pane fade in active" id="home1">
						<table class="table table-hover table-striped" id="tbl_ev_byday">
							<thead>
								<tr class="bg-eee">
									<th class="text-center">#</th>
									<th>Tên</th>
									<th class="text-right">Điểm đố</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($todaay_points as $i=>$dp){?>
								<tr>
									<td class="text-center <?php if($i<3){ ?> bg-primary <?php } ?>">
										<?php echo ($i+1)?>
									</td>
									<td>
										<?php echo $dp['last_name']." ".$dp['first_name'] ?></a></td>
									<td class="text-right">
										<?php echo $dp['points']; ?>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<div class="row">
							<div class="col-xs-12" title="Xem theo ngày">
								<a class="pull-right ">
									<i class="far fa-calendar-alt mr-5"></i>
									<input id="datepicker_event" type="button" style="margin-right:5px" value="Xem theo ngày">
								</a>
							</div>
							<center>
								<ul class="pagination listpage pagerankday">
									<?php if($num_page_day>6){?>
									<li class="page-item active" onclick="drawpage_rank_day(0)"><a class="page-link">1</a></li>
									<li class="page-item" onclick="drawpage_rank_day(1)"><a class="page-link">2</a></li>
									<li class="page-item" onclick="drawpage_rank_day(2)"><a class="page-link">3</a></li>
									<li class="page-item" onclick="drawpage_rank_day(3)"><a class="page-link">4</a></li>
									<li class="page-item" onclick="drawpage_rank_day(4)"><a class="page-link">5</a></li>
									<?php if($num_page_day>7){ ?>
									<li class="page-item"><a class="page-link">...</a></li>
									<?php } ?>
									<li class="page-item" onclick="drawpage_rank_day(<?php  echo $num_page_day-1 ?>)"><a class="page-link">
											<?php echo $num_page_day ?></a></li>
									<?php }else{?>
									<li class="page-item active" onclick="drawpage_rank_day(0)"><a class="page-link">1</a></li>
									<?php for($i=1; $i<$num_page_day; $i++){?>
									<li class="page-item" onclick="drawpage_rank_day(<?php  echo $i ?>)"><a class="page-link">
											<?php  echo $i+1 ?></a></li>
									<?php }?>
									<?php }?>
								</ul>
							</center>
						</div>
					</div>
					<div style="display:none">
						<input type="text" id="inf_rank_page_day" value="0">
						<input type="text" id="inf_rank_day_day" value="<?php echo $todaay ?>">
					</div>
					<div class="tab-pane fade" id="paneTwo1">
						<table class="table table-hover table-striped" id="tbl_ev_byweek">
							<thead>
								<tr class="bg-eee">
									<th class="text-center">#</th>
									<th>Tên</th>
									<th class="text-right">Điểm Đố</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($week_points as $i=>$wp){?>
								<tr>
									<td class="text-center <?php if($i<3){ ?> bg-primary <?php } ?>">
										<?php echo ($i+1)?>
									</td>
									<td>
											<?php echo $wp['last_name']." ".$wp['first_name'] ?></a></td>
									<td class="text-right">
										<?php echo $wp['points']; ?>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<div class="row">
							<center>
								<ul class="pagination listpage pageweekday">
									<?php if($num_page_week>6){?>
									<li class="page-item active" onclick="drawpage_week_day(0)"><a class="page-link">1</a></li>
									<li class="page-item" onclick="drawpage_week_day(1)"><a class="page-link">2</a></li>
									<li class="page-item" onclick="drawpage_week_day(2)"><a class="page-link">3</a></li>
									<li class="page-item" onclick="drawpage_week_day(3)"><a class="page-link">4</a></li>
									<li class="page-item" onclick="drawpage_week_day(4)"><a class="page-link">5</a></li>
									<?php if($num_page_week>7){ ?>
									<li class="page-item"><a class="page-link">...</a></li>
									<?php } ?>
									<li class="page-item" onclick="drawpage_week_day(<?php  echo $num_page_week-1 ?>)"><a class="page-link">
											<?php echo $num_page_week ?></a></li>
									<?php }else{?>
									<li class="page-item active" onclick="drawpage_week_day(0)"><a class="page-link">1</a></li>
									<?php for($i=1; $i<$num_page_week; $i++){?>
									<li class="page-item" onclick="drawpage_week_day(<?php  echo $i ?>)"><a class="page-link">
											<?php  echo $i+1 ?></a></li>
									<?php }?>
									<?php }?>
								</ul>
							</center>
						</div>
					</div>
					<div style="display:none">
						<input type="text" id="inf_rank_week_page" value="0">
						<input type="text" id="inf_rank_week_monday" value="<?php echo $monday ?>">
						<input type="text" id="inf_rank_week_sunday" value="<?php echo $sunday ?>">
					</div>
					<div class="tab-pane fade" id="paneTwo2">
						<table class="table table-hover table-striped" id="tbl_ev_byalltime">
							<thead>
								<tr class="bg-eee">
									<th class="text-center">#</th>
									<th>Tên</th>
									<th class="text-right">Điểm Đố</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($alltime_points as $i=>$atp){?>
								<tr>
									<td class="text-center <?php if($i<3){ ?> bg-primary <?php } ?>">
										<?php echo ($i+1)?>
									</td>
									<td>
											<?php echo $atp['first_name']." ".$atp['last_name'] ?></a></td>
									<td class="text-right">
										<?php echo $atp['points']; ?>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<div class="row">
							<center>
								<ul class="pagination listpage pageallday">
									<?php if($num_page_all>6){?>
									<li class="page-item active" onclick="drawpage_all_day(0)"><a class="page-link">1</a></li>
									<li class="page-item" onclick="drawpage_all_day(1)"><a class="page-link">2</a></li>
									<li class="page-item" onclick="drawpage_all_day(2)"><a class="page-link">3</a></li>
									<li class="page-item" onclick="drawpage_all_day(3)"><a class="page-link">4</a></li>
									<li class="page-item" onclick="drawpage_all_day(4)"><a class="page-link">5</a></li>
									<?php if($num_page_all>7){ ?>
									<li class="page-item"><a class="page-link">...</a></li>
									<?php } ?>
									<li class="page-item" onclick="drawpage_all_day(<?php  echo $num_page_all-1 ?>)"><a class="page-link">
											<?php echo $num_page_all ?></a></li>
									<?php }else{?>
									<li class="page-item active" onclick="drawpage_all_day(0)"><a class="page-link">1</a></li>
									<?php for($i=1; $i<$num_page_all; $i++){?>
									<li class="page-item" onclick="drawpage_all_day(<?php  echo $i ?>)"><a class="page-link">
											<?php  echo $i+1 ?></a></li>
									<?php }?>
									<?php }?>
								</ul>
							</center>
						</div>
					</div>
					<div style="display:none">
						<input type="text" id="inf_rank_all_day" value="0">
					</div>
				</div>
			</div>
		</div>
			


	
      </aside>
      <aside class="col-md-3 rightbar">
      	
	   <div class="box-bor">
		  <h3 class="text-xanh1"><a href="<?php echo site_url('home/quiz_list')?>">BÀI TRẮC NGHIỆM </a></h3>
		  <?php foreach($quiz_fun_rb as $k=>$qz){?>
		     
				  <div <?php if($k!=count($quiz_fun_rb)-3){ ?> style="margin-bottom:20px" class="bo-B" <?php } ?>>
					<div style="margin-bottom:10px"><a class="pointer" href="<?php echo site_url('page/quiz/'.$qz['permalink']);?>"> <img src="<?php echo $qz['img'];?> " width="100%"></a><br/>
					</div>
					 <a style="font-size:15px;" class="pointer" href="<?php echo site_url('page/quiz/'.$qz['permalink']);?>"><b><?php echo $qz['quiz_name'];?></a></b>
				 </div>
			  
		   <?php }?>
		  
        </div>
		
      </aside>
     
    </section>
  	</main>
  	

  </body>


</html>
