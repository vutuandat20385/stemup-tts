function manageQuestion_mod(event){
	$("#main_bussiness").attr("style", "");
	$("#new_main_page").attr("style", "display:none");
	load_topmenu("quiz_menu");
	load_tab1();
	$('#home1').empty();
	$('#text-tabs')[0].innerText = "Quản lý câu hỏi";
	var formData = {};
	$.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/home_user/manage_question/",
		success: function(results){
			$('#home1').css('overflow', 'auto');
			$('#home1').append('<table id="tblquestion_2" class="display" style="width:100%"></table>');
			var tbl = $('#tblquestion_2').DataTable({
				responsive: true,
				data: results.data['question'],
				columns: [
					{ "data": "qid","title": "#"},
		            { "data": "question","render":function (data, type, row){
						                       return '<a href="#manage_question" title="Xem trước"><b>'+row.question+'</b></a>';
					                           } ,"title": "Câu hỏi", "width":"80%" ,"class":  "details-control-p"},
		            { "data": "category_name", "title": "Danh mục","render":function (data, type, row){
						                       return '<a href="#manage_question" class="categ">'+row.category_name+'</a>';
					                           }, "width":"30%" ,"orderable":false},
		            { "data": "level_name", "title": "Cấp độ","render":function (data, type, row){
						                       return '<a href="#manage_question" class="lv">'+row.level_name+'</a>';
					                           }, "width":"30%" ,"orderable":false,},
					//{ "data": "rated", "title": "","render":function (data, type, row) { 
					//                                                return show_rating(2.55);
					//												}, 
					//												"class":  "details-control-p", "orderable": false },
				    
					{ "data": null, "title": "","render":function (data, type, row) { 
					                                                return'<a href="#manage_question" title="Xem trước"><i class="fas fa-eye text-success"></i></a>';}
																	, 
																	"class":  "details-control-p", "orderable": false },
		            { "data": "rated", "title": "","render":function (data, type, row) { 
					                                                           
					                                                 if(row.rated==0)
																		return'<a href="#manage_question" title="Câu hỏi chưa được đánh giá! Đề xuất đánh giá câu hỏi này?"><i class="fas fa-exclamation text-warning"></i></a>';
																	  else
																		 return'<a href="#manage_question" title="Đề xuất đánh giá câu hỏi này?"><i class="fas fa-check-circle text-success"></i></a>'; 
																	}, 
																	"class":  "details-control-r", "orderable": false },
				    { "data": "user_code","visible": false,"title": ""},
					{ "data": "create_date","visible": false,"title": ""},
					{ "data": "fun_priory","title": "", "render":function (data, type, row) {
						                                 if(row.fun_priory==1){
															 return'<div style="display:none;">1</div><a href="#manage_question" title="MCQ Fun? Xét duyệt câu hỏi này?"><i class="fas fa-question-circle text-warning"></i></a>';
														 }
														 else if(row.fun_priory==2){
															 return'<div style="display:none;">2</div><a href="#manage_question" title="MCQ Fun! Ghim câu hỏi này lên đầu trang?"><i class="far fa-smile text-danger"></i></a>';
														 }
														 else if(row.fun_priory==3){
															 return'<div style="display:none;">3</div><a href="#manage_question" title="MCQ Fun! Bỏ ghim câu hỏi này?"><i class="fas fa-thumbtack text-info"></i></a>';
														 }
														 else
															 return '';
														}, "class":  "details-control-f", "orderable": false},
				   { "data": null, "title": "","render":function (data, type, row) { 
					                                            if(row.editable==1) {
					                                                return'<a href="#manage_question" title="Sửa"><i class="fas fa-pencil-alt text-warning"></i></a>';}
																	else {return "<p></p>";}}, 
																	"class":  "details-control-e", "orderable": false },
		            { "data": null, "title": "","render":function (data, type, row) { 
					                                            if(row.editable==1) {
					                                                return'<a href="#manage_question" title="Xóa"><i class="fas fa-trash-alt"></i></a>';}
																	else {return "<p></p>";}}
												                 , "class":  "details-control-d", "orderable": false },
		          
		        ],
		        language: langs,
		        order: [[ 8, "desc" ]]
			});

			var avs = '<span>'+
			'<a href="#manage_question" id="advance_search_q" > Tìm kiếm nâng cao </a>'+
			'</span>';
			$("#tblquestion_2_filter").prepend(avs);
			$("#tblquestion_2").prev().append('<div id= "avsval" ></div>');
			$("#advance_search_q").on('click', function(e){
				if(!$("#slat").length)
					$("#avsval").append('<div><p> <label>Người tạo:</label> <select id="slat" style="width:190px; margin-left:20px; "><option value="">Tất cả</option></select> <label style="margin-left:20px">Thời gian tạo:</label> <select id="sltime" style="width:100px; margin-left:20px"><option value="">Mọi lúc</option><option value="1">Giờ qua </option><option value="2">24 giờ qua</option><option value="3">Tuần qua</option></option><option value="4">Tháng qua</option> </option><option value="5">Năm qua</option></select> <a href=""> </div>');
				$("#slat").select2();
				$("#sltime").select2({
					minimumResultsForSearch: -1
				});
				$("#avsval").append('<div style="display:none"> <input id="start_date"> <input id="end_date"></div>');
				$.ajax({
				type: "POST",
				data : {},
				url: base_url + "index.php/propose/get_question_author/",
				success: function(results){
					for(i=0;i<results.length; i++){
						$("#slat").append('<option value="'+results[i].user_code+'">'+results[i].first_name+' '+results[i].last_name+'</option>');
					}
					$("#slat").on('change', function(e){
					    tbl.columns(6)
							.search($("#slat").val())
							.draw();
					    
					});
   
				},
				error: function(xhr,status,strErr){
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}
				});
				
				$("#sltime").on('change',function(e){
					var d = new Date();
					var curentstring =  d.getFullYear()+ "-" + ("0"+(d.getMonth()+1)).slice(-2) + "-" +
                                   ("0" + d.getDate()).slice(-2)  + " " + ("0" + d.getHours()).slice(-2) + ":" +
								   ("0" + d.getMinutes()).slice(-2)+":"+("0" +  d.getSeconds()).slice(-2);
	   				   
					if($("#sltime").val()==""){
						$('#start_date').val("");
					}
					else if($("#sltime").val()=="1"){
						var onehourago = new Date(d.getTime()-60*60*1000); 
						var onehouragostring =  onehourago.getFullYear()+ "-" + ("0"+(onehourago.getMonth()+1)).slice(-2) + "-" +
                                   ("0" + onehourago.getDate()).slice(-2)  + " " + ("0" + onehourago.getHours()).slice(-2) + ":" + 
								   ("0" + onehourago.getMinutes()).slice(-2)+":"+("0" + onehourago.getSeconds()).slice(-2);
						$('#start_date').val(onehouragostring);
					}else if($("#sltime").val()=="2"){
						var yesterday = new Date(d.getTime()-24*60*60*1000); 
						var yesterdaystring =  yesterday.getFullYear()+ "-" + ("0"+(yesterday.getMonth()+1)).slice(-2) + "-" +
                                   ("0" + yesterday.getDate()).slice(-2)  + " " + ("0" + yesterday.getHours()).slice(-2) + ":" + 
								   ("0" + yesterday.getMinutes()).slice(-2)+":"+("0" + yesterday.getSeconds()).slice(-2);
						$('#start_date').val(yesterdaystring);
					}else if($("#sltime").val()=="3"){
						var oneweekago = new Date(d.getTime()-7*24*60*60*1000); 
						var oneweekagostring =  oneweekago.getFullYear()+ "-" + ("0"+(oneweekago.getMonth()+1)).slice(-2) + "-" +
                                   ("0" + oneweekago.getDate()).slice(-2)  + " " + ("0" + oneweekago.getHours()).slice(-2) + ":" + 
								   ("0" + oneweekago.getMinutes()).slice(-2)+":"+("0" +oneweekago.getSeconds()).slice(-2);
						$('#start_date').val(oneweekagostring);
					}else if($("#sltime").val()=="4"){
						var onemonthago = new Date(d.getTime()-30*24*60*60*1000); 
						var onemonthagostring =  onemonthago.getFullYear()+ "-" + ("0"+(onemonthago.getMonth()+1)).slice(-2) + "-" +
                                   ("0" + onemonthago.getDate()).slice(-2)  + " " + ("0" + onemonthago.getHours()).slice(-2) + ":" + 
								   ("0" + onemonthago.getMinutes()).slice(-2)+":"+("0" +onemonthago.getSeconds()).slice(-2);
						$('#start_date').val(onemonthagostring);
					}else if($("#sltime").val()=="5"){
						var oneyearago = new Date(d.getTime()-365*24*60*60*1000); 
						var oneyearagostring =  oneyearago.getFullYear()+ "-" + ("0"+(oneyearago.getMonth()+1)).slice(-2) + "-" +
                                   ("0" + oneyearago.getDate()).slice(-2)  + " " + ("0" + oneyearago.getHours()).slice(-2) + ":" + 
								   ("0" + oneyearago.getMinutes()).slice(-2)+":"+("0" +oneyearago.getSeconds()).slice(-2);
						$('#start_date').val(oneyearagostring);
					}
						
					$('#end_date').val(curentstring);
					tbl.draw();
				});
			
				$.fn.dataTable.ext.search.push(
					function( settings, data, dataIndex ) {
						var startdate =$('#start_date').val();
						var enddate =$('#end_date').val();
						var time = data[7]; 
				        if(startdate==""){
							return true;
						}
						else if (startdate <= time   && time <= enddate ){
							 
							return true;
						}
						else return false;
					}
				);
			});
			
		
			$('#tblquestion_2 thead tr').each(function () {
				$(this).css('background-color', '#e9ebee');
			});
            
			$("[type=search]").attr("placeholder","Tìm kiếm câu hỏi, danh mục, cấp độ");
			$("[type=search]").attr("style","width:250px;");
			$('#tblquestion_2 thead tr').each(function () {
				$(this).css('background-color', '#e9ebee');
			});
            
			$("tbody").find("img").each(function(e){
				$(this).attr("class","col-md-5");
				});
			$("tbody>tr>td>a>b>p>iframe").attr("class","col-md-5");
			$("tbody>tr>td>a>b>p>iframe").attr("height",100);
			$('#tblquestion_2 thead th').each(function () {
		        var title = $(this).text();
				
		        /*if(title == 'Câu hỏi'  ){	
		        	$(this).empty();
		        	$(this).append('<p style="margin-left:-10px">'+title+'   <a style="margin-left:40px" href="#searchq" data-toggle="collapse"><i class="fas fa-search"></i></a></p>'
					                 +' <div  style="margin-left:-10px" id="searchq" class="collapse"><input type="text"  style="width: 240px;" placeholder="Tìm kiếm '+title+'" /></div>' );
		        }*/
				 var html_opt = '';
				 for(i =0; i < results.data['category'].length; i++){
					 html_opt+='<option>'+results.data['category'][i]['category_name']+'</option>';
				 }
				 var html_level = '';
				 for(i =0; i < results.data['level'].length; i++){
					 html_level+='<option>'+results.data['level'][i]['level_name']+'</option>';
				 }
				 if(title == 'Danh mục'  ){	
		        	$(this).empty();
		        	$(this).append(  '<select style="width:90px; margin-left:-20px" id="slc"><option id="optct0">Danh mục</option><option>Tất cả</option>'
									 +html_opt
									 +'</select>' );
					 
		        }
				if(title == 'Cấp độ'  ){	
		        	$(this).empty();
		        	$(this).append('<select style="width:75px;margin-left:-20px" id="slv"><option id="optlv0">Cấp độ</option><option>Tất cả</option>'
									 +html_level
									 +'</select></div>' );
		        }
		    });
            
            
		    tbl.columns().every(function(){
		        var that = this;
		        $('input', this.header()).on('keyup change', function(){
		            if (that.search() !== this.value){
		                that.search(this.value).draw();
		            }
		        });
				
				$('select',this.header()).on('change', function() {
					
				   if (that.search() !== this.value ){
					   
		               
					   if(this.value=="Tất cả"){
						that.search('').draw();
						
					    }
						else{
							that.search(this.value).draw();

						}
					    
					}
					
				});
				
		    });
			 $('#tblquestion_2 tbody').on('click', 'td>a.categ', function (){
				$("#slc").val($(this).html());
				$("#slv").val('Tất cả');
				tbl.column(2).search($(this).html()).draw();
		        tbl.column(3).search('').draw();
			});
			
			 $('#tblquestion_2 tbody').on('click', 'td>a.lv', function (){
				$("#slv").val($(this).html());
				$("#slc").val('Tất cả');
				tbl.column(3).search($(this).html()).draw();
				tbl.column(2).search('').draw();
		   
			});
			
			$("#slc").on('click', function(){
				$("#optct0").prop("disabled", true);
		   
			});
			$("#slv").on('click', function(){
				$("#optlv0").prop("disabled", true);
		   
			});
				 $('#tblquestion_2 tbody').on('click', 'td.details-control-p', function () {
					 var dataq = tbl.row($(this).parent()).data();
					  $.ajax({
						type: "POST",
						data : formData,
						url: base_url + "index.php/home_user/get_question/"+dataq['qid'],
						success: function(results){
							$("#previewquestionModal").modal();	
							$("#prqt").empty();
							$("#prqt").append("Câu hỏi #"+ dataq['qid']);							
							var q = results.data['question'];
							if(q.indexOf("<img")!=-1)
								q=q.replace("<img", "<img width=240 height:160");
							if(q.indexOf("<iframe")!=-1)
								q=q.replace("<iframe", "<iframe height:150");
							if(dataq.background_template!=0 && q.indexOf("<iframe")==-1 && q.indexOf("<img")==-1){
								q='<div  id="qwbgpr" style="font-size: 33px; text-align:center ;font-weight: 700;" >'
								   +'<font color="white"><div style="padding: 120px 27px;text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url(\'https://stemup.app/upload/background/'+dataq.background_template+'.jpg\'); height:300px">'+q+
		                         '</div></font></div>';
							}
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
											'<tr> <td>Môn học:</td><td style="padding:5px">'+dataq['category_name']+'</td></tr>'+
											'<tr> <td>Lớp:</td><td style="padding:5px">'+dataq['level_name']+'</td></tr>'+
											'<tr> <td>Giải thích:</td><td style="padding:5px">'+results.data['description']+'</td></tr>'+
											'<tr> <td>Từ khóa:</td><td style="padding:5px">'+results.data['tags']+'</td></tr>'+
											'<tr> <td>Thời gian làm bài:</td><td style="padding:5px">'+results.data['answer_time']+' giây</td></tr>'+
											'<tr> <td>Đánh giá:</td><td style="padding:5px"><a href="javascript:void(0);" onmouseup="rating_item('+ dataq['qid']+', \'savsoft_qbank\','+reid+','+reviewervalue+',\''+reviewercontent+'\');" title="'+reviewcountstr+'"><input id="rvalue" value="'+rating+'" class="rating rating-loading" data-min="0" data-max="5"  data-size="xs"/></a></td></tr>'+
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
					});
				
				
				$('#tblquestion_2 tbody').on('click', 'td.details-control-r', function () {
					 var dataq = tbl.row($(this).parent()).data();
					 $("#proposeratingModal").modal();
					  $("#titleproposeratingModal").empty();
					 $("#bodyproposeratingModal").empty();
					 $("#titleproposeratingModal").append("Đề xuất đánh giá câu hỏi #"+dataq['qid']);
					 $("#bodyproposeratingModal").append('<table id="tblpr" class="display" style="width:100%"></table>');
					 $.ajax({
						type: "POST",
						data : formData,
						url: base_url + "index.php/user/getteacher",
						success: function(results){
							var pprt_ids=new Array();
							var tblpr = $('#tblpr').DataTable({
								responsive: true,
								data: results,
								columns: [
									{ "data": "uid","title": "#"},
									{ "data": "first_name","title": "Họ và tên", "render":function (data, type, row){
																		  return row.first_name+ " "+ row.last_name;
																	  }},
									{ "data": "email","title": "email", "width":"30%"},
									{ "data": "categories","title": "Dạy môn"},
									{ "data": null, "title": "","render":function (data, type, row) { 
																		return'<input class="cbtc" type="checkbox">';} 
																		, "orderable": false },
									
								],
								language: langs,
								order: [[ 0, "desc" ]],
								lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]]
						   });
						   $("#tblpr_filter>label>[type=search]").attr("placeholder","Tìm kiếm giáo viên");
						   $('#tblpr thead tr').each(function () {
								$(this).css('background-color', '#e9ebee');
							});
						   //$('#tblpr thead th').each(function () {
							//   var title = $(this).text();
							//   if(title == 'check'){
							//		$(this).empty();
							//    	$(this).append('<input type="checkbox" id="cball" style="margin-left:-10px">' );
							//    }
							//});
							//$("#cball").on("change", function(e){
						//		$(".cbtc").prop('checked',true);
						//	});
						   $('#tblpr tbody').on('change', 'td>.cbtc', function () {
							   var tc= tblpr.row($(this).parent().parent()).data();
							   var i = pprt_ids.indexOf(tc.uid);
							   if(i==-1)
									pprt_ids.push(tc.uid);
							   else
								   pprt_ids.splice(i,1);
							  
						   });
						   
						   $("#pprtbutton").on('click', function(e){
							   
								var pprt_str = "";
								for(i=0; i<pprt_ids.length; i++){
									if(i==0)
										pprt_str+=pprt_ids[0];
									else
										pprt_str+=','+pprt_ids[i];
								}
								
								 var pr={'question_id': dataq['qid'],
										 'uid_pprt':pprt_str
									   };
								 var  info_pr =JSON.stringify(pr);
								
								$.ajax({
									type: "POST",
									data : info_pr,
									url: base_url + "index.php/propose/rating_question",
									success: function(results){
										  $("#msg_ppr").remove();
										  $("#home1").parent().prepend("<div id='msg_ppr' class='alert alert-success'>Gửi đề xuất thành công</div>");
									},
									error: function(xhr,status,strErr){
										console.log(xhr);
										console.log(status);
										console.log(strErr);
										$("#msg_ppr").remove();
										$("#home1").parent().prepend("<div id='msg_ppr' class='alert alert-danger'>Gửi đề xuất thất bại</div>");
									}
							    });
						   })
						 //console.log(results);
						},
						error: function(xhr,status,strErr){
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}
					 });
						
					 
				});
			    $('#tblquestion_2 tbody').on('click', 'td.details-control-e', function () {
					 var dataq = tbl.row($(this).parent()).data();
					 if(dataq['editable']==1){
					  $.ajax({
						type: "POST",
						data : formData,
						url: base_url + "index.php/home_user/get_question/"+dataq['qid'],
						success: function(results){
                             //console.log(results);
							 $("#editquestionModal").modal();
							 urlf= base_url + "index.php/qbank/edit_question_1/"+dataq['qid'];
						     $('#editquestionform').attr('action', urlf);
							 cid = results.data['cid'] ;
							 lid = results.data['lid'] ;
							
							 tinymce.init({
								  menubar:false,
								  statusbar: false,
								  selector: '#optA,#optB,#optC,#optD,#descredt',
                                   branding: false,										   
								  images_dataimg_filter: function(img) {
									return img.hasAttribute('internal-blob');
								  },
								   min_height: 40,
								  theme: 'modern',
								  plugins: [
									'placeholder',
									'advlist autolink lists link image jbimages eqneditor charmap print preview hr anchor pagebreak',
									'searchreplace wordcount visualblocks visualchars code fullscreen',
									'insertdatetime media nonbreaking save table contextmenu directionality',
									'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
								  ],
								  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages | eqneditor |print preview media | forecolor backcolor emoticons | codesample help',
								  image_advtab: true,
								   setup: function (theEditor) {
										theEditor.on('focus', function () {
											$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").show();
										});
										theEditor.on('blur', function () {
											$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
										});
										theEditor.on("init", function () {
											$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
										});
									}
								  
								 });
								 tinymce.init({
								  menubar:false,
								  //statusbar: false,
								  selector: 'textarea#questione',
                                   branding: false, 
								  images_dataimg_filter: function(img) {
									return img.hasAttribute('internal-blob');
								  },
								   height: 100,
								  theme: 'modern',
								  plugins: [
									'placeholder',
									'advlist autolink lists link image jbimages eqneditor charmap print preview hr anchor pagebreak',
									'searchreplace  visualblocks visualchars code fullscreen',
									'insertdatetime media nonbreaking save table contextmenu directionality',
									'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
								  ],
								  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages | eqneditor |print preview media | forecolor backcolor emoticons | codesample help',
								  image_advtab: true,
								 
								   setup: function (theEditor) {
										theEditor.on('focus', function () {
											$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").show();
										});
										theEditor.on('blur', function () {
											$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
										});
										theEditor.on("init", function () {
											$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
										});
									}
								  
								 });
							   var q = results.data['question'];
							  if(q.indexOf("<img")!=-1)
								  q=q.replace("<img", "<img width=360 height:270");
                               tinyMCE.get('questione').setContent(q); 
							   tinyMCE.get('optA').setContent(results.data['options'][0]['q_option']); 
							   tinyMCE.get('optB').setContent(results.data['options'][1]['q_option']);
							   tinyMCE.get('optC').setContent(results.data['options'][2]['q_option']); 
							   tinyMCE.get('optD').setContent(results.data['options'][3]['q_option']); 	
							   tinyMCE.get('descredt').setContent(results.data['description']); 								   
                             					  
							 $("#questione").val(results.data['question']);
						
							  $("#optA").val(results.data['options'][0]['q_option']);
							 $("#optB").val(results.data['options'][1]['q_option']);
							 $("#optC").val(results.data['options'][2]['q_option']);
						    $("#optD").val(results.data['options'][3]['q_option']);
							 for(i=0; i<3; i++){
								if(i==results.data['c_option'])
									$("#r"+i).prop("checked",true);

							 }
							 $("#cat"+cid).prop("selected",true);
							 $("#lv"+lid).prop("selected",true);
							 
							$("#descredt").val(results.data['description']);
							 $("#tagsedt").val(results.data['tags']);
							 $("#answer_timeedt").val(results.data['answer_time']);
							// $("#smedt").attr('onclick','save_edit_qt('+dataq['qid']+')');
							
						},
						error: function(xhr,status,strErr){
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}
					 }); }            
				});

				 $('#tblquestion_2 tbody').on('click', 'td.details-control-d', function (){
					 var data = tbl.row($(this).parent()).data();
					 if(data['editable']==1){
						remove_entry('qbank/remove_question/'+data['qid'], 'câu hỏi');
					 }
					 console.log(data);
				});
		         $('#tblquestion_2 tbody').on('click', 'td.details-control-f>a', function () {
					 var data = tbl.row($(this).parent().parent()).data();
					 change_mcqfun_priory(data['qid'], data['fun_priory']);
				 });


		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});
}

