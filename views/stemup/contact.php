<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>STEMUP | LIEN HỆ</title>
	<?php $this->load->view('stemup/head_not_login');?>
	<link href="<?php echo base_url('css/stemup_css/style.css');?>" rel="stylesheet">
	<link href="/web/content/2283-7cda5ba/web.assets_common.0.css" rel="stylesheet">
	<link href="/web/content/10111-ebd264e/web.assets_frontend.0.css" rel="stylesheet">
	<link href="/web/content/10112-ebd264e/web.assets_frontend.1.css" rel="stylesheet">

	<script type="text/javascript" src="/web/content/2286-7cda5ba/web.assets_common.js"></script>
	<script type="text/javascript" src="/web/content/10113-ebd264e/web.assets_frontend.js"></script>

</head>
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
	<main>

		<div id="wrap">
			<div class="oe_structure"></div>
			<div class="container">
				<h1>Liên hệ</h1>
				<div class="row">
					<div class="col-md-8">
						<div class="oe_structure">
							<div>
								<p><span id="result_box" lang="vi"><span>Liên hệ với chúng tôi về bất cứ điều gì liên quan đến công ty hoặc dịch vụ của chúng tôi</span></span>.</p>
								<p><span id="result_box" lang="vi"><span>Chúng tôi sẽ cố gắng hết sức để liên hệ lại với bạn sớm nhất</span></span>.</p>
							</div>
						</div>
						<div>
							<form action="/website_form/" class="s_website_form form-horizontal container-fluid mt32" data-model_name="crm.lead" data-success_page="/page/website_crm.contactus_thanks" enctype="multipart/form-data" method="post">
								<div class="form-group form-field o_website_form_required_custom">
									<label class="col-md-3 col-sm-4 control-label" for="contact_name">
										Họ và Tên
									</label>
									<div class="col-md-7 col-sm-8">
										<input class="form-control o_website_form_input" name="contact_name" required="" type="text" value="">
									</div>
								</div>
								<div class="form-group form-field">
									<label class="col-md-3 col-sm-4 control-label" for="phone">
										Số điện thoại
									</label>
									<div class="col-md-7 col-sm-8">
										<input class="form-control o_website_form_input" name="phone" type="text" value="">
									</div>
								</div>
								<div class="form-group form-field">
									<label class="col-md-3 col-sm-4 control-label" for="email_from">Tên đăng nhập / Email</label>
									<div class="col-md-7 col-sm-8">
										<input class="form-control o_website_form_input" name="email_from" required="" type="text" value="">
									</div>
								</div>
								<div class="form-group form-field">
									<label class="col-md-3 col-sm-4 control-label" for="partner_name">
										Tên công ty của bạn
									</label>
									<div class="col-md-7 col-sm-8">
										<input class="form-control o_website_form_input" name="partner_name" required="" type="text" value="">
									</div>
								</div>
								<div class="form-group form-field o_website_form_required">
									<label class="col-md-3 col-sm-4 control-label" for="name">Môn học</label>
									<div class="col-md-7 col-sm-8">
										<input class="form-control o_website_form_input" name="name" required="" type="text" value="">
									</div>
								</div>
								<div class="form-group form-field o_website_form_required_custom">
									<label class="col-md-3 col-sm-4 control-label" for="description">
										Nội dung
									</label>
									<div class="col-md-7 col-sm-8">
										<textarea class="form-control o_website_form_input" name="description" required="">              
										</textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-offset-3 col-sm-offset-4 col-sm-8 col-md-7">
										<span class="btn btn-lg btn-primary o_website_form_send" data-original-title="" title="">Gửi</span>
										<span class="text-danger ml8" id="o_website_form_result">&nbsp;</span>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-md-4 mb32">

						<address itemscope="itemscope" itemtype="http://schema.org/Organization">
							<div data-oe-many2one-id="1" data-oe-many2one-model="res.partner" data-oe-contact-options="{&quot;widget&quot;: &quot;contact&quot;, &quot;inherit_branding&quot;: null, &quot;fields&quot;: [&quot;name&quot;, &quot;address&quot;, &quot;phone&quot;, &quot;mobile&quot;, &quot;fax&quot;, &quot;email&quot;], &quot;tagName&quot;: &quot;div&quot;, &quot;type&quot;: &quot;contact&quot;, &quot;translate&quot;: null, &quot;expression&quot;: &quot;res_company.partner_id&quot;}">
								<address class="mb0" itemscope="itemscope" itemtype="http://schema.org/Organization">

									<div>

										<span itemprop="name">Học viện STEM</span>



									</div>
									<div itemprop="address" itemscope="itemscope" itemtype="http://schema.org/PostalAddress">
										<div>
											<i class="fa fa-map-marker"></i> <span itemprop="streetAddress">Số 18, Ô C2/N0 Khu Nam Trung Yên, Đường Mạc Thái Tông<br>&nbsp; &nbsp; Trung Hòa, Cầu Giấy<br>&nbsp; &nbsp; Hà Nội HN <br>&nbsp; &nbsp; Việt Nam</span>
										</div>

										<div><i class="fa fa-phone"></i> <span itemprop="telephone">094.102.8558</span></div>



										<div><i class="fa fa-envelope"></i> <span itemprop="email">tuyensinh@hocvienstem.com</span></div>
									</div><div>



									</div>

								</address>
							</div>

							<span class="fa fa-map-marker fa-fw mt16"></span> <a target="_BLANK" href="https://maps.google.com/maps?q=S%E1%BB%91+18%2C+%C3%94+C2%2FN0+Khu+Nam+Trung+Y%C3%AAn%2C+%C4%90%C6%B0%E1%BB%9Dng+M%E1%BA%A1c+Th%C3%A1i+T%C3%B4ng%2C+H%C3%A0+N%E1%BB%99i+%2C+Vi%E1%BB%87t+Nam&amp;z=8"> Google Maps</a>

						</address>


					</div>
				</div>
			</div>
			<div class="oe_structure"></div>
		</div>

	</main>
	<footer>
		<div class="oe_structure" id="footer">
			<section>
				<?php $this->load->view('stemup/footer');?>
			</section>
		</div>
	</footer>
</div>
<script>
	document.addEventListener("DOMContentLoaded", function(event) {
		odoo.define('im_livechat.livesupport', function (require) {
		});
	});
</script>
<script id="tracking_code">
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', _.str.trim(' UA-101093405-2'), 'auto');
	ga('send','pageview');
</script>
<div id="trans_div" style="display: none;"></div></body>
</body>
</html>
<script type="text/javascript">
   $("#contact_").attr("class","active");
</script>