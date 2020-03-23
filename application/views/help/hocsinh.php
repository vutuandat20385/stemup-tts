<!DOCTYPE html>
<html lang="en">
  <link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
  <?php $this->load->view('stemup/head');?>
  <script src="<?php echo base_url('js/left-menu.js');?>"></script>
  <script>
	//quizAssignTo();
	var base_url="<?php echo base_url();?>";
	var site_url="<?php echo site_url();?>";
	var su="<?php echo $su ?>";
	</script>
	
	<link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">
	
	<link href="<?php echo base_url('css/style-dat.css');?>" rel="stylesheet">
  <body class="bg-body">

<?php $this->load->view('stemup/header');?>
<main class="container MT70">
    
	<section class="row">
  	
  	    <aside class="col-md-10 col-md-offset-1 help_content2">
		<h2 class="text-center">HƯỚNG DẪN SỬ DỤNG ỨNG DỤNG STEMUP HỌC SINH </h2>
		<h4><b>1.Cách cài đặt STEMUP Học sinh: </b></h4>
		<p id="content_helpmobile">Phụ huynh có thể cài đặt hoặc con cùng có thể tự cài đặt app STEMUP Học sinh trên điện thoại (nếu có) thông qua các bước sau:</p>
		
		
		
		<p><b>+ Với Android:</b></p>
		
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDHS/HDapp_student1.png') ?>" alt="">
		</div>
		
		
		
		<p><b>+ Với ios (iphone, ipad):</b></p>
		<p id="content_helpmobile">Hoặc tải ứng dụng STEMUP Phụ huynh trên Hệ điều hành iOS tại đây</p>
		
		
		
		
		
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDHS/HDapp_student2.png') ?>" alt="">
		</div>
		
		
		
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
		
		
		<h4><b>6.Làm bài tập trên trang Trang tự học.</b></h4>
		<h5><b>- Làm câu hỏi trắc nghiệm</b></h5>
		
		<p id="content_helpmobile">Tại trang tự học, hệ thống cung cấp các câu hỏi trắc nghiệm theo từng môn học và khối lớp. Con có thể xem và nhẫn chọn các đáp án cho câu hỏi.</p>
		
		
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDHS/HDapp_student8.png') ?>" alt="">
		</div>
		
		<h5><b>-Làm bài tập trắc nghiệm vui do hệ thống cập nhật</b></h5>
		
		<p id="content_helpmobile">Tại trang tự học con nhấn trang phần Trắc nghiệm vui để làm bài kiểm tra.</p>
		
		
		
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDHS/HDapp_student9.png') ?>" alt="">
		</div>
		<h5><b>- Xem kết quả bài trắc nghiệm.</b></h5>
		
		<div class="help_mobile_dl col-md-12 col-sm-12 col-xs-12">
		<img class="img-responsive" src="<?php echo base_url('images/image_HDHS/HDapp_student10.png') ?>" alt="">
		</div>
		
		
	</aside>
	  
	  
      

    </section>
	
  	</main>

  	
	<?php $this->load->view('stemup/footer');?>
  </body>
    
  </html>
