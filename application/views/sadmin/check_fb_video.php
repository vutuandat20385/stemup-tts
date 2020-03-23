<?php $this->load->view('sadmin/head')?>
<div class="container">
	<h2 class="col-md-12 title ta-c">NHẬP FRAME FACEBOOK VIDEO CẦN KIỂM TRA</h2>
	<textarea style="width: 100%;height: 200px;" name="frame" id="frame">
			
	</textarea>
	<button class="btn btn-info" name="btn_info" id="btn_info">Kiểm tra</button>
	<div class="col-md-12" id="col1">
		
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#btn_info').click(function(){
			var frame=document.getElementById("frame");
			//console.log(frame.value);
			$.ajax({
                    url : "<?php echo site_url('sadmin/check');?>",
                    type : "post",
                    data : {
                         frame:frame.value
                    },
                    success : function (result){
                        $('#col1').html(result);
                        $('#col2').html(result);

                    }
                });
		});
	});
</script>
