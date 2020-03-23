$(document).ready(function(){
	$("#slgr").on('click',function(){
		$("#optlb").prop("disabled", true);
	});
	$("#slgr").on('change',function(){
		$("#grade").val($("#slgr").val());
	});
	$("#slct").on('click',function(){
		$("#ctlb").prop("disabled", true);
	});
	
	 if(window.location.hash) {
		var hash = window.location.hash.substring(1); 
		params = hash.split('/');
		
		if(params.length>2){
			if(params[1]=='class'){
				$("#home1").empty();
				load_class(params[2]);
			}   
		}
		
	}
	

	//$("#text-tabs2").attr("style", "display:none");

});
var langs = {
    "sProcessing":   "Đang xử lý...",
    "sLengthMenu":   "Xem _MENU_ mục",
    "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
    "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
    "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
    "sInfoFiltered": "(được lọc từ _MAX_ mục)",
    "sInfoPostFix":  "",
    "sSearch":       "<i class='fas fa-search' style='float:right;margin-top:10px; margin-left:10px'></i>",
    "sUrl":          "",
    "oPaginate": {
        "sFirst":    "Đầu",
        "sPrevious": "Trước",
        "sNext":     "Tiếp",
        "sLast":     "Cuối"
    }
};
function clearData(){
  $("#class_name").val('');
  $("#grade").val('');
  $("#grade_one_choice").attr('style','display:block');
  $("#grade_range_choice").attr('style','display:none');
  $("#rangegrade").empty();
  $("#slgr").val(''); 
  $("#slct").val('');
}
function change_type_grade(type){
	if(type==1){
		$("#grade_range_choice").attr("style","display:block");
		$("#grade_one_choice").attr("style","display:none");
        $("#grade").val('1 - 1');
		$("#slider_range").slider({
			range:true,
			min:1,
			max:12,
			slide: function(event,ui){
				$("#grade").val(ui.values[0]+" - "+ui.values[1]);
				$("#rangegrade").empty();
                $("#rangegrade").append(ui.values[0]+" đến "+ui.values[1]);
			} 
		});
		
	}
	
	else if(type=2){
		$("#grade_range_choice").attr("style","display:none");
		$("#grade_one_choice").attr("style","display:block");
	}
	
}


function create_class2(){
	var clname=$("#class_name").val();
	var grade=$("#grade").val();
	var categ=$("#slct").val();
	if(clname==""){
		if(!$(".class_name_error").length)
			$("#class_name").parent().append("<div class='text-do class_name_error'>Tên lớp không được để trống</div>");       
	}
	else {
		if($(".class_name_error").length)
			$(".class_name_error").remove();
		if(grade==""){

		   if(!$(".level_error").length)
				$("#grade").parent().append("<div class='text-do level_error'>Vui lòng chọn một cấp độ</div>");
	   }
	   else {
		   if($(".level_error").length)
			$(".level_error").remove();
		   if(categ==""){
			   if(!$(".categ_error").length)
					$("#slct").parent().append("<div class='text-do categ_error'>Vui lòng chọn một môn học</div>");
	       }
		   else{
			   
			   if(grade=="0") grade="3,4,5,6,7,8,9,10,11,12,13,14";
			  
			   if(grade.indexOf("-")!=-1){
				   var ar = grade.split(" - ");
				   console.log(ar[0]);
				   grade = parseInt(ar[0])+2;
				   for(i=parseInt(ar[0])+3; i<=parseInt(ar[1])+2; i++){
					   grade+=","+i;
				   }
			   } 
			   if(categ=="0") categ="3,4,5,6,7,8,9,10,11,12,13,14,15,16";
				var cl={'class_name': clname,
						'grade':grade,
						'categ':categ
					   };
				 var class_info =JSON.stringify(cl);
				 console.log(cl);
				 $("#addclassModal").modal('hide');
                 clearData();
				 $.ajax({
				  type: 'POST',
				  url: site_url+"/classes/add_new",
				  data: class_info,
				  contentType: 'application/json',
				  success: function(data) {
					   //window.location.hash="/manage_class#/class/"+data['class_id'];
					   window.location.href =  site_url+"/home_user/list_student_inclass/"+data['class_id'];
                       load_class(data['class_id']);
					   $("#invitestdclassModal").modal({
						   backdrop:'static'
					   });
					   $("#class_code").empty();
					   $("#class_code").append(data['class_code']);
					   $(".message_class").empty();
                       $(".message_class").append("Bạn đã tạo lớp thành công! Hãy sử dụng mã này để thêm học sinh vào trong lớp của mình!")

				  },
				  error : function(data) {
					 console.log(data);
				  }	  
				  
				});
		   }
		}
	}
	
}

