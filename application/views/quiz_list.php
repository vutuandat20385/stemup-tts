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
<?php 
$logged_in=$this->session->userdata('logged_in');
		
			?>
   
 <h3><?php echo $title;?> ( <?php echo $number_question ?> bài kiểm tra ) </h3>
    <?php 
	if($logged_in['su']=='1'){
		?>
		<div class="row">
 
        <div class="col-lg-6">
	<div class="input-group">
    <input type="text" id="txtSearch" class="form-control" value="<?php echo $search ?>" name="search" onkeyup="search_quiz(this,event,'<?php echo site_url() ?>')" placeholder="<?php echo $this->lang->line('search');?>...">
      <span class="input-group-btn">
        <button class="btn btn-success" onclick="search_quiz1('<?php echo site_url() ?>')" ><?php echo $this->lang->line('search');?></button>
      </span>
	 
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->

  <div class="col-lg-6">
  <p style="float:right;">
  <?php 
  if($list_view=='grid'){
	  ?>
	 <a href="<?php echo site_url('quiz/index/table/'.$cid.'/'.$lid.'/'.$inserted_by.'/'.$page.'/?search='.$search);?>"><?php echo $this->lang->line('table_view');?></a>
	  <?php 
  }else{
	  ?>
	   <a href="<?php echo site_url('quiz/index/grid/'.$cid.'/'.$lid.'/'.$inserted_by.'/'.$page.'/?search='.$search);?>"><?php echo $this->lang->line('grid_view');?></a>
	  
	  <?php 
  }
  ?>
  </p>
  
  </div>
</div><!-- /.row -->

<?php 
	}
?>

  <div class="row">
 
<div class="col-md-12">
<br> 
			<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
		}
		?>	
		
		<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
		}
		?>	
					<div class="form-group">	 
					<form method="post" action="<?php echo site_url('quiz/pre_question_list/'.$cid.'/'.$lid.'/'.$inserted_by.'/0?search='.$search);?>">
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
		<?php 
  if($list_view=='table'){
	  ?>
<table class="table table-bordered">
<tr>
 <th>#</th>
<th><?php echo $this->lang->line('quiz_name');?></th>
<th><?php echo $this->lang->line('noq');?></th>
<th><?php echo $this->lang->line('inserted_by') ?></th>
<th><?php echo $this->lang->line('category_name');?> / <?php echo $this->lang->line('level_name');?></th>
<th><?php echo $this->lang->line('action');?> </th>
</tr>
<?php 
if(count($result)==0){
	?>
<tr>
 <td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
</tr>	
	
	
	<?php
}
foreach($result as $key => $val){
?>
<tr>
 <td><?php echo $val['quid'];?></td>
 <!--<td><?php echo substr(strip_tags($val['quiz_name']),0,50);?></td>-->
 <td><?php echo strip_tags($val['quiz_name']);?></td>
<td><?php echo $val['noq'];?></td>
<td><?php echo $val['first_name'].' '.$val['last_name']; ?></td>
<td><?php echo $val['category_name'];?> / <span style="font-size:12px;"><?php echo $val['level_name'];?></span></td>
 <td>
<a href="<?php echo site_url('quiz/quiz_detail/'.$val['quid']);?>" class="btn btn-success"  ><?php echo $this->lang->line('attempt');?> </a>


<?php 
if($logged_in['su']=='1'){
	?>
	<!--	<a  href="<?php echo site_url('quiz/proctor/'.$val['quid']);?>" class="btn btn-info"  ><?php echo $this->lang->line('proctor');?> </a>	-->
<a href="<?php echo site_url('quiz/edit_quiz/'.$val['quid']);?>"><img src="<?php echo base_url('images/edit.png');?>"></a>
<a href="javascript:remove_entry('quiz/remove_quiz/<?php echo $val['quid'];?>');"><img src="<?php echo base_url('images/cross.png');?>"></a>
<?php 
}
?>
</td>
</tr>

<?php 
}
?>
</table>

  <?php 
  }else{
	  ?>
	  <?php 
if(count($result)==0){
	?>
<?php echo $this->lang->line('no_record_found');?>
	<?php
}
$cc=0;
$colorcode=array(
'success',
'warning',
'info',
'danger'
);
foreach($result as $key => $val){
?>
	  
	                <!-- item -->
                <div class="col-md-4 text-center">
                    <div class="panel panel-<?php echo $colorcode[$cc];?> panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <h3 title="<?php echo strip_tags($val['quiz_name']) ?>" ><?php echo mb_substr(strip_tags($val['quiz_name']),0,50,"utf-8").'...';?></h3>
							<!--<h3><?php echo strip_tags($val['quiz_name']);?></h3> -->
                        </div>
                        <div class="panel-body text-center">
                            <p><strong><?php echo $this->lang->line('duration');?> <?php echo $val['duration'];?></strong></p>
                        </div>
                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class="fa fa-check"></i> <?php echo $this->lang->line('noq');?>:  <?php echo $val['noq'];?></li>
                            <li class="list-group-item"><i class="fa fa-check"></i> <?php echo $this->lang->line('maximum_attempts');?>: <?php echo $val['maximum_attempts'];?></li>
                            </ul>
                        <div class="panel-footer">
                         
						 
<a href="<?php echo site_url('quiz/quiz_detail/'.$val['quid']);?>" class="btn btn-success"  ><?php echo $this->lang->line('attempt');?> </a>

<?php 
if($logged_in['su']=='1'){
	?>
			<!--<a href="<?php echo site_url('quiz/proctor/'.$val['quid']);?>" class="btn btn-info"  ><?php echo $this->lang->line('proctor');?> </a>-->
<a href="<?php echo site_url('quiz/edit_quiz/'.$val['quid']);?>"><img src="<?php echo base_url('images/edit.png');?>"></a>
<a href="javascript:remove_entry('quiz/remove_quiz/<?php echo $val['quid'];?>');"><img src="<?php echo base_url('images/cross.png');?>"></a>
<?php 
}
?>


                        </div>
                    </div>
                </div>
                <!-- /item --> 
	  
	  
	  <?php 
	  if($cc >= 4){
	  $cc=0;
	  }else{
	  $cc+=1;
	  }
	  
}

  }
  ?>

</div>

</div>
<br><br>
<?php
if($page > 0){
	?><a href="<?php echo site_url('quiz/index/'.$list_view.'/'.$cid.'/'.$lid.'/'.$inserted_by.'/'.($page-1).'?search='.$search);?>"  class="btn btn-primary"><?php echo $this->lang->line('back');?></a>
	<?php
}
?>
&nbsp;&nbsp;
<?php if( 0 <= $page && $page<$last_page) 
{
	?><a href="<?php echo site_url('quiz/index/'.$list_view.'/'.$cid.'/'.$lid.'/'.$inserted_by.'/'.($page+1).'?search='.$search);?>"  class="btn btn-primary"><?php echo $this->lang->line('next');?></a>
	<?php
}
?>
<?php if($last_page > 1)
{
	?>
	<input type="number" value="<?php echo $page ?>" id='nbpage'> <button class="btn btn-primary" id="btpage">Go</button> 
	<?php
} ?>
<script>
	  document.getElementById("btpage").onclick = function () {
		p = document.getElementById("nbpage").value;
		var m ="<?php echo site_url("quiz/index/$list_view/$cid/$lid/$inserted_by")?>";
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