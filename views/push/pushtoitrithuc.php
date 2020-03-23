<script src="<?php echo base_url('js/jquery.js');?>"></script>
<script>

console.log(1);
$(document).ready(function(){
   var form = new FormData();
	form.append("subject", "2");
	form.append("grade", "1");
	form.append("chapter_id", "0");
	form.append("level", "1");
	form.append("question", "1+3=? ");
	form.append("answer1", "2");
	form.append("answer2", "3");
	form.append("answer3", "4");
	form.append("answer4", "5");
	form.append("question_image", "");
	form.append("correct_answer", "3");
	form.append("explanation", "");

	var settings = {
	  "async": true,
	  "crossDomain": true,
	  "url": "http://tracnghiem.itrithuc.vn/api/question/submit?api_key=rnCtS8RVSlAyPHgfmb7xGnzTvRA9ApNT",
	  "method": "POST",
	  "headers": {
		"cache-control": "no-cache",
		"Access-Control-Allow-Origin":"*"
	  },
	  "processData": false,
	  "contentType": false,
	  "mimeType": "multipart/form-data",
	  "data": form
	}

	$.ajax(settings).done(function (response) {
	  console.log(response);
	});
	
});

</script>