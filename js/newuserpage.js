$(document).ready(function () {
    /*$.ajax({
		  type: 'POST',
		  url: site_url+"/event_racing/summary/",
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {			 
		  },
		  error: function(data) {			  
		  }
	 });
	 */
	if (window.location.hash) {
		check_load_more = false;
	}
	else {
		check_load_more = true;
	}



	resize_opt1($("#qiq_0"));



	$('#carousel1').on('slid.bs.carousel', function (e) {
		index = $('div.item.active').index();
		index_mobile = index + count_question;
		// console.log(index);''
		qid = $("#qiq_" + index).find(".ol_opt").attr('id').replace('ol_opt-', '');
		if (qid) {
			loadoption(qid, index, count_question);
		}
		$(".carousel-Quizz>li").each(function (e) { $(this).attr("class", "") });
		$("#car_index_qt_" + index).attr("class", "ftsz-25-fix");
		$("#car_index_qt_" + index_mobile).attr("class", "ftsz-25-fix");
		// resize_opt1($("#qiq_"+index));
	});
	$("#welcome_modal").modal();
	$("#update_email_modal").modal();
	if (!$("#welcome_modal").length) {
		$("#interest_modal").modal({
			backdrop: 'static'
		});
	}
	else {
		$('#welcome_modal').on('hidden.bs.modal', function () {
			$("#interest_modal").modal({
				backdrop: 'static'
			});
		});
	}

	$('.modal').on('show.bs.modal', function () {
		check_load_more = false;
		$(".ul-mobile").attr("style", "display:none");



	});



	$('.modal').on('hide.bs.modal', function () {
		check_load_more = true;
		$(".ul-mobile").attr("style", "");
	});

	tinymce.init({
		menubar: false,
		statusbar: false,
		selector: 'input#opt_crq_x0,input#opt_crq_x1,input#opt_crq_x2,input#opt_crq_x3',
		branding: false,
		images_dataimg_filter: function (img) {
			return img.hasAttribute('internal-blob');
		},
		min_height: 30,
		theme: 'modern',
		plugins: [
			'placeholder tiny_mce_wiris',

		],
		toolbar1: 'tiny_mce_wiris_formulaEditor',
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

		}

	});

	tinymce.init({
		menubar: false,
		statusbar: false,
		selector: 'textarea#descr_main',
		branding: false,
		auto_focus: "descr1",
		images_dataimg_filter: function (img) {
			return img.hasAttribute('internal-blob');
		},

		height: 250,
		theme: 'modern',
		plugins: [
			'tiny_mce_wiris',
			'advlist autolink lists link image jbimages eqneditor charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
		],
		toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages | eqneditor tiny_mce_wiris_formulaEditor | print preview media embed  | forecolor backcolor emoticons | codesample help',
		image_advtab: true,
		setup: function (editor) {

			editor.addButton('embed', {
				icon: 'embedcode',
				tooltip: "Embed",
				onclick: function () {
					editor.windowManager.open({
						title: 'Insert Embed Code',
						body: [
							{ type: 'textbox', name: 'text', size: '1000', autofocus: true, multiline: true, minHeight: 150, minWidth: 500, id: 'embedcodes' }
						],
						onsubmit: function (e) {
							editor.insertContent($('#embedcodes').val());

						}
					});
				}
			});
		}

	});
	$(".searchbt").on('click', function (e) {
		if ($(window).width() > 767) {
			s = $("#inpsearch_top_dt").val();
		}
		else {

			s = $("#inpsearch_top").val();
		}
		while (s.indexOf("+") > -1)
			s = s.replace("+", "%2B");
		while (s.indexOf(" ") > -1)
			s = s.replace(" ", "+");
		new_url = encodeURI(updateQueryStringParameter(site_url + '/home_user', 'search', s));
		window.location.assign(new_url);


	});


	$(".div_opt").each(function () {
		resize_opt(this);
	});

	$("#xctbt").on('click', function (e) {
		$("#resinfo").attr("style", "display:none");
		$("#rsct").attr("style", "");
		$("#resultbyeach").show();
	})
	$(".backbtrs").on('click', function (e) {
		$("#resinfo").attr("style", "background-image:url('https://stemup.app/images/result_bg.jpg');background-size:cover;font-size:18px;padding:40px;color:#ffffff;min-height:540px;");
		$("#rsct").attr("style", "margin-top:40px");
		$("#resultbyeach").hide();
	});
	if ($(window).width() > 767) {
		$(".mcq_multimd2").attr("style", "font-size:17px;font-weight:700");
	}

	if ($(window).width() < 767) {
		$(".mcq_multimd2").attr("style", "font-size:14px!important;font-weight:700");
	}


	$("#create_question_main").on('click', function () {
		$(this).prev().attr("style", "display:none");
		$("#collapse_qt_box").show();
		tinymce.init({
			menubar: false,
			statusbar: false,
			selector: 'textarea#create_question_main',
			branding: false,
			auto_focus: "create_question_main",
			images_dataimg_filter: function (img) {
				return img.hasAttribute('internal-blob');
			},
			init_instance_callback: function (editor) {
				editor.on('change', function (e) {
					$("#loadopt").attr("style", "display:none");
					checksim2 = true;
					similar2 = false;
				});


			},
			height: 150,
			theme: 'modern',
			plugins: [
				'placeholder tiny_mce_wiris',
				'advlist autolink lists link image jbimages eqneditor charmap print preview hr anchor pagebreak',
				'searchreplace wordcount visualblocks visualchars code fullscreen',
				'insertdatetime media nonbreaking save table contextmenu directionality',
				'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
			],
			toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages | eqneditor tiny_mce_wiris_formulaEditor | print preview media embed  | forecolor backcolor emoticons | codesample help',
			image_advtab: true,
			setup: function (editor) {

				editor.addButton('embed', {
					icon: 'embedcode',
					tooltip: "Embed",
					onclick: function () {
						editor.windowManager.open({
							title: 'Insert Embed Code',
							body: [
								{ type: 'textbox', name: 'text', size: '1000', autofocus: true, multiline: true, minHeight: 150, minWidth: 500, id: 'embedcodes' }
							],
							onsubmit: function (e) {
								editor.insertContent($('#embedcodes').val());

							}
						});
					}
				});
			}

		});

		checksim2 = true;
		similar2 = false;
		$("#opt_crq_0,#opt_crq_1,#opt_crq_2,#opt_crq_3").on('click', function (e) {

			content = tinyMCE.get('create_question_main').getContent().trim();
			content = content.replace(/<\/?[^>]+(>|$)/g, "");
			content = content.replace("?", "");
			//console.log(content);
			if (content == "") {
				alert("Vui lòng nhập câu hỏi trước")
			}
			else
				sim2(content.trim(), 200);

		});
		$("[name=score]").on('change', function (e) {

			content = tinyMCE.get('create_question_main').getContent().trim();
			content = content.replace(/<\/?[^>]+(>|$)/g, "");
			content = content.replace("?", "");
			$("#loadopt").prop('disabled', false);
			if (content == "") {
				alert("Vui lòng nhập câu hỏi trước")
			}
			else
				sim2(content.trim(), 200);

		});
	});

	$(".optvalmb").attr("onclick", "check_answered(this)");

	$("#cancel_btn_crmain").on("click", function () {
		$("#collapse_opt_box").hide();
		$("#collapse_qt_box").hide();
		$(this).parent().parent().parent().find(".input-group-addon").attr("style", "")
		tinymce.remove("textarea#create_question_main");
		$("#create_question_main").val("");
		$("#opt_crq_0").val("");
		$("#opt_crq_1").val("");
		$("#opt_crq_2").val("");
		$("#opt_crq_3").val("");
		$("[name=score]").attr("checked", false);
		$("#mcq_fun_main").attr("checked", false);
		$("#main_logorg").attr("checked", true);
		$("#sl_categ_main").val("");
		$("#sl_level_main").val("");
		$("#descr_main").val("");
		$("#tags_main").val("");
		$("#time_main").val(60);
		$("#bgqid_main").val(0);
		if ($("#sqmain").length) {
			$("#sqmain").remove();
			$(this).parent().prepend('<button type="button" class="btn btn-primary" onclick="load_opt_main(this)">Lưu</button>');

		}

	});
	$("#mcq_fun_main").on('change', function () {
		mfp = parseInt($(this).val());
		$(this).val(1 - mfp);
	})

	$("#main_logorg").on('change', function () {
		mfp = parseInt($(this).val());
		$(this).val(1 - mfp);
	})

	$(".mcq_multimd,.mcq_multimd2").find("h1,h2,h3,h4,h5,h6").each(function () {
		if (window.screen.width > 767)
			$(this).attr("style", "font-size: 17px;font-weight: 600!important; ");
		else
			$(this).attr("style", "font-size: 14px!important;font-weight: 600!important; ");
	});


	//load more
	var lastScrollTop = 0;
	check_load_more = true;
	$(window).scroll(function (event) {
		st = $(this).scrollTop();
		if (st > lastScrollTop) {
			distance = $("footer").height() + 1050;

			if ($(window).width() < 767) {
				distance += $("aside.rightbar").height() + 1050;
			}
			if ($(window).scrollTop() >= $(document).height() - distance) {

				if (check_load_more)

					if (id_mcq_fun != "") {
						ar_fun = id_mcq_fun.split(",", 5);
						for (i = 0; i < ar_fun.length; i++) {

							id_mcq_fun = id_mcq_fun.replace(ar_fun[i] + ",", "").replace(ar_fun[i], "");
						}

						load_more_mcq_quiz_fun();
					}


			}
		}
		lastScrollTop = st;
	})
});

