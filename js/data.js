function changeDataItem(event){
	var parent_id = event.target.value;
	var formData = {parent_id:parent_id};
	if(parent_id!=0){
		$.ajax({
			type: "POST",
			data : formData,
			url: base_url + "index.php/login/get_dataitem/"+parent_id,
			success: function(data){
				if(event.target.id == 'tinhthanh_id'){
					$('#quanhuyen_id').empty();
					$('#xaphuong_id').empty();
					$('#truong_id').empty();
					$('#lop_id').empty();
					$('#quanhuyen_id').append('<option value="0" > ----Chọn quận/ huyện----</option>');
					for (var i = 0; i < data.length; i++) {
						$('#quanhuyen_id').append('<option value="'+data[i].did+'">'+data[i].dataitem_name+'</option>');
					}
				}
				if(event.target.id == 'quanhuyen_id'){
					$('#xaphuong_id').empty();
					$('#truong_id').empty();
					$('#lop_id').empty();
					$('#xaphuong_id').append('<option value="0" > ----Chọn Xã/ phường----</option>');
					for (var i = 0; i < data.length; i++) {
						$('#xaphuong_id').append('<option value="'+data[i].did+'">'+data[i].dataitem_name+'</option>');
					}
				}
			},
			error: function(xhr,status,strErr){
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}	
		});
	}
	else{
		if(event.target.id == 'tinhthanh_id'){
			$('#quanhuyen_id').empty();
		}
		if(event.target.id == 'quanhuyen_id'){
			$('#xaphuong_id').empty();
		}
	}
}
function changeDataItemSchool(event){
	var school_id = event.target.value;
	var formData = {school_id:school_id};
	if(school_id!= 0){
		$.ajax({
			type:"POST",
			data: formData,
			url: base_url + "index.php/login/get_dataitem_school/"+school_id,
			success: function(data){
				if(event.target.id == 'xaphuong_id'){
					$('#truong_id').append('<option value="0" > ----Chọn Trường----</option>');
					$('#lop_id').empty();
					for (var i = 0; i < data.length; i++) {
						$('#truong_id').append('<option value="'+data[i].schoolid+'">'+data[i].school_name+'</option>');
					}
				}
			}

		})
	}else{

	}

}

function changeDataItemClass(event){
	var class_id = event.target.value;
	var formData = {class_id:class_id};
	if(class_id!= 0){
		$.ajax({
			type:"POST",
			data: formData,
			url: base_url + "index.php/login/get_dataitem_class/"+class_id,
			success: function(data){
				if(event.target.id == 'truong_id'){
					for (var i = 0; i < data.length; i++) {
						$('#lop_id').append('<option value="'+data[i].class_id+'">'+data[i].class_name+'</option>');
					}
				}
			}

		})
	}else{

	}

}

function changeDataGroup(){
	var group_id = document.getElementById('group_id').value;
	var dataitem_level = document.getElementById('dataitem_level').value;
	var formData = {
		group_id:group_id,
		dataitem_level:dataitem_level
	};
	
	$.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/data/dataitem_filter/"+group_id+"/"+dataitem_level,
		success: function(data){
			$('#parent_id').empty();
			$('#parent_id').append('<option>Select the parent of dataitem</option>');
			for (var i = 0; i < data.length; i++) {
				$('#parent_id').append('<option value="'+data[i].did+'">'+data[i].dataitem_name+'</option>');
			}
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}	
	});
}

function changeDataSchool(event){
	var parent_id = event.target.value;
	var formData = {parent_id:parent_id};
	if(parent_id!=0){
		$.ajax({
			type: "POST",
			data : formData,
			url: base_url + "index.php/login/get_data_huyen/"+parent_id,
			success: function(data){
				//console.log(data);
				
					$('#scl_quanhuyen_id').empty();
					$('#scl_quanhuyen_id').append('<option value="0" > ----Chọn quận/ huyện----</option>');
					for (var i = 0; i < data.length; i++) {
						$('#scl_quanhuyen_id').append('<option value="'+data[i].did+'">'+data[i].dataitem_name+'</option>');
					}
				
			},
			error: function(xhr,status,strErr){
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}	
		});
	}
	else{
		
			$('#scl_quanhuyen_id').empty();
		
	}
}
function changeDataSchool1(event){
	var qh_id = event.target.value;
	var formData = {qh_id:qh_id};
	//console.log(qh_id);
	if(qh_id!=0){
		$.ajax({
			type: "POST",
			data : formData,
			url: base_url + "index.php/login/get_data_school/"+qh_id,
			success: function(data){
			//	console.log(data);
				
					$('#scl_school_id').empty();
					$('#scl_school_id').append('<option value="0" > ----Chọn Trường----</option>');
					for (var i = 0; i < data.length; i++) {
						$('#scl_school_id').append('<option value="'+data[i].schoolid+'">'+data[i].school_name+'</option>');
					}
				
			},
			error: function(xhr,status,strErr){
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}	
		});
	}
	else{
		
			$('#scl_school_id').empty();
		
	}
}