<h3 class="col-md-12 col-md-offset-2"><?php echo $title;?></h3>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<form method="post" action="<?php echo site_url('user/process_excel')  ?>" enctype="multipart/form-data">
   <div class="login-panel panel panel-default col-md-7 col-md-offset-2">
		<div class="panel-body"> 
			<?php 
				if($this->session->flashdata('message')){
					echo $this->session->flashdata('message');	
				}
			?>
             <script>
				$(document).ready(function() {
				    $('#tinhthanh_id').select2();
				    $('#quanhuyen_id').select2();
				    $('#xaphuong_id').select2();
				});

             </script>
		    

		    <div class="form-group">
				<label><?php echo $this->lang->line('tinhthanh_id'); ?></label>
				<select class="form-control" name="tinhthanh_id" id="tinhthanh_id" onchange="changeDataItem(event);" required>
					<option> ----Chọn tỉnh/ thành phố----</option>
					<?php
						foreach ($dataitem_list as $key => $val) {
					?>

						<option value="<?php echo $val['did'];?>"><?php echo $val['dataitem_name'];?></option>
					<?php
						}
					?>
				</select>
				</div>

				<div class="form-group">
					<label><?php echo $this->lang->line('quanhuyen_id'); ?></label>
					<select class="form-control" name="quanhuyen_id" id="quanhuyen_id" onchange="changeDataItem(event);" required>
					</select>
				</div>

				<div class="form-group">
					<label><?php echo $this->lang->line('xaphuong_id'); ?></label>
					<select class="form-control" name="xaphuong_id" id="xaphuong_id" onchange="changeDataItem(event);" required></select>
				</div>

				<div class="form-group">
					<label   ><?php echo $this->lang->line('account_type');?></label> 
					<select class="form-control" name="su">
						<?php 
						foreach($account_type as $ak =>$val){
						?>
						<option value="<?php echo $val['account_id'];?>"><?php echo $val['account_name'];?></option>
						<?php 
						}
						?>
						 
					</select>
				</div>
                <label>Chọn file:(chỉ hỗ trợ file .xls và .xlsx) </label> <input type="file" name="upload"/>
         		<input style="margin-top:40px;" class="btn btn-success" type="submit" name="uploadclick" value="Xác nhận"/>

			</div>			
		</div>

	</div>
</form> 