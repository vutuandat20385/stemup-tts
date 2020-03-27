function drawpage_mng_user(page) {
	uid = $("#inf_uid").val();
	su = $("#inf_su").val();
	search = $("#inf_search").val();
	limit = $("#inf_limit").val();
	$("#go_to_page").val(page + 1);
	redrawusertbl(uid, su, search, limit, page);
}

// function drawlv_mng_user_link(su) {
// 	uid = $("#inf_uid").val();
// 	search = $("#inf_search").val();
// 	limit = $("#inf_limit").val();
// 	redrawusertbl(uid, su, search, limit, 0);
// }
function drawlimit_mng_user(event) {
	limit = $(event).val();
	uid = $("#inf_uid").val();
	su = $("#inf_su").val();
	search = $("#inf_search").val();
	redrawusertbl(uid, su, search, limit, 0);
}

function drawct_mng_user(event) {
	su = $(event).val();
	uid = $("#inf_uid").val();
	search = $("#inf_search").val();
	limit = $("#inf_limit").val();
	redrawusertbl(uid, su, search, limit, 0);
}

function drawsearch_mng_user(event, e) {
	uid = $("#inf_uid").val();
	su = $("#inf_su").val();
	limit = $("#inf_limit").val();
	if (e.keyCode == '13') {
		search = $(event).val();
		redrawusertbl(uid, su, search, limit, 0);
	}
}

function drawsearch_mng_user_btn() {
	uid = $("#inf_uid").val();
	su = $("#inf_su").val();
	limit = $("#inf_limit").val();
	search = $("#search_mng_user").val();
	redrawusertbl(uid, su, search, limit, 0);
}

