

<style>	
	@media screen and (max-width: 767px) {
		#time {
	    	margin-left: 29%;
		}
		#name_quiz{
			font-size: 15px;
			margin-left: 28%;
		}
	}
</style>

  <aside class="col-md-10" style="margin-bottom:130px">

	 <div role="tabpanel" style="margin-bottom:100px">
		<input type="text" value ="<?php echo $notify[count($notify)-1]['id'] ?>" id="nbid" style="display:none" >
		<input type="text" id="lnid" value="20" style="display:none" >

		<div  style="min-height:720px">

		  <?php 
		if (sizeof($notify)!=0){
			foreach( $notify as $dt ){
			?>
			<?php if($dt['status']==1){ ?>
			<div class="col-md-12 box-bor ef" style="border-bottom-style: solid;border-bottom-width: 1px"  onMouseOver="this.style.backgroundColor='#85E2E7'" onMouseOut="this.style.backgroundColor='#FFFFFF'"
			<?php if($su != 2 && $dt['action'] == 'Assign quiz' ){
				?> <?php
			}else{
				?>
				onclick="<?php //echo $dt['click'] ?>"
				 <?php
			} ?>	
			>
			<?php }?> 	
			<?php if($dt['status']==0){ ?>
			<div id="testnotify_<?php echo $dt['id']?>" class="col-md-12 box-bor ef" style="border-bottom-style: solid;border-bottom-width: 1px;background:#d7d6d6;" onclick="see_notify(<?php echo $dt['id']?>)">
			<?php }?>	
				
				<div id="avatar" class="col-md-1 col-xs-3 avartar_notify" >
					<img class="img-responsive img-circle" style="margin-top: 5px;width: 50px;height: 50px;border-radius: 50%;border: 2px solid #286090;" src="<?php echo $dt['photo'] ?>">
				</div>
				<div id="content" class = "col-md-8 content_notify">
					<div id="notify">
					<p style="padding-top: 4px"><b><?php echo $dt['username'] ?></b> <?php echo $dt['content'] ?> </p>
					</div>
					
					<div id="name_quiz">
				   	<p><?php echo "Tên bài:".$dt['quiz_name']?></p>
				   	
					</div>
					<div id="time">
				   	<p style=""><?php echo $dt['createdate']; ?></p>         
					</div>
				</div>
			</div>
			<?php
			}
		}else{
			?>
				<h3><b>Bạn không có thông báo nào!!</b></h3> 
			<?php
		} ?>
		</div>
		
		<div id="show_more_notify" class="col-md-9" class style="display:none" >
		</div>
	</div>
  </aside>
   