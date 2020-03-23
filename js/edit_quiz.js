function drawpage_qbank_in(page) {
    cid = $("#inf_cid_in").val();
    lid = $("#inf_lid_in").val();
    search = $("#inf_search_in").val();
    limit = $("#inf_limit_in").val();
    redraws_qbank_in(cid, lid, search, limit, page);
}
function drawlv_qbank_in(event) {
    cid = $("#inf_cid_in").val();
    lid = $(event).val();
    search = $("#inf_search_in").val();
    limit = $("#inf_limit_in").val();
    redraws_qbank_in(cid, lid, search, limit, 0);
}
function drawlimit_qbank_in(event) {
    cid = $("#inf_cid_in").val();
    lid = $("#inf_lid_in").val();
    search = $("#inf_search_in").val();
    limit = $(event).val();
    redraws_qbank_in(cid, lid, search, limit, 0);
}
function drawct_qbank_in(event) {
    cid = $(event).val();
    lid = $("#inf_lid_in").val();
    search = $("#inf_search_in").val();
    limit = $("#inf_limit_in").val();
    redraws_qbank_in(cid, lid, search, limit, 0);
}
function drawsearch_qbank_in(event, e) {
    cid = $("#inf_cid_in").val();
    lid = $("#inf_lid_in").val();
    limit = $("#inf_limit_in").val();
    if (e.keyCode == '13') {
        search = $(event).val();
        redraws_qbank_in(cid, lid, search, limit, 0);
    }
}
function drawsearch_qbank_btn_in() {
    cid = $("#inf_cid_in").val();
    lid = $("#inf_lid_in").val();
    limit = $("#inf_limit_in").val();
    search = $("#search_qbank_in").val();
    redraws_qbank_in(cid, lid, search, limit, 0);
}
function redraws_qbank_in(cid, lid, search, limit, page) {
    $("#inf_cid_in").val(cid);
    $("#inf_lid_in").val(lid);
    $("#inf_search_in").val(search);
    $("#inf_limit_in").val(limit);
    $("#inf_page_in").val(page);
    url = window.location.href;
    spilit_url = url.split('/');
    dt = JSON.stringify({
        'cid': cid,
        'lid': lid,
        'search': search,
        'limit': limit,
        'page': page,
    });
    console.log(dt);
    console.log(spilit_url[spilit_url.length - 1]);
    $(".qbank_in").empty();
    $(".qbank_in").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');
    $.ajax({
        type: 'POST',
        url: site_url + "/home_user/get_data_qbank_in/" + spilit_url[spilit_url.length - 1],
        data: dt,
        contentType: 'application/json',
        success: function (data) {
            console.log(data);
            q = data.qbank;
            var html = '<span style="float:right; margin-bottom:10px;">';
            html += '<input id="search_qbank_in" style="min-width:250px;margin-top:5%" placeholder="Tìm kiếm câu hỏi" onkeyup="drawsearch_qbank_in(this,event)" value="' + search + '">';
            html += '<i class="pointer fa fa-search" onclick="drawsearch_qbank_btn_in()"></i></span>';
            html += '<table class="table table-bordered">';
            html += `
            <thead>
				<tr style="background-color: rgb(233, 235, 238);">
				<th></th>
                <th style="width: 400px;">Câu hỏi<span>
                <select style="float:right" onchange="drawlimit_qbank_in(this)">
            `;
            for (i = 1; i < 6; i++) {
                html += '<option value="' + i * 5 + '"';
                if (limit == i * 5) {
                    html += 'selected';
                }
                html += '> ' + i * 5 + ' mục </option>';
            }
            html += '</select></span></th>';
            html += `
            <th>
                <select style="width:95px" onchange="drawct_qbank_in(this)">
                <option disabled>Danh mục</option>
                <option 
            `;
            if (cid == 0) {
                html += 'selected';
            }
            html += 'value = 0> Tất cả </option>';
            for (i = 0; i < data.category_list.length; i++) {
                html += '<option ';
                if (data.category_list[i]['cid'] == cid) {
                    html += 'selected';
                }
                html += 'value = "' + data.category_list[i]['cid'] + '" >' + data.category_list[i]['category_name'] + '</option>';
            }
            html += '</select></th>';
            html += `
            <th>
				<select style="width:95px" onchange="drawlv_qbank_in(this)">
				<option disabled>Cấp độ</option>
				<option 
            `;
            if (lid == 0) {
                html += 'selected';
            }
            html += 'value=0> Tất cả </option>';
            for (i = 0; i < data.level_list.length; i++) {
                html += '<option ';
                if (data.level_list[i]['lid'] == lid) {
                    html += 'selected';
                }
                html += 'value ="' + data.level_list[i]['lid'] + '"> ' + data.category_list[i]['level_name'] + '</option> ';
            }
            html += '</select></th><th></th></tr></thead>';
            html += '<tbody>';
            for (i = 0; i < q.length; i++) {
                html += '<tr class="shown">';
                html += '<td onclick="change_stt_qt(this,'+ data.quiz +','+ q[i]['qid'] +')" class="details-control" style="width:30px"></td>';
                html += '<td>';
                html += ' ' + q[i]['question'] + ' ';
                html += '</td>';
                html += '<td>';
                html += ' ' + q[i]['category_name'] + ' ';
                html += '</td>';
                html += '<td>';
                html += ' ' + q[i]['level_name'] + ' ';
                html += '</td>';
                html += '<td><a class="pointer" onclick="mng_preview_qt(' + q[i]['qid'] + ')">';
                html += `
                <i class="pointer text-success fa fa-eye" title="Xem trước"></i></a></td>
				</tr>
                `;
            }
            html += '</tbody></table>';
            html += '<p>Đang xem <span id="beginqt"> ' + Math.min(data.limit * data.page + 1, data.num_qbank) + ' ';
            html += ' đến <span id="endqt">  ' + Math.min(data.limit * (data.page + 1), data.num_qbank) + ' ';
            html += 'trong tổng số <span id="totalqt"> ' + data.num_qbank + ' </span> câu hỏi<p> ';
            html += `<center>
            <ul class="pagination listpage pageqt">`;
            if (data.num_page < 7) {
                for (i = 0; i < data.num_page; i++) {
                    html += '<li class="page-item';
                    if (i == page) {
                        html += ' active';
                    }
                    html += '" onclick="drawpage_qbank_in(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
                }
            } else {

                if (page <= 3) {
                    for (i = 0; i < 5; i++) {
                        html += '<li class="page-item';
                        if (i == page) {
                            html += ' active';
                        }
                        html += '" onclick="drawpage_qbank_in(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
                    }
                    html += '<li class="page-item"><a class="page-link">...</a></li>';
                    html += '<li class="page-item" onclick="drawpage_qbank_in(' + (data.num_page - 1) + ')"><a class="page-link">' + data.num_page + '</a></li>';
                }
                else {
                    html += '<li class="page-item" onclick="drawpage_qbank_in(0)"><a class="page-link">1</a></li>';
                    html += '<li class="page-item"><a class="page-link">...</a></li>';

                    if (page < data.num_page - 4) {
                        html += '<li class="page-item" onclick="drawpage_qbank_in(' + (page - 1) + ')"><a class="page-link">' + page + '</a></li>';
                        html += '<li class="page-item active" onclick="drawpage_qbank_in(' + page + ')"><a class="page-link">' + (page + 1) + '</a></li>';
                        html += '<li class="page-item" onclick="drawpage_qbank_in(' + (page + 1) + ')"><a class="page-link">' + (page + 2) + '</a></li>';
                        html += '<li class="page-item"><a class="page-link">...</a></li>';
                        html += '<li class="page-item" onclick="drawpage_qbank_in(' + (data.num_page - 1) + ')"><a class="page-link">' + data.num_page + '</a></li>';
                    }
                    else {
                        for (i = page - 2; i < data.num_page; i++) {
                            html += '<li class="page-item';
                            if (i == page) {
                                html += " active";
                            }
                            html += '" onclick="drawpage_qbank_in(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>';
                        }

                    }
                }
            }
            $("#circularG").remove();
            $(".qbank_in").append(html);
        },
        error: function (data) {
            console.log(data);
        }
    })
}

