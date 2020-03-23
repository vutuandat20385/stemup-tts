function drawpage_mng_qt_quiz(page){
	cid= $("#inf_cid").val();
	lid=$("#inf_lid").val();
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();
	redrawqttbl_quiz(cid,lid, search,limit,page);
}

function drawlv_mng_qt_quiz(event){
	cid= $("#inf_cid").val();
	lid=$(event).val();
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();
	redrawqttbl_quiz(cid,lid, search,limit,0);
}
function drawlv_mng_qt_link_quiz(lid){
	cid= $("#inf_cid").val();
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();
	redrawqttbl_quiz(cid,lid, search,limit,0);
}

function drawct_mng_qt_quiz(event){
	lid= $("#inf_lid").val();
	cid=$(event).val();
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();
	redrawqttbl_quiz(cid,lid, search,limit,0);
}

function drawct_mng_qt_link_quiz(cid){
	lid= $("#inf_lid").val();
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();
	redrawqttbl_quiz(cid,lid, search,limit,0);
}
function drawlimit_mng_qt_quiz(event){
	limit=$(event).val();
	cid= $("#inf_cid").val();
	lid= $("#inf_lid").val();
	search=$("#inf_search").val();
	redrawqttbl_quiz(cid,lid, search,limit,0);
}
function drawsearch_mng_qt_quiz(event,e){
	lid= $("#inf_lid").val();
	cid= $("#inf_cid").val();
	limit=$("#inf_limit").val();
	 if(e.keyCode=='13'){
     	search= $(event).val();
		redrawqttbl_quiz(cid,lid, search,limit,0);
	 }	
	
}
function drawsearch_mng_qt_btn_quiz(){
	lid= $("#inf_lid").val();
	cid= $("#inf_cid").val();
	limit=$("#inf_limit").val();
    search= $("#search_mng_qt").val();
    redrawqttbl_quiz(cid,lid, search,limit,0);
}

