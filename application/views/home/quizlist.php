<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bài trắc nghiệm </title>
		<meta name="Description" content="<?php if($quiz_list){ echo $quiz_list[0]['quiz_name']; } else {echo "Danh sách các bài kiểm tra";} ?>"/>
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
    <!-- Bootstrap -->
	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/star-rating.css');?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
	  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	 <script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
	<script src="<?php echo base_url('js/responsive.dataTables.js');?>"></script>
	<link href="<?php echo base_url('css/responsive.dataTables.min.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('js/newpage.js');?>"></script>
		<script src="<?php echo base_url('js/signup.js');?>"></script>
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
			  <a class="navbar-brand navbar-brand1" href="<?php echo site_url('home') ?>">
					<img class="hidden-xs" src="<?php echo base_url('images/hu_logo_home1.png');?>" alt="">
					<img class="visible-xs-block logo-s" src="<?php echo base_url('images/hu_logo_home1.png');?>" height="32" alt="">
			  </a>
			<div class="pull-right text-trang-mobile visible-xs-block">
				<!-- <a class="text-trang hover" href="<?php echo site_url('message'); ?>">
					<i class="far fa-envelope"></i>
					<span class="badge badge-sm up bg-pink count mcount"></span>
				</a> -->
				
				<!-- <a class="text-trang hover" data-toggle="dropdown">
					<i class="far fa-bell"></i>
					<span class="badge badge-sm up bg-pink count ncount"></span>
				</a> -->
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
			 <li><a style="width:50%" href="<?php echo site_url("home/about")?>">Điều khoản sử dụng</a></li>
		</ul>
	</section>
	  
  </nav><!--end nav-->
