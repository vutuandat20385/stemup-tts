<script src="<?php echo base_url('js/search.js');?>"></script>
	<link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
	  	<script src="<?php echo base_url('js/select2.min.js');?>"></script>
	<script> 
	$(document).ready(function() {
    $('.inserted_by').select2();
	$('.lid').select2();
	$('.cid').select2();
});
	</script>
 <div class="container">

   
 <h3><?php echo $title;?> ( <?php echo $number_question ?> Câu hỏi ) </h3>
    <div class="row">
 
  <div class="col-lg-6">
	<div class="input-group">
    <input type="text" id="txtSearch" class="form-control" value="<?php echo $search ?>" name="search" onkeyup='search_qbank(this,event, "<?php echo site_url(); ?>")' placeholder="<?php echo $this->lang->line('search');?>...">
      <span class="input-group-btn">
        <button class="btn btn-success" onclick='search_qbank1("<?php echo site_url(); ?>")' ><?php echo $this->lang->line('search');?></button>
      </span>
	 
	  
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->


  <div class="row">
 
<div class="col-md-12">
<br> 

			<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
		}
		?>	
						<div class="form-group">	 
					<form method="post" action="<?php echo site_url('qbank/pre_question_list/'.$cid.'/'.$lid.'/'.$inserted_by.'/0?search='.$search);?>">
					<select   name="cid" class="col-md-3 cid">
					<option value="0"><?php echo $this->lang->line('all_category');?></option>
					<?php 
					foreach($category_list as $key => $val){
						?>
						
						<option value="<?php echo $val['cid'];?>" <?php if($val['cid']==$cid){ echo 'selected';} ?> ><?php echo $val['category_name'];?></option>
						<?php 
					}
					?>
					</select>
			 	<select  name="lid" class="col-md-3 lid">
				<option value="0"><?php echo $this->lang->line('all_level');?></option>
					<?php 
					foreach($level_list as $key => $val){
						?>
						
						<option value="<?php echo $val['lid'];?>"  <?php if($val['lid']==$lid){ echo 'selected';} ?> ><?php echo $val['level_name'];?></option>
						<?php 
					}
					?>
					</select>
					<select name="inserted_by" class=" col-md-3 inserted_by" >
				<option value="0"><?php echo $this->lang->line('select_inserted_by');?></option>
					<?php 
					foreach($inserted_by_list as $key => $val){
						?>
						
						<option value="<?php echo $val['inserted_by'];?>" <?php if($val['inserted_by']==$inserted_by){ echo 'selected';} ?> ><?php echo $val['first_name']." ".$val['last_name'];?></option>
						<?php 
					}
					?>
					</select>
					 <button class="btn btn-success" type="submit"><?php echo $this->lang->line('filter');?></button>
					 &nbsp;&nbsp;
					 </form>
			</div>
	
<table class="table table-bordered">
<tr>
 <th>#</th>
 <th><?php echo $this->lang->line('question');?></th>
<th style="width:12%"><?php echo $this->lang->line('category_name');?> / <?php echo $this->lang->line('level_name');?></th>
 
<th style="width:10%"><?php echo $this->lang->line('inserted_by') ?></th>
<th style="width:10%"><?php echo $this->lang->line('action');?> </th>

</tr>
<?php 
if(count($result)==0){
	?>
<tr>
 <td colspan="5"><?php echo $this->lang->line('no_record_found');?></td>
</tr>	
	
	
	<?php
}
foreach($result as $key => $val){
?>
<tr>
 <td>  <a href="javascript:show_question_stat('<?php echo $val['qid'];?>');">+</a>  <?php echo $val['qid'];?></td>
 <!--<td><?php echo substr(strip_tags($val['question']),0,40);?>-->
 <td><?php echo strip_tags($val['question']);?>
 
 <span style="display:none;" id="stat-<?php echo $val['qid'];?>">
  
 
 <table class="table table-bordered">
<tr><td><?php echo $this->lang->line('no_times_corrected');?></td><td><?php echo $val['no_time_corrected'];?></td></tr>
<tr><td><?php echo $this->lang->line('no_times_incorrected');?></td><td><?php echo $val['no_time_incorrected'];?></td></tr>
<tr><td><?php echo $this->lang->line('no_times_unattempted');?></td><td><?php echo $val['no_time_unattempted'];?></td></tr>

</table>


 

 </span>
 
 
 
 </td>
<td><?php echo $val['category_name'];?> / <span style="font-size:12px;"><?php echo $val['level_name'];?></span></td>
<td><?php echo $val['first_name'].' '.$val['last_name']; ?></td>
<td>
<?php 
$qn=1;
if($val['question_type']==$this->lang->line('multiple_choice_single_answer')){
	$qn=1;
}
if($val['question_type']==$this->lang->line('multiple_choice_multiple_answer')){
	$qn=2;
}
if($val['question_type']==$this->lang->line('match_the_column')){
	$qn=3;
}
if($val['question_type']==$this->lang->line('short_answer')){
	$qn=4;
}
if($val['question_type']==$this->lang->line('long_answer')){
	$qn=5;
}


?>
<a href="<?php echo site_url('qbank/edit_question_'.$qn.'/'.$val['qid']);?>"><img src="<?php echo base_url('images/edit.png');?>"></a>
<a href="javascript:remove_entry('qbank/remove_question/<?php echo $val['qid'];?>');"><img src="<?php echo base_url('images/cross.png');?>"></a>

</td>
</tr>

<?php 
}
?>
</table>
</div>

</div>


