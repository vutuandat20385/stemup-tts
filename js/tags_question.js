function drawpage_rs(page){
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();
	tag_id=$("#inf_tag_id").val();
	cid=$("#cid_ctg").val();
	lid=$("#lid_ctg").val();
	inserted_by=$("#ind_ctg").val();
	redrawrstbl(search,limit,page,tag_id,cid,lid,inserted_by);
}

function drawlimit_rs(event){
	limit=$(event).val();
	search=$("#inf_search").val();
	tag_id=$("#inf_tag_id").val();
	cid=$("#cid_ctg").val();
	lid=$("#lid_ctg").val();
	inserted_by=$("#ind_ctg").val();
	redrawrstbl(search,limit,0,tag_id,0,0,0);
}


function drawsearch_rs(event,e){

	limit=$("#inf_limit").val();
	tag_id=$("#inf_tag_id").val();
	cid=$("#cid_ctg").val();
	lid=$("#lid_ctg").val();
	inserted_by=$("#ind_ctg").val();
	if(e.keyCode=='13'){
     	search= $(event).val();
		redrawrstbl(search,limit,0,tag_id,0,0,0);
	}	
	
}
function send_data(event){
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();
	tag_id=$("#inf_tag_id").val();
	cid=$("#cid_ctg").val();
	lid=$("#lid_ctg").val();
	inserted_by=$("#ind_ctg").val();
	redrawrstbl(search,limit,0,tag_id,0,0,0);
}

function drawsearch_rs_btn(){

	limit=$("#inf_limit").val();
    search= $("#inf_search").val();
	tag_id=$("#inf_tag_id").val();
	cid=$("#cid_ctg").val();
	lid=$("#lid_ctg").val();
	inserted_by=$("#ind_ctg").val();
    redrawrstbl(search,limit,0,tag_id,0,0,0);
}
function redrawrstbl(search,limit,page,tag_id,cid,lid,inserted_by){
	$("#inf_search").val(search);
	$("#inf_limit").val(limit);
	$("#inf_page").val(page);
	$("#inf_tag_id").val(tag_id);
	cid=$("#cid_ctg").val();
	lid=$("#lid_ctg").val();
	inserted_by=$("#ind_ctg").val();
	dt=JSON.stringify({'search':search,
					   'limit':limit,
					   'page':page,
					   'tag_id':tag_id,
					   'cid':cid,
					   'lid':lid,
					   'inserted_by':inserted_by
	                  });	
    $(".data_question").empty();
    $(".data_question").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');		
    	
	$.ajax({
		  type: 'POST',
		  url: site_url+"/tags/get_data_tagquestion/",
		  data: dt,
		  contentType: 'application/json',
		  success: function(data) {
			console.log(data);
			html='<div class="data_question"><table class="table table-bordered">';
			html+='<tr><th>#</th><th>Câu hỏi</th><th>Tên danh mục</th><th>Tên cấp độ</th><th>Người tạo</th><th>Hoạt động</th>';
			html+='</tr>';
			
	       
			for(i=0; i< data.result.length; i++){
				   html+='<tr><td>'+data.result[i]['qid']+'</td>';
				   html+='<td >'+data.result[i]['question']+'</td>';
				   html+='<td >'+data.result[i]['category_name']+'</td>';
				   html+='<td >'+data.result[i]['level_name']+'</td>';
				   html+='<td>'+data.result[i]['inserted_by_name']+'</td>';
				   html+='<td>';
				   html+='<a target="__blank" href= "'+site_url+'/qbank/edit_question_1/'+data.result[i]['qid']+'"><i class="pointer text-warning fas fa-pencil-alt" title="Sửa" style="color: #ef00ff;"></i></a>';
				   html+='<a style="margin-left:30px" href="javascript:remove_entry("qbank/remove_question/ '+data.result[i]['qid']+'")"><i class="pointer fas fa-trash-alt" title="Xóa"></i></a>';

				   html+='</td></tr>';
            } 
									 
				html+='</table></div>';
				$(".data_question").empty();
				$(".data_question").append(html);
				
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


