<!DOCTYPE html>
<html lang="en">
<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
<?php $this->load->view('stemup/head');?>
<script src="<?php echo base_url('js/notify_stem_up.js');?>"></script>
 <script>
    var site_url="<?php echo site_url();?>";
    	var su="<?php echo $su ?>";
 </script>
  <body class="bg-body">
	  <?php $this->load->view('stemup/header');?>
	<main class="container MT70 mb-20">
	<section class="row">
  	  <?php $this->load->view('stemup/menu');?>
  	  <?php $this->load->view('stemup/notification_stem_up');?>
    </section>
  	</main>
  	<?php $this->load->view('stemup/footer');?>
  </body>
</html>