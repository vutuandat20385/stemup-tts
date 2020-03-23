$(document).ready(function(){
   tinymce.PluginManager.add('placeholder', function (editor) {
		editor.on('init', function () {
			var label = new Label;
			onBlur();
			tinymce.DOM.bind(label.el, 'click', onFocus);
			editor.on('focus', onFocus);
			editor.on('blur', onBlur);
			editor.on('change', onBlur);
			editor.on('setContent', onBlur);
			function onFocus() { if (!editor.settings.readonly === true) { label.hide(); } editor.execCommand('mceFocus', false); }
			function onBlur() { if (editor.getContent() == '') { label.show(); } else { label.hide(); } }
		});
		var Label = function () {
			var placeholder_text = editor.getElement().getAttribute("placeholder") || editor.settings.placeholder;
			var placeholder_attrs = editor.settings.placeholder_attrs || { style: { position: 'absolute', top: '2px', left: 0, color: '#aaaaaa', padding: '.25%', margin: '5px', width: '80%', 'font-size': '17px !important;', overflow: 'hidden', 'white-space': 'pre-wrap' } };
			var contentAreaContainer = editor.getContentAreaContainer();
			tinymce.DOM.setStyle(contentAreaContainer, 'position', 'relative');
			this.el = tinymce.DOM.add(contentAreaContainer, "label", placeholder_attrs, placeholder_text);
		}
		Label.prototype.hide = function () { tinymce.DOM.setStyle(this.el, 'display', 'none'); }
		Label.prototype.show = function () { tinymce.DOM.setStyle(this.el, 'display', ''); }
	});	
	
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
			'tiny_mce_wiris',
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

	
	
});

function create_question_video(lib_id){
	
	cleardata();
	$('#crt_mcq_vid').on('show.bs.modal', function () {
		$('body').css({});
	});
	$("#content").removeAttr('style');
	$("#content").removeAttr('title');
	$("#content").attr('data-original-title','');
	$("#selectAnswer").removeAttr('style');
	$("#selectAnswer").removeAttr('title');
	$("#selectAnswer").attr('data-original-title','');
	$("#tags").removeAttr('style');
	$("#tags").removeAttr('title');
	$("#tags").attr('data-original-title','');


	tinyMCE.get('questione').setContent($("#video-if-"+lib_id).html()); 
	$("#crt_mcq_vid").modal();
	
	$("#logo_org_e").click(function(){
		$("#logo_org_e").val(1-$("#logo_org_e").val());
	});
	$("#mcq_fun_e").click(function(){
		$("#mcq_fun_e").val(1-$("#mcq_fun_e").val());
	});
} 


