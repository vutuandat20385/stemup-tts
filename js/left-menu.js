
$(document).on('hidden.bs.modal', '.modal', function () {
    if ($('body').find('.modal.show').length > 0) {
        $('body').addClass('modal-open');
    }
});
$(document).ready(function(){
   
  
  $(".mbqmn").on('click',function(e){
	   $(".ul-mobile.list-unstyled").attr('style','display:none');
	  $("#clmncl").collapse('hide');
	  $("#grmncl").collapse('hide');
	  $("#tnmncl").collapse('show');
	 
  });
  $(".mbclmn").on('click',function(e){
	  $(".ul-mobile.list-unstyled").attr('style','display:none');
	  $("#clmncl").collapse('show');
	  $("#grmncl").collapse('hide');
	  $("#tnmncl").collapse('hide');
	 
  });
  if(su==4){
	  $(".mbgrmn1").on('click',function(e){
		 $(".ul-mobile.list-unstyled").attr('style','display:none');
		  $("#clmncl").collapse('hide');
		  $("#grmncl1").collapse('show');
		  $("#tnmncl").collapse('hide');
		  $("#grmncl").collapse('hide');
	  });
  }
  $(".mbgrmn").on('click',function(e){
	 $(".ul-mobile.list-unstyled").attr('style','display:none');
	  $("#clmncl").collapse('hide');
	  $("#grmncl").collapse('show');
	  $("#tnmncl").collapse('hide');
	 
  });
  $(".close_menu_mb").on('click',function(e){
	  $("#clmncl").collapse('hide');
	  $("#grmncl").collapse('hide');
	  $("#tnmncl").collapse('hide');
	  $(".ul-mobile.list-unstyled").attr('style','');
	  $("#grmncl1").collapse('hide');
  });
 $("#icosearch_top").on('click',function(e){
	  $("#search_top").collapse('toggle');
	  $("#inpsearch_top").focus();
	
  });
   
 
});

function reload(){
	location.reload();
}
function fun_question(event){
	 /*$("#main_bussiness").attr("style", "display:none");
	$("#new_main_page").attr("style", "");
	$(".box-cauhoi").parent().parent().attr("style", "display:none");
	$("#bannerpage_m").attr("style", "");*/
	window.location.href = site_url+"/home_user";
	
}
function load_topmenu(choice){
	
	$("#clmncl").collapse('hide');
	$("#grmncl").collapse('hide');
	$("#tnmncl").collapse('hide');
	$(".ul-mobile.list-unstyled").attr('style','');
	old_top = $("#topname").html();
	html = $("#"+choice).html();
	if(old_top!=choice){
		$("#top_menu").empty();
		$("#top_menu").append(' <div style="display:none;" id="topname">'+choice+'</div>'+html);
		$("#"+old_top).attr("style","display:block");
		$("#"+choice).attr("style","display:none");
	}
	$("html, body").animate({ scrollTop: 0 }); 
	
	
}

function load_tab1(){
	$("#text-tabs2").attr("style", "display:none");
	$("#text-tabs2").parent().attr("class", "");
	$("#text-tabs4").parent().attr("class", "");
	$("#text-tabs5").parent().attr("class", "");
	$("#text-tabs").parent().attr("class", "active");
	$("#home1").attr("class","tab-pane fade in active");
	$("#home4").attr("class","tab-pane fade");
	$("#home5").attr("class","tab-pane fade");

}

function choosetypeaccount(){
	$("#main_bussiness").attr("style", "");
	$("#new_main_page").attr("style", "display:none");
    load_topmenu("account_menu");
	load_tab1();
	$('#home1').empty();
	$('#text-tabs')[0].innerText = "Chọn dạng tài khoản";
	$('.line-L h1')[0].innerText = "Tài khoản";
	htmlac ='<p>Bạn là :</p>'+
		  '<form method="post" action="'+site_url+'/synchronize/change_role">'+
		  '<div style="margin-bottom:20px">'+
				'<div class="col-md-4"><input type="radio" name="rradio" value="3"> Giáo viên</div>'+
				'<div class="col-md-4"> <input type="radio" name="rradio" value="2"> Học sinh <br/></div>'+
				'<input type="radio" name="rradio" value="4" > Phụ Huynh <br/>'+
			 '</div>'+
			 '<button type="submit" class="btn btn-info" style="margin-left:220px">Xác nhận</button>'+
		 '</form>';
    $('#home1').append(htmlac);
}
function createQuestionItem(event){
  // window.location.href = base_url+"index.php/home_user";
   $("#main_bussiness").attr("style", "");
$("#new_main_page").attr("style", "display:none");
   // load_topmenu("quiz_menu");
	load_tab1();
	$('#home1').empty();
	$('#text-tabs')[0].innerText = "Tạo câu hỏi";
	$('.line-L h1')[0].innerText = "Trắc nghiệm";
   $("#home1").empty();
    var htmlx='<form method="post" action="'+site_url+'/qbank/new_question_1/4/0">'+
				'<div class="form-group MT20">'+
					'<textarea class="form-control" id= "question" rows="3" name="question" placeholder="Tạo câu hỏi trắc nghiệm" ></textarea>'+
				'</div>'+
				'<div class="form-group MT20">'+
				  '<input class="form-control" id= "bgqid" rows="3" name="bgqid" value="0" style="display:none;">'+
				'</div>';
		if($(window).width()<1100){
			htmlx+='<div id="bg_template"class="form-group MT20" style="margin-bottom:90px">';
			if($(window).width()>767){
				htmlx+=' <table>'+
							'<tr>'+
				'<td>Chọn màu nền  </td>';
			}
			else{
				htmlx+=' <table>'+
				    	'<tr>'+
                           '<td>Chọn màu nền  </td>'+
						'</tr>'+
                        '<tr>';
			}
		}
        else{
			htmlx+='<div id="bg_template"class="form-group MT20" style="margin-bottom:50px">';
			htmlx+=' <table>'+
				    	'<tr>'+
                           '<td>Chọn màu nền  </td>'+
						'</tr>'+
                        '<tr>';
		}		
			
		if($(window).width()<1100){
			for(i=0; i<10; i++){
					htmlx+=	'<td class="tranbtsbg openbgc"  style="opacity: 1; transform: translateX('+30*i+'px);">'+
						'<a id="bgq'+(i+1)+'">'+
							'<img src="https://stemup.app/upload/background/'+(i+1)+'.jpg" class="imgbgrbt" >'+
						'</a>'+
					   '</td>';
			}	
		   for(i=10; i<20; i++){
					htmlx+=	'<td class="tranbtsbg openbgc"  style="opacity: 1; transform: translate('+30*(i-10)+'px,40px);">'+
						'<a id="bgq'+(i+1)+'">'+
							'<img src="https://stemup.app/upload/background/'+(i+1)+'.jpg" class="imgbgrbt" >'+
						'</a>'+
					   '</td>';
			}
		}
        else{
			for(i=0; i<20; i++){
					htmlx+=	'<td class="tranbtsbg openbgc"  style="opacity: 1; transform: translateX('+30*i+'px);">'+
						'<a id="bgq'+(i+1)+'">'+
							'<img src="https://stemup.app/upload/background/'+(i+1)+'.jpg" class="imgbgrbt" >'+
						'</a>'+
					   '</td>';
			}	
		}		
		htmlx+='<tr>'+	
				    '</table>'+
											
					    
				'</div>'+
				'<div class="row MB20" id="answer-area-1">'+
					'<div class="col-xs-6">'+
						'<label class="radio-inline w-100">'+
								 '<input class="MT10" type="radio" name="score" value="0">'+
							   '<div class="input-group">'+
								 '<span class="input-group-addon">A</span>'+
								 '<input id="optA1" type="text" class="form-control" name="option[]"  value="" placeholder="Điền phương án A" required />'+
							   '</div>'+
						'</label>'+
					'</div>'+
					'<div class="col-xs-6">'+
						'<label class="radio-inline w-100">'+
								 '<input class="MT10" type="radio" name="score" value="1" >'+
							   '<div class="input-group">'+
								 '<span class="input-group-addon">B</span>'+
								 '<input id="optB1" type="text" class="form-control" name="option[]" value="" placeholder="Điền phương án B" required />'+
							   '</div>'+	
						'</label>'+
					'</div>'+
				'</div>'+
				'<div class="row" id="answer-area-2">'+
					'<div class="col-xs-6">'+
						'<label class="radio-inline w-100">'+					
								 '<input class="MT10" type="radio" name="score" value="2">'+
							   '<div class="input-group">'+
								 '<span class="input-group-addon">C</span>'+
								 '<input id="optC1" type="text" class="form-control" name="option[]" value="" placeholder="Điền phương án C" required />'+
							   '</div>'+	 
						'</label>'+
					'</div>'+
					'<div class="col-xs-6">'+
						'<label class="radio-inline w-100">'+
								 '<input class="MT10" type="radio" name="score" value="3">'+
							   '<div class="input-group">'+
								 '<span class="input-group-addon">D</span>'+
								 '<input id="optD1" type="text" class="form-control" name="option[]"value="" placeholder="Điền phương án D" required />'+
							   '</div>'+
						'</label>'+
					'</div>'+
				'</div>'+
				'<div><p class="text-center MT10 text-do" id="support">Chọn câu trả lời đúng trước khi lưu</p></div>'+
				'<div class="text-center" id="btarea">'+
					'<button id="savebt" type="button" class="btn btn-primary" disabled style="display:none;">Lưu</button>'+
					'<button id="cancelbt" type="button" class="btn btn-default" onclick="cancel_question()"">Hủy</button>'+
				'</div>'+
			'</form>';
	$("#home1").append(htmlx);
    tinymce.remove("textarea#question");
	 tinymce.init({
	  menubar:false,
	  statusbar: false,
	  selector: 'textarea#question,textarea#descr1',
       branding: false,
	  auto_focus : "question",
	  images_dataimg_filter: function(img) {
		return img.hasAttribute('internal-blob');
	  },
	  init_instance_callback: function (editor) {
		editor.on('change', function (e) {
		$("#savebt").attr("style","display:none");
		  checksim=true;
		  similar=false;
		});
		
		
	  },
	   height: 150,
	  theme: 'modern',
	  plugins: [
		'tiny_mce_wiris',
		'advlist autolink lists link image jbimages eqneditor charmap print preview hr anchor pagebreak',
		'searchreplace wordcount visualblocks visualchars code fullscreen',
		'insertdatetime media nonbreaking save table contextmenu directionality',
		'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
	  ],
	  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify ',
	  image_advtab: true,
	  setup: function(editor) {

			editor.addButton('embed', {
			  icon: 'embedcode',
			  tooltip: "Embed",
			  onclick: function() {
				  editor.windowManager.open({
						title: 'Insert Embed Code',
						body: [
							{type: 'textbox', name: 'text', size:'1000' , autofocus: true,multiline:true,minHeight:150,minWidth:500,id:'embedcodes'}
						],
						onsubmit: function(e) {
							editor.insertContent($('#embedcodes').val());
							
						}
				  });
			  }
			});
		  }
	  
	 });
	 tinymce.init({
	  menubar:false,
	  statusbar: false,
	  selector: 'input#optAs1,input#optBs1,input#optCs1,input#optDs1',
	   branding: false,										   
	  images_dataimg_filter: function(img) {
		return img.hasAttribute('internal-blob');
	  },
	   min_height: 30,
	  theme: 'modern',
	  plugins: [
		'placeholder tiny_mce_wiris',
		
	  ],
	  toolbar1: 'tiny_mce_wiris_formulaEditor',
	  image_advtab: true,
	   setup: function (theEditor) {
			theEditor.on('focus', function () {
				$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").show();
			});
			theEditor.on('blur', function () {
				$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
			});
			theEditor.on("init", function () {
				$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
			});
			
		}
	  
	 });
	 
	$("#bgq1").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/1.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(1);
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq1").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/1.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(1);
        }
	});

   	$("#bgq2").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/2.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(2);
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq2").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/2.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(2);
        }
	});
  
  	$("#bgq3").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/3.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(3);
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq3").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/3.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(3);
        }
	});
	
	$("#bgq4").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/4.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid").val(4);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq4").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/4.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(4);
        }
	});
	
	$("#bgq5").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/5.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid").val(5);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq5").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/5.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(5);
        }
	});
	
	$("#bgq6").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/6.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid").val(6);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq6").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/6.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(6);
        }
	});
	
	$("#bgq7").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/7.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid").val(7);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq7").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/7.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(7);
        }
	});
	
	$("#bgq8").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/8.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid").val(8);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq8").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/8.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(8);
        }
	});
	
	$("#bgq9").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/9.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid").val(9);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq9").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/9.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(9);
        }
	});
	
	$("#bgq10").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/10.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid").val(10);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq10").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/10.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(10);
        }
	});

	$("#bgq11").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/11.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(11);
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq11").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/11.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(11);
        }
	});
	$("#bgq12").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/12.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(12);
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq12").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/12.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(12);
        }
	});
	$("#bgq13").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/13.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(13);
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq13").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/13.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(13);
        }
	});
	$("#bgq14").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/14.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(14);
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq14").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/14.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(14);
        }
	});
	$("#bgq15").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/15.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(15);
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq15").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/15.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(15);
        }
	});
	$("#bgq16").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/16.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(16);
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq16").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/16.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(16);
        }
	});
	$("#bgq17").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/17.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(17);
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq17").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/17.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(17);
        }
	});
	$("#bgq18").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/18.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(18);
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq18").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/18.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(18);
        }
	});
	$("#bgq19").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/19.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(19);
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#mbgq19").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/19.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(19);
        }
	});
	$("#bgq20").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('question').getContent();
		
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/20.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(20);
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});
   
   $("#mbgq20").on('click',function(){

		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		xx=$("#qwbgpr").html();
		if(xx.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/20.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid").val(20);
        }
	});
	
	$("#clmdprbg").on('click', function(){
		tinyMCE.get('question').setContent($("#qwbgpr").html());
	});						

		
		checksim=true;
		similar=false;
		$("#optA1,#optB1,#optC1,#optD1").on('click',function(e){
			
			content =tinyMCE.get('question').getContent().trim();
			content=content.replace(/<\/?[^>]+(>|$)/g, "");
			content=content.replace("?", "");
			//console.log(content);
			sim(content.trim(),200);
			
		});
		$("[name=score]").on('change',function(e){																						
		
			content =tinyMCE.get('question').getContent().trim();
			content=content.replace(/<\/?[^>]+(>|$)/g, "");
			content=content.replace("?", "");
			$("#savebt").prop('disabled', false);
			sim(content.trim(),200);
			
		});
		var htmlcteg="";
		var htmllevel="";
		$.ajax({
			type: "POST", // phương thức dữ liệu được truyền đi
			data : {}, // lấy toàn bộ thông tin các fields trong form
			url: base_url + "index.php/qbank/get_category_level_list/", // gọi đến file server
			success: function(results){//kết quả trả về từ server nếu gửi thành công
				
				for(i=0;i<results.category_list.length; i++)
					htmlcteg+='<option value="'+results.category_list[i]['cid']+'">'+results.category_list[i]['category_name']+'</option>';
				for(i=0;i<results.level_list.length; i++)
					htmllevel+='<option value="'+results.level_list[i]['lid']+'">'+results.level_list[i]['level_name']+'</option>';
				var htmls = '<div id="optionarea" style="margin-top:20px">';
				
				htmls+='<div class="col-md-12"><div class="col-md-3" style="margin-top:20px">Dạng câu hỏi: </div>';
				htmls+='<div class="col-md-3" style="margin-top:20px"> <input name="q_type" value="1" type="radio"> Trắc nghiệm</div>';
				htmls+='<div class="col-md-3" style="margin-top:20px"> <input name="q_type" value="2" type="radio"> Video </div>';
				htmls+='<div class="col-md-3" style="margin-top:20px"> <input name="q_type" value="3" type="radio"> Bài đọc </div>';
				
				htmls+='</div>';
				
                htmls+='<div class="col-md-12"><div class="col-md-3" style="margin-top:20px">Chọn là MCQ Fun: </div>';
				htmls+='<div class="col-md-9" style="margin-top:20px"> <input id="mcqfun" name="mcqfun" value="0" type="checkbox"></div></div>';
				htmls+='<div class="col-md-12"><div class="col-md-3" style="margin-top:20px">Hiển thị logo: </div>';
				htmls+='<div class="col-md-9" style="margin-top:20px"> <input id="logorg" name="logorg" value="1" type="checkbox" checked></div></div>';
			
				
				htmls+='<div class="col-md-12"><div class="col-md-3" style="margin-top:20px">Chọn môn học <span style="color:red">(*)</span>:</div>';
				htmls+='<div class="col-md-9" style="margin-top:20px" ><select class="form-control col-md-9" name="cid" required><option value="">-------Chọn môn học--------</option>'+htmlcteg+'</select></div>';
				htmls+='<div class="col-md-3" style="margin-top:20px" > Chọn lớp :</div>';
				htmls+='<div class="col-md-9" style="margin-top:20px"><select class="form-control" name="lid" required> <option value="15">-------Chọn lớp -------------</option> '+htmllevel+'</select></div>';
				htmls+='<div class="col-md-3" style="margin-top:20px">Giải thích </span>:</div>';
				htmls+='<div class="col-md-9" style="margin-top:20px"><textarea  id="descr1" name="description"  class="form-control" ></textarea></div>';
				htmls+='<div class="col-md-3" style="margin-top:20px">Từ khóa <span style="color:red">(*)</span>:</div>';
				htmls+='<div class="col-md-9" style="margin-top:20px"><input type="text" class="form-control" style="margin-bottom:20px" name="tags" value="" required></div>';
				htmls+='<div class="col-md-3" style="margin-top:20px">Thời gian làm bài:(tính bằng giây) <span style="color:red">(*)</span></div>';
				htmls+='<div class="col-md-9" style="margin-top:20px"><input type="number" class="form-control" style="margin-bottom:20px" name="answer_time" value="60" min="0" required></div>';
               
			     htmls+='<div class="col-md-3" style="margin-top:20px">Tiết :</span></div>';
				htmls+=	'<div class="col-md-9" style="margin-top:20px"><input name="unitmcq" id="unitmcq" type="text" class="form-control" style="margin-bottom:20px" value=""></div>';

				
			    htmls+='<div class="col-md-3" style="margin-top:20px">Bài :</span></div>';
				htmls+=	'<div class="col-md-9" style="margin-top:20px"><input name="lessonmcq" id="lessonmcq" type="text" class="form-control" style="margin-bottom:20px" value=""></div>';

				

				htmls+='<div class="col-md-3" style="margin-top:20px">Nguồn :</span></div>';
				htmls+=	'<div class="col-md-9" style="margin-top:20px"><input name="sourcemcq" id="sourcemcq" type="text" class="form-control" style="margin-bottom:20px" value=""></div>';
				htmls+='</div>';
				htmls+='<div><p class="text-center MT10 text-do" id="support">Từ khóa: liên kết các câu hỏi liên quan đến nhau. Một câu hỏi có thể nhiều từ khóa.</p></div>';
				htmls+='<div><p class="text-center MT10 text-do" id="support">Lưu ý: các từ khóa cách nhau bởi dấu phẩy (,) </p></div>';
				htmls+='<div><p class="text-center MT10 text-do" id="support">(*): Thông tin bắt buộc </p></div>';
					document.getElementById("savebt").onclick = function () {
			
			        
					$("#btarea").prev().prepend(htmls);
					tinymce.init({
					  menubar:false,
					  statusbar: false,
					  selector: 'textarea#descr1',
					   branding: false,
					  auto_focus : "descr1",
					  images_dataimg_filter: function(img) {
						return img.hasAttribute('internal-blob');
					  },
					  
					   height: 250,
					  theme: 'modern',
					  plugins: [
						'tiny_mce_wiris',
						'advlist autolink lists link image jbimages eqneditor charmap print preview hr anchor pagebreak',
						'searchreplace wordcount visualblocks visualchars code fullscreen',
						'insertdatetime media nonbreaking save table contextmenu directionality',
						'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
					  ],
					  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages | eqneditor tiny_mce_wiris_formulaEditor | print preview media embed  | forecolor backcolor emoticons | codesample help',
					  image_advtab: true,
					  setup: function(editor) {

							editor.addButton('embed', {
							  icon: 'embedcode',
							  tooltip: "Embed",
							  onclick: function() {
								  editor.windowManager.open({
										title: 'Insert Embed Code',
										body: [
											{type: 'textbox', name: 'text', size:'1000' , autofocus: true,multiline:true,minHeight:150,minWidth:500,id:'embedcodes'}
										],
										onsubmit: function(e) {
											editor.insertContent($('#embedcodes').val());
											
										}
								  });
							  }
							});
						  }
					  
					 });
					$("#mcqfun").on('change', function(){
						mfp=parseInt($(this).val());
						$(this).val(1-mfp);
						//console.log($(this).val());

					})
					$("#logorg").on('change', function(){
						mfp=parseInt($(this).val());
						$(this).val(1-mfp);
						//console.log($(this).val());

					})
					$('#savebt').remove();
					$('#cancelbt').parent().prepend('<button type="submit" class="btn btn-primary">Lưu</button>');
					
				}

			},
			error: function(xhr,status,strErr){
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}
	    });
		
		

		
	
	
	

	
}
function cancel_question(){
	//window.location.href = base_url+"index.php/home_user";
	createQuestionItem(this);
}

