<!DOCTYPE html>
<html lang="en">
<head>
	<title>STEMUP</title>
	<?php $this->load->view('stemup/head_not_login');?>
	<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
</head>
<body>
	<header class="container-fluid bg-stemup ">
		<div class="container">	<?php $this->load->view('stemup/home/home_header');?>	</div>
	</header>
	<nav class="navbar navbar-default mb-6">
		<div class="container">
			<?php $this->load->view('stemup/home/home_header_mobile');?>
			<?php $this->load->view('stemup/home/menu_top_index'); ?>			
		</div>
	</nav>
	<section class="container-fluid">
		<div class="row">
			<div class="col-md-6 pr-1 pl-1">
				<div id="carousel1" class="carousel slide mb-6" data-ride="carousel">
					<div id="thumbnail-preview-indicators" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="item slides active">
								<div class="slide-1" style="background-image: url(<?php echo $post[0]['avatar'] ?>);background-position: left !important;">
									<div class="carousel-caption carousel-caption1">
										<h1 class="tle-slide">
											<a class="text-tintop" href="<?php echo site_url('home/tintuc'.'/'.$post['slide'][0]['url_name'])?>">
											<?php echo $post[0]['name'] ?></a>
										</h1>
									</div>
								</div>
							</div>
							<div class="item slides">
								<div class="slide-3" style="background-image: url(<?php echo $post[1]['avatar'] ?>);background-position: left !important;">
									<div class="carousel-caption carousel-caption1">
										<h1 class="tle-slide"><a class="text-tintop" href="<?php echo site_url('home/tintuc'.'/'.$post['slide'][1]['url_name'])?>"><?php echo $post[1]['name'] ?></a></h1>
									</div>
								</div>
							</div>
						</div>
						<a class="left carousel-control carousel-control-nghechoi" href="#thumbnail-preview-indicators" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
						<a class="right carousel-control carousel-control-nghechoi" href="#thumbnail-preview-indicators" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
					</div> <!--end slide-->
					
					<a class="left carousel-control" href="#carousel1" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel1" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-xs-6 pl-1 pr-1">
						<a class="thum-top1" href="<?php echo site_url('home/tintuc'.'/'.$post[2]['url_name'])?>" style="background-image: url(<?php echo $post[2]['avatar'] ?>)">
							<span class="text-top1"><?php echo $post[2]['name'] ?></span>
						</a>
					</div>
					<div class="col-xs-6 pl-1 pr-1">
						<a class="thum-top1" href="<?php echo site_url('home/tintuc'.'/'.$post[3]['url_name'])?>" style="background-image: url(<?php echo $post[3]['avatar'] ?>)">
							<span class="text-top1"><?php echo $post[3]['name'] ?></span>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 pl-1 pr-1">
						<a class="thum-top1" href="<?php echo site_url('home/tintuc'.'/'.$post[4]['url_name'])?>" style="background-image: url(<?php echo $post[4]['avatar'] ?>)">
							<span class="text-top1"><?php echo $post[4]['name'] ?></span>
						</a>
					</div>
					<div class="col-xs-6 pl-1 pr-1">
						<a class="thum-top1" href="<?php echo site_url('home/tintuc'.'/'.$post[5]['url_name'])?>" style="background-image: url(<?php echo $post[5]['avatar'] ?>)">
							<span class="text-top1"><?php echo $post[5]['name'] ?></span>
						</a>
					</div>
				</div>
			</div>

		</div>
	
	</section>

	<section id="loiich" class="container-fluid bg-xanh pd-30">
		<?php $this->load->view('stemup/home/loi_ich');?>
	</section>
	<section id="nguoidung" class="container-fluid bg1 pd-30" style="background-image: url(<?php echo base_url('images/stemup_images/bg1.png')?>)">
		<?php $this->load->view('stemup/home/nguoi_dung');?>
	</section>
	<section id="caidat" class="container-fluid pd-30">
		<?php $this->load->view('stemup/home/cai_dat');?>
	</section>
	<section id="baochi" class="container-fluid bg-xam pd-30">
		<?php $this->load->view('stemup/home/bao_chi');?>
	</section>	

	<section>			
		<?php $this->load->view('stemup/footer');?> 
	</section>

</body>
</html>