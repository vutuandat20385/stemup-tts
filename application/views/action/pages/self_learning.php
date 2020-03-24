<div class="col-md-10 col-learning-right">
			<div class="trac-nghiem mb-20 col-md-12 col-sm-12 col-xs-12">
				<h2 class="title">TRẮC NGHIỆM </h2>

				<?php
				foreach ($list_category as $key => $value) {
					$cid=$value['cid'];
				?>
					<div class="col-md-2 col-sm-4 col-xs-4 category-box">
						<a href="<?php echo site_url('self_learning/category/').'/'.$cid;?>">
							<div class="cover">
								<img class="category-avatar " src="<?php echo base_url('upload/symbol/').'/'.$cid.'.png';?>" />
								<hr>
								<span class="col-md-9 col-xs-9 col-xs-9 category-name "><?php echo $value['tenmon']; ?></span>
								<span class="col-md-3 col-sm-3 col-xs-3 category-soluong"><?php echo $value['soluong']; ?></span>
							</div>
						</a>
					</div>
				<?php
				}
				?>
			</div>
			
		</div>