<head>
<script src="<?php echo base_url('js/jquery-1.11.3.min.js');?>"></script>
</head>
<script language="javascript">
            function load_ajax(){
                $('#textclick').click(function(){
					alert('Click!');
				});
            }
        </script>
<body>

		
		<div id="result">
            Nội dung ajax sẽ được load ở đây
        </div>
        <input type="button" name="clickme" id="clickme"  value="Click Me"/>
		
		<a href="#" id="textclick">Click</a>
		
		
</body>