function updateQueryStringParameter(uri, key, value) {
    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
      return uri.replace(re, '$1' + key + "=" + value + '$2');
    }
    else {
      return uri + separator + key + "=" + value;
    }
  }
  function search_qbank(event,e,site_url){
       if(e.keyCode=='13'){
           s= $(event).val();
          while(s.indexOf("+")>-1)
              s =s.replace("+","%2B");
          while(s.indexOf(" ")>-1)
              s =s.replace(" ","+");
          new_url=encodeURI(updateQueryStringParameter(window.location.href,'search',s));
          spilit_url = new_url.split("?");
          index=  new_url.indexOf("/",-1);
          index_qbank = new_url.indexOf("qbank/index",-1);
          if(index_qbank!= -1){
            new_url =new_url.substring(0,index)+"0?"+spilit_url["1"];
          }
          else{
            new_url =new_url.substring(0,index)+"qbank/index/0/0/0/0?"+spilit_url["1"];
          }
          window.location.assign(new_url);
       }
  }
  function search_qbank1(site_url){
   s=$('#txtSearch').val();
       while(s.indexOf("+")>-1)
           s =s.replace("+","%2B");
       while(s.indexOf(" ")>-1)
           s =s.replace(" ","+");
       new_url=encodeURI(updateQueryStringParameter(window.location.href,'search',s));
       spilit_url = new_url.split("?");
       index=  new_url.indexOf("/",-1);
        index_qbank = new_url.indexOf("qbank/index",-1);
          if(index_qbank!= -1){
            new_url =new_url.substring(0,index)+"0?"+spilit_url["1"];
          }
          else{
            new_url =new_url.substring(0,index)+"qbank/index/0/0/0/0?"+spilit_url["1"];
          }
       window.location.assign(new_url);
  }
  function search_quiz(event,e,site_url){
    if(e.keyCode=='13'){
        s= $(event).val();
       while(s.indexOf("+")>-1)
           s =s.replace("+","%2B");
       while(s.indexOf(" ")>-1)
           s =s.replace(" ","+");
       new_url=encodeURI(updateQueryStringParameter(window.location.href,'search',s));
       spilit_url = new_url.split("?");
       index=  new_url.indexOf("/",-1);
       index_quiz = new_url.indexOf("/quiz/index/",-1);
       if(index_quiz != -1 ){
        new_url =new_url.substring(0,index)+"0?"+spilit_url["1"];
       }
       else{
        new_url =new_url.substring(0,index)+"index/grid/0?"+spilit_url["1"];
       }
   
       window.location.assign(new_url);
    }
}
function search_quiz1(site_url){
s=$('#txtSearch').val();
    while(s.indexOf("+")>-1)
        s =s.replace("+","%2B");
    while(s.indexOf(" ")>-1)
        s =s.replace(" ","+");
    new_url=encodeURI(updateQueryStringParameter(window.location.href,'search',s));
    spilit_url = new_url.split("?");
    index=  new_url.indexOf("/",-1);
    index_quiz = new_url.indexOf("/quiz/index/",-1);
    if(index_quiz != -1 ){
     new_url =new_url.substring(0,index)+"0?"+spilit_url["1"];
    }
    else{
     new_url =new_url.substring(0,index)+"quiz/index/grid/0?"+spilit_url["1"];
    }
//    new_url1 = site_url+"/quiz/index/0/grid?"+spilit_url["1"];
    window.location.assign(new_url);
}

function search_result(event,e,site_url){
    if(e.keyCode=='13'){
        s= $(event).val();
       while(s.indexOf("+")>-1)
           s =s.replace("+","%2B");
       while(s.indexOf(" ")>-1)
           s =s.replace(" ","+");
    new_url=encodeURI(updateQueryStringParameter(window.location.href,'search',s));
    spilit_url = new_url.split("?");
    index=  new_url.indexOf("/",-1);
    index_quiz = new_url.indexOf("/result/index/",-1);
    if(index_quiz != -1 ){
     new_url =new_url.substring(0,index)+"0?"+spilit_url["1"];
    }
    else{
     new_url =new_url.substring(0,index)+"result/index/0/0?"+spilit_url["1"];
    }
//    new_url1 = site_url+"/quiz/index/0/grid?"+spilit_url["1"];
    window.location.assign(new_url);
    }
}
function search_result1(site_url){
    s=$('#txtSearch').val();
    while(s.indexOf("+")>-1)
        s =s.replace("+","%2B");
    while(s.indexOf(" ")>-1)
        s =s.replace(" ","+");
        new_url=encodeURI(updateQueryStringParameter(window.location.href,'search',s));
        spilit_url = new_url.split("?");
        index=  new_url.indexOf("/",-1);
        index_quiz = new_url.indexOf("/result/index/",-1);
        if(index_quiz != -1 ){
         new_url =new_url.substring(0,index)+"0?"+spilit_url["1"];
        }
        else{
         new_url =new_url.substring(0,index)+"result/index/0/0?"+spilit_url["1"];
        }
        window.location.assign(new_url);
}

 function search_question_into_quiz(event,e,site_url){
    if(e.keyCode=='13'){
        s= $(event).val();
       while(s.indexOf("+")>-1)
           s =s.replace("+","%2B");
       while(s.indexOf(" ")>-1)
           s =s.replace(" ","+");
       new_url=encodeURI(updateQueryStringParameter(window.location.href,'search',s));
       spilit_url = new_url.split("?");
	index=  new_url.indexOf("/",-1);
	new_url =new_url.substring(0,index)+"0?"+spilit_url["1"];
    window.location.assign(new_url);
    }
}
function search_question_into_quiz1(site_url){
s=$('#txtSearch').val();
    while(s.indexOf("+")>-1)
        s =s.replace("+","%2B");
    while(s.indexOf(" ")>-1)
        s =s.replace(" ","+");
    new_url=encodeURI(updateQueryStringParameter(window.location.href,'search',s));
	 spilit_url = new_url.split("?");
	index=  new_url.indexOf("/",-1);
	new_url =new_url.substring(0,index)+"0?"+spilit_url["1"];
    window.location.assign(new_url);
}
function search_user(event,e,site_url){
    if(e.keyCode=='13'){
        s= $(event).val();
       while(s.indexOf("+")>-1)
           s =s.replace("+","%2B");
       while(s.indexOf(" ")>-1)
           s =s.replace(" ","+");
        var str = window.location.href;   
        var res = str.replace(site_url+"/", "");
        var ss = res.split('?');
        var aa = ss[0];
        var cc = aa.split('/');
        if(cc[0] == '')
        {
            cc[0]= 'index';
        }
        var ee = site_url+"/index" +'/0?';
       new_url=encodeURI(updateQueryStringParameter(ee,'search',s));
       window.location.assign(new_url);
    }
}



function search_user1(site_url){
s=$('#txtSearch').val();
    while(s.indexOf("+")>-1)
        s =s.replace("+","%2B");
    while(s.indexOf(" ")>-1)
        s =s.replace(" ","+");
        var str = window.location.href;
        var res = str.replace(site_url+"/", "");
        var ss = res.split('?');
        var aa = ss[0];
        var cc = aa.split('/');
        if(cc[0] == '')
        {
            cc[0]= 'index';
        }
        var ee = site_url+"/index" +'/0?';
       new_url=encodeURI(updateQueryStringParameter(ee,'search',s));
       window.location.assign(new_url);
}
function fitter_status(val,s){
    s= s=$('#txtSearch').val();
	window.location=base_url+"index.php/result/index/"+val+"/0?search="+s;
}
