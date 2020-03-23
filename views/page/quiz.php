<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:url" content="https://stemup.app/index.php/page/quiz/<?php echo $permalink?>" />
<meta property="og:title" content="<?php echo str_replace("\"","'",strip_tags(html_entity_decode($quiz['quiz_name'])))?>" />
<meta property="og:image" content="<?php echo $img?>" />
<meta property="og:description" content="<?php echo str_replace("\"","'",strip_tags(html_entity_decode($quiz['quiz_name']))).".".str_replace("\"","'",strip_tags(html_entity_decode($quiz['description'])))?>"/>

<meta name="Description" content="<?php echo str_replace("\"","'",strip_tags(html_entity_decode($quiz['quiz_name']))).".".str_replace("\"","'",strip_tags(html_entity_decode($quiz['description'])))?>" />
<meta property="og:type" content="website" />
    <title><?php echo str_replace("\"","'",strip_tags(html_entity_decode($quiz['quiz_name'])))?></title>
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
    <!-- Bootstrap -->
	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('css/setbackground.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/star-rating.css');?>" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
	<script src="<?php echo base_url('js/jquery.dataTables.js');?>"></script>
	<link href="<?php echo base_url('css/jquery.dataTables.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('js/addclass.js');?>"></script>
	<script src="<?php echo base_url('js/newpage.js');?>"></script>
	<script src="<?php echo base_url('js/responsive.dataTables.js');?>"></script>
	<!--<script src="<?php echo base_url('js/owlcarousel/owl.carousel.min.js');?>"></script>-->
		<script src="<?php echo base_url('js/setbackground.js');?>"></script>
	<link href="<?php echo base_url('css/responsive.dataTables.min.css');?>" rel="stylesheet">
   		<script src="<?php echo base_url('js/signup.js');?>"></script>
				<script src="<?php echo base_url('js/loadoption.js');?>"></script>
	<script>

	
	var base_url="<?php echo base_url();?>";
	var site_url="<?php echo site_url();?>";
	var su="<?php echo $su ?>";
    var id_mcq_fun ="";
     var id_quiz_fun ="";
	 var count_question =<?php echo count($questions);?>;
	</script>
	<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
	<script src="<?php echo base_url('js/select2.min.js');?>"></script>
<script src="<?php echo base_url('js/editprofile.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('js/formattoolbar.js')?>"></script>

	<script src="<?php echo base_url('js/left-menu.js');?>"></script>
	<script src="<?php echo base_url('js/star-rating.js');?>"></script>
	<script src="<?php echo base_url('js/paginate.js');?>"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
	  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> <script> (adsbygoogle = window.adsbygoogle || []).push({ google_ad_client: "ca-pub-3948834986570227", enable_page_level_ads: true }); </script>
  </head>
 <body class="bg-body">
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
					<span class="badge badge-sm up bg-pink count ncount mr-5"></span> -->
					<!-- <i class="mr10 fa fa-angle-right"></i> -->
				</a>
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
					<!-- <div class="col-md-4"> -->
						<!-- <div class="input-group-sm mb-5">
						  <input type="text" class="form-control" placeholder="Username">
						</div> -->
		
				 
					<div class="form-group col-md-3 col-xs-6 hidden-xs">	  
						 
						<!--<button class="btn btn-sm btn-default btn-primary pull-right mb-5" type="submit">Đăng nhập</button>-->
						<button class="btn btn-sm btn-default btn-primary pull-right mb-5 dropdown-toggle" type="button" data-toggle="dropdown">Đăng nhập</button>
						 <div class="dropdown-menu " style="margin-left:-260px;">
						     <div class="arrow_box arrow-box-top"></div>
							 <div style="padding:10px">
								<form class="form-signin" method="post" action="<?php echo site_url('login/verifylogin');?>">
								     
									 <input class="page-signin-form-control form-control" name="email" style="width:350px;margin:10px" placeholder="<?php echo $this->lang->line('email_address');?>" type="text" required autofocus>
									 <input class="page-signin-form-control form-control" name="password" style="width:270px;margin:10px" id="inputPassword" placeholder="<?php echo $this->lang->line('password');?>" type="password" required  >
		                           	<input style="margin: 10px;" name="remember" type="checkbox">Tự động đăng nhập
									 <button style="z-index:2; margin-top:-42px; margin-right:17px"class="btn btn-sm btn-default btn-primary pull-right mb-5" type="submit">Đăng nhập</button>
									 
									 <!--<table>
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
   
