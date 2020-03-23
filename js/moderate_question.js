function remove_entry1(redir_cont, message){
	if(confirm("Bạn muốn xóa "+message+" này?")){
		$.ajax({
		  type: 'POST',
		  url: site_url+"/"+redir_cont,
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {},
		  error:function(data) {}
		});
		
		cid= $("#inf_cid").val();
	    lid=$("#inf_lid").val();
	    search=$("#inf_search").val();
	    limit=$("#inf_limit").val();
		page=$("#inf_page").val();
	    redrawqttbl_e(cid,lid, search,limit,page);
		
		
	}

}


function drawpage_mdr_qt(page){
	cid= $("#inf_cid").val();
	lid=$("#inf_lid").val();
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();
	redrawqttbl_e(cid,lid, search,limit,page);
}

function drawlv_mdr_qt(event){
	cid= $("#inf_cid").val();
	lid=$(event).val();
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();
	redrawqttbl_e(cid,lid, search,limit,0);
}
function drawlv_mdr_qt_link(lid){
	cid= $("#inf_cid").val();
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();
	redrawqttbl_e(cid,lid, search,limit,0);
}

function drawct_mdr_qt(event){
	lid= $("#inf_lid").val();
	cid=$(event).val();
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();
	redrawqttbl_e(cid,lid, search,limit,0);
}

