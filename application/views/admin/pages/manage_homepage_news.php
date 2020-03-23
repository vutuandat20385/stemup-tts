<div id="ds_homepage_news" class="">
    <table class="manage_new table table-hover" style="background-color: rgba(60, 141, 188, 0.28);">
        <tr>
            <th class="ta-c new_avatar">Avatar </th>
            <th class="ta-c new_title">Tiêu đề tin</th>
            <th class="ta-c new_catagory">Thể loại</th>												 
            <th class="ta-c new_create_date">Ngày tạo</th>
            <th class="ta-c new_pos">Vị trí</th>
            <th class="ta-c "></th>
        </tr>
        <?php 
            foreach ($ds_homepage_news as $key => $value) {
        ?>
            <tr>
                <form method="POST" action="<?php echo site_url('admin/update_pos');?>">
                    <td class="hidden"><input type="text" name="id" id="id" value="<?php echo $value['id'];?>"></td>
                    <td class="ta-c new_avatar"><img src="<?php echo $value['avatar'];?>"></td>
                    <td class="new_title "><?php echo $value['name'];?></td>
                    <td class="ta-c new_catagory"><?php echo $value['category_name'];?></td> 
                    <td class="ta-c new_create_date"><?php echo date("d-m-Y", strtotime($value['modify_date']));?></td>
                    <td class="ta-c new_pos"><input type="text" class="form-control" id="<?php echo $value['id'];?>" name="pos" value="<?php echo $value['pos'];?>"></td>
                    <td class="ta-c luu"><input type="submit" class="form-control btn-success" name="btn-submit" id="btn-luu" value="Lưu"></td>
                </form>
            </tr>
        <?php		
            }
        ?>
    </table>
</div>