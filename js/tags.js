function drawpage_rs(page){
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();
	redrawrstbl(search,limit,page);
}

function drawlimit_rs(event){
	limit=$(event).val();
	search=$("#inf_search").val();
	redrawrstbl(search,limit,0);
}


function drawsearch_rs(event,e){

	limit=$("#inf_limit").val();
	if(e.keyCode=='13'){
     	search= $(event).val();
		redrawrstbl(search,limit,0);
	}	
	
}
function drawsearch_rs_btn(){

	limit=$("#inf_limit").val();
    search= $("#inf_search").val();
    redrawrstbl(search,limit,0);
}
function redrawrstbl(search,limit,page){
	$("#inf_search").val(search);
	$("#inf_limit").val(limit);
	$("#inf_page").val(page);
	dt=JSON.stringify({'search':search,
					   'limit':limit,
					   'page':page
	                  });	
    $(".data_tags").empty();
    $(".data_tags").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');		
    	
	$.ajax({
		  type: 'POST',
		  url: site_url+"/tags/get_data_tags/",
		  data: dt,
		  contentType: 'application/json',
		  success: function(data) {
			console.log(data);
			html='<div class="data_tags"><table class="table table-bordered">';
			html+='<tr>';
			html+='<th>Actions</th><th>ID</th><th>Tags_name</th><th>Num question</th>';
			
			html+='</tr>';
	       
			  for(i=0; i< data.result.length; i++){
				   html+='</tr><td>';
				   html+='<input class="merge_all_tags" type="checkbox" value=('+data.result[i]['tag_id']+') title="Merge"></i></input>';
				   html+='<a style="margin-left:30px" id="tag_edit_'+data.result[i]['tag_id']+'" onclick="edit_tags('+data.result[i]['tag_id']+')"> <i class="pointer text-warning fas fa-pencil-alt" title="Sửa" style="color: #ef00ff;"></i></a>';				
				   html+='<a style="margin-left:30px" onclick="delete_tags('+data.result[i]['tag_id']+')"><i class="pointer fas fa-trash-alt" title="Xóa"></i></a></td>';
				   html+='<td id="tagid_'+data.result[i]['tag_id']+'">'+data.result[i]['tag_id']+'</td>';
				   html+='<td id="tagname_'+data.result[i]['tag_id']+'"><a href="'+site_url+'tags/question/('+data.result[i]['tag_id']+' )">'+data.result[i]['tag_name']+'</td>';
				   html+='<td>'+data.result[i]['num_question']+'</td>';

				   html+='</tr>';
               } 
									 
				html+='</table></div>';
				$(".data_tags").empty();
				$(".data_tags").append(html);
				
			   $("#totalrs").empty();
			   $("#totalrs").append(data.num_result);
			   $("#beginrs").empty();
			   $("#beginrs").append(Math.min(data.limit*data.page+1 ,data.num_result));
			   $("#endrs").empty();
			   $("#endrs").append(Math.min(data.limit*(data.page+1),data.num_result));
			   
			    $(".pagers").empty();
				pgihtml="";
				if(data.num_page<7){
					  for(i=0; i<data.num_page; i++){
						  pgihtml+='<li class="page-item';
						  if(i==page){
							   pgihtml+=' active';
						  }
						  pgihtml+='" onclick="drawpage_rs('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
					  }
					  
					 
				  }
				  else{
					  if(page<=3){
						  for(i=0; i<5; i++){
							  pgihtml+='<li class="page-item';
							  if(i==page){
								   pgihtml+=' active';
							  }
							  pgihtml+='" onclick="drawpage_rs('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
						  }
						  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
						  pgihtml+='<li class="page-item" onclick="drawpage_rs('+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
					  }
					  else{
						  pgihtml+='<li class="page-item" onclick="drawpage_rs(0)"><a class="page-link">1</a></li>';
						  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
						  
						  if(page<data.num_page-4){
							  pgihtml+='<li class="page-item" onclick="drawpage_rs('+(page-1)+')"><a class="page-link">'+page+'</a></li>';
							  pgihtml+='<li class="page-item active" onclick="drawpage_rs('+page+')"><a class="page-link">'+(page+1)+'</a></li>';
							  pgihtml+='<li class="page-item" onclick="drawpage_rs('+(page+1)+')"><a class="page-link">'+(page+2)+'</a></li>';
							  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
							  pgihtml+='<li class="page-item" onclick="drawpage_rs('+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
						  }
						  else{
							  for(i=page-2; i<data.num_page; i++){
								  pgihtml+='<li class="page-item';
								  if(i==page){
									  pgihtml+=" active";
								  }
								  pgihtml+='" onclick="drawpage_rs('+i+')"><a class="page-link">'+(i+1)+'</a></li>';
							  }
							  
						  }
					  }
				  }
			    $("#circularG").remove();
				$(".pagers").append(pgihtml);
		  },
		  error: function(data) {  
			   console.log(data);  
			  
		  }
	});
	
}

function edit_tags(tag_id){
	a= $("#tagname_"+tag_id).text();
	$("#tagname_"+tag_id).empty();
	b='<input class="form-control " style="width:350px;float:left" value="'+a+'"><span class="input-group-btn"><button class="btn btn-primary" onclick="get_tagsave('+tag_id+')" >Lưu lại</button> </span>';
	$("#tagname_"+tag_id).append(b);
	$("#tag_edit_"+tag_id).attr('onclick',"");
}
function delete_tags(tag_id){
	$.ajax({
		type: 'POST',
		url: site_url+"/tags/delete_tags/"+tag_id,
		data: {},
		success: function(data) {
			page= $("#inf_page").val();
			drawpage_rs(page);
		},
	    error: function(data) {  
			   console.log(data);  
			  
		  }
	});
}
function get_tagsave(tag_id){
	tag_id = $("#tagid_"+tag_id).text();
	tag_name = $("#tagname_"+tag_id+'>input').val();
	console.log(tag_name);
	dataq = JSON.stringify({'tag_id':tag_id,
							'tag_name':tag_name	
	});
	$.ajax({
		type: 'POST',
		url: site_url+"/tags/edit_tags/",
		data: dataq,
		contentType: 'application/json',
		success: function(data) {
			//console.log(data.status);
			if(data.status==1){
				
				$("#tagname_"+tag_id).empty();
				$("#tagname_"+tag_id).append('<a href="'+site_url+'tags/question/'+tag_id+'">'+tag_name+'</a>'); 
				$("#tag_edit_"+tag_id).attr('onclick','edit_tags('+tag_id+')');
			}
			else{
				alert("Trùng thẻ");
			}
		},
	    error: function(data) {  
			   console.log(data);  
			  
		  }
	});
}