var langs = {
    "sProcessing":   "Đang xử lý...",
    "sLengthMenu":   "Xem _MENU_ mục",
    "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
    "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
    "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
    "sInfoFiltered": "(được lọc từ _MAX_ mục)",
    "sInfoPostFix":  "",
    "sSearch":       "<i class='fas fa-search' style='float:right;margin-top:10px; margin-left:10px'></i>",
    "sUrl":          "",
    "oPaginate": {
        "sFirst":    "Đầu",
        "sPrevious": "Trước",
        "sNext":     "Tiếp",
        "sLast":     "Cuối"
    }
};

function gocthutai(event){
	$("#main_bussiness").attr("style", "");
	$("#new_main_page").attr("style", "display:none");
	load_topmenu("quiz_menu");
	load_tab1();
	$('#home1').empty();
	$('#text-tabs')[0].innerText = "Góc thử tài";
	$('.line-L h1')[0].innerText = "Trắc nghiệm";
	var formData = {};
	$.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/home_user/goc_thu_tai/",
		success: function(results){
			//console.log(results);
			var html = '<p class="MT10 "> Bài trắc nghiệm: <a href="'+base_url+'index.php/quiz/validate_quiz/'+results.qt.quid+'">';
			html += '<b>'+results.qt.quiz_name+'</b></a></p><div class="form-group MT20"><b>'+results.qt.question+'</b></div>';
			html += '<form method="post" action="'+base_url+'index.php/home_user/student_answers/'+results.qt.quid+'/'+results.qt.qid+'">';
			var answers = ['A', 'B', 'C', 'D'];
			for(var i = 0; i < 4; i++){
				html += '<div class="col-xs-6 MB20"><label class="radio-inline w-100">';
				html += '<input class="MT10" type="radio" name="optradio" value="'+i+'">';
				html += '<div class="input-group"><span class="input-group-addon">'+answers[i]+'</span>';
				var option = 'option_' + i;
				html += '<p style="margin-left:10px;">'+results.opt[option]+'</p> ';
				html += '</div></label></div>';
			}
			html += '<div class="text-center" style="margin-top:20px"><button type="submit" class="btn btn-primary">Trả lời</button></div></form>';
			$('#home1').append(html);
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});
}

function manageQuestionItem(event){
	$("#main_bussiness").attr("style", "");
	$("#new_main_page").attr("style", "display:none");
	load_topmenu("quiz_menu");
	load_tab1();
	$('#home1').empty();
	$('#text-tabs')[0].innerText = "Quản lý câu hỏi";
	$('.line-L h1')[0].innerText = "Trắc nghiệm";
	var formData = {};
	$.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/home_user/manage_question/",
		success: function(results){
			$('#home1').css('overflow', 'auto');
			$('#home1').append('<table id="tblquestion" class="display" style="width:100%"></table>');
			var tbl = $('#tblquestion').DataTable({
				responsive: true,
				data: results.data['question'],
				columns: [
					{ "data": "qid","title": "#"},
		            { "data": "question","render":function (data, type, row){
						                       return '<a href="#manage_question" title="Xem trước"><b>'+row.question+'</b></a>';
					                           } ,"title": "Câu hỏi", "width":"80%" ,"class":  "details-control-p"},
		            { "data": "category_name", "title": "Danh mục","render":function (data, type, row){
						                       return '<a href="#manage_question" class="categ">'+row.category_name+'</a>';
					                           }, "width":"30%" ,"orderable":false},
		            { "data": "level_name", "title": "Cấp độ","render":function (data, type, row){
						                       return '<a href="#manage_question" class="lv">'+row.level_name+'</a>';
					                           }, "width":"30%" ,"orderable":false,},
					{ "data": null, "title": "","render":function (data, type, row) { 
					                                                return'<a href="#manage_question" title="Xem trước"><i class="fas fa-eye text-success"></i></a>';}
																	, 
																	"class":  "details-control-p", "orderable": false },
		            { "data": null, "title": "","render":function (data, type, row) { 
					                                            if(row.editable==1) {
					                                                return'<a href="#manage_question" title="Sửa"><i class="fas fa-pencil-alt text-warning"></i></a>';}
																	else {return "<p></p>";}}, 
																	"class":  "details-control-e", "orderable": false },
		            { "data": null, "title": "","render":function (data, type, row) { 
					                                            if(row.editable==1) {
					                                                return'<a href="#manage_question" title="Xóa"><i class="fas fa-trash-alt"></i></a>';}
																	else {return "<p></p>";}}
												                 , "class":  "details-control-d", "orderable": false },
		        ],
		        language: langs,
		        order: [[ 0, "desc" ]]
			});
            
			$('#tblquestion thead tr').each(function () {
				$(this).css('background-color', '#e9ebee');
			});
            
			$("[type=search]").attr("placeholder","Tìm kiếm câu hỏi, danh mục, cấp độ");
			$("[type=search]").attr("style","width:250px;");
			$('#tblquestion thead tr').each(function () {
				$(this).css('background-color', '#e9ebee');
			});
            
			$("tbody>tr>td>a>b>p>img").attr("class","col-md-5");
			$("tbody>tr>td>a>b>p>iframe").attr("class","col-md-5");
			$("tbody>tr>td>a>b>p>iframe").attr("height",100);
			$('#tblquestion thead th').each(function () {
		        var title = $(this).text();
				
		        /*if(title == 'Câu hỏi'  ){	
		        	$(this).empty();
		        	$(this).append('<p style="margin-left:-10px">'+title+'   <a style="margin-left:40px" href="#searchq" data-toggle="collapse"><i class="fas fa-search"></i></a></p>'
					                 +' <div  style="margin-left:-10px" id="searchq" class="collapse"><input type="text"  style="width: 240px;" placeholder="Tìm kiếm '+title+'" /></div>' );
		        }*/
				 var html_opt = '';
				 for(i =0; i < results.data['category'].length; i++){
					 html_opt+='<option>'+results.data['category'][i]['category_name']+'</option>';
				 }
				 var html_level = '';
				 for(i =0; i < results.data['level'].length; i++){
					 html_level+='<option>'+results.data['level'][i]['level_name']+'</option>';
				 }
				 if(title == 'Danh mục'  ){	
		        	$(this).empty();
		        	$(this).append(  '<select style="width:90px; margin-left:-20px" id="slc"><option id="optct0">Danh mục</option><option>Tất cả</option>'
									 +html_opt
									 +'</select>' );
					 
		        }
				if(title == 'Cấp độ'  ){	
		        	$(this).empty();
		        	$(this).append('<select style="width:75px;margin-left:-20px" id="slv"><option id="optlv0">Cấp độ</option><option>Tất cả</option>'
									 +html_level
									 +'</select></div>' );
		        }
		    });
			//$('#slc').select2();
			// $('#slv').select2();
		    tbl.columns().every(function(){
		        var that = this;
		        $('input', this.header()).on('keyup change', function(){
		            if (that.search() !== this.value){
		                that.search(this.value).draw();
		            }
		        });
				
				$('select',this.header()).on('change', function() {
					
				   if (that.search() !== this.value ){
					   
		               
					   if(this.value=="Tất cả"){
						that.search('').draw();
					    }
						else
						  that.search(this.value).draw();
					}
					
				});
				
		    });
			 $('#tblquestion tbody').on('click', 'td>a.categ', function (){
				$("#slc").val($(this).html());
				$("#slv").val('Tất cả');
				tbl.column(2).search($(this).html()).draw();
		        tbl.column(3).search('').draw();
			});
			
			 $('#tblquestion tbody').on('click', 'td>a.lv', function (){
				$("#slv").val($(this).html());
				$("#slc").val('Tất cả');
				tbl.column(3).search($(this).html()).draw();
				tbl.column(2).search('').draw();
		   
			});
			
			$("#slc").on('click', function(){
				$("#optct0").prop("disabled", true);
		   
			});
			$("#slv").on('click', function(){
				$("#optlv0").prop("disabled", true);
		   
			});
				 $('#tblquestion tbody').on('click', 'td.details-control-p', function () {
					 var dataq = tbl.row($(this).parent()).data();
					  $.ajax({
						type: "POST",
						data : formData,
						url: base_url + "index.php/home_user/get_question/"+dataq['qid'],
						success: function(results){
							$("#previewquestionModal").modal();	
							$("#prqt").empty();
							$("#prqt").append("Câu hỏi #"+ dataq['qid']);							
							var q = results.data['question'];
							if(q.indexOf("<img")!=-1)
								q=q.replace("<img", "<img width=240 height:160");
							if(q.indexOf("<iframe")!=-1)
								q=q.replace("<iframe", "<iframe height:150");
							
							if(dataq.background_template!=0){
								q='<div  id="qwbgpr" style="font-size: 33px; text-align:center ;font-weight: 700;" >'
								   +'<font color="white"><div style="padding: 120px 27px;text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url(\'https://stemup.app/upload/background/'+dataq.background_template+'.jpg\'); height:300px">'+q+
		                         '</div></font></div>';
							}
							$("#questionp").empty();
							$("#questionp").append('<b>'+q+'</b>');
							$("#answer-areap").empty();
							opA =results.data['options'][0]['q_option'];
							opB =results.data['options'][1]['q_option'];
							opC =results.data['options'][2]['q_option'];
							opD =results.data['options'][3]['q_option'];
							if(opA.indexOf("<p>")==0)
								opA = opA.substring(3,opA.length-4);
							if(opB.indexOf("<p>")==0)
								opB = opB.substring(3,opB.length-4);
							if(opC.indexOf("<p>")==0)
								opC = opC.substring(3,opC.length-4);
							if(opD.indexOf("<p>")==0)
								opD = opD.substring(3,opD.length-4);
								
							var htmla='<div class="row MB20">'+
										'<div class="col-xs-6"><div id="optAp"> A: '+opA+'</div></div>'+
										'<div class="col-xs-6"><div id="optBp"> B: '+opB+'</div></div>'+
									'</div>'+
									'<div class="row MB20">'+
										'<div class="col-xs-6"><div id="optCp"> C: '+opC+'</div></div>'+
										'<div class="col-xs-6"><div id="optDp"> D: '+opD+'</div></div>'+
									'</div>';													
							$("#answer-areap").append(htmla);
							if(results.data['c_option']==0){
									$('#optAp').prepend("<i class='fa fa-check-circle text-success'></i>");
									$('#optAp').attr("class","text-success");
							}
							else if(results.data['c_option']==1){
								$('#optBp').prepend("<i class='fa fa-check-circle text-success'></i>");
								$('#optBp').attr("class","text-success");
							}
							else if(results.data['c_option']==2){
								$('#optCp').prepend("<i class='fa fa-check-circle text-success'></i>");
								$('#optCp').attr("class","text-success");
							}
							else if(results.data['c_option']==3){
								$('#optDp').prepend("<i class='fa fa-check-circle text-success'></i>");
								$('#optDp').attr("class","text-success");
							}
							var rating = 0;
							var reviewervalue = 0;
					    	var reviewercontent = "";
					    	var reid = 0;
					    	var reviewcount = results.review.length;
		    				var reviewcountstr = reviewcount + " người đã đánh giá.";
							if(results.review.length > 0){
								for (var i = results.review.length - 1; i >= 0; i--) {
									rating += parseInt(results.review[i].value);
									if(results.user.uid === results.review[i].reviewer){
										reid = results.review[i].id;
										reviewervalue = results.review[i].value;
										reviewercontent = results.review[i].content;
									}
								}
								rating = rating / results.review.length;
							}
							$("#optionareap").empty();
							var htmlo ='<table>'+
											'<tr> <td>Môn học:</td><td style="padding:5px">'+dataq['category_name']+'</td></tr>'+
											'<tr> <td>Lớp:</td><td style="padding:5px">'+dataq['level_name']+'</td></tr>'+
											'<tr> <td>Giải thích:</td><td style="padding:5px">'+results.data['description']+'</td></tr>'+
											'<tr> <td>Từ khóa:</td><td style="padding:5px">'+results.data['tags']+'</td></tr>'+
											'<tr> <td>Thời gian làm bài:</td><td style="padding:5px">'+results.data['answer_time']+' giây</td></tr>'+
											'<tr> <td>Đánh giá:</td><td style="padding:5px"><a href="javascript:void(0);" onmouseup="rating_item('+ dataq['qid']+', \'savsoft_qbank\','+reid+','+reviewervalue+',\''+reviewercontent+'\');" title="'+reviewcountstr+'"><input id="rvalue" value="'+rating+'" class="rating rating-loading" data-min="0" data-max="5"  data-size="xs"/></a></td></tr>'+
										'</table>';
							$("#optionareap").append(htmlo);
							$('#rvalue').rating({displayOnly: true, step: 1});
							$('*').keyup(function(e){
								  if(e.keyCode=='27'){
									 $('#previewquestionModal').modal('hide');
								  }       
							  })
							
						},
						error: function(xhr,status,strErr){
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}
					  });
					});
				
			    $('#tblquestion tbody').on('click', 'td.details-control-e', function () {
					 var dataq = tbl.row($(this).parent()).data();
					 if(dataq['editable']==1){
					  $.ajax({
						type: "POST",
						data : formData,
						url: base_url + "index.php/home_user/get_question/"+dataq['qid'],
						success: function(results){
							 $("#editquestionModal").modal();
							 //urlf= base_url + "index.php/qbank/edit_question_1/"+dataq['qid'];
							 //$('#editquestionform').attr('action', urlf);
							 cid = results.data['cid'] ;
							 lid = results.data['lid'] ;
							  
							 tinymce.init({
								  menubar:false,
								  statusbar: false,
								  selector: '#optA,#optB,#optC,#optD',
                                   branding: false,										   
								  images_dataimg_filter: function(img) {
									return img.hasAttribute('internal-blob');
								  },
								   min_height: 40,
								  theme: 'modern',
								  plugins: [
									'placeholder tiny_mce_wiris',
									'advlist autolink lists link image jbimages eqneditor charmap print preview hr anchor pagebreak',
									'searchreplace wordcount visualblocks visualchars code fullscreen',
									'insertdatetime media nonbreaking save table contextmenu directionality',
									'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
								  ],
								  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages | eqneditor tiny_mce_wiris_formulaEditor | print preview media embed | forecolor backcolor emoticons | codesample help',
								  image_advtab: true,
								   setup: function (theEditor) {
										theEditor.on('focus', function () {
											$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").show();
										});
										theEditor.on('blur', function () {
											$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
										});
										theEditor.on("init", function () {
											$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
										});
										theEditor.addButton('embed', {
											  icon: 'embedcode',
											  tooltip: "Embed",
											  onclick: function() {
												  theEditor.windowManager.open({
														title: 'Insert Embed Code',
														body: [
															{type: 'textbox', name: 'text', size:'1000' , autofocus: true,multiline:true,minHeight:150,minWidth:500,id:'embedcodes'}
														],
														onsubmit: function(e) {
															theEditor.insertContent($('#embedcodes').val());
															
														}
												  });
												}
										});
									}
								  
								 });
								 tinymce.init({
								  menubar:false,
								  //statusbar: false,
								  selector: 'textarea#questione,#descr',
                                   branding: false, 
								  images_dataimg_filter: function(img) {
									return img.hasAttribute('internal-blob');
								  },
								   height: 100,
								  theme: 'modern',
								  plugins: [
									'placeholder tiny_mce_wiris',
									'advlist autolink lists link image jbimages eqneditor charmap print preview hr anchor pagebreak',
									'searchreplace  visualblocks visualchars code fullscreen',
									'insertdatetime media nonbreaking save table contextmenu directionality',
									'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
								  ],
								  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages | eqneditor tiny_mce_wiris_formulaEditor | print preview media embed | forecolor backcolor emoticons | codesample help',
								  image_advtab: true,
								 
								   setup: function (theEditor) {
										theEditor.on('focus', function () {
											$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").show();
										});
										theEditor.on('blur', function () {
											$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
										});
										theEditor.on("init", function () {
											$(this.contentAreaContainer.parentElement).find("div.mce-toolbar-grp").hide();
										});
										
										theEditor.addButton('embed', {
										  icon: 'embedcode',
										  tooltip: "Embed",
										  onclick: function() {
											  theEditor.windowManager.open({
													title: 'Insert Embed Code',
													body: [
														{type: 'textbox', name: 'text', size:'1000' , autofocus: true,multiline:true,minHeight:150,minWidth:500,id:'embedcodes'}
													],
													onsubmit: function(e) {
														theEditor.insertContent($('#embedcodes').val());
														
													}
											  });
											}
										});
									}
								  
								 });
								if(results.data['fun_priory']>0){
								  $('#mcq_fun_e').prop('checked', true);
								  $('#mcq_fun_e').val(1);
							   }
							   else{
								   $('#mcq_fun_e').prop('checked', false);
								  $('#mcq_fun_e').val(0);
							   }
							   
							   if(results.data['show_logo']>0){
								  $('#logo_org_e').prop('checked', true);
								  $('#logo_org_e').val(1);
							   }
							    else{
								   $('#logo_org_e').prop('checked', false);
								  $('#logo_org_e').val(0);
							   }
							   $("#qide").empty();
							   $("#qide").append(dataq['qid']);
							   $('#mcq_fun_e').on('click', function(){
								   valfp =$('#mcq_fun_e').val();
								   $('#mcq_fun_e').val(1-valfp);
							   } );
							    $('#logo_org_e').on('click', function(){
								   valfp =$(logo_org_e).val();
								   $('#logo_org_e').val(1-valfp);
							   } );
							   
							   var q = results.data['question'];
							  if(q.indexOf("<img")!=-1)
								  q=q.replace("<img", "<img width=360 height:270");
                               tinyMCE.get('questione').setContent(q); 
							   tinyMCE.get('optA').setContent(results.data['options'][0]['q_option']); 
							   tinyMCE.get('optB').setContent(results.data['options'][1]['q_option']);
							   tinyMCE.get('optC').setContent(results.data['options'][2]['q_option']); 
							   tinyMCE.get('optD').setContent(results.data['options'][3]['q_option']); 	
							   tinyMCE.get('descr').setContent(results.data['description']); 								   
                             					  
							 $("#questione").val(results.data['question']);
							 $("#sourcemcq_e").val(results.data['source']);
						
							  $("#optA").val(results.data['options'][0]['q_option']);
							 $("#optB").val(results.data['options'][1]['q_option']);
							 $("#optC").val(results.data['options'][2]['q_option']);
						    $("#optD").val(results.data['options'][3]['q_option']);
							 for(i=0; i<3; i++){
								if(i==results.data['c_option'])
									$("#r"+i).prop("checked",true);

							 }
							 $("#cat"+cid).prop("selected",true);
							 $("#lv"+lid).prop("selected",true);
							 
							$("#descr").val(results.data['description']);
							 $("#tags").val(results.data['tags']);
							 $("#answer_timeedt").val(results.data['answer_time']);
							
						},
						error: function(xhr,status,strErr){
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}
					 }); }            
				});

				 $('#tblquestion tbody').on('click', 'td.details-control-d', function (){
					 var data = tbl.row($(this).parent()).data();
					 if(data['editable']==1){
						remove_entry('qbank/remove_question/'+data['qid'], 'câu hỏi');
					 }
					 console.log(data);
				});
		    


		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});
}

