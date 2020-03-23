$(document).ready(function () {
	if (window.location.hash) {
		var hash = window.location.hash.substring(1);
		if (hash == 'logo') {
			$('a[href="#logorg"]').tab('show');


		}
	}
});

$(document).ready(function () {
	tinymce.init({
		menubar: false,
		statusbar: false,
		selector: '#introarea',
		branding: false,
		images_dataimg_filter: function (img) {
			return img.hasAttribute('internal-blob');
		},
		height: 250,
		theme: 'modern',
		plugins: [
			'tiny_mce_wiris advlist autolink lists link image jbimages eqneditor charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
		],
		toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages | eqneditor tiny_mce_wiris_formulaEditor | print preview media embed | forecolor backcolor emoticons | codesample',
		image_advtab: true,
		setup: function (theEditor) {

			theEditor.addButton('embed', {
				icon: 'embedcode',
				tooltip: "Embed",
				onclick: function () {
					theEditor.windowManager.open({
						title: 'Insert Embed Code',
						body: [{
							type: 'textbox',
							name: 'text',
							size: '1000',
							autofocus: true,
							multiline: true,
							minHeight: 150,
							minWidth: 500,
							id: 'embedcodes'
						}],
						onsubmit: function (e) {
							theEditor.insertContent($('#embedcodes').val());

						}
					});
				}
			});
		}


	});
	if (!$("#edbtn").length)
		$("#maininfo").attr('style', 'height:560px');
	$(".cb_ict").click(function () {
		if (!$("#svct").length)
			$("#catearea").append('<div class="col-md-12 col-xs-12" style="margin-top:20px"><button type="submit" class="btn btn-danger" id="svct" onclick="">Lưu lại</button></div>');
	});

	$(".cb_ilv").click(function () {
		if (!$("#svlv").length)
			$("#levelarea").append('<div class="col-md-12 col-xs-12" style="margin-top:20px"><button type="submit" class="btn btn-danger" id="svlv" onclick="">Lưu lại</button></div>');
	});

});

function editintro() {

	$("#introarea2").attr("style", "display:block");
	$("#introarea2").val($("#text-desc").html());
	$("#text-desc").empty();
	tinymce.init({
		menubar: false,
		statusbar: false,
		selector: '#introarea2',
		branding: false,
		images_dataimg_filter: function (img) {
			return img.hasAttribute('internal-blob');
		},
		height: 250,
		theme: 'modern',
		plugins: [
			'tiny_mce_wiris advlist autolink lists link image jbimages eqneditor charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
		],
		toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages | eqneditor tiny_mce_wiris_formulaEditor | print preview media embed | forecolor backcolor emoticons | codesample',
		image_advtab: true,
		setup: function (theEditor) {

			theEditor.addButton('embed', {
				icon: 'embedcode',
				tooltip: "Embed",
				onclick: function () {
					theEditor.windowManager.open({
						title: 'Insert Embed Code',
						body: [{
							type: 'textbox',
							name: 'text',
							size: '1000',
							autofocus: true,
							multiline: true,
							minHeight: 150,
							minWidth: 500,
							id: 'embedcodes'
						}],
						onsubmit: function (e) {
							theEditor.insertContent($('#embedcodes').val());

						}
					});
				}
			});
		}


	});
	$("#btn-area").append('<button class="btn btn-danger" onclick="save_description()">Lưu lại</button>');
	$("#edbtn").remove();
	if (!$("#edbtn").length) {
		if ($(window).width() > 767) {
			$("#maininfo").attr('style', 'height:560px');
		} else {
			$("#maininfo").attr('style', 'height:560px');
		}
	}




}

function save_description() {
	var des = tinymce.get('introarea');
	if (!des)
		des = tinymce.get('introarea2');
	var ims = {
		"description": des.getContent()
	};


	var infoms = JSON.stringify(ims);
	$.ajax({
		type: 'POST',
		url: site_url + "/profile/save_description",
		data: infoms,
		contentType: 'application/json',
		success: function (data) {
			window.location.href = site_url + "/profile";
			$("#maininfo").attr('style', '');
		},
		error: function (data) {
			console.log(data);
		}

	});
}


