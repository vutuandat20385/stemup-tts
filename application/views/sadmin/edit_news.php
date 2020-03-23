<?php
  $this->load->view('sadmin/head');
  $this->load->model("sadmin_model");
?>
<script> var site_url = "<?php echo site_url() ?>";</script>
<script> var base_url = "<?php echo base_url() ?>";</script>
<script>
  $( function() {
    $("#public_date").datepicker({
      dateFormat: 'd/m/Y'
    });
  } );
</script>
<div class="wrapper">

<?php $this->load->view('sadmin/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <?php $this->load->view('sadmin/leftmenu'); ?>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="col-md-12"> <p class="title">SỬA TIN TỨC</p> </div>
    <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
            <form id="create_new_stemup">
                  <div class="col-md-9 pl-0">
                    <div class="tenbai ">   
                          <label class="label-tenbai col-md-2" for="">Tên bài viết:</label> 
                          <div class="div-input-tenbai">
                                <input type="text" name="txtnamenews" id="txtnamenews" value="<?php echo $new['name'] ?>" class="input-tenbai col-md-10">
                          </div>
                    </div>
                      <div class="form-group">
                        <label for="" class="col-md-12">Nội dung:</label> 
                        <div class="col-md-12">
                              <textarea name="ckeditor" class="ckeditor form-control" placeholder="" id="editor1" rows="20" cols="80">
                                <?php echo $new['content'] ?>
                              </textarea>
                              
                        </div>
                      </div>
                  </div>
                  <div class="col-md-3 p0">
                         <div class="form-group">  
                            <label for="">Mô tả ngắn nội dung:</label> 
                                <div class="form-group">
                                      <textarea name="txtdesnews" id="txtdesnews" class="form-control" rows="4" cols="30"><?php echo $new['description'] ?></textarea> 
                                </div>
                          </div>

                          <div class="form-group col-md-12 p0">  
                            <span class="txt_stt">Thứ tự hiển thị</span><input type='text' name="inp_stt" id="inp_stt" value="<?php echo $new['pos'] ?>"> 
                          </div>
                        <?php
                          $date = strtotime($new['public_date']);
                          $public_date = date('m/d/Y', $date);
                        ?>
                        <div class="form-group col-md-12 p0">  
                          <span class="txt_stt">Ngày hiển thị</span><input type='text' name="public_date" id="public_date" value="<?php echo $public_date ?>"> 
                        </div>

                        <div class="form-group col-md-12 p0">   
                          <label for=""><input type='checkbox' name="cbfeatured" id="cbfeatured" value=1 <?php if($new['featured'] == 1) echo 'checked' ?> >&nbsp; Tin nổi bật</label> 
                        </div> 

                          <div class="form-group">   
                            <label for="">Ảnh đại diện</label> 
                                <div class="form-group MT20 ta-c">
                                  <img style="max-width: 250px;max-height: 155px;object-fit: cover;" name="output_image" id="output_image" src="<?php echo $new['avatar'] ?>"/>
                                </div>
                                <div class="form-group MT20 ta-c">
                                <label for="image_avatar"><i>Thay đổi ảnh đại diện</i></label>
                                <input type="file" class="form-control" name="image_avatar" id="image_avatar" accept="image/*" style="display: none;" onchange="preview_image(event)">
                                </div>
                          </div>

                          <div class="form-group">   
                            <div class="col-md-3 p0">Tag</div>
                            <div class="col-md-9 p0 MT20"><input type="text" name="txttagnews" id="txttagnews" class="form-control" value="<?php echo $new['tag'] ?>">
                            </div>
                          </div>

                          <div class="form-group">   
                              <div class="col-md-3 p0">Loại tin:</div> 
                              <div class="col-md-9 p0 MT20">
                                      <select id="sltype" class="form-control">
                                        <?php foreach($class as $cl) { ?>
                                                <option value="<?php echo $cl['id'] ?>" <?php if($cl['id'] == $new['category']) echo 'selected' ?> ><?php echo $cl['category_name'] ?></option>
                                        <?php } ?>
                                      </select>
                              </div>
                          </div>

                          <div class="form-group">   
                            <label for="inputEmail">Tác giả, nguồn bài viết:</label> 
                            <div class="form-group MT20">
                              <input type="text" name="txtsource" id="txtsource" class="form-control" value="<?php echo $new['source'] ?>">
                            </div>
                          </div>

                          <div class="form-group form-tinlienquan">
                            <div class="col-md-12 p0" id="select_tinlienquan">
                              <div class="col-md-9 p0">
                                <!-- Chọn tin liên quan: <a class="icon-tinlienquan-1" id="chon_tinlienquan" alt="Chọn tối đa 3 tin" data-target="#modal_dstin"><i class="fa fa-file-text-o" aria-hidden="true"></i></a> -->

                                <!-- Button trigger modal -->
                                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_dstin">
                                        Chọn tin liên quan 
                                      </button>

                                      <!--- POPUP Danh sach tin--->
                                      <div class="modal fade" id="modal_dstin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                         <div class="modal-content">
                            <div class="model_search">
                             <input type="text" id="fname"> <a class="btn-default glyphicon glyphicon-search icon_search" id="search" onclick="sfunction()"></a>
                           </div>
                            <div class="modal-header-dstin">DANH SÁCH TIN TỨC</div>
                            <div id="modal_body" class="modal-body">
                             
                              <br>
                                              <table class="table table-hover" style="background: #d2e8f5;">
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
                                                  <?php
                                                    foreach ($list_news as $key => $value) {
                                                  ?>
                                                      <tr>
                                                        <th scope="row" class="ta-c"><?php echo $key+1;?></th>
                                                        <td><?php echo $value['name']?></td>
                                                        <td class="ta-c"><?php echo $value['category_name']?></td>
                                                        <td class="ta-c"><?php echo date("d-m-Y", strtotime($value['modify_date']))?></td>
                                                        <td class="ta-c"><input type="checkbox" name="cb-chon" class="cb-chon" value="<?php echo $value['id']?>"
                                                        <?php if(in_array( $value['id'], $array_related)) echo "checked"; ?>></td>
                                                      </tr>
                                                  <?php
                                                    }
                                                  ?>
                                                  
                                                </tbody>
                                              </table>
                                            </div>
                                         <div class="paging" align="center">
                           
                            <a id="back" class="btn-default" href="#">trang truoc</a> <?php for ($i = 1; $i <=$trang ; $i++) {
                             ?>
                             <a class="btn-default" href="#" id="page" onclick="myFuntion(<?php echo $i ?>)"><?php echo $i ?></a>
                             <?php
                           } ?> <a href="#" class="btn-default" id="next">Trang sau</a>
                         </a> 
                         <div class="modal-footer">

                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                           <button type="button" class="btn btn-primary" id="ds_luuchon" >Lưu chọn</button>
                         </div>
                       </div>
                      </div>
                    </div>
                <script type="text/javascript">

                    function myFuntion(id) {
                      $.get("<?php echo base_url() ?>index.php/sadmin/get_items",{trang:id},function(data){
                        $("#modal_body").html(data);
                      });
                    }
                   <?php if($trang==0) $trang=0 ?>
                   var dem=0;
                   $(document).ready(function() {
                    $("#next").click(function() {
                      /* Act on the event */
                      dem=dem+1;
                      if(dem<=<?php echo $trang ?>){
                        dem=dem+1;
                      }else{
                        dem=<?php echo $trang ?>;
                        alert("trang cuối rồi !");
                      }
                      $.get("<?php echo base_url() ?>index.php/sadmin/get_items",{trang:dem},function(data){
                        $("#modal_body").html(data);
                      });
                    }); 
                    $("#back").click(function() {
                      /* Act on the event */
                      if(dem>1){
                        dem=dem-1;
                      }else{
                        dem=1;
                        alert('Trang đầu tiên rồi !')}
                        $.get("<?php echo base_url() ?>index.php/sadmin/get_items",{trang:dem},function(data){
                          $("#modal_body").html(data);
                        });
                      });
                  });
                   function sfunction() {
                      var x = document.getElementById("fname").value;
                      
                        $.get("<?php echo base_url() ?>index.php/sadmin/get_items",{search:x},function(data){
                          $("#modal_body").html(data);
                        });
                      
                   }
                </script>
                                      <!--- End POPUP --->
                              </div>
                              <div class="col-md-3 p0 ta-r">
                                <!-- <a class="icon-tinlienquan-1"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                                <a class="icon-tinlienquan-1"> <i class="fa fa-arrow-down" aria-hidden="true"></i></a> -->
                                <!-- <a class="icon-tinlienquan-1" id="xoa_tinlienquan"> <i class="fa fa-trash-o" aria-hidden="true"></i></a> -->
                              </div>
                              
                            
                              <div class="col-md-12" id="list-tinlienquan">
                                <?php echo $related_news ?>
                              </div>
                              <div class="col-md-12" id="displaynone" style="display: none;">
                                  <input type="text" value=" <?php echo $new['related_news'] ?>" name="" id="displaynone1" >
                              </div>
                            </div>
                          </div>
                  </div>
            </form>
            </div>
        </div>
        <!-- /.col -->
      </div>
      <div class="col-md-12" style="text-align: center;">
        <button class="btn btn-success" onclick="editNew(<?php echo $new['id'] ?>)" >Xác nhận</button>
      </div>
      <!-- /.row -->
  </section>
    <!-- /.content -->
  </div>
<script src="<?php echo base_url('js/edit_new.js')  ?>"></script>

<?php $this->load->view('sadmin/foot'); ?>

