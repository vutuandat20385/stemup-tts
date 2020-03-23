<form class="navbar-form pull-right mt-15 pad-0" role="search" method="post" action="<?php echo site_url('/login/stemupverifylogin');?>">
	<div class="form-group mt-5">
		<input type="text" class="form-control" id="emailph" name="emailph" placeholder="Email phụ huynh">
		<input type="text" class="form-control" id="namehs" name="namehs" placeholder="Tên học sinh">
		<input type="password" class="form-control" id="pwd" name= "password" placeholder="Mật khẩu"><br>
	<div id="error" style="color: white;"></div>
	<div id="ok" style="color: green"></div>
		<?php if($this->session->flashdata('message_r')){ ?>
			<div class="alert-danger" style="padding:5px">							
				<?php echo $this->session->flashdata('message_r'); ?>												
			</div>
				<?php } ?>
	</div>
	<button type="submit" class="btn btn-success mt-5" id="button11">Đăng nhập</button>
</form>

<script type="text/javascript">
	$('#button11').on('click',function(){
		var emailph = $("#emailph").val();
		var namehs = $("#namehs").val();
		var password = $("#pwd").val();
		var error = $("#error");
		var ok = $("#ok");
	// resert 2 thẻ div thông báo trở về rỗng mỗi khi click nút đăng nhập
		error.html("");
						
	// Kiểm tra nếu username rỗng thì báo lỗi
		if (emailph == "") {
			error.html("Địa chỉ Email không được để trống");
			return false;
		}
		if (namehs == "") {
			error.html("Tên học sinh không được để trống ");
			return false;
		}
		if (password == "") {
			error.html("Password không được để trống");
			return false;
		}

	});
</script>