function staticstical(class_id,class_code){
		var start = $('#datePicker').val();
		var finish = $('#datePickerTo').val();
	
		// start =$('#datePicker').val();
		var dt = JSON.stringify({
  		'class_id': class_id,
  		'start': start,
  		'finish': finish 
	  	});
	  	console.log(class_code);
		console.log(dt);
		  	$.ajax({
		  		type: "POST",
		  		data: dt,
		  		url: base_url + "index.php/classes/getDate",
		  		contentType: 'application/json',
		  		success: function(results){
		  			
		  			console.log(results);
		  			$("#home1").empty();
		  			$('#home1').css('overflow', 'auto');
					$('#home1').append('<div class="row">');
					$('#home1').append('	<div class="col-md-4" id="div-print"><img src="../../images/print.jpg"></div>');
					$('#home1').append('	<div class="col-md-4" id="div-classcode">Mã lớp <span id="ma_lop">'+class_code+'</span></div>');						
					// $('#home1').append('	<div class="col-md-8" id="div-thongke">');
					abc = "staticstical("+class_id+",'"+class_code+"')";
					$('#home1').append('	<div class="col-md-2" style="position: relative;left: 105px;top: -16px;"><label style="position: relative;left: -57px;top: 32px;">Từ ngày:</label><input type="text" id="datePicker" ></div>');
					$('#home1').append('	<div class="col-md-2" style="position: relative;right: 48px;margin-top: 30px;"><label style="position: relative;left: -64px;top: 32px">Đến ngày:</label><input type="text" id="datePickerTo" ></div>');
					// $('#home1').append('	<div class="col-md-2"><label>         </label><input type="submit" value="Thống kê" id="staticstical" onclick="'+abc+'" style="margin-top: 21px;color: #fff;background-color: #5cb85c;border-color: #4cae4c;margin-right: 74px;position: relative;right: -70px;""></div>');
						// $('#home1').append('

					// $('#home1').append('		<div><button type="button" value="Gửi"></button></div>');
					// $('#home1').append('    </div');

					$('#home1').append('</div>');
					$('#home1').append('<table id="tblclass_mng1" class="display" style="width:100%;margin-top:10px"></table>');
					//$('#home1').append('<button onclick="add_student_to_class('+class_id+')" lass="btn btn-info">Thêm thành viên</button>');
					if(su==2)
						var a='<button onclick="add_student_to_class('+class_id+')" class="btn btn-info">Mời bạn</button>';
					else 
					    var a='<button onclick="add_student_to_class('+class_id+')" class="btn btn-info">Thêm học sinh</button>';
					
					$('#home1').append(a);
					// $(document).ready(function(){
							$('#datePicker').datepicker({
								dateFormat: 'yy-mm-dd 00:00:00'
								});
							$('#datePickerTo').datepicker({
								dateFormat: 'yy-mm-dd 00:00:00'
								});
						// });
						// $(document).ready(function(){
							$('#datePicker').change(function(){
								console.log ($('#datePicker').val());
								var abc=$('#datePickerTo').val();
								var abcd=$('#datePicker').val()
								if(abc==''|| abcd==''){
									// alert('Chưa có giá trị');
								}else{
									// alert('Hàm đã có giá trị');
									staticstical(class_id,class_code);
								}
						    });
						    $('#datePickerTo').change(function(){
								console.log ($('#datePickerTo').val());
								var abc=$('#datePickerTo').val();
								var abcd=$('#datePicker').val()
								if(abc==''|| abcd==''){
									// alert('Chưa có giá trị');
								}else{
									// alert('Hàm đã có giá trị');
									staticstical(class_id,class_code);
								}
						    });
						// });    

					var csu= results['data1']['su'];
					var tbl = $('#tblclass_mng1').DataTable({
						responsive: true,
						data: results.data1,
						columns: [
						    
							{ "data": "member_id", "title": "#"},
							{ "data": "name", "title": "Họ tên", "render":function(data, type, row){
								return row.first_name+" "+row.last_name;
							}},
							{ "data": "email", "title": "Email", "class":"text-center"},
							{ "data": "su", "title": "Chức vụ","render":function (data, type, row){
										var chucvu='';
												if(row.su=='1'){
														 chucvu='Admin';
												} 
												if(row.su=='2'){
													chucvu='Học sinh';
												 } 
												 if(row.su=='3'){
													chucvu='Giáo viên';
												 } 
												 if(row.su=='4'){
													chucvu='Phụ huynh';
												 } 
												 if(row.su=='6'){
													chucvu='Quản trị';
												 } 
												 if(row.su=='8'){
													chucvu='Tổ chức';
												 } 
												 
												return chucvu;
														}, "class":"text-center"},
				      { "data": "DaTL", "title": "Số bài đã làm", "class":"text-center"},
							{ "data": "sum", "title": "Số bài chưa làm", "render":function (data, type, row){
												return  parseInt(row.sum)-parseInt(row.DaTL); 		
														},"class":  "text-center"},
				      { "data": null, "title": "Điểm","render":function (data, type, row){
											return 'Chưa có';
														 } , "class":  "text-center","orderable": false},
				      { "data": null,"render":function (data, type, row){
								           if((csu==3 || csu==1) && row.su==2)
												return '<a href="'+class_id+'" title="Xóa"><i class="far fa-trash-alt"></i></a>';
										   else
											   return '<div></div>'; 
				                           } , "class":  "details-control-1","orderable": false },
				        ],
				        language:langs,
				        order: [[ 0, "asc" ]]
					});

      				$("[type=search]").attr("placeholder","Tìm kiếm theo họ tên, email, ngày sinh");
					$("[type=search]").attr("style","width:250px");
					
					$('#tblclass_mng thead tr').each(function () {
						$(this).css('background-color', '#e9ebee');
					});

					$('#tblclass_mng thead th').each(function () {
				        var title = $(this).text();
				        //if(title !== '#' && title !=''){
				        	//$(this).empty();
				        	//$(this).append('<p>'+title+'</p><input type="text"  style="width: 135px;" placeholder="Tìm kiếm '+title+'" />' );
				       // }
				    });

				    tbl.columns().every(function(){
				        var that = this;
				 
				        //$('input', this.header()).on('keyup change', function(){
				        //    if (that.search() !== this.value){
				       //         that.search(this.value).draw();
				        //    }
				       // });
				    });
                    
					$('#tblclass_mng1 tbody').on('click', 'td.details-control-1>a', function(e){
						var data = tbl.row($(this).parent().parent()).data();
							
           			  	$.ajax({
						 	type: "POST",
							data : {},
							url: base_url + "index.php/classes/remove_student/"+class_id+"/"+data['id'],
							success: function(results){
								console.log(data);
							},
							error: function(xhr,status,strErr){
								console.log(xhr);
								console.log(status);
								console.log(strErr);
							}
						});
							
						$(this).parent().parent().remove();                            
				        //console.log(data);
				    });
				},
				error: function(xhr,status,strErr){
					console.log(xhr);
					console.log(status);
					console.log(strErr);
				}
		  	});
	  	};

