<?php
/**
 * Created by PhpStorm.
 * User: MrK
 * Date: 2/26/2019
 * Time: 10:39 AM
 */
?>
<div class="post-discussion row" id="discussion-temp">
      <div class="p-head col-md-12">
             <div class="avatar col-md-1">
                    <img src="<?php
                           if ($link_photo == null) {
                                 echo base_url(photo) . '/avatar-default-icon.png';
                            } else
                                 echo $link_photo;
                               ?>
                     ">

             </div>
             <div class="user-info col-md-8">
                     <a href="#"><?php echo $user_name; ?></a> đã đăng một thảo luận<br>Lúc <?php echo date_format(date_create($value['time']), 'H:i:s  d-m-Y'); ?>
            </div>
            <div class="star col-md-3">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>

          </div>
        </div>
    <div class="post-discussion-content col-md-12" id="discussion-?>">
        <?php echo $value; ?>
    </div>
</div>