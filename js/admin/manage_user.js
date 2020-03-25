function drawpage_mng_user(page) {
	uid = $("#inf_uid").val();
	su = $("#inf_su").val();
	search = $("#inf_search").val();
	limit = $("#inf_limit").val();
	$("#go_to_page").val(page + 1);
	redrawusertbl(uid, su, search, limit, page);
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
			var html = ' <table class="table table-bordered" style="background: #fff;"><tr style="background-color: rgb(233, 235, 238);"><th>#</th>';
			html += '<th style="width: 50%;">Email <span><select  style="float:right" onchange="drawlimit_mng_user(this)">';
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
			html += '<option disabled>Danh mục</option><option ';
			if (uid == 0)
				html += " selected ";
			html += ' value="0">Tất cả</option>';
			html += '	<option value="1">Admin</option><option value="10">Cộng tác viên</option>'
			html += '</select></th><th><input id="search_mng_user" style="width:65%;margin-left: 15%" onkeyup="drawsearch_mng_user(this,event)" value="' + search + '"> ';
			html += '<i class="pointer fa fa-search" onclick="drawsearch_mng_user_btn()"></i></th></tr>';

			for (i = 0; i < q.length; i++) {
				html += '<tr><td>' + q[i]['uid'] + '</td>';
				html += '<td><b><a class="pointer" onclick="mng_preview_user(' + q[i]['uid'] + ')">' + q[i]['email'] + '</a></b></td>';
				html += '<td>' + q[i]['first_name'] + '</td>';
				html += '<td><a class="pointer" onclick="drawlv_mng_user_link(' + q[i]['su'] + ')">';
				if (q[i]['su'] == 1) {
					html += 'Admin';
				}
				if (q[i]['su'] == 10) {
					html += 'Cộng tác viên';
				};
				html +='</a></td>';
				html += '<td>';
				html += '<a onclick="mdr_preview_user(' + q[i]['qid'] + ')"><i class="pointer text-success fa fa-eye" style="margin-left: 15%;" title="Xem trước"></i></a>';

				html += '<a onclick="mng_edit_user(' + q[i]['qid'] + ')"><i class="pointer text-warning fa fa-pencil" title="Sửa" style="color: #ef00ff;margin-left: 20%;"></i></a>';

				html += '<a><i class="pointer fa fa-remove" style="margin-left: 20%;" onclick="delete_user_(' + q[i]['qid'] + ')" title="Xóa"></i></a>';
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