function load_class(class_id){
	   $("#main_bussiness").attr("style", "");
	   $("#new_main_page").attr("style", "display:none");
	  
	  $.ajax({
		  type: 'POST',
		  url: site_url+"/classes/load_class/"+class_id,
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {
			  console.log(class_id);
			  console.log(data);
			   var class_code= data['class']['dataitem_code'];
			   console.log(data);
			  if(data['status']==1){
				  
				  $("#bannerpage").empty();
				  var bnhtml = '<div class="line-L">'+
									'<h1>Lớp '+data['class'].dataitem_name+'</h1>'+
									'<p>'+data['class'].name_create_by +' - '+data['class'].level+' - '+data['class'].category+' </p>'+
								'</div>';
				  $("#bannerpage").append(bnhtml);
				  
				  if(!$("#menu_class_"+class_id).length)
						$("#classpage_menu").append('<a href="list_student_inclass'+class_id+'" id="menu_class_'+class_id+'" class="list-group-item" onclick="">'+data['class'].dataitem_name+'</a>');
				  $("#text-tabs2").attr("style", "display:block");

				  $('#text-tabs')[0].innerText = "Thông tin lớp";
				  $('#text-tabs2')[0].innerText = "Thảo luận";
				  
				  // tab post
				  $("#home2").empty();
				  var csu= data['user']['su'];
				  if(!data['user']['photo'])
					  photo=base_url+'/upload/avatar/default.png';
				  else
					  photo=data['user']['photo'];
					var posthtml='<button id="myBtn" onClick="Add_New_Discussion()">Viết bài thảo luận mới</button>'+
								'<div id="writepostclass" style="display:none" class="col-xs-12 box-bor" >'+
				        '<table ><tr><td></td>'+
								'<td style="padding:10px"><textarea placeholder="Viết bài" id="write_post_class" name="write_post_class" style="width:100%;height:50px" required></textarea></td></tr></table>'+
							  '<div style="float: right"> <button class="btn btn-danger" onclick="cancel_post()">Hủy bỏ</button>'+ 
								'<button class="btn btn-info" onclick="write_post_class('+class_id+')" style="margin-left:20px">Đăng bài</button>'+ 
							  '</div>'+	 
				        '</div>'+
							  '<div id="discussion_area" style="margin-top:10px" class="col-xs-12 box-bor"></div>';
				  
					
				  $("#home2").append(posthtml);
                  tinymce.remove("textarea#write_post_class");
				  tinymce.init({
					  menubar:false,
					  //statusbar: false,
					  selector: 'textarea#write_post_class',
					   branding: false, 
					  images_dataimg_filter: function(img) {
						return img.hasAttribute('internal-blob');
					  },
					   height: 100,
					  theme: 'modern',
					  plugins: [
						//'placeholder',
						'tiny_mce_wiris advlist autolink lists link image jbimages eqneditor charmap print preview hr anchor pagebreak',
						'searchreplace  visualblocks visualchars code fullscreen',
						'insertdatetime media nonbreaking save table contextmenu directionality',
						'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
					  ],
					  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages | eqneditor tiny_mce_wiris_formulaEditor| print preview media embed | forecolor backcolor emoticons | codesample help',
					  image_advtab: true,
					 
					   setup: function (theEditor) {
							
							theEditor.addButton('embed', {
							  icon: 'embedcode',
							  tooltip: "Embed",
							  onclick: function() {
								  theEditor.windowManager.open({
										title: 'Insert Embed Code',
										body: [
											{type: 'textbox', name: 'text', size:'1000' , autofocus: true,multiline:true,minHeight:150,minWidth:500,id:'embedcodes'}
										],
										onsubmit: function(e) {
											theEditor.insertContent($('#embedcodes').val());
											
										}
								  });
								}
							});
						}
					  
					 });

					$("#myBtn").click(function(){
						document.getElementById("writepostclass").style = "display:block";
					});
							 
				  
				  load_discussions_class(class_id);
				  
				  //tab member
				  $("#home1").empty();
				  $.ajax({
				 	type: "POST",
					data : {},
					url: base_url + "index.php/classes/get_member/"+class_id,
					success: function(results){
						console.log(results);
						$('#home1').css('overflow', 'auto');
						$('#home1').append('<div class="row">');
						$('#home1').append('	<div class="col-md-4" id="div-print"><img src="../../../images/print.jpg"></div>');
						$('#home1').append('	<div class="col-md-4" id="div-classcode">Mã lớp <span id="ma_lop">'+class_code+'</span></div>');						
						// $('#home1').append('	<div class="col-md-8" id="div-thongke">');
						abc = "staticstical("+class_id+",'"+class_code+"')";
						$('#home1').append('	<div class="col-md-2" style="position: relative;left: 105px;top: -16px;"><label style="position: relative;left: -57px;top: 32px;">Từ ngày:</label><input type="text" id="datePicker" ></div>');
						$('#home1').append('	<div class="col-md-2" style="position: relative;right: 48px;margin-top: 30px;"><label style="position: relative;left: -64px;top: 32px">Đến ngày:</label><input type="text" id="datePickerTo" ></div>');
						// $('#home1').append('	<div class="col-md-2"><label>         </label><input type="submit" value="Thống kê" id="staticstical" onclick="'+abc+'" style="margin-top: 21px;color: #fff;background-color: #5cb85c;border-color: #4cae4c;margin-right: 74px;position: relative;right: -70px;""></div>');
						// $('#home1').append('		<div><button type="button" value="Gửi"></button></div>');
						// $('#home1').append('    </div');

						$('#home1').append('</div>');
						$('#home1').append('<table id="tblclass_mng1" class="display" style="width:100%;margin-top:10px"></table>');
						//$('#home1').append('<button onclick="add_student_to_class('+class_id+')" lass="btn btn-info">Thêm thành viên</button>');
						if(su==2)
							var a='<button onclick="add_student_to_class('+class_id+')" class="btn btn-info">Mời bạn</button>';
						else 
						    var a='<button onclick="add_student_to_class('+class_id+')" class="btn btn-info">Thêm học sinh</button>';
						
						$('#home1').append(a);
						// $(document).ready(function(){
							$('#datePicker').datepicker({
								dateFormat: 'yy-mm-dd 00:00:00'
								});
							$('#datePickerTo').datepicker({
								dateFormat: 'yy-mm-dd 00:00:00'
								});
						// });
						// $(document).ready(function(){
							$('#datePicker').change(function(){
								console.log ($('#datePicker').val());
								var abc=$('#datePickerTo').val();
								var abcd=$('#datePicker').val()
								if(abc==''|| abcd==''){
									// alert('Chưa có giá trị');
								}else{
									// alert('Hàm đã có giá trị');
									staticstical(class_id,class_code);
								}
						    });
						    $('#datePickerTo').change(function(){
								console.log ($('#datePickerTo').val());
								var abc=$('#datePickerTo').val();
								var abcd=$('#datePicker').val()
								if(abc==''|| abcd==''){
									// alert('Chưa có giá trị');
								}else{
									// alert('Hàm đã có giá trị');
									staticstical(class_id,class_code);
								}
						    });
						// });    
						
						

				  
						// $.ajax({
						// 	type: "post",
						// 	// data: {
						// 	// 	class_id: 1,
						// 	// 	diemdau: 2,
						// 	// 	diemcuoi: 3
						// 	// },
						// 	data: dt,
						// 	contentType: 'application/json',
						// 	url: base_url + "index.php/classes/getDate",
						// 	success: function(dataDate){
						// 		$('#home1').append(dataDate);
						// 	},
						// 	error: function(){

						// 	}
						// });
						
						
						
						var tbl = $('#tblclass_mng1').DataTable({
							responsive: true,
							data: results.data,
							columns: [
							    
								{ "data": "member_id", "title": "#"},
								{ "data": "first_name", "title": "Họ tên", "render":function (data, type, row){
									                               return  row.first_name+" "+ row.last_name  ;   
																}},
								{ "data": "email", "title": "Email", "class":"text-center"},
								{ "data": "su", "title": "Chức vụ","render":function (data, type, row){
											var chucvu='';
													if(row.su=='1'){
															 chucvu='Admin';
													} 
													if(row.su=='2'){
														chucvu='Học sinh';
													 } 
													 if(row.su=='3'){
														chucvu='Giáo viên';
													 } 
													 if(row.su=='4'){
														chucvu='Phụ huynh';
													 } 
													 if(row.su=='6'){
														chucvu='Quản trị';
													 } 
													 if(row.su=='8'){
														chucvu='Tổ chức';
													 } 
													 
													return chucvu;
															}, "class":"text-center"},
					      { "data": "DaTL", "title": "Số bài đã làm", "class":"text-center"},
								{ "data": "Tong", "title": "Số bài chưa làm", "render":function (data, type, row){
													return  parseInt(row.Tong)-parseInt(row.DaTL); 		
															},"class":  "text-center"},
					      { "data": null, "title": "Điểm","render":function (data, type, row){
												return 'Chưa có';
															 } , "class":  "text-center","orderable": false},
					      { "data": null,"render":function (data, type, row){
									           if((csu==3 || csu==1) && row.su==2)
													return '<a href="'+class_id+'" title="Xóa" onclick="removestd('+class_id+','+data['member_id']+')"><i class="fas fa-trash"></i></a>';
											   else
												   return '<div></div>'; 
					                           } , "class":  "details-control-1","orderable": false },
					        ],
					        language:langs,
					        order: [[ 0, "asc" ]]
						});
            $("[type=search]").attr("placeholder","Tìm kiếm theo họ tên, email, ngày sinh");
						$("[type=search]").attr("style","width:250px");
						
						$('#tblclass_mng thead tr').each(function () {
							$(this).css('background-color', '#e9ebee');
						});

						$('#tblclass_mng thead th').each(function () {
					        var title = $(this).text();
					        //if(title !== '#' && title !=''){
					        	//$(this).empty();
					        	//$(this).append('<p>'+title+'</p><input type="text"  style="width: 135px;" placeholder="Tìm kiếm '+title+'" />' );
					       // }
					    });
					    tbl.columns().every(function(){
					        var that = this;
					 
					        //$('input', this.header()).on('keyup change', function(){
					        //    if (that.search() !== this.value){
					       //         that.search(this.value).draw();
					        //    }
					       // });
					    });
                        
						/*$('#tblclass_mng1 tbody').on('click', 'td.details-control-1>a', function(e){
							var data = tbl.row($(this).parent().parent()).data();
								
							$.ajax({
								type: "POST",
								data : {},
								url: site_url + "classes/remove_student/"+class_id+"/"+data['id'],
								success: function(results){
									console.log(class_id);
									console.log(data['id']);
								},
								error: function(xhr,status,strErr){
									console.log(xhr);
									console.log(status);
									console.log(strErr);
								}
							});
									
									$(this).parent().parent().remove();                            
					        //console.log(data);
					    });*/
					},
					error: function(xhr,status,strErr){
						console.log(xhr);
						console.log(status);
						console.log(strErr);
					}
				});  
				  
				  
			  }
			  else{
				   window.location.href = site_url+"/home_user/manage_class";
			  }

		  },
		  error : function(data) {
			console.log(data);
		  }	  
		  
	});
	
	
}

