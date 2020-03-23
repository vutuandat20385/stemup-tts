$(document).ready(function(){
	/*unseen_message();
	setInterval(function(){ 
		unseen_message();
	}, 20000);


	$('.mdropdown').on('click', function(){
		$('.mcount').html('');
		unseen_message('yes');
	});*/


	unseen_notification();
	setInterval(function(){ 
		unseen_notification();
	}, 20000);
    
	if(su==6){
		moderate_count();
		setInterval(function(){ 
			moderate_count();
		}, 100000);
    }

	$('.ndropdown').on('click', function(){
		$('.ncount').html('');
		unseen_notification('yes');
	});


	/*load_activities();
	setInterval(function(){ 
		load_activities();
	}, 60000);*/
});

function unseen_message(view = ''){
	var formData = {view:view};
	
	$.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/message/message_for_user/" + view,
		success: function(data){
			console.log(data);
			if(data.nuser.length > 0){
				$('.message__list').empty();
				for (var i = 0; i < data.nuser.length; i++) {
					var html = '<div class="notification__item">';
					html += '<a class="notification__url">';
					if(data.nuser[i].photo == null){
						html += '<img class="img-circle MR5" src="'+base_url + 'upload/avatar/default.png" width="64"/>';
					}else{
						html += '<img class="img-circle MR5" src="'+data.nuser[i].photo+'" width="64" height="64"/>';
					}
                    html += '<div class="fx">';
                    html += '<p class="notification__message"><span style="font-weight: bold;">'+data.nuser[i].first_name+'</span>'+data.nuser[i].message+'</p>';
                    var datestr = data.nuser[i].created_at;
					var date = new Date(datestr.replace(' ', 'T'));
                    html += '<p class="notification__time">'+timeSince(date)+'</p>';
                    html += '</div>';
                    html += '</a>';
                    if(data.nuser[i].seen == "1"){
                    	html += '<span class="notification__status notification__status--read"></span>';
                    }else{
                    	html += '<span class="notification__status"></span>';
                    }
					html += '</div>';
					$('.message__list').prepend(html);
				}
			}else{
				$('.message__list').empty();
				$('.message__list').append('<p>Bạn không có tin nhắn nào.</p>');
			}
			if(data.ncount[0].num > 0){
				$('.mcount').html(data.ncount[0].num);
			}
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}	
	});
}
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
function unseen_notification(view = ''){
	var formData = {view:view};
	
	$.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/notification/notification_for_user/" + view,
		success: function(data){
			//console.log(data);
			if(data.nuser.length > 0){
				var notifications = data.nuser.reverse();
				$('.notification__list').empty();
				for (var i = 0; i < notifications.length; i++) {
					var day = new Date(notifications[i]['createdate']).getTime();
					var html = '<div class="notification__item">';
					if(!notifications[i].click)
						html += '<a class="notification__url  pointer">';
				    else
						html += '<a class="notification__url pointer" onclick="'+notifications[i].click+'">';
					if(notifications[i].photo == null){
						html += '<img class="img-circle MR5" src="'+base_url + 'upload/avatar/default.png" width="64"/>';
					}else{
						html += '<img class="img-circle MR5" src="'+notifications[i].photo+'" width="64" height="64"/>';
					}
                    html += '<div class="fx">';
                    html += '<p class="notification__message"><span style="font-weight: bold;">'+notifications[i].username+'</span>'+notifications[i].content+'</p>';
                //    var datestr = notifications[i].createdate;
				//	var date = new Date(datestr.replace(' ', 'T'));
                    html += '<p class="notification__time">'+timeDifference(Date.now(),day)+'</p>';
                    html += '</div>';
                    html += '</a>';
                    if(notifications[i].status == "1"){
                    	html += '<span class="notification__status notification__status--read"></span>';
                    }else{
                    	html += '<span class="notification__status"></span>';
                    }
					html += '</div>';
					$('.notification__list').prepend(html);
				}
			}else{
				$('.notification__list').empty();
				$('.notification__list').append('<p style="margin-left:13px">Bạn không có thông báo nào.</p>');
			}
			if(data.ncount[0].num > 0){
				$('.ncount').html(data.ncount[0].num);
			}
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}	
	});
}

