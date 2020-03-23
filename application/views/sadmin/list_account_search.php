<?php if($list_account['status']==1){?>

	<?php 
	// echo "<pre>";
	// print_r($search_result['result']);
	// echo "</pre>";
	?>
	
	<table class="table">
		<thead class="thead-light">
			<tr>
				<td scope="col" align="center"><b>#</b></td>
				<td scope="col"><b>Email</b></td>
				<td scope="col"><b>Tên người dùng</b></td>
				<td scope="col" align="center"><b>Số sao</b></td>
				<td scope="col" align="center"><b>Thao tác</b></td>
			</tr>
		</thead>
		<tbody>
			<?php 
			foreach ($list_account['user'] as $key => $value) {
				?>
				<tr>
					<td align="center"><?php echo $value['uid'] ?></td>
					<td><?php echo $value['email'] ?></td>
					<td><?php echo $value['first_name'] ?></td>
					<td align="center"><?php echo $value['point'] ?></td>
					<td align="center" onclick="deleteUser(<?php echo $value['uid'] ?>)">
						<i class="fa fa-user-edit"></i>
						<i class="fa fa-user-times"></i>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
	<?php 
}else{
	echo "Không tìm thấy kết quả";
}  
?>
