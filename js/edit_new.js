function editNew(id) {
    var desc = CKEDITOR.instances.editor1.getData();
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
    var des_new = $("textarea#txtdesnews").val();
    var pos = $('#inp_stt').val();
    var img_new = $("input[name=image_avatar]").val();
    var class_new = $("#sltype").val();
    var related_news = $('#displaynone1').val();
    var featured = $('#cbfeatured').val();
    var source = $('#txtsource').val();
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
            url: site_url + "/sadmin/check_name_exist_update/",
            contentType: "application/json",
            success: function(data) {
                // console.log(data);
                if (data['check'] == 1) {
                    $("#txtnamenews").css('border', '');
                    $("#txtnamenews").attr('title', '');
                    $.ajax({
                        type: "POST",
                        data: formData,
                        url: site_url + "/sadmin/update_new/",
                        //    contentType: 'application/json',
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            // console.log(data);
                            if (data['mess'] == 'success') {
                                alert("Sửa bài viết thành công!");
                                window.location.href = site_url + "/sadmin/manage_news";
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