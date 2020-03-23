
  
    <?php $this->load->view('sadmin/head');?>
	
    <!-- Bootstrap -->
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/setbackground.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/card.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/star-rating.css');?>" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
	<script src="<?php echo base_url('js/addclass.js');?>"></script>
	<script src="<?php echo base_url('js/group.js');?>"></script>
	<script src="<?php echo base_url('js/manage_group.js') ?>"></script>
	<script src="<?php echo base_url('js/manage_class.js') ?>"></script>
	<script src="<?php echo base_url('js/newuserpage.js');?>"></script>
	<script src="<?php echo base_url('js/responsive.dataTables.js');?>"></script>
	<link href="<?php echo base_url('css/responsive.dataTables.min.css');?>" rel="stylesheet">
    <script src="<?php echo base_url('js/jquery.dataTables.js');?>"></script>
	<link href="<?php echo base_url('css/jquery.dataTables.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
	<script src="<?php echo base_url('js/select2.min.js');?>"></script>
<script src="<?php echo base_url('js/editprofile.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('js/formattoolbar.js')?>"></script>

	<script src="<?php echo base_url('js/addclass.js');?>"></script>
	<script src="<?php echo base_url('js/group.js');?>"></script>
	<script src="<?php echo base_url('js/insert_video.js');?>"></script>
	<script>

	
	var base_url="<?php echo base_url();?>";
	var site_url="<?php echo site_url();?>";
	var su="<?php echo $su ?>";
	</script>

	<script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('js/formattoolbar.js')?>"></script>

	<script src="<?php echo base_url('js/left-menu.js');?>"></script>
	<script src="<?php echo base_url('js/notification.js');?>"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
	  
	  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">

	
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> <script> (adsbygoogle = window.adsbygoogle || []).push({ google_ad_client: "ca-pub-3948834986570227", enable_page_level_ads: true }); </script>
  
<style>
.MT70 {
    margin-top: 0px;
}
.bg-tab {
    background: #fff;
    padding-top: 0px;
}
</style>
	
    

<div class="wrapper">
	<?php $this->load->view('sadmin/header'); ?>
	<div class="content-wrapper " >
	<aside class="main-sidebar">
        <?php $this->load->view('sadmin/leftmenu'); ?>
    </aside>
		<main class="container MT70">	
		<section class="row">
  	 
		<aside class="col-md-12" >
			<!--<div class="box-lop" id="bannerpage">
				<div class="line-L">
				  <h1>Thư viện</h1> 
				</div>
			</div>-->
			<div role="tabpanel">
				<ul class="nav nav-tabs MB20 bg-tab" role="tablist">
					<li role="presentation" class="active" style="display: none;"><a href="#home2a" data-toggle="tab" role="tab" aria-controls="tab1">Đăng bài</a></li>
				</ul>
				<div id="tabContent2" class="tab-content">
				  <div role="tabpanel" class="tab-pane fade in active" id="home2a">
					<div class="box-bor MB20">
						<div role="tabpanel" id="tabs">
						  <ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#home1"  id="text-tabs" data-toggle="tab" role="tab" aria-controls="tab1">Video</a></li>
							<li role="presentation"><a href="#home2" data-toggle="tab" role="tab" aria-controls="tab2" id="text-tabs2" style="display:none">Ghi chú</a></li>
						
						  </ul>
						  <div id="tabContent1" class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="home1" >
							   
							   <div class="form-group MT20">
								  <?php echo $info_video['content'] ?>
								</div>
								
								Mô phỏng : <span><input  id="issim" name="issim" value="0" type="checkbox"></span><br/><br/>
								
								Tên: <input name="name_video" id="name_video" type="text" class="form-control" style="margin-bottom:20px; " value="<?php echo $info_video['name'] ?>" required>
								Title:<input name="title_video" id="title_video" type="text" class="form-control" value="<?php echo $info_video['title'] ?>" style="margin-bottom:20px">
								Mô tả
								<textarea name="descr_video" id="descr_video" type="text" class="form-control" style="margin-bottom:20px"><?php echo $info_video['description'] ?></textarea>
								Từ khóa:
								<input name="tags_video" id="tags_video" type="text" class="form-control" style="margin-bottom:20px" value="<?php echo $tags ?>">
								Môn học:
                                <select class="form-control" name="cid" id="cide" style="margin-bottom:20px"><?php foreach($category_list as $key => $val){ ?>  
                                    <option value="<?php echo $val['cid'];?>" id="cat<?php echo $val['cid'];?> 
                                    <?php if($val['cid'] == $info_video['cid'] ){ echo 'selected';} ?> ">
                                    <?php echo $val['category_name'];?></option>
                                    <?php }?>
                                </select>
								
								Lớp:
								<select class="form-control" name="lid" id="lide" style="margin-bottom:20px"><?php foreach($level_list as $key => $val){ ?>  <option value="<?php echo $val['lid'];?>" 
								<?php if($val['lid']==$info_video['lid']){echo ' selected '; } ?>
								id="cat<?php echo $val['lid'];?>"><?php echo $val['level_name'];?></option><?php }?></select>
								Tiết : 
								<input name="unit_video" id="unit_video" type="number" class="form-control" style="margin-bottom:20px" value="">
								Nguồn : 
								<input name="source_video" id="source_video" type="text" class="form-control" style="margin-bottom:20px" value="<?php echo $info_video['source'] ?>">
								<input type="button" class="btn btn-primary" value="Sửa dữ liệu" onclick="edit_video(<?php echo $info_video['lib_id'] ?>)">
					
							</div>
								<div role="tabpanel" class="tab-pane fade" id="home2">
								</div>
								<div role="tabpanel" class="tab-pane fade" id="tabDropDownOne1">
									<p>Dropdown content#1</p>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="tabDropDownTwo2">
									<p>Dropdown content#2 </p>
								</div>
							</div>
						</div>
					</div>
		      
				</div>
			</div>
		</div>
    </aside>