function load_opt_main(event) {
	$("#collapse_opt_box").show();
	$(event).remove();
	$("#cancel_btn_crmain").parent().prepend('<button type="submit" class="btn btn-primary" id="sqmain">Lưu</button>');
}

function answer_qt(qid, ans) {
	$.ajax({
		type: 'POST',
		url: site_url + "/qbank/answer_mcq/",
		data: JSON.stringify({ 'qid': qid, 'ans': ans }),
		contentType: 'application/json',
		success: function (data) {
			$("#result_answer_qt").modal({
				//backdrop:'static'
			});


			if (ans == data['correct']) {
				$("#result_answer_qt_true").modal({
					//backdrop:'static'
				});
				$("#correct_ans_tr").empty();

				$("#correct_ans_tr").append(String.fromCharCode(65 + parseInt(data['correct'])) + ": " + data['options'][data['correct']]['q_option'].replace(/<\/?[^>]+(>|$)/g, ""));
			}
			else {
				$("#result_answer_qt_false").modal({
					//backdrop:'static'
				});
				$("#correct_ans_fs").empty();
				$("#correct_ans_fs").append(String.fromCharCode(65 + parseInt(data['correct'])) + ": " + data['options'][data['correct']]['q_option'].replace(/<\/?[^>]+(>|$)/g, ""));

			}
		},
		error: function (data) { }
	});
}