function write_post_class(class_id){
	//tinyMCE.activeEditor.getContent({format : 'raw'});
	var content= tinyMCE.get('write_post_class').getContent();
	var content1 = content.replace(/<(?:.|\n)*?>/gm, '');
	var res = content1.replace(/&nbsp;/g,"");
	var ret = res.replace(/\n/g,"");
	var ress= ret.split(' ').join('');
	console.log(content);
	if(ress.length==0){
		alert('Bạn chưa nhập nội dung thảo luận. Vui lòng nhập nội dung');
	}else{
		var post = JSON.stringify({'content':content});
		$.ajax({
			  type: 'POST',
			  url: site_url+"/classes/write_post/"+class_id,
			  data: post,
			  contentType: 'application/json',
			  success: function(data) {
				tinyMCE.get('write_post_class').setContent('');
				 load_discussions_class(class_id);
			  },
			  error : function(data) {
				 console.log(data);
			  }	  
			  
		});
	}
}

function cancel_post(){
	tinyMCE.get('write_post_class').setContent('');
}

function padding_number(number){
	if(number<10){
		return "0"+number;
	}
	else
		return number;
}
function to_string_datetime(string_datetime){
	var curenttime= new Date();
	var date = new Date(string_datetime);
	var diffsec = Math.floor((curenttime-date)/1000);
	
	if(diffsec<20)
		return 'vài giây trước';
	else{
		var diffmin =Math.floor(diffsec/60);
		if(diffmin<60)
			return diffmin+" phút trước";
		else{
			var diffhour= Math.floor(diffmin/60);
			if(diffhour<24)
				return diffhour+" giờ trước";
			else  				
				return padding_number(date.getHours())+ ":" + padding_number(date.getMinutes()) +" "+ padding_number(date.getDate()) + '/' + padding_number(date.getMonth()+1) + '/' +  padding_number(date.getFullYear());
		}
			
	}
	
    
}

