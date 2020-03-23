
 <script>
	var site_url="<?php echo site_url();?>";
</script>
<script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>
 <div class="modal fade" id="signupModal" role="dialog">
		<div class="modal-dialog">	 
			 <div class="modal-content">
			    <div class="box-popup1">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Đăng ký tài khoản</h4>
					 
					</div>
					<div class="modal-body" >
							<input type="text" style="display:none" id="model_sn" name="model_sn" value=""/>
						  <input type="text" style="display:none" id="id_sn" name="id_sn" value="0"/>
						   <input type="text" style="display:none" id="opt_choice_sn" name="opt_choice_sn" value=""/>
							<div id="chose_type">
								  <p>Chọn dạng tài khoản:</p>
								 <button type="button" class="btn btn-info" style="width:32%" onclick='load_signup_form(3)'>Giáo viên</button>
								 <button type="button" class="btn btn-info" style="width:32%" onclick='load_signup_form(2)'>Học sinh</button>
								 <button type="button" class="btn btn-info" style="width:32%" onclick='load_signup_form(4)'>Phụ huynh</button>
								  
							</div>
							<div id="captcha" style="display:none;"><div class="g-recaptcha" data-sitekey="6LfzlKMUAAAAAMv6fJ1q3p57pOxeKpSRRw8cHyxt"></div></div>
							<button id="btn_sm"class="btn btn-success" type="submit" style="display:none;">Xác nhận</button>
						
						<script type="text/javascript">
							$('#btn_sm').on("click",function(){
								$('#error5').empty();
								$('#error1').empty();
								$('#error2').empty();
								$('#error3').empty();
								$('#error4').empty();
								first_name = $('#first_name').val();
								email = $('#inputEmail').val();
								password = $('#inputPassword1').val();
								passwordcfm = $('#inputPasswordcfm').val();
								su = $('#su').val();
								if(first_name==''){
									$('#error5').html('<i>(Mời bạn nhập Họ tên)</i>');
								}else if(email==''){
									$('#error1').html('<i>(Mời bạn nhập địa chỉ Email)</i>');
								}else{
								    var email = document.getElementById('inputEmail').value;
								    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
								    if (!filter.test(email)) {
								    // alert('Địa chỉ Email không hợp lệ! \nVui lòng nhập lại Email');
								    $('#error1').html('<i>Địa chỉ Email không hợp lệ, vui lòng nhập lại Email</i>');
								    email.focus;
								    return false;
									}
									if(password==''){
										$('#error2').html('<i>(Mật khẩu không được để trống)</i>');
									}else if(passwordcfm==''){
										$('#error3').html('<i>(Mật khẩu xác nhận không được để trống)</i>');
									}else if(password!=passwordcfm){
										$('#error4').html('<i>(Mật khẩu xác nhận không trùng khớp)</i>');
										// console.log('555');
									}else{
										    $('#signupModal').modal('hide');
											$('#processing_md').modal();
											$.ajax({
												type: 'POST',
												data: {first_name:first_name,email:email,password:password,passwordcfm:passwordcfm,su:su},
												url: "<?php echo site_url('/signup/create_user') ?>",
												success: function(data){
													// console.log(data);
													$('#processing_md').modal('hide');
													if(data==1){
														
														window.location.href= "<?php echo site_url('/home_user') ?>";
													}else{
														alert('Email này đã tồn tại \nBạn vui lòng nhập Email khác để đăng ký');
													}
												},
												error: function(data){}
											});
										}
									} 
								// console.log('bbbbbbbbbbbbbbbbbbbbb');
							});
						</script>
					</div>
				</div>
			 </div>
			  
		</div>
	</div>
	
	 <div class="modal fade" id="resetpwdModal" role="dialog" >
		<div class="modal-dialog" style="width:40%">	 
			 <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" onclick="reload()">&times;</button>
				  <h4 class="modal-title">Quên mật khẩu</h4>
				 
				</div>
				
				<div class="modal-body">
					<form class="resetpwd" method="post" action="<?php echo site_url('home/resetpassword');?>">
						<input type="text" class="form-control form-TK1 col-md-12"  name="emailresetpwd" style="width:63%; margin-left:20%;" placeholder="Email" required autofocus />
						<div class="g-recaptcha" data-sitekey="6LfzlKMUAAAAAMv6fJ1q3p57pOxeKpSRRw8cHyxt" style="padding-top:50px; margin-left:0%"></div>
						<div  style="margin-left:40%;"><button type="submit" id="btrspw" class="btn btn-primary" style="margin-top:10px">Xác nhận</button></div>
					</form>
				</div>
				<div class="modal-footer">
						 <button type="button" class="btn btn-default" data-dismiss="modal" onclick="reload()">Close</button>
				</div>
				
			 </div>
			  
		</div>
	</div>
	<div class="modal fade" id="error_login" role="dialog" onclick="dismiss_modal(this)">
			<div class="modal-dialog">	 
				 <div class="modal-content">
						<div class="box-popup">
					<div class="bg-xanhnhat">
						<div class="icon">
							<img src="<?php echo base_url();?>images/thongbao.png" alt="">
						</div>
					</div>
					<div id="boxchon" class="box-chon">
					<h3><?php echo $this->session->flashdata('message_r');?> </h3>
					</div>

				</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="processing_md" role="dialog" >
			<div class="modal-dialog">	 
				 <div class="modal-content">
						<div class="box-popup">
					<div class="bg-xanhnhat">
						<div class="icon">
							<img src="<?php echo base_url();?>images/thongbao.png" alt="">
						</div>
					</div>
					<div id="boxchon" class="box-chon">
					<h3>Hệ thống đang xử lý yêu cầu của bạn! Xin vui lòng chờ trong giây lát!! </h3>
					</div>

				</div>
				</div>
			</div>
		</div>
<!--	<div class="modal fade" id="loginModal" role="dialog" >
		<div class="modal-dialog" style="width:40%">	 
			 <div class="modal-content">
			<div class="box-popup">
			   
			</div>
				
			 </div>
			  
		</div>
	</div>-->