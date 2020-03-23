
<table class="table table-hover tbl-ncov-quiz">
    <thead>
        <tr  class="row">
            <th class="col-md-1 col-id">ID</th>
            <th class="col-md-8 col-question text-center">Câu hỏi</th>
            <th class="col-md-2 col-lang text-center">Ngôn ngữ</th>
            <th class="col-md-1 col-edit text-center">Sửa</th>
        </tr>
    </thead>
    <tbody>
<?php 
    if($question_list){
        foreach($question_list as $k => $value){?>
            <tr class="row">
                <td class="col-md-1 col-id "><?php echo $value['qid'];?></td>
                <td class="col-md-8 col-question "><?php echo $value['question'];?></td>
                <td class="col-md-2 col-lang text-center ">
                    <a href=""> 
                        <img class="flag-icon-lang" src="<?php echo base_url().'images/catagory-icon/vi.png'?>" title="Tiếng việt">
                    </a>
                    <a href="<?php echo base_url().'index.php/sadmin/add_language/'.$value['qid']?>"> 
                        <img class="flag-icon-add" src="<?php echo base_url().'images/catagory-icon/add.png'?>" title="Thêm ngôn ngữ">
                    </a>  
                </td>
                <td class="col-md-1 col-edit ">
                    <a href="<?php echo base_url().'index.php/admin/edit_ncov_question/'.$value['qid']?>"><i class="fa fa-pencil-square-o" aria-hidden="true" title="Sửa"></i></a> 
                </td>
            </tr>
<?php
        }
    }else{?>
    <div class="col-md-12"><span >Chưa có câu hỏi nào</span></div>
<?php        
    }
?>
    </tbody>
</table> 