function drawpage_qbank_not_in(page) {
    cid = $("#inf_cid_not_in").val();
    lid = $("#inf_lid_not_in").val();
    search = $("#inf_search_not_in").val();
    limit = $("#inf_limit_not_in").val();
    redraws_qbank_not_in(cid, lid, search, limit, page);
}
function drawlv_qbank_not_in(event) {
    cid = $("#inf_cid_not_in").val();
    lid = $(event).val();
    search = $("#inf_search_not_in").val();
    limit = $("#inf_limit_not_in").val();
    redraws_qbank_not_in(cid, lid, search, limit, 0);
}
function drawlimit_qbank_not_in(event) {
    cid = $("#inf_cid_not_in").val();
    lid = $("#inf_lid_not_in").val();
    search = $("#inf_search_not_in").val();
    limit = $(event).val();
    redraws_qbank_not_in(cid, lid, search, limit, 0);
}
function drawct_qbank_not_in(event) {
    cid = $(event).val();
    lid = $("#inf_lid_not_in").val();
    search = $("#inf_search_not_in").val();
    limit = $("#inf_limit_not_in").val();
    redraws_qbank_not_in(cid, lid, search, limit, 0);
}
function drawsearch_qbank_not_in(event, e) {
    cid = $("#inf_cid_not_in").val();
    lid = $("#inf_lid_not_in").val();
    limit = $("#inf_limit_not_in").val();
    if (e.keyCode == '13') {
        search = $(event).val();
        redraws_qbank_not_in(cid, lid, search, limit, 0);
    }
}
function drawsearch_qbank_btn_not_in() {
    cid = $("#inf_cid_not_in").val();
    lid = $("#inf_lid_not_in").val();
    limit = $("#inf_limit_not_in").val();
    search = $("#search_qbank_not_in").val();
    redraws_qbank_not_in(cid, lid, search, limit, 0);
}
function redraws_qbank_not_in(cid, lid, search, limit, page) {
    $("#inf_cid_not_in").val(cid);
    $("#inf_lid_not_in").val(lid);
    $("#inf_search_not_in").val(search);
    $("#inf_limit_not_in").val(limit);
    $("#inf_page_not_in").val(page);
    url = window.location.href;
    spilit_url = url.split('/');
    dt = JSON.stringify({
        'cid': cid,
        'lid': lid,
        'search': search,
        'limit': limit,
        'page': page,
    });
   
    $(".qbank_not_in").empty();
    $(".qbank_not_in").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');
    $.ajax({
        type: 'POST',
        url: site_url + "/home_user/get_data_qbank_not_in/" + spilit_url[spilit_url.length - 1],
        data: dt,
        contentType: 'application/json',
        success: function (data) {
            console.log(data);
            q = data.qbank;
            var html = '<span style="float:right; margin-bottom:10px;">';
            html += '<input id="search_qbank_not_in" style="min-width:250px;margin-top:5%" placeholder="Tìm kiếm câu hỏi" onkeyup="drawsearch_qbank_not_in(this,event)" value="' + search + '">';
            html += '<i class="pointer fa fa-search" onclick="drawsearch_qbank_btn_not_in()"></i></span>';
            html += '<table class="table table-bordered">';
            html += `
            <thead>
				<tr style="background-color: rgb(233, 235, 238);">
				<th></th>
                <th style="width: 400px;">Câu hỏi<span>
                <select style="float:right" onchange="drawlimit_qbank_not_in(this)">
            `;
            for (i = 1; i < 6; i++) {
                html += '<option value="' + i * 5 + '"';
                if (limit == i * 5) {
                    html += 'selected';
                }
                html += '> ' + i * 5 + ' mục </option>';
            }
            html += '</select></span></th>';
            html += `
            <th>
                <select style="width:95px" onchange="drawct_qbank_not_in(this)">
                <option disabled>Danh mục</option>
                <option 
            `;
            if (cid == 0) {
                html += 'selected';
            }
            html += 'value = 0> Tất cả </option>';
            for (i = 0; i < data.category_list.length; i++) {
                html += '<option ';
                if (data.category_list[i]['cid'] == cid) {
                    html += 'selected';
                }
                html += 'value = "' + data.category_list[i]['cid'] + '" >' + data.category_list[i]['category_name'] + '</option>';
            }
            html += '</select></th>';
            html += `
            <th>
				<select style="width:95px" onchange="drawlv_qbank_not_in(this)">
				<option disabled>Cấp độ</option>
				<option 
            `;
            if (lid == 0) {
                html += 'selected';
            }
            html += 'value=0> Tất cả </option>';
            for (i = 0; i < data.level_list.length; i++) {
                html += '<option ';
                if (data.level_list[i]['lid'] == lid) {
                    html += 'selected';
                }
                html += 'value ="' + data.level_list[i]['lid'] + '"> ' + data.category_list[i]['level_name'] + '</option> ';
            }
            html += '</select></th><th></th></tr></thead>';
            html += '<tbody>';
            for (i = 0; i < q.length; i++) {
                html += '<tr>';
                html += '<td onclick="change_stt_qt(this,'+ data.quiz +','+ q[i]['qid'] +')" class="details-control" style="width:30px"></td>';
                html += '<td>';
                html += ' ' + q[i]['question'] + ' ';
                html += '</td>';
                html += '<td>';
                html += ' ' + q[i]['category_name'] + ' ';
                html += '</td>';
                html += '<td>';
                html += ' ' + q[i]['level_name'] + ' ';
                html += '</td>';
                html += '<td><a class="pointer" onclick="mng_preview_qt(' + q[i]['qid'] + ')">';
                html += `
                <i class="pointer text-success fa fa-eye" title="Xem trước"></i></a></td>
				</tr>
                `;
            }
            html += '</tbody></table>';
            html += '<p>Đang xem <span id="beginqt"> ' + Math.min(data.limit * data.page + 1, data.num_qbank) + ' ';
            html += ' đến <span id="endqt">  ' + Math.min(data.limit * (data.page + 1), data.num_qbank) + ' ';
            html += 'trong tổng số <span id="totalqt"> ' + data.num_qbank + ' </span> câu hỏi<p> ';
            html += `<center>
            <ul class="pagination listpage pageqt">`;
            if (data.num_page < 7) {
                for (i = 0; i < data.num_page; i++) {
                    html += '<li class="page-item';
                    if (i == page) {
                        html += ' active';
                    }
                    html += '" onclick="drawpage_qbank_not_in(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
                }
            } else {

                if (page <= 3) {
                    for (i = 0; i < 5; i++) {
                        html += '<li class="page-item';
                        if (i == page) {
                            html += ' active';
                        }
                        html += '" onclick="drawpage_qbank_not_in(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
                    }
                    html += '<li class="page-item"><a class="page-link">...</a></li>';
                    html += '<li class="page-item" onclick="drawpage_qbank_not_in(' + (data.num_page - 1) + ')"><a class="page-link">' + data.num_page + '</a></li>';
                }
                else {
                    html += '<li class="page-item" onclick="drawpage_qbank_not_in(0)"><a class="page-link">1</a></li>';
                    html += '<li class="page-item"><a class="page-link">...</a></li>';

                    if (page < data.num_page - 4) {
                        html += '<li class="page-item" onclick="drawpage_qbank_not_in(' + (page - 1) + ')"><a class="page-link">' + page + '</a></li>';
                        html += '<li class="page-item active" onclick="drawpage_qbank_not_in(' + page + ')"><a class="page-link">' + (page + 1) + '</a></li>';
                        html += '<li class="page-item" onclick="drawpage_qbank_not_in(' + (page + 1) + ')"><a class="page-link">' + (page + 2) + '</a></li>';
                        html += '<li class="page-item"><a class="page-link">...</a></li>';
                        html += '<li class="page-item" onclick="drawpage_qbank_not_in(' + (data.num_page - 1) + ')"><a class="page-link">' + data.num_page + '</a></li>';
                    }
                    else {
                        for (i = page - 2; i < data.num_page; i++) {
                            html += '<li class="page-item';
                            if (i == page) {
                                html += " active";
                            }
                            html += '" onclick="drawpage_qbank_not_in(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>';
                        }

                    }
                }
            }
            $("#circularG").remove();
            $(".qbank_not_in").append(html);
        },
        error: function (data) {
            console.log(data);
        }
    })
}
function mng_preview_qt(qid) {
    $.ajax({
        type: "POST",
        data: {},
        url: base_url + "index.php/home_user/get_question/" + qid,
        success: function (results) {
            $("#previewquestionModal").modal();
            $("#prqt").empty();
            $("#prqt").append("Câu hỏi #" + qid);
            var q = results.data['question'];
            if (q.indexOf("<img") != -1)
                q = q.replace("<img", "<img width=240 height:160");
            if (q.indexOf("<iframe") != -1)
                q = q.replace("<iframe", "<iframe height:150");
            $("#questionp").empty();
            $("#questionp").append('<b>' + q + '</b>');
            $("#answer-areap").empty();
            opA = results.data['options'][0]['q_option'];
            opB = results.data['options'][1]['q_option'];
            opC = results.data['options'][2]['q_option'];
            opD = results.data['options'][3]['q_option'];
            if (opA.indexOf("<p>") == 0)
                opA = opA.substring(3, opA.length - 4);
            if (opB.indexOf("<p>") == 0)
                opB = opB.substring(3, opB.length - 4);
            if (opC.indexOf("<p>") == 0)
                opC = opC.substring(3, opC.length - 4);
            if (opD.indexOf("<p>") == 0)
                opD = opD.substring(3, opD.length - 4);

            var htmla = '<div class="row MB20">' +
                '<div class="col-xs-6"><div id="optAp"> A: ' + opA + '</div></div>' +
                '<div class="col-xs-6"><div id="optBp"> B: ' + opB + '</div></div>' +
                '</div>' +
                '<div class="row MB20">' +
                '<div class="col-xs-6"><div id="optCp"> C: ' + opC + '</div></div>' +
                '<div class="col-xs-6"><div id="optDp"> D: ' + opD + '</div></div>' +
                '</div>';
            $("#answer-areap").append(htmla);
            if (results.data['c_option'] == 0) {
                $('#optAp').prepend("<i class='fa fa-check-circle text-success'></i>");
                $('#optAp').attr("class", "text-success");
            }
            else if (results.data['c_option'] == 1) {
                $('#optBp').prepend("<i class='fa fa-check-circle text-success'></i>");
                $('#optBp').attr("class", "text-success");
            }
            else if (results.data['c_option'] == 2) {
                $('#optCp').prepend("<i class='fa fa-check-circle text-success'></i>");
                $('#optCp').attr("class", "text-success");
            }
            else if (results.data['c_option'] == 3) {
                $('#optDp').prepend("<i class='fa fa-check-circle text-success'></i>");
                $('#optDp').attr("class", "text-success");
            }
            var rating = 0;
            var reviewervalue = 0;
            var reviewercontent = "";
            var reid = 0;
            var reviewcount = results.review.length;
            var reviewcountstr = reviewcount + " người đã đánh giá.";
            if (results.review.length > 0) {
                for (var i = results.review.length - 1; i >= 0; i--) {
                    rating += parseInt(results.review[i].value);
                    if (results.user.uid === results.review[i].reviewer) {
                        reid = results.review[i].id;
                        reviewervalue = results.review[i].value;
                        reviewercontent = results.review[i].content;
                    }
                }
                rating = rating / results.review.length;
            }
            $("#optionareap").empty();
            var htmlo = '<table>' +
                '<tr> <td>Giải thích:</td><td style="padding:5px">' + results.data['description'] + '</td></tr>' +
                '<tr> <td>Từ khóa:</td><td style="padding:5px">' + results.data['tags'] + '</td></tr>' +
                '<tr> <td>Thời gian làm bài:</td><td style="padding:5px">' + results.data['answer_time'] + ' giây</td></tr>' +
                '<tr> <td>Đánh giá:</td><td style="padding:5px"><a href="javascript:void(0);" onmouseup="rating_item(' + qid + ', \'savsoft_qbank\',' + reid + ',' + reviewervalue + ',\'' + reviewercontent + '\');" title="' + reviewcountstr + '"><input id="rvalue" value="' + rating + '" class="rating rating-loading" data-min="0" data-max="5"  data-size="xs"/></a></td></tr>' +
                '</table>';
            $("#optionareap").append(htmlo);
            $('#rvalue').rating({ displayOnly: true, step: 1 });
            $('*').keyup(function (e) {
                if (e.keyCode == '27') {
                    $('#previewquestionModal').modal('hide');
                }
            })

        },
        error: function (xhr, status, strErr) {
            console.log(xhr);
            console.log(status);
            console.log(strErr);
        }
    });
}
function removequestion(quid, qid) {
    var formData = {
        quid: quid,
        qid: qid
    };
    $.ajax({
        type: "POST",
        data: formData,
        url: base_url + "index.php/home_user/remove_qid/" + quid + '/' + qid,
        success: function (data) {
        },
        error: function (xhr, status, strErr) {
            console.log(xhr);
            console.log(status);
            console.log(strErr);
        }
    });
}
function addquestion(quid, qid) {
    var formData = { quid: quid };
    $.ajax({
        type: "POST",
        data: formData,
        url: base_url + "index.php/quiz/add_qid/" + quid + '/' + qid,
        success: function (data) {
        },
        error: function (xhr, status, strErr) {
            console.log(xhr);
            console.log(status);
            console.log(strErr);
        }
    });
}
function change_stt_qt(event, quid,qid){
	cl=$(event).parent().attr('class');
	if(cl=="shown"){
		$(event).parent().attr('class',"");
		removequestion(quid,qid);
		pos = arr_qt.indexOf(qid);
		if(pos!=-1)
			arr_qt.splice(pos, 1);
	}
	else{
		$(event).parent().attr('class',"shown");
		addquestion(quid,qid);
		pos = arr_qt.indexOf(qid);
		if(pos==-1)
			arr_qt.push(qid);
	}
}
$(document).ready(function(){
    url = window.location.href;
    spilit_url = url.split('/');
    $('#btnCapnhat_quiz').on('click', function(e){
        if($("#inpquizname").val()!=""){
            $.ajax({
            type: "POST",
            data : $('#formEditQuiz').serialize(),
            url: base_url + "index.php/home_user/update_quiz_1/"+spilit_url[ spilit_url.length - 1 ],
            success: function(dataupd){
                alert("Sửa thành công bài kiểm tra!");
                window.location.href=site_url+"/home_user/quiz_list"
            },
            error:function(dataupd){}
              
            });
        }
        else{
            alert("Vui lòng thử lại !");
        }
    });
})