<?php
if($page > 0){
	?><a href="<?php echo site_url('qbank/index/'.$cid.'/'.$lid.'/'.$inserted_by.'/'.($page-1).'?search='.$search);?>"  class="btn btn-primary"><?php echo $this->lang->line('back');?></a>
	<?php
}
?>
&nbsp;&nbsp;

<?php if( 0 <= $page && $page<$last_page) 
{
	?><a href="<?php echo site_url('qbank/index/'.$cid.'/'.$lid.'/'.$inserted_by.'/'.($page+1).'?search='.$search);?>"  class="btn btn-primary"><?php echo $this->lang->line('next');?></a>
	<?php
}
?>
<?php if($last_page >1){
	?>
		<input type="number" value="<?php echo $page ?>" id='nbpage'> <button class="btn btn-primary" id="btpage">Go</button>
	<?php
} ?>
<script>
	  document.getElementById("btpage").onclick = function () {
		p = document.getElementById("nbpage").value;
		var m ="<?php echo site_url("qbank/index/$cid/$lid/$inserted_by")?>";
		var n="<?php echo"?search=$search"?>";
        if( 0 <= p && p <= <?php echo $last_page ?> )
		{
			location.href = m+"/"+p+n;
		} else {
			alert(" Page is incorrect ");
		}
    };
</script>


<br><br><br><br>
<!--
<div class="login-panel panel panel-default">
	<div class="panel-heading">
<h4><?php echo $this->lang->line('import_question');?></h4> 
</div>
	<div class="panel-body"> 

<?php echo form_open('qbank/import',array('enctype'=>'multipart/form-data')); ?>
  
 <select name="cid"  required >
 <option value=""><?php echo $this->lang->line('select_category');?></option>
<?php 
					foreach($category_list as $key => $val){
						?>
						
						<option value="<?php echo $val['cid'];?>" <?php if($val['cid']==$cid){ echo 'selected';} ?> ><?php echo $val['category_name'];?></option>
						<?php 
					}
					?></select>
 <select name="did"  required >
 <option value=""><?php echo $this->lang->line('select_level');?></option>
<?php 
					foreach($level_list as $key => $val){
						?>
						
						<option value="<?php echo $val['lid'];?>"  <?php if($val['lid']==$lid){ echo 'selected';} ?> ><?php echo $val['level_name'];?></option>
						<?php 
					}
					?>
					</select> 

<?php echo $this->lang->line('upload_excel');?>
	<input type="hidden" name="size" value="3500000">
	<input type="file" name="xlsfile" style="width:150px;float:left;margin-left:10px;">
	<div style="clear:both;"></div>
	<input type="submit" value="Import" style="margin-top:5px;" class="btn btn-default">
	
<a href="<?php echo base_url();?>sample/sample.xls" target="new">Click here</a> <?php echo $this->lang->line('upload_excel_info');?> 
</form>

</div>





</div>



<div class="login-panel panel panel-default">
<div class="panel-heading">
<h4><?php echo $this->lang->line('import_question2');?></h4> 
</div>
		<div class="panel-body"> 

<?php echo form_open('word_import',array('enctype'=>'multipart/form-data')); ?>
 
<div class="alert alert-danger"> <?php echo $this->lang->line('wordimportinfo');?></div>

 <select name="cid"  required >
 <option value=""><?php echo $this->lang->line('select_category');?></option>
<?php 
					foreach($category_list as $key => $val){
						?>
						
						<option value="<?php echo $val['cid'];?>" <?php if($val['cid']==$cid){ echo 'selected';} ?> ><?php echo $val['category_name'];?></option>
						<?php 
					}
					?></select>
 <select name="lid" required >
 <option value=""><?php echo $this->lang->line('select_level');?></option>
<?php 
					foreach($level_list as $key => $val){
						?>
						
						<option value="<?php echo $val['lid'];?>"  <?php if($val['lid']==$lid){ echo 'selected';} ?> ><?php echo $val['level_name'];?></option>
						<?php 
					}
					?>
					</select> 

<?php echo $this->lang->line('upload_doc');?>
	<input type="hidden" name="size" value="3500000">
	<input type="file" name="word_file" style="width:150px;float:left;margin-left:10px;">
	<div style="clear:both;"></div>
	<p style="padding:10px;"><a href="javascript:advanceconfig();"><?php echo $this->lang->line('advance_options');?></a></p>
	<div id="advanceconfig" style="padding:10px;display:none">
	<table>
	<tr><td>Question Splitter:</td><td> <input type="text" name="question_split" value="/Q:[0-9]+\)/"></td></tr>
	<tr><td>Paragraph Splitter:</td><td> <input type="text" name="paragraph_split" value="Paragraph:"></td></tr>
	<tr><td>Description Splitter: </td><td><input type="text" name="description_split" value="/Sol:/"></td></tr>
	<tr><td>Options Splitter: </td><td><input type="text" name="option_split" value="/[A-Z]:\)/"></td></tr>
	<tr><td>Correct Option Splitter: </td><td><input type="text" name="correct_split" value="/Correct:/"></td></tr>
	</table>
	</div>
	
	<input type="submit" value="Import" style="margin-top:5px;" class="btn btn-default">
	
<a href="<?php echo base_url();?>sample/sample.docx" target="new">Click here</a> <?php echo $this->lang->line('upload_doc_info');?> 
</form>

</div>



</div>
-->
<script>

function advanceconfig(){
	
	$('#advanceconfig').toggle();
	
}



</script>
<br><br><br><br>
