/*function add_life_account(class_id){
	console.log();
	$("#classaddstdModal").modal();
	$('#bodyclassaddstdmodal').empty();
	console.log(class_id);
	$.ajax({
		type: "POST",
		data : {},
		url: base_url + "index.php/classes/get_student_1/"+class_id,
		success: function(results){
			console.log(results)
			$('#bodyclassaddstdmodal').append('<table id="tblstd" class="display" style="width:100%"></table>');
			var tbl = $('#tblstd').DataTable({
				responsive: true,
				data: results,
				columns: [
				{ "data": null,"title": "","class":"details-control" ,"render":function (data, type, row){
					return "";
				} },
				{ "data": null,"render":function (data, type, row){
					return data.first_name+" "+data.last_name;
				} ,"title": "Họ tên"},
				{ "data": "email", "title": "Email" },
				{ "data": "birthdate", "title": "Ngày sinh","class":"hide_ebcstd" },
				{ "data": "user_code", "title": "Mã học sinh","class":"hide_ebcstd" }

				],
				language:langs,
				order: [[ 0, "desc" ]]
			});
			
			$('#tblstd tbody').on('click', 'td.details-control', function () {
				var tr = $(this).closest('tr');
				var row = tbl.row( tr );
				if (tr.hasClass('shown')){

					removestd(class_id, row.data().uid);
					row.child.hide();
					tr.removeClass('shown');
				}else{
					addstd(class_id, row.data().uid);
					row.child.show();
					tr.addClass('shown');
				}
			});
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});
}

*/
function addstd (class_id, uid){
	$.ajax({
		type: "POST",
		data : {},
		url: site_url + "/classes/add_student/"+class_id+'/'+uid,
		success: function(data){
			
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}	
	});	
}
function reload_student(class_id){
	window.location.href =  site_url+"/home_user/list_student_inclass/"+class_id;
}

function removestd (clsss_id, uid){
	$.ajax({
		type: "POST",
		data : {},
		url: site_url + "/classes/remove_student/"+clsss_id+'/'+uid,
		success: function(data){
			
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}	
	});	
}
function reload_mb(){    
	location.reload();
}