<!DOCTYPE html>
<html lang="en">
<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
<?php $this->load->view('stemup/head');?>
<script src="<?php echo base_url('js/left-menu.js');?>"></script>
<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
<script>
	//quizAssignTo();
	var base_url="<?php echo base_url();?>";
	var site_url="<?php echo site_url();?>";
	var su="<?php echo $su ?>";
</script>

<link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">

<link href="<?php echo base_url('css/style-dat.css');?>" rel="stylesheet">
<body class="bg-body">

	<?php $this->load->view('stemup/header');?>
	<main class="container MT70">

		<section class="row">

			<aside class="col-md-12">

				<div role="tabpanel">

					<div id="tabContent2" class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="home2a">
							<div class="box-bor MB20">
								<div role="tabpanel" id="tabs">
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active" ><a href="#home1"  id="text-tabs" data-toggle="tab" role="tab" aria-controls="tab1">Stemup Phụ Huynh </a></li>

										<li role="presentation" ><a href="#home2"  id="text-tabs2" data-toggle="tab" role="tab" aria-controls="tab1">Stemup Học Sinh</a></li>

										<li role="presentation" onclick=""><a href="#home3" id="text-tabs3" data-toggle="tab" role="tab" aria-controls="tab2">Web Stemup</a></li>
									</ul>
									<div id="tabContent1" class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="home1">
											<?php $this->load->view('help/help_mobile_parent');?>
										</div>
										<div role="tabpanel" class="tab-pane fade in " id="home2">
											<?php $this->load->view('help/help_mobile_student');?>


										</div>
										<div role="tabpanel" class="tab-pane fade in" id="home3">
											<?php $this->load->view('help/help_mobile_home');?>
										</div>


									</div>
								</div>
							</div>

						</div>
					</div>

				</div>

			</aside>

		</section>

	</main>


	<?php $this->load->view('stemup/footer');?>
</body>

</html>
