<!DOCTYPE html>
<html lang="en">
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
	<aside class="col-md-10 col-md-offset-1 help_content2">
		<h2 class="text-center">HƯỚNG DẪN SỬ DỤNG ỨNG DỤNG STEMUP HỌC SINH </h2>
		<h4><b>1.Cách cài đặt STEMUP Học sinh: </b></h4>
		<p id="content_helpmobile">Phụ huynh có thể cài đặt hoặc con cùng có thể tự cài đặt app STEMUP Học sinh trên điện thoại (nếu có) thông qua các bước sau:</p>
		
		
		
		<p id="content_helpmobile"><b>+ Với Android:</b></p>
		
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">		
		<img class="img-responsive" src="<?php echo base_url('images/image_HDHS/HDapp_student1.png') ?>" alt="">		
		</div>
		<p id="content_helpmobile">Hoặc tải ứng dụng STEMUP Học sinh trên Hệ điều hành Android tại đây:<a href="https://play.google.com/store/apps/details?id=vn.dtt.mcq&hl=en">&nbsp;Download STEMUP Học sinh</a></p>
		
		
		
		<p id="content_helpmobile"><b>+ Với ios (iphone, ipad):</b></p>		
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDHS/HDapp_student2.png') ?>" alt="">
		</div>
		<p id="content_helpmobile">Hoặc tải ứng dụng STEMUP Học sinh trên Hệ điều hành iOS tại đây:<a href="https://itunes.apple.com/vn/app/stemup-h%E1%BB%8Dc-sinh/id1405372828">&nbsp;Download STEMUP Học sinh</a></p>
		
		
		<h4><b>2.Đăng nhập</b></h4>
		<p id="content_helpmobile"><b>Sau khi tạo tải app về con sẽ xin email, Tên đăng nhập  và mật khẩu đăng nhập do phụ huynh tạo trước đó để đăng nhập thông qua các bước sau:</b></p>
		
		
		
		
		
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDHS/HDapp_student3.png') ?>" alt="">
		</div>
		
		
		
		<h4><b>3.Xem danh sách bài được giao.</b></h4>
		
		
		
		
		<p id="content_helpmobile">Sau khi đăng nhập thành công học sinh chưa thể làm bài được giao luôn mà phải đợi phụ huynh giao bài nhận thông báo và làm bài. Để xem danh sách bài giao học sinh thực hiện các bước sau:</p>
		
		
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDHS/HDapp_student4.png') ?>" alt="">
		</div>  
		
		
		
		<h4><b>4.Làm bài tập được giao</b></h4>
		
		
		
		
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
			<img class="img-responsive" src="<?php echo base_url('images/image_HDHS/HDapp_student5.png') ?>" alt="">
		</div>
		
		<p id="content_helpmobile">Sau Khi làm bài xong hệ thống sẽ tự động chuyển kết quả sang trang <b>Đã làm </b>và gửi thông báo đến phụ huynh.</p>
		
		
		
		<h4><b>5.Xem kết quả bài làm.</b></h4>
		
		
		
		
		<p id="content_helpmobile">Nội dung hiển thị kết quả sẽ bao gồm: Tên bài giao, kết quả , thưởng sao (nếu có) cho con sau khi làm xong bài và Số sao . Trang kết quả chi tiết hiển thị thông tin đáp án đúng màu xanh và đáp án  sai màu đỏ. Quy trình xem kết quả bài làm của học sinh diễn ra như sau:</p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDHS/HDapp_student6.png') ?>" alt="">
		</div>
		
		<p id="content_helpmobile">Ngoài ra, con cũng có thể xem kết quả thông qua các trang sau. Tại trang kết quả ngoài biết được % câu trả lời đúng, con có thể biết được con có vượt qua bài trắc nghiệm không.</p>
		
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDHS/HDapp_student7.png') ?>" alt="">
		</div>
		
		
		<h4><b>6.Làm bài tập ở trang Trang tự học.</b></h4>
		<p id="content_helpmobile"><b>- Làm câu hỏi trắc nghiệm</b><p>
		
		<p id="content_helpmobile">Tại trang tự học, hệ thống cung cấp các câu hỏi trắc nghiệm theo từng môn học và khối lớp. Con có thể xem và nhẫn chọn các đáp án cho câu hỏi.</p>
		
		
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDHS/HDapp_student8.png') ?>" alt="">
		</div>
		
		<p id="content_helpmobile"><b>-Làm bài tập trắc nghiệm vui do hệ thống cập nhật</b></p>
		
		<p id="content_helpmobile">Tại trang tự học con nhấn trang phần Trắc nghiệm vui để làm bài kiểm tra.</p>
		
		
		
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDHS/HDapp_student9.png') ?>" alt="">
		</div>
		<p id="content_helpmobile"><b>- Xem kết quả bài trắc nghiệm.</b><p>
		
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDHS/HDapp_student10.png') ?>" alt="">
		</div>
		
		
	</aside>	  
	  
     
    </section>
  	</main>





  </body>

 
</html>
