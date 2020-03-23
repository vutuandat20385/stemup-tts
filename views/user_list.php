<script src="<?php echo base_url('js/search.js');?>"></script>
	<link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
	  	<script src="<?php echo base_url('js/select2.min.js');?>"></script>
		<script src="<?php echo base_url('js/user_list.js');?>"></script>
 <div class="container">
 <h3><?php echo $title;?> ( <?php echo $number_users  ?> người dùng) </h3>
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
 <th>Tên đăng nhập</th>
<th><?php echo $this->lang->line('first_name');?> <?php echo $this->lang->line('last_name');?></th>
<th>Email liên hệ</th>
<th><?php echo $this->lang->line('account_status');?> </th>
<th>Xác thực email</th>
<!--<th><?php echo $this->lang->line('action');?> </th>-->
<th>Add school</th>
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
<td><?php echo $val['email2'];?></td>
 <td><?php echo $val['user_status'];?></td>

<!--<td>
 
<a href="<?php echo site_url('user2/view_user/'.$val['uid']);?>"><i class="fa fa-eye" title="View Profile"></i></a>
 
<a href="<?php echo site_url('user/edit_user/'.$val['uid']);?>"><img src="<?php echo base_url('images/edit.png');?>"></a>
<a href="javascript:remove_entry('user/remove_user/<?php echo $val['uid'];?>');"><img src="<?php echo base_url('images/cross.png');?>"></a>

</td>-->
<td>
<span class="auth_email">
<?php if($val['auth_email']==0) { ?><i class="fas fa-times text-danger" style="font-size:20px"></i>
<?php } else { ?> <i class="fas fa-check text-success" style="font-size:20px"></i> 
<?php } ?>
</span>
<button class="btn btn-info" style="float:right" onclick="change_auth_status(<?php echo $val['uid'];?>, this)">Thay đổi</button>

</td >
<td style="width:5%"><a data-toggle="modal" data-target="#add_school" class="add_school"><i class="pointer text-warning fas fa-pencil-alt" title="Thêm" style="color: green;" onclick="user_addschool(<?php echo $val['uid'];?>)"></i></td>
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
	
	function change_auth_status(uid, event){
		$.ajax({
			type: 'POST',
			url:  "<?php echo site_url(); ?>/user/change_auth_status/"+uid,
			data: {},
			contentType: 'application/json',
			success: function (data) {
                if(data==1){
					$(event).parent().find(".auth_email").empty();
					$(event).parent().find(".auth_email").append('<i class="fas fa-check text-success" style="font-size:20px"></i> ');
				}
				else if(data==0){
					$(event).parent().find(".auth_email").empty();
					$(event).parent().find(".auth_email").append('<i class="fas fa-times text-danger" style="font-size:20px"></i> ');
					
				}
			},
			error: function (data) {
				console.log(data);
			}
		})
	}
</script>
<div class="modal fade" id="add_school" role="dialog">
	<div class="modal-dialog">	 
		 <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Thêm,chỉnh sửa trường</h4>
			</div>
			<div class="modal-body">
					 <tr>
									<span id="truong_"><td style="padding:10px">Trường:</td></span>
									<td style="padding:10px">
										<div id="scl"><?php echo $school ?></div>
										<div id="scl_change" style="display:none" class="col-md-12 col-xs-12" >
										   <div class="col-md-4 col-xs-12">
											    <select class="form-control" name="scl_tinhthanh_id" id="scl_tinhthanh_id" onchange="changeDataSchool(event);">
													<option selected> ----Chọn tỉnh/ thành phố----</option>
													
													<?php
														foreach ($tinhthanh as $key => $val) {
															if($val['did']){ 
													?>
														
															<option value="<?php echo $val['did'];?>" ><?php echo $val['dataitem_name'];?></option>
													<?php } else{ ?>
															
															<option value="<?php echo $val['did'];?>"><?php echo $val['dataitem_name'];?></option>
													<?php }}?>
												</select>
											</div>
											<div class="col-md-4 col-xs-12">
												<select class="form-control" name="scl_quanhuyen_id" id="scl_quanhuyen_id" onchange="changeDataSchool1(event)"></select>
											</div>
											<div class="col-md-4 col-xs-12">
												<select class="form-control" name="scl_school_id" id="scl_school_id" onchange=""></select>
											</div>
											<!--<div class="col-md-4 col-xs-12">
												<select class="form-control" name="xaphuong_id" id="scl_xaphuong_id" onchange="changeDataSchool(event);"></select>
											</div>-->
										</div>
									</td>
								 </tr>
					  <!--<button  id="add_school" class="btn btn-primary" style="margin-left:30px">Xác nhận</button>-->
								<br><br>
								<p id="errorr" style="color:red" ></p>
			</div>
			<div class="modal-footer">
			  <span id="chinhsua">
			  <button  type="button" onclick="edit_school(<?php echo $val['uid'];?>)" class="btn btn-primary" data-dismiss="modal">Chỉnh sửa</button>
			  </span>
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		 </div>
		  
	</div>
</div>

</div>
