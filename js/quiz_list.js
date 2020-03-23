$(document).ready(function(){
	//$(".result-rating").rating({displayOnly: true, step: 1});
	
	$('#ratingModal').on('hide.bs.modal', function () {			
			reload();
		});
		
});



function updateQueryStringParameter(uri, key, value) {
  var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
  var separator = uri.indexOf('?') !== -1 ? "&" : "?";
  if (uri.match(re)) {
    return uri.replace(re, '$1' + key + "=" + value + '$2');
  }
  else {
    return uri + separator + key + "=" + value;
  }
}

function filter_quiz_categ_al(event){
	val = $(event).val();
	str=window.location.href.split("?");
	new_url = window.location.href.replace(str[0],site_url+'/sadmin/quiz_list');
	new_url=updateQueryStringParameter(new_url,'cid',val);
    window.location.assign(new_url);

}
function filter_quiz_level_al(event){
	val = $(event).val();	
	str=window.location.href.split("?");
	new_url = window.location.href.replace(str[0],site_url+'/sadmin/quiz_list');
	new_url=updateQueryStringParameter(new_url,'lid',val);
    window.location.assign(new_url);
}

function filter_quiz_search_al(event){
	val = $(event).val();	
	while(val.indexOf("+")>-1)
			val =val.replace("+","%2B");
		while(val.indexOf(" ")>-1)
			val =val.replace(" ","+");
	new_url=encodeURI(updateQueryStringParameter(window.location.href,'search',val));
	str=window.location.href.split("?");
	new_url = window.location.href.replace(str[0],site_url+'/sadmin/quiz_list');
	new_url=updateQueryStringParameter(new_url,'search',val);
    window.location.assign(new_url);
}

function sort_quiz_al(event){
	val = $(event).val();	
	str=window.location.href.split("?");
	new_url = window.location.href.replace(str[0],site_url+'/sadmin/quiz_list');
	new_url=updateQueryStringParameter(new_url,'sortby',val);
    window.location.assign(new_url);
}

function assignstatus(quid, uid, auid) {
	$("#stt"+uid+quid).empty();
	$("#olstd"+uid+quid).removeAttr("onclick");
	$("#olstd"+uid+quid).removeAttr("title");
	$("#stt"+uid+quid).removeAttr("style");
	$("#stt"+uid+quid).attr("style","color:blue");
	$("#olstd"+uid+quid).attr("title","Xóa");
	$("#olstd"+uid+quid).attr("onclick","unassignn("+quid+','+uid+','+auid+")");
	var startdate = $('#startdate')[0].value;
	var enddate = $('#enddate')[0].value;
	var formData = { quid: quid, uid: uid, auid: auid , startdate: startdate, enddate: enddate };
	var stt = "<i>Đã giao bài</i>";
	$("#stt"+uid+quid).append(stt);
	$("#tr"+uid+quid).attr("class","shown");
	$.ajax({
		type: "POST",
		data: formData,
		url: base_url + "index.php/sadmin/assignstatus/" + quid + "/" + uid + "/" + auid + "/" + startdate + "/" + enddate,
		success: function (data) {
			console.log(data.result);
		},
		error: function (xhr, status, strErr) { }
	});
}
function unassignn(quid, uid,auid) {
	$("#stt"+uid+quid).empty();
	$("#stt"+uid+quid).removeAttr("style");
	$("#stt"+uid+quid).attr("style","color:red");
	var formData = { quid: quid, uid: uid };
	$.ajax({
		type: "POST",
		data: formData,
		url: base_url + "index.php/sadmin/unassign_quiz/" + quid + "/" + uid,
		success: function (data) {
			console.log(data.result);
			if (data.result == "success") {
				$("#olstd"+uid+quid).removeAttr("onclick");
				$("#olstd"+uid+quid).removeAttr("title");
				$("#olstd"+uid+quid).attr("title","Thêm");
				$("#olstd"+uid+quid).attr("onclick","assignstatus("+quid+','+uid+','+auid+")");
				var stt = "<i>Chưa giao bài</i>";
				$("#stt"+uid+quid).append(stt);
				$("#tr"+uid+quid).removeAttr("class");
			}
		},
		error: function (xhr, status, strErr) { 

		}
	});
}
function unassigntoclassc(quid, classid){
	$("#clistcmt"+quid+classid).empty();
	$("#olcl"+classid+quid).removeAttr("onclick");
	$("#olcl"+classid+quid).removeAttr("title");
	$("#clistcmt"+quid+classid).removeAttr("style");
	$("#clistcmt"+quid+classid).attr("style","color:red");
	var formData = {quid:quid, classid:classid};
	$.ajax({
		type: "POST",
		data : formData,
		url: base_url + "index.php/sadmin/unassign_to_class/"+quid+"/"+classid,
		success: function(data){
			console.log(data);
			if(data.result == "success"){
				$("#olcl"+classid+quid).attr("title","Thêm");
				$("#olcl"+classid+quid).attr("onclick","assigntoclassc("+quid+','+classid+")");
				$("#clist"+quid+classid).removeClass('shown');
				var stt = "<i>Chưa giao bải</i>";
				$("#clistcmt"+quid+classid).append(stt);
			}
		},
		error: function(xhr,status,strErr){}
	});
}