function drawct_mdr_qt_link(cid){
	lid= $("#inf_lid").val();
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();
	redrawqttbl_e(cid,lid, search,limit,0);
}
function drawlimit_mdr_qt(event){
	limit=$(event).val();
	cid= $("#inf_cid").val();
	lid= $("#inf_lid").val();
	search=$("#inf_search").val();
	redrawqttbl_e(cid,lid, search,limit,0);
}
function drawsearch_mdr_qt(event,e){
	lid= $("#inf_lid").val();
	cid= $("#inf_cid").val();
	limit=$("#inf_limit").val();
	 if(e.keyCode=='13'){
     	search= $(event).val();
		redrawqttbl_e(cid,lid, search,limit,0);
	 }	
	
}
function drawsearch_mdr_qt_btn(){
	lid= $("#inf_lid").val();
	cid= $("#inf_cid").val();
	limit=$("#inf_limit").val();
    search= $("#search_mdr_qt").val();
    redrawqttbl_e(cid,lid, search,limit,0);
}
function redrawqttbl_e(cid,lid, search,limit,page){
	
	$("#inf_cid").val(cid);
	$("#inf_lid").val(lid);
	$("#inf_search").val(search);
	$("#inf_limit").val(limit);
	$("#inf_page").val(page);
	dt=JSON.stringify({'cid':cid,
	                   'lid':lid,
					   'search':search,
					   'limit':limit,
					   'page':page
	                  });	
    $(".data_mdrq").empty();
    $(".data_mdrq").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');					  
	$.ajax({
		  type: 'POST',
		  url: site_url+"/home_user/get_data_moderate_qbank/",
		  data: dt,
		  contentType: 'application/json',
		  success: function(data) {
			   console.log(data);
			  q= data.questions;
			  var html =' <table class="table table-bordered"><tr style="background-color: rgb(233, 235, 238);"><th>#</th>';
			  html+='<th>Câu hỏi <span><select  style="float:right" onchange="drawlimit_mdr_qt(this)">';
			  for(i=1; i<6;i++){
				   html+='<option value="'+(i*5)+'"';
				   if(limit==i*5) {
					   html+=" selected";
				   }
				   html+='>'+(i*5)+' mục</option>';
			  }
			  
			  html+='</select>';
			 html+='</span></th><th><select style="width:60px" onchange="drawct_mdr_qt(this)">';
			 html+='<option disabled>Danh mục</option><option ';
			  if(cid==0)
				  html+=" selected ";
			  html+=' value="0">Tất cả</option>';

			  for(i=0; i<data.category_list.length; i++){
				  html+='<option ';
				  if(data.category_list[i]['cid']==cid)
					  html+=" selected ";
				  html+='value="'+data.category_list[i]['cid'] +'">'+data.category_list[i]['category_name']+'</option>';
			  }
			  html+=' </select></th><th>';
			  html+='<select style="width:60px" onchange="drawlv_mdr_qt(this)">';
			  html+='<option disabled>Cấp độ</option><option ';
			  if(lid==0)
				  html+=" selected ";
			  html+=' value="0">Tất cả</option>';
			  for(i=0; i<data.level_list.length; i++){
				  html+='<option';
				  if(data.level_list[i]['lid']==lid)
					  html+=" selected ";
				  html+=' value="'+data.level_list[i]['lid'] +'">'+data.level_list[i]['level_name']+'</option>';
			  }
			  html+='</select></th><th colspan="4"><input id="search_mdr_qt" style="width:60px" onkeyup="drawsearch_mdr_qt(this,event)" value="'+search+'"> ';
			  html+='<i class="pointer fas fa-search" onclick="drawsearch_mdr_qt_btn()"></i></th></tr>';
			  
			  for(i=0; i<q.length; i++){
				  html+='<tr><td>'+q[i]['qid']+'</td>';
				  html+='<td><b><a class="pointer" onclick="mdr_preview_qt('+q[i]['qid']+')">'+q[i]['question']+'</a></b></td>';
				  html+='<td><a class="pointer" onclick="drawct_mdr_qt_link('+q[i]['cid']+')">'+q[i]['category_name']+'</a></td>';	
                  html+='<td><a class="pointer" onclick="drawlv_mdr_qt_link('+q[i]['lid']+')">'+q[i]['level_name']+'</a></td>';					  
				  html+='<td><a onclick="mdr_preview_qt('+q[i]['qid']+')"><i class="pointer text-success fas fa-eye" title="Xem trước"></a></td>';		
				  if(q[i]['editable']==1){
					html+='<td><a onclick="mng_edit_question('+q[i]['qid']+')"><i class="pointer text-warning fas fa-pencil-alt" title="Sửa" style="color: #ef00ff;"></i></a></td>';		
					html+='<td><a onclick="mdr_moderate_question('+q[i]['qid']+')"><i class="pointer text-warning fas fa-check-circle" title="Kiểm duyệt" ></i></a></td>';
					html+='<td><a><i class="pointer fas fa-trash-alt" onclick="remove_entry1(\'qbank/remove_question/'+q[i]['qid']+'\', \'câu hỏi\');" title="Xóa"></i></a></td>';	
				  }	 
				  html+='</tr>';
			  }
			  html+="</table>";
			  $(".data_mdrq").append(html);
			  $("#totalqt").empty();
			  $("#totalqt").append(data.num_question);
			   $("#beginqt").empty();
			  $("#beginqt").append(Math.min(data.limit*data.page+1 ,data.num_question));
			   $("#endqt").empty();
			  $("#endqt").append(Math.min(data.limit*(data.page+1),data.num_question));
			  
			  $(".pageqt").empty();
			  pgihtml="";
			  if(data.num_page<7){
				  for(i=0; i<data.num_page; i++){
					  pgihtml+='<li class="page-item';
					  if(i==page){
						   pgihtml+=' active';
					  }
					  pgihtml+='" onclick="drawpage_mdr_qt('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
				  }
				  
				 
			  }
			  else{
				  if(page<=3){
					  for(i=0; i<5; i++){
						  pgihtml+='<li class="page-item';
						  if(i==page){
							   pgihtml+=' active';
						  }
						  pgihtml+='" onclick="drawpage_mdr_qt('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
					  }
					  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
					  pgihtml+='<li class="page-item" onclick="drawpage_mdr_qt('+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
				  }
				  else{
					  pgihtml+='<li class="page-item" onclick="drawpage_mdr_qt(0)"><a class="page-link">1</a></li>';
					  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
					  
					  if(page<data.num_page-4){
						  pgihtml+='<li class="page-item" onclick="drawpage_mdr_qt('+(parseInt(page)-1)+')"><a class="page-link">'+page+'</a></li>';
						  pgihtml+='<li class="page-item active" onclick="drawpage_mdr_qt('+page+')"><a class="page-link">'+(parseInt(page)+1)+'</a></li>';
						  pgihtml+='<li class="page-item" onclick="drawpage_mdr_qt('+(parseInt(page)+1)+')"><a class="page-link">'+(parseInt(page)+2)+'</a></li>';
						  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
						  pgihtml+='<li class="page-item" onclick="drawpage_mdr_qt('+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
					  }
					  else{
						  for(i=page-2; i<data.num_page; i++){
							  pgihtml+='<li class="page-item';
							  if(i==page){
								  pgihtml+=" active";
							  }
							  pgihtml+='" onclick="drawpage_mdr_qt('+i+')"><a class="page-link">'+(i+1)+'</a></li>';
						  }
						  
					  }
				  }
			  }
			   $("#circularG").remove();
			   $(".pageqt").append(pgihtml);
		  },
		  error: function(data) {
			  console.log(data);
			  
		  }
	});
	
}