function load_discussions_class(class_id){
	$("#discussion_area").empty();
	var max_post=5;
	$.ajax({
		  type: 'POST',
		  url: site_url+"/classes/load_discussion/"+class_id+"/0/"+max_post,
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {
			  $("#discussion_area").append('');
			  if(data['post'].length==0) $("#discussion_area").append('<h5 style="text-align:center">Chưa có bài thảo luận nào!!!</h5>');
			  else{
				  data_length=data['post'].length;
				  if(data_length==max_post+1)
					  data_length--;
				  for(i=0; i<data_length; i++){
					 if(data['cuid']==data['post'][i]['uid'])
						 temp = '<div class="box-post1 col-md-12"';
					 else 
					     temp = '<div class="box-post1 col-md-12"';
					if(!data['post'][i]['photo'])
						photo=base_url+'/upload/avatar/default.png';
				   	else
						photo=data['post'][i]['photo'];
					content=data['post'][i].content;

					index =content.indexOf('<img src');
					while(index>-1){
						content=content.substr(0,index+4) + ' style="max-width:100%" '+content.substr(index+4);
						index =content.indexOf('<img src');
					}

					
					var  post= temp+'<div class=""><div class="discussion-header col-md-12">'+
													'		<div class="col-md-1">'+
													'			<img class="img-circle MR5" src="'+photo+'" alt="">'+
													'				</div>'+
													'		<div class="col-md-8">'+
													'			<strong><a class="user_name">'+data['post'][i].first_name+' '+ data['post'][i].last_name+'</a></strong> đã đăng một thảo luận<br>'+
													'			Lúc <span style="">'+to_string_datetime(data['post'][i].create_date)+'</span>'+
													'		</div>'+
													'		<div class="star col-md-3"><img src="../../../images/star.gif"></div>'+
													'</div>'+
													'<div class="settingpost col-md-12"><i class="fas fa-cog"></i></div><p style="margin-top:5px">'+content+'</p></div>'+
													'<p><div><h6 class="text-reply col-md-12"><a href="#" style="" onclick="replypost_class(this,'+data['post'][i]['post_id']+','+class_id+')">Trả lời (<span id="nreply_'+data['post'][i].post_id+'">'+data['post'][i].nreply+'</span>)</a>'+
													'</h6></div></div></p>';
						
					post+='<div class="div-reply col-md-12" id="reply_post_'+data['post'][i]['post_id']+'">';  
					reply_length=data['post'][i]['reply'].length;
					if(reply_length==3)
						  reply_length=2;
					for(j=0; j<reply_length; j++){
						if(!data['post'][i]['reply'][j]['photo'])
							photo_reply=base_url+'/upload/avatar/default.png';
						else
							photo_reply=data['post'][i]['reply'][j]['photo'];
						post+='<h6 style="" class="replies"><div><img class="img-circle MR5 reply-avatar" src="'+photo_reply+'" alt="" width="32"><strong><a class="user_name">'+data['post'][i]['reply'][j].first_name+' '+ data['post'][i]['reply'][j].last_name+'</a></strong>'+
						'<div class="settingpost"><i class="fas fa-cog"></i></div>'+data['post'][i]['reply'][j].content+'</div> '+
						'</h6>';
					}
					if(data['post'][i]['reply'].length>=2)
						rpivot = data['post'][i]['reply'][data['post'][i]['reply'].length-2]['post_id'];
					else
						rpivot = data['post'][i]['reply']['post_id'];	
					if(data['post'][i]['reply'].length==3)
						post+='<h6 id="showmore_reply_'+data['post'][i]['post_id']+'" style="" class="showmore-text"> <a href="#" onclick="load_more_reply_class('+data['post'][i]['post_id']+','+rpivot+')">Xem thêm các phản hồi</a></h6>';   
						post+='</div>';       
						$("#discussion_area").append(post);
					
				  }
				  if(data['post'].length>=2)
						pivot = data['post'][data['post'].length-2]['post_id'];
				  else
					    pivot=pivot = data['post'][0]['post_id'];
				  if(data['post'].length==max_post+1)
					$("#discussion_area").append('<a style="float:right;" href="#" id="load_more_discussion_class" onclick="load_more_discussion_class('+class_id+','+pivot+')">Xem thêm</a>');
			  }
				  
              
		  },
		  error : function(data) {
			 console.log(data);
		  }	  
		  
	});
}

