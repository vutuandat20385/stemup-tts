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
	<aside class="col-md-10 col-md-offset-1 help_content1">
		<h2 class="text-center">HƯỚNG DẪN SỬ DỤNG ỨNG DỤNG STEMUP PHỤ HUYNH </h2>
		<h4>Lưu ý: Trước khi người dùng đọc tài liệu, vui lòng tải ứng dụng STEMUP Phụ huynh trên hai nền tảng Android và Ios. Đồng thời, cài đặt song song app STEMUP HỌC SINH cho con để thực hiện các chức năng trên phần mềm.</h4>
		<h4>Dưới đây là chi tiết cách hướng dẫn download và sử dụng các tính năng trên app STEMUP Phụ huynh và STEMUP Học sinh.</h4>
		<h4><b>I. Cài đặt ứng dụng STEMUP Phụ huynh và STEMUP Học sinh.</b></h4>
		<h4 id="phare_helpmobile">Cách cài đặt STEMUP Phụ huynh: </h4>
		<p id="content_helpmobile"></p>
		<p id="content_helpmobile"><b>+ Đối với Hệ điều hành Android</b></p>
		<p class="vmb-20">
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD1app_parent.png') ?>" alt="">
		</div></p>
		<p id="content_helpmobile">Hoặc tải ứng dụng STEMUP Phụ huynh trên Hệ điều hành Android tại đây:<a href="https://play.google.com/store/apps/details?id=vn.dtt.stemup.student&hl=en">&nbsp;Download STEMUP Phụ huynh</a></p>
		
		<p id="content_helpmobile"><b>+ Với ios (iphone, ipad):</b></p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD2app_parent.png') ?>" alt="">
		</div>
		<p id="content_helpmobile">Hoặc tải ứng dụng STEMUP Phụ huynh trên Hệ điều hành iOS tại đây: <a href="https://itunes.apple.com/vn/app/stemup/id1446403154?mt=8">&nbsp;Download STEMUP Phụ huynh</a></p>
		
		
		
		
		<h4 id="phare_helpmobile">Cách cài đặt STEMUP Học sinh: </h4>
		<p id="content_helpmobile"><b>+ Với Android</b></p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD3app_parent.png') ?>" alt="">
		</div>
		<p id="content_helpmobile">Hoặc tải ứng dụng STEMUP Học sinh trên Hệ điều hành Android tại đây:<a href="https://play.google.com/store/apps/details?id=vn.dtt.mcq&hl=en">&nbsp;Download STEMUP Học sinh</a></p>
		<p id="content_helpmobile"><b>+ Với ios (iphone, ipad)</b></p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD4app_parent.png') ?>" alt="">
		</div>
		<p id="content_helpmobile">Hoặc tải ứng dụng STEMUP Học sinh trên Hệ điều hành iOS tại đây:<a href="https://itunes.apple.com/vn/app/stemup-h%E1%BB%8Dc-sinh/id1405372828">&nbsp;Download STEMUP Học sinh</a></p>
		
		
		<h4><b>II. Đăng ký/ Đăng nhập tài khoản STEMUP Phụ huynh.</b></h4>
		<p id="content_helpmobile"><b>- Đăng ký</b></p>
		
		
		
		<p id="content_helpmobile">Sau khi tải ứng dụng về thành công Phụ huynh cần thực hiện đăng ký tài khoản thông qua các bước sau:</p>
		
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD5app_parent.png') ?>" alt="">
		</div>
		
		
		<p id="content_helpmobile"><b>- Đăng nhập</b></p>
		<p id="content_helpmobile">Sau khi đăng ký thành công Phụ huynh tiến hành đăng nhập bằng tài khoản vừa tạo từ hệ thống.</p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD6app_parent.png') ?>" alt="">
		</div>

		<p id="content_helpmobile"><b>- Quên mật khẩu</b></p>
		<p id="content_helpmobile">Hệ thống bổ sung thêm tính năng <b>Quên mật khẩu</b> tại trang <b>Đăng nhập</b>, giúp người dùng cập nhật lại mật khẩu thông qua xác nhận email trong trường hợp không nhớ mật khẩu để đăng nhập vào tài khoản trên STEMUP Phụ huynh. Sau khi đổi mật khẩu thành công hệ thống sẽ gửi xác nhận đổi mật khẩu thành công về mail. </p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD20app_parent.png') ?>" alt="">
		</div>

		
		<h4><b>III. Tạo và Đăng nhập tài khoản STEMUP Học sinh.</b></h4>
		
		
		
		
		<p id="content_helpmobile">Sau khi đăng nhập vào tài khoản thành công Phụ huynh chưa thể thực hiện các chức năng giao bài trên app STEMUP Phụ huynh. Phụ huynh cần vào trang cấu hình để cập nhật thêm thông tin cá nhân và tạo tài khoản cho con để có thể sử dụng các tính năng.</p>
		<p id="content_helpmobile"><b>- Tạo tài khoản cho con trên STEMUP Phụ huynh</b></p>
		<p id="content_helpmobile">Trên trang Cấu hình, phụ huynh  tạo và đăng ký tài khoản cho con trong mục Quản lý hồ sơ con bằng cách nhấn chọn</p> <div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD7app_parent.png') ?>" alt="">
		</div>  <p id="content_helpmobile">hoặc nút Thêm con.Tài khoản của con được tạo có thể đăng nhập trên app STEMUP Học sinh hoặc trên website stemup. Phụ huynh có thể tạo nhiều tài khoản cho các con. Các bước tạo lập được thực hiện như sau: </p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD8app_parent.jpg') ?>" alt="">
		</div>
		
		<p id="content_helpmobile">Hướng dẫn nhập các trường trên trăng Thêm tài khoản con như sau:</p>
		<p id="content_helpmobile">+ Tên: Nhập tên con có thể viết hoa hoặc viết thường; có dấu hoặc không dấu.</p>
		<p id="content_helpmobile">+ Tên đăng nhập: dùng để đăng nhập vào tài khoản của con trên STEMUP Học sinh và stemup.app .Tên đăng nhập trùng tên con.</p>
		<p id="content_helpmobile">+ Nhập mật khẩu</p>
		<p id="content_helpmobile">+ Chọn lớp: Có thể thay đổi lớp cho con theo khối lớp theo học bằng cách nhấp vào mũi tên để chọn lớp.</p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD9app_parent.png') ?>" alt="">
		</div>
		<p id="content_helpmobile">Giao diện hồ sơ của con sau khi tạo xong.</p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
			<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD10app_parent.png') ?>" alt="">
		</div>
		
		
		<p id="content_helpmobile"><b>-	Xóa tài khoản của con.</b></p>
		<p id="content_helpmobile">Trường hợp phụ huynh muốn xóa những tài khoản con không dùng. Phụ huynh thực hiện các thao tác sau để xóa con.</p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD21app_parent.png') ?>" alt="">
		</div>
		
		<h4><b>IV. Xem và giao bài tập cho con.</b></h4>
		<h4><b>1.Giao bài Kĩ Năng Sống</b></h4>
		
		<p id="content_helpmobile">Quy trình giao bài tập trắc nghiệm Kỹ Năng Sống như sau:</p>
		
		
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD13app_parent.png') ?>" alt="">
		</div>
		<h4><b>2.Giao bài Học Cùng Con</b></h4>
		
		<p id="content_helpmobile">Quy trình giao bài Học Cùng Con cụ thể như sau:</p>
		
		
		
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD14app_parent.png') ?>" alt="">
		</div>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD15app_parent.png') ?>" alt="">
		</div>
		
		<h4><b>3.Xem thông tin bài vừa giao</b></h4>
		<p id="content_helpmobile">Sau khi phụ huynh xác nhận giao bài cho con xong. Hệ thống sẽ chuyển thông báo bài giao đến app STEMUP Học sinh và web stemup.app để học sinh có thể làm bài. Ngoài ra, để xem thông tin bài vừa giao xong Phụ huynh vào mục thông báo. Quy trình thực hiện như sau:</p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD16app_parent.png') ?>" alt="">
		</div>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD17app_parent.png') ?>" alt="">
		</div>
		<h4><b>4.Xem kết quả bài làm của con.</b></h4>
		<p id="content_helpmobile">Sau khi nhận thông tin kết quả bài làm đã giao của con, phụ huynh mở mục Thông báo và nhấn chọn kết quả bài làm để xem đáp án chi tiết. Kết quả chi tiết bài được giao sẽ được thể hiện đáp án đúng màu xanh, đáp án sai màu đỏ. Để xem kết quả của con Phụ huynh thực hiện các thao tác sau:</p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
			<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD18app_parent.png') ?>" alt="">
		</div>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
			<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD19app_parent.png') ?>" alt="">
		</div>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
			<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD22app_parent.png') ?>" alt="">
		</div>
		
		
		
		<h4><b>V. Góp ý cho ứng dụng STEMUP.</b></h4>
		<p id="content_helpmobile">Phụ huynh có thể góp ý và gửi phẩn hồi về ứng dụng STEMUP thông qua các bước sau:</p>
		<p id="content_helpmobile">+ Góp ý tính năng sử dụng.</p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
			<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD23app_parent.png') ?>" alt="">
		</div>
		<p id="content_helpmobile">+ Góp ý nội dung và đáp án câu hỏi.</p>
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
			<img class="img-responsive" src="<?php echo base_url('images/image_HDPH/HD24app_parent.png') ?>" alt="">
		</div>
		
	</aside>	  
	  
     
    </section>
  	</main>





  </body>

 
</html>
