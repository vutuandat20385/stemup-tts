
<div class="arrowlistmenu">
<?php
    foreach($level_list as $value){
?>
    <h3 class="menuheader expandable" id="h3_<?php echo $value['lid']?>" onclick="show_quiz_list(<?php echo $value['lid']?>)">☆  <?php echo $value['level_name']?></h3>

<?php 
    }
?>


</div>
 
<script type="text/javascript">
	
</script>