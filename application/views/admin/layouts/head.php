<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title?></title>
    <link type="text/css" href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>
    <link type="text/css" href="<?php echo base_url('css/admin/bootstrap.min.css'); ?>" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url('css/admin/bootstrap-theme.min.css'); ?>" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url('css/admin/jquery-ui.css'); ?>" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url('edmin/css/theme.cs'); ?>s" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('edmin/bower_components/font-awesome/css/font-awesome.min.css')?>">
    <link type="text/css" href="<?php echo base_url('css/admin/style-admin.css'); ?>" rel="stylesheet">

    <script src="<?php echo base_url('ckeditor/ckeditor.js'); ?>" type="text/javascript"></script>
    <script>
        base_url="<?php echo base_url(); ?>";
    </script>  

    <?php
        function _substr($str, $length, $minword = 7){
        $sub = '';
        $len = 0;
        foreach (explode(' ', $str) as $word)
        {
            $part = (($sub != '') ? ' ' : '') . $word;
            $sub .= $part;
            $len += strlen($part);
            if (strlen($word) > $minword && strlen($sub) >= $length)
            {
            break;
            }
        }
            return $sub . (($len < strlen($str)) ? '...' : '');
        }
    ?>
</head>
<body>