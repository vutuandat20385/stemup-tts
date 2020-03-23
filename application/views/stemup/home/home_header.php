<a class="logo hidden-xs" href="<?php echo site_url(); ?>"><img class="" src="<?php echo base_url('images/stemup_images/logo_stemsup.svg');?>" height="60" alt=""></a>
			<form class="navbar-form pull-right mt-15 pad-0" id="loginform" role="search" method="post" action="<?php echo site_url('/login/stemupverifylogin');?>">
				<p class="login-title hidden-lg hidden-md hidden-sm">Đăng nhập</p>
				<div class="form-group mt-5">
					<input type="text" class="form-control" id="emailph" oninvalid="this.setCustomValidity('Không được để trống email !')" oninput="setCustomValidity('')" name="emailph" placeholder="Email phụ huynh" required> 
					<input type="text" class="form-control" id="namehs" oninvalid="this.setCustomValidity('Không được để trống tên học sinh !')" oninput="setCustomValidity('')" name="namehs" placeholder="Tên học sinh" required>
					<input type="password" class="form-control" id="pwd" oninvalid="this.setCustomValidity('Không được để trống password !')" oninput="setCustomValidity('')" name= "password" placeholder="Mật khẩu" required><br>
					<input type="checkbox" class="form-check-input" name="remember" id="remember"> Ghi nhớ
					<div id="error" style="color: white;"></div>
					<div id="ok" style="color: green"></div>
					<?php if($this->session->flashdata('message_r')){ ?>
						<script>
							toastr["warning"]('<?php echo $this->session->flashdata('message_r') ?>',"Error");
							toastr.options = {
								"closeButton": true,
								"debug": false,
								"newestOnTop": false,
								"progressBar": false,
								"positionClass": "toast-top-right",
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
						</script>
					<?php } ?>
				</div>
				<button type="submit" class="btn btn-success mt-5 bt_submit" id="button11">Đăng nhập</button>
				<button type="button" class="btn btn-danger btn-close hidden-lg hidden-md hidden-sm bt_close " data-dismiss="modal">Close</button>
			</form>

<script type="text/javascript">

if(screen.width<=767){

	$('input#emailph').removeClass('form-control');
	$('input#namehs').removeClass('form-control');
	$('input#pwd').removeClass('form-control');

	$('input#emailph').addClass('form-mobile');
	$('input#namehs').addClass('form-mobile');
	$('input#pwd').addClass('form-mobile');

	$('form#loginform').removeClass('navbar-form');   
	$('form#loginform').removeClass('pull-right');
	$('form#loginform').removeClass('mt-15');
	$('form#loginform').removeClass('pad-0');
	$('form#loginform').addClass('modal fade login-mobile');
}



	// modal fade

</script>