function edit_logo() {
	$("#edtlogobtn").empty();
	$("#edtlogobtn").append('<button class="btn btn-danger"   onclick="save_logo()">Lưu lại</button>');
	var textorg = $("#divtextorg").html().trim();
	var linkorg = $("#divlinkorg>a").html();
	$("#divtextorg").empty();
	$("#divtextorg").append('<input type="text" name="textorg" value="' + textorg + '" id="textorg">');
	$("#divlinkorg").empty();
	$("#divlinkorg").append('<input type="text" name="linkorg" value="' + linkorg + '" id="linkorg">');

}

function save_logo() {
	var textorg = $("#textorg").val().trim();
	var linkorg = $("#linkorg").val().trim();
	var ims = {
		"textorg": textorg,
		"linkorg": linkorg
	};
	var infoms = JSON.stringify(ims);
	$.ajax({
		type: 'POST',
		url: site_url + "/profile/save_logo",
		data: infoms,
		contentType: 'application/json',
		success: function (data) {
			window.location.href = site_url + "/profile#logo";
			$("#edtlogobtn").empty();
			$("#edtlogobtn").append('<button class="btn btn-danger"   onclick="edit_logo()">Chỉnh sửa</button>');
			$("#divtextorg").empty();
			$("#divtextorg").append("" + textorg);
			$("#divlinkorg").empty();
			$("#divlinkorg").append('<a href="' + linkorg + '" target="_blank">' + linkorg + '</a>');
		},
		error: function (data) {
			console.log(data);
		}

	});
}
/*function edit_info_stemup1(uid,tt1,qh1,scl1){
	

} */
function edit_info_stemup(tt, qh, xp, uid, tt1, qh1, scl1) {
	$("#dtbirthdate").css("display", "none");
	$("#txtschool").css("display", "none");
	$("#txtaddress").css("display", "none");
	$("#nbphone").css("display", "none");
	$("#scl").empty();
	$('#scl_change').attr("style", "display:block; width:90%; margin-left:-10px");
	//	$('#fname').empty();
	//	$('#txtfname').attr("style","display:block; width:90%");
	//	$('#lname').empty();
	//	$('#txtlname').attr("style","display:block; width:90%");
	$('#birthdate').empty();
	$('#bdt').attr("style", "display:block; width:90%");
	$('#bdt').datepicker({
		dateFormat: 'dd-mm-yy',
	});
	$("#address").empty();
	$('#address_change').attr("style", "display:block; width:90%; margin-left:-10px");
	//	$('#usmail').empty();
	//	$('#usmt').attr("style","display:block; width:90%");
	$('#usphone').empty();
	$('#uspn').attr("style", "display:block; width:90%");
	$("#btn_inf").append('<button onclick="form_information()" class="btn btn-danger" id="save_edt_inf">Lưu lại</button>');
	$("#btn_edt_inf").remove();

	if (uid != 0) {
		var formData = {
			uid: uid
		};
		$.ajax({
			type: "POST",
			data: formData,
			url: base_url + "index.php/login/get_data_schools/" + uid,
			success: function (data) {
				// console.log(data);
				if (tt1 != 0) {
					var formData = {
						tt1: tt1
					};
					$.ajax({
						type: "POST",
						data: formData,
						url: base_url + "index.php/login/get_data_tinh1/" + tt1,
						success: function (data) {
							// console.log(data);
							$('#scl_tinhthanh_id').empty();
							$('#scl_tinhthanh_id').append('<option> ----Chọn tỉnh/ thành phố----</option>');
							for (var i = 0; i < data.length; i++) {
								if (data[i].did == tt1)
									$('#scl_tinhthanh_id').append('<option value="' + data[i].did + '" selected>' + data[i].dataitem_name + '</option>');
								else
									$('#scl_tinhthanh_id').append('<option value="' + data[i].did + '" >' + data[i].dataitem_name + '</option>');
							}
						},
						error: function (xhr, status, strErr) {
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}
					});
				}
				if (tt1 != 0) {
					var formData = {
						parent_id: tt1
					};
					$.ajax({
						type: "POST",
						data: formData,
						url: base_url + "index.php/login/get_data_huyen/" + tt1,
						success: function (data) {
							// console.log(data);
							$('#scl_quanhuyen_id').empty();
							$('#scl_quanhuyen_id').append('<option> ----Chọn quận/ huyện----</option>');
							for (var i = 0; i < data.length; i++) {
								if (data[i].did == qh1)
									$('#scl_quanhuyen_id').append('<option value="' + data[i].did + '" selected>' + data[i].dataitem_name + '</option>');
								else
									$('#scl_quanhuyen_id').append('<option value="' + data[i].did + '" >' + data[i].dataitem_name + '</option>');
							}


						},
						error: function (xhr, status, strErr) {
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}
					});
				}
				if (qh1 != 0) {
					var formData = {
						parent_id: qh1
					};
					$.ajax({
						type: "POST",
						data: formData,
						url: base_url + "index.php/login/get_data_school/" + qh1,
						success: function (data) {
							//	 console.log(data);

							$('#scl_school_id').empty();
							$('#scl_school_id').append('<option> ----Chọn Trường----</option>');
							for (var i = 0; i < data.length; i++) {
								if (data[i].schoolid == scl1)
									$('#scl_school_id').append('<option value="' + data[i].schoolid + '" selected >' + data[i].school_name + '</option>');
								else
									$('#scl_school_id').append('<option value="' + data[i].schoolid + '">' + data[i].school_name + '</option>');
							}


						},
						error: function (xhr, status, strErr) {
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}
					});
				}
			},
			error: function (xhr, status, strErr) {
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}
		});
	}


	if (tt != 0) {
		var formData = {
			parent_id: tt
		};
		$.ajax({
			type: "POST",
			data: formData,
			url: base_url + "index.php/login/get_dataitem/" + tt,
			success: function (data) {
				//	 console.log(data);

				$('#quanhuyen_id').empty();
				$('#quanhuyen_id').append('<option> ----Chọn quận/ huyện----</option>');
				for (var i = 0; i < data.length; i++) {
					if (data[i].did == qh)
						$('#quanhuyen_id').append('<option value="' + data[i].did + '" selected>' + data[i].dataitem_name + '</option>');
					else
						$('#quanhuyen_id').append('<option value="' + data[i].did + '" >' + data[i].dataitem_name + '</option>');
				}
			},
			error: function (xhr, status, strErr) {
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}
		});
	}
	if (qh != 0) {
		var formData1 = {
			parent_id: qh
		};
		$.ajax({
			type: "POST",
			data: formData1,
			url: base_url + "index.php/login/get_dataitem/" + qh,
			success: function (data) {
				//	 console.log(data);

				$('#xaphuong_id').empty();
				for (var i = 0; i < data.length; i++) {
					if (data[i].did == xp)
						$('#xaphuong_id').append('<option value="' + data[i].did + '" selected>' + data[i].dataitem_name + '</option>');
					else
						$('#xaphuong_id').append('<option value="' + data[i].did + '" >' + data[i].dataitem_name + '</option>');
				}

			},
			error: function (xhr, status, strErr) {
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}
		});

	}
}

