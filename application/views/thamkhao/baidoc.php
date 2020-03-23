<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('stemup/head');?>
<style type="text/css">
	h2.other {
    color: #337ab7;
    text-align: center;
    font-weight: 500;
}

</style>
<body class="bg-body">

<?php $this->load->view('stemup/header');?>
<main class="container MT70">    

	<div class="col-md-8 col-baidoc-content">
		<h2 class="title"><?php echo $content['title']?></h2>
		<p><?php echo $content['content']?></p>
	</div>	

	<div class="col-md-4 col-baidoc-list">
		<h2 class="other">CÁC BÀI ĐỌC KHÁC</h2>
		<table class="table table-hover">
			<?php 
				foreach ($list as $value) {
					$img=base_url('images/app-07.png');
			?>
				<tr>
					<td><a href="<?php echo $value['link']?>"><img src="<?php echo $img; ?>" width="60" /></a></td>
					<td><a href="<?php echo $value['link']?>"><?php echo $value['title'];?></a></td>
				</tr>
			<?php		
				}
			?>
		</table>
	</div>
</main>

	<?php $this->load->view('stemup/footer'); ?>
</body>

</html>
