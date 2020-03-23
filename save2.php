<?php 

header("Access-Control-Allow-Origin: *");
error_reporting(E_ALL);
ini_set('display_errors', 1);
$upload_dir = "screenshots/";
$img = $_POST['hidden_data'];
$rid=$_POST['rid'];
$quid=$_POST['quid'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$nm=$quid.'-'.$rid.'-'.date('d-m-Y-H-i-s',time());
$file = $upload_dir . $nm. ".png";
$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';





?>