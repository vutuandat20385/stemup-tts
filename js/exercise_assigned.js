function drawpage_rs3(page){
	search=$("#inf_search3").val();
	limit=$("#inf_limit3").val();
	cid=$("#inf_cid3").val();
	uid=$("#inf_uid3").val();
	redrawrstbl3(search,limit,cid,uid,page);
}

function drawlimit_rs3(event){
	limit=$(event).val();
	search=$("#inf_search3").val();
	cid=$("#inf_cid3").val();
	uid=$("#inf_uid3").val();
	redrawrstbl3(search,limit,cid,uid,0);
}

function drawsearch_rs3(event,e){

	limit=$("#inf_limit3").val();
	cid=$("#inf_cid3").val();
	uid=$("#inf_uid3").val();
	 if(e.keyCode=='13'){
     	search= $(event).val();
		redrawrstbl3(search,limit,cid,uid,0);
	 }	
	
}
function drawct_mng_qt(event){
	
	cid=$(event).val();
	search=$("#inf_search3").val();
	limit=$("#inf_limit3").val();
	uid=$("#inf_uid3").val();
	redrawrstbl3(search,limit,cid,uid,0);
}
function drawct_mng_qt1(event){
	
	uid=$(event).val();
	search=$("#inf_search3").val();
	limit=$("#inf_limit3").val();
	cid=$("#inf_cid3").val();
	redrawrstbl3(search,limit,cid,uid,0);
}

function drawsearch_rs3_btn(){

	limit=$("#inf_limit3").val();
    search= $("#search_rs3").val();
	cid=$("#inf_cid3").val();
	uid=$("#inf_uid3").val();
    redrawrstbl3(search,limit,cid,uid,0);
}


