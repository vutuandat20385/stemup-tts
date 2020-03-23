<section id="table-contents" class="">

    <table class="table">
        <thead class="thead-light">
            <tr>
                <td scope="col" align="center"><b>#</b></td>
                <td scope="col"><b>Email</b></td>
                <td scope="col"><b>Tên người dùng</b></td>
                <td scope="col" align="center"><b>Số sao</b></td>
                <td scope="col" align="center"><b>Thao tác</b></td>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($get_parent_limit as $key => $value) {
            ?>
            <tr>
                <td align="center"><?php echo $value['uid'] ?></td>
                <td><?php echo $value['email'] ?></td>
                <td><?php echo $value['first_name'] ?></td>
                <td align="center"><?php echo $value['point'] ?></td>
                <td align="center" onclick="deleteUser(<?php echo $value['uid'] ?>)">
                    <i class="fa fa-user-edit"></i>
                    <i class="fa fa-user-times"></i>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <ul class="pagination" style="margin-left: 34%;margin-top: -1%;">
        <?php echo $links ?>
    </ul>
</section>