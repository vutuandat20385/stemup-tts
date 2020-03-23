   <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kết quả</title>
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
    <!-- Bootstrap -->
	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">

    	<link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
	<script src="<?php echo base_url('js/newuserpage.js');?>"></script>
	<script src="<?php echo base_url('js/view_result.js');?>"></script>

	<script>
	var base_url="<?php echo base_url();?>";
	var site_url="<?php echo site_url();?>";
	var su="<?php echo $su ?>";
   var id_mcq_fun ="";
   var id_quiz_fun ="";
   var qids = "<?php  echo $result['r_qids']?>";
   var qid_arr= qids.split(",");
	</script>

	<script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>



	<script src="<?php echo base_url('js/notification.js');?>"></script>

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
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user');?>/assign_quiz" ><i class="mr-5 far fa-calendar-check"></i><br class="hidden-xs">Nhiệm vụ</a>
			</li>
			<li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user');?>/results" ><i class="mr-5 far fa-chart-bar"></i><br class="hidden-xs">Kết quả</a>
			</li>
			<li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('library/video'); ?>"><i class="mr-5 fas fa-cloud"></i><br class="hidden-xs">Thư viện</a>
			</li>
			<?php if($su==2) { ?>
			<!-- <li  class="dropdown mdropdown">
				<a class="text-trang hover text-center text-l" href="#"  data-toggle="dropdown">
					<i class="far fa-envelope"></i>
					<span class="badge badge-sm up bg-pink count mcount  mr-5"></span>
					<br class="hidden-xs">Tin nhắn
				</a>
				<div  class="dropdown-menu" id="notifications">
                    <!- <h3>Notifications</h3> ->
                    <header class="dropdown__header fx-lt">
                    	<div class="dropdown__title fx mr10"> 
	                    	<span translate="">
	                    		<span>Tin nhắn</span>
	                    	</span> 
                    	</div>
                    	<a class="dropdown__setting">
                    		<i class="udi fas fa-cog"></i>
                    	</a>
                    </header>
                    <div class="message__list">
                    </div>
                    <div class="dropdown__footer">
                    	<a class="link--dropdown-footer link--see-all" href="<?php echo site_url('home_user/notifications') ?>">
                    		Xem tất cả
                    		<i class="mr10 fa fa-angle-right"></i>
                    	</a>
                    </div>
                </div>
			</li> -->
			<?php } ?>
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
 
 
 
 <script src="<?php echo base_url('js/TweenMax.min.js');?>"></script>
 <style>
@media print {
   
   .navbar{
   display:none;
   }
   #footer{
   display:none;
   } 
   .printbtn{
	  display:none; 
   }
   #social_share{
	   display:none;
   }
   
   #page_break2{
	   
   page-break-after: always;
	}
	
.noprint{
	
	display:none; 
}
}
@media screen {
.onlyprint{
	display:none; 
	
}
}
 td{
		color:#212121;
		font-size:14px;
		padding:4px;
	}
	
	
	
	
	
	.circle_result{
	
	    width: 40px;
    height: 40px;
    border-radius: 20px;
    background: #0b8d6f;
    color: #ffffff;
    padding: 5px;
    font-size: 16px;
    text-align: center;
	margin-right:20px;
		float:left;
}


.circle_ur{
	
	    width: 40px;
    height: 40px;
    border-radius: 20px;
    background: #ffcc66;
    color: #ffffff;
    padding: 5px;
    font-size: 16px;
    text-align: center;
	margin-right:20px;
	float:left;
}


.circle_l{
	
	    width: 40px;
    height: 40px;
    border-radius: 20px;
    background: #ff3300;
    color: #ffffff;
    padding: 5px;
    font-size: 16px;
    text-align: center;
	margin-right:20px;
	float:right;
}

.td_line{
	background:url('<?php echo base_url('images/rankbar.png');?>');background-repeat: repeat-x;
}
</style>
 <div class="container">
<?php 
$logged_in=$this->session->userdata('logged_in');
?>
   
    
 
<?php 

