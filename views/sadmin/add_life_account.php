<script src="<?php echo base_url('js/toastr.js') ?>"></script>
<link href="<?php echo base_url('css/toastr.css') ?>" rel="stylesheet" type="text/css" />
<table class="table">
	<thead class="thead-dark" style="background: #76bd7f">
		<tr>
			<td class="td_id col-md-1" align="center"><b>ID</b></td>
			<td class="td_content col-md-5"><b>Email</b></td>
			<td class="td_creater col-md-4"><b>Tên phụ huynh</b></td>
			<td class="td_createdate col-md-2" align="center"><b>Số sao</b></td>
		</tr>
	</thead>
	<?php
	foreach ($arr_result['data'] as $value){
		?>
		
		<tr>
			<td class="td_id col-md-1" align="center"><?php echo $value['uid'];?></td>
			<td  class="td_content col-md-4"><?php echo $value['email'];?></td>
			<td  class="td_creater col-md-4"><?php echo $value['name'];?></td>
			<td  class="td_createdate col-md-3" align="center"><?php echo $value['point'];?></td>
		</tr>
		<?php
	}
	?>
</table>
<?php 
$text='';
if($arr_result['status']==2){
	$text='Mời bạn nhập email để thêm tài khoản!';
}else if ($arr_result['status']==-1) {
	$text='Email không hợp lệ, mời bạn nhập lại email!';
}else if ($arr_result['status']==1) {
	$text='Đã thêm tài khoản thành công';
	log_message('error','GIA TRI = '.$text);
}else if ($arr_result['status']==0) {
	$text='Không phải email phụ huynh, mời bạn nhập lại email!';
}
?>

<script type="text/javascript">
	$(document).ready(function(){
		var notify = '<?php echo $text?>';
		var status = '<?php echo $arr_result['status'] ?>';
		if(status==2){
			toastr["warning"](notify);
		}else if(status==-1 || status==0){
			toastr["error"](notify);
		}else if(status==1){
			toastr["success"](notify);
		}
		toastr.options = {
			"closeButton": false,
			"debug": false,
			"newestOnTop": false,
			"progressBar": false,
			"positionClass": "toast-bottom-right",
			"preventDuplicates": false,
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}
	});
</script>
