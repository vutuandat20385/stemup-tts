$( document ).ready(function(){
	$.ajax({
		  type: 'POST',
		  url: site_url+"/event_racing/summary/",
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {		
              		  
		  },
		  error: function(data) {			  
		  }
	 });
	
	 $.datepicker.regional["vi-VN"] =
	{
		closeText: "Đóng",
		prevText: "Trước",
		nextText: "Sau",
		currentText: "Hôm nay",
		monthNames: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
		monthNamesShort: ["Một", "Hai", "Ba", "Bốn", "Năm", "Sáu", "Bảy", "Tám", "Chín", "Mười", "Mười một", "Mười hai"],
		dayNames: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"],
		dayNamesShort: ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"],
		dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
		weekHeader: "Tuần",
		dateFormat: "dd/mm/yy",
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ""
	};

	$.datepicker.setDefaults($.datepicker.regional["vi-VN"]);
	
	$( "#datepicker_event" ).datepicker({
		dateFormat:"dd/mm/yy",
		maxDate: "+0D"
	});
	
	$( "#datepicker_event_1" ).datepicker({
		dateFormat:"dd/mm/yy",
		maxDate: "+0D"
	});
	$( "#datepicker_event_2" ).datepicker({
		dateFormat:"dd/mm/yy",
		maxDate: "+0D"
	});
	$( "#datepicker_event" ).on("change",function(){
		day=$("#datepicker_event").val();
		$(".see_all_link_day").empty();
		daystr= "'"+day+"'";
		$(".see_all_link_day").append('<p class="text-right"><a class="pointer" onclick="redraw_all_ev_tbl_day('+daystr+',0)">Xem tất cả</a></p>');
		redraw_ev_tbl_day(day,0);
	});
	
	$( "#datepicker_event_1" ).on("change",function(){
		day=$("#datepicker_event_1").val();
		$( "#datepicker_event" ).val(day);
		$("#datepicker_event_1").val("Xem theo ngày");
		$('.nav-tabs a[href="#home1"]').tab('show');
		$(".see_all_link_day").empty();
		daystr= "'"+day+"'";
		$(".see_all_link_day").append('<p class="text-right"><a class="pointer" onclick="redraw_all_ev_tbl_day('+daystr+',0)">Xem tất cả</a></p>');
		
		redraw_ev_tbl_day(day,0);
	});
	
	$( "#datepicker_event_2" ).on("change",function(){
		day=$("#datepicker_event_2").val();
		$( "#datepicker_event" ).val(day);
		$("#datepicker_event_2").val("Xem theo ngày");
		$('.nav-tabs a[href="#home1"]').tab('show');
		$(".see_all_link_day").empty();
		daystr= "'"+day+"'";
		$(".see_all_link_day").append('<p class="text-right"><a class="pointer" onclick="redraw_all_ev_tbl_day('+daystr+',0)">Xem tất cả</a></p>');
		redraw_ev_tbl_day(day,0);
	});
});


function redraw_ev_tbl_day(day, page){
	
	$("#tbl_ev_byday").empty();
	$("#tbl_ev_byday").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');
	$("#day_ev").empty();
	$("#day_ev").append(day);
	$.ajax({
		  type: 'POST',
		  url: site_url+"/event_racing/get_data_by_day/",
		  data: JSON.stringify({"day":day, "page":page}),
		  contentType: 'application/json',
		  success: function(data) {
			  console.log(data);
              html='<thead>';
			  html+='<tr class="bg-eee">';
			  html+='<th class="text-center">#</th>';
			  html+='<th>Tên</th>';
			  html+='<th class="text-right">Điểm Đố</th>';
			  html+='<th class="text-right">Điểm Vui</th>';
			  html+='<th class="text-right">Điểm Học</th>';
			  html+='<th class="text-right">Tổng điểm</th>';
			  html+='</tr>';
			  html+='</thead>';
			  html+='<tbody>';
			  if(data.day_points.length!=0){
				  for(i=0; i<data.day_points.length; i++){
					 html+='<tr>';
					 html+='<td class="text-center';
						if(i<3){ 
							html+=' bg-primary';
						} 
						html+='">'+(i+1)+'</td>';
					 html+='<td><a href="">'+data.day_points[i]['first_name']+" "+data.day_points[i]['last_name']+'</a></td>';
					 html+='<td class="text-right">'+data.day_points[i]['do_points']+'</td>';
					 html+='<td class="text-right">'+data.day_points[i]['vui_points']+'</td>';
					 html+='<td class="text-right">'+data.day_points[i]['hoc_points']+'</td>';
					 html+='<td class="text-right"><strong>'+data.day_points[i]['total_points']+'</strong></td>';
					 html+='</tr>';
				   } 
			   }
               else{
                  html+='<tr><td class="text-center" colspan="6">Không có dữ liệu</td></tr>';
               }				  
			   html+='</tbody>';
			   $("#circularG").remove();
			   $("#tbl_ev_byday").append(html);
			   
		  },
		  error: function(data) {
			  console.log(data);
			  
		  }
	});
}


