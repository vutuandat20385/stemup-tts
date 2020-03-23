
<?php if($search_result['status']==1){?>

	<?php 
	// echo "<pre>";
	// print_r($search_result['result']);
	// echo "</pre>";
	?>
	
	<table class="table">
		<thead class="thead-dark" style="background: #286090">
			<tr>
				<td class="td_id col-md-1">ID</td>
				<td class="td_content col-md-4">Email</td>
				<td class="td_creater col-md-4">Tên phụ huynh</td>
				<td class="td_createdate col-md-3">Số sao</td>
			</tr>
		</thead>
		<?php
		foreach ($search_result['result'] as $key => $value) {
			?>
			<tr>
				<td  class=""><?php echo $value['uid'];?></td>
				<td  class=""><?php echo $value['email'];?></td>
				<td  class=""><?php echo $value['first_name'];?></td>
				<td  class=""><?php echo $value['point'];?></td>
			</tr>
		

			<?php
		}						
		?>
	</table>
	<?php 
}else{
	echo "Không tìm thấy kết quả";
}  
?>
