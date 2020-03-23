<h3 class="col-md-12 col-md-offset-2"><?php echo $title;?></h3>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<form method="post" action="<?php echo site_url('user/insert_user/');?>">
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
							<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('email_address');?></label> 
							<input type="email" id="inputEmail" name="email" class="form-control" placeholder="<?php echo $this->lang->line('email_address');?>" required autofocus>
						</div>
						<div class="form-group">	  
								<label for="inputPassword" class="sr-only"><?php echo $this->lang->line('password');?></label>
								<input type="password" id="inputPassword" name="password"  class="form-control" placeholder="<?php echo $this->lang->line('password');?>" required >
						 </div>
						<div class="form-group">	 
								<label for="inputEmail" class="sr-only"><!--<?php echo $this->lang->line('first_name');?>--> Tên</label> 
								<input type="text"  name="first_name"  class="form-control" placeholder="Tên"   autofocus>
						</div>
						
						<div class="form-group">	 
								<label for="inputEmail" class="sr-only"><?php echo $this->lang->line('contact_no');?></label> 
								<input type="text" name="contact_no"  class="form-control" placeholder="<?php echo $this->lang->line('contact_no');?>"   autofocus>
						</div>


		    <div class="form-group">
				<label><?php echo $this->lang->line('tinhthanh_id'); ?></label>
				<select class="form-control" name="tinhthanh_id" id="tinhthanh_id" onchange="changeDataItem(event);" required>
					<option value="0"> ----Chọn tỉnh/ thành phố----</option>
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
					<select class="form-control" name="quanhuyen_id" id="quanhuyen_id" onchange="changeDataItem(event);" >
					</select>
				</div>

				<div class="form-group">
					<label><?php echo $this->lang->line('xaphuong_id'); ?></label>
					<select class="form-control" name="xaphuong_id" id="xaphuong_id" onchange="changeDataItem(event);" ></select>
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
               <button class="btn btn-default" type="submit"><?php echo $this->lang->line('submit');?></button>

			</div>			
		</div>

	</div>
</form> 