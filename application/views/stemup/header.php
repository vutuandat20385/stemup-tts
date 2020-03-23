<?php
$this->load->database();
$this->load->helper('url');
$this->lang->load('basic', $this->config->item('language'));

?>
<header class="navbar navbar-fixed-top navbar-stemup">
	  <div class="container pos-stemup">
		  <div class="header-giua">
			  	<a class="pull-left logo123" href="<?php echo site_url('action') ?>"><img class="" src="<?php echo base_url('images/app-07.png') ?> " alt="" height="40"></a>
			  	<div class="slogan123"><span class="text-header">Trợ lý a.i<br> giúp phụ huynh học cùng con</span></div>
		  </div>
		  <div class="div-guide hidden-xs">
		  		<a class="bt-hoi hidden-xs" href="<?php echo site_url('help') ?>"><i class="far fa-question-circle fa-2x mr-5"></i>Hướng dẫn</a>
			</div>
			<?php
				$user= $this->session->userdata('logged_in');
				if($user){
			?>
				<div class="div-logout">
		  		<a  href="#" onclick ="window.location= '<?php echo base_url() ?>index.php/user/logout' "><i class="text-logout fas fa-sign-out-alt fa-2x" ></i>&nbsp;&nbsp;&nbsp;<span id="text-logout-1" style="font-family: 'Roboto Condensed', sans-serif;
    font-size: 15px;">Đăng xuất</span></a>
				</div>
		  
			<?php		
				}
				
			?>
		</div>	
</header>

<?php $this->load->view('stemup/embedfbmsg');?> 
