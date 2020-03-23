<!DOCTYPE html>
<html lang="en">
  <head>
    
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
   <title><?php echo html_entity_decode(strip_tags($mcq['question']))?></title>
   <link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
   <meta property="og:url" content="http://stemup.app/index.php/page/question/<?php echo $mcq['permalink']?>" />
<meta property="og:title" content="<?php echo str_replace("\"","'",strip_tags(html_entity_decode($mcq['question'])))?>" />
<meta property="og:image" content="<?php echo $mcq['img'] ?>" />
<meta property="og:description" content="<?php echo strip_tags(html_entity_decode($mcq['question'])).".A.".strip_tags(html_entity_decode($mcq['options'][0]['q_option'])).".B.".strip_tags(html_entity_decode($mcq['options'][1]['q_option'])).".C.".strip_tags(html_entity_decode($mcq['options'][2]['q_option'])).".D.".strip_tags(html_entity_decode($mcq['options'][3]['q_option'])).".".strip_tags(html_entity_decode($mcq['description'])); ?>" />

<meta name="Description" content="<?php echo strip_tags(html_entity_decode($mcq['question'])).".A.".strip_tags(html_entity_decode($mcq['options'][0]['q_option'])).".B.".strip_tags(html_entity_decode($mcq['options'][1]['q_option'])).".C.".strip_tags(html_entity_decode($mcq['options'][2]['q_option'])).".D.".strip_tags(html_entity_decode($mcq['options'][3]['q_option'])).".".strip_tags(html_entity_decode($mcq['description'])); ?>" />
<meta property="og:type" content="website" />
	
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
	<script src="<?php echo base_url('js/newuserpage.js');?>"></script>
	<script src="<?php echo base_url('js/responsive.dataTables.js');?>"></script>
	<script src="<?php echo base_url('js/minhash.js');?>"></script>
		<script src="<?php echo base_url('js/setbackground.js');?>"></script>
	<link href="<?php echo base_url('css/responsive.dataTables.min.css');?>" rel="stylesheet">
	<script>

	
	var base_url="<?php echo base_url();?>";
	var site_url="<?php echo site_url();?>";
	var su="<?php echo $su ?>";
    var id_mcq_fun="";
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
			  <!--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1" aria-expanded="false">
				  <span class="sr-only">Toggle navigation</span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
			  </button>-->
			  <a class="navbar-brand navbar-brand1" href="<?php echo site_url('home_user'); ?>">
					<img class="hidden-xs" src="<?php echo base_url('images/hu_logo_home1.png');?>" alt="">
					<img class="visible-xs-block logo-s" src="<?php echo base_url('images/hu_logo_home1.png');?>" height="32" alt="">
			  </a>
			<div class="pull-right text-trang-mobile visible-xs-block">
				<!-- <a class="text-trang hover text-center text-l" href="<?php echo site_url('library/video'); ?>">
					<i class="mr-5 fas fa-cloud"></i>
					<br class="hidden-xs">
				</a> -->
				<!-- <a class="text-trang hover text-center text-l"  href="<?php echo site_url('home_user/notifications') ?>">
					<i class="far fa-bell"></i>
					<span class="badge badge-sm up bg-pink count ncount mr-5"></span>
					<!-<i class="mr10 fa fa-angle-right"></i> -->
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
			    <a href="" class="input-group-addon addon-TK1"><i class="fa fa-search" aria-hidden="true"></i></a>
			  </div>
			</form>
		</div>
		
  	    <div class="collapse navbar-collapse" id="defaultNavbar1">
  	       
 	        <ul class="nav navbar-nav navbar-right">
  	        <li>
				<a class="text-trang hover text-center text-l" href="<?php echo site_url('home_user'); ?>"><i class="mr-5 fas fa-home"></i><br class="hidden-xs">Trang chủ</a>
			</li>
		
				<!-- <li>
				<a class="text-trang hover text-center text-TV" href="#">Mời thành viên</a>
			</li> -->
          </ul>
        </div>
  	    <!-- /.navbar-collapse -->
  </div>
  	  <!-- /.container-fluid -->
	  
  </nav><!--end nav-->
 