function assigntoclassc(quid, classid){
	$("#clistcmt"+quid+classid).empty();
	$("#olcl"+classid+quid).removeAttr("onclick");
	$("#olcl"+classid+quid).removeAttr("title");
	$("#clistcmt"+quid+classid).removeAttr("style");
	$("#clistcmt"+quid+classid).attr("style","color:blue");
	var startdate = $('#startdate')[0].value;
	var enddate = $('#enddate')[0].value;
	var formData = {quid:quid, classid:classid, startdate:startdate, enddate:enddate};
	$.ajax({
		type: "POST",
		data : formData,
		url: base_url + "index.php/sadmin/assign_to_class/"+quid+"/"+classid+"/"+startdate+"/"+enddate,
		success: function(data){
			console.log(data);
			if(data.result == "success"){
				$("#olcl"+classid+quid).attr("title","Xóa");
				$("#olcl"+classid+quid).attr("onclick","unassigntoclassc("+quid+','+classid+")");
				var stt = "<i>Đã giao bài</i>";
				$("#clistcmt"+quid+classid).append(stt);
				$("#clist"+quid+classid).addClass("shown");
			}
		},
		error: function(xhr,status,strErr){
			console.log('Error');
		}
	});
}
function search_std(){
	quid = $("#quidd").val();
	search = $("#search_student").val();
    redraws_std(quid,search,0);
}
function search_std_1(event,e){
	quid = $("#quidd").val();
	if (e.keyCode == '13') {
        search = $(event).val();
        redraws_std(quid,search, 0);
    }
}
function page_std(page){
	quid = $("#quidd").val();
	search = $("#search_std").val();
	redraws_std(quid,search,page);
}
function redraws_std(quid,search,page){
	$("#search_std").val(search);
	$("#page_std").val(page);
	$("#studenttab").empty();
	var formData = { quid: quid, search: search, page: page};
	console.log(formData);
	$.ajax({
		type:'POST',
		data: formData,
		url: base_url + "index.php/sadmin/get_data_std/" + quid,
		success: function (data){
			console.log(data);
			var html = `
			<span style="float:right; margin-bottom:10px;">
			   <input id="search_student" style="min-width:250px;margin-top:5%" placeholder="Tìm kiếm" onkeyup="search_std_1(this,event)" `;
			   html +='value="'+data.search+'">'
			html+=`
		   <i class="pointer fas fa-search" onclick="search_std()"></i></span>
		   <table class="table table-bordered">
			   <thead role="row">
			   <tr style="background-color: rgb(233, 235, 238);">
					<td>&nbsp;</td>
				   <td>#</td>
				   <td>Họ tên</td>
				   <td>Email</td>
				   <td>Trạng thái</td>
			   <tr>
			   </thead>
			   <tbody>
			`;
			for(i=0;i< data.students.list.length;i++){
				if(data.students.list[i]['stt']==1){
					html += '<tr id="tr'+data.students.list[i]['uid']+''+data.quid+'" class="shown">';
					html += '<td id="olstd'+data.students.list[i]['uid']+''+data.quid+'" class="details-control" title="Xóa" onclick="unassignn('+ data.quid +','+ data.students.list[i]['uid'] +','+ data['uid'] +' )" style="width:30px" ></td>';
				}else{
				html += '<tr id="tr'+data.students.list[i]['uid']+''+data.quid+'" class="">';
				html += '<td id="olstd'+data.students.list[i]['uid']+''+data.quid+'" class="details-control" title="Thêm" onclick="assignstatus('+ data.quid +','+ data.students.list[i]['uid'] +','+ data['uid'] +' )" style="width:30px" ></td>';
				}
				html += '<td> '+ data.students.list[i]['uid'] +' </td>'
				html += '<td> '+ data.students.list[i]['first_name'] +' '+ data.students.list[i]['last_name'] +' </td>';
				html += '<td>'+ data.students.list[i]['email'] +'</td>';
				if(data.students.list[i]['cmt'] == 'Đã giao bài'){
					html += '<td ><p style="color:blue" id="stt'+data.students.list[i]['uid']+''+data.quid+'"><i>'+ data.students.list[i]['cmt'] +'</i></p></td>';
				}else{
					html += '<td ><p style="color:red" id="stt'+data.students.list[i]['uid']+''+data.quid+'"><i>'+ data.students.list[i]['cmt'] +'</i></p></td>';
				}
				html += '</tr>';
			}
			html += '</tbody></table>';
			html += `<center>
			<ul class="pagination listpage pageqt">`;
			if (data.np_std < 7) {
                for (i = 0; i < data.np_std; i++) {
                    html += '<li class="page-item';
                    if (i == page) {
                        html += ' active';
                    }
                    html += '" onclick="page_std(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
                }
            } else {

                if (page <= 3) {
                    for (i = 0; i < 5; i++) {
                        html += '<li class="page-item';
                        if (i == page) {
                            html += ' active';
                        }
                        html += '" onclick="page_std(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
                    }
                    html += '<li class="page-item"><a class="page-link">...</a></li>';
                    html += '<li class="page-item" onclick="page_std(' + (data.np_std - 1) + ')"><a class="page-link">' + data.np_std + '</a></li>';
                }
                else {
                    html += '<li class="page-item" onclick="page_std(0)"><a class="page-link">1</a></li>';
                    html += '<li class="page-item"><a class="page-link">...</a></li>';

                    if (page < data.np_std - 4) {
                        html += '<li class="page-item" onclick="page_std(' + (page - 1) + ')"><a class="page-link">' + page + '</a></li>';
                        html += '<li class="page-item active" onclick="page_std(' + page + ')"><a class="page-link">' + (page + 1) + '</a></li>';
                        html += '<li class="page-item" onclick="page_std(' + (page + 1) + ')"><a class="page-link">' + (page + 2) + '</a></li>';
                        html += '<li class="page-item"><a class="page-link">...</a></li>';
                        html += '<li class="page-item" onclick="page_std(' + (data.np_std - 1) + ')"><a class="page-link">' + data.np_std + '</a></li>';
                    }
                    else {
                        for (i = page - 2; i < data.np_std; i++) {
                            html += '<li class="page-item';
                            if (i == page) {
                                html += " active";
                            }
                            html += '" onclick="page_std(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>';
                        }

                    }
                }
			}
		$("#studenttab").append(html);
		},
		error: function(data){
			console.log(data);
		}

	})
}
function search_cl(){
	quid = $("#quidd").val();
	search = $("#search_class").val();
    redraws_cl(quid,search,0);
}
function search_cl_1(event,e){
	quid = $("#quidd").val();
	if (e.keyCode == '13') {
        search = $(event).val();
        redraws_cl(quid,search, 0);
    }
}
function page_cl(page){
	quid = $("#quidd").val();
	search = $("#search_cl").val();
	redraws_cl(quid,search,page);
}
function redraws_cl(quid,search,page){
	$("#search_cl").val(search);
	$("#page_cl").val(page);
	$("#classtab").empty();
	var formData = {quid:quid , search:search, page:page}
	console.log(formData);
	$.ajax({
		type: 'POST',
		data: formData,
		url: base_url + "index.php/sadmin/get_data_class/" + quid,
		success: function(data){
			console.log(data);
			var clist = `
			<span style="float:right; margin-bottom:10px;">
			   <input id="search_class" style="min-width:250px;margin-top:5%" placeholder="Tìm kiếm" onkeyup="search_cl_1(this,event)" `
			   clist += ' value="'+data.search+'">';
			   clist +=`<i class="pointer fas fa-search" onclick="search_cl()"></i></span>
		   <table class="table table-bordered">
			   <thead role="row">
			   <tr style="background-color: rgb(233, 235, 238);">
					<td>&nbsp;</td>
				   <td>#</td>
				   <td>Tên lớp</td>
				   <td>Mã lớp</td>
				   <td>Trạng thái</td>
			   <tr>
			   </thead>
			   <tbody>
			`;
				for(i=0;i<data.class.clist.length;i++){
				//	if(data.class.clist[i]['nbmb']!=0){
						if(data.class.clist[i]['stt']==1){
							clist += '<tr id="clist'+data.quid+''+data.class.clist[i]['did']+'" class="shown">';
							clist += '<td id="olcl'+data.class.clist[i]['did']+''+data.quid+'" class="details-control" title="Xóa" onclick="unassigntoclassc('+data.quid+','+data.class.clist[i]['did']+')" style="width:30px" ></td>';
						}else{
							clist += '<tr id="clist'+data.quid+''+data.class.clist[i]['did']+'">';
							clist += '<td id="olcl'+data.class.clist[i]['did']+''+data.quid+'" class="details-control" title="Thêm" onclick="assigntoclassc('+data.quid+','+data.class.clist[i]['did']+')" style="width:30px" ></td>';
						}
						clist += '<td> '+ data.class.clist[i]['did'] +' </td>'
						clist += '<td> '+ data.class.clist[i]['dataitem_name'] +' </td>';
						clist += '<td>'+ data.class.clist[i]['dataitem_code'] +'</td>';
						if(data.class.clist[i]['cmt'] == 'Đã giao bài'){
							clist += '<td ><p id="clistcmt'+data.quid+''+data.class.clist[i]['did']+'" style="color:blue"><i>'+ data.class.clist[i]['cmt'] +'</i></p></td>';
						}else{
							clist += '<td ><p id="clistcmt'+data.quid+''+data.class.clist[i]['did']+'" style="color:red"><i>'+ data.class.clist[i]['cmt'] +'</i></p></td>';
						}
						clist += '</tr>';
				//	}
				}
				clist += '</tbody></table>';
				clist += `<center>
				<ul class="pagination listpage pageqt">`;
				if (data.np_cl < 7) {
					for (i = 0; i < data.np_cl; i++) {
						clist += '<li class="page-item';
						if (i == page) {
							clist += ' active';
						}
						clist += '" onclick="page_cl(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
					}
				} else {
	
					if (clist <= 3) {
						for (i = 0; i < 5; i++) {
							clist += '<li class="page-item';
							if (i == page) {
								clist += ' active';
							}
							clist += '" onclick="page_cl(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
						}
						clist += '<li class="page-item"><a class="page-link">...</a></li>';
						clist += '<li class="page-item" onclick="page_cl(' + (data.np_cl - 1) + ')"><a class="page-link">' + data.np_cl + '</a></li>';
					}
					else {
						clist += '<li class="page-item" onclick="page_cl(0)"><a class="page-link">1</a></li>';
						clist += '<li class="page-item"><a class="page-link">...</a></li>';
	
						if (page < data.np_cl - 4) {
							clist += '<li class="page-item" onclick="page_cl(' + (page - 1) + ')"><a class="page-link">' + page + '</a></li>';
							clist += '<li class="page-item active" onclick="page_cl(' + page + ')"><a class="page-link">' + (page + 1) + '</a></li>';
							clist += '<li class="page-item" onclick="page_cl(' + (page + 1) + ')"><a class="page-link">' + (page + 2) + '</a></li>';
							clist += '<li class="page-item"><a class="page-link">...</a></li>';
							clist += '<li class="page-item" onclick="page_cl(' + (data.np_cl - 1) + ')"><a class="page-link">' + data.np_cl + '</a></li>';
						}
						else {
							for (i = page - 2; i < data.np_cl; i++) {
								clist += '<li class="page-item';
								if (i == page) {
									clist += " active";
								}
								clist += '" onclick="page_cl(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>';
							}
	
						}
					}
				}

		
		$("#classtab").append(clist);
	},
		error: function(data){

		},
	})
}


