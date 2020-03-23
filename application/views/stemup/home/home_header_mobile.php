<!-- Brand and toggle get grouped for better mobile display -->
<style type="text/css">
		.content-1 img {
    width: 100% !important;
    height: 60% !important;
}
</style>
<div class="navbar-header">
	<a class="logo logo-mobile" href="<?php echo site_url(); ?>"><img class="hidden-sm hidden-md hidden-lg"
			src="<?php echo base_url('images/stemup_images/logo_stemsup.svg');?>" height="40" alt=""></a>
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"
		aria-expanded="false">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<button type="button" class="btn btn-primary btn-dangnhap-mobile" data-toggle="modal"
		data-target="#loginform">Đăng nhập</button>
	<!-- <div class="modal fade bd-example-modal-lg" id="form-login" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form class="navbar-form form-login-mobile" id="login-form-mobile">
					<p class="title-login-form">Đăng nhập</p>
					<div class="form-group mt-5">
						<input type="text" class="form-control m10 " id="emailph" name="emailph"
							placeholder="Email phụ huynh">
							<p style="padding: 0px 11px;color:red;display:none" id="error_email">Không được để trống Email!</p>
						<input type="text" class="form-control m10" id="namehs" name="namehs"
							placeholder="Tên học sinh">
							<p style="padding: 0px 11px;color:red;display:none" id="error_name">Không được để trống Tên học sinh!</p>
						<input type="password" class="form-control m10" id="pwd" name="password"
							placeholder="Mật khẩu">
							<p style="padding: 0px 11px;color:red;display:none" id="error_pwd">Không được để trống Mật Khẩu!</p>

							<br>
				
						</div>
				</form>
				<div class="navbar-form form-login-mobile" style="margin-top: -57px;">
				<button class="btn btn-success mt-5" id="button12" onclick="submit()">Đăng nhập</button>
				<div class="alert-danger" id="div-error" style="padding:5px,display:none">
				</div>
				</div>
			</div>
		</div>
	</div> -->
</div>
<!-- <script>
	function submit(){
		var emailph = $("#form-login #emailph").val();
		var namehs = $("#form-login #namehs").val();
		var pwd = $("#form-login #pwd").val();
		var check_email,check_name,check_pw;
		
		if(emailph.trim().length == 0) {
			$("#form-login #error_email").css("display","");
			check_email = 0;
		} else {
			$("#form-login #error_email").css("display","none");
			check_email = 1;
		}
		if(namehs.trim().length == 0) {
			$("#form-login #error_name").css("display","");
			check_name = 0;
		} else {
			$("#form-login #error_name").css("display","none");
			check_name = 1;
		}
		if(pwd.trim().length == 0) {
			$("#form-login #error_pwd").css("display","");
			check_pw = 0;
		} else {
			$("#form-login #error_pwd").css("display","none");
			check_pw = 1;
		}
		formData = $("#form-login #login-form-mobile").serialize();
		if(check_email==1 && check_name==1 && check_pw==1){
			$.ajax({
				type:"POST",
				url: "<?php echo site_url('/login/stemupverifylogin_mobile');?>",
				data: formData,
				success: function(data){
					// console.log(data);
					if(data.status != 1) {
						$("#form-login #div-error").css("display","");
						$("#form-login #div-error").html(data.message);
					} else {
						$("#form-login #div-error").css("display","none");
						$("#form-login #div-error").html();
						window.location.href = 'action';
					}
				},
				error: function(data){

				}
			})
		}
	}
</script> -->