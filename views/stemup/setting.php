<!DOCTYPE html>
<html lang="en">
<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
<script src="<?php echo base_url('js/profile.js') ?>"></script> 
<script src="<?php echo base_url('js/data.js') ?>"></script> 
<script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>

  <?php $this->load->view('stemup/head');?>
  <body class="bg-body">
	  <?php $this->load->view('stemup/header');?>
	<main class="container MT70 mb-20">
	<section class="row">
  	  <?php $this->load->view('stemup/menu');?>
  	  <?php $this->load->view('stemup/setting_stem_up');?>
    </section>
  	</main>
  	<?php $this->load->view('stemup/footer');?>
  </body>
</html>