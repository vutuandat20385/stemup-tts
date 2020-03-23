<table class="table table-bordered">
	<th>
        <td>1</td>	
	    <td>2</td>
	    <td>3</td>
	    <td>4</td>
		<td>5</td> 
	<th>

<?php foreach($reading as $r){?>
	<tr>
        <td><?php echo $r['rdid']?></td>	
	    <td><?php echo $r['link']?></td>
	    <td><?php echo $r['content']?></td>
	    <td><?php echo $r['title']?></td>
		<td><img src="<?php echo $r['img']?>" class="img-responsive"></td> 
		
	</tr>
<?php }?>

<script>
$(document).ready(function(){
	
	$("img").attr("class", "img-responsive");
	
});
</script>
</table>