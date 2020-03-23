<?php 

    // $i=array(3,4);
    $i=array(3,4,5,6,7,8,9,10,11,12,13,14);
    // $j=array(3,4);
    $j=array(3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22);
?>
<style>
    .thongke-item{
        border: 1px solid #111;
        font-weight: 600;
        width: 70px;
        padding: 2px 5px;
    }
    .lop-title{
        background: #248aaf;
        padding: 5px 10px;
        border-radius: 3px;
        color: #fff;
    }
</style>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    $( function() {
        $('#start_date').datepicker({
            dateFormat: 'dd-mm-yy'
        });

        $('#end_date').datepicker({
            dateFormat: 'dd-mm-yy'
        });
    } );
  </script>

<div class="container" >
    <form action="<?php echo base_url('index.php/admin/thongke');?>" method="POST">
        <div class="col-md-5">
                <input type="text" class="form-control" id="start_date"  name="start_date" value="
                <?php if(isset($t1)){
                    echo $t1;
                }else{
                    echo date('d-m-Y', strtotime(date('d-m-Y'). ' - 30 days'));
                }?>
                ">
        </div>

        <div class="col-md-5">
            <input type="text" class="form-control" id="end_date"  name="end_date" value="
            <?php if(isset($t2)){
                    echo $t2;
                }else{
                    echo date('d-m-Y');
                }?>
                ">
        </div>

        <div class="col-md-2">
            <button type="submit" class="form-control btn btn-primary" id="btn_thongke" name="btn_thongke" >Thống kê</button>
        </div>
    </form>
<br><br>

<br>
    <?php foreach($i as $ii => $ll){?>
    <div class="col-md-12">
    <h2 class="lop-title"><?php $lev = $this->admin_model->get_level_name($ll); echo $lev['level_name'] ?></h2>
        <table class="table table-hover" style="margin-bottom: 10px;">
            <tr>
                <td class="thongke-item col-md-1">Lớp </td>
                <td class="thongke-item col-md-4">Môn học</td>
                <td class="thongke-item col-md-2 text-center">Tổng số câu</td>
                <td class="thongke-item col-md-2 text-center">Số lượt làm</td>
                <td class="thongke-item col-md-3 text-center">export</td>
            </tr>
            <?php foreach($j as $jj => $cc){?>
            <tr>
                <td class="thongke-item col-md-1"><?php echo $lev['level_name'] ?></td>
                <td class="thongke-item col-md-4"><?php $cat = $this->admin_model->get_category_name($cc); echo $cat['abbr'] ?></td>
                <td class="thongke-item col-md-2 text-center"><?php $total = $this->admin_model->count_total_lid_cid($ll,$cc); echo $total ?></td>
                <td class="thongke-item col-md-2 text-center"><?php echo $arr2[$ll][$cc]?></td>
                <td class="thongke-item col-md-3 text-center">
                
                </td>
        
            </tr>
            <?php } ?>
        </table>
    </div>
    <?php } ?>
</div>