function generateRatingTemplate(reviews){
	var row_label = ['Một sao', 'Hai sao', 'Ba sao', 'Bốn sao', 'Năm sao'];
	var fill= [0, 0, 0, 0, 0];
	if(reviews.length > 0){
		for (var i = 0; i < reviews.length; i++) {
			if(reviews[i].value == 1){
				fill[0] += 1;
			}
			if(reviews[i].value == 2){
				fill[1] += 1;
			}
			if(reviews[i].value == 3){
				fill[2] += 1;
			}
			if(reviews[i].value == 4){
				fill[3] += 1;
			}
			if(reviews[i].value == 5){
				fill[4] += 1;
			}
		}
		fill[0] = (fill[0]  / reviews.length) * 100;
		fill[1] = (fill[1]  / reviews.length) * 100;
		fill[2] = (fill[2]  / reviews.length) * 100;
		fill[3] = (fill[3]  / reviews.length) * 100;
		fill[4] = (fill[4]  / reviews.length) * 100;
	}
	$('.ratings_chart_vl').empty();
	for(var j = 0; j < row_label.length; j++){
		var html = '<li class="chart_row_vl">';
		html += '<span class="row_label row_cell">'+row_label[j]+'</span>';
		html += '<span class="row_bar row_cell">';
		html += '<span class="bar_vl"><span class="fill_vl" style="width:'+fill[j]+'%;"></span></span>';
		html += '</span><span class="row_count row_cell">'+parseInt(fill[j])+'%</span></li>';
		$('.ratings_chart_vl').prepend(html);
	}
}

function rating_item(reviewid, model, reid, value, content){
	$("#ratingModal").modal();
	
	var reviewData = {reviewid: reviewid, model:model};
	$.ajax({
	 	type: "POST",
		data : reviewData,
		url: base_url + "index.php/review/get_review/"+reviewid+"/"+model,
		success: function(results){
			var reviews = [];
			var rdisplay = 0;
			var countdisplay = 0;
			var countdisplaystr = "0 người đã đánh giá";
			$('#value-vl').rating({ displayOnly: true, showCaption:false, showClear:false, step: 1});
			if(results.review.length > 0){
				//console.log("----1----");
				reviews = results.review;
				countdisplay = reviews.length;
				countdisplaystr = countdisplay + " người đã đánh giá.";
				if(reviews.length > 0){
					for (var i = 0; i < reviews.length; i++) {
						rdisplay += parseInt(reviews[i].value);
					}
					rdisplay = rdisplay / reviews.length;
				}
				generateRatingTemplate(reviews);
				$('#value-vl')[0].value = rdisplay;
				$('.seeAllReviews')[0].innerText = countdisplaystr;
				$('#value-vl').rating('update', rdisplay);
			}else{
				//console.log("----2----");
				generateRatingTemplate(reviews);
				$('#value-vl')[0].value = rdisplay;
				$('.seeAllReviews')[0].innerText = countdisplaystr;
				$('#value-vl').rating('update', rdisplay);
			}
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});

	
	if(model === 'savsoft_quiz'){
		if(su!=6){
			$("#ratingModal .close")[0].setAttribute('onclick', "reload()");
			$("#ratingModal .btn-default")[0].setAttribute('onclick', "reload()");
		}
		else{
			$("#ratingModal .close")[0].setAttribute('onclick', "reload()");
			$("#ratingModal .btn-default")[0].setAttribute('onclick', "reload()");
		}
	}else{
		if(su!=6){
			$("#ratingModal .close")[0].setAttribute('onclick', "manageQuestionItem(event);");
			$("#ratingModal .btn-default")[0].setAttribute('onclick', "manageQuestionItem(event);");
		}
		else{
			$("#ratingModal .close")[0].setAttribute('onclick', "manageQuestion_mod(event);");
			$("#ratingModal .btn-default")[0].setAttribute('onclick', "manageQuestion_mod(event);");
		}
	}
	if(value > 0){
		$('#ratingModal #rvalue').rating('update', value);
		$('#ratingModal textarea[name="rcontent"]')[0].value = content;
		$('#msgRating')[0].innerText = "Bạn đã đánh giá mục này, nếu bạn đánh giá thêm hệ thống sẽ lưu lại kết quả lần đánh giá sau cùng của bạn.";
		$('#msgRating')[0].style.display = "";
	}else{
		$('#ratingModal #rvalue').rating('update', 0);
		$('#ratingModal textarea[name="rcontent"]')[0].value = "";
		$('#msgRating')[0].innerText = "";
	}
	$('#ratingBtn').unbind('click').bind('click', function(){

		var rvalue = parseInt($('#ratingModal .rxs .filled-stars')[0].style.width) * 5 / 100;
		var rcontent = $('#ratingModal textarea[name="rcontent"]')[0].value;
		var urlaction = "";
		if(value > 0){
			urlaction = base_url + "index.php/review/update_review_item/"+reviewid+"/"+model+"/"+reid+"/"+rvalue+"/"+rcontent;
		}else{
			urlaction = base_url + "index.php/review/review_item/"+reviewid+"/"+model+"/"+rvalue+"/"+rcontent;
		}
		var formData = {reviewid:reviewid, model:model, rvalue:rvalue, rcontent:rcontent};
		if(rvalue > 0){
			$.ajax({
			 	type: "POST",
				data : formData,
				url: urlaction,
				success: function(results){
					if(results.review.length > 0){
						var rating = 0;
						for (var i = results.review.length - 1; i >= 0; i--) {
							rating += parseInt(results.review[i].value);
						}
						rating = rating / results.review.length;
					}
					changeRating(rating, reviewid, model);
					$('#ratingModal').modal('hide');
				},
				error: function(xhr,status,strErr){
					console.log(xhr);
					console.log(status);
					console.log(strErr);
				}
			});
		}else{
			$('#msgRating')[0].style.display = "";
			$('#msgRating')[0].innerText = "Vui lòng chọn sao trước khi đánh giá.";
		}
	});
}

function changeRating(rating, reviewid, model){
	if(model === 'savsoft_quiz'){
		$('#result-rating'+reviewid).rating('update', rating);
	}else{
		$('#rvalue').rating('update', rating);
	}
}

function remove_entry(redir_cont, message){
	
	if(confirm("Bạn muốn xóa "+message+" này?")){
		window.location=base_url+"index.php/"+redir_cont;
	}
	
}
function create_quiz(event){
	$("#main_bussiness").attr("style", "");
	$("#new_main_page").attr("style", "display:none");
	load_topmenu("quiz_menu");
	load_tab1();
	$('#home1').empty();
	$('#text-tabs')[0].innerText = "Tạo bài kiểm tra";
	$('.line-L h1')[0].innerText = "Trắc nghiệm";
	html = $("#quizModalbody").html();
	html+='<button id="addQuizFirst" type="button" class="btn btn-primary">Tiếp</button>';
	$("#data-grip").remove();
	$("#addQuiz").remove();
	$("#data-grip-pagination").remove();
	$('#home1').append(html);
	
	var formData = {};
		$.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/home_user/manage_quiz/",
		success: function(results){
			// console.log(results);
		    var cc=0;
			var colorcode=['success', 'warning', 'info', 'danger'];
			
		    //console.log(results.questions);
		    var questions = results['questions'];
			var categories = results['categories'];
            var levels = results['levels'];
		    if(results.user.quiz.includes("Add")){
		    	
		    	$('#addQuizFirst').on('click', function(e){
					if($("#inpquizname").val()!=""){
						e.stopPropagation();
						$.ajax({
					 	type: "POST",
						data : $('#formAddQuiz').serialize(),
						url: base_url + "index.php/home_user/add_quiz/",
						success: function(data){
							//console.log(data);
							$('#table-question').append('<table id="tblQuestion" class="display" style="width:100%"></table>');
							var tbl = $('#tblQuestion').DataTable({
					    		searching: true,
					    		select: true,
								responsive: true,
								data: questions,
								columns: [
									{ "data": null, "defaultContent": "", "class":  "details-control", "orderable": false },
						            { "data": "question","render":function (data, type, row){
						                       return '<a href="#create_quiz" title="Xem trước"><b>'+row.question+'</b></a>';
					                           } ,"title": "Câu hỏi", "width":"70%" },
						            { "data": "category_name", "title": "Danh mục" ,"render":function (data, type, row){
													return '<a href="#create_quiz" class="categ">'+row.category_name+'</a>';}},
						            { "data": "level_name", "title": "Cấp độ","render":function (data, type, row){
													return '<a href="#create_quiz" class="lv">'+row.level_name+'</a>'; }},
									{ "data": null, "title": "","render":function (data, type, row) { 
					                                                return'<a href="#create_quiz" title="Xem trước"><i class="fas fa-eye text-success"></i></a>';}, 
																	"class":  "details-control-pp", "orderable": false }
						        ],
						        language: langs,
						        lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]]
							});
                            $("[type=search]").attr("placeholder","Tìm kiếm câu hỏi, danh mục, cấp độ");
							$("[type=search]").attr("style","width:250px;");
							$('#tblQuestion thead tr').each(function () {
								$(this).css('background-color', '#e9ebee');
							});
							
							$("tbody>tr>td>a>b>p>img").attr("class","col-md-5");
							$("tbody>tr>td>a>b>p>iframe").attr("class","col-md-5");
							$("tbody>tr>td>a>b>p>iframe").attr("height",100);
							$('#tblQuestion thead tr').each(function () {
								$(this).css('background-color', '#e9ebee');
							});

							$('#tblQuestion thead th').each(function () {
								 var title = $(this).text();
								 var html_opt = '';
								for(i =0; i < categories.length; i++){
									 html_opt+='<option>'+categories[i]['category_name']+'</option>';
								 }
								 var html_level = '';
								 for(i =0; i < levels.length; i++){
									 html_level+='<option>'+levels[i]['level_name']+'</option>';
								 }
								 if(title == 'Danh mục'  ){	
									$(this).empty();
									$(this).append(  '<select style="width:90px ;margin-left:-20px" id="slc1"><option id="optct1">Danh mục</option><option>Tất cả</option>'
									                 +html_opt
													 +'</select>' );
									 
								}
								if(title == 'Cấp độ'  ){	
									$(this).empty();
									$(this).append('<select style="width:75px;margin-left:-20px" id="slv1"><option id="optlv1">Cấp độ</option><option>Tất cả</option>'
													 +html_level
													 +'</select></div>' );
								}
							});
							
							//$('#slc1').select2();
							//$('#slv1').select2();
						    tbl.columns().every(function(){
						        var that = this;
						 
						        $('input', this.header()).on('keyup change', function(){
						            if (that.search() !== this.value){
						                that.search(this.value).draw();

						            }
						        });
								$('select',this.header()).on('change', function() {
								   if (that.search() !== this.value ){
									   if(this.value=="Tất cả"){
										that.search('').draw();
										}
										else
										  that.search(this.value).draw();
									}
									
								});
								
						    });
							
							 $('#tblQuestion tbody').on('click', 'td>a.categ', function (){
								$("#slc1").val($(this).html());
								$("#slv1").val('Tắt cả');
								tbl.column(2).search($(this).html()).draw();
								tbl.column(3).search('').draw();
						   
							});
							
							 $('#tblQuestion tbody').on('click', 'td>a.lv', function (){
								$("#slv1").val($(this).html());
								$("#slc1").val('Tất cả');
								tbl.column(3).search($(this).html()).draw();
								tbl.column(2).search('').draw();
						   
							});
							
							$("#slc1").on('click', function(){
								$("#optct1").prop("disabled", true);
						   
							});
							$("#slv1").on('click', function(){
								$("#optlv1").prop("disabled", true);
						   
							});
                             $('#tblQuestion tbody').on('click', 'td.details-control-pp', function () {
								var dataq = tbl.row($(this).parent()).data();
								$.ajax({
									type: "POST",
									data : formData,
									url: base_url + "index.php/home_user/get_question/"+dataq['qid'],
									success: function(results){
										$("#previewquestionModal").modal();	
										$("#prqt").empty();
										$("#prqt").append("Câu hỏi #"+ dataq['qid']);
                                        console.log(results);									
										var q = results.data['question'];
										if(q.indexOf("<img")!=-1)
											q=q.replace("<img", "<img width=240 height:160");
										if(q.indexOf("<iframe")!=-1)
											q=q.replace("<iframe", "<iframe height:150");
										$("#questionp").empty();
										$("#questionp").append('<b>'+q+'</b>');
										$("#answer-areap").empty();
										opA =results.data['options'][0]['q_option'];
										opB =results.data['options'][1]['q_option'];
										opC =results.data['options'][2]['q_option'];
										opD =results.data['options'][3]['q_option'];
										if(opA.indexOf("<p>")==0)
											opA = opA.substring(3,opA.length-4);
										if(opB.indexOf("<p>")==0)
											opB = opB.substring(3,opB.length-4);
										if(opC.indexOf("<p>")==0)
											opC = opC.substring(3,opC.length-4);
										if(opD.indexOf("<p>")==0)
											opD = opD.substring(3,opD.length-4);
											
										var htmla='<div class="row MB20">'+
													'<div class="col-xs-6"><div id="optAp"> A: '+opA+'</div></div>'+
													'<div class="col-xs-6"><div id="optBp"> B: '+opB+'</div></div>'+
												'</div>'+
												'<div class="row MB20">'+
													'<div class="col-xs-6"><div id="optCp"> C: '+opC+'</div></div>'+
													'<div class="col-xs-6"><div id="optDp"> D: '+opD+'</div></div>'+
												'</div>';													
										$("#answer-areap").append(htmla);
										if(results.data['c_option']==0){
												$('#optAp').prepend("<i class='fa fa-check-circle text-success'></i>");
												$('#optAp').attr("class","text-success");
										}
										else if(results.data['c_option']==1){
											$('#optBp').prepend("<i class='fa fa-check-circle text-success'></i>");
											$('#optBp').attr("class","text-success");
										}
										else if(results.data['c_option']==2){
											$('#optCp').prepend("<i class='fa fa-check-circle text-success'></i>");
											$('#optCp').attr("class","text-success");
										}
										else if(results.data['c_option']==3){
											$('#optDp').prepend("<i class='fa fa-check-circle text-success'></i>");
											$('#optDp').attr("class","text-success");
										}

										$("#optionareap").empty();
										var htmlo ='<table>'+
														'<tr> <td>Môn học:</td><td style="padding:5px">'+dataq['category_name']+'</td></tr>'+
														'<tr> <td>Lớp:</td><td style="padding:5px">'+dataq['level_name']+'</td></tr>'+
														'<tr> <td>Giải thích:</td><td style="padding:5px">'+results.data['description']+'</td></tr>'+
														'<tr> <td>Từ khóa:</td><td style="padding:5px">'+results.data['tags']+'</td></tr>'+
														'<tr> <td>Thời gian làm bài:</td><td style="padding:5px">'+results.data['answer_time']+' giây</td></tr>'+
													'</table>';
										$("#optionareap").append(htmlo);
										$('*').keyup(function(e){
											  if(e.keyCode=='27'){
												 $('#previewquestionModal').modal('hide');
											  }       
										  })
										
									},
									error: function(xhr,status,strErr){
										console.log(xhr);
										console.log(status);
										console.log(strErr);
									}
								  });
							});
						    $('#tblQuestion tbody').on('click', 'td.details-control', function () {
						        var tr = $(this).closest('tr');
						        var row = tbl.row( tr );
						 		
						 		//console.log(row.data().qid);
						 		//console.log(data.quid);
						        if (tr.hasClass('shown')){
						        	removequestion(data.quid, row.data().qid);
						            row.child.hide();
						            tr.removeClass('shown');
						        }else{
									
						        	addquestion(data.quid, row.data().qid);
						            row.child.show();
						            tr.addClass('shown');
						        }
						    });

						    $('#addQuizFirst').css('display', 'none');
						    $('#home1').append('<button id="btnCapnhat" type="button" class="btn btn-success" data-dismiss="modal">Cập nhật</button>');
						   	$('#btnCapnhat').on('click', function(){
						   		$('#table-question').empty();
						   		$('#quizModal input[name=quiz_name]')[0].value = "";
						   		$('#quizModal textarea[name=description]')[0].value = "";
						   		$('#addQuizFirst').css('display', '');
						   		//$('#btnCapnhat').remove();
						   		//$('#quizModal').modal('hide');
						   		checkItem(event);
						   	}); 
						},
						error: function(xhr,status,strErr){
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}	
					});
		    	    }
					else{
						alert("Vui lòng điền tên bài kiểm tra!!");
					}
				});
		    }
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});
	//$("#quizModal").modal(); 
}


function create_quiz_1(event){

	var formData = JSON.stringify({'cid':0,
								   'lid':0,
								   'search':"",
								   'limit':10,
								   'page':0
								  });	
		$.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/home_user/create_quiz_data/",
		success: function(results){
			
		    var cc=0;
			var colorcode=['success', 'warning', 'info', 'danger'];
			
		    var questions = results['questions'];
			var categories = results['categories'];
            var levels = results['levels'];
		    if(results.user.quiz.includes("Add")){
		    	
		    	$('#addQuizFirst').on('click', function(e){
					if($("#inpquizname").val()!=""){
						e.stopPropagation();
						$.ajax({
					 	type: "POST",
						data : $('#formAddQuiz').serialize(),
						url: base_url + "index.php/home_user/add_quiz/",
						success: function(data){
							$("#inf_quid").val(data['quid']);
						    $('#addQuizFirst').css('display', 'none');
						    $('#home1').append('<button id="btnCapnhat_quiz" type="button" class="btn btn-success" data-dismiss="modal">Cập nhật</button>');
							html="<p><b>Thêm câu hỏi vào trong bài kiểm tra</b></p>";
							html+='<div ><span style="float:right; margin-bottom:10px;"><input id="search_mng_qt"  style="min-width:250px" placeholder="Tìm kiếm câu hỏi" onkeyup="drawsearch_mng_qt_quiz(this,event)" value=""> ';
			                html+='<i class="pointer fas fa-search" onclick="drawsearch_mng_qt_btn_quiz()"></i></span><div>';
							html+='<table class="table table-bordered">';
							html+='<tr style="background-color: rgb(233, 235, 238);">';
							html+='<th></th><th>Câu hỏi<span>';
							html+='<select  style="float:right" onchange="drawlimit_mng_qt_quiz(this)">';
							html+='<option value="5">5 mục</option>';
							html+='<option value="10" selected>10 mục</option>';
							html+='<option value="15">15 mục</option>';
							html+='<option value="20">20 mục</option>';
							html+='<option value="25">25 mục</option>';
							html+='</select></span></th><th>';
							html+='<select style="width:60px" onchange="drawct_mng_qt_quiz(this)">';
							html+='<option>Danh mục</option>';
							html+='<option value="0">Tất cả</option>';
							for(i=0; i<categories.length; i++){ 
								html+='<option value="'+categories[i]['cid']+'"> '+categories[i]['category_name']+'</option>';
							} 
							html+='</select>';
							html+='</th><th>';
							html+='<select style="width:60px" onchange="drawlv_mng_qt_quiz(this)">';
							html+='<option>Cấp độ</option>';
							html+='<option value="0">Tất cả</option>';
							for(i=0; i<levels.length; i++){ 
								html+='<option value="'+levels[i]['lid']+'"> '+levels[i]['level_name']+'</option>';
							} 
							html+='</select>';
							html+='</th>';
							html+='<th>';
							html+='</th>';
						    html+='</tr>';
							for(i=0; i<questions.length; i++){ 
								html+='<tr >';
								html+='<td onclick="change_stt_qt(this,'+data['quid']+','+questions[i]['qid']+')" class="details-control" style="width:30px">';
								html+=	'</td> ';
								html+=	'<td>';
								html+=	'<b>';
								html+=	'<a class="pointer" onclick="mng_preview_qt_quiz('+questions[i]['qid']+')">';
								html+=	questions[i]['question'];
								html+='</a>';
								html+=	'</b>';	
								html+=	'</td>';
								html+=	'<td>';
								html+=	'<a class="pointer" onclick="drawct_mng_qt_link_quiz('+questions[i]['cid']+')">';
								html+=questions[i]['category_name'];
								html+='</a>';
								html+='</td>';
								html+='<td>';
								html+= '<a class="pointer" onclick="drawlv_mng_qt_link_quiz('+questions[i]['lid']+')">';
								html+=questions[i]['level_name'];
								html+='</a>';
								html+='</td>';
								html+='<td>';
								html+='<a onclick="mng_preview_qt_quiz('+questions[i]['qid']+')"><i class="pointer text-success fas fa-eye" title="Xem trước"></i></a>';
								html+='</td>';
								html+='</tr>';
				          }
						 
									
							
							html+='</table>';
							html+='<p>Đang xem <span id="beginqt">'+Math.min(results.limit*results.page+1,results.num_question)+'</span>';
							html+=' đến <span id="endqt">'+Math.min(results.limit*(results.page+1),results.num_question)+'</span>';
							html+=' trong tổng số <span id="totalqt">'+results.num_question+'</span> câu hỏi<p>';
							
							num_page = Math.ceil(results.num_question/results.limit);
							html+='<center>';
							html+='<ul class="pagination listpage pageqt">';
							if(num_page>6){
								html+='<li class="page-item active" onclick="drawpage_mng_qt_quiz(0)"><a class="page-link">1</a></li>';
								html+='<li class="page-item" onclick="drawpage_mng_qt_quiz(1)"><a class="page-link">2</a></li>';
								html+='<li class="page-item" onclick="drawpage_mng_qt_quiz(2)"><a class="page-link">3</a></li>';
								html+='<li class="page-item" onclick="drawpage_mng_qt_quiz(3)"><a class="page-link">4</a></li>';
								html+='<li class="page-item" onclick="drawpage_mng_qt_quiz(4)"><a class="page-link">5</a></li>';
								if(num_page>7){
									  html+='<li class="page-item"><a class="page-link">...</a></li>';
							    }
								html+='<li class="page-item" onclick="drawpage_mng_qt_quiz('+(num_page-1)+')"><a class="page-link">'+num_page+'</a></li>';
								}else{
									html+='<li class="page-item active" onclick="drawpage_mng_qt_quiz(0)"><a class="page-link">1</a></li>';
									for(i=1; i<num_page; i++){
									html+='<li class="page-item" onclick="drawpage_mng_qt_quiz('+i+')"><a class="page-link">'+(i+1)+'</a></li>';
									 }
							}									
							html+='</ul>';
							html+='</center>';
							$("#table_question_into_quiz").empty();
							$("#table_question_into_quiz").append(html);
							$('#btnCapnhat_quiz').on('click', function(e){
								if($("#inpquizname").val()!=""){
									
									$.ajax({
									type: "POST",
									data : $('#formAddQuiz').serialize(),
									url: base_url + "index.php/home_user/update_quiz_1/"+data['quid'],
									success: function(dataupd){
										alert("Tạo thành công bài kiểm tra!");
										window.location.href=site_url+"/home_user/quiz_list"
									},
									error:function(dataupd){}
									  
									});
								}
								else{
									alert("Vui lòng điền tên bài kiểm tra!");
								}
							});
						},
						error: function(xhr,status,strErr){
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}	
					});
		    	    }
					else{
						alert("Vui lòng điền tên bài kiểm tra!!");
					}
				});
		    }
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});
	//$("#quizModal").modal(); 
}
function compareDate(startdate, enddate){
	var now = new Date();
	var result = false;
	if(enddate > now && enddate > startdate){
		var timeDiff = Math.abs(enddate.getTime() - now.getTime()); 
		var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
		if(diffDays == 1){
			result = true;
		}
	}else{
		result = false;
	}
	return result;
	
}

