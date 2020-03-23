<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Điều khoản sử dụng</title>
<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
	<!-- Web fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<!-- Bootstrap -->

	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/login.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-home.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('js/signup.js');?>"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
   <!-- <script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->
   <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> <script> (adsbygoogle = window.adsbygoogle || []).push({ google_ad_client: "ca-pub-3948834986570227", enable_page_level_ads: true }); </script>
</head>
<body>
<header class="bg-den">
   <?php     
	            if($this->session->flashdata('message_r')){echo $this->session->flashdata('message_r');} 
				if($this->session->flashdata('message')){
					?>
					
					<?php echo str_replace('{resend_url}',site_url('login/resend'),$this->session->flashdata('message'));?>
					
				<?php	
				}
				?>	
	<div class="container">
		 
		<div class="row">
				
			<div class="col-md-7 col-xs-6">
			<button class="btview" data-toggle="collapse" data-target="#relatedsite">Hệ sinh thái STEM</button>
				<!--<button class="btview" data-toggle="collapse" data-target="#demo">View related sites</button>

				<div id="demo" class="collapse">
					<div class="row">
						<ul class="col-md-4">
							<li><a href="">Toán vui cho người thông minh: Thay dấu hỏi bằng số nào? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate quisquam dolor eligendi sint commodi iusto quibusdam nihil id. In sunt dolorem aspernatur. Quis ratione quisquam illum facilis, adipisci in eum.</a></li>
							<li><a href="">Thiết kế Kỹ thuật Sáng tạo</a></li>
							<li><a href="">Trong cơ thể người, cơ quan nào lớn nhất? </a></li>
							<li><a href="">Trên thế giới có bao nhiêu người mắt xanh lá cây? </a></li>
							<li><a href="">Các mô hình giáo dục stem hiện nay? </a></li>
						</ul>
					</div>
				</div> -->
			</div>
				<?php if($clogin == 0) { ?>
			
			<div class="col-md-5 col-xs-6">
				<div class="row" style="float:right">
					<!-- <div class="col-md-4"> -->
						<!-- <div class="input-group-sm mb-5">
						  <input type="text" class="form-control" placeholder="Username">
						</div> -->
		
				 
					<div class="form-group col-md-3 col-xs-6">	  
						 
						<!--<button class="btn btn-sm btn-default btn-primary pull-right mb-5" type="submit">Đăng nhập</button>-->
						<button class="btn btn-sm btn-default btn-primary pull-right mb-5 dropdown-toggle" type="button" data-toggle="dropdown">Đăng nhập</button>
						 <div class="dropdown-menu" style="margin-left:-260px">
						     <div class="arrow_box arrow-box-top"></div>
							 <div style="padding:10px">
								<form class="form-signin" method="post" action="<?php echo site_url('login/verifylogin');?>">
								     
									 <input class="page-signin-form-control form-control" name="email" style="width:350px;margin:10px" placeholder="<?php echo $this->lang->line('email_address');?>" type="text" required autofocus>
									 <input class="page-signin-form-control form-control" name="password" style="width:270px;margin:10px" id="inputPassword" placeholder="<?php echo $this->lang->line('password');?>" type="password" required  >
		                           	<input style="margin: 10px;" name="remember" type="checkbox">Tự động đăng nhập
									 <button style="z-index:2; margin-top:-42px; margin-right:17px"class="btn btn-sm btn-default btn-primary pull-right mb-5" type="submit">Đăng nhập</button>
									 
									<!-- <table>
										 <tr>
											<td style="padding:10px">
												<a class="btn"  style="background:#3C66C4;color:#ffffff;" href="<?php echo  site_url('hauth/login/Facebook');?>" > <i class="fab fa-facebook-f"></i> Đăng nhập với Facebook </a>
											 </td>
											 <td style="padding:10px">
												<a class="btn btn-danger"  href="<?php echo  site_url('sso/login');?>" > <i class="fab fa-google"></i> Đăng nhập với Itrithuc.vn </a>
											 </td>
										 </tr>
									 </table>-->
									 <a href="#" data-toggle="modal" data-target="#resetpwdModal" style="float:right; padding:10px"> Quên mật khẩu</a>
								 </form>
							 </div>
							 
						 </div>
					</div>


					<button type="submit" class="btn btn-sm btn-default btn-success" onclick="signup()">Đăng ký</button>
					
				</div>
			</div>
				<?php }  else {?>
			    <div class="col-md-offset-9">
					<div class="col-xs-2"><a href="<?php echo site_url('home_user/');?>">
					<?php if($link_photo) { ?>
    			    <img id="avt" class=" img-circle MR5" src="<?php echo $link_photo;?> " alt="" width="32" height="32">
    			<?php } else{ ?>   
    			   <img id="avt" class=" img-circle MR5" src="<?php echo base_url('upload/avatar/default.png');?> " alt="" width="32">
    			<?php } ?> 
					</a></div>
					<div class="col-xs-9">
						  <a href="<?php echo site_url('home_user/');?>" class="border-B1" style="color:#FFF"><?php echo $user_name; ?></a>
					</div>
			     </div>
			<?php } ?>
		</div>
	</div>

	<div id="relatedsite" class="collapse">
		<div class="row">
			<div class="col-md-4" style="margin-left:100px;">
				<ul>
					<li>
						<i class="fas fa- 
