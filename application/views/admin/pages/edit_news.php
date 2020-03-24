<?php
$this->load->model("admin_model");
?>
<script>
  var site_url = "<?php echo site_url() ?>";
</script>
<script>
  var base_url = "<?php echo base_url() ?>";
</script>
<script>
  $(function() {
    $("#public_date").datepicker({
      dateFormat: 'd/m/Y'
    });
  });
</script>


<div class="col-xs-12 p0">
  <div class="box">
    <!-- /.box-header -->
    <div class="box-body">
      <form id="create_new_stemup">
        <div class="col-md-9">
          <div class="form-group">
            <label class="" for="">Tên bài viết:</label>
            <div id="url_name"></div>
            <input type="text" name="txtnamenews" id="txtnamenews" class="col-md-9 form-control" value="<?php echo $new['name'] ?>">
          </div>

          <div class="form-group">
            <label for="">Mô tả ngắn:</label>
            <div class="form-group">
              <textarea name="txtdesnews" id="txtdesnews" class="form-control" rows="4" cols="30"><?php echo $new['description'] ?></textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="">Nội dung:</label>
            <div class="">
              <textarea name="ckeditor" class="ckeditor form-control" placeholder="" id="editor1" rows="20" cols="80"><?php echo $new['content'] ?>
              </textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-3 related_news_btn">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_dstin">
                Chọn tin liên quan
              </button>
            </div>
            <div class="col-md-9" id="related_news">
              <?php echo $related_news ?>
            </div>

            <div class="col-md-12" id="displaynone" style="display: none;">
              <input type="text" name="displaynone1" id="displaynone1">
            </div>
          </div>

        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label class="" for="">Loại tin:</label>
            <div class="">
              <select id="sltype" class="form-control">
                <?php foreach ($class as $cl) { ?>
                  <option value="<?php echo $cl['id'] ?>" <?php if ($cl['id'] == $new['category']) echo 'selected' ?>><?php echo $cl['category_name'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="">Ảnh đại diện</label> 
            <input type='file' name="image_avatar" id="image_avatar" />
            <img id="blah" src="<?php echo $new['avatar'] ?>" alt="your image" />
          </div>

          <div class="form-group">
            <label class="" for="">Thứ tự hiển thị</label><input class="form-control" type='text' name="inp_stt" id="inp_stt" autocomplete="off" value="<?php echo $new['pos'] ?>">
          </div>
          <?php
          $date = strtotime($new['public_date']);
          $public_date = date('m/d/Y', $date);
          ?>
          <div class="form-group">
            <label class="txt_stt" for="">Ngày hiển thị</label><input class="form-control" type='text' name="public_date" id="public_date" autocomplete="off" value="<?php echo $public_date ?>">
          </div>

          <div class="form-group">
            <label for=""><input type='checkbox' name="cbfeatured" id="cbfeatured" value=1 <?php if ($new['featured'] == 1) echo 'checked' ?>>&nbsp; Tin nổi bật</label>
          </div>

          <div class="form-group">
            <label class="" for="">Tag</label>
            <div class=""><input type="text" name="txttagnews" id="txttagnews" class="form-control" value="<?php echo $new['tag'] ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail">Tác giả, nguồn bài viết:</label>
            <div class="form-group MT20">
              <input type="text" name="txtsource" id="txtsource" class="form-control" value="<?php echo $new['source'] ?>">
            </div>
          </div>

        </div>

      </form>
    </div>
  </div>
  <!--- POPUP Danh sach tin--->
  <div class="modal fade" id="modal_dstin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content row">
        <div class="col-md-3 model_search text-center"> </div>
        <div class="col-md-6 modal-header-dstin text-center">DANH SÁCH TIN TỨC</div>
        <div class="col-md-3 model_search text-center"><input type="text" id="fname" class="form-control" placeholder="Nhập nội dung tìm kiếm"> </div>
        <div id="modal_body" class="modal-body">
          <table id="item-list" class="table table-hover" style="background: #d2e8f5;">
            <thead>
              <tr>
                <th scope="col" class="ta-c">STT</th>
                <th scope="col" class="ta-c">Tiêu đề</th>
                <th scope="col" class="ta-c">Loại tin</th>
                <th scope="col" class="ta-c">Ngày tạo</th>
                <th scope="col" class="ta-c">Chọn</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_news as $key => $n) {
                $i++; ?>
                <tr>
                  <th scope="row" class="ta-c"><?php echo $i; ?></th>
                  <td><?php echo $n['name'] ?></td>
                  <td class="ta-c"><?php echo $n['category_name'] ?></td>
                  <td class="ta-c"><?php echo date("d-m-Y", strtotime($n['modify_date'])) ?></td>
                  <td class="ta-c"><input type="checkbox" name="cb-chon" class="cb-chon" value="<?php echo $n['id'] ?>"></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
          <button type="button" class="btn btn-primary" id="ds_luuchon">Lưu chọn</button>
        </div>
      </div>
    </div>
  </div>
  <!--- End POPUP --->
</div>
<!-- /.col -->

<div class="col-md-12" style="text-align: center;">
  <button class="btn btn-success" onclick="editNew(<?php echo $new['id'] ?>)">Xác nhận</button>
</div>
<!-- /.row -->

<!-- /.content -->

<script src="<?php echo base_url('js/admin/edit_new.js')  ?>"></script>