function redrawrstbl3(search,limit,cid,uid,page){
	$("#inf_search3").val(search);
	$("#inf_limit3").val(limit);
	$("#inf_cid3").val(cid);
	$("#inf_uid3").val(uid);
	$("#inf_page3").val(page);
	dt=JSON.stringify({'search':search,
					   'limit':limit,
					   'cid':cid,
					   'uid':uid,
					   'page':page
	                  });	
    $(".data_rs3").empty();
    $(".data_rs3").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');					  
	$.ajax({
		  type: 'POST',
		  url: site_url+"/home_user/get_data_result2/",
		  data: dt,
		  contentType: 'application/json',
		  success: function(data) {
			   var m= ["","","","Toán","Vật Lý","Hóa học","Địa lý","Tin Học","Sinh học","Khoa học","Lịch sử","Công nghệ","Tiếng Anh","Thiên văn - vũ trụ","Robot","Môi trường","Sức khỏe","Văn học","Tiếng Việt","Xã hội","Test IQ","Giáo dục công dân","Tự nhiên và xã hội"];
			         //0 ,1 ,2 ,3     ,4 ,5 ,6 ,7 ,8 ,9 ,10,11,12,13,14,15,16,17,18,19,20,21,22
			  html='<table class="table table-bordered">';
			  html+='<tr style="background-color: rgb(233, 235, 238);">';
			  html+='<th>#</th><th>Người giao </th><th style="min-width:200px;">Câu hỏi đố<span>';
			 
			  html+='<select  style="float:right" onchange="drawlimit_rs3(this)">';
			  for(i=1; i<6;i++){
				   html+='<option value="'+(i*5)+'"';
				   if(limit==i*5) {
					   html+=" selected";
				   }
				   html+='>'+(i*5)+' mục</option>';
			  }
			  html+='</select></span></th>';
			  html+='<th><select style="width:60px" onchange="drawct_mng_qt(this)">';
			  html+='<option value="0">Môn</option><option value="0">Tất cả</option>';
			  if(cid==0){
				  html+=" selected ";
			  html+=' value="0">Tất cả</option>';
			  }
			  for(i=3; i<m.length; i++){
				  html+='<option ';
				 if(i==cid)
					  html+=" selected ";
				  html+='value="'+i+'">'+m[i]+'</option>';
			  }
			 
			  html+='</select></th>';
			  html+='<th><select style="width:60px" onchange="drawct_mng_qt1(this)">';
			  html+='<option value="0">Học sinh</option><option value="0">Tất cả</option>';
			  if(uid==0){
				 html+=" selected ";
			  html+=' value="0">Tất cả</option>'; 
			  }
			  console.log(data.users);
			  for(i=0; i<data.users.length; i++){
				  html+='<option ';
				 if(data.users[i]['uid']==uid)
					  html+=" selected ";
				  html+='value="'+data.users[i]['uid']+'">'+data.users[i]['first_name']+'</option>';
			  }
			  html+='</select></th>';
		      html+='<th>Trạng thái</th>';
			  html+='<th><input id="search_rs3" value="'+search+'" style="min-width:40px; width:80%" onkeyup="drawsearch_rs3(this,event)">';
			  html+='<span><i class="pointer fas fa-search" onclick="drawsearch_rs3_btn()"></i></span>';
			  html+='</th></tr>';
	         
			  for(i=0; i< data.result.length; i++){
				   html+='<tr><td>'+data.result[i]['qaid']+'</td>';
				   html+='<td>'+data.result[i]['fgiao']+" "+data.result[i]['lgiao']+'</td>';
				   html+='<td>'+data.result[i]['question']+'</td>';
				   html+='<td>'+m[data.result[i]['cid']]+'</td>';
				   html+='<td>'+data.result[i]['dfgiao']+" "+data.result[i]['dlgiao']+'</td>';
				   html+='<td>';
				   if(data.result[i].answer) html+= "<span style='color:blue'>Đã trả lời</span>";
				   else html+= "<span style='color:red'>Chưa trả lời</span>";
				   html+='</td>';
				   html+='<td><a target="_blank" href="'+data.result[i]['permalink']+'" >Chi tiết </a></td>';
				   html+='</tr>';
               } 
									 
				html+='</table>';
				$(".data_rs3").append(html);
				
			   $("#totalrs3").empty();
			   $("#totalrs3").append(data.num_result);
			   $("#beginrs3").empty();
			   $("#beginrs3").append(Math.min(data.limit*data.page+1 ,data.num_result));
			   $("#endrs3").empty();
			   $("#endrs3").append(Math.min(data.limit*(data.page+1),data.num_result));
			   
			    $(".pagers3").empty();
				pgihtml="";
				if(data.num_page<7){
					  for(i=0; i<data.num_page; i++){
						  pgihtml+='<li class="page-item';
						  if(i==page){
							   pgihtml+=' active';
						  }
						  pgihtml+='" onclick="drawpage_rs3('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
					  }
					  
					 
				  }
				  else{
					  if(page<=3){
						  for(i=0; i<5; i++){
							  pgihtml+='<li class="page-item';
							  if(i==page){
								   pgihtml+=' active';
							  }
							  pgihtml+='" onclick="drawpage_rs3('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
						  }
						  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
						  pgihtml+='<li class="page-item" onclick="drawpage_rs3('+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
					  }
					  else{
						  pgihtml+='<li class="page-item" onclick="drawpage_rs3(0)"><a class="page-link">1</a></li>';
						  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
						  
						  if(page<data.num_page-4){
							  pgihtml+='<li class="page-item" onclick="drawpage_rs3('+(page-1)+')"><a class="page-link">'+page+'</a></li>';
							  pgihtml+='<li class="page-item active" onclick="drawpage_rs3('+page+')"><a class="page-link">'+(page+1)+'</a></li>';
							  pgihtml+='<li class="page-item" onclick="drawpage_rs3('+(page+1)+')"><a class="page-link">'+(page+2)+'</a></li>';
							  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
							  pgihtml+='<li class="page-item" onclick="drawpage_rs3('+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
						  }
						  else{
							  for(i=page-2; i<data.num_page; i++){
								  pgihtml+='<li class="page-item';
								  if(i==page){
									  pgihtml+=" active";
								  }
								  pgihtml+='" onclick="drawpage_rs3('+i+')"><a class="page-link">'+(i+1)+'</a></li>';
							  }
							  
						  }
					  }
				  }
			    $("#circularG").remove();
				$(".pagers3").append(pgihtml);
		  },
		  error: function(data) {
			  console.log(data);
			  
		  }
	});
	
}