<main class="container MT70">

    
	<section class="row">
  	 <aside class="col-md-2 hidden-xs">
		<div style="margin-top:-20px;" class="div-leftbar-home">
		    <div style="position:sticky;top:70px">
				<div class="list-group hidden-xs" >
				 <h3 class="list-group-item active1">Trắc nghiệm</h3>
				 <a href="<?php echo site_url("home")?>"  class="list-group-item"> <i class="fas fa-question-circle" style="margin-right:5px"></i> Câu hỏi vui</a>
				 <!-- <a href="<?php echo site_url("home/question_list")?>"  class="list-group-item"> <i class="fas fa-university" style="margin-right:5px"></i> Ngân hàng câu hỏi</a>-->
				  <a href="<?php echo site_url('home/quiz_list') ?>"  class="list-group-item"><i class="fas fa-book" style="margin-right:5px"></i> Bài trắc nghiệm</a>
				  
			  </div>
			  <div class="list-group hidden-xs" >
					 <h3 class="list-group-item active1">Phân loại</h3>
					 <a href="<?php echo site_url("page/categories")?>"  class="list-group-item"> <i class="fas fa-filter" style="margin-right:5px"></i> Chuyên mục</a>
				  
			</div>
			  <div class="list-group hidden-xs" >
				 <h3 class="list-group-item active1">Về chúng tôi</h3>
				 <a href="<?php echo site_url('home/about') ?>"  class="list-group-item"><i class="fas fa-bullseye" style="margin-right:5px"></i> Giới thiệu</a>
				 <a href="<?php echo site_url('home/detail/user_terms') ?>"  class="list-group-item"><i class="fas fa-object-group" style="margin-right:5px"></i> Điều khoản sử dụng</a>
				 <a href="<?php echo site_url('home/detail1/guidelines') ?>"  class="list-group-item"><i class="fas fa-folder-open" style="margin-right:5px"></i> Hướng dẫn</a>
				 <a href="<?php echo site_url('home/detail2/policy') ?>"  class="list-group-item"><i class="fa fa-window-restore" style="margin-right:5px"></i> Chính sách riêng tư</a>
			  </div>
		    </div>
		</div>  

  	  </aside>  
	   <aside class="col-md-10" style="min-height:800px;margin-bottom:20px" id="mainbar">
	     <div class="box-bor1">
	     <div class="col-md-12 box-filter">
			<div class="col-md-3" > 
			   <select id="cteg-quiz" onchange="filter_quiz_categ(this)" style="padding:3px; width:100%; margin-bottom:10px">
			    <option selected disabled>
						<b>Chủ đề</b>
					</option>
					<option value="0">
						  Tất cả
					</option>
			   <?php foreach(array_reverse($category_list) as $ct){?>
			        <?php if($ct['cid']==$cid){?>
						<option value="<?php echo $ct['cid'] ?>" selected>
					<?php } else{?>
						<option value="<?php echo $ct['cid'] ?>" >
					<?php }?>
						  <?php echo $ct['category_name'] ?>
					</option>
			   <?php }?>
			   </select>
			</div>
		    <div class="col-md-3" style="margin-bottom: 5px;"> 
			<select id="level-quiz" onchange="filter_quiz_level(this)" style="padding:3px; width:100%; margin-bottom:5px">
			 <option selected disabled>
						<b>Lớp</b>
					</option>
					<option value="0">
						  Tất cả 
					</option>
			 <?php foreach($level_list as $lv){?>
					<?php if($lv['lid']==$lid){?>
						<option value="<?php echo $lv['lid'] ?>" selected>
					<?php } else{?>
						<option value="<?php echo $lv['lid'] ?>" >
					<?php }?>
						  <?php echo $lv['level_name'] ?>
					</option>
			   <?php }?>
			   </select>
			</div>
			
		      <div class="col-md-3">
				<select style="padding:3px ;width:100%; margin-bottom:10px" id="sort-question" onchange="sort_quiz(this)">
					<option selected disabled>
					  <b>	Sắp xếp</b>
					</option>
					<option value="create_date+desc" <?php if($sortby=='create_date desc'){echo 'selected';  } ?> >
					Mới nhất
					</option>
					<option value="create_date+asc" <?php if($sortby=='create_date asc'){echo 'selected';  } ?>>
					Cũ nhất
					</option>
					<option value="answered+desc" <?php if($sortby=='answered desc'){echo 'selected';  } ?>>
					Nhiều lượt trả lời
					</option>
					<option value="assigned+desc" <?php if($sortby=='assigned desc'){echo 'selected';  } ?>>
					Nhiều lượt giao bài 
					</option>
					
				</select>
			 </div>
			 <div class="col-md-3 " style="margin-bottom:5px" style="float:left"> 
			  <table style="width:100%;"><tr><td><input type="text" onchange="filter_quiz_search(this)" style="width:93%"/></td>
				<td><i class="fa fa-search"></i></td></tr></table>
			</div>
		 </div>
		 <div class="col-md-12" style="margin-top: 73px;">
         <?php foreach($quiz_list as $quiz){?> 
			<div class="col-md-4 div_quizz div_cteg_<?php echo $quiz['cid'] ?> div_level_<?php echo $quiz['lid'] ?>" >
			   <div class="box-quiz-home" style="background-color:<?php
					$a=array("Azure","pink" ,"LemonChiffon","WhiteSmoke","SeaShell","LightYellow","Violet");
					echo $a[array_rand($a)];
					?>" >
				   <div class="box-img-home">
						
						<center>
						    <a class="pointer" href="<?php echo site_url('page/quiz/'.$quiz['permalink']);?>">
							<img class="img-responsive" style="height:200px" src="<?php echo str_replace("..",'https://stemup.app',$quiz['img'] )?>">
							</a>
						</center>
				   </div> 

				   <!-- Cắt chuỗi -->
				   <?php
					if( mb_strlen($quiz['quiz_name'],'UTF-8') > 88)
					{
						$pos = strpos($quiz['quiz_name'],' ',79);
						$quiz_name = substr($quiz['quiz_name'],0,$pos).'...';
					}
					else {
						$quiz_name = $quiz['quiz_name'];
					}
				   ?>
				   <!-- Cắt chuỗi -->
				   
				   <div class="box-title-home"> 
						<center>
							<a class="pointer" title="<?php echo $quiz['quiz_name'] ?>"  href="<?php echo site_url('page/quiz/'.$quiz['permalink']);?>"><b class="quiz_name"><?php echo $quiz_name?></b></a>
						 </center>
					</div>
					<div>
						<center>
						 <button class="btn btn-info" onclick=" popup_require_login1(<?php echo $quiz['quid'];?>)"> Kiểm tra</button>		
						 <button class="btn btn-success" onclick=" popup_require_login()"> Giao bài kiểm tra</button>	 
						</center>					 
					</div>
				
				   </div>
			</div>
		 <?php } ?>
		</div>
		<div>
		    <center>
		<ul class="pagination listpage">
			    <?php if($numpage<11){ ?>
					 <?php for($k=0; $k<$numpage; $k++){?> 
					 
					<li class="page-item <?php if($k+1==$page){?> active <?php } ?>"><a class="page-link" href="<?php
					$href=site_url('home/quiz_list/'.($k+1).'?cid='.$cid.'&lid='.$lid.'&sortby='.$sortby.'&search='.$search);
					echo $href;
					?>"><?php echo  $k+1 ?></a></li>
					 <?php }?> 
				  <?php }else{?>
				  
				    
				     <li class="page-item <?php if($page==1){?> active <?php } ?>"><a class="page-link" href="<?php 
					 	$href=site_url('home/quiz_list/1')."?";
						if($cid!=0){
                          $href.="cid=".$cid;  
						}
						if($lid!=0){
                          $href.="&lid=".$lid;  
						}
						if($sortby!=0){
                          $href.="&sortby=".$sortby;  
						}
						if($search!=0){
                          $href.="&search=".$search; 
						}
						echo $href;
					 ?>">1</a></li>
					  <?php if($pstart>2){ ?> 
					      <li class="page-item"><a class="page-link"> ... </a></li>
					  <?php } ?>
					<?php for($k=$pstart; $k<$pstart+7; $k++){?> 
					   <li class="page-item <?php if($k==$page){?> active <?php } ?> "><a class="page-link" href="<?php 
					   $href=site_url('home/quiz_list/'.$k)."?";
						if($cid!=0){
                          $href.="cid=".$cid;  
						}
						if($lid!=0){
                          $href.="&lid=".$lid;  
						}
						if($sortby!=0){
                          $href.="&sortby=".$sortby;  
						}
						if($search!=0){
                          $href.="&search=".$search; 
						}
						echo $href;
					   ?>"><?php echo  $k ?></a></li>
					<?php }?> 
					<?php if($pstart+7<$numpage){ ?> 
					      <li class="page-item"><a class="page-link"> ... </a></li>
					  <?php } ?>
					 <li class="page-item <?php if($page==$numpage){?> active <?php } ?>"><a class="page-link" href="<?php 
						$href=site_url('home/quiz_list/'.$numpage)."?";
						if($cid!=0){
                          $href.="cid=".$cid;  
						}
						if($lid!=0){
                          $href.="&lid=".$lid;  
						}
						if($sortby!=0){
                          $href.="&sortby=".$sortby;  
						}
						if($search!=0){
                          $href.="&search=".$search; 
						}
						echo $href;
					 ?>"><?php echo  $numpage ?></a></li>
				 <?php }?>
				 
			  </ul>
			 </center>
		</div>
		<div class="modal fade" id="loginmodal" role="dialog">
		<div class="modal-dialog">	 
			 <div class="modal-content">
				<form class="form-signin" method="post" action="<?php echo site_url('login/verifylogin');?>">
				 
				 <input class="page-signin-form-control form-control" name="email" style="width:300px;margin:10px" placeholder="<?php echo $this->lang->line('email_address');?>" type="text" required autofocus>
				 <input class="page-signin-form-control form-control" name="password" style="width:220px;margin:10px" id="inputPassword" placeholder="<?php echo $this->lang->line('password');?>" type="password" required  >
				<input style="margin: 10px;" name="remember" type="checkbox">Tự động đăng nhập
				 <button style="z-index:2; margin-top:-42px; margin-right:17px"class="btn btn-sm btn-default btn-primary pull-right mb-5" type="submit">Đăng nhập</button>
				 
				 <!--<table>
					 <tr>
						<td style="padding:10px">
							<a class="btn"  style="background:#3C66C4;color:#ffffff;" href="<?php echo  site_url('hauth/login/Facebook');?>" > <i class="fab fa-facebook-f"></i> Đăng nhập với Facebook </a>
						 </td>
						 <td style="padding:10px">
							<a class="btn btn-danger"  href="<?php echo  site_url('sso/login');?>" > <i class="fab fa-google"></i> Đăng nhập với Itrithuc.vn</a>
						 </td>
					 </tr>
				 </table>-->
				 <a href="#" data-toggle="modal" data-target="#resetpwdModal" style=" padding:10px"> Quên mật khẩu</a>
			 </form>
				
			 </div>
			  
		</div>
	</div>
		
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
	
        </div>
	
      </aside>
    

    </section>
  	</main>
  	

  </body>

</html>