function load_more_discussion_class(class_id, pivot){
	var max_post=5;
	$.ajax({
		  type: 'POST',
		  url: site_url+"/classes/load_discussion/"+class_id+"/"+pivot+"/"+max_post,
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {
              data_length=data['post'].length;
			  if(data_length==max_post+1)
					  data_length--;
			  for(i=0; i<data_length; i++){
					 if(data['cuid']==data['post'][i]['uid'])
						 temp = '<div class="box-post1 col-md-12"';
					 else 
						 temp = '<div class="box-post1 col-md-12"';
					 if(!data['post'][i]['photo'])
						photo=base_url+'/upload/avatar/default.png';
					else
						photo=data['post'][i]['photo'];
					content=data['post'][i].content;
					index =content.indexOf('<img src');
					while(index>-1){
						content=content.substr(0,index+4) + ' style="max-width:550px" '+content.substr(index+4);
						index =content.indexOf('<img src');
					}
					var  post= temp+' style="margin:5px"><img class="img-circle MR5" src="'+photo+'" alt="" width="32"><strong><a class="user_name">'+data['post'][i].first_name+' '+ data['post'][i].last_name+'</a></strong>'+
						'<div class="settingpost"><i class="fas fa-cog"></i></div><p style="margin-top:5px">'+content+'</p></div> '+
						'<p><div><h6><a href="#" style="" onclick="replypost_class(this,'+data['post'][i]['post_id']+','+class_id+')">Trả lời (<span id="nreply_'+data['post'][i].post_id+'">'+data['post'][i].nreply+'</span>)</a>'+
						'<span style="float:right">'+to_string_datetime(data['post'][i].create_date)+'</span></h6></div></p>';
					reply_length=data['post'][i]['reply'].length;
					if(reply_length==3)
						  reply_length=2;
					for(j=0; j<reply_length; j++){
						if(!data['post'][i]['reply'][j]['photo'])
							photo_reply=base_url+'/upload/avatar/default.png';
						else
							photo_reply=data['post'][i]['reply'][j]['photo'];
						post+='<h6 style=""><div><img class="img-circle MR5" src="'+photo_reply+'" alt="" width="32"><strong><a class="user_name">'+data['post'][i]['reply'][j].first_name+' '+ data['post'][i]['reply'][j].last_name+'</a></strong>'+
						'<div class="settingpost"><i class="fas fa-cog"></i></div>'+data['post'][i]['reply'][j].content+'</div> '+
						'</h6>';
					}
					if(data['post'][i]['reply'].length>=2)
						rpivot = data['post'][i]['reply'][data['post'][i]['reply'].length-2]['post_id'];
					else
						rpivot = data['post'][i]['reply']['post_id'];	
					if(data['post'][i]['reply'].length==3)
						post+='<h6 id="showmore_reply_'+data['post'][i]['post_id']+'" style="margin-left:10%"> <a href="#" onclick="load_more_reply_class('+data['post'][i]['post_id']+','+rpivot+')">Xem thêm các phản hồi</a></h6>';   
					post+='</div>';   			
					$("#discussion_area").append(post);
				
			  }
			   if(data['post'].length>=2)
					pivot = data['post'][data['post'].length-2]['post_id'];
			   else
					pivot = data['post'][0]['post_id'];
			  $("#load_more_discussion_class").remove();
			  if(data['post'].length==max_post+1)
					$("#discussion_area").append('<a style="float:right;" href="#" id="load_more_discussion_class" onclick="load_more_discussion_class('+class_id+','+pivot+')">Xem thêm</a>');
			  
				  
              
		  },
		  error : function(data) {
			 console.log(data);
		  }	  
		  
	});
}
function load_more_reply_class(parent_id, pivot){
	var max_post=5;
	
	$.ajax({
		  type: 'POST',
		  url: site_url+"/classes/load_reply/"+parent_id+"/"+pivot+"/"+max_post,
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {	
			  data_length=data['post'].length;
			  if(data_length==max_post+1)
				 data_length--;
			  for(i=0; i<data_length; i++){
				if(!data['post'][i]['photo'])
				  photo_reply=base_url+'/upload/avatar/default.png';
				else
				photo_reply=data['post'][i]['photo'];		
				  $("#reply_post_"+parent_id).append('<h6 style=""><img class="img-circle MR5 reply-avatar" src="'+photo_reply+'" alt="" width="32"><strong><a class="user_name">'+data['post'][i].first_name+' '+ data['post'][i].last_name+'<a></strong><div class="settingpost"><i class="fas fa-cog"></i></div> '+data['post'][i].content+'</div></h6>');
			  }
			   if(data['post'].length>=2)
					rpivot = data['post'][data['post'].length-2]['post_id'];
			   else
					rpivot = data['post'][0]['post_id'];
			  $("#showmore_reply_"+parent_id).remove();
			  if(data['post'].length==max_post+1)
				  $("#reply_post_"+parent_id).append('<h6 id="showmore_reply_'+parent_id+'" style="" class="showmore-text"> <a href="#" onclick="load_more_reply_class('+parent_id+','+rpivot+')">Xem thêm các phản hồi</a></h6>');
			  
		  },
		  error : function(data) {
			 console.log(data);
		  }	  
	});	  
}
function replypost_class(event,post_id,class_id){
	$("[class=replyform]").remove();
	$(event).parent().append('<p style="margin-top:10px"><textarea class="replyform" id="reply_'+post_id+'" style="width:94%; margin-left:5%" required autofocus ></textarea><p>');
	$('#reply_'+post_id).keyup(function(e){
		  if(e.keyCode=='13'){
			  var content=$(this).val();
			 if(content && content.trim().length>0){
				
				 var reply = JSON.stringify({'content':content.replace('\n','')});
				 $.ajax({
					  type: 'POST',
					  url: site_url+"/classes/write_post/"+class_id+"/"+post_id,
					  data: reply,
					  contentType: 'application/json',
					  success: function(data) {
						    srcphoto = $("#avt").attr('src');
							us_name=$("#username").html();
							$nreply =parseInt($("#nreply_"+post_id).html())+1;
							$("#nreply_"+post_id).empty();
							$("#nreply_"+post_id).append($nreply+'');
							if($("#reply_post_"+post_id).children().first().length){
								$("#reply_post_"+post_id).children().first().prepend('<h6><img class="img-circle MR5" src="'+srcphoto+'" alt="" width="32"><strong><a class="user_name">'+us_name+'<a></strong><div class="settingpost"><i class="fas fa-cog"></i></div> '+content+'</div></h6>');
							}
							else{
								$("#reply_post_"+post_id).append('<h6 style="margin-left:10%"><img class="img-circle MR5" src="'+srcphoto+'" alt="" width="32"><strong><a class="user_name">'+us_name+'<a></strong><div class="settingpost"><i class="fas fa-cog"></i></div> '+content+'</div></h6>');
							}
					  },
					  error : function(data) {
						 console.log(data);
					  }	  
					  
				});
				 $(this).remove();
			 }
		  }       
	  })
	
	
}