function redraw_all_ev_tbl_day(day, page){
	
	$("#tbl_ev_byday").empty();
	$("#tbl_ev_byday").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');
	$("#day_ev").empty();
	$("#day_ev").append(day);
	$.ajax({
		  type: 'POST',
		  url: site_url+"/event_racing/get_data_by_day/",
		  data: JSON.stringify({"day":day, "page":page}),
		  contentType: 'application/json',
		  success: function(data) {
              html='<thead>';
			  html+='<tr class="bg-eee">';
			  html+='<th class="text-center">#</th>';
			  html+='<th>Tên</th>';
			  html+='<th class="text-right">Điểm Đố</th>';
			  html+='<th class="text-right">Điểm Vui</th>';
			  html+='<th class="text-right">Điểm Học</th>';
			  html+='<th class="text-right">Tổng điểm</th>';
			  html+='</tr>';
			  html+='</thead>';
			  html+='<tbody>';
			  if(data.day_points.length!=0){
				  for(i=0; i<data.day_points.length; i++){
					 html+='<tr>';
					 html+='<td class="text-center';
						if(i<3 && page==0){ 
							html+=' bg-primary';
						} 
						html+='">'+(page*10+i+1)+'</td>';
					 html+='<td><a href="">'+data.day_points[i]['first_name']+" "+data.day_points[i]['last_name']+'</a></td>';
					 html+='<td class="text-right">'+data.day_points[i]['do_points']+'</td>';
					 html+='<td class="text-right">'+data.day_points[i]['vui_points']+'</td>';
					 html+='<td class="text-right">'+data.day_points[i]['hoc_points']+'</td>';
					 html+='<td class="text-right"><strong>'+data.day_points[i]['total_points']+'</strong></td>';
					 html+='</tr>';
				   } 
			   }
               else{
                  html+='<tr><td class="text-center" colspan="6">Không có dữ liệu</td></tr>';
               }				  
			   html+='</tbody>';
			   $("#circularG").remove();
			   $(".see_all_link_day").empty();
			   
			   pgihtml=' <div class="text-right"><ul class="pagination listpage pageqt" style="margin:0px">';
			   daystr="'"+day+"'";
			   if(data.num_page<7){
				  for(i=0; i<data.num_page; i++){
					  pgihtml+='<li class="page-item';
					  if(i==page){
						   pgihtml+=' active';
					  }
					  pgihtml+='" onclick="redraw_all_ev_tbl_day('+daystr+','+i+')"><a class="page-link">'+(i+1)+'</a></li>'
				  }
				  
				 
			  }
			  else{
				  if(page<=3){
					  for(i=0; i<5; i++){
						  pgihtml+='<li class="page-item';
						  if(i==page){
							   pgihtml+=' active';
						  }
						  pgihtml+='" onclick="redraw_all_ev_tbl_day('+daystr+','+i+')"><a class="page-link">'+(i+1)+'</a></li>'
					  }
					  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
					  pgihtml+='<li class="page-item" onclick="redraw_all_ev_tbl_day('+daystr+','+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
				  }
				  else{
					  pgihtml+='<li class="page-item" onclick="redraw_all_ev_tbl_day('+daystr+',0)"><a class="page-link">1</a></li>';
					  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
					  
					  if(page<data.num_page-4){
						  pgihtml+='<li class="page-item" onclick="redraw_all_ev_tbl_day('+daystr+','+(page-1)+')"><a class="page-link">'+page+'</a></li>';
						  pgihtml+='<li class="page-item active" onclick="redraw_all_ev_tbl_day('+daystr+','+page+')"><a class="page-link">'+(page+1)+'</a></li>';
						  pgihtml+='<li class="page-item" onclick="redraw_all_ev_tbl_day('+daystr+','+(page+1)+')"><a class="page-link">'+(page+2)+'</a></li>';
						  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
						  pgihtml+='<li class="page-item" onclick="redraw_all_ev_tbl_day('+daystr+','+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
					  }
					  else{
						  for(i=page-2; i<data.num_page; i++){
							  pgihtml+='<li class="page-item';
							  if(i==page){
								  pgihtml+=" active";
							  }
							  pgihtml+='" onclick="redraw_all_ev_tbl_day('+daystr+','+i+')"><a class="page-link">'+(i+1)+'</a></li>';
						  }
						  
					  }
				  }
			  }
			  pgihtml+="</ul></div>";
			  $(".see_all_link_day").append(pgihtml);
			  $("#tbl_ev_byday").append(html);
			   
		  },
		  error: function(data) {
			  console.log(data);
			  
		  }
	});
}


