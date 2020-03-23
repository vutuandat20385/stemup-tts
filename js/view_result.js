function load_statistic_mcq(qid){
  	$.ajax({
		  type: 'POST',
		  url: site_url+"/result/get_statistic_mcq/"+qid,
		  data: {},
		  contentType: 'application/json',
		  success: function(data) {
			  console.log(data);  
			  $(".box-statans-res.menu-btn").empty();
			  if(data.n_answers>0){
				  html= '<div class="col-xs-12 text-right mgr-20" style="float:right" >';
				   html+='<p class="f11"><i style="width:20px" class="fas fa-users mr-5 bo-tron bg-danger"></i><strong class="text-danger">';
				   html+= Math.ceil(100*data.n_correct_answers/data.n_answers)+'%</strong> trả lời đúng</p>';
			       html+='</div>';
			    $(".box-statans-res.menu-btn").append(html);
			  }
			  $(".text-res.social_area").empty();
              
			  if(data.liked==1){
				 html='<li class="col-xs-4"><a class="acti pointer"  onclick="like_question(this , '+qid+')"><i class="fas fa-thumbs-up mr-5"></i>Thích</a></li>';
			  } else{
				 html='<li class="col-xs-4"><a class="pointer"  onclick="like_question(this , '+qid+')">Thích</a></li>';
			  }
			  html+='<li class="col-xs-4"><a class="pointer" data-toggle="collapse" data-target="#comment_area_main_'+qid+'" ><i class="far fa-comment-alt mr-5"></i>Bình luận</a></li>';
			  html+='<li class="col-xs-4"><a class="pointer" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fstemup.app%2Findex.php%2Fpage%2Fquestion%2F'+data.permalink+'&amp;src=sdkpreparse" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); count_share('+qid+');return false;"><i class="fas fa-share-alt mr-5"></i>Chia sẻ</a></li>';
			  $(".text-res.social_area").append(html);
			  
			  $("#like_statistic_"+qid).empty();
			  html="";
			  if(data.liked==1 || data.n_like>0 ){
				  html='<div class="col-xs-12 bo-B" >';		 
				  html+='<i style="width:20px" class="fas fa-thumbs-up mr-5 bo-tron bg-primary"></i>';
				  html+='<a class="f10" href="#" style="color:#337ab7">';
				  if(data.liked==1){
							 
					 if(data.n_like >0) { 
						html+= 'Bạn và';
					 } 
					 else 
						 html+= data.user_name;
				  }
				  if(data.n_like >0) {
							 html+= " "+data.n_like+' người' ;
				  }
				 html+=	'</a>';
				 html+='</div>';
			  }
			  
			  $("#like_statistic_"+qid).append(html);
			   
			  $("#box_comment_"+qid).empty(); 
			  html='<div class="media-object-default">';
		      for(i=0; i<data.comment.length;  i++){ 
				 html+='<div class="media">';
	             html+='<div class="media-left">';
				 html+='<a href="#">';
				 if(data.comment[i]['photo']) {
					 html+=	'<img class="media-object img-circle" src="'+data.comment[i]['photo']+'" width="36" alt="placeholder image">';
                 } else{ 
					html+='<img class="media-object img-circle" src="'+base_url+'/upload/avatar/default.png" width="36" alt="placeholder image">';
				 }
				 html+='</a>';
				 html+='</div>';
				 html+= '<div class="media-body">';
				 html+='<h4 class="media-heading"><a href="">'+data.comment[i]['first_name']+" "+data.comment[i]['last_name']+'</a></h4>';
				 html+=data.comment[i]['content'];				 
				 html+='</div>';			
				 html+='</div>';
                          
				} 
									  
			   html+='</div>'; 
			   $("#box_comment_"+qid).append(html);
		 },
		  error:function(data) {}
		});
}