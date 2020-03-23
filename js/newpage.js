$(document).ready(function(){
	//$("main").prepend('<div class="col-md-12"><div class="col-md-10 col-md-offset-1" style="margin-bottom:10px"><marquee> Hệ thống đang trong giai đoạn thử nghiệm Open Beta. </marquee></div></div>');
	/*$.ajax({
		  type: 'POST',
		  url: site_url+"/event_racing/summary/",
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {			 
		  },
		  error: function(data) {			  
		  }
	 });*/
	resize_opt1($("#qiq_0"));
	if($(window).width()>767){
		if($("#mainbar").height()>$(".div-sticky-quiz").height())
			$(".div-sticky-quiz").attr("style","height:"+$("#mainbar").height()+"px;");  
		$(".div-leftbar").attr("style","margin-top:-20px;height:"+($(".mainbar").height()+30)+"px;");  
		$(".div-leftbar-home").attr("style","margin-top:-20px;height:"+($("#mainbar").height()+70)+"px;");
	}
	
	
	
    $('#carousel1').on('slid.bs.carousel', function (e) {
	     index= $('div.item.active').index();
		 qid = $("#qiq_"+index).find(".ol_opt").attr('id').replace('ol_opt-','');
         if(qid){
			loadoption(qid, index, count_question);
         }
		 $(".carousel-Quizz>li").each(function(e){$(this).attr("class","")});
		 $("#car_index_qt2_"+index).attr("class","ftsz-25-fix");
		 
	});
	$('.modal').on('show.bs.modal', function () {
			check_load_more=false;
			$(".ul-mobile").attr("style", "display:none");
					
		});		
	$('.modal').on('hide.bs.modal', function () {
			check_load_more=true;
			$(".ul-mobile").attr("style", "");
		});
		
	if(window.location.hash) {
		check_load_more=false;
	}
	else{
		check_load_more=true;
	}
   
	$(".searchbt").on('click', function(e){
		if($(window).width()>767){
			s =$("#inpsearch_top_dt").val();
		}
		else{
			
			s =$("#inpsearch_top").val();
		}
		while(s.indexOf("+")>-1)
			s =s.replace("+","%2B");
		while(s.indexOf(" ")>-1)
			s =s.replace(" ","+");
		new_url=encodeURI(updateQueryStringParameter(site_url+'/home','search',s));
		window.location.assign(new_url);
		
		
	});
	
	
	$(".div_opt").each(function(){
		resize_opt(this);
	});
	


	//load more
	var lastScrollTop = 0;
	check_load_more=true;
	if($(".show_more_mcq").length){
		$(window).scroll(function (event) { 
		   st = $(this).scrollTop();
		   
		   if (st > lastScrollTop) {
				distance=$("footer").height()+50;
				if($(window).width()<767){
					distance+=$("aside.rightbar").height()+20;
				}
				if ($(window).scrollTop() >= $(document).height() - $(window).height() -distance){
				
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
	}
});


function load_more_mcq_quiz_fun(){
	  console.log("WTF");
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
		  url: site_url+"/api/get_question_block/",
		  data: dt,
		  contentType: 'application/json',
		  success: function(data) {
			  //console.log(data);
			 $("#circularG").remove();
			  $(".show_more_mcq").parent().append(data.html);
			   if($("#mainbar").height()>$(".div-sticky-quiz").height())
				$(".div-sticky-quiz").attr("style","height:"+$("#mainbar").height()+"px;"); 
			for(idx=0 ; idx<ar_fun.length;idx++){
				$(".moremcq_"+ar_fun[idx]).find(".div_opt").each(function(){
					resize_opt(this);
				});
			}
			$(".div-leftbar-home").attr("style","margin-top:-20px;height:"+($("#mainbar").height()+130)+"px;");
			check_load_more=true;
		  },
		  error: function(data) {
			  console.log(data);
			  
		  }
	});
	  }
	  
     
	
	
}




function resize_opt(event){
	if($(window).width()>767){
		
		max_size=0; 
		$(event).find(".optvalmb").each(function() {
			val=$(this).html();
			if(val.indexOf("<img")!=-1) max_size=70;
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
			if(val.indexOf("<img")!=-1) $(this).height(70);
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
			if(val.indexOf("<img")!=-1) max_size=70;
			c_size=$(this)[0].scrollHeight-5;
			
			if(c_size>max_size){
				max_size=c_size;
			}
		})
		$(event).find(".optvalmb").each(function() {
			$(this).height(max_size);
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
			if(val.indexOf("<img")!=-1) $(this).height(70);
			else
				
				$(this).height($(this)[0].scrollHeight-7 );
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

function search_question(event,e){
	 if(e.keyCode=='13'){
     	s= $(event).val();
		while(s.indexOf("+")>-1)
			s =s.replace("+","%2B");
		while(s.indexOf(" ")>-1)
			s =s.replace(" ","+");
		new_url=encodeURI(updateQueryStringParameter(site_url+'/home','search',s));
		window.location.assign(new_url);
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
function popup_require_login1(quid){
	
  $("#popup_require_login").modal();
  $(".smlg").attr("onclick","popup_login1("+quid+")");
  $(".smsn").attr("onclick","popup_signup1("+quid+")");

}
function popup_require_login2(qid){
	
  $("#popup_require_login").modal();
  $(".smlg").attr("onclick","popup_login2("+qid+")");
  $(".smsn").attr("onclick","popup_signup2("+qid+")");

}

function popup_require_login3(qid,opt_choice ){
	
  $("#popup_require_login").modal();
  $(".smlg").attr("onclick","popup_login3("+qid+","+opt_choice+")");
  $(".smsn").attr("onclick","popup_signup3("+qid+","+opt_choice+")");

}
function popup_require_login4(quid){	
  $("#popup_require_login").modal();
  $(".smlg").attr("onclick","popup_login4("+quid+")");
  $(".smsn").attr("onclick","popup_signup4("+quid+")");

}
function login(){
	
  $("#loginmodal").modal();

}

function filter_question_categ(event){
	val = $(event).val();
	str=window.location.href.split("?");
	new_url = window.location.href.replace(str[0],site_url+'/home/question_list');
	new_url=updateQueryStringParameter(new_url,'cid',val);
    window.location.assign(new_url);

}
function filter_quiz_categ(event){
	val = $(event).val();
	str=window.location.href.split("?");
	new_url = window.location.href.replace(str[0],site_url+'/home/quiz_list');
	new_url=updateQueryStringParameter(new_url,'cid',val);
    window.location.assign(new_url);

}
function filter_question_level(event){
	val = $(event).val();	
	str=window.location.href.split("?");
	new_url = window.location.href.replace(str[0],site_url+'/home/question_list');
	new_url=updateQueryStringParameter(new_url,'lid',val);
    window.location.assign(new_url);
}
	
function filter_quiz_level(event){
	val = $(event).val();	
	str=window.location.href.split("?");
	new_url = window.location.href.replace(str[0],site_url+'/home/quiz_list');
	new_url=updateQueryStringParameter(new_url,'lid',val);
    window.location.assign(new_url);
}
function filter_question_search(event){
	val = $(event).val();	
	while(val.indexOf("+")>-1)
			val =val.replace("+","%2B");
		while(val.indexOf(" ")>-1)
			val =val.replace(" ","+");
	new_url=encodeURI(updateQueryStringParameter(window.location.href,'search',val));
	str=window.location.href.split("?");
	new_url = window.location.href.replace(str[0],site_url+'/home/question_list');
	new_url=updateQueryStringParameter(new_url,'search',val);
    window.location.assign(new_url);
}

function filter_quiz_search(event){
	val = $(event).val();	
	while(val.indexOf("+")>-1)
			val =val.replace("+","%2B");
		while(val.indexOf(" ")>-1)
			val =val.replace(" ","+");
	new_url=encodeURI(updateQueryStringParameter(window.location.href,'search',val));
	str=window.location.href.split("?");
	new_url = window.location.href.replace(str[0],site_url+'/home/quiz_list');
	new_url=updateQueryStringParameter(new_url,'search',val);
    window.location.assign(new_url);
}

function sort_question(event){
	val = $(event).val();	
	str=window.location.href.split("?");
	new_url = window.location.href.replace(str[0],site_url+'/home/question_list');
	new_url=updateQueryStringParameter(new_url,'sortby',val);
    window.location.assign(new_url);
}

function sort_quiz(event){
	val = $(event).val();	
	str=window.location.href.split("?");
	new_url = window.location.href.replace(str[0],site_url+'/home/quiz_list');
	new_url=updateQueryStringParameter(new_url,'sortby',val);
    window.location.assign(new_url);
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
function count_share2(quid){
	$.ajax({
		  type: 'POST',
		  url: site_url+"/api/count_share2/",
		  data: JSON.stringify({'quid':quid }),
		  contentType: 'application/json',
		  success: function(data) {
		  },
		  error: function(data) {
			
			  
		  }
	 });
}
function popup_login(){
$("#loginmodal2").modal({});

}

function popup_login1(quid){
$("#loginmodal2").modal({});
$("#model").val("quiz")
$("#id_login").val(quid);
$(".fb-login").attr("href",site_url+"/hauth/login/Facebook/quiz/"+quid);
$(".gp-login").attr("href",site_url+"/hauth/login/Google/quiz/"+quid);
}

function popup_login2(qid){
$("#loginmodal2").modal({});
$("#model").val("question")
$("#id_login").val(qid);
$(".fb-login").attr("href",site_url+"/hauth/login/Facebook/question/"+qid);
$(".gp-login").attr("href",site_url+"/hauth/login/Google/question/"+qid);
}

function popup_login3(qid, opt_choice){
$("#loginmodal2").modal({});
$("#model").val("question")
$("#id_login").val(qid);
$("#opt_choice").val(opt_choice);
$(".fb-login").attr("href",site_url+"/hauth/login/Facebook/question/"+qid+"/"+opt_choice);
$(".gp-login").attr("href",site_url+"/hauth/login/Google/question/"+qid+"/"+opt_choice);
}
function popup_login4(quid){
$("#loginmodal2").modal({});
$("#model").val("quiz1")
$("#id_login").val(quid);
$(".fb-login").attr("href",site_url+"/hauth/login/Facebook/quiz1/"+quid);
$(".gp-login").attr("href",site_url+"/hauth/login/Google/quiz1/"+quid);
}

function popup_signup1(quid){
$("#signupModal").modal({});
$("#model_sn").val("quiz")
$("#id_sn").val(quid);
}

function popup_signup2(qid){
$("#signupModal").modal({});
$("#model_sn").val("question")
$("#id_sn").val(qid);
}

function popup_signup3(qid, opt_choice){
$("#signupModal").modal({});
$("#model_sn").val("question")
$("#id_sn").val(qid);
$("#opt_choice_sn").val(opt_choice);
}

function popup_signup4(quid){
	$("#signupModal").modal({});
	$("#model_sn").val("quiz1")
	$("#id_sn").val(quid);
}

function show_question_none_login(qid){
	$("#lqtmodal").modal();
	var puq=$(".moremcq_"+qid).html().replace("bgqtdiv","bgqtdiv1");
	
	$("#lqtmodal-content").empty();
	$("#lqtmodal-content").append('<div class="box-bor1" style="inline-block" >'+puq+'</div>');
	var qt = $(".hiddenlqt").html();
	$(".bgqtdiv1").parent().append(qt);
	
	$("#lqtmodal").find(".imgwlogo").remove();
    $(".bgqtdiv1").remove();
	$("#lqtmodal").find(".optradio_main").each(function(){
		//$(this).attr("onclick"," answer_qt2(this)");
	});
	
}