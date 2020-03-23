<!DOCTYPE html>
<html lang="en">
<head>

	<title>STEMUP</title>
	<?php $this->load->view('stemup/head_not_login');?>
	<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/faq.css');?>" rel="stylesheet">
</head>
<style>
.pointer {cursor: pointer;};
.tab-pane {
    min-height: 60px !important;
}
</style>
<body>
	<header class="container-fluid bg-stemup hidden-xs">
		<div class="container">	<?php $this->load->view('stemup/home/home_header');?>	</div>
	</header>
    <nav class="navbar navbar-default mb-6">
        <div class="container">
            <?php $this->load->view('stemup/home/home_header_mobile');?>
            <?php $this->load->view('stemup/menu_top'); ?>			
        </div>
    </nav>
        <div role="tabpanel" class="container" id="home2a">
			<div class="box-bor MB20">
				<div role="tabpanel">
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
				   <div id="tabContent1" class="tab-content">
					  
					  <div role="tabpanel" class="tab-pane fade in active pad" id="tabDropDownOne1">
						
						<h3 class="text-center"><strong>Chính sách quyền riêng tư</strong></h3>
					   	<p class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stemup.app kết bảo vệ các thông tin riêng tư trực tuyến của bạn. Việc sử dụng Stemup.app được  hiểu là bạn chính thức đồng ý với nội dung được mô tả trong chính sách sau đây. Chính sách này có thể thay đổi và bạn nên kiểm tra lại trong quá trình sử dụng. </p>
                        <p class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Các bài đăng trên Stemup.app có thể chứa các liên kết tới các site khác mà chúng tôi không kiểm soát. Công ty sở hữu và điều hành Stemup.app không chịu trách nhiệm về các chính sách bảo mật hoặc việc thực hiện chúng của các site mà bạn kết nối tới từ Stemup.app. Chính sách Bảo mật này chỉ áp dụng cho các thông tin mà chúng tôi thu thập trên Stemup.app và không áp dụng cho thông tin mà chúng tôi thu thập được theo cách khác. </p>  
                        <p class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Chúng tôi dùng thông tin cá nhân được tập hợp trên Stemup.app nhằm mục đích điều hành và cải tiến chất lượng Stemup.app, tăng cường tiện ích và sự hài lòng, thực hiện tốt hơn việc thông báo, tương tác giữa hệ thống với người dùng cũng như kết nối người dùng với nhau.</p>
                        <p class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Khi được hỏi về các thông tin cá nhân trên Stemup.app, có nghĩa là bạn đang chia sẻ thông tin đó với riêng Stemup.app, trừ phi có thông báo cụ thể khác. Tuy nhiên, một số hoạt động do đặc trưng của chúng, sẽ dẫn đến việc thông tin cá nhân của bạn được tiết lộ cho những người dùng khác của Stemup.app biết.Chúng tôi không tiết lộ cho bên thứ ba thông tin cá nhân của bạn, hoặc thông tin về việc sử dụng Stemup.app của bạn ngoại trừ các mục sau đây:</p>
                        <p class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>1.</b>&nbsp;&nbsp;Chúng tôi có thể để lộ thông tin đó cho các nhóm thứ ba nếu bạn đồng ý. Ví dụ, nếu bạn cho biết bạn muốn nhận thông tin về các sản phẩm, dịch vụ hay quà tặng của bên thứ ba khi đăng ký một tài khoản trên Stemup.app, chúng tôi có thể cung cấp thông tin liên hệ của bạn cho bên thứ ba đó. Chúng tôi có thể dùng dữ liệu đã có về bạn để xác định xem liệu bạn có thể quan tâm đến các sản phẩm hay dịch vụ của một bên thứ ba cụ thể nào không.</p>
                        <p class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>2.</b>&nbsp;&nbsp;Chúng tôi có thể tiết lộ thông tin đó cho các công ty và cá nhân mà chúng tôi thuê để thay mặt chúng tôi thực hiện các chức năng của công ty. Ví dụ, việc lưu giữ các máy chủ web, phân tích dữ liệu, cung cấp các trợ giúp về marketing, xử lý thẻ tín dụng hoặc các hình thức thanh toán khác, và dịch vụ cho khách hàng. Những công ty và cá nhân này sẽ truy cập tới thông tin cá nhân của bạn khi cần để thực hiện các chức năng của họ, nhưng không chia sẻ thông tin đó với bất kỳ bên thứ ba nào khác.</p>
                        <p class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>3.</b>&nbsp;&nbsp;Chúng tôi có thể tiết lộ thông tin đó nếu có yêu cầu pháp lý, hay từ một cơ quan chính phủ hoặc nếu chúng tôi tin rằng hành động đó là cần thiết nhằm: 
                            </p><ul class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(a) tuân theo các yêu cầu pháp lý hoặc chiếu theo quy trình của luật pháp; </ul>
                            <ul class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(b) bảo vệ các quyền hay tài sản của các đối tác; </ul>
                            <ul class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(c) ngăn chặn tội phạm hoặc bảo vệ an ninh quốc gia;  </ul>
                            <ul class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(d) bảo vệ an toàn cá nhân của những người sử dụng hay công chúng.</ul>
                        <p></p>
                        <p class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>4.</b>
                        &nbsp;&nbsp;Chúng tôi có thể tiết lộ và chuyển thông tin đó tới một nhóm thứ ba, đối tượng mua lại toàn bộ hay phần lớn công việc kinh doanh của công ty , bằng cách liên kết, hợp nhất hoặc mua toàn bộ hay phần lớn các tài sản của chúng tôi. Ngoài ra, trong tình huống công ty trở thành đối tượng của một vụ khởi kiện phá sản, dù tự nguyện hay miễn cưỡng, thì công ty hay người được uỷ thác có thể bán, cho phép hoặc tiết lộ thông tin như vậy theo cách khác trong quá trình chuyển giao được toà án về phá sản đồng ý.
                            </p><ul class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Chúng tôi cung cấp cho bạn các phương tiện đảm bảo thông tin cá nhân của bạn là chính xác và cập nhật. Bạn có thể hiệu chỉnh hoặc xoá hồ sơ của bạn bất cứ lúc nào.</ul>
                            <ul class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ngoài người quản trị Stemup.app  hoặc cá nhân được uỷ quyền khác của Stemup.app, bạn là người duy nhất được truy nhập thông tin cá nhân của mình. Chúng tôi khuyến nghị bạn không để lộ mật khẩu của bạn cho bất kỳ ai. </ul>
                            <ul class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Không có dữ liệu nào truyền trên Internet có thể bảo đảm an toàn 100%. Vì vậy, mặc dù chúng tôi cố gắng tối đa bảo vệ thông tin cá nhân của bạn, Stemup.app có thể không thể bảo đảm hoặc cam kết về tính an toàn của thông tin bất kỳ mà bạn chuyển tới chúng tôi hoặc từ dịch vụ trực tuyến của chúng tôi, và bạn phải tự chịu rủi ro. Ngay khi chúng tôi nhận được thông tin bạn gửi tới, chúng tôi sẽ cố gắng hết sức để bảo đảm an toàn trên hệ thống của chúng tôi.</ul>
                        <p></p>
                        <h3><p class="text-right" style="padding-right:30px"><b>Stemup.app</b></p></h3>
                      </div>
<!--------------------------------------------------------------------------------------------------------------------------------------------------->
					  
<!--------------------------------------------------------------------------------------------------------------------------------------------------->
					  
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
				  </div>
				</div>
			</div>
		  </div>

    <section id="lienhe" class="container-fluid bg-stemup pd-30">
    <div class="container">
        <div class="row padTB15">
            <div class="col-md-7 boL1 text-center767">
                <p class="text-trang">© 2019 DTT. Inc. All Rights Reserved.</p>
            </div>
            <div class="col-md-5 text-right">
                <div class="mb-20"><a class="text-trang" href="">www.facebook.com/stemupapp</a><br></div>
                <a href=""><img src="<?php echo base_url('images/stemup_images/google-01.svg')?>" height="25" alt=""></a>
                <a href=""><img src="<?php echo base_url('images/stemup_images/iphone-02.svg')?>" height="25" alt=""></a>
            </div>
        </div>
    </div>
</section>
</body>
</html>