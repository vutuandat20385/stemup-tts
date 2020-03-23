function add_question(qid) {
    $("#" + qid).addClass('shown');
    //    $("#td_"+qid).prop('onclick', null);
    $("#td_" + qid).removeAttr('onclick');
    $("#td_" + qid).attr('onClick', 'sub_question(' + qid + ')');
    string_qid = $("#inf_qid").val();
    var lastChar=string_qid.charAt(string_qid.length-1);
 //   console.log(lastChar);
    if (string_qid.length == 0) {
        string_qid += qid;
    } else {
        if(lastChar == ','){
            string_qid += qid;
        } else {
            string_qid += ',' + qid;
        }
    }
    $("#inf_qid").val(string_qid);
}
function sub_question(qid) {
    $("#td_" + qid).removeAttr('onclick');
    $("#" + qid).removeAttr('class');
    $("#td_" + qid).attr('onClick', 'add_question(' + qid + ')');
    string_qid = $("#inf_qid").val();
    let string_update = '';
    array_qid = string_qid.split(',');
    for (i = 0; i < array_qid.length; i++) {
        if (array_qid[i] != qid) {
            string_update += array_qid[i] + ',';
        }
    }
    let lastChar=string_update.charAt(string_update.length-1);
    if(lastChar == ','){
        string_update = string_update.substring(0, string_update.length - 1);
    }
    $("#inf_qid").val(string_update);
}
function add_quiz() {
    dataform = $("#formAddQuiz").serialize();
    var name;
    var qids;
    var check_qids = /[0-9]+/;
    var check_name = /[a-zA-Z0-9]+/;
    string_name = $('input[name=quiz_name]').val();
    string_qids = $('input[name=string_qids]').val();
   if (check_name.test(string_name)) {
        $('input[name=quiz_name]').css('border', '');
        $('input[name=quiz_name]').attr('title', '');
        name = 1;
    } else {
        $('input[name=quiz_name]').css('border', '1px solid red');
        $('input[name=quiz_name]').attr('title', 'Tên bài Quiz không hợp lệ!');
        name = 0;
    }
    if (check_qids.test(string_qids)) {
        qids = 1;
    } else {
        alert("Bạn chưa chọn câu hỏi!");
        qids = 0;
    }
    if (name == 1 && qids == 1) {
        $.ajax({
            type: "POST",
            data: dataform,
            url: site_url + '/sadmin/add_quiz',
            success: function (data) {
                //    console.log('success');
                alert("Thêm bài Quiz thành công!");
                window.location.href = site_url + '/sadmin/quiz_list';
            },
            error: function (data) {

            }
        })
    }
    //    console.log(dataform);
}
function draw_qbank(page) {
    cid = $("#inf_cid").val();
    lid = $("#inf_lid").val();
    search = $("#inf_search").val();
    limit = $("#inf_limit").val();
    redraw_tbl_qbank(cid, lid, search, limit, page);
}

