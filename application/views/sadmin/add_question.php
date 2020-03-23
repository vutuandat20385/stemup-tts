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

   <link rel="stylesheet" href="<?php echo base_url('css/style-sadmin.css')?>">
   <!-- Google Font -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
   <script src="<?php echo base_url('js/create_quiz_stemup.js') ?>"></script>
   <script src="<?php echo base_url('js/new_stemup.js')  ?>"></script>

 </head>
  <style>
    html,body,h1,h2,h3,h4,p,div,span{
      direction: <?php echo $this->config->item('direction');?>;
    }
  </style>

  <!-- <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script> -->
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">

  <!-- bootstrap css -->
  <!-- <link href="<?php// echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet"> -->

  <!-- custom css -->
  <link href="<?php echo base_url('css/style.css');?>" rel="stylesheet">

  <script>

   var base_url="<?php echo base_url();?>";

 </script>

 <!-- jquery -->
 <script src="<?php echo base_url('js/jquery.js');?>"></script>

 <?php
 if(($this->uri->segment(1).'/'.$this->uri->segment(2))!='quiz/attempt'){
   ?>
   <!-- custom javascript -->
   <script src="<?php echo base_url('js/basic.js');?>"></script>
   <script src="<?php echo base_url('js/data.js');?>"></script>
   <?php
 }
 ?> 
 <!-- bootstrap js -->
 <!-- <script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script> -->

 <!-- fontawesome css -->
 <link href="<?php echo base_url('font-awesome/css/font-awesome.css');?>" rel="stylesheet">

 <!-- chartjs -->
 <script src="<?php echo base_url('js/Chart.bundle.min.js');?>"></script>

 <!-- firebase messaging menifest.json -->
 <link rel="manifest" href="<?php echo base_url('js/manifest.json');?>">

<script type="text/javascript">
  tinymce.init({
    selector: '#ta01',
    skin: 'dark',
    width: 600,
    height: 300,
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table directionality emoticons template paste'
    ],
    content_css: 'css/content.css',
    toolbar: 'insertfile undo redo '
  });
  </script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php $this->load->view('sadmin/header'); ?>
    <aside class="main-sidebar">
      <?php $this->load->view('sadmin/leftmenu'); ?>
    </aside>
    <?php
    $lang=$this->config->item('question_lang');
    ?>
   
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
      <h3>Thêm mới câu hỏi</h3>
      <form method="post"  id="qf" action="<?php echo site_url('sadmin/add_question/'.$nop.'/'.$para);?>">
 </section>
 <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
        <div class="col-md-12">
          <br> 
          <div class="login-panel panel panel-default">
            <div class="panel-body"> 

              <?php 
              if($this->session->flashdata('message')){
                echo $this->session->flashdata('message');  
              }
              ?>  

              <div class="form-group">   

                <?php echo $this->lang->line('multiple_choice_single_answer');?>
              </div>

              <div class="form-group col-lg-6" >   
                <label   ><?php echo $this->lang->line('select_category');?></label> 
                <select class="form-control" name="cid">
                  <?php 
                  foreach($category_list as $key => $val){
                    ?>

                    <option value="<?php echo $val['cid'];?>"><?php echo $val['category_name'];?></option>
                    <?php 
                  }
                  ?>
                </select>
              </div>

              <div class="form-group col-lg-6">  
                <label   ><?php echo $this->lang->line('select_level');?></label> 
                <select class="form-control" name="lid">
                  <?php 
                  foreach($level_list as $key => $val){
                    ?>

                    <option value="<?php echo $val['lid'];?>"><?php echo $val['level_name'];?></option>
                    <?php 
                  }
                  ?>
                </select>
              </div>

              <?php 
              if($para==1){
                foreach($lang as $lkey =>$val){ 
                  $lno=$lkey;
                  if($lkey==0){
                    $lno="";
                  }
                  ?>
                  <div class="col-lg-6">
                    <div class="form-group">   
                      <label for="inputEmail"  ><?php echo $this->lang->line('paragraph').' : '.$val;?></label> 
                      <textarea  name="paragraph<?php echo $lno;?>"  class="form-control"   ><?php
                      if(isset($qp)){ echo $qp['paragraph'.$lno]; } ?></textarea>
                    </div>
                  </div>       

                  <?php
                }
              } 
              ?>      

              <?php 

              foreach($lang as $lkey =>$val){ 
                $lno=$lkey;
                if($lkey==0){
                  $lno="";
                }
                ?>
                <div class="col-lg-6">
                  <div class="form-group">   
                    <label for="inputEmail"  ><?php echo $this->lang->line('question').' : '.$val;?></label> 
                    <textarea  name="question<?php echo $lno;?>"  class="form-control"   ></textarea>
                  </div>
                </div>

                <?php 
              }
              foreach($lang as $lkey =>$val){ 
                $lno=$lkey;
                if($lkey==0){
                  $lno="";
                }
                ?>  <div class="col-lg-6">    
                  <div class="form-group">   
                    <label for="inputEmail"  ><?php echo $this->lang->line('description').' : '.$val;?></label> 
                    <textarea  id="ta01" name="description<?php echo $lno;?>"  class="form-control"></textarea>
                  </div>
                </div>  
                <?php 
              }
              ?>
              <?php 
              for($i=1; $i<=$nop; $i++){
                ?>

                <?php 

                foreach($lang as $lkey =>$val){ 
                  $lno=$lkey;
                  if($lkey==0){
                    $lno="";
                  }
                  ?>
                  <div class="col-lg-6">
                    <div class="form-group">   
                      <label for="inputEmail"  ><?php echo $this->lang->line('options');?> <?php echo $i;?>) <?php echo ' : '.$val;?></label> <br>
  <?php 
  if($lkey==0){
    ?>  <input type="radio" name="score" value="<?php echo $i-1;?>" <?php if($i==1){ echo 'checked'; } ?> > Chọn đáp án đúng
  <?php }else{ ?>  <?php } 
  ?>      <br><textarea  name="option<?php echo $lno;?>[]"  class="form-control"   ></textarea>
</div>
</div>
<?php
} 
?>


