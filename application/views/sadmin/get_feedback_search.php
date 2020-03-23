<?php if($feedback_search['status']==1){?>

	<!-- <?php 
	//echo "<pre>";
	//print_r($feedback_search['result']);
	//echo "</pre>";
	?> -->

	 <table class="table table-hover">
		<thead class="thead-light">
			<tr class="first-row-tbl">
				<td class="header-table header-table-color" align="center">Fbid</td>
				<td class="header-table header-table-color">Uid</td>
				<td class="header-table header-table-color">Nội dung</td>
				<td class="header-table header-table-color">Email</td>
				<td class="header-table header-table-color" align="center">Loại phản hồi</td>
				<td class="header-table header-table-color" align="center">Ngày tạo</td>
				<td class="header-table header-table-color" align="center">Hành động</td>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($feedback_search['result'] as $fb) {
				if ($fb["status"] == 0) {
					$status = '<i class="fa fa-eye-slash"></i>';
				}
				else {
					$status = '<i class="fa fa-check-circle"></i>';
				}
				?>

				<tr>
					<td class="header-table" align="center"><?php echo $fb["fbid"] ?></td>
					<td class="header-table" align="center"><?php echo $fb["uid"] ?></td>
					<td class="header-table"><?php echo $fb["content"] ?></td>

					<td class="header-table" align="center"><?php echo $fb["email"] ?></td>
					<td class="header-table" align="center"><?php echo $fb["type_name"] ?></td>
					<td class="header-table" align="center"><?php echo $fb["create_date"] ?></td>
					<td class="header-table" align="center" onclick="updateFbStatus(<?php echo $fb['fbid']?>,<?php echo $fb['status'] ?>)"><?php echo $status?></td>
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
