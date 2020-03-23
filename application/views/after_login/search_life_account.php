
<table class="table">
	<thead class="thead-dark" style="background: #76bd7f">
		<tr>
			<td class="td_id col-md-1" align="center"><b>ID</b></td>
			<td class="td_content col-md-5"><b>Email</b></td>
			<td class="td_creater col-md-4"><b>Tên phụ huynh</b></td>
			<td class="td_createdate col-md-2" align="center"><b>Số sao</b></td>
		</tr>
	</thead>
	<?php
	foreach ($search_result['result'] as $value){
		?>
		<tr>
			<td class="td_id col-md-1" align="center"><?php echo $value['uid'];?></td>
			<td  class="td_content col-md-4"><?php echo $value['email'];?></td>
			<td  class="td_creater col-md-4"><?php echo $value['name'];?></td>
			<td  class="td_createdate col-md-3" align="center"><?php echo $value['point'];?></td>
		</tr>
		<?php
	}
	?>
</table>

