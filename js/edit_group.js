$(document).ready(function(){
    $('#btnCapnhat_group').on('click',function(e){ 
        var sg_id = $("#sg_id").val();
        var social_name = $("#socialname").val();
        var categ_group = $("[name=categ_group]").val();
        var grade2 = $("#grade2").val();
        var description = $("[name=description2]").val();
        var status = $("[name=status]").val();
        if(social_name==""){
            if(!$(".group_name_error2").length){
                $("#socialname").parent().append("<div class='text-do group_name_error2'>Tên nhóm không được để trống</div>");
            }
        }else{
            if($(".group_name_error2").length)
            $(".group_name_error2").remove();
            if(grade2==""){
                if(!$(".level_error2").length)
                     $("#grade2").parent().append("<div class='text-do level_error2'>Vui lòng chọn một cấp độ</div>");
            }else{
                if($(".level_error2").length)
                $(".level_error2").remove();
                if(categ_group==""){
                    if(!$(".categ_error2 ").length)
                         $("#slct2").parent().append("<div class='text-do categ_error2'>Vui lòng chọn một môn học</div>");
                }else{
                    if(grade2=="0") grade2="3,4,5,6,7,8,9,10,11,12,13,14";
                    if(grade2.indexOf("-")!=-1){
                        var ar = grade2.split(" - ");
                        grade2 = parseInt(ar[0])+2;
                        for(i=parseInt(ar[0])+3; i<=parseInt(ar[1])+2; i++){
                            grade2+=","+i;
                        }
                    }
                    dt = JSON.stringify({
                        'sg_id' :sg_id,
                        'social_name' :social_name,
                        'categ_group' :categ_group,
                        'grade2' :grade2,
                        'description' :description,
                        'status' :status,
                    });
                    $.ajax({
                        type: "POST",
                        data: dt,
                        url: site_url+"/social_group/edit",
                        success: function(data){
                            alert("Sửa thông tin nhóm thành công!");
                            window.location.href=site_url+"/home_user/manage_group";
                        },
                        error: function(data){

                        }
                    })
                }
            }
        }
    })
})