function redraw_all_ev_tbl_week(monday, sunday, page){
	
	$("#tbl_ev_byweek").empty();
	$("#tbl_ev_byweek").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');

	$.ajax({
		  type: 'POST',
		  url: site_url+"/event_racing/get_data_by_week/",
		  data: JSON.stringify({"monday":monday, "sunday":sunday,"page":page}),
		  contentType: 'application/json',
		  success: function(data) {
			  html='<thead>';
			  html+='<tr class="bg-eee">';
			  html+='<th class="text-center">#</th>';
			  html+='<th>Tên</th>';
			  html+='<th class="text-right">Điểm Đố</th>';
			  html+='<th class="text-right">Điểm Vui</th>';
			  html+='<th class="text-right">Điểm Học</th>';
			  html+='<th class="text-right">Tổng điểm</th>';
			  html+='</tr>';
			  html+='</thead>';
			  html+='<tbody>';
			  if(data.week_points.length!=0){
				  for(i=0; i<data.week_points.length; i++){
					 html+='<tr>';
					 html+='<td class="text-center';
						if(i<3 && page==0){ 
							html+=' bg-primary';
						} 
						html+='">'+(page*10+i+1)+'</td>';
					 html+='<td><a href="">'+data.week_points[i]['first_name']+" "+data.week_points[i]['last_name']+'</a></td>';
					 html+='<td class="text-right">'+data.week_points[i]['dps']+'</td>';
					 html+='<td class="text-right">'+data.week_points[i]['vps']+'</td>';
					 html+='<td class="text-right">'+data.week_points[i]['hps']+'</td>';
					 html+='<td class="text-right"><strong>'+data.week_points[i]['tps']+'</strong></td>';
					 html+='</tr>';
				   } 
			   }
               else{
                  html+='<tr><td class="text-center" colspan="6">Không có dữ liệu</td></tr>';
               }				  
			   html+='</tbody>';
			   $("#circularG").remove();
			   $(".see_all_link_week").empty();
			   
			   pgihtml=' <div class="text-right"><ul class="pagination listpage pageqt" style="margin:0px">';
			   daystr="'"+monday+"','"+sunday+"'";
			   if(data.num_page<7){
				  for(i=0; i<data.num_page; i++){
					  pgihtml+='<li class="page-item';
					  if(i==page){
						   pgihtml+=' active';
					  }
					  pgihtml+='" onclick="redraw_all_ev_tbl_week('+daystr+','+i+')"><a class="page-link">'+(i+1)+'</a></li>'
				  }
				  
				 
			  }
			  else{
				  if(page<=3){
					  for(i=0; i<5; i++){
						  pgihtml+='<li class="page-item';
						  if(i==page){
							   pgihtml+=' active';
						  }
						  pgihtml+='" onclick="redraw_all_ev_tbl_week('+daystr+','+i+')"><a class="page-link">'+(i+1)+'</a></li>'
					  }
					  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
					  pgihtml+='<li class="page-item" onclick="redraw_all_ev_tbl_week('+daystr+','+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
				  }
				  else{
					  pgihtml+='<li class="page-item" onclick="redraw_all_ev_tbl_week('+daystr+',0)"><a class="page-link">1</a></li>';
					  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
					  
					  if(page<data.num_page-4){
						  pgihtml+='<li class="page-item" onclick="redraw_all_ev_tbl_week('+daystr+','+(page-1)+')"><a class="page-link">'+page+'</a></li>';
						  pgihtml+='<li class="page-item active" onclick="redraw_all_ev_tbl_week('+daystr+','+page+')"><a class="page-link">'+(page+1)+'</a></li>';
						  pgihtml+='<li class="page-item" onclick="redraw_all_ev_tbl_week('+daystr+','+(page+1)+')"><a class="page-link">'+(page+2)+'</a></li>';
						  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
						  pgihtml+='<li class="page-item" onclick="redraw_all_ev_tbl_week('+daystr+','+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
					  }
					  else{
						  for(i=page-2; i<data.num_page; i++){
							  pgihtml+='<li class="page-item';
							  if(i==page){
								  pgihtml+=" active";
							  }
							  pgihtml+='" onclick="redraw_all_ev_tbl_week('+daystr+','+i+')"><a class="page-link">'+(i+1)+'</a></li>';
						  }
						  
					  }
				  }
			  }
			  pgihtml+="</ul></div>";
			  $(".see_all_link_week").append(pgihtml);
			  $("#tbl_ev_byweek").append(html);
			   
		  },
		  error: function(data) {
			  console.log(data);
			  
		  }
	});
}


