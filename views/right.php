<div class="box-bor MB20 pad-0">
    <h3 class="text-xanh1 pad-15"><a href="<?php echo site_url('/event_racing')?>">Bảng xếp hạng <small>(<?php echo $today;?>)</small></a></h3>
    <table class="table table-hover table-striped">
        <thead>
        <tr class="bg-eee">
            <th class="text-center">#</th>
            <th>Tên</th>
            <th class="text-right">Điểm Đố</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($todaay_points as $i=>$dp){?>
            <tr>
                <td class="text-center <?php if($i<3){ ?> bg-primary <?php } ?>"><?php  echo $i+1 ?></td>
                <td><?php echo $dp['last_name']." ".$dp['first_name'] ?></a></td>
                <td class="text-right"><?php echo $dp['points']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <p class="text-center"><a href="<?php echo site_url('/event_racing')?>">Xem thêm</a></p>
    <!--  <p class="text-center"><a href="<?php echo site_url('/event_racing')?>">Câu hỏi cùng chủ đề</a></p> -->
</div>
<div style="margin-bottom:20px">
    <div class="fb-page"
         data-href="https://www.facebook.com/stemupapp"
         data-width="380"
         data-hide-cover="false"
         data-show-facepile="true">
    </div>
</div>
<?php
$this->load->model("quiz_model");
$quiz_fun_rb=$this->quiz_model->get_quiz_right_bar(7);
?>
<div class="box-bor MB20">
    <h3 class="text-xanh1"><a href="<?php echo site_url('home_user/quiz_list'); ?>">BÀI TRẮC NGHIỆM </a></h3>
    <?php foreach($quiz_fun_rb as $qz){?>
        <div style="margin-bottom:25px" class="bo-B">
            <div style="margin-bottom:10px"><a href="<?php echo site_url('quiz/validate_quiz/'.$qz['quid']);?>"> <img src="<?php echo $qz['img'];?> " width="100%"></a><br/>
            </div>
            <a style="font-size:15px;" href="<?php echo site_url('quiz/validate_quiz/'.$qz['quid']);?>"><b><?php echo $qz['quiz_name'];?></a></b>
        </div>
    <?php }?>
    <!--<div id="activities"></div>
		  
		  <div class="media-object-default">
			   <div class="media">
			     <div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
			     <div class="media-body">
			       <h4 class="media-heading"><a href="">Thạch Long</a></h4>
			       <span class="text-small">21 giờ trước</span>
		         </div>
	        </div>
	      </div>
		  
			<hr>
			<div class="media-object-default">
			   <div class="media">
			     <div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
			     <div class="media-body">
			       <h4 class="media-heading"><a href="">Thạch Long</a></h4>
			       <span class="text-small">Connected to</span>
			       <div class="media">
			         <div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
			         <div class="media-body">
			           <h4 class="media-heading text-use"><a href="">Cường nguyễn</a></h4>
					 </div>
					   <span class="text-small1">25-04-2018</span>
		           </div>
		         </div>
	        </div>
	      </div>
			<hr>
			<div class="media-object-default">
			   <div class="media">
			     <div class="media-left"><a href="#"><img class="media-object" src="<?php echo base_url('images/hu_MediaObj_Placeholder.png');?>" alt="placeholder image"></a></div>
			     <div class="media-body">
			       <h4 class="media-heading"><a href="">Thạch Long</a></h4>
			       <span class="text-small">21 giờ trước</span>
		         </div>
	        </div>
	      </div>
			<hr>
			-->
</div>