function mdr_preview_qt(qid){
$.ajax({
		type: "POST",
		data : {},
		url: base_url + "index.php/home_user/get_question/"+qid,
		success: function(results){
			console.log(results);
			$("#previewquestionModal").modal();	
			$("#prqt").empty();
			$("#prqt").append("Câu hỏi #"+ qid);							
			var q = results.data['question'];
			if(q.indexOf("<img")!=-1)
				q=q.replace("<img", "<img width=240 height:160");
			if(q.indexOf("<iframe")!=-1)
				q=q.replace("<iframe", "<iframe height:150");
			
			/*if(q.background_template!=0){
				q='<div  id="qwbgpr" style="font-size: 33px; text-align:center ;font-weight: 700;" >'
				   +'<font color="white"><div style="padding: 120px 27px;text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url(\'https://do.stem.vn/upload/background/'+q.background_template+'.jpg\'); height:300px">'+q+
				 '</div></font></div>';
			}*/
			$("#questionp").empty();
			$("#questionp").append('<b>'+q+'</b>');
			$("#answer-areap").empty();
			opA =results.data['options'][0]['q_option'];
			opB =results.data['options'][1]['q_option'];
			opC =results.data['options'][2]['q_option'];
			opD =results.data['options'][3]['q_option'];
			if(opA.indexOf("<p>")==0)
				opA = opA.substring(3,opA.length-4);
			if(opB.indexOf("<p>")==0)
				opB = opB.substring(3,opB.length-4);
			if(opC.indexOf("<p>")==0)
				opC = opC.substring(3,opC.length-4);
			if(opD.indexOf("<p>")==0)
				opD = opD.substring(3,opD.length-4);
				
			var htmla='<div class="row MB20">'+
						'<div class="col-xs-6"><div id="optAp"> A: '+opA+'</div></div>'+
						'<div class="col-xs-6"><div id="optBp"> B: '+opB+'</div></div>'+
					'</div>'+
					'<div class="row MB20">'+
						'<div class="col-xs-6"><div id="optCp"> C: '+opC+'</div></div>'+
						'<div class="col-xs-6"><div id="optDp"> D: '+opD+'</div></div>'+
					'</div>';													
			$("#answer-areap").append(htmla);
			if(results.data['c_option']==0){
					$('#optAp').prepend("<i class='fa fa-check-circle text-success'></i>");
					$('#optAp').attr("class","text-success");
			}
			else if(results.data['c_option']==1){
				$('#optBp').prepend("<i class='fa fa-check-circle text-success'></i>");
				$('#optBp').attr("class","text-success");
			}
			else if(results.data['c_option']==2){
				$('#optCp').prepend("<i class='fa fa-check-circle text-success'></i>");
				$('#optCp').attr("class","text-success");
			}
			else if(results.data['c_option']==3){
				$('#optDp').prepend("<i class='fa fa-check-circle text-success'></i>");
				$('#optDp').attr("class","text-success");
			}
			
			$("#ndr_btn").attr("onclick","mdr_moderate_question("+qid+")")
			var rating = 0;
			var reviewervalue = 0;
			var reviewercontent = "";
			var reid = 0;
			var reviewcount = results.review.length;
			var reviewcountstr = reviewcount + " người đã đánh giá.";
			if(results.review.length > 0){
				for (var i = results.review.length - 1; i >= 0; i--) {
					rating += parseInt(results.review[i].value);
					if(results.user.uid === results.review[i].reviewer){
						reid = results.review[i].id;
						reviewervalue = results.review[i].value;
						reviewercontent = results.review[i].content;
					}
				}
				rating = rating / results.review.length;
			}
			$("#optionareap").empty();
			var htmlo ='<table>'+
							'<tr> <td>Môn học:</td><td style="padding:5px">'+results.data['category_name']+'</td></tr>'+
							'<tr> <td>Lớp:</td><td style="padding:5px">'+results.data['level_name']+'</td></tr>'+
							'<tr> <td>Giải thích:</td><td style="padding:5px">'+results.data['description']+'</td></tr>'+
							'<tr> <td>Từ khóa:</td><td style="padding:5px">'+results.data['tags']+'</td></tr>'+
							'<tr> <td>Thời gian làm bài:</td><td style="padding:5px">'+results.data['answer_time']+' giây</td></tr>'+
							'<tr> <td>Đánh giá:</td><td style="padding:5px"><a href="javascript:void(0);" onmouseup="rating_item('+ qid+', \'savsoft_qbank\','+reid+','+reviewervalue+',\''+reviewercontent+'\');" title="'+reviewcountstr+'"><input id="rvalue" value="'+rating+'" class="rating rating-loading" data-min="0" data-max="5"  data-size="xs"/></a></td></tr>'+
						'</table>';
			$("#optionareap").append(htmlo);
			$('#rvalue').rating({displayOnly: true, step: 1});
			$('*').keyup(function(e){
				  if(e.keyCode=='27'){
					 $('#previewquestionModal').modal('hide');
				  }       
			  })
			
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	  });
}

function mdr_moderate_question(qid){
	if(confirm("Chấp nhận câu hỏi này?")){
		$.ajax({
		  type: 'POST',
		  url: site_url+"/qbank/moderate_question/"+qid,
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {
			  $("#previewquestionModal").modal("hide");
			  
		  },
		  error:function(data) {}
		});
		
		cid= $("#inf_cid").val();
	    lid=$("#inf_lid").val();
	    search=$("#inf_search").val();
	    limit=$("#inf_limit").val();
		page=$("#inf_page").val();
	    redrawqttbl_e(cid,lid, search,limit,page);
	}
	
}

function drawpage_mdr_quiz(page){

	search=$("#inf_search_quiz").val();
	limit=$("#inf_limit_quiz").val();
	redrawquiztbl(search,limit,page);
}

function drawlimit_mdr_quiz(event){
	limit=$(event).val();
	search=$("#inf_search_quiz").val();
	redrawquiztbl(search,limit,0);
}

function drawsearch_mdr_quiz(event,e){
	limit=$("#inf_limit_quiz").val();
	if(e.keyCode=='13'){
     	search= $(event).val();
		redrawquiztbl(search,limit,0);
	}	
	
}
function drawsearch_mdr_quiz_btn(){
	limit=$("#inf_limit_quiz").val();
    search= $("#search_mdr_quiz").val();
    redrawquiztbl(search,limit,0);
}

function redrawquiztbl(search,limit,page){
	
	$("#inf_search_quiz").val(search);
	$("#inf_limit_quiz").val(limit);
	$("#inf_page_quiz").val(page);
	dt=JSON.stringify({
					   'search':search,
					   'limit':limit,
					   'page':page
	                  });	
    $(".data_mdr_quiz").empty();
    $(".data_mdr_quiz").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');					  
	$.ajax({
		  type: 'POST',
		  url: site_url+"/home_user/get_data_moderate_quiz/",
		  data: dt,
		  contentType: 'application/json',
		  success: function(data) {  
			  q= data.quiz;  
			  var html =' <table class="table table-bordered"><tr style="background-color: rgb(233, 235, 238);"><th>#</th>';
			  html+='<th>Bài trắc nghiệm <span><select  style="float:right" onchange="drawlimit_mdr_quiz(this)">';
			  for(i=1; i<6;i++){
				   html+='<option value="'+(i*5)+'"';
				   if(limit==i*5) {
					   html+=" selected";
				   }
				   html+='>'+(i*5)+' mục</option>';
			  }
			  
			  html+='</select>';
			  html+='</span></th>';
			  html+='<th>Số câu hỏi</th><th colspan="4"><input id="search_mdr_quiz" style="width:60px" onkeyup="drawsearch_mdr_quiz(this,event)" value="'+search+'"> ';
			  html+='<i class="pointer fas fa-search" onclick="drawsearch_mdr_quiz_btn()"></i></th></tr>';
			  
			 for(i=0; i<q.length; i++){
				  html+='<tr><td>'+q[i]['quid']+'</td>';
				  html+='<td><b><a class="pointer" onclick="mdr_preview_quiz('+q[i]['quid']+')">'+q[i]['quiz_name']+'</a></b></td>';
                  html+='<td>'+q[i]['noq']+'</td>';			  				  
				  html+='<td><a onclick="mdr_preview_qt('+q[i]['quid']+')"><i class="pointer text-success fas fa-eye" title="Xem trước"></a></td>';	
				  html+='<td><a onclick="mng_edit_question('+q[i]['qid']+')"><i class="pointer text-warning fas fa-pencil-alt" title="Sửa" style="color: #ef00ff;"></i></a></td>';	
				  html+='<td><a onclick="mdr_moderate_quiz('+q[i]['quid']+')"><i class="pointer text-warning fas fa-check-circle" title="Kiểm duyệt" ></i></a></td>';		
				  html+='<td><a><i class="pointer fas fa-trash-alt" onclick="remove_quiz('+q[i]['quid']+')" title="Xóa"></i></a></td>';		  
				  html+='</tr>';
			  }
			  html+="</table>";
			  
			  $(".data_mdr_quiz").append(html);
			  $("#totalquiz").empty();
			  $("#totalquiz").append(data.num_quiz);
			   $("#beginquiz").empty();
			  $("#beginquiz").append(Math.min(data.limit*data.page+1 ,data.num_quiz));
			   $("#endquiz").empty();
			  $("#endquiz").append(Math.min(data.limit*(data.page+1),data.num_quiz));
			  
			  $(".pagequiz").empty();
			  pgihtml="";
			  if(data.num_page<7){
				  for(i=0; i<data.num_page; i++){
					  pgihtml+='<li class="page-item';
					  if(i==page){
						   pgihtml+=' active';
					  }
					  pgihtml+='" onclick="drawpage_mdr_quiz('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
				  }
				  
				 
			  }
			  else{
				  if(page<=3){
					  for(i=0; i<5; i++){
						  pgihtml+='<li class="page-item';
						  if(i==page){
							   pgihtml+=' active';
						  }
						  pgihtml+='" onclick="drawpage_mdr_quiz('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
					  }
					  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
					  pgihtml+='<li class="page-item" onclick="drawpage_mdr_quiz('+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
				  }
				  else{
					  pgihtml+='<li class="page-item" onclick="drawpage_mdr_quiz(0)"><a class="page-link">1</a></li>';
					  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
					  
					  if(page<data.num_page-4){
						  pgihtml+='<li class="page-item" onclick="drawpage_mdr_quiz('+(parseInt(page)-1)+')"><a class="page-link">'+page+'</a></li>';
						  pgihtml+='<li class="page-item active" onclick="drawpage_mdr_quiz('+page+')"><a class="page-link">'+(parseInt(page)+1)+'</a></li>';
						  pgihtml+='<li class="page-item" onclick="drawpage_mdr_quiz('+(parseInt(page)+1)+')"><a class="page-link">'+(parseInt(page)+2)+'</a></li>';
						  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
						  pgihtml+='<li class="page-item" onclick="drawpage_mdr_quiz('+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
					  }
					  else{
						  for(i=page-2; i<data.num_page; i++){
							  pgihtml+='<li class="page-item';
							  if(i==page){
								  pgihtml+=" active";
							  }
							  pgihtml+='" onclick="drawpage_mdr_quiz('+i+')"><a class="page-link">'+(i+1)+'</a></li>';
						  }
						  
					  }
				  }
			  }
			   $("#circularG").remove();
			   $(".pagequiz").append(pgihtml);
		  },
		  error: function(data) {
			  console.log(data);
			  
		  }
	});
	
}


function mdr_preview_quiz(quid){
	$("#previewquizModal").modal();
	$("#btn_mod_quiz").attr("onclick", "mdr_moderate_quiz("+quid+")");
	$.ajax({
	  type: 'POST',
	  url: site_url+"/quiz/get_quiz_info/"+quid+"/0",
	  data: {},
	  contentType: 'application/json',
	  success: function(data) {
		  //console.log(data);
		   $("#quiztitlepr").empty();				  
		   $("#quiztitlepr").append("<h3>Bài kiểm tra: "+data.quiz['quiz_name']+"</h3>");
		   $("#quizbodypr").empty();
		   html="";
		   if(data.quiz['description'])
				html+='<div><h4>Mô tả:'+data.quiz['description']+'</h4></div>';
		   html+='<div><h4>Thời gian làm bài: '+data.quiz['duration']+' phút </h4></div>';
		   html+="<div><h4>Số lượng câu hỏi:  "+data.quiz['noq']+"</h4></div>";
		   html+="<div><h4>Danh sách câu hỏi:</h4></div>";
		   html+=' <table class="table table-bordered"><tr style="background-color: rgb(233, 235, 238);"><th>#</th>';
		   html+='<th>Câu hỏi</th>';
		   html+='<th>Danh mục</th>';
		   html+='<th>Cấp độ</th></tr>';
		   for(i=0; i<data.question_list.length; i++){
			   html+='<tr>';
			   html+='<td>'+data.question_list[i].qid+'</td>';
			   html+='<td>'+data.question_list[i].question+'</td>';
			   html+='<td>'+data.question_list[i].category_name+'</td>';
			   html+='<td>'+data.question_list[i].level_name+'</td>';
			   html+='</tr>';
		   }	   
	       html+="</table>";
		   
		   num_page = Math.ceil(data.quiz['noq']/5);
		   page=0;
		   pgihtml='<center> <ul class="pagination listpage pagequizqt">';
		   if(num_page<7){
				  for(i=0; i<num_page; i++){
					  pgihtml+='<li class="page-item';
					  if(i==0){
						   pgihtml+=' active';
					  }
					  pgihtml+='" onclick="drawpage_mdr_quiz_qt('+quid+','+i+')"><a class="page-link">'+(i+1)+'</a></li>'
				  }
				  
				 
			  }
			  else{

				  for(i=0; i<5; i++){
					  pgihtml+='<li class="page-item';
					  if(i==0){
						   pgihtml+=' active';
					  }
					  pgihtml+='" onclick="drawpage_mdr_quiz_qt('+quid+','+i+')"><a class="page-link">'+(i+1)+'</a></li>'
				  }
				  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
				  pgihtml+='<li class="page-item" onclick="drawpage_mdr_quiz_qt('+quid+','+(num_page-1)+')"><a class="page-link">'+num_page+'</a></li>';
				  
			  }
     		  pgihtml+='</ul></center>';  

		   
		   $("#quizbodypr").append(html);
		   $("#quizbodypr").append(pgihtml);
		  
	  },
	  error:function(data) {}
	});
	
}

function drawpage_mdr_quiz_qt(quid,page){
	$.ajax({
	  type: 'POST',
	  url: site_url+"/quiz/get_quiz_info/"+quid+"/"+page,
	  data: {},
	  contentType: 'application/json',
	  success: function(data) {
		  console.log(data);
		  //console.log(data);

		   $("#quizbodypr").empty();
		   html="";
		   if(data.quiz['description'])
				html+='<div><h4>Mô tả:'+data.quiz['description']+'</h4></div>';
		   html+='<div><h4>Thời gian làm bài: '+data.quiz['duration']+' phút </h4></div>';
		   html+="<div><h4>Số lượng câu hỏi:  "+data.quiz['noq']+"</h4></div>";
		   html+="<div><h4>Danh sách câu hỏi:</h4></div>";
		   html+=' <table class="table table-bordered"><tr style="background-color: rgb(233, 235, 238);"><th>#</th>';
		   html+='<th>Câu hỏi</th>';
		   html+='<th>Danh mục</th>';
		   html+='<th>Cấp độ</th></tr>';
		   for(i=0; i<data.question_list.length; i++){
			   html+='<tr>';
			   html+='<td>'+data.question_list[i].qid+'</td>';
			   html+='<td>'+data.question_list[i].question+'</td>';
			   html+='<td>'+data.question_list[i].category_name+'</td>';
			   html+='<td>'+data.question_list[i].level_name+'</td>';
			   html+='</tr>';
		   }	   
	       html+="</table>";
		   
		   num_page = Math.ceil(data.quiz['noq']/5);
		   pgihtml='<center> <ul class="pagination listpage pagequizqt">';
		   if(num_page<7){
				  for(i=0; i<num_page; i++){
					  pgihtml+='<li class="page-item';
					  if(i==page){
						   pgihtml+=' active';
					  }
					  pgihtml+='" onclick="drawpage_mdr_quiz_qt('+quid+','+i+')"><a class="page-link">'+(i+1)+'</a></li>'
				  }
				  
				 
			  }
			  else{
				  if(page<=3){
					  for(i=0; i<5; i++){
						  pgihtml+='<li class="page-item';
						  if(i==page){
							   pgihtml+=' active';
						  }
						  pgihtml+='" onclick="drawpage_mdr_quiz_qt('+quid+','+i+')"><a class="page-link">'+(i+1)+'</a></li>'
					  }
					  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
					  pgihtml+='<li class="page-item" onclick="drawpage_mdr_quiz_qt('+quid+','+(num_page-1)+')"><a class="page-link">'+num_page+'</a></li>';
				  }
				  else{
					  pgihtml+='<li class="page-item" onclick="drawpage_mdr_quiz_qt('+quid+',0)"><a class="page-link">1</a></li>';
					  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
					  
					  if(page<data.num_page-4){
						  pgihtml+='<li class="page-item" onclick="drawpage_mdr_quiz_qt('+quid+','+(parseInt(page)-1)+')"><a class="page-link">'+page+'</a></li>';
						  pgihtml+='<li class="page-item active" onclick="drawpage_mdr_quiz_qt('+quid+','+page+')"><a class="page-link">'+(parseInt(page)+1)+'</a></li>';
						  pgihtml+='<li class="page-item" onclick="drawpage_mdr_quiz_qt('+quid+','+(parseInt(page)+1)+')"><a class="page-link">'+(parseInt(page)+2)+'</a></li>';
						  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
						  pgihtml+='<li class="page-item" onclick="drawpage_mdr_quiz_qt('+quid+','+(num_page-1)+')"><a class="page-link">'+num_page+'</a></li>';
					  }
					  else{
						  for(i=page-2; i<num_page; i++){
							  pgihtml+='<li class="page-item';
							  if(i==page){
								  pgihtml+=" active";
							  }
							  pgihtml+='" onclick="drawpage_mdr_quiz_qt('+quid+','+i+')"><a class="page-link">'+(i+1)+'</a></li>';
						  }
						  
					  }
				  }
			  }
     		  pgihtml+='</ul></center>';   

		   
		   $("#quizbodypr").append(html);
		   $("#quizbodypr").append(pgihtml);
		  
	  },
	  error:function(data) {}
	});
}
/************************/
function mdr_moderate_quiz(quid){
	if(confirm("Chấp nhận bài kiểm tra này?")){
		$.ajax({
		  type: 'POST',
		  url: site_url+"/quiz/moderate_quiz/"+quid,
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {
			   search=$("#inf_search_quiz").val();
			   limit=$("#inf_limit_quiz").val();
			   page=$("#inf_page_quiz").val();
			   redrawquiztbl(search,limit,page);
		  },
		  error:function(data) {}
		});
		

	    
	}
}

function remove_quiz(quid){
	if(confirm("Bạn muốn xóa bài kiểm tra này?")){
		$.ajax({
		  type: 'POST',
		  url: site_url+"/quiz/delete_quiz1/"+quid,
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {},
		  error:function(data) {}
		});
		
	    search=$("#inf_search_quiz").val();
	    limit=$("#inf_limit_quiz").val();
		page=$("#inf_page_quiz").val();
	    redrawquiztbl(search,limit,page);
		
		
	}

}
function get_inf_edit_e(){
	qid= $("#qide").html();
	correct_opt=$('input[name=score]:checked').val();
	qt=tinyMCE.get('questione').getContent().trim().replace("<p>","").replace("</p>","");
	optA=tinyMCE.get('optA').getContent().trim().replace("<p>","").replace("</p>","");
	optB=tinyMCE.get('optB').getContent().trim().replace("<p>","").replace("</p>","");
	optC=tinyMCE.get('optC').getContent().trim().replace("<p>","").replace("</p>","");
	optD=tinyMCE.get('optD').getContent().trim().replace("<p>","").replace("</p>","");
	cid=$("#cide").val();
	lid=$("#lide").val();
	descr=tinyMCE.get('descr').getContent().trim().replace("<p>","").replace("</p>","");
	tags=$('#tags').val().trim();
	answer_time=$('#answer_timeedt').val().trim();
	unit=$('#unitmcqedt').val().trim();

	$("#logo_org_e").click(function(){
		$("#logo_org_e").val(1-$("#logo_org_e").val());
	});
	$("#mcq_fun_e").click(function(){
		$("#mcq_fun_e").val(1-$("#mcq_fun_e").val());
	});
    fp = $("#mcq_fun_e").val();
	sl = $("#logo_org_e").val();
	source= $("#sourcemcq_e").val();
    dataqe = JSON.stringify({'qid':qid,
	                        'question':qt,
							'opt0':optA,
							'opt1':optB,
							'opt2':optC,
							'opt3':optD,
							'cid':cid,
							'lid':lid,
							'description':descr,
							'tags':tags,
							'answer_time':answer_time,
							'fp':fp,
							'sl':sl,
							'correct_opt':correct_opt,
							"source":source,
							"unit":unit
                         	});
	$.ajax({
		  type: 'POST',
		  url: site_url+"/qbank/edit_question_0/",
		  data: dataqe,
		  contentType: 'application/json',
		  success: function(data) {
			 console.log(data);
			 $('#editquestionModal').modal('hide');
			 lid= $("#inf_lid").val();
			 cid= $("#inf_cid").val();
			 limit=$("#inf_limit").val();
			 search= $("#inf_search").val();
			 page= $("#inf_page").val();
			 redrawqttbl_e(cid,lid, search,limit,page);
		  },
		  error: function(data) {
			 
			  
		  }
	 });
	
}