function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
    else
        return $number. $ends[$number % 10];
}

function questioninwhichcategory($key,$c_range){
	foreach($c_range as $k => $cv){
		
		if($key >= $cv[0] && $key <= $cv[1]){
			return $k;
		}
	}
	
}




function cia_cat($narray,$c_range){
	$unattempted=array();
	$correct=array();
	$incorrect=array();
	foreach($narray as $k => $val){
		
	if($val==0){
		if(isset($unattempted[questioninwhichcategory($k,$c_range)])){
		$unattempted[questioninwhichcategory($k,$c_range)]+=1;
		}else{
		$unattempted[questioninwhichcategory($k,$c_range)]=1;	
		}
	}else if($val==1){
// $correct+=1;
		if(isset($correct[questioninwhichcategory($k,$c_range)])){
		$correct[questioninwhichcategory($k,$c_range)]+=1;
		}else{
		$correct[questioninwhichcategory($k,$c_range)]=1;	
		}
	}else if($val==2){
// $incorrect+=1;
		if(isset($incorrect[questioninwhichcategory($k,$c_range)])){
		$incorrect[questioninwhichcategory($k,$c_range)]+=1;
		}else{
		$incorrect[questioninwhichcategory($k,$c_range)]=1;	
		}
	}	
	 
		 
	 
	}
	
	return array($correct,$incorrect,$unattempted);
}





function cia_tim_cate($narray,$tim,$c_range){
	$unattempted=array();
	$correct=array();
	$incorrect=array();
	foreach($narray as $k => $val){
	
	if($val==0){
		if(isset($unattempted[questioninwhichcategory($k,$c_range)])){
		$unattempted[questioninwhichcategory($k,$c_range)]+=$tim[$k];
		}else{
		$unattempted[questioninwhichcategory($k,$c_range)]=$tim[$k];	
		}
	}else if($val==1){
// $correct+=1;
		if(isset($correct[questioninwhichcategory($k,$c_range)])){
		$correct[questioninwhichcategory($k,$c_range)]+=$tim[$k];
		}else{
		$correct[questioninwhichcategory($k,$c_range)]=$tim[$k];	
		}
	}else if($val==2){
// $incorrect+=1;
		if(isset($incorrect[questioninwhichcategory($k,$c_range)])){
		$incorrect[questioninwhichcategory($k,$c_range)]+=$tim[$k];
		}else{
		$incorrect[questioninwhichcategory($k,$c_range)]=$tim[$k];	
		}
	}	
	
	}
		
	return array($correct,$incorrect,$unattempted);
}

function prezero($val){
	if($val <= 9){
	return '0'.$val;	
	}else{
		return $val;
	}
}
function secintomin($sec){
	if($sec >= 60){
	$splitin=explode('.',($sec/60));
	if(isset($splitin[1])){
		$secs=substr(intval((substr($splitin[1],0,2)*60)/100),0,2);
	}else{
		$secs=0;
	}
	return $splitin[0].' phút '.prezero($secs).' giây';
	}else{
	return prezero($sec).' giây';	
	}
}


function per_nonzero($arr){
	
$totallen=count($arr);
$filt=array_filter($arr);
$per=(count($filt)/$totallen)*100;
return intval($per);	
}

$c_range=array();
$j=0;
$i=0;
foreach(explode(",",$result['category_range']) as $ck => $cv){
	$c_range[]=array($i,($i+($cv-1)));
	$i+=$cv;
}
$correct_incorrect_unattempted=explode(",",$result['score_individual']);
 
$cia_cat=cia_cat($correct_incorrect_unattempted,$c_range);
 
$cia_tim_cate=cia_tim_cate($correct_incorrect_unattempted,explode(",",$result['individual_time']),$c_range);



?>
<div class="row noprint">
<?php 
		//if($this->session->flashdata('message')){
		//	echo $this->session->flashdata('message');	
		//}
		?>	
		
<div class="col-lg-12" id="resinfo" style="background-image:url('<?php echo base_url('images/result_bg.jpg');?>');background-size:cover;font-size:18px;padding:40px;color:#ffffff;min-height:540px;">