caret caret_e 
-right" style="color:#9E9E9E"></i>
				       <a class="rellink" href="https://stem.vn" target="_blank">Trang chính thức stem.vn</a>
				   </li>
				   <li>
                        <i class="fas fa- 
caret caret_e 
-right" style="color:#9E9E9E"></i>
				        <a class="rellink" href="https://vui.stem.vn" target="_blank">Trang Vui</a>
				    </li>
					 <li>
                        <i class="fas fa- 
caret caret_e 
-right" style="color:#9E9E9E"></i>
				        <a class="rellink" href="https://www.stem.vn/vi_VN/all-courses" target="_blank">Trang Học</a>
				    </li>
					 <li>
                        <i class="fas fa- 
caret caret_e 
-right" style="color:#9E9E9E"></i>
				        <a class="rellink" href="https://www.stem.vn/vi_VN/forum/stem-forum-2" target="_blank">Trang Hỏi</a>
				    </li>
			    </ul>
			</div>
		</div>
	</div>
</header>
	<!--nav-->
<nav class="container">
  <div class="row padTB10">
		<div class="col-md-3"><a href="<?php echo base_url('');?>"><img class="img-responsive" src="<?php echo base_url('images/logo.png');?>" alt=""></a></div>
		<div class="col-md-3 col-md-offset-6">
			<div class="input-group mt-5">
			  <input type="text" class="form-control">
			  <a class="input-group-addon" href=""><i class="fas fa-search"></i></a>
			</div>
		</div
	</div>
</nav>
<img class="img-responsive col-md-10 col-md-offset-1" src="<?php echo base_url('images/home_anh15.jpg');?>" alt="">	
 <h1  style="text-align:center" class="col-md-10 col-md-offset-1"> <b>Điều khoản sử dụng: </b></h1>
 <h4  class="col-md-8 col-md-offset-2"> 
 Bản quy chế này áp dụng cho các thành viên đăng ký sử dụng Mạng xã hội Stem.vn. Thành viên tham gia là cá nhân phải đăng ký và được Stem.vn công nhận, cho phép sử dụng dịch vụ. Người sử dụng phải đảm bảo các thông tin cá nhân cung cấp cho chúng tôi là trung thực, mới nhất và chính xác. Các thông tin thành viên chỉ được dùng để: Cung cấp tài khoản, bao gồm dịch vụ, tiện ích và sự hỗ trợ, chăm sóc… nhằm nâng cao chất lượng ngân hàng MCQ; giải quyết các vấn đề hay tranh chấp phát sinh khi thành viên sử dụng các MCQ. 
  </h4>
<h4 class="col-md-8 col-md-offset-2">
	Các thông tin đăng ký không được tiết lộ, chuyển nhượng, cho thuê hoặc bán cho bên thứ ba khi chưa được sự đồng ý của các bên liên quan, trừ trường hợp có yêu cầu cơ quan chức năng. Stem.vn có trách nhiệm hỗ trợ cơ quan quản lý nhà nước điều tra các hành vi kinh doanh vi phạm pháp luật; cung cấp các tài liệu như thông tin đăng ký, lịch sử dữ liệu giao dịch… của đối tượng có hành vi vi phạm pháp luật trên hệ thống.
</h4>
<h4 class="col-md-8 col-md-offset-2">
 Người sử dụng có trách nhiệm tự bảo vệ mật khẩu của mình trên Stem.vn. Chúng tôi khuyến khích bạn nên dùng mật khẩu mang tính bảo mật cao (bao gồm chữ thường, chữ hoa, chữ số và ký hiệu cho phép). Chủ tài khoản phải hoàn toàn chịu trách nhiệm cho mọi hoạt động được thực hiện dưới tên tài khoản và mật khẩu đã đăng kí.
</h4>	 
<h4 class="col-md-8 col-md-offset-2" >
	Người sử dụng không tái bản, sao chụp, bán, bán lại hoặc lợi dụng bất kỳ phần nào của Stem.vn cho mục đích thương mại, nếu không được chúng tôi  cho phép bằng văn bản. 