function timeSince(date) {

  var seconds = Math.floor((new Date() - date) / 1000);

  var interval = Math.floor(seconds / 31536000);

  if (interval > 1) {
    return interval + " năm trước";
  }
  interval = Math.floor(seconds / 2592000);
  if (interval > 1) {
    return interval + " tháng trước";
  }
  interval = Math.floor(seconds / 86400);
  if (interval > 1) {
    return interval + " ngày trước";
  }
  interval = Math.floor(seconds / 3600);
  if (interval > 1) {
    return interval + " giờ trước";
  }
  interval = Math.floor(seconds / 60);
  if (interval > 1) {
    return interval + " phút trước";
  }
  return "vừa xong";
}

function load_activities(){
	var formData = {};
	
	$.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/home_user/activities/",
		success: function(data){
			if(data.notify.length > 0){
				$('#activities').empty();
				for (var i = 0; i < data.notify.length; i++) {
					var html = '<div class="media-object-default"><div class="media"><div class="media-left">';
					if(data.notify[i].photo == null){
						html += '<a href="#"><img width="40" class="media-object" src="'+base_url + 'upload/avatar/default.png" alt="placeholder image"></a></div>';
					}else{
						html += '<a href="#"><img width="40" class="media-object" src="'+data.notify[i].photo+'" alt="placeholder image"></a></div>';
					}
					html += '<div class="media-body">';//<h4 class="media-heading"><a href="">'+data.notify[i].username+'</a></h4>';
					html += '<span class="text-small">'+data.notify[i].content+'</span></div></div>';
					var datestr = data.notify[i].createdate;
					var date = new Date(datestr.replace(' ', 'T'));
					var dateshow = date.getDate()+'-'+(date.getMonth() + 1)+'-'+date.getFullYear()+' '+date.getHours()+':'+date.getMinutes();
					html += '<div class="pull-right" style="font-size: 10px;">'+dateshow+'</div></div><hr>';
					$('#activities').append(html);
				}
			}
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}	
	});
}

function question_ass(qid, assid){
	let modal = create_modal_ass(qid);

	$.ajax({
    	type: "POST",
		data : {},
		url: base_url + "index.php/api/check_answer/"+qid+"/"+assid,
		success: function(data){
			//console.log(data);
			if(data.answer)	
			{
				
				$(".modal-content>div>button[class='btnanwser btn btn-success']").attr('style',"display:none");
				$(".modal-content>div>button[class='btnclose btn btn-warning']").attr('style',"display:none");
				$(".option-main>label>input[data-optid="+data.answer+"]").next().addClass('option-fail');
				$(".option-main>label>input[data-optid="+data.answer+"]").prop("checked", true);
				$(".option-main>label>.opt-ass[name='option-assign'][value='1']").next().addClass('option-true');
				$(".option-main>label>.opt-ass").prop("disabled", true);
				
			}
			
			else
			{
				$(".modal-content>div>button[class='btnclose btn btn-info']").attr('style',"display:none");
				$(".btnanwser").on('click', function(){
					var answer = '';
					var score = '';
					$(".modal-content>div>button[class='btnanwser btn btn-success']").attr('style',"display:none");
				
				$('input[name="option-assign"]').each(function(){
					if(this.checked){
					answer = this.dataset.optid;
					score = this.value;
						if(score == '1')
						{
							$('.ass-msg')[0].innerText = 'Bạn đã trả lời đúng.';
							$('.ass-msg').addClass('text-success');
							$('.ass-msg').removeClass('text-danger');
							$(this.nextElementSibling).addClass('option-true');
							$('.btnclose')[0].innerText = 'Đóng';
						}
						else
						{
							$('.ass-msg')[0].innerText = 'Bạn đã trả lời sai.';
							$('.ass-msg').addClass('text-danger');
							$('.ass-msg').removeClass('text-success');
							$(this.nextElementSibling).addClass('option-fail');
						}
					}
					else
					{
						$(this.nextElementSibling).removeClass('option-true');
						$(this.nextElementSibling).removeClass('option-fail');
					}
				$('.btnclose')[0].innerText = 'Đóng';	
				$(".option-main>label>input[value='1']").next().addClass('option-true');
				$(".option-main>label>.opt-ass").prop("disabled", true);
				
				});

				var formData = {qid: qid, assid: assid, answer: answer};
				$.ajax({
					type: "POST",
					data : formData,
					url: base_url + "index.php/api/answer_ass",
					success: function(data){},
					error: function(err){}
					});
		
				});
			
			}
		},
		error: function(err){}
    });
}