<main class="container MT70">

	<section class="row">
	  <aside class="col-md-12" >
		 
		
		  <div class="box-bor1 mb-20">
			  <!--<h4 class="tle1">Bài viết</h4>-->
			  <div>
				  <div class="row1 col-xs-12" style="margin-top:20px">
					  <div class="col-md-10">
						  <div class="w60"><a class="pointer" href="<?php echo site_url('page/category/'.$mcq['cat_permalink']) ?>"><img class="img-responsive img-circle" src="<?php echo base_url('upload/symbol/'.$mcq['cid'].'.png');?>" alt=""></a></div>
						  <h4 class="mb-0"><a class="pointer" href="<?php echo site_url('page/category/'.$mcq['cat_permalink']) ?>"><b><?php echo $mcq['category_name']?></b></a><br></h4>
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
				  <div class="hidden-dt"> 
				  <?php if(strpos($mcq['question'],'latex.codecogs.com')!==false || strpos($mcq['question'],'www.w3.org/1998/Math/MathML')!==false){?>
						   
						<?php } else{?>
					 <?php if(strpos($mcq['question'], '<iframe')===false && strpos($mcq['question'], '<img')===false){?>
				
					 <div class="col-md-6 imgres1">
						  <div class="bgqtdiv ft20" >
									<font color="white">
										<div  style=" background-image:url('https://stemup.app/upload/background/<?php if($mcq['background_template']!=0){ echo $mcq['background_template'];} else{ echo rand(1,20);}?>.jpg');" class="outer bgqt">
											<div class="middle">
												<div class="inner">
													<?php 
														
														$des=html_entity_decode(strip_tags($mcq['question'])) ;
														
														
														if (strpos($mcq['question'],'https://latex.codecogs.com')===false &&  mb_strlen($des, 'UTF-8')>120){
															$pos=strpos($des," ",110); 
															
															echo substr($des,0,$pos).'... <a  style="text-shadow: -2px 0 white, 0 2px white, 2px 0 white, 0 -1px white;" class="pointer" onclick="show_question('.$mcq['qid'].')">Xem thêm</a><div class="hiddenlqt" style="display:none">'.$des.'</div>';
														}else{
															echo $des;
														}
													
														
														?>
												</div>
											</div>
										 </div>
									</font>
							  </div>
					 </div>
						 <?php } else{ ?>
							 <div class="col-md-6 imgres1" >
							 
							 <?php

							preg_match_all('/<img[^>]+>/i',$mcq['question'], $imgTags); 
							if(count($imgTags[0])>0){
								echo str_replace('src="..','class="img-responsive" src="https://stemup.app',$imgTags[0][0]);
							}
							
							$origvidSrc="";
							 preg_match_all('/<iframe[^>]+>/i',$mcq['question'], $vidTags); 

							 if(count($vidTags[0])>0){
								
								echo  '<div style="font-size:20px" ><b>Câu hỏi:</b>'. $mcq['question']."</div>";
								
								
							}
							
							
							// echo str_replace('src="..','src="https://stemup.app',$question['question']);
							 
							 ?><br>
							 </div>
						 <?php }?>
						<?php } ?>
				 </div> 
			  <div class="col-md-6" style="margin-bottom:10px">
			        <?php ?>
					<div class="box-qt-res 
					  <?php if(count($vidTags[0])>0){ echo 'hidden-xs';} ?>
					">
						<div style="font-size:20px">
							<em>
								<b>Câu hỏi</b>: 
								<?php if (strpos($mcq['question'],'latex.codecogs.com')!==false ||strpos($mcq['question'],'www.w3.org/1998/Math/MathML')!==false  ) 
									     echo html_entity_decode($mcq['question']);
									  else
										   echo strip_tags($mcq['question']);
									?>
							</em>
						</div>
					</div>
					<div class='box-qt-res'>
						<div style='font-size:20px'>
							<b>Đáp án</b>: <?php echo html_entity_decode($mcq['correct_option']) ?>
						</div>
					</div>
					<div class="box-descr-res hidden-xs"><?php
							if($mcq['description']!='') {
								if(strpos($mcq['description'],"<img")!==false){
									$des=str_replace('src="..','class="img-responsive" src="'.base_url(),$mcq['description']);
								}
								else{
									$des=strip_tags($mcq['description']);
								}
								echo '<div style="font-size:20px;"><b>Thông tin thêm</b>: ';
								
								echo $des.'</div>';
								
							 }
								
					?></div>
					
					<div class="box-descr-res hidden-dt"><?php
							if($mcq['description']!='') {
								if(strpos($mcq['description'],"<img")!==false){
									
									$des=str_replace('src="..','class="img-responsive" src="'.base_url(),$mcq['description']);
								}
								else{
									$des=strip_tags($mcq['description']);
								}
									echo '<div style="font-size:20px;"><b>'.$this->lang->line('description').'</b>: ';
									
									echo $des.'</div>';
									
								 }
								
					?></div>
					<div>
					<p class="mt-10 mb-0"><button type="button" class="btn btn-danger" style="display:none">Tag bạn Facebook để trợ giúp</button></p>

						<?php  if($mcq['n_answers']>0){?>
					   <div class="col-xs-12 text-right mgr-20" style="float:right" >
							<p class="f11"><i style="width:20px" class="fas fa-users mr-5 bo-tron bg-danger"></i><strong class="text-danger"><?php  echo number_format(100*$mcq['n_correct_answers']/$mcq['n_answers'],0)?>%</strong> trả lời đúng</p>
						</div>	
						<?php  }?>
					</div>
					 <div class="col-xs-12 bo-tb">
				  <div class="row">
					  <div class="col-xs-12" style="margin-bottom:5px">
						  <ul class="list-inline text-bt">
							  <?php if($mcq['liked']==1){?>
							  <li class="col-xs-4"><a class="acti pointer"  onclick="like_question(this , <?php echo $mcq['qid'] ?>)"><i class="fas fa-thumbs-up mr-5"></i>Thích</a></li>
							  <?php } else{?>
							  <li class="col-xs-4"><a class="pointer" onclick="
								  <?php if($login) { echo 'like_question(this ,'.$mcq['qid'].')' ;} 
								  else{
									  echo 'alert_msg()';
								  }
								  ?>">Thích</a></li>
							  <?php }?>
							  <li class="col-xs-4"><a class="pointer" 
								  <?php if($login) { echo 'data-toggle="collapse" data-target="#comment_area_main_'.$mcq['qid'].'"';}
								  else{
									  echo 'onclick="alert_msg()"';
								  }
								?> 
							 ><i class="far fa-comment-alt mr-5"></i>Bình luận</a></li>
								<li class="col-xs-4"><a class="pointer" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fstemup.app%2Findex.php%2Fpage%2Fquestion%2F<?php echo  $mcq['permalink']?>&amp;src=sdkpreparse" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0');count_share(<?php echo $mcq['qid'];?>); return false;"><i class="fas fa-share-alt mr-5"></i>Chia sẻ</a></li>
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
				  <?php if($mcq['liked']==1|| $mcq['n_like']>0 ){?>
					  <div class="col-xs-12 bo-B" >		 
						 <i style="width:20px" class="fas fa-thumbs-up mr-5 bo-tron bg-primary"></i>
						 <a class="f10" href="#">
							 <?php if($mcq['liked']==1){?>
								 
								<?php if($mcq['n_like'] >0) { echo 'Bạn và';} else echo $user_name;?>
							 <?php }?>
							 <?php if($mcq['n_like'] >0) {echo " ".$mcq['n_like'].' người' ;}?> 
						 </a>
					  </div>
				  <?php }?>
				  </div>
				   <?php if($mcq['share_count']>0){ ?>
				   <div class="col-xs-12">
					   <p class="f10 text-xam"><i class="fas fa-share-alt mr-5"></i><?php echo $mcq['share_count']?> lượt chia sẻ</p>
				   </div>
				   <?php } ?>
				  <div class="col-xs-12 collapse" id="comment_area_main_<?php echo $mcq['qid']?>">
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
				  </div> 
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
				  
				  </div>
			  <div class="col-md-6 hidden-xs" style="margin-bottom:10px">
			       <?php if(strpos($mcq['question'],'latex.codecogs.com')!==false || strpos($mcq['question'],'www.w3.org/1998/Math/MathML')!==false){?>
				   <div class="bgqtdiv" >
						<font color="white">
							<img class="img-responsive" src='https://stemup.app/upload/background/<?php if($mcq['background_template']!=0){ echo $mcq['background_template'];} else{ echo rand(1,20);}?>.jpg')>
								
						</font>
				  </div>
					<?php } else{?>
				   <?php if(strpos($mcq['question'], '<iframe')===false && strpos($mcq['question'], '<img')===false){?>
				   <div class="bgqtdiv" >
						<font color="white">
							<div style="background-size:1220px 500px;background-image:url('https://stemup.app/upload/background/<?php if($mcq['background_template']!=0){ echo $mcq['background_template'];} else{ echo rand(1,20);}?>.jpg');" class="outer bgqt">
								<div class="middle">
									<div class="inner">
										<?php 
										
										$des=html_entity_decode(strip_tags($mcq['question'])) ;
										
										
										if (strpos($mcq['question'],'https://latex.codecogs.com')===false &&  mb_strlen($des, 'UTF-8')>120){
											$pos=strpos($des," ",110); 
											
											echo substr($des,0,$pos).'...';
										}else{
											echo $des;
										}
									
										
										?>
									</div>
								</div>
							 </div>
						</font>
				  </div>
				   <?php } else{?>
					  <div class="imgres1" >
						  
						 <?php

						preg_match_all('/<img[^>]+>/i',$mcq['question'], $imgTags); 
						if(count($imgTags[0])>0){
							echo $imgTags[0][0];
						}
						
						$origvidSrc="";
						 preg_match_all('/<iframe[^>]+>/i',$mcq['question'], $vidTags); 

						 if(count($vidTags[0])>0){
							echo  '<div class="video-wrapper">'. str_replace('allowfullscreen="allowfullscreen"',' data-autoplay="true"',$vidTags[0][0]).'</iframe></div>';
							
						}
						
						
						// echo str_replace('src="..','src="https://stemup.app',$question['question']);
						 
						 ?><br>
						 </div>
					 <?php }?>
				  <?php }?>
			</div>
		</div></div>

		  <?php if(count($related_question)>0) {  ?>	
	<div  class= "realative_question-box box-bor1" style="margin-bottom:20px">
	  <div style="margin-bottom: 20px;">
			<h4>
				<b style="padding:10px;"><span class="block-title"> Câu hỏi cùng chủ đề</span></b>
			</h4>
	   </div>
	   <?php foreach($related_question as $rqt){?>
	   <div class="col-md-2  mb-10">
			<a  class="pointer" href="<?php echo site_url('page/question/'.$rqt['permalink'])?>">
				<img class="img-responsive img_quiz" src="<?php echo $rqt['img']?>" >
				<div style="margin-top:10px; height:80px; font-weight:700" title="<?php echo $rqt['question']?>">
					<?php
						if (strpos($rqt['question'],'https://latex.codecogs.com')===false &&  mb_strlen($rqt['question'], 'UTF-8')>85){
							$pos=strpos($rqt['question']," ",85); 
							
							echo substr($rqt['question'],0,$pos).'...';
						}else{
							echo $rqt['question'];
						}
					?>
				</div>
				
			 </a>
								
	   </div> 
	   <?php } ?>	   
	</div>	
	<?php } ?>

     <?php if(count($recommend_question)>0) {  ?>	
	<div  class= "realative_question-box box-bor1" style="margin-bottom:20px">
	  <div style="margin-bottom: 20px;">
			<h4>
				<b style="padding:10px;"><span class="block-title"> Bạn có thể quan tâm</span></b>
			</h4>
	   </div>
	   <?php foreach($recommend_question as $rqt){?>
	   <div class="col-md-2  mb-10">
			<a  class="pointer" href="<?php echo site_url('page/question/'.$rqt['permalink'])?>">
				<img class="img-responsive img_quiz" src="<?php echo $rqt['img']?>" >
				<div style="margin-top:10px; height:80px; font-weight:700" title="<?php echo $rqt['question']?>">
					<?php
						if (strpos($rqt['question'],'https://latex.codecogs.com')===false &&  mb_strlen($rqt['question'], 'UTF-8')>85){
							$pos=strpos($rqt['question']," ",85); 
							
							echo substr($rqt['question'],0,$pos).'...';
						}else{
							echo $rqt['question'];
						}
					?>
				</div>
				
			 </a>
								
	   </div> 
	   <?php } ?>	   
	</div>	
	<?php } ?>
		
   	   
      </aside>
      
     

    </section>
	
  	</main>
  
   
  </body>
      
  </html>
