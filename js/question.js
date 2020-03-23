$(document).ready(function(){
	$(".div_opt").each(function(){
		resize_opt(this);
	});
	if(login==0){
		$(".mobile-opt").on("click", function(){
			 popup_require_login();
		});
	}
	else{
		$(".optradio_main").on("click", function(){
		qid = $(this).attr("name").replace("opt_main_","");
		ans = $(this).val();
	
		$.ajax({
		  type: 'POST',
		  url: site_url+"/qbank/check_answered/"+qid,
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {
			  if(!data){
				  $("#complete_answer").modal({
						 //backdrop:'static'
				   });
				   
				   
					$(".opt_choice").empty();
					$(".opt_choice").append(" "+String.fromCharCode(65+parseInt(ans))+" ");
					$("#confirm_answer").attr("onclick","answer_qt("+qid+","+ans+")");
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
	
	$(".optvalmb").on("click", function(){
		
		qid = $(this).parent().prev().attr("name").replace("opt_main_","");
		ans = $(this).parent().prev().val();
		$(this).parent().parent().find(".optradio_main").attr("checked", true);
		if($('#carousel1').length){
			indexqt=$(this).parent().parent().find(".optradio_main").attr("id").replace("answer_value","").split("-")[0];
			$('#carousel1').carousel("next");
			$("#car_index_qt_"+indexqt).attr("style","background-color:green; color:white");
			$("#car_index_qt2_"+indexqt).attr("style","background-color:green; color:white");
		}
		$.ajax({
		  type: 'POST',
		  url: site_url+"/qbank/check_answered/"+qid,
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {
			  if(!data){
				  $("#complete_answer").modal({
						// backdrop:'static'
				   });
				   
					$(".opt_choice").empty();
					$(".opt_choice").append(" "+String.fromCharCode(65+parseInt(ans))+" ");
					$("#confirm_answer").attr("onclick","answer_qt("+qid+","+ans+")");
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
	}

});


function resize_opt(event){
	if($(window).width()>767){
		
		max_size=0; 
		$(event).find(".optvalmb").each(function() {
			c_size=$(this)[0].scrollHeight;
			if(c_size>max_size){
				max_size=c_size;
			}
		})
		$(event).find(".optvalmb").each(function() {
			$(this).height(max_size+5);
		});
		$(event).find(".optradio_main").each(function() {
			$(this).attr("style","transform:translate(0px,"+((max_size-10)/2)+"px); z-index:7;" );
		});
		$(event).find(".bo-input-left").each(function() {
			$(this).attr("style","transform:translateX(-8px)");
		});
		$(event).find("tr").each(function() {
			$(this).attr("valign", "center");
			$(this).attr("style", "height:"+(max_size-10)+"px");
		});
		
		
	}
	else{
		
		$(event).find(".optvalmb").each(function() {
			$(this).height($(this)[0].scrollHeight );
		});
		
		$(event).find(".optradio_main").each(function() {
			
			$(this).attr("style","transform:translate(20px,"+(($(this).next().height()-36)/2)+"px); z-index:7; margin-top:10px!important" );
		});

	}
}
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

function dismiss_modal(e){
	$(e).modal('hide');
}

function alert_msg(){
	alert('Vui lòng đăng nhập hoặc tạo tài khoản!');
}

function popup_require_login(){
	
  $("#popup_require_login").modal();

}
function login(){
	
  $("#loginmodal").modal();

}


function count_share(qid){
	 $.ajax({
		  type: 'POST',
		  url: site_url+"/api/count_share/",
		  data: JSON.stringify({'qid':qid }),
		  contentType: 'application/json',
		  success: function(data) {
			 
		  },
		  error: function(data) {
			 
			  
		  }
	 });
}

function write_comment(event,e,model, wall_id){
	 
	 if(e.keyCode=='13'){
			cm = $(event).val();
			if(cm!=""){		
				 $.ajax({
					  type: 'POST',
					  url: site_url+"/comment/write/"+model+"/"+wall_id,
					  data: JSON.stringify({'content':cm}),
					  contentType: 'application/json',
					  success: function(data) {
						$(event).val("");
						var cmthtml='<div class="media">'+
							 '<div class="media-left">'+
								'<a href="#">';
						if(data['photo'])		
							cmthtml+='<img class="media-object img-circle" src="'+data['photo']+'" width="36" alt="placeholder image">';
						else
							cmthtml+='<img class="media-object img-circle" src="'+base_url+'upload/avatar/default.png" width="36" alt="placeholder image">';
						cmthtml+='</a>'+
							'</div>'+
							'<div class="media-body">'+
								'<h4 class="media-heading"><a href="">'+data['user_name']+'</a></h4>'+cm+
								//'<p class="text-small1">'+
									//'<a class="mr-23" href="">Thích</a>'+
									//'<a class="mr-23" href="">Trả lời</a> - Vừa xong'+
								//'</p>'+
							'</div>'+				
							'</div>';
						$("#box_comment_"+wall_id+">.media-object-default").prepend(cmthtml);
					  },
					  error : function(data) {
						 console.log(data);
					  }	  
					  
				});
		}
	}			 
}

function like_question(event, qid){
	$.ajax({
		  type: 'POST',
		  url: site_url+"/qbank/like/",
		  data: JSON.stringify({'qid':qid}),
		  contentType: 'application/json',
		  success: function(data) {
			  //console.log(data);
			  if($(event).attr("class")=='acti pointer'){
					$(event).attr("class", 'pointer');
					$(event).children().remove();
					if(data.n_like>0){
						$("#like_statistic_"+qid).find('a').empty();
						$("#like_statistic_"+qid).find('a').append(data.n_like+ " người");
					}
					else{
						$("#like_statistic_"+qid).empty();
					}
				}
				else{
					$(event).attr("class", 'acti pointer');
					$(event).prepend('<i class="fas fa-thumbs-up mr-5"></i>');
					if(!$("#like_statistic_"+qid+">div").length){
						html_st= '<div class="col-xs-12 bo-B" >'+ 
									'<i style="width:20px" class="fas fa-thumbs-up mr-5 bo-tron bg-primary"></i>'+
									'<a class="f10" href="#">';
						if(data.n_like>0){
							html_st+='Bạn và '+data.n_like+' người</a> </div>';
						}
						else{
							html_st+=data.user_name+'</a> </div>';
						}
						$("#like_statistic_"+qid).append(html_st);
					}
					else{
						$("#like_statistic_"+qid).find('a').empty();
						st = "Bạn";
						if(data.n_like>0)
							st+=' và '+data.n_like+' người';
						$("#like_statistic_"+qid).find('a').append(st);
					}
					
				}
		  },
		  error: function(data) {
			  
		  }
	});
	
}
function answer_qt(qid,ans){
	$.ajax({
		  type: 'POST',
		  url: site_url+"/qbank/answer_mcq/",
		  data: JSON.stringify({'qid':qid, 'ans':ans}),
		  contentType: 'application/json',
		  success: function(data) {
			  $("#result_answer_qt").modal({
				   //backdrop:'static'
			  });
			  
			  
			  if(ans==data['correct']){
				  $("#result_answer_qt_true").modal({
					   //backdrop:'static'
				  });
				  $("#correct_ans_tr").empty();
				  
				  $("#correct_ans_tr").append(String.fromCharCode(65+parseInt(data['correct']))+": "+data['options'][data['correct']]['q_option'].replace(/<\/?[^>]+(>|$)/g, ""));
			  }
			  else {
					 $("#result_answer_qt_false").modal({
					   //backdrop:'static'
				    });
					 $("#correct_ans_fs").empty();
				  $("#correct_ans_fs").append(String.fromCharCode(65+parseInt(data['correct']))+": "+data['options'][data['correct']]['q_option'].replace(/<\/?[^>]+(>|$)/g, ""));
	
			  }
		  },
		  error: function(data) {}
	});
}