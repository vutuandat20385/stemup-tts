<main class="container MT70 mb-20">
	<form class="box-bor w350 mt-40" method="post" action="<?php echo site_url('/login/stemupverifylogin');?>">
		 <h3 class="text-xanh1 mb-40"><a href="">Học sinh đăng nhập</a></h3>
		  <div class="form-group">
			<label for="email">Tên + Email Phụ huynh:</label>
			<input type="email" class="form-control" id="email" name="email">
		  </div>
		  <div class="form-group">
			<label for="pwd">Mật khẩu:</label>
			<input type="password" class="form-control" id="pwd" name= "password">
		  </div>
		  <div class="checkbox">
			<label><input type="checkbox" name="remember"> Tự động đăng nhập</label>
		  </div>
		  <button type="submit" class="btn btn-danger btn-block"><span class="text-H">Đăng nhập</span></button>
	</form> 
 </main>