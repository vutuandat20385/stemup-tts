 <div class="container">

   
	<h3>Luật thay đổi điểm</h3>


	<div class="row">
	 
		<div class="col-md-12">

					
			<div id="message"></div>
				
			<form method="post" action="<?php echo site_url('rulepoint/insert_rule/');?>">
			
				<table class="table table-bordered">
					<tr>
						 <th><?php echo $this->lang->line('id');?></th>
						 <th><?php echo $this->lang->line('rule_name');?> </th>
						 <th><?php echo $this->lang->line('point_change');?> </th>
						 <?php if($role==1){ ?>
						    <th><?php echo $this->lang->line('action');?>  </th>
                         <?php } ?>
					</tr>
				
					<?php


						foreach($rule_list as $key => $val){
					?>
						<tr>
						    <td> <?php echo $val['rule_id']?></td>
						    <td> <?php echo $val['rule_name']?></td>
						    <td> <?php echo $val['point_change']?></td>
						    <?php if($role=='1'){ ?>
							    <td> 

							    	<a href="<?php echo site_url('rulepoint/edit_rule/'.$val['rule_id']);?>"> <img src="<?php echo base_url('images/edit.png');?>"></a>
	                                <a href="<?php echo site_url('rulepoint/delete_rule/'.$val['rule_id']);?>"><img src="<?php echo base_url('images/cross.png');?>"></a>
							    </td>
						   <?php } ?>
						</tr>
					<?php }
					if($role==1){
					 ?>
				
                  
						<tr>
							<td></td>
						 	<td>
						 
								 <input type="text" class="form-control" name="rule_name" value="" placeholder="<?php echo $this->lang->line('rule_name');?>"  required ></td>
						
							
							<td>
						 
								 <input type="number"   class="form-control" name="point_change" value="" placeholder="<?php echo $this->lang->line('point_change');?>"  required></td>
							<td>
							<button class="btn btn-default" type="submit"><?php echo $this->lang->line('add_new');?></button>
						 
							</td>
						</tr>
					<?php } ?>
				</table>
			</form>
		</div>

	</div>



</div>
