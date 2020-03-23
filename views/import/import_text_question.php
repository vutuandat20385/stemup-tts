<h3 class="col-md-12 col-md-offset-2"><?php echo $title;?></h3>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<div class="col-md-7 col-md-offset-2">
	<h3>Thêm câu hỏi dạng text. </h3>
</div>
<form method="post" action="<?php echo site_url('import/process_excel2')  ?>" enctype="multipart/form-data">
   <div class="login-panel panel panel-default col-md-7 col-md-offset-2">
		<div class="panel-body"> 
			<?php 
				if($this->session->flashdata('message')){
					echo $this->session->flashdata('message');	
				}
			?>
		    
                <label>Chọn file:(upload file excel .xls hoặc .xlsx và các ảnh ) </label> 
         		<input name="upload[]" type="file" multiple="multiple" />
				<input style="margin-top:40px;" class="btn btn-success" type="submit" name="uploadclick" value="Xác nhận"/>

			</div>			
		</div>

	</div>
</form> 