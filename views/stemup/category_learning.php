<html>

<?php 
$this->load->view('stemup/head'); 
// $this->load->view('sadmin/head'); 
$this->load->model("self_learning_model");

?>
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
			<div class="col-md-6 subject"><?php echo $tenmon['category_name']; ?></div>
			<div class="col-md-6 grade"><?php echo 'Lớp: '.$lid; ?></div>

			 <?php
				foreach ($result as $key => $value) {
					$avatar=$this->self_learning_model->get_quiz_avatar($value['quid']);

			?>
			<div class="col-md-3 category-box"><a  href="<?php echo site_url('quiz/validate_quiz/').'/'.$value['quid']?>" >
				<div class="cover">
					<?php echo $avatar; ?>
					
					<span class="col-md-12 category-name-1"><?php echo _substr($value['quiz_name'],43,4); ?></span>
					
				</div></a>
			</div>
			<?php
				}
			?> 
				
			
		</div>
	</div>
	<?php $this->load->view('stemup/footer'); ?>

	
</body>
</html>