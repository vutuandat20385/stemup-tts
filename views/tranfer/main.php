 <div class="container">

   
	<h3>Chuyển điểm</h3>

    <?php	
	 if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
	}?>
	<div class="row">
	    <form method="post" action="<?php echo site_url('tranfer_point/tranfer/');?>">
			<div class="col-md-12">
			   <p class="col-md-2">Chuyển tới:</p>
			   <input  class="col-md-3" type="text" class="form-control" name="user_received" value="" placeholder="Nhập vào email của người bạn muốn cho điểm"  required />
		   </div>
		  <div class="col-md-12">
			   <p class="col-md-2">Số điểm cần chuyển:</p>
			   <input  class="col-md-3" type="number" class="form-control" name="point_tranfer" value="0" placeholder="Nhập số điểm cần chuyển" min=0 required />
		   </div>
		   <div class="col-md-12">
				<p class="col-md-2">Mật khẩu:</p>
				<input class="col-md-3" type="password" class="form-control" name="pwd_tranfer" value="" placeholder="Nhập mật khẩu tài khoản của bạn."  required />
		  </div> 
		   <div class="col-md-12">
				<p class="col-md-2">Nhập lại Mật khẩu:</p>
				<input class="col-md-3" type="password" class="form-control" name="cmf_pwd_tranfer" value="" placeholder="Nhập lại mật khẩu tài khoản của bạn"  required />
		  </div> 
		  <div class="col-md-offset-2">
			<button  style="margin-top:30px" class="btn btn-success" type="submit">Xác nhận</button>
		  </div>
		</form>
    </div>
</div>