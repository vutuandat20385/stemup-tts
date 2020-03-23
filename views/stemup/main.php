<!DOCTYPE html>
<html lang="en">
  <?php $this->load->view('stemup/head');?>
  <body class="bg-body">
	  <?php $this->load->view('stemup/header');?>
	<main class="container MT70 mb-20">
	<section class="row">
  	  <?php $this->load->view('stemup/menu');?>
  	  <?php $this->load->view('stemup/action');?>
    </section>
  	</main>
  	<?php $this->load->view('stemup/footer');?>
  </body>
</html>