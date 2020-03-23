	
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tự học</title>
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">

	<?php $this->load->view('stemup/head'); ?>
	<script src="<?php echo base_url('js/newuserpage.js');?>"></script>
</head>
<body class="bg-body">
	<div class="container MT70" style="padding: 0;">
		<?php $this->load->view('stemup/header');?>
		<?php $this->load->view('stemup/menu');?>
		<div class="col-md-10 col-learning-right">
			<div class="trac-nghiem mb-20 col-md-12 col-sm-12 col-xs-12">
				<h2 class="title">TRẮC NGHIỆM </h2>

				<?php
				foreach ($list_category as $key => $value) {
					$cid=$value['cid'];
				?>
					<div class="col-md-2 col-sm-4 col-xs-4 category-box">
						<a href="<?php echo site_url('self_learning/category/').'/'.$cid;?>">
							<div class="cover">
								<img class="category-avatar " src="<?php echo base_url('upload/symbol/').'/'.$cid.'.png';?>" />
								<hr>
								<span class="col-md-9 col-xs-9 col-xs-9 category-name "><?php echo $value['tenmon']; ?></span>
								<span class="col-md-3 col-sm-3 col-xs-3 category-soluong"><?php echo $value['soluong']; ?></span>
							</div>
						</a>
					</div>
				<?php
				}
				?>
			</div>
			
		</div>
	</div>
	<footer>
		<section> <?php $this->load->view('stemup/footer');?> </section>
	</footer>
</body>
</html>