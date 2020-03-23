
<h4 class="tle125">các tin khác</h4>
				<!-- <?php //echo 'Chưa có bài viết';?> -->
	<?php
		foreach ($other_news as $value) {
	?>
		<div class="media-object-default mgin">
			<div class="media">
				<div class="media-left"><a href="<?php echo site_url('home/tintuc'.'/'.$value['url_name'])?>"><img class="media-object" src="<?php echo $value['avatar']?>" width="130" height="90" alt="placeholder image"></a></div>
				    <div class="media-body">
				      <h4 class="media-heading"><a class="tle-tin" href="<?php echo site_url('home/tintuc'.'/'.$value['url_name'])?>"><?php echo $value['name'];?></a>
				      <!-- <div class="media-description"><?php echo _substr($value['description'], 100, $minword = 5);?></div> -->
				</div>
			</div>
		</div><!-- <hr class="line-f"> -->
	<?php
		}
	?>			
				