</section>
	
</main>
</div>
 <footer class="main-footer">
		<div class="pull-right hidden-xs">
		  <b>Version</b> 2.4.0
		</div>
		<strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
		reserved.
	  </footer>

	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
		<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
		  <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
		  <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
		</ul>
    <!-- Tab panes -->
		<div class="tab-content">
		  <!-- Home tab content -->
		  <div class="tab-pane" id="control-sidebar-home-tab">
			<h3 class="control-sidebar-heading">Recent Activity</h3>
			<ul class="control-sidebar-menu">
			  <li>
				<a href="javascript:void(0)">
				  <i class="menu-icon fa fa-birthday-cake bg-red"></i>

				  <div class="menu-info">
					<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

					<p>Will be 23 on April 24th</p>
				  </div>
				</a>
			  </li>
			  <li>
				<a href="javascript:void(0)">
				  <i class="menu-icon fa fa-user bg-yellow"></i>

				  <div class="menu-info">
					<h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

					<p>New phone +1(800)555-1234</p>
				  </div>
				</a>
			  </li>
			  <li>
				<a href="javascript:void(0)">
				  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

				  <div class="menu-info">
					<h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

					<p>nora@example.com</p>
				  </div>
				</a>
			  </li>
			  <li>
				<a href="javascript:void(0)">
				  <i class="menu-icon fa fa-file-code-o bg-green"></i>

				  <div class="menu-info">
					<h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

					<p>Execution time 5 seconds</p>
				  </div>
				</a>
			  </li>
			</ul>
			<!-- /.control-sidebar-menu -->

			<h3 class="control-sidebar-heading">Tasks Progress</h3>
			<ul class="control-sidebar-menu">
			  <li>
				<a href="javascript:void(0)">
				  <h4 class="control-sidebar-subheading">
					Custom Template Design
					<span class="label label-danger pull-right">70%</span>
				  </h4>

				  <div class="progress progress-xxs">
					<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
				  </div>
				</a>
			  </li>
			  <li>
				<a href="javascript:void(0)">
				  <h4 class="control-sidebar-subheading">
					Update Resume
					<span class="label label-success pull-right">95%</span>
				  </h4>

				  <div class="progress progress-xxs">
					<div class="progress-bar progress-bar-success" style="width: 95%"></div>
				  </div>
				</a>
			  </li>
			  <li>
				<a href="javascript:void(0)">
				  <h4 class="control-sidebar-subheading">
					Laravel Integration
					<span class="label label-warning pull-right">50%</span>
				  </h4>

				  <div class="progress progress-xxs">
					<div class="progress-bar progress-bar-warning" style="width: 50%"></div>
				  </div>
				</a>
			  </li>
			  <li>
				<a href="javascript:void(0)">
				  <h4 class="control-sidebar-subheading">
					Back End Framework
					<span class="label label-primary pull-right">68%</span>
				  </h4>

				  <div class="progress progress-xxs">
					<div class="progress-bar progress-bar-primary" style="width: 68%"></div>
				  </div>
				</a>
			  </li>
			</ul>
			<!-- /.control-sidebar-menu -->

		  </div>
		  <!-- /.tab-pane -->
		  <!-- Stats tab content -->
		  <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
		  <!-- /.tab-pane -->
		  <!-- Settings tab content -->
		  <div class="tab-pane" id="control-sidebar-settings-tab">
			<form method="post">
			  <h3 class="control-sidebar-heading">General Settings</h3>

			  <div class="form-group">
				<label class="control-sidebar-subheading">
				  Report panel usage
				  <input type="checkbox" class="pull-right" checked>
				</label>

				<p>
				  Some information about this general settings option
				</p>
			  </div>
			  <!-- /.form-group -->

			  <div class="form-group">
				<label class="control-sidebar-subheading">
				  Allow mail redirect
				  <input type="checkbox" class="pull-right" checked>
				</label>

				<p>
				  Other sets of options are available
				</p>
			  </div>
			  <!-- /.form-group -->

			  <div class="form-group">
				<label class="control-sidebar-subheading">
				  Expose author name in posts
				  <input type="checkbox" class="pull-right" checked>
				</label>

				<p>
				  Allow the user to show his name in blog posts
				</p>
			  </div>
			  <!-- /.form-group -->

			  <h3 class="control-sidebar-heading">Chat Settings</h3>

			  <div class="form-group">
				<label class="control-sidebar-subheading">
				  Show me as online
				  <input type="checkbox" class="pull-right" checked>
				</label>
			  </div>
			  <!-- /.form-group -->

			  <div class="form-group">
				<label class="control-sidebar-subheading">
				  Turn off notifications
				  <input type="checkbox" class="pull-right">
				</label>
			  </div>
			  <!-- /.form-group -->

			  <div class="form-group">
				<label class="control-sidebar-subheading">
				  Delete chat history
				  <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
				</label>
			  </div>
			  <!-- /.form-group -->
			</form>
		  </div>
		  <!-- /.tab-pane -->
		</div>
	  </aside>
	  <!-- /.control-sidebar -->
	  <!-- Add the sidebar's background. This div must be placed
		   immediately after the control sidebar -->
	<div class="control-sidebar-bg"></div>
</div>	
<?php
  $this->load->view('sadmin/foot');
?>	

      
  
