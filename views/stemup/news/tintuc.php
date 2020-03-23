<!DOCTYPE html>
<html lang="en">
<head>
	<meta property="og:title" content="<?php echo $new['name']?>" />
	<meta property="og:description" content="<?php echo $new['description'];?>" />
	<meta property="og:image" content="<?php echo $new['avatar'];?>" />

	<meta name="twitter:title" content="<?php echo $new['name']?>">
	<meta name="twitter:description" content="<?php echo $new['description'];?>">
	<meta name="twitter:image" content="<?php echo $new['avatar'];?>">

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

<script type="text/javascript" src="http://apis.google.com/js/plusone.js"> {lang: 'vi'} </script>


</head>

<body class="bg-body">
	<!---Share FB --->
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.3"></script>
	<!---End share --->

	<header class="container-fluid bg-stemup hidden-xs">
		<div class="container">	<?php $this->load->view('stemup/home/home_header');?>	</div>
	</header>
	<nav class="navbar navbar-default mb-6">
		<div class="container">
			<?php $this->load->view('stemup/home/home_header_mobile');?>
			<?php $this->load->view('stemup/menu_top'); ?>			
		</div>
	</nav>
	
	<main class="container MT70">
		<aside class="col-md-8 text-justify content-1">
			
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb hidden-xs">
					<li class="breadcrumb-item"><a href="<?php echo site_url();?>">Trang chủ</a></li>
					<li class="breadcrumb-item" aria-current="page"><a href="<?php echo site_url('home/news');?>">Tin tức</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?php echo $new['name'];?></li>
				</ol>
			</nav>
			<header class="clearfix">
				<span class="text-ngayxam-page left_n" >
					<?php 
					$timeEng = ['Sunday','Monday','Tuesday','Wednesday', 'Thursday', 'Friday', 'Saturday', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
					$timeVie = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy','Một', 'Hai', 'Ba', 'Tư', 'Năm', 'Sáu', 'Bảy', 'Tám', 'Chín', 'Mười', 'Mười Một', 'Mười Hai'];
					$time =strtotime($new['modify_date']);
					$time=date('l, d/m/Y H:i:s',$time);
					$time = str_replace( $timeEng, $timeVie, $time);
					echo '('.$time.')';
					?>
				</span>
				<div class="bo-b1 right_n">
					<a class="icon-mang1 fb" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo site_url('home/tintuc'.'/'.$new['url_name'])?>"><i class="fab fa-facebook-square"></i></a>
					<a class="icon-mang1 t" href="http://twitter.com/share?text=<?php echo urlencode($new['description']);?>&amp;url=<?php echo site_url('home/tintuc'.'/'.$new['url_name'])?>" target="_blank"><i class="fab fa-twitter-square"></i></a>
					<!-- <a class="icon-mang1 g" href=""><i class="fab fa-google-plus-square"></i></a> -->
					<g:plusone></g:plusone>
					<a class="icon-cn btn btn-default aa_n" href="javascript:zoomoutLetter();">A-</a>
					<a class="icon-cn btn btn-default aa_n" href="javascript:zoominLetter();"><strong>A+</strong></a>
				</div>

			</header>
			<section>
				<h3 class="" ><?php echo $new['name'];?><br>

				</h3>

				<!-- <?php //echo strtotime($new['modify_date']); ?>
				<?php //echo time(); ?> -->

				<p class="text-justify fz16"><strong><?php echo $new['description'];?></strong></p>
				<p><img class="img-responsive img-news" src="<?php echo $new['avatar'];?>" alt="placeholder image"></p>
				<p class="text-justify fz16"><?php echo $new['content'];?></p>


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
				var s = 17;
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
			var s = 15;
			}

			if(s!=min) {
				s -= 1;
			}
			p[i].style.fontSize = s+"px";
		}
	}
</script>