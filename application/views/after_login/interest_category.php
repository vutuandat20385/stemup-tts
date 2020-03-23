<div id="interest_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content modal-content1">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
	  </div>
	  <div class="modal-body">
		<p class="text-cm text-cm-ic"><em>Chọn lĩnh vực bạn quan tâm</em></p>
		 <form method="post" action="<?php echo site_url("profile/save_interest_category1")?>">
			<div id="catearea">
				<div class="col-md-12">
				 <?php foreach($categories as $k=>$cat){ ?>
								 
						<div class="col-md-4 col-xs-6">
							<input class="cb_ict" value="<?php echo $cat['cid'] ?>" name="categ[]" type="checkbox" > <?php echo $cat['category_name']?></input>
						</div>
				<?php }?>
				</div>
			</div>
			<center>
				<button type="submit" class="btn btn-success" style="margin-top:30px">Lưu lại</button>
			</center>
		</form> 
	  </div>
	</div>

  </div>
</div>