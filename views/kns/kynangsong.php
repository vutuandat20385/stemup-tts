<script>  
    var quid_global;  
    var base_url="<?php echo base_url();?>";
    var site_url="<?php echo site_url();?>";
    var su="<?php echo $su ?>";
    var id_mcq_fun="<?php echo $id_mcq_fun ?>";
    var id_quiz_fun="<?php echo $id_quiz_fun ?>";
    </script>
<div id="menu">
    <?php //$this->load->view('web_menu'); ?>
    <span id="t-header">KỸ NĂNG SỐNG</span>
</div>
<div class="container" style="min-height:550px">
	<div class="col-md-2 col-sm-2 col-sx-2 menu-left">
		 <?php $this->load->view('kns/leftmenu');?>
	</div>
	<div class="col-md-10 col-sm-10 col-xs-10" id="quiz-list">
		<?php 
		  $col_num = 4;
		  
		  foreach($quiz_list as $value){
		?>
			<div class="col-md-3 col-sm-6 col-xs-12 quiz-item">
        		<div class="item-cover col-md-12 col-sm-12 col-xs-12">
        			<div class="quiz-item-img col-md-12"><a><img src="<?php echo $value['img_video']?>"></a></div>
        			<div class="quiz-item-title col-md-12"><a><?php echo _substr($value['quiz_name'], 40,3)?></a></div>
        			<div class="quiz-item-level-hard text-center col-md-12"><i class="fas fa-star icon-left"></i><?php echo 'Kỹ năng sống' ?></div>
                     <div class="col-text-lambai col-md-12 col-sm-12 col-xs-12">

                        <button type="button" class="btn-lambai" onclick="popup_require_login1_kns(<?php echo $value['quid'];?>)">Làm bài</button>
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
                                <img src="https://stemup.app/images/thongbao.png" alt="">
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
                    <!-- <table>
                         <tr>
                            <td style="padding:10px">
                                <a class="btn btn1 social-login fb-login"  style="background:#3C66C4;color:#ffffff;" href="<?php echo  site_url('hauth/login/Facebook');?>" > <i class="fab fa-facebook-f"></i> Đăng nhập với Facebook </a>
                             </td>
                             <td style="padding:10px">
                                <a class="btn btn1 btn-danger social-login gp-login"  href="<?php echo  site_url('sso/login');?>" > <i class="fab fa-google"></i> Đăng nhập với Itrithuc.vn </a>
                             </td>
                         </tr>
                     </table>-->
                     <a href="#" data-toggle="modal" data-target="#resetpwdModal" style=" padding:10px"> Quên mật khẩu</a>
                 </form>
                    
                 </div>
              
            </div>
        </div>

<div id="footer">
        
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
    function popup_require_login1_kns(quid){
    var uid="<?php echo $uid; ?>";
    quid_global=quid;
    if(uid==''){
      $("#popup_require_login").modal();
      $(".smlg").attr("onclick","popup_login1("+quid+")");
      $(".smsn").attr("onclick","popup_signup1("+quid+")");
    }else{
      window.location.href = "<?php echo site_url('quiz/validate_quiz/')?>"+"/"+quid;


    }
      

    }
</script>