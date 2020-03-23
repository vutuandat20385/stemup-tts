<!DOCTYPE html>
<html lang="en">
<head>

	<title>STEMUP</title>
	<?php $this->load->view('stemup/head_not_login');?>
	<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/faq.css');?>" rel="stylesheet">
</head>
<style>
.pointer {cursor: pointer;};
.tab-pane {
    min-height: 60px !important;
}
</style>
<body>
	<header class="container-fluid bg-stemup hidden-xs">
			<div class="container">	<?php $this->load->view('stemup/home/home_header');?>	</div>
		</header>
		<nav class="navbar navbar-default mb-6">
			<div class="container">
				<?php $this->load->view('stemup/home/home_header_mobile');?>
				<?php $this->load->view('stemup/menu_top'); ?>			
			</div>
		</nav>
	<section class="container-fluid">
		<main class="container MT70">   
		<section class="row">
			<div class="col-md-2"></div>
	  		<aside class="col-md-8 min-h" style="background: #FFFF;padding-bottom: 50px;">
				<div role="tabpanel">		    
					<div id="tabContent2" class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="home" style=" min-height: 60px !important;">
							<div class="box-bor MB20">
								<div role="tabpanel" id="tabs">
									<ul class="row col-xs-12 nav nav-tabs" role="tablist">						  
										<li class="active col-xs-4 action_answer" role="presentation" ><a href="#home1"  id="text-tabs" data-toggle="tab" role="tab" aria-controls="tab1"><b><center>Cài đặt STEMUP</center></b></a></li>
								
										<li class="col-xs-4 action_answer" role="presentation"><a href="#home2" id="text-tabs2" data-toggle="tab" role="tab" aria-controls="tab2" ><b><center>Nội dung</center></b></a></li>
								
										<li class="col-xs-4 action_answer" role="presentation"><a href="#home3" id="text-tabs3" data-toggle="tab" role="tab" aria-controls="tab3"><b><center>Câu hỏi khác</center></b></a></li>
									</ul>
									
								</div>

						    </div>   
						</div>
					</div>
				</div>

				<div id="tabContent1" class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="home1">
											<?php $this->load->view('stemup/fad1');?>
										</div>							
										<div role="tabpanel" class="tab-pane fade in" id="home2">
											<?php $this->load->view('stemup/fad2');?>	
										</div>
										<div role="tabpanel" class="tab-pane fade in " id="home3">
											<?php $this->load->view('stemup/fad3');?>
										</div>
									 
									</div>	  
			</aside>
			<div class="col-md-2"></div>
	    </section>	
  	</main>
	</section>


		<section id="lienhe" class="container-fluid bg-stemup pd-30">
			<div class="container">
				<div class="row padTB15">
					<div class="col-md-7 boL1 text-center767">
						<p class="text-trang">© 2019 DTT. Inc. All Rights Reserved.</p>
					</div>
					<div class="col-md-5 text-right">
						<div class="mb-20"><a class="text-trang" href="">www.facebook.com/stemupapp</a><br></div>
						<a href=""><img src="<?php echo base_url('images/stemup_images/google-01.svg')?>" height="25" alt=""></a>
						<a href=""><img src="<?php echo base_url('images/stemup_images/iphone-02.svg')?>" height="25" alt=""></a>
					</div>
				</div>
			</div>
		</section>


		<!-- body code goes here -->
		<script type="text/javascript">
			jQuery(document).ready(function($) {

				$('#myCarousel').carousel({
					interval: 5000
				});

        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
        	var id_selector = $(this).attr("id");
        	try {
        		var id = /-(\d+)$/.exec(id_selector)[1];
        		console.log(id_selector, id);
        		jQuery('#myCarousel').carousel(parseInt(id));
        	} catch (e) {
        		console.log('Regex failed!', e);
        	}
        });
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
        	var id = $('.item.active').data('slide-number');
        	$('#carousel-text').html($('#slide-content-'+id).html());
        });
    });
</script>

</body>
</html>
<script type="text/javascript">
 	$("#faq_").attr("class","active");
</script>