function form_information() {
	var data = $("#user_infomation").serialize();
	var birthdate = $('input[name=birthdate]').val();
	//	fname = $('input[name=fname]').val();
	//	lname = $('input[name=lname]').val();
	/*	var b_fname,b_lname;
		check_fname = /^[a-zA-Z ]{1,30}$/;
		check_lname = /^[a-zA-Z ]{1,30}$/;
		if(!check_fname.test(fname)){
			b_fname = 0;
			$("input[name=fname]").css({'border': '1px solid red'});
			$("input[name=fname]").attr('title','Họ không khả dụng!');
		} else {
			b_fname = 1;
			$("input[name=fname]").css({'border': ''});
			$("input[name=fname]").attr('title','');
		}
		if(!check_lname.test(lname)){
			b_lname = 0;
			$("input[name=lname]").css({'border': '1px solid red'});
			$("input[name=lname]").attr('title','Tên không khả dụng!');
		} else {
			b_lname = 1;
			$("input[name=lname]").css({'border': ''});
			$("input[name=lname]").attr('title','');
		}*/
	//	if(b_fname == 1 && b_lname == 1){
	if (birthdate == '') {
		$.ajax({
			type: "POST",
			data: data,
			url: base_url + "index.php/profile/save_information",
			success: function (data) {
				window.location.reload()
			},
			error: function (xhr, status, strErr) {
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}
		})
	} else {
		var res = birthdate.split("-");
		var date = new Date(res[2], res[1], res[0]);
		var now = new Date();
		var diff = now.getTime() - date.getTime();
		var age = Math.floor(diff / (1000 * 60 * 60 * 24 * 365.25));
		if (age >= 6) {
			$('input[name=birthdate]').css({
				'border': ''
			});
			$('input[name=birthdate]').attr('title', '');
			$.ajax({
				type: "POST",
				data: data,
				url: base_url + "index.php/profile/save_information",
				success: function (data) {
					window.location.reload()
				},
				error: function (xhr, status, strErr) {
					console.log(xhr);
					console.log(status);
					console.log(strErr);
				}
			})
		} else {
			$('input[name=birthdate]').css({
				'border': '1px solid red'
			});
			$('input[name=birthdate]').attr('title', 'Ngày sinh không hợp lệ!');
		}
	}
	//	}
}

