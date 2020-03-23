<?php
  $this->load->view('sadmin/head');
?>

<style type="text/css">
.ta-c.new_avatar img {
    width: 120px;
    height: 60px;
    object-fit: cover;
}
.fw100{
	font-weight: 100;
}
.ta-c.new_pos input {
    width: 60px;
    text-align: center;
}
.ta-c.new_pos {
    width: 8%;
}
.ta-c.new_avatar {
    width: 13%;
}
.ta-c.new_title {
    width: 15%;
}
.ta-c.new_catagory {
    width: 9%;
}
.ta-c.new_create_date {
    width: 9%;
}
.pl-15{
	padding-left: 15px;
}
.title1 {
    text-align: right;
    padding: 10px 20px;
    margin-bottom: 0;
}
a#txtupdate {
    background: #fbf300;
    padding: 5px 15px;
    -webkit-box-shadow: 5px 5px 25px -5px rgba(237,23,52,1);
    -moz-box-shadow: 5px 5px 25px -5px rgba(237,23,52,1);
    box-shadow: 5px 5px 25px -5px rgba(237,23,52,1);
    border: 1px solid #f30606;
    font-size: 16px;
    font-weight: 600;
    color: #367fa9;
}
</style>
<script src="<?php echo base_url('js/manage_news.js');?> "></script>

<?php

// echo '<pre>';
// print_r($ds_homepage_news);
// echo '</pre>';
?>
<div class="wrapper">
	<?php $this->load->view('sadmin/header'); ?>
	<aside class="main-sidebar">
        <?php $this->load->view('sadmin/leftmenu'); ?>
    </aside>

    <div class="content-wrapper pl-15" >
    	
    		<div class="">
			<p class="title col-md-5">DANH SÁCH TIN TRANG CHỦ</p>
			<div class="col-md-5" id="result_info"></div>
			<div class="title1 col-md-2"><!-- <a href="" id="txtupdate">Cập nhật</a> --></div>
		</div>
		<div id="ds_homepage_news" class="tab-content">
			<table class="table table-hover" style="background-color: rgba(60, 141, 188, 0.28);">
			  <thead>
			    <tr>
			      	<th class="ta-c new_avatar">Avatar </th>
					<th class="ta-c new_title">Tiêu đề tin</th>
					<th class="ta-c new_desc">Mô tả</th>
					<th class="ta-c new_catagory">Thể loại</th>												 
					<th class="ta-c new_create_date">Ngày tạo</th>
					<th class="ta-c new_pos">Vị trí</th>
					<th class="ta-c "></th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php 
			  		foreach ($ds_homepage_news as $key => $value) {
			  	?>
			  		<tr>
				  		<form method="POST" action="<?php echo site_url('sadmin/update_pos');?>">
				  			<td class="hidden"><input type="text" name="id" id="id" value="<?php echo $value['id'];?>"></td>
					      	<td class="ta-c new_avatar"><img src="<?php echo $value['avatar'];?>"></td>
							<td class="new_title fw100"><?php echo $value['name'];?></td>
							<td class="new_desc fw100"><?php echo $value['description'];?></td>
							<td class="ta-c new_catagory fw100"><?php echo $value['category_name'];?></td> 
							<td class="ta-c new_create_date fw100"><?php echo date("d-m-Y", strtotime($value['modify_date']));?></td>
							<td class="ta-c new_pos"><input type="text" class="inp_pos" id="<?php echo $value['id'];?>" name="pos" value="<?php echo $value['pos'];?>"></td>
							<td class="ta-c luu fw100"><input type="submit" name="btn-submit" id="btn-luu" value="Lưu"></td>
						</form>
				    </tr>
			  	<?php		
			  		}
			  	?>
			  </tbody>
			</table>
		</div>
    	</form>
    	

		<div id="id_test"></div>
    </div>

    <?php $this->load->view('sadmin/footer');?>
</div>
<?php
  $this->load->view('sadmin/foot');
?>
<?php
    function _substr($str, $length, $minword = 7){
    $sub = '';
    $len = 0;
    foreach (explode(' ', $str) as $word)
    {
        $part = (($sub != '') ? ' ' : '') . $word;
        $sub .= $part;
        $len += strlen($part);
        if (strlen($word) > $minword && strlen($sub) >= $length)
        {
          break;
        }
     }
        return $sub . (($len < strlen($str)) ? '...' : '');
    }
?>

<!-- <script type="text/javascript">
	$(document).ready(function(){
		$('#txtupdate').click(function(){
			console.log(1);

			var list=document.getElementsByClassName('inp_pos');
			var Item = {
				    id : "",
				    pos : ""
				};
	        var data=[];
	        for (var i = 0; i < list.length; i++) {
	            Item[i].id = list[i].name;
	            // Item.pos = list[i].val;
	            data[i]=Item;
	        }
	        
	        alert(data);
	        // $.ajax({
	        //         url: "<?php echo site_url('sadmin/update_pos');?>",
	        //         type: 'POST',
	        //         data: data,
	        //         success:function(result){
	        //         	console.log(2);
	        //             alert('Cập nhật thành công');
	        //             $('#id_test').html('Thành công');
	        //         }
	        //     });
		});
	});
</script> -->