<?php 
$this->load->model('api_model');
$points= $this->api_model->user_point();
$noti= $this->api_model->count_notification();
?>

<aside class="col-md-2">
	<div class="mobile_MB20">
		<div class="box-bor MB20">		
			<div class="row row1">
				<div class="col-xs-3 info-img"><img class="img-circle MR5" src="<?php echo $photo?>" width="36" alt=""></div>
				<div class="col-xs-3 info-info">
					<a href="#" onclick="window.location.href='<?php echo site_url('stem_up_setting')?>#account'" class="border-B1"><?php echo $first_name?></a>
					<p class="text-small">Lớp <?php echo $grade-2?></p>
				</div>
				<div class="col-xs-6">
					<div class="box-diem">
						<p class="text-diem1"><span class="text-diem"><?php echo $points['point']?> Sao</span></p>
					</div>
				</div>
			</div>
			<hr style="margin-top:0px;">
			<div class="row row2">
				<div class="col-xs-12 menu_chung">
					<div class="col-xs-6 mobile_m">
						<button type="button" class="btn btn-primary btn-block btn-lg text-left f20" onclick="window.location='<?php echo site_url('stem_up_setting')?>'">
							<i class="fas fa-cog MR10"></i><b>Cấu hình</b>
						</button>
					</div>
					<div class="col-xs-6 mobile_m">
						<button type="button" class="btn btn-success btn-block btn-lg text-left f20" onclick="window.location='<?php echo site_url('action')?>'">
							<i class="far fa-check-square MR10"></i><b>Hoạt động</b>
						</button>
					</div>
				</div>


				<div class="col-xs-12 next_row2 ">
					<div class="col-xs-6 mobile_m">
					<button type="button" class="btn btn-warning btn-block btn-lg text-left f20" onclick="window.location='<?php echo site_url('self_learning')?>'">
						<i class="fas fa-chalkboard-teacher MR10"></i><b>Tự học</b>
					</button>
					</div>
					<div class="col-xs-6 mobile_m">
						<button type="button" class="btn btn-danger btn-block btn-lg text-left f20" onclick="window.location='<?php echo site_url('stem_up_notification')?>'">
							<i class="far fa-bell MR10"></i>Thông báo 
							<?php 
							if($noti['so_luong']==0){}else{ ?>				
								<div id="so_thongbao" style="color:#FFFF;"><?php echo $noti['so_luong'] ?></div>
							<?php } ?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="web_MB20">
		<div class="box-bor MB20">	
			<div class="row">
				<div class="col-md-4 col-md-offset-1 info-img"><img class="img-circle MR5" src="<?php echo $photo?>" width="36" alt=""></div>
					<div class="col-xs-7 info-info">
					  <a href="#" onclick="window.location.href='<?php echo site_url('stem_up_setting')?>#account'" class="border-B1"><?php echo $first_name?></a>
					  <p class="text-small">Lớp <?php echo $grade-2?></p>
					</div>
					<div class="col-xs-12">
					  <div class="box-diem">
						  <p class="text-diem1"><span class="text-diem"><?php echo $points['point']?> Sao</span></p>
					  </div>
					</div>
			</div>
		</div>
		<div>
			<button type="button" class="btn btn-primary btn-block btn-lg text-left f20" onclick="window.location='<?php echo site_url('stem_up_setting')?>'">
				<i class="fas fa-cog MR10"></i>Cấu hình
			</button>
			<button type="button" class="btn btn-success btn-block btn-lg text-left f20" onclick="window.location='<?php echo site_url('action')?>'">
				<i class="far fa-check-square MR10"></i>Hoạt động
			</button>
			<button type="button" class="btn btn-warning btn-block btn-lg text-left f20" onclick="window.location='<?php echo site_url('self_learning')?>'">
				<i class="fas fa-chalkboard-teacher MR10"></i>Tự học
			</button>
			<button type="button" class="btn btn-danger btn-block btn-lg text-left f20" onclick="window.location='<?php echo site_url('stem_up_notification')?>'">
				<i class="far fa-bell MR10"></i>Thông báo 
				<?php 
				if($noti['so_luong']==0){}else{ ?>				
					<div id="sothongbao" style="color:#FFFF;"><?php echo $noti['so_luong'] ?></div>
				<?php } ?>
			</button>
		</div>
	</div>
</aside>