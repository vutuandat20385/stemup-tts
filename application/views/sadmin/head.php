<!DOCTYPE html>
 <!DOCTYPE html>
 <html>
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('sadmin/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('sadmin/bower_components/font-awesome/css/font-awesome.min.css')?>">

  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('sadmin/bower_components/Ionicons/css/ionicons.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('sadmin/dist/css/AdminLTE.min.css')?>">
  
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="<?php echo base_url('sadmin/dist/css/skins/_all-skins.min.css')?>">
   <!-- jvectormap -->
   <link rel="stylesheet" href="<?php echo base_url('sadmin/bower_components/jvectormap/jquery-jvectormap.css')?>">
   <!-- Date Picker -->
   <link rel="stylesheet" href="<?php echo base_url('sadmin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')?>">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="<?php echo base_url('sadmin/bower_components/bootstrap-daterangepicker/daterangepicker.css')?>">
   <!-- bootstrap wysihtml5 - text editor -->
   <link rel="stylesheet" href="<?php echo base_url('sadmin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')?>">
<script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
   <link rel="stylesheet" href="<?php echo base_url('css/style-sadmin.css')?>">
   <!-- Google Font -->
   <script src="<?php echo base_url('ckeditor/ckeditor.js') ?>" charset="utf-8"></script>
<script src="<?php echo base_url('ckfinder/ckfinder.js') ?>"></script>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
   <script src="<?php echo base_url('js/create_quiz_stemup.js') ?>"></script>
   <script src="<?php echo base_url('js/new_stemup.js')  ?>"></script>
<!-- <script src="<?php //echo base_url('js/send_email.js')  ?>"></script> -->

<script type="text/javascript">
  $(document).ready(function(){
    // var dschon=[];
    $('#ds_luuchon').click(function(){

      var danhsach=document.getElementsByName('cb-chon');
      var chon=[];
      for(var i=0; i<danhsach.length; i++){
        if(danhsach[i].checked === true){
          chon.push(danhsach[i].value);
          
        }
      }
      if(chon.length>3){
            alert('Bạn đã chọn hơn 3 tin liên quan, vui lòng chọn lại !');
          }else{
            
            $.ajax({
                url : "<?php echo site_url('sadmin/show_danhsach_chon');?>",
                type : "post",
                data : {chon:chon},
                success : function (result){
                 
                    $('#list-tinlienquan').html(result);

                }
            });
            $('#modal_dstin').modal('hide');
            // $('#displaynone1').setAttribute('display', 'none');
            document.getElementById('displaynone1').value=chon; 
          }

    });
    // dschon=chon;

  });
</script>
<style type="text/css">
.cke_contents {
    min-height: 500px;
}
.modal-dialog {
    width: 1024px !important;
}
.model_search {
    margin-top: 8px;
    float: right;
    margin-right: 30px;
}
input#fname {
    border-radius: 13px;
    background-color: #f1f0ff99;
}


</style>
<!-- <link rel="stylesheet" href="<?php base_url(); ?>style/format.css"> -->
</head>
<body class="hold-transition skin-blue sidebar-mini">