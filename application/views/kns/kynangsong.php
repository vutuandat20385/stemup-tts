  <head>

    <title>Giáo Dục Đạo Đức Lối Sống</title>
    <script src="<?php echo base_url('js/loadoption1.js');?>"></script>
 <?php $this->load->view('kns/head');?>

<script>  
    var quid_global;  
    var base_url="<?php echo base_url();?>";
    var site_url="<?php echo site_url();?>";
    var su="<?php echo $su ?>";
    var id_mcq_fun="<?php echo $id_mcq_fun ?>";
    var id_quiz_fun="<?php echo $id_quiz_fun ?>";
    </script>
	<style>
		#quiz-list{
		background: #e9ebee;
		height: auto;
		margin-top: 20px;
		min-height: 700px;
		margin-bottom: 25px;
		}
		
		.footer-contact a {
		color: #FFF;
		}
		.footer-contact h3 {
		color: #FFF;
		}
		#module1 {
		background: #2b2b2b;
		}
		#module3 {
		background: black;
		}
		#module4 {
		color: #9D9A9A;
		}
		.curlink a {
			color: #FFF;
		}
		.pointer {cursor: pointer;}
	</style>
</head>
<div id="menu" style="background-image: url('<?php echo base_url('images/kynangsong/banner.png');?>'); background-position: center top; background-size: cover; height: 150px;">
<img src="<?php echo base_url('images/kynangsong/logo-top.png');?>" style="margin-right: 953px;
height: 42px;">

<div class="title" style="font-size:50px;color:#FFF">Giáo Dục Đạo Đức Lối Sống</div>


</div>

<div class="container" style="min-height:550px">
	<div class="col-md-2 col-sm-2 col-sx-2 menu-left">
		<?php $this->load->view('kns/leftmenu'); ?>
		
	</div>
	<div class="col-md-10 col-sm-10 col-xs-10 quiz_list" id="quiz-list">
		<?php 
		  $col_num = 4;
		  
		  foreach($quiz_list as $value){
		?>
			<div class="col-md-3 col-sm-6 col-xs-12 quiz-item">
        		<div class="item-cover col-md-12 col-sm-12 col-xs-12">
        			<div class="quiz-item-img col-md-12"><a><?php 
					$end = strpos($value['question'],'" frameborder');
					$start = strpos($value['question'],'embed/');
					$chuoicon = substr($value['question'], $start+6, $end-$start-6);
					echo '<img src="https://img.youtube.com/vi/'.str_replace('" width="560" height="315','',$chuoicon).'/0.jpg">';
					?></a></div>
        			<div class="quiz-item-title col-md-12"><a><?php 
					$start1 = strpos($value['question'],'<br');
					$end1 = strlen($value['question']);
                    $chuoicon1 = substr($value['question'],$start1,$end1);
					echo _substr($chuoicon1, 55,3);
					?></a></div>
        			<div class="quiz-item-level-hard text-center col-md-12"><br><i class="fas fa-star icon-left"></i><?php echo 'Đạo đức lối sống' ?></div>
                    <div class="col-text-lambai col-md-12 col-sm-12 col-xs-12">
                        <button type="button" class="btn-lambai" onclick="xemchitiet(<?php echo $value['qid'];?>)">Xem</button>
                    </div>
        		</div>			
    		</div>
        

		<?php          
		      
		  }
		  
		  echo $pagnation_link;
		?>
	</div>
</div>
<div class="modal" id="popup_require_login" role="dialog" onclick="dismiss_modal(this)" >
            <div class="modal-dialog">   
                 <div class="modal-content">
                    <div class="box-popup">
                        <div class="bg-xanhnhat">
                            <div class="icon">
                                <img src="https://do.stem.vn/images/thongbao.png" alt="">
                            </div>
                        </div>
                        <div class="box-chon">
                            <h4 class="text-center mb-20 mt-0">Vui lòng <button class="btn btn-info smlg" onclick="popup_login1(<?php echo $value['quid'];?>)">Đăng nhập</button> hoặc <button class="btn btn-success smsn" onclick="popup_signup1(<?php echo $value['quid'];?>)">Đăng ký</button> để thực hiện thao tác này!</h4>
                        </div>

                    </div>

                    
                 </div>
                  
            </div>
        </div>

        <div class="modal fade" id="loginmodal2" role="dialog">
            <div class="modal-dialog" >     
                 <div class="modal-content">
                    <form class="form-signin" method="post" action="<?php echo site_url('login/verifylogin2');?>">
                     <input type="text" style="display:none" id="model" name="model" value=""/>
                      <input type="text" style="display:none" id="id_login" name="id_login" value="0"/>
                     <input class="page-signin-form-control form-control login-email" name="email" placeholder="<?php echo $this->lang->line('email_address');?>" type="text" required autofocus>
                     <input class="page-signin-form-control form-control login-pwd" name="password" id="inputPassword" placeholder="<?php echo $this->lang->line('password');?>" type="password" required  >
                    <input style="margin: 10px;" name="remember" type="checkbox">Tự động đăng nhập
                     <button style="z-index:2; margin-top:-42px; margin-right:17px"class="btn btn1 btn-sm btn-default btn-primary pull-right mb-5" type="submit">Đăng nhập</button>
                     <table>
                         <tr>
                            <td style="padding:10px">
                                <a class="btn btn1 social-login fb-login"  style="background:#3C66C4;color:#ffffff;" href="<?php echo  site_url('hauth/login/Facebook');?>" > <i class="fab fa-facebook-f"></i> Đăng nhập với Facebook </a>
                             </td>
                             <td style="padding:10px">
                                <a class="btn btn1 btn-danger social-login gp-login"  href="<?php echo  site_url('sso/login');?>" > <i class="fab fa-google"></i> Đăng nhập với Itrithuc.vn </a>
                             </td>
                         </tr>
                     </table>
                     <a href="#" data-toggle="modal" data-target="#resetpwdModal" style=" padding:10px"> Quên mật khẩu</a>
                 </form>
                    
                 </div>
              
            </div>
        </div>

