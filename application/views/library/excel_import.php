<!DOCTYPE html>
<html>
<head>
	<title>How to Import Excel Data into MySql in Codeigniter</title>
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?> css/bootstrap-3.4.1.css">
		<script type="text/javascript" src="<?php echo base_url(); ?> js/jquery-1.11.3.min.js"></script> -->
		<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
		<!-- <script src="<?php //echo base_url('js/jquery-1.11.3.min.js');?> "></script> -->
		<script src="<?php echo base_url('js/jquery-1.12.4.min.js');?> "></script>
		
	</head>
	<body>
		<div class="container">
			<br>
			<h3 align="center">How to Import Excel Data into Mysql in Codeigniter</h3>
			<form method="post" id="import_form" enctype="multipart/form-data">
				<p><label>Select Excel File</label>
					<input type="file" name="file" id="file" required accept=".xls, .xlsx"/>
				</p>	
				<br>
				<input type="submit" name="import" value="Import" class="btn btn-info">
			</form>
			<br>
			<div class="table-responsive" id="customer_data"></div>
			<br>
		</div>
	</body>
	</html>
	<script type="text/javascript">
		$(document).ready(function(){
			load_data();  
			function load_data(){
				$.ajax({
					url:"<?php echo site_url('excel_import/fetch') ?>",
					method: "post",
					success: function(data){
						$('#customer_data').html(data);
					}
				});
			}
			$('#import_form').on('submit', function(event){
				event.preventDefault();
				$.ajax({
					url: "<?php echo site_url('excel_import/import') ?>",
					method: "post",
					data: new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					success:function(data){
						console.log(data);
						$('#file').val('');
						load_data();
						alert(data+' hello hello');
					}

				});
			});
		});
	</script>
	