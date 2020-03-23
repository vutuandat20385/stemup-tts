 
<script>  
    var quid_global;  
    var base_url="<?php echo base_url();?>";
    var site_url="<?php echo site_url();?>";
    var su="<?php echo $su ?>";
    var id_mcq_fun="<?php echo $id_mcq_fun ?>";
    var id_quiz_fun="<?php echo $id_quiz_fun ?>";
	
    </script>
	
<style>
	#qbank_answer tr td {
		border: none;
	}
	.title_cover {
    background: #c7ceca;
    padding: 12px 20px;
    border-radius: 50px;
	}
	
	
</style>
<div class="container" style="min-height:550px">
	
	<div class="col-md-10 col-sm-10 col-xs-10" >
		<div class="qb_video_title col-md-12" style="font-size: large;text-align: center;margin-top:20px">			 		 		  
			<?php  foreach($qid_kns as $value){ ?>
				<div class="qid-item-img col-md-12"><?php 
						$start = strpos($value['question'],'https');
						$end = strpos($value['question'],'" frameborder');							
						$chuoicon = substr($value['question'], $start, $end-$start);
						echo '<iframe width="70%" height="315" src="'.$chuoicon.'" style="margin:auto"></iframe>';
				?></div>
			    <div class="title-item col-md-12 ">
				   <?php 
				        $start1 = strpos($value['question'],'<br>');
						$end1 = strlen($value['question']);
						$chuoicon1 = substr($value['question'],$start1,$end1-$start1);
						echo '<h3>'.$chuoicon1.'</h3>';
					?>
				</div>

			<?php } ?>
			
		</div>
		<div class="qb_answer col-md-12">
			<table id="qbank_answer" class="table">
                <tr>
                    <td><?php echo $qid_kns['question'];?></td>
                </tr>
				<tr>     

					<td><?php echo '<div class="title_cover" value="'.$a['score'].'">'.$a['option'].'</div>' ?></td>
					<td><?php echo '<div class="title_cover" value="'.$b['score'].'">'.$b['option'].'</div>' ?></td>
				</tr>
				<tr>
      				<td><?php echo '<div class="title_cover" value="'.$c['score'].'">'.$c['option'].'</div>' ?></td>
					<td><?php echo '<div class="title_cover" value="'.$d['score'].'">'.$d['option'].'</div>' ?></td>
				</tr>
			</table>	
		</div>
	</div>
	
</div>
<div class="modal" id="popup_require_login" role="dialog" onclick="dismiss_modal(this)" >
            <div class="modal-dialog">   
                 <div class="modal-content">
                    <div class="box-popup">
                        <div class="bg-xanhnhat">
                            <div class="icon">
                                <img src="https://do.stem.vn/images/thongbao.png" alt="">
                            </div>
                        </div>
                        <div class="box-chon">
                            <h4 class="text-center mb-20 mt-0">Vui lòng <button class="btn btn-info smlg" onclick="popup_login1(<?php echo $value['quid'];?>)">Đăng nhập</button> hoặc <button class="btn btn-success smsn" onclick="popup_signup1(<?php echo $value['quid'];?>)">Đăng ký</button> để thực hiện thao tác này!</h4>
                        </div>

                    </div>

                    
                 </div>
                  
            </div>
        </div>




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
<script type="text/javascript">
    function popup_require_login1_kns(quid){
    var uid="<?php echo $uid; ?>";
    quid_global=quid;
    if(uid==''){
      $("#popup_require_login").modal();
      $(".smlg").attr("onclick","popup_login1("+quid+")");
      $(".smsn").attr("onclick","popup_signup1("+quid+")");
    }else{
      window.location.href = "<?php echo site_url('quiz/validate_quiz/')?>"+"/"+quid;


    }
      

    }
	$(document).ready(function(){
		$('.title_cover[value="1"]').attr('style','background:green');
	});
</script>
