$(document).on('click', '.assign-bt', function(){
    var qid = $(this).data('qid');
    var qass = $('.moremcq_'+qid+' .bgqtdiv')[0];
    var imgass = '';
    var qname = '';
	var vardissplay ="";
	var video="";
    if(qass != undefined){
        var a = $('.moremcq_'+qid+' .bgqtdiv')[0].children[0].children[0].style.backgroundImage;
		if(a!=""){
			 qname = qass.innerText;
			imgass = (a.split('("')[1]).split('")')[0];
			
		}
		else{
	         qname = $(".hiddenlqt").html();
			 a = $('.moremcq_'+qid+' .bgqtdiv')[0].children[1].children[0].style.backgroundImage;
			 imgass = (a.split('("')[1]).split('")')[0];
			 
		}
    }else{
        qass = $('.moremcq_'+qid+' .mcq_multimd')[0];
		qname = qass.innerHTML;
		if(qname.indexOf("latex.codecogs.com")==-1){
			qname = qass.innerText;
			
		}
		if(qass.children[0]!=undefined){
			if(qass.children[0].children[0]){
			
			if(qass.innerHTML.indexOf("<iframe")==-1){
				imgass = qass.children[0].children[0].src;	
				console.log(qass);
			}
			else{
				video = qass.innerHTML;
				imgass="";
				vardissplay = "none";
			}	
			} else{
				imgass="";
				vardissplay = "none";
				
			}
			if(imgass.indexOf("latex.codecogs.com")!=-1){
				imgass="";
				vardissplay = "none";
				
			}
		}
		else{ 
			imgass="";
			vardissplay = "none";
			
		}


    }
    $('#modalABT').remove();
    let modal = $('<div/>', {
        class: 'modal', 
        id: 'modalABT'
    }).append([
            $('<div/>',{ 
                class: "modal-dialog" 
            }).append([
                $('<div/>',{ 
                    class: "modal-content" 
                }).append([
                    $('<div/>', {
                        class: "modal-header",
                        style: 'border-bottom: 1px solid #bdbdbd'
                    }).append([
                        $('<button/>', {
                            type: 'button',
                            class: 'close',
                            'data-dismiss': 'modal',
                            text: 'x'
                        }),
                        $('<select/>', { 
                            class: 'form-control nav typeassign', 
                            style: 'width: auto'
                        }).append([
                            $('<option/>', {text: 'Giao bài cho cá nhân', value: 'private'}),
                            $('<option/>', {text: 'Giao bài cho nhóm', value: 'group'}),
                            $('<option/>', {text: 'Giao bài cho lớp', value: 'class'}),
                        ])
                    ]),
                    $('<div/>', {
                        class: 'body-ass-header'
                    }).append([
                        $('<span/>',{
                            text: 'Tới:',
                            class: 'asstitle'
                        }),
                        $('<select></select>', {
                            class: 'form-control assto',
                            name: 'uids[]',
                            multiple: 'multiple'
                        })
                    ]),
                    $('<div/>',{ 
                        class: "modal-body" 
                    }).append([
                        $('<div/>', {
                            class: 'mcq_multimd',
                            html: qname
                        }).append([
                            $('<div/>', {
                                class: 'imgqtt'
                            }).append([
                                $('<img/>', {
                                    class: 'img-responsive',
                                    src: imgass,
                                    width: '100%',
									style: "display: " +vardissplay
                                })
                            ])
                        ]),
                    ]),
                    $('<div/>', {
                        class: 'modal-footer'
                    }).append([
                        $('<button/>', {
                            class: 'btn btn-warning',
                            type: 'button',
                            'data-dismiss': 'modal',
                            text: 'Hủy'
                        }),
                        $('<button/>', {
                            class: 'btnass btn btn-success',
                            type: 'button',
                            text: 'Gửi',
                            disabled: ''
                        })
                    ])
                ]),
            ]),
        ]);
    $(document.body).append(modal);
	if(video){
		$(".imgqtt").parent().parent().append(video);
		$(".mcq_multimd").attr('style',"display:none");
	}
    modal.modal();
    select_data_render(qid);

    $(".btnass").click(function (){ 
        //console.log($(".assto").select2("data"));
        var z = $(".assto").select2("data");
        if(z.length > 0){
			uids="";
			for (var i = 0; i < z.length; i++) {
				if(uids==""){
					uids+=z[i].id;
				}
				else{
					uids+=","+z[i].id;
				}
			}

			var a = {qid: qid, uids:uids};
			$.ajax({
				type: "POST",
				data : a,
				url: base_url + "index.php/api/assign_question",
				success: function(data){
						modal.modal('hide');
						var message_fail = '';
						var message_success='';
						console.log(data);
						if(data.name_fail){
							message_fail = 'Bạn không thể giao thêm cho: '+ data.name_fail;
						}
						if(data.name_success){
						    message_success='\n \Bạn đã gửi thành công câu hỏi trắc nghiệm cho: '+data.name_success;
						}
						var sf = message_fail + message_success;
						alert(sf);
						if(data.success!=""){
							$.ajax({
								type: "POST",
								data : {type:"assign", uids: data.success, type_assign:"câu hỏi"},
								url: base_url + "index.php/sendemail",
								success: function(data){
									//console.log(data);
								},
								error:function(data){	
									console.log(data);							
								},
							});
						}
				   
				},
				error: function(error){
					console.log(error);
				}
			});
            
        }else{
            
        }
    });

    $(".assto").on("change", function (e){ 
        if($(this).select2("data").length > 0){
            $(".btnass").removeAttr('disabled');
        }else{
            $(".btnass").attr('disabled', 'disabled');
        } 
    });

    
    $('.typeassign').on('change', function(){
        if(this.value != "private"){
            $('.body-ass-header').empty();
            $('.body-ass-header').append([$('<div/>', {
                style: 'color: red; text-align: center;',
                text: 'Hiện tính năng này đang được cập nhật, vui lòng quay lại sau.'
            })]);
        }else{
            $('.body-ass-header').empty();
            $('.body-ass-header').append([
                $('<span/>',{
                    text: 'Tới:',
                    class: 'asstitle'
                }),
                $('<select></select>', {
                    class: 'form-control assto',
                    name: 'uids[]',
                    multiple: 'multiple'
                })
            ]);
            select_data_render(qid);
        }
    });
});

function select_data_render(qid){
    var formData = {qid:qid};
    var results = [];
    $.ajax({
        type: "POST",
        data : formData,
        url: base_url + "index.php/api/user_list",
        success: function(data){
            if(data.users.length > 0){
                for (var i = 0; i < data.users.length; i++) {

                    results.push({
                        id: data.users[i].uid,
                        text: data.users[i].first_name
                    });
                }
                $(".assto").select2({
                    placeholder: 'Nhập tên',
                    data: results,
                    createSearchChoice:function(term, data) { 
                        if ($(data).filter(function() {return this.text.localeCompare(term)===0;}).length===0) {
                            return {id:term, text:term};
                        } 
                    },
                });
            }
        },
        error: function(error){}
    });
}
/*(function(){
    
})();*/