function redraw_all_ev_tbl_alltime(page){
	
	$("#tbl_ev_byalltime").empty();
	$("#tbl_ev_byalltime").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');

	$.ajax({
		  type: 'POST',
		  url: site_url+"/event_racing/get_data_by_alltime/",
		  data: JSON.stringify({"page":page}),
		  contentType: 'application/json',
		  success: function(data) {
			  html='<thead>';
			  html+='<tr class="bg-eee">';
			  html+='<th class="text-center">#</th>';
			  html+='<th>Tên</th>';
			  html+='<th class="text-right">Điểm Đố</th>';
			  html+='<th class="text-right">Điểm Vui</th>';
			  html+='<th class="text-right">Điểm Học</th>';
			  html+='<th class="text-right">Tổng điểm</th>';
			  html+='</tr>';
			  html+='</thead>';
			  html+='<tbody>';
			  if(data.alltime_points.length!=0){
				  for(i=0; i<data.alltime_points.length; i++){
					 html+='<tr>';
					 html+='<td class="text-center';
						if(i<3 && page==0){ 
							html+=' bg-primary';
						} 
						html+='">'+(page*10+i+1)+'</td>';
					 html+='<td><a href="">'+data.alltime_points[i]['first_name']+" "+data.alltime_points[i]['last_name']+'</a></td>';
					 html+='<td class="text-right">'+data.alltime_points[i]['dps']+'</td>';
					 html+='<td class="text-right">'+data.alltime_points[i]['vps']+'</td>';
					 html+='<td class="text-right">'+data.alltime_points[i]['hps']+'</td>';
					 html+='<td class="text-right"><strong>'+data.alltime_points[i]['tps']+'</strong></td>';
					 html+='</tr>';
				   } 
			   }
               else{
                  html+='<tr><td class="text-center" colspan="6">Không có dữ liệu</td></tr>';
               }				  
			   html+='</tbody>';
			   $("#circularG").remove();
			   $(".see_all_link_alltime").empty();
			   
			   pgihtml=' <div class="text-right"><ul class="pagination listpage pageqt" style="margin:0px">';
			   if(data.num_page<7){
				  for(i=0; i<data.num_page; i++){
					  pgihtml+='<li class="page-item';
					  if(i==page){
						   pgihtml+=' active';
					  }
					  pgihtml+='" onclick="redraw_all_ev_tbl_alltime('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
				  }
				  
				 
			  }
			  else{
				  if(page<=3){
					  for(i=0; i<5; i++){
						  pgihtml+='<li class="page-item';
						  if(i==page){
							   pgihtml+=' active';
						  }
						  pgihtml+='" onclick="redraw_all_ev_tbl_alltime('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
					  }
					  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
					  pgihtml+='<li class="page-item" onclick="redraw_all_ev_tbl_alltime('+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
				  }
				  else{
					  pgihtml+='<li class="page-item" onclick="redraw_all_ev_tbl_alltime(0)"><a class="page-link">1</a></li>';
					  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
					  
					  if(page<data.num_page-4){
						  pgihtml+='<li class="page-item" onclick="redraw_all_ev_tbl_alltime('+(page-1)+')"><a class="page-link">'+page+'</a></li>';
						  pgihtml+='<li class="page-item active" onclick="redraw_all_ev_tbl_alltime('+page+')"><a class="page-link">'+(page+1)+'</a></li>';
						  pgihtml+='<li class="page-item" onclick="redraw_all_ev_tbl_alltime('+(page+1)+')"><a class="page-link">'+(page+2)+'</a></li>';
						  pgihtml+='<li class="page-item"><a class="page-link">...</a></li>';
						  pgihtml+='<li class="page-item" onclick="redraw_all_ev_tbl_alltime('+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
					  }
					  else{
						  for(i=page-2; i<data.num_page; i++){
							  pgihtml+='<li class="page-item';
							  if(i==page){
								  pgihtml+=" active";
							  }
							  pgihtml+='" onclick="redraw_all_ev_tbl_alltime('+i+')"><a class="page-link">'+(i+1)+'</a></li>';
						  }
						  
					  }
				  }
			  }
			  pgihtml+="</ul></div>";
			  $(".see_all_link_alltime").append(pgihtml);
			  $("#tbl_ev_byalltime").append(html);
			   
		  },
		  error: function(data) {
			  console.log(data);
			  
		  }
	});
}


