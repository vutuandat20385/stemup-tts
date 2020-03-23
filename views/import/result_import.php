<h3 class="col-md-12 col-md-offset-2"><?php echo $title;?></h3>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<form method="post" action="<?php echo site_url('user/process_excel')  ?>" enctype="multipart/form-data">
   <div class="login-panel panel panel-default col-md-7 col-md-offset-2">
		<div class="panel-body"> 
			<?php 
				if($this->session->flashdata('message')){
					echo $this->session->flashdata('message');	
				}
				
				foreach($file as $i=>$f){	
				?>
				  
				  <h4> <?php echo $i+1 ?>.  <a href="<?php echo base_url($f['filename'])?>"><?php echo $f['title']?> </a></h4><br/>
				<?php 		
				}
			?>
              
            <div><a type="button" class="btn btn-default" href="<?php echo site_url('/user/import_user')?>">Quay lại</a></div>
			</div>			
		</div>

	</div>
</form> 