<div class="container">
 	<h3><?php echo $title;?></h3>
  	<div class="row">
     	<form method="post" action="<?php echo site_url('data/edit_datagroup/'.$gid);?>">
	
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
							<label for="inputEmail"  ><?php echo $this->lang->line('datagroup_name');?></label> 
							<input type="text" required  name="datagroup_name"  class="form-control"  value="<?php echo $datagroup['datagroup_name'];?>" > 
						</div>

						<div class="form-group">	 
							<label for="inputEmail"  ><?php echo $this->lang->line('datagroup_code');?></label> 
							<input type="text" required  name="datagroup_code"  class="form-control"  value="<?php echo $datagroup['datagroup_code'];?>"   > 
						</div>
					 
						<div class="form-group">	 
							<label for="inputEmail"  ><?php echo $this->lang->line('description');?></label> 
							<textarea  name="description"  class="form-control"><?php echo $datagroup['description'];?></textarea>
						</div>
						<button class="btn btn-default" type="submit"><?php echo $this->lang->line('submit');?></button>
					</div>
				</div>
			</div>
      	</form>
	</div>
</div>
