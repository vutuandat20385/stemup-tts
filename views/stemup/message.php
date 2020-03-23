<!DOCTYPE html>
<html lang="en">
<head>

	<?php $this->load->view('stemup/head');?>
	<link href="<?php echo base_url('css/login.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('js/signup.js');?>"></script>


</head>
<body>
<?php $this->load->view('stemup/header');?>
   
	
<div style="margin-top:120px">
<?php echo $message; ?>
</div>	
		



             
<?php $this->load->view('stemup/footer');?>

</body>
</html>
