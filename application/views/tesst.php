
	<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?> "></script>
<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
 <script src="<?php echo base_url('js/bootstrap.js');?>"></script> 
 <link href="<?php echo base_url('css/select2.min.css');?>" rel="stylesheet" />
<script src="<?php echo base_url('js/select2.min.js');?>"></script>

	
<div style="margin:20px">
	<table  class="table table-bordered">
		<tr style="border-bottom: 2px solid black;">
			<th></th>
			<th>Tiết</th>
			<th>Thứ 2</th>
			<th>Thứ 3</th>
			<th>Thứ 4</th>
			<th>Thứ 5</th>
			<th>Thứ 6</th>
			<th>Thứ 7</th>
			<!--<th>Chủ nhật</th>-->
		</tr>
		<tr>
			<td rowspan="5" style="vertical-align: middle;text-align:center">Sáng</td>
			<td>1</td>
			<td>
				<select id="a1">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a2">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a3">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a4">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a5">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a6">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<!--<td>Chủ nhật</td>-->
		</tr> 
		<tr>
			
			<td>2</td>
			<td>
				<select id="a7">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a8">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a9">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a10">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a11">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a12">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<!--<td>Chủ nhật</td>-->
		</tr>
		<tr>
			<td>3</td>
			<td>
				<select id="a13">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a14">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a15">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a16">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a17">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a18">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<!--<td>Chủ nhật</td>-->
		</tr> 
		<tr>
			
			<td>4</td>
			<td>
				<select id="a19">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a20">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a21">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a22">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a23">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a24">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<!--<td>Chủ nhật</td>-->
		</tr>
		<tr style="border-bottom: 2px solid black;">
			
			<td>5</td>
			<td>
				<select id="a25">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a26">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a27">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a28">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a29">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a30">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<!--<td>Chủ nhật</td>-->
		</tr> 
		<tr>
			<td rowspan="5" style="vertical-align: middle;text-align:center">Chiều</td>
			<td>1</td>
			<td>
				<select id="a31">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a32">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a33">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a34">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a35">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a36">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<!--<td>Chủ nhật</td>-->
		</tr> 
		<tr>
			
			<td>2</td>
	<td>
				<select id="a37">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a38">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a39">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a40">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a41">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a42">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<!--<td>Chủ nhật</td>-->
		</tr>
		<tr>
			
			<td>3</td>
			<td>
				<select id="a43">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a44">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a45">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a46">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a47">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a48">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<!--<td>Chủ nhật</td>-->
		</tr> 
		<tr>
			
			<td>4</td>
			<td>
				<select id="a49">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a50">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a51">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a52">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a53">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a54">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<!--<td>Chủ nhật</td>-->
		</tr>
		<tr >
			
			<td>5</td>
			<td>
				<select id="a55">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a56">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a57">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a58">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a59">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<td>
				<select id="a60">
					 <option value="0"> </option>
					 <?php  foreach($categs as $c) {?>
						  <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
					 <?php } ?>
				</select>
			</td>
			<!--<td>Chủ nhật</td>-->
		</tr>
	</table>
</div>    

<button onclick="getid_ctt()">Save</button>

<div id="rs"></div>

<script>
function getid_ctt(){
	html="";	
	t2="";t3="";t4="";t5="";t6="";t7="";
	for(i=1;i<=60; i++){
		j= i%6;
		console.log(t3);
		switch(j){
			case 1: t2+=$("#a"+i).val()+",";break;
			case 2: t3+=$("#a"+i).val()+",";break;
			case 3: t4+=$("#a"+i).val()+",";break;
			case 4: t5+=$("#a"+i).val()+",";break;
			case 5: t6+=$("#a"+i).val()+",";break;
			case 0: t7+=$("#a"+i).val()+",";break;
		}
		//html+=i+" "+$("#a"+i).val()+"  \ ";
		
	}
	
	html+=t2+"<br/>";
	html+=t3+"<br/>";
	html+=t4+"<br/>";
	html+=t5+"<br/>";
	html+=t6+"<br/>";
	html+=t7+"<br/>";
	$("#rs").empty();
	$("#rs").append(html);
}
</script>