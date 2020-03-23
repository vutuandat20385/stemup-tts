<div class="container">
	<h3><?php echo $title;?></h3>
	<div class="row">
     	<form method="post" action="<?php echo site_url('data/edit_dataitem/'.$did);?>">
			<div class="col-md-8">
				<br> 
 				<div class="login-panel panel panel-default">
					<div class="panel-body">
						<?php 
							if($this->session->flashdata('message')){
								echo $this->session->flashdata('message');	
							}
						?>

						<div class="form-group">	 
							<label for="inputEmail"  ><?php echo $this->lang->line('group_id');?></label>
							<select class="form-control" name="group_id" id="group_id" onchange="changeDataGroup();">
							<?php 
								foreach($datagroup_list as $key => $val){
							?>
								<option value="<?php echo $val['gid'];?>" <?php if($dataitem['group_id']==$val['gid']){ echo 'selected';}?> ><?php echo $val['datagroup_name'];?></option>
							<?php 
								}
							?>
							</select>
						</div>

						<div class="form-group">	 
							<label for="inputEmail"><?php echo $this->lang->line('dataitem_name');?></label> 
							<input type="text" required  name="dataitem_name"  class="form-control" value="<?php echo $dataitem['dataitem_name'];?>"/> 
						</div>

						<div class="form-group">	 
							<label for="inputEmail"><?php echo $this->lang->line('dataitem_code');?></label> 
							<input type="text" required  name="dataitem_code"  class="form-control" value="<?php echo $dataitem['dataitem_code'];?>"/> 
						</div>

						<div class="form-group">	 
							<label for="inputEmail"><?php echo $this->lang->line('dataitem_level');?></label> 
							<input type="text" required  name="dataitem_level" id="dataitem_level" class="form-control" value="<?php echo $dataitem['dataitem_level'];?>" onchange="changeDataGroup();" /> 
						</div>

						<div class="form-group">	 
							<label for="inputEmail"><?php echo $this->lang->line('parent_id');?></label> 
							<select class="form-control" name="parent_id" id="parent_id"></select>
						</div>
						
						<div class="form-group">	 
							<label for="inputEmail"  ><?php echo $this->lang->line('description');?></label> 
							<textarea  name="description"  class="form-control"><?php echo $dataitem['description'];?></textarea>
						</div>
						<button class="btn btn-default" type="submit"><?php echo $this->lang->line('submit');?></button>
					</div>
				</div>
			</div>
      	</form>
	</div>
</div>
<script>
changeDataGroup();
</script>