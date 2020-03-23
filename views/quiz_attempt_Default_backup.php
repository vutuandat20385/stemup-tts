<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
    <!-- Bootstrap -->
	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-dat.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('css/setbackground.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/star-rating.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/responsive.dataTables.min.css');?>" rel="stylesheet">

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
	<script src="<?php echo base_url('js/jquery.dataTables.js');?>"></script>
	<link href="<?php echo base_url('css/jquery.dataTables.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('js/addclass.js');?>"></script>
	<script src="<?php echo base_url('js/newuserpage.js');?>"></script>
	<script src="<?php echo base_url('js/responsive.dataTables.js');?>"></script>
	<script src="<?php echo base_url('js/minhash.js');?>"></script>
	<!--<script src="<?php echo base_url('js/owlcarousel/owl.carousel.min.js');?>"></script>-->
		<script src="<?php echo base_url('js/loadoption.js');?>"></script>
	<style>
		.container {
    padding-left: 10px;
    padding-right: 0px;
}
	</style>
	<script>

	
	var base_url="<?php echo base_url();?>";
	var site_url="<?php echo site_url();?>";
	var su="<?php echo $su ?>";
   var id_mcq_fun ="";
     var id_quiz_fun ="";
	 var count_question =<?php echo count($questions);?>;
	</script>
	<link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
	<script src="<?php echo base_url('js/select2.min.js');?>"></script>
<script src="<?php echo base_url('js/editprofile.js');?>"></script>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('js/formattoolbar.js')?>"></script>

	<script src="<?php echo base_url('js/left-menu.js');?>"></script>
	<script src="<?php echo base_url('js/notification.js');?>"></script>
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
			  <a class="navbar-brand navbar-brand1" href="<?php echo site_url('home_user');?>">
					<img class="hidden-xs" src="<?php echo base_url('images/hu_logo_home1.png');?>" alt="">
					<img class="visible-xs-block logo-s" src="<?php echo base_url('images/hu_logo_home1.png');?>" height="32" alt="">
			  </a>
			<div class="pull-right text-trang-mobile visible-xs-block">
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('library/video'); ?>">
					<i class="mr-5 fas fa-cloud"></i>
					<br class="hidden-xs">
				</a>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user/notifications') ?>">
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
			    <input id="inpsearch_top_dt"  onkeyup="search_question(this, event)" class="form-control form-TK1 w350" placeholder="Tìm kiếm" type="text">
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
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user');?>#assign_quiz" onclick="quizAssignTo(event);"><i class="mr-5 far fa-calendar-check"></i><br class="hidden-xs">Nhiệm vụ</a>
			</li>
			<li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user/results');?>"  ><i class="mr-5 far fa-chart-bar"></i><br class="hidden-xs">Kết quả</a>
			</li>
			<li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('library/video'); ?>"><i class="mr-5 fas fa-cloud"></i><br class="hidden-xs">Thư viện</a>
			</li>
			
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
  	        	<span class=" 
