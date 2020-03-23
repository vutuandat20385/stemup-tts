<!DOCTYPE html>
<html lang="en">
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
	
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-dat.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet"> 
	
	
	<?php $this->load->view('stemup/head');?>
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
	<script src="<?php echo base_url('js/jquery.dataTables.js');?>"></script>
	<link href="<?php echo base_url('css/jquery.dataTables.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('js/addclass.js');?>"></script>
	<script src="<?php echo base_url('js/newuserpage.js');?>"></script>
	<script src="<?php echo base_url('js/responsive.dataTables.js');?>"></script>
	<script src="<?php echo base_url('js/minhash.js');?>"></script>
	<script src="<?php echo base_url('js/manage_class.js') ?>"></script>
		<script src="<?php echo base_url('js/setbackground.js');?>"></script>
	<link href="<?php echo base_url('css/responsive.dataTables.min.css');?>" rel="stylesheet">
	<script>

	
	var base_url="<?php echo base_url();?>";
	var site_url="<?php echo site_url();?>";
	var su="<?php echo $su ?>";
     var id_mcq_fun="<?php echo $id_mcq_fun ?>";
	    var id_quiz_fun ="";
	</script>
	<link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
	<script src="<?php echo base_url('js/select2.min.js');?>"></script>
<script src="<?php echo base_url('js/editprofile.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('js/formattoolbar.js')?>"></script>

	<script src="<?php echo base_url('js/left-menu.js');?>"></script>
	<script src="<?php echo base_url('js/notification.js');?>"></script>
	<script src="<?php echo base_url('js/star-rating.js');?>"></script>
	<script src="<?php echo base_url('js/paginate.js');?>"></script>
		<script src="<?php echo base_url('js/assign.js');?>"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
	  
	  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> <script> (adsbygoogle = window.adsbygoogle || []).push({ google_ad_client: "ca-pub-3948834986570227", enable_page_level_ads: true }); </script>


<style>
</style>
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
<header class="container-fluid bg-stemup hidden-xs">
		<div class="container">	<?php $this->load->view('stemup/header');?> 	</div>
</header>
 
