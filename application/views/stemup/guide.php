<!DOCTYPE html>
<html lang="en">
  <head>
	<title>HƯỚNG DẪN | STEMUP</title>
	<?php $this->load->view('stemup/head_not_login');?>
	<!--CSS-->
	<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/guide.css');?>" rel="stylesheet">
	<!--JS-->
	
	 <script>
		//quizAssignTo();
		var base_url="<?php echo base_url();?>";
		var site_url="<?php echo site_url();?>";
		var su="<?php echo $su ?>";
	 </script>
	<style>
		.MB20_mobile{
				display: none;
			}
		@media only screen and (max-width: 767px){
			.MB20_web{
				display: none;
			}
			.MB20_mobile{
				display: block;
			}
			.img-responsive {
			    width: unset;
			}
		}
	</style> 
</head>

  <body class="bg-body">
	<header class="container-fluid bg-stemup">
			<div class="container">	<?php $this->load->view('stemup/home/home_header');?>	</div>
	</header>
		<nav class="navbar navbar-default mb-6">
		<div class="container">
			<?php $this->load->view('stemup/home/home_header_mobile');?>
			<?php $this->load->view('stemup/home/menu_top_home'); ?>			
		</div>
	</nav>
		
	<main class="container MT70">
		<section class="row">
			<div class="col-md-1"></div>
	  		<aside class="col-md-10 min-h" style="background: #FFFF;padding-bottom: 50px;">
				<div role="tabpanel">		    
					<div id="tabContent2" class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="home" style=" min-height: 60px !important;">
							<div class="box-bor MB20">
								<div role="tabpanel" id="tabs">
									<ul class="row col-xs-12 nav nav-tabs title_tap" role="tablist">						  
										<li class="active col-xs-4 action_answer" role="presentation" ><a href="#home1"  id="text-tabs" data-toggle="tab" role="tab" aria-controls="tab1"><b><center>Stemup Phụ Huynh</center></b></a></li>
								
										<li class="col-xs-4 action_answer" role="presentation"><a href="#home2" id="text-tabs2" data-toggle="tab" role="tab" aria-controls="tab2" ><b><center>Stemup Học Sinh</center></b></a></li>
								
										<li class="col-xs-4 action_answer" role="presentation"><a href="#home3" id="text-tabs3" data-toggle="tab" role="tab" aria-controls="tab3"><b><center>Web Stemup</center></b></a></li>
									</ul>
									
								</div>

						    </div>   
						</div>
					</div>
				</div>

				<div id="tabContent1" class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="home1">
											<?php $this->load->view('stemup/guide1');?>
										</div>							
										<div role="tabpanel" class="tab-pane fade in" id="home2">
											<?php $this->load->view('stemup/guide2');?>	
										</div>
										<div role="tabpanel" class="tab-pane fade in " id="home3">
											<?php $this->load->view('stemup/guide3');?>
										</div>
									 
									</div>	  
			</aside>
			<div class="col-md-1"></div>
	    </section>	
		
	
  	</main>
	
	<section>
		<?php $this->load->view('stemup/footer');?> 
	</section>
  </body>
    
  </html>
 <script type="text/javascript">
 	$("#guide_").attr("class","active");
 </script>