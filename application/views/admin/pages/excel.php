<div class="row">
    <div class="col-md-6 p0">
        <br>
        <form action="<?php echo base_url();?>index.php/admin/generatexls" method="post" enctype="multipart/form-data">
        <div class="col-md-6">
            <select class="form-control" name="lid" id="lid">
                <option value="">Chọn Lớp</option>
                <?php foreach($level_list as $l){ ?>
                    <?php if($l['lid'] < 15){ ?>
                        <option value="<?php echo $l['lid']?>"><?php echo $l['level_name']?></option>
                    <?php }?>
                <?php }?>
            </select>
        </div>
        <div class="col-md-6">
            <select class="form-control" name="cid" id="cid">
                <option value="">Chọn Môn</option>
                <?php foreach($category_list as $c){ ?>
                    <?php if($c['cid'] < 22){ ?>
                        <option value="<?php echo $c['cid']?>"><?php echo $c['category_name']?></option>
                    <?php }?>
                <?php }?>
            </select>
        </div>
        <div class="col-md-12"><br>
            <input type="submit" class="form-control btn btn-success" name="submit" value="Xuất file Excel" />
            <!-- <a class="form-control btn btn-success" href="<?php //echo base_url().'index.php/admin/generatexls?cid='.$cc.'&lid='.$ll?>">Xuất file Excel</a> -->
        </div>
        </form>
    </div>
    <div class="col-md-6 p0">
        Nhập file excel: <br>
        <form action="<?php echo base_url();?>index.php/admin/importFile" method="post" enctype="multipart/form-data">
            <input type="file" name="uploadFile" value="" class="form-control" />
            <br>
            <input type="submit" class="form-control btn btn-success" name="submit" value="Nhập file excel" />
        </form>
    </div>
</div>