function answer_ass(qid, assid, answer){
	
	//let modal = create_modal_ass(qid);
	$('#modalQASS').remove();
    let modal = $('<div/>', {
        class: 'modal', 
        id: 'modalQASS'
    }).append([
        $('<div/>',{ 
            class: "modal-dialog" 
        }).append([
            $('<div/>',{ 
                class: "modal-content" 
            }).append([
                $('<div/>', {
                    class: "modal-header"
                }).append([
                    $('<button/>', {
                        type: 'button',
                        class: 'close',
                        'data-dismiss': 'modal',
                        text: 'x'
                    })
                ]),
                $('<div/>',{ 
                    class: "modal-body",
                    style: 'padding-top: 0px;' 
                }).append([
                	
                    $('<div/>', {
                        class: '',
                        style: '350px'
                    }).append([
                        $('<div/>', {
                            class: 'imgqtt'
                        }).append([
                            $('<img/>', {
                                class: 'img-responsive  img-qass',
                                src: '',
                                width: '100%'
                            })
                        ])
                    ]),
                    $('<h4/>', {class: 'qass-title', html:''}),
					
					$('<div/>', {
                    	class: 'option-main'
                    }),
                    $('<div/>', {
                    	class: 'ass-msg'
                    })
                ]),
                $('<div/>', {
                    class: 'modal-footer'
                }).append([
                	$('<button/>', {
                        class: 'btnclose btn btn-warning',
                        type: 'button',
                        'data-dismiss': 'modal',
                        text: 'Để sau'
                    }),
                    $('<button/>', {
                        class: 'btnanwser btn btn-success',
                        type: 'button',
                        text: 'Trả lời',
                       	disabled: ''
                    }),
					$('<button/>', {
                        class: 'btnclose btn btn-info',
                        type: 'button',
                        text: 'Thoát',
                       	'data-dismiss': 'modal'
                    })
                       	
                ])
            ]),
        ]),
    ]);
    $(document.body).append(modal);
	// teacher,parent
    var formData = {qid:qid};
    $.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/api/get_question_ass",
		success: function(data){
			
			if(data.qass != undefined){
				//var ques = $(data.qass.question);

				
				
				if(data.qass.question.indexOf("<iframe")==-1 && data.qass.question.indexOf("latex.codecogs.com")==-1){
					
					$('.qass-title')[0].innerText = data.qass.question.replace(/<(?:.|\n)*?>/gm, '');;
					
					if(data.qass.img!=""){
						$('.img-qass')[0].src = data.qass.img;	
					}
					else{
						$('.img-qass').attr('style',"display:none");	
					}
				}
				else{
					$('.img-qass').attr('style',"display:none");
					$('.qass-title')[0].innerHTML= data.qass.question;
				}

				var options = data.qass.options;

				for (var i = options.length-1; i >=0; i--) {
					if(options[i].q_option.trim() != ''){
						var optval = '';
						//if($(options[i].q_option)[0] == undefined){
							optval = options[i].q_option.replace("<p>","").replace("</p>","");
							
						//}else{
						//	optval = $(options[i].q_option)[0].innerText;
							
						//}
						var html = '<label>';
						html += '<input class="opt-ass opt-ass-'+i+'" data-optid="'+options[i].oid+'" name="option-assign" value="'+options[i].score+'" type="radio" disabled ';
						if(options[i].oid == answer){
							html +=" checked ";
						}
						html+='>';
						html += '<div class="form-control opt-ass-val opt-ass-val-'+i+' ';
						if(options[i].oid == answer){
							html +=" option-fail ";
						}
						if(options[i].score ==1){
							html +=" option-true ";
						}
						html+='">';
						html += '<span style="margin-left:0px" type="text" class="opt-ass-span" name="option[]" readonly="">'; 	
						html +='<div style="padding-left:25px">'+optval+'</div></span></div></label>';
						$('.option-main').prepend(html);
					}
						
				}
				modal.modal();
				
				$('input[name="option-assign"]').on('click', function(){
			    	$('.btnanwser').removeAttr('disabled');
			    });
			}
			for(i=0;i<4;i++){
				var heg1 = $('.opt-ass-val-'+i).height();
					console.log(heg1);
				$('.opt-ass-'+i).attr("style","transform:translate(0px,"+(heg1/2-13)+"px);" );
			}	
			
		},
		error: function(err){}
    });

	$('.btnanwser').remove();
	$('.btnclose')[0].innerText = 'Đóng';
	$(".modal-content>div>button[class='btnclose btn btn-info']").attr('style',"display:none");
}

