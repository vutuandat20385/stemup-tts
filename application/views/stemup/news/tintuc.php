<!DOCTYPE html>
<html lang="en">
<head>
	<title>TIN TỨC | STEMUP</title>
	<?php $this->load->view('stemup/head_not_login');?>
	<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
	<script>
		//quizAssignTo();
		var base_url="<?php echo base_url();?>";
		var site_url="<?php echo site_url();?>";
		var su="<?php echo $su ?>";
	</script>
	<style>
		
		.content-1 img {
    width: 100% !important;
    height: 60% !important;
}

		.MT70{
			margin-bottom: 30px;
			margin-top: 0;
		}
		.header-giua {
			width: unset !important;
		}	
		span{
			font-family:'Roboto', sans-serif !important;
		}
		p.text-justify.strong_n {
    color: #594f4f;
		}
		.content-source {
			/* float: right; */
			text-align: right;
		}
		span.tag-label {
			text-transform: uppercase;
			font-weight: 600;
			color: #fff;
			background: #111;
			padding: 2px 5px;
		}

		span.tag-item {
			background: #9ea698;
			color: #fff;
			padding: 2px 5px;
		}

		.tags {
			margin-top: 15px;
		}

	</style>  
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




</head>

<body class="bg-body">
	<header class="container-fluid bg-stemup ">
		<div class="container">	<?php $this->load->view('stemup/home/home_header');?>	</div>
	</header>
		<nav class="navbar navbar-default mb-6">
		<div class="container">
			<?php $this->load->view('stemup/home/home_header_mobile');?>
			<?php $this->load->view('stemup/home/menu_top_home'); ?>			
		</div>
	</nav>
	
	<main class="container MT70">
		<aside class="col-md-8 text-justify content-1">
			
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb hidden-xs">
					<li class="breadcrumb-item"><a href="<?php echo site_url();?>">Trang chủ</a></li>
					<li class="breadcrumb-item" aria-current="page"><a href="<?php echo site_url('home/news');?>">Tin tức</a></li>
					<!-- <li class="breadcrumb-item active" aria-current="page"><?php echo $new['name'];?></li> -->
				</ol>
			</nav>
			<header class="clearfix">
				
				<div class="bo-b1 right_n">
					<a class="icon-mang1 fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo site_url('home/tintuc'.'/'.$new['url_name'])?>"><i class="fab fa-facebook-square"></i></a>
					<a class="icon-mang1 t" href="https://twitter.com/intent/tweet?text=<?php echo $new['name'];?>&url=<?php echo site_url('home/tintuc'.'/'.$new['url_name'])?>"><i class="fab fa-twitter-square"></i></a>
					<!-- <a class="icon-mang1 g" href=""><i class="fab fa-google-plus-square"></i></a> -->
					<a class="icon-cn btn btn-default aa_n" href="javascript:zoomoutLetter();">A-</a>
					<a class="icon-cn btn btn-default aa_n" href="javascript:zoominLetter();"><strong>A+</strong></a>
				</div>

			</header>
			<section>
				<h3 class="" ><?php echo $new['name'];?><br></h3>
				<div>
				<span class="text-ngayxam-page left_n" >
					<?php 
					$timeEng = ['Sunday','Monday','Tuesday','Wednesday', 'Thursday', 'Friday', 'Saturday', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
					$timeVie = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy','Một', 'Hai', 'Ba', 'Tư', 'Năm', 'Sáu', 'Bảy', 'Tám', 'Chín', 'Mười', 'Mười Một', 'Mười Hai'];
					$time =strtotime($new['modify_date']);
					// $time=date('l, d/m/Y H:i:s',$time);
					$time=date('l, d/m/Y',$time);
					$time = str_replace( $timeEng, $timeVie, $time);
					echo '('.$time.')';
					?>
				</span>
				</div>
				<br>
				<br>

				<!-- <?php //echo strtotime($new['modify_date']); ?>
				<?php //echo time(); ?> -->

				<p class="text-justify strong_n"><strong><?php echo $new['description'];?></strong></p>
				<p><!-- <img class="img-responsive img-news" src="<?php echo $new['avatar'];?>" alt="placeholder image"> --></p>
				<p class="text-justify"><?php echo $new['content'];?></p>

				

				<?php if($new['source']!="" || !is_null($new['source'])){?>
				<div class="content-source">Nguồn, tác giả bài viết: <?php echo $new['source'];?></div>
				<?php } ?>

				<?php if($new['tag']!="" || !is_null($new['tag'])){?>
				<div class="tags"><span class="tag-label">Tags:</span> 
				
				<?php $arr = explode(",",$new['tag']);
					foreach($arr as $k => $v){?>
						<span class="tag-item"> <?php echo $v?></span>
				<?php	} ?>
				
				</div>
				<?php } ?>
			</section>

		</aside>
		<article class="col-md-4">
			<div class="mb-4"> <?php $this->load->view('stemup/news/tinlienquan');?> </div>
			<div class="mb-4"> <?php $this->load->view('stemup/news/tinkhac');?> </div>
		</article>

	</main>
	<section id="baochi" class="container-fluid bg-xam pd-30">
		<?php $this->load->view('stemup/home/bao_chi');?>
	</section>
	<section>			
		<?php $this->load->view('stemup/footer');?> 
	</section>
</body>

</html>
  <script type="text/javascript">
	var min=8;
	var max=28;
	function zoominLetter() {
		var p = document.getElementsByTagName('p');
		for(i=0;i<p.length;i++) {
			if(p[i].style.fontSize) {
				var s = parseInt(p[i].style.fontSize.replace("px",""));
			}else{
				var s = 12;
			}

			if(s!=max) {
				s += 1;
			}

			p[i].style.fontSize = s+"px";
		}
	}
	function zoomoutLetter() {
		var p = document.getElementsByTagName('p');
		for(i=0;i<p.length;i++) {
			if(p[i].style.fontSize) {
				var s = parseInt(p[i].style.fontSize.replace("px",""));
			}else{
			var s = 12;
			}

			if(s!=min) {
				s -= 1;
			}
			p[i].style.fontSize = s+"px";
		}
	}
</script>