
  <aside class="col-md-7">
		<div id="tabContent2" class="tab-content">
				  <div role="tabpanel" class="tab-pane fade in active" id="home2a">
					<div class="box-bor MB20">
						<div role="tabpanel" id="tabs">
						  <ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#home1"  id="text-tabs" data-toggle="tab" role="tab" aria-controls="tab1">
							Thông tin</a></li>
							
							
							<li role="presentation"><a href="#home4"  id="text-tabs4" data-toggle="tab" role="tab" aria-controls="tab4">Tài khoản</a></li>
						
						  </ul>
						  <div id="tabContent1" class="tab-content mobile_ch">
							<div role="tabpanel" class="tab-pane fade in active" id="home1" style="margin-top: 40px;">
								
								<div class="box-bor MB20 padding10px fz17" style="cursor:pointer" onclick="window.location= '<?php echo base_url() ?>index.php/help' ">
									<img class="img-setting"  src="<?php echo base_url('images/1.jpg'); ?>"> 
									&nbsp;&nbsp;&nbsp;Hướng dẫn sử dụng
									
								</div>
				  
								<div class="box-bor MB20 padding10px fz17" style="cursor:pointer" onclick="window.location= '<?php echo base_url() ?>index.php/info' ">
									<img class="img-setting" src="<?php echo base_url('images/2.png'); ?>" >
									&nbsp;&nbsp;&nbsp;Giới thiệu STEMUP
								</div>
							</div>
							
							<div role="tabpanel" class="tab-pane fade in" id="home4" style="margin-top: 40px;">
							
						<form id="user_infomation">
							<input type="text" name="uid" value="<?php echo $uid ?>" style="display:none" >
							<h4><table >
								<tbody>
									<tr>
										<td style="padding:10px">Tên:</td>
										<td style="padding:10px">								
											<div id="fname"><?php echo $first_name.' '.$last_name  ?></div>
										<!--	<input type="text" name="fname" value="<?php echo $first_name?>" id="txtfname" style="display:none"> -->
										</td>
									</tr>
								<!--	<tr>
										<td style="padding:10px">Tên:</td>
										<td style="padding:10px">								
											<div id="lname"><?php echo $last_name?></div>
											<input type="text" name="lname" value="<?php echo $last_name?>" id="txtlname" style="display:none">
										</td>
									</tr> -->
									<tr>
										<td style="padding:10px">Ngày sinh:</td>
										<td style="padding:10px">
											<div id="birthdate"><?php echo $birthdate?></div>
											<input type="text" name="birthdate" value="<?php echo $birthdate?>" id="bdt" placeholder="dd-mm-yyyy ví dụ :23-05-2018" style="display:none">
										</td>
									</tr>
									<?php if($su==2 || $su==3){ ?>
										<tr>
											<td style="padding:10px">Lớp:</td>
											<td style="padding:10px">
												<div id="cla"><?php echo $grade-2?></div>
											</td>
										</tr>
										<tr>
											<td style="padding:10px">Trường:</td>
											<td style="padding:10px">
												<div id="scl"><?php echo $schools ?></div>
												<div id="scl_change" style="display:none" class="col-md-12 col-xs-12" >
													<div class="col-md-4 col-xs-12">
														<select class="form-control" name="scl_tinhthanh_id" id="scl_tinhthanh_id" onchange="changeDataSchool(event);">
															<option selected> ----Chọn tỉnh/ thành phố----</option>
															
															<?php
															foreach ($tinhthanh as $key => $val) {
																if($val['did']){ 
																	?>
																	
																	<option value="<?php echo $val['did'];?>" ><?php echo $val['dataitem_name'];?></option>
																<?php } else{ ?>
																	
																	<option value="<?php echo $val['did'];?>"><?php echo $val['dataitem_name'];?></option>
																<?php }}?>
															</select>
														</div>
														<div class="col-md-4 col-xs-12">
															<select class="form-control" name="scl_quanhuyen_id" id="scl_quanhuyen_id" onchange="changeDataSchool1(event)"></select>
														</div>
														<div class="col-md-4 col-xs-12">
															<select class="form-control" name="scl_school_id" id="scl_school_id" onchange=""></select>
														</div>
											<!--<div class="col-md-4 col-xs-12">
												<select class="form-control" name="xaphuong_id" id="scl_xaphuong_id" onchange="changeDataSchool(event);"></select>
											</div>-->
										</div>
									</td>
								</tr>
							<?php }?>
							<tr>
								<td style="padding:10px">Địa chỉ:</td>
								<td style="padding:10px">
									<div id="address"><?php echo $address?></div>
									<div id="address_change" style="display:none;" class="col-md-12 col-xs-12" >
										<div class="col-md-4 col-xs-12">
											<select class="form-control" name="tinhthanh_id" id="tinhthanh_id" onchange="changeDataItem(event);">
												<option> ----Chọn tỉnh/ thành phố----</option>
												<?php
												foreach ($dataitem_list as $key => $val) {
													if($val['did']==$tinhthanh_id){ 
														?>
														
														<option value="<?php echo $val['did'];?>" selected><?php echo $val['dataitem_name'];?></option>
													<?php } else{ ?>
														
														<option value="<?php echo $val['did'];?>"><?php echo $val['dataitem_name'];?></option>
													<?php }}?>
												</select>
											</div>
											<div class="col-md-4 col-xs-12">
												<select class="form-control" name="quanhuyen_id" id="quanhuyen_id" onchange="changeDataItem(event);"></select>
											</div>
											<div class="col-md-4 col-xs-12">
												<select class="form-control" name="xaphuong_id" id="xaphuong_id" onchange="changeDataItem(event);"></select>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td style="padding:10px">Email:</td>
									<td style="padding:10px">								
										<div id="usmail"><?php echo $email?></div>
									<!--	<input type="email" name="email" value="<?php echo $email?>" id="usmt" style="display:none"> -->
									</td>       
								</tr>
								<tr>
									<td style="padding:10px">Số điện thoại:</td>				
									<td style="padding:10px">								
										<div id="usphone"><?php echo $phone?></div>
										<input type="number" name="phone" value="<?php echo $phone?>" id="uspn" style="display:none">
									</td>          
								</tr>
							</tbody>
						</table>
					</h4>
				</form>
				<div id="btn_inf">
				<button class="btn btn-danger" id="btn_edt_inf"  onclick="edit_info_stemup(<?php echo $tinhthanh_id.','.$quanhuyen_id.','.$xaphuong_id.','.$uid.','.$scl_tinhthanh_id.','.$scl_quanhuyen_id.','.$scl_school_id ?>)">Chỉnh sửa</button>
				</div>

							</div>
	
							
						</div>
				</div>
					
		      
	        </div>
			</div>
	

  </aside>
   <aside class="col-md-3 rightbar">
	   
      </aside>
   