function like_question(event, qid) {
	$.ajax({
		type: 'POST',
		url: site_url + "/qbank/like/",
		data: JSON.stringify({ 'qid': qid }),
		contentType: 'application/json',
		success: function (data) {
			//console.log(data);

			if ($(event).attr("class") == 'btnlike acti pointer') {
				$(event).attr("class", 'btnlike pointer');
				$(".moremcq_" + qid).find('.btnlike').attr("class", 'btnlike pointer');
				if (data.n_like > 0) {
					$("#like_statistic_" + qid).find('a').empty();
					$("#like_statistic_" + qid).find('a').append(data.n_like + " người");
					$(".moremcq_" + qid).find('.text_lst').empty();
					$(".moremcq_" + qid).find('.text_lst').append(data.n_like + " người");
				}
				else {
					$("#like_statistic_" + qid).empty();
					$(".moremcq_" + qid).find("#like_statistic_" + qid).empty();
				}
			}
			else {
				$(event).attr("class", 'btnlike acti pointer');
				$(".moremcq_" + qid).find('.btnlike').attr("class", 'btnlike acti pointer');
				if (!$("#like_statistic_" + qid + ">div").length) {
					html_st = '<div class="col-xs-12 bo-B" >' +
						'<i style="width:20px" class="fas fa-thumbs-up mr-5 bo-tron bg-primary"></i>' +
						'<a class="f10" href="#">';
					if (data.n_like > 0) {
						html_st += 'Bạn và ' + data.n_like + ' người</a> </div>';
					}
					else {
						html_st += data.user_name + '</a> </div>';
					}
					$("#like_statistic_" + qid).append(html_st);
					//$(".moremcq_"+qid).find("#like_statistic_"+qid).append(html_st);
				}
				else {
					$("#like_statistic_" + qid).find('a').empty();
					st = "Bạn";
					if (data.n_like > 0)
						st += ' và ' + data.n_like + ' người';
					$("#like_statistic_" + qid).find('a').append(st);
					$(".moremcq_" + qid).find('.text_lst').empty();
					$(".moremcq_" + qid).find('.text_lst').append(st);
				}

			}
		},
		error: function (data) {

		}
	});

}
function like_quiz(event, quid) {
	$.ajax({
		type: 'POST',
		url: site_url + "/quiz/like/",
		data: JSON.stringify({ 'quid': quid }),
		contentType: 'application/json',
		success: function (data) {
			//console.log(data);
			if ($(event).attr("class") == 'acti pointer') {
				$(event).attr("class", 'pointer');
				if (data.n_like > 0) {
					$("#like_statistic_quiz_" + quid).find('a').empty();
					$("#like_statistic_quiz_" + quid).find('a').append(data.n_like + " người");
				}
				else {
					$("#like_statistic_quiz_" + quid).empty();
				}
			}
			else {
				$(event).attr("class", 'acti pointer');

				if (!$("#like_statistic_quiz_" + quid + ">div").length) {
					html_st = '<div class="col-xs-12 bo-B" >' +
						'<i style="width:20px" class="fas fa-thumbs-up mr-5 bo-tron bg-primary"></i>' +
						'<a class="f10" href="#">';
					if (data.n_like > 0) {
						html_st += 'Bạn và ' + data.n_like + ' người</a> </div>';
					}
					else {
						html_st += data.user_name + '</a> </div>';
					}
					$("#like_statistic_quiz_" + quid).append(html_st);
				}
				else {
					$("#like_statistic_quiz_" + quid).find('a').empty();
					st = "Bạn";
					if (data.n_like > 0)
						st += ' và ' + data.n_like + ' người';
					$("#like_statistic_quiz_" + quid).find('a').append(st);
				}

			}
		},
		error: function (data) {

		}
	});

}
function load_more_mcq_quiz_fun() {

	check_load_more = false;
	ar_str = "";
	ar_fun = [];
	if (id_mcq_fun != "") {
		ar_fun = id_mcq_fun.split(",", 5);
		for (i = 0; i < ar_fun.length; i++) {
			id_mcq_fun = id_mcq_fun.replace(ar_fun[i] + ",", "").replace(ar_fun[i], "");
			if (i > 0)
				ar_str += "," + ar_fun[i];
			else
				ar_str += ar_fun[i];
		}
		if (id_quiz_fun != "") {
			ar_quiz_fun = id_quiz_fun.split(",", 1);
			dt = JSON.stringify({ 'qids': ar_str, 'quid': ar_quiz_fun[0] });
			id_quiz_fun = id_quiz_fun.replace(ar_quiz_fun[0] + ",", "").replace(ar_quiz_fun[0], "");
		}
		else
			dt = JSON.stringify({ 'qids': ar_str });

		$(".show_more_mcq").parent().append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');



		$.ajax({
			type: 'POST',
			url: site_url + "/qbank/get_question_block/",
			data: dt,
			contentType: 'application/json',
			success: function (data) {
				//console.log(data);
				$("#circularG").remove();
				$(".show_more_mcq").parent().append(data.html);



				for (idx = 0; idx < ar_fun.length; idx++) {
					$(".moremcq_" + ar_fun[idx]).find(".div_opt").each(function () {
						resize_opt(this);
					});
				}
				$('.modal').on('show.bs.modal', function () {
					check_load_more = false;
					$(".ul-mobile").attr("style", "display:none");
				});

				$('.modal').on('hide.bs.modal', function () {
					check_load_more = true;
					$(".ul-mobile").attr("style", "");
				});

				$(".optvalmb").attr("onclick", "check_answered(this)");
				$(".mcq_multimd").find("h1,h2,h3,h4,h5,h6").each(function () {
					if ($(window).width() > 767)
						$(this).attr("style", "font-size: 17px;font-weight: 600!important; ");
					else
						$(this).attr("style", "font-size: 14px!important;font-weight: 600!important; ");
				});


				check_load_more = true;
			},
			error: function (data) {
				console.log(data);

			}
		});

	}




}

