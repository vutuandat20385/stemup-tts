<!-- style="position: fixed;left: 0;bottom: 0;width: 100%;" -->
	<footer class="container-fluid"   >
		<div class="row bg-f1" style="display:none;">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
					      <div id="thumbnail-preview-indicator" class="carousel slide" data-ride="carousel">
         
							  <div class="carousel-inner">
									<div class="item slides active">
										 <h3 class="tle-f1" >Giới thiệu<br><span class="line-f"></span></h3>
										 <p class="text-trang2 mb-20">Chúng tôi cung cấp cho bạn những tin tức <br>mới nhất và video từ lĩnh vực khoa học kỹ thuật.<br>Hệ thống đang trong giai đoạn thử nghiệm<br/> Open Beta.</p>
										 
										 <div class="row">
											 <div class="col-md-6">
												   <p class="text-trang1">Theo dõi chúng tôi:</p>
												   <a class="text-trang2" href="https://www.facebook.com/stemupapp" target="_blank"><i class="fab fa-facebook fa-2x mr-10"></i></a>
												   <a class="text-trang2" href="https://twitter.com/StemHoc" target="_blank" ><i class="fab fa-twitter-square fa-2x"></i></a>
											 </div>
											 <div class="col-md-6">
												   <p class="text-trang1">Liên hệ chúng tôi:</p>
												   <a class="text-trang2" href="">info@stem.vn</a>
											 </div>
										     
										 </div>
										 
										 
									</div>
									
									<div class="item slides">
					
										 <h3 class="tle-f1" >Điều khoản sử dụng<br><span class="line-f"></span></h3>
										  <p class="text-trang2 ">Bản quy chế này áp dụng cho các thành viên <br> đăng ký sử dụng Hệ thống trắc nghiệm trực tuyến<br> trên website stemup.app và app….</p>
										  <h5><a  class="col-md-3 col-md-offset-7 text-trang2 mb-20" href="<?php echo base_url('index.php/home/detail/user_terms')?>">Xem thêm &gt;&gt;</a>
										  </h5>
										  <div class="row">
											   <div class="col-md-6">
													<p class="text-trang1">Tải STEM app:</p>
													<a class="text-trang2" href="https://play.google.com/store/apps/details?id=vn.dtt.stemvn" target="_blank"><i class="fab fa-google-play fa-2x"></i></i></a>
													<a class="text-trang2" href="https://play.google.com/store/apps/details?id=vn.dtt.mcq" target="_blank"><i class="fab fa-android fa-2x mr-10"></i></a>
													<a class="text-trang2" href="https://itunes.apple.com/vn/app/%C4%91%E1%BB%91/id1405372828?mt=8" target="_blank" ><i class="fab fa-apple fa-2x"></i></a>
												</div> 
												<div class="col-md-6">
													<p class="text-trang1">Liên hệ chúng tôi:</p>
													<a class="text-trang2" href="">info@stem.vn</a>
												</div>
												
											</div>
									</div>
								 
							 
								</div>
						 
						
						</div>
					</div>
					<div class="col-md-8 mb-10">
						<div class="row">
						
						    <div class="col-md-3">
								<h3 class="tle-f">Liên kết nhanh<br><span class="line-f"></span></h3>
								<ul class="menu-f">
									<?php 
										foreach($post_tag as $key => $val){
									?>
										<li><a href="<?php echo $val['link'];?>" target="_blank"><i class="mr-10 fa fa-angle-right"></i><?php echo $val['title'];?></a></li>
									<?php 
										}
									?>
								</ul>
							</div>
							 <div class="col-md-9">
								<h3 class="tle-f">Chuyên mục<br><span class="line-f"></span></h3>
								
									
								<div class="col-md-4">
								    
									<ul class="menu-f">

									 <?php for($i=0; $i<ceil(count($stcategories)/3); $i++){?>
									 	<li>
											<a href="<?php echo site_url('page/category/'.$stcategories[$i]['permalink'])?>" target="_blank">
												<i class="mr-10 fa fa-angle-right"></i><?php echo $stcategories[$i]['category_name']; ?>
												<span class="pull-right"><?php echo $stcategories[$i]['num_question']; ?></span>
											</a>
											
										</li>
									 <?php } ?>
									
									</ul>

									
								</div>
								<div class="col-md-4">
									 <ul class="menu-f">
									 <?php for($i=ceil(count($stcategories)/3); $i<ceil(2*count($stcategories)/3); $i++){?>
									 	<li>
											<a href="<?php echo site_url('page/category/'.$stcategories[$i]['permalink'])?>" target="_blank">
												<i class="mr-10 fa fa-angle-right"></i><?php echo $stcategories[$i]['category_name']; ?>
												<span class="pull-right"><?php echo $stcategories[$i]['num_question']; ?></span>
											</a>
											
										</li>
									 <?php } ?>
									</ul>
								</div>
								<div class="col-md-4">
									 <ul class="menu-f">
									<?php for($i=ceil(2*count($stcategories)/3); $i<count($stcategories); $i++){?>
									 	<li>
											<a href="<?php echo site_url('page/category/'.$stcategories[$i]['permalink'])?>" target="_blank">
												<i class="mr-10 fa fa-angle-right"></i><?php echo $stcategories[$i]['category_name']; ?>
												<span class="pull-right"><?php echo $stcategories[$i]['num_question']; ?></span>
											</a>
											
										</li>
									 <?php } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- The scroll to top feature -->

	<div class="scroll-top-wrapper ">
	  <span class="scroll-top-inner ">
		<i class="fa fa-2x fa-arrow-circle-up"></i>
	  </span>
	</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
 <!--<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?>"></script>-->
	
	<script>
				$( document ).ready(function() {
				$("[rel='tooltip']").tooltip();    

				$('.thumbnail').hover(
					function(){
						$(this).find('.caption').slideDown(250); //.fadeIn(250)
					},
					function(){
						$(this).find('.caption').slideUp(250); //.fadeOut(205)
					}
				); 
			});
		</script>
	<script>
		$(document).ready(function(){

$(function(){
 
    $(document).on( 'scroll', function(){
 
    	if ($(window).scrollTop() > 100) {
			$('.scroll-top-wrapper').addClass('show');
		} else {
			$('.scroll-top-wrapper').removeClass('show');
		}
	});
 
	$('.scroll-top-wrapper').on('click', scrollToTop);
});
 
function scrollToTop() {
	verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
	element = $('body');
	offset = element.offset();
	offsetTop = offset.top;
	$('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
}

});
	</script>
<script>window.MathJax = { MathML: { extensions: ["mml3.js", "content-mathml.js"]}};</script>
<script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=MML_HTMLorMML"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 



          <script src="<?php echo base_url('js/bootstrap.js');?>"></script> 
	<link href="<?php echo base_url('css/style-footer.css');?>" rel="stylesheet">
	

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140211627-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-140211627-1');
</script>

