$(document).ready(function(){


	$.ajax({
			  type: 'POST',
			  url: site_url+"/qbank/check_answered/"+qid1,
			  data: {},
			  contentType: 'application/json',
			  success: function(data) {
				  if(!data){
					  $("#complete_answer").modal({
							 //backdrop:'static'
					   });
					   
					    console.log(answ);
						$(".opt_choice").empty();
						$(".opt_choice").append(" "+String.fromCharCode(64+parseInt(answ))+" ");
						$("#confirm_answer").attr("onclick","answer_qt("+qid1+","+(answ-1)+")");
						
				  }
				  
				  else{
					   $("#answered").modal({
							 //backdrop:'static'
					   });
					
					   result_answered='Phương án bạn chọn là '+String.fromCharCode(65+parseInt(data['option_choice']));
					   result_answered+='. Đáp án đúng là: '+String.fromCharCode(65+parseInt(data['option_correct']))+".";
					   $("#result_answered").empty();
					   $("#result_answered").append(result_answered);
				  }
			  },
			  error:function(data) {
				  
			  },
			});	  
			
});