function cleardata(){
	tinyMCE.get('optA').setContent(""); 
	tinyMCE.get('optB').setContent(""); 
	tinyMCE.get('optC').setContent(""); 
	tinyMCE.get('optD').setContent(""); 
	$("#cide").val(3);
	$("#lide").val(3);
	tinyMCE.get('descr').setContent(""); 
	$('#tags').val("");
	$('#answer_timeedt').val(60);
	$("#sourcemcq_e").val("");
	
	$("#logo_org_e").prop("checked", false);
	$("#mcq_fun_e").prop("checked", false);
	$("#logo_org_e").val(0);
	$("#mcq_fun_e").val(0);
	$('input[name=score]').prop("checked", false);
	$('input[name=q_type]').prop("checked", false);
}
function get_inf_qt(){
	
	correct_opt=$('input[name=score]:checked').val();
	qt=tinyMCE.get('questione').getContent().trim().replace("<p>","").replace("</p>","");
	optA=tinyMCE.get('optA').getContent().trim().replace("<p>","").replace("</p>","");
	optB=tinyMCE.get('optB').getContent().trim().replace("<p>","").replace("</p>","");
	optC=tinyMCE.get('optC').getContent().trim().replace("<p>","").replace("</p>","");
	optD=tinyMCE.get('optD').getContent().trim().replace("<p>","").replace("</p>","");
	cid=$("#cide").val();
	lid=$("#lide").val();
	descr=tinyMCE.get('descr').getContent().trim().replace("<p>","").replace("</p>","");
	tags=$('#tags').val().trim();
	answer_time=$('#answer_timeedt').val().trim();

	unitmcq=$('#unitmcq').val().trim();
    lesson=$('#lessonmcq').val().trim();
	type=$('input[name=q_type]:checked').val();
    fp = $("#mcq_fun_e").val();
	sl = $("#logo_org_e").val();
	source= $("#sourcemcq_e").val();
	var txtError ={
		q: "",
		opt: "",
		check: "",
		tags: "",
	};
	var regIframe = /(<iframe)/g;
	if(!regIframe.test(qt)){
		txtError["q"] = "Câu hỏi không hợp lệ";
		$("#content").attr('style',"border-color: red;border-style:solid;border-width: thin");
		$('#content').attr('data-original-title', txtError["q"]);
		$('#content').tooltip();
	}else{
		$("#content").attr('style',"");
		$('#content').attr('data-original-title', txtError["q"]);
	};
	if(tags.length == 0 ){
		txtError["tags"] = "Bạn không được để trống từ khóa";
		$("#tags").attr('style',"border-color: red");
		$('#tags').attr('data-original-title', txtError["tags"]);
		$('#tags').tooltip();
	}else{
		$("#tags").attr('style',"");
		$('#tags').attr('data-original-title', txtError["tags"]);
	};
	if(optA.length ==0 || optB.length ==0 || optC.length ==0 || optD.length ==0 || $("input[name='score']:checked").val()==undefined ){
		txtError['opt'] = "Bạn không được bỏ trống đáp án và phải chọn đáp án đúng";
		$("#selectAnswer").attr('style',"border-color: red;border-style:solid;border-width: thin");
		$('#selectAnswer').attr('data-original-title', txtError['opt']);
		$('#selectAnswer').tooltip();
	}else{
		$("#selectAnswer").attr('style',"");		
		$('#selectAnswer').attr('data-original-title', txtError['opt']);
	};
/*	if ($("input[name='score']:checked").val()==undefined) {
		txtError['check'] = "Bạn phải điền đủ bốn đáp án và chọn đáp án đúng";
		$("#selectAnswer").attr('style',"border-color: red;border-style:solid;border-width: thin");
		$('#selectAnswer').prop('title', txtError['check']);
		$('#selectAnswer').tooltip();

	}else{
		$("#selectAnswer").attr('style',"");		
		$('#selectAnswer').prop('title', txtError['check']);
	}*/
 dataqt = JSON.stringify({ 'question':qt,  
 'opt0':optA,
 'opt1':optB,
 'opt2':optC,
 'opt3':optD,
 'cid':cid, 
 'lid':lid,
 'description':descr,
 'tags':tags,
 'answer_time':answer_time,
 'fp':fp,
 'sl':sl,
 'correct_opt':correct_opt,
 "source":source,
							 "unit": unitmcq,	                            
 "lesson": lesson,
							 "type": type							
							});
 if(txtError["q"]=="" && txtError["opt"]=="" && txtError["check"]=="" && txtError["tags"]=="" ){
	$.ajax({
		type: 'POST',
		url: site_url+"/qbank/insert_video_question/",
		data: dataqt,
		contentType: 'application/json',
		success: function(data) {
		 console.log(data);
		 $('#crt_mcq_vid').modal('hide');
		},
		error: function(data) {
		}
 });
 }
}
function deleteVideo(lib_id){
	console.log(lib_id);
	if(confirm('Bạn có muốn xóa video?')){
		$.ajax({
			type: 'POST',
			url: site_url+"/sadmin/deleteVideo/"+lib_id,
			data: {},
			contentType: 'application/json',
			success: function(data) {
				
				 window.location.href =  site_url+"/sadmin/video/";
			 
			},
			error: function(data) {
			}
		});
	}	
}