function redrawusertbl(uid, su, search, limit, page) {

	$("#inf_uid").val(uid);
	$("#inf_su").val(su);
	$("#inf_search").val(search);
	$("#inf_limit").val(limit);
	$("#inf_page").val(page);
	dt = JSON.stringify({
		'uid': uid,
		'su': su,
		'search': search,
		'limit': limit,
		'page': page
	});
	$(".data_mngq").empty();
	$(".data_mngq").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');
	$.ajax({
		type: 'POST',
		url: site_url + "/admin/get_data_user/",
		data: dt,
		contentType: 'application/json',
		success: function (data) {
			console.log(data);
			q = data.users;
			var html = '<div style="float: right">';
			html += '<a class="btn btn-primary" data-toggle="modal" data-target="#add-user" href="" role="button">Thêm</a>';
			html += '</div >';
			html += '<div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="add-userLabel" aria-hidden="true">';
			html += '<div class="modal-dialog" role="document">';
			html += '<div class="modal-content">';

			html += '<div class="modal-header">';
			html += '<button type="button" class="close" data-dismiss="modal">&times;</button>';
			html += '<h4 class="modal-title">Thêm tài khoản #<span id="qide"><span></h4>';
			html += '</div>';
			html += '<div class="modal-body">';
			html += '<div style="color: red;" id="msg-err"></div>';
			html += '<form action="" method="post">';
			html += '<div class="form-group">';
			html += '<label for="email">Email: </label>';
			html += '<input type="email" class="form-control" name="email" id="email" required >';
			html += '</div>';
			html += '<div class="form-group">';
			html += '<label for="password">Password: </label>';
			html += '<input type="password" class="form-control" name="password" required id = "password" placeholder = "Password" >';
			html += '</div>';
			html += '<div class="form-group">';
			html += '<label for="first_name">Tên người dùng: </label>';
			html += '<input type="text" class="form-control" name="first_name" required id="first_name">';
			html += '</div>';
			html += '<label>Quyền hạn: </label>';
			html += '<div class="form-check form-check-inline">';
			html += '<input checked class="form-check-input" name="su" id="su" type="radio" value="10">';
			html += '<label class="form-check-label">Cộng tác viên</label>';
			html += '<input style="margin-left: 10px;" class="form-check-input" type="radio" name="su" id="su" value="1">';
			html += '<label class="form-check-label">Admin</label>';
			html += '</div>';
			html += '</form>';
			html += '</div>';
			html += '<div class="modal-footer">';
			html += '<input class="btn btn-success" type="submit" onclick="add_user()" value="Xác nhận" />';
			html += '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
			html += '</div>';

			html += '</div>';
			html += '</div>';
			html += '</div>';
			html += ' <table class="table table-bordered" style="background: #fff;"><tr style="background-color: rgb(233, 235, 238);"><th>#</th>';
			html += '<th style="width: 50%;">Email <span><select style="float:right" onchange="drawlimit_mng_user(this)">';
			for (i = 3; i < 6; i++) {
				html += '<option value="' + (i * 5) + '"';
				if (limit == i * 5) {
					html += " selected";
				}
				html += '>' + (i * 5) + ' mục</option>';
			}
			html += '<th>Tên người dùng</th>';
			html += '</select>';
			html += '</span></th><th><select style="width:85%" onchange="drawct_mng_user(this)">';
			html += '<option disabled>Danh mục</option>';
			if (su == 0) {
				html += '<option selected value="0">Tất cả</option>';
				html += '<option value="1">Admin</option>'
				html += '<option value="10">Cộng tác viên</option>'
			} else if (su == 1) {
				html += '<option value="0">Tất cả</option>'
				html += '<option selected value="1">Admin</option>';
				html += '<option value="10">Cộng tác viên</option>'
			} else if (su == 10) {
				html += '<option value="0">Tất cả</option>'
				html += '<option value="1">Admin</option>'
				html += '<option selected value="10">Cộng tác viên</option>';
			}
			html += '</select></th><th><input id="search_mng_user" style="width:65%;margin-left: 15%" onkeyup="drawsearch_mng_user(this,event)" value="' + search + '"> ';
			html += '<i class="pointer fa fa-search" onclick="drawsearch_mng_user_btn()"></i></th></tr>';

			for (i = 0; i < q.length; i++) {
				html += '<tr><td>' + q[i]['uid'] + '</td>';
				html += '<td><b><a class="pointer" onclick="mng_preview_user(' + q[i]['uid'] + ')">' + q[i]['email'] + '</a></b></td>';
				html += '<td>' + q[i]['first_name'] + '</td>';
				// html += '<td><a class="pointer" onclick="drawlv_mng_user_link(' + q[i]['su'] + ')">';
				html += '<td>';
				if (q[i]['su'] == 1) {
					html += 'Admin';
				}
				if (q[i]['su'] == 10) {
					html += 'Cộng tác viên';
				};
				html += '</td>';
				html += '<td>';
				// html += '<a href="" onclick="mdr_preview_user(' + q[i]['qid'] + ')"><i class="pointer text-success fa fa-eye" style="margin-left: 15%;" title="Xem trước"></i></a>';

				html += '<a href="" data-toggle="modal" data-target="#edituserModal_' + q[i]['uid'] + '"><i class="pointer text-warning fa fa-pencil" title="Sửa" style="color: #ef00ff;margin-left: 20%;"></i></a>';
				html += '<a href=""><i class="pointer fa fa-remove" style="margin-left: 20%;" onclick="delete_user_(' + q[i]['uid'] + ')" title="Xóa"></i></a>';
				html += '<div class="modal fade" id="edituserModal_' + q[i]['uid'] + '" role="dialog">';
				html += '<div class="modal-dialog" style="width:40%">';

				html += '<div class="modal-content">';
				html += '<div class="modal-header">';
				html += '<button type="button" class="close" data-dismiss="modal">&times;</button>';
				html += '<h4 class="modal-title">Chỉnh sửa tài khoản ' + q[i]['uid'] + '<span id="qide"><span></h4>';
				html += '</div>';
				html += '<div class="modal-body">';
				html += '<form action="" method="post">';
				html += '<div class="messedit" id="messedit' + q[i]['uid'] + '"></div>';
				html += '<div class="form-group">';
				html += '<label>Email: </label>';
				html += '<input type="email" class="form-control" id="email' + q[i]['uid'] + '" value="' + q[i]['email'] + '" require>';
				html += '</div>';
				html += '<div class="form-group">';
				html += '<label>Mật khẩu mới: </label>';
				html += '<input type="password" class="form-control" id="password' + q[i]['uid'] + '" require>';
				html += '</div>';
				html += '<div class="form-group">';
				html += '<label>Tên người dùng: </label>';
				html += '<input type="text" class="form-control" id="first_name' + q[i]['uid'] + '" value="' + q[i]['first_name'] + '" require>';
				html += '</div>';
				html += '<div class="form-group">';
				html += '<label>Quyền hạn: </label>';
				html += '<div class="form-check form-check-inline">';
				html += '<input class="form-check-input" type="radio" name="su' + q[i]['uid'] + '" id="su" value="1"';
				if (q[i]['su'] == 1) {
					html += 'checked';
				}
				html += '>';
				html += '<label class="form-check-label">Admin</label>';
				html += '<input style="margin-left: 10px;" class="form-check-input" name="su' + q[i]['uid'] + '" id="su" type="radio" value="10"';
				if (q[i]['su'] == 10) {
					html += 'checked';
				}
				html += '>';
				html += '<label class="form-check-label">Cộng tác viên</label>';
				html += '</div >';
				html += '</div >';
				html += '</form>';

				html += '</div>';
				html += ' <div class="modal-footer">';
				html += '<input class="btn btn-success" type="submit" onclick="get_inf_edit1(' + q[i]['uid'] + ')" value="Xác nhận" />';
				html += '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
				html += '</div>';
				html += '</div >';

				html += '</div >';
				html += '</div>';
				html += '</td></tr>';
			}
			html += "</table>";
			$(".data_mngq").append(html);
			$("#totaluser").empty();
			$("#totaluser").append(data.num_user);
			$("#beginuser").empty();
			$("#beginuser").append(Math.min(data.limit * data.page + 1, data.num_user));
			$("#enduser").empty();
			$("#enduser").append(Math.min(data.limit * (data.page + 1), data.num_user));

			$(".pageuser").empty();
			pgihtml = "";
			page = parseInt(page);
			if (data.num_page < 7) {
				for (i = 0; i < data.num_page; i++) {
					pgihtml += '<li class="page-item';
					if (i == page) {
						pgihtml += ' active';
					}
					pgihtml += '" onclick="drawpage_mng_user(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
				}


			}
			else {
				if (page <= 3) {
					for (i = 0; i < 5; i++) {
						pgihtml += '<li class="page-item';
						if (i == page) {
							pgihtml += ' active';
						}
						pgihtml += '" onclick="drawpage_mng_user(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
					}
					pgihtml += '<li class="page-item"><a class="page-link">...</a></li>';
					pgihtml += '<li class="page-item" onclick="drawpage_mng_user(' + (data.num_page - 1) + ')"><a class="page-link">' + data.num_page + '</a></li>';
				}
				else {
					pgihtml += '<li class="page-item" onclick="drawpage_mng_user(0)"><a class="page-link">1</a></li>';
					pgihtml += '<li class="page-item"><a class="page-link">...</a></li>';

					if (page < data.num_page - 4) {
						pgihtml += '<li class="page-item" onclick="drawpage_mng_user(' + (parseInt(page) - 1) + ')"><a class="page-link">' + page + '</a></li>';
						pgihtml += '<li class="page-item active" onclick="drawpage_mng_user(' + page + ')"><a class="page-link">' + (parseInt(page) + 1) + '</a></li>';
						pgihtml += '<li class="page-item" onclick="drawpage_mng_user(' + (parseInt(page) + 1) + ')"><a class="page-link">' + (parseInt(page) + 2) + '</a></li>';
						pgihtml += '<li class="page-item"><a class="page-link">...</a></li>';
						pgihtml += '<li class="page-item" onclick="drawpage_mng_user(' + (data.num_page - 1) + ')"><a class="page-link">' + data.num_page + '</a></li>';
					}
					else {
						for (i = page - 2; i < data.num_page; i++) {
							pgihtml += '<li class="page-item';
							if (i == page) {
								pgihtml += " active";
							}
							pgihtml += '" onclick="drawpage_mng_user(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>';
						}

					}
				}
			}
			$("#circularG").remove();
			$(".pageuser").append(pgihtml);

		},
		error: function (data) {
			console.log(data);

		}
	});

}

