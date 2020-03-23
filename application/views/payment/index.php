<!DOCTYPE html>
<html lang="en">
<head>
	<title>STEMUP</title>
	<?php $this->load->view('stemup/head');?>
	<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
</head>
<body>
	<header class="container-fluid bg-stemup ">
		<div class="container">	<?php $this->load->view('stemup/home/home_header_login');?>	</div>
	</header>
	<div class="container MT70">
		<h2 class="title ta-c">QUẢN LÝ THANH TOÁN </h2>
		<div class="col-md-12">
			<div class="col-md-6 btn-group">
				<select >
					<option >1</option>
					<option >2</option>
					<option >3</option>
					<option >4</option>
				</select>
			</div>
			<div class="col-md-6">
				<input type="search" name="" placeholder="Nhập số điện thoại hoặc tên người dùng">
			</div>
		</div>
		<div class="col-md-10 col-left">
			<table class="table table-hover">
			  <thead>
			    <tr>
			      <th scope="col">UID</th>
			      <th scope="col">Tài khoản</th>
			      <th scope="col">SĐT</th>
			      <th scope="col">Yêu cầu</th>
			      <th scope="col">Ngày</th>
			      <th scope="col">Trạng thái</th>
			      <th scope="col"></th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <th>1</th>
			      <td>tuandat@dtt</td>
			      <td>01224229007</td>
			      <td>1 tháng</td>
			      <td>20-08-2019</td>
			      <td>Pending</td>
			      <td><a href="#">Xử lý</a></td>
			    </tr>
			    <tr>
			      <th>1</th>
			      <td>maichi@dtt</td>
			      <td>0135269852</td>
			      <td>1 tháng</td>
			      <td>20-08-2019</td>
			      <td>Pending</td>
			      <td><a href="#">Xử lý</a></td>
			    </tr>
			    <tr>
			      <th>1</th>
			      <td>hoaanh@dtt</td>
			      <td>0356267891</td>
			      <td>3 tháng</td>
			      <td>20-08-2019</td>
			      <td>Success</td>
			      <td><a href="#">Xử lý</a></td>
			    </tr>
			    <tr>
			      <th>1</th>
			      <td>minhdang@dtt</td>
			      <td>0369235110</td>
			      <td>1 tháng</td>
			      <td>20-08-2019</td>
			      <td>Fail</td>
			      <td><a href="#">Xử lý</a></td>
			    </tr>
			  </tbody>
			</table>
		</div>
		<div class="col-md-2 col-right">
			Pending: 9 <br>
			Success: 213<br>
			Fail: 2s
		</div>
	</div>
</body>
</html>