<!DOCTYPE html>
<html lang="en">
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
	<?php $this->load->view("stemup/head");?>
	<script src="<?php echo base_url('js/study.js');?>"></script>
	<link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">
	
	   <script>	
	var base_url="<?php echo base_url();?>";
    var site_url="<?php echo site_url();?>";
	var su="<?php echo $su ?>";
	var id_mcq_fun="<?php echo $id_mcq_fun ?>";
	var id_quiz_fun="<?php echo $id_quiz_fun ?>";
	</script>
	<script src="<?php echo base_url('js/left-menu.js');?>"></script>
  <body class="bg-body">
   <?php $this->load->view("stemup/header");?>


<main class="container MT70">
  
    <section class="row">
  	    <?php $this->load->view("stemup/menu");?>

	    <aside class="col-md-7">

		  

		
		 <?php foreach( $mcq_fun as $mcq) {?>
		 <div class="box-bor1 mb-20 moremcq_<?php echo $mcq['qid']?>"">
			  <!--<h4 class="tle1">Bài viết</h4>-->
			  <div>
				  <div class="row1" style="margin-top:20px">
					  <div class=col-xs-10>
						  <div class="w60"><a class="pointer"><img class="img-responsive img-circle" src="<?php echo base_url('upload/symbol/'.$mcq['cid'].'.png');?>" alt=""></a></div>
						  <h4 class="mb-0"><a class="pointer"><b><?php echo $mcq['category_name']?></b></a>
						   <span style="margin-left:10px" class="dropdown pointer"><a class="dropdown-toggle"  data-toggle="dropdown">
							<span class=" 
caret caret_e 
"></span></a>
						  <ul  class="dropdown-menu dropdown-menu_e"style="overflow-y: scroll;height: 273px;font-size:15px">
						      <?php foreach ($category_list as $ct){?>
							  <li><a href="<?php echo site_url('/page/category/'.$ct['category_permalink'])?>"><b><?php echo $ct['category_name']?></b></a></li>
							  <?php } ?>
							</ul>
						  
						  </span>
						  <br></h4>
						  <span class="text-small1"><?php echo $mcq['str_time_ago'] ?></i></span>
					  </div>
					  
			
				  </div>
				  <div class="col-xs-12" style="margin-bottom:10px">
				       <?php if(strpos($mcq['question'],'latex.codecogs.com')!==false || strpos($mcq['question'],'www.w3.org/1998/Math/MathML')!==false || ($mcq['cid']<5  && $mcq['fun_priory']<2)){?>
						  <div class="mcq_multimd assqid-<?php echo $mcq['qid']?>" style="display:none">
							<?php echo $mcq['question']?>
						 </div>
							<a href="<?php echo site_url('page/question/'.$mcq['permalink'].'/notsolved'); ?>" target="_blank" style="color:#000; font-size:30px">
						  
								<?php echo $mcq['question']?>
							 
						  
						  </a>
						<?php } else{?>
					   <?php if(strpos($mcq['question'], '<iframe')===false && strpos($mcq['question'], '<img')===false){?>
					    <a href="<?php echo site_url('page/question/'.$mcq['permalink'].'/notsolved'); ?>" target="_blank" style="color:#fff">
					   <div class="bgqtdiv" >
							<font color="white">
								<div style="background-image:url('https://stemup.app/upload/background/<?php if($mcq['background_template']!=0){ echo $mcq['background_template'];} else{ echo rand(1,20);}?>.jpg');" class="outer bgqt">
									<div class="middle">
										<div class="inner">
											<?php 
											
											$des=html_entity_decode(strip_tags($mcq['question'])) ;
											if (mb_strlen($des, 'UTF-8')>120){
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
							<div class="imgwlogo">
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

					  </a>
					   <?php } else{?>
					     <div class="mcq_multimd assqid-<?php echo $mcq['qid']?>" style="display:none">
							<?php echo $mcq['question']?>
						 </div>
					     <?php if(strpos($mcq['question'], '<iframe')===false){ ?>
						 <div class="mcq_multimd assqid-<?php echo $mcq['qid']?>">
							<center style="margin-bottom:20px">
							 <?php if($mcq['create_su']==3 && $mcq['text_license'] && $mcq['show_logo']==1) {?>
								<div class="imgwlogo">
									<a>
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
							<?php echo $mcq['question']?>
						 <?php }?>
						<?php }?>
					   
					  </a>
					  <?php }?>
				  </div>
				  
				<div class="col-xs-12 div_opt">
					  <div class="row MB20 twopt">
						<div class="col-xs-6 mobile-opt mobmb20"> 
							<label class="radio-inline w-100">
								 
								   <input class="MT10 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='0'>
								   <div class="input-group mobile-text-opt" >
		
									 <span class="input-group-addon opt-mb2 bo-input-left"></span>
									  <span id="optA1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> 
									  <table>
										<tr><td><b> A:</b> </td>
										 <td><?php 
										 $daa= html_entity_decode($mcq['options'][0]['q_option']);
										 $daa=str_replace ("<p>","",$daa);
										 $daa=str_replace ("</p>","",$daa);
										 echo $daa;
										 ?> </td>
										 </tr></table>
									  </span>
								   </div>
							
							</label>
						</div>
						<div class="col-xs-6 mobile-opt" > 
							<label class="radio-inline w-100">
								 
								   <input class="MT10 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='1'>
								   <div class="input-group mobile-text-opt" >
									 <span class="input-group-addon opt-mb2 bo-input-left"></span>
									  <span id="optB1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> 
									  <table>
										<tr><td><b> B:</b> </td>
										 <td><?php 
										 $dab= html_entity_decode($mcq['options'][1]['q_option']);
										 $dab=str_replace ("<p>","",$dab);
										 $dab=str_replace ("</p>","",$dab);
										 echo $dab;
										 ?> </td>
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
								 
								    <input class="MT10 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='2'>
								   <div class="input-group mobile-text-opt" >
									 <span class="input-group-addon opt-mb2 bo-input-left"></span>
									  <span id="optC1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> 
									  <table>
										<tr><td><b> C:</b> </td>
										 <td><?php 
										 $dac= html_entity_decode($mcq['options'][2]['q_option']);
										 $dac=str_replace ("<p>","",$dac);
										 $dac=str_replace ("</p>","",$dac);
										 echo $dac;
										 ?> </td>
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
								 
								 <input class="MT10 optradio_main mobile-radio-opt" type="radio" name="opt_main_<?php echo $mcq['qid']?>" value='3'>
								   <div class="input-group mobile-text-opt" >
									 <span class="input-group-addon opt-mb2 bo-input-left"></span>
									  <span id="optD1" type="text" class="form-control optvalmb pointer bo-input-right" name="option[]"   readonly style="color: transparent; text-shadow: 0 0 0 #444;resize: none; height:30px;padding-bottom:0px;overflow: hidden;"> 
									  <table>
										<tr><td><b> D:</b> </td>
										 <td><?php 
										 $dad= html_entity_decode($mcq['options'][3]['q_option']);
										 $dad=str_replace ("<p>","",$dad);
										 $dad=str_replace ("</p>","",$dad);
										 echo $dad;
										 ?> </td>
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
			 
			  
		  </div><!--end baiviet-->
		 <?php } ?>
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
						<!--<p class="text-left"><strong>Câu hỏi liên quan:</strong><br>
						<a href="">Tên gọi Cà Mau được hình thành do người Khmer gọi tên vùng đất này. 
						Ý nghĩa của chữ "Cà Mau" là gì?</a></p>-->
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
					<!--<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Đáp án</h4>
					 
					</div>-->
					<!--<div class="modal-body" id="bd_result_answer_qt">
						
						
					</div>-->
					<div class="box-popup">
						<div class="bg-xanhnhat">
							<div class="icon">
								<img src="<?php echo base_url();?>images/images1.png" alt="">
								
							</div>
						</div>
						<div class="box-chon">
							<h3 class="text-center mb-20">
								Chúc mừng bạn đã trả lời đúng!<br>
								Đáp án chính xác là <span id="correct_ans_tr"> </span>.
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
						<h3 class="text-center mb-20 mt-0">Rất tiếc bạn đã trả lời sai!<br>Đáp án chính xác là <span id="correct_ans_fs"> </span>.</h3>
					</div>

				</div>

					
				 </div>
				  
			</div>
		</div>
	

	
      </aside>
      
      <aside class="col-md-3 rightbar">
	 
	   <div class="box-bor MB20">
		  <h3 class="text-xanh1"><a href="">HOẠT ĐỘNG </a></h3>
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
  	
   <?php echo $this->load->view('stemup/footer');?>
  </body>
      
  </html>