</h4>
<h4 class="col-md-8 col-md-offset-2">
Stem.vn có quyền cập nhật, chỉnh sửa nội dung các điều khoản mà không cần báo trước. Và khi bạn tiếp tục sử dụng mạng xã hội Stem.vn  sau khi các thay đổi về điều khoản và điều kiện được đăng tải, có nghĩa là bạn chấp nhận những thay đổi đó.
</h4>				

<h4 class="col-md-8 col-md-offset-2">
<b>Về việc trao đổi, chia sẻ, cung cấp thông tin trên Stem.vn</b>
</h4>	  
<h4 class="col-md-8 col-md-offset-2">
Người sử dụng hiểu rằng các nội dung được đăng tải trên Stem.vn, dù là công khai hoặc được truyền đưa riêng, hoàn toàn thuộc vể trách nhiệm của người tạo ra nội dung đó. Điều này có nghĩa là bạn phải hoàn toàn chịu trách nhiệm với:  Toàn bộ nội dung mà bạn tải lên, đăng, gửi, truyền đưa hoặc tạo sẵn;  việc bạn tiếp xúc, sử dụng những nội dung của người khác trên Stem.vn hoặc với bất cứ tổn thất nào phát sinh từ việc bạn tiếp xúc, sử dụng chúng.
</h4>
<h4 class="col-md-8 col-md-offset-2">
Người sử dụng hoàn toàn chịu trách nhiệm trước pháp luật về các nội dung do bạn đưa lên mạng xã hội Stem.vn. 
</h4>
<h4 class="col-md-8 col-md-offset-2">
Người sử dụng cam kết không đăng tải, trao đổi, chia sẻ trên mạng xã hội Stem.vn các nội dung bị cấm theo khoản 1, điều 5, Nghị định 72/2013/NĐ-CP về quản lý, cung cấp sử dụng dịch vụ Internet và thông tin trên mạng; đồng thời cam kết tuân thủ mọi quy định của pháp luật về chia sẻ, trao đổi thông tin, quảng cáo, khuyến mại, bảo vệ quyền sở hữu trí tuệ, bảo vệ quyền lợi người tiêu dùng và các quy định của pháp luật có liên quan khác khi sử dụng mạng xã hội Stem.vn.
</h4>
<h4 class="col-md-8 col-md-offset-2">
Stem.vn được sử dụng, tái sản xuất, xuất bản, cung  cấp, dịch và tạo ra các phiên bản phái sinh từ các nội dung được người dùng đăng tải lên Stem.vn. Các nội dung này có thể tiếp tục thuộc giao diện nội dung trên Stem.vn ngay cả khi tài khoản của người sử dụng đã bị xóa vì bất kỳ lý do gì. Chúng tôi cũng có quyền từ chối xuất bản, loại bỏ bất kỳ nội dung nào mà người sử dụng đã cung cấp trên Stem.vn hoặc  xử lý các thông tin đăng tải cho phù hợp với thuần phong mỹ tục, các quy tắc đạo đức và các quy tắc đảm bảo an ninh quốc gia. Chúng tôi có toàn quyền cho phép hoặc không cho phép bài viết của người sử dụng xuất hiện hay tồn tại trên Stem.vn.
</h4>
<h4 class="col-md-8 col-md-offset-2">
Stem.vn được sử dụng, tái sản xuất, xuất bản, cung  cấp, dịch và tạo ra các phiên bản phái sinh từ các nội dung được người dùng đăng tải lên Stem.vn. Các nội dung này có thể tiếp tục thuộc giao diện nội dung trên Stem.vn ngay cả khi tài khoản của người sử dụng đã bị xóa vì bất kỳ lý do gì. Chúng tôi cũng có quyền từ chối xuất bản, loại bỏ bất kỳ nội dung nào mà người sử dụng đã cung cấp trên Stem.vn hoặc  xử lý các thông tin đăng tải cho phù hợp với thuần phong mỹ tục, các quy tắc đạo đức và các quy tắc đảm bảo an ninh quốc gia. Chúng tôi có toàn quyền cho phép hoặc không cho phép bài viết của người sử dụng xuất hiện hay tồn tại trên Stem.vn.
</h4>
<h4 class="col-md-8 col-md-offset-2">
Để đảm bảo hoạt động lành mạnh và thông suốt của mạng xã hội Stem.vn, Ban quản trị diễn đàn có quyền xoá các nội dung bạn đăng tải, hủy tư cách thành viên, tạm dừng hoặc hủy cung cấp dịch vụ cho của bạn mà không cần báo trước nếu chúng tôi tin rằng bạn có hành động vi phạm các điều khoản trên. 
</h4>

<section class="container-fluid">
		
	</section>
</html>
