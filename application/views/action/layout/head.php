<!DOCTYPE html>
<html lang="en">
<link href="<?php echo base_url('css/style-hu.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('css/style-dat.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('css/stemup_css/style.css'); ?>" rel="stylesheet">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>STEMUP</title>
    <link href="<?php echo base_url('css/stemup_css/bootstrap-3.4.1.css'); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="" crossorigin="anonymous">
    <link href="<?php echo base_url('css/style_stemup.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('css/action-menu.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/notify_menu.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/jquery-ui.css'); ?>" rel="stylesheet">
    <script src="<?php echo base_url('js/stemup_js/jquery-1.12.4.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/stemup_js/bootstrap-3.4.1.js'); ?>"></script>
    <script src="<?php echo base_url('js/notification.js'); ?>"></script>
    <script src="<?php echo base_url('js/star-rating.js'); ?>"></script>
    <script src="<?php echo base_url('js/paginate.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>editor/tinymce.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('js/formattoolbar.js') ?>"></script>
    <script src="<?php echo base_url('js/jquery-1.11.3.min.js'); ?> "></script>
    <script src="<?php echo base_url('js/jquery.dataTables.js'); ?>"></script>
    <link href="<?php echo base_url('css/jquery.dataTables.css'); ?>" rel="stylesheet">
    <script src="<?php echo base_url('js/addclass.js'); ?>"></script>
    <script src="<?php echo base_url('js/newuserpage1.js'); ?>"></script>
    <script src="<?php echo base_url('js/responsive.dataTables.js'); ?>"></script>
    <script src="<?php echo base_url('js/minhash.js'); ?>"></script>
    <script src="<?php echo base_url('js/loadoption1.js'); ?>"></script>
    <script src="<?php echo base_url('js/newuserpage.js');?>"></script>

    <script>
        var base_url = "<?php echo base_url(); ?>";
        var site_url = "<?php echo site_url(); ?>";
        var su = "<?php echo $su; ?>";
    </script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-3948834986570227",
            enable_page_level_ads: true
        });
    </script>
</head>
<script src="<?php echo base_url('js/left-menu.js'); ?>"></script>
<script src="<?php echo base_url('js/profile.js'); ?>"></script>
<link href="<?php echo base_url('css/setbackground.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('css/star-rating.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('css/result.css'); ?>" rel="stylesheet">


<script>
    var rid = <?php echo $result['rid'] ?>;
    var base_url = "<?php echo base_url(); ?>";
    var site_url = "<?php echo site_url(); ?>";
    var su = "<?php echo $su ?>";
    var id_mcq_fun = "";
    var id_quiz_fun = "";
    var count_question = <?php echo count($questions); ?>;
</script>

<script src="<?php echo base_url('js/exercise_assigned_student.js'); ?>"></script>
<link href="<?php echo base_url('css/card.css'); ?>" rel="stylesheet">

<body class="bg-body">
    <?php $this->load->view('action/layout/header') ?>