function change_stt_qt(event, quid,qid){
	cl=$(event).parent().attr('class');
	if(cl=="shown"){
		$(event).parent().attr('class',"");
		removequestion(quid,qid);
		pos = arr_qt.indexOf(qid);
		if(pos!=-1)
			arr_qt.splice(pos, 1);
	}
	else{
		$(event).parent().attr('class',"shown");
		addquestion(quid,qid);
		pos = arr_qt.indexOf(qid);
		if(pos==-1)
			arr_qt.push(qid);
	}


}
function redrawqttbl_quiz(cid,lid, search,limit,page){
	
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
	$("#table_question_into_quiz").empty();

    $("#table_question_into_quiz").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');					  
	$.ajax({
		  type: 'POST',
		  url: site_url+"/home_user/create_quiz_data/",
		  data: dt,
		  contentType: 'application/json',
		  success: function(results) {
				quid = $("#inf_quid").val();
				var questions = results['questions'];
				var categories = results['categories'];
				var levels = results['levels'];
				html="<p><b>Thêm câu hỏi vào trong bài kiểm tra</b></p>";
				html+='<div ><span style="float:right; margin-bottom:10px;"><input id="search_mng_qt" style="min-width:250px" placeholder="Tìm kiếm câu hỏi" onkeyup="drawsearch_mng_qt_quiz(this,event)" value="'+search+'"> ';
			     html+='<i class="pointer fas fa-search" onclick="drawsearch_mng_qt_btn_quiz()"></i></span><div>';
				
				html+='<table class="table table-bordered" >';
				html+='<tr style="background-color: rgb(233, 235, 238);">';
				html+='<th></th><th>Câu hỏi<span>';
				html+='<select  style="float:right" onchange="drawlimit_mng_qt_quiz(this)">';
				for(i=1; i<6;i++){
				   html+='<option value="'+(i*5)+'"';
				   if(limit==i*5) {
					   html+=" selected";
				   }
				   html+='>'+(i*5)+' mục</option>';
			    }
				html+='</select></span></th><th>';
				html+='<select style="width:60px" onchange="drawct_mng_qt_quiz(this)">';
				
				html+='<option disabled>Danh mục</option><option ';
				if(cid==0)
					html+=" selected ";
				html+=' value="0">Tất cả</option>';

				for(i=0; i<categories.length; i++){
					html+='<option ';
				   if(categories[i]['cid']==cid)
					   html+=" selected ";
				   html+='value="'+categories[i]['cid'] +'">'+categories[i]['category_name']+'</option>';
			   }
				
				
				html+='</select>';
				html+='</th><th>';
				html+='<select style="width:60px" onchange="drawlv_mng_qt_quiz(this)">';
				html+='<option disabled>Cấp độ</option><option ';
				if(lid==0)
				  html+=" selected ";
				html+=' value="0">Tất cả</option>';
				for(i=0; i<levels.length; i++){
				  html+='<option';
				  if(levels[i]['lid']==lid)
					  html+=" selected ";
				  html+=' value="'+levels[i]['lid'] +'">'+levels[i]['level_name']+'</option>';
				}
				html+='</select>';
				html+='</th>';
				html+='<th>';
				html+='</th>';
				html+='</tr>';
				for(i=0; i<questions.length; i++){ 
					check=false;
					ind=0;
					while(!check && ind<arr_qt.length){
						check=(questions[i]['qid']== arr_qt[ind]);
						ind++;
					}
				    if(!check)
						html+='<tr>';
					else
						html+='<tr class="shown">';
					html+='<td onclick="change_stt_qt(this,'+quid+','+questions[i]['qid']+')" class="details-control" style="width:30px">';
					html+=	'</td>';
					html+=	'<td>';
					html+=	'<b>';
					html+=	'<a class="pointer" onclick="mng_preview_qt_quiz('+questions[i]['qid']+')">';
					html+=	questions[i]['question'];
					html+='</a>';
					html+=	'</b>';	
					html+=	'</td>';
					html+=	'<td>';
					html+=	'<a class="pointer" onclick="drawct_mng_qt_link_quiz('+questions[i]['cid']+')">';
					html+=questions[i]['category_name'];
					html+='</a>';
					html+='</td>';
					html+='<td>';
					html+= '<a class="pointer" onclick="drawlv_mng_qt_link_quiz('+questions[i]['lid']+')">';
					html+=questions[i]['level_name'];
					html+='</a>';
					html+='</td>';
					html+='<td>';
					html+='<a onclick="mng_preview_qt_quiz('+questions[i]['qid']+')"><i class="pointer text-success fas fa-eye" title="Xem trước"></i></a>';
					html+='</td>';
					html+='</tr>';
			  }
			 
						
				
				html+='</table>';
				html+='<p>Đang xem <span id="beginqt">'+Math.min(results.limit*results.page+1,results.num_question)+'</span>';
				html+=' đến <span id="endqt">'+Math.min(results.limit*(results.page+1),results.num_question)+'</span>';
				html+=' trong tổng số <span id="totalqt">'+results.num_question+'</span> câu hỏi<p>';
				
				html+='<center>';
				html+='<ul class="pagination listpage pageqt">';
			    if(results.num_page<7){
				  for(i=0; i<results.num_page; i++){
					  html+='<li class="page-item';
					  if(i==page){
						   html+=' active';
					  }
					  html+='" onclick="drawpage_mng_qt_quiz('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
				  }
				  
				 
			  }
			  else{
				  if(page<=3){
					  for(i=0; i<5; i++){
						  html+='<li class="page-item';
						  if(i==page){
							   html+=' active';
						  }
						  html+='" onclick="drawpage_mng_qt_quiz('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
					  }
					  html+='<li class="page-item"><a class="page-link">...</a></li>';
					  html+='<li class="page-item" onclick="drawpage_mng_qt_quiz('+(results.num_page-1)+')"><a class="page-link">'+results.num_page+'</a></li>';
				  }
				  else{
					  html+='<li class="page-item" onclick="drawpage_mng_qt_quiz(0)"><a class="page-link">1</a></li>';
					  html+='<li class="page-item"><a class="page-link">...</a></li>';
					  
					  if(page<results.num_page-4){
						  html+='<li class="page-item" onclick="drawpage_mng_qt_quiz('+(page-1)+')"><a class="page-link">'+page+'</a></li>';
						  html+='<li class="page-item active" onclick="drawpage_mng_qt_quiz('+page+')"><a class="page-link">'+(page+1)+'</a></li>';
						  html+='<li class="page-item" onclick="drawpage_mng_qt_quiz('+(page+1)+')"><a class="page-link">'+(page+2)+'</a></li>';
						  html+='<li class="page-item"><a class="page-link">...</a></li>';
						  html+='<li class="page-item" onclick="drawpage_mng_qt_quiz('+(results.num_page-1)+')"><a class="page-link">'+results.num_page+'</a></li>';
					  }
					  else{
						  for(i=page-2; i<results.num_page; i++){
							  html+='<li class="page-item';
							  if(i==page){
								  html+=" active";
							  }
							  html+='" onclick="drawpage_mng_qt_quiz('+i+')"><a class="page-link">'+(i+1)+'</a></li>';
						  }
						  
					  }
				  }
			  }
			  html+='</ul>';
			  html+='</center>';
			  $("#table_question_into_quiz").append(html);
			  $("#circularG").remove();
			  
		  },
		  error: function(data) {
			  console.log(data);
			  
		  }
	});
	
}

function mng_preview_qt_quiz(qid){
$.ajax({
		type: "POST",
		data : {},
		url: base_url + "index.php/home_user/get_question/"+qid,
		success: function(results){
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
							//'<tr> <td>Môn học:</td><td style="padding:5px">'+dataq['category_name']+'</td></tr>'+
							//'<tr> <td>Lớp:</td><td style="padding:5px">'+dataq['level_name']+'</td></tr>'+
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

