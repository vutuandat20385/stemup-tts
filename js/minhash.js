String.prototype.hashCode = function(a,b) {
  p=4294967297;
  var hash = 0, i, chr;
  if (this.length === 0) return hash;
  for (i = 0; i < this.length; i++) {
    chr   = this.charCodeAt(i);
    hash  = ((hash << 5) - hash) + chr;
    hash |= 0; 
	hash+=p-1;
	hash = (a*hash+b)%p;
  }
  return hash;
};


function minhash(str,a,b){
	min=Number.MAX_SAFE_INTEGER;
	
    for(j=0; j<str.length; j++){
	   hc =str[j].hashCode(a,b);
	   if(hc<min) min=hc;
    }     
	return min;
}
function checkmh(str, val, a, b){
	res = false;
	min=Number.MAX_SAFE_INTEGER;
	
    for(j=0; j<str.length; j++){
	   hc =str[j].hashCode(a,b);
	   if(hc<min) min=hc;
	   if(min<val)
		   break; 
    } 
    if(val==min)  res=true;
	return res;
}


function sim(str, numhashfunc){
	if(similar) {
		if(str==""){
			alert("Vui lòng nhập câu hỏi trước")
		}
		else
			alert("Câu hỏi trùng lặp!!!!");
	}
	else
	if(checksim){
		checksim=false;
		strar=str.split(" ");
		var sr ="";
		if(str!="") 
			if(strar.length>2){
				sr=strar[0]+" "+strar[1]+"-"+strar[strar.length-1];
			}
			else{
				sr=strar[0]+ "-"+strar[strar.length-1];
			}

		var inf={'search': sr };
		var src=JSON.stringify(inf);
		if(str!="")
		$.ajax({
			  type: 'POST',
			  url: site_url+"/qbank/load_question_shingles",
			  data: src,
			  contentType: 'application/json',
			  success: function(data) {
				  
				  isSim=false;
				  
				  for(i=0; i<data.length; i++){
					  count=0;count2=0;
					  spdata=data[i]["question"].split(" ");
					  if(Math.abs(spdata.length-strar.length)<3){
						  for (hi=0; hi<numhashfunc; hi++){
							  a = Math.floor(Math.random() * 10000000);
							  b = Math.floor(Math.random() * 10000000);
							  val=minhash(strar,2*a+1,b);
							  
							  if(checkmh(spdata, val, 2*a+1,b)){
									count++;
									if(count>numhashfunc*9/10) {
										isSim=true;
										checksim=true;
										similar=true;
										if(str==""){
											alert("Vui lòng nhập câu hỏi trước");
										}
										else
										    alert("Câu hỏi trùng lặp!!!!");
										    alert("Câu hỏi trùng lặp!!!!");
										$("#savebt").attr("style","display:none");
										break;	
									}
							  }
							  else{
								  count2++;
								  if(count2>numhashfunc/10) {
									 break;
								  }
							  }
						  }
					  }
					  if(isSim){
						 break;
					  }
                      
				  }
				  if(!isSim){
					  $("#savebt").attr("style","");
				  }
				  
			  },
			  error: function(xhr,status,strErr){
					console.log(xhr);
					console.log(status);
					console.log(strErr);
			}
		});  
	}
}

function sim2(str, numhashfunc){
	if(similar2) {
		if(str==""){
			alert("Vui lòng nhập câu hỏi trước")
		}
		else
			alert("Câu hỏi trùng lặp!!!!");
	}
	else
	if(checksim2){
		checksim2=false;
		strar=str.split(" ");
		var sr ="";
		if(str!="")
			if(strar.length>2){
				sr=strar[0]+" "+strar[1]+"-"+strar[strar.length-2]+" "+strar[strar.length-1];
			}
			else{
				sr=strar[0]+ "-"+strar[strar.length-1];
			}

		var inf={'search': sr };
		var src=JSON.stringify(inf);
		if(str!="")
		$.ajax({
			  type: 'POST',
			  url: site_url+"/qbank/load_question_shingles",
			  data: src,
			  contentType: 'application/json',
			  success: function(data) {
				  isSim2=false;
				  
				  for(i=0; i<data.length; i++){
					  count3=0;count4=0;
					  spdata=data[i]["question"].split(" ");
					  if(Math.abs(spdata.length-strar.length)<3){
						  for (hi=0; hi<numhashfunc; hi++){
							   a = Math.floor(Math.random() * 10000000);
							  b = Math.floor(Math.random() * 10000000);
							  val=minhash(strar,2*a+1,b);
							  
							  if(checkmh(spdata, val, 2*a+1,b)){
									count3++;
									if(count3>numhashfunc*9/10) {
										isSim2=true;
										checksim2=true;
										similar2=true;
										if(str==""){
											alert("Vui lòng nhập câu hỏi trước");
										}
										else
										    alert("Câu hỏi trùng lặp!!!!");
										$("#loadopt").attr("style","display:none");
										break;	
									}
							  }
							  else{
								  count4++;
								  if(count4>numhashfunc/10) {
									 break;
								  }
							  }
						  }
					  }
					  if(isSim2){
						 break;
					  }
                      
				  }
				  if(!isSim2){
					  $("#loadopt").attr("style","");
				  }
				  
			  },
			  error: function(xhr,status,strErr){
					console.log(xhr);
					console.log(status);
					console.log(strErr);
			}
		});  
	}
}