function edit_info1(uid, tt1, qh1, scl1) {

	$("#scl").empty();
	$('#scl_change').attr("style", "display:block; width:90%; margin-left:-10px");
	if (uid != 0) {
		var formData = {
			uid: uid
		};
		$.ajax({
			type: "POST",
			data: formData,
			url: base_url + "index.php/login/get_data_schools/" + uid,
			success: function (data) {
				console.log(data);
				if (tt1 != 0) {
					var formData = {
						tt1: tt1
					};
					$.ajax({
						type: "POST",
						data: formData,
						url: base_url + "index.php/login/get_data_tinh1/" + tt1,
						success: function (data) {
							console.log(data);
							$('#scl_tinhthanh_id').empty();
							$('#scl_tinhthanh_id').append('<option> ----Chọn tỉnh/ thành phố----</option>');
							for (var i = 0; i < data.length; i++) {
								if (data[i].did == tt1)
									$('#scl_tinhthanh_id').append('<option value="' + data[i].did + '" selected>' + data[i].dataitem_name + '</option>');
								else
									$('#scl_tinhthanh_id').append('<option value="' + data[i].did + '" >' + data[i].dataitem_name + '</option>');
							}


						},
						error: function (xhr, status, strErr) {
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}
					});
				}
				if (tt1 != 0) {
					var formData = {
						parent_id: tt1
					};
					$.ajax({
						type: "POST",
						data: formData,
						url: base_url + "index.php/login/get_data_huyen/" + tt1,
						success: function (data) {
							console.log(data);
							$('#scl_quanhuyen_id').empty();
							$('#scl_quanhuyen_id').append('<option> ----Chọn quận/ huyện----</option>');
							for (var i = 0; i < data.length; i++) {
								if (data[i].did == qh1)
									$('#scl_quanhuyen_id').append('<option value="' + data[i].did + '" selected>' + data[i].dataitem_name + '</option>');
								else
									$('#scl_quanhuyen_id').append('<option value="' + data[i].did + '" >' + data[i].dataitem_name + '</option>');
							}


						},
						error: function (xhr, status, strErr) {
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}
					});
				}
				if (qh1 != 0) {
					var formData = {
						parent_id: qh1
					};
					$.ajax({
						type: "POST",
						data: formData,
						url: base_url + "index.php/login/get_data_school/" + qh1,
						success: function (data) {
							console.log(data);

							$('#scl_school_id').empty();
							$('#scl_school_id').append('<option> ----Chọn Trường----</option>');
							for (var i = 0; i < data.length; i++) {
								if (data[i].schoolid == scl1)
									$('#scl_school_id').append('<option value="' + data[i].schoolid + '" selected >' + data[i].school_name + '</option>');
								else
									$('#scl_school_id').append('<option value="' + data[i].schoolid + '">' + data[i].school_name + '</option>');
							}


						},
						error: function (xhr, status, strErr) {
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}
					});
				}
				//$('#scl_tinhthanh_id').empty();
				//$('#scl_tinhthanh_id').append('<option> ----Chọn tỉnh/ thành phố----</option>');
				//for (var i = 0; i < data.length; i++) {
				//if(data[i].did==tt1)
				//$('#scl_tinhthanh_id').append('<option value="'+data[i].did+'" selected>'+data[i].dataitem_name+'</option>');
				//else
				//$('#scl_tinhthanh_id').append('<option value="'+data[i].did+'" >'+data[i].dataitem_name+'</option>');
				//}






				//$('#scl_tinhthanh_id').append('<option value="'+data['tinh_thanh']+'" selected>'+data['dataitem_name']+'</option>');
				//$('#scl_quanhuyen_id').append('<option value="'+data['quan_huyen']+'" selected>'+data['huyen']+'</option>');
				//$('#scl_school_id').append('<option value="'+data['schoolid']+'" selected>'+data['school_name']+'</option>');
				//for (var i = 0; i < data.length; i++) {
				//if(data[i].tinh_thanh==qh)
				//$('#quanhuyen_id').append('<option value="'+data[i].did+'" //selected>'+data[i].dataitem_name+'</option>');
				//else
				//$('#quanhuyen_id').append('<option value="'+data[i].did+'" //>'+data[i].dataitem_name+'</option>');
				//}


			},
			error: function (xhr, status, strErr) {
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}
		});
	}

}

