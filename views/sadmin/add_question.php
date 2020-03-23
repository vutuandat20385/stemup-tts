
<?php
$this->load->view("sadmin/head")
?>
<!-- <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script> -->
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
<link href="<?php echo base_url('css/style.css');?>" rel="stylesheet">
<link href="<?php echo base_url('font-awesome/css/font-awesome.css');?>" rel="stylesheet">
<link rel="manifest" href="<?php echo base_url('js/manifest.json');?>">
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('js/Chart.bundle.min.js');?>"></script>
<script src="<?php echo base_url('js/jquery.js');?>"></script>
<script>
 var base_url="<?php echo base_url();?>";
</script>
<?php
if(($this->uri->segment(1).'/'.$this->uri->segment(2))!='quiz/attempt'){
 ?>
 <script src="<?php echo base_url('js/basic.js');?>"></script>
 <script src="<?php echo base_url('js/data.js');?>"></script>
 <?php
}
?> 
<style>
  html,body,h1,h2,h3,h4,p,div,span{
    direction: <?php echo $this->config->item('direction');?>;
  }
</style>
<div class="wrapper">
  <?php
  $this->load->view("sadmin/header") 
  ?>
  <!-- left menu -->
  <aside class="main-sidebar">
    <?php $this->load->view('sadmin/leftmenu'); ?>
  </aside>
  <!-- Main content -->
  <div class="content-wrapper">
    <section class="row">
      <aside  class="col-md-12" >
        <div class="col-md-12">
          <?php
          $lang=$this->config->item('question_lang');
          ?>
          <h3 style="margin-left: 15px">Thêm mới câu hỏi</h3>
          <form method="post"  id="qf" action="<?php echo site_url('sadmin/add_question/'.$nop.'/'.$para);?>">
            <div class="col-md-12">
              <div class="login-panel panel panel-default">
                <div class="panel-body"> 
                  <?php 
                  if($this->session->flashdata('message')){
                    echo $this->session->flashdata('message'); 
                  } ?> 

                  <div class="form-group">  
                    <?php echo $this->lang->line('multiple_choice_single_answer');?>
                  </div>
                  <div class="form-group col-lg-6" >  
                    <label   ><?php echo $this->lang->line('select_category');?></label> 
                    <select class="form-control" name="cid">
                      <?php foreach($category_list as $key => $val)
                      { ?>
                        <option value="<?php echo $val['cid'];?>"><?php echo $val['category_name'];?></option>
                        <?php 
                      } ?>
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
                      } ?>
                    </select>
                  </div>

                  <?php 
                  if($para==1){
                    foreach($lang as $lkey =>$val){  
                      $lno=$lkey;
                      if($lkey==0){
                        $lno="";
                      } ?>
                      <div class="col-lg-6">
                        <div class="form-group">  
                          <label for="inputEmail"  ><?php echo $this->lang->line('paragraph').' : '.$val;?></label> 
                          <textarea  name="paragraph<?php echo $lno;?>"  class="form-control">
                            <?php if(isset($qp)){ echo $qp['paragraph'.$lno]; } ?>
                          </textarea>
                        </div>
                      </div>       
                    <?php }
                  } ?>  

                  <?php 
                  foreach($lang as $lkey =>$val){ 
                    $lno=$lkey;
                    if($lkey==0){
                      $lno="";
                    } ?>
                    <div class="col-lg-6">
                      <div class="form-group">   
                        <label for="inputEmail"><?php echo $this->lang->line('question').' : '.$val;?></label> 
                        <textarea name="question<?php echo $lno;?>"  class="form-control"> </textarea>
                      </div>
                    </div>

                    <?php 
                  }
                  foreach($lang as $lkey =>$val){ 
                    $lno=$lkey;
                    if($lkey==0){
                      $lno="";
                    }
                    ?>  
                    <div class="col-lg-6">    
                      <div class="form-group">   
                        <label for="inputEmail"  ><?php echo $this->lang->line('description').' : '.$val;?></label> 
                        <textarea  name="description<?php echo $lno;?>"  class="form-control"></textarea>
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
                      } ?>
                      <div class="col-lg-6">
                        <div class="form-group">  
                          <label for="inputEmail"><?php echo $this->lang->line('options');?> <?php echo $i;?>) <?php echo ' : '.$val;?></label> 
                          <br>
                          <?php 
                          if($lkey==0){
                            ?><input type="radio" name="score" value="<?php echo $i-1;?>" <?php if($i==1){ echo 'checked'; } ?> > Chọn đáp án đúng
                          <?php }else{ ?>  <?php } 
                          ?> <br><textarea  name="option<?php echo $lno;?>[]"  class="form-control"></textarea>
                        </div>
                      </div>
                      <?php
                    } ?>
                    <?php   
                  } ?>

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
                </div>
                <button class="btn btn-default" style="margin-top: 0px;margin-left: 975px;margin-bottom: 6px;" type="submit"><?php echo $this->lang->line('submit');?></button>
                <?php 
                if($para==1){?>  
                  <button class="btn btn-default" type="button" onClick="javascript:parags();"><?php echo $this->lang->line('submit&add');?></button>
                <?php } ?>
              </div>
            </div>
          </form>
        </div>
      </aside>
    </section>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
</div>
</body>
<?php
$this->load->view("sadmin/foot")
?>
</html>

<?php $this->load->view('footer');?>
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