function drawlv_qbank(event) {
    cid = $("#inf_cid").val();
    lid = $(event).val();
    search = $("#inf_search").val();
    limit = $("#inf_limit").val();
    redraw_tbl_qbank(cid, lid, search, limit, 0);
}
function drawct_qbank(event) {
    lid = $("#inf_lid").val();
    cid = $(event).val();
    search = $("#inf_search").val();
    limit = $("#inf_limit").val();
    redraw_tbl_qbank(cid, lid, search, limit, 0);
}
function drawlimit_qbank(event) {
    limit = $(event).val();
    cid = $("#inf_cid").val();
    lid = $("#inf_lid").val();
    search = $("#inf_search").val();
    redraw_tbl_qbank(cid, lid, search, limit, 0);
}
function drawsearch_qbank(event, e) {
    lid = $("#inf_lid").val();
    cid = $("#inf_cid").val();
    limit = $("#inf_limit").val();
    if (e.keyCode == '13') {
        search = $(event).val();
        redraw_tbl_qbank(cid, lid, search, limit, 0);
    }

}
function drawsearch_qbank_btn() {
    lid = $("#inf_lid").val();
    cid = $("#inf_cid").val();
    limit = $("#inf_limit").val();
    search = $("#search_qbank").val();
    redraw_tbl_qbank(cid, lid, search, limit, 0);
}
function redraw_tbl_qbank(cid, lid, search, limit, page) {

    $("#inf_cid").val(cid);
    $("#inf_lid").val(lid);
    $("#inf_search").val(search);
    $("#inf_limit").val(limit);
    $("#inf_page").val(page);
    string_qids = $('input[name=string_qids]').val();
    string_qids_new = string_qids.split(',');
    dt = JSON.stringify({
        'cid': cid,
        'lid': lid,
        'search': search,
        'limit': limit,
        'page': page
    });
    $("#table_question_into_quiz").empty();
    $("#footer_qbank").empty();
    $("#table_question_into_quiz").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');
    $.ajax({
        type: 'POST',
        url: site_url + "/sadmin/get_data_qbank/",
        data: dt,
        contentType: 'application/json',
        success: function (results) {
            //   console.log(string_qids.split(','));
            //  console.log(results);
            var questions = results['questions'];
            var categories = results['categories'];
            var levels = results['levels'];
            var numpage = results['num_page'];
        //    console.log(questions);
            table = '';
            table += '<thead>';
            table += '<tr style="background-color: rgb(233, 235, 238);">';
            table += '<th></th>';
            table += '<th>Câu hỏi<span>';
            table += '<select style="float:right" onchange="drawlimit_qbank(this)">';
            for (i = 1; i < 6; i++) {
                table += '<option value="' + (i * 5) + '"';
                if (limit == i * 5) {
                    table += " selected";
                }
                table += '>' + (i * 5) + ' mục</option>';
            }
            table += '</select></span></th>';
            table += '<th>';
            table += '<select style="width:60px" onchange="drawct_qbank(this)">';
            table += '<option disabled>Danh mục</option><option ';
            if (cid == 0)
                table += " selected ";
            table += ' value="0">Tất cả</option>';

            for (i = 0; i < categories.length; i++) {
                table += '<option ';
                if (categories[i]['cid'] == cid)
                    table += " selected ";
                table += 'value="' + categories[i]['cid'] + '">' + categories[i]['category_name'] + '</option>';
            }
            table += '</select>';
            table += '</th><th>';
            table += '<select style="width:60px" onchange="drawlv_qbank(this)">';
            table += '<option disabled>Cấp độ</option><option ';
            if (lid == 0)
                table += " selected ";
            table += ' value="0">Tất cả</option>';
            for (i = 0; i < levels.length; i++) {
                table += '<option';
                if (levels[i]['lid'] == lid)
                    table += " selected ";
                table += ' value="' + levels[i]['lid'] + '">' + levels[i]['level_name'] + '</option>';
            }
            table += '</select>';
            table += '</th>';
            table += '<th>';
            table += '</th>';
            table += '</tr>';
            table += '</thead>';
            table += '<tbody>';
            for (i = 0; i < questions.length; i++) {
                /*  for(j=0;j<j<string_qids_new.length;j++){
                      if(questions[i]['qid'] == string_qids_new[j]){
                          table += '<tr id=' + string_qids_new[j] + ' class="">';
                      }
                  }*/
                if (string_qids_new.includes(questions[i]['qid'])) {
                    table += '<tr id=' + questions[i]['qid'] + ' class="shown">';
                table += '<td id="td_'+ questions[i]['qid'] +'" onclick="sub_question('+ questions[i]['qid'] +')"  class="details-control" style="width:30px"></td>';

                } else {
                    table += '<tr id=' + questions[i]['qid'] + ' class="">';
                table += '<td id="td_'+ questions[i]['qid'] +'" onclick="add_question('+ questions[i]['qid'] +')"  class="details-control" style="width:30px"></td>';
                }
                table += '</td>';
                table += '<td>';
                table += questions[i]['question'];
                table += '</td>';
                table += '<td>';
                table += questions[i]['category_name'];
                table += '</td>';
                table += '<td>';
                table += questions[i]['level_name'];
                table += '</a>';
                table += '<td>';
                table += '<a onclick="mng_preview_qt_quiz(' + questions[i]['qid'] + ')"><i class="pointer text-success fa fa-eye" style="width:20px;" title="Xem trước"></i></a>';
                table += '</td>';
                table += '</tr>';
            }
            table += '</tbody>';
            footer = '';
            footer += '<p>Đang xem <span id="beginqt">' + Math.min(results.limit * results.page + 1, results.num_question) + '</span>';
            footer += ' đến <span id="endqt">' + Math.min(results.limit * (results.page + 1), results.num_question) + '</span>';
            footer += ' trong tổng số <span id="totalqt">' + results.num_question + '</span> câu hỏi<p>';
            footer += '<center>';
            footer += '<ul class="pagination listpage pageqt">';
            if (results.num_page < 7) {
                for (i = 0; i < results.num_page; i++) {
                    footer += '<li class="page-item';
                    if (i == page) {
                        footer += ' active';
                    }
                    footer += '" onclick="draw_qbank(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
                }
            }
            else {
                if (page <= 3) {
                    for (i = 0; i < 5; i++) {
                        footer += '<li class="page-item';
                        if (i == page) {
                            footer += ' active';
                        }
                        footer += '" onclick="draw_qbank(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
                    }
                    footer += '<li class="page-item"><a class="page-link">...</a></li>';
                    footer += '<li class="page-item" onclick="draw_qbank(' + (results.num_page - 1) + ')"><a class="page-link">' + results.num_page + '</a></li>';
                }
                else {
                    footer += '<li class="page-item" onclick="draw_qbank(0)"><a class="page-link">1</a></li>';
                    footer += '<li class="page-item"><a class="page-link">...</a></li>';

                    if (page < results.num_page - 4) {
                        footer += '<li class="page-item" onclick="draw_qbank(' + (page - 1) + ')"><a class="page-link">' + page + '</a></li>';
                        footer += '<li class="page-item active" onclick="draw_qbank(' + page + ')"><a class="page-link">' + (page + 1) + '</a></li>';
                        footer += '<li class="page-item" onclick="draw_qbank(' + (page + 1) + ')"><a class="page-link">' + (page + 2) + '</a></li>';
                        footer += '<li class="page-item"><a class="page-link">...</a></li>';
                        footer += '<li class="page-item" onclick="draw_qbank(' + (results.num_page - 1) + ')"><a class="page-link">' + results.num_page + '</a></li>';
                    }
                    else {
                        for (i = page - 2; i < results.num_page; i++) {
                            footer += '<li class="page-item';
                            if (i == page) {
                                footer += " active";
                            }
                            footer += '" onclick="draw_qbank(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>';
                        }

                    }
                }
            }
            footer += '</ul>';
            footer += '</center>';
            $("#table_question_into_quiz").append(table);
            $("#footer_qbank").append(footer);
            $("#circularG").remove();

        },
        error: function (data) {
            console.log(data);

        }
    });
}