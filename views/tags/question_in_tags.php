<script src="<?php echo base_url('js/search.js');?>"></script>
<script src="<?php echo base_url('js/tags_question.js');?>"></script>
	<link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
	  	<script src="<?php echo base_url('js/select2.min.js');?>"></script>
		
<script> 
	$(document).ready(function() {
    $('.inserted_by').select2();
	$('.lid').select2();
	$('.cid').select2();
});
	</script>
<script>
var site_url = "<?php echo site_url()?>";
</script>
 <div class="container">
    <div class="row">
 
    <div class="col-lg-6">
	<div class="input-group">
    <input type="text" id="inf_search" class="form-control" value="<?php echo $search ?>" name="search" onkeyup="drawsearch_rs(this,event)" placeholder="<?php echo $this->lang->line('search');?>...">
      <span class="input-group-btn">
        <button class="btn btn-success" onclick="drawsearch_rs_btn()" ><?php echo $this->lang->line('search');?></button> 
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
					
					<select id="cid_ctg" name="cid" class="col-md-3 cid">
					<option value="0"><?php echo $this->lang->line('all_category');?></option>
					<?php 
					foreach($cat as $key => $val){
						?>
						
						<option  value="<?php echo $val['cid'];?>" ><?php echo $val['category_name'];?></option>
						<?php 
					}
					?>
					</select>
			 	<select id="lid_ctg" name="lid" class="col-md-3 lid">
				<option value="0"><?php echo $this->lang->line('all_level');?></option>
					<?php 
					foreach($lev as $key => $val){
						?>
						
						<option value="<?php echo $val['lid'];?>"  ><?php echo $val['level_name'];?></option>
						<?php 
					}
					?>
					</select>
					<select id="ind_ctg" name="inserted_by" class=" col-md-3 inserted_by" >
				<option value="0"><?php echo $this->lang->line('select_inserted_by');?></option>
					<?php 
					foreach($list as $key => $val){
						?>
						
						<option value="<?php echo $val['inserted_by'];?>" ><?php echo $val['inserted_by_name'];?></option>
						<?php 
					}
					?>
					</select>
					 <button class="btn btn-success" onclick="send_data()" type="submit"><?php echo $this->lang->line('filter');?></button>
					 
					 
	</div>
<div class="data_question">	
<table class="table table-bordered">
<tr>
	<th>#</th>
	<th>Câu hỏi</th>	
	<th>Tên danh mục</th>
	<th>Tên cấp độ</th>
	<th>Người tạo</th>
	<th>Hoạt động</th>
<!--<th><?php echo $this->lang->line('action');?> </th>-->
</tr>
<?php 
if(count($result)==0){
	?>
	
	
	
<?php
}
foreach($results as $key => $val){
?>

<tr>
<td><?php echo $val['qid'];?></td>
<td ><?php echo $val['question'];?></td>
<td><?php echo $val['category_name'];?></td>
<td><?php echo $val['level_name'];?></td>
<td><?php echo $val['inserted_by_name'];?></td>
<td>
	<a target="__blank" href="<?php echo site_url('qbank/edit_question_1/'.$val['qid']); ?>" ><i class="pointer text-warning fas fa-pencil-alt" title="Sửa" style="color: #ef00ff;"></i></a>
	<a style="margin-left:30px" href="javascript:remove_entry('qbank/remove_tag_question/<?php echo $val['qid'];?>');"><i class="pointer fas fa-trash-alt" title="Xóa"></i></a>
</td>


</tr>

<?php 
}
?>
</table>
</div>
</div>

</div>


<br><br>
<P>Đang xem <span id="beginrs"><?php echo min($limit*$page+1,$num_result);?></span> 
			  đến <span id="endrs"><?php echo min($limit*($page+1),$num_result);?></span> 
			  trong tổng số <span id="totalrs"><?php echo $num_result;?></span> kết quả<p>
	<center>
	  <ul class="pagination listpage pagers">
		<?php if($num_page>6){?>
		<li class="page-item active" onclick="drawpage_rs(0)"><a class="page-link">1</a></li>
		<li class="page-item" onclick="drawpage_rs(1)"><a class="page-link">2</a></li>
		<li class="page-item" onclick="drawpage_rs(2)"><a class="page-link">3</a></li>
		<li class="page-item" onclick="drawpage_rs(3)"><a class="page-link">4</a></li>
		<li class="page-item" onclick="drawpage_rs(4)"><a class="page-link">5</a></li>
		  <?php if($num_page>7){ ?>
		  <li class="page-item"><a class="page-link">...</a></li>
		  <?php } ?>
		  <li class="page-item" onclick="drawpage_rs(<?php  echo $num_page-1 ?>)"><a class="page-link"><?php echo $num_page ?></a></li>
		<?php }else{?>
		  <li class="page-item active" onclick="drawpage_rs(0)"><a class="page-link">1</a></li>
		  <?php for($i=1; $i<$num_page; $i++){?>
			<li class="page-item" onclick="drawpage_rs(<?php  echo $i ?>)"><a class="page-link"><?php  echo $i+1 ?></a></li>
		  <?php }?>
		<?php }?>
		
	  </ul>
	</center>
	<div style="display:none">
	  <input type="text" id="inf_search" value="">
	  <input type="text" id="inf_page" value="0">
	  <input type="text" id="inf_limit" value="10">
	  <input type="text" id="inf_tag_id" value="<?php echo $val['tag_id'];?>">
	  <!--<input type="text" id="inf_cid" value="0">
	  <input type="text" id="inf_lid" value="0">
	  <input type="text" id="inf_inserted_by" value="0">-->
	</div>
</div>
