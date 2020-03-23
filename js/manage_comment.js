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
    search= $("#search_rs").val();
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
    $(".data_comment").empty();
    $(".data_comment").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');		
    console.log(19);	
	$.ajax({
		  type: 'POST',
		  url: site_url+"/comment/get_data_comment/",
		  data: dt,
		  contentType: 'application/json',
		  success: function(data) {
			  console.log(1);
			console.log(data);
			html='<table class="table table-bordered">';
			html+='<tr>';
			html+='<th>Post_id</th><th style="min-width:40px; width:40%">Nội dung</th><th>Người tạo</th><th>Ngày tạo/Kiểm tra</th><th>Model</th><th>Câu hỏi/Kiểm tra</th><th>Thay đổi</th>';
			
			html+='</tr>';
	       
			  for(i=0; i< data.result.length; i++){
				   html+='<tr><td>'+data.result[i]['post_id']+'</td>';
				   html+='<td>'+data.result[i]['content']+'</td>';
				   html+='<td>'+data.result[i]['create_name']+'</td>';
				   html+='<td>'+data.result[i]['create_date']+'</td>';
				   html+='<td>'+data.result[i]['model']+'</td>';
				   html+='<td>'+data.result[i]['name']+'</td>';
				   html+='<td><a href="'+site_url+'/comment/delete_comment/'+data.result[i]['post_id']+'" class="btn btn-danger xoa"><i class="fa fa-times"></i> Delete </td>';
				   html+='</tr>';
               } 
									 
				html+='</table>';
				$(".data_comment").append(html);
				
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
			   console.log(2);  
			   console.log(data);  
			  
		  }
	});
	
}
