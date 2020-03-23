<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Câu hỏi</title>
	<meta name="Description" content="<?php if($mcqs){ echo strip_tags(html_entity_decode($mcqs[0]['question'])); } else {echo "Danh sách các câu hỏi";} ?>"/>
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
<main class="container MT70">

    
	<section class="row">
  	  <aside class="col-md-2 hidden-xs">
	      <div style="margin-top:-20px;" class="div-leftbar-home">
		    <div style="position:sticky;top:70px">
				
				<div class="list-group hidden-xs" >
				 <h3 class="list-group-item active1">Trắc nghiệm</h3>
				 <a href="<?php echo site_url("home")?>"  class="list-group-item"> <i class="fas fa-question-circle" style="margin-right:5px"></i> Câu hỏi vui</a>
				  <a href="<?php echo site_url("home/question_list")?>"  class="list-group-item"> <i class="fas fa-university" style="margin-right:5px"></i> Ngân hàng câu hỏi</a>
				  <a href="<?php echo site_url('home/quiz_list') ?>"  class="list-group-item"><i class="fas fa-book" style="margin-right:5px"></i> Bài kiểm tra</a>
				  
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
	     <div class="box-bor1 mb-20" style="padding:10px">
			  <div class="col-md-4">
				  <select style="padding:3px; width:100%; margin-bottom:10px" id="cteg-question" onchange="filter_question_categ(this)">
				  <option selected disabled>
						Chủ đề
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
			  <div class="col-md-4">
				<select style="padding:3px ;width:100%; margin-bottom:10px" id="level-question" onchange="filter_question_level(this)">
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
			  <div class="col-md-4">
				<select style="padding:3px ;width:100%; margin-bottom:10px" id="sort-question" onchange="sort_question(this)">
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
			<!-- <div class="col-md-3">
				<table style="width:100%;"><tr><td><input type="text" onchange="filter_question_search(this)" style="width:93%"/></td>
				<td><i class="fa fa-search"></i></td></tr></table>
			 </div>-->
		 </div>
		 <?php foreach( $mcqs as $mcq) {?>
		 <div class="box-bor1 mb-20 moremcq_<?php echo $mcq['qid']?>" >
			  <!--<h4 class="tle1">Bài viết</h4>-->
			  <div>
				  <div class="row1" style="margin-top:20px">
					  <div class="col-xs-10">
						  <div class="w60"><a class="pointer" ><img class="img-responsive img-circle" src="<?php echo base_url('upload/symbol/'.$mcq['cid'].'.png');?>" alt=""></a></div>
						  <h4 class="mb-0"><a class="pointer" href="<?php echo site_url('/page/category/'.$mcq['category_permalink'])?>"><b><?php echo $mcq['category_name']?></b></a> 
						   <span style="margin-left:10px" class="dropdown pointer"><a class="dropdown-toggle"  data-toggle="dropdown">
							<span class=" 
caret caret_e 
" style="font-size: 50px" style="border-top: 12px dashed" style="border-right:  6px solid" style="border-left:  6px solid"></span></a>
						  <ul  class="dropdown-menu dropdown-menu_e"style="overflow-y: scroll;height: 273px;font-size:15px">
						      <?php foreach ($category_list as $ct){?>
							  <li><a href="<?php echo site_url('/page/category/'.$ct['category_permalink'])?>"><b><?php echo $ct['category_name']?></b></a></li>
							  <?php } ?>
							</ul>
						  
						  </span>
						  <br></h4>
						  <span class="text-small1"><?php echo $mcq['str_time_ago'] ?></i></span>
					  </div>
					  
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
				<div class="col-xs-12 " style="margin-bottom:20px">
				        <a href="<?php echo site_url('page/question/'.$mcq['permalink'].'/notsolved'); ?>" target="_blank" style="color:#000; font-size:30px">
					  
							<?php echo $mcq['question']?>
						 
					  
					  </a>
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
			   <!-- <div class="col-xs-12 collapse" id="comment_area_main_<?php echo $mcq['qid']?>">
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
						 <input type="text" class="form-control bo-input inp_comment" onkeyup="write_comment(this,event,'qbank',<?php echo $mcq['qid']?>)"  placeholder="Bình luận">
					   </div>

				  </div>
				</div>
			  </div>-->
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
			 
		  </div><!--end baiviet-->
		 <?php } ?>
		 <div>
		    <center>
			<ul class="pagination listpage">
			    <?php if($numpage<11){ ?>
					 <?php for($k=0; $k<$numpage; $k++){?> 
					 
					<li class="page-item <?php if($k+1==$page){?> active <?php } ?>"><a class="page-link" href="<?php
					$href=site_url('home/question_list/'.($k+1).'?cid='.$cid.'&lid='.$lid.'&sortby='.$sortby.'&search='.$search);
					echo $href;
					?>"><?php echo  $k+1 ?></a></li>
					 <?php }?> 
				  <?php }else{?>
				  
				    
				     <li class="page-item <?php if($page==1){?> active <?php } ?>"><a class="page-link" href="<?php 
					 	$href=site_url('home/question_list/1')."?";
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
					   $href=site_url('home/question_list/'.$k)."?";
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
						$href=site_url('home/question_list/'.$numpage)."?";
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
			<div class="modal-dialog" style="width:30%">	
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
					</div>

				</div>

					
				 </div>
				  
			</div>
		</div>
	      
		

	
      </aside>
      <aside class="col-md-3">
      	
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

 <?php if(count($mcqs)==0){?>
	<script>alert("Không tìm thấy câu hỏi phù hợp!");
		  window.location.href =site_url+"/home/question_list";
	 </script>
 <?php }?>
</html>
