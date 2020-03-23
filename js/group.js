$(document).ready(function(){
	$("#slgr2").on('click',function(){
		$("#optlb2").prop("disabled", true);
	});
	$("#slgr2").on('change',function(){
		$("#grade2").val($("#slgr2").val());
	});
	$("#slct2").on('click',function(){
		$("#ctlb2").prop("disabled", true);
	});
});

function change_type_grade2(type,first,last){
	if(type==1){
		if(first == null && last == null){
			$("#grade_range_choice2").attr("style","display:block");
			$("#grade_one_choice2").attr("style","display:none");
					$("#grade2").val('1 - 1');
			$("#slider_range2").slider({
				range:true,
				min:1,
				max:12,
				slide: function(event,ui){
					$("#grade2").val(ui.values[0]+" - "+ui.values[1]);
					$("#rangegrade2").empty();
									$("#rangegrade2").append(ui.values[0]+" đến "+ui.values[1]);
				} 
			});
		}else{
			$("#grade_range_choice2").attr("style","display:block");
			$("#grade_one_choice2").attr("style","display:none");
					$("#grade2").val(first +' - '+ last);
			$("#slider_range2").slider({
				range:true,
				min:1,
				max:12,
				values: [first,last],
				slide: function(event,ui){
					$("#grade2").val(ui.values[0]+" - "+ui.values[1]);
					$("#rangegrade2").empty();
									$("#rangegrade2").append(ui.values[0]+" đến "+ui.values[1]);		
				} 
			});
		}
	}
	else if(type==2){
		$("#grade_range_choice2").attr("style","display:none");
		$("#grade_one_choice2").attr("style","display:block");
	}
}

function clearData(){
  $("#sg_name").val('');
  $("#sg_des").val('');
  $("#grade2").val('');
  $("#grade_one_choice2").attr('style','display:block');
  $("#grade_range_choice2").attr('style','display:none');
  $("#rangegrade2").empty();
  $("#slgr2").val(''); 
  $("#slct2").val('');
}

function create_group2(){
	var sgname=$("#sg_name").val();
	var des = $("#sg_des").val();
	var grade=$("#grade2").val();
	var categ=$("#slct2").val();
	if(sgname==""){
		if(!$(".group_name_error2").length){
			$("#sg_name").parent().append("<div class='text-do group_name_error2'>Tên nhóm không được để trống</div>");
		}
	}
	else {
		if($(".group_name_error2").length)
			$(".group_name_error2").remove();
		if(grade==""){
		   if(!$(".level_error2").length)
				$("#grade2").parent().append("<div class='text-do level_error2'>Vui lòng chọn một cấp độ</div>");
	   }
	   else {
		   if($(".level_error2").length)
			$(".level_error2").remove();
		   if(categ==""){
			   if(!$(".categ_error2 ").length)
					$("#slct2").parent().append("<div class='text-do categ_error2'>Vui lòng chọn một môn học</div>");
	       }
		   else{
			   
			   if(grade=="0") grade="3,4,5,6,7,8,9,10,11,12,13,14";
			  
			   if(grade.indexOf("-")!=-1){
				   var ar = grade.split(" - ");
				   grade = parseInt(ar[0])+2;
				   for(i=parseInt(ar[0])+3; i<=parseInt(ar[1])+2; i++){
					   grade+=","+i;
				   }
			   }
			   if(categ=="0") categ="3,4,5,6,7,8,9";
				var sg={'sg_name': sgname,
						'sg_des': des,
						'grade':grade,
						'categ':categ,
						 };
				 var sg_info =JSON.stringify(sg);
				 url = document.location.href;
				 var href = url.split("/");
				 var link = href[href.length - 1];
				 html='';
				 for(i=0;i<href.length-1;i++){
					 html += href[i]+'/';
				 }
				 
				 $("#addgroupModal").modal('hide');
                 clearData();
				 $.ajax({
				  type: 'POST',
				  url: site_url+"/social_group/add_new",
				  data: sg_info,
				  contentType: 'application/json',
				  success: function(data) {
					 if(data['status'] == 1){
						alert('Bạn đã tạo nhóm thành công! \n Hãy sử dụng mã: "'+data['sg_code']+'" để thêm thành viên vào trong nhóm của mình!');
						window.location.href = html + 'manage_group';
					 }else{
						$("#sg_name").parent().append("<div class='text-do group_name_error2'>Tên nhóm đã tồn tại</div>")
					 }
					// alert(data['status']);
				//	  window.location.href = html + 'manage_group';
				  },
				  error : function(data) {
					 console.log(data);
				  }	  
				  
				});
		   }
		}
	}
	
}

