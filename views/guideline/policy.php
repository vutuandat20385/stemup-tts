<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chính sách riêng tư</title>
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/ico.png');?>"/>
    <!-- Bootstrap -->
	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
	  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	 <script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>

	<script src="<?php echo base_url('js/newpage.js');?>"></script>
		<script src="<?php echo base_url('js/signup.js');?>"></script>
   <script>	
	var base_url="<?php echo base_url();?>";
    var site_url="<?php echo site_url();?>";
	var su="<?php echo $su ?>";
	var id_mcq_fun="<?php echo $id_mcq_fun ?>";
	var id_quiz_fun="<?php echo $id_quiz_fun ?>";
	</script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> <script> (adsbygoogle = window.adsbygoogle || []).push({ google_ad_client: "ca-pub-3948834986570227", enable_page_level_ads: true }); </script>
  </head>
  <body class="bg-body">
  <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php     
	            if($this->session->flashdata('message_r')){echo '<script>$(document).ready(function(){$("#error_login").modal();});</script>';} 
				
				?>	

<nav class="navbar navbar-stem navbar-fixed-top">
  <div class="container">
  	    <!-- Brand and toggle get grouped for better mobile display -->
  	    	 <div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1" aria-expanded="false">
				  <span class="sr-only">Toggle navigation</span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand navbar-brand1" href="<?php echo site_url('home') ?>">
					<img class="hidden-xs" src="<?php echo base_url('images/hu_logo_home1.png');?>" alt="">
					<img class="visible-xs-block logo-s" src="<?php echo base_url('images/hu_logo_home1.png');?>" height="32" alt="">
			  </a>
			<div class="pull-right text-trang-mobile visible-xs-block">
				
				
				<a class="text-trang hover" data-toggle="dropdown">
					<i class="far fa-bell"></i>
					<span class="badge badge-sm up bg-pink count ncount"></span>
				</a>
				<a href="#" class="text-trang hover " data-toggle="collapse" data-target="#search_top" id="icosearch_top">
					<i class="fas fa-search"></i>
				</a>
			     
			</div>
	    </div>
  	     <!-- Collect the nav links, forms, and other content for toggling -->
		<div class="panel-collapse collapse" id="search_top">
			 <form class="navbar-form navbar-left" role="search">
			  <div class="input-group">
			    <input id="inpsearch_top" class="form-control form-TK1 w350" placeholder="Tìm kiếm" type="text">
			    <a href="#" class="input-group-addon addon-TK1 searchbt"><i class="fa fa-search" aria-hidden="true"></i></a>
			  </div>
			</form>
		</div>
		<div class="panel-collapse" id="search_top_dt">
			 <form class="navbar-form navbar-left" role="search">
			  <div class="input-group">
			    <input id="inpsearch_top_dt" class="form-control form-TK1 w350" placeholder="Tìm kiếm" type="text" onkeyup="search_question(this, event)" >
			    <a href="#" class="input-group-addon addon-TK1 searchbt"><i class="fa fa-search" aria-hidden="true"></i></a>
			  </div>
			</form>
		</div>
  	    <div class="collapse navbar-collapse" id="defaultNavbar1">
  	         <div class="row" style="float:right; margin-top:10px">
					
		
				 
					<div class="form-group col-md-3 col-xs-6 hidden-xs">	  
						 
					
						<button class="btn btn-sm btn-default btn-primary pull-right mb-5 dropdown-toggle" type="button" data-toggle="dropdown">Đăng nhập</button>
						 <div class="dropdown-menu " style="margin-left:-260px;">
						     <div class="arrow_box arrow-box-top"></div>
							 <div style="padding:10px">
								<form class="form-signin" method="post" action="<?php echo site_url('login/verifylogin');?>">
								     <div id="error" style="color: red;"></div>
								     <div id="ok" style="color: green"></div>
									 <input class="page-signin-form-control form-control" name="email" style="width:350px;margin:10px" placeholder="<?php echo $this->lang->line('email_address');?>" type="text" required autofocus id="email">
									 <input class="page-signin-form-control form-control" name="password" style="width:270px;margin:10px" id="inputPassword" placeholder="<?php echo $this->lang->line('password');?>" type="password" required>
		                           	<input style="margin: 10px;" name="remember" type="checkbox">Tự động đăng nhập
									 <button style="z-index:2; margin-top:-42px; margin-right:17px"class="btn btn-sm btn-default btn-primary pull-right mb-5" type="submit" id="btn_subit">Đăng nhập</button>
									 
									 <!--<table>
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
									 <script type="text/javascript">
									 	$('#btn_subit').on('click',function(){
									 		var username = $("#email").val();
									 		var password = $("#inputPassword").val();
									 		var error = $("#error");
									 		var ok = $("#ok");
							 				// resert 2 thẻ div thông báo trở về rỗng mỗi khi click nút đăng nhập
											error.html("");
											//ok.html("");
 
											// Kiểm tra nếu username rỗng thì báo lỗi
											if (username == "") {
												console.log('wetgw rthwrth5555');
												error.html("Địa chỉ Email không được để trống");
												return false;
											}
											if (password == "") {
												console.log('wetgw rthwrth5555');
												error.html("Password không được để trống");
												return false;
											}
											
											// Kiểm tra nếu password rỗng thì báo lỗi
											/*if (password == "") {
												console.log('mat khau khong de trng');
												error.html("Mật khẩu không được để trống");
												return false;
											}*/

											// Chạy ajax gửi thông tin username và password về server check_dang_nhap.php
											// để kiểm tra thông tin đăng nhập hợp lệ hay chưa
											/*$.ajax({

											  url: "Signup/create_user",
											  method: "POST",
											  data: { email : username, password : password },
											  success : function(response){
											  	if (response == "1") {
											  		ok.html("Đăng nhập thành công!");
											  	console.log('agadfdafgsdfg');
											  	}else{
											  		error.html("Password không được để trống!");
											  		console.log('da33333333333333333');
											  	}
											  }
											});*/
										});
									 </script>
								 </form>
							 </div>
							 
						 </div>
					</div>

                    <button class="btn btn-sm btn-default btn-primary mb-5 hidden-dt" type="button" onclick="login()">Đăng nhập</button>
					<button type="submit" class="btn btn-sm btn-default btn-success" onclick="signup()">Đăng ký</button>
 	        
          
        </div>
  	    <!-- /.navbar-collapse -->
  </div>
  	  <!-- /.container-fluid -->
	<section class="visible-xs-block nav-mobile">
			<ul class="ul-mobile list-unstyled">
				<li><a href="<?php echo site_url("home")?>">Câu hỏi vui</a></li>
				<li><a  href="<?php echo site_url("home/quiz_list")?>">Trắc nghiệm</a></li>
				<li><a  href="<?php echo site_url("home/about")?>">Giới thiệu</a></li>
				<li><a  class="pointer" data-toggle="collapse" data-target="#more_menu">...</a></li>
			</ul>  
		<ul id="more_menu" class="panel-collapse collapse ul-mobile list-unstyled">	
	         <li><a  href="<?php echo site_url("home/about")?>">Hướng dẫn</a></li>
			 <li><a href="<?php echo site_url("home/about")?>">Điều khoản sử dụng</a></li>
		</ul>
	</section>
	  
  </nav><!--end nav-->
