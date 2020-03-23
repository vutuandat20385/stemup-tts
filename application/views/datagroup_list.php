 <div class="container">
	<h3><?php echo $title;?></h3>

	<div class="row"> 
		<div class="col-md-12">
			<br>
			<?php 
				if($this->session->flashdata('message')){
					echo $this->session->flashdata('message');	
				}
			?>	
			<div id="message"></div>
			<a href="<?php echo site_url('data/add_new_datagroup');?>" class="btn btn-success">Add New</a>			
			<table class="table table-bordered">
				<tr>
				 	<th><?php echo $this->lang->line('datagroup_name');?></th>
				 	<th><?php echo $this->lang->line('datagroup_code'); ?></th>
					<th><?php echo $this->lang->line('action');?> </th>
				</tr>
				<?php 
					if(count($datagroup_list)==0){
				?>
				<tr>
				 	<td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
				</tr>	
				<?php
					}

					foreach($datagroup_list as $key => $val){
				?>
						<tr>
						 	<td> <?php echo $val['datagroup_name'];?></td>
						 	<td><?php echo $val['datagroup_code'];?></td>
							<td>
								<a href="<?php echo site_url('data/edit_datagroup/'.$val['gid']);?>"><img src="<?php echo base_url('images/edit.png');?>"></a>
								<a href="<?php echo site_url('data/remove_datagroup/'.$val['gid']);?>" onclick="return confirm('Are you sure you want to delete this item?')"><img src="<?php echo base_url('images/cross.png');?>"></a>
							</td>
						</tr>

				<?php 
					}
				?>				 
			</table>		 
		</div>
	</div>
</div>