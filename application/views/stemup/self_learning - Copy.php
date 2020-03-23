
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tự học</title>
	
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
	<!-- <script src="<?php //echo base_url('js/newuserpage.js');?>"></script> -->
	<?php $this->load->view('stemup/head'); ?>
	<style type="text/css">
		.trac-nghiem, .do-vui {
		    background: #e9ebee;
		}
		
	</style>
</head>
<body class="bg-body">
	<div class="container MT70">
		<?php $this->load->view('stemup/header');?>
		<?php $this->load->view('stemup/menu');?>
		<div class="col-md-10 col-learning-right">
			<div class="trac-nghiem mb-20 col-md-12 col-sm-12 col-xs-12">
				<h2 class="title">TRẮC NGHIỆM </h2>

				<?php
				foreach ($list_category as $key => $value) {
					$cid=$value['cid'];
					?>
					<div class="col-md-2 category-box"><a href="<?php echo site_url('self_learning/category/').'/'.$cid;?>">
						<div class="cover">
							<img class="category-avatar " src="<?php echo base_url('upload/symbol/').'/'.$cid.'.png';?>" />
							<hr><span class="col-md-9 category-name "><?php echo $value['tenmon']; ?></span><span class="col-md-3 category-soluong"><?php echo $value['soluong']; ?></span>
						</div></a>
					</div>
					<?php
				}
				?>
			</div>
<div class="do-vui mb-20 col-md-12 col-sm-12 col-xs-12" style="display:none;">
	<h2 class="title ">ĐỐ VUI </h2>
