 <!-- fontawesome css -->
	<link href="<?php echo base_url('font-awesome/css/font-awesome.css');?>" rel="stylesheet">
	<div class="container">

   
 <?php 
  
 $sq_url="https://".$_SERVER['HTTP_HOST'] . str_replace('index.php/install','',$_SERVER['REQUEST_URI']);
 $last_sl=substr($sq_url,(strlen($sq_url)-1),strlen($sq_url));
 if($last_sl=='/'){
	$sq_url=$sq_url; 
 }else{
	$sq_url=$sq_url."/";  
 }
 
 ?>
 
 
<style>
table th{
font-size:12px;
background:#dddddd;
padding:10px;
}
tr{
background:#CCFFCC;
border-bottom:1px solid #ffffff;
}
td{
text-align:center;
padding:10px;
}
.thead{

background:#eeeeee;
}
</style>


<div class="col-md-2">
</div>
<div class="col-md-8">

	<div class="login-panel panel panel-default">
		<div class="panel-body"> 
		<img src="<?php echo base_url('images/logo.png');?>">
		

					<h2 class="form-signin-heading"><?php echo $this->lang->line('installation_process');?></h2>
		<?php 
		if($this->session->flashdata('message')){
			?>
			<div class="alert alert-danger">
			<?php echo $this->session->flashdata('message');?>
			</div>
		<?php	
		}
		if($this->uri->segment(3) != 'ph'){
		?>	<br>
		<form class="form-signin" method="post" action="<?php echo $sq_url.'index.php/Install/index/ph';?>"  >
			
		<div class="form-group">	 
					<label for="inputEmail"  ><?php echo $this->lang->line('hostname');?></label> 
					<input type="text"   name="sq_hostname" class="form-control" value="localhost" placeholder="<?php echo $this->lang->line('hostname');?>" required autofocus >
			</div>
			<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('db_name');?></label> 
					<input type="text"   name="sq_dbname" class="form-control" placeholder="<?php echo $this->lang->line('db_name');?>" required   >
			</div>
			<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('db_username');?></label> 
					<input type="text"   name="sq_dbusername" class="form-control" placeholder="<?php echo $this->lang->line('db_username');?>" required   >
			</div>
			<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('db_password');?></label> 
					<input type="password"   name="sq_dbpassword" class="form-control" placeholder="<?php echo $this->lang->line('db_password');?>"     >
			</div>
			<div class="form-group">	  
					 
					<button class="btn btn-lg btn-primary btn-block" type="submit">Next</button>
			</div>
			</form>
			
		<?php
		}else{
		// echo $_SERVER['REQUEST_URI'];
		$sq_url="https://".$_SERVER['HTTP_HOST'] . str_replace('index.php/Install/index/ph','',$_SERVER['REQUEST_URI']);
 $last_sl=substr($sq_url,(strlen($sq_url)-1),strlen($sq_url));
 if($last_sl=='/'){
	$sq_url=$sq_url; 
 }else{
	$sq_url=$sq_url."/";  
	
	
 }
 
  
		$con = mysqli_connect($_POST['sq_hostname'], $_POST['sq_dbusername'], $_POST['sq_dbpassword']);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$mysqlversion=mysqli_get_server_info($con);

$result = mysqli_query($con,"SHOW VARIABLES LIKE 'sql_mode'");
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
 
$groupbymode=0;
if (strpos($row['Value'], 'ONLY_FULL_GROUP_BY') !== false) {
  $groupbymode=1;
}else{
$groupbymode=0;
}

		?>
		<h4>Minimum requirement:<h4>
		
		<table>
		<tr><th></th><th>Minimum Required/Folder</th><th>Current Status</th></tr>
		<tr  <?php if (phpversion() < 5.6) { ?>style="background:#FF9999;"<?php } ?> ><th class='thead'>PHP Version</th><td>5.6+</td><td><?php echo phpversion();?></td></tr>
		<tr <?php if (floatval($mysqlversion) < 5.5) { ?>style="background:#FF9999;"<?php } ?> ><th class='thead'>MySql Version</th><td>5.5+</td><td><?php echo $mysqlversion;?></td></tr>
		<tr   <?php if (!extension_loaded('zip')) { ?>style="background:#FF9999;"<?php } ?> ><th class='thead'>PHP-ZIP Library</th><td> Required </td><td><?php if (!extension_loaded('zip')){ echo "Not found";}else{ echo "Installed"; }  ?></td></tr>
		
		<tr   <?php if (function_exists('curl_version')===false) { ?>style="background:#FF9999;"<?php } ?> ><th class='thead'>PHP cURL   </th><td> Required </td><td><?php if (function_exists('curl_version')===false){ echo "Not found";}else{ echo 'Installed'; }  ?></td></tr>
		
		
		<tr   <?php if ($groupbymode==1) { ?>style="background:#FF9999;"<?php } ?> ><th class='thead'>MySql ONLY_FULL_GROUP_BY</th><td> Disabled </td><td><?php if($groupbymode==1) { echo "Enabled";}else{ echo "Disabled"; }  ?></td></tr>
		
		<tr <?php if (!is_writable('upload/')) { ?>style="background:#FF9999;"<?php } ?> ><th class='thead' >Writable Permission</th><td> upload/ </td><td><?php if (!is_writable('upload/')) { echo "Not writable";}else{ echo "Writable"; }  ?></td></tr>
		<tr  <?php if (!is_writable('xls/')) { ?>style="background:#FF9999;"<?php } ?> ><th class='thead'>Writable Permission</th><td> xls/ </td><td><?php if (!is_writable('xls/')) { echo "Not writable";}else{ echo "Writable"; }  ?></td></tr>
		<tr  <?php if (!is_writable('photo/')) { ?>style="background:#FF9999;"<?php } ?> ><th class='thead'>Writable Permission</th><td> photo/ </td><td><?php if (!is_writable('photo/')) { echo "Not writable";}else{ echo "Writable"; }  ?></td></tr>
		<tr  <?php if (!is_writable('application/logs/')) { ?>style="background:#FF9999;"<?php } ?> ><th class='thead'>Writable Permission</th><td> application/logs/ </td><td><?php if (!is_writable('application/logs/')) { echo "Not writable";}else{ echo "Writable"; }  ?></td></tr>
		
		
		<tr  <?php if (!is_writable('application/config/sq_config.php')) { ?>style="background:#FF9999;"<?php } ?> ><th class='thead'>Writable Permission</th><td> application/config/sq_config.php </td><td><?php if (!is_writable('application/config/sq_config.php')) { echo "Not writable";}else{ echo "Writable"; }  ?></td></tr>
		<tr  <?php if (!is_writable('application/config/config.php')) { ?>style="background:#FF9999;"<?php } ?> ><th class='thead'>Writable Permission</th><td> application/config/config.php </td><td><?php if (!is_writable('application/config/config.php')) { echo "Not writable";}else{ echo "Writable"; }  ?></td></tr>
		<?php 
		$this->session->set_userdata('ifCIsessionworks','OK');
		if($this->session->userdata('ifCIsessionworks')){
     $sok=1;
}else{
    $sok=0;
}
?>
		<tr  <?php if ($sok==0) { ?>style="background:#FF9999;"<?php } ?> ><th class='thead'>CI session status</th><td colspan=2 >
		 <?php if ($sok==0) { ?>CI session not working.<br>Please rename 'rename_to_Session_if_session_not_work.php' file <br>(located at application/libraries/)  to Session.php <?php }else{ echo "Working";} ?>
		 </td></tr>
		 
		 <?php 
		 // print_r(get_loaded_extensions());
		 $gefunden="Not installed";
		  foreach ( get_loaded_extensions() as $number => $extension_name ) { 
		  if ( (strpos( strtolower($extension_name) , "ioncube" )) === false) {
		  $gefunden="Not installed";
		     } else { 
		    $gefunden="Installed";
		      } } 
		  ?>
		<tr  <?php if ($gefunden=="Not installed") { ?>style="background:#FF9999;"<?php } ?> ><th class='thead'>ionCube PHP Loader</th><td colspan=2 >
		 <?php echo $gefunden; ?> 
		  <?php if ($gefunden=="Not installed") { ?>
		  <br> <a href="https://www.ioncube.com/lw/" target="new" >Installation help -1 </a> | 
		  <a href="https://www.howtoforge.com/tutorial/how-to-install-ioncube-loader/" target="new">Installation help -2 </a> <br>
		  <p>If iconcube installed and still status showing 'Not installed' then be sure you are not using custom php.ini in any root folder or multiple php.ini. Find all available php.ini file and add zend extension in custom php.ini. eg. <br>
		  <code style='font-size:11px;'>zend_extension = /usr/lib/php5/20131226/ioncube_loader_lin_5.6.so</code> 
		  <br>Note: php version,path and ioncube version may be different in your case. 
		  </p>
		  <?php } ?>
		 </td></tr>
		
		</table> <br><br>
		<div class="alert alert-warning ">You can ask your hosting provider or server administrator to fullfil minimum requirements.</div>
		<hr><br>
		<form class="form-signin" method="post" action="<?php echo $sq_url.'index.php/Install/config_sq';?>" onSubmit="return agreetos();">
			
			<div class="form-group">	 
					<label for="inputEmail"  ><?php echo $this->lang->line('base_url');?></label> 
					<input type="text" name="sq_base_url" id="base_url" class="form-control" value="<?php echo str_replace('index.php/Install/index/ph/','',str_replace('//index.php/Install/index/ph/','/',$sq_url));?>" placeholder="<?php echo $this->lang->line('hostname');?>" required autofocus >
			</div>
			<div class="form-group">	 
					<label for="inputEmail"  ><?php echo $this->lang->line('hostname');?></label> 
					<input type="text"   name="sq_hostname" class="form-control" value="<?php if(isset($_POST['sq_hostname'])){ echo $_POST['sq_hostname']; }?>" placeholder="<?php echo $this->lang->line('hostname');?>" required autofocus autocomplete=off  >
			</div>
			<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('db_name');?></label> 
					<input type="text"  value="<?php if(isset($_POST['sq_dbname'])){ echo $_POST['sq_dbname']; }?>" name="sq_dbname" class="form-control" placeholder="<?php echo $this->lang->line('db_name');?>" required   autocomplete=off  >
			</div>
			<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('db_username');?></label> 
					<input type="text"  value="<?php if(isset($_POST['sq_dbusername'])){ echo $_POST['sq_dbusername']; }?>" name="sq_dbusername" class="form-control" placeholder="<?php echo $this->lang->line('db_username');?>" required  autocomplete=off   >
			</div>
			<div class="form-group">	 
					<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('db_password');?></label> 
					<input type="password" value="<?php if(isset($_POST['sq_dbpassword'])){ echo $_POST['sq_dbpassword']; }?>"  name="sq_dbpassword" class="form-control" placeholder="<?php echo $this->lang->line('db_password');?>"    autocomplete=off   >
			</div>
 			<div class="form-group">	  
					<input type="checkbox" name="tos" id="tos"> <span style="font-size:11px;">You must agree to our <a href="https://savsoftquiz.com/wp/index.php/terms-conditions-license-agreement-v2-0/" target="savsoftquiz" >Terms & Conditions</a> before installation</span><br>
					<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $this->lang->line('install_now');?></button>
			</div>
<!--  <input type="checkbox" name="force_write"  > <span style="font-size:11px;"> Tick if server required 777 permission to write file </span> -->
			</form>
			
			<?php 
			}
			?>
		</div>
	</div>

</div>
<div class="col-md-2">


</div>



</div>
<script>
function agreetos(){
	if(document.getElementById('tos').checked == true){
		return true;
	}else{
		alert('Please tick checkbox to agree with terms and conditions');
		return false;
	}
	
}


</script>

<script>
var basu=$('#base_url').val();
var lstr=basu.substr(-2);
if(lstr === '//') {
       basu= basu.substr(0, basu.length - 1);
    }
$('#base_url').val(basu);

</script>
