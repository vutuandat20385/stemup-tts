
<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * 
	 */
	class Excel_import extends CI_Controller{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->database();
			$this->load->model('excel_import_model');
			$this->load->library('excel');

		}
		
		function index(){
			
			$data['get_n']= $this->excel_import_model->get_data_str1();
			$this->load->view('excel_import');

		}

		function fetch(){
			$data=$this->excel_import_model->select();
			// echo "<pre>";
			// print_r($data);
			// echo "</pre>";
			$output = '
			<h3 align="center">Total Data- '.$data->num_rows().'</h3>
			<table class="table table-striped table-bordered">
			<tr>
			<th>url_name</th>
			<th>link</th>
			<th>content</th>
			<th>title</th>
			<th>img</th>
			<th>category</th>
			</tr>
			';
			foreach ($data ->result() as $row) {
				# code...
				$output .='
				<tr>
				<td>'.$row->url_name.'</td>
				<td>'.$row->link.'</td>
				<td>'.$row->content.'</td>
				<td>'.$row->title.'</td>
				<td>'.$row->img.'</td>
				<td>'.$row->category.'</td>
				</tr>
				';
			}
			$output .='</table>';
			echo $output;
		}

		function import(){
			if(isset($_FILES["file"]["name"])){
				$path =$_FILES["file"]["tmp_name"];// lấy tên tạm

				$objReader = PHPExcel_IOFactory:: createReaderForfile($path);//Tạo đối tượng reader
				$listWorkSheets = $objReader->listWorksheetNames($path);// Lấy các sheet trong file

				// foreach ($listWorkSheets as $values) {

					// $sql = "INSERT INTO lop(name) VALUES ('$values')";// Insert dữ liệu là các sheet vào bảng lớp
					// $this->db->query($sql);
					// $id_lop = $this->db->insert_id();

					// $objReader ->setLoadSheetsOnly($values);//Load sheet trong DB
					$objExcel = $objReader->load($path);// tải sheet
					$sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);// chuyển sheet sang mảng 
					// echo "<pre>";
					// print_r($sheetData);
					// echo "</pre>";
					// die();
					
					$highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();//Đếm xem có bao nhiêu bao nhiêu dòng tất cả(lấy row cao nhất)
					echo $highestRow; echo "<br/>";
					
					for ($row=2; $row <= $highestRow; $row++) { 
						// $question = $sheetData[$row]['A'];
						// $data= $this->excel_import_model->insert($question);
						
						// $id_lop= $data['id_lop'];
						// $str_n=$data['result'][$row-2]['question'];
						// // echo $str_n;
						// // echo "<br>";
						// $str= $this->excel_import_model->get_data_str($str_n);
						// // echo $str;

						// $this->excel_import_model->insert_permalink($id_lop,$str);


						// $anh = base_url('images/Image').'/'.$row.'.jpg';
						$anh = 'http://dev.stemup.vn/index.php/images/Image'.'/'.$row.'.jpg';
						// echo $anh;
						// die();
						$this->excel_import_model->insert_anh($anh,$row);
						// die();
					}
				// }
					echo "Data Imported successfully";
				}
			}

		}
		?>