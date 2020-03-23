<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <style>
  .opp {
    margin-top: 134px;
    mix-blend-mode: exclusion;
}
  </style>
<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
<?php $this->load->view('stemup/head');?>
<script src="<?php  echo base_url('js/data.js') ?>"></script>
<script src="<?php  echo base_url('js/profile.js') ?>"></script>
<script src="<?php  echo base_url('js/jquery-ui.js') ?>"></script>
<link href="<?php  echo base_url('css/jquery-ui.css') ?>">
</head>
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