function add_student_to_class(class_id){
	console.log();
	$("#classaddstdModal").modal();
	$('#bodyclassaddstdmodal').empty();
	console.log(class_id);
	$.ajax({
	 	type: "POST",
		data : {},
		url: base_url + "index.php/classes/get_student_1/"+class_id,
		success: function(results){
			console.log(results)
			$('#bodyclassaddstdmodal').append('<table id="tblstd" class="display" style="width:100%"></table>');
			var tbl = $('#tblstd').DataTable({
				responsive: true,
				data: results,
				columns: [
					{ "data": null,"title": "","class":"details-control" ,"render":function (data, type, row){
						                       return "";
					                           } },
		            { "data": null,"render":function (data, type, row){
						                       return data.first_name+" "+data.last_name;
					                           } ,"title": "Họ tên"},
		            { "data": "email", "title": "Email" },
		            { "data": "birthdate", "title": "Ngày sinh","class":"hide_ebcstd" },
					{ "data": "user_code", "title": "Mã học sinh","class":"hide_ebcstd" }
					
		        ],
		        language:langs,
		        order: [[ 0, "desc" ]]
			});
			
		    $('#tblstd tbody').on('click', 'td.details-control', function () {
				var tr = $(this).closest('tr');
				var row = tbl.row( tr );
				if (tr.hasClass('shown')){

					removestd(class_id, row.data().uid);
					row.child.hide();
					tr.removeClass('shown');
				}else{
					addstd(class_id, row.data().uid);
					row.child.show();
					tr.addClass('shown');
				}
			});
	 },
	 error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});
}


