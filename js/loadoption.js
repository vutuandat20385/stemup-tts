$(document).ready(function(){
	qid0 = $("#qiq_"+0).find(".ol_opt").attr('id').replace('ol_opt-','');
	loadoption(qid0, 0, count_question);
	
	/*for(i=1; i<count_question; i++){
		qidi = $("#qiq_"+i).find(".ol_opt").attr('id').replace('ol_opt-','');
		loadoption(qidi, i, count_question);

	
	}*/
	
	 
       
});

function loadoption(qid, index,count_question){

	  $.ajax({
		  type: 'POST',
		  url: site_url+"/quiz/loadoption/"+qid+"/"+index+"/"+count_question,
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {

			 $("#ol_opt-"+qid).append(data);
			 $("#ol_opt-"+qid).attr("id","");
			  //if(index==0){
				//  resize_opt1($("#qiq_0"));
			 // }

			resize_opt1($("#qiq_"+index));
			

		  },
		  error:function(data) {
			  
		  },
		});	  
	
	
}


function carousel_next(index){
//	console.log(index);
	$('#carousel1').carousel("next");
	$("#car_index_qt_"+index).attr("style","background-color:green; color:white");
	$("#car_index_qt2_"+index).attr("href","#q_type"+index-1);
	$("#car_index_qt2_"+index).attr("style","background-color:green; color:white; border:1px solid green");
	radios = document.getElementsByName('answer['+index+'][]');
	for (var i = 0, length = radios.length; i < length; i++){
		 if (radios[i].checked){
			// value = radios[i].value;
			// $("#oid-"+radios[i].value).attr("style","background-color:green; color:white");
			// $("#sid-"+radios[i].value).attr("style","background-color:green; color:white");
			 $("#sid-"+radios[i].value).css("background-color","green");
			 $("#sid-"+radios[i].value).css("color","white");
			 $("#oid-"+radios[i].value).css("background-color","green");
			 $("#oid-"+radios[i].value).css("color","white");
		 } else {
		//	$("#oid-"+radios[i].value).attr("style","");
		//	$("#sid-"+radios[i].value).attr("style","");
			$("#sid-"+radios[i].value).css("background-color","");
			$("#sid-"+radios[i].value).css("color","transparent");
			$("#oid-"+radios[i].value).css("background-color","");
			$("#oid-"+radios[i].value).css("color","transparent");
		//	 console.log(radios[i].value);
			//uncheck.push(radios[i].value);
		//	$("#oid-"+value).attr("style","");
		//	$("#sid-"+value).attr("style","");
		 }
	}	

}