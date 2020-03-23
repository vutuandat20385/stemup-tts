<?php
  	$this->load->view('sadmin/head');
	$this->load->model("sadmin_model");
?>
<script> var site_url = "<?php echo site_url() ?>";</script>
<script> var base_url = "<?php echo base_url() ?>";</script>
<link rel="stylesheet" href="<?php base_url(); ?>style/format.css">
<div class="wrapper">

<?php $this->load->view('sadmin/header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <?php $this->load->view('sadmin/leftmenu'); ?>
  </aside>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SITE MAP
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
        <li class="active">Site map</li>
      </ol>
    </section>

    <!-- Main content -->
	<section class="content">
      
      <p>Danh sách các bài tin tức</p>
      <a id="create_sitemap" href="" onClick="create_sitemap()">Tạo sitemap Tin tức</a>
      <div class="">
      	<table id="danhsachtin" class="table table-hover">
      		<thead>
			    <tr>
			      <th class="col-md-1" scope="col">ID</th>
			      <th class="col-md-2" scope="col">Ảnh đại diện</th>
			      <th class="col-md-4" scope="col">Tên bài</th>
			      <th class="col-md-4" scope="col">URL</th>
			      <th class="col-md-1" scope="col"></th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php
			  		foreach ($list_tintuc as $key => $value) {
			  	?>
			  		<tr>
				      <th scope="row"><?php echo $value['id']?></th>
				      <td><img width="80" height="45" src="<?php echo $value['avatar']?>"></td>
				      <td><?php echo $value['name']?></td>
				      <td><?php echo $value['url_name']?></td>
				      <td><i class="fa fa-check-square-o" aria-hidden="true" style="color: green;"></i></td>
				    </tr>
			  	<?php
			  		}
			  	?>
			  </tbody>
      	</table>
      </div>
    </section>
 
  </div>

</div>

<?php
  $this->load->view('sadmin/foot');
?>
<?php
	function create_sitemap(){
		 $fileLocation = getenv("DOCUMENT_ROOT") . "/myfile.txt";
		  $file = fopen($fileLocation,"w");
		  $content = "Your text here";
		  fwrite($file,$content);
		  fclose($file);
	}
?>