caret caret_e 
"></span></a>
  	          <ul class="dropdown-menu dropdown-menu1">
  	           <!-- <li><a href="#"><i class="MR10 far fa-file-alt text-primary" aria-hidden="true"></i>Bảng tin</a></li>
  	            <li><a href="#"><i class="MR10 far fa-comments text-danger" aria-hidden="true"></i>Tin nhắn</a></li>
  	            <li><a href="#"><i class="MR10 fas fa-th-large text-success" aria-hidden="true"></i>Khóa học</a></li>
  	            <li><a href="#"><i class="MR10 fas fa-calendar text-danger" aria-hidden="true"></i>Sự kiện</a></li>
  	            <li><a href="#"><i class="MR10 fas fa-users text-info" aria-hidden="true"></i>Nhóm</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-address-book text-warning" aria-hidden="true"></i>Dánh sách bạn bè</a></li> -->
				<?php if($su!=2){?>
				<li><a data-toggle="modal" data-target="#transferModal" href="#"><i class="MR10 fas fa-exchange-alt text-warning" aria-hidden="true"></i>Chuyển điểm</a></li>
				<?php } ?>
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
 
    <main class="container MT60">
	
	<section class="row">

	  <aside class="col-md-4 hidden-dt" style="position:fixed; bottom:0; z-index:100" >
      	 <div class="bg-quizz2"  style="margin-right: -2%;">
      	 	<!--<h4 class="text-quizz">Bài trắc nghiệm: <?php echo $title;?></h4>-->
			 <table>
			 <tr>
				 <td class="col-xs-9">
					<h5 class="text-quizz1" style="background-color:#1b75ba; color:white;margin-left:-4%; padding:5px; border-radius:5px">Quizz: <?php echo $title;?></h5>
				 </td>
			    <td>
					  <div class="box-dongho1">
						 <span class="text-gio1" id='timer1' ></span>
						 
					 </div>
				 </td>
			   <td>
			  <button type="button" class="btn btn-success btn-lg1 btn-nopbai" onclick="javascript:cancelmove();">Nộp bài</button>
			   </td> 
			   </tr>
			  </table>	
      	 </div>
		
      </aside>
			<div class="container row test-header hidden-xs">
					<div class="col-md-9	text-title">
						<div class=""  style="display: table;height: 80px; width: 100%;">
							<h3 class="text-quizz"><!---Bài trắc nghiệm: ---><?php echo $title;?></h3>
								<!-- <?php //if($quiz['description']!=" " && $quiz['description']!=""){?>
									<p class="text-justify"><i> 
									<?php //echo $quiz['description']?>
									</i></p>
								<?php //}?> -->
						</div>
					</div>
					<div class="col-dongho col-md-1">
							<div class="dongho1	">
									<p class="text-dongho"><span class="text-gio" id='timer' ></span></p>																	
							</div>
					</div>
					<div class="col-btn-nopbai col-md-2">
							<div class="btn-nopbai-1">
								<button type="button" class="btn btn-success btn-block btn-lg btn-nopbai" onclick="javascript:cancelmove();">Nộp bài</button>	
							</div>					
					</div>
					
			</div>
	
   	  <aside class="col-md-7 q-col-left" id="mainqtatt" >
	   
		  <div class="bg-quizz1">
              <form method="post" action="<?php echo site_url('quiz/submit_quiz/'.$quiz['rid']);?>" id="quiz_form" >
					<input type="hidden" name="rid" value="<?php echo $quiz['rid'];?>">
					<input type="hidden" name="noq" value="<?php echo $quiz['noq'];?>">
					<input type="hidden" name="individual_time"  id="individual_time" value="<?php echo $quiz['individual_time'];?>">
			  <div id="carousel1" class="carousel slide slide1" data-ride="carousel" data-interval="false" data-wrap="false">
			    <ol class="carousel-indicators carousel-Quizz hidden-dt">
				   <?php foreach($questions as $qk => $question){ ?>
				    <?php if($qk==0){ ?>
						<li href="#q_type22" id="car_index_qt_<?php echo $qk ?>"  class="active"><?php echo $qk+1 ?></li>
			        <?php }else{ ?>
					    <li href="#q_type22" id="car_index_qt_<?php echo $qk ?>" ><span style="margin-top:10px"><?php echo $qk+1 ?></span></li>
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
							  <div class="row1" style="margin-top:5px">

							  </div>
							  <div id="q_type<?php echo $qk;?>" class="col-xs-12" style="margin-bottom:10px">
							       <input type="hidden"  name="question_type[]"   value="1">
								   <?php  if(strpos($question['question'],'https://latex.codecogs.com')===false && (strpos($question['question'], '<iframe')===false && strpos($question['question'], '<img')===false)){?>
								   <div class="bgqtdiv bgqtdiv_e " style="margin-left: 0px;">
										<font color="white" style="font-size: 25px;">
											<div  style="background-image:url('https://stemup.app/upload/background/h400/<?php if($question['background_template']!=0){ echo $question['background_template'];} else{ echo rand(1,20);}?>.jpg'); height:330px;" class="outer bgqt_att">
												<div class="middle">
													<div class="inner" style="margin-left:30px;">	   
														<?php
															echo $question['question'];
  														
														?>
													</div>
												</div>
											 </div>
										</font>
								  </div>
								  
                                   <?php } else if(strpos($question['question'],'https://latex.codecogs.com')!==false){?>
								    <div class="bgqtdiv bgqtdiv_d" >
										 <div style="text-shadow: none;" class="outer bgqt_att bgqtdiv_d">
										     <div class="middle">
													
												  <div  class="inner" style="font-size:18px;text-align: center">
												<?php echo html_entity_decode($question['question']); ?>
												</div>
											</div>
										</div>
									 </div>
									<?php	  } else{?>
									 <div class="mcq_multimd2">
									    <?php  if(strpos($question['question'], '<iframe')===false){
											?>
											
						           <!-- <div class="box-img-quiz img-q">
														<center>
																<img class="img-responsive img-quiz-at"  src="<?php echo str_replace("..",'https://stemup.app',$question['img'] )?>">
														</center>
											 </div> -->
										      <div class="text-center" style="margin-top:10px">
											 <?php echo  $question['question'] ?>
                                            </div>											  
											
											<?php
											
											
											
										} else { 

											?>
										<div class="video-wrapper">
											<?php echo str_replace('allowfullscreen="allowfullscreen"',' allowfullscreen="allowfullscreen" data-autoplay="true"',$question['question']);?>
										</div>
										<div class="hidden-dt text-center" style="margin-top:10px">
											<?php echo strip_tags($question['question']);?>
										</div>
										<?php }?>
									 </div>
									<?php 
										}
								?>
								
							  </div>
							  
							  <div class="col-xs-12 div_opt1">
								 <div class="ol_opt" id="ol_opt-<?php echo $question['qid'] ?>"> 
								 </div>
								  <p class="mt-10 mb-0"><button type="button" class="btn btn-danger" style="display:none">Tag bạn Facebook để trợ giúp</button></p>
								    <?php  if($question['n_answers']>0){?>
								   <div class="col-xs-12 text-right mgr-20" style="float:right" >
										<p class="f11"><i style="width:20px" class="fas fa-users mr-5 bo-tron bg-danger"></i><strong class="text-danger"><?php  echo number_format(100*$question['n_correct_answers']/$question['n_answers'],0)?>%</strong> trả lời đúng</p>
								   </div>
								  <?php  }?>
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
              </form>			  
		  </div><!--end baiviet-->


	
      </aside>
      <aside class="col-md-5 hidden-xs q-col-right" style="line-height: 2;">
      	 <!-- <div class="bg-quizz">
      	 	<h3 class="text-quizz">Bài trắc nghiệm: <?php echo $title;?></h3>
			 			<?php //if($quiz['description']!=" " && $quiz['description']!=""){?>
			 				<p class="text-justify"><i> <?php //echo $quiz['description']?></i></p>
			 			<?php //}?> -->
			 <!-- <div class="box-dongho">
				 <p class="text-dongho"><span class="text-gio" id='timer' ></span></p>
				 
			 </div> -->
			 <!-- <div > -->
				<!-- <button type="button" class="btn btn-success btn-block btn-lg" onclick="javascript:cancelmove();">Nộp bài</button> -->
			 </div>
			
		</div> 
		
				<div>

<div id="exTab2" class="">	
<ul class="nav nav-tabs">
			<li class="active">
        <a  href="#1" data-toggle="tab">Danh sách câu hỏi</a>
			</li>

		</ul>

			<div class="tab-content ">
			  <div class="tab-pane active" id="1">
					<center class="quiz-list-right-col">
				
						<?php for($i=0; $i<$count_page_qt; $i++){ ?>	
							<div style="margin-top:10px">
								<ol class="carousel-Quizz">
									<?php foreach($questions as $qk => $question){ if($qk>=$i*7 && $qk<($i+1)*7 ){?>	
																									
										<li href="#q_type<?php echo $qk ?>" id="car_index_qt2_<?php echo $qk ?>" <?php if($qk==0){ echo 'class="ftsz-25-fix"'; }?> data-target="#carousel1" data-slide-to="<?php echo $qk ?>"><span style="margin-top:10px"><?php echo $qk+1 ?></span>
										<?php
											for($j=0; $j<count($arr_quiz_video); $j++){
													if($arr_quiz_video[$j]==$question['qid']){
														echo '<i class="far fa-play-circle"></i>';
													}
											}
											for($jj=0; $jj<count($arr_quiz_reading); $jj++){
												if($arr_quiz_reading[$jj]==$question['qid']){
													echo '<i class="far fa-file-alt"></i>';
												}
											}
										?>
										</li>		 
									<?php } ?>
										<?php } ?>
								</ol>
							</div>
						<?php } ?>
							
					</center>
					<div class="text-center">
					<div id="fb" style="margin-top:20px">
						<div class="fb-page" 
								data-href="https://www.facebook.com/stemupapp"
								data-width="450px" 
								data-hide-cover="false"
								data-show-facepile="true">
							</div>
					</div>
										
					</div>
				</div>

			</div>
	</div>
	
		</div>

				

		<!-- <div id="fb" style="margin-top:20px">
			<div class="fb-page" 
				  data-href="https://www.facebook.com/stemupapp"
				  data-width="450px" 
				  data-hide-cover="false"
				  data-show-facepile="true">
		    </div>
		</div> -->
		

		
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


<script>

var Timer;
var TotalSeconds;


function CreateTimer(TimerID, Time) {
Timer = document.getElementById(TimerID);
TotalSeconds = Time;

UpdateTimer()
window.setTimeout("Tick()", 1000);
}

function Tick() {
if (TotalSeconds <= 0) {

alert("Hết giờ!");
return;
}

TotalSeconds -= 1;
UpdateTimer()
window.setTimeout("Tick()", 1000);
}

function UpdateTimer() {
var Seconds = TotalSeconds;


var Minutes = Math.floor(TotalSeconds / 60);
Seconds -= Minutes * (60);


var TimeStr =  LeadingZero(Minutes) + ":" + LeadingZero(Seconds)


Timer.innerHTML = TimeStr;
}


function LeadingZero(Time) {

return (Time < 10) ? "0" + Time : + Time;

}

//var myCountdown1 = new Countdown({time:<?php echo $seconds;?>, rangeHi:"hour", rangeLo:"second"});
setTimeout(submitform,'<?php echo $seconds * 1000;?>');
function submitform(){
submit_quiz();
window.location="<?php echo site_url('quiz/submit_quiz/');?>";
}

 

 

</script>


<script type="text/javascript">
if($(window).width()>767){
	window.onload = CreateTimer("timer", <?php echo $seconds;?>);
}else{
	window.onload = CreateTimer("timer1", <?php echo $seconds;?>);
}
</script>

<script>
var ctime=0;
var ind_time=new Array();
<?php 
$ind_time=explode(',',$quiz['individual_time']);
for($ct=0; $ct < $quiz['noq']; $ct++){
	?>
ind_time[<?php echo $ct;?>]=<?php if(!isset($ind_time[$ct])){ echo 0;}else{ echo $ind_time[$ct]; }?>;
	<?php 
}
?>
noq="<?php echo $quiz['noq'];?>";
show_question('0');


function increasectime(){
	
	ctime+=1;
 
}
 setInterval(increasectime,1000);
 setInterval(setIndividual_time,30000);
 
</script>
<div class="modal-dialog">
  	<div id="warning_div" class="box-popup" style="position:fixed;z-index:100;display:none;width:84%;border-radius:5px;height:82%; border:10px solid #dddddd;left:8%;top:9%;">
		<div class="bg-xanhnhat">
			<div class="icon">
				<img src="<?php echo base_url();?>images/thongbao.png" alt="">
			</div>
		</div>
		<div class="box-chon" style="margin-top:2%;">
			<center><b style="font-size: 16px;"> <?php echo $this->lang->line('really_Want_to_submit');?></b> <br><br>
				<span id="processing"></span>
				<a href="javascript:cancelmove();"   class="btn btn-danger"  style="cursor:pointer;"><?php echo $this->lang->line('cancel');?></a> &nbsp; &nbsp; &nbsp; &nbsp;
				<a href="javascript:submit_quiz();"   class="btn btn-info"  style="cursor:pointer;"><?php echo $this->lang->line('submit_quiz');?></a>
			</center>
		</div>
	</div>
</div>
<!-- <div class="modal fade" id="popup_require_login" role="dialog" onclick="dismiss_modal(this)">
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
		</div> -->	
</div>

</body>
<script src="<?php echo base_url('js/bootstrap.js');?>"></script> 
<script>
	$(document).ready(function(){
		$('img').removeAttr('srcset');
		$('img').removeAttr('sizes');
		$('img').removeAttr('alt');
	});
	
</script>















  





 
