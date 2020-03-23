	<section class="container-fluid" id= "section_vhh">
		<div class="row mb-50">
			<div class="col-md-5 col-md-offset-1">
				<img class="img-responsive" src="<?php echo array_values($vui_post)[0]['image'];?>" alt="">
			</div>
			<div class="col-md-4">
				<div class="box-tle">
					  <h2 class="tle1 pull-left tle1-vang">Vui</h2>
					  <div class="arrow-right pull-left arrow-right-vang"></div>
				 </div>

				<h3><a href="<?php echo array_values($vui_post)[0]['link'];?>" target="_blank"><?php echo array_values($vui_post)[0]['title'];?></a></h3>
				<p><?php echo array_values($vui_post)[0]['subtitle'];?></p>
				<a class="bt-chitiet" href="<?php echo array_values($vui_post)[0]['link'];?>" target="_blank">Chi tiết<i class="fas fa-angle-right ML5"></i></a>
			</div>
		</div>
		<div class="row mb-50">
			<div class="col-md-4 col-md-offset-1">
				<div class="box-tle">
					  <h2 class="tle1 pull-left tle1-xanh">Học</h2>
					  <div class="arrow-right pull-left arrow-right-xanh"></div>
				 </div>

				<h3><a href="https://<?php echo array_values($hoc_post)[0]['link'];?>" target="_blank"><?php echo array_values($hoc_post)[0]['title'];?></a></h3>
				<p><?php echo array_values($hoc_post)[0]['subtitle'];?></p>
				<a class="bt-chitiet" href="https://<?php echo array_values($hoc_post)[0]['link'];?>" target="_blank">Chi tiết<i class="fas fa-angle-right ML5"></i></a>
			</div>
			<div class="col-md-5">
				<img class="img-responsive" src="<?php echo base_url('images/ap2.jpg');?>" alt="">
			</div>
		</div>
		<div class="row mb-50">
			<div class="col-md-5 col-md-offset-1">
				<img class="img-responsive" src="<?php echo base_url('images/anhho1.png');?>" alt="">
			</div>
			<div class="col-md-4">
				<div class="box-tle">
					  <h2 class="tle1 pull-left tle1-la">Hỏi</h2>
					  <div class="arrow-right pull-left arrow-right-la"></div>
				 </div>

				<h4><a href="https://<?php echo array_values($hoi_post)[0]['link'];?>" target="_blank"><?php echo array_values($hoi_post)[0]['title'];?></a></h4>
				<!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis fugiat qui est iste deleniti dicta ducimus, possimus asperiores vero aperiam. Minima officia, necessitatibus pariatur itaque quaerat laborum iste quidem debitis.</p>-->
				<a class="bt-chitiet" href="https://<?php echo array_values($hoi_post)[0]['link'];?>" target="_blank">Chi tiết<i class="fas fa-angle-right ML5"></i></a>
			</div>
		</div>

	</section>