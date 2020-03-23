<script src="<?php echo base_url('js/search.js');?>"></script>
<script src="<?php echo base_url('js/tags.js');?>"></script>
<script src="<?php echo base_url('js/merge_tag.js');?>"></script>
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
	<br>
	<select id="merge_" style="width:50%" name="" class="form-control">
		<option>Lựa chọn</option>
		<option data-toggle="modal" data-target="#myModal" >Merge thẻ</option>
		<option>Sửa đổi</option>
		
	</select>
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
<div class="data_tags">		
<table class="table table-bordered">
<tr>
	<th>Actions</th>
	<th>ID</th>
	<th>Tags_name</th>	
	<th>Num question</th>
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
<td style="width:13%">
	<input class="merge_all_tags" type="checkbox" value="<?php echo $val['tag_id'];?>" title="Merge"></i></input>
	<a style="margin-left:30px" id="tag_edit_<?php echo $val['tag_id'];?>" onclick="edit_tags(<?php echo $val['tag_id'];?>)"> <i class="pointer text-warning fas fa-pencil-alt" title="Sửa" style="color: #ef00ff;"></i></a>
	<a style="margin-left:30px" onclick="delete_tags(<?php echo $val['tag_id'];?>)"><i class="pointer fas fa-trash-alt" title="Xóa"></i></a>
</td>
<td id="tagid_<?php echo $val['tag_id'];?>"><?php echo $val['tag_id'];?></td>
<td id="tagname_<?php echo $val['tag_id'];?>"><a href="<?php echo site_url('tags/question/'.$val['tag_id']); ?>"><?php echo $val['tag_name'];?></td>
<td><?php echo $val['num_question'];?></td>

<!--<td><a href="<?php echo site_url('comment/delete_comment/'); ?>/<?= $val['post_id'];?>" class="btn btn-danger xoa"><i class="fa fa-times"></i> Delete </td>-->

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
	<div class="modal fade" id="myModal" role="dialog">
    
	
	<!-- postup -->
	<div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nội dung thẻ</h4>
        </div>
        <div class="modal-body">
          <input type="text" id="tag_content" class="form-control" placeholder="Nội dung"></input>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="merge_post()" class="btn btn-success" data-dismiss="modal">Xác nhận</button>
        </div>
      </div>
      
    </div> <!-- end postup -->
  </div>
  
</div>
</div>
