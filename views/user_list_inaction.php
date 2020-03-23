<script src="<?php echo base_url('js/search.js');?>"></script>
	<link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
	  	<script src="<?php echo base_url('js/select2.min.js');?>"></script>
 <div class="container">
 <h3> Danh sách người dùng không hoạt động ( <?php echo $number_users  ?> bản ghi ) </h3>
    <div class="row">
 
    <div class="col-lg-6">
	<div class="input-group">
    <input type="text" id="txtSearch" class="form-control" value="<?php echo $search ?>" name="search" onkeyup="search_user(this,event,'<?php echo site_url('user/')?>')" placeholder="<?php echo $this->lang->line('search');?>...">
      <span class="input-group-btn">
        <button class="btn btn-success" onclick="search_user1('<?php echo site_url('user/'); ?>')" ><?php echo $this->lang->line('search');?></button> 
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
<table class="table table-bordered">
<tr>
 <th>#</th>
 <th><?php echo $this->lang->line('email');?></th>
<th><?php echo $this->lang->line('first_name');?> <?php echo $this->lang->line('last_name');?></th>
<th><?php echo $this->lang->line('account_status');?> </th>
<th><?php echo $this->lang->line('send_notification');?> </th>
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
 <td><?php echo $val['uid'];?></td>
<td><?php echo $val['email'].' '.$val['wp_user'];?></td>
<td><?php echo $val['first_name'];?> <?php echo $val['last_name'];?></td>
 <td><?php echo $val['user_status'];?></td>
 <td><a href="<?php echo site_url('notification/add_new/'.$val['uid']);?>"><?php echo $this->lang->line('send_notification');?></a></td>
<td>
 
<a href="<?php echo site_url('user2/view_user/'.$val['uid']);?>"><i class="fa fa-eye" title="View Profile"></i></a>
 
<a href="<?php echo site_url('user/edit_user/'.$val['uid']);?>"><img src="<?php echo base_url('images/edit.png');?>"></a>
<a href="javascript:remove_entry('user/remove_user/<?php echo $val['uid'];?>');"><img src="<?php echo base_url('images/cross.png');?>"></a>

</td>
</tr>

<?php 
}
?>
</table>
</div>

</div>


<br><br>
<?php
if($page > 0){
	?><a href="<?php echo site_url('user/'.$url.'/'.($page-1).'?search='.$search);?>"  class="btn btn-primary"><?php echo $this->lang->line('back');?></a>
	<?php
}
?>
&nbsp;&nbsp;
<?php if( 0 <= $page && $page<$last_page) 
{
	?><a href="<?php echo site_url('user/'.$url.'/'.($page+1).'?search='.$search);?>"  class="btn btn-primary"><?php echo $this->lang->line('next');?></a>
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
		var m ="<?php echo site_url("user/$url/")?>";
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
