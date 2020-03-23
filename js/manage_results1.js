function drawpage_rs1(page){
	search=$("#inf_search1").val();
	limit=$("#inf_limit1").val();
	uid=$("#inf_uid1").val();
	cid=$("#inf_cid1").val();
	redrawrstbl1(search,limit,uid,cid,page);
}

function drawlimit_rs1(event){
	limit=$(event).val();
	search=$("#inf_search1").val();
	uid=$("#inf_uid1").val();
	cid=$("#inf_cid1").val();
	redrawrstbl1(search,limit,uid,cid,0);
}


function drawsearch_rs1(event,e){

	limit=$("#inf_limit1").val();
	uid=$("#inf_uid1").val();
	cid=$("#inf_cid1").val();
	 if(e.keyCode=='13'){
     	search= $(event).val();
		redrawrstbl1(search,limit,uid,cid,0);
	 }	
	
}
function drawname_mng_qt(event){
	uid=$(event).val();
    search= $("#search_rs1").val();
	limit=$("#inf_limit1").val();
	cid=$("#inf_cid1").val();
    redrawrstbl1(search,limit,uid,cid,0);
}
function drawct_mng_qt(event){
	cid=$(event).val();
    search= $("#search_rs1").val();
	limit=$("#inf_limit1").val();
	uid=$("#inf_uid1").val();
    redrawrstbl1(search,limit,uid,cid,0);
}
function drawsearch_rs1_btn(){

	limit=$("#inf_limit1").val();
    search= $("#search_rs1").val();
	uid=$("#inf_uid1").val();
	cid=$("#inf_cid1").val();
    redrawrstbl1(search,limit,uid,cid,0);
}


function redrawrstbl1(search,limit,uid,cid,page){
	$("#inf_search1").val(search);
	$("#inf_limit1").val(limit);
	$("#inf_uid1").val(uid);
	$("#inf_cid1").val(cid);
	$("#inf_page1").val(page);
	dt=JSON.stringify({'search':search,
					   'limit':limit,
					   'uid' :uid,
					   'cid' :cid,
					   'page':page
	                  });	
    $(".data_rs1").empty();
    $(".data_rs1").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');					  
	$.ajax({
		  type: 'POST',
		  url: site_url+"/home_user/get_data_result1/",
		  data: dt,
		  contentType: 'application/json',
		  success: function(data) {
			  var m= ["","","","Toán","Vật Lý","Hóa học","Địa lý","Tin Học","Sinh học","Khoa học","Lịch sử","Công nghệ","Tiếng Anh","Thiên văn - vũ trụ","Robot","Môi trường","Sức khỏe","Ngữ Văn","Tiếng Việt","Xã hội","Test IQ","Giáo dục công dân","Tự nhiên và xã hội"];
			
			  html='<table class="table table-bordered">';
			  html+='<tr style="background-color: rgb(233, 235, 238);">';
			  
			  html+='<th>#</th>';
			  if(su!=2){
			  html+='<th><span><select style="width:60px" onchange="drawname_mng_qt(this)"><option value="0">Họ tên</option><option value="0">Tất cả</option>';
			for(i=0; i<data.users.length; i++){
				 html+='<option ';
				 if(data.users[i]['uid']==uid)
					  html+=" selected ";
				  html+='value="'+data.users[i]['uid']+'">'+data.users[i]['first_name']+'</option>';
			  }
			}
			  else html+='<th>Họ tên</th>';  
			  
			  
			  html+='</select></span></th>';
			  html+='<th>Câu hỏi đố<select style="float:right;width:60px" onchange="drawct_mng_qt(this)">';
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
			  html+='</select></span></th>';
		      html+='<th>Câu trả lời</th><th>Đáp án đúng</th>';
			  html+='<th><input id="search_rs1" value="'+search+'" style="min-width:40px; width:80%" onkeyup="drawsearch_rs1(this,event)">';
			  html+='<span><i class="pointer fas fa-search" onclick="drawsearch_rs1_btn()"></i></span>';
			  html+='</th></tr>';
	          
			  for(i=0; i< data.result.length; i++){
				   html+='<tr><td>'+data.result[i]['qid']+'</td>';
				   html+='<td>'+data.result[i]['first_name']+" "+data.result[i]['last_name']+'</td>';
				   html+='<td>'+data.result[i]['question']+'</td>';
				   html+='<td>'+String.fromCharCode(parseInt(data.result[i]['option_choice'])+65)+'</td>';
				   html+='<td>'+String.fromCharCode(parseInt(data.result[i]['option_correct'])+65)+'</td>';
				   html+='<td><a target="_blank" href="'+data.result[i]['permalink']+'" >Chi tiết </a></td>';
				   html+='</tr>';
               } 
									 
				html+='</table>';
				$(".data_rs1").append(html);
				
			   $("#totalrs1").empty();
			   $("#totalrs1").append(data.num_result1);
			   $("#beginrs1").empty();
			   $("#beginrs1").append(Math.min(data.limit*data.page+1 ,data.num_result1));
			   $("#endrs1").empty();
			   $("#endrs1").append(Math.min(data.limit*(data.page+1),data.num_result1));
			   
			    $(".pagers1").empty();
				pgihtml="";
				if(data.num_page1<7){
					  for(i=0; i<data.num_page1; i++){
						  pgihtml+='<li class="page-item';
						  if(i==page){
							   pgihtml+=' active';
						  }
						  pgihtml+='" onclick="drawpage_rs1('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
					  }
					  
					 
				  }
				  else{
					  if(page<=3){
						  for(i=0; i<5; i++){
							  pgihtml+='<li class="page-item';
							  if(i==page){
								   pgihtml+=' active';
							  }
							  pgihtml+='" onclick="drawpage_rs1('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
						  }
						  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
						  pgihtml+='<li class="page-item" onclick="drawpage_rs1('+(data.num_page1-1)+')"><a class="page-link">'+data.num_page1+'</a></li>';
					  }
					  else{
						  pgihtml+='<li class="page-item" onclick="drawpage_rs1(0)"><a class="page-link">1</a></li>';
						  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
						  
						  if(page<data.num_page1-4){
							  pgihtml+='<li class="page-item" onclick="drawpage_rs1('+(page-1)+')"><a class="page-link">'+page+'</a></li>';
							  pgihtml+='<li class="page-item active" onclick="drawpage_rs1('+page+')"><a class="page-link">'+(page+1)+'</a></li>';
							  pgihtml+='<li class="page-item" onclick="drawpage_rs1('+(page+1)+')"><a class="page-link">'+(page+2)+'</a></li>';
							  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
							  pgihtml+='<li class="page-item" onclick="drawpage_rs1('+(data.num_page1-1)+')"><a class="page-link">'+data.num_page1+'</a></li>';
						  }
						  else{
							  for(i=page-2; i<data.num_page1; i++){
								  pgihtml+='<li class="page-item';
								  if(i==page){
									  pgihtml+=" active";
								  }
								  pgihtml+='" onclick="drawpage_rs1('+i+')"><a class="page-link">'+(i+1)+'</a></li>';
							  }
							  
						  }
					  }
				  }
			    $("#circularG").remove();
				$(".pagers1").append(pgihtml);
		  },
		  error: function(data) {
			  console.log(data);
			  
		  }
	});
	
}
