function drawpage_sad_news(page){
	search=$("#inf_search").val();
	limit=$("#inf_limit").val();

	redrawrs_admin_news(search,limit,page);
}
function drawsearch_news_qt(event,e){

	limit=$("#inf_limit").val();
	if(e.keyCode=='13'){
     	search= $(event).val();
		redrawrs_admin_news(search,limit,0);
	}	
	
}
function drawsearch_news(){
	search=$("#search_mng_qt").val();
	limit=$("#inf_limit").val();
	page=$("#inf_page").val();
	redrawrs_admin_news(search,limit,0);
}
function redrawrs_admin_news(search,limit,page){
	console.log(search,limit,page);
	dt=JSON.stringify({'search':search,
					   'limit':limit,
					   'page':page
	                  });
	$('#home1').empty();
	$.ajax({
		type: 'POST',
		url: site_url+"/sadmin/get_data_news/",
		data: dt,
		contentType: 'application/json',
		success: function(data) {
			console.log(data);
			html = '<table class="table table-bordered" style="font-size: 14px;width: 95%;"><tr style="background-color: rgba(60, 141, 188, 0.28);">';
			html+= '<th>#</th><th class="ta-c new_avatar" height="80" width="130" >Avatar</th><th height="80" width="130" >Tiêu đề tin</th><th height="80" width="380" >Mô tả</th><th>Thể loại</th><th>Ngày tạo</th><th>vị trí</th><th>Action</th>';							
			// html+= '<th ><input id="search_mng_qt" style="width:70%;margin-left: 15%" onkeyup="drawsearch_news_qt(this,event)">';								
			// html+= '<i class="pointer fa fa-search" onclick="drawsearch_news()"></i>';									
			html+= '</tr>';
			console.log(data.list_news.length);
			for(i=0;i<data.list_news.length;i++){
				html+= '<tr><td>'+data.list_news[i]['id']+'</td>';
				html+= '<td><img src="'+data.list_news[i]['avatar']+'"><img></td>';
				html+= '<td>'+data.list_news[i]['name']+'</td>';
				html+= '<td>'+data.list_news[i]['description']+'</td>';
				html+= '<td>'+data.list_news[i]['category']+'</td>';
				html+= '<td>'+data.list_news[i]['modify_date']+'</td>';
				html+= '<td class="ta-c new_pos"><input type="text" name="inp-pos" style="width: 50px;text-align: center;font-weight: 600;color: #3c8dbc;" value="'+data.list_news[i]['pos']+'"></td>';
				html+= '<td><a href="'+site_url+'/sadmin/edit_news/'+data.list_news[i]['id']+'"><i class="fa fa-pencil-square-o" title="Sửa" style="margin-left: 20%;"></i></a>';
				html+= '<a href="#" class="delete" id="'+data.list_news[i]['id']+'"><i class="fa fa-trash" style="margin-left: 20%;" onclick="delete_news('+data.list_news[i]['id']+')" title="Xóa"></i></a>';
				html+= '</td>';
				html+= '</tr>';
			}





			html+= '</table>';
			html+='<div class="col-md-12"><p>Đang xem <span id="beginqt">';
	  		html+= Math.min(limit*page+1,data.num_list);
	  		html+='</span>';
	  		html+=' đến <span id="endqt">'+Math.min(limit*(page+1),data.num_list)+'</span>'; 
	  		html+=' trong tổng số <span id="totalqt">'+data.num_list;
			html+='</span> mục tin tức</p></div>';



			html+='<center><div id="pagination" class="row">';
			html+='<div id="pagination_page" class="col-md-7">';
			html+='<ul class="pagination listpage pageqt">';
				if(data.num_page<7){
					  for(i=0; i<data.num_page; i++){
						  html+='<li class="page-item';
						  if(i==page){
							   html+=' active';
						  }
						  html+='" onclick="drawpage_sad_news('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
					  }
					  
					 
				  }
				  else{
					  if(page<=3){
						  for(i=0; i<5; i++){
							  html+='<li class="page-item';
							  if(i==page){
								   html+=' active';
							  }
							  html+='" onclick="drawpage_sad_news('+i+')"><a class="page-link">'+(i+1)+'</a></li>'
						  }
						  html+='<li class="page-item"><a class="page-link">...</a></li>';
						  html+='<li class="page-item" onclick="drawpage_sad_news('+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
					  }
					  else{
						  html+='<li class="page-item" onclick="drawpage_sad_news(0)"><a class="page-link">1</a></li>';
						  html+='<li class="page-item"><a class="page-link">...</a></li>';
						  
						  if(page<data.num_page-4){
							  html+='<li class="page-item" onclick="drawpage_sad_news('+(page-1)+')"><a class="page-link">'+page+'</a></li>';
							  html+='<li class="page-item active" onclick="drawpage_sad_news('+page+')"><a class="page-link">'+(page+1)+'</a></li>';
							  html+='<li class="page-item" onclick="drawpage_sad_news('+(page+1)+')"><a class="page-link">'+(page+2)+'</a></li>';
							  html+='<li class="page-item"><a class="page-link">...</a></li>';
							  html+='<li class="page-item" onclick="drawpage_sad_news('+(data.num_page-1)+')"><a class="page-link">'+data.num_page+'</a></li>';
						  }
						  else{
							  for(i=page-2; i<data.num_page; i++){
								  html+='<li class="page-item';
								  if(i==page){
									  html+=" active";
								  }
								  html+='" onclick=drawpage_sad_news('+i+')"><a class="page-link">'+(i+1)+'</a></li>';
							  }
							  
						  }
					  }
				  }
				html+='</ul></div></div>';
				html+='<div style="display: none">';
				html+='<input type="text" id="inf_page" value="0">';
				html+='<input type="text" id="inf_limit" value="5">';
				html+='</div>';	






									 								
			$("#home1").append(html);									
													
			},
		  error: function(data) {
			  console.log(data);
			  
		  }
	});
	
}
  $(document).on('click', '.delete', function(){
        var id = $(this).attr('id');
        if(confirm("Are you sure you want to Delete this data?"))
        {
            $.ajax({
                url:site_url+"/sadmin/delete_news",
                mehtod:"get",
                data:{id:id},
                success:function(data)
                {
                    alert('xoa thanh cong');
                   location.reload();
                }
            })
        }
        else
        {
            return false;
        }
    });

												
function preview_news(id){

}													
function edit_news(id){
	
}													
												
													
												
												
													
																								 
												
													
												
												
													 
											
												
											
											
											
													
														
													
													
													
													
														
													
													
														
												
													
												
														
													
													
														
													
											
										
		

			