function send_reminders(aid){
	console.log("send message");
	var aid = aid;
	var formData = {aid:aid};
	$.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/message/send_reminders/"+aid,
		success: function(results){
			console.log(results);
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});
}

function quizAssignTo(event){
	$("#main_bussiness").attr("style", "");
	$("#new_main_page").attr("style", "display:none");
	load_topmenu("quiz_menu");
	load_tab1();
	$('#home1').empty();
	if(su!=2)
		$('#text-tabs')[0].innerText = "Bài đã giao";
    else
		$('#text-tabs')[0].innerText = "Bài được giao";
	$('.line-L h1')[0].innerText = "Trắc nghiệm";
	//$('#home1').attr('style','display:block');
	var formData = {};
	$.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/home_user/quiz_assign/",
		success: function(results){
			console.log(results);
			$('#home1').append('<div id="data-grip" style=" height: 420px;"><div class="asscon"><div id="row-card" class="row"></div></div></div>');
			if(results.assign.length > 0){
			    for (var i = 0; i < results.assign.length; i++) {
			    	var html = '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" id="card' + results.assign[i].id + '">';
			    	if(results.assign[i].status == 1){
			    		html += '<div class="offer offer-danger" title="'+results.assign[i].quiz_name+'"><div class="shape"><div class="shape-text" title="Chưa làm!"><i class="fa fa-ban"></i></div></div>';
			    	}else{
			    		html += '<div class="offer offer-success" title="'+results.assign[i].quiz_name+'"><div class="shape"><div class="shape-text" title="Đã hoàn thành!"><i class="fa fa-check"></i></div></div>';
			    	}
					html += '<div class="offer-content"><h5 class="lead" title="'+results.assign[i].quiz_name+'">' + results.assign[i].quiz_name + '</h5><p>';
					html += '<i class="fa fa-user-secret"></i> Người giao: <br>' + results.assign[i].aname ;
					html += '<br> <i class="fa fa-user-circle"></i> Học sinh: <br>' + results.assign[i].first_name ;
					var startdate = new Date(results.assign[i].startdate.replace(' ', 'T'));
					var dateshow = startdate.getDate()+'-'+(startdate.getMonth() + 1)+'-'+startdate.getFullYear(); 
					html += '<br><i class="fa fa-calendar-minus"></i> Ngày bắt đầu: <br>' + dateshow;
					var enddate = results.assign[i].enddate != null ? new Date(results.assign[i].enddate.replace(' ', 'T')) : "";
					if(enddate != ""){
						var enddateshow = enddate.getDate()+'-'+(enddate.getMonth() + 1)+'-'+enddate.getFullYear();
						html += '<br> <i class="fa fa-calendar-check"></i> Ngày kết thúc: <br>'  + enddateshow; 

						if(results.user.su == "2" && compareDate(startdate, enddate) && results.assign[i].status == 1){
							send_reminders(results.assign[i].id);
						}
					}
					                 
					// html += '</p><p style="text-align:right">';
					if(results.user.quiz.includes("Assign")){
						if(results.assign[i].status == 1){
							html += '<a href="#" onclick="send_reminders(' + results.assign[i].id + ')" title=""><button class="btn btn-danger">Nhắc nhở</button></a>&nbsp;';
							html += '<a href="#" onclick="delete_assign(' + results.assign[i].id + ',' + results.assign[i].quid + ','+ results.assign[i].auid +','+ results.assign[i].uid +')"><button class="btn btn-default btn-lambai">Hủy</button></a>';
						}else{
							html += '<a href="'+base_url+'index.php/result/view_result/'+ results.assign[i].rid +'"><button class="btn btn-success">Xem kết quả</button></a>';	
						}
						
					}else{
						if(results.assign[i].status == 1){
							html += '<a href="'+base_url+'index.php/quiz/validate_quizs/' + results.assign[i].quid + '/'+ results.assign[i].auid +'/'+results.assign[i].id+'" title=""><button class="btn btn-danger btn-lambai">Làm bài</button></a>&nbsp;';
						}else{
							
							html += '<a href="'+base_url+'index.php/result/view_result/'+ results.assign[i].rid +'"><button class="btn btn-success">Xem kết quả</button></a>';	
						}
					}
					html += '</p></div></div></div>';
					if($(window).width()>767){
						var heigth = Math.ceil(results.assign.length/3)*350;
					}
					else{
						var heigth = results.assign.length*320;
					}
					$('#data-grip').attr('style','height: '+heigth+'px');
			    	$('#row-card').prepend(html);
			    }
			}else{
				if(results.user.quiz.includes("Assign")){
					$('#row-card').prepend('<div class="MT10" style="text-align: center;">Hiện tại bạn đang không có bài đã giao.</div>');
				}else{
					$('#row-card').prepend('<div class="MT10" style="text-align: center;">Hiện tại bạn đang không có bài được giao.</div>');
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

function delete_assign(id,quid,auid,uid){
	if(confirm("Bạn có chắc muốn hủy bài giao này?")){
		close_assign(id,quid,auid,uid);
	}
	return true;
}

function redraw_assign_quiz(event,cid,arr,search){
	uidz=$(event).val();
	quizAssignTo_1(0,uidz,cid,arr,search);
	
}
function redraw2_assign_quiz(event,uidz,arr,search){
	cid =$(event).val();
	quizAssignTo_1(0,uidz,cid,arr,search);
}
function redraw3_assign_quiz(event,uidz,cid,search){
	arr =$(event).val();
	quizAssignTo_1(0,uidz,cid,arr,search);
}
function redrawsearch_assign_quiz(event,e,uidz,cid,arr){
	 if(e.keyCode=='13'){
     	search= $(event).val();
		quizAssignTo_1(0,uidz,cid,arr,search);
	 }		
}
function redrawsearch_assign_quiz1(page,uidz,cid,arr,search){
	search=$("#search_assign_quiz1").val();
	quizAssignTo_1(0,uidz,cid,arr,search);
}


function quizAssignTo_1(page,uidz,cid,arr,search){
	$('body,html').animate({
				scrollTop: 0
			})
	
	$('#home1').empty();
		$("#home1").append('<div id="circularG"><div id="circularG_1" class="circularG"></div><div id="circularG_2" class="circularG"></div><div id="circularG_3" class="circularG"></div><div id="circularG_4" class="circularG"></div><div id="circularG_5" class="circularG"></div><div id="circularG_6" class="circularG"></div><div id="circularG_7" class="circularG"></div><div id="circularG_8" class="circularG"></div></div>');	
	
	
   
	$.ajax({
	 	type: "POST",
		data : {search:search},
		url: base_url + "index.php/home_user/quiz_assign_4/"+page +"/"+ uidz +"/"+ cid +"/"+ arr ,
		success: function(results){
			// console.log(results);
			// console.log(results.user);
			var m= ["Tổ hợp","","","Toán","Vật Lý","Hóa học","Địa lý","Tin Học","Sinh học","Khoa học","Lịch sử","Công nghệ","Tiếng Anh","Thiên văn - vũ trụ","Robot","Môi trường","Sức khỏe","Văn học","Tiếng Việt","Xã hội","Test IQ","Giáo dục công dân","Tự nhiên và xã hội"];
			var n= ["Trạng thái","Đã trả lời","Chưa trả lời"];
			var html='<br><div ><div class="col-sm-3" style="margin-top:5px"><select style="width:120px; display:none" onchange="redraw_assign_quiz(this,'+cid+','+arr+',\''+search+'\')"><option value="0">';
			if(su!=2){
				html += 'Học sinh';
			}
			else{
				html += 'Người giao';
			}
			html +='</option><option value="0">Tất cả</option>';
			for(i=0; i<results.assign.student.length; i++){
				  html +='<option ';
				 if(uidz==results.assign.student[i]['uid'])
					  html +=" selected ";
				  html +='value="'+results.assign.student[i]['uid']+'">'+results.assign.student[i]['first_name']+'</option>';
			  }
			  
			 html += '</select></div>';
			 
			 html += '<div class="col-sm-3" style="margin-top:5px"><select style="width:120px;display:none"  onchange="redraw2_assign_quiz(this,'+uidz+','+arr+',\''+search+'\')">';
			 html+='<option value="1">Môn</option><option value="1">Tất cả</option>';
			 if(cid==1){
				  html+=" selected ";
			  html+=' value="1">Tất cả</option>';
			  }
			  for(i=0; i<m.length; i++){
				  if(i!=1  && i!=2){
					  html+='<option ';
					  if(i==cid)
						  html+=" selected ";
					  html+='value="'+i+'">'+m[i]+'</option>';
				  }
			  }
			 
			 
			 
			 html += '</select></div>';
			 html += '<div class="col-sm-3" style="margin-top:5px"><select style="width:120px;display:none"  onchange="redraw3_assign_quiz(this,'+uidz+','+cid+',\''+search+'\')" >';
			 for(i=0; i<n.length; i++){
				  html+='<option ';
				 if(i==arr)
					  html+=" selected ";
				  html+='value="'+i+'">'+n[i]+'</option>';
			  }
			 html += '</select></div>';			 
			 html += '<div class="col-sm-3" style="margin-top:5px"><input style="width:120px;display:none" id="search_assign_quiz1" value= "'+search+'" onkeyup="redrawsearch_assign_quiz(this,event,'+uidz+','+cid+','+arr+')"></input>';
			 html += '<span style="display:none"><i class="pointer fas fa-search" onclick="redrawsearch_assign_quiz1('+page+','+uidz+','+cid+','+arr+',\''+search+'\')"></i></span></div>';
			 html +='<div id="data-grip"><div class="asscon"><div id="row-card" class="row"></div></div></div></div>';
			$('#home1').append(html);
			html='';

			
			
			if(results.assign.quiz.length > 0){
				

			    for (var i = results.assign.quiz.length-1; i >=0; i--) {

			    	var html = '<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 asign-item" id="card' + results.assign.quiz[i].id + '">';
			    	if(results.assign.quiz[i].sta == 1){
			    		html += '<div class="offer offer-danger" title="'+results.assign.quiz[i].quiz_name+'"><div class="shape"><div class="shape-text" title="Chưa làm!"><i class="fa fa-ban"></i></div></div>';
			    	}else{
			    		html += '<div class="offer offer-success" title="'+results.assign.quiz[i].quiz_name+'"><div class="shape"><div class="shape-text" title="Đã hoàn thành!"><i class="fa fa-check"></i></div></div>';
			    	}
					
					html += ''+results.assign.quiz[i].avatar+'';

					html += '<div class="offer-content"><h5 class="lead" title="'+results.assign.quiz[i].quiz_name+'">' + results.assign.quiz[i].quiz_name + '</h5><p>';
					html +='<div class="col-md-12 p0">';
	
					
					
						var startdate = new Date(results.assign.quiz[i].startdate.replace(' ', 'T'));
						var dateshow = startdate.getDate()+'-'+(startdate.getMonth() + 1)+'-'+startdate.getFullYear(); 

						var end_time = results.assign.quiz[i].end_time;

						var enddate = results.assign.quiz[i].enddate != null ? new Date(results.assign.quiz[i].enddate.replace(' ', 'T')) : "";
						if(enddate != ""){
							var enddateshow = enddate.getDate()+'-'+(enddate.getMonth() + 1)+'-'+enddate.getFullYear();
							// html += '<br> <i class="color-blue far fa-clock"></i> Ngày kết thúc: <span class="text-strong">'  + enddateshow +'</span>'; 

							if(results.user.su == "2" && compareDate(startdate, enddate) && results.assign.quiz[i].sta == 1){
								send_reminders(results.assign.quiz[i].id);
							}
						}
				
					html+='</div>';
					html+='<div class="col-md-12 p0">';
					var loai_bai;
						if(results.assign.quiz[i].level_hard=='0' || results.assign.quiz[i].level_hard==null){
							loai_bai='Bài được giao';
						}
						if(results.assign.quiz[i].level_hard>=1 && results.assign.quiz[i].level_hard<=3){
							loai_bai='HCC';
						}
						if(results.assign.quiz[i].level_hard>=4 && results.assign.quiz[i].level_hard<=6){
							loai_bai='KNS';
						}
					if(results.assign.quiz[i].sta == 1){
						html+='<i class="color-blue fas fa-clock"></i> Ngày giao: <span class="text-strong">' + dateshow + '</span>';
						html+='<br>';
			    		html+='<i class="color-blue fas fa-address-book"></i> Loại bài: <span class="text-strong">'+ loai_bai +'</span><br>';
						html+='<i class="color-blue fas fa-trophy"></i> Thưởng tối đa: <span class="text-strong">'+ results.assign.quiz[i].reward_point +' <i class="fa fa-star orange" aria-hidden="true"></i> </span>';
			    	}else{
						html+='<i class="color-blue fas fa-clock"></i> Ngày làm: <span class="text-strong">' + end_time + '</span>';	
						html+='<br>';
						html+='<i class="color-blue fas fa-chart-bar"></i> Kết quả: <span class="text-strong">'+ Math.ceil(results.assign.quiz[i].percentage_obtained) +'% </span><br>';		
						html+='<i class="color-blue fas fa-trophy"></i>Được thưởng: ';		

						html+= '<span class="text-strong">'+ Math.ceil((results.assign.quiz[i].percentage_obtained * results.assign.quiz[i].reward_point)/100) +' <i class="fa fa-star orange" aria-hidden="true"></i></span><br>';
						
			    	}
					
					html+='</div>';
					html+='<div class="col-md-12 text-center p0">';
					

						if(results.assign.quiz[i].sta == 1){
							html += '<a href="'+base_url+'index.php/quiz/validate_quizs/' + results.assign.quiz[i].quid + '/'+ results.assign.quiz[i].auid +'/'+results.assign.quiz[i].id+'" title=""><button class="btn btn-danger btn-lambai" onclick="do_homework('+results.assign.quiz[i].quid+','+results.assign.quiz[i].auid+')">Làm bài</button></a>';
						}else{
							// html += '<a href="'+base_url+'index.php/result/view_result/'+ results.assign.quiz[i].rid +'"><button class="btn btn-success btn-lamlai">Làm lại</button></a>';
							html += '<a href="'+base_url+'index.php/result/view_result/'+ results.assign.quiz[i].rid +'"><button class="btn btn-success btn-xemketqua">Xem kết quả</button></a>';	
						}
					
					html+='</div>';

					
					                 
					
					html += '</div></div></div>';

					
			    	$('#row-card').prepend(html);
					
			    }
				 html_page='<div class="col-xs-12"><center><ul class="pagination listpage pageqt">';
					if(results.assign.num_page<=6){
						for(i=0; i<results.assign.num_page; i++){
							html_page+='<li class="page-item';
							if(i==page){
							html_page+=' active';
							}
							html_page+='" onclick="quizAssignTo_1('+i+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+(i+1)+'</a></li>';
						}
					}

                    else{
						 if(page<=3){
							  for(i=0; i<5; i++){
								  html_page+='<li class="page-item';
								  if(i==page){
									   html_page+=' active';
								  }
								  html_page+='" onclick="quizAssignTo_1('+i+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+(i+1)+'</a></li>'
							  }
							  html_page+='<li class="page-item"><a class="page-link">...</a></li>';
							  html_page+='<li class="page-item" onclick="quizAssignTo_1('+(results.assign.num_page-1)+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+results.assign.num_page+'</a></li>';
						  }
						  else{
							  html_page+='<li class="page-item" onclick="quizAssignTo_1(0,'+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">1</a></li>';
							  html_page+='<li class="page-item"><a class="page-link">...</a></li>';
							  
							  if(page<results.assign.num_page-4){
								  html_page+='<li class="page-item" onclick="quizAssignTo_1('+(page-1)+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+page+'</a></li>';
								  html_page+='<li class="page-item active" onclick="quizAssignTo_1('+page+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+(page+1)+'</a></li>';
								  html_page+='<li class="page-item" onclick="quizAssignTo_1('+(page+1)+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+(page+2)+'</a></li>';
								  html_page+='<li class="page-item"><a class="page-link">...</a></li>';
								  html_page+='<li class="page-item" onclick="quizAssignTo_1('+(results.assign.num_page-1)+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+results.assign.num_page+'</a></li>';
							  }
							  else{
								  for(i=page-2; i<results.assign.num_page; i++){
									  html_page+='<li class="page-item';
									  if(i==page){
										  html_page+=" active";
									  }
									  html_page+='" onclick="quizAssignTo_1('+i+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+(i+1)+'</a></li>';
								  }
								  
							  }
						  }
						
					}					
							
					 html_page+='<ul></center></div>';
					 $("#circularG").remove();		
					$('#row-card').append(html_page);   
			}else{
				
				$('#row-card').prepend('<div class="MT10" style="text-align: center;">Hiện tại bạn không có hoạt động được giao.</div>');
				
			}
			$("#circularG").remove();
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});
	
	
	
}

function quizAssignTo_done(page,uidz,cid,arr,search){
	$('body,html').animate({
				scrollTop: 0
			})
	
	$('#home4').empty();
		$("#home4").append('<div id="circularGG"><div id="circularGG_1" class="circularGG"></div><div id="circularGG_2" class="circularGG"></div><div id="circularGG_3" class="circularGG"></div><div id="circularGG_4" class="circularGG"></div><div id="circularGG_5" class="circularGG"></div><div id="circularGG_6" class="circularGG"></div><div id="circularGG_7" class="circularGG"></div><div id="circularGG_8" class="circularGG"></div></div>');	
	
	
   
	$.ajax({
	 	type: "POST",
		data : {search:search},
		url: base_url + "index.php/home_user/quiz_assign_5/"+page +"/"+ uidz +"/"+ cid +"/"+ arr ,
		success: function(results){
			// console.log(results);
			// console.log(results.user);
			var m= ["Tổ hợp","","","Toán","Vật Lý","Hóa học","Địa lý","Tin Học","Sinh học","Khoa học","Lịch sử","Công nghệ","Tiếng Anh","Thiên văn - vũ trụ","Robot","Môi trường","Sức khỏe","Văn học","Tiếng Việt","Xã hội","Test IQ","Giáo dục công dân","Tự nhiên và xã hội"];
			var n= ["Trạng thái","Đã trả lời","Chưa trả lời"];
			var html='<br><div ><div class="col-sm-3" style="margin-top:5px"><select style="width:120px; display:none" onchange="redraw_assign_quiz_done(this,'+cid+','+arr+',\''+search+'\')"><option value="0">';
			if(su!=2){
				html += 'Học sinh';
			}
			else{
				html += 'Người giao';
			}
			html +='</option><option value="0">Tất cả</option>';
			for(i=0; i<results.assign.student.length; i++){
				  html +='<option ';
				 if(uidz==results.assign.student[i]['uid'])
					  html +=" selected ";
				  html +='value="'+results.assign.student[i]['uid']+'">'+results.assign.student[i]['first_name']+'</option>';
			  }
			  
			 html += '</select></div>';
			 
			 html += '<div class="col-sm-3" style="margin-top:5px"><select style="width:120px;display:none"  onchange="redraw2_assign_quiz_done(this,'+uidz+','+arr+',\''+search+'\')">';
			 html+='<option value="1">Môn</option><option value="1">Tất cả</option>';
			 if(cid==1){
				  html+=" selected ";
			  html+=' value="1">Tất cả</option>';
			  }
			  for(i=0; i<m.length; i++){
				  if(i!=1  && i!=2){
					  html+='<option ';
					  if(i==cid)
						  html+=" selected ";
					  html+='value="'+i+'">'+m[i]+'</option>';
				  }
			  }
			 
			 
			 
			 html += '</select></div>';
			 html += '<div class="col-sm-3" style="margin-top:5px"><select style="width:120px;display:none"  onchange="redraw3_assign_quiz_done(this,'+uidz+','+cid+',\''+search+'\')" >';
			 for(i=0; i<n.length; i++){
				  html+='<option ';
				 if(i==arr)
					  html+=" selected ";
				  html+='value="'+i+'">'+n[i]+'</option>';
			  }
			 html += '</select></div>';			 
			 html += '<div class="col-sm-3 " style="margin-top:5px"><input style="width:120px;display:none" id="search_assign_quiz1_done" value= "'+search+'" onkeyup="redrawsearch_assign_quiz_done(this,event,'+uidz+','+cid+','+arr+')"></input>';
			 html += '<span style="display:none"><i class="pointer fas fa-search" onclick="redrawsearch_assign_quiz1_done('+page+','+uidz+','+cid+','+arr+',\''+search+'\')"></i></span></div>';
			 html +='<div id="data-grip_done"><div class="asscon"><div id="row-card_done" class="row"></div></div></div></div>';
			$('#home4').append(html);
			html='';
			if(results.assign.quiz.length > 0){
			    for (var i = results.assign.quiz.length-1; i >=0; i--) {
			    	var html = '<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 asign-item" id="card' + results.assign.quiz[i].id + '">';
			    	if(results.assign.quiz[i].sta == 1){
			    		html += '<div class="offer offer-danger" title="'+results.assign.quiz[i].quiz_name+'"><div class="shape"><div class="shape-text" title="Chưa làm!"><i class="fa fa-ban"></i></div></div>';
			    	}else{
			    		html += '<div class="offer offer-success" title="'+results.assign.quiz[i].quiz_name+'"><div class="shape"><div class="shape-text" title="Đã hoàn thành!"><i class="fa fa-check"></i></div></div>';
			    	}
					
					html += ''+results.assign.quiz[i].avatar+'';

					html += '<div class="offer-content"><h5 class="lead" title="'+results.assign.quiz[i].quiz_name+'">' + results.assign.quiz[i].quiz_name + '</h5><p>';
					html +='<div class="col-md-12 p0">';
									
					
						var startdate = new Date(results.assign.quiz[i].startdate.replace(' ', 'T'));
						var dateshow = startdate.getDate()+'-'+(startdate.getMonth() + 1)+'-'+startdate.getFullYear(); 

						var end_time = results.assign.quiz[i].end_time;
						
						var enddate = results.assign.quiz[i].enddate != null ? new Date(results.assign.quiz[i].enddate.replace(' ', 'T')) : "";
						if(enddate != ""){
							var enddateshow = enddate.getDate()+'-'+(enddate.getMonth() + 1)+'-'+enddate.getFullYear();

							if(results.user.su == "2" && compareDate(startdate, enddate) && results.assign.quiz[i].sta == 1){
								send_reminders(results.assign.quiz[i].id);
							}
					
					
					
					html+='</div>';
					html+='<div class="col-md-12">';
					var loai_bai;
						if(results.assign.quiz[i].level_hard=='0' || results.assign.quiz[i].level_hard==null){
							loai_bai='Bài được giao';
						}
						if(results.assign.quiz[i].level_hard>=1 && results.assign.quiz[i].level_hard<=3){
							loai_bai='HCC';
						}
						if(results.assign.quiz[i].level_hard>=4 && results.assign.quiz[i].level_hard<=6){
							loai_bai='KNS';
						}

						
			    		html+='<i class="color-blue fas fa-clock"></i> Ngày làm: <span class="text-strong">' + end_time + '</span>';	
						html+='<br>';
						html+='<i class="color-blue fas fa-chart-bar"></i> Kết quả: <span class="text-strong">'+ Math.ceil(results.assign.quiz[i].percentage_obtained) +'% </span><br>';		
						html+='<i class="color-blue fas fa-trophy"></i>Được thưởng: ';		

						html+= '<span class="text-strong">'+ Math.ceil((results.assign.quiz[i].percentage_obtained * results.assign.quiz[i].reward_point)/100) +' <i class="fa fa-star orange" aria-hidden="true"></i></span><br>';
						
						
			    	}
					
					html+='</div>';
					html+='<div class="col-md-12 text-center">';
					

						if(results.assign.quiz[i].sta == 1){
							html += '<a href="'+base_url+'index.php/quiz/validate_quizs/' + results.assign.quiz[i].quid + '/'+ results.assign.quiz[i].auid +'/'+results.assign.quiz[i].id+'" title=""><button class="btn btn-danger btn-lambai">Làm bài</button></a>&nbsp;';
						}else{
							// html += '<a href="'+base_url+'index.php/result/view_result/'+ results.assign.quiz[i].rid +'"><button class="btn btn-success btn-lamlai">Làm lại</button></a>';
							html += '<a href="'+base_url+'index.php/result/view_result/'+ results.assign.quiz[i].rid +'"><button class="btn btn-success btn-xemketqua">Xem kết quả</button></a>';	
						}
					
					html+='</div>';

					
					                 
					
					html += '</div></div></div>';

					
			    	$('#row-card_done').prepend(html);
					
			    }
				 html_page='<div class="col-xs-12"><center><ul class="pagination listpage pageqt">';
					if(results.assign.num_page<=6){
						for(i=0; i<results.assign.num_page; i++){
							html_page+='<li class="page-item';
							if(i==page){
							html_page+=' active';
							}
							html_page+='" onclick="quizAssignTo_done('+i+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+(i+1)+'</a></li>';
						}
					}

                    else{
						 if(page<=3){
							  for(i=0; i<5; i++){
								  html_page+='<li class="page-item';
								  if(i==page){
									   html_page+=' active';
								  }
								  html_page+='" onclick="quizAssignTo_done('+i+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+(i+1)+'</a></li>'
							  }
							  html_page+='<li class="page-item"><a class="page-link">...</a></li>';
							  html_page+='<li class="page-item" onclick="quizAssignTo_done('+(results.assign.num_page-1)+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+results.assign.num_page+'</a></li>';
						  }
						  else{
							  html_page+='<li class="page-item" onclick="quizAssignTo_done(0,'+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">1</a></li>';
							  html_page+='<li class="page-item"><a class="page-link">...</a></li>';
							  
							  if(page<results.assign.num_page-4){
								  html_page+='<li class="page-item" onclick="quizAssignTo_done('+(page-1)+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+page+'</a></li>';
								  html_page+='<li class="page-item active" onclick="quizAssignTo_done('+page+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+(page+1)+'</a></li>';
								  html_page+='<li class="page-item" onclick="quizAssignTo_done('+(page+1)+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+(page+2)+'</a></li>';
								  html_page+='<li class="page-item"><a class="page-link">...</a></li>';
								  html_page+='<li class="page-item" onclick="quizAssignTo_done('+(results.assign.num_page-1)+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+results.assign.num_page+'</a></li>';
							  }
							  else{
								  for(i=page-2; i<results.assign.num_page; i++){
									  html_page+='<li class="page-item';
									  if(i==page){
										  html_page+=" active";
									  }
									  html_page+='" onclick="quizAssignTo_done('+i+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+(i+1)+'</a></li>';
								  }
								  
							  }
						  }
						
					}					
							
					 html_page+='<ul></center></div>';
					 $("#circularGG").remove();		
					$('#row-card_done').append(html_page);   
			}else{
				
				
					$('#row-card_done').prepend('<div class="MT10" style="text-align: center;">Hiện tại bạn không có hoạt động đã làm giao.</div>');
				
			}
			$("#circularGG").remove();
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});
}


function quizAssignTo_undone(page,uidz,cid,arr,search){
	$('body,html').animate({
				scrollTop: 0
			})
	
	$('#home5').empty();
		$("#home5").append('<div id="circularGGG"><div id="circularGGG_1" class="circularGGG"></div><div id="circularGGG_2" class="circularGGG"></div><div id="circularGGG_3" class="circularGGG"></div><div id="circularGGG_4" class="circularGGG"></div><div id="circularGGG_5" class="circularGGG"></div><div id="circularGGG_6" class="circularGGG"></div><div id="circularGGG_7" class="circularGGG"></div><div id="circularGGG_8" class="circularGGG"></div></div>');	
	
	
   
	$.ajax({
	 	type: "POST",
		data : {search:search},
		url: base_url + "index.php/home_user/quiz_assign_6/"+page +"/"+ uidz +"/"+ cid +"/"+ arr ,
		success: function(results){
			// console.log(results);
			// console.log(results.user);
			var m= ["Tổ hợp","","","Toán","Vật Lý","Hóa học","Địa lý","Tin Học","Sinh học","Khoa học","Lịch sử","Công nghệ","Tiếng Anh","Thiên văn - vũ trụ","Robot","Môi trường","Sức khỏe","Văn học","Tiếng Việt","Xã hội","Test IQ","Giáo dục công dân","Tự nhiên và xã hội"];
			var n= ["Trạng thái","Đã trả lời","Chưa trả lời"];
			var html='<br><div ><div class="col-sm-3" style="margin-top:5px"><select style="width:120px; display:none" onchange="redraw_assign_quiz_undone(this,'+cid+','+arr+',\''+search+'\')"><option value="0">';
			if(su!=2){
				html += 'Học sinh';
			}
			else{
				html += 'Người giao';
			}
			html +='</option><option value="0">Tất cả</option>';
			for(i=0; i<results.assign.student.length; i++){
				  html +='<option ';
				 if(uidz==results.assign.student[i]['uid'])
					  html +=" selected ";
				  html +='value="'+results.assign.student[i]['uid']+'">'+results.assign.student[i]['first_name']+'</option>';
			  }
			  
			 html += '</select></div>';
			 
			 html += '<div class="col-sm-3" style="margin-top:5px"><select style="width:120px;display:none"  onchange="redraw2_assign_quiz_undone(this,'+uidz+','+arr+',\''+search+'\')">';
			 html+='<option value="1">Môn</option><option value="1">Tất cả</option>';
			 if(cid==1){
				  html+=" selected ";
			  html+=' value="1">Tất cả</option>';
			  }
			  for(i=0; i<m.length; i++){
				  if(i!=1  && i!=2){
					  html+='<option ';
					  if(i==cid)
						  html+=" selected ";
					  html+='value="'+i+'">'+m[i]+'</option>';
				  }
			  }
			 
			 
			 
			 html += '</select></div>';
			 html += '<div class="col-sm-3" style="margin-top:5px"><select style="width:120px;display:none"  onchange="redraw3_assign_quiz_undone(this,'+uidz+','+cid+',\''+search+'\')" >';
			 for(i=0; i<n.length; i++){
				  html+='<option ';
				 if(i==arr)
					  html+=" selected ";
				  html+='value="'+i+'">'+n[i]+'</option>';
			  }
			 html += '</select></div>';			 
			 html += '<div class="col-sm-3" style="margin-top:5px"><input style="width:120px;display:none" id="search_assign_quiz1_undone" value= "'+search+'" onkeyup="redrawsearch_assign_quiz_undone(this,event,'+uidz+','+cid+','+arr+')"></input>';
			 html += '<span style="display:none"><i class="pointer fas fa-search" onclick="redrawsearch_assign_quiz1_undone('+page+','+uidz+','+cid+','+arr+',\''+search+'\')"></i></span></div>';
			 html +='<div id="data-grip_undone"><div class="asscon"><div id="row-card_undone" class="row"></div></div></div></div>';
			$('#home5').append(html);
			html='';
			if(results.assign.quiz.length > 0){
			    for (var i = results.assign.quiz.length-1; i >=0; i--) {

			    	var html = '<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 asign-item" id="card' + results.assign.quiz[i].id + '">';
			    	if(results.assign.quiz[i].sta == 1){
			    		html += '<div class="offer offer-danger" title="'+results.assign.quiz[i].quiz_name+'"><div class="shape"><div class="shape-text" title="Chưa làm!"><i class="fa fa-ban"></i></div></div>';
			    	}else{
			    		html += '<div class="offer offer-success" title="'+results.assign.quiz[i].quiz_name+'"><div class="shape"><div class="shape-text" title="Đã hoàn thành!"><i class="fa fa-check"></i></div></div>';
			    	}
					
					html += ''+results.assign.quiz[i].avatar+'';

					html += '<div class="offer-content"><h5 class="lead" title="'+results.assign.quiz[i].quiz_name+'">' + results.assign.quiz[i].quiz_name + '</h5><p>';
					html +='<div class="col-md-12 p0">';
	
					
					
						var startdate = new Date(results.assign.quiz[i].startdate.replace(' ', 'T'));
						var dateshow = startdate.getDate()+'-'+(startdate.getMonth() + 1)+'-'+startdate.getFullYear(); 

						var end_time = results.assign.quiz[i].end_time;

						var enddate = results.assign.quiz[i].enddate != null ? new Date(results.assign.quiz[i].enddate.replace(' ', 'T')) : "";
						if(enddate != ""){
							var enddateshow = enddate.getDate()+'-'+(enddate.getMonth() + 1)+'-'+enddate.getFullYear();
							// html += '<br> <i class="color-blue far fa-clock"></i> Ngày kết thúc: <span class="text-strong">'  + enddateshow +'</span>'; 

							if(results.user.su == "2" && compareDate(startdate, enddate) && results.assign.quiz[i].sta == 1){
								send_reminders(results.assign.quiz[i].id);
							}
						}
				
					html+='</div>';
					html+='<div class="col-md-12 p0">';
					var loai_bai;
						if(results.assign.quiz[i].level_hard=='0' || results.assign.quiz[i].level_hard==null){
							loai_bai='Bài được giao';
						}
						if(results.assign.quiz[i].level_hard>=1 && results.assign.quiz[i].level_hard<=3){
							loai_bai='HCC';
						}
						if(results.assign.quiz[i].level_hard>=4 && results.assign.quiz[i].level_hard<=6){
							loai_bai='KNS';
						}
					
						html+='<i class="color-blue fas fa-clock"></i> Ngày giao: <span class="text-strong">' + dateshow + '</span>';
						html+='<br>';
			    		html+='<i class="color-blue fas fa-address-book"></i> Loại bài: <span class="text-strong">'+ loai_bai +'</span><br>';
						html+='<i class="color-blue fas fa-trophy"></i> Thưởng tối đa: <span class="text-strong">'+ results.assign.quiz[i].reward_point +' <i class="fa fa-star orange" aria-hidden="true"></i> </span>';
			    
					
					html+='</div>';
					html+='<div class="col-md-12 text-center p0">';
					

					
						html += '<a href="'+base_url+'index.php/quiz/validate_quizs/' + results.assign.quiz[i].quid + '/'+ results.assign.quiz[i].auid +'/'+results.assign.quiz[i].id+'" title=""><button class="btn btn-danger btn-lambai" onclick="do_homework('+results.assign.quiz[i].quid+','+results.assign.quiz[i].auid+')">Làm bài</button></a>';
						
					
					html+='</div>';

					
					                 
					
					html += '</div></div></div>';

					
			    	$('#row-card_undone').prepend(html);
					
			    }
				 html_page='<div class="col-xs-12"><center><ul class="pagination listpage pageqt">';
					if(results.assign.num_page<=6){
						for(i=0; i<results.assign.num_page; i++){
							html_page+='<li class="page-item';
							if(i==page){
							html_page+=' active';
							}
							html_page+='" onclick="quizAssignTo_undone('+i+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+(i+1)+'</a></li>';
						}
					}

                    else{
						 if(page<=3){
							  for(i=0; i<5; i++){
								  html_page+='<li class="page-item';
								  if(i==page){
									   html_page+=' active';
								  }
								  html_page+='" onclick="quizAssignTo_undone('+i+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+(i+1)+'</a></li>'
							  }
							  html_page+='<li class="page-item"><a class="page-link">...</a></li>';
							  html_page+='<li class="page-item" onclick="quizAssignTo_undone('+(results.assign.num_page-1)+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+results.assign.num_page+'</a></li>';
						  }
						  else{
							  html_page+='<li class="page-item" onclick="quizAssignTo_undone(0,'+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">1</a></li>';
							  html_page+='<li class="page-item"><a class="page-link">...</a></li>';
							  
							  if(page<results.assign.num_page-4){
								  html_page+='<li class="page-item" onclick="quizAssignTo_undone('+(page-1)+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+page+'</a></li>';
								  html_page+='<li class="page-item active" onclick="quizAssignTo_undone('+page+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+(page+1)+'</a></li>';
								  html_page+='<li class="page-item" onclick="quizAssignTo_undone('+(page+1)+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+(page+2)+'</a></li>';
								  html_page+='<li class="page-item"><a class="page-link">...</a></li>';
								  html_page+='<li class="page-item" onclick="quizAssignTo_undone('+(results.assign.num_page-1)+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+results.assign.num_page+'</a></li>';
							  }
							  else{
								  for(i=page-2; i<results.assign.num_page; i++){
									  html_page+='<li class="page-item';
									  if(i==page){
										  html_page+=" active";
									  }
									  html_page+='" onclick="quizAssignTo_undone('+i+','+uidz+','+cid+','+arr+',\''+search+'\')"><a class="page-link">'+(i+1)+'</a></li>';
								  }
								  
							  }
						  }
						
					}					
							
					 html_page+='<ul></center></div>';
					 $("#circularGGG").remove();		
					$('#row-card_undone').append(html_page);   
			}else{
				
				
				$('#row-card_undone').prepend('<div class="MT10" style="text-align: center;">Hiện tại bạn không có hoạt động chưa làm.</div>');
				
			}
			$("#circularGGG").remove();
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});
}




function abc(){
	delete_assign(id,quid,auid,uid)
	quizAssignTo_1(page,uidz,cid,arr,search);
}

function close_assign(cardid, quid, auid, uid){
	var formData = {
		quid:quid,
		auid:auid,
		uid:uid
	};
	$.ajax({
		 type: "POST",
		 data : formData,
			url: base_url+'index.php/home_user/close_assign/' + quid + '/'+ auid +'/'+ uid,
		success: function(data){
			if(data.result == "success"){
				$('#card'+cardid).remove();
			}
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}	
	});
}

function checkItem(event){
	$("#main_bussiness").attr("style", "");
	$("#new_main_page").attr("style", "display:none");
	load_topmenu("quiz_menu");
	load_tab1();
	$('#home1').empty();
	$('#text-tabs')[0].innerText = "Kiểm tra";
	$('.line-L h1')[0].innerText = "Trắc nghiệm";
	$('#home1').attr('style','display:block');
	var formData = {};
	$.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/home_user/manage_quiz/",
		success: function(results){
			//console.log(results);
		    var cc=0;
			var colorcode=['danger', 'warning', 'info', 'success'];
			$('#home1').append('<div id="addQuiz"  class="option-display pull-right"><div class="show-list active" title="Hiện thị theo danh sách"><i class="fas fa-th-list"></i></div><div class="show-grid active" title="Hiện thị theo dạng thẻ"><i class="fas fa-th"></i></div></div><div id="data-grip" style=" height: 420px;"></div><div id="data-grip-pagination"><a id="data-grip-previous" href="#">&laquo; Trước</a>&nbsp;&nbsp;<a id="data-grip-next" href="#">Sau &raquo;</a></div>');
		    if(results.data.length > 0){
		    	for (var i = 0; i < results.data.length; i++) {
			    	var rating = results.data[i].rvalue / results.data[i].rrating;
			    	if(isNaN(rating)){
			    		rating = 0;
			    	}
			    	var reviewervalue = 0;
			    	var reviewercontent = "";
			    	var reid = 0;
			    	var reviewcount = results.data[i].reviewcount;
			    	var reviewcountstr = reviewcount + " người đã đánh giá.";
			    	if(results.data[i].reviewer !== null){
			    		if(results.data[i].reviewer.includes(results.user.uid)){
				    		reviewervalue = results.data[i].reviewervalue;
				    		reviewercontent = results.data[i].reviewercontent;
				    		reid = results.data[i].reid;
				    	}
			    	}
			    	
			    	var html = '<div class="col-md-4 text-center" style="margin-top: 10px;">';
			    	html += '<div class="panel panel-'+ colorcode[cc] +' panel-pricing">';
			    	html += '<div class="panel-heading" title="' + results.data[i].quiz_name + '">';
			    	html += '<a href="javascript:void(0);" onmouseup="rating_item('+ results.data[i].quid +', \'savsoft_quiz\','+reid+','+reviewervalue+',\''+reviewercontent+'\');" title="'+reviewcountstr+'"><input id="result-rating'+results.data[i].quid+'" value="'+rating+'" class="rating rating-loading" data-min="0" data-max="5"  data-size="cs"/></a>';
			    	if(results.data[i].gids.includes(4) ){
			    		html += '<i class="fas fa-lock"></i>';
			    	}else{
			    		html += '<i class="fas fa-lock-open"></i>';
			    	}
			    	html += '<a href="'+base_url+'index.php/quiz/validate_quiz/' + results.data[i].quid + '"><h4>' + results.data[i].quiz_name + '</h4></a></div>';
			    	html += '<div class="panel-body text-center">';
			    	html += '<a href="'+base_url+'index.php/quiz/validate_quiz/' + results.data[i].quid + '" class="btn btn-primary">Kiểm tra</a><br/>';
			    	if(results.user.quiz.includes("Assign")){
			    		html += '<a class="btn btn-success MT10" onclick="assignQuiz('+ results.data[i].quid +', '+results.user.su+')">Giao bài kiểm tra</a>';
			    	}
			    	html += '</div></div></div>';
			    	if(cc >= 3){
					  	cc=0;
				  	}else{
					  	cc+=1;
					}
					if($(window).width()>767){
						var heigth = Math.ceil(results.data.length/12)*200;
					}
					else{
						var heigth = Math.ceil(results.data.length/4)*220;
					}
					$('#data-grip').attr('style','height: '+heigth+'px');
			    	$('#data-grip').prepend(html);
			    	$('#result-rating'+results.data[i].quid).rating({displayOnly: true, step: 1});
			    }
			    $('#data-grip').paginate({itemsPerPage: 9});

			    $('.show-list').on('click', function(){
			    	$('#home1').empty();
			    	var header = '<div class="list-item-title"><div class="list-item-name ">Tên bài trắc nghiệm</div><div class="list-item-review" style="width: 40%;">Đánh giá</div><div class="list-item">Tác vụ</div></div>';
			    	$('#home1').append('<div id="addQuiz"  class="option-display pull-right"><div class="show-list active" title="Hiện thị theo danh sách"><i class="fas fa-th-list"></i></div><div class="show-grid active" title="Hiện thị theo dạng thẻ"><i class="fas fa-th"></i></div></div>'+header+'<div id="data-grip" class="list-group" style=" height: 420px;"></div><div id="data-grip-pagination"><a id="data-grip-previous" href="#">&laquo; Trước</a>&nbsp;&nbsp;<a id="data-grip-next" href="#">Sau &raquo;</a></div>');
			    	$('#data-grip').attr('style','height: auto');
			    	for (var i = 0; i < results.data.length; i++) {
				    	var rating = results.data[i].rvalue / results.data[i].rrating;
				    	if(isNaN(rating)){
				    		rating = 0;
				    	}
				    	var reviewervalue = 0;
				    	var reviewercontent = "";
				    	var reid = 0;
				    	var reviewcount = results.data[i].reviewcount;
				    	var reviewcountstr = reviewcount + " người đã đánh giá.";
				    	if(results.data[i].reviewer !== null){
				    		if(results.data[i].reviewer.includes(results.user.uid)){
					    		reviewervalue = results.data[i].reviewervalue;
					    		reviewercontent = results.data[i].reviewercontent;
					    		reid = results.data[i].reid;
					    	}
				    	}

				    	var html = '<div class="list-group-item p-5"><div class="list-item-name">' + results.data[i].quiz_name + '</div>';
				    	html += '<div class="list-item-review"><p style="width:'+(rating*20)+'%" data-value="'+(rating*20)+'"></p><progress class="psg progress text-'+colorcode[rating]+'" value="'+rating+'" max="5" title="'+reviewcountstr+'"><div class="progress-bar"><span style="width: '+(rating*20)+'%">'+(rating*20)+'%</span></div></progress></div>';
				    	html += '<div class="list-item-action c-dropdown dropdown"><a id="dropdownMenuButton'+results.data[i].quid+'" href="#" title="Kiểm tra" class="c-dropdown__menu dropdown-toggle" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></a>';
				    	html += '<div class="c-dropdown-bg dropdown-menu" aria-labelledby="dropdownMenuButton'+results.data[i].quid+'" x-placement="bottom-start">';
				    	html += '<a class="c-dropdown__item dropdown-item" href="#" onmouseup="rating_item('+ results.data[i].quid +', \'savsoft_quiz\','+reid+','+reviewervalue+',\''+reviewercontent+'\');">Đánh giá</a>';
				    	html += '<a class="c-dropdown__item dropdown-item" href="'+base_url+'index.php/quiz/validate_quiz/' + results.data[i].quid + '" class="btn btn-primary">Kiểm tra</a>';
				    	if(results.user.quiz.includes("Assign")){
				    		html += '<a class="c-dropdown__item dropdown-item" href="#" onclick="assignQuiz('+ results.data[i].quid +', '+results.user.su+')">Giao bài kiểm tra</a>';
				    	}
				    	html += '</div></div></div>';

				    	$('#data-grip').prepend(html);
				    }
				    $('#data-grip').paginate({itemsPerPage: 10});

			    	$('.show-grid').on('click', function(){
				    	checkItem(event);
				    });
			    	//console.log(results);
			    });

			    $('.show-grid').on('click', function(){
			    	checkItem(event);
			    });
		    }
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});
}

function assign(quid, uid, olduid){
	if(olduid.length > 0){
		olduid = olduid.replace(/,/g, "+");
	}
	var startdate = $('#startdate')[0].value;
	var enddate = $('#enddate')[0].value;
	var formData = {quid:quid, uid:uid, olduid:olduid, startdate:startdate, enddate:enddate};
	$.ajax({
		type: "POST",
		data : formData,
		url: base_url + "index.php/home_user/assignQuiz/"+quid+"/"+uid+"/"+olduid+"/"+startdate+"/"+enddate,
		success: function(data){
			if(data.result == "success"){
				$('#inviteMsg').css('display', '');
				$('#inviteMsg')[0].innerText = "Thêm thành công.";
			}
		},
		error: function(xhr,status,strErr){}
	});
}

function unassign(quid, uid){
	var formData = {quid:quid, uid:uid};
	$.ajax({
		type: "POST",
		data : formData,
		url: base_url + "index.php/home_user/unassign_quiz/"+quid+"/"+uid,
		success: function(data){
			if(data.result == "success"){
				$('#inviteMsg').css('display', '');
				$('#inviteMsg')[0].innerText = "Hủy thành công.";
			}
		},
		error: function(xhr,status,strErr){}
	});
}

function unassigntoclass(quid, classid){
	var formData = {quid:quid, classid:classid};
	$.ajax({
		type: "POST",
		data : formData,
		url: base_url + "index.php/home_user/unassign_to_class/"+quid+"/"+classid,
		success: function(data){
			if(data.result == "success"){
				$('#inviteMsg').css('display', '');
				$('#inviteMsg')[0].innerText = "Hủy thành công.";
			}
		},
		error: function(xhr,status,strErr){}
	});
}

function assigntoclass(quid, classid){
	var startdate = $('#startdate')[0].value;
	var enddate = $('#enddate')[0].value;
	var formData = {quid:quid, classid:classid, startdate:startdate, enddate:enddate};
	$.ajax({
		type: "POST",
		data : formData,
		url: base_url + "index.php/home_user/assign_to_class/"+quid+"/"+classid+"/"+startdate+"/"+enddate,
		success: function(data){
			if(data.result == "success"){
				$('#inviteMsg').css('display', '');
				$('#inviteMsg')[0].innerText = "Thêm thành công.";
			}
		},
		error: function(xhr,status,strErr){}
	});
}

function assignQuiz(quid, su){
	$('#quid').val(quid);
	$("#inviteModal").modal();
	if($('#studenttab').hasClass('active')){
		var formData = {quid:quid};
		$.ajax({
			type: "POST",
			data : formData,
			url: base_url + "index.php/home_user/student_list/"+quid,
			success: function(data){
				var olduid = '';
				if(data.qassign.length > 0){
					for (var i = 0; i < data.qassign.length; i++) {
						if(data.qassign[i].status == '1'){
							olduid += data.qassign[i].uid;
							olduid += ",";
						}
					}
				}
				var tbl = $('#tblStudentAssign').DataTable({
					responsive: true,
					data: data.students,
					columns: [
						{ "data": null, "defaultContent": "", "class":  "details-control", "orderable": false },    
						{ "data": "uid", "title": "#"},
						{ "data": "first_name", "title": "Họ tên"},
			            { "data": "email", "title": "Email"},
			            { "data":  null, "defaultContent": "", "class":  "details-status", "orderable": false},
			        ],
			        language: langs,
			        order: [[ 0, "desc" ]]
				});
				$('#tblStudentAssign tbody td.details-control').each(function () {
			        var tr = $(this).closest('tr');
			        var row = tbl.row(tr);
			        if(data.quiz.uids != null){
						if(olduid.includes(row.data().uid)){
							tr.addClass('shown');
							$(this).attr('title', "Hủy");
						}else{
							$(this).attr('title', "Thêm");
						}
					}
			    });

			    $('#tblStudentAssign tbody td.details-status').each(function () {
			        var tr = $(this).closest('tr');
			        var row = tbl.row(tr);
			        if(data.quiz.uids != null){
						if(olduid.includes(row.data().uid)){
							this.innerText = "Đã giao";
							this.style.color = "red";
						}
					}
			    });

				$('#tblStudentAssign tbody td.details-control').unbind('click').bind('click', function (e){

			        var tr = $(this).closest('tr');
			        var row = tbl.row( tr );

			        if (tr.hasClass('shown')){
			        	unassign(quid, row.data().uid);
			            row.child.hide();
			            tr.removeClass('shown');
			        }else{
			        	assign(quid, row.data().uid, olduid);
			            row.child.show();
			            tr.addClass('shown');
			        }
			    });
			},
			error: function(xhr,status,strErr){
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}
		});
	}

	$('#assClass').unbind('click').bind('click', function(){
   		var formData = {quid:quid};
		$.ajax({
			type: "POST",
			data : formData,
			url: base_url + "index.php/home_user/class_list/"+quid,
			success: function(data){
				console.log(data);
				var olddid = '';
				if(data.qassign.length > 0){
					for (var i = 0; i < data.qassign.length; i++) {
						if(data.qassign[i].status == '1'){
							olddid += data.qassign[i].classid;
							olddid += ",";
						}
					}
				}
				var tbl = $('#tblClassAssign').DataTable({
					retrieve: true,
					responsive: true,
					data: data.clist,
					columns: [
						{ "data": null, "defaultContent": "", "class":  "details-control", "orderable": false },    
						{ "data": "did", "title": "#"},
						{ "data": "dataitem_name", "title": "Tên lớp"},
			            { "data": "dataitem_code", "title": "Mã lớp"},
			            { "data":  null, "defaultContent": "", "class":  "details-status", "orderable": false},
			        ],
			        language: langs,
			        order: [[ 0, "desc" ]]
				});
				$('#tblClassAssign tbody td.details-control').each(function () {
			        var tr = $(this).closest('tr');
			        var row = tbl.row(tr);
			        if(olddid != null){
						if(olddid.includes(row.data().did)){
							tr.addClass('shown');
							$(this).attr('title', "Hủy");
						}else{
							$(this).attr('title', "Thêm");
						}
					}
			    });

			    $('#tblClassAssign tbody td.details-status').each(function () {
			        var tr = $(this).closest('tr');
			        var row = tbl.row(tr);
			        if(olddid != null){
						if(olddid.includes(row.data().did)){
							this.innerText = "Đã giao";
							this.style.color = "red";
						}
					}
			    });

				$('#tblClassAssign tbody td.details-control').unbind('click').bind('click', function (e){

			        var tr = $(this).closest('tr');
			        var row = tbl.row( tr );

			        if (tr.hasClass('shown')){
			        	unassigntoclass(quid, row.data().did);
			            row.child.hide();
			            tr.removeClass('shown');
			        }else{
			        	assigntoclass(quid, row.data().did);
			            row.child.show();
			            tr.addClass('shown');
			        }
			    });
			},
			error: function(xhr,status,strErr){
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}
		});
	});

	$('#inviteModal').on('hidden.bs.modal', function () {
	    $('#studenttab').empty();
	    $('#studenttab').append('<h3></h3><table id="tblStudentAssign" class="display" style="width:100%"></table>');
	    $('#classtab').empty();
	    $('#classtab').append('<h3></h3><table id="tblClassAssign" class="display" style="width:100%"></table>');
	    $('#studenttab').addClass('active');
	    $('#tabstudent').addClass('active');
	    $('#studenttab').removeClass('fade');
	    $('#tabclass').removeClass('active');
	    $('#classtab').removeClass('active');
	    
	});

	/*if(su == '4'){
		$('.assClass').css('display', 'none');
	}
	$('#inviteModal input[type="checkbox"]').on('change', function() {
	   	$('#inviteModal input[type="checkbox"]').not(this).prop('checked', false);
	   	
	   	if($(this).val() == '1'){
	   		$(".selectUids").css('display', '');
	   		$(".classCode").css('display', 'none');
	   		$(".js-invite-basic-multiple").select2();
	   		var formData = {quid:quid};
			$.ajax({
				type: "POST",
				data : formData,
				url: base_url + "index.php/home_user/student_list/"+quid,
				success: function(data){
	   				
   					var students = [];
					for (var i = 0; i < data.students.length; i++) {
						if(data.quiz.uids != null){
							if(!data.quiz.uids.includes(data.students[i].uid)){
								students.push({
									id: data.students[i].uid,
									text: data.students[i].first_name
								});
							}
						}else{
							students.push({
								id: data.students[i].uid,
								text: data.students[i].first_name
							});
						}
					}
					if(students.length > 0){
						$(".js-invite-basic-multiple").select2({
						  	data: students
						});
					}else{
	   					$('#inviteMsg').css('display', '');
						$('#inviteMsg')[0].innerText = "Hãy kiểm tra lại thông tin của bạn, có thể bạn chưa có con hoặc học sinh nào trên hệ thống và có thể bài học đã được giao cho con hoặc học sinh của bạn. ";
	   				}

					$('#btnInvite').on('click', function(){
						var uids = "";
						if(data.quiz.uids != null){
							uids += data.quiz.uids;
						}
						var listUids = $('.js-invite-basic-multiple')[0].selectedOptions;
						if(listUids.length > 0){
							if(uids.length > 0){
								uids = uids.replace(/,/g, "+");
							}
							for (var i = 0; i < listUids.length; i++) {
								uids += "+"; 
								uids += listUids[i].value;
							}
							console.log(uids);
							var inviteData = {quid:quid, uids:uids};
							$.ajax({
								type: "POST",
								data : inviteData,
								url: base_url + "index.php/home_user/assignQuiz/"+quid+"/"+uids,
								success: function(data){
									if(data.result == "success"){
										$(".js-invite-basic-multiple").select2({
											data: []
										});
										$('#inviteModal').modal('hide');
										$('#inviteModal').removeData();
										alert("Thêm thành công.");
									}
								},
								error: function(xhr,status,strErr){}
							});
						}else{
							$('#inviteMsg').css('display', '');
							$('#inviteMsg')[0].innerText = "Vui lòng chọn học sinh.";
						}
					});
				},
				error: function(xhr,status,strErr){}
			});
	   	}else{
	   		$(".selectUids").css('display', 'none');
	   		$(".classCode").css('display', '');
	   		var classcode = '';
	   		var formData = {quid:quid, classcode:classcode};
			$.ajax({
				 type: "POST",
				 data : formData,
					url: base_url + "index.php/home_user/class_list/"+quid+"/"+classcode,
				success: function(a){
					var clist = [];
					for (var i = 0; i < a.clist.length; i++) {
						clist.push({
							id: a.clist[i].did,
							text: "Tên lớp: " + a.clist[i].dataitem_name+" - Mã lớp: " + a.clist[i].dataitem_code
						});
					}
					$(".js-assign-class-multiple").select2({
						data: clist
					});
					$('#btnInvite').on('click', function(){
						var uids = "";
						if(a.quiz.uids != null){
							uids += a.quiz.uids;
						}
						var listClassId = $('.js-assign-class-multiple')[0].selectedOptions;
						if(listClassId.length > 0){
							for (var i = 0; i < listClassId.length; i++) {
								console.log(listClassId[i].value);
								var classData = {class_id:listClassId[i].value};
								$.ajax({
									type: "POST",
									data : classData,
									url: base_url + "index.php/home_user/student_of_class/"+listClassId[i].value,
									success: function(b){
										console.log(b.students);
										for (var i = 0; i < b.students.length; i++) {
											if(uids.length > 0){
												uids.replace(",", "+");
												uids += "+";
											}
											uids += b.students[i].uid;
										}
										uids = uids.replace(",", "+");
										console.log(uids);
										var inviteData = {quid:quid, uids:uids};
										$.ajax({
											type: "POST",
											data : inviteData,
											url: base_url + "index.php/home_user/assignQuiz/"+quid+"/"+uids,
											success: function(c){
												if(c.result == "success"){
													$(".js-assign-class-multiple").select2({
														data: []
													});
													$('#inviteModal').modal('hide');
													$('#inviteModal').removeData();
													alert("Thêm thành công.");
												}
											},
											error: function(xhr,status,strErr){}
										});
									},
									error: function(xhr,status,strErr){}
								});
							}
						}else{
							$('#inviteMsg').css('display', '');
							$('#inviteMsg')[0].innerText = "Vui lòng chọn lớp học.";
						}
					});
					console.log(a);
				},
				error: function(xhr,status,strErr){
					console.log(xhr);
					console.log(status);
					console.log(strErr);
				}	
			});
	   	}
	});*/
}

function addquestion(quid,qid){
1
 	var did='#q'+qid;
	var formData = {quid:quid};
	$.ajax({
		 type: "POST",
		 data : formData,
			url: base_url + "index.php/quiz/add_qid/"+quid+'/'+qid,
		success: function(data){
			/*console.log('------------');
			console.log(data);
			console.log('------------');*/
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}	
	});	
}

function removequestion(quid, qid){
	var formData = {
		quid:quid,
		qid:qid
	};
	$.ajax({
		 type: "POST",
		 data : formData,
			url: base_url + "index.php/home_user/remove_qid/"+quid+'/'+qid,
		success: function(data){
			/*console.log('------------');
			console.log(data);
			console.log('------------');*/
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}	
	});
}

function resultItem(event){
	$("#main_bussiness").attr("style", "");
	$("#new_main_page").attr("style", "display:none");
	load_topmenu("quiz_menu");
	load_tab1();
	var formData = {};
	$.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/home_user/manage_result/",
		success: function(results){
			//console.log(results);
			var objs = {};
			var arr = [];
			for(var i = 0; i < results.data.length; i++){ 
				var obj = {}; 
				obj['rid'] = results.data[i].rid;
				obj['people_answer'] = results.data[i].first_name; 
				obj['quiz_name'] = results.data[i].quiz_name;
				obj['email'] = results.data[i].email;
				obj['score_obtained'] = results.data[i].score_obtained;
				obj['time_spent'] = secintomin(results.data[i].total_time);
				obj['attempt_time'] = attempt(results.data[i].start_time);
				obj['contact_no'] = results.data[i].contact_no;
				obj['result_status'] = results.data[i].result_status;
				obj['percentage_obtained'] = results.data[i].percentage_obtained + "%";
				arr.push(obj); 
			}
			objs.data = arr;
			
			$('#home1').empty();
			$('#text-tabs')[0].innerText = "Kết quả";
			$('.line-L h1')[0].innerText = "Trắc nghiệm";
			$('#home1').attr('style','display:block');
			$('#home1').append('<table id="tblZ" class="display" style="width:100%"></table>');
			var tbl = $('#tblZ').DataTable({
				responsive: true,
				data: objs.data,
				columns: [
					{ "data": "rid", "title": "#" },
		            { "data": "people_answer", "title": "Họ Tên" },
		            { "data": "quiz_name", "title": "Tên bài trắc nghiệm" },
		            { "data": "result_status", "title": "Trạng thái" },
		            { "data": "percentage_obtained", "title": "Tỷ lệ phần trăm" },
					{ "data": null, "title": "","render":function (data, type, row) { return'<a href="#">Chi tiết</a>';}
											 , "class":  "details-control-c", "orderable": false },
		        ],
		        language: langs,
		        order: [[ 0, "desc" ]]
			});

			$('#tblZ tbody').on('click', 'td.details-control-c', function () {
		        var rowdata = tbl.row( $(this).parent() ).data();
		        console.log(rowdata);
		        window.location.href= base_url+'index.php/result/view_result/'+rowdata.rid;
		    } );

		    /*$('#tblZ tbody').on('click', 'td.details-control', function () {
		        var tr = $(this).closest('tr');
		        var row = tbl.row( tr );
		 
		        if ( row.child.isShown() ) {
		            // This row is already open - close it
		            row.child.hide();
		            tr.removeClass('shown');
		        }
		        else {
		            // Open this row
		            row.child( format(row.data()) ).show();
		            tr.addClass('shown');
		        }
		    });*/
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}	
	});
}


function format ( d ) {
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Score:</td>'+
            '<td>'+d.score_obtained+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Time Spent (Approx.):</td>'+
            '<td>'+d.time_spent+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Attempt Time:</td>'+
            '<td>'+d.attempt_time+'</td>'+
        '</tr>'+
    '</table>';
}

function attempt(timeString){
	var time = parseInt(timeString);
	var d = new Date(time * 1000);
	var dateStr = d.getDate() + '/' + (d.getMonth()+1) + '/' + d.getFullYear() + " " +
				d.getUTCHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
	return dateStr;
}

function prezero(val){
	if(val <= 9){
		return '0' + val;	
	}else{
		return val;
	}
}
function secintomin(sec){
	var secInt = parseInt(sec);
	if(secInt >= 60){
		var secStr = (secInt/60) + "";
		var splitin = secStr.split('.');
		if(splitin[1]){
			if(splitin[1].length > 1){
				var sp1 = ((parseInt(splitin[1].substring(0,2)) * 60)/100) + "";
				var secs = sp1.substring(0,2);
			}else{
				var secs=0;
			}
	    }
        else{
			var secs=0;
		}		
		return splitin[0] + ':' + prezero(secs);
	}else{
		return '0:' + prezero(sec);	
	}
}


function manage_class(event){
	$("#main_bussiness").attr("style", "");
	$("#new_main_page").attr("style", "display:none");
	//load_topmenu("class_menu");
	load_tab1();
    $('#text-tabs')[0].innerText = "Danh sách lớp";
    $('.line-L h1')[0].innerText = "Lớp";
	$('#home1').empty();
    var formData = {};
	$.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/classes/get_class/",
		success: function(results){
			$('#home1').css('overflow', 'auto');
			$('#home1').append('<table id="tblclass" class="display" style="width:100%"></table>');
            console.log(results);
			var tbl = $('#tblclass').DataTable({
				responsive: true,
				data: results.data,
				columns: [
					{ "data": "did","class":"list_class_", "title": "#"},
		            { "data": "dataitem_name","class":"list_class_","render":function (data, type, row){
									           
												 
				return '<a href="list_student_inclass/'+row.did+'" onclick="load_class('+row.did+')">'+ row.class_name+'</a>';
; 
					                           }, "title": "Tên lớp" },
		            { "data": "school","class":"list_class_", "title": "Trường" },
		            { "data": "","class":"list_class_","render":function (data, type, row){
						var html ='<span>'+row.student_count+'</span>';
						return html;
					}, "title": "Số học sinh" },
					
					{ "data": "","class":"list_class_","render":function (data, type, row){
						if(su==2){
							var	html = '<a href="#" title="" onclick="" style="margin-left:40px"><i class="pointer fas fa-plus-square" title="Mời bạn" style="color: green;" onclick="add_student_to_class('+row.did+')"></i></a>';
						}
						else{
							var	html = '<a href="#" title="" onclick="" style=""><i class="pointer fas fa-plus-square" title="Thêm học sinh" style="color: green;" onclick="add_student_to_class('+row.did+')"></i></a>';
							html += '<a href="#" title="" onclick="" style="margin-left:20px" data-toggle="modal" data-target="#repair_class"><i class="pointer fas fa-pencil-alt" title="Sửa lớp" style="color: blue;" onclick="repair_class('+row.did+')"></i></a>';
							html += '<a href="#" style="margin-left:20px"><i class="pointer fas fa-trash-alt" title="Xóa lớp" style="color: red;" onclick="deleteclass_ofteacher('+row.did+')"></i></a>';
								
						}
						return html;
					},"title": "Trạng thái" },
					
		        ],
		        language: langs,
		        order: [[ 0, "desc" ]]
			});
            $("[type=search]").attr("placeholder","Tìm kiếm lớp");
			$('#tblclass thead tr').each(function () {
				$(this).css('background-color', '#e9ebee');
			});

			$('#tblclass thead th').each(function () {
		       // var title = $(this).text();
		       // if(title !== '#' && title != 'Số học sinh'){
		       // 	$(this).empty();
		       // 	$(this).append('<p>'+title+'</p><input type="text"  style="width: 135px;" placeholder="Tìm kiếm '+title+'" />' );
		       // }
		    });
		    tbl.columns().every(function(){
		        var that = this;
		 
		        $('input', this.header()).on('keyup change', function(){
		            if (that.search() !== this.value){
		                that.search(this.value).draw();
		            }
		        });
		    });

			/*$('#tblclass tbody').on('click', 'tr', function(e){
				var data = tbl.row(this).data();
				var class_id = data['did'];
				var code = data['dataitem_code'];
				//e.stopPropagation(); 
		    	//$("#classModal").modal(); 
		    	
		    	$("#titleclassmodal").empty();
		    	$("#bodyclassmodal").empty();
		    	if(data['school'])
		    	   htmltt='<h3 class="modal-title" >Danh sách lớp <b>'+data['dataitem_name']+' Trường '+data['school']+'</b></h3>'+
		    	           '<div id="cl_id" style="display:none;">'+data['did']+'</div>'+
		    	           '<div id="code" style="display:none;">'+data['dataitem_code']+'</div>';
		    	else
		    		 htmltt='<h3 class="modal-title" >Danh sách lớp <b>'+data['dataitem_name']+'</b></h3>'+
		    	           '<div id="cl_id" style="display:none;">'+data['did']+'</div>'+
		    	           '<div id="code" style="display:none;">'+data['dataitem_code']+'</div>';
		    	$("#titleclassmodal").append(htmltt);
                
		        $.ajax({
				 	type: "POST",
					data : formData,
					url: base_url + "index.php/classes/get_student/"+class_id,
					success: function(results){
						$('#bodyclassmodal').css('overflow', 'auto');
						$('#bodyclassmodal').append("<h4>Mã lớp:  "+ code+"</h4>");
						$('#bodyclassmodal').append("<h4>Danh sách học sinh</h4>");
						$('#bodyclassmodal').append('<table id="tblclass_mng" class="display" style="width:100%"></table>');
						$("#bodyclassmodal").append('<div style="margin-top:30px"><button  class="btn btn-success col-md-3 col-md-offset-2" type="submit" onclick="add_std('+class_id+')">Thêm học sinh</button>'+
						                            '<button  class="btn btn-danger col-md-3 col-md-offset-2" type="submit">Vào lớp</button></div>');
						var tbl = $('#tblclass_mng').DataTable({
							responsive: true,
							data: results.data,
							columns: [
							    
								{ "data": "uid", "title": "#"},
								{ "data": "first_name", "title": "Họ tên"},
					            { "data": "email", "title": "Email"},
					            { "data": "birthdate", "title": "Ngày sinh"},
					            { "data": null, "defaultContent": '<a href="#"><i class="far fa-trash-alt"></i></a>', "class":  "details-control-1", "orderable": false },
					        ],
					        language: langs,
					        order: [[ 0, "desc" ]]
						});
                        
						$('#tblclass_mng thead tr').each(function () {
							$(this).css('background-color', '#e9ebee');
						});

						$('#tblclass_mng thead th').each(function () {
					        var title = $(this).text();
					        if(title !== '#' && title !=''){
					        	$(this).empty();
					        	$(this).append('<p>'+title+'</p><input type="text"  style="width: 135px;" placeholder="Tìm kiếm '+title+'" />' );
					        }
					    });
					    tbl.columns().every(function(){
					        var that = this;
					 
					        $('input', this.header()).on('keyup change', function(){
					            if (that.search() !== this.value){
					                that.search(this.value).draw();
					            }
					        });
					    });
                        
						$('#tblclass_mng tbody').on('click', 'td.details-control-1', function(e){
							var data = tbl.row($(this).parent()).data();
								
	                            $.ajax({
								 	type: "POST",
									data : formData,
									url: base_url + "index.php/classes/remove_student/"+class_id+"/"+data['uid'],
									success: function(results){
										
									},
									error: function(xhr,status,strErr){
										console.log(xhr);
										console.log(status);
										console.log(strErr);
									}
								});

								//$(this).parent().remove();
								$(this).parent().remove();
							//});  
                            
					        console.log(data);
					    });
					},
					error: function(xhr,status,strErr){
						console.log(xhr);
						console.log(status);
						console.log(strErr);
					}
				});  
               
                

		        console.log(data);
		    });*/
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});
	
}
function deleteclass_ofteacher(class_id){
	if(confirm('Bạn có muốn xóa lớp?')){
		$.ajax({
			type: "POST",
			data : formData={},
			url: base_url + "index.php/classes/deleteclass_ofteacher/"+class_id,
			success: function(data){
				
				manage_class(event);
				},
			error: function(xhr,status,strErr){
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}
		});  
	}
}
/*function repair_class(class_id){
	$('#repair_class').html();
	$.ajax({
	 	type: "POST",
		data : formData = {},
		url: base_url + "index.php/classes/class_of_teacher/"+class_id,
		success: function(data){
			$('#class_name').empty();
			$('#grade_class').empty();
			$('#cl_category').empty();
			$('#repair_cls').empty();
			console.log(data);
			var name_class = data[0].dataitem_name;
			var lid = data[0].grade;
			var cid = data[0].category;
			var name_class1 = data[0].dataitem_name;
			var lid1 = data[0].level_name;
			var cid1 = data[0].category_name;
			$('#class_name').append(" Tên lớp :  " +name_class1);
			$('#grade_class').append(" Lớp :  " +lid1);
			$('#cl_category').append(" Môn :  " +cid1);
			$('#repair_cls').append('<input type="button" value="Chỉnh sửa"  id="" onclick="modal_classes('+class_id+','+lid+','+cid+')" class="btn btn-primary">');
			},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});  
}*/
function repair_class(class_id){
	$('#repair_class').html();
	$.ajax({
	 	type: "POST",
		data : formData = {},
		url: base_url + "index.php/classes/class_of_teacher/"+class_id,
		success: function(data){
			$('#class_name').empty();
			$('#grade_class').empty();
			$('#cl_category').empty();
			$('#repair_cls').empty();
			console.log(data);
			var name_class = data[0].dataitem_name;
			var lid = data[0].grade;
			var cid = data[0].category;
			var name_class1 = data[0].dataitem_name;
			var lid1 = data[0].level_name;
			var cid1 = data[0].category_name;
			$('#class_name').append('<input type="text" class="form-control" style=" border: 1px solid blue;"  id="class_name_dt" placeholder="" value="'+name_class+'" onchange="change_name(this)" >');
			$.ajax({
				type: "POST",
				data : formData = {},
				url: base_url + "index.php/classes/level_class/",
				success: function(data){
				console.log(data);
				var gra = '<select id="level_id" style=" border: 1px solid blue;width:160px;margin-left:7px;" value="'+lid+'" onchange="change_grade(this)"><option id="optlb" value = "0">Chọn lớp </option>';
				for(i=0; i<data.length; i++){
				
				  gra+='<option ';
				 if(i==lid-3)
					  gra+=" selected ";
				  gra+='value="'+data[i]['lid']+'">'+data[i]['level_name']+'</option>';
				 
				}
			 
				gra+='</select>';
				$('#grade_class').append(" Chọn lớp học " +gra);
			},
			error: function(xhr,status,strErr){
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}
		});    
	
	
	
	$.ajax({
	 	type: "POST",
		dataq : formData1 = {},
		url: base_url + "index.php/classes/category_class/",
		success: function(dataq){
			
			console.log(dataq);
			var cate ='<select id="cate_id" style=" border: 1px solid blue;width:160px;" onchange="change_category_class(this)" name="categ_class" ><option id="ctlb" value="">Chọn môn học</option>';
			for(i=0; i<dataq.length; i++){
				  cate +='<option ';
				 if(i == cid-3)
					  cate +=" selected ";
				  cate +='value="'+dataq[i]['cid']+'">'+dataq[i]['category_name']+'</option>';
				  
			}
			 
			  cate+='</select>';
			
			$('#cl_category').append("Chọn môn học " +cate);
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});    
	
		$('#repair_cls').append('<input type="button" value="Xác nhận"  id="" onclick="determine_class('+class_id+')" class="btn btn-success">')
			
			

			},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});  
}


function change_name(event){
	name=$(event).val();
	lid=$('#level_id').val();
	cid=$('#cate_id').val();
	class_grade_category(name,lid,cid);
}
function change_grade(event){
	lid=$(event).val();
	name=$('#class_name_dt').val();
	cid=$('#cate_id').val();
	class_grade_category(name,lid,cid);
}
function change_category_class(event){
	cid=$(event).val();
	name=$('#class_name_dt').val();
	lid=$('#level_id').val();	
	class_grade_category(name,lid,cid);
}
function class_grade_category(name,lid,cid){
	$("#class_name_dt").val(name);
	$("#level_id").val(lid);
	$("#cate_id").val(cid);
}

function determine_class(class_id){
	name=$("#class_name_dt").val();
	lid=$("#level_id").val();
	cid=$("#cate_id").val();
	class_grade_category(name,lid,cid);
	console.log("###########################"+name);
	if(!name){
		$('#class_name').empty();
		$('#class_name').append('<input type="text" class="form-control" style=" border: 1px solid blue;"  id="class_name_dt" name="class_name_rp" placeholder="" value="" onchange="change_name(this)" ><br><span style="color:red"> Tên lớp không được để trống </span>');
		console.log(name);
		console.log(lid);
		console.log(cid);
	}
	else{
		dt=JSON.stringify({ 'class_id' : class_id,
							'name':name,
							'lid':lid,
							'cid':cid,
						  });
		
		console.log(dt);
		
		$.ajax({
			type: "POST",
			data : dt,
			url: base_url + "index.php/classes/determine_class/",
			success: function(data){
				location.reload();
				
				
				
				
			},
			error: function(xhr,status,strErr){
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}
		});
	}
}




function manage_class_modal_rl(){
    
    var formData = {};
    var class_id= $('#cl_id').text();
    var code= $('#code').text();
    $("#bodyclassmodal").empty();
    $.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/classes/get_student/"+class_id,
		success: function(results){
			$('#bodyclassmodal').css('overflow', 'auto');
			$('#bodyclassmodal').append("<h4>Mã lớp:  "+ code+"</h4>");
			$('#bodyclassmodal').append("<h4>Danh sách học sinh</h4>");

			$('#bodyclassmodal').append('<table id="tblclass_mng" class="display" style="width:100%"></table>');
									$("#bodyclassmodal").append('<div style="margin-top:30px"><button  class="btn btn-success col-md-3 col-md-offset-2" type="submit" onclick="add_std('+class_id+')">Thêm học sinh</button>'+
						                            '<button  class="btn btn-danger col-md-3 col-md-offset-2" type="submit">Vào lớp</button></div>');
			var tbl = $('#tblclass_mng').DataTable({
				responsive: true,
				data: results.data,
				columns: [
				    
					{ "data": "uid", "title": "#"},
					{ "data": "first_name", "title": "Họ tên"},
		            { "data": "email", "title": "Email"},
		            { "data": "birthdate", "title": "Ngày sinh"},
		            { "data": null, "defaultContent": '<a href="#"><i class="far fa-trash-alt"></i></a>', "class":  "details-control-1", "orderable": false },
		        ],
		        language: langs,
		        order: [[ 0, "desc" ]]
			});
            
			$('#tblclass_mng thead tr').each(function () {
				$(this).css('background-color', '#e9ebee');
			});

			$('#tblclass_mng thead th').each(function () {
		        var title = $(this).text();
		        if(title !== '#' && title !=''){
		        	$(this).empty();
		        	$(this).append('<p>'+title+'</p><input type="text"  style="width: 135px;" placeholder="Tìm kiếm '+title+'" />' );
		        }
		    });
		    tbl.columns().every(function(){
		        var that = this;
		 
		        $('input', this.header()).on('keyup change', function(){
		            if (that.search() !== this.value){
		                that.search(this.value).draw();
		            }
		        });
		    });
            
			
			$('#tblclass_mng tbody').on('click', 'td.details-control-1', function(e){
				var data = tbl.row($(this).parent()).data();
					console.log(1);
                    $.ajax({
					 	type: "POST",
						data : formData,
						url: base_url + "index.php/classes/remove_student/"+class_id+"/"+data['uid'],
						success: function(results){
							
						},
						error: function(xhr,status,strErr){
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}
					});

					//$(this).parent().remove();
					$(this).parent().remove();
				//});  
                
		        console.log(data);
		    });
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});  

}

function add_std(class_id){
    $("#classaddstdModal").modal(); 
    $('#bodyclassaddstdmodal').empty();
    var formData = {};
    $.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/classes/get_student_rm/"+class_id,
		success: function(results){
			$('#bodyclassaddstdmodal').css('overflow', 'auto');
			$('#bodyclassaddstdmodal').append('<table id="tblclass_std" class="display" style="width:100%"></table>');
			var tbl = $('#tblclass_std').DataTable({
				responsive: true,
				data: results.data,
				columns: [
				   
					{ "data": "uid", "title": "#"},
					{ "data": "first_name", "title": "Họ tên"},
		            { "data": "email", "title": "Email"},
		            { "data": "birthdate", "title": "Ngày sinh"},
		             { "data": null, "defaultContent": '<a href="#"><i class="fas fa-plus-circle text-success"/></a>', "class":  "details-control-2", "orderable": false },
		        ],
		        language: langs,
		        order: [[ 0, "desc" ]]
			});

			$('#tblclass_std thead tr').each(function () {
				$(this).css('background-color', '#e9ebee');
			});
             
			$('#tblclass_std thead th').each(function () {
		        var title = $(this).text();
		        if(title !== '#' && title !=''){
		        	$(this).empty();
		        	$(this).append('<p>'+title+'</p><input type="text"  style="width: 135px;" placeholder="Tìm kiếm '+title+'" />' );
		        }
		    });
		    tbl.columns().every(function(){
		        var that = this;
		 
		        $('input', this.header()).on('keyup change', function(){
		            if (that.search() !== this.value){
		                that.search(this.value).draw();
		            }
		        });
		    });
            
			$('#tblclass_std tbody').on('click', 'td.details-control-2', function(e){
				var data = tbl.row($(this).parent()).data();

					$.ajax({
					 	type: "POST",
						data : formData,
						url: base_url + "index.php/classes/add_student/"+class_id+"/"+data['uid'],
						success: function(results){
						   
						},
						error: function(xhr,status,strErr){
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}
					});  

					//$(this).parent().remove();
					$(this).parent().remove();
				//});
				

				//cap nhat luon
		        console.log(data);
		    });
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});  

}


function create_class(event){
	$("#main_bussiness").attr("style", "");
	$("#new_main_page").attr("style", "display:none");
	load_topmenu("class_menu");
	load_tab1();
	$('#home1').empty();
	$('#text-tabs')[0].innerText = "Tạo một lớp";
	$('.line-L h1')[0].innerText = "Lớp";
	$('#addclassModal').modal({
		backdrop:'static'
	});
    
}

function createGroup(event) {
	load_topmenu("group_menu");
	load_tab1();
	$('#home1').empty();
	$('#text-tabs')[0].innerText = "Tạo một nhóm";
	$('.line-L h1')[0].innerText = "Nhóm";
	$('#addgroupModal').modal({
		backdrop:'static'
	});
	$("#main_bussiness").attr("style", "");
	$("#new_main_page").attr("style", "display:none");
    
}

function manageGroup(event) {
	$("#main_bussiness").attr("style", "");
	$("#new_main_page").attr("style", "display:none");
	load_topmenu("group_menu");
	load_tab1();
	
    $('#text-tabs')[0].innerText = "Quản lý nhóm";
    $('.line-L h1')[0].innerText = "Nhóm";
    $('#home1').empty();
    var formData = {};
    $.ajax({
        type: "POST",
        data: formData,
        url: base_url + "index.php/social_group/manage_group",
        success: function (results) {
            $('#home1').css('overflow', 'auto');
            $('#home1').append('<table id="tblgroup" class="display" style="width:100%"></table>');
            var tbl = $('#tblgroup').DataTable({
                responsive: true,
                data: results.data,
                columns: [
                    {"data": "sg_id", "title": "#"},
                    {"data": "sg_name", "title": "Tên nhóm"},
                    //{"data": "student_count", "title": "Số thành viên"},
                ],
                language: langs,
                order: [[0, "desc"]]
            });

            $('#tblgroup thead tr').each(function () {
                $(this).css('background-color', '#e9ebee');
            });

            $('#tblgroup thead th').each(function () {
                var title = $(this).text();
                if (title !== '#' && title != 'Số thành viên') {
                    $(this).empty();
                    $(this).append('<p>' + title + '</p><input type="text"  style="width: 135px;" placeholder="Tìm kiếm ' + title + '" />');
                }
            });
            tbl.columns().every(function () {
                var that = this;

                $('input', this.header()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                });
            });

            $('#tblgroup tbody').on('click', 'tr', function (e){
                var data = tbl.row(this).data();
                var group_id = data['sg_id'];
                var code = data['sg_code'];
                e.stopPropagation();
                $("#groupModal").modal();
                $("#titlegroupmodal").empty();
                $("#bodygroupmodal").empty();
                if (data['sg_name'])
                    htmltt = '<h3 class="modal-title" >Quản lý nhóm <b>' + data['sg_name'] + '</b></h3>' +
                        	'<div id="sg_id" style="display:none;">' + data['sg_id'] + '</div>'+
		    	            '<div id="code" style="display:none;">'+data['sg_code']+'</div>';
                else
                    htmltt = '<h3 class="modal-title" >Quản lý nhóm <b>' + data['sg_name'] + '</b></h3>' +
                        '<div id="sg_id" style="display:none;">' + data['sg_id'] + '</div>'+
		    	           '<div id="code" style="display:none;">'+data['sg_code']+'</div>';
                $("#titlegroupmodal").append(htmltt);
                $.ajax({
                    type: "POST",
                    data: formData,
                    url: base_url + "index.php/social_group/get_mem/" + group_id,
                    success: function (results) {
                        $('#bodygroupmodal').css('overflow', 'auto');
                        $('#bodygroupmodal').append("<h4>Mã nhóm:  " + code + "</h4>");
                        $('#bodygroupmodal').append("<h4>Danh sách thành viên</h4>");
                        $('#bodygroupmodal').append('<table id="tblgroup_mng" class="display" style="width:100%"></table>');
                        $("#bodygroupmodal").append('<div style="margin-top:30px"><button  class="btn btn-success col-md-3 col-md-offset-2" type="submit" onclick="add_mem('+group_id+')">Thêm thành viên</button></div>');
                        var tbl = $('#tblgroup_mng').DataTable({
                            responsive: true,
                            data: results.data,
                            columns: [

                                {"data": "uid", "title": "#"},
                                {"data": "first_name", "title": "Họ tên"},
                                {"data": "email", "title": "Email"},
                                {"data": "birthdate", "title": "Ngày sinh"},
                                {
                                    "data": null,
                                    "defaultContent": '<a href="#"><i class="far fa-trash-alt"></i></a>',
                                    "class": "details-control-1",
                                    "orderable": false
                                },
                            ],
                            language: langs,
                            order: [[0, "desc"]]
                        });

                        $('#tblgroup_mng thead tr').each(function () {
                            $(this).css('background-color', '#e9ebee');
                        });

                        $('#tblgroup_mng thead th').each(function () {
                            var title = $(this).text();
                            if (title !== '#' && title != '') {
                                $(this).empty();
                                $(this).append('<p>' + title + '</p><input type="text"  style="width: 135px;" placeholder="Tìm kiếm ' + title + '" />');
                            }
                        });
                        tbl.columns().every(function () {
                            var that = this;

                            $('input', this.header()).on('keyup change', function () {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        });

                        $('#tblgroup_mng tbody').on('click', 'td.details-control-1', function (e) {
                            var data = tbl.row($(this).parent()).data();

                            $.ajax({
                                type: "POST",
                                data: formData,
                                url: base_url + "index.php/social_group/remove_mem/" + group_id + "/" + data['uid'],
                                success: function (results) {

                                },
                                error: function (xhr, status, strErr) {
                                    console.log(xhr);
                                    console.log(status);
                                    console.log(strErr);
                                }
                            });

                            //$(this).parent().remove();
                            $(this).parent().remove();
                            //});

                            console.log(data);
                        });
                    },
                    error: function (xhr, status, strErr) {
                        console.log(xhr);
                        console.log(status);
                        console.log(strErr);
                    }
                });

                console.log(data);
            });
        },
        error: function (xhr, status, strErr) {
            console.log(xhr);
            console.log(status);
            console.log(strErr);
        }
    });
}

function manage_group_modal_rl(){
    
    var formData = {};
    var group_id= $('#sg_id').text();
    var code = $('#code').text();
    $("#bodygroupmodal").empty();
    $.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/social_group/get_mem/"+group_id,
		success: function(results){
			$('#bodygroupmodal').css('overflow', 'auto');
                        $('#bodygroupmodal').append("<h4>Mã nhóm:  " + code + "</h4>");
                        $('#bodygroupmodal').append("<h4>Danh sách thành viên</h4>");
                        $('#bodygroupmodal').append('<table id="tblgroup_mng" class="display" style="width:100%"></table>');
                        $("#bodygroupmodal").append('<div style="margin-top:30px"><button  class="btn btn-success col-md-3 col-md-offset-2" type="submit" onclick="add_mem('+group_id+')">Thêm thành viên</button></div>');
			
			var tbl = $('#tblgroup_mng').DataTable({
				responsive: true,
				data: results.data,
				columns: [
				    
					{ "data": "uid", "title": "#"},
					{ "data": "first_name", "title": "Họ tên"},
		            { "data": "email", "title": "Email"},
		            { "data": "birthdate", "title": "Ngày sinh"},
		            { "data": null, "defaultContent": '<a href="#"><i class="far fa-trash-alt"></i></a>', "class":  "details-control-1", "orderable": false },
		        ],
		        language: langs,
		        order: [[ 0, "desc" ]]
			});
            
			$('#tblgroup_mng thead tr').each(function () {
				$(this).css('background-color', '#e9ebee');
			});

			$('#tblgroup_mng thead th').each(function () {
		        var title = $(this).text();
		        if(title !== '#' && title !=''){
		        	$(this).empty();
		        	$(this).append('<p>'+title+'</p><input type="text"  style="width: 135px;" placeholder="Tìm kiếm '+title+'" />' );
		        }
		    });
		    tbl.columns().every(function(){
		        var that = this;
		 
		        $('input', this.header()).on('keyup change', function(){
		            if (that.search() !== this.value){
		                that.search(this.value).draw();
		            }
		        });
		    });
            
			
			$('#tblgroup_mng tbody').on('click', 'td.details-control-1', function(e){
				var data = tbl.row($(this).parent()).data();
					console.log(1);
                    $.ajax({
					 	type: "POST",
						data : formData,
						url: base_url + "index.php/social_group/remove_mem/"+group_id+"/"+data['uid'],
						success: function(results){
							
						},
						error: function(xhr,status,strErr){
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}
					});

					//$(this).parent().remove();
					$(this).parent().remove();
				//});  
                
		        console.log(data);
		    });
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	}); 

}

function add_mem(group_id){
    $("#groupaddstdModal").modal(); 
    $('#bodygroupaddstdmodal').empty();
     
    var formData = {};
    $.ajax({
	 	type: "POST",
		data : formData,
		url: base_url + "index.php/social_group/get_mem_rm/"+group_id,
		success: function(results){
			$('#bodygroupaddstdmodal').css('overflow', 'auto');
			$('#bodygroupaddstdmodal').append("<h4>Thêm thành viên</h4>");
			$('#bodygroupaddstdmodal').append('<table id="tblgroup_std" class="display" style="width:100%"></table>');
			var tbl = $('#tblgroup_std').DataTable({
				responsive: true,
				data: results.data,
				columns: [
					{ "data": "uid", "title": "#"},
					{ "data": "first_name", "title": "Họ tên"},
		            { "data": "email", "title": "Email"},
		            { "data": "birthdate", "title": "Ngày sinh"},
		             { "data": null, "defaultContent": '<a href="#"><i class="fas fa-plus-circle text-success"/></a>', "class":  "details-control-2", "orderable": false },
		        ],
		        language: langs,
		        order: [[ 0, "desc" ]]
			});

			$('#tblgroup_std thead tr').each(function () {
				$(this).css('background-color', '#e9ebee');
			});
             
			$('#tblgroup_std thead th').each(function () {
		        var title = $(this).text();
		        if(title !== '#' && title !=''){
		        	$(this).empty();
		        	$(this).append('<p>'+title+'</p><input type="text"  style="width: 135px;" placeholder="Tìm kiếm '+title+'" />' );
		        }
		    });
		    tbl.columns().every(function(){
		        var that = this;
		 
		        $('input', this.header()).on('keyup change', function(){
		            if (that.search() !== this.value){
		                that.search(this.value).draw();
		            }
		        });
		    });
            
			$('#tblgroup_std tbody').on('click', 'td.details-control-2', function(e){
				var data = tbl.row($(this).parent()).data();

					$.ajax({
					 	type: "POST",
						data : formData,
						url: base_url + "index.php/social_group/add_mem/"+group_id+"/"+data['uid'],
						success: function(results){
						   
						},
						error: function(xhr,status,strErr){
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}
					});  

					//$(this).parent().remove();
					$(this).parent().remove();
				//});
				

				//cap nhat luon
		        console.log(data);
		    });
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	});  
}

function propose_question(question_id){
	  $.ajax({
			type: "POST",
			data : {},
			url: base_url + "index.php/home_user/get_question/"+question_id,
			success: function(results){
				if(results.data['question'] != ''){
					$("#previewquestionModal").modal();	
					$("#prqt").empty();
					$("#prqt").append("Câu hỏi #"+ question_id);							
					var q = results.data['question'];
					if(q.indexOf("<img")!=-1)
						q=q.replace("<img", "<img width=240 height:160");
					if(q.indexOf("<iframe")!=-1)
						q=q.replace("<iframe", "<iframe height:150");
					$("#questionp").empty();
					$("#questionp").append('<b>'+q+'</b>');
					$("#answer-areap").empty();
					opA =results.data['options'][0]['q_option'];
					opB =results.data['options'][1]['q_option'];
					opC =results.data['options'][2]['q_option'];
					opD =results.data['options'][3]['q_option'];
					if(opA.indexOf("<p>")==0)
						opA = opA.substring(3,opA.length-4);
					if(opB.indexOf("<p>")==0)
						opB = opB.substring(3,opB.length-4);
					if(opC.indexOf("<p>")==0)
						opC = opC.substring(3,opC.length-4);
					if(opD.indexOf("<p>")==0)
						opD = opD.substring(3,opD.length-4);
						
					var htmla='<div class="row MB20">'+
								'<div class="col-xs-6"><div id="optAp"> A: '+opA+'</div></div>'+
								'<div class="col-xs-6"><div id="optBp"> B: '+opB+'</div></div>'+
							'</div>'+
							'<div class="row MB20">'+
								'<div class="col-xs-6"><div id="optCp"> C: '+opC+'</div></div>'+
								'<div class="col-xs-6"><div id="optDp"> D: '+opD+'</div></div>'+
							'</div>';													
					$("#answer-areap").append(htmla);
					if(results.data['c_option']==0){
							$('#optAp').prepend("<i class='fa fa-check-circle text-success'></i>");
							$('#optAp').attr("class","text-success");
					}
					else if(results.data['c_option']==1){
						$('#optBp').prepend("<i class='fa fa-check-circle text-success'></i>");
						$('#optBp').attr("class","text-success");
					}
					else if(results.data['c_option']==2){
						$('#optCp').prepend("<i class='fa fa-check-circle text-success'></i>");
						$('#optCp').attr("class","text-success");
					}
					else if(results.data['c_option']==3){
						$('#optDp').prepend("<i class='fa fa-check-circle text-success'></i>");
						$('#optDp').attr("class","text-success");
					}
					var rating = 0;
					var reviewervalue = 0;
					var reviewercontent = "";
					var reid = 0;
					var reviewcount = results.review.length;
					var reviewcountstr = reviewcount + " người đã đánh giá.";
					if(results.review.length > 0){
						for (var i = results.review.length - 1; i >= 0; i--) {
							rating += parseInt(results.review[i].value);
							if(results.user.uid === results.review[i].reviewer){
								reid = results.review[i].id;
								reviewervalue = results.review[i].value;
								reviewercontent = results.review[i].content;
							}
						}
						rating = rating / results.review.length;
					}
					$("#optionareap").empty();
					var htmlo ='<table>'+
									'<tr> <td>Môn học:</td><td style="padding:5px">'+results.data['category_name']+'</td></tr>'+
									'<tr> <td>Lớp:</td><td style="padding:5px">'+results.data['level_name']+'</td></tr>'+
									'<tr> <td>Giải thích:</td><td style="padding:5px">'+results.data['description']+'</td></tr>'+
									'<tr> <td>Từ khóa:</td><td style="padding:5px">'+results.data['tags']+'</td></tr>'+
									'<tr> <td>Thời gian làm bài:</td><td style="padding:5px">'+results.data['answer_time']+' giây</td></tr>'+
									'<tr> <td>Đánh giá:</td><td style="padding:5px"><a href="javascript:void(0);" onmouseup="rating_item('+ question_id+', \'savsoft_qbank\','+reid+','+reviewervalue+',\''+reviewercontent+'\');" title="'+reviewcountstr+'"><input id="rvalue" value="'+rating+'" class="rating rating-loading" data-min="0" data-max="5"  data-size="xs"/></a></td></tr>'+
								'</table>';
					$("#optionareap").append(htmlo);
					$('#rvalue').rating({displayOnly: true, step: 1});
					$('*').keyup(function(e){
						  if(e.keyCode=='27'){
							 $('#previewquestionModal').modal('hide');
						  }       
					  })
				}else{
					alert("Câu hỏi đã bị xóa");
				}				
			},
			error: function(xhr,status,strErr){
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}
		  });
}

function propose_quiz(quiz_id){
	  $.ajax({
			type: "POST",
			data : {},
			url: base_url + "index.php/home_user/get_quiz/"+quiz_id,
			success: function(results){
				$("#previewquizModal").modal();	
				var dataquiz = results.data;
				
				if(dataquiz['quiz_name']){
					$("#previewquizModal").modal();	
					$("#quiztitlepr").empty();				  
					$("#quiztitlepr").append("<h3>Bài kiểm tra: "+dataquiz['quiz_name']+"</h3>");
					$("#quizbodypr").empty();
					$("#quizbodypr").append('<table id="tblqsqz" class="display" style="width:100%"></table>');
					var reid=0;
					var reviewervalue=dataquiz.userrate;
					if(dataquiz.userrate>0){
						reid=1;
					}
					var reviewercontent=dataquiz.usercomment;
					var reviewcountstr = dataquiz.nrate + " người đã đánh giá.";
					var htmlr='<a href="javascript:void(0);" onmouseup="rating_item('+ dataquiz.quid +', \'savsoft_quiz\','+reid+','+reviewervalue+',\''+reviewercontent+'\');" title="'+reviewcountstr+'"><input id="result-rating_'+dataquiz.quid+'" value="'+dataquiz.rated+'" class="rating rating-loading" data-min="0" data-max="5"  data-size="cs"/></a>';
					$("#quiztitlepr").append(htmlr);
					$('#result-rating_'+dataquiz.quid).rating({displayOnly: true, step: 1});
					$.ajax({
						type: "POST",
						data : {},
						url: base_url + "index.php/quiz/get_questions/"+dataquiz['quid'],
						success: function(results){
							console.log(results);
							var tblqsqz = $('#tblqsqz').DataTable({
								responsive: true,
								data: results,
								columns: [
									{ "data": "qid","title": "#"},
									{ "data": "question","render":function (data, type, row){
											   return '<a href="#manage_quiz" title="Xem trước"><b>'+row.question+'</b></a>';
											   } ,"title": "Câu hỏi", "width":"70%" ,"class":  "details-control-p"},
									{ "data": "category_name", "title": "Danh mục"},
									{ "data": "level_name", "title": "Cấp độ"},
								  
								],
								language: langs,
								order: [[ 0, "desc" ]],
								lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]]
							});
							
							$("#tblqsqz_filter>label>[type=search]").attr("placeholder","Tìm kiếm câu hỏi");
							$('#tblqsqz thead tr').each(function () {
								$(this).css('background-color', '#e9ebee');
							});
							$("tbody>tr>td>a>b>p>img").attr("class","col-md-7");
							$("tbody>tr>td>a>b>p>iframe").attr("class","col-md-7");
							$("tbody>tr>td>a>b>p>iframe").attr("height",150);
							
						},
						error: function(xhr,status,strErr){
							console.log(xhr);
							console.log(status);
							console.log(strErr);
						}
					});
				 
				}else{
					alert('Bài kiểm tra đã bị xóa');
				}

			},
			error: function(xhr,status,strErr){
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}
		  });
}

function add_child(){
	student_code=$("#student_code").val();
	 $.ajax({
			type: "POST",
			data : JSON.stringify({'student_code':student_code}),
			url: base_url + "index.php/home_user/add_child_1/",
			success: function(results){
                 if(results['status']==0){				 
					$("#msg_addchild").remove();			 
					$("#btn_sm_addchild").parent().append('<div id="msg_addchild" style="margin-top:10px; color:red">'+results['message']+'</div>');
                 }
                 else{
					 $("#msg_addchild").remove();
					 $("#addstudentModal").modal("hide");
					 alert("Thêm thành công");
					 location.reload(); 	 
                 }
			},
			error: function(xhr,status,strErr){
				console.log(xhr);
				console.log(status);
				console.log(strErr);
			}
		  });
}
function do_homework(quid,auid){
	console.log(quid);
	$.ajax({
		type: "POST",
		data : {},
		url: base_url + "index.php/home_user/do_homework/"+quid+"/"+auid,
		success: function(results){
			
		},
		error: function(xhr,status,strErr){
			console.log(xhr);
			console.log(status);
			console.log(strErr);
		}
	  });
	  
	}