<script src="<?php echo base_url('js/search.js');?>"></script>
	<link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
	  	<script src="<?php echo base_url('js/select2.min.js');?>"></script>
<div class="container">
<?php 
$logged_in=$this->session->userdata('logged_in');
?>
   
  

<?php 
if($logged_in['su']=='1'){
	?>
   <div class="row">
 
  <div class="col-lg-12">
  <!--
    <form method="post" action="<?php echo site_url('result/generate_report/');?>">
	<div class="input-group">
    <h3><?php echo $this->lang->line('generate_report');?> </h3> 
<select name="quid">
<option value="0"><?php echo $this->lang->line('select_quiz');?></option>
<?php 
foreach($quiz_list as $qk => $quiz){
	?>
	<option value="<?php echo $quiz['quid'];?>"><?php echo $quiz['quiz_name'];?></option>
	<?php 
}
?>
</select>
 	
<select name="gid">
<option value="0"><?php echo $this->lang->line('select_group');?></option>
<?php 
foreach($group_list as $gk => $group){
	?>
	<option value="<?php echo $group['gid'];?>"><?php echo $group['group_name'];?></option>
	<?php 
}
?>
</select>
<input type="text" name="date1" value="" placeholder="<?php echo $this->lang->line('date_from');?>">
 
 <input type="text" name="date2" value="" placeholder="<?php echo $this->lang->line('date_to');?>">

 <button class="btn btn-info" type="submit"><?php echo $this->lang->line('generate_report');?></button>	
    </div><!-- /input-group -->
	 </form>
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->

<?php 
}
?>


<h3><?php echo $title;?> ( <?php echo $number_result ?> kết quả ) </h3>
 
  <div class="row">
 
  <div class="col-lg-6">
	<div class="input-group">
    <input type="text" id="txtSearch" class="form-control" value="<?php echo $search ?>" name="search" onkeyup="search_result(this,event,'<?php echo site_url() ?>')" placeholder="<?php echo $this->lang->line('search');?>...">
      <span class="input-group-btn">
        <button class="btn btn-success" onclick="search_result1('<?php echo site_url() ?>')" ><?php echo $this->lang->line('search');?></button>
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
		<?php 
		if($logged_in['su']=='1'){
			?>
				<div class='alert alert-danger'><?php echo $this->lang->line('pending_message_admin');?></div>		
		<?php 
		}
		?>
<table class="table table-bordered">
<tr>
 <th><?php echo $this->lang->line('result_id');?></th>
<th style="width:16%"><?php echo $this->lang->line('first_name');?> <?php echo $this->lang->line('last_name');?></th>
 <th><?php echo $this->lang->line('quiz_name');?></th>
 <th style="width:10%"><?php echo $this->lang->line('status');?>
 <select onchange="fitter_status(this.value,<?php echo $s ?>);">
 <option value="0"><?php echo $this->lang->line('all');?></option>
 <option value="1" <?php if($status==1){ echo 'selected'; } ?> ><?php echo $this->lang->line('pass');?></option>
 <option value="2" <?php if($status==2){ echo 'selected'; } ?> ><?php echo $this->lang->line('fail');?></option>
 <option value="3" <?php if($status==3){ echo 'selected'; } ?> ><?php echo $this->lang->line('pending');?></option>
 </select>
 </th>
 <th><?php echo $this->lang->line('percentage_obtained');?></th>
<th><?php echo $this->lang->line('action');?> </th>
</tr>
<?php 
if(count($result)==0){
	?>
<tr>
 <td colspan="6"><?php echo $this->lang->line('no_record_found');?></td>
</tr>	
	
	
	<?php
}

foreach($result as $key => $val){
?>
<tr>
 <td><?php echo $val['rid'];?></td>
<td><?php echo $val['first_name'];?> <?php echo $val['last_name'];?></td>
 <td><?php echo $val['quiz_name'];?></td>
 <td><?php echo $val['result_status'];?></td>
 <td><?php echo $val['percentage_obtained'];?>%</td>
<td>
<a href="<?php echo site_url('result/view_result/'.$val['rid']);?>" class="btn btn-success" ><?php echo $this->lang->line('view');?> </a>
<?php 
if($logged_in['su']=='1'){
	?>
	<a href="javascript:remove_entry('result/remove_result/<?php echo $val['rid'];?>');"><img src="<?php echo base_url('images/cross.png');?>"></a>
<?php 
}
?>
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
	?><a href="<?php echo site_url('result/index/'.$status.'/'.($page-1).'?search='.$search);?>"  class="btn btn-primary"><?php echo $this->lang->line('back');?></a>
	<?php
}
?>
&nbsp;&nbsp;
<?php
 $next=$limit+($this->config->item('number_of_rows'));  ?>

<?php if( 0 <= $page && $page<$last_page) 
{
	?><a href="<?php echo site_url('result/index/'.$status.'/'.($page+1).'?search='.$search);?>"  class="btn btn-primary"><?php echo $this->lang->line('next');?></a>
	<?php
}
?>



&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--
<a href="<?php echo site_url('result/remove_result/0/1');?>"  class="btn btn-primary"><?php echo $this->lang->line('cancel');?> <?php echo $this->lang->line('open');?></a>

-->
<?php if($last_page >1){
	?>
		<input type="number" value="<?php echo $page ?>" id='nbpage'> <button class="btn btn-primary" id="btpage">Go</button>
	<?php
} ?>
<script>
	  document.getElementById("btpage").onclick = function () {
		p = document.getElementById("nbpage").value;
		var m ="<?php echo site_url("result/index/$status/")?>";
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