function change_mcqfun_priory(qid, priory){
	message='';
	if(priory==1){
		message='Bạn có muốn thêm câu hỏi này vào danh sách MCQ Fun?';
	}
	else if(priory==2){
		message='Bạn có muốn ghim câu hỏi này?';
	}
	else if(priory==3){
		message='Bạn có muốn bỏ ghim câu hỏi này?';
	}
	if(confirm(message)){
		$.ajax({
			type: "POST",
			data : {},
			url: site_url + "/qbank/change_fun_priory/"+qid,
			success: function(results){
				manageQuestion_mod(this);
			},
			error: function(error){
				console.log(error);
			}
		})
	}
}

function checkItem_mod(event){
	$("#main_bussiness").attr("style", "");
	$("#new_main_page").attr("style", "display:none");
	load_topmenu("quiz_menu");
	load_tab1();
	$('#home1').empty();
	$('#text-tabs')[0].innerText = "Kiểm tra";
	$('#home1').attr('style','display:block');
	var formData = {};
	$.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/home_user/manage_quiz_mod/",
		success: function(results){
			console.log(results);
			$('#home1').css('overflow', 'auto');
			$('#home1').append('<table id="tblquiz" class="display" style="width:100%"></table>');
			var tbl = $('#tblquiz').DataTable({
				responsive: true,
				data: results.data,
				columns: [
					{ "data": "quid","title": "#"},
		            { "data": "question","render":function (data, type, row){
						                       return '<b>'+row.quiz_name+'</b>';
					                           } ,"title": "Bài kiểm tra", "width":"50%" ,"class":  "details-control-p"},
					{ "data": "noq","title": "Số lượng câu hỏi","width":"15%"},
					{ "data": "duration","title": "Thời gian làm bài","width":"15%","render":function (data, type, row) { 
														return row.duration + " phút";
																		}},
					{ "data": null, "title": "","render":function (data, type, row) { 
					                                                return'<a href="#manage_quiz" title="Xem trước"><i class="fas fa-eye text-success"></i></a>';}
																	, 
																	"class":  "details-control-p", "orderable": false },													
                    { "data": null, "title": "","render":function (data, type, row) { 
					                                                if(row.nrate==0)
																		return'<a href="#manage_quiz" title="Đề xuất đánh giá"><i class="fas fa-exclamation text-warning"></i></a>';
																	else
																		return'<a href="#manage_quiz" title="Đề xuất đánh giá"><i class="fas fa-check-circle text-success"></i></a>';
																	}, 
																	"class":  "details-control-r", "orderable": false },
					//{ "data": "create_date","visible": false,"title": ""}
		          
		        ],
		        language: langs,
		        order: [[ 0, "desc" ]]
			});
			
			$("[type=search]").attr("placeholder","Tìm kiếm bài kiểm tra");
			$('#tblquiz thead tr').each(function () {
				$(this).css('background-color', '#e9ebee');
			});
			$('#tblquiz tbody').on('click', 'td.details-control-p', function () {
	              $("#previewquizModal").modal();
				  var dataquiz = tbl.row($(this).parent()).data();
				  
				  $("#quiztitlepr").empty();				  
				  $("#quiztitlepr").append("<h3>Bài kiểm tra: "+dataquiz['quiz_name']+"</h3>");
				  $("#quizbodypr").empty();
				  $("#quizbodypr").append('<table id="tblqsqz" class="display" style="width:100%"></table>');
				  var reid=0;
				  var reviewervalue=dataquiz.userrate;
				  if(dataquiz.userrate>0){
					  reid=1;
				  }
				  var reviewercontent=dataquiz.usercomment;
				  var reviewcountstr = dataquiz.nrate + " người đã đánh giá.";
				  var htmlr='<a href="javascript:void(0);" onmouseup="rating_item('+ dataquiz.quid +', \'savsoft_quiz\','+reid+','+reviewervalue+',\''+reviewercontent+'\');" title="'+reviewcountstr+'"><input id="result-rating'+dataquiz.quid+'" value="'+dataquiz.rated+'" class="rating rating-loading" data-min="0" data-max="5"  data-size="cs"/></a>';
				  $("#quiztitlepr").append(htmlr);
				  $('#result-rating'+dataquiz.quid).rating({displayOnly: true, step: 1});
				  $.ajax({
						type: "POST",
						data : formData,
						url: base_url + "index.php/quiz/get_questions/"+dataquiz['quid'],
						success: function(results){
							console.log(results);
							var tblqsqz = $('#tblqsqz').DataTable({
								responsive: true,
								data: results,
								columns: [
									{ "data": "qid","title": "#"},
									{ "data": "question","render":function (data, type, row){
						                       return '<a href="#manage_quiz" title="Xem trước"><b>'+row.question+'</b></a>';
					                           } ,"title": "Câu hỏi", "width":"70%" ,"class":  "details-control-p"},
									{ "data": "category_name", "title": "Danh mục"},
									{ "data": "level_name", "title": "Cấp độ"},
								  
								],
								language: langs,
								order: [[ 0, "desc" ]],
								lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]]
							});
							
							$("#tblqsqz_filter>label>[type=search]").attr("placeholder","Tìm kiếm câu hỏi");
							$('#tblqsqz thead tr').each(function () {
								$(this).css('background-color', '#e9ebee');
							});
							$("tbody>tr>td>a>b>p>img").attr("class","col-md-7");
							$("tbody>tr>td>a>b>p>iframe").attr("class","col-md-7");
							$("tbody>tr>td>a>b>p>iframe").attr("height",150);
							
						},
						error: function(xhr,status,strErr){
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}
				  });
			 });
			
			$('#tblquiz tbody').on('click', 'td.details-control-r', function () {
				 var dataquiz = tbl.row($(this).parent()).data();
				 $("#proposeratingModal").modal();
				 $("#titleproposeratingModal").empty();
				 $("#bodyproposeratingModal").empty();
				 $("#titleproposeratingModal").append("Đề xuất đánh giá bài kiểm tra #"+dataquiz['quid']+': '+dataquiz['quiz_name']);
				 $("#bodyproposeratingModal").append('<table id="tblpr" class="display" style="width:100%"></table>');
				 $.ajax({
						type: "POST",
						data : formData,
						url: base_url + "index.php/user/getteacher",
						success: function(results){
							var pprt_ids=new Array();
							var tblpr = $('#tblpr').DataTable({
								responsive: true,
								data: results,
								columns: [
									{ "data": "uid","title": "#"},
									{ "data": "first_name","title": "Họ và tên", "render":function (data, type, row){
																		  return row.first_name+ " "+ row.last_name;
																	  }},
									{ "data": "email","title": "email", "width":"30%"},
									{ "data": "categories","title": "Dạy môn"},
									{ "data": null, "title": "","render":function (data, type, row) { 
																		return'<input class="cbtc" type="checkbox">';} 
																		, "orderable": false },
									
								],
								language: langs,
								order: [[ 0, "desc" ]],
								lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]]
						   });
						   
						   $("#tblpr_filter>label>[type=search]").attr("placeholder","Tìm kiếm giáo viên");
						   $('#tblpr thead tr').each(function () {
								$(this).css('background-color', '#e9ebee');
						   });
							
						  $('#tblpr tbody').on('change', 'td>.cbtc', function () {
							   var tc= tblpr.row($(this).parent().parent()).data();
							   var i = pprt_ids.indexOf(tc.uid);
							   if(i==-1)
									pprt_ids.push(tc.uid);
							   else
								   pprt_ids.splice(i,1);
							  
						   });
						   
						   $("#pprtbutton").on('click', function(e){
							   
								var pprt_str = "";
								for(i=0; i<pprt_ids.length; i++){
									if(i==0)
										pprt_str+=pprt_ids[0];
									else
										pprt_str+=','+pprt_ids[i];
								}
								
								 var pr={'quiz_id': dataquiz['quid'],
										 'uid_pprt':pprt_str
									   };
								 var  info_pr =JSON.stringify(pr);
								 console.log(info_pr);
								 
								 $.ajax({
									type: "POST",
									data : info_pr,
									url: base_url + "index.php/propose/rating_quiz",
									success: function(results){
										   $("#msg_ppr").remove();
										  $("#home1").parent().prepend("<div id='msg_ppr' class='alert alert-success'>Gửi đề xuất thành công</div>");
									},
									error: function(xhr,status,strErr){
										console.log(xhr);
										console.log(status);
										console.log(strErr);
										$("#msg_ppr").remove();
										$("#home1").parent().prepend("<div id='msg_ppr' class='alert alert-danger'>Gửi đề xuất thất bại</div>");
									}
							    });
						   });
						},
						error: function(xhr,status,strErr){
						console.log(xhr);
						console.log(status);
						console.log(strErr);
					}
				});	
			});
			
            
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});
}


function show_rating(rate){
	html='';
	floorrate=Math.floor(rate);
	halfstar=0
	if(rate-floorrate<0.75 && rate-floorrate>=0.25){
		halfstar=1;
	}
	if(rate-floorrate>=0.75)
	    floorrate++;
	for(i=0; i<floorrate; i++){
		html+='<span><i class="glyphicon glyphicon-star"></i></span>';
	}
	for(i=0; i<halfstar; i++){
		html+='<i class="glyphicon glyphicon-star half"></i>'
	}
	return html;	
}