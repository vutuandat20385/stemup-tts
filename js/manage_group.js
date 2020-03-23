$(document).ready(function () {
    var hash = window.location.hash.substring(1);
    params = hash.split('/');
    if (params.length > 2) {
        if (params[1] == 'group') {
            $("#home1").empty();
            load_group(params[2]);
        }
    }
})
function drawlimit_mng_gr(event){
    limit=$(event).val();
	search=$("#inf_search").val();
	redrawgrtbl(search,limit,0);
}
function drawsearch_mng_gr(event, e){
    limit=$("#inf_limit").val();
    if(e.keyCode=='13'){
        search= $(event).val();
       redrawgrtbl(search,limit,0);
    }	
}

function drawsearch_mng_gr_btn(){
	limit=$("#inf_limit").val();
    search= $("#search_mng_qt").val();
    redrawgrtbl(search,limit,0);
}
function drawpage_mng_gr(page){
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();
	redrawgrtbl(search,limit,page);
}
function sort_quiz(event){
	val = $(event).val();	
	str=window.location.href.split("?");
	new_url = window.location.href.replace(str[0],site_url+'/home_user/manage_group');
	new_url=updateQueryStringParameter(new_url,'sortby',val);
    window.location.assign(new_url);
}
function redrawgrtbl(search,limit,page){
    var url = window.location.href;
    var sortby = url.split("=");
	$("#inf_search").val(search);
	$("#inf_limit").val(limit);
    $("#inf_page").val(page);
    dt=JSON.stringify({
        'search' :search,
        'limit': limit,
        'page':page,
    })
    console.log(sortby);
    $('.data_mngq').empty();
    $('.data_mngq').append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');
    $.ajax({
        type: 'POST',
        data: dt,
        url: site_url + "/home_user/get_data_manage_group/"+sortby[1],
        contentType : 'application/json',
        success: function(data){
            console.log(data);
            g = data.group;
            var html = `<table class="table table-bordered"><tr style="background-color: rgb(233, 235, 238);">
            <th>#</th>
            <th>Câu hỏi <span><select  style="float:right" onchange="drawlimit_mng_gr(this)">
            
            `;
            for(i=1;i<6;i++){
                html+= '<option value= "'+(i*5)+'"';
                if(limit==i*5){
                    html+= 'selected';
                }
                html+='>'+(i*5)+'mục</option>';
            }
            html+='</select></th> ';
            html+='<th>Code</th>'
            html+=`
            <th>
            <select onchange="sort_quiz(this)" style="width:60px">`
            html+='<option value="all" ';
            if(data.sortby=='all'){
                html+= 'selected';
            }
            html+='>Tất cả</option>';
            html+='<option value="created" ';
            if(data.sortby=='created'){
                html+= 'selected';
            }
            html+='>Đã tạo</option>';
            
            html+='<option value="joined" ';
            if(data.sortby=='joined'){
                html+= 'selected';
            }
            html+='>Đã tham gia</option>';
            html+= `</select>
            </th>`;
            if(data.su ==1){
                html+= '<th>Người tạo</th>'
            }
            html+='<th>Action</th></tr>'
            for(i=0;i<g.length;i++){
                html+='<tr><td>'+g[i]['sg_id']+'</td>';
                html+='<td><a class="pointer" >'+g[i]['sg_name']+'</a></td>';
                html+='<td><a class="pointer" >'+g[i]['sg_code']+'</a></td>';
                if(g[i]['created_by']==data.uid){
                    html+='<td>Đã tạo</td>'
                }else{
                    html+='<td>Đã tham gia</td>'
                }
                if(data.su==1){
                    html+= '<td>' + g[i]['first_name'] + ' ' + g[i]['last_name'] + '</td>'
                }
                if(g[i]['created_by']==data.uid || data.su ==1){
                    html+='<td><a href=" '+ site_url +'/social_group/edit_groupp/'+ g[i]['sg_id'] +' " ><i class="pointer text-warning fas fa-pencil-alt" title="Sửa" ></i></a>';		
                    html+='<a onclick="del('+ g[i]['sg_id'] +')" ><i class="pointer fas fa-trash-alt" title="Xóa"></i></a></td>';	
                }else{
                    html+='<td><a onclick="outgroup('+ g[i]['sg_id'] +', '+ data.uid+')" ><i class="fas fa-sign-out-alt"></i></a></td>';
                }
                  
                html+='</tr>';
            }
            html+="</table>";
            $(".data_mngq").append(html);
            $("#totalqt").empty();
            $("#totalqt").append(data.num_group);
             $("#beginqt").empty();
            $("#beginqt").append(Math.min(data.limit*data.page+1 ,data.num_group));
             $("#endqt").empty();
            $("#endqt").append(Math.min(data.limit*(data.page+1),data.num_group));
            
            $(".pageqt").empty();
            pgihtml="";
            if(data.num_page<7){
                for(i=0; i<data.num_page; i++){
                    pgihtml+='<li class="page-item';
                    if(i==page){
                         pgihtml+=' active';
                    }
                    pgihtml+='" onclick="drawpage_mng_gr('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
                }
            }
            else{
                if(page<=3){
                    for(i=0; i<5; i++){
                        pgihtml+='<li class="page-item';
                        if(i==page){
                             pgihtml+=' active';
                        }
                        pgihtml+='" onclick="drawpage_mng_gr('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
                    }
                    pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
                    pgihtml+='<li class="page-item" onclick="drawpage_mng_gr('+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
                }
                else{
                    pgihtml+='<li class="page-item" onclick="drawpage_mng_gr(0)"><a class="page-link">1</a></li>';
                    pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
                    
                    if(page<data.num_page-4){
                        pgihtml+='<li class="page-item" onclick="drawpage_mng_gr('+(page-1)+')"><a class="page-link">'+page+'</a></li>';
                        pgihtml+='<li class="page-item active" onclick="drawpage_mng_gr('+page+')"><a class="page-link">'+(page+1)+'</a></li>';
                        pgihtml+='<li class="page-item" onclick="drawpage_mng_gr('+(page+1)+')"><a class="page-link">'+(page+2)+'</a></li>';
                        pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
                        pgihtml+='<li class="page-item" onclick="drawpage_mng_gr('+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
                    }
                    else{
                        for(i=page-2; i<data.num_page; i++){
                            pgihtml+='<li class="page-item';
                            if(i==page){
                                pgihtml+=" active";
                            }
                            pgihtml+='" onclick="drawpage_mng_gr('+i+')"><a class="page-link">'+(i+1)+'</a></li>';
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
    })
}
function checkcodegroup(evt, code){
    if(evt.keyCode == 13){
        code = $("#group_code").val();
        if (code.length == 0) {
            document.getElementById("errorrr").innerHTML = "<i>Không được để trống mã nhóm</i>";
        } else {
            dt = JSON.stringify({
                'code': code,
            })
            $.ajax({
                type: "POST",
                url: site_url+'/home_user/notify_join_group',
                data: dt,
                contentType: 'application/json',
                success: function(data){
                    console.log(data);
                    if(data.check.status==0){
                        document.getElementById("errorrr").innerHTML = `<i>${data.check.mess}</i> `;
                    }else{
                        alert(data.check.mess);
                    //    window.location.href = site_url + '/home_user/manage_group';
                    }
                },
                error: function(data){
                    console.log(data);
                }
            })
        }
    }
}
function checkcodegroupbt(){
        code = $("#group_code").val();
        if (code.length == 0) {
            document.getElementById("errorrr").innerHTML = "<i>Không được để trống mã nhóm</i>";
        } else {
            dt = JSON.stringify({
                'code': code,
            })
            $.ajax({
                type: "POST",
                url: site_url+'/home_user/notify_join_group',
                data: dt,
                contentType: 'application/json',
                success: function(data){
                    console.log(data);
                    if(data.check.status==0){
                        document.getElementById("errorrr").innerHTML = `<i>${data.check.mess}</i> `;
                    }else{
                        alert(data.check.mess);
                    //    window.location.href = site_url + '/home_user/manage_group';
                    }
                },
                error: function(data){
                    console.log(data);
                }
            })
        }
}
function cancel_post_group(){
	tinyMCE.get('write_post_group').setContent('');
}

function load_group(sg_id) {
    $("#main_bussiness").attr("style", "");
	$("#new_main_page").attr("style", "display:none");
    $.ajax({
        type: 'POST',
        url: site_url + "/social_group/load_group/" + sg_id,
        data: {},
        contentType: 'application/json',
        success: function (result) {
            if (result.info.stt == 1) {
                $('#searchh').empty();
                $("#bannerpage").empty();
                $("#bannerpage").empty();
                var bnhtml = '<div class="line-L">' +
                    '<h1>Nhóm ' + result.info.group.sg_name + '</h1>' +
                    '<p>' + result.info.group.first_name + ' ' + result.info.group.last_name + ' - ' + result.info.group.sg_code + ' </p>' +
                    '</div>';
                $("#bannerpage").append(bnhtml);
                //    if(!$("#menu_class_"+class_id).length)
                //    $("#classpage_menu").append('<a href="#/class/'+class_id+'" id="menu_class_'+class_id+'" class="list-group-item" onclick="load_class('+class_id+')">'+result['class'].resultitem_name+'</a>');
                $("#text-tabs2").attr("style", "display:block");
                $('#text-tabs')[0].innerText = "Viết bài";
                $('#text-tabs2')[0].innerText = "Thành viên";
                $("#home1").empty();
                $('#home1').css('overflow', 'auto');
                var csu = result['user']['su'];
                if (!result['user']['photo'])
                    photo = base_url + '/upload/avatar/default.png';
                else
                    photo = result['user']['photo'];
                var posthtml = '<div id="writepostgroup" style="margin-top:30px" class="col-xs-12 box-bor">' +
                    '<table ><tr><td><img class="img-circle MR5" src="' + photo + '" alt="" width="32"></td>' +
                    '<td style="padding:10px"><textarea placeholder="Viết bài" id="write_post_group" name="write_post_group" style="width:550px;height:50px" required></textarea></td></tr></table>' +
                    '<div style="float: right"> <button class="btn btn-danger" onclick="cancel_post_group()">Hủy bỏ</button>' +
                    '<button class="btn btn-info" onclick="write_post_group(' + sg_id + ')" style="margin-left:20px">Đăng bài</button>' +
                    '</div>' +
                    '</div>' +
                    '<div id="discussion_area" style="margin-top:20px" class="col-xs-12 box-bor"></div>';
                $("#home1").append(posthtml);
                tinymce.remove("textarea#write_post_group");
                tinymce.init({
                    menubar: false,
                    //statusbar: false,
                    selector: 'textarea#write_post_group',
                    branding: false,
                    images_dataimg_filter: function (img) {
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
                            onclick: function () {
                                theEditor.windowManager.open({
                                    title: 'Insert Embed Code',
                                    body: [
                                        { type: 'textbox', name: 'text', size: '1000', autofocus: true, multiline: true, minHeight: 150, minWidth: 500, id: 'embedcodes' }
                                    ],
                                    onsubmit: function (e) {
                                        theEditor.insertContent($('#embedcodes').val());

                                    }
                                });
                            }
                        });
                    }
                });
                load_discussions_group(sg_id);
                //tab member
                $("#home2").empty();
                $('#home2').css('overflow', 'auto');
                $('#home2').append('<table id="tblclass_mng1" class="display" style="width:100%"></table>');
                var tbl = $('#tblclass_mng1').DataTable({
                    responsive: true,
                    data: result.member,
                    columns: [
                        { "data": "uid", "title": "#" },
                        {
                            "data": "first_name", "title": "Họ tên", "render": function (data, type, row) {
                                return row.first_name + " " + row.last_name;
                            }
                        },
                        { "data": "email", "title": "Email" },
                        {
                            "data": null, "title": "Chức vụ", "render": function (data, type, row) {
                                if (row.su == 3)
                                    return 'Giáo viên';
                                else if (row.su == 1)
                                    return 'Admin';
                                else if (row.su == 4)
                                    return 'Phụ huynh';
                                else 
                                    return 'Học sinh';
                            }, "class": "details-control-1", "orderable": false
                        },
                        { "data": null,"render":function (data, type, row){
                        //    if(result.info.group['created_by']==result.user['uid'] && result.info.group['created_by'] != row.uid ){
                        //        return '<a href="#/social_group/'+sg_id+'" title="Xóa"><i class="far fa-trash-alt"></i></a>';
                         //   }
                        //    else
                                return '<div></div>'; 
                            } , "class":  "details-control-1","orderable": false },
                    ],
                    language: langs,
                    order: [[0, "desc"]]
                });
                $("[type=search]").attr("placeholder", "Tìm kiếm");
                $("[type=search]").attr("style", "width:250px");
                $('#tblclass_mng thead tr').each(function () {
                    $(this).css('background-color', '#e9ebee');
                });

                $('#tblclass_mng thead th').each(function () {
                    var title = $(this).text();
                });
                tbl.columns().every(function () {
                    var that = this;
                });
                $('#tblclass_mng1 tbody').on('click', 'td.details-control-1>a', function (e) {
                    var data = tbl.row($(this).parent().parent()).data();
                    $.ajax({
                        type: "POST",
                        data: {},
                        url: base_url + "index.php/social_group/out_group/" + sg_id + "/" + data['uid'],
                        success: function (results) {
                            console.log('success');
                        },
                        error: function (xhr, status, strErr) {
                            console.log(xhr);
                            console.log(status);
                            console.log(strErr);
                        }
                    });
                    $(this).parent().parent().remove();
                    //console.log(data);
                });
            }
            else {
                window.location.href = site_url + "/home_user";
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
}
function load_discussions_group(sg_id){
    $("#discussion_area").empty();
    var max_post = 5;
    $.ajax({
        type: 'POST',
        url: site_url+"/social_group/load_discussion/"+sg_id+"/0/"+max_post,
        data: {},
        contentType: 'application/json',
        success: function(data){
            $("#discussion_area").append('<h4>Thảo luận</h4>');
            if(data['post'].length==0) $("#discussion_area").append('<h5 style="text-align:center">Chưa có bài thảo luận nào!!!</h5>');
            else{
                data_length=data['post'].length;
                if(data_length==max_post+1)
                    data_length--;
                for(i=0; i<data_length; i++){
                   if(data['cuid']==data['post'][i]['uid'])
                       temp = '<div class="box-post"';
                   else 
                       temp = '<div class="box-post1"';
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
                      '<p><div><h6><a href="'+window.location.hash+'" style="margin-left:10px;" onclick="replypost_group(this,'+data['post'][i]['post_id']+','+sg_id+')">Trả lời (<span id="nreply_'+data['post'][i].post_id+'">'+data['post'][i].nreply+'</span>)</a>'+
                      '<span style="float:right">'+to_string_datetime(data['post'][i].create_date)+'</span></h6></div></p>';
                      
                  post+='<div id="reply_post_'+data['post'][i]['post_id']+'">';  
                  reply_length=data['post'][i]['reply'].length;
                  if(reply_length==3)
                        reply_length=2;
                  for(j=0; j<reply_length; j++){
                      if(!data['post'][i]['reply'][j]['photo'])
                          photo_reply=base_url+'/upload/avatar/default.png';
                      else
                          photo_reply=data['post'][i]['reply'][j]['photo'];
                      post+='<h6 style="margin-left:10%"><div><img class="img-circle MR5" src="'+photo_reply+'" alt="" width="32"><strong><a class="user_name">'+data['post'][i]['reply'][j].first_name+' '+ data['post'][i]['reply'][j].last_name+'</a></strong>'+
                      '<div class="settingpost"><i class="fas fa-cog"></i></div>'+data['post'][i]['reply'][j].content+'</div> '+
                      '</h6>';
                  }
                  if(data['post'][i]['reply'].length>=2)
                      rpivot = data['post'][i]['reply'][data['post'][i]['reply'].length-2]['post_id'];
                  else
                      rpivot = data['post'][i]['reply']['post_id'];	
                  if(data['post'][i]['reply'].length==3)
                      post+='<h6 id="showmore_reply_'+data['post'][i]['post_id']+'" style="margin-left:10%"> <a href="'+window.location.hash+'" onclick="load_more_reply_group('+data['post'][i]['post_id']+','+rpivot+')">Xem thêm các phản hồi</a></h6>';   
                      post+='</div>';       
                      $("#discussion_area").append(post);
                }
                if(data['post'].length>=2)
                      pivot = data['post'][data['post'].length-2]['post_id'];
                else
                      pivot=pivot = data['post'][0]['post_id'];
                if(data['post'].length==max_post+1)
                  $("#discussion_area").append('<a style="float:right;" href="'+window.location.hash+'" id="load_more_discussion_group" onclick="load_more_discussion_group('+sg_id+','+pivot+')">Xem thêm</a>');
            }
        },
        error: function(data){
            console.log(data);
        }
    })
}
function load_more_discussion_group(sg_id, pivot){
	var max_post=5;
	$.ajax({
		  type: 'POST',
		  url: site_url+"/social_group/load_discussion/"+sg_id+"/"+pivot+"/"+max_post,
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {
              data_length=data['post'].length;
			  if(data_length==max_post+1)
					  data_length--;
			  for(i=0; i<data_length; i++){
					 if(data['cuid']==data['post'][i]['uid'])
						 temp = '<div class="box-post"';
					 else 
						 temp = '<div class="box-post1"';
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
						'<p><div><h6><a href="'+window.location.hash+'" style="margin-left:10px;" onclick="replypost_group(this,'+data['post'][i]['post_id']+','+sg_id+')">Trả lời (<span id="nreply_'+data['post'][i].post_id+'">'+data['post'][i].nreply+'</span>)</a>'+
						'<span style="float:right">'+to_string_datetime(data['post'][i].create_date)+'</span></h6></div></p>';
					reply_length=data['post'][i]['reply'].length;
					if(reply_length==3)
						  reply_length=2;
					for(j=0; j<reply_length; j++){
						if(!data['post'][i]['reply'][j]['photo'])
							photo_reply=base_url+'/upload/avatar/default.png';
						else
							photo_reply=data['post'][i]['reply'][j]['photo'];
						post+='<h6 style="margin-left:10%"><div><img class="img-circle MR5" src="'+photo_reply+'" alt="" width="32"><strong><a class="user_name">'+data['post'][i]['reply'][j].first_name+' '+ data['post'][i]['reply'][j].last_name+'</a></strong>'+
						'<div class="settingpost"><i class="fas fa-cog"></i></div>'+data['post'][i]['reply'][j].content+'</div> '+
						'</h6>';
					}
					if(data['post'][i]['reply'].length>=2)
						rpivot = data['post'][i]['reply'][data['post'][i]['reply'].length-2]['post_id'];
					else
						rpivot = data['post'][i]['reply']['post_id'];	
					if(data['post'][i]['reply'].length==3)
						post+='<h6 id="showmore_reply_'+data['post'][i]['post_id']+'" style="margin-left:10%"> <a href="'+window.location.hash+'" onclick="load_more_reply_group('+data['post'][i]['post_id']+','+rpivot+')">Xem thêm các phản hồi</a></h6>';   
					post+='</div>';   			
					$("#discussion_area").append(post);
			  }
			   if(data['post'].length>=2)
					pivot = data['post'][data['post'].length-2]['post_id'];
			   else
					pivot = data['post'][0]['post_id'];
			  $("#load_more_discussion_group").remove();
			  if(data['post'].length==max_post+1)
					$("#discussion_area").append('<a style="float:right;" href="'+window.location.hash+'" id="load_more_discussion_group" onclick="load_more_discussion_group('+sg_id+','+pivot+')">Xem thêm</a>');
			  
				  
              
		  },
		  error : function(data) {
			 console.log(data);
		  }	  
		  
	});
}
function write_post_group(sg_id){
    var content= tinyMCE.get('write_post_group').getContent();
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
			  url: site_url+"/social_group/write_post/"+sg_id,
			  data: post,
			  contentType: 'application/json',
			  success: function(data) {
                console.log('success');
				tinyMCE.get('write_post_group').setContent('');
				load_discussions_group(sg_id);
			  },
			  error : function(data) {
				console.log(data);
			  }
			  
		});
	}
}
function load_more_reply_group(parent_id, pivot){
	var max_post=5;
	
	$.ajax({
		  type: 'POST',
		  url: site_url+"/social_group/load_reply/"+parent_id+"/"+pivot+"/"+max_post,
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
				  $("#reply_post_"+parent_id).append('<h6 style="margin-left:10%"><img class="img-circle MR5" src="'+photo_reply+'" alt="" width="32"><strong><a class="user_name">'+data['post'][i].first_name+' '+ data['post'][i].last_name+'<a></strong><div class="settingpost"><i class="fas fa-cog"></i></div> '+data['post'][i].content+'</div></h6>');
			  }
			   if(data['post'].length>=2)
					rpivot = data['post'][data['post'].length-2]['post_id'];
			   else
					rpivot = data['post'][0]['post_id'];
			  $("#showmore_reply_"+parent_id).remove();
			  if(data['post'].length==max_post+1)
				  $("#reply_post_"+parent_id).append('<h6 id="showmore_reply_'+parent_id+'" style="margin-left:10%"> <a href="'+window.location.hash+'" onclick="load_more_reply_group('+parent_id+','+rpivot+')">Xem thêm các phản hồi</a></h6>');
			  
		  },
		  error : function(data) {
			 console.log(data);
		  }	  
	});	  
}
function replypost_group(event,post_id,sg_id){
	$("[class=replyform]").remove();
	$(event).parent().append('<p style="margin-top:10px"><textarea class="replyform" id="reply_'+post_id+'" style="width:94%; margin-left:5%" required autofocus ></textarea><p>');
	$('#reply_'+post_id).keyup(function(e){
		  if(e.keyCode=='13'){
			  var content=$(this).val();
			 if(content!=""){
				
				 var reply = JSON.stringify({'content':content.replace('\n','')});
				 $.ajax({
					  type: 'POST',
					  url: site_url+"/social_group/write_post/"+sg_id+"/"+post_id,
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
function join_group(uid,sg_id,name_uid,sg_name){
    dt=JSON.stringify({
        'uid':uid,
        'sg_id':sg_id,
        'code':"0",
    });
    $.ajax({
        type: "POST",
        url: site_url+'/home_user/check_user_group',
        data:dt,
        contentType:'application/json',
        success: function(data) {
            if(data['check']==1){
                alert(name_uid+' đã tham gia nhóm trước đó');
            }else{
                if(confirm('Bạn có đồng ý cho '+name_uid+' tham gia nhóm '+sg_name)){
                    $.ajax({
                        type: "POST",
                        url: site_url+'/home_user/join_group',
                        data:dt,
                        contentType:'application/json',
                        success: function(data){
                        },
                        error: function(data){
    
                        }
                    })
                }
            }
        },
        error:function(data){
        }
    })

}
function accept_join_group(sg_id,uid){
    dt = JSON.stringify({
        'uid':uid,
        'sg_id': sg_id,
        'code': '1'
    });
        $.ajax({
            type: "POST",
            url: site_url+'/home_user/check_user_group',
            data: dt,
            contentType: 'application/json',
            success: function(data){
                if(data['check']==1){
                    alert('Bạn đã tham gia nhóm trước đó');
                    window.location.href =  site_url+"/home_user/manage_group";
                }else{
                    if(confirm('Bạn có muốn tham gia nhóm?')){
                        $.ajax({
                            type: "POST",
                            url: site_url+'/home_user/join_group',
                            data:dt,
                            contentType:'application/json',
                            success: function(data){
                                window.location.href =  site_url+"/home_user/manage_group";
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
}