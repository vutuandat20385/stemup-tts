function user_addschool(ulist_id){
	$("#scl").empty();
	$("#chinhsua").empty();
	if(ulist_id!=0){
		var formData = {ulist_id:ulist_id};
		$.ajax({
			type: "POST",
			data : formData,
			url: base_url + "index.php/user/get_showschool/"+ulist_id,
			success: function(data){	
				if(data){
					//$('#scl_change').emty();
					$("#scl").append(data['school_name']);
					$('#scl_change').attr("style","display:none; width:90%; margin-left:-10px");
					$("#chinhsua").append('<button type="button" onclick="edit_school('+ulist_id+')" class="btn btn-primary" data-dismiss="modal">Chỉnh sửa</button>');
				}
				else{
					edit_school(ulist_id);
					
				}
				
			},
			error: function(xhr,status,strErr){
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}	
		});
	}
}
function edit_school(ulist_id){
	$("#truong_").empty();
	$("#scl").empty();
	$("#chinhsua").empty();
	$('#scl_change').attr("style","display:block; width:90%; margin-left:-10px");
	if(ulist_id!=0){
		$("#chinhsua").append('<button type="button" onclick="save_shool('+ulist_id+')" class="btn btn-success" data-dismiss="modal">Lưu trường</button>');	
	}
}
function save_shool(ulist_id){
	var id_school=$("#scl_school_id").val();
	var formData = {ulist_id:ulist_id,id_school:id_school};
	
	$.ajax({
			type: "POST",
			data : formData,
			url: base_url + "index.php/user/save_school/"+ ulist_id +"/" +id_school,
			success: function(data){
				//console.log(id_school);
			},
			error: function(xhr,status,strErr){
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}	
		});
}