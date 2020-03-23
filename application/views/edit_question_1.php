<script>window.MathJax = { MathML: { extensions: ["mml3.js", "content-mathml.js"]}};</script>
<script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=MML_HTMLorMML"></script>

 <div class="container">
<?php
$lang=$this->config->item('question_lang');
?>
   
 <h3><?php echo $title;?></h3>
   
 

  <div class="row">
     <form method="post" action="<?php echo site_url('qbank/edit_question_1/'.$question['qid']);?>">
	
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

 	
			<div class="form-group col-lg-6">	 
					<label   ><?php echo $this->lang->line('select_category');?></label> 
					<select class="form-control" name="cid">
					<?php 
					foreach($category_list as $key => $val){
						?>
						
						<option value="<?php echo $val['cid'];?>"  <?php if($question['cid']==$val['cid']){ echo 'selected'; } ?> ><?php echo $val['category_name'];?></option>
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
						
						<option value="<?php echo $val['lid'];?>" <?php if($question['lid']==$val['lid']){ echo 'selected'; } ?> ><?php echo $val['level_name'];?></option>
						<?php 
					}
					?>
					</select>
			</div>

			
<?php 
if(strip_tags($question['paragraph'])!=""){
foreach($lang as $lkey =>$val){	
$lno=$lkey;
if($lkey==0){
	$lno="";
}
?>
<div class="col-lg-6">
			<div class="form-group">	 
					<label for="inputEmail"  ><?php echo $this->lang->line('paragraph').' : '.$val;?></label> 
					<textarea  name="paragraph<?php echo $lno;?>"  class="form-control"   ><?php echo $question['paragraph'.$lno];?></textarea>
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
					<textarea  name="question<?php echo $lno;?>"  class="form-control"   ><?php echo $question['question'.$lno];?></textarea>
			</div></div>
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
					<textarea  name="description<?php echo $lno;?>"  class="form-control"><?php echo $question['description'.$lno];?></textarea>
			</div>
			
			</div>		
			<?php 
}
?>
		<?php 
		foreach($options as $key => $val){
		
			?>
			<?php 
 
foreach($lang as $lkey =>$la){	
$lno=$lkey;
if($lkey==0){
	$lno="";
}
?>
			<div class="col-lg-6">
		
		
		
			<div class="form-group">	 
					<label for="inputEmail"  ><?php echo $this->lang->line('options');?> <?php echo ($key+1);?>) <?php echo ' : '.$la;?></label> <br>
					<?php 
					if($lkey==0){ 
					?><input type="radio" name="score" value="<?php echo $key;?>" <?php if($val['score']==1){ echo 'checked'; } ?> > Select Correct Option 
					<?php } ?><br>
					<textarea  name="option<?php echo $lno;?>[]"  class="form-control"  ><?php echo $val['q_option'.$lno];?></textarea>
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
	<div class="col-lg-3" style="margin-top:20px"> <input name="q_type" id="q_type_1" value="1" type="radio" > Trắc nghiệm</div>
	<div class="col-lg-3" style="margin-top:20px"> <input name="q_type" id="q_type_2" value="2" type="radio"> Video </div>
	<div class="col-lg-3" style="margin-top:20px"> <input name="q_type" id="q_type_3" value="3" type="radio"> Bài đọc </div>
				
</div>


<div class="col-lg-3" style="margin-bottom:10px">
	<div class="col-lg-8" style="margin-top:20px"><b>Chọn là MCQ Fun: </b></div>
	<div class="col-lg-4" style="margin-top:20px"> <input  id="mcq_fun_main" name="mcqfun" value="<?php if($question['fun_priory']>1) echo 1;
	      else echo 0;
	?>" type="checkbox"
	<?php 
	if($question['fun_priory']>1) echo 'checked';
	?>
	
	></div>
				
</div>
<div class="col-lg-3" style="margin-bottom:10px">
    
	<div class="col-lg-8" style="margin-top:20px"><b>Hiển thị logo:</b> </div>
	<div class="col-lg-4" style="margin-top:20px">  <input id="main_logorg" name="logorg" value="<?php echo $question['show_logo'] ?>" type="checkbox"
	<?php 
	if($question['show_logo']==1) echo 'checked';
	?>
	
	></div>
				
</div>				
		
    <div class="col-lg-12" style="margin-bottom:10px">		
	<b><?php echo $this->lang->line('tags'); ?>:</b>
		<input type="text" class="form-control" name="tags" value="<?php echo $tags;?>" required >
</div>
<div class="col-lg-3">		
	<b><?php echo $this->lang->line('answer_time(s)'); ?>:</b>
		<input type="number" class="form-control" name="answer_time" value="<?php echo $question['answer_time'];?>" required >
</div>		
<div class="col-lg-2">		
	<b>Tiết</b>
		<input type="text" class="form-control" name="unitmcq" value=<?php echo $question['unit'];?>>
</div>	
<div class="col-lg-2">		
	<b>Bài</b>
		<input type="text" class="form-control" name="lessonmcq" value="<?php echo $question['lesson'];?>">
</div>	
 <div class="col-lg-5">		
	<b>Nguồn</b>
		<input type="text" class="form-control" name="sourcemcq" value="<?php echo $question['source'];?>">
</div>	 
	<button class="btn btn-default" type="submit" style='margin-top:20px;'><?php echo $this->lang->line('submit');?></button>
 
		</div>
</div>

 
 
 
<!--</div>
      </form>
	  
	  
	  	  <div class="col-md-3">
		
		
			<div class="form-group">	 
			<table class="table table-bordered">
			<tr><td><?php echo $this->lang->line('no_times_corrected');?></td><td><?php echo $question['no_time_corrected'];?></td></tr>
			<tr><td><?php echo $this->lang->line('no_times_incorrected');?></td><td><?php echo $question['no_time_incorrected'];?></td></tr>
			<tr><td><?php echo $this->lang->line('no_times_unattempted');?></td><td><?php echo $question['no_time_unattempted'];?></td></tr>

			</table>

			</div>


	  </div>
</div>-->

 



</div>
<script>

$(document).ready(function(){
	$("#mcq_fun_main").click(function(){
		$("#mcq_fun_main").val(1-$("#mcq_fun_main").val());
	});
	$("#main_logorg").click(function(){
		$("#main_logorg").val(1-$("#main_logorg").val());
	});
	
	for(i=0; i<4; i++){
		if(i==<?php echo $question['type']?>)
			$("#q_type_"+i).prop("checked",true);

	 }
});
	
</script>