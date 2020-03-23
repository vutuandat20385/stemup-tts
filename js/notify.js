$(document).ready(function(){
    check = true;
    var lastScrollTop = 0;
    $(window).scroll(function(event){
        st= $(this).scrollTop();
        
        if(st > lastScrollTop){
            distance = $("footer").height()+800;
            if($(window).width < 767){
                distance+=$("aside.rightbar").height()+20;
            }
            if($(window).scrollTop() >= $(document).height() - distance){
            //    console.log($(window).scrollTop() >= $(document).height() - distance);

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
    $("#show_more_notify").parent().append('<div class="col-md-12" style="margin-left:50%" id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');
    $.ajax({
        type:'POST',
        url: site_url + "/home_user/get_notify_block/"+$('#nbid').val(),
        data: {},
        contentType: 'application/json',
        success: function(data){
            $("#circularG").remove();
            html="";
            for( i=0;i<data.length;i++ ){
                var day = new Date(data[i]['createdate']).getTime();
                html+= `<div class='col-md-12 pointer' style=" border-bottom-style: solid;border-bottom-width: 1px" onMouseOver='this.style.backgroundColor="#85E2E7"' onMouseOut='this.style.backgroundColor="#E9EBEE"' `;
                if(su!=2 && data[i]['action'] == 'Assign quiz' ){
                    html+='>';
                }else{
                    html +=  'onclick="'+data[i]['click']+'">';
                };
                html+='<div id="avatar" class="col-md-1" >';
                html+=' <img class="img-responsive img-circle" style="padding-top: 4px" src=" '+data[i]['photo']+'">';
                html+='</div>'
                html+='<div id="content" class = "col-md-8" >';
                html+='<div id="notify">';
                html+='<p style="padding-top: 4px"><b>'+ data[i]['username']+' </b>  '+data[i]['content']+' </p>'    ;
                html+='</div>';
                html+='<div id="time">';    
               html+='<p>'+ timeDifference(Date.now(),day) +' </p>';    
            //    html+='<p>'+ moment(data[i]['createdate']).fromNow();  +' </p>'
                html+=' </div></div></div>';   
            }
            $('#nbid').val(data[data.length - 1]['id']);
            $('#show_more_notify').parent().append(html);
            check = true;
        }
    });
   
}