function load_group($sg_id){
	
	  $.ajax({
		  type: 'POST',
		  url: site_url+"/social_group/load_group/"+sg_id,
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {
			  if(data['status']==1){
				  load_topmenu('class_menu');
				  $("#bannerpage").empty();
				  var bnhtml = '<div class="line-L">'+
									'<h1>Lớp '+data['class'].dataitem_name+'</h1>'+
									'<p>'+data['class'].name_create_by +' - '+data['class'].level+' - '+data['class'].category+' </p>'+
								'</div>';
				  $("#bannerpage").append(bnhtml);
				  
				  if(!$("#menu_class_"+class_id).length)
						$("#classpage_menu").append('<a href="#/class/'+class_id+'" id="menu_class_'+class_id+'" class="list-group-item" onclick="load_class('+class_id+')">'+data['class'].dataitem_name+'</a>');
				  $("#text-tabs2").attr("style", "display:block");

				  $('#text-tabs')[0].innerText = "Viết bài";
				  $('#text-tabs2')[0].innerText = "Thành viên";
				  
				  // tab post
				  $("#home1").empty();
				  var csu= data['user']['su'];
				  if(!data['user']['photo'])
					  photo=base_url+'/upload/avatar/default.png';
				  else
					  photo=data['user']['photo'];
				  var posthtml='<div id="writepost" style="margin-top:30px" class="col-xs-12 box-bor">'+
				                 '<table ><tr><td><img class="img-circle MR5" src="'+photo+'" alt="" width="32"></td>'+
								 '<td style="padding:10px"><textarea placeholder="Viết bài" id="write_post" name="write_post" style="width:550px;height:50px" required></textarea></td></tr></table>'+
							   '<div style="float: right"> <button class="btn btn-danger" onclick="cancel_post()">Hủy bỏ</button>'+ 
								      '<button class="btn btn-info" onclick="write_post('+class_id+')" style="margin-left:20px">Đăng bài</button>'+ 
							   '</div>'+	 
				               '</div>'+
							   '<div id="discussion_area" style="margin-top:20px" class="col-xs-12 box-bor"></div>';
				  
				 
				  $("#home1").append(posthtml);
				  
				  tinymce.init({
					  menubar:false,
					  //statusbar: false,
					  selector: 'textarea#write_post',
					   branding: false, 
					  images_dataimg_filter: function(img) {
						return img.hasAttribute('internal-blob');
					  },
					   height: 100,
					  theme: 'modern',
					  plugins: [
						//'placeholder',
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
							 
				  
				  load_discussions(class_id);
				  
				  //tab member
				  $("#home2").empty();
				  $.ajax({
				 	type: "POST",
					data : {},
					url: base_url + "index.php/classes/get_member/"+class_id,
					success: function(results){
						$('#home2').css('overflow', 'auto');

						$('#home2').append('<table id="tblclass_mng1" class="display" style="width:100%"></table>');

						var tbl = $('#tblclass_mng1').DataTable({
							responsive: true,
							data: results.data,
							columns: [
							    
								{ "data": "uid", "title": "#"},
								{ "data": "first_name", "title": "Họ tên", "render":function (data, type, row){
									                               return  row.first_name+" "+ row.last_name  ;   
																}},
					            { "data": "email2", "title": "Email"},
					            { "data": "birthdate", "title": "Ngày sinh"},
					            { "data": null,"render":function (data, type, row){
									           if((csu==3 || csu==1) && row.su==2)
													return '<a href="#/class/'+class_id+'" title="Xóa"><i class="far fa-trash-alt"></i></a>';
											   else
												   return '<div></div>'; 
					                           } , "class":  "details-control-1","orderable": false },
					        ],
					        language: langs,
					        order: [[ 0, "desc" ]]
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
                        
						$('#tblclass_mng tbody').on('click', 'td.details-control-1>a', function(e){
							var data = tbl.row($(this).parent().parent()).data();
								
	                            $.ajax({
								 	type: "POST",
									data : {},
									url: base_url + "index.php/classes/remove_student/"+class_id+"/"+data['uid'],
									success: function(results){
										
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
				  
				  
			  }
			  else{
				   window.location.href = site_url+"/home_user";
			  }

		  },
		  error : function(data) {
			console.log(data);
		  }	  
		  
	});
	
}