function create_modal_ass(qid){
	$('#modalQASS').remove();
    let modal = $('<div/>', {
        class: 'modal', 
        id: 'modalQASS'
    }).append([
        $('<div/>',{ 
            class: "modal-dialog" 
        }).append([
            $('<div/>',{ 
                class: "modal-content" 
            }).append([
                $('<div/>', {
                    class: "modal-header"
                }).append([
                    $('<button/>', {
                        type: 'button',
                        class: 'close',
                        'data-dismiss': 'modal',
                        text: 'x'
                    })
                ]),
                $('<div/>',{ 
                    class: "modal-body",
                    style: 'padding-top: 0px;' 
                }).append([
                	
                    $('<div/>', {
                        class: '',
                        style: '350px'
                    }).append([
                        $('<div/>', {
                            class: 'imgqtt'
                        }).append([
                            $('<img/>', {
                                class: 'img-responsive  img-qass',
                                src: '',
                                width: '100%'
                            })
                        ])
                    ]),
                    $('<h4/>', {class: 'qass-title', html:''}),
					
					$('<div/>', {
                    	class: 'option-main'
                    }),
                    $('<div/>', {
                    	class: 'ass-msg'
                    })
                ]),
                $('<div/>', {
                    class: 'modal-footer'
                }).append([
                	$('<button/>', {
                        class: 'btnclose btn btn-warning',
                        type: 'button',
                        'data-dismiss': 'modal',
                        text: 'Để sau'
                    }),
                    $('<button/>', {
                        class: 'btnanwser btn btn-success',
                        type: 'button',
                        text: 'Trả lời',
                       	disabled: ''
                    }),
					$('<button/>', {
                        class: 'btnclose btn btn-info',
                        type: 'button',
                        text: 'Thoát',
                       	'data-dismiss': 'modal'
                    })
                       	
                ])
            ]),
        ]),
    ]);
	
	//student
    $(document.body).append(modal);
    var formData = {qid:qid};
	
    $.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/api/get_question_ass",
		success: function(data){
			//console.log(data);
			if(data.qass != undefined){
				//var ques = $(data.qass.question);
				
				
				if(data.qass.question.indexOf("<iframe")==-1 && data.qass.question.indexOf("latex.codecogs.com")==-1){
					$('.qass-title')[0].innerText = data.qass.question.replace(/<(?:.|\n)*?>/gm, '');;
				
					if(data.qass.img){
						$('.img-qass')[0].src = data.qass.img;
					}
					else{
					
						$('.img-qass').attr('style',"display:none");
					}
				}
				else{
					$('.img-qass').remove();
					$('.qass-title')[0].innerHTML= data.qass.question;
				}
				var options = data.qass.options;
                // var optval = '';
				for (var i = options.length-1; i >=0; i--) {
					if(options[i].q_option.trim() != ''){
						var optval = '';
						//if($(options[i].q_option)[0] == undefined){
						optval = options[i].q_option.replace("<p>","").replace("</p>","");
						
						//optval+="fhjxtjg gggggggggggggggggggg ggggggggggggggggggggggggggggggg ggnfhcjsnckjskanvk ksajvkjsdkahvksakvhj"	;
						//}else{
						//	optval = $(options[i].q_option)[0].innerText;
							
						//}
						var html = '<label>';
						html += '<input class="opt-ass opt-ass-'+i+'" data-optid="'+options[i].oid+'" name="option-assign" value="'+options[i].score+'" type="radio">';
						html += '<div class="form-control opt-ass-val opt-ass-val-'+i+'">';
						html += '<span type="text" class="opt-ass-span" name="option[]" readonly="">'; 	
						html += '<div style="padding-left:25px">'+optval+'</div></span></div></label>';
						$('.option-main').prepend(html);
						
					}
				}
				modal.modal();
				$('input[name="option-assign"]').on('click', function(){
			    	$('.btnanwser').removeAttr('disabled');
			    });
			}
				for(i=0;i<4;i++){
				var heg1 = $('.opt-ass-val-'+i).height();
					console.log(heg1);
				$('.opt-ass-'+i).attr("style","transform:translate(0px,"+(heg1/2-13)+"px);" );
				}
		},
		error: function(err){}
    });

    return modal;
}


function moderate_count(){
	$(".modcount").empty();
	$.ajax({
	 	type: "POST",
		data : {},
		url: base_url + "index.php/api/number_mdr",
		success: function(data){
			$(".modcount").append(data.num_question+data.num_quiz);	
			message="Bạn có "+data.num_question+" câu hỏi và "+data.num_quiz+" bài kiểm tra cần kiểm duyệt!";
			$(".modcount").parent().attr("title",message);
		},
		error:function(data){}
	});
	
}
