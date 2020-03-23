 <div class="container">
	<h3><?php echo $title;?></h3>

    <div class="row">
	  	<div class="col-lg-6">
	    	<form method="post" action="<?php echo site_url('data/dataitem_list/');?>">
				<div class="input-group">
	    			<input type="text" class="form-control" name="search" placeholder="<?php echo $this->lang->line('search');?>...">
				    <span class="input-group-btn">
				        <button class="btn btn-default" type="submit"><?php echo $this->lang->line('search');?></button>
				    </span> 
	    		</div>
		 	</form>
	  	</div>
	</div>
	<div class="row"> 
		<div class="col-md-12">
			<br>
			<?php 
				if($this->session->flashdata('message')){
					echo $this->session->flashdata('message');	
				}
			?>	
			<div id="message"></div>
			<a href="<?php echo site_url('data/add_new_dataitem');?>" class="btn btn-success">Add New</a>			
			<table class="table table-bordered">
				<tr>
				 	<th><?php echo $this->lang->line('datagroup_name');?></th>
				 	<th><?php echo $this->lang->line('dataitem_name');?></th>
				 	<th><?php echo $this->lang->line('dataitem_code');?></th>
				 	<th><?php echo $this->lang->line('dataitem_level');?></th>
					<th><?php echo $this->lang->line('action');?> </th>
				</tr>
				<?php 
					if(count($dataitem_list)==0){
				?>
				<tr>
				 	<td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
				</tr>	
				<?php
					}

					foreach($dataitem_list as $key => $val){
				?>
						<tr>
						 	<td> <?php echo $val['datagroup_name'];?></td>
						 	<td> <?php echo $val['dataitem_name'];?></td>
						 	<td> <?php echo $val['dataitem_code'];?></td>
						 	<td> <?php echo $val['dataitem_level'];?></td>
							<td>
								<a href="<?php echo site_url('data/edit_dataitem/'.$val['did']);?>"><img src="<?php echo base_url('images/edit.png');?>"></a>
								<a href="<?php echo site_url('data/remove_dataitem/'.$val['did']);?>" onclick="return confirm('Are you sure you want to delete this item?')"><img src="<?php echo base_url('images/cross.png');?>"></a>
							</td>
						</tr>

				<?php 
					}
				?>				 
			</table>		 
		</div>
	</div>
	<?php
		if(($limit-($this->config->item('number_of_rows')))>=0){ 
			$back=$limit-($this->config->item('number_of_rows')); 
		}else{ 
			$back='0'; 
		} 
	?>

	<a href="<?php echo site_url('data/dataitem_list/'.$back);?>"  class="btn btn-primary"><?php echo $this->lang->line('back');?></a>&nbsp;&nbsp;
	<?php
 		$next=$limit+($this->config->item('number_of_rows'));  
 	?>

	<a href="<?php echo site_url('data/dataitem_list/'.$next);?>"  class="btn btn-primary"><?php echo $this->lang->line('next');?></a>
</div>