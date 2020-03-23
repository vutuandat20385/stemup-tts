<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Child Activities</title>
    <!-- Bootstrap -->
	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('css/style-hu.css');?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=latin,vietnamese" rel="stylesheet" type="text/css">
	  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
	<script src="<?php echo base_url('js/jquery.dataTables.js');?>"></script>
	<link href="<?php echo base_url('css/jquery.dataTables.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('js/responsive.dataTables.js');?>"></script>
	<link href="<?php echo base_url('css/responsive.dataTables.min.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('js/editprofile.js');?>"></script>
   <script>	
	var base_url="<?php echo base_url();?>";

	</script>
	<script src="<?php echo base_url('js/left-menu.js');?>"></script>
  </head>
  <body class="bg-body">
<nav class="navbar navbar-stem navbar-fixed-top">
  <div class="container">
  	    <!-- Brand and toggle get grouped for better mobile display -->
  	    <div class="navbar-header">
  	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        <a class="navbar-brand navbar-brand1" href="#"><img src="<?php echo base_url('images/hu_logo_home1.png');?>" alt=""></a></div>
  	    <!-- Collect the nav links, forms, and other content for toggling -->
  	    <div class="collapse navbar-collapse" id="defaultNavbar1">
  	        <form class="navbar-form navbar-left" role="search">
			  <div class="input-group">
			    <input type="text" class="form-control form-TK1 w350" placeholder="Tìm kiếm khóa học">
			    <a href="" class="input-group-addon addon-TK1"><i class="fa fa-search" aria-hidden="true"></i></a>
			  </div>
			</form>
 	        <ul class="nav navbar-nav navbar-right">
  	        <li>
				<a class="text-trang hover text-center" href="<?php echo site_url();?>"><i class="fas fa-home"></i><br>Trang chủ</a>
			</li>
			<li>
				<a class="text-trang hover text-center" href="#"><i class="far fa-calendar-check"></i><br>Nhiệm vụ</a>
			</li>
			<li>
				<a class="text-trang hover text-center" href="#"><i class="far fa-chart-bar"></i><br>Kết quả</a>
			</li>
			
			<li>
				<a class="text-trang hover text-center" href="#"><i class="far fa-envelope"></i><span class="badge badge-sm up bg-pink count">4</span><br>Tin nhắn</a>
			</li>
			<li>
				<a class="text-trang hover text-center" href="#"><i class="far fa-bell"></i><span class="badge badge-sm up bg-pink count">4</span><br>Thông báo</a>
			</li>
  	        <li class="dropdown"><a href="#" class="dropdown-toggle bt-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
  	        	<?php if($link_photo) { ?>
    			    <img id="avt" class=" img-circle MR5" src="<?php echo base_url('upload/avatar/'.$uid.'.png');?> " alt="" width="32" height="32">
    			<?php } else{ ?>   
    			   <img id="avt" class=" img-circle MR5" src="<?php echo base_url('upload/avatar/default.png');?> " alt="" width="32">
    			<?php } ?> 
  	        	<span class=" 
caret caret_e 
"></span></a>
  	          <ul class="dropdown-menu dropdown-menu1" >
  	            <li><a href="#"><i class="MR10 fa fa-file-alt text-primary" aria-hidden="true"></i>Bảng tin</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-comments text-danger" aria-hidden="true"></i>Tin nhắn</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-th-large text-success" aria-hidden="true"></i>Khóa học</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-calendar text-danger" aria-hidden="true"></i>Sự kiện</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-users text-info" aria-hidden="true"></i>Nhóm</a></li>
  	            <li><a href="#"><i class="MR10 fa fa-address-book text-warning" aria-hidden="true"></i>Dánh sách bạn bè</a></li>
				<li><a href="<?php echo site_url('home_user/child_list'); ?>"><i class="MR10 fa fa-users text-success" aria-hidden="true"></i>Dánh sách các con</a></li>
				<li><a data-toggle="modal" data-target="#transferModal"><i class="MR10 fas fa-exchange-alt text-warning" aria-hidden="true"></i>Chuyển điểm</a></li>
				<li><a data-toggle="modal" data-target="#infoModal"><i class="MR10 fas fa-user text-success" aria-hidden="true"></i>Thông tin cá nhân</a></li>
  	            <li><a href="<?php echo site_url('user/logout');?>"><i class="MR10 fa fa-sign-out-alt"></i> Log Out</a></li>
              </ul>
            </li>
				<!--<li>
				<a class="text-trang hover text-center text-TV" href="#">Mời thành viên</a>
			</li>-->
          </ul>
        </div>
  	    <!-- /.navbar-collapse -->
  </div>
  	  <!-- /.container-fluid -->
  </nav><!--end nav-->