function see_more_descr(event) {
	$(event).parent().find(".three_dotcomma").attr("style", "display:none;");
	$(event).parent().find(".more_descr").attr("style", "");
	$(event).attr("style", "display:none;");
}

function write_comment(event, e, model, wall_id) {

	if (e.keyCode == '13') {
		cm = $(event).val();
		if (cm != "") {
			$.ajax({
				type: 'POST',
				url: site_url + "/comment/write/" + model + "/" + wall_id,
				data: JSON.stringify({ 'content': cm }),
				contentType: 'application/json',
				success: function (data) {
					$(event).val("");
					var cmthtml = '<div class="media">' +
						'<div class="media-left">' +
						'<a href="#">';
					if (data['photo'])
						cmthtml += '<img class="media-object img-circle" src="' + data['photo'] + '" width="36" alt="placeholder image">';
					else
						cmthtml += '<img class="media-object img-circle" src="' + base_url + 'upload/avatar/default.png" width="36" alt="placeholder image">';
					cmthtml += '</a>' +
						'</div>' +
						'<div class="media-body">' +
						'<h4 class="media-heading"><a href="">' + data['user_name'] + '</a></h4>' + cm +
						//'<p class="text-small1">'+
						//'<a class="mr-23" href="">Thích</a>'+
						//'<a class="mr-23" href="">Trả lời</a> - Vừa xong'+
						//'</p>'+
						'</div>' +
						'</div>';
					if (model == 'qbank') {
						$("#box_comment_" + wall_id + ">.media-object-default").prepend(cmthtml);
					}
					else if (model == 'quiz') {
						$("#box_comment_quiz_" + wall_id + ">.media-object-default").prepend(cmthtml);
					}
				},
				error: function (data) {
					console.log(data);
				}

			});
		}
	}
}