function edit_info(tt, qh, xp) {
	$('#usname').empty();
	$('#usnt').attr("style", "display:block; width:90%");
	$('#birthdate').empty();

	$('#bdt').attr("style", "display:block; width:90%");
	$('#bdt').datepicker({
		dateFormat: 'dd-mm-yy'
	});

	$("#address").empty();
	$('#address_change').attr("style", "display:block; width:90%; margin-left:-10px");

	if (tt != 0) {
		var formData = {
			parent_id: tt
		};
		$.ajax({
			type: "POST",
			data: formData,
			url: base_url + "index.php/login/get_dataitem/" + tt,
			success: function (data) {
				console.log(data);

				$('#quanhuyen_id').empty();
				$('#quanhuyen_id').append('<option> ----Chọn quận/ huyện----</option>');
				for (var i = 0; i < data.length; i++) {
					if (data[i].did == qh)
						$('#quanhuyen_id').append('<option value="' + data[i].did + '" selected>' + data[i].dataitem_name + '</option>');
					else
						$('#quanhuyen_id').append('<option value="' + data[i].did + '" >' + data[i].dataitem_name + '</option>');
				}


			},
			error: function (xhr, status, strErr) {
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}
		});
	}
	if (qh != 0) {
		var formData1 = {
			parent_id: qh
		};
		$.ajax({
			type: "POST",
			data: formData1,
			url: base_url + "index.php/login/get_dataitem/" + qh,
			success: function (data) {
				console.log(data);

				$('#xaphuong_id').empty();
				for (var i = 0; i < data.length; i++) {
					if (data[i].did == xp)
						$('#xaphuong_id').append('<option value="' + data[i].did + '" selected>' + data[i].dataitem_name + '</option>');
					else
						$('#xaphuong_id').append('<option value="' + data[i].did + '" >' + data[i].dataitem_name + '</option>');
				}

			},
			error: function (xhr, status, strErr) {
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}
		});

	}

	$('#usmail').empty();
	$('#usmt').attr("style", "display:block; width:90%");
	$('#usphone').empty();
	$('#uspn').attr("style", "display:block; width:90%");
	$("#btn_inf").append('<button type="submit" class="btn btn-danger" id="save_edt_inf">Lưu lại</button>');
	$("#btn_edt_inf").remove();
}

function timegetemail() {
	time = $('#timegetemail').val();
	dt = JSON.stringify({
		'time': time,
	});
	$.ajax({
		type: 'POST',
		url: site_url + '/profile/changetime',
		data: dt,
		contentType: 'application/json',
		success: function (data) {
			console.log(data);
		},
		error: function (data) {
			console.log(data);
		}
	})
}

function Sub(id) {
	dt = JSON.stringify({
		'id': id,
	});
	console.log(dt);
	$.ajax({
		type: 'POST',
		url: site_url + '/profile/sub',
		data: dt,
		contentType: 'application/json',
		success: function (data) {
			alert('Cảm ơn bạn đã theo dõi!');
			location.reload();
		},
		error: function (data) {
			console.log(data);
		}
	});
}

function unSub(id) {
	dt = JSON.stringify({
		'id': id,
	});
	console.log(dt);
	$.ajax({
		type: 'POST',
		url: site_url + '/profile/unsub',
		data: dt,
		contentType: 'application/json',
		success: function (data) {
			alert('Bạn đã hủy theo dõi!');
			location.reload();
		},
		error: function (data) {
			console.log(data);
		}
	});
}