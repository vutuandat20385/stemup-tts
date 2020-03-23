<!DOCTYPE html>
<html lang="en">
<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
<?php $this->load->view('stemup/head');?>
<head>

</head>
<body class="bg-body">



	<main class="container MT70">


		<section class="row">
  	  <!--<aside class="col-md-2 hidden-xs">
	  
	     <div style="margin-top:-20px;" class="div-leftbar-home">
			<?php if($level_categ_list){?>
		         <div style="margin-top:20px">			   
				    <div class="list-group hidden-xs" >
					  <a href="<?php echo site_url('page/category/'.$category_permalink)?>"> <h3 class="list-group-item active1"><?php echo $category_name;?></h3></a>
					 <?php foreach($level_categ_list as $lv){?>
					    
						 <a href="<?php echo site_url('page/category/'.$category_permalink.'/'.$lv['permalink']);?>"  class="list-group-item <?php if($lv['lid']==$level_id){?> active <?php } ?>">  <?php echo $lv['level_name'];?></a>
					 <?php }?>
					</div>
			<?php } else{?>
			<div style="position:sticky;top:70px">
			<?php }?>
				<div class="list-group hidden-xs" >
					 <h3 class="list-group-item active1">Trắc nghiệm</h3>
					 <a href="<?php echo site_url("home")?>"  class="list-group-item"> <i class="fas fa-question-circle" style="margin-right:5px"></i> Câu hỏi vui</a>
					
					  <a href="<?php echo site_url('home/quiz_list') ?>"  class="list-group-item"><i class="fas fa-book" style="margin-right:5px"></i> Bài trắc nghiệm</a>
				  
				</div>
				
				<div class="list-group hidden-xs" >
					 <h3 class="list-group-item active1">Phân loại</h3>
					 <a href="<?php echo site_url("page/categories")?>"  class="list-group-item"> <i class="fas fa-filter" style="margin-right:5px"></i> Chuyên mục</a>
				  
				</div>
				<div class="list-group hidden-xs" >
					 <h3 class="list-group-item active1">Về chúng tôi</h3>
					 <a href="<?php echo site_url('home/about') ?>"  class="list-group-item"><i class="fas fa-bullseye" style="margin-right:5px"></i> Giới thiệu</a>
					 <a href="<?php echo site_url('home/detail3/user_terms') ?>"  class="list-group-item"><i class="fas fa-object-group" style="margin-right:5px"></i> Điều khoản sử dụng</a>
					 <a href="<?php echo site_url('home/detail1/guidelines') ?>"  class="list-group-item"><i class="fas fa-folder-open" style="margin-right:5px"></i> Hướng dẫn</a>
					 <a href="<?php echo site_url('home/detail2/policy') ?>"  class="list-group-item"><i class="fa fa-window-restore" style="margin-right:5px"></i> Chính sách riêng tư</a>
			  </div>
			</div>
		  
       </div> 
   </aside> --> 
   <aside class="col-md-10 col-md-offset-1 help_content1">
   	<h2 class="text-center">HƯỚNG DẪN SỬ DỤNG ỨNG DỤNG STEMUP.APP </h2>


   	<p id="content_helpmobile"><b>Sau khi phụ huynh tạo tài khoản cho con. Phụ huynh sẽ cung cấp thông tin email trên web stemup.app để xem bài giao và làm bài tập.</b></p>


   	<h4 class="h4_to" style="margin-top: 20px;"><b>I. Hướng dẫn sử dụng trên stemup.app</b></h4>
   	<h4 class="h4_nh" style="margin-top: 15px;"><b>1.	Đăng nhập trên web stemup.app</b></h4>


   	<p id="content_helpmobile"> Bước 1: Học sinh tiến hành truy cập vào link: <a href="https://stemup.app">https://stemup.app</a> để tiến hành đăng nhập.</p>
	<p id="content_helpmobile"> Bước 2: Nhập email Phụ huynh và tên đăng nhập của học sinh và mật khẩu đăng nhập do phụ huynh tạo cho con tại chức năng Thêm con cung cấp. Nhấn tự động đăng nhập để duy trì trạng thái sau khi tắt trình duyệt (Không bắt buộc).</p>
	<p id="content_helpmobile"> Bước 3: Nhấn chọn nút đăng nhập.</p>

	<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12 new_n">
		<img class="img-responsive" src="<?php echo base_url('upload/huongdan/1n.png') ?>" alt="">
	</div>

   	<h4 class="h4_to"><b>II. Hướng dẫn sử dụng các tính năng trên stemup.app</b></h4>
   	<h4 class="h4_nh"><b>1. Xem danh sách bài được giao.</b></h4>



   	<p id="content_helpmobile">Sau khi đăng nhập, để xem thông tin bài được giao trang sẽ dẫn trực tiếp sang trang Hoạt động xem danh sách bài được giao, vì học sinh mới đăng nhập phụ huynh chưa giao bài nên danh sách bài giao không hiển thị:</p>

	<p id="content_helpmobile"> Bước 1: Nhấn chọn mục Hoạt động.</p>
	<p id="content_helpmobile"> Bước 2: Vào Hoạt động được giao để xem tổng hợp bài được giao và kết quả sau khi làm bài.</p>
	<p id="content_helpmobile"> Bước 3: Vào trang Hoạt động đã làm để xem danh sách các bài đã làm rồi bao gồm: Người giao bài, thời gian làm bài, loại bài và sao thưởng từ phụ huynh.</p> 
	<p id="content_helpmobile"> Bước 4: Vào trang Hoạt động chưa làm để xem thông tin bài tập được giao nhưng chưa làm bao gồm: Tên người giao bài, thời gian làm bài, loại bài tập và sao thưởng từ tối đa từ phụ huynh nếu làm đúng 100% bài tập.</p>

	<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12 new_n">
		<img class="img-responsive" src="<?php echo base_url('upload/huongdan/2n.png') ?>" alt="">
	</div>

	<p id="content_helpmobile">Bạn cũng có thể mở thông báo để xem thông tin bài được giao</p>
	<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12 new_n">
		<img class="img-responsive" src="<?php echo base_url('upload/huongdan/3n.png') ?>" alt="">
	</div>

	<h4 class="h4_nh"><b>2. Làm bài được giao</b></h4>

	<p id="content_helpmobile">Sau khi nhận thông báo giao bài tập từ phụ huynh học sinh. Để làm bài được giao học sinh thực hiện các bước sau:</p>

	<p id="content_helpmobile">Bước 1: Nhấn vào mục Hoạt động</p>
	<p id="content_helpmobile">Bước 2: Nhấn chọn vào mục Hoạt động được giao hoặc Hoạt động chưa làm để xem bài chưa làm.</p>
	<p id="content_helpmobile">Bước 3: Nhấn chọn nút Làm bài để thực hiện làm bài kiểm tra.</p>
	<p id="content_helpmobile">Bước 4: Nhấn chọn đáp án trả lời. Hệ thống sẽ tử dẫn sang câu hỏi tiếp theo.</p>
	<p id="content_helpmobile">Bước 5: Nhấn Nộp bài để gửi đáp án và xem kết quả.</p>
	<p id="content_helpmobile"><i>(Chú ý: Mỗi bài tập sẽ được quy đinh thời gian phải hoàn thành. Nếu hết thời gian hệ thống sẽ tự động nộp bài).</i></p>

	<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12 new_n">
		<img class="img-responsive" src="<?php echo base_url('upload/huongdan/4n.png') ?>" alt="">
	</div>
	<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12 new_n">
		<img class="img-responsive" src="<?php echo base_url('upload/huongdan/5n.png') ?>" alt="">
	</div>

	<h4 class="h4_nh"><b>3. Xem kết quả</b></h4>

	<p id="content_helpmobile">Sau khi làm hoàn thành bài được giao hệ thống sẽ tự động tra về kết quả bài giao. Nội dung kết quả sẽ bao gồm đáp án đúng màu xanh và đáp án nếu bạn lựa chon sai là màu đỏ. Với những câu chưa làm hoặc bỏ sót hệ thống sẽ hiển thị thông báo và đáp án. Ngoài ra, bạn cũng có thể mở mục Hoạt động để  xem đáp án chi tiết câu hỏi và thông tin thưởng sao.</p>

	<p id="content_helpmobile">Bước 1: Nhấn vào mục Hoạt động. </p>
	<p id="content_helpmobile">Bước 2: Nhấn chọn mục Hoạt động được giao hoặc Hoạt động đã làm.</p>
	<p id="content_helpmobile">Bước 3: Nhấn chọn xem kết quả.</p>
	<p id="content_helpmobile">Bước 4: Trang đáp án chi tiết hiển thị</p>

	<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12 new_n">
		<img class="img-responsive" src="<?php echo base_url('upload/huongdan/6n.png') ?>" alt="">
	</div>
	<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12 new_n">
		<img class="img-responsive" src="<?php echo base_url('upload/huongdan/7n.png') ?>" alt="">
	</div> 

	<p id="content_helpmobile"> => Kết quả của con sau khi làm bài xong sẽ được chuyển về thông báo app STEMUP Phụ huynh để Phụ huynh xem kết quả. </p>


	<h4 class="h4_nh"><b>4. Làm câu hỏi trắc nghiệm và bài tập trên trang Tự Học.</b></h4>

	<p id="content_helpmobile">Tại trang tự học, hệ thống cung cấp các câu hỏi trắc nghiệm theo từng môn học và khối lớp. Con có thể xem và nhẫn chọn các đáp án cho câu hỏi.</p>

	<p id="content_helpmobile">Bước 1: Nhấn chọn mục Tự học. </p>
	<p id="content_helpmobile">Bước 2: Nhấn chọn bài trắc nghiệm để làm</p>
	<p id="content_helpmobile">Bước 3: Làm bài trắc nghiệm như phần làm bài được giao. Con nhấn nộp bài và xem luôn đáp án chi tiết do hệ thống cung cấp.</p>
	<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12 new_n">
		<img class="img-responsive" src="<?php echo base_url('upload/huongdan/8n.png') ?>" alt="">
	</div>
</aside>	  

</section>
</main>





</body>


</html>