function save_edit_qt(qid) {
	qt = tinyMCE.get('questione').getContent();
	optA = $("#optA").val();
	optB = $("#optB").val();
	optC = $("#optC").val();
	optD = $("#optD").val();
	cropt = document.querySelector('input[name="score"]:checked').value;
	cid = $("#cidedt").val();
	lid = $("#lidedt").val();
	des = $("#descredt").val();
	tags = $("#tagsedt").val();;
	ans_time = $("#answer_timeedt").val();

}
function resize_opt(event) {
	if ($(window).width() > 767) {

		max_size = 0;
		$(event).find(".optvalmb").each(function () {
			val = $(this).html();
			if (val.indexOf("<img") != -1) max_size = 60;
			c_size = $(this)[0].scrollHeight;
			if (c_size > max_size) {
				max_size = c_size;
			}
		})
		$(event).find(".optvalmb").each(function () {

			$(this).height(max_size + 5);
		});
		$(event).find(".optradio_main").each(function () {
			$(this).attr("style", "transform:translate(-20px," + ((max_size - 10) / 2) + "px); z-index:7;");
		});

		$(event).find("tr").each(function () {
			$(this).attr("valign", "center");
			$(this).attr("style", "height:" + (max_size - 10) + "px");
		});


	}
	else {

		$(event).find(".optvalmb").each(function () {
			val = $(this).html();
			if (val.indexOf("<img") != -1)
				$(this).height(60);
			else
				$(this).height($(this)[0].scrollHeight);
		});

		$(event).find(".optradio_main").each(function () {

			$(this).attr("style", "transform:translate(20px," + (($(this).next().height() - 36) / 2) + "px); z-index:7; margin-top:10px!important");
		});

	}
}
function resize_opt1(event) {
	if ($(window).width() > 767) {

		max_size = 0;
		$(event).find(".optvalmb").each(function () {
			val = $(this).html();
			if (val.indexOf("<img") != -1) max_size = 60;
			c_size = $(this)[0].scrollHeight - 10;

			if (c_size > max_size) {
				max_size = c_size;
			}
		})

		$(event).find(".optvalmb").each(function () {
			$(this).height(max_size + 5);
		});
		$(event).find(".optradio_main").each(function () {
			$(this).attr("style", "transform:translate(-20px," + ((max_size - 10) / 2) + "px); z-index:7;display:none");
		});

		$(event).find("tr").each(function () {
			$(this).attr("valign", "center");
			$(this).attr("style", "height:" + (max_size - 10) + "px");
		});


	}
	else {
		$(event).find(".optvalmb").each(function () {
			val = $(this).html();
			if (val.indexOf("<img") != -1)
				$(this).height(60);
			else
				$(this).height($(this)[0].scrollHeight);
		});

		$(event).find(".optradio_main").each(function () {

			$(this).attr("style", "transform:translate(20px," + (($(this).next().height() - 30) / 2) + "px); z-index:7; margin-top:10px!important;display:none");
		});


	}
}
function updateQueryStringParameter(uri, key, value) {
	var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
	var separator = uri.indexOf('?') !== -1 ? "&" : "?";
	if (uri.match(re)) {
		return uri.replace(re, '$1' + key + "=" + value + '$2');
	}
	else {
		return uri + separator + key + "=" + value;
	}
}

