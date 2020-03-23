$(document).ready(function () {
	tinymce.init({
		menubar: false,
		statusbar: false,
		selector: '#optA,#optB,#optC,#optD',
		branding: false,
		images_dataimg_filter: function (img) {
			return img.hasAttribute('internal-blob');
		},
		min_height: 40,
		theme: 'modern',
		plugins: [
			'placeholder tiny_mce_wiris',
			'advlist autolink lists link image jbimages eqneditor charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
		],
		toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages | eqneditor tiny_mce_wiris_formulaEditor | print preview media embed | forecolor backcolor emoticons | codesample help',
		image_advtab: true,
		setup: function (theEditor) {
			theEditor.on('focus', function () {
				$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").show();
			});
			theEditor.on('blur', function () {
				$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
			});
			theEditor.on("init", function () {
				$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
			});
			theEditor.addButton('embed', {
				icon: 'embedcode',
				tooltip: "Embed",
				onclick: function () {
					theEditor.windowManager.open({
						title: 'Insert Embed Code',
						body: [
							{ type: 'textbox', name: 'text', size: '1000', autofocus: true, multiline: true, minHeight: 150, minWidth: 500, id: 'embedcodes' }
						],
						onsubmit: function (e) {
							theEditor.insertContent($('#embedcodes').val());

						}
					});
				}
			});
		}

	});

	tinymce.init({
		menubar: false,
		//statusbar: false,
		selector: 'textarea#questione,#descr',
		branding: false,
		images_dataimg_filter: function (img) {
			return img.hasAttribute('internal-blob');
		},
		height: 100,
		theme: 'modern',
		plugins: [
			'placeholder tiny_mce_wiris',
			'advlist autolink lists link image jbimages eqneditor charmap print preview hr anchor pagebreak',
			'searchreplace  visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
		],
		toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages | eqneditor tiny_mce_wiris_formulaEditor | print preview media embed | forecolor backcolor emoticons | codesample help',
		image_advtab: true,

		setup: function (theEditor) {
			theEditor.on('focus', function () {
				$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").show();
			});
			theEditor.on('blur', function () {
				$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
			});
			theEditor.on("init", function () {
				$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
			});

			theEditor.addButton('embed', {
				icon: 'embedcode',
				tooltip: "Embed",
				onclick: function () {
					theEditor.windowManager.open({
						title: 'Insert Embed Code',
						body: [
							{ type: 'textbox', name: 'text', size: '1000', autofocus: true, multiline: true, minHeight: 150, minWidth: 500, id: 'embedcodes' }
						],
						onsubmit: function (e) {
							theEditor.insertContent($('#embedcodes').val());

						}
					});
				}
			});
		}

	});


});



function remove_entry_e(redir_cont, message) {
	if (confirm("Bạn muốn xóa " + message + " này?")) {
		$.ajax({
			type: 'POST',
			url: site_url + "/" + redir_cont,
			data: {},
			contentType: 'application/json',
			success: function (data) { },
			error: function (data) { }
		});

		cid = $("#inf_cid").val();
		lid = $("#inf_lid").val();
		search = $("#inf_search").val();
		limit = $("#inf_limit").val();
		page = $("#inf_page").val();
		redrawqttbl(cid, lid, search, limit, page);


	}

}


function drawpage_mng_qt(page) {
	cid = $("#inf_cid").val();
	lid = $("#inf_lid").val();
	search = $("#inf_search").val();
	limit = $("#inf_limit").val();
	$("#go_to_page").val(page + 1);
	redrawqttbl(cid, lid, search, limit, page);
}

function drawlv_mng_qt(event) {
	cid = $("#inf_cid").val();
	lid = $(event).val();
	search = $("#inf_search").val();
	limit = $("#inf_limit").val();
	redrawqttbl(cid, lid, search, limit, 0);
}
function drawlv_mng_qt_link(lid) {
	cid = $("#inf_cid").val();
	search = $("#inf_search").val();
	limit = $("#inf_limit").val();
	redrawqttbl(cid, lid, search, limit, 0);
}

