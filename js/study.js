$(document).ready(function(){
   
	if(window.location.hash) {
		check_load_more=false;
	}
	else{
		check_load_more=true;
	}
	
	 
		  
	resize_opt1($("#qiq_0"));
	  
	 
	
	$('#carousel1').on('slid.bs.carousel', function (e) {
	     index= $('div.item.active').index();
		 
		 qid = $("#qiq_"+index).find(".ol_opt").attr('id').replace('ol_opt-','');
         if(qid){
			loadoption(qid, index, count_question);
         }
		 $(".carousel-Quizz>li").each(function(e){$(this).attr("class","")});
		 $("#car_index_qt2_"+index).attr("class","ftsz-25-fix");
		 // resize_opt1($("#qiq_"+index));
	});
	$("#welcome_modal").modal();
	$("#update_email_modal").modal();
	if(!$("#welcome_modal").length){
		$("#interest_modal").modal({
			backdrop:'static'
		});
	}
	else{
		$('#welcome_modal').on('hidden.bs.modal', function () {
			$("#interest_modal").modal({
				backdrop:'static'
			});	
		});
	}
	
	$('.modal').on('show.bs.modal', function () {
			check_load_more=false;
			$(".ul-mobile").attr("style", "display:none");
			
			 
			
		});
		
	
		
	$('.modal').on('hide.bs.modal', function () {
			check_load_more=true;
			$(".ul-mobile").attr("style", "");
		});
	
	
	
	
	$(".div_opt").each(function(){
		resize_opt(this);
	});
	
	$("#xctbt").on('click', function(e){
		$("#resinfo").attr("style","display:none");
		$("#rsct").attr("style","");
		$("#resultbyeach").show();
	})
	$(".backbtrs").on('click', function(e){
		$("#resinfo").attr("style","background-image:url('https://stemup.app/images/result_bg.jpg');background-size:cover;font-size:18px;padding:40px;color:#ffffff;min-height:540px;");
		$("#rsct").attr("style","margin-top:40px");
		$("#resultbyeach").hide();
	});
	if($(window).width()>767){
		$(".mcq_multimd2").attr("style", "font-size:17px;font-weight:700");
	}
	
	if($(window).width()<767){
		$(".mcq_multimd2").attr("style", "font-size:14px!important;font-weight:700");
	}
	
	

	$(".optvalmb").attr("onclick","check_answered(this)");

	
	$("#mcq_fun_main").on('change', function(){
		mfp=parseInt($(this).val());
		$(this).val(1-mfp);
	})
	
	$("#main_logorg").on('change', function(){
		mfp=parseInt($(this).val());
		$(this).val(1-mfp);
	})
	
	$(".mcq_multimd,.mcq_multimd2").find("h1,h2,h3,h4,h5,h6").each(function(){
         if(window.screen.width>767)
			$(this).attr ("style","font-size: 17px;font-weight: 600!important; ");
		  else
            $(this).attr ("style","font-size: 14px!important;font-weight: 600!important; ");			  
    });
	

	//load more
	var lastScrollTop = 0;
	check_load_more=true;
	$(window).scroll(function (event) { 
	   st = $(this).scrollTop();
	   if (st > lastScrollTop) {
			distance=$("footer").height()+1050;

			if($(window).width()<767){
				distance+=$("aside.rightbar").height()+1050;
			}
			if ($(window).scrollTop() >= $(document).height() -distance){
				
				if(check_load_more)
					
					if(id_mcq_fun!=""){
						  ar_fun=id_mcq_fun.split(",",5);
						  for(i=0; i<ar_fun.length; i++){
							  
							  id_mcq_fun=id_mcq_fun.replace(ar_fun[i]+",", "").replace(ar_fun[i],"");
						  }
						 
						  load_more_mcq_quiz_fun();
					 }
				
				
			}
	   }
	   lastScrollTop=st;
	})
});