/*function adduser(event, e, sg_id) {
    if (e.keyCode == '13') {
        search = $(event).val();
        add(search, sg_id);
    }
}
function adduser_click(sg_id) {
    search = $('#name_user').val();
    add(search, sg_id);
}
function add(search, sg_id) {
    console.log(site_url);
    dt = JSON.stringify({
        'email': search,
        'sg_id': sg_id
    });
    $.ajax({
        type: 'POST',
        url: site_url + "/social_group/get_data_add_user/",
        data: dt,
        contentType: 'application/json',
        success: function (data) {
            if (data.user.stt == 0) {
                $("#error_email").empty();
                $("#error_email").append(data.user.error);
            } else {
                $('#adduser').modal('hide');
                alert(data.user.error);
                window.location.href = site_url + '/social_group/edit_groupp/' + data['sg_id'];
            }
        },
        error: function (data) {
            console.log(data);
        }
    })
}*/
function drawpage(page) {
    search = $('#search').val();
    redraws(search, page)
}
function drawsearch(event, e) {
    if (e.keyCode == 13) {
        search = $(event).val();
        redraws(search, 0);
    }
}
function drawsearch_btn() {
    search = $('#searchuser').val();
    redraws(search, 0);
}
function redraws(search, page) {
    $('#search').val(search);
    dt = JSON.stringify({
        'search': search,
        'page': page,
        'gid': gid,
    });
    $("#users").empty();
    $("#users").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');
    $.ajax({
        type: 'POST',
        data: dt,
        url: site_url + '/social_group/get_data_edit_group',
        contentType: 'application/json',
        success: function (data) {
            u = data.users;
            index = 0;
            html = '<span style="float:right; margin-bottom:10px;">'
            html += '<input id="searchuser" style="min-width:250px;margin-top:5%" placeholder="Tìm kiếm"	onkeyup="drawsearch(this,event)" value="' + data['search'] + '">'
            html += `<i class="pointer fas fa-search" onclick="drawsearch_btn()"></i></span>
			<table class="table table-bordered">
			<thead>
				<tr style="background-color: rgb(233, 235, 238);">
					<td>Index</td>
					<td>Email</td>
					<td>Contact_no</td>
					<td>Action</td>
				</tr>
            </thead>
            <tbody>
            `;
            for (i = 0; i < u.length; i++) {
                html += '<tr>';
                html += '<td> ' + ++index + ' </td>';
                html += '<td> ' + u[i]['email'] + ' </td>';
                html += '<td> ';
                if (u[i]['contact_no'] == null) {
                    html += '&nbsp;'
                } else {
                    html += u[i]['contact_no'];
                }
                html += '</td>'
                html += '<td>';
                if (cr == u[i]['uid']) {
                    html += '<a onclick = "add_member('+ data['gid'] +')"><i title="Thêm thành viên" class="fa fa-user-plus" aria-hidden="true"></i></a>';
                } else {
                    html += '<a onclick="del(' + data['gid'] + ',' + u[i]['uid'] + ')"><i class="pointer fas fa-trash-alt" title="Xóa"></i></a>'
                }
                html += '</td>';
            }
            html += '</tbody>';
            html += '</table>';
            html += `<center>
            <ul class="pagination listpage pageqt">`;
            if (data.num_page < 7) {
                for (i = 0; i < data.num_page; i++) {
                    html += '<li class="page-item';
                    if (i == page) {
                        html += ' active';
                    }
                    html += '" onclick="drawpage(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
                }
            } else {

                if (page <= 3) {
                    for (i = 0; i < 5; i++) {
                        html += '<li class="page-item';
                        if (i == page) {
                            html += ' active';
                        }
                        html += '" onclick="drawpage(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
                    }
                    html += '<li class="page-item"><a class="page-link">...</a></li>';
                    html += '<li class="page-item" onclick="drawpage(' + (data.num_page - 1) + ')"><a class="page-link">' + data.num_page + '</a></li>';
                }
                else {
                    html += '<li class="page-item" onclick="drawpage(0)"><a class="page-link">1</a></li>';
                    html += '<li class="page-item"><a class="page-link">...</a></li>';

                    if (page < data.num_page - 4) {
                        html += '<li class="page-item" onclick="drawpage(' + (page - 1) + ')"><a class="page-link">' + page + '</a></li>';
                        html += '<li class="page-item active" onclick="drawpage(' + page + ')"><a class="page-link">' + (page + 1) + '</a></li>';
                        html += '<li class="page-item" onclick="drawpage(' + (page + 1) + ')"><a class="page-link">' + (page + 2) + '</a></li>';
                        html += '<li class="page-item"><a class="page-link">...</a></li>';
                        html += '<li class="page-item" onclick="drawpage(' + (data.num_page - 1) + ')"><a class="page-link">' + data.num_page + '</a></li>';
                    }
                    else {
                        for (i = page - 2; i < data.num_page; i++) {
                            html += '<li class="page-item';
                            if (i == page) {
                                html += " active";
                            }
                            html += '" onclick="drawpage(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>';
                        }
                    }
                }
            }
            $("#circularG").remove();
            $("#users").append(html);
        },
        error: function (data) {
            
        }
    })
}
function show_grade(){
    $('#grade_one_choice2').removeAttr('style');
    $("#txtgrade").css({display:"none"});
    $("#link_edit_grade").css({display:"none"});
}
function cancel_edit_grade(){
    $('#txtgrade').removeAttr('style');
    $('#link_edit_grade').removeAttr('style');
    $("#grade_one_choice2").css({display:"none"});
}
function add_member(sg_id){
    $("#add_member").modal();
    $("#bodyadd_member").empty();
    $.ajax({
        type:"POST",
        data: {},
        url: site_url + '/social_group/get_member/'+sg_id,
        success: function(result){
            $("#bodyadd_member").append('<table id="tbmb" class="display" style="width:100%"></table>');
            var tbl = $("#tbmb").DataTable({
                reponsive:true,
                data: result,
                columns: [
                    {"data":null,"title":"","class":"details-control","render":function(data,type,row){
                        return "";
                    }},
                    {"data":null,"title":"Họ tên","render":function(data,type,row){
                        return data.first_name+' '+data.last_name;
                    }},
                    { "data": "email", "title": "Email" },
		        //    { "data": "birthdate", "title": "Ngày sinh" },
					{ "data": "user_code", "title": "Mã người dùng" }
                ],
                language: langs,
		        order: [[ 0, "desc" ]]
            });
            $("#tbmb tbody").on('click','td.details-control',function(){
                var tr = $(this).closest('tr');
                var row = tbl.row(tr);
                if (tr.hasClass('shown')){
					removemb(sg_id, row.data().uid);
					row.child.hide();
					tr.removeClass('shown');
				}else{
					addmb(sg_id, row.data().uid);
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
    })
}
function removemb(sg_id,uid){
    $.ajax({
        type: "POST",
        data: {},
        url: site_url + '/social_group/out_group/'+sg_id+'/'+uid,
        success: function(data){
           
        },
        error: function(xhr,status,sttErr){
            console.log(xhr),
            console.log(status),
            console.log(sttErr)
        },
    })
}
function addmb(sg_id,uid){
    $.ajax({
        type: "POST",
        data: {},
        url: site_url + '/social_group/add_group_member/'+sg_id+'/'+uid,
        success: function(data){
           
        },
        error: function(xhr,status,sttErr){
            console.log(xhr),
            console.log(status),
            console.log(sttErr)
        },
    })
}