

<div class="modal fade" id="addclassModal" role="dialog">
	<div class="modal-dialog" style="">	 
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tạo một lớp</h4>

			</div>
			<div class="modal-body" id="bodyclass">
				<div class="form-group">
					<input type="text"  class="form-control"  id="class_name" name="class_name" placeholder="Tên lớp" required>
				</div> 
				<div class="form-group" id="grade_area">
					<input type='text' readonly style='display:none' id='grade' name='grade'>
					<div id="grade_one_choice">
						<select id="slgr" required>
							<option id="optlb"  value = "">Chọn lớp</option>
							<option value = "0">Tất cả</option>
							<?php foreach ($level_list as $lv) {?>
								<option value="<?php echo $lv['lid'] ?>"><?php echo $lv['level_name']?></option>
							<?php }?>
						</select>

						<!--hoặc <a href="#" onclick="change_type_grade(1)">chọn trong một khoảng</a>-->
					</div>
					<div id="grade_range_choice" style="display:none">
						Lớp <label id="rangegrade">1 đến 1</label> hoặc <a href='#' onclick='change_type_grade(2)'>chọn trong một cấp độ</a> <br/><div id='slider_range'></div>
					</div>


				</div>
				<div class="form-group">
					<select id="slct" required name="categ_class">
						<option id="ctlb" value="">Chọn môn học</option>
						<option value="0">Tất cả</option>
						<?php foreach ($category_list as $categ) {?>
							<option value="<?php echo $categ['cid'] ?>"><?php echo $categ['category_name']?></option>
						<?php }?>
					</select>
				</div>						
			</div>
			<div class="modal-footer">
				<input type="button" value="Xác nhận"  id="submit_class" onclick="create_class2()" class="btn btn-success">
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="back_home_user()">Close</button>
			</div>
		</div>

	</div>
</div>

<div class="modal fade" id="invitestdclassModal" role="dialog">
	<div class="modal-dialog" style="">	 
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Thêm lớp thành công</h4>

			</div>

			<div class="modal-body">
				<table>
					<tbody>
						<tr>
							<td class="class_code" style="color: #fecb00;border: 2px dashed #fecb00;padding:5px;width:25%">
								<h3 style="text-align: center;" id="class_code"></h3>
							</td>
							<td style="padding:12px" class="message_class"></td>
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