<main class="container MT70">
  
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
	
    <?php if($su==3){?>
	<div class="modal fade" id="previewquestionModal" role="dialog">
		<div class="modal-dialog" style="width:40%">	 
			 <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title" id="prqt"></h4>
				</div>
				<div class="modal-body">
					 <div class="form-group MT20">
						<div id="questionp"></div>
					 </div>
					 <p><h5><b>Đáp án</b></h5></p>
					 <div id="answer-areap">
					 </div>
					 <div id="optionareap">
					 </div>	
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				
			 </div>
			  
		</div>
	</div>
	<div class="modal fade" id="previewquizModal" role="dialog">
		<div class="modal-dialog" style="width:50%">	 
			 <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title" id="quiztitlepr"></h4>
				</div>
				<div class="modal-body" id="quizbodypr">
					
					
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				
			 </div>
			  
		</div>
	</div>
	<?php }?>
			  <div class="modal fade" id="addstudentModal" role="dialog">
			<div class="modal-dialog">	 
				 <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Thêm con</h4>
					 
					</div>
					<div class="modal-body">
						<input type="text" class="form-control form-TK1 col-xs-12" id="student_code" name="student_code" style="width:450px" placeholder="Mã học sinh"/>
						<button type="submit" class="btn btn-primary" id="btn_sm_addchild"  style="margin-left:30px" onclick="add_child()">Xác nhận</button>
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				 </div>
				  
			</div>
		</div>
		<?php if($su==4){?>
		<div class="modal fade" id="createchildModal" role="dialog">
			<div class="modal-dialog">	 
				 <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Tạo tài khoản cho con</h4>
					 
					</div>
					<div class="modal-body">

						   <div class="form-group">	
							  Họ tên của con: <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Họ tên" required>
							  <div id="error_child" style="color: red;"></div>
							</div>
							<div class="form-group">	
							  Email của con: <input type="text" id="email" name="email" class="form-control" placeholder="email" required>
							  <div id="error1_child" style="color: red;"></div>
							</div>
							<div class="form-group">	
							Mật khẩu: <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mật khẩu" required >
							<div id="error2_child" style="color: red;"></div>
						   </div>
						   <div class="form-group">	
							Xác nhận mật khẩu: <input type="password" id="inputcfmPassword" name="passwordcfm" class="form-control" placeholder="Xác nhận lại mật khẩu" required >
							<div id="error3_child" style="color: red;"></div>
						   </div>
					       <button type="submit" class="btn btn-primary" id="btn_pr" >Xác nhận</button>
					  <script type="text/javascript">
					  		$('#btn_pr').on("click",function(){
					  			first_name=$('#first_name').val();
					  			email=$('#email').val();
					  			password=$('#inputPassword').val();
					  			passwordcfm=$('#inputcfmPassword').val();
					  			console.log(first_name);
					  			console.log(email);
					  			console.log(password);
					  			console.log(passwordcfm);
					  			$('#error_child').empty();
					  			$('#error1_child').empty();
					  			$('#error2_child').empty();
					  			$('#error3_child').empty();
					  			if(first_name==''){
					  				$('#error_child').html('<i>Họ tên của con không được để trống</i>');
					  				// console.log(first_name+"aaa");
					  			}else if(email==''){
					  				$('#error1_child').html('<i>Email của con không được để trống</i>');
					  			}else {
								    var email = document.getElementById('email').value;
								    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
								    if (!filter.test(email)) {
								    // alert('Địa chỉ Email không hợp lệ! \nVui lòng nhập lại Email');
								    $('#error1_child').html('<i>Địa chỉ Email không hợp lệ, vui lòng nhập lại Email</i>');
								    email.focus;
								    return false;
									}
					  				if(password==''){
					  					$('#error2_child').html('<i>Mật khẩu không được để trống</i>');
					  				}else if(passwordcfm==''){
					  					$('#error3_child').html('<i>Mật khẩu xác nhận không được để trống</i>');
					  				}else if(password!=passwordcfm){
					  					$('#error3_child').html('<i>Mật khẩu xác nhận không trùng khớp</i>');
					  				}else{
					  					$.ajax({
					  						type: 'POST',
					  						data: {first_name:first_name,email:email,password:password,passwordcfm:passwordcfm},
					  						url:"<?php echo site_url('/home_user/create_child') ?>",
					  						success: function(data){
					  							console.log(data);
					  							if(data==true){
					  								$('#createchildModal').modal('hide');
					  								alert('Bạn đã đăng ký thành công!');
					  							}else{
					  								alert('Email này đã được đăng ký \nVui lòng đăng ký bằng Email khác');
					  							}
					  						},
					  						error: function(data){
					  						}
					  					});
					  				}
					  			}
					  		});
					  </script>
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				 </div>
				  
			</div>
		</div>
		<?php } ?>
	<?php if($su==2){?>
	<div class="modal fade" id="joinClassModal" role="dialog">
			<div class="modal-dialog">	 
				 <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Tham gia lớp</h4>
					 
					</div>
					<div class="modal-body">
							 <input type="text" class="form-control form-TK1 col-xs-12"  name="class_code" id="class_code" onkeyup="checklengthtab(event,this.value)" style="width:450px" placeholder="Nhập Mã lớp"/>
					          <button  id="btjoinclass" onclick="checklength()" class="btn btn-primary" style="margin-left:30px">Xác nhận</button>
										<br><br>
										<p id="error" style="color:red" ></p>
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				 </div>
				  
			</div>
		</div>
     <?php }?>
    
	<section class="row"> 
	<?php $this->load->view('stemup/menu');?>
	  <aside class="col-md-7">
	      
		<div class="box-bor-quiz mb-20">
			  <h3 class="mt-0">Bài trắc nghiệm: <a href="<?php echo site_url('quiz/validate_quiz/'.$quiz_fun['quid']);?>"><?php echo $quiz_fun['quiz_name'] ?></a></h3>
			 <!-- <h4 class="mt-0"><a href=""><?php echo $quiz_fun['description'] ?></a></h4>-->
			 
			  <div class="row hidden-xs">
			      <?php foreach($quiz_fun['question'] as $k=>$qf){?>
						<a class="col-md-3 col-xs-6 mb-10" href="<?php echo site_url('quiz/validate_quiz/'.$quiz_fun['quid']);?>"><img class="img-responsive img_quiz" src="<?php echo $qf['img'];?>" alt=""></a>
				  <?php }?>
				 
			  </div>
			  <div class="hidden-dt">
				  <div class="row">
					  <?php foreach($quiz_fun['question'] as $k=>$qf){
							if($k<2){?>
							<a class="col-md-3 col-xs-6 mb-10" href="<?php echo site_url('quiz/validate_quiz/'.$quiz_fun['quid']);?>"><img class="img-responsive img_quiz" src="<?php echo $qf['img'];?>" alt=""></a>
							<?php }}?>
					 
				  </div>
				   <div class="row">
					  <?php foreach($quiz_fun['question'] as $k=>$qf){
							if($k>=2){?>
							<a class="col-md-3 col-xs-6 mb-10" href="<?php echo site_url('quiz/validate_quiz/'.$quiz_fun['quid']);?>"><img class="img-responsive img_quiz" src="<?php echo $qf['img'];?>" alt=""></a>
							<?php }}?>
					 
				  </div>
			   </div>
			   <div class="col-xs-12 bo-tb">
				 <div class="row">
					  <div class="col-xs-12" style="margin-bottom:5px">
						  <ul class="list-inline text-bt">
						      <?php if($quiz_fun['liked']==1){?>
							  <li class="col-xs-3"><a class="acti pointer" onclick="like_quiz(this,<?php echo $quiz_fun['quid']; ?>)" ><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs">Thích</span></a></li>
							  <?php } else{?>
							  <li class="col-xs-3"><a class="pointer" onclick="like_quiz(this,<?php echo $quiz_fun['quid']; ?>)"><i class="fas fa-thumbs-up mr-5"></i><span class="hidden-xs"> Thích</span></a></li>
							  <?php }?>
							  <li class="col-xs-3"><a class="pointer" data-toggle="collapse" data-target="#comment_quiz_main_<?php echo $quiz_fun['quid']?>" ><i class="far fa-comment-alt mr-5"></i><span class="hidden-xs">Bình luận</span></a></li>
							    <li class="col-xs-3"><a class="pointer" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fstemup.app%2Findex.php%2Fpage%2Fquiz%2F<?php echo  $quiz_fun['permalink']?>&amp;src=sdkpreparse" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0');count_share2(<?php echo $quiz_fun['quid'];?>); return false;"><i class="fas fa-share-alt mr-5"></i><span class="hidden-xs">Chia sẻ</span></a></li>
							  
							</li>
							<li class="col-xs-3">
								<a class="pointer" onclick="assignQuiz(<?php echo $quiz_fun['quid']; ?>, <?php echo $su;?>)"><i class="fas fa-share-square mr-5"></i><span class="hidden-xs"> Đố </span></a>
							</li>
						  </ul>
					  </div>
					   
				  </div>
				 </div>
				  <div id="like_statistic_quiz_<?php echo $quiz_fun['quid']?>">
				  <?php if($quiz_fun['liked']==1|| $quiz_fun['n_like']>0 ){?>
					  <div class="col-xs-12 bo-B" >		 
						 <i style="width:20px" class="fas fa-thumbs-up mr-5 bo-tron bg-primary"></i>
						 <a class="f10" href="#">
							 <?php if($quiz_fun['liked']==1){?>
								 
								<?php if($quiz_fun['n_like'] >0) { echo 'Bạn và';} else echo $user_name;?>
							 <?php }?>
							 <?php if($quiz_fun['n_like'] >0) {echo " ".$quiz_fun['n_like'].' người' ;}?> 
						 </a>
					  </div>
				  <?php }?>
				  </div>
				   <?php if($quiz_fun['share_count']>0){ ?>
			   <div class="col-xs-12">
				   <p class="f10 text-xam"><i class="fas fa-share-alt mr-5"></i><?php echo $quiz_fun['share_count']?> lượt chia sẻ</p>
			   </div>
			   <?php } ?>
				   <div class="col-xs-12 collapse" id="comment_quiz_main_<?php echo $quiz_fun['quid']?>">
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
						   <div class="media-body" >
							 <input type="text" class="form-control bo-input inp_comment" onkeyup="write_comment(this,event,'quiz',<?php echo $quiz_fun['quid']?>)"   placeholder="Bình luận">
						   </div>

					  </div>
					</div>
			    </div>
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
								 <!--  <p class="text-small1">
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
	
      </aside>
      
      <aside class="col-md-3 rightbar">
	 
	   <div class="box-bor MB20">
		  <h3 class="text-xanh1"><a href="">BÀI TRẮC NGHIỆM </a></h3>
		  <?php foreach($quiz_fun_rb as $qz){?>
		      <div style="margin-bottom:20px" class="bo-B">
				<a href="<?php echo site_url('quiz/validate_quiz/'.$qz['quid']);?>"> <img src="<?php echo $qz['img'];?> " width="100%"></a><br/>
		         <a style="font-size:15px" href="<?php echo site_url('quiz/validate_quiz/'.$qz['quid']);?>"><b><?php echo $qz['quiz_name'];?></a></b>
			 </div>
		  <?php }?>
		 <!-- <div id="activities"></div>-->
		 
        </div>
      </aside>


    </section>
	
  	</main>
  	<section id="lienhe" class="container-fluid bg-stemup pd-30">
		<div class="container">
			<div class="row padTB15">
				<div class="col-md-7 boL1 text-center767">
					<p class="text-trang">© 2019 DTT. Inc. All Rights Reserved.</p>
				</div>
				<div class="col-md-5 text-right">
					<div class="mb-20"><a class="text-trang" href="">www.facebook.com/stemupapp</a><br></div>
					<a href=""><img src="<?php echo base_url('images/stemup_images/google-01.svg')?>" height="25" alt=""></a>
					<a href=""><img src="<?php echo base_url('images/stemup_images/iphone-02.svg')?>" height="25" alt=""></a>
				</div>
			</div>
		</div>
	</section>
   
  </body>
      
  </html>