<main class="container MT70">
   <!-- <div class="event-banner" style="margin-bottom:10px">
		<a href="http://vui.stem.vn/chia-se-tri-thuc-stem-de-nhan-mua-phan-thuong/"><img class="img-responsive" src= "<?php echo base_url("images/event_banner.jpg") ?>"></a>
	</div>-->
    
	<section class="row">
  	  <aside class="col-md-2 hidden-xs">
	  
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
  	  </aside>  
	<aside class="col-md-10">
		  <div role="tabpanel" class="tab-pane fade in active" id="home2a">
			<div class="box-bor MB20">
				<div role="tabpanel">
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
				   <div id="tabContent1" class="tab-content">
					  
					  <div role="tabpanel" class="tab-pane fade in active pad" id="tabDropDownOne1">
						
						<h3 class="text-center"><strong>Chính sách quyền riêng tư</strong></h3>
					   	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stem.vn kết bảo vệ các thông tin riêng tư trực tuyến của bạn. Việc sử dụng Stem.vn được  hiểu là bạn chính thức đồng ý với nội dung được mô tả trong chính sách sau đây. Chính sách này có thể thay đổi và bạn nên kiểm tra lại trong quá trình sử dụng. </p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Các bài đăng trên Stem.vn có thể chứa các liên kết tới các site khác mà chúng tôi không kiểm soát. Công ty sở hữu và điều hành Stem.vn không chịu trách nhiệm về các chính sách bảo mật hoặc việc thực hiện chúng của các site mà bạn kết nối tới từ Stem.vn. Chính sách Bảo mật này chỉ áp dụng cho các thông tin mà chúng tôi thu thập trên Stem.vn và không áp dụng cho thông tin mà chúng tôi thu thập được theo cách khác. </p>  
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Chúng tôi dùng thông tin cá nhân được tập hợp trên Stem.vn nhằm mục đích điều hành và cải tiến chất lượng Stem.vn, tăng cường tiện ích và sự hài lòng, thực hiện tốt hơn việc thông báo, tương tác giữa hệ thống với người dùng cũng như kết nối người dùng với nhau.</p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Khi được hỏi về các thông tin cá nhân trên Stem.vn, có nghĩa là bạn đang chia sẻ thông tin đó với riêng Stem.vn, trừ phi có thông báo cụ thể khác. Tuy nhiên, một số hoạt động do đặc trưng của chúng, sẽ dẫn đến việc thông tin cá nhân của bạn được tiết lộ cho những người dùng khác của Stem.vn biết.Chúng tôi không tiết lộ cho bên thứ ba thông tin cá nhân của bạn, hoặc thông tin về việc sử dụng Stem.vn của bạn ngoại trừ các mục sau đây:</p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>1.</b>&nbsp;&nbsp;Chúng tôi có thể để lộ thông tin đó cho các nhóm thứ ba nếu bạn đồng ý. Ví dụ, nếu bạn cho biết bạn muốn nhận thông tin về các sản phẩm, dịch vụ hay quà tặng của bên thứ ba khi đăng ký một tài khoản trên Stem.vn, chúng tôi có thể cung cấp thông tin liên hệ của bạn cho bên thứ ba đó. Chúng tôi có thể dùng dữ liệu đã có về bạn để xác định xem liệu bạn có thể quan tâm đến các sản phẩm hay dịch vụ của một bên thứ ba cụ thể nào không.</p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>2.</b>&nbsp;&nbsp;Chúng tôi có thể tiết lộ thông tin đó cho các công ty và cá nhân mà chúng tôi thuê để thay mặt chúng tôi thực hiện các chức năng của công ty. Ví dụ, việc lưu giữ các máy chủ web, phân tích dữ liệu, cung cấp các trợ giúp về marketing, xử lý thẻ tín dụng hoặc các hình thức thanh toán khác, và dịch vụ cho khách hàng. Những công ty và cá nhân này sẽ truy cập tới thông tin cá nhân của bạn khi cần để thực hiện các chức năng của họ, nhưng không chia sẻ thông tin đó với bất kỳ bên thứ ba nào khác.</p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>3.</b>&nbsp;&nbsp;Chúng tôi có thể tiết lộ thông tin đó nếu có yêu cầu pháp lý, hay từ một cơ quan chính phủ hoặc nếu chúng tôi tin rằng hành động đó là cần thiết nhằm: 
                            <ul>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(a) tuân theo các yêu cầu pháp lý hoặc chiếu theo quy trình của luật pháp; </ul>
                            <ul>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(b) bảo vệ các quyền hay tài sản của các đối tác; </ul>
                            <ul>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(c) ngăn chặn tội phạm hoặc bảo vệ an ninh quốc gia;  </ul>
                            <ul>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(d) bảo vệ an toàn cá nhân của những người sử dụng hay công chúng.</ul>
                        </p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>4.</b>
                        &nbsp;&nbsp;Chúng tôi có thể tiết lộ và chuyển thông tin đó tới một nhóm thứ ba, đối tượng mua lại toàn bộ hay phần lớn công việc kinh doanh của công ty , bằng cách liên kết, hợp nhất hoặc mua toàn bộ hay phần lớn các tài sản của chúng tôi. Ngoài ra, trong tình huống công ty trở thành đối tượng của một vụ khởi kiện phá sản, dù tự nguyện hay miễn cưỡng, thì công ty hay người được uỷ thác có thể bán, cho phép hoặc tiết lộ thông tin như vậy theo cách khác trong quá trình chuyển giao được toà án về phá sản đồng ý.
                            <ul>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Chúng tôi cung cấp cho bạn các phương tiện đảm bảo thông tin cá nhân của bạn là chính xác và cập nhật. Bạn có thể hiệu chỉnh hoặc xoá hồ sơ của bạn bất cứ lúc nào.</ul>
                            <ul>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ngoài người quản trị Stem.vn  hoặc cá nhân được uỷ quyền khác của Stem.vn, bạn là người duy nhất được truy nhập thông tin cá nhân của mình. Chúng tôi khuyến nghị bạn không để lộ mật khẩu của bạn cho bất kỳ ai. </ul>
                            <ul>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Không có dữ liệu nào truyền trên Internet có thể bảo đảm an toàn 100%. Vì vậy, mặc dù chúng tôi cố gắng tối đa bảo vệ thông tin cá nhân của bạn, Stem.vn có thể không thể bảo đảm hoặc cam kết về tính an toàn của thông tin bất kỳ mà bạn chuyển tới chúng tôi hoặc từ dịch vụ trực tuyến của chúng tôi, và bạn phải tự chịu rủi ro. Ngay khi chúng tôi nhận được thông tin bạn gửi tới, chúng tôi sẽ cố gắng hết sức để bảo đảm an toàn trên hệ thống của chúng tôi.</ul>
                        </p>
                        <h3><p class="text-right" style="padding-right:30px"><b>Stem.vn</b></p></h3>
                      </div>
<!--------------------------------------------------------------------------------------------------------------------------------------------------->
					  
<!--------------------------------------------------------------------------------------------------------------------------------------------------->
					  
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
				  </div>
				</div>
			</div>
		  </div><!--CMQ-->
      </aside>	

     
    </section>
  	</main>
  	

  </body>

 
</html>
