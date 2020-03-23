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
	var base_url="<?php echo base_url();?>";
    var site_url="<?php echo site_url();?>";
	var su="<?php echo $su ?>";
	var id_mcq_fun="<?php echo $id_mcq_fun ?>";
	var id_quiz_fun="<?php echo $id_quiz_fun ?>";
	</script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> <script> (adsbygoogle = window.adsbygoogle || []).push({ google_ad_client: "ca-pub-3948834986570227", enable_page_level_ads: true }); </script>
  </head>
  <body class="bg-body">
  <div id="fb-root"></div>
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
}(document, 'script', 'facebook-jssdk'));</script>
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
				<!-- <a class="text-trang hover text-center text-l" href="<?php echo site_url('library/video'); ?>">
					<i class="mr-5 fas fa-cloud"></i>
					<br class="hidden-xs">
				</a>
				<a class="text-trang hover text-center text-l"  href="<?php echo site_url('home_user/notifications') ?>">
					<i class="far fa-bell"></i>
					<span class="badge badge-sm up bg-pink count ncount mr-5"></span>
					 <i class="mr10 fa fa-angle-right"></i>
				</a> -->
				<a href="#" class="text-trang hover " data-toggle="collapse" data-target="#search_top" id="icosearch_top">
					<i class="fas fa-search"></i>
				</a>
			     <!--  -->
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
    
    <div class="event-banner" style="margin-bottom:10px">
		<a href=""><img class="img-responsive" style="width:1150px" src= "<?php echo base_url("images/web.png") ?>"></a>
	</div> 
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
					 <h3 class="list-group-item active1">Phân loại</h3>
					 <a href="<?php echo site_url("page/categories")?>"  class="list-group-item"> <i class="fas fa-filter" style="margin-right:5px"></i> Chuyên mục</a>
				  
				</div>
				<div class="list-group hidden-xs" >
					 <h3 class="list-group-item active1">Về chúng tôi</h3>
					 <a href="<?php echo site_url('home/about1') ?>"  class="list-group-item"><i class="fas fa-bullseye" style="margin-right:5px"></i> Giới thiệu</a>
					 <a href="<?php echo site_url('home/detail3/user_terms') ?>"  class="list-group-item"><i class="fas fa-object-group" style="margin-right:5px"></i> Điều khoản sử dụng</a>
					 <a href="<?php echo site_url('home/detail1/guidelines') ?>"  class="list-group-item"><i class="fas fa-folder-open" style="margin-right:5px"></i> Hướng dẫn</a>
					 <a href="<?php echo site_url('home/detail2/policy') ?>"  class="list-group-item"><i class="fa fa-window-restore" style="margin-right:5px"></i> Chính sách riêng tư</a>
			    </div>
			</div>
		  
       </div> 
  	  </aside>  
	   <aside class="col-md-7" id="mainbar">
		
		 <?php foreach( $mcq_fun as $mcq) {?>
		 <div class="box-bor1 mb-20 moremcq_<?php echo $mcq['qid']?>">
	
			  <div>
				  <div class="row1" style="margin-top:20px">
					  <div class="col-xs-10">
						  <div class="w60"><a class="pointer" ><img class="img-responsive img-circle" src="<?php echo base_url('upload/symbol/'.$mcq['cid'].'.png');?>" alt=""></a></div>
						  	<h4 class="mb-0">
						  		<a class="pointer" href="<?php echo site_url('/page/category/'.$mcq['category_permalink'])?>">
						  			<b><?php echo $mcq['category_name']?></b>
						  		</a> 
							    	<span style="margin-left:10px" class="dropdown pointer ">
							    		<a class="dropdown-toggle"  data-toggle="dropdown">
											<span class="caret caret_e" ></span>
										</a>
							   			<div class="dropdown-menu_e dropdown-menu"style="overflow-y: scroll;height: 273px;font-size:15px">
							       			<?php foreach ($category_list as $ct){?>
									    	<li>
									    		<a href="<?php echo site_url('/page/category/'.$ct['category_permalink'])?>">
									    			<b><?php echo $ct['category_name']?></b>
									    		</a>
									    	</li>
								   			<?php } ?>
										</div>
									</span>
								
						    	<br>
							</h4>
						  <span class="text-small1"><?php echo $mcq['str_time_ago'] ?></i></span>
					  </div>
					  
					 
				  </div>
				 <div class="col-xs-12" style="margin-bottom:10px">
				        <?php if(strpos($mcq['question'],'latex.codecogs.com')!==false || strpos($mcq['question'],'www.w3.org/1998/Math/MathML')!==false){?>
						   
							<a href="<?php echo site_url('page/question/'.$mcq['permalink'].'/notsolved'); ?>" target="_blank" style="color:#000; font-size:30px">
						  
								<?php echo $mcq['question']?>
							 
						  
						  </a>
						<?php } else{?>
						
				        <a href="<?php echo site_url('page/question/'.$mcq['permalink'].'/notsolved'); ?>" target="_blank" style="color:#fff">
					   <?php if(strpos($mcq['question'], '<iframe')===false && strpos($mcq['question'], '<img')===false){?>

					   <div class="bgqtdiv" >
							<font color="white">
								<div style="background-image:url('https://stemup.app/upload/background/<?php if($mcq['background_template']!=0){ echo $mcq['background_template'];} else{ echo rand(1,20);}?>.jpg'); " class="outer bgqt">
									<div class="middle">
										<div class="inner" >
										  
											<?php 
											
											$des=html_entity_decode(strip_tags($mcq['question'])) ;
											
											if (strpos($mcq['question'],'https://latex.codecogs.com')===false &&  mb_strlen($des, 'UTF-8')>120){
												$pos=strpos($des," ",110); 
												
												echo substr($des,0,$pos).'... <a  style="text-shadow: -2px 0 white, 0 2px white, 2px 0 white, 0 -1px white;" class="pointer" onclick="show_question_none_login('.$mcq['qid'].')">Xem thêm</a><div class="hiddenlqt" style="display:none">'.$des.'</div>';
											}else{
												echo $des;
											}
										
											
											?>s
										</div>
									</div>
								 </div>
							</font>
							<?php if($mcq['create_su']==3 && $mcq['text_license'] && $mcq['show_logo']==1) {?>
							<div class="imgwlogo" >
									<a href="<?php echo $mcq['out_link']?>" target="_blank"> 
										<div class="logobanner">
										
											<div >
											  
												<table style="width:100%">
												  <tr>
												   <td style=" padding: 5px 10px;">
												  <?php if($mcq['logo']){?>
												  <div class="logoimg">
														<img src="<?php echo $mcq['logo'] ?>">
												  </div>
												  <?php }?>
												  </td>
												   <td class="textorg" >
												     <div  class="contentbn">
														<i style="font-weight:200px">Cung cấp bởi</i> <b><a><?php echo $mcq['text_license'] ?></b></a>
													 </div>
												   </td>
												 
												 </tr> 
											   </table>
											   
											</div>
									  
										 </div>
									   </a>
								</div>
							<?php }?>
					  </div>
					   <?php } else{?>
					     <?php if(strpos($mcq['question'], '<iframe')===false){ ?>
						 <div class="mcq_multimd assqid-<?php echo $mcq['qid']?>">
							<center style="margin-bottom:20px">
							 <?php if($mcq['create_su']==3 && $mcq['text_license'] && $mcq['show_logo']==1) {?>
								<div class="imgwlogo">
									 <a href="<?php echo site_url('page/question/'.$mcq['permalink'].'/notsolved'); ?>" target="_blank">
										<img class="img-responsive" style="width:100%" src="<?php echo $mcq['img'] ?>"/>
									</a>
									<a href="<?php echo $mcq['out_link']?>" target="_blank"> 
										<div class="logobanner">
										
											<div >
											  
												<table style="width:100%">
												  <tr>
												   <td style=" padding: 5px 10px;">
												  <?php if($mcq['logo']){?>
												  <div class="logoimg">
														<img src="<?php echo $mcq['logo'] ?>">
												  </div>
												  <?php }?>
												  </td>
												   <td class="textorg" >
												     <div  class="contentbn">
														<i style="font-weight:200px">Cung cấp bởi</i> <b><a><?php echo $mcq['text_license'] ?></b></a>
													 </div>
												   </td>
												 
												 </tr> 
											   </table>
											   
											</div>
									  
										 </div>
									   </a>
								</div>
							 <?php } else{?>
							      <a href="<?php echo site_url('page/question/'.$mcq['permalink'].'/notsolved'); ?>" target="_blank">
										<img class="img-responsive" style="width:100%" src="<?php echo $mcq['img'] ?>"/>
								  </a>
							<?php } ?>
							</center>
							 <a href="<?php echo site_url('page/question/'.$mcq['permalink'].'/notsolved'); ?>" target="_blank">
							    <?php echo strip_tags($mcq['question'])?>
							</a>
						 </div>
						 <?php } else{?>
							<div style="color:#000; font-weight:700"><?php echo $mcq['question']?></div>
						 <?php }?>
						<?php }?>
					 
					  </a>
					  <?php }?>
				  </div>
				  
				<div class="col-xs-12 div_opt">
					  <div class="row MB20 twopt">
						<div class="col-xs-6 mobile-opt mobmb20" onclick="popup_require_login3(<?php echo $mcq['qid'] ?>,1)"> 
							<label class="radio-inline w-100">
								 
								   <input class="mt-5 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='0'>
								   <div class="input-group mobile-text-opt" >
		
									 <span class="input-group-addon opt-mb2 bo-input-left"></span>
									  <span id="optA1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> 
									  <table>
										<tr><td><b> A:</b> </td>
										 <td><?php echo html_entity_decode($mcq['options'][0]['q_option'])?> </td>
										 </tr></table>
									  </span>
								   </div>
							
							</label>
						</div>
						<div class="col-xs-6 mobile-opt" onclick="popup_require_login3(<?php echo $mcq['qid'] ?>,2)"> 
							<label class="radio-inline w-100">
								 
								   <input class="mt-5 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='1'>
								   <div class="input-group mobile-text-opt" >
									 <span class="input-group-addon opt-mb2 bo-input-left"></span>
									  <span id="optB1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> 
									  <table>
										<tr><td><b> B:</b> </td>
										 <td><?php echo html_entity_decode($mcq['options'][1]['q_option'])?> </td>
										 </tr></table>
									  </span>
								   </div>
							
							</label>
						</div>
					</div>
					<div class="row" >
						<?php if(!in_array(html_entity_decode($mcq['options'][2]['q_option']),array("", " ","  ", "   ")) ){?>
						<div class="col-xs-6 mobile-opt mobmb20" onclick="popup_require_login3(<?php echo $mcq['qid'] ?>,3)"> 
						
						<?php } else{ ?>
						<div class="col-xs-6 mobile-opt mobmb20" style="display:none"> 
						<?php } ?>
							<label class="radio-inline w-100">
								 
								    <input class="mt-5 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='2'>
								   <div class="input-group mobile-text-opt" >
									 <span class="input-group-addon opt-mb2 bo-input-left"></span>
									  <span id="optC1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> 
									  <table>
										<tr><td><b> C:</b> </td>
										 <td><?php echo html_entity_decode($mcq['options'][2]['q_option'])?> </td>
										 </tr></table>
									  </span>
								   </div>
							
							</label>
						</div>
						<?php if(!in_array(html_entity_decode($mcq['options'][3]['q_option']),array("", " ","  ", "   ")) ){?>
						<div class="col-xs-6 mobile-opt" onclick="popup_require_login3(<?php echo $mcq['qid'] ?>,4)"> 
						
						<?php } else{ ?>
						<div class="col-xs-6 mobile-opt" style="display:none"> 
						<?php } ?>
							<label class="radio-inline w-100">
								 
								 <input class="mt-5 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='3'>
								   <div class="input-group mobile-text-opt" >
									 <span class="input-group-addon opt-mb2 bo-input-left"></span>
									  <span id="optD1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> 
									  <table>
										<tr><td><b> D:</b> </td>
										 <td><?php echo html_entity_decode($mcq['options'][3]['q_option'])?> </td>
										 </tr></table>
									  </span>
								   </div>
							
							</label>
						</div>
					</div>
					  <p class="mt-10 mb-0"><button type="button" class="btn btn-danger" style="display:none">Tag bạn Facebook để trợ giúp</button></p>

						<?php  if($mcq['n_answers']>0){?>
					   <div class="col-xs-12 text-right mgr-20" style="float:right" >
							<p class="f11"><i style="width:20px" class="fas fa-users mr-5 bo-tron bg-danger"></i><strong class="text-danger"><?php  echo number_format(100*$mcq['n_correct_answers']/$mcq['n_answers'],0)?>%</strong> trả lời đúng</p>
					   </div>
					  <?php  }?>
					   
				  </div>
			  </div>
			  <div class="col-xs-12 bo-tb">
				  <div class="row">
					  <div class="col-xs-12" style="margin-bottom:5px">
						  <ul class="list-inline text-bt">

							  <li class="col-xs-2"><a class="pointer"  onclick="popup_require_login2(<?php echo $mcq['qid'] ?>)"><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs">Thích</span></a></li>
							  <li class="col-xs-3"><a class="pointer" onclick="popup_require_login2(<?php echo $mcq['qid'] ?>)"><i class="far fa-comment-alt mr-5"></i><span class="hidden-xs"> Bình luận </span></a></li>
							    <li class="col-xs-3"><a class="pointer" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fstemup.app%2Findex.php%2Fpage%2Fquestion%2F<?php echo  $mcq['permalink']?>&amp;src=sdkpreparse" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0');  count_share(<?php echo $mcq['qid'];?>); return false;"><i class="fas fa-share-alt mr-5"></i><span class="hidden-xs"> Chia sẻ</span></a></li>
								
							<li class="col-xs-2">
								<a class="assign-bt pointer" href="<?php echo site_url('page/question/'.$mcq['permalink']); ?>" target="_blank"><i class="fab fa-resolving mr-5"></i><span class="hidden-xs"> Đáp án</span></a>
							</li>
							<li class="col-xs-2">
								<a class="assign-bt pointer" onclick="popup_require_login2(<?php echo $mcq['qid'] ?>)"><i class="fas fa-share-square mr-5"></i><span class="hidden-xs"> Đố </span></a>
							</li>
						  </ul>
					  </div>
					  
				  </div>
			  </div>
			  <div id="like_statistic_<?php echo $mcq['qid']?>">
			  <?php if( $mcq['n_like']>0 ){?>
				  <div class="col-xs-12 bo-B" >		 
					 <i style="width:20px" class="fas fa-thumbs-up mr-5 bo-tron bg-primary"></i>
					 <a class="f10" href="#">
						 <?php echo " ".$mcq['n_like'].' người' ;?> 
					 </a>
				  </div>
			  <?php }?>
			  </div>
			   <?php if($mcq['share_count']>0){ ?>
			   <div class="col-xs-12">
				   <p class="f10 text-xam"><i class="fas fa-share-alt mr-5"></i><?php echo $mcq['share_count']?> lượt chia sẻ</p>
			   </div>
			   <?php } ?>

			  <div class="col-xs-12">
				  <div class="box-commen" style="margin-top:20px;" id="box_comment_<?php echo $mcq['qid']?>">
					  <div class="media-object-default">
							<?php foreach($mcq['comment'] as $cmt){ ?>
							 <div class="media">
							   <div class="media-left">
								   <a href="#">
								   <?php if($cmt['photo']) { ?>
										<img class="media-object img-circle" src="<?php echo $cmt['photo'];?>" width="36" alt="placeholder image">
									<?php } else{ ?>   
										<img class="media-object img-circle" src="<?php echo base_url('upload/avatar/default.png');?>" width="36" alt="placeholder image">
									<?php } ?> 
								   </a>
							   </div>
							  <div class="media-body">
								 <h4 class="media-heading"><a href=""><?php echo $cmt['first_name']." ".$cmt['last_name'];?></a></h4>
								 <?php echo $cmt['content']; ?>
								
							   </div>
								
						  </div>
                          
							<?php } ?>
						</div>
				  </div>
			  </div>
		  </div> 
		  </div><!--end baiviet-->

		 <?php } ?>
		 
		 <?php if($quiz_fun){?>
		 <div class="box-bor-quiz mb-20">
			  <h3 class="mt-0">Bài trắc nghiệm: <a class="pointer" href="<?php echo site_url('page/quiz/'.$quiz_fun['permalink']);?>"><?php echo $quiz_fun['quiz_name'] ?></a></h3>
			
			 
			  <div class="row hidden-xs">
			      <?php foreach($quiz_fun['question'] as $k=>$qf){?>
						<a class="col-md-3 col-xs-6 mb-10" class="pointer" href="<?php echo site_url('page/quiz/'.$quiz_fun['permalink']);?>"><img class="img-responsive img_quiz" src="<?php echo str_replace('..',base_url(), $qf['img']);?>" alt=""></a>
				  <?php }?>
				 
			  </div>
			  <div class="hidden-lg">
				  <div class="row">
					  <?php foreach($quiz_fun['question'] as $k=>$qf){
							if($k<2){?>
							<a class="col-md-3 col-xs-6 mb-10" class="pointer" href="<?php echo site_url('page/quiz/'.$quiz_fun['permalink']);?>"><img class="img-responsive img_quiz" src="<?php echo str_replace('..',base_url(), $qf['img'])?>" alt=""></a>
							<?php }}?>
					 
				  </div>
				   <div class="row">
					  <?php foreach($quiz_fun['question'] as $k=>$qf){
							if($k>=2){?>
							<a class="col-md-3 col-xs-6 mb-10" class="pointer" href="<?php echo site_url('page/quiz/'.$quiz_fun['permalink']);?>"><img class="img-responsive img_quiz" src="<?php echo str_replace('..',base_url(), $qf['img']);?>" alt=""></a>
							<?php }}?>
					 
				  </div>
			   </div>
			    <div class="col-xs-12 bo-tb">
				  <div class="row">
					  <div class="col-xs-12" style="margin-bottom:5px">
						  <ul class="list-inline text-bt">

							  <li class="col-xs-3"><a class="pointer"  onclick="popup_require_login4(<?php echo $quiz_fun['quid'] ?>)"><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs">Thích</span></a></li>
							  <li class="col-xs-3"><a class="pointer" onclick="popup_require_login4(<?php echo $quiz_fun['quid'] ?>)"><i class="far fa-comment-alt mr-5"></i><span class="hidden-xs"> Bình luận </span></a></li>
							  <li class="col-xs-3"><a class="pointer" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fstemup.app%2Findex.php%2Fpage%2Fquiz%2F<?php echo  $quiz_fun['permalink']?>&amp;src=sdkpreparse" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0');count_share2(<?php echo $quiz_fun['quid'];?>); return false;"><i class="fas fa-share-alt mr-5"></i><span class="hidden-xs">Chia sẻ</span></a></li>
							
							  <li class="col-xs-3">
								<a class="assign-bt pointer" onclick="popup_require_login4(<?php echo $quiz_fun['quid'] ?>)"><i class="fas fa-share-square mr-5"></i><span class="hidden-xs"> Đố </span></a>
							  </li>
						  </ul>
					  </div>
					 
				  </div>
			  </div>
			  <div id="like_statistic_quiz<?php echo $quiz_fun['quid']?>">
			  <?php if( $quiz_fun['n_like']>0 ){?>
				  <div class="col-xs-12 bo-B" >		 
					 <i style="width:20px" class="fas fa-thumbs-up mr-5 bo-tron bg-primary"></i>
					 <a class="f10" href="#">
						 <?php echo " ".$quiz_fun['n_like'].' người' ;?> 
					 </a>
				  </div>
			  <?php }?>
			  </div>
			   <?php if($quiz_fun['share_count']>0){ ?>
			   <div class="col-xs-12">
				   <p class="f10 text-xam"><i class="fas fa-share-alt mr-5"></i><?php echo $quiz_fun['share_count']?> lượt chia sẻ</p>
			   </div>
			   <?php } ?>
			    <div class="col-xs-12">
				  <div class="box-commen" style="margin-top:20px;" id="box_comment_quiz_<?php echo $quiz_fun['quid']?>">
					  <div class="media-object-default">
							<?php foreach($quiz_fun['comment'] as $cmt){ ?>
							 <div class="media">
							   <div class="media-left">
								   <a href="#">
								   <?php if($cmt['photo']) { ?>
										<img class="media-object img-circle" src="<?php echo $cmt['photo'];?>" width="36" alt="placeholder image">
									<?php } else{ ?>   
										<img class="media-object img-circle" src="<?php echo base_url('upload/avatar/default.png');?>" width="36" alt="placeholder image">
									<?php } ?> 
								   </a>
							   </div>
							  <div class="media-body">
								 <h4 class="media-heading"><a href=""><?php echo $cmt['first_name']." ".$cmt['last_name'];?></a></h4>
								 <?php echo $cmt['content']; ?>
								
							   </div>
								
						  </div>
                          
							<?php } ?>
						</div>
				  </div>
			  </div>
			   
		  </div>
		 <?php }?>
	      <div  class="show_more_mcq" style="display:none;">
		  </div>
		 
		<div class="modal fade" id="loginmodal" role="dialog">
			<div class="modal-dialog" style="">	
              <div class="box-popup1">			
				 <div class="modal-content">
					<form class="form-signin" method="post" action="<?php echo site_url('login/verifylogin');?>">
					 
					 <input class="page-signin-form-control form-control login-email" name="email" placeholder="<?php echo $this->lang->line('email_address');?>" type="text" required autofocus>
					 <input class="page-signin-form-control form-control login-pwd" name="password" id="inputPassword" placeholder="<?php echo $this->lang->line('password');?>" type="password" required  >
					<input style="margin: 10px;" name="remember" type="checkbox">Tự động đăng nhập
					 <button style="z-index:2; margin-top:-42px; margin-right:17px"class="btn btn-sm btn-default btn-primary pull-right mb-5" type="submit">Đăng nhập</button>
					 
					 <!--<table>
						 <tr>
							<td style="padding:10px">
								<a class="btn social-login"  style="background:#3C66C4;color:#ffffff;" href="<?php echo  site_url('hauth/login/Facebook');?>" > <i class="fab fa-facebook-f"></i> Đăng nhập với Facebook </a>
							 </td>
							 <td style="padding:10px">
								<a class="btn btn-danger social-login"  href="<?php echo  site_url('sso/login');?>" > <i class="fab fa-google"></i> Đăng nhập với Itrithuc.vn </a>
							 </td>
						 </tr>
					 </table>
					 -->
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
								<a class="btn btn-danger social-login gp-login"  href="<?php echo  site_url('sso/login');?>" > <i class="fab fa-google"></i> Đăng nhập với Itrithuc.vn </a>
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
						<div >
							<div class="fb-like" 
								data-href="https://www.facebook.com/stemupapp"
								data-layout="button_count" 
								data-action="like" 
								data-show-faces="false"
								data-size="large" >
							  </div>
						</div>
					</div>

				</div>

					
				 </div>
				  
			</div>
		</div>
	     <svg height="0" width="0">
		  <filter id="fb-filter">
			<feColorMatrix type="hueRotate" values="100"/>
		  </filter>
		</svg>
		<style>
		  .fb-like, .fb-send, .fb-share-button {
			-webkit-filter: url(#fb-filter); 
			filter: url(#fb-filter);
		  }
		</style> 
		

	
      </aside>
      <aside class="col-md-3 rightbar">
      	<div class="box-bor MB20 pad-0">
			<h3 class="text-xanh1 pad-15"><a href="<?php echo site_url('/event_racing')?>">Bảng xếp hạng <small>(<?php echo $today;?>)</small></a></h3>
			<div style="display:none">
					<input type="text" id="inf_rank_day_day" value="<?php echo $todaay ?>">
				</div>
			<!--<div style="width:100%;text-align:right;padding-left:2px;margin-bottom:5px">
				<span class="glyphicon glyphicon-star"></span>
				<select id="slCid" onchange="rankwithcategory(this)">
				<option value="default" selected disabled>Xếp hạng</option>
				<option value="0">Tất cả</option>
					<?php foreach($category_list as $ctgr){
						?>	
						<option value="<?php echo $ctgr['cid'] ?>"><?php echo $ctgr['category_name'] ?></option>
						<?php
					} ?>
				</select>
			</div>-->
			<div id="rankTable">
      	 	<table class="table table-hover table-striped">
				<thead>
				  <tr class="bg-eee">
					<th class="text-center">#</th>
					<th>Tên</th>
					<th class="text-right">Điểm Đố</th>
				  </tr>
				</thead>
				<tbody>
					<?php foreach($todaay_points as $i=>$dp){?>
					  <tr>
						<td class="text-center <?php if($i<3){ ?> bg-primary <?php } ?>"><?php  echo $i+1 ?></td>
						<td><?php echo $dp['last_name']." ".$dp['first_name'] ?></td>
						<td class="text-right"><?php echo $dp['points']; ?></td> 
					  </tr>
					<?php } ?>
				</tbody>
			  </table>
				</div>
			  <p class="text-center"><a href="<?php echo site_url('/event_racing')?>">Xem thêm</a></p>
			<!--  <p class="text-center"><a href="<?php echo site_url('/event_racing')?>">Câu hỏi cùng chủ đề</a></p> -->
		</div> 
		
		<div style="margin-bottom:20px">
			<div class="fb-page" 
				  data-href="https://www.facebook.com/stemupapp"
				  data-width="380" 
				  data-hide-cover="false"
				  data-show-facepile="true">
		    </div>
			
		</div>
		
	   <div class="box-bor">
		  <h3 class="text-xanh1"><a href="<?php echo site_url('home/quiz_list')?>">BÀI TRẮC NGHIỆM </a></h3>
		  <?php foreach($quiz_fun_rb as $k=>$qz){?>
		      <?php if($k<count($quiz_fun_rb)-2){?>
				  <div <?php if($k!=count($quiz_fun_rb)-3){ ?> style="margin-bottom:20px" class="bo-B" <?php } ?>>
					<div style="margin-bottom:10px"><a class="pointer" href="<?php echo site_url('page/quiz/'.$qz['permalink']);?>"> <img src="<?php echo $qz['img'];?> " width="100%"></a><br/>
					</div>
					 <a style="font-size:15px;" class="pointer" href="<?php echo site_url('page/quiz/'.$qz['permalink']);?>"><b><?php echo $qz['quiz_name'];?></a></b>
				 </div>
			  <?php }?>
		   <?php }?>
		  
        </div>
		<?php if(count($quiz_fun_rb)>2){?>
		<div class="div-sticky-quiz">
			<div class="box-bor MB20 box-sticky-quiz">
		
		         <?php for($k=count($quiz_fun_rb)-2; $k<count($quiz_fun_rb); $k++){?>
					 <div style="margin-bottom:20px" class="bo-B">
						<div style="margin-bottom:10px"><a class="pointer" href="<?php echo site_url('page/quiz/'.$quiz_fun_rb[$k]['permalink']);?>"> <img src="<?php echo $quiz_fun_rb[$k]['img'];?> " width="100%"></a><br/>
						</div>
						 <a style="font-size:15px;" class="pointer" href="<?php echo site_url('page/quiz/'.$quiz_fun_rb[$k]['permalink']);?>"><b><?php echo $quiz_fun_rb[$k]['quiz_name'];?></a></b>
					 </div>
				 <?php }?>
		   </div>
		 </div>
		<?php } ?>
      </aside>
     
    </section>
  	</main>
  	

  </body>

 <?php if(count($mcq_fun)==0){?>
		 		  <script>alert("Không tìm thấy câu hỏi phù hợp!");
		  window.location.href =site_url+"/home_user";
		  </script>
		  <?php }?>
</html>
