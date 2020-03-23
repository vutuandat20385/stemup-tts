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
	<script src="<?php echo base_url('js/news_stemup.js') ?>"></script>
	<style>
		.MT70{
			margin-bottom: 30px;
			margin-top: 0;
		}
		.header-giua {
			width: unset !important;
		}
		#pagination_page {
			margin-left: 20%;
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
		<nav aria-label="breadcrumb" style="padding-left: 20px;">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
				<li class="breadcrumb-item active" aria-current="page">Tin tức</li>
			</ol>
		</nav>
		<br>
		<aside class="col-md-8 news-list">
			<div class="row">
				<?php
				if(!$news){
					echo 'Chưa có bài viết';
				}else
				foreach ($news as $value) { 
					
					?>
					<div class="col-md-6">
						<div class="box mb-3">
							<figure class="snip1581"><img class="d-block w-100 avatar-news" src="<?php echo $value['avatar']?>" alt="profile-sample2"><a href="<?php echo site_url('home/tintuc'.'/'.$value['url_name'])?>"></a></figure>
							<div class="box-tin">
								<a class="text-a1" href="<?php echo site_url('home/tintuc'.'/'.$value['url_name'])?>"><?php echo $value['name']?></a>
								<p class="text-muted"><?php echo _substr($value['description'],200, $minword = 5)?></p>

								<a class="btn btn-danger btn-sm" href="<?php echo site_url('/home/tintuc'.'/'.$value['url_name'])?>">Xem thêm</a>
							</div>
						</div>
					</div>
					<?php
				}
				?>
			</div>
			
			<div class="col-md-12"><p>Đang xem <span id="beginqt"><?php echo min($limit*$page+1,$num_news);?></span> 
				đến <span id="endqt"><?php echo min($limit*($page+1),$num_news);?></span> 
				trong tổng số <span id="totalqt"><?php echo $num_news.' '
				;?></span>mục tin tức</p></div>
				<center>
					<div id="pagination" class="row">
						<div id="pagination_page" class="col-md-7">
							<ul class="pagination listpage pageqt">
								<?php if($num_page>6){?>
									<li class="page-item active" onclick="drawpage_news_qt(0)"><a class="page-link">1</a></li>
									<li class="page-item" onclick="drawpage_news_qt(1)"><a class="page-link">2</a></li>
									<li class="page-item" onclick="drawpage_news_qt(2)"><a class="page-link">3</a></li>
									<li class="page-item" onclick="drawpage_news_qt(3)"><a class="page-link">4</a></li>
									<li class="page-item" onclick="drawpage_news_qt(4)"><a class="page-link">5</a></li>
									<?php if($num_page>7){ ?>
										<li class="page-item"><a class="page-link">...</a></li>
									<?php } ?>
									<li class="page-item" onclick="drawpage_news_qt(<?php  echo $num_page-1 ?>)"><a class="page-link"><?php echo $num_page ?></a></li>
								<?php }else{?>
									<li class="page-item active" onclick="drawpage_news_qt(0)"><a class="page-link">1</a></li>
									<?php for($i=1; $i<$num_page; $i++){?>
										<li class="page-item" onclick="drawpage_news_qt(<?php  echo $i ?>)"><a class="page-link"><?php  echo $i+1 ?></a></li>
									<?php }?>
								<?php }?>
							</ul>
						</div>
						
					</div>
				</center> 
				<div style="display: none">
					<input type="text" id="inf_page" value="0">
					<input type="text" id="inf_limit" value="6">
				</div>	
				
			</aside>
			<article class="col-md-4">
				<div class="mb-4"> <?php $this->load->view('stemup/news/tinnoibat');?> </div>
				<div class="mb-4"> <?php $this->load->view('stemup/news/tinmoi');?> </div>
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
		$("#news_").attr("class","active");
	</script>