function level(lid,size){
    $("#level_"+lid).addClass("active");
    for(i=2;i<size+3;i++){
        if(i!=lid){
            $("#level_"+i).removeClass("active");
        }
    }
    $("#div_category").empty();
    $("#div_level_category").empty();

    var dt = JSON.stringify({
        'lid' : lid,
    });
    $.ajax({
        type: "GET",
        url: base_url + "index.php/qbank/get_lid/"+lid,
        data: dt,
        contentType: "application/json",
        success: function(data){
            console.log(data);
            html = '';
            for(i=0;i<data.lid_cid.length;i++){
                html += '<div class="box-bor col-md-11" id=level_category_'+ data.lid_cid[i]['lid'] +'_'+ data.lid_cid[i]['cid'] +'>';
                html += '<div onclick="category('+ data.lid_cid[i]['lid'] +','+ data.lid_cid[i]['cid'] +','+ data.cid[0]['cid'] +')">';
                html += '<span>'+ data.lid_cid[i]['category_name'] +'</span>';
                html += '<span style="float:right">'+ data.lid_cid[i]['num_question'] +'</span>';
                html += '</div>';
                html += '</div>';
            }
            $("#div_category").append(html);
        },
        error: function(data){

        }
    })
}
function category(lid,cid,size){
    $("#level_category_"+lid+"_"+cid).css({"background-color": "#337ab7"});
    for(i=0;i<=size;i++){
        if(i!=cid){
            $("#level_category_"+lid+"_"+i).removeAttr('style');
        }
    }
    $("#div_level_category").empty();
    var dt = JSON.stringify({
        'lid':lid,
        'cid':cid,
    });
    $.ajax({
        type:"GET",
        url: base_url + "index.php/qbank/get_lid_cid/"+lid+"/"+cid,
        data: dt,
        contentType: "application/json",
        success: function(data){
            html ='';
            console.log(data.lesson.length);
            if(data.lesson.length != 0){
                for(i=0;i<data.lesson.length;i++){
                    html += '<div class="box-bor col-md-10">';
                    html += '<span>'+ data.lesson[i]['lesson'] +'</span>';
                    html += '<span style="float:right">'+ data.lesson[i]['num_question'] +'</span>';
                    html += '</div>';
                }
            } else {
                html += '<div class="box-bor col-md-10">';
                html += '<span> Không có bài học nào! </span>';
                html += '</div>';
            }

            $("#div_level_category").append(html);
        },
        error: function(data){

        }
    })
}