<?php   
}
?>




<div class="col-lg-6" style="margin-bottom:10px">
  <div class="col-lg-3" style="margin-top:20px"> <b  style="margin-top:20px">Dạng câu hỏi: </b></div>
  <div class="col-lg-3" style="margin-top:20px"> <input name="q_type" value="1" type="radio"> Trắc nghiệm</div>
  <div class="col-lg-3" style="margin-top:20px"> <input name="q_type" value="2" type="radio"> Video </div>
  <div class="col-lg-3" style="margin-top:20px"> <input name="q_type" value="3" type="radio"> Bài đọc </div>

</div>  
<div class="col-lg-3" style="margin-bottom:10px">
  <div class="col-lg-8" style="margin-top:20px"><b>Chọn là MCQ Fun: </b></div>
  <div class="col-lg-4" style="margin-top:20px"> <input  id="mcq_fun_main" name="mcqfun" value="0" type="checkbox"></div>

</div>
<div class="col-lg-3" style="margin-bottom:10px">

  <div class="col-lg-8" style="margin-top:20px"><b>Hiển thị logo:</b> </div>
  <div class="col-lg-4" style="margin-top:20px">  <input id="main_logorg" name="logorg" value="0" type="checkbox"></div>

</div>        

<div class="col-lg-12" style="margin-bottom:10px">    
  <b><?php echo $this->lang->line('tags'); ?>:</b>
  <input type="text" class="form-control" name="tags" value="" required >
</div>   
<div class="col-lg-3">    
  <b><?php echo $this->lang->line('answer_time(s)'); ?>:</b>
  <input type="number" class="form-control" name="answer_time" value="60" required >
</div>
<div class="col-lg-2">    
  <b>Tiết</b>
  <input type="text" class="form-control" name="unitmcq" >
</div>  
<div class="col-lg-2">    
  <b>Bài</b>
  <input type="text" class="form-control" name="lessonmcq">
</div>
<div class="col-lg-5">    
  <b>Nguồn</b>
  <input type="text" class="form-control" name="sourcemcq">
</div>  
<input type="hidden" name="parag" id="parag" value="0">
<button class="btn btn-default" style="margin-top:20px;" type="submit"><?php echo $this->lang->line('submit');?></button>
<?php 
if($para==1){
  ?>  <button class="btn btn-default" type="button" onClick="javascript:parags();"><?php echo $this->lang->line('submit&add');?></button>
<?php } ?>

</div>
</div>




</div>
</form>
</div>
</div>
</html>
<footer class=" col-xs-12 footer2">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
       <strong>Copyright &copy; 2019 <a href="http://dtt.vn">Công ty cổ phần công nghệ DTT</a>.</strong>
    </footer>
<?php $this->load->view('footer');?>
<?php $this->load->view('sadmin/foot');?>
<script>
  $(document).ready(function(){
    $("#mcq_fun_main").click(function(){
      $("#mcq_fun_main").val(1-$("#mcq_fun_main").val());
    });
    $("#main_logorg").click(function(){
      $("#main_logorg").val(1-$("#main_logorg").val());
    });
  });
  function parags(){
    $('#parag').val('1');
    $('#qf').submit(); 
  }

</script>
