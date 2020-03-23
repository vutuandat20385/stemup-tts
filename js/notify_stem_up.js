$(document).ready(function(){
    check = true;
    var lastScrollTop = 0;
//  console.log( $("footer").height()+969);
    $(window).scroll(function(event){
        st= $(this).scrollTop();
      //  console.log(st);
        if(st > lastScrollTop){
            distance = $("footer").height()+969;
            if($(window).width < 767){
                distance+=$("aside.rightbar").height()+20;
            }
          //  console.log($(window).scrollTop() >= $(document).height() - distance);

            if($(window).scrollTop() >= $(document).height() - distance){

                if(check==true){
                    check = false;
                    load_more_notify();
                }
            }
        }
        lastScrollTop = st;
    });

});
  function timeDifference(current, previous) {
    
    var msPerMinute = 60 * 1000;
    var msPerHour = msPerMinute * 60;
    var msPerDay = msPerHour * 24;
    var msPerMonth = msPerDay * 30;
    var msPerYear = msPerDay * 365;
    
    var elapsed = current - previous;
    if (elapsed < msPerMinute) {
         return Math.round(elapsed/1000) + ' Seconds ago';   
    }
    else if (elapsed < msPerHour) {
         return Math.round(elapsed/msPerMinute) + ' Minutes ago';   
    }
    else if (elapsed < msPerDay ) {
         return Math.round(elapsed/msPerHour ) + ' Hours ago';   
    }
    else if (elapsed < msPerMonth) {
         return  Math.round(elapsed/msPerDay) + ' Days ago';   
    }
    else if (elapsed < msPerYear) {
         return  Math.round(elapsed/msPerMonth) + ' Months ago';   
    }
    else {
         return  Math.round(elapsed/msPerYear ) + ' Years ago';   
    }
}

function load_more_notify(){
    if($("#lnid").val() == 20 ){
        $("#show_more_notify").parent().append('<div class="col-md-12" style="margin-left:50%" id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');
    }
	console.log("--------------------------");
	console.log($('#nbid').val());
	console.log("--------------------------");
    $.ajax({
        type:'POST',
        url: site_url + "/home_user/get_notify_block/"+$('#nbid').val(),
        data: {},
        contentType: 'application/json',
        success: function(data){
			$('#lnid').val(data.length);
            console.log(data);
            console.log(data.length);
            $("#circularG").remove();
            html="";
            for( i=0;i<data.length;i++ ){
             //   var day = new Date(data[i]['createdate']).getTime();
                string = data[i]['quiz_name'];
                a = "...";
			    if(data[i]['status']==1){
                html+= `<div class='col-md-12 box-bor list_notify' style=" border-bottom-style: solid;border-bottom-width: 1px" onMouseOver='this.style.backgroundColor="#85E2E7"' onMouseOut='this.style.backgroundColor="#FFFFFF"'> `;
				}else{
				html+= '<div id="testnotify_'+data["id"]+'" class="col-md-12 box-bor list_notify" style="border-bottom-style: solid;border-bottom-width: 1px;background:#d7d6d6;" onclick="test_notify('+data["id"]+')"> ';
				}
                html+='<div id="avatar" class="col-md-1 col-xs-3 avartar_notify" >';
                html+=' <img class="img-responsive img-circle" style="margin-top: 5px;width: 50px;height: 50px;border-radius: 50%;border: 2px solid #286090;" src=" '+data[i]['photo']+'">';
                html+='</div>'
                html+='<div id="content'+data[i]['id']+'" class = "col-md-8 content_notify" >';
                html+='<div id="notify">';
                html+='<p style="padding-top: 4px"><b>'+ data[i]['username']+' </b>  '+data[i]['content']+' </p>'    ;
                html+='</div>';
                html+='<div id="name_quiz">';
                html+='<p style="padding-top: 4px">Tên bài:'+string+'</p>';
                html+='</div>';
                html+='<div id="time">';    
               html+='<p>'+ data[i]['createdate'] +' </p>';    
            //    html+='<p>'+ moment(data[i]['createdate']).fromNow();  +' </p>'
                html+=' </div></div></div>';   
            }
			if(data.length>0)
				$('#nbid').val(data[data.length - 1]['id']);
            $('#show_more_notify').parent().append(html);
            check = true;
        }
    });
   
}
function see_notify(id){
	console.log(id);
	$.ajax({
        type:'POST',
        url: site_url + "/home_user/see_notify/"+id,
        data: {},
        contentType: 'application/json',
        success: function(data){
            console.log(data);
			$("#testnotify_"+id).attr('style',"background:#FFFFF");
			$.ajax({
			type:'POST',
			url: site_url + "/home_user/see_notify1/",
			data: {},
			contentType: 'application/json',
			success: function(dt){
				if(dt['so_luong']==0){
					$("#sothongbao").remove();
				}
				else{
					$("#sothongbao").html(dt['so_luong']);
					$("#so_thongbao").html(dt['so_luong']);
				}

			}

			});

            b=data[0].click;
            start=b.indexOf("/index");
            end=b.length;
            c=b.substring(start,end-1);
            console.log(start);
            console.log(c);
           window.location.href = c;
		}
    });
}