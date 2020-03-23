<?php 
if($this->config->item('mathjax')){
?><script type="text/javascript"
     src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML">
  </script>
  <?php 
  }
  ?>
<center><?php 
if($this->uri->segment(2) != 'attempt'  && $this->uri->segment(1) != 'install'){
	$this->db->where("add_status","Active");
	$this->db->where("position","Bottom");
	$query=$this->db->get('savsoft_add');
	if($query->num_rows()==1){
	$ad=$query->row_array();
	if($ad['advertisement_code'] != ""){
	echo $ad['advertisement_code'];
	}else if($ad['banner']!=''){ ?><a href="<?php echo $ad['banner_link'];?>" target="new_add"><img src="<?php echo base_url('upload/'.$ad['banner']);?>" class="img-responsive"  ></a> <?php    
	
	}
	}
	}
	
	
?></center>


<?php
$during_quiz="";
if($this->uri->segment(2) == 'attempt'){
	$this->db->where("add_status","Active");
	$this->db->where("position","During_Quiz");
	$query=$this->db->get('savsoft_add');
	if($query->num_rows()==1){
	$ad=$query->row_array();
	if($ad['advertisement_code'] != ""){
	$during_quiz=$ad['advertisement_code'];
	}else if($ad['banner']!=''){ 
	$during_quiz="<a href='".$ad['banner_link']."' target='new_add'><img src='".base_url('upload/'.$ad['banner'])."' class='img-responsive'  ></a>";
	}
	}
	}
	
 
if($during_quiz != ""){
?>




<?php
}	
	?>
	 



<?php 
if($this->config->item('tinymce')){
					if($this->uri->segment(2)!='attempt'){
					if($this->uri->segment(2)!='view_result'){

					if($this->uri->segment(2)!='config'){
					if($this->uri->segment(2)!='css'){
					if($this->uri->segment(2)!='edit_advertisment'){

	
	?>
	<script type="text/javascript" src="<?php echo base_url();?>editor/tinymce.min.js"></script>
	 
 <?php 
 if($this->uri->segment(2)=='edit_quiz' || ($this->uri->segment(2)=='add_new' && $this->uri->segment(1)=='quiz')){
?>
<script type="text/javascript">
  tinymce.init({
  selector: '.tinymce_textarea',
  height: 100,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link image jbimages <?php if($this->config->item('eqneditor')){ ?>eqneditor<?php } ?> charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
  ],
  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages | <?php if($this->config->item('eqneditor')){ ?>eqneditor<?php } ?>',
  toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });
 
 </script>

 

<?php 
 }else{
?>

	<script type="text/javascript">
  tinymce.init({
  selector: 'textarea',
  images_dataimg_filter: function(img) {
    return img.hasAttribute('internal-blob');
  },
  height: 100,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link image jbimages <?php if($this->config->item('eqneditor')){ ?>eqneditor<?php } ?> <?php if($this->config->item('wiris')){ ?>tiny_mce_wiris<?php } ?>  charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
  ],
  // toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |  jbimages | <?php if($this->config->item('eqneditor')){ ?>eqneditor<?php } ?> <?php if($this->config->item('wiris')){ ?> | tiny_mce_wiris_formulaEditor | tiny_mce_wiris_formulaEditorChemistry | tiny_mce_wiris_CAS <?php } ?>',
  // toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
  toolbar1: 'bold italic | alignleft aligncenter alignright alignjustify | link image |  jbimages | <?php if($this->config->item('eqneditor')){ ?>eqneditor<?php } ?> ',

  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });
 
 </script>

<?php 
 }
 ?>
 
 

	
	<?php 
	}
						}
					}
			}
		}
	}
?>







