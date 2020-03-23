$(document).ready(function(){
	//qid0 = $("#qiq_"+0).find(".ol_opt1").attr('id').replace('ol_opt-','');
	//loadoption(qid0, 0, count_question,rid);
	
	/*for(i=1; i<count_question; i++){
		qidi = $("#qiq_"+i).find(".ol_opt").attr('id').replace('ol_opt-','');
		loadoption(qidi, i, count_question);

	
	}*/
	
	
	
});

function loadoption(qid, index,count_question,rid){

	$.ajax({
		type: 'POST',
		url: site_url+"/quiz/loadoption1/"+qid+"/"+index+"/"+count_question+"/"+rid,
		data: {},
		contentType: 'application/json',
		success: function(data) {
		  	// console.log(data);
		  	$("#ol_opt-"+qid).append(data);
		  	$("#ol_opt-"+qid).attr("id","");
		  	
		  	if(index==0){
		  		resize_opt1($("#qiq_0"));
		  	}
			// $("#sid-373202").attr("style","background:#38b44a");
			// $("#oid-373202").attr("style","background:#38b44a;color: transparent; text-shadow: 0 0 0 #444;padding-bottom:0px;overflow: hidden;");
			resize_opt1($("#qiq_"+index));
		},
		error:function(data) {
			
		},
	});	 

	

}



function carousel_next(index){
	console.log(index);
	$('#carousel1').carousel("next");
	$("#car_index_qt_"+index).attr("style","background-color:green; color:white");

	$("#car_index_qt2_"+index).attr("href","#q_type"+index-1);
	$("#car_index_qt2_"+index).attr("style","background-color:green; color:white; border:1px solid green");
}