function search_question(event, e) {
	if (e.keyCode == '13') {
		s = $(event).val();
		while (s.indexOf("+") > -1)
			s = s.replace("+", "%2B");
		while (s.indexOf(" ") > -1)
			s = s.replace(" ", "+");
		new_url = encodeURI(updateQueryStringParameter(site_url + '/home_user', 'search', s));
		window.location.assign(new_url);
	}
}

function dismiss_modal(e) {
	$(e).modal('hide');
}

function alert_msg() {
	alert('Vui lòng đăng nhập hoặc tạo tài khoản!');
}

function count_share(qid) {
	$.ajax({
		type: 'POST',
		url: site_url + "/api/count_share/",
		data: JSON.stringify({ 'qid': qid }),
		contentType: 'application/json',
		success: function (data) {

		},
		error: function (data) {


		}
	});
}

function count_share2(quid) {
	$.ajax({
		type: 'POST',
		url: site_url + "/api/count_share2/",
		data: JSON.stringify({ 'quid': quid }),
		contentType: 'application/json',
		success: function (data) {
		},
		error: function (data) {


		}
	});
}

function get_inf_edit() {
	qid = $("#qide").html();
	correct_opt = $('input[name=score]:checked').val();
	qt = tinyMCE.get('questione').getContent().trim();
	optA = tinyMCE.get('optA').getContent().trim();
	optB = tinyMCE.get('optB').getContent().trim();
	optC = tinyMCE.get('optC').getContent().trim();
	optD = tinyMCE.get('optD').getContent().trim();
	cid = $("#cide").val();
	lid = $("#lide").val();
	descr = tinyMCE.get('descr').getContent().trim();
	tags = $('#tags').val().trim();
	answer_time = $('#answer_timeedt').val().trim();
	fp = $('#mcq_fun_e').val();
	sl = $('#logo_org_e').val();
	source = $("#sourcemcq_e").val();
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
		"source": source
	});
	$.ajax({
		type: 'POST',
		url: site_url + "/qbank/edit_question_0/",
		data: dataqe,
		contentType: 'application/json',
		success: function (data) {
			console.log(data);
			$('#editquestionModal').modal('hide');

		},
		error: function (data) {


		}
	});

}

function show_question(qid) {
	$("#lqtmodal").modal();
	var puq = $(".moremcq_" + qid).html().replace("bgqtdiv", "bgqtdiv1");

	$("#lqtmodal-content").empty();
	$("#lqtmodal-content").append('<div class="box-bor1" style="inline-block" >' + puq + '</div>');
	var qt = $(".hiddenlqt").html();
	$(".bgqtdiv1").parent().append(qt);

	$("#lqtmodal").find(".imgwlogo").remove();
	$(".bgqtdiv1").remove();
	$("#lqtmodal").find(".optradio_main").each(function () {
		$(this).attr("onclick", " answer_qt2(this)");
	});

}

