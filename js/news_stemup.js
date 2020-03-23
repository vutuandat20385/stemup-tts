

function drawpage_news_qt(page){
	limit=$("#inf_limit").val();
	redrawrsnews(limit,page);
}

function redrawrsnews(limit,page){
	
	dt=JSON.stringify({'limit':limit,
						'page':page					   
	                  });
	$(".news-list").empty();
	
	$.ajax({
	  	type: 'POST',
	  	url: site_url+"/Home/get_data_news/",
	  	data: dt,
	  	contentType: 'application/json',
	  	success: function(dataq) {
	  		var url = site_url+'/home/tintuc'+'/';
	  		var html="";


	  		console.log(dataq);
	  		for(i=0;i<dataq.list.length;i++){
	  			string = dataq.list[i]['description'];
		  		html+='<div class="col-md-6"> ';
					
				html+='<div class="box mb-3">';
				
				html+='<figure class="snip1581"><img class="d-block w-100 avatar-news" src="'+dataq.list[i]['avatar']+'" alt="profile-sample2">';
				html+='<a href="'+url+dataq.list[i]['url_name']+'"></a></figure>';
				
							
				html+='<div class="box-tin">';
				html+='<a class="text-a1" href="'+url+dataq.list[i]['url_name']+'">'+dataq.list[i]['name']+'</a>';
				html+='<p class="text-muted">'+dataq.description1+'</p>';

				html+='<a class="btn btn-danger btn-sm" href="'+url+dataq.list[i]['url_name']+'">Xem thêm</a>';
				html+='</div></div></div>';
				


		  		
	   		}
   			html+='<div class="col-md-12"><p>Đang xem <span id="beginqt">';
	  		html+= Math.min(limit*page+1,dataq.num_list);
	  		html+='</span>';
	  		html+=' đến <span id="endqt">'+Math.min(limit*(page+1),dataq.num_list)+'</span>'; 
	  		html+=' trong tổng số <span id="totalqt">'+dataq.num_list;
			html+='</span> mục tin tức</p></div>';



			html+='<center><div id="pagination" class="row">';
			html+='<div id="pagination_page" class="col-md-7">';
			html+='<ul class="pagination listpage pageqt">';
				if(dataq.num_page<7){
					  for(i=0; i<dataq.num_page; i++){
						  html+='<li class="page-item';
						  if(i==page){
							   html+=' active';
						  }
						  html+='" onclick="drawpage_news_qt('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
					  }
					  
					 
				  }
				  else{
					  if(page<=3){
						  for(i=0; i<5; i++){
							  html+='<li class="page-item';
							  if(i==page){
								   html+=' active';
							  }
							  html+='" onclick="drawpage_news_qt('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
						  }
						  html+='<li class="page-item"><a class="page-link">...</a></li>';
						  html+='<li class="page-item" onclick="drawpage_news_qt('+(data.num_page-1)+')"><a class="page-link">'+data.num_page1+'</a></li>';
					  }
					  else{
						  html+='<li class="page-item" onclick="drawpage_news_qt(0)"><a class="page-link">1</a></li>';
						  html+='<li class="page-item"><a class="page-link">...</a></li>';
						  
						  if(page<data.num_page1-4){
							  html+='<li class="page-item" onclick="drawpage_news_qt('+(page-1)+')"><a class="page-link">'+page+'</a></li>';
							  html+='<li class="page-item active" onclick="drawpage_news_qt('+page+')"><a class="page-link">'+(page+1)+'</a></li>';
							  html+='<li class="page-item" onclick="drawpage_news_qt('+(page+1)+')"><a class="page-link">'+(page+2)+'</a></li>';
							  html+='<li class="page-item"><a class="page-link">...</a></li>';
							  html+='<li class="page-item" onclick="drawpage_news_qt('+(data.num_page1-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
						  }
						  else{
							  for(i=page-2; i<data.num_page; i++){
								  html+='<li class="page-item';
								  if(i==page){
									  html+=" active";
								  }
								  html+='" onclick=drawpage_news_qt('+i+')"><a class="page-link">'+(i+1)+'</a></li>';
							  }
							  
						  }
					  }
				  }
				html+='</ul></div></div>';
				html+='<div style="display: none">';
				html+='<input type="text" id="inf_page" value="0">';
				html+='<input type="text" id="inf_limit" value="6">';
				html+='</div>';	


	  		$(".news-list").append(html);
	  		

	  	},
		error: function(data) {
			console.log(data);
			  
		}
	});
	
}                 	
