
<div class="arrowlistmenu">
<?php
    foreach($level_list as $value){
?>
    <h3 class="menuheader expandable" id="h3_<?php echo $value['lid']?>" onclick="show_quiz_list(<?php echo $value['lid']?>)">☆  <?php echo $value['level_name']?></h3>
    <ul class="categoryitems">
    	<!-- <li><a href="#" onclick="show_quiz_list(<?php echo $value['lid']?>)">Kỹ năng sống</a></li> -->
    </ul>
<?php 
    }
?>


</div>
<script type="text/javascript">
	function show_quiz_list(lid){

		$.ajax({
			url : "<?php echo site_url();?>/kynangsong/show_quiz_list/",
                    type : "post",
                    dataType:"text",
                    data : {
                        lid:lid
                    },
                    success : function (result){
                        $('#quiz-list').html(result);
                        console.log(result);

                    }
		});
	}
</script>