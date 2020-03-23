 <div class="container">
<?php
$lang=$this->config->item('question_lang');
?>
   
 <h3><?php echo $title;?></h3>
   
 

  <div class="row">
     <form method="post"  id="qf" action="<?php echo site_url('qbank/new_question_01/'.$nop.'/'.$para);?>">
	
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
?>	<div class="col-lg-6">		
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
}
?>
			<div class="col-lg-6">
			<div class="form-group">	 
					<label for="inputEmail"  ><?php echo $this->lang->line('options');?> <?php echo $i;?>) <?php echo ' : '.$val;?></label> <br>
				<?php 
if($lkey==0){
?>	<input type="radio" name="score" value="<?php echo $i-1;?>" <?php if($i==1){ echo 'checked'; } ?> > Chọn đáp án đúng
<?php }else{ ?>  <?php } 
?>			<br><textarea  name="option<?php echo $lno;?>[]"  class="form-control"   ></textarea>
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
?>	<button class="btn btn-default" type="button" onClick="javascript:parags();"><?php echo $this->lang->line('submit&add');?></button>
<?php } ?>
 
		</div>
</div>
 
 
 
 
</div>
      </form>
</div>



 



</div>
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