function changeassign(quid, uid) {
	console.log(quid);
	console.log(uid);
	$("#quidd").val(quid);
	$("#studenttab").empty();
	$("#classtab").empty();
	pagestd=0;
	pagecl=0;
	$('#quid').val(quid);
		var formData = { quid: quid };
		console.log($("#quidd").val(quid));
		$.ajax({
			type: "POST",
			data: formData,
			url: base_url + "index.php/sadmin/student_list/" + quid,
			success: function (data) {
				console.log(data);
					var html = `
					<span style="float:right; margin-bottom:10px;">
	   				<input id="search_student" style="min-width:250px;margin-top:5%" placeholder="Tìm kiếm" onkeyup="search_std_1(this,event)" value="">
				   <i class="pointer fas fa-search" onclick="search_std()"></i></span>
				   <table class="table table-bordered">
					   <thead role="row">
					   <tr style="background-color: rgb(233, 235, 238);">
							<td>&nbsp;</td>
						   <td>#</td>
						   <td>Họ tên</td>
						   <td class="hideemail">Email</td>
						   <td>Trạng thái</td>
					   <tr>
					   </thead>
					   <tbody>
					`;
					for(i=0;i< data.students.list.length;i++){
						if(data.students.list[i]['stt']==1){
							html += '<tr id="tr'+data.students.list[i]['uid']+''+data.quiz['quid']+'" class="shown">';
							html += '<td id="olstd'+data.students.list[i]['uid']+''+data.quiz['quid']+'" class="details-control" title="Xóa" onclick="unassignn('+ data.quiz['quid'] +','+ data.students.list[i]['uid'] +','+ data['uid'] +' )" style="width:30px" ></td>';
						}else{
						html += '<tr id="tr'+data.students.list[i]['uid']+''+data.quiz['quid']+'" class="">';
						html += '<td id="olstd'+data.students.list[i]['uid']+''+data.quiz['quid']+'" class="details-control" title="Thêm" onclick="assignstatus('+ data.quiz['quid'] +','+ data.students.list[i]['uid'] +','+ data['uid'] +' )" style="width:30px" ></td>';
						}
						html += '<td> '+ data.students.list[i]['uid'] +' </td>'
						html += '<td> '+ data.students.list[i]['first_name'] +' '+ data.students.list[i]['last_name'] +' </td>';
						html += '<td class="hideemail">'+ data.students.list[i]['email'] +'</td>';
						if(data.students.list[i]['cmt'] == 'Đã giao bài'){
							html += '<td ><p style="color:blue" id="stt'+data.students.list[i]['uid']+''+data.quiz['quid']+'"><i>'+ data.students.list[i]['cmt'] +'</i></p></td>';
						}else{
							html += '<td ><p style="color:red" id="stt'+data.students.list[i]['uid']+''+data.quiz['quid']+'"><i>'+ data.students.list[i]['cmt'] +'</i></p></td>';
						}
						html += '</tr>';
					}
					html += '</tbody></table>';
					html += `<center>
					<ul class="pagination listpage pageqt">`;
					if (data.np_std < 7) {
						for (i = 0; i < data.np_std; i++) {
							html += '<li class="page-item';
							if (i == pagestd) {
								html += ' active';
							}
							html += '" onclick="page_std(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
						}
					} else {
		
						if (pagestd <= 3) {
							for (i = 0; i < 5; i++) {
								html += '<li class="page-item';
								if (i == pagestd) {
									html += ' active';
								}
								html += '" onclick="page_std(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
							}
							html += '<li class="page-item"><a class="page-link">...</a></li>';
							html += '<li class="page-item" onclick="page_std(' + (data.np_std - 1) + ')"><a class="page-link">' + data.np_std + '</a></li>';
						}
						else {
							html += '<li class="page-item" onclick="page_std(0)"><a class="page-link">1</a></li>';
							html += '<li class="page-item"><a class="page-link">...</a></li>';
		
							if (page < data.np_std - 4) {
								html += '<li class="page-item" onclick="page_std(' + (pagestd - 1) + ')"><a class="page-link">' + pagestd + '</a></li>';
								html += '<li class="page-item active" onclick="page_std(' + pagestd + ')"><a class="page-link">' + (pagestd + 1) + '</a></li>';
								html += '<li class="page-item" onclick="page_std(' + (pagestd + 1) + ')"><a class="page-link">' + (pagestd + 2) + '</a></li>';
								html += '<li class="page-item"><a class="page-link">...</a></li>';
								html += '<li class="page-item" onclick="page_std(' + (data.np_std - 1) + ')"><a class="page-link">' + data.np_std + '</a></li>';
							}
							else {
								for (i = pagestd - 2; i < data.np_std; i++) {
									html += '<li class="page-item';
									if (i == pagestd) {
										html += " active";
									}
									html += '" onclick="page_std(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>';
								}
							}
						}
					}				
					var clist = `
					<span style="float:right; margin-bottom:10px;">
	   				<input id="search_class" style="min-width:250px;margin-top:5%" placeholder="Tìm kiếm" onkeyup="search_cl_1(this,event)" value="">
				   <i class="pointer fas fa-search" onclick="search_cl()"></i></span>
				   <table class="table table-bordered">
					   <thead role="row">
					   <tr style="background-color: rgb(233, 235, 238);">
							<td>&nbsp;</td>
						   <td>#</td>
						   <td>Tên lớp</td>
						   <td>Mã lớp</td>
						   <td>Trạng thái</td>
					   <tr>
					   </thead>
					   <tbody>
					`;
					if(data['su']==3 || data['su']==1 ){
						for(i=0;i<data.class.clist.length;i++){
								if(data.class.clist[i]['stt']==1){
									clist += '<tr id="clist'+data.quiz['quid']+''+data.class.clist[i]['did']+'" class="shown">';
									clist += '<td id="olcl'+data.class.clist[i]['did']+''+data.quiz['quid']+'" class="details-control" title="Xóa" onclick="unassigntoclassc('+data.quiz['quid']+','+data.class.clist[i]['did']+')" style="width:30px" ></td>';
								}else{
									clist += '<tr id="clist'+data.quiz['quid']+''+data.class.clist[i]['did']+'">';
									clist += '<td id="olcl'+data.class.clist[i]['did']+''+data.quiz['quid']+'" class="details-control" title="Thêm" onclick="assigntoclassc('+data.quiz['quid']+','+data.class.clist[i]['did']+')" style="width:30px" ></td>';
								}
								clist += '<td> '+ data.class.clist[i]['did'] +' </td>'
								clist += '<td> '+ data.class.clist[i]['dataitem_name'] +' </td>';
								clist += '<td>'+ data.class.clist[i]['dataitem_code'] +'</td>';
								if(data.class.clist[i]['cmt'] == 'Đã giao bài'){
									clist += '<td ><p id="clistcmt'+data.quiz['quid']+''+data.class.clist[i]['did']+'" style="color:blue"><i>'+ data.class.clist[i]['cmt'] +'</i></p></td>';
								}
								else{
									clist += '<td ><p id="clistcmt'+data.quiz['quid']+''+data.class.clist[i]['did']+'" style="color:red"><i>'+ data.class.clist[i]['cmt'] +'</i></p></td>';
								}
								clist += '</tr>';
						}
						clist += '</tbody></table>';
						clist += `<center>
						<ul class="pagination listpage pageqt">`;
						if (data.np_cl < 7) {
							for (i = 0; i < data.np_cl; i++) {
								clist += '<li class="page-item';
								if (i == pagecl) {
									clist += ' active';
								}
								clist += '" onclick="page_cl(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
							}
						} else {
			
							if (pagecl <= 3) {
								for (i = 0; i < 5; i++) {
									clist += '<li class="page-item';
									if (i == pagecl) {
										clist += ' active';
									}
									clist += '" onclick="page_cl(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>'
								}
								clist += '<li class="page-item"><a class="page-link">...</a></li>';
								clist += '<li class="page-item" onclick="page_cl(' + (data.np_cl - 1) + ')"><a class="page-link">' + data.np_cl + '</a></li>';
							}
							else {
								clist += '<li class="page-item" onclick="page_cl(0)"><a class="page-link">1</a></li>';
								clist += '<li class="page-item"><a class="page-link">...</a></li>';
			
								if (page < data.np_cl - 4) {
									clist += '<li class="page-item" onclick="page_cl(' + (pagecl - 1) + ')"><a class="page-link">' + pagecl + '</a></li>';
									clist += '<li class="page-item active" onclick="page_cl(' + pagecl + ')"><a class="page-link">' + (pagecl + 1) + '</a></li>';
									clist += '<li class="page-item" onclick="page_cl(' + (pagecl + 1) + ')"><a class="page-link">' + (pagecl + 2) + '</a></li>';
									clist += '<li class="page-item"><a class="page-link">...</a></li>';
									clist += '<li class="page-item" onclick="page_cl(' + (data.np_cl - 1) + ')"><a class="page-link">' + data.np_cl + '</a></li>';
								}
								else {
									for (i = pagecl - 2; i < data.np_cl; i++) {
										clist += '<li class="page-item';
										if (i == pagecl) {
											clist += " active";
										}
										clist += '" onclick="page_cl(' + i + ')"><a class="page-link">' + (i + 1) + '</a></li>';
									}
								}
							}
						}
						$("#classtab").append(clist);
					}
				$("#studenttab").append(html);
				$("#inviteModal").modal();
			}
		});

}