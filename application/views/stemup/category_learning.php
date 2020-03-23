<html>
<head>

	<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
	<style type="text/css">
	@media only screen and (max-width: 767px) {
		footer.bg-xanh.pos-f {
		    display: none;
		}
	}
	</style>

<?php 
$this->load->view('stemup/head'); 

// $this->load->view('sadmin/head'); 
$this->load->model("self_learning_model");

?>
</head>
<?php
function _substr($str, $length, $minword = 3){
	$sub = '';
	$len = 0;
	foreach (explode(' ', $str) as $word)
	{
		$part = (($sub != '') ? ' ' : '') . $word;
		$sub .= $part;
		$len += strlen($part);
		if (strlen($word) > $minword && strlen($sub) >= $length)
		{
			break;
		}
	}
	return $sub . (($len < strlen($str)) ? '...' : '');
}
?>
<body class="bg-body">
	<div class="container MT70">
		<?php $this->load->view('stemup/header');?>
		<?php $this->load->view('stemup/menu');?>
		<div class="col-md-10 col-learning-right">
			<h2 class="title">TRẮC NGHIỆM </h2>
			<div class="col-md-6 col-xs-6 subject"><?php echo $tenmon['category_name']; ?></div>
			<div class="col-md-6 col-xs-6 grade"><?php echo 'Lớp: '.$lid; ?></div>
			<?php
			foreach ($result as $key => $value) {
				$avatar=$this->self_learning_model->get_quiz_avatar($value['quid']);

				?>
				<div class="col-md-3 col-xs-12 category-box category-box-mobile">
					<div class="col-xs-12 cover category-mobile">
						<a  href="<?php echo site_url('quiz/validate_quiz/').'/'.$value['quid']?>" >
							<div class="col-md-12 col-xs-3 box-avatar box-avatar-mobile"><?php echo $avatar; ?></div>
							<div class="col-md-12 col-xs-9 category-name-1"><?php echo _substr($value['quiz_name'],50,4); ?></div>
						</a>
					</div>
				</div>
				
				<?php
			}
			?> 

		</div>
		
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12 phantrang">
			<ul class="pagination" >
				<?php echo $links ?>
			</ul>
	</div>
	<?php $this->load->view('stemup/footer'); ?>

	
</body>
</html>