<section>
	<div class="random">
						<?php foreach( $mcq_fun as $mcq) {?>
							<div class="box-bor1 mb-20 moremcq_<?php echo $mcq['qid']?>">
								<!--<h4 class="tle1">Bài viết</h4>-->
								<div>
									<div class="row1" style="margin-top:20px">
										<div class=col-xs-10>
											<div class="w60"><a class="pointer" ><img class="img-responsive img-circle" src="<?php echo base_url('upload/symbol/'.$mcq['cid'].'.png');?>" alt=""></a></div>
											<h4 class="mb-0"><a class="pointer" href="<?php echo site_url('/page/category/'.$mcq['category_permalink'])?>"><b><?php echo $mcq['category_name']?></b></a> 
											</h4>
											<span class="text-small1"><?php echo $mcq['str_time_ago'] ?></i></span>
										</div>

									</div>
									<div class="col-xs-12" style="margin-bottom:10px">
										<a href="<?php echo site_url('page/question/'.$mcq['permalink'].'/notsolved'); ?>" target="_blank" style="color:#fff">
											<?php if(strpos($mcq['question'],'https://latex.codecogs.com')!==false || (strpos($mcq['question'], '<iframe')===false && strpos($mcq['question'], '<img')===false)){?>

												<div class="bgqtdiv" >
													<font color="white">
														<div style="background-image:url('https://stemup.app/upload/background/<?php if($mcq['background_template']!=0){ echo $mcq['background_template'];} else{ echo rand(1,20);}?>.jpg'); " class="outer bgqt">
															<div class="middle">
																<div class="inner" >

																	<?php 
																	if(strpos($mcq['question'],'https://latex.codecogs.com')!==false){
																		$des=html_entity_decode($mcq['question']) ;
																	}
																	else{
																		$des=html_entity_decode(strip_tags($mcq['question'])) ;
																	}

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
												<?php if($mcq['create_su']==3 && $mcq['text_license'] && $mcq['show_logo']==1) {?>
													<div class="imgwlogo" style="margin-top:-15px">
														<a href="<?php echo $mcq['out_link']?>" target="_blank"> 
															<div class="logobanner">

																<div >

																	<table style="width:100%">
																		<tr>
																			<td style=" padding: 5px 20px;">
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
											<?php } else{?>
												<div class="mcq_multimd assqid-<?php echo $mcq['qid']?>" style="display:none">
													<?php echo $mcq['question']?>
												</div>

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
									</div>

									<div class="col-xs-12 div_opt">
										<div class="row MB20 twopt">
											<div class="col-xs-6 mobile-opt mobmb20"> 
												<label class="radio-inline w-100">

													<!-- <input class="mt-5 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='0'> -->
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
												<div class="col-xs-6 mobile-opt" > 
													<label class="radio-inline w-100">

														<!-- <input class="mt-5 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='1'> -->
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
														<div class="col-xs-6 mobile-opt mobmb20"> 

														<?php } else{ ?>
															<div class="col-xs-6 mobile-opt mobmb20" style="display:none"> 
															<?php } ?>
															<label class="radio-inline w-100">

																<!-- <input class="mt-5 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='2'> -->
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
																<div class="col-xs-6 mobile-opt"> 

																<?php } else{ ?>
																	<div class="col-xs-6 mobile-opt" style="display:none"> 
																	<?php } ?>
																	<label class="radio-inline w-100">

																		<!-- <input class="mt-5 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='3'> -->
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

																</div>


															</div>
														</div>


													</div><!--end baiviet-->
												<?php } ?>


											</div>
										</div>
										<?php $this->load->view('stemup/footer'); ?>
										<?php if($quiz_fun){?>
											<div class="box-bor-quiz mb-20">
												<h3 class="mt-0">Bài trắc nghiệm: <a href="<?php echo site_url('quiz/validate_quiz/'.$quiz_fun['quid']);?>"><?php echo $quiz_fun['quiz_name'] ?></a></h3>
												<!-- <h4 class="mt-0"><a href=""><?php echo $quiz_fun['description'] ?></a></h4>-->

												<div class="row hidden-xs">
													<?php foreach($quiz_fun['question'] as $k=>$qf){?>
														<a class="col-md-3 col-xs-6 mb-10" href="<?php echo site_url('quiz/validate_quiz/'.$quiz_fun['quid']);?>"><img class="img-responsive img_quiz" src="<?php echo $qf['img'];?>" alt="">

														</a>
													<?php }?>

												</div>
												<div class="hidden-dt">
													<div class="row">
														<?php foreach($quiz_fun['question'] as $k=>$qf){
															if($k<2){?>
																<a class="col-md-3 col-xs-6 mb-10" href="<?php echo site_url('quiz/validate_quiz/'.$quiz_fun['quid']);?>"><img class="img-responsive img_quiz" src="<?php echo $qf['img'];?>" alt=""></a>
															<?php }
														}?>

													</div>
													<div class="row">
														<?php foreach($quiz_fun['question'] as $k=>$qf){
															if($k>=2){?>
																<a class="col-md-3 col-xs-6 mb-10" href="<?php echo site_url('quiz/validate_quiz/'.$quiz_fun['quid']);?>"><img class="img-responsive img_quiz" src="<?php echo $qf['img'];?>" alt=""></a>
															<?php }
														}?>

													</div>
												</div>
												<div class="col-xs-12 bo-tb">
													<div class="row">
														<div class="col-xs-12" style="margin-bottom:5px">
															<ul class="list-inline text-bt">
																<?php if($quiz_fun['liked']==1){?>
																	<li class="col-xs-3">
																		<a class="acti pointer" onclick="like_quiz(this,<?php echo $quiz_fun['quid']; ?>)" >
																			<i class="fas fa-thumbs-up mr-5"></i>
																			<span class="hidden-xs">Thích</span>
																		</a>
																	</li>
																<?php } else{?>
																	<li class="col-xs-3">
																		<a class="pointer" onclick="like_quiz(this,<?php echo $quiz_fun['quid']; ?>)">
																			<i class="fas fa-thumbs-up mr-5">
																			</i>
																			<span class="hidden-xs"> Thích
																			</span>
																		</a>
																	</li>
																<?php }?>
																<li class="col-xs-3">
																	<a class="pointer" data-toggle="collapse" data-target="#comment_quiz_main_<?php echo $quiz_fun['quid']?>" >
																		<i class="far fa-comment-alt mr-5"></i>
																		<span class="hidden-xs">Bình luận</span>
																	</a>
																</li>
																<li class="col-xs-3">
																	<a class="pointer" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fdev.do.stem.vn%2Findex.php%2Fpage%2Fquiz%2F<?php echo  $quiz_fun['permalink']?>&amp;src=sdkpreparse" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0');count_share2(<?php echo $quiz_fun['quid'];?>); return false;">
																		<i class="fas fa-share-alt mr-5"></i>
																		<span class="hidden-xs">Chia sẻ</span>
																	</a>

																</li>
																<li class="col-xs-3">
																	<a class="pointer" onclick="changeassign(<?php echo $quiz_fun['quid']; ?>, <?php echo $su;?>)">
																		<i class="fas fa-share-square mr-5"></i>
																		<span class="hidden-xs"> Đố </span>
																	</a>
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
										<div class="modal fade" id="answered" role="dialog" onclick="dismiss_modal(this)">
											<div class="modal-dialog">
												<div class="modal-content" >

													<div class="box-popup">
														<div class="bg-xanhnhat">
															<div class="icon">
																<img src="<?php echo base_url()?>images/images3.png" alt="">
															</div>
														</div>
														<div class="box-chon">
															<h3 class="text-center mb-20 mt-0">Bạn đã trả lời câu hỏi này! Vui lòng chọn câu hỏi khác.</h3>
															<h3 class="text-center mb-20 mt-0" id="result_answered"></h3>


														</div>

													</div>

												</div>

											</div>
										</div>
										<div class="modal fade" id="complete_answer" role="dialog">
											<div class="modal-dialog">
												<div class="modal-content" >


													<div class="box-popup">
														<div class="bg-xanhnhat">
															<div class="icon">
																<img src="<?php echo base_url();?>images/images4.png" alt="">
															</div>
														</div>
														<div class="box-chon">
															<h3 class="text-center mb-20">Phương án <span class="opt_choice"> A </span> là câu trả lời cuối cùng của bạn?</h3>
															<button type="button" data-dismiss="modal" id="cancel_answer" class="btn btn-warning btn-lg1">Chọn lại</button>
															<button type="button" data-dismiss="modal" id="confirm_answer" class="btn btn-success btn-lg1">Đồng ý</button>

														</div>


													</div>


												</div>

											</div>
										</div>

										<div class="modal fade" id="result_answer_qt_true" role="dialog" onclick="dismiss_modal(this)">
											<div class="modal-dialog">	 
												<div class="modal-content">

													<div class="box-popup">
														<div class="bg-xanhnhat">
															<div class="icon">
																<img src="<?php echo base_url();?>images/images1.png" alt="">

															</div>
														</div>
														<div class="box-chon">
															<h3 class="text-center">
																<div style="margin-bottom:10px">
																	Chúc mừng bạn đã trả lời đúng!<br>
																	Đáp án chính xác là <span id="correct_ans_tr"> </span>.
																</div>
																<div>
																	<div class="fb-like" data-href="https://www.facebook.com/stem.vn" ata-layout="button_count" data-action="like" data-show-faces="false" data-size="large">
																	</div>
																</div>
															</h3>
														</div>

													</div>
												</div>

											</div>
										</div>
										<div class="modal fade" id="result_answer_qt_false" role="dialog" onclick="dismiss_modal(this)">
											<div class="modal-dialog">	 
												<div class="modal-content">
													<div class="box-popup">
														<div class="bg-xanhnhat">
															<div class="icon">
																<img src="<?php echo base_url();?>images/images2.png" alt="">
															</div>
														</div>
														<div class="box-chon">
															<h3 class="text-center mt-0">
																<div style="margin-bottom:10px">
																	Rất tiếc bạn đã trả lời sai!
																	<br>Đáp án chính xác là 
																	<span id="correct_ans_fs"> </span>.
																</div>
																<div >
																	<div class="fb-like" data-href="https://www.facebook.com/stem.vn" data-layout="button_count" data-action="like" data-show-faces="false" data-size="large" >
																	</div>
																</div>
															</h3>
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
									</div>
								</div>
							</aside>

							<aside class="col-md-3 rightbar">
							</aside>
							<div class="modal fade" id="quizModal" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Tạo bài kiểm tra</h4>
										</div>
										<div class="modal-body" id="quizModalbody">
											<form id="formAddQuiz">
												<div class="form-group">	 
													<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('quiz_name');?></label> 
													<input type="text" id="inpquizname" name="quiz_name"  class="form-control" placeholder="<?php echo $this->lang->line('quiz_name');?>"  required autofocus>
												</div>
												<div class="form-group">	 
													<label for="inputEmail"  ><?php echo $this->lang->line('description');?></label> 
													<textarea   name="description"  class="form-control tinymce_textarea" ></textarea>
												</div>
												<div class="form-group">	 
													<label><?php echo $this->lang->line('assign_to_group');?></label> <br>
													<?php 
													foreach($group_list as $key => $val){
														?>

														<input type="radio" name="gids[]" value="<?php echo $val['gid'];?>" <?php if($key==1){ echo 'checked'; } ?> > <?php echo $val['group_name'];?> &nbsp;&nbsp;&nbsp;
														<?php 
													}
													?>
												</div>
												<a href="#" data-toggle="collapse" data-target="#advance_options"><?php echo $this->lang->line('advance_options');?></a>
												<div id="advance_options" class="collapse">

													<div class="form-group">	 
														<label for="inputEmail"  ><?php echo $this->lang->line('start_date');?></label> 
														<input type="text" name="start_date"  value="<?php echo date('Y-m-d H:i:s',time());?>" class="form-control" placeholder="<?php echo $this->lang->line('start_date');?>"   required >
													</div>
													<div class="form-group">	 
														<label for="inputEmail"  ><?php echo $this->lang->line('end_date');?></label> 
														<input type="text" name="end_date"  value="<?php echo date('Y-m-d H:i:s',(time()+(60*60*24*365)));?>" class="form-control" placeholder="<?php echo $this->lang->line('end_date');?>"   required >
													</div>
													<div class="form-group">	 
														<label for="inputEmail"  ><?php echo $this->lang->line('duration');?></label> 
														<input type="text" name="duration"  value="10" class="form-control" placeholder="<?php echo $this->lang->line('duration');?>"  required  >
													</div>
													<div class="form-group">	 
														<label for="inputEmail"  ><?php echo $this->lang->line('maximum_attempts');?></label> 
														<input type="text" name="maximum_attempts"  value="10000" class="form-control" placeholder="<?php echo $this->lang->line('maximum_attempts');?>"   required >
													</div>
													<div class="form-group">	 
														<label for="inputEmail"  ><?php echo $this->lang->line('pass_percentage');?></label> 
														<input type="text" name="pass_percentage" value="50" class="form-control" placeholder="<?php echo $this->lang->line('pass_percentage');?>"   required >
													</div>
													<div class="form-group" style="display:none;">	 
														<label for="inputEmail"  ><?php echo $this->lang->line('correct_score');?></label> 
														<input type="text" name="correct_score"  value="1" class="form-control" placeholder="<?php echo $this->lang->line('correct_score');?>"   required >
													</div>
													<div class="form-group" style="display:none;">	 
														<label for="inputEmail"  ><?php echo $this->lang->line('incorrect_score');?></label> 
														<input type="text" name="incorrect_score"  value="0" class="form-control" placeholder="<?php echo $this->lang->line('incorrect_score');?>"  required  >
													</div>
													<div class="form-group">	 
														<label for="inputEmail"  ><?php echo $this->lang->line('ip_address');?></label> 
														<input type="text" name="ip_address"  value="" class="form-control" placeholder="<?php echo $this->lang->line('ip_address');?>"    >
													</div>
													<div class="form-group">	 
														<label for="inputEmail" ><?php echo $this->lang->line('view_answer');?></label> <br>
														<input type="radio" name="view_answer"    value="1" checked > <?php echo $this->lang->line('yes');?>&nbsp;&nbsp;&nbsp;
														<input type="radio" name="view_answer"    value="0"  > <?php echo $this->lang->line('no');?>
													</div>
													<div class="form-group" style="display:none;">	 
														<label for="inputEmail" ><?php echo $this->lang->line('open_quiz');?></label> <br>
														<input type="radio" name="with_login"    value="0"  > <?php echo $this->lang->line('yes');?>&nbsp;&nbsp;&nbsp;
														<input type="radio" name="with_login"    value="1" checked > <?php echo $this->lang->line('no');?>
													</div>

													<div class="form-group">	 
														<label for="inputEmail" ><?php echo $this->lang->line('show_rank');?></label> <br>
														<input type="radio" name="show_chart_rank"    value="1" checked > <?php echo $this->lang->line('yes');?>&nbsp;&nbsp;&nbsp;
														<input type="radio" name="show_chart_rank"    value="0"  > <?php echo $this->lang->line('no');?>
													</div>


													<?php 
													if($this->config->item('webcam')==true){
														?>
														<div class="form-group" style="display:none;">	 
															<label for="inputEmail" ><?php echo $this->lang->line('capture_photo');?></label> <br>
															<input type="radio" name="camera_req"    value="1"  > <?php echo $this->lang->line('yes');?>&nbsp;&nbsp;&nbsp;
															<input type="radio" name="camera_req"    value="0"  checked > <?php echo $this->lang->line('no');?>
														</div>
														<?php 
													}else{
														?>
														<input type="hidden" name="camera_req" value="0">

														<?php 
													}
													?>

													<div class="form-group" style="display:none;">

														<label   ><?php echo $this->lang->line('assign_to_student');?></label> <br>


														<select class="js-example-basic-multiple form-control" name="uids[]" multiple="multiple">
															<?php foreach($user_list as $k => $uval){ ?>
																<option value="<?php echo $uval['uid'];?>"><?php echo $uval['first_name'].' '.$uval['last_name'].' ('.$uval['email'].')';?></option>
															<?php } ?>
														</select>
														<script type="text/javascript">
															$(".js-example-basic-multiple").select2();
														</script>
													</div>

													<div class="form-group" style="display:none;">	 
														<label   ><?php echo $this->lang->line('quiz_template');?></label> <br>
														<select name="quiz_template">
															<?php 
															foreach($this->config->item('quiz_templates') as $qk=> $val){
																?>
																<option value="<?php echo $val;?>"><?php echo $val;?></option>
																<?php 
															}
															?>

														</select>
													</div>

													<div class="form-group" style="display:none;">	 
														<label for="inputEmail" ><?php echo $this->lang->line('question_selection');?></label> <br>
														<input type="radio" name="question_selection"    value="1"  > <?php echo $this->lang->line('automatically');?><br>
														<input type="radio" name="question_selection"    value="0"  checked > <?php echo $this->lang->line('manually');?>
													</div>
													<div class="form-group" style="display:none;">	 
														<label for="inputEmail" ><?php echo $this->lang->line('generate_certificate');?></label> <br>
														<input type="radio" name="gen_certificate"    value="1"  > <?php echo $this->lang->line('yes');?><br>
														<input type="radio" name="gen_certificate"    value="0"  checked > <?php echo $this->lang->line('no');?>
													</div>

													<div class="form-group" style="display:none;">	 
														<label for="inputEmail"  ><?php echo $this->lang->line('certificate_text');?></label> 
														<textarea   name="certificate_text"  class="form-control" ></textarea><br>
														<?php echo $this->lang->line('tags_use');?> <?php echo htmlentities("<br>  <center></center>  <b></b>  <h1></h1>  <h2></h2>   <h3></h3>    <font></font>");?><br>
														{email}, {first_name}, {last_name}, {quiz_name}, {percentage_obtained}, {score_obtained}, {result}, {generated_date}, {result_id}, {qr_code}
													</div>

												</div>
												<div class="form-group" id="table-question" >
												</div>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
											<button id="addQuizFirst" type="button" class="btn btn-primary">Tiếp</button>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="inviteModal" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Giao bài kiểm tra</h4>
										</div>
										<div class="modal-body">
											<form id="inviteModalForm">
												<p id="inviteMsg" style="display: none;" class=" text-danger"></p>
												<input type="hidden" name="quid" id="quid"/>
												<div class="form-group">
													<label>Ngày bắt đầu</label>
													<input class="form-control" value="<?php echo date("Y-m-d"); ?>" type="date" name="startdate" id="startdate" />
													<label>Ngày kết thúc</label>
													<input class="form-control" value="<?php echo (new DateTime(date("Y-m-d")))->add(new DateInterval("P1D"))->format('Y-m-d'); ?>" type="date" name="enddate" id="enddate" />
												</div>
												<div class="assign-tab">
													<ul class="nav nav-tabs">
														<li class="active" id="tabstudent"><a data-toggle="tab" href="#studenttab">Học sinh</a></li>
														<?php
														if($su != 4){
															?>
															<li id="tabclass"><a data-toggle="tab" href="#classtab" id="assClass">Lớp</a></li>
															<li id="tabgroup"><a data-toggle="tab" href="#grouptab" id="assGroup">Nhóm</a></li>
															<?php
														} 
														?>
													</ul>

													<div class="tab-content">
														<div id="studenttab" class="tab-pane fade in active">

															<table id="tblStudentAssign" class="display" style="width:100%"></table>
														</div>
														<div style="display:none">
															<input type="text" id="search_std" value="">
															<input type="text" id="page_std" value="0">
															<input type="text" id="quidd" value="">
														</div>
														<div id="classtab" class="tab-pane fade">
															<table id="tblClassAssign" class="display" style="width:100%"></table>
														</div>
														<div style="display:none">
															<input type="text" id="search_cl" value="">
															<input type="text" id="page_cl" value="0">
														</div>
														<div id="grouptab" class="tab-pane fade">
															<table id="tblGroupAssign" class="display" style="width:100%"></table>
														</div>
														<div style="display:none">
															<input type="text" id="search_gr" value="">
															<input type="text" id="page_gr" value="0">
														</div>
													</div>
												</div>

											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-success" id="determine_ass_teacher" data-dismiss="modal">Xác nhận</button>
											<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
											<!--<button id="btnInvite" type="button" class="btn btn-primary">Lưu</button>-->
										</div>
									</div>
								</div>
							</div>
</section>
</div>
<footer>
	<section>
	<?php $this->load->view('stemup/footer');?>
	</section>
</footer>
</body>
</html>