<?php 
if($this->session->userdata('logged_in')){
$logged_in=$this->session->userdata('logged_in');
$tuid=$logged_in['uid'];
if($this->uri->segment(2)!='attempt'){
?>
<!-- firebase notification code starts -->
<!--
<script src="https://www.gstatic.com/firebasejs/3.8.0/firebase.js"></script>
<script>
  // Initialize Firebase
  
  var config = {
    apiKey: "<?php echo $this->config->item('firebase_apiKey');?>",
    authDomain: "<?php echo $this->config->item('firebase_authDomain');?>",
    databaseURL: "<?php echo $this->config->item('firebase_databaseURL');?>",
    projectId: "<?php echo $this->config->item('firebase_projectId');?>",
    storageBucket: "<?php echo $this->config->item('firebase_storageBucket');?>",
    messagingSenderId: "<?php echo $this->config->item('firebase_messagingSenderId');?>"
  };
 
  firebase.initializeApp(config);
 

// Retrieve Firebase Messaging object.
const messaging = firebase.messaging();

messaging.requestPermission()
.then(function() {
  console.log('Notification permission granted.');
  // TODO(developer): Retrieve an Instance ID token for use with FCM.
  // ...
})
.catch(function(err) {
  console.log('Unable to get permission to notify.', err);
});


// Get Instance ID token. Initially this makes a network call, once retrieved
  // subsequent calls to getToken will return from cache.
  messaging.getToken()
  .then(function(currentToken) {
    if (currentToken) {
      console.log('token.'+currentToken);
      sendTokenToServer(currentToken);
      // updateUIForPushEnabled(currentToken);
    } else {
      // Show permission request.
      console.log('No Instance ID token available. Request permission to generate one.');
      // Show permission UI.
      // updateUIForPushPermissionRequired();
      setTokenSentToServer(false);
    }
  })
  .catch(function(err) {
    console.log('An error occurred while retrieving token. ', err);
   //  showToken('Error retrieving Instance ID token. ', err);
    setTokenSentToServer(false);
  });
 


// Callback fired if Instance ID token is updated.
messaging.onTokenRefresh(function() {
  messaging.getToken()
  .then(function(refreshedToken) {
    console.log('Token refreshed.');
    // Indicate that the new Instance ID token has not yet been sent to the
    // app server.
    setTokenSentToServer(false);
    // Send Instance ID token to app server.
    sendTokenToServer(refreshedToken);
    // ...
  })
  .catch(function(err) {
    console.log('Unable to retrieve refreshed token ', err);
    // showToken('Unable to retrieve refreshed token ', err);
  });
});



  function setTokenSentToServer(sent) {
    window.localStorage.setItem('sentToServer', sent ? 1 : 0);
  }
  function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer()) {
    // register web token to user account
    	 	 
	var formData = {currentToken:currentToken};
	$.ajax({
		 type: "POST",
		 data : formData,
		url: base_url + "index.php/notification/register_token/web/<?php echo $tuid;?>",
		success: function(data){
	 	
			},
		error: function(xhr,status,strErr){
			//alert(status);
			}	
		});
		
	subscribeTokenToTopic(currentToken,'<?php echo $this->config->item('firebase_topic');?>');	
      console.log('Sending token to server...');
      // TODO(developer): Send the current token to your server.
      setTokenSentToServer(true);
    } else {
      console.log('Token already sent to server so won\'t send it again ' +
          'unless it changes');
    }
  }
  
   function isTokenSentToServer() {
    if (window.localStorage.getItem('sentToServer') == 1) {
          return true;
    }
    return false;
  }



  // [START receive_message]
  // Handle incoming messages. Called when:
  // - a message is received while the app has focus
  // - the user clicks on an app notification created by a sevice worker
  //   `messaging.setBackgroundMessageHandler` handler.
  messaging.onMessage(function(payload) {
    console.log("Message received. ", payload);
    // [START_EXCLUDE]
    // Update the UI to include the received message.
    appendMessage(payload);
    // [END_EXCLUDE]
  });
  // [END receive_message]


  // Add a message to the messages element.
  function appendMessage(payload) {
// var fcmobj = jQuery.parseJSON(payload);
 
  $('#fcm_modal').modal('show');
  var titl="<a href='"+payload.notification.click_action+"' target='fcmaction'>"+payload.notification.title+"</a>";
 $('#fcm_modal_title').html(titl);
  $('#fcm_modal_body').html(payload.notification.body);
 
  }
  // Clear the messages element of all children.
  function clearMessages() {
    const messagesElement = document.querySelector('#messages');
    while (messagesElement.hasChildNodes()) {
      messagesElement.removeChild(messagesElement.lastChild);
    }
  }
  
 
 
 
 function subscribeTokenToTopic(token, topic) {
  fetch('https://iid.googleapis.com/iid/v1/'+token+'/rel/topics/'+topic, {
    method: 'POST',
    headers: new Headers({
      'Authorization': 'key=<?php echo $this->config->item('firebase_serverkey');?>'
    })
  }).then(response => {
    if (response.status < 200 || response.status >= 400) {
      throw 'Error subscribing to topic: '+response.status + ' - ' + response.text();
    }
    console.log('Subscribed to "'+topic+'"');
  }).catch(error => {
    console.error(error);
  })
}

</script>
-->
<?php 
}
}
?>
<!-- firebase notification code ends -->


<div id="messages"></div>

<!--  firebase notification model starts -->
<div id="fcm_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="fcm_modal_title"></h4>
      </div>
      <div class="modal-body">
        <p id="fcm_modal_body"></p>
      </div>
       
    </div>

  </div>
</div>

<!--  firebase notification model ends --> 





<!-- duplicate question check -->
<div id="duplicate_question" style="display:none;position:fixed;z-index:1000;width:100%;bottom:0px;height:220px;overflow-y:auto;background:#212121;color:#ffffff;padding:8px;">

<a href="javascript:canceldupli();" style="float:right;"><i class="fa fa-times"></i></a>
<div id="duplicate_question2">

</div>
</div>
<script>
var showdupli=1;
function canceldupli(){
$('#duplicate_question').css('display','none');	
showdupli=0;
}
		
function myCustomOnChangeHandler(inst) {
         
      tinyMCE.triggerSave();
       var question=$('#question').val();
if(question != '' && showdupli == 1){
$('#duplicate_question').css('display','block');

	var formData = {question:question};
	$.ajax({
		 type: "POST",
		 data : formData,
		url: base_url + "index.php/duplicate_question/index",
		success: function(data){
		 
		if(data.trim() != ''){
	 	$('#duplicate_question2').html(data);
	 	}else{
	 	 
	 	$('#duplicate_question').css('display','none');
	 	}
			},
		error: function(xhr,status,strErr){
			//alert(status);
			}	
		});
		}else{
$('#duplicate_question').css('display','none');		
		}
}

 		
</script>

<script>

function toogleid(id){
var did="#"+id;
$(did).toggle();

}

</script>
<!-- dupllicate question check ends -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML"></script>
</body>
</html>
