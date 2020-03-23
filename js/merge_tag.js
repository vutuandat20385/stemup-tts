function merge_post(){
	var tags_id="";
	tags_name= $("#tag_content").val();
	$.each($(".merge_all_tags:checked"), function(){
		if(tags_id!="")
			tags_id+=",";
		tags_id+=$(this).val();
		
	}
	);

	
	data_t= JSON.stringify({'tags_id':tags_id,
							'tags_name':tags_name	
	});
	$.ajax({
		type: 'POST',
		url: site_url+"/tags/get_data_merge/",
		data: data_t,
		contentType: 'application/json',
		success: function(data) {
			
			
			
			
		},
	    error: function(data) {  
			   console.log(data);  
			  
		  }
	});
}