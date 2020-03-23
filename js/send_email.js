$(document).ready(function () {
    $('.selectall').click(function () {
        $("#string_send").val('');
        if ($(this).is(':checked')) {
            $.ajax({
                type: "POST",
                url: site_url + '/sadmin/get_all_email_parent',
                success: function (data) {
                    string_send = '';
                    for (i = 0; i < data.email_parent.length; i++) {
                        string_send += data.email_parent[i]['uid'] + ' ,';
                    }
                    $("#string_send").val(string_send);
                },
                error: function (data) {

                }
            })
            // console.log('aa');
            $('tbody tr td input').prop('checked', true);
        } else {
            $('tbody tr td input').prop('checked', false);
        }
    });
})

function accept_send() {
    string_send = $("#string_send").val();
    email_send = $("#email_send").val();
    content = CKEDITOR.instances.editor1.getData();
    content = content.split('src="/stem_up/').join('src="' + base_url);
    subject = $("#txtsubject").val();
    subject = subject.replace(/\s\s+/g, ' ');
    subject = subject.trim();
    var check_content, check_subject;
    if (subject.length == 0) {
        check_subject = 0;
        $("#txtsubject").css("border", "1px solid red");
        $("#txtsubject").attr('title', 'Không được để trống !!!');
    } else {
        check_subject = 1;
        $("#txtsubject").css("border", "");
        $("#txtsubject").attr('title', '');
    }
    if (content.trim() == '') {
        check_content = 0;
        $("#cke_editor1").css("border", "1px solid red");
        $("#cke_editor1").attr('title', 'Không được để trống !!!');
    } else {
        check_content = 1;
        $("#cke_editor1").css("border", "");
        $("#cke_editor1").attr('title', '');
    }
    data = JSON.stringify({
        'email': email_send,
        'email_send': string_send,
        'content': content.trim(),
        'subject': subject
    });
    if (check_content == 1 && check_subject == 1) {
        $.ajax({
            type: "POST",
            data: data,
            url: site_url + '/sadmin/send_email_Process',
            contentType: 'application/json',
            success: function (data) {
                // console.log(data);
                if (data.mess == 1) {
                    alert("Gửi Email thành công");
                    location.reload();
                } else {
                    alert("Có sự cố xảy ra! ");
                }
            },
            error: function (data) {

            }
        })
    }
}

function add_string(uid) {
    string_send = $("#string_send").val();
    array_send = string_send.split(' ,');
    convert_uid = uid.toString();
    var checkbox = document.getElementById('email_' + uid);
    if (checkbox.checked == true) {
        if (string_send.length == 0) {
            string_send += uid + ' ,';
        } else {
            if (!array_send.includes(convert_uid)) {
                string_send += uid + ' ,';
            }
        }
    } else {
        string_send = '';
        for (i = 0; i < array_send.length - 1; i++) {
            if (array_send[i] != convert_uid) {
                string_send += array_send[i] + ' ,';
            }
        }
    }
    $("#string_send").val(string_send);
}

function search_parent(event, e) {
    if (e.keyCode == '13') {
        search = $(event).val();
        redraw_email_parent(search, 0);
    }
}

function search_parent_btn() {
    search = $("#txt_search_parent").val();
    redraw_email_parent(search, 0);
}

function drawpage_send_email(page) {
    search = $("#search_parent").val();
    redraw_email_parent(search, page);
}

function redraw_email_parent(search, page) {
    string_send = $("#string_send").val();
    array_send = string_send.split(' ,');
    $("#search_parent").val(search);
    $("#page_parent").val(page);
    dt = JSON.stringify({
        "search": search,
        "page": page,
    });
    id = (10 * page) + 1;
    $.ajax({
        type: "POST",
        data: dt,
        url: site_url + '/sadmin/get_send_email',
        contentType: "application/json",
        success: function (data) {
            $("#tbody_email").empty();
            $("#footer_email").empty();
            for (i = 0; i < data.email_parent.length; i++) {
                convert_uid = data.email_parent[i]['uid'].toString();
                tbody = '';
                tbody += '<tr>';
                tbody += '<th scope="row">' + id++ + '</th>';
                tbody += '<td>' + data.email_parent[i]['email'] + '</td>';
                tbody += '<td>' + data.email_parent[i]['username'] + '</td>';
                if (array_send.includes(convert_uid)) {
                    tbody += '<td><input type="checkbox" name="sample[]" class="checkbox_email" id="email_' + data.email_parent[i]['uid'] + '" checked onclick="add_string( ' + data.email_parent[i]['uid'] + ' )" value = "' + data.email_parent[i]['uid'] + '"></td>';
                } else {
                    tbody += '<td><input type="checkbox" name="sample[]" class="checkbox_email" id="email_' + data.email_parent[i]['uid'] + '" onclick="add_string( ' + data.email_parent[i]['uid'] + ' )" value = "' + data.email_parent[i]['uid'] + '"></td>';
                }
                tbody += '</tr>';
                $("#tbody_email").append(tbody);
            }
            footer = '';
            footer += '<p style="padding-top:5px">Đang xem <span id="beginqt">' + Math.min((10 * page) + 1, data.number_email_parent) + '</span> ';
            footer += 'đến <span id="endqt">' + Math.min(10 * (page + 1), data.number_email_parent) + ' </span> ';
            footer += 'trong tổng số <span id="totalqt">' + data.number_email_parent + '</span> câu hỏi </p>';
            footer += '<center>';
            footer += '<ul class="pagination listpage pageqt">';
            if (data.num_page < 7) {
                for (i = 0; i < data.num_page; i++) {
                    footer += '<li class="page-item';
                    if (i == page) {
                        footer += ' active';
                    }
                    footer += '" onclick="drawpage_send_email(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
                }
            } else {
                if (page <= 3) {
                    for (i = 0; i < 5; i++) {
                        footer += '<li class="page-item';
                        if (i == page) {
                            footer += ' active';
                        }
                        footer += '" onclick="drawpage_send_email(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
                    }
                    footer += '<li class="page-item"><a class="page-link">...</a></li>';
                    footer += '<li class="page-item" onclick="drawpage_send_email(' + (data.num_page - 1) + ')"><a class="page-link">' + data.num_page + '</a></li>';
                } else {
                    footer += '<li class="page-item" onclick="drawpage_send_email(0)"><a class="page-link">1</a></li>';
                    footer += '<li class="page-item"><a class="page-link">...</a></li>';

                    if (page < data.num_page - 4) {
                        footer += '<li class="page-item" onclick="drawpage_send_email(' + (page - 1) + ')"><a class="page-link">' + page + '</a></li>';
                        footer += '<li class="page-item active" onclick="drawpage_send_email(' + page + ')"><a class="page-link">' + (page + 1) + '</a></li>';
                        footer += '<li class="page-item" onclick="drawpage_send_email(' + (page + 1) + ')"><a class="page-link">' + (page + 2) + '</a></li>';
                        footer += '<li class="page-item"><a class="page-link">...</a></li>';
                        footer += '<li class="page-item" onclick="drawpage_send_email(' + (data.num_page - 1) + ')"><a class="page-link">' + data.num_page + '</a></li>';
                    } else {
                        for (i = page - 2; i < data.num_page; i++) {
                            footer += '<li class="page-item';
                            if (i == page) {
                                footer += " active";
                            }
                            footer += '" onclick="drawpage_send_email(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>';
                        }

                    }
                }
            }
            footer += '</ul>';
            footer += '</center>';
            $("#footer_email").append(footer);

        },
        error: function (data) {

        }
    })
}