<!DOCTYPE html>
<html lang="en">
  <link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('css/style-dat.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
  <?php $this->load->view('stemup/head');?>
  <script src="<?php echo base_url('js/left-menu.js');?>"></script>
  <script>
	//quizAssignTo();
	var base_url="<?php echo base_url();?>";
	var site_url="<?php echo site_url();?>";
	var su="<?php echo $su ?>";
	</script>
	<script src="<?php echo base_url('js/exercise_assigned_student.js');?>"></script>
	<link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">
	
  <body class="bg-body">

<?php $this->load->view('stemup/header');?>
<main class="container MT70">    
	<section class="row">
  	 <?php $this->load->view('stemup/menu');?>
		<aside class="col-md-10">
				<div role="tabpanel">		    
					<div id="tabContent2" class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="home2a">
							<div class="box-bor MB20">
								<div role="tabpanel" id="tabs">
									<ul class="row col-xs-12 nav nav-tabs" role="tablist">						  
										<li class="active col-xs-4 action_answer" role="presentation" ><a href="#home1"  id="text-tabs" data-toggle="tab" role="tab" aria-controls="tab1">Hoạt động được giao</a></li>
								
										<li class="col-xs-4 action_answer" role="presentation" onclick="quizAssignTo_undone(0,0,1,0,'')"><a href="#home5" id="text-tabs5" data-toggle="tab" role="tab" aria-controls="tab5" >Hoạt động chưa làm</a></li>
								
										<li class="col-xs-4 action_answer" role="presentation" onclick="quizAssignTo_done(0,0,1,0,'')"><a href="#home4" id="text-tabs4" data-toggle="tab" role="tab" aria-controls="tab4">Hoạt động đã làm</a></li>
									</ul>
								<div id="tabContent1" class="tab-content">
									<div role="tabpanel" class="tab-pane fade in active" id="home1"> 
									</div>							
									<div role="tabpanel" class="tab-pane fade in" id="home4">	
									</div>
									<div role="tabpanel" class="tab-pane fade in " id="home5">
									</div>
								 
								</div>
							</div>
						</div>   
					</div>
				</div>
			</div>	  
		</aside>
	  
	  
		<aside class="col-md-3 rightbar">
	   
		</aside>

    </section>
	
  	</main>

  	<script>
		quizAssignTo_1(0,0,1,0,"");
	</script>
	
  </body>
    <?php $this->load->view('stemup/footer');?>  
  </html>