<div class="col-lg-12" >
<div style="padding-botom:40px" >
<center>
<h1 class="hidden-xs"><span style="color:#e39500;"> Bài trắc nghiệm <?php echo $result['quiz_name'];?>  </span></h1>
</center>
<center>
<center style="margin-top:20px">
<h1><span style="color:#e39500;"> Kết quả làm bài của <?php echo $result['first_name'].' '.$result['last_name'];?> </span></h1>
</center>
<center style="margin-top:20px">
<h1><span style="color:#e39500;"> Điểm: <?php echo $result['score_obtained'].'/'.count($questions);?>  </span></h1>
</center>
</div>
<div>
<center  style="margin-top:20px"><h3><span style="color:#e39500;"> 
</span> <?php echo $result['result_status'];?> bài trắc nghiệm </center>

<center  style="margin-top:10px"><h3><span style="color:#e39500;"> 
</span> Thời gian làm bài là <?php echo secintomin($result['total_time']);?> </h3></center>

<center  style="margin-top:10px"><h3><span style="color:#e39500;"> 
</span>  <?php echo str_replace('{attempt_no}',$attempt,$this->lang->line('title_result'));?>!</h3></center>
</div>
</div>

<div>
<center><button  id="xctbt" class="btn btn-primary" type="button"  style="font-size:25px; margin-top:40px; margin-botom:20px">
    Xem đáp án chi tiết
  </button></center>
</div>


</div>



</div>

<!--  -->
<script type="text/javascript">
	var cur_page=0;
    var endpage= <?php echo count($questions)-1;?>;
    var startpage= <?php echo count($questions);?>;
    // var startpage= <?php echo count($questions)-count($questions);?>;
    console.log(endpage+1);
    // console.log(startpage);
	/*$(document).keypress(function(event){
		var keycode=(event.keyCode ? event.keyCode : event.which);*/
	document.onkeydown = checkKey;

		function checkKey(e) {
			e = e || window.event;

		    if (e.keyCode == '37') {
		        if(cur_page==0){
					cur_page=startpage;
				}
				// alert('Bạn vừa nhấn nút left arrow');
				cur_page--;
				shoq(cur_page);

				console.log(cur_page);
			    }
			    else if (e.keyCode == '39') {
			       	 if(cur_page==endpage){
						cur_page=-1;
					}
					// alert('Bạn vừa nhấn nút right arrow');
					cur_page++;
					// $(cur_page).hide();
					// $(cur_page).eq(cur_page).show();
					shoq(cur_page);

					console.log(cur_page);
				    }

			}
		/*if(keycode == '39'){
			if(cur_page==endpage){
				cur_page=-1;
			}
			// alert('Bạn vừa nhấn nút right arrow');
			cur_page++;
			// $(cur_page).hide();
			// $(cur_page).eq(cur_page).show();
			shoq(cur_page);

			console.log(cur_page);
		}
		if(keycode=='37'){
			if(cur_page==0){
				cur_page=startpage;
			}
			// alert('Bạn vừa nhấn nút left arrow');
			cur_page--;
			shoq(cur_page);

			console.log(cur_page);
		}*/
		console.log('aaaaaaaaa');
	// });
</script>
				
<?php 
$noq=count($result['r_qids']);
$category_range=explode(',',$result['category_range']);
$category_ranges=array();
$qi=0;
foreach($category_range as $qik => $qvv){
	$category_ranges_i=array($qi,($qi+($qvv-1)));
	$category_ranges[]=$category_ranges_i;
	$qi+=$qvv;
}
?>
<?php  ?>

