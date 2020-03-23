$(document).ready(function(){
$("#issim").click(function(){
	$("#issim").val(1-$("#issim").val());
});
tinymce.init({
		  menubar:false,
		  statusbar: false,
		  selector: 'textarea#video_if',
		   branding: false,
		  auto_focus : "descr1",
		  images_dataimg_filter: function(img) {
			return img.hasAttribute('internal-blob');
		  },
		  
		   height: 350,
		  theme: 'modern',
		  plugins: [
			'tiny_mce_wiris',
			'advlist autolink lists link image jbimages eqneditor charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
		  ],
		  toolbar1: 'embed',
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
})
function find_occurences(str, char_to_count){
    return str.split(char_to_count).length - 1;
}
function insert_video(){	
	video_if= tinymce.get("video_if").getContent();
	video_if= video_if.replace("<p>","").replace("</p>","");
	name_video= $("#name_video").val();
	title_video= $("#title_video").val();	
	descr_video= $("#descr_video").val();
	tags_video= $("#tags_video").val();	
	cid_video=$("#cide").val();
	lid_video=$("#lide").val();
	source_video = $("#source_video").val();
	unit_video = $("#unit_video").val();
	issim = $("#issim").val();
	if(issim==0){
		type="video";
	}
	else{
		type="simulation";
	}
	 //check field
	 if(video_if.indexOf("<iframe")==-1){
		 alert("Dữ liệu không chứa mã nhúng!");
	 }
	 else if(find_occurences(video_if, '<iframe') != 1){
		alert("Mỗi lần chỉ được thêm 1 video!");
	 }
	 else if(name_video==""){
		 alert("Tên video/mô phỏng không được bỏ trống!");
	 }
	 else if(title_video==""){
		  alert("Title không được bỏ trống!");
	 }
		 
	else {
		dt=JSON.stringify({'video_if':video_if,
						   'name_video':name_video,
						   'title_video':title_video,
						   'descr_video':descr_video,
						   'tags_video':tags_video,
						   'cid_video':cid_video,
						   'lid_video':lid_video,
						   'source_video':source_video,
						   'type':type,
						   'unit_video':unit_video
						  });	

		 $.ajax({
			  type: 'POST',
			  url: site_url+"/library/add_video",
			  contentType: 'application/json',
			  data:dt,
			  contentType: 'application/json',
			  success: function(data) {
				//  console.log(data);
				  alert("Thêm dữ liệu thành công!");
				  window.reload();
			  },
			  error:function(data) {
				  
			  }
		});
	}
}    

function edit_video(lib_id){
	video_if= tinymce.get("video_if").getContent();
	video_if= video_if.replace("<p>","").replace("</p>","");
	name_video= $("#name_video").val();
	title_video= $("#title_video").val();	
	descr_video= $("#descr_video").val();
	tags_video= $("#tags_video").val();	
	cid_video=$("#cide").val();
	lid_video=$("#lide").val();
	source_video = $("#source_video").val();
	issim = $("#issim").val();
	if(issim==0){
		type="video";
	}
	else{
		type="simulation";
	}
	 //check field
	 if(video_if.indexOf("<iframe")==-1){
		alert("Dữ liệu không chứa mã nhúng!");
	}
	else if(find_occurences(video_if, '<iframe') != 1){
		alert("Mỗi lần chỉ được thêm 1 video!");
	 }
	else if(name_video==""){
		alert("Tên video/mô phỏng không được bỏ trống!");
	}
	else if(title_video==""){
		 alert("Title không được bỏ trống!");
	}
		 
	else {
		dt=JSON.stringify({'lib_id':lib_id,
						    'content': video_if,
						   'name_video':name_video,
						   'title_video':title_video,
						   'descr_video':descr_video,
						   'tags_video':tags_video,
						   'cid_video':cid_video,
						   'lid_video':lid_video,
						   'source_video':source_video,
						   'type':type
						  });	
		 $.ajax({
			  type: 'POST',
			  url: site_url+"/library/get_data_edit_video",
			  contentType: 'application/json',
			  data:dt,
			  contentType: 'application/json',
			  success: function(data) {
				  alert("Sửa dữ liệu thành công!");
				//  console.log(data);
				  window.reload();
			  },
			  error:function(data) {
				  
			  }
		});
	}
}