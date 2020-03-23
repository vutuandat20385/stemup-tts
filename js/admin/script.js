//Date picker
//CKeditor
CKEDITOR.replace( 'ta_add_content' );// tham số là biến name của textarea

//Image Upload
function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
  }
  
  $("#imgInp").change(function() {
    readURL(this);
  });

//Danh sách chọn tin liên quan
$(document).ready(function(){
    // var dschon=[];
    $('#ds_luuchon').click(function(){

      var danhsach=document.getElementsByName('cb-chon');
      var chon=[];
      for(var i=0; i<danhsach.length; i++){
        if(danhsach[i].checked === true){
          chon.push(danhsach[i].value);
        }
      }
      if(chon.length>3){
        alert('Bạn đã chọn hơn 3 tin liên quan, vui lòng chọn lại !');
      }else{
        // ds_chon = chon.join(",");
        // console.log(ds_chon);
        $.ajax({
            url : base_url + 'index.php/admin/show_danhsach_chon',
            type : "post",
            data : {chon:chon},
            success : function (result){
              $('#related_news').html(result);
            }
        });
        $('#modal_dstin').modal('hide');
        document.getElementById('displaynone1').value = chon;
      }

    });

  });
  function preview_image(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('output_image');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
  function convert_str(str) {
    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');
    str = str.replace(/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/g, 'A');
    str = str.replace(/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/g, 'E');
    str = str.replace(/(Ì|Í|Ị|Ỉ|Ĩ)/g, 'I');
    str = str.replace(/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/g, 'O');
    str = str.replace(/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/g, 'U');
    str = str.replace(/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/g, 'Y');
    str = str.replace(/(Đ)/g, 'D');
    str = str.replace(/[^a-zA-Z0-9 ]/g, "");
    str = str.replace(/\s+/g, "-");
    return str;
}

  //create news
  function createnew() {
    var desc = CKEDITOR.instances.ta_add_content.getData();
    var html = jQuery.parseHTML(desc);
    var tmp = document.createElement('div');
    tmp.innerHTML = desc;
    var img = tmp.getElementsByTagName('img');
    var src = img.src;
    var check;
    //  console.log(tmp);
    for (i = 0; i < img.length; i++) {
        var a = $("img").attr("id", i);
        // $("img").attr("alt","image");
        //console.log(img[i].src);
        //console.log(img[i]);
    }
    /*  while(desc.indexOf('src="/stem_up')!=-1){
          desc.replace('src="/stem_up', 'src=".../stem_up');
      }*/
    $("#cbshow").prop("checked") ? check = 1 : check = 0;
    var show = $("input[name=cbShow]").val();
    var name_new = $("input[name=txtnamenews]").val();
    var tag_new = $("input[name=txttagnews]").val();
    var des_new = $("textarea#ta_des").val();
    var pos = $('#inp_stt').val();
    // var public_date = $("#datepicker").val();
    var public_date = $("#public_date").val();
    // var public_date = $("#public_date").datepicker("getDate");
    // console.log('public: '+public_date);  
    var img_new = $("input[name=imgInp]").val();
    var class_new = $("#sltype").val();
    var related_news = $('#displaynone1').val();
    var featured = $('#cbfeatured').val();
    var source = $('#txtsource').val();
    var check_desc, check_name, check_ava, check_des;
    name_new = name_new.trim();
    url_name = convert_str(name_new);
    // name_new = name_new.replace(/[&\/\\#,!,+()$~%.'":*?<>{}]/g, '');
    // name_new = name_new.replace(/[^a-zA-Z0-9 ]/g, "");
    // console.log(name_new);
    // console.log(base_url);
    tag_new = tag_new.trim();
    des_new = des_new.trim();
    desc = desc.trim();
    if (name_new != '') {
        $("#txtnamenews").css("border", "");
        $("#txtnamenews").attr('title', '');
        check_name = 1;
    } else {
        $("#txtnamenews").css('border', '1px solid red');
        $("#txtnamenews").attr('title', 'Không được để trống tên');
        check_name = 0;
    }
    if (des_new != '') {
        $("#ta_des").css("border", "");
        $("#ta_des").attr('title', '');
        check_des = 1;
    } else {
        $("#ta_des").css('border', '1px solid red');
        $("#ta_des").attr('title', 'Không được để trống tên');
        check_des = 0;
    }

    if (img_new != '') {
        $("#imgInp").css("border", "");
        $("#imgInp").attr('title', '');
        check_ava = 1;
    } else {
        $("#imgInp").css('border', '1px solid red');
        $("#imgInp").attr('title', 'Không được để trống tên');
        check_ava = 0;
    }
    if (desc != '') {
        $("#ta_add_content").css("border", "");
        $("#ta_add_content").attr('title', '');
        check_desc = 1;
    } else {
        $("#ta_add_content").css('border', '1px solid red');
        $("#ta_add_content").attr('title', 'Không được để trống nội dung');
        check_desc = 0;
    }
    // console.log(public_date);
    // throw new Error("my error message");
  //  console.log(desc);
  //  console.log(name_new);
  //  console.log(url_name);
  //  console.log(des_new);
  //  console.log(tag_new);
  //  console.log(class_new);
  //  console.log(pos);
  //  console.log(public_date);
  //  console.log(related_news);
  //  console.log(featured);
  //  console.log(featured);
  //  console.log(source);
  //  return;
    var formData = new FormData();
    // formData.append('homepage',check);
    formData.append('content', desc);
    formData.append('name', name_new);
    formData.append('url_name', url_name);
    formData.append('des', des_new);
    formData.append('class', class_new);
    formData.append('tag', tag_new);
    //formData.append('avatar', img_new);
    formData.append('avatar_news', $('#imgInp')[0].files[0], $("#imgInp")[0].files[0].name);
    formData.append('pos', pos);
    formData.append('public_date', public_date);
    formData.append('related_news', related_news);
    formData.append('featured', featured);
    formData.append('source', source);
    // console.log(...formData);
    // return;
    /*  dt = JSON.stringify({
          'content': desc,
          'name': name_new,
          'des': des_new,
          'class' : class_new,
          'tag': tag_new,
          'avatar': img_new
      });*/
    // var image =  $('#imgInp')[0].files[0] + $("#imgInp")[0].files[0].name;
    // var formData = {
    //   'homepage': check,
    //   'content' :desc,
    //   'name' : name_new,
    //   'url_name':url_name,
    //   'des':des_new,
    //   'class':class_new,
    //   'tag':tag_new,
    //   'avatar':img_new,
    //   'avatar_new': image,
    //   'pos':pos,
    //   'public_date':public_date,
    //   'related_news':related_news,
    //   'featured':featured,
    //   'source': source,
    // }
    // console.log(formData);
    // return;
    name = JSON.stringify({
        'name': name_new,
    })

    if (check_desc == 1 && check_name == 1 && check_ava == 1 && check_des == 1) {
        $.ajax({
            type: "POST",
            data: name,
            url: base_url + "index.php/admin/check_name_exist/",
            contentType: "application/json",
            success: function (data) {
                //   console.log(data);
                if (data['check'] == 1) {
                    $("#txtnamenews").css('border', '');
                    $("#txtnamenews").attr('title', '');
                    $.ajax({
                        type: "POST",
                        data: formData,
                        url: base_url + "index.php/admin/create_new/",
                        //    contentType: 'application/json',
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            // console.log(data);
                            if (data['mess'] == 'success') {
                                alert("Tạo bài viết thành công!");
                                location.replace(base_url+"index.php/admin/manage_news");
                            } else {
                                alert("Oops, Đã xảy ra một số lỗi! Bạn vui lòng thử lại!");
                            }
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    })
                } else {
                    $("#txtnamenews").css('border', '1px solid red');
                    $("#txtnamenews").attr('title', 'Tên bài đã tồn tại.');
                }
            },
            error: function (data) {
                console.log(data);
            }
        })
    }




}



		$('#txtupdate').click(function(){

			var list=document.getElementsByClassName('pos');
			var Item = {
				    id : "",
				    pos : ""
				};
	        var data=[];
	        for (var i = 0; i < list.length; i++) {
	            Item[i].id = list[i].name;
	            // Item.pos = list[i].val;
	            data[i]=Item;
	        }
	        
	        alert(data);
	        // $.ajax({
	        //         url: "<?php echo site_url('sadmin/update_pos');?>",
	        //         type: 'POST',
	        //         data: data,
	        //         success:function(result){
	        //         	console.log(2);
	        //             alert('Cập nhật thành công');
	        //             $('#id_test').html('Thành công');
	        //         }
	        //     });
    });
    function editNew(id) {
      var desc = CKEDITOR.instances.edit_content.getData();
      var html = jQuery.parseHTML(desc);
      var tmp = document.createElement('div');
      tmp.innerHTML = desc;
      var img = tmp.getElementsByTagName('img');
      var src = img.src;
      var check;
      $("#cbshow").prop("checked") ? check = 1 : check = 0;
      var show = $("input[name=cbShow]").val();
      var name_new = $("input[name=txtnamenews]").val();
      var tag_new = $("input[name=txttagnews]").val();
      var des_new = $("textarea#ta_des").val();
      var pos = $('#inp_stt').val();
      var img_new = $("input[name=image_avatar]").val();
      var class_new = $("#sltype").val();
      var related_news = $('#displaynone1').val();
      var featured = $('#cbfeatured').val();
      var source = $('#txtsource').val();
      var public_date = $('#public_date').val();
      var check_desc, check_name, check_ava, check_des;
      name_new = name_new.trim();
      url_name = convert_str(name_new);
      tag_new = tag_new.trim();
      des_new = des_new.trim();
      desc = desc.trim();
      if (name_new != '') {
          $("#txtnamenews").css("border", "");
          $("#txtnamenews").attr('title', '');
          check_name = 1;
      } else {
          $("#txtnamenews").css('border', '1px solid red');
          $("#txtnamenews").attr('title', 'Không được để trống tên');
          check_name = 0;
      }
      if (des_new != '') {
          $("#txtdesnews").css("border", "");
          $("#txtdesnews").attr('title', '');
          check_des = 1;
      } else {
          $("#txtdesnews").css('border', '1px solid red');
          $("#txtdesnews").attr('title', 'Không được để trống tên');
          check_des = 0;
      }
  
      if (img_new != '') {
          $("#image_avatar").css("border", "");
          $("#image_avatar").attr('title', '');
          check_ava = 1;
      } else {
          $("#image_avatar").css('border', '1px solid red');
          $("#image_avatar").attr('title', 'Không được để trống tên');
          check_ava = 0;
      }
      if (desc != '') {
          $("#cke_editor1").css("border", "");
          $("#cke_editor1").attr('title', '');
          check_desc = 1;
      } else {
          $("#cke_editor1").css('border', '1px solid red');
          $("#cke_editor1").attr('title', 'Không được để trống nội dung');
          check_desc = 0;
      }
  
      var formData = new FormData();
      formData.append('content', desc);
      formData.append('name', name_new);
      formData.append('url_name', url_name);
      formData.append('des', des_new);
      formData.append('class', class_new);
      formData.append('tag', tag_new);
      if (check_ava == 1) {
          formData.append('avatar_news', $('#image_avatar')[0].files[0], $("#image_avatar")[0].files[0].name);
      }
      formData.append('id', id);
      formData.append('pos', pos);
      formData.append('public_date', public_date);
      formData.append('related_news', related_news);
      formData.append('featured', featured);
      formData.append('source', source);
  
      name = JSON.stringify({
          'name': name_new,
          'id': id,
      })
      if (check_desc == 1 && check_name == 1 && check_des == 1) {
          $.ajax({
              type: "POST",
              data: name,
              url: base_url + "index.php/admin/check_name_exist_update/",
              contentType: "application/json",
              success: function(data) {
                  // console.log(data);
                  if (data['check'] == 1) {
                      $("#txtnamenews").css('border', '');
                      $("#txtnamenews").attr('title', '');
                      $.ajax({
                          type: "POST",
                          data: formData,
                          url: base_url + "index.php/admin/update_new/",
                          //    contentType: 'application/json',
                          contentType: false,
                          processData: false,
                          success: function(data) {
                              // console.log(data);
                              if (data['mess'] == 'success') {
                                  alert("Sửa bài viết thành công!");
                                  window.location.href = base_url + "index.php/admin/manage_news";
                              } else {
                                  alert("Oops, Đã xảy ra một số lỗi! Bạn vui lòng thử lại!");
                              }
                          },
                          error: function(xhr, ajaxOptions, thrownError) {
                              console.log(xhr);
                              console.log(ajaxOptions);
                              console.log(thrownError);
                          }
                      })
                  } else {
                      $("#txtnamenews").css('border', '1px solid red');
                      $("#txtnamenews").attr('title', 'Tên bài đã tồn tại.');
                  }
              },
              error: function(xhr, ajaxOptions, thrownError) {
                  console.log(xhr);
                  console.log(ajaxOptions);
                  console.log(thrownError);
              }
          })
      }
  
  
  
  
  }

