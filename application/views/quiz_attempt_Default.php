<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    
    <?php $this->load->view('stemup/head')?>
    <!-- Bootstrap -->

	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-dat.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/setbackground.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/star-rating.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/view-result.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/responsive.dataTables.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
	<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="<?php echo base_url('js/jquery.dataTables.js');?>"></script>
	<link href="<?php echo base_url('css/jquery.dataTables.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('js/addclass.js');?>"></script>
	<script src="<?php echo base_url('js/newuserpage.js');?>"></script>
	<script src="<?php echo base_url('js/responsive.dataTables.js');?>"></script>
	<script src="<?php echo base_url('js/minhash.js');?>"></script>
	<!--<script src="<?php echo base_url('js/owlcarousel/owl.carousel.min.js');?>"></script>-->
	<script src="<?php echo base_url('js/loadoption.js');?>"></script>
	<script src="<?php echo base_url('js/select2.min.js');?>"></script>
	<script src="<?php echo base_url('js/editprofile.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url('js/formattoolbar.js')?>"></script>
	<script src="<?php echo base_url('js/left-menu.js');?>"></script> 
	<!--	<script src="<?php echo base_url('js/notification.js');?>"></script> -->
	<script src="<?php echo base_url('js/star-rating.js');?>"></script>
	<script src="<?php echo base_url('js/paginate.js');?>"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> 


	
	<script> (adsbygoogle = window.adsbygoogle || []).push({ google_ad_client: "ca-pub-3948834986570227", enable_page_level_ads: true }); 
	</script>
	
	<script>
		var base_url="<?php echo base_url();?>";
		var site_url="<?php echo site_url();?>";
		var su="<?php echo $su ?>";
	   	var id_mcq_fun ="";
	    var id_quiz_fun ="";
		var count_question =<?php echo $count_questions;?>;
	</script>

	<link href="<?php echo base_url('css/style_stemup.css') ?>" rel="stylesheet" type="text/css">
 	<!-- <link href="<?php //echo base_url('css/action-menu.css');?>" rel="stylesheet"> -->
	<style type="text/css">
	@media screen and (max-width: 767px) {
		.MT60{
			margin-top:0;
			padding-top: 0;
		}
		.box-bor.MB20 {
		    padding: 20px 0;
		}
		.imgqtt img {
		    width: 100%;
		}
	}
	</style>
  </head>
 <body class="bg-body">

    <main class="container MT60">
    <!--- Mobile: Theo dõi thời gian làm bài và nút NỘP BÀI--->
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
      <!--- Mobile--->
      <?php $this->load->view('stemup/header');?>
      <div class="container">
      	<div class="left-menu">
      		<?php $this->load->view('stemup/menu');?>
      	</div>	
      	<div class="content-right col-md-10">
      		<!---header--->
      		<div class="row test-header hidden-xs">
					<div class="col-md-11 text-title">
						<div class=""  style="display: table;height: 60px; width: 100%;margin-top: 10px;">
							<h3 class="text-quizz"><?php echo $title;?></h3>
						</div>
					</div>
					<div class="col-dongho col-md-1">
							<div class="dongho1">
									<p class="text-dongho" style="margin-left: -15%;"><span class="text-gio" id='timer' ></span></p>																	
							</div>
					</div>
					
					
			</div>
			<!---End header--->

			<!---Slide--->
			<aside class="col-md-12 q-col-left" id="mainqtatt" >
	   
			  <div class="bg-quizz1">
	              <form method="post" action="<?php echo site_url('quiz/submit_quiz/'.$quiz['rid']);?>" id="quiz_form" >
						<input type="hidden" name="rid" value="<?php echo $quiz['rid'];?>">
						<input type="hidden" name="noq" value="<?php echo $quiz['noq'];?>">
						<input type="hidden" name="individual_time"  id="individual_time" value="<?php echo $quiz['individual_time'];?>">
				  <div id="carousel1" class="carousel slide slide1" data-ride="carousel" data-interval="false" data-wrap="false">
		
							
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
												<div  style="background-image:url('https://do.stem.vn/upload/background/h400/<?php if($question['background_template']!=0){ echo $question['background_template'];} else{ echo rand(1,20);}?>.jpg'); height:330px;" class="outer bgqt_att text-fixed">
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
																	<img class="img-responsive img-quiz-at"  src="<?php echo str_replace("..",'https://do.stem.vn',$question['img'] )?>">
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
								<span class="glyphicon glyphicon-chevron-left top200px" aria-hidden="true" id="previous"></span>
								<span class="sr-only" >Previous</span>
							</a>
							<a class="right carousel-control right-Quizz" href="#carousel1" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right top200px" aria-hidden="true" id="next"></span>
								<span class="sr-only" >Next</span>
					       </a>
						   <aside class="col-md-12 hidden-xs" id="question-list">
				<center class="quiz-list-right-col">
				
						<?php for($i=0; $i<$count_page_qt; $i++){ ?>	
							<div style="margin-top:10px">
								<ol class="carousel-Quizz">
									<?php foreach($questions as $qk => $question){ if($qk>=$i*15 && $qk<($i+1)*15 ){?>	
																									
										<li href="#q_type<?php echo $qk ?>" id="car_index_qt_<?php echo $qk ?>" <?php if($qk==0){ echo 'class="ftsz-25-fix"'; }?> data-target="#carousel1" data-slide-to="<?php echo $qk ?>"><span style="margin-top:10px"><?php echo $qk+1 ?></span>
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
					<center>
						<div class="col-btn-nopbai col-md-12">
							<div class="btn-nopbai-1">
								<button type="button" class="btn btn-success btn-block btn-lg btn-nopbai" onclick="javascript:cancelmove();">Nộp bài</button>	
							</div>					
					</div>
					</center>
			</aside>
					    </div>	
	                </div>	
	              </div>
	              </form>			  
			  </div><!--end baiviet-->

	      </aside>
				<center class="quiz-list-right-col">
				
				<?php for($i=0; $i<$count_page_qt; $i++){ ?>	
					<div style="margin-top:10px">
					<?php if($i==0) {
					?>	<ol class="carousel-indicators carousel-Quizz hidden-dt" style="margin-top:-56px;"> <?php
					} else {
					?>	<ol class="carousel-indicators carousel-Quizz hidden-dt"> <?php
					} ?>
						
							<?php foreach($questions as $qk => $question){ if($qk>=$i*7 && $qk<($i+1)*7 ){?>	
																							
								<li href="#q_type<?php echo $qk ?>" id="car_index_qt_<?php echo $qk+$count_questions ?>" <?php if($qk==0){ echo 'class="ftsz-25-fix"'; }?> data-target="#carousel1" data-slide-to="<?php echo $qk ?>"><span style="margin-top:10px"><?php echo $qk+1 ?></span>
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
			<!---End Slide--->
			<!---Question List --->
			
			<!---End Question List --->
      	</div>
      </div>

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

</div>

</body>
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