function drawct_mng_qt(event) {
	lid = $("#inf_lid").val();
	cid = $(event).val();
	search = $("#inf_search").val();
	limit = $("#inf_limit").val();
	redrawqttbl(cid, lid, search, limit, 0);
}

function drawct_mng_qt_link(cid) {
	lid = $("#inf_lid").val();
	search = $("#inf_search").val();
	limit = $("#inf_limit").val();
	redrawqttbl(cid, lid, search, limit, 0);
}
function drawlimit_mng_qt(event) {
	limit = $(event).val();
	cid = $("#inf_cid").val();
	lid = $("#inf_lid").val();
	search = $("#inf_search").val();
	redrawqttbl(cid, lid, search, limit, 0);
}
function drawgotopage_mng_qt(event, e, num_page) {
	cid = $("#inf_cid").val();
	lid = $("#inf_lid").val();
	search = $("#inf_search").val();
	limit = $("#inf_limit").val();
	if (e.keyCode == '13') {
		page = $(event).val();
		if (page < 1 || page > num_page) {
			$("#go_to_page").css("border", "solid 1px red");
			$("#go_to_page").attr("title", "Trang không tồn tại!!");
		} else {
			$("#go_to_page").css("border", "");
			$("#go_to_page").attr("title", "");
			redrawqttbl(cid, lid, search, limit, page - 1);
		}
	}
}
function drawsearch_mng_qt(event, e) {
	lid = $("#inf_lid").val();
	cid = $("#inf_cid").val();
	limit = $("#inf_limit").val();
	if (e.keyCode == '13') {
		search = $(event).val();
		redrawqttbl(cid, lid, search, limit, 0);
	}
}
function drawsearch_mng_qt_btn() {
	lid = $("#inf_lid").val();
	cid = $("#inf_cid").val();
	limit = $("#inf_limit").val();
	search = $("#search_mng_qt").val();
	redrawqttbl(cid, lid, search, limit, 0);
}
function redrawqttbl(cid, lid, search, limit, page) {

	$("#inf_cid").val(cid);
	$("#inf_lid").val(lid);
	$("#inf_search").val(search);
	$("#inf_limit").val(limit);
	$("#inf_page").val(page);
	dt = JSON.stringify({
		'cid': cid,
		'lid': lid,
		'search': search,
		'limit': limit,
		'page': page
	});
	$(".data_mngq").empty();
	$(".data_mngq").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');
	$.ajax({
		type: 'POST',
		url: site_url + "/home_user/get_data_manage_qbank/",
		data: dt,
		contentType: 'application/json',
		success: function (data) {
			console.log(data);
			q = data.questions;
			var html = ' <table class="table table-bordered"><tr style="background-color: rgb(233, 235, 238);"><th>#</th>';
			html += '<th style="width: 50%;">Câu hỏi <span><select  style="float:right" onchange="drawlimit_mng_qt(this)">';
			for (i = 3; i < 6; i++) {
				html += '<option value="' + (i * 5) + '"';
				if (limit == i * 5) {
					html += " selected";
				}
				html += '>' + (i * 5) + ' mục</option>';
			}

			html += '</select>';
			html += '</span></th><th><select style="width:85%" onchange="drawct_mng_qt(this)">';
			html += '<option disabled>Danh mục</option><option ';
			if (cid == 0)
				html += " selected ";
			html += ' value="0">Tất cả</option>';

			for (i = 0; i < data.category_list.length; i++) {
				html += '<option ';
				if (data.category_list[i]['cid'] == cid)
					html += " selected ";
				html += 'value="' + data.category_list[i]['cid'] + '">' + data.category_list[i]['category_name'] + '</option>';
			}
			html += ' </select></th><th>';
			html += '<select style="width:60%" onchange="drawlv_mng_qt(this)">';
			html += '<option disabled>Cấp độ</option><option ';
			if (lid == 0)
				html += " selected ";
			html += ' value="0">Tất cả</option>';
			for (i = 0; i < data.level_list.length; i++) {
				html += '<option';
				if (data.level_list[i]['lid'] == lid)
					html += " selected ";
				html += ' value="' + data.level_list[i]['lid'] + '">' + data.level_list[i]['level_name'] + '</option>';
			}
			html += '</select></th><th><input id="search_mng_qt" style="width:65%;margin-left: 15%" onkeyup="drawsearch_mng_qt(this,event)" value="' + search + '"> ';
			html += '<i class="pointer fa fa-search" onclick="drawsearch_mng_qt_btn()"></i></th></tr>';

			for (i = 0; i < q.length; i++) {
				html += '<tr><td>' + q[i]['qid'] + '</td>';
				html += '<td><b><a class="pointer" onclick="mng_preview_qt(' + q[i]['qid'] + ')">' + q[i]['question'] + '</a></b></td>';
				html += '<td><a class="pointer" onclick="drawct_mng_qt_link(' + q[i]['cid'] + ')">' + q[i]['category_name'] + '</a></td>';
				html += '<td><a class="pointer" onclick="drawlv_mng_qt_link(' + q[i]['lid'] + ')">' + q[i]['level_name'] + '</a></td>';
				//html+='<td><a onclick="mdr_preview_qt('+q[i]['qid']+')"><i class="pointer text-success fa fa-eye" style="margin-left: 15%;" title="Xem trước"></a>';		
				//if(q[i]['editable']==1){
				//html+='<a onclick="mng_edit_question('+q[i]['qid']+')"><i class="pointer text-warning fa fa-pencil" style="margin-left: 20%;" title="Sửa" style="color: #ef00ff;"></i></a>';		
				//html+='<a><i class="pointer fa fa-remove" style="margin-left: 20%;" onclick="delete_question_('+q[i]['qid']+')" title="Xóa"></i></a>';	
				//}
				html += '<td>';
				html += '<a onclick="mdr_preview_qt(' + q[i]['qid'] + ')"><i class="pointer text-success fa fa-eye" style="margin-left: 15%;" title="Xem trước"></i></a>';



				html += '<a onclick="mng_edit_question(' + q[i]['qid'] + ')"><i class="pointer text-warning fa fa-pencil" title="Sửa" style="color: #ef00ff;margin-left: 20%;"></i></a>';


				html += '<a><i class="pointer fa fa-remove" style="margin-left: 20%;" onclick="delete_question_(' + q[i]['qid'] + ')" title="Xóa"></i></a>';
				html += '</td></tr>';
			}
			html += "</table>";
			$(".data_mngq").append(html);
			$("#totalqt").empty();
			$("#totalqt").append(data.num_question);
			$("#beginqt").empty();
			$("#beginqt").append(Math.min(data.limit * data.page + 1, data.num_question));
			$("#endqt").empty();
			$("#endqt").append(Math.min(data.limit * (data.page + 1), data.num_question));

			$(".pageqt").empty();
			pgihtml = "";
			page = parseInt(page);
			if (data.num_page < 7) {
				for (i = 0; i < data.num_page; i++) {
					pgihtml += '<li class="page-item';
					if (i == page) {
						pgihtml += ' active';
					}
					pgihtml += '" onclick="drawpage_mng_qt(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
				}


			}
			else {
				if (page <= 3) {
					for (i = 0; i < 5; i++) {
						pgihtml += '<li class="page-item';
						if (i == page) {
							pgihtml += ' active';
						}
						pgihtml += '" onclick="drawpage_mng_qt(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
					}
					pgihtml += '<li class="page-item"><a class="page-link">...</a></li>';
					pgihtml += '<li class="page-item" onclick="drawpage_mng_qt(' + (data.num_page - 1) + ')"><a class="page-link">' + data.num_page + '</a></li>';
				}
				else {
					pgihtml += '<li class="page-item" onclick="drawpage_mng_qt(0)"><a class="page-link">1</a></li>';
					pgihtml += '<li class="page-item"><a class="page-link">...</a></li>';

					if (page < data.num_page - 4) {
						pgihtml += '<li class="page-item" onclick="drawpage_mng_qt(' + (parseInt(page) - 1) + ')"><a class="page-link">' + page + '</a></li>';
						pgihtml += '<li class="page-item active" onclick="drawpage_mng_qt(' + page + ')"><a class="page-link">' + (parseInt(page) + 1) + '</a></li>';
						pgihtml += '<li class="page-item" onclick="drawpage_mng_qt(' + (parseInt(page) + 1) + ')"><a class="page-link">' + (parseInt(page) + 2) + '</a></li>';
						pgihtml += '<li class="page-item"><a class="page-link">...</a></li>';
						pgihtml += '<li class="page-item" onclick="drawpage_mng_qt(' + (data.num_page - 1) + ')"><a class="page-link">' + data.num_page + '</a></li>';
					}
					else {
						for (i = page - 2; i < data.num_page; i++) {
							pgihtml += '<li class="page-item';
							if (i == page) {
								pgihtml += " active";
							}
							pgihtml += '" onclick="drawpage_mng_qt(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>';
						}

					}
				}
			}
			$("#circularG").remove();
			$(".pageqt").append(pgihtml);

		},
		error: function (data) {
			console.log(data);

		}
	});

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

			/*if(q.background_template!=0){
				q='<div  id="qwbgpr" style="font-size: 33px; text-align:center ;font-weight: 700;" >'
				   +'<font color="white"><div style="padding: 120px 27px;text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url(\'https://do.stem.vn/upload/background/'+q.background_template+'.jpg\'); height:300px">'+q+
				 '</div></font></div>';
			}*/
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
				//'<tr> <td>Môn học:</td><td style="padding:5px">'+dataq['category_name']+'</td></tr>'+
				//'<tr> <td>Lớp:</td><td style="padding:5px">'+dataq['level_name']+'</td></tr>'+
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

function mng_edit_question(qid) {
	$.ajax({
		type: "POST",
		data: {},
		url: base_url + "index.php/home_user/get_question/" + qid,
		success: function (results) {

			$("#editquestionModal").modal();
			cid = results.data['cid'];
			lid = results.data['lid'];


			if (results.data['fun_priory'] > 0) {
				$('#mcq_fun_e').prop('checked', true);
				$('#mcq_fun_e').val(1);
			}
			else {
				$('#mcq_fun_e').prop('checked', false);
				$('#mcq_fun_e').val(0);
			}

			if (results.data['show_logo'] > 0) {
				$('#logo_org_e').prop('checked', true);
				$('#logo_org_e').val(1);
			}
			else {
				$('#logo_org_e').prop('checked', false);
				$('#logo_org_e').val(0);
			}
			$("#qide").empty();
			$("#qide").append(qid);
			$('#mcq_fun_e').on('click', function () {
				valfp = $('#mcq_fun_e').val();
				$('#mcq_fun_e').val(1 - valfp);
			});
			$('#logo_org_e').on('click', function () {
				valfp = $(logo_org_e).val();
				$('#logo_org_e').val(1 - valfp);
			});

			var q = results.data['question'];
			var latex = "latex.codecogs.com";
			if (q.indexOf("<img") != -1) {
				if (q.includes(latex) == false) {
					q = q.replace("<img", "<img width=360 height:270");
				} else {
					q = q.replace("<img", "<img height:270");
				}
			}
			tinyMCE.get('questione').setContent(q);
		tinyMCE.get('optA').setContent(results.data['options'][0]['q_option']);
			tinyMCE.get('optB').setContent(results.data['options'][1]['q_option']);
			tinyMCE.get('optC').setContent(results.data['options'][2]['q_option']);
			tinyMCE.get('optD').setContent(results.data['options'][3]['q_option']);
			tinyMCE.get('descr').setContent(results.data['description']);

			$("#questione").val(results.data['question']);
			$("#sourcemcq_e").val(results.data['source']);

			$("#optA").val(results.data['options'][0]['q_option']);
			$("#optB").val(results.data['options'][1]['q_option']);
			$("#optC").val(results.data['options'][2]['q_option']);
			$("#optD").val(results.data['options'][3]['q_option']);
			for (i = 0; i <= 3; i++) {
				if (i == results.data['c_option'])
					$("#r" + i).prop("checked", true);

			}

			if (results.data['type'] != null) {
				for (i = 1; i < 4; i++) {
					if (i == results.data['type'])
						$("#q_type_" + i).prop("checked", true);

				}
			}

			else {
				for (i = 1; i < 4; i++) {
					$("#q_type_" + i).prop("checked", false);
				}
			}
			$("#cat" + cid).prop("selected", true);
			$("#lv" + lid).prop("selected", true);

			$("#descr").val(results.data['description']);
			$("#tags").val(results.data['tags']);
			$("#answer_timeedt").val(results.data['answer_time']);
			$("#unitmcqedt").val(results.data['unit']);
			$("#lessonmcqedt").val(results.data['lesson']);

		},
		error: function (xhr, status, strErr) {
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});
}

function get_inf_edit1() {
	qid = $("#qide").html();
	correct_opt = $('input[name=score]:checked').val();
	qt = tinyMCE.get('questione').getContent().trim().replace("<p>", "").replace("</p>", "");
	optA = tinyMCE.get('optA').getContent().trim().replace("<p>", "").replace("</p>", "");
	optB = tinyMCE.get('optB').getContent().trim().replace("<p>", "").replace("</p>", "");
	optC = tinyMCE.get('optC').getContent().trim().replace("<p>", "").replace("</p>", "");
	optD = tinyMCE.get('optD').getContent().trim().replace("<p>", "").replace("</p>", "");
	cid = $("#cide").val();
	lid = $("#lide").val();
	descr = tinyMCE.get('descr').getContent().trim().replace("<p>", "").replace("</p>", "");
	tags = $('#tags').val().trim();
	answer_time = $('#answer_timeedt').val().trim();
	unit = $('#unitmcqedt').val().trim();
	lesson = $('#lessonmcqedt').val().trim();
	$("#logo_org_e").click(function () {
		$("#logo_org_e").val(1 - $("#logo_org_e").val());
	});
	$("#mcq_fun_e").click(function () {
		$("#mcq_fun_e").val(1 - $("#mcq_fun_e").val());
	});
	fp = $("#mcq_fun_e").val();
	sl = $("#logo_org_e").val();
	source = $("#sourcemcq_e").val();
	type = $('input[name=q_type]:checked').val();
	dataqe = JSON.stringify({
		'qid': qid,
		'question': qt,
		'opt0': optA,
		'opt1': optB,
		'opt2': optC,
		'opt3': optD,
		'cid': cid,
		'lid': lid,
		'description': descr,
		'tags': tags,
		'answer_time': answer_time,
		'fp': fp,
		'sl': sl,
		'correct_opt': correct_opt,
		"source": source,
		"unit": unit,
		"lesson": lesson,
		'type': type
	});
	$.ajax({
		type: 'POST',
		url: site_url + "/qbank/edit_question_0/",
		data: dataqe,
		contentType: 'application/json',
		success: function (data) {
			console.log(data);
			$('#editquestionModal').modal('hide');
			lid = $("#inf_lid").val();
			cid = $("#inf_cid").val();
			limit = $("#inf_limit").val();
			search = $("#inf_search").val();
			page = $("#inf_page").val();
			redrawqttbl(cid, lid, search, limit, page);
		},
		error: function (data) {


		}
	});

}
function delete_question_(qid) {
	console.log(qid);
	if (confirm('Bạn có muốn xóa câu hỏi?')) {
		$.ajax({
			type: 'POST',
			url: site_url + "/qbank/delete_question/" + qid,
			data: {},
			contentType: 'application/json',
			success: function (data) {
				$("#ques_" + qid).attr('style', "display:none");
			},
			error: function (data) {


			}
		});
	}
}