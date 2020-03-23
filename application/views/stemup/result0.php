   <head>
   	<meta charset="utf-8">
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
   	<title>Kết quả</title>
   	<?php $this->load->view('stemup/head');?>

   	<!-- Bootstrap -->
   	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
   	<link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">
   	<link href="<?php echo base_url('css/jquery.dataTables.css');?>" rel="stylesheet">
   	<link href="<?php echo base_url('css/responsive.dataTables.min.css');?>" rel="stylesheet">
   	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
   	<script src="<?php echo base_url('js/newuserpage1.js');?>"></script>
   	<script src="<?php echo base_url('js/view_result.js');?>"></script>
   	<script src="<?php echo base_url('js/loadoption1.js');?>"></script>
   	<script src="<?php echo base_url('js/minhash.js');?>"></script> 
   	<script src="<?php echo base_url('js/responsive.dataTables.js');?>"></script>
   	<script src="<?php echo base_url('js/jquery.dataTables.js');?>"></script>
   	<script src="<?php echo base_url('js/addclass.js');?>"></script>
   	<script src="<?php echo base_url('js/owlcarousel/owl.carousel.min.js');?>"></script>
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
   	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>




   </head>
   <body class="bg-body">
   	
   	<div class="modal fade" id="changepwdModal" role="dialog">
   		<div class="modal-dialog">	 
   			<div class="modal-content">
   				
   				<div class="modal-body">

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

	 					


					</div> 
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- <script src="<?php //echo base_url('js/TweenMax.min.js');?>"></script> -->

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
							</button>
						</center>
					</div>
				</div>
			</div>


	<div class="row" id="rsct" style="margin-top:40px;">
		<div class="col-md-12 collapse" id="resultbyeach">
			<!--- Chi tiet dap an--->

 <aside class="col-md-12 col-sm-12 col-xs-12 q-col-left" id="mainqtatt" >

      <div class="bg-quizz1">
        <form method="post" action="<?php echo site_url('quiz/submit_quiz/'.$quiz['rid']);?>" id="quiz_form" >
          <input type="hidden" name="rid" value="<?php echo $quiz['rid'];?>">
          <input type="hidden" name="noq" value="<?php echo $quiz['noq'];?>">
          <input type="hidden" name="individual_time"  id="individual_time" value="<?php echo $quiz['individual_time'];?>">
          <div id="carousel1" class="carousel slide slide1" data-ride="carousel" data-interval="false" data-wrap="false">
            <ol class="carousel-indicators carousel-Quizz hidden-dt">
             <?php for($i=0; $i<$count_page_qt; $i++){ ?>	
               <div style="margin-top:10px">
                <ol class="carousel-Quizz">
                 <?php foreach($questions as $qk => $question){ if($qk>=$i*7 && $qk<($i+1)*7 ){?>	

                  <li href="#q_type<?php echo $qk ?>" class="btn-list" id="car_index_qt2_<?php echo $qk ?>" <?php if($qk==0){ echo 'class="ftsz-25-fix"'; }?> data-target="#carousel1" data-slide-to="<?php echo $qk ?>"><span style="margin-top:10px"><?php echo $qk+1 ?></span>
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
        <?php   } else{?>
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

                          <?php 
                      // echo str_replace('allowfullscreen="allowfullscreen"','id="video" allowfullscreen="allowfullscreen" data-autoplay="true"',$question['question']);
                          echo str_replace($v_link_full_1,$v_link_full_2,$question['question']);
                          ?>

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
                  <!-- <p class="mt-10 mb-0"><button type="button" class="btn btn-danger" style="display:none">Tag bạn Facebook để trợ giúp</button></p>
                    <?php  if($question['n_answers']>0){?>
                   <div class="col-xs-12 text-right mgr-20" style="float:right" >
                    <p class="f11"><i style="width:20px" class="fas fa-users mr-5 bo-tron bg-danger"></i><strong class="text-danger"><?php  echo number_format(100*$question['n_correct_answers']/$question['n_answers'],0)?>%</strong> trả lời đúng</p>
                   </div>
                   <?php  }?> -->
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
    <span class="glyphicon glyphicon-chevron-left top200px" aria-hidden="true" id="previous"></span>
    <span class="sr-only" >Previous</span>
  </a>
  <a class="right carousel-control right-Quizz" href="#carousel1" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right top200px" aria-hidden="true" id="next"></span>
    <span class="sr-only" >Next</span>
  </a>

</div>  
</div>  
</div>
</form>       
</div><!--end baiviet-->



</aside>
			<!--- End chi tiet dap an--->			
			
		</div>

	</div>
</div>

</div>

</body>