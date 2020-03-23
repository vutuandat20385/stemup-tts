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
	  selector: 'textarea#question',
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
		'placeholder tiny_mce_wiris',
		'advlist autolink lists link image jbimages eqneditor charmap print preview hr anchor pagebreak',
		'searchreplace wordcount visualblocks visualchars code fullscreen',
		'insertdatetime media nonbreaking save table contextmenu directionality',
		'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
	  ],
	  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages | eqneditor tiny_mce_wiris_formulaEditor ',
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
	 
	 
	