function testconnection(){
	 var ims ={
		"host_name": $('#host_name').val(),
        "port": $('#port').val(),
		"user_name": $('#user_name').val(),
        "password": $('#password').val()
	 };
	 

	 var infoms =JSON.stringify(ims);
	 $.ajax({
      type: 'POST',
      url: site_url+"/system_config/test_connect_ms",
      data: infoms,
      contentType: 'application/json',
      success: function(data) {
		     alert(data);
      },
      error : function(data) {
		 console.log("error");
      }	  
	  
    });
}

function update_ms_config(){
	 var ims ={
		"host_name": $('#host_name').val(),
        "port": $('#port').val(),
		"user_name": $('#user_name').val(),
        "password": $('#password').val()
	 };
	 

	 var infoms =JSON.stringify(ims);
	 $.ajax({
      type: 'POST',
      url: site_url+"/system_config/update_ms_config",
      data: infoms,
      contentType: 'application/json',
      success: function(data) {
		     alert(data);
      },
      error : function(data) {
		 console.log("error");
      }	  
	  
    });
}

function update_firebase_config(){
  var ims ={
    "firebase_serverkey": $('#firebase_serverkey').val(),
    "firebase_topic": $('#firebase_topic').val()
  };
   

  var infoms =JSON.stringify(ims);
    $.ajax({
      type: 'POST',
      url: site_url+"/system_config/update_firebase_config",
      data: infoms,
      contentType: 'application/json',
      success: function(data) {
        alert(data);
      },
      error : function(data) {
        console.log("error");
      }
    });
}