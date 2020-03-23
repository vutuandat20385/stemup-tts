$(document).ready(function(){
	
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
	
	$("#bgq1_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/1.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid_main").val(1);
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		console.log(x.length);
		$("#qwbgpr").append(x);
	});

   	$("#bgq2_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/2.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid_main").val(2);
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});
  
  	$("#bgq3_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/3.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			$("#bgqid_main").val(3);
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});
	
	$("#bgq4_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/4.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid_main").val(4);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});
	
	$("#bgq5_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/5.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid_main").val(5);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});
	
	$("#bgq6_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/6.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid_main").val(6);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});
	
	$("#bgq7_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/7.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid_main").val(7);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	
	$("#bgq8_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/8.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid_main").val(8);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});
	
	$("#bgq9_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/9.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid_main").val(9);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#bgq10_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/10.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid_main").val(10);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});
	
	$("#bgq11_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/11.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid_main").val(11);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	
	$("#bgq12_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/12.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid_main").val(12);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	
	$("#bgq13_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/13.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid_main").val(13);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	
	$("#bgq14_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/14.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid_main").val(14);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	
	$("#bgq15_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/15.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid_main").val(15);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#bgq16_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/16.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid_main").val(16);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#bgq17_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/17.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid_main").val(17);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});
 
	$("#bgq18_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/18.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid_main").val(18);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

    $("#bgq19_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/19.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid_main").val(19);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});

	$("#bgq20_main").on('click',function(){                                                  
		$("#question_wbg").modal({
			   backdrop:'static'
		   });
		$("#qwbgpr").empty();
		x= tinyMCE.get('create_question_main').getContent();
		if(x.indexOf('<img')==-1 && x.indexOf("<iframe")==-1){
			$("#question_wbg>.modal-dialog>.modal-content>.modal-body").attr('style','text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -1px black;background-image:url("https://stemup.app/upload/background/20.jpg"); height:300px');
			$("#fclqpr").attr('color','white');
			x=x.replace(/<\/?[^>]+(>|$)/g, "");
			$("#bgqid_main").val(20);
		}
		if(x.length>100){
			$("#qwbgpr").attr('style','font-size: 20px; text-align:center ;font-weight: 700;padding: 50px 27px;');
		
		}
		$("#qwbgpr").append(x);
	});


	
	
	$("#clmdprbg").on('click', function(){
		tinyMCE.get('question').setContent($("#qwbgpr").html());
		tinyMCE.get('create_question_main').setContent($("#qwbgpr").html());
	});
	
	$("#clmdprbg_1").on('click', function(){
		tinyMCE.get('question').setContent($("#qwbgpr").html());
		tinyMCE.get('create_question_main').setContent($("#qwbgpr").html());
	});
    
	

	
	
})