function delete_user_(uid) {
	console.log(uid);
	if (confirm('Bạn có muốn xóa tài khoản?')) {
		$.ajax({
			type: 'POST',
			url: site_url + "/admin/delete_user/" + uid,
			data: {},
			contentType: 'application/json',
			success: function (data) {
				$("#ques_" + uid).attr('style', "display:none");
			},
		});
	}
}

function get_inf_edit1(uid) {
	var checkbox = document.getElementsByName("su" + uid);
	for (var i = 0; i < checkbox.length; i++) {
		if (checkbox[i].checked == true) {
			var su = checkbox[i].value;

		}
	}

	$.ajax({
		type: 'POST',
		url: base_url + "index.php/admin/edit_user/" + uid,
		data: {
			email: $("#email" + uid).val(),
			first_name: $("#first_name" + uid).val(),
			su: su,
			password: $("#password" + uid).val(),
		},
		success: function (msg) {
			if (msg == '1') {
				$('#messedit' + uid).html('Có lỗi sảy ra!');
			}
			if (msg == '0') {
				location.reload();
			}
		},
	});
}

function add_user() {
	var checkbox = document.getElementsByName("su");
	for (var i = 0; i < checkbox.length; i++) {
		if (checkbox[i].checked == true) {
			var su = checkbox[i].value;
		}
	}
	var first_name = $('#first_name').val();
	var email = $('#email').val();
	var password = $('#password').val();
	$.ajax({
		type: 'POST',
		url: base_url + 'index.php/admin/addUser',
		data: {
			first_name: first_name,
			email: email,
			password: password,
			su: su,
		},
		success: function (msg) {
			if (msg == '0') {
				location.reload();
			}
			else {
				document.getElementById("msg-err").innerHTML = 'Email đã tồn tại!';
				$('#first_name').val(first_name);
				$('#email').val(email);
				$('#password').val('');
			}
		}
	});
}