function drawpage_rs(page){
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();
	cid=$("#inf_cid2").val();
	uid=$("#inf_uid2").val();
	redrawrstbl(search,limit,cid,uid,page);
}

function drawlimit_rs(event){
	limit=$(event).val();
	search=$("#inf_search").val();
	cid=$("#inf_cid2").val();
	uid=$("#inf_uid2").val();
	redrawrstbl(search,limit,cid,uid,0);
}
function drawct_mng_qt2(event){
	cid=$(event).val();
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();
	uid=$("#inf_uid2").val();
	redrawrstbl(search,limit,cid,uid,0);
}
function drawname_mng_qt2(event){
	uid=$(event).val();
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();
	cid=$("#inf_cid2").val();
	redrawrstbl(search,limit,cid,uid,0);
}


function drawsearch_rs(event,e){

	limit=$("#inf_limit").val();
	cid=$("#inf_cid2").val();
	uid=$("#inf_uid2").val();
	 if(e.keyCode=='13'){
     	search= $(event).val();
		redrawrstbl(search,limit,cid,uid,0);
	 }	
	
}
function drawsearch_rs_btn(){

	limit=$("#inf_limit").val();
    search= $("#search_rs").val();
	cid=$("#inf_cid2").val();
	uid=$("#inf_uid2").val();
    redrawrstbl(search,limit,cid,uid,0);
}
function redrawrstbl(search,limit,cid,uid,page){
	$("#inf_search").val(search);
	$("#inf_limit").val(limit);
	$("#inf_cid2").val(cid);
	$("#inf_uid2").val(uid);
	$("#inf_page").val(page);
	dt=JSON.stringify({'search':search,
					   'limit':limit,
					   'cid':cid,
					   'uid' :uid,
					   'page':page
	                  });	
    $(".data_rs").empty();
    $(".data_rs").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');					  
	$.ajax({
		  type: 'POST',
		  url: site_url+"/home_user/get_data_result/",
		  data: dt,
		  contentType: 'application/json',
		  success: function(data) {
			var m= ["Tổ hợp","","","Toán","Vật Lý","Hóa học","Địa lý","Tin Học","Sinh học","Khoa học","Lịch sử","Công nghệ","Tiếng Anh","Thiên văn - vũ trụ","Robot","Môi trường","Sức khỏe","Ngữ Văn","Tiếng Việt","Xã hội","Test IQ","Giáo dục công dân","Tự nhiên và xã hội"];
			
			  html='<table class="table table-bordered">';
			  html+='<tr style="background-color: rgb(233, 235, 238);">';
			  html+='<th>#</th>';
			  if(su!=2){
			  html+='<th><span><select style="width:60px" onchange="drawname_mng_qt2(this)"><option value="0">Họ tên</option><option value="0">Tất cả</option>';
			  for(i=0; i<data.users.length; i++){
				 html+='<option ';
				 if(data.users[i]['uid']==uid)
					  html+=" selected ";
				  html+='value="'+data.users[i]['uid']+'">'+data.users[i]['first_name']+'</option>';
				}
			  }
			  else html+='<th>Họ tên</th>';
			  
			  
			  html+='</select></span></th>';
			  html+='<th style="min-width:200px;">Bài trắc nghiệm<span>';
			  html+='<select style="float:right;width:60px" onchange="drawct_mng_qt2(this)">';
			  html+='<option value="1">Môn</option><option value="1">Tất cả</option>';
			  if(cid==1){
				  html+=" selected ";
			  html+=' value="1">Tất cả</option>';
			  }
			  for(i=0; i<m.length; i++){
				  if(i!=1  && i!=2){
					  html+='<option ';
					  if(i==cid)
						  html+=" selected ";
					  html+='value="'+i+'">'+m[i]+'</option>';
				  }
			  }
			  html+='</select></span></th>';
		      html+='<th>Trạng thái</th><th>%</th>';
			  html+='<th><input id="search_rs" value="'+search+'" style="min-width:40px; width:80%" onkeyup="drawsearch_rs(this,event)">';
			  html+='<span><i class="pointer fas fa-search" onclick="drawsearch_rs_btn()"></i></span>';
			  html+='</th></tr>';
	          
			  for(i=0; i< data.result.length; i++){
				   html+='<tr><td>'+data.result[i]['rid']+'</td>';
				   html+='<td>'+data.result[i]['first_name']+" "+data.result[i]['last_name']+'</td>';
				   html+='<td>'+data.result[i]['quiz_name']+'</td>';
				   html+='<td>'+data.result[i]['result_status']+'</td>';
				   html+='<td>'+Number.parseFloat(data.result[i]['percentage_obtained']).toFixed(0)+'%</td>';
				   html+='<td><a href="'+site_url+'/result/view_result/'+data.result[i]['rid']+'" >Chi tiết </a></td>';
				   html+='</tr>';
               } 
									 
				html+='</table>';
				$(".data_rs").append(html);
				
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