<div id="footer">
    <div class="region-bottom"><div id="module1" class="ModuleWrapper"><div class="section-footer"><div id="column1-1" class="column1 container">
  <div class="columns-widget row">  <div class="col-md-12"><div id="module2" class="ModuleWrapper"><div class="footer-contact" style="display:table;width:100%">
<div class="col-left col-md-2 col-xs-12" style="display: table-cell;float: none;vertical-align: middle;">
<div class="logo">
<a title="Kho học liệu số" href="https://hoclieu.itrithuc.vn/?page=home">
<img alt="Kho học liệu số" src="<?php echo base_url('images/kynangsong/logo-footer.png');?>">
</a>
</div>
</div>
<div class="col-right col-md-5 col-xs-12" style="display: table-cell;color:#FFF">
<h3 class="mb-20">LIÊN HỆ</h3>
<strong></strong>
<p class="address mt-10"><i class="fa fa-envelope"></i>&nbsp;&nbsp;e-Learning@moet.edu.vn </p>
<p class="address mt-10"><i class="fa fa-phone-square"></i>&nbsp;&nbsp;024.3.8695712 </p>
<p class="address mt-10"><i class="fa fa-home"></i>&nbsp;&nbsp;Ðịa chỉ: Số 15 Hai Bà Trưng, Quận Hoàn Kiếm, Hà Nội</p>
</div>
<div class="col-right col-md-2 col-xs-12" style="display: table-cell">
<!-- <h3 class="mb-20">MENU</h3>
<div><a href="/gioi-thieu">Giới thiệu</a></div>
<div class="mt-10"><a href="/ton-vinh">Tôn vinh</a></div>
<div class="mt-10"><a href="https://ungdung.itrithuc.vn/" target="_blank">Ứng dụng</a></div>
<div class="mt-10"><a href="/chinh-sach">Chính sách</a></div> -->
</div>
<div class="col-right col-md-5 col-xs-12" style="display: table-cell;">
<h3 class="mb-20">HỆ TRI THỨC VIỆT SỐ HÓA</h3>
<div class="row">
<div class="col-md-6">
<a href="http://itrithuc.vn" target="_blank"><img src="<?php echo base_url('images/kynangsong/footer-menu-icon-1.png');?>" style="margin-right:10px">Ðáp án</a>
</div>
<div class="col-md-6">
<a href="https://dulieu.itrithuc.vn/" target="_blank"><img src="<?php echo base_url('images/kynangsong/footer-menu-icon-2.png');?>" style="margin-right:10px">Dữ liệu mở</a>
</div>
<div class="col-md-6 mt-20">
<a href="https://trithuc.itrithuc.vn/" target="_blank"><img src="<?php echo base_url('images/kynangsong/footer-menu-icon-3.png');?>" style="margin-right:10px">Hệ tri thức</a>
</div>
<div class="col-md-6 mt-20">
<a href="https://ungdung.itrithuc.vn/" target="_blank"><img src="<?php echo base_url('images/kynangsong/footer-menu-icon-4.png');?>" style="margin-right:10px">Kho ứng dụng</a>
</div>
<div class="col-md-6 mt-20">
<a href="https://hoidap.itrithuc.vn/" target="_blank"><img src="<?php echo base_url('images/kynangsong/footer-menu-icon-5.png');?>" style="margin-right:10px">Ngân hàng hỏi đáp</a>
</div>
<div class="col-md-6 mt-20">
<a href="https://dev.itrithuc.vn/" target="_blank"><img src="<?php echo base_url('images/kynangsong/footer-menu-icon-6.png');?>" style="margin-right:10px">Nhà phát triển</a>
</div>
</div>
</div>
<!-- div class="col-right col-md-3 col-xs-12 text-center">
<img src="/App/images/logo_viettel.png" title="Thi?t k?, tài tr? h? t?ng và d?ng hành tri?n khai" alt="logo_viettel.png" style="width: 100px;"/>
<span style="display: block;font-size: 11px;margin-top: 10px;">Thi?t k?, tài tr? h? t?ng và d?ng hành tri?n khai</span>
</div -->
</div>
</style></div></div>  </div></div></div><style></style>
</div>
<div id="module3" class="ModuleWrapper"><div class="footer-copyright"><div id="column1-3" class="column1 container">
  <div class="columns-widget row">  <div class="col-md-12"><div id="module4" class="ModuleWrapper"><div style="text-align: center;" class="mt-10 mb-10">© Copyright 2018. Bản quyền thuộc Bộ Khoa học &amp; Công nghệ - Ðược phát triển bởi <a href="http://dtt.vn/">DTT</a></div></div></div>  </div></div></div><style></style>
    
</div>
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
<script type="text/javascript">
    function xemchitiet(qid){

	    $.ajax({
    	type: "POST",
		data : {qid:qid},
		url: base_url + "index.php/kynangsong/xemchitiet/",
		success: function(data){	
			$('#quiz-list').html(data);
		},
		error: function(err){}
        });
	}
	
</script>
