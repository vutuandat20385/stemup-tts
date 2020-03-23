<!DOCTYPE html>
<html lang="en">
  <?php $this->load->view('stemup/head');?>
  <script src="<?php echo base_url('js/jquery-1.12.4.min.js') ?>"></script>
  <script src="https://code.jquery.com/jquery-latest.js"></script>
  <body class="bg-body">
	  <?php $this->load->view('stemup/header');?>
	<main class="container MT70 mb-20">
	<section class="row"> 
	<div class="col-md-1 col-sm-1 hidden-xs"></div> 	 
  	<div class="col-md-10 col-sm-10 col-xs-12 col-payment">
  		<?php
  			// echo '<pre>';
  			// print_r($user);
  			// echo '</pre>';
  		?>
  		<div class="col-md-6 col-assist-info">
  			<div class="div-cover">
  				<p class="title">Thông tin Nhân viên</p>
  				<p>Họ và tên: <span class="assist-info"><?php echo $user['first_name']?></span></p>
  				<p>Email: <span class="assist-info"><?php echo $user['email']?></span></p>
  				<p>Mã nhân viên: <span class="assist-info"><?php echo $user['user_code']?></span></p>
  				<p>Ngày làm việc: <span class="assist-info"><?php echo date("d - m - Y");?></span></p>
  			</div>
  		</div>
  		<div class="col-md-6 col-assist-work">
  			<div class="div-cover">
  				<table>
  					<tr>
  						<td>Số điện thoại khách cần nạp</td><td><input type="text" class="" id="phonenumber" style="width: 200px;    margin-left: 10px;margin-bottom: 5px;"></td>
  					</tr>
  					<tr>
  						<td>Số sao cần nạp</td><td><input type="text" class="" id="starpoint" style="width: 200px;margin-left: 10px;margin-bottom: 5px;"></td>
  					</tr>
  					<tr>
  						<td colspan="2" style="text-align: center;"><button class="btn btn-success" id="getcode">Nhận code</button><br>
						<div id="showcode"></div></td>
  					</tr>
  				</table>
  				
  			</div>
  		</div>

		
	</div>
	<div class="col-md-1 col-sm-1 hidden-xs"></div> 	
    </section>
  	</main>
  	<?php $this->load->view('stemup/footer');?>
  </body>
</html>

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#getcode').click(function(){
			var starpoint=document.getElementById("starpoint");
			var star=starpoint.value;

			$.ajax({
					url : "<?php echo site_url('transaction/auto_create_code');?>",
                    type : "post",
                    data : {starpoint:star},
                    success : function (result){
                        $('#showcode').html(result);
                    }
			});
			
		});

	});


</script>

