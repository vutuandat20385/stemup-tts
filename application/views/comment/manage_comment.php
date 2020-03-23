<script src="<?php echo base_url('js/search.js');?>"></script>
<script src="<?php echo base_url('js/manage_comment.js');?>"></script>
	<link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
	  	<script src="<?php echo base_url('js/select2.min.js');?>"></script>
<script>
var site_url = "<?php echo site_url()?>";
</script>
 <div class="container">
    <div class="row">
 
    <div class="col-lg-6">
	<div class="input-group">
    <input type="text" id="txtSearch" class="form-control" value="<?php echo $search ?>" name="search" onkeyup="drawsearch_rs(this,event)" placeholder="<?php echo $this->lang->line('search');?>...">
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
<div class="data_comment">		
<table class="table table-bordered">
<tr>
	<th>Post_id</th>
	<th style="min-width:40px; width:40%" >Nội dung</th>
	<th>Người tạo</th>
	<th>Ngày tạo</th>
	<th>Model</th>
	<th>Câu hỏi/Kiểm tra</th>
	<th>Thay đổi</th>
<!--<th><?php echo $this->lang->line('action');?> </th>-->
</tr>
<?php 
if(count($result)==0){
	?>
<tr>

</tr>	
	
	
	<?php
}
foreach($results as $key => $val){
?>
<tr>
 <td><?php echo $val['post_id'];?></td>
<td><?php echo $val['content'];?></td>
<td><?php echo $val['create_name'];?></td>
 <td><?php echo $val['create_date'];?></td>
<td><?php echo $val['model'];?></td>
<td><?php echo $val['name'];?></td>
<td><a href="<?php echo site_url('comment/delete_comment/'); ?>/<?= $val['post_id'];?>" class="btn btn-danger xoa"><i class="fa fa-times"></i> Delete </td>

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
	</div>
</div>