function answer_qt2(event) {
	qid = $(event).attr("name").replace("opt_main_", "");
	ans = $(event).val();
	/*if($('#carousel1').length){
		$('#carousel1').carousel("next");
		indexqt=$(event).attr("id").replace("answer_value","").split("-")[0];
		$('#carousel1').carousel("next");
		$("#car_index_qt_"+indexqt).attr("style","background-color:green; color:white");
		$("#car_index_qt2_"+indexqt).attr("style","background-color:green; color:white");
	}*/
	$(".bd-example-modal-lg").modal();
	$.ajax({
		type: 'POST',
		url: site_url + "/qbank/check_answered/" + qid,
		data: {},
		contentType: 'application/json',
		success: function (data) {
			$(".bd-example-modal-lg").modal('hide');
			if (!data) {
				$("#complete_answer").modal({
					//backdrop:'static'
				});


				$(".opt_choice").empty();
				$(".opt_choice").append(" " + String.fromCharCode(65 + parseInt(ans)) + " ");
				$("#confirm_answer").attr("onclick", "answer_qt(" + qid + "," + ans + ")");
			}

			else {
				$("#answered").modal({
					//backdrop:'static'
				});

				result_answered = 'Phương án bạn chọn là ' + String.fromCharCode(65 + parseInt(data['option_choice']));
				result_answered += '. Đáp án đúng là: ' + String.fromCharCode(65 + parseInt(data['option_correct'])) + ".";
				$("#result_answered").empty();
				$("#result_answered").append(result_answered);
			}
		},
		error: function (data) {

		},
	});
}

function check_answered(event) {
	qid = $(event).parent().prev().attr("name").replace("opt_main_", "");
	ans = $(event).parent().prev().val();
	$(event).parent().parent().find(".optradio_main").attr("checked", true);
	$(".bd-example-modal-lg").modal();

	$.ajax({
		type: 'POST',
		url: site_url + "/qbank/check_answered/" + qid,
		data: {},
		contentType: 'application/json',
		success: function (data) {
			$(".bd-example-modal-lg").modal('hide');
			if (!data) {
				$("#complete_answer").modal({
					// backdrop:'static'
				});

				$(".opt_choice").empty();
				$(".opt_choice").append(" " + String.fromCharCode(65 + parseInt(ans)) + " ");
				$("#confirm_answer").attr("onclick", "answer_qt(" + qid + "," + ans + ")");
			}

			else {
				$("#answered").modal({
					//backdrop:'static'
				});
				result_answered = 'Phương án bạn chọn là ' + String.fromCharCode(65 + parseInt(data['option_choice']));
				result_answered += '. Đáp án đúng là: ' + String.fromCharCode(65 + parseInt(data['option_correct'])) + ".";
				$("#result_answered").empty();
				$("#result_answered").append(result_answered);
			}
		},
		error: function (data) {

		},
	});
}

function sendemail_changepassword() {
	$.ajax({
		type: "POST",
		data: { type: "change_password" },
		url: base_url + "index.php/send_email/",
		success: function (results) {

		},
		error: function (xhr, status, strErr) {
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});
}

function sendemail_signup() {
	$.ajax({
		type: "POST",
		data: { type: "signup" },
		url: base_url + "index.php/send_email/",
		success: function (results) {

		},
		error: function (xhr, status, strErr) {
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});
}

function validate_email(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(String(email).toLowerCase());
}
function update_email2() {
	email = $("#upd_email").val();
	if (validate_email(email)) {
		$.ajax({
			type: "POST",
			data: { email: email },
			url: base_url + "index.php/user/update_email",
			success: function (results) {
				$("#update_email_modal").modal("hide");
				alert("Cập nhật thành công!");
			},
			error: function (xhr, status, strErr) {
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}
		});
	}
	else {
		$("#errmsg_upde").empty();
		$("#errmsg_upde").append("Email không đúng!");
	}

}