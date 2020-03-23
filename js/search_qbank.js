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
  function search_qbank(event,e){
       if(e.keyCode=='13'){
           s= $(event).val();
          while(s.indexOf("+")>-1)
              s =s.replace("+","%2B");
          while(s.indexOf(" ")>-1)
              s =s.replace(" ","+");
          new_url=encodeURI(updateQueryStringParameter(window.location.href,'search',s));
         
          window.location.assign(new_url);
       }
  }
  function search_qbank1(){
   s=$('#txtSearch').val();
       while(s.indexOf("+")>-1)
           s =s.replace("+","%2B");
       while(s.indexOf(" ")>-1)
           s =s.replace(" ","+");
       new_url=encodeURI(updateQueryStringParameter(window.location.href,'search',s));
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
       new_url1 = site_url+"/quiz/index/0/grid?"+spilit_url["1"];
       window.location.assign(new_url1);
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
    new_url1 = site_url+"/quiz/index/0/grid?"+spilit_url["1"];
    window.location.assign(new_url1);
}