<main class="container MT70">
		<div class="modal fade" id="infoModal" role="dialog">
		<div class="modal-dialog">	 
			 <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Thông tin cá nhân</h4>
				 
				</div>
				<div class="modal-body">

                    <table class="table table-user-information">
	                    <tbody>
		                    <tr>
		                        <td>Họ tên</td>
		                        <td >
		                        	<?php  echo $user_name?>
		                        </td>
		                        <td>
		                        	<!-- <a onclick="editButton(this)">
		                        		<i class="fa fa-pencil-alt"></i>
		                        		Edit
		                        	</a> -->
		                        </td>
		                    </tr>
                        	<tr>
                        		<td>Email</td>
                        		<td>
                        			<?php  echo $email ?>
                        		<td>
                        			<!-- <a onclick="editButton(this)">
                        				<i class="fa fa-pencil-alt"></i>
                        				Edit
                        			</a> -->
                        		</td>
                      		</tr>
                        	<tr>
                        		<td>Số điện thoại</td>
                        		<td>
                        			<?php  echo $phone?>
                        		</td>
                        		<td>
                        			<!-- <a onclick="editButton(this)">
                        				<i class="fa fa-pencil-alt"></i>
                        				Edit
                        			</a> -->
                        		</td>
                      		</tr>
                      		<tr>
                        		<td>Ảnh đại diện</td>
                        		<td >
                        			<?php if($link_photo) { ?>
                        			    <img id="avt" class="MR5" src="<?php echo base_url('upload/avatar/'.$uid.'.png');?> " alt="" width="128">
                        			<?php } else{ ?>   
                        			   <img id="avt" class="MR5" src="<?php echo base_url('upload/avatar/default.png');?> " alt="" width="128">
                        			<?php } ?> 
                        		</td>
                        		<td>
                        			<a onclick="edit_avatar()">
                        				<i class="fa fa-pencil-alt"></i>
                        				Chỉnh sửa
                        			</a>
                        		</td>
                      		</tr>
	                    </tbody>
	                </table>
				    
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			 </div>
			  
		</div>
	</div>
    <div class="modal fade" id="editavtModal" role="dialog">
		<div class="modal-dialog">	 
			 <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Chỉnh sửa ảnh đại diện</h4>
				 
				</div>
				<div class="modal-body">
				     <form method="post" action="<?php echo site_url('home_user/upload_photo');?>" enctype="multipart/form-data">
						<label>Chọn ảnh :(chỉ hỗ trợ  .png và .jpg) </label> <input type="file" name="upload"/>
         	            <input style="margin-top:40px;" class="btn btn-success" type="submit" name="uploadclick" value="Xác nhận"/>
				    </form>
				    
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			 </div>
			  
		</div>
	</div>

    <div class="modal fade" id="transferModal" role="dialog">
			<div class="modal-dialog">	 
				 <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Chuyển điểm</h4>
					 
					</div>
					<div class="modal-body">
					     <form method="post" action="<?php echo site_url('tranfer_point/tranfer_1/');?>">
							<div class="col-md-12">
							   <p class="col-md-4">Chuyển tới:</p>
							   <input  class="col-md-8" type="text" class="form-control" name="user_received" value="" placeholder="Nhập vào email người cần chuyển"  required />
						   </div>
						  <div class="col-md-12">
							   <p class="col-md-4">Số điểm cần chuyển:</p>
							   <input  class="col-md-8" type="number" class="form-control" name="point_tranfer" value="0" placeholder="0"  required />
						   </div>
						   <div class="col-md-12">
								<p class="col-md-4">Mật khẩu:</p>
								<input class="col-md-8" type="password" class="form-control" name="pwd_tranfer" value="" placeholder="Nhập vào mật khẩu của bạn"  required />
						  </div> 
						  <div class="col-md-offset-4">
							<button  style="margin-top:30px" class="btn btn-success" type="submit">Xác nhận</button>
						  </div>
					    </form>
					    
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				 </div>
				  
			</div>
		</div>
	<section class="row">
  	  <aside class="col-md-2">
		  <div class="box-bor MB20">
			  <div class="row">
				  <div class="col-xs-3">
				  	<?php if($link_photo) { ?>
    			    <img id="avt" class=" img-circle MR5" src="<?php echo base_url('upload/avatar/'.$uid.'.png');?> " alt="" width="32" height="32">
    			<?php } else{ ?>   
    			   <img id="avt" class=" img-circle MR5" src="<?php echo base_url('upload/avatar/default.png');?> " alt="" width="32">
    			<?php } ?> 
				  </div>
				  <div class="col-xs-9">
					  <a href="#" class="border-B1"><?php echo $user_name;?></a>
					  <p class="text-small">Phụ Huynh</p>
				  </div>
				  <div class="col-xs-12">
					  <div class="box-diem">
						  <p class="text-diem1"><span class="text-diem"><?php echo $user_point." Sao"?></span></p>
					  </div>
				  	
				  </div>
			  </div>
		  </div>
		  <div class="list-group">

			  <h3 class="list-group-item active1">Trắc nghiệm</h3>
			   <!-- <a href="#" class="list-group-item">Kiểm tra</a>-->
			  <a href="#" class="list-group-item" onclick="resultItem(event);">Kết quả</a>
			  <!--<a href="#" class="list-group-item">Tạo câu hỏi</a>-->
			  <!--<a href="#" class="list-group-item">Quản lý câu hỏi</a>--->
			  
		  </div>
		  
		  <div class="list-group">
			  <h4 class="list-group-item active1">Hoạt động của con</h4>
			   <?php foreach($child_list as $k=>$child) { ?>
			  <a href="<?php echo site_url('home_user/child_activities/'.$k); ?>" class="list-group-item"><?php echo $child['sname']; ?></a>
			  <?php } ?>
			  <a data-toggle="modal" data-target="#addstudentModal" class="list-group-item"><i class="far fa-plus-square"></i>  Thêm học sinh</a>
			  
		  </div>
		  <div class="modal fade" id="addstudentModal" role="dialog">
			<div class="modal-dialog">	 
				 <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Thêm học sinh</h4>
					 
					</div>
					<div class="modal-body">
					  <input type="text" class="form-control form-TK1 col-md-5"  style="width:450px" placeholder="Mã học sinh"/>
					    <button type="button" class="btn btn-primary" style="margin-left:30px">Xác nhận</button>
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				 </div>
				  
			</div>
		</div>
  	  </aside>
  	  <aside class="col-md-10">
			<div class="box-lop">
				<div class="line-L">
					<h1>Học sinh <?php echo $child_name?></h1>
					<!--<p>Văn Long Thạch - Lớp 9 - Tiếng Anh</p>-->
				</div>
			</div>
			<div role="tabpanel">
				<ul class="nav nav-tabs MB20 bg-tab" role="tablist">
					<li role="presentation" class="active"><a href="#acti" data-toggle="tab" role="tab" aria-controls="tab2">Hoạt động </a></li>
					<li role="presentation"><a href="#posts" data-toggle="tab" role="tab" aria-controls="tab1">Đăng bài</a></li>
				  
					<!--<li role="presentation"><a href="#paneTwo3" data-toggle="tab" role="tab" aria-controls="tab2">Thành viên</a></li>-->
					<li class="pull-right MR10">
						  <!-- Single button -->
						<div class="btn-group">
						  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							<i class="fas fa-cog MR10"></i>Cài đặt<span class=" 
