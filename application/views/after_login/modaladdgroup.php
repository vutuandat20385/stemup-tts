<div class="modal fade" id="addgroupModal" role="dialog">
	<div class="modal-dialog" style="width:40%">	 
		 <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Tạo một nhóm</h4>
			 
			</div>
			 
				<div class="modal-body" id="bodygroup">
				   <div class="form-group">
					  <input type="text"  class="form-control"  id="sg_name" name="sg_name" placeholder="Tên nhóm" required>
				   </div> 
				   <div class="form-group">
					  <textarea class="form-control" rows="5" id="sg_des" name="about" placeholder="Mô tả"></textarea>
				   </div> 
					<div class="form-group" id="grade_area2">
					    <input type='text' readonly style='display:none' id='grade2' name='grade2'>
					    <div id="grade_one_choice2">
							<select id="slgr2" required>
								<option id="optlb2"  value = "">Chọn một cấp độ</option>
								<option value = "0">Tất cả</option>
								<?php foreach ($level_list as $lv) {?>
									<option value="<?php echo $lv['lid'] ?>"><?php echo $lv['level_name']?></option>
								<?php }?>
								
							</select>
					
							hoặc <a href="#" onclick="change_type_grade2(1)">chọn trong một khoảng</a>
						</div>
						<div id="grade_range_choice2" style="display:none">
							Lớp <label id="rangegrade2">1 đến 1</label> hoặc <a href='#' onclick='change_type_grade2(2)'>chọn trong một cấp độ</a> <br/><div id='slider_range2'></div>
						</div>
						
						
					</div>
					 <div class="form-group">
					  <select id="slct2" required name="categ_group">
						<option id="ctlb2" value="">Chọn môn học</option>
						<option value="0">Tất cả</option>
						<?php foreach ($category_list as $categ) {?>
							<option value="<?php echo $categ['cid'] ?>"><?php echo $categ['category_name']?></option>
						<?php }?>
					</select>
					</div>						
			</div>
			<div class="modal-footer">
			   <input type="button" value="Xác nhận"  id="submit_group" onclick="create_group2()" class="btn btn-success">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		 </div>
		  
	</div>
</div>

<div class="modal fade" id="invitestdgroupModal" role="dialog">
	<div class="modal-dialog" style="width:40%">	 
		 <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Thêm nhóm thành công</h4>
			 
			</div>
			 
			<div class="modal-body">
				   <table>
						<tbody>
						   <tr>
								<td class="group_code" style="color: #fecb00;border: 2px dashed #fecb00;padding:5px;width:25%">
									<h3 style="text-align: center;" id="group_code" autocomplete="off"></h3>
								</td>
								<td style="padding:12px" class="message_group"></td>
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