<div class="row" id="rsct" style="margin-top:40px;">
	<div class="col-md-12 collapse" id="resultbyeach">
			<?php
		$ind_score=explode(',',$result['score_individual']); 
		// view answer
		if($result['view_answer']=='1' || $logged_in['su']=='1'){
			?>
		<a name="answers_i"></a>
		<?php 
		$abc=array(
		'0'=>'A',
		'1'=>'B',
		'2'=>'C',
		'3'=>'D',
		'4'=>'E',
		'6'=>'F',
		'7'=>'G',
		'8'=>'H',
		'9'=>'I',
		'10'=>'J',
		'11'=>'K'
		);
		$seg3=$this->uri->segment(4);
		if($seg3==''){
			$seg3=0;
		}

		foreach($questions as $qk => $question){
		// remove below condition for all solution at one page
		$question['question'] = str_replace("https://latex.codecogs.com/gif.latex?", 'https://latex.codecogs.com/gif.latex?\bg_white&space;', $question['question']);
		?>
		<!-- aaaa -->
		<div class="rqn" id="qn<?php echo $qk;?>" style="<?php if($qk==0){ echo 'display:block;';}else{ echo 'display:none;';} ?>">
			<div class="col-md-12 " id="q<?php echo $qk;?>" class="resqt" style="padding:40px; background-image:url('<?php echo base_url('images/result_bg.jpg');?>');background-size:cover;color:#ffffff;min-height:540px;">
				<!--<div class="col-md-1 col-sm-1">
					<div style="height:45px; width:45px; background-color:#ffffff;border-radius:50%;color:#4b7d42;
					margin-top:6px;padding:14px;border:1px solid #666666;"><b><?php echo $qk+1;?></b> </div>
				</div>-->
				<div >
				    <div class="col-md-12" >
						<a href="javascript:shoq(p_q_index);" class="btn btn-default btn-prev btn-prev_e"><b><?php echo '<<';?></b></a>
						<a href="javascript:shoq(n_q_index);" class="btn btn-default btn-next btn-next_e"><b><?php echo '>>';?></b></a>
					</div>
						<?php
					if(strip_tags($question['paragraph'])!=""){
						echo $this->lang->line('paragraph')."<br>";
						echo $question['paragraph']."<hr>";
					}
						?>
					<div class="col-md-6" style="margin-left: -50px;margin-right: -50px;">
					  	<?php
							 // multiple single choice
							 if($question['question_type']==$this->lang->line('multiple_choice_single_answer')){
								echo '<div style="margin-top:25px;color:#e39500;" class="hidden-xs"><h2><b>Bài trắc nghiệm</b>: ' .$result['quiz_name'].'</h2></div>';?>
							    <div class="hidden-dt"> 
								    <?php if(strpos($question['question'],'https://latex.codecogs.com')!==false ||(strpos($question['question'], '<iframe')===false && strpos($question['question'], '<img')===false))
								    {?>
								    <div class="col-md-6 imgres1">
								        <div class="bgqtdiv ft20"  style="margin-left: 0px;" >
											<font color="white">
												<div  style=" background-image:url('https://stemup.app/upload/background/<?php if($question['background_template']!=0){ echo $question['background_template'];} else{ echo rand(1,20);}?>.jpg');margin-left: 0px;padding-right: 0;" class="outer bgqt">
													<div class="middle">
														<div class="inner" style="margin-left: -20px;">
															<?php  if(strpos($question['question'],'https://latex.codecogs.com')!==false){ ?>
																<?php echo html_entity_decode($question['question'])?>
														    <?php } else{?>
														        <?php echo strip_tags($question['question'])?>
															<?php 
																} 
															?>
														</div>
													</div>
												</div>
											</font>
									    </div>
								    </div>
									<?php }  else{ ?>
									<div class="col-md-6 imgres1" >
										<?php
											preg_match_all('/<img[^>]+>/i',$question['question'], $imgTags); 
											if(count($imgTags[0])>0){
												echo str_replace('src="..','class="img-responsive" src="https://stemup.app',$imgTags[0][0]);
											}
											$origvidSrc="";
										    preg_match_all('/<iframe[^>]+>/i',$question['question'], $vidTags); 
										    if(count($vidTags[0])>0){
												echo  '<div class="video-wrapper">'. str_replace('allowfullscreen="allowfullscreen"',' data-autoplay="true"',$vidTags[0][0]).'</iframe></div>';
											}
											// echo str_replace('src="..','src="https://stemup.app',$question['question']);
										?><br>
									</div>
									<?php }?>
								</div> 
							 	<?php  if(strpos($question['question'],'https://latex.codecogs.com')!==false){ 
									echo '<div class="box-qt-res" style="margin-left: 10px;"><div style="font-size:20px;margin-right:50px;"><em><b>Câu hỏi</b>: '.html_entity_decode($question['question']).'</em></div></div>';
							  		} else{
								   		echo '<div class="box-qt-res" style="margin-left: 10px;"><div style="font-size:20px;margin-right:50px;"><em><b>Câu hỏi</b>: '.strip_tags($question['question']).'</em></div></div>';
									} 
									$save_ans=array();
							 		foreach($saved_answers as $svk => $saved_answer){
								 		if($question['qid']==$saved_answer['qid']){
											$save_ans[]=$saved_answer['q_option'];
										}
									}
								?>
						<input type="hidden"  name="question_type[]"  id="q_type<?php echo $qk;?>" value="1">
					    <?php
						$i=0;
						$correct_options=array();
						foreach($options as $ok => $option){
							if($option['qid']==$question['qid']){
								if($option['score'] >= 0.1){
									$correct_options[]=$option['q_option'];
								}
								?>
								<?php 
							 	$i+=1;
							}else{
								$i=0;	
							}
						}echo "<br>";
                		$correct_options = str_replace("https://latex.codecogs.com/gif.latex?", 'https://latex.codecogs.com/gif.latex?\bg_white&space;', $correct_options);
						if(strpos($correct_options[0], '&lt;')===false){
                			echo "<div class='box-qt-res' style='margin-left: 10px;'><div style='font-size:20px;'><b>".$this->lang->line('correct_options').'</b>: '.html_entity_decode(implode(', ',array_map('trim',($correct_options)))).'</div></div>';
                		}else {
                			echo "<div class='box-qt-res' style='margin-left: 10px;'><div style='font-size:20px;'><b>".$this->lang->line('correct_options').'</b>: '.htmlentities(html_entity_decode(implode(', ',array_map('trim',($correct_options))))).'</div></div><br/>';
						}
					}
						// multiple_choice_multiple_answer	
						if($question['question_type']==$this->lang->line('multiple_choice_multiple_answer')){
							$save_ans=array();
				    		foreach($saved_answers as $svk => $saved_answer){
					   			if($question['qid']==$saved_answer['qid']){
									$save_ans[]=$saved_answer['q_option'];
								}
							}
							?>
							<input type="hidden"  name="question_type[]"  id="q_type<?php echo $qk;?>" value="2">
							<?php echo '<b>'.$this->lang->line('your_answer').'</b>:';
							$i=0;
							$correct_options=array();
							foreach($options as $ok => $option){
								if($option['qid']==$question['qid']){
									if($option['score'] >= 0.1){
										$correct_options[]=$option['q_option'];
									}
									?>
									<?php 
									if(in_array($option['oid'],$save_ans)){   echo  trim($option['q_option']).', '; }?> 
								 	<?php 
								 	$i+=1;
								}else{
									$i=0;	
								}
							}echo "<br>";
							echo "<b>".$this->lang->line('correct_options').'</b>: '.implode(', ',$correct_options);
						}
						// short answer	
						if($question['question_type']==$this->lang->line('short_answer')){
							$save_ans="";
							foreach($saved_answers as $svk => $saved_answer){
								if($question['qid']==$saved_answer['qid']){
									$save_ans=$saved_answer['q_option'];
								}
							}
							?>
							<input type="hidden"  name="question_type[]"  id="q_type<?php echo $qk;?>" value="3"   >
							<?php
							?>
							<div class="op"> 
								<?php echo '<b>'.$this->lang->line('your_answer').'</b>:';?> 
							    <?php echo $save_ans;?>   
							</div>
							<?php 
							foreach($options as $ok => $option){
								if($option['qid']==$question['qid']){
									echo "<b>".$this->lang->line('correct_answer').'</b>: '.$option['q_option'];
								}
							}
						}
						// long answer	
						if($question['question_type']==$this->lang->line('long_answer')){
							$save_ans="";
							foreach($saved_answers as $svk => $saved_answer){
								if($question['qid']==$saved_answer['qid']){
									$save_ans=$saved_answer['q_option'];
								}
							}
							?>
							<input type="hidden"  name="question_type[]" id="q_type<?php echo $qk;?>" value="4">
							<?php
							?>
							<div class="op"> 
								<?php echo $this->lang->line('answer');?> <br>
								<?php echo $this->lang->line('word_counts');?>  <?php echo str_word_count($save_ans);?>
								<textarea name="answer[<?php echo $qk;?>][]" id="answer_value<?php echo $qk;?>" style="width:100%;height:100%;" onKeyup="count_char(this.value,'char_count<?php echo $qk;?>');"><?php echo $save_ans;?></textarea>
							</div>
							<?php 
							if($logged_in['su']=='1'){
								if($ind_score[$qk]=='3'){?>
									<div id="assign_score<?php echo $qk;?>">
										<?php echo $this->lang->line('evaluate');?>	
										<a href="javascript:assign_score('<?php echo $result['rid'];?>','<?php echo $qk;?>','1');"  class="btn btn-success" ><?php echo $this->lang->line('correct');?></a>	
										<a href="javascript:assign_score('<?php echo $result['rid'];?>','<?php echo $qk;?>','2');"  class="btn btn-danger" ><?php echo $this->lang->line('incorrect');?></a>	
									</div>
							  <?php }
							}
							?>		
							<?php 
						}
						// matching	
						if($question['question_type']==$this->lang->line('match_the_column')){
							$save_ans=array();
							foreach($saved_answers as $svk => $saved_answer){
								if($question['qid']==$saved_answer['qid']){
									// $exp_match=explode('__',$saved_answer['q_option_match']);
									$save_ans[]=$saved_answer['q_option'];
								}
							}
							?>
							<input type="hidden" name="question_type[]" id="q_type<?php echo $qk;?>" value="5">
							<?php
							$i=0;
							$match_1=array();
							$match_2=array();
							foreach($options as $ok => $option){
								if($option['qid']==$question['qid']){
									$match_1[]=$option['q_option'];
									$match_2[]=$option['q_option_match'];
							?>
							<?php 
									$i+=1;
								}else{
									$i=0;	
								}
							}
							?>
							<div class="op">
								<table>
									<tr>
										<td></td>
										<td><?php echo "<b>".$this->lang->line('your_answer').'</b> ';?></td>
										<td><?php echo "<b>".$this->lang->line('correct_answer').'</b> ';?></td>
									</tr>
									<?php 
									foreach($match_1 as $mk1 =>$mval){ ?>
										<tr>
											<td>
												<?php echo $abc[$mk1];?>)  <?php echo $mval;?> 
										    </td>
											<td>
												<?php 
												foreach($match_2 as $mk2 =>$mval2){?>
				  									<?php $m1=$mval.'___'.$mval2; if(in_array($m1,$save_ans)){ echo $mval2; } ?>  
													<?php 
												}
												?>
											</td>
											<td>
												<?php 
													echo $match_2[$mk1];
												?>
											</td>
										</tr>
									<?php 
									} ?>
								</table>
							</div>
								<?php
						}
							?>
						<p>
							<div class="box-descr-res hidden-xs"><?php
								if($question['description']!='') {
									if(strpos($question['description'],"<img")!==false){ // Tìm kiếm vị trí xuất hiện đầu tiên của 1 chuỗi con trong 1 chuỗi cho trước
										$des=str_replace('src="..','class="img-responsive" src="'.base_url(),$question['description']);// tìm kiếm và thay thế chuỗi
										echo $des;
									}else{
										$des=strip_tags($question['description']);// Loại bỏ các thẻ HTML, ký tự đặc biệt trong PHP
										echo '<div style="font-size:20px;"><b>'.$this->lang->line('description').'</b>: ';
										if (strlen($des)>260){// trả về số lượng hay chiều dài của chuỗi
											$pos=strpos($des," ",250); 
											// Hàm substr cắt chuỗi 
											echo substr($des,0,$pos).'<span class="three_dotcomma">... </span><span class="more_descr" style="display:none;">'.substr($des,$pos).'</span><a class="pointer" onclick="see_more_descr(this)"><span style="color:#02a3f3"> Xem thêm</span></a></div>';
										}else{
											echo $des.'</div>';
										}
									}
								}
							?>
							</div>
							<div class="box-descr-res hidden-dt"><?php
								if($question['description']!='') {
									if(strpos($question['description'],"<img")!==false){
											echo str_replace('src="..','class="img-responsive" src="'.base_url(),$question['description']);
									}else{
										$des=strip_tags($question['description']);
										echo '<div style="font-size:20px;"><b>'.$this->lang->line('description').'</b>: ';
										if (strlen($des)>80){
											$pos=strpos($des," ",70); 
											echo substr($des,0,$pos).'<span class="three_dotcomma">... </span><span class="more_descr" style="display:none;">'.substr($des,$pos).'</span><a class="pointer" onclick="see_more_descr(this)"><span style="color:#02a3f3"> Xem thêm</span></a></div>';
										}else{
												echo $des.'</div>';
										}
									}
								}
							?>
							</div>
						</p>
							<?php 
						if($this->config->item('q2a')){
							$q2a_path=$this->config->item('q2a_path');
								?>
							<div id="q2a<?php echo $qk;?>">
							</div>	
								<?php 
						}
							?>
						<div class="box-statans-res menu-btn">
						</div>
						<div class="col-xs-12 bo-letf-right social-box-res" style="z-index:100">
							<div class="bo-tb">
							  	<div class="row">
								  	<div class="col-xs-12" style="margin-bottom:5px">
									  <ul class="list-inline text-bt text-res social_area">
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
							</div>
							   <?php if($question['share_count']>0){ ?>
							<div class="col-xs-12">
							   <p class="f10"><i class="fas fa-share-alt mr-5"></i><?php echo $question['share_count']?> lượt chia sẻ</p>
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
									    <div class="media-body" >
										    <input type="text" class="form-control bo-input inp_comment" onkeyup="write_comment(this,event,'qbank',<?php echo $question['qid']?>)"  placeholder="Bình luận">
									    </div>
								    </div>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
						  	<div class="box-commen" style="margin-top:20px;" id="box_comment_<?php echo $question['qid']?>">
						  	</div>
					  	</div>
					</div>
				  	<div class="hidden-xs "> 
						<?php if(strpos($question['question'],'https://latex.codecogs.com')!==false ||(strpos($question['question'], '<iframe')===false && strpos($question['question'], '<img'))===false){?>
						<div class="col-md-6 imgres">
						  	<div class="bgqtdiv bgqtdiv_e ft20" >
								<font color="white">
									<div  style=" background-image:url('https://stemup.app/upload/background/<?php if($question['background_template']!=0){ echo $question['background_template'];} else{ echo rand(1,20);}?>.jpg');" class="outer bgqt">
										<div class="middle">
											<div class="inner">
												<div>
													<?php  if(strpos($question['question'],'https://latex.codecogs.com')!==false){ // Tìm kiếm vị trí xuất hiện đầu tiên của 1 chuỗi con trong 1 chuỗi cho trước
														//$show_qt=str_replace('src="..','class="img-responsive" src="'.base_url(),$question['question']);
														// $show_qt= html_entity_decode($question['question']);//sẽ chuyển đổi các kí hiệu HTML entities thành các kí tự tương ứng.
														$pos_2=strpos($show_qt," ",200); 
														echo substr($show_qt,0,$pos_2).'<span class="three_dotcomma"> ... </span>';
														// echo $show_qt;
														}else{
															$show_qt= strip_tags($question['question']);
															// echo '<div style="font-size:20px;"><b>'.$this->lang->line('question').'</b>: ';
			                                                if (strpos($show_qt,'https://latex.codecogs.com')===false &&  mb_strlen($show_qt, 'UTF-8')>260){
			                                                	// if (strlen($show_qt)>260){
															    $pos_1=strpos($show_qt," ",250); 
															    echo substr($show_qt,0,$pos_1).'<span class="three_dotcomma">... </span><span class="more_descr" style="display:none;">'.substr($show_qt,$pos_1).'</span><a class="pointer" onclick="see_more_descr(this)"><span style="color:#02a3f3"> Xem thêm</span></a>';
																// $show_qt= substr($show_qt,0,$pos_1).'...';
															}else{
																	echo $show_qt;
																}
														} 	
		                                                // echo $show_qt;												 
													?>	
												</div>  
											</div>
										</div>
									 </div>
								</font>
							</div>
						</div>
							 <?php } else{ ?>
								 <div class="col-md-6 imgres" style="margin-left: 40px;">
								  
								 <?php

								preg_match_all('/<img[^>]+>/i',$question['question'], $imgTags); 
								if(count($imgTags[0])>0){
									echo str_replace('src="..','class="img-responsive" src="https://stemup.app',$imgTags[0][0]);
								}
								
								$origvidSrc="";
								 preg_match_all('/<iframe[^>]+>/i',$question['question'], $vidTags); 

								 if(count($vidTags[0])>0){
									echo  '<div class="video-wrapper">'. str_replace('allowfullscreen="allowfullscreen"',' data-autoplay="true"',$vidTags[0][0]).'</iframe></div>';
										
								}
								
								
								// echo str_replace('src="..','src="https://stemup.app',$question['question']);
								 
								 ?><br>
								 </div>
							 <?php }?>
					</div> 
				</div>
				<center>
					<div class="col-md-12">
					    <div>
				        	<?php 
								for($qks=0;$qks<count($questions); $qks++){
							?>
							<li onclick="shoq(<?php echo $qks?>);" 
								<?php if($qk == $qks) {echo ' style= "background-color:green; color:white" ';}
								?>
							 class="btn btn-default" id="btn_srq_<?php echo $qks?>"><b><?php echo $qks+1;?></b></li>
							<?php
								}
							?>  
						</div>
						<a class="btn btn-primary" style="float:right;margin-right: -25px;" href="<?php echo site_url('')?>/home_user/results"><b>Đóng</b></a>
					</div>
				</center>
				
				<div class="col-md-2 col-sm-2" id="q<?php echo $qk;?>"  style="font-size:30px;">
				</div>
			</div>
			<div id="page_break"></div>
		</div>
		<?php
		}
		?>
	</div>
</div>
	<?php 

	}
	// view answer ends
?>
</div>
<input type="hidden" id="evaluate_warning" value="<?php echo $this->lang->line('evaluate_warning');?>">
<script>
 var c_q_index=0;
 var n_q_index=1;
 
 var p_q_index=0;
 var l_q = parseInt("<?php echo count($questions);?>");
 if(l_q==1) n_q_index=1;
 
 function shoq(id){
 	cur_page=id;
 
 	
 c_q_index=parseInt(id);
 n_q_index=parseInt(id)+1;
 if(c_q_index!=0)
	p_q_index=parseInt(id)-1; 
 else
	 p_q_index=0;
 if(c_q_index!=l_q-1)
	n_q_index=parseInt(id)+1; 
 else
	n_q_index= l_q-1;
 var did=".rqn";
 $(did).css('display','none');
 var didd="#qn"+id;
 $(didd).css('display','block');
 load_statistic_mcq(qid_arr[id]);
 }
</script>
 
<!-- disable copy, right click -->
<script type="text/javascript">
$(document).ready(function () {
    //Disable cut copy paste
	load_statistic_mcq(qid_arr[0]);
    $('body').bind('cut copy paste', function (e) {
        e.preventDefault();
    });
   
    //Disable mouse right click
   
});

</script>
</body>