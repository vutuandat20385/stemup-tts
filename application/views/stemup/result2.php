<!DOCTYPE html>
<html lang="en">
    <!-- Bootstrap -->
  <link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('css/style-dat.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('css/setbackground.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('css/star-rating.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('css/responsive.dataTables.min.css');?>" rel="stylesheet">

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --->
  <script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script> 
  <script src="<?php echo base_url('js/jquery.dataTables.js');?>"></script>
  <link href="<?php echo base_url('css/jquery.dataTables.css');?>" rel="stylesheet">
  <script src="<?php echo base_url('js/addclass.js');?>"></script>
  <script src="<?php echo base_url('js/newuserpage1.js');?>"></script>
  <script src="<?php echo base_url('js/responsive.dataTables.js');?>"></script>
  <script src="<?php echo base_url('js/minhash.js');?>"></script> 
  <!--<script src="<?php echo base_url('js/owlcarousel/owl.carousel.min.js');?>"></script>-->
    <script src="<?php echo base_url('js/loadoption1.js');?>"></script>
<!--     <script src="<?php echo base_url('js/view_result.js');?>"></script> -->

  <style>
    .container {
    padding-left: 10px;
    padding-right: 0px;
}

  @media screen and (max-width: 767px){
    .bg-quizz1 {
    margin-left: 0 !important;
    margin-right: 0 !important;
  }
  .row.dtmt10, .row.MB20.twopt {
    padding-left: 15px;
}
.slide1 {
    padding-bottom: 0;
}
#mainqtatt {
    margin-bottom: 0;
}

  }
  </style>
  <!-- <style>
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
</style> -->

  <script>

  var rid=<?php echo $result['rid']?>;
  var base_url="<?php echo base_url();?>";
  var site_url="<?php echo site_url();?>";
  var su="<?php echo $su ?>";
   var id_mcq_fun ="";
     var id_quiz_fun ="";
   var count_question =<?php echo count($questions);?>;
  </script>



  <script src="<?php echo base_url('js/left-menu.js');?>"></script>
  <script src="<?php echo base_url('js/notification.js');?>"></script>
  <script src="<?php echo base_url('js/star-rating.js');?>"></script>
  <script src="<?php echo base_url('js/paginate.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url('js/formattoolbar.js')?>"></script>
  
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">

<?php $this->load->view('stemup/head');?>

  <body class="bg-body">
    <?php $this->load->view('stemup/header');?>
  <main class="container MT70 mb-20">
  <section class="row">
      <?php $this->load->view('stemup/menu');?>
      
      <!-- Content -->
<section class="row col-md-10"> 

    <aside class="col-md-12 hidden-dt" style="position:fixed; bottom:0; z-index:100" >
         <div class="bg-quizz2"  style="margin-right: -2%;">
          <!--<h4 class="text-quizz">Bài trắc nghiệm: <?php echo $title;?></h4>-->
           <table>
           <tr>
             <td class="col-xs-12">
              <h5 class="text-quizz1 " style="background-color:#1b75ba; color:white;margin-left:-4%; padding:5px; border-radius:5px">Quizz: <?php echo $result['quiz_name'];?></h5>
             </td>
              
             </tr>
            </table>  
         </div>
    
      </aside>
      <div class="test-header hidden-xs" style="height: 70px;"> 
          <div class="col-md-12  text-title">
            <div class=""  style="display: table;height: 70px; width: 100%;">
              <h3 class="text-quizz" style="color: #fff;"><!---Bài trắc nghiệm: ---><?php echo $result['quiz_name'];?></h3>

            </div>
          </div>

          
      </div>
  
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
      <aside class="col-md-12 hidden-xs q-col-right" style="line-height: 2;">

       <!--  <div id="exTab2" class="">  
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
                          <?php foreach($questions as $qk => $question){ if($qk>=$i*10 && $qk<($i+1)*10 ){?>  
                                                          
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
                      
                  </center>
                  
                </div>

              </div>
          </div> -->
  
      </aside>
    
    </section>


      <!--- End content-->
    </section>
    </main>
    <?php $this->load->view('stemup/footer');?>

    <!-- <div class="row noprint">
<?php 
    //if($this->session->flashdata('message')){
    //  echo $this->session->flashdata('message');  
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



</div> -->

  </body>
</html>


<script src="<?php echo base_url('js/bootstrap.js');?>"></script> 
<script>
  $(document).ready(function(){
    $('img').removeAttr('srcset');
    $('img').removeAttr('sizes');
    $('img').removeAttr('alt');
  });
  


// global variable for the player
var player;

// this function gets called when API is ready to use
  function onYouTubePlayerAPIReady() {
    // create the global player from the specific iframe (#video)
    player = new YT.Player('video', {
      events: {
        // call this function when player is ready to use
        'onReady': onPlayerReady
      }
    });
    
  }

function onPlayerReady(event) {
  
  var pauseNext = document.getElementById("next");
  var pausePrevious = document.getElementById("previous");
  var pauseList = document.getElementsByClassName("btn-list");
  var pauseOpt = document.getElementsByClassName("div_opt1");

  pauseNext.addEventListener("click", function() {
    player.pauseVideo();
  });
  pausePrevious.addEventListener("click", function() {
    player.pauseVideo();
  });


  for(var i=0; i<pauseList.length;i++){
    pauseList[i].addEventListener("click", function() {
    player.pauseVideo();
    });
  };

  for(var j=0; j<pauseOpt.length;j++){
    pauseOpt[j].addEventListener("click", function() {
    player.pauseVideo();
    });
  };
}

// Inject YouTube API script
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/player_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


</script>

