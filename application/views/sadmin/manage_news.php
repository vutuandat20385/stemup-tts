<?php
$this->load->view('sadmin/head');
?>
<script>
	var base_url = "<?php echo base_url(); ?>";
	var site_url = "<?php echo site_url(); ?>";
	var su = "<?php echo $su ?>";
	var id_mcq_fun = "";
	var id_quiz_fun = "";
</script>
<script src="<?php echo base_url('js/manage_news.js'); ?> "></script>

<style>
	.pointer {
		cursor: pointer;
	}

	;

	.nav.nav-tabs.MB20.bg-tab {
		display: none;
	}

	img {
		width: 100%;
	}

	#pagination_page {
		margin-left: 15%;
	}

	.data_mngq table img {
		width: 130px;
		height: 80px;
		object-fit: cover;
	}
</style>
<div class="wrapper">
	<?php $this->load->view('sadmin/header'); ?>
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<?php $this->load->view('sadmin/leftmenu'); ?>
	</aside>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper ">

		<main class="container MT70" style="margin-top: 0px;">
			<section class="row">

				<aside class="col-md-12">
					<?php
					if ($this->session->flashdata('message')) {
						echo $this->session->flashdata('message');
					}
					if ($this->session->flashdata('message2')) {
						echo $this->session->flashdata('message2');
					}
					?>

					<div class="">
						<p class="title">DANH SÁCH TIN TỨC</p>
					</div>
					<div id="danhsachtin" class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="home1">
							<div class="data_mngq">
								<table class="table table-bordered" style="font-size: 14px;width: 95%;">
									<tr style="background-color: rgba(60, 141, 188, 0.28);">

										<th class="ta-c new_avatar">
											Avatar
										</th>
										<th class="ta-c new_title">
											Tiêu đề tin
										</th>
										<th class="ta-c new_desc">
											Mô tả
										</th>
										<th class="ta-c new_catagory">
											Thể loại
										</th>
										<th class="ta-c new_create_date">
											Ngày tạo
										</th>
										<th class="ta-c new_pos">
											Vị trí
										</th>
										<th class="ta-c news_delete " style="padding-left: 0; padding-right: 0;">
											Sửa-Xóa
										</th>


									</tr>

									<?php foreach ($list_news as $n) { ?>
									<tr>

										<td class="ta-c new_avatar">
											<img src="<?php echo $n['avatar']; ?>">
										</td>
										<td class="new_title">
											<?php echo _substr($n['name'], 100); ?>
										</td>
										<td class="new_desc">
											<?php echo _substr($n['description'], 100); ?>
										</td>
										<td class="ta-c new_catagory">
											<?php echo $n['category_name']; ?>
										</td>
										<td class="ta-c new_create_date">
											<?php echo date("d-m-Y", strtotime($n['modify_date'])); ?>
										</td>
										<td class="ta-c new_pos">
											<input type="text" name="inp-pos" style="width: 50px;text-align: center;font-weight: 600;color: #3c8dbc;" value="<?php echo $n['pos']; ?>">
										</td>
										<td class="ta-c news_delete">
											<a href="<?php echo site_url("sadmin/edit_news").'/'.$n['id'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
											<a href="#" class="delete" id="<?php echo $n['id'] ?>"><i class="fa fa-trash" aria-hidden="true" tyle="margin-left: 20%;"  title="Xóa"></i></a>
										</td>

									</tr>
									<?php } ?>

								</table>
							</div>
							<p>Đang xem <span id="beginqt"><?php echo min($limit * ($page-1), $num_news); ?></span>
								đến <span id="endqt"><?php echo min($limit * ($page), $num_news); ?></span>
								trong tổng số <span id="totalqt"><?php echo $num_news; ?></span> câu hỏi<p>
									<center>
										<div id="pagination" class="row">
										<ul class="pagination">

<?php foreach ($links as $link) { ?>


   <li class="page-item page-link "><?php echo  $link ?>
</li>

<?php }?>  


</ul>
											<!-- <div id="pagination_page" class="col-md-7">
												<ul class="pagination listpage pageqt">
													<?php if ($num_page > 6) { ?>
													<li class="page-item active" onclick="drawpage_sad_news(0)"><a class="page-link">1</a></li>
													<li class="page-item" onclick="drawpage_sad_news(1)"><a class="page-link">2</a></li>
													<li class="page-item" onclick="drawpage_sad_news(2)"><a class="page-link">3</a></li>
													<li class="page-item" onclick="drawpage_sad_news(3)"><a class="page-link">4</a></li>
													<li class="page-item" onclick="drawpage_sad_news(4)"><a class="page-link">5</a></li>
													<?php if ($num_page > 7) { ?>
													<li class="page-item"><a class="page-link">...</a></li>
													<?php } ?>
													<li class="page-item" onclick="drawpage_sad_news(<?php echo $num_page - 1 ?>)"><a class="page-link"><?php echo $num_page ?></a></li>
													<?php } else { ?>
													<li class="page-item active" onclick="drawpage_sad_news(0)"><a class="page-link">1</a></li>
													<?php for ($i = 1; $i <= $num_page; $i++) { ?>
													<li class="page-item" onclick="drawpage_sad_news(<?php echo $i ?>)"><a class="page-link"><?php echo $i + 1 ?></a></li>
													<?php } ?>
													<?php } ?>
												</ul>
											</div> -->
											<!-- <div id="pagination_input" class="col-md-5" style="margin-top:23px">
														<span class="span_gopage">Đi đến trang</span>
														<input type="number" min="1" value="<?php echo $page + 1 ?>" onkeyup="drawgotopage_mng_qt(this,event,<?php echo $num_page ?>)" id="go_to_page" class="gopage" >
													</div> -->
										</div>
									</center>
									<div style="display:none">
										<input type="text" id="inf_search" value="">
										<input type="text" id="inf_page" value="0">
										<input type="text" id="inf_limit" value="5">
									</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="home2">
						</div>
						<div role="tabpanel" class="tab-pane fade" id="tabDropDownOne1">
							<p>Dropdown content#1</p>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="tabDropDownTwo2">
							<p>Dropdown content#2 </p>
						</div>
					</div>


				</aside>




			</section>

		</main>
	</div>
	<!-- /.content-wrapper -->
	<?php $this->load->view('sadmin/footer'); ?>

</div>
<!-- ./wrapper -->

<?php
$this->load->view('sadmin/foot');
?>
<?php
function _substr($str, $length, $minword = 7)
{
	$sub = '';
	$len = 0;
	foreach (explode(' ', $str) as $word) {
		$part = (($sub != '') ? ' ' : '') . $word;
		$sub .= $part;
		$len += strlen($part);
		if (strlen($word) > $minword && strlen($sub) >= $length) {
			break;
		}
	}
	return $sub . (($len < strlen($str)) ? '...' : '');
}
?>
