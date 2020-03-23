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

   
 <h3><?php echo $title;?></h3>
  <a href="<?php echo site_url('quiz/edit_quiz/'.$quid);?>" class="btn btn-info"  ><?php echo $this->lang->line('close');?></a><br><br>
  <div class="row">
 
  
  <div class="col-lg-6">
	<div class="input-group">
    <input type="text" id="txtSearch" class="form-control" value="<?php echo $search ?>" name="search" onkeyup="search_question_into_quiz(this,event,'<?php echo site_url() ?>')" placeholder="<?php echo $this->lang->line('search');?>...">
      <span class="input-group-btn">
        <button class="btn btn-success" onclick="search_question_into_quiz1('<?php echo site_url() ?>')" ><?php echo $this->lang->line('search');?></button>
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
		<input type="hidden" id="added" value="<?php echo $this->lang->line('added');?>">
				
					<div class="form-group">	 
					<form method="post" action="<?php echo site_url('quiz/pre_add_question/'.$quid.'/'.$limit.'/'.$cid.'/'.$lid.'/0?search='.$search);?>">
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
					 <?php echo $number_question ?> Câu hỏi 
					
					 </form>
			</div>

	
	
	
<table class="table table-bordered">
<tr>
 <th>#</th>
 <th><?php echo $this->lang->line('question');?></th>
<th><?php echo $this->lang->line('category_name');?> / <?php echo $this->lang->line('level_name');?></th>
<th> <?php  echo $this->lang->line('inserted_by') ?></th>
<th><?php echo $this->lang->line('action');?> </th>
</tr>
<?php 
if(count($result)==0){
	?>
<tr>
 <td colspan="7"><?php echo $this->lang->line('no_record_found');?></td>
</tr>	
	
	
	<?php
}
foreach($result as $key => $val){
?>
<tr>
 <td>  <a href="javascript:show_question_stat('<?php echo $val['qid'];?>');">+</a>   <?php echo $val['qid'];?></td>
 <td><?php echo $val['question'];?>
 
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
 
<a href="javascript:addquestion('<?php echo $quid;?>','<?php echo $val['qid'];?>');" class="btn btn-primary" id='q<?php echo $val['qid'];?>'>
<?php 
if(in_array($val['qid'],explode(',',$quiz['qids']))){
	 echo $this->lang->line('added'); 
}else{
  echo $this->lang->line('add');
}
?>
</a> 


</td>
</tr>

<?php 
}
?>
</table>
</div>

</div>


<?php
if(($limit-($this->config->item('number_of_rows')))>=0){ $back=$limit-($this->config->item('number_of_rows')); }else{ $back='0'; } ?>

<?php if($page > 0){ ?>
<a href="<?php echo site_url('quiz/add_question/'.$quid.'/'.$cid.'/'.$lid.'/'.$inserted_by.'/'.($page-1).'?search='.$search);?>"  class="btn btn-primary"><?php echo $this->lang->line('back');?></a>
<?php 
	} 
?>
&nbsp;&nbsp;
<?php
 $next=$limit+($this->config->item('number_of_rows'));  ?>
<?php if( 0 <= $page && $page<$last_page){
	?>
	 <a href="<?php echo site_url('quiz/add_question/'.$quid.'/'.$cid.'/'.$lid.'/'.$inserted_by.'/'.($page+1).'?search='.$search);?>"  class="btn btn-primary"><?php echo $this->lang->line('next');?></a>
	<?php
	}
	?>
<?php if($last_page > 1){
	?>
		<input type="number" value="<?php echo $page ?>" id='nbpage'> <button class="btn btn-primary" id="btpage">Go</button>
	<?php
} ?>
<script>
	  document.getElementById("btpage").onclick = function () {
		p = document.getElementById("nbpage").value;
		var m ="<?php echo site_url("quiz/add_question/$quid/$cid/$lid/$inserted_by/")?>";
		var n="<?php echo"?search=$search"?>";
		if( 0 <= p && p <= <?php echo $last_page ?> )
		{
			location.href = m+"/"+p+n;
		} else {
			alert(" Page is incorrect ");
		}
    };
</script>
</div>