<div class="modal fade" id="changepwdModal" role="dialog">
 		<div class="modal-dialog">	 
 			 <div class="modal-content">
 				<div class="modal-header">
 				  <button type="button" class="close" data-dismiss="modal">&times;</button>
 				  <h4 class="modal-title">Đổi mật khẩu</h4>
 				</div>
 				<div class="modal-body">
 				     
 						  <div class="form-group">
 							<p>Mật khẩu hiện tại</p>
 							<input type="password" name="old_pwd" minlength="1" autofocus="autofocus" class="form-control" id="old_pwd" />
 						</div>
 						<div id="error" style="color: red;"></div>
 						<div class="form-group">
 						<p>Nhập mật khẩu mới</p>
 							<input type="password" name="new_pwd" minlength="1" class="form-control" id="new_pwd" />
 						</div>
 						<div id="error1" style="color: red;"></div>
 						<div>
 						</div>
 						 <div class="form-group">
 							<p>Nhập lại mật khẩu mới</p>
 							<input type="password" name="confirm_pwd" minlength="1" class="form-control" id="confirm_pwd" />
 						</div>
 						<div id="error2" style="color: red;"></div>
 						<div id="error3" style="color: green;"></div>
 						<div class="form-group">
 							<button type="submit" class="btn btn-primary oe_form_button" id="submit_cpw" name = "submit">Cập nhật</button>
 						</div>
 						<script type="text/javascript">
 							$('#submit_cpw').on("click",function(){
 								$("#error").empty();
 								$("#error1").empty();
 								$("#error2").empty();
 								$("#error3").empty();
 								var old_pwd =$("#old_pwd").val();
 								var new_pwd =$("#new_pwd").val();
 								var confirm_pwd =$("#confirm_pwd").val();
 								if(old_pwd==''){
 									$("#error").html("(<i>Mời bạn nhập Mật khẩu hiện tại</i>)");
 								}else 
 								if(new_pwd==''){
									$("#error1").html("(<i>Mật khẩu mới không được để trống</i>)");
								}else
								if (confirm_pwd==''){
									$("#error2").html("(<i>Mời bạn nhập vào Mật khẩu mới</i>)");
								}else
								if (confirm_pwd!=new_pwd){
									$("#error2").html("(<i>Mật khẩu xác nhận không trùng khớp</i>)");
								}
								else{
									$.ajax({
							        type: 'POST',
							        data: {old_pwd:old_pwd,new_pwd:new_pwd,confirm_pwd:confirm_pwd},
							        url: "<?php  echo site_url('/user/changepassword') ?>",
							        success: function(data){
							        	// console.log(data);
	                                    if(data==0){
	                                    	 // console.log("Mật khẩu hiện tại không đúng nhé");
	                                    	 $("#error").html("(<i>Mật khẩu hiện tại không đúng</i>)");
	                                    }else
	                                     if(data==2){
	                                    	 // console.log("Mật khẩu xác nhận không trùng khớp với mật khẩu mới");
	                                    	 $("#error2").html("(<i>Mật khẩu xác nhận không trùng khớp với mật khẩu mới</i>)");
	                                    }else
	                                    if(data==3){
	                                    	// console.log("Thay đổi mật khẩuthành công");
	                                    	 $('#changepwdModal').modal('hide');
	                                    	 alert("Thay đổi mật khẩu thành công!");
	                                    	 sendemail_changepassword();
	                                    }
							        },
							        error: function(data) {
							            // console.log(data);
							        }
								    });
							    }

						    });

 						</script>
 						
	 					<!-- 	if($this->session->flashdata('wrong_password')){ 
					  			$wrong_password=$this->session->flashdata('wrong_password');}
							if($this->session->flashdata('matkhaudetrong')){
								$matkhaudetrong=$this->session->flashdata('matkhaudetrong');}
							if($this->session->flashdata('matkhaumoi')){
								$matkhaumoi= $this->session->flashdata('matkhaumoi');}		
							if($this->session->flashdata('change_sucsess')){
								$change_sucsess=$this->session->flashdata('change_sucsess');}
 					 -->
 						 
 						<!-- <script type="text/javascript">
						$('#submit_cpw').on("click",function(){
								var old_pwd =$("#old_pwd").val();
								var new_pwd =$("#new_pwd").val();
								var confirm_pwd =$("#confirm_pwd").val();
								var error =$("#error");
								error.html("");
								
								if(old_pwd==""){
									console.log('aaaaaaaaaaaa');
									error.html("(<i>Mời bạn nhập Mật khẩu hiện tại</i>)");
									return false;
								}else {
									var wrong_password= '<php echo $wrong_password; ?>';
									var matkhaudetrong= '<php echo $matkhaudetrong; ?>';
									var matkhaumoi= '<php echo $matkhaumoi; ?>';
									var change_sucsess= '<php echo $change_sucsess; ?>';
									if(wrong_password!=''){
										error.html(wrong_password);
									}else if(matkhaudetrong!=''){
										$("#error1").html(matkhaudetrong);
									}else if(matkhaumoi!=''){
										$("#error1").html(matkhaudetrong);
									}else if(change_sucsess!=''){
										$("#error1").html(change_sucsess);
									}
									
									/**/
									console.log('ccccccccccc');
								}
							});
 						</script> -->
 				    
 				    
 				</div> 
 				<div class="modal-footer">
 				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 				</div>
 		 </div>
 		</div>
 	</div>
 
    <main class="container MT70">
	
	<section class="row">
	  <aside class="col-md-4 hidden-dt" style="position:fixed; bottom:0; z-index:100" >
      	 <div class="bg-quizz2"  style="margin-right: -2%;">
      	 	<!--<h4 class="text-quizz">Bài trắc nghiệm: <?php echo $title;?></h4>-->
			 <table>
			 <tr>
				 <td class="col-xs-10">
					<h5 class="text-quizz1" style="background-color:#1b75ba; color:white;margin-left:-4%; padding:5px; border-radius:5px">Quizz: <?php echo $title;?></h5>
				 </td>
			   
			   <td>
			  <button type="button" class="btn btn-success btn-lg1" onclick="popup_require_login1(<?php echo $quiz['quid'];?>)">Nộp bài</button>
			   </td> 
			   </tr>
			  </table>	
      	 </div>
		 
      </aside>
	
   	  <aside class="col-md-8" id="mainqtatt">
	   
		  <div class="bg-quizz1">
					<input type="hidden" name="noq" value="<?php echo $quiz['noq'];?>">
			  <div id="carousel1" class="carousel slide slide1" data-ride="carousel" data-interval="false" data-wrap="false">
			    <ol class="carousel-indicators carousel-Quizz hidden-dt">
				   <?php foreach($questions as $qk => $question){ ?>
				    <?php if($qk==0){ ?>
						<li id="car_index_qt_<?php echo $qk ?>" data-target="#carousel1" data-slide-to="<?php echo $qk ?>" class="active"><?php echo $qk+1 ?></li>
			        <?php }else{ ?>
					    <li id="car_index_qt_<?php echo $qk ?>" data-target="#carousel1" data-slide-to="<?php echo $qk ?>"><span style="margin-top:10px"><?php echo $qk+1 ?></span></li>
					 <?php } ?>
				   <?php } ?>
		        </ol>
			    <div class="carousel-inner" role="listbox" style="margin-bottom: 20px;">
				    <?php foreach($questions as $qk => $question){ ?>
					 <?php if($qk==0){ ?>
			        <div class="item active" id="qiq_<?php echo $qk?>">
					 <?php } else { ?>
			        <div class="item" id="qiq_<?php echo $qk?>">
					 <?php } ?>
					      <div>
							  <div class="row1" style="margin-top:20px">
								 <!-- <div class=col-xs-10>
									  <div class="w60"><a class="pointer" ><img class="img-responsive img-circle" src="<?php echo base_url('upload/symbol/'.$question['cid'].'.png');?>" alt=""></a></div>
									  <h4 class="mb-0"><a class="pointer" href="<?php echo site_url('/page/category/'.$question['category_permalink'])?>"><b><?php echo $question['category_name']?></b></a><br></h4>
									  <span class="text-small1"><?php echo $question['str_time_ago'] ?></i></span>
								  </div>-->
								  
								  <!--<div class="col-xs-2 text-right">
									 
									<div class="btn-group">
									  <button type="button" class="btn btn-default dropdown-toggle btn-none" data-toggle="dropdown">
										<span class="f20">...</span>
									  </button>
									  <ul class="dropdown-menu dropdown-menu-right" role="menu">
										<li><a href="#">Action</a></li>
										<li><a href="#">Another action</a></li>
										<li><a href="#">Something else here</a></li>
										<li class="divider"></li>
										<li><a href="#">Separated link</a></li>
									  </ul>
									</div>
								  </div>-->
							  </div>
							  <div class="col-xs-12" style="margin-bottom:10px">
							       <input type="hidden"  name="question_type[]"  id="q_type<?php echo $qk;?>" value="1">
								   <?php  if(strpos($question['question'],'https://latex.codecogs.com')===false && (strpos($question['question'], '<iframe')===false && strpos($question['question'], '<img')===false)){?>
								   <div class="bgqtdiv" >
										<font color="white">
											<div  style="background-image:url('https://stemup.app/upload/background/h400/<?php if($question['background_template']!=0){ echo $question['background_template'];} else{ echo rand(1,20);}?>.jpg'); height:380px;" class="outer bgqt_att">
												<div class="middle">
													<div class="inner" style="margin-left:30px;">	   
														<?php
															echo strip_tags($question['question']);
  														
														?>
													</div>
												</div>
											 </div>
										</font>
								  </div>
								  
                                   <?php } else if(strpos($question['question'],'https://latex.codecogs.com')!==false){?>
								    <div class="bgqtdiv" >
										 <div style="text-shadow: none;" class="outer bgqt_att">
										     <div class="middle">
													
												  <div  class="inner" style="font-size:20px;text-align: center">
												<?php echo html_entity_decode($question['question']); ?>
												</div>
											</div>
										</div>
									 </div>
									<?php	  } else{?>
									 <div class="mcq_multimd2">
									    <?php  if(strpos($question['question'], '<iframe')===false){
											?>
											
						                     <div class="box-img-quiz">
												<center>
													<img class="img-responsive img-quiz-at"  src="<?php echo str_replace("..",'https://stemup.app',$question['img'] )?>">
												</center>
											 </div>
										      <div style="margin-top:10px">
											 <?php echo  strip_tags($question['question']) ?>
                                            </div>											  
											
											<?php
											
											
											
										} else { ?>
										<div class="video-wrapper">
											<?php echo str_replace('allowfullscreen="allowfullscreen"',' data-autoplay="true"',$question['question']);?>
										</div>
										<div class="hidden-dt" style="margin-top:10px">
											<?php echo strip_tags($question['question']);?>
										</div>
										<?php }?>
									 </div>
									<?php }?>
								
							  </div>
							  
							  <div class="col-xs-12 div_opt1">
								 <div class="ol_opt" id="ol_opt-<?php echo $question['qid'] ?>" onclick="popup_require_login1(<?php echo $quiz['quid'];?>)"> 
								 </div>
								  <p class="mt-10 mb-0"><button type="button" class="btn btn-danger" style="display:none">Tag bạn Facebook để trợ giúp</button></p>
								    <?php  if($question['n_answers']>0){?>
								   <div class="col-xs-12 text-right mgr-20" style="float:right" >
										<p class="f11"><i style="width:20px" class="fas fa-users mr-5 bo-tron bg-danger"></i><strong class="text-danger"><?php  echo number_format(100*$question['n_correct_answers']/$question['n_answers'],0)?>%</strong> trả lời đúng</p>
								   </div>
								  <?php  }?>
							  </div>
						  </div>
						  <div class="col-xs-12 bo-tb">
							  <div class="row">
								  <div class="col-xs-12" style="margin-bottom:5px">
									  <ul class="list-inline text-bt">						  
										  <li class="col-xs-4"><a class="pointer" onclick="popup_require_login2(<?php  echo $question['qid']?>)"><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs">Thích</span></a></li>
										  <li class="col-xs-4"><a class="pointer" onclick="popup_require_login2(<?php  echo $question['qid']?>)" ><i class="far fa-comment-alt mr-5"></i><span class="hidden-xs">Bình luận</span></a></li>
											<li class="col-xs-4"><a class="pointer" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fstemup.app%2Findex.php%2Fpage%2Fquestion%2F<?php echo  $question['permalink']?>&amp;src=sdkpreparse" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); count_share(<?php echo $mcq['qid'];?>);return false;"><i class="fas fa-share-alt mr-5"></i><span class="hidden-xs">Chia sẻ</span></a></li>
									  </ul>
								  </div>
								   <!-- Single button 
								  <div class="col-xs-2 text-right">
									 
										<div class="btn-group">
										  <button type="button" class="btn btn-default dropdown-toggle btn-none" data-toggle="dropdown">
											
											 <?php if($link_photo) { ?>
												<img class="img-responsive img-circle w20" src="<?php echo $link_photo;?>" alt="">
											<?php } else{ ?>   
												<img class="img-responsive img-circle w20" src="<?php echo base_url('upload/avatar/default.png');?>" alt="">
											<?php } ?> 
											<span class=" 
caret caret_e 
"></span>
										  </button>
										  <ul class="dropdown-menu" role="menu">
											<li><a href="#">Action</a></li>
											<li><a href="#">Another action</a></li>
											<li><a href="#">Something else here</a></li>
											<li class="divider"></li>
											<li><a href="#">Separated link</a></li>
										  </ul>
										</div>
								  </div>-->
							  </div>
						  </div>
						  <div id="like_statistic_<?php echo $question['qid']?>">
						  <?php if($question['liked']==1|| $question['n_like']>0 ){?>
							  <div class="col-xs-12 bo-B" >		 
								 <i style="width:20px" class="fas fa-thumbs-up mr-5 bo-tron bg-primary"></i>
								 <a class="f10" href="#">
									<?php echo " ".$question['n_like'].' người' ;?> 
								 </a>
							  </div>
						  <?php }?>
						  </div>
						   <?php if($question['share_count']>0){ ?>
						   <div class="col-xs-12">
							   <p class="f10 text-xam"><i class="fas fa-share-alt mr-5"></i><?php echo $question['share_count']?> lượt chia sẻ</p>
						   </div>
						   <?php } ?>
						  <div class="col-xs-12 collapse" id="comment_area_main_<?php echo $question['qid']?>">
							  <div class="media-object-default">
								 <div class="media">
								   <div class="media-left">
									   <a href="#">
										<?php if($link_photo) { ?>
											<img class="media-object img-circle" src="<?php echo $link_photo;?>" width="36" alt="placeholder image">
										<?php } else{ ?>   
											<img class="media-object img-circle" src="<?php echo base_url('upload/avatar/default.png');?>" width="36" alt="placeholder image">
										<?php } ?> 
									   
									   </a>
								   </div>
								   

							  </div>
							</div>
						  </div>
						  <div class="col-xs-12">
							  <div class="box-commen" style="margin-top:20px;" id="box_comment_<?php echo $question['qid']?>">
								  <div class="media-object-default">
									<?php foreach($question['comment'] as $cmt){ ?>
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
								   <!--<p class="text-small1">
									  <a class="mr-23" href="">Thích</a>
									  <a class="mr-23" href="">Trả lời</a>
									  - <?php echo $cmt['str_time_ago'];?>
								  </p>-->
							   </div>
								
						  </div>
                          
							<?php } ?>	 
								   </div>
							  </div>
						  </div>
						 
					  </div>
					  <?php } ?>
					   <a class="left carousel-control left-Quizz" href="#carousel1" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left top200px" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control right-Quizz" href="#carousel1" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right top200px" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
				       </a>
				    </div>	
                </div>	
              </div>
		  
		  </div><!--end baiviet-->
     
		<div class="modal fade" id="loginmodal2" role="dialog">
			<div class="modal-dialog" style="width:28%">	 
				 <div class="modal-content">
					<form class="form-signin" method="post" action="<?php echo site_url('login/verifylogin2');?>">
					 <input type="text" style="display:none" id="model" name="model" value=""/>
					  <input type="text" style="display:none" id="id_login" name="id_login" value="0"/>
					 <input class="page-signin-form-control form-control login-email" name="email" placeholder="<?php echo $this->lang->line('email_address');?>" type="text" required autofocus>
					 <input class="page-signin-form-control form-control login-pwd" name="password" id="inputPassword" placeholder="<?php echo $this->lang->line('password');?>" type="password" required  >
					<input style="margin: 10px;" name="remember" type="checkbox">Tự động đăng nhập
					 <button style="z-index:2; margin-top:-42px; margin-right:17px"class="btn btn-sm btn-default btn-primary pull-right mb-5" type="submit">Đăng nhập</button>
					<!-- <table>
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
							<h4 class="text-center mb-20 mt-0">Vui lòng <button class="btn btn-info smlg">Đăng nhập</button> hoặc <button class="btn btn-success smsn">Đăng ký</button> để thực hiện thao tác này!</h4>
						</div>

					</div>

					
				 </div>
				  
			</div>
		</div>
      </aside>
      <aside class="col-md-4 hidden-xs" style="line-height: 2;">
      	 <div class="bg-quizz">
      	 	<h3 class="text-quizz">Bài trắc nghiệm: <?php echo $title;?></h3>
			 <?php if($quiz['description']!=" " && $quiz['description']!=""){?>
			 <p class="text-justify"><i> <?php echo $quiz['description']?></i></p>
			 <?php }?>
			 <div >
				<button type="button" class="btn btn-success btn-block btn-lg" onclick="popup_require_login1(<?php echo $quiz['quid'];?>)">Nộp bài</button>
			 </div>
			
		</div> 
		<center style="margin-left:-10%">
			
				<?php for($i=0; $i<$count_page_qt; $i++){ ?>	
				  <div style="margin-top:10px">
						<ol class="carousel-Quizz">
						   <?php foreach($questions as $qk => $question){ if($qk>=$i*7 && $qk<($i+1)*7 ){?>	
                                						   
								<li id="car_index_qt2_<?php echo $qk ?>" <?php if($qk==0){ echo 'class="ftsz-25"'; }?> data-target="#carousel1" data-slide-to="<?php echo $qk ?>"><span style="margin-top:10px"><?php echo $qk+1 ?></span></li>		 
						   <?php } ?>
						    <?php } ?>
						</ol>
					</div>
						
					
					  
				<?php } ?>		
		
        </center>
      </aside>
	  
    </section>
  	</main>
  




 
 
 




<!-- Template javascript -->
	  	<script src="<?php echo base_url('js/basic.js');?>"></script>
 <style>
 td{
		font-size:14px;
		padding:4px;
	}
.row{
margin:0px;
}
	
</style>








 
 
 
 
 
  
	
</div>

</body>















  





 