function addstd (clsss_id, uid){
	$.ajax({
		type: "POST",
		data : {},
		url: site_url + "/classes/add_student/"+clsss_id+'/'+uid,
		success: function(data){
			
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}	
	});	
}
function reload_student(class_id){
	window.location.href =  site_url+"/home_user/list_student_inclass/"+class_id;
}

function removestd (clsss_id, uid){
	$.ajax({
		type: "POST",
		data : {},
		url: site_url + "/classes/remove_student/"+clsss_id+'/'+uid,
		success: function(data){
			
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}	
	});	
}
function reload_mb(){    
	location.reload();
}
/*function accept_join_class(class_id,uid){
    dt = JSON.stringify({
		'class_id': class_id,
        'uid':uid,
        
    });
        $.ajax({
            type: "POST",
            url: site_url+'/classes/check_user_class',
            data: dt,
            contentType: 'application/json',
            success: function(data){
                if(data['check']==1){
                    alert('Bạn đã tham gia lớp trước đó');
                    window.location.href =  site_url+"/home_user/list_student_inclass/"+class_id;
                }else{
                    if(confirm('Bạn có muốn tham gia lớp?')){
                        $.ajax({
                            type: "POST",
                            url: site_url+'/classes/join_class',
                            data:dt,
                            contentType:'application/json',
                            success: function(data){
                                window.location.href =  site_url+"/home_user/list_student_inclass/"+class_id;
                            },
                            error: function(data){
                            }
                        })
                    }
                }
            },
            error: function(data){
            }
        })
		return true;
}*/
function accept_join_friendclass(class_id,uid,f_id){
	dt1 = JSON.stringify({
		'class_id': class_id,
		'f_id':f_id
	});
	$.ajax({
            type: "POST",
            url: site_url+'/classes/check_friend_class',
            data: dt1, 
            contentType: 'application/json',
            success: function(data){
                if(data['check']==1){
                    alert('Bạn đã phê duyệt trước đó!');
                    window.location.href =  site_url+"/home_user/list_student_inclass/"+class_id;
				}else{
					if(confirm('Phê duyệt!')){
						dt = JSON.stringify({
								'class_id': class_id,
								'uid':uid,
								'f_id':f_id
							});
						$.ajax({			
							type: "POST",
							url: site_url+'/classes/join_friendclass',
							data:dt,
							contentType:'application/json',
							success: function(data){
								
								console.log(111111);
								window.location.href =  site_url+"/home_user/list_student_inclass/"+class_id;
							},
							error: function(data){
								console.log(data);
							}
						});
					}
				}
			},
			error: function(data){
				console.log(data);
            }
	});
	return true;
}
function wait_determine(class_id){
	dt = JSON.stringify({
		'class_id': class_id
	});
	$.ajax({			
		type: "POST",
		url: site_url+'/classes/check_friend1_class',
		data:dt,
		contentType:'application/json',
		success: function(data){
			if(data['check']==1){
                window.location.href =  site_url+"/home_user/list_student_inclass/"+class_id;
			}else{
				console.log(class_id);
				alert('Đang chờ giáo viên phê duyệt!');
			}
		},
		error: function(data){
			console.log(data);
		}
	});
	
}
function class_exist(class_id){
	dt = JSON.stringify({
		'class_id': class_id
	});
	$.ajax({			
		type: "POST",
		url: site_url+'/classes/class_exist',
		data:dt,
		contentType:'application/json',
		success: function(data){
			console.log(data);
			if(data.status==1){
				window.location.href =  site_url+"/home_user/list_student_inclass/"+class_id;
			}
			else{
				alert('Lớp không còn tồn tại!');
			}
		},
		error: function(data){
			console.log(data);
		}
	});
}