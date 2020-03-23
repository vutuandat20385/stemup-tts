<?php 
if($quiz_list==''){
	echo '<div class="text-noidung">Nội dung đang cập nhật</div>';
}else{
		  $col_num = 4;
		  
		  foreach($quiz_list as $value){
?>
			<div class="col-md-3 col-sm-6 col-xs-12 quiz-item">
        		<div class="item-cover col-md-12 col-sm-12 col-xs-12">
        			<div class="quiz-item-img col-md-12"><a><img src="<?php echo $value['img_video']?>"></a></div>
        			<div class="quiz-item-title col-md-12"><a><?php echo _substr($value['quiz_name'], 40,3)?></a></div>
        			<div class="quiz-item-level-hard text-center col-md-12"><i class="fas fa-star icon-left"></i><?php echo 'Kỹ năng sống' ?></div>
                     <div class="col-text-lambai col-md-12 col-sm-12 col-xs-12">

                        <button type="button" class="btn-lambai" onclick="popup_require_login1(<?php echo $value['quid'];?>)">Làm bài</button>
                    </div>
        		</div>			
    		</div>
		<?php          
		    
		  }
		  
		  
		?>
		<div class="pagnation_link col-md-12">
			<?php echo $pagnation_link;?>
		</div> 
<?php
	}
?> 
<?php
    function _substr($str, $length, $minword = 3){
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