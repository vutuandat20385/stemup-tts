<table class="manage_new table table-bordered">
    <tr style="background-color: rgba(60, 141, 188, 0.28);">
        <th class="ta-c new_avatar"> Avatar </th>
        <th class="ta-c new_title"> Tiêu đề tin </th>
        <th class="ta-c new_catagory"> Thể loại </th>
        <th class="ta-c new_create_date"> Ngày tạo </th>
        <th class="ta-c new_pos"> Vị trí </th>
        <th class="ta-c news_delete"> Sửa-Xóa </th>
    </tr>
    <?php foreach ($list_news as $n) { ?>
        <tr>
            <td class="ta-c new_avatar"> <img src="<?php echo $n['avatar']; ?>"> </td>
            <td class="new_title"> <?php echo _substr($n['name'], 100); ?> </td>
            <td class="ta-c new_catagory"> <?php echo $n['category_name']; ?> </td>
            <td class="ta-c new_create_date"> <?php echo date("d-m-Y", strtotime($n['modify_date'])); ?> </td>
            <td class="ta-c new_pos"> <input class="form-control" type="text" name="inp-pos" value="<?php echo $n['pos']; ?>" disabled> </td>
            <td class="ta-c news_delete">
                <a href="<?php echo base_url("index.php/admin/edit_news") . '/' . $n['id'] ?>"><i class="fa fa-pencil-square-o" title="Sửa"></i>Sửa</a>
                <a href="<?php echo base_url("index.php/admin/delete_news") . '/' . $n['id'] ?>" onclick="delete_news()" class="delete" id="<?php echo $n['id'] ?>"><i class="fa fa-trash" title="Xóa"></i>Xóa</a>
            </td>
        </tr>
    <?php } ?>

</table>
<div class="col-md-12">
    <center>
        <ul class="pagination">
            <?php foreach ($links as $link) { ?>
                <li class="page-item page-link "><?php echo  $link ?> </li>
            <?php } ?>
        </ul>
    </center>
</div>
