<!DOCTYPE html>
<html lang="en">
<head>

	
</head>
<style>
	.so_luong{
		width:20%;
		margin: 2%;
	}
</style>
<body>
<form action="<?php echo base_url('index.php/qbank/xuat_file');?>" method="post">

Bắt đầu từ :<input class="so_luong" type="value" name="start"><br>
File số:<input class="so_luong" type="value" name="sofile">.xml<br>
<input type="submit">
</form>

</body>
</html>
<?php 
	
	$filename = FCPATH.'XML/sitemap-'.$i.'.xml';
	$fp = @fopen($filename, "w");
  
// Kiểm tra file mở thành công không
if (!$fp) {
    echo 'Mở file không thành công';
}
else
{	
$data1 = "<urlset \n".'xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n".' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n" .'xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
	http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
$data3 = "</urlset>"; 
fwrite($fp, $data1);
foreach ($result as $val){
	$data2 = "\n<url>\n<loc>".site_url('page/question/').'/'.$val['permalink']."</loc>\n<lastmod>"."2019-08-11T10:36:55+00:00"."</lastmod>\n<priority>0.8</priority>"."\n</url>\n";


    // Ghi file
fwrite($fp, $data2);
}
fwrite($fp, $data3);
    // Đóng file
	echo 'Thành công!';
    fclose($fp);
}
?>