caret caret_e 
"></span>
						  </button>
						  <ul class="dropdown-menu dropdown-menu_e" style="overflow-y: scroll;height: 273px;font-size:15px" role="menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
						  </ul>
						</div>
					</li>
				</ul>
				
				<div id="home1"  class="box-bor MB20" style="display:none;">
				</div>	
			
		    <div id="tabContent2" class="tab-content">
			    <div role="tabpanel" class="tab-pane fade in active" id="acti">
					<div class="box-bor MB20">
                       <div role="tabpanel">
							<ul class="nav nav-tabs" role="tablist" >
								<li role="presentation" class="active"><a href="#all" data-toggle="tab" role="tab" aria-controls="tab1">All</a></li>
								<li role="presentation"><a href="#event" data-toggle="tab" role="tab" aria-controls="tab2">Event</a></li>
								<li role="presentation"><a href="#assignment" data-toggle="tab" role="tab" aria-controls="tab2">Assignment</a></li>
								<li role="presentation"><a href="#quiz" data-toggle="tab" role="tab" aria-controls="tab2">Quizzes</a></li>
							</ul>
							<div id="tabContent1" class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="all">
								    <div class="media-object-default" style="margin-top:20px">
									    <?php if($child_id==1){?>
										<div class="media" >
											<div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?> " alt="placeholder image"></a></div>
											<div class="media-body">
												<h4 class="media-heading">Làm bài trắc nghiệm </h4>
												<?php echo $child_name ?> làm bài trắc nghiệm vào 10 phút trước </br>
												<a href="#"> xem kết quả</a>
											</div>
							            </div>
										<hr>
										<div class="media" >
											<div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?> " alt="placeholder image"></a></div>
											<div class="media-body">
												<h4 class="media-heading">Làm bài trắc nghiệm </h4>
												<?php echo $child_name ?> làm bài trắc nghiệm vào 9:12 ngày 14/04/2018 </br>
												<a href="#"> xem kết quả</a>
											</div>
							            </div>
										<hr>
										<div class="media" >
											<div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?> " alt="placeholder image"></a></div>
											<div class="media-body">
												<h4 class="media-heading">Tham gia nhóm </h4>
												<?php echo $child_name ?> tham gia vào nhóm Toán lớp 7 vào 15:42 ngày 12/04/2018 </br>
												
											</div>
							            </div>
										<?php } 
										else {?>
										<div class="media" >
											<div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?> " alt="placeholder image"></a></div>
											<div class="media-body">
												<h4 class="media-heading">Làm bài trắc nghiệm </h4>
												<?php echo $child_name ?> làm bài trắc nghiệm vào 22 phút trước </br>
												<a href="#"> xem kết quả</a>
											</div>
							            </div>
										<hr>
										<div class="media" >
											<div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?> " alt="placeholder image"></a></div>
											<div class="media-body">
												<h4 class="media-heading">Tham gia nhóm </h4>
												<?php echo $child_name ?> tham gia vào nhóm Sinh lớp 6 vào 7:17 ngày 13/04/2018 </br>
												
											</div>
							            </div>
										<hr>
										<div class="media" >
											<div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?> " alt="placeholder image"></a></div>
											<div class="media-body">
												<h4 class="media-heading">Tham gia nhóm </h4>
												<?php echo $child_name ?> tham gia vào nhóm Toán lớp 6 vào 7:15 ngày 13/04/2018 </br>
												
											</div>
							            </div>
										<hr>
										<div class="media" >
											<div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?> " alt="placeholder image"></a></div>
											<div class="media-body">
												<h4 class="media-heading">Làm bài trắc nghiệm </h4>
												<?php echo $child_name ?> làm bài trắc nghiệm vào  7:12 ngày 13/04/2018 </br>
												<a href="#"> xem kết quả</a>
												
											</div>
							            </div>
										
										<?php }?>
									</div>
								    
                                </div>
								
								<div role="tabpanel" class="tab-pane fade" id="event">
								  <p>Content 2</p>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="assignment">
								  <p>Content 23</p>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="quiz">
								  <p>Content 24</p>
								</div>
							
							</div>
						</div>
		
				    </div>
			    </div>
 
				<div role="tabpanel" class="tab-pane fade" id="posts">
				 
					<div class="box-bor MB20">
						<div class="row">
							<div class="col-xs-2">
								  Post:
							</div>
							<div class="col-xs-10 BL">
								  <!--<a href="">Ghi chú</a>
								  <a href="">Cảnh báo</a>-->
								  <a href="">Nhiệm vụ</a>
						    </div>
						</div>
						<hr>
					    <div class="row">
						  <div class="col-xs-2">
							  <img class="img-responsive img-thumbnail" src="<?php echo base_url('images/hu_mh1.jpg');?> " alt="">
						  </div>
						  <div class="col-xs-10 BL">
							<div class="media-object-default">
								 <div class="media">
								   <div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?> " alt="placeholder image"></a></div>
								   <div class="media-body">
									 <h4 class="media-heading">Media heading 1</h4>
									 This is the content inside the media-body. By default the media is top-aligned. Use class "media-middle" or "media-bottom" to middle align or bottom align them, respectively. </div>
							  </div>
								 <div class="media">
								   <div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
								   <div class="media-body">
									 <h4 class="media-heading">Media heading 2</h4>
									 This is the content inside the media-body. By default the media is top-aligned. Use class "media-middle" or "media-bottom" to middle align or bottom align them, respectively.
									 <div class="media">
									   <div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
									   <div class="media-body">
										 <h4 class="media-heading">Nested media heading</h4>
										 This is the content inside the nested media-body. By default the media is top-aligned. Use class "media-middle" or "media-bottom" to middle align or bottom align them, respectively. </div>
									 </div>
								   </div>
							  </div>
								 <div class="media">
								   <div class="media-body">
									 <h4 class="media-heading">Media heading 4</h4>
									 This is the content inside the media-body. By default the media is top-aligned. Use class "media-middle" or "media-bottom" to middle align or bottom align them, respectively. </div>
								   <div class="media-right"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
							  </div>
								 <div class="media">
								   <div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
								   <div class="media-body">
									 <h4 class="media-heading">Media heading 5</h4>
									 This is the content inside the media-body. By default the media is top-aligned. Use class "media-middle" or "media-bottom" to middle align or bottom align them, respectively. </div>
								   <div class="media-right"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
							  </div>
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

  </body>
</html>