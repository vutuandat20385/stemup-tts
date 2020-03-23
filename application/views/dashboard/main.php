 <div class="container">

   


<div class="row">

	<div class="col-md-3">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-users fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo $num_student;?></div>
						<div>Số lượng học sinh </div>
					</div>
				</div>
			</div>
			<a href="<?php echo site_url('user/student');?>">
				<div class="panel-footer">
					<span class="pull-left">Danh sách học sinh</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-success">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-users fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo $num_teacher;?></div>
						<div>Số lượng giáo viên </div>
					</div>
				</div>
			</div>
			<a href="<?php echo site_url('user/teacher');?>">
				<div class="panel-footer">
					<span class="pull-left">Danh sách giáo viên</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>


	<div class="col-md-3">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-book fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo $num_quiz;?></div>
						<div>Số lượng bài kiểm tra</div>
					</div>
				</div>
			</div>
			<a href="<?php echo site_url('quiz');?>">
				<div class="panel-footer">
					<span class="pull-left">Danh sách bài trắc nghiệm</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

	<div class="col-md-3">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-question fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo $num_qbank;?></div>
						<div>Số lượng câu hỏi</div>
					</div>
				</div>
			</div>
			<a href="<?php echo site_url('qbank');?>">
				<div class="panel-footer">Danh sách câu hỏi</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
	 </div>

  </div>
 

</div>
<div class="row">
 <!-- Top --->
   <div>
   
   </div>
  <!-- statistic graph-->
  <!--
 <div class=="col-md-12">
 

    <?php
     
    $dataPoints = array(
    	array("y" => 25, "label" => "Sunday"),
    	array("y" => 15, "label" => "Monday"),
    	array("y" => 25, "label" => "Tuesday"),
    	array("y" => 5, "label" => "Wednesday"),
    	array("y" => 10, "label" => "Thursday"),
    	array("y" => 0, "label" => "Friday"),
    	array("y" => 20, "label" => "Saturday")
    );
     
    ?>
    <!DOCTYPE HTML>
    <html>
    <head>
    <script>
    window.onload = function () {
     
    var chart = new CanvasJS.Chart("chartContainer", {
    	title: {
    		text: "Push-ups Over a Week"
    	},
    	axisY: {
    		title: "Number of Push-ups"
    	},
    	data: [{
    		type: "line",
    		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    	}]
    });
    chart.render();
     
    }
    </script>
    </head>
    <body>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </body>
    </html>                              


 </div>

</div>
-->