function load_opt_main(event){
	$("#collapse_opt_box").show();
	$(event).remove();
	$("#cancel_btn_crmain").parent().prepend('<button type="submit" class="btn btn-primary" id="sqmain">Lưu</button>');
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
function load_more_mcq_quiz_fun(){

	  check_load_more=false;
	  ar_str="";
	  ar_fun=[];
	  if(id_mcq_fun!=""){
		  ar_fun=id_mcq_fun.split(",",5);
		  for(i=0; i<ar_fun.length; i++){
			  id_mcq_fun=id_mcq_fun.replace(ar_fun[i]+",", "").replace(ar_fun[i],"");
			  if(i>0)
				ar_str+=","+ar_fun[i];
			  else
				ar_str+= ar_fun[i];  
		  }
		   if(id_quiz_fun!=""){
			   ar_quiz_fun=id_quiz_fun.split(",",1);
			   dt=JSON.stringify({'qids':ar_str,'quid':ar_quiz_fun[0] });
			   id_quiz_fun=id_quiz_fun.replace(ar_quiz_fun[0]+",", "").replace(ar_quiz_fun[0],"");
		   }
		   else
			    dt=JSON.stringify({'qids':ar_str});
		   
		    $(".show_more_mcq").parent().append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');
		   

		  
		   $.ajax({
		  type: 'POST',
		  url: site_url+"/qbank/get_question_block/",
		  data: dt,
		  contentType: 'application/json',
		  success: function(data) {
			  //console.log(data);
			   $("#circularG").remove();
			  $(".show_more_mcq").parent().append(data.html);

			  
			
		for(idx=0 ; idx<ar_fun.length;idx++){
				$(".moremcq_"+ar_fun[idx]).find(".div_opt").each(function(){
					resize_opt(this);
				});
			}
			$('.modal').on('show.bs.modal', function () {
			check_load_more=false;
			$(".ul-mobile").attr("style", "display:none");
		});
		
		$('.modal').on('hide.bs.modal', function () {
				check_load_more=true;
				$(".ul-mobile").attr("style", "");
			});
	
	   $(".optvalmb").attr("onclick","check_answered(this)");
	  $(".mcq_multimd").find("h1,h2,h3,h4,h5,h6").each(function(){
			 if($(window).width()>767)
				$(this).attr ("style","font-size: 17px;font-weight: 600!important; ");
			  else
				$(this).attr ("style","font-size: 14px!important;font-weight: 600!important; ");			  
				});
				
			
			check_load_more=true;
		  },
		  error: function(data) {
			  console.log(data);
			  
		  }
	});
	
	  }
	  
     
	
	
}

function see_more_descr(event){
	$(event).parent().find(".three_dotcomma").attr("style","display:none;");
	$(event).parent().find(".more_descr").attr("style","");
	$(event).attr("style","display:none;");
}


function resize_opt(event){
	if($(window).width()>767){
		
		max_size=0; 
		$(event).find(".optvalmb").each(function() {
			val=$(this).html();
			if(val.indexOf("<img")!=-1) max_size=60;
			c_size=$(this)[0].scrollHeight;
			if(c_size>max_size){
				max_size=c_size;
			}
		})
		$(event).find(".optvalmb").each(function() {
            
			$(this).height(max_size+5);
		});
		$(event).find(".optradio_main").each(function() {
			$(this).attr("style","transform:translate(-20px,"+((max_size-10)/2)+"px); z-index:7;" );
		});
		
		$(event).find("tr").each(function() {
			$(this).attr("valign", "center");
			$(this).attr("style", "height:"+(max_size-10)+"px");
		});
		
		
	}
	else{
		
		$(event).find(".optvalmb").each(function() {
			val=$(this).html();
			if(val.indexOf("<img")!=-1)
				$(this).height(60);
			else
				$(this).height($(this)[0].scrollHeight );
		});
		
		$(event).find(".optradio_main").each(function() {
			
			$(this).attr("style","transform:translate(20px,"+(($(this).next().height()-36)/2)+"px); z-index:7; margin-top:10px!important" );
		});

	}
}
function resize_opt1(event){
	if($(window).width()>767){
		
		max_size=0; 
		$(event).find(".optvalmb").each(function() {
			val=$(this).html();
			if(val.indexOf("<img")!=-1) max_size=60;
			c_size=$(this)[0].scrollHeight-10;

			if(c_size>max_size){
				max_size=c_size;
			}
		})

		$(event).find(".optvalmb").each(function() {
			$(this).height(max_size+5);
		});
		$(event).find(".optradio_main").each(function() {
			$(this).attr("style","transform:translate(-20px,"+((max_size-10)/2)+"px); z-index:7;" );
		});
		
		$(event).find("tr").each(function() {
			$(this).attr("valign", "center");
			$(this).attr("style", "height:"+(max_size-10)+"px");
		});
		
		
	}
	else{
		$(event).find(".optvalmb").each(function() {
			val=$(this).html();
			if(val.indexOf("<img")!=-1)
				$(this).height(60);
			else
				$(this).height($(this)[0].scrollHeight );
		});
		
		$(event).find(".optradio_main").each(function() {
			
			$(this).attr("style","transform:translate(20px,"+(($(this).next().height()-30)/2)+"px); z-index:7; margin-top:10px!important" );
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


function show_question(qid){
	$("#lqtmodal").modal();
	var puq=$(".moremcq_"+qid).html().replace("bgqtdiv","bgqtdiv1");
	
	$("#lqtmodal-content").empty();
	$("#lqtmodal-content").append('<div class="box-bor1" style="inline-block" >'+puq+'</div>');
	var qt = $(".hiddenlqt").html();
	$(".bgqtdiv1").parent().append(qt);
	
	$("#lqtmodal").find(".imgwlogo").remove();
    $(".bgqtdiv1").remove();
	$("#lqtmodal").find(".optradio_main").each(function(){
		$(this).attr("onclick"," answer_qt2(this)");
	});
	
}

function answer_qt2(event){
	qid = $(event).attr("name").replace("opt_main_","");
		ans = $(event).val();
		/*if($('#carousel1').length){
			$('#carousel1').carousel("next");
			indexqt=$(event).attr("id").replace("answer_value","").split("-")[0];
			$('#carousel1').carousel("next");
			$("#car_index_qt_"+indexqt).attr("style","background-color:green; color:white");
			$("#car_index_qt2_"+indexqt).attr("style","background-color:green; color:white");
		}*/
		 $(".bd-example-modal-lg").modal();
		$.ajax({
		  type: 'POST',
		  url: site_url+"/qbank/check_answered/"+qid,
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {
			   $(".bd-example-modal-lg").modal('hide');
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
}

function check_answered(event){
	   	qid = $(event).parent().prev().attr("name").replace("opt_main_","");
		ans = $(event).parent().prev().val();
	    $(event).parent().parent().find(".optradio_main").attr("checked", true);
		 $(".bd-example-modal-lg").modal();

		$.ajax({
		  type: 'POST',
		  url: site_url+"/qbank/check_answered/"+qid,
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {
			   $(".bd-example-modal-lg").modal('hide');
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
}


