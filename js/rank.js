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
	
/*	 $.datepicker.regional["vi-VN"] =
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
	});*/
	$( "#datepicker_event" ).on("change",function(){
        day=$("#datepicker_event").val();
        $("#inf_rank_ctgr").val(0);
        var convertDay = day.split('/');
        var newDay = convertDay[2]+'-'+convertDay[1]+'-'+convertDay[0];
		redraw_rank_day(newDay,0);
	});
});
function drawpage_rank_day(page){
    day = $("#inf_rank_day_day").val();
    category = $("#inf_rank_ctgr").val();
    redraw_rank_day(day,page,category);
}
function redraw_rank_day(day,page,category){
    $("#day_ev").empty();
    $("#day_ev").append(day);
    category = $("#inf_rank_ctgr").val();
    $("#inf_rank_page_day").val(page);
    $("#inf_rank_day_day").val(day);
    dt = JSON.stringify({
        'day': day,
        'page': page,
        'limit': 10,
        'category': category,
    });
    $("#tbl_ev_byday").empty();
    $(".pagerankday").empty();
    $.ajax({
        type: 'POST',
        data: dt,
        contentType: 'application/json',
        url: site_url+"/event_racing/get_data_rank_day/",
        success: function(data){
            var html = `
            <table class="table table-hover table-striped" id="tbl_ev_byday">
				<thead>
					<tr class="bg-eee">
						<th class="text-center">#</th>
						<th>Tên</th>
						<th class="text-right">Điểm Đố</th>
					</tr>
                </thead>
                <tbody>
            `;
            for(i = 0;i<data.todaay_points.length;i++){
                html += '<tr>';
                html += "<td class='text-center ";
                if(i<3 && page==0)
                {
                    html += "bg-primary"
                }
                html += "'>"+(i+page*10+1)+"</td>";
                html += '<td>'+data.todaay_points[i]['last_name']+' '+data.todaay_points[i]['first_name']+'</td>';
                html += '<td class="text-right">'+data.todaay_points[i]['points']+'</td>';
                html += '</tr>';
            }
            html += '</tbody>';
            html += '</table>';
            $("#tbl_ev_byday").append(html);
            var pagination = `
                <center>
					<ul class="pagination listpage pageqt">
            `;
            page=parseInt(page);
            if(data.num_page_day<7){
                for(i=0; i<data.num_page_day; i++){
                    pagination +='<li class="page-item';
                    if(i==page){
                        pagination +=' active';
                    }
                    pagination +='" onclick="drawpage_rank_day('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
                }
            }else{
                if(page<=3){
                    for(i=0; i<5; i++){
                        pagination+='<li class="page-item';
                        if(i==page){
                            pagination+=' active';
                        }
                        pagination+='" onclick="drawpage_rank_day('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
                    }
                    pagination+='<li class="page-item"><a class="page-link">...</a></li>';
                    pagination+='<li class="page-item" onclick="drawpage_rank_day('+(data.num_page_day-1)+')"><a class="page-link">'+data.num_page_day+'</a></li>';
                }else{
                    pagination+='<li class="page-item" onclick="drawpage_rank_day(0)"><a class="page-link">1</a></li>';
                    pagination+='<li class="page-item"><a class="page-link">...</a></li>';
                    
                    if(page<data.num_page_day-4){
                        pagination+='<li class="page-item" onclick="drawpage_rank_day('+(parseInt(page)-1)+')"><a class="page-link">'+page+'</a></li>';
                        pagination+='<li class="page-item active" onclick="drawpage_rank_day('+page+')"><a class="page-link">'+(parseInt(page)+1)+'</a></li>';
                        pagination+='<li class="page-item" onclick="drawpage_rank_day('+(parseInt(page)+1)+')"><a class="page-link">'+(parseInt(page)+2)+'</a></li>';
                        pagination+='<li class="page-item"><a class="page-link">...</a></li>';
                        pagination+='<li class="page-item" onclick="drawpage_rank_day('+(data.num_page_day-1)+')"><a class="page-link">'+data.num_page_day+'</a></li>';
                    }
                    else{
                        for(i=page-2; i<data.num_page_day; i++){
                            pagination+='<li class="page-item';
                            if(i==page){
                                html+=" active";
                            }
                            pagination+='" onclick="drawpage_rank_day('+i+')"><a class="page-link">'+(i+1)+'</a></li>';
                        }
                        
                    }
                }
            }
            pagination += "</center>";
            $(".pagerankday").append(pagination);
        },
        error: function(data){
            console.log(data);
        }
    })
}
function drawpage_week_day(page){
    monday = $("#inf_rank_week_monday").val();
    sunday = $("#inf_rank_week_sunday").val();
    category = $("#inf_rank_ctgr").val();
    redraw_rank_week(monday,sunday,page,category);
}
function redraw_rank_week(monday,sunday,page,category){
    category = $("#inf_rank_ctgr").val();
    $("#inf_rank_week_monday").val(monday);
    $("#inf_rank_week_sunday").val(sunday);
    $("#inf_rank_week_page").val(page);
    $('#tbl_ev_byweek').empty();
    $('.pageweekday').empty();
    dt = JSON.stringify({
        'monday' :monday,
        'sunday': sunday,
        'page': page,
        'category':category,
    });
    $.ajax({
        type: "POST",
        data: dt,
        url: site_url+"/event_racing/get_data_by_week/",
        contentType: 'application/json',
        success: function(data){
            var html = `
            <thead>
					<tr class="bg-eee">
						<th class="text-center">#</th>
						<th>Tên</th>
						<th class="text-right">Điểm đố</th>
					</tr>
				</thead>
			<tbody>
            `;
            for(i = 0;i<data.week_points.length;i++){
                html += '<tr>';
                html += "<td class='text-center ";
                if(i<3 && page==0)
                {
                    html += "bg-primary"
                }
                html += "'>"+(i+page*10+1)+"</td>";
                html += '<td>'+data.week_points[i]['last_name']+' '+data.week_points[i]['first_name']+'</td>';
                html += '<td class="text-right">'+data.week_points[i]['points']+'</td>';
                html += '</tr>';
            }
            html += '</tbody>';
            html += '</table>';
            $("#tbl_ev_byweek").append(html);
            var pagination = "";
            page=parseInt(page);
            if(data.num_page_week<7){
                for(i=0; i<data.num_page_week; i++){
                    pagination +='<li class="page-item';
                    if(i==page){
                        pagination +=' active';
                    }
                    pagination +='" onclick="drawpage_week_day('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
                }
            }else{
                if(page<=3){
                    for(i=0; i<5; i++){
                        pagination+='<li class="page-item';
                        if(i==page){
                            pagination+=' active';
                        }
                        pagination+='" onclick="drawpage_week_day('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
                    }
                    pagination+='<li class="page-item"><a class="page-link">...</a></li>';
                    pagination+='<li class="page-item" onclick="drawpage_week_day('+(data.num_page_week-1)+')"><a class="page-link">'+data.num_page_week+'</a></li>';
                }else{
                    pagination+='<li class="page-item" onclick="drawpage_week_day(0)"><a class="page-link">1</a></li>';
                    pagination+='<li class="page-item"><a class="page-link">...</a></li>';
                    
                    if(page<data.num_page_week-4){
                        pagination+='<li class="page-item" onclick="drawpage_week_day('+(parseInt(page)-1)+')"><a class="page-link">'+page+'</a></li>';
                        pagination+='<li class="page-item active" onclick="drawpage_week_day('+page+')"><a class="page-link">'+(parseInt(page)+1)+'</a></li>';
                        pagination+='<li class="page-item" onclick="drawpage_week_day('+(parseInt(page)+1)+')"><a class="page-link">'+(parseInt(page)+2)+'</a></li>';
                        pagination+='<li class="page-item"><a class="page-link">...</a></li>';
                        pagination+='<li class="page-item" onclick="drawpage_week_day('+(data.num_page_week-1)+')"><a class="page-link">'+data.num_page_week+'</a></li>';
                    }
                    else{
                        for(i=page-2; i<data.num_page_week; i++){
                            pagination+='<li class="page-item';
                            if(i==page){
                                html+=" active";
                            }
                            pagination+='" onclick="drawpage_week_day('+i+')"><a class="page-link">'+(i+1)+'</a></li>';
                        }
                        
                    }
                }
            }
            $(".pageweekday").append(pagination);
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    })

}
function drawpage_all_day(page,category){
    category = $("#inf_rank_ctgr").val();
    $("#tbl_ev_byalltime").empty();
    $('.pageallday').empty();
    dt = JSON.stringify({
        'page':page,
        'category':category
    });
    $.ajax({
        type: "POST",
        data: dt,
        url: site_url+"/event_racing/get_data_by_alltime/",
        contentType: 'application/json',
        success: function(data){
            var html = `
            <thead>
					<tr class="bg-eee">
						<th class="text-center">#</th>
						<th>Tên</th>
						<th class="text-right">Điểm đố</th>
					</tr>
				</thead>
			<tbody>
            `;
            for(i = 0;i<data.alltime_points.length;i++){
                html += '<tr>';
                html += "<td class='text-center ";
                if(i<3 && page==0)
                {
                    html += "bg-primary"
                }
                html += "'>"+(i+page*10+1)+"</td>";
                html += '<td>'+data.alltime_points[i]['last_name']+' '+data.alltime_points[i]['first_name']+'</td>';
                html += '<td class="text-right">'+data.alltime_points[i]['points']+'</td>';
                html += '</tr>';
            }
            html += '</tbody>';
            html += '</table>';
            $("#tbl_ev_byalltime").append(html);
            var pagination = "";
            page=parseInt(page);
            if(data.num_page<7){
                for(i=0; i<data.num_page; i++){
                    pagination +='<li class="page-item';
                    if(i==page){
                        pagination +=' active';
                    }
                    pagination +='" onclick="drawpage_all_day('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
                }
            }else{
                if(page<=3){
                    for(i=0; i<5; i++){
                        pagination+='<li class="page-item';
                        if(i==page){
                            pagination+=' active';
                        }
                        pagination+='" onclick="drawpage_all_day('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
                    }
                    pagination+='<li class="page-item"><a class="page-link">...</a></li>';
                    pagination+='<li class="page-item" onclick="drawpage_all_day('+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
                }else{
                    pagination+='<li class="page-item" onclick="drawpage_all_day(0)"><a class="page-link">1</a></li>';
                    pagination+='<li class="page-item"><a class="page-link">...</a></li>';
                    
                    if(page<data.num_page-4){
                        pagination+='<li class="page-item" onclick="drawpage_all_day('+(parseInt(page)-1)+')"><a class="page-link">'+page+'</a></li>';
                        pagination+='<li class="page-item active" onclick="drawpage_all_day('+page+')"><a class="page-link">'+(parseInt(page)+1)+'</a></li>';
                        pagination+='<li class="page-item" onclick="drawpage_all_day('+(parseInt(page)+1)+')"><a class="page-link">'+(parseInt(page)+2)+'</a></li>';
                        pagination+='<li class="page-item"><a class="page-link">...</a></li>';
                        pagination+='<li class="page-item" onclick="drawpage_all_day('+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
                    }
                    else{
                        for(i=page-2; i<data.num_page; i++){
                            pagination+='<li class="page-item';
                            if(i==page){
                                html+=" active";
                            }
                            pagination+='" onclick="drawpage_all_day('+i+')"><a class="page-link">'+(i+1)+'</a></li>';
                        }
                        
                    }
                }
            }
            $(".pageallday").append(pagination);
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    })
}
function allrankcategory(event){
    category = event.value;
    $("#inf_rank_ctgr").val(category);
    day = $("#inf_rank_day_day").val();
    monday = $("#inf_rank_week_monday").val();
    sunday = $("#inf_rank_week_sunday").val();
    redraw_rank_day(day,0,category);
    redraw_rank_week(monday,sunday,0,category);
    drawpage_all_day(0,category);
}
function rankwithcategory(event){
   $("#rankTable").empty();
   var day = $("#inf_rank_day_day").val();
   dt = JSON.stringify({
    'category':event.value,
    'day' :day,
    'limit': 5,
    'page': 0
    });
    $.ajax({
        type: "POST",
        data: dt,
        url: site_url+"/event_racing/get_data_rank_day/",
        contentType: 'application/json',
        success:function(data){
            var html = `
            <table class="table table-hover table-striped">
				<thead>
				  <tr class="bg-eee">
					<th class="text-center">#</th>
					<th>Tên</th>
					<th class="text-right">Điểm Đố</th>
				  </tr>
				</thead>
				<tbody>
            `;
            for(var i =0;i<data.todaay_points.length;i++){
                html += "<tr>"
                html += "<td class='text-center "
                if(i < 3){
                    html += " bg-primary' ";
                }
                html += " >";
                html += (i+1)+"</td>";
                html += "<td>"+data.todaay_points[i]['last_name']+ ' '+data.todaay_points[i]['first_name']+ "</td>";
                html += "<td class='text-right'>"+data.todaay_points[i]['points']+"</td>";
                html += "</tr>"
            }
            $("#rankTable").append(html);
        },
        error:function(data){
        }
    })
}


function rankwithcategory2(event){
   $("#rankTable").empty();
   var day = $("#inf_rank_day_day").val();
   dt = JSON.stringify({
    'category':event.value,
    'day' :day,
    'limit': 5,
    'page': 0
    });
    $.ajax({
        type: "POST",
        data: dt,
        url: site_url+"/event_racing/get_data_rank_day/",
        contentType: 'application/json',
        success:function(data){
            var html = `
            <table class="table table-hover table-striped">
				<thead>
				  <tr class="bg-eee">
					<th class="text-center">#</th>
					<th>Tên</th>
					<th class="text-right">Điểm Đố</th>
				  </tr>
				</thead>
				<tbody>
            `;
            for(var i =0;i<data.todaay_points.length;i++){
                html += "<tr>"
                html += "<td class='text-center "
                if(i < 3){
                    html += " bg-primary' ";
                }
                html += " >";
                html += (i+1)+"</td>";
                html += "<td>"+data.todaay_points[i]['last_name']+ ' '+data.todaay_points[i]['first_name']+ "</td>";
                html += "<td class='text-right'>"+data.todaay_points[i]['points']+"</td>";
                html += "</tr>"
            }
            $("#rankTable").append(html);
        },
        error:function(data){
        }
    })
}