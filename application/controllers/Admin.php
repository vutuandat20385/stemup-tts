<?php defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('pagination');

        $this->load->model('admin/admin_model');
        $this->load->model('post_model');
        $this->load->model('qbank_model');
        $this->load->model('sadmin_model');
        $this->load->model('user_model');
        $this->load->model("library_model");
        $this->lang->load('basic', $this->config->item('language'));

        // $this->load->database();
        // $this->load->helper('url');
        // $this->load->library('email');
        // $this->load->library('pagination');
        // $this->load->model("user_model");
        // $this->load->model("admin/admin_model");
        // $this->load->model("post_model");
        // $this->load->model("qbank_model");
        $this->load->model("api_model");
        $this->load->model("notify_model");
        $this->load->model("quiz_model");
        // $this->load->model("library_model");
        // $this->lang->load('basic', $this->config->item('language'));
    }

    function login()
    {
        $data['title'] = 'Đăng nhập trang quản trị';
        $data['head'] = $this->load->view('admin/layouts/head_login', $data, true);
        $data['foot'] = $this->load->view('admin/layouts/foot_login', $data, true);
        $this->load->view('admin/login', $data);
    }

    public function verifylogin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $result = $this->admin_model->login_verify($email, $password);
        $this->session->set_userdata('logged_in', $result['user']);

        if ($result['status'] == '1') {
            redirect('admin/index');
        } else {
            redirect('admin/login');
        }
    }

    function logout()
    {

        header('Location: ' . base_url() . 'index.php/admin/login');
    }

    function index()
    {
        $data['user'] = $this->session->userdata("logged_in");
        $data['title'] = 'Trang quản trị';

        $data['head'] = $this->load->view('admin/layouts/head', $data, true);
        // $data['topbar'] = $this->load->view('admin/elements/topbar',$data,true);
        $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
        $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);
        $this->load->view('admin/layouts/main', $data);
    }

    function news()
    {
        $user = $this->session->userdata("logged_in");
        $data['user'] = $user;
        if ($user['su'] == 1) {

            $data['title'] = 'Thêm tin mới';
            // $data['topbar'] = $this->load->view('admin/elements/topbar',$data,true);
            $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
            $data['head'] = $this->load->view('admin/layouts/head', $data, true);
            $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);

            $data['list_news'] = $this->admin_model->list_news();

            $data['category_news'] = $this->admin_model->get_class_new();
            $data['content'] = $this->load->view('admin/pages/add_new', $data, true);

            $this->load->view('admin/layouts/main', $data);
        } else {
            header('Location: ' . base_url() . 'index.php/admin/login');
        }
    }

    function show_danhsach_chon()
    {
        $chon = $this->input->post('chon');
        $list_id = implode(',', $chon);
        $data['chon'] = $this->admin_model->get_list_chon($list_id);
        $this->load->view('admin/pages/show_danhsach_chon', $data);
    }

    function manage_news()
    {
        $user = $this->session->userdata("logged_in");
        $data['user'] = $user;
        if ($user['su'] == 1) {
            $total_row = $this->admin_model->num_news();
            $data['limit'] = 6;
            $data['num_news'] = $total_row;
            $data['num_page'] = ceil($data['num_news'] / $data['limit']);

            $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
            $config = array();
            $config["base_url"] = base_url() . "index.php/admin/manage_news";
            $config["total_rows"] = $total_row;
            $config["per_page"] = $data['limit'];

            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = $total_row;
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            $config['cur_tag_close'] = '</a>';
            $config['next_link'] = 'Next';
            $config['prev_link'] = 'Previous';

            $data['list_news'] = $this->admin_model->list_news_manage($page, $data['limit']);

            $this->pagination->initialize($config);
            $str_links = $this->pagination->create_links();
            $data['links'] = explode('&nbsp;', $str_links);

            $data['title'] = 'Danh sách tin tức';
            // $data['topbar'] = $this->load->view('admin/elements/topbar',$data,true);
            $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
            $data['head'] = $this->load->view('admin/layouts/head', $data, true);
            $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);

            $data['content'] = $this->load->view('admin/pages/manage_news', $data, true);

            $this->load->view('admin/layouts/main', $data);
        } else {
            header('Location: ' . base_url() . 'index.php/admin/login');
        }
    }

    function manage_homepage_news()
    {
        $user = $this->session->userdata("logged_in");
        $data['user'] = $user;
        if ($user['su'] == 1) {
            $data['ds_homepage_news'] = $this->admin_model->get_post_homepage();
            $data['title'] = 'Danh sách tin trang chủ';
            // $data['topbar'] = $this->load->view('admin/elements/topbar',$data,true);
            $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
            $data['head'] = $this->load->view('admin/layouts/head', $data, true);
            $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);

            $data['content'] = $this->load->view('admin/pages/manage_homepage_news', $data, true);

            $this->load->view('admin/layouts/main', $data);
        } else {
            header('Location: ' . base_url() . 'index.php/admin/login');
        }
    }

    function update_pos()
    {
        $id = $_POST['id'];
        $pos = $_POST['pos'];
        $data['result'] = $this->sadmin_model->update_pos($id, $pos);
        header("Location:" . site_url('admin/manage_homepage_news'));
        exit;
    }

    function create_new()
    {
        $user = $this->session->userdata("logged_in");
        if ($user['su'] == 1) {
            $data['mess'] = $this->admin_model->insert_new();

            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }

    function check_name_exist()
    {
        $user = $this->session->userdata("logged_in");
        if ($user['su'] == 1) {
            $data['check'] = $this->admin_model->check_name_exist();
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }

    function delete_news($id)
    {
        // $id=$this->input->get('id');
        $data = $this->admin_model->delete_new($id);
        redirect("admin/manage_news");
    }

    function get_feedback()
    {

        $config = array();
        $config["base_url"] = base_url() . "index.php/admin/get_feedback";
        $total_row = $this->admin_model->record_count_feedBack();
        $config["total_rows"] = $total_row;
        $config["per_page"] = 8;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);
        if ($this->uri->segment(3)) {
            $page = ($this->uri->segment(3));
        } else {
            $page = 1;
        }
        $data["list_news"] = $this->admin_model->data_feed_back($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);

        $data['title'] = 'Feed back người dùng';
        // $data['topbar'] = $this->load->view('admin/elements/topbar',$data,true);
        $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
        $data['head'] = $this->load->view('admin/layouts/head', $data, true);
        $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);

        // $this->load->view("admin/feedback_software", $data);
        $data['content'] = $this->load->view('admin/pages/feedback', $data, true);

        $this->load->view('admin/layouts/main', $data);
    }

    function update_feedback_status()
    {
        $fid = $this->input->post('fbid');
        // $fstt = $this->input->post('fbstatus');
        $data = $this->admin_model->updateFeedbackStatus($fid);
        // $data["feedback"] = $this->admin_model->getFeedBack();
        // $this->load->view("admin/pages/feedback_software_processed", $data);
        print_r($data);
    }

    function thongke()
    {
        log_message('error', 'Start-thongke ');
        $user = $this->session->userdata("logged_in");
        $data['user'] = $user;
        if ($user['su'] == 1) {
            $post = $this->input->post('btn_thongke');
            if (isset($post)) {
                $t1 = $this->input->post('start_date');
                $start_time = strtotime($t1);
                $data['t1'] = $t1;
                $t2 = $this->input->post('end_date');
                $end_time = strtotime($t2);
                $data['t2'] = $t2;
            } else {
                $start_time = strtotime(date('d-m-Y') . '-30 days');
                $end_time = strtotime(date('d-m-Y'));
            }

            $this->db->select('r_qids');
            $this->db->where('start_time >=', $start_time);
            $this->db->where('start_time <=', $end_time);
            $r_qids = $this->db->get('savsoft_result')->result_array();

            $v = '';
            foreach ($r_qids as $k => $value) {
                if ($k == 0) {
                    $v = $value['r_qids'];
                } else
                    $v = $v . ',' . $value['r_qids'];
            }
            $arr = explode(',', $v);

            foreach ($arr as $k1 => $val) {
                $check = $this->admin_model->check_qid($val);
                $arr1[$k1]['qid'] = $val;
                $arr1[$k1]['lid'] = $check['lid'];
                $arr1[$k1]['cid'] = $check['cid'];
            }

            for ($i = 3; $i < 15; $i++) {
                for ($j = 3; $j <= 34; $j++) {
                    $arr2[$i][$j] = $this->admin_model->count_lid_cid($i, $j, $arr1);
                }
            }
            $data['arr2'] = $arr2;


            $data['title'] = 'THỐNG KÊ SỐ LƯỢNG CÂU HỎI ĐÃ ĐƯỢC LÀM';
            $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
            $data['head'] = $this->load->view('admin/layouts/head', $data, true);
            $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);

            $data['content'] = $this->load->view('admin/pages/thongke', $data, true);

            $this->load->view('admin/layouts/main', $data);
        } else {
            header('Location: ' . base_url() . 'index.php/admin/login');
        }
    }
    function generatexls()
    {
        // $cid=$_GET['cid'];
        // $lid=$_GET['lid'];

        $lid = $this->input->post('lid');
        $cid = $this->input->post('cid');

        $cat = $this->admin_model->get_category_name($cid);
        $mon = $cat['abbr'];
        $lev = $this->admin_model->get_level_name($lid);
        $lop = $lev['level_name'];

        // $i=15; 
        // load excel library
        $this->load->library('excel');
        $num = $this->qbank_model->num_mng_qt($cid, $lid, "", $i, 0);
        //for($i=0;$i<num;$i+5000){
        $i = 2000000;
        $listInfo = $this->qbank_model->mng_qt_list($cid, $lid, "", $i, 0);
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->setCellValue('B2', 'Môn ' . $mon . ' - ' . $lop);
        $objPHPExcel->getActiveSheet()->mergeCells('B2:J2');

        $objPHPExcel->getActiveSheet()->setCellValue('A4', 'ID (Không sửa)');
        $objPHPExcel->getActiveSheet()->setCellValue('B4', 'Nội dung câu hỏi');

        $objPHPExcel->getActiveSheet()->setCellValue('C4', 'Các lựa chọn');
        $objPHPExcel->getActiveSheet()->mergeCells('C4:F4');

        $objPHPExcel->getActiveSheet()->setCellValue('G4', 'Đáp án đúng');
        $objPHPExcel->getActiveSheet()->mergeCells('G4:J4');

        $objPHPExcel->getActiveSheet()->setCellValue('K4', 'ID Option (Không sửa)');
        $objPHPExcel->getActiveSheet()->mergeCells('K4:N4');

        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'qid');
        $objPHPExcel->getActiveSheet()->SetCellValue('B5', 'Question');
        $objPHPExcel->getActiveSheet()->SetCellValue('C5', 'option 1');
        $objPHPExcel->getActiveSheet()->SetCellValue('D5', 'option 2');
        $objPHPExcel->getActiveSheet()->SetCellValue('E5', 'option 3');
        $objPHPExcel->getActiveSheet()->SetCellValue('F5', 'option 4');
        $objPHPExcel->getActiveSheet()->SetCellValue('G5', 'A');
        $objPHPExcel->getActiveSheet()->SetCellValue('H5', 'B');
        $objPHPExcel->getActiveSheet()->SetCellValue('I5', 'C');
        $objPHPExcel->getActiveSheet()->SetCellValue('J5', 'D');
        $objPHPExcel->getActiveSheet()->SetCellValue('K5', 'id_option1');
        $objPHPExcel->getActiveSheet()->SetCellValue('L5', 'id_option2');
        $objPHPExcel->getActiveSheet()->SetCellValue('M5', 'id_option3');
        $objPHPExcel->getActiveSheet()->SetCellValue('N5', 'id_option4');

        $objPHPExcel->getActiveSheet()->freezePane('A6');

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(100);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        // set Row
        $rowCount = 6;
        foreach ($listInfo as $val) {
            $q_option = $this->sadmin_model->get_question_qvbank($val['qid']);
            $question = html_entity_decode($val['question']);
            $option1 = html_entity_decode($q_option['0']['q_option']);
            $option2 = html_entity_decode($q_option['1']['q_option']);
            $option3 = html_entity_decode($q_option['2']['q_option']);
            $option4 = html_entity_decode($q_option['3']['q_option']);

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $val['qid']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $question);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $option1);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $option2);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $option3);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $option4);

            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $q_option['0']['score']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $q_option['1']['score']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $q_option['2']['score']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $q_option['3']['score']);

            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $q_option['0']['oid']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $q_option['1']['oid']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $q_option['2']['oid']);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $q_option['3']['oid']);

            $objPHPExcel->getActiveSheet()->getStyle('B6:F' . $objPHPExcel->getActiveSheet()->getHighestRow())->getAlignment()->setWrapText(true);

            $rowCount++;
        }

        $filename = $mon . "-" . $lop . "-" . date("Y-m-d-H-i-s") . ".";

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . 'xlsx');
        header('Cache-Control: max-age=0');

        ob_end_clean();
        $objWriter->save('php://output');
    }

    function manage_questions()
    {
        $user = $this->session->userdata("logged_in");
        $data['user'] = $user;
        if ($user['su'] == 1) {
            $data['title'] = 'Danh sách câu hỏi trắc nghiệm';
            $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
            $data['head'] = $this->load->view('admin/layouts/head', $data, true);
            $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);

            $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
            $limit = 20;
            $start = $page * $limit;


            $config['base_url'] = base_url() . 'index.php/admin/manage_questions';
            $config['total_rows'] = $this->admin_model->count_all_questions();
            log_message('error', $config['total_rows']);
            $config['per_page'] = $limit;
            $config["uri_segment"] = 3;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $data['question_list'] = $this->admin_model->get_question_list($limit, $start);

            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = '<i class="fa"></i><<';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            $config['next_link'] = '>> <i class="fa"></i>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);

            // build paging links
            $data['links'] = $this->pagination->create_links();

            $data['level_list'] = $this->admin_model->get_level_list();
            $data['category_list'] = $this->admin_model->get_category_list();

            $data['content'] = $this->load->view('admin/pages/question_list', $data, true);

            $this->load->view('admin/layouts/main', $data);
        } else {
            header('Location: ' . base_url() . 'index.php/admin/login');
        }
    }

    function search_question()
    {
    }
    public function importFile()
    {

        if ($this->input->post('submit')) {

            $path = 'upload/';
            require_once APPPATH . "/third_party/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('uploadFile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
            if (empty($error)) {
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;

                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i = 0;
                    foreach ($allDataInSheet as $value) {
                        if ($flag) {
                            $flag = false;
                            continue;
                        }
                        $inserdata[$i]['qid'] = $value['A'];
                        $inserdata[$i]['question'] = $value['B'];
                        $inserdata[$i]['op1'] = $value['C'];
                        $inserdata[$i]['op2'] = $value['D'];
                        $inserdata[$i]['op3'] = $value['E'];
                        $inserdata[$i]['op4'] = $value['F'];
                        $inserdata[$i]['dapan1'] = $value['G'];
                        $inserdata[$i]['dapan2'] = $value['H'];
                        $inserdata[$i]['dapan3'] = $value['I'];
                        $inserdata[$i]['dapan4'] = $value['J'];
                        $inserdata[$i]['id_op1'] = $value['K'];
                        $inserdata[$i]['id_op2'] = $value['L'];
                        $inserdata[$i]['id_op3'] = $value['M'];
                        $inserdata[$i]['id_op4'] = $value['N'];

                        $i++;
                    }
                    $result = $this->admin_model->insert($inserdata);
                    if ($result) {
                        echo "Imported successfully";
                    } else {
                        echo "ERROR !";
                    }
                } catch (Exception $e) {
                    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
                }
            } else {
                echo $error['error'];
            }
        }
    }

    function excel()
    {
        $user = $this->session->userdata("logged_in");
        $data['user'] = $user;
        if ($user['su'] == 1) {
            $data['title'] = 'Xử lý Xuất - Nhập thống kê';
            $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
            $data['head'] = $this->load->view('admin/layouts/head', $data, true);
            $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);

            $data['level_list'] = $this->admin_model->get_level_list();
            $data['category_list'] = $this->admin_model->get_category_list();

            $data['content'] = $this->load->view('admin/pages/excel', $data, true);

            $this->load->view('admin/layouts/main', $data);
        } else {
            header('Location: ' . base_url() . 'index.php/admin/login');
        }
    }

    public function thong_ke_user()
    {
        $user = $this->session->userdata("logged_in");
        $data['user'] = $user;
        if ($user['su'] == 1) {

            $data['title'] = 'Bảng thống kê đăng ký tài khoản trong vòng 30 ngày';
            $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
            $data['head'] = $this->load->view('admin/layouts/head', $data, true);
            $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);

            $data['user'] = $this->admin_model->get_user();
            $data['user_l30day']= $this->admin_model->get_user_l30day();
            $data['user_cr30day']= $this->admin_model->get_user_cr30day();
            $data['content'] = $this->load->view('admin/pages/thong_ke_user', $data, true);
            $this->load->view('admin/layouts/main', $data);
        } else {
            header('Location: ' . base_url() . 'index.php/admin/login');
        }
    }

    function video($page = 1)
    {
        $user = $this->session->userdata('logged_in');
        $data['user_name'] = $user['last_name'] . ' ' . $user['first_name'];
        $data['user_point'] = $this->user_model->get_user_points($user['uid']);
        $data['email'] = $user['email'];
        $data['phone'] = $user['contact_no'];
        $data['uid'] = $user['uid'];
        $data['user_code'] = $user['user_code'];
        $data['birthdate'] = $user['birthdate'];
        $data['link_photo'] = $user['photo'];
        $data['su'] = $user['su'];

        $data['title'] = 'Danh sách video';
        $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
        $data['head'] = $this->load->view('admin/layouts/head', $data, true);
        $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);

        if (isset($_GET['txtSearchVideo'])) {
            $data['search'] = $_GET['txtSearchVideo'];
        } else {
            $data['search'] = "";
        }
        $data['stcategories'] = $this->qbank_model->get_statistic_category();
        $data['post_tag'] = $this->post_model->post_list($type_tag = 'post_tag');
        $data['video_list'] = $this->library_model->get_data_library("video", $data['search'], 8, $page - 1);
        $data['numpage'] = ceil($this->library_model->number_data_library("video", $data['search']) / 8);
        $data['page'] = $page;
        $data['category_list'] = $this->qbank_model->category_list();
        $data['level_list'] = $this->qbank_model->level_list();
        if ($data['numpage'] > 10) {
            if ($page < $data['numpage'] - 3 && $page > 4) {
                $data['pstart'] = $page - 3;
            } else {
                if ($page < 5) {
                    $data['pstart'] = 2;
                } else {
                    $data['pstart'] = $data['numpage'] - 7;
                }
            }
        }
        $data['content'] = $this->load->view('admin/pages/video', $data, true);


        $this->load->view('admin/layouts/main', $data);
    }


    function add_video()
    {
        $data['title'] = 'Thêm  video';
        $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
        $data['head'] = $this->load->view('admin/layouts/head', $data, true);
        $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);

        $data['category_list'] = array_reverse($this->qbank_model->category_list());
        $data['level_list'] = $this->qbank_model->level_list();
        $data['stcategories'] = $this->qbank_model->get_statistic_category();
        $data['post_tag'] = $this->post_model->post_list($type_tag = 'post_tag');
        $data['content'] = $this->load->view('admin/pages/add_video', $data, true);
        $this->load->view('admin/layouts/main', $data);
    }

    public function add_question($nop = '4', $para = '0')
    {
        $data['title'] = 'Thêm mới câu hỏi';
        $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
        $data['head'] = $this->load->view('admin/layouts/head', $data, true);
        $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);
        if ($this->input->post('question')) {

            if ($this->qbank_model->insert_question_1()) {
                $uid = $logged_in['uid'];
                $content = "Đã tạo một câu hỏi.";
                $model = "qbank";
                $action = "new question";
                $nid = $this->notify_model->insert_notify($uid, $content, $model, $action);
                $this->notify_model->insert_notify_user($nid, $uid);

                $this->session->set_flashdata('message', "<div class='alert alert-success'>" . $this->lang->line('data_added_successfully') . " </div>");
                $check = 0;
            } else {
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>" . $this->lang->line('error_to_add_data') . " </div>");
            }
            if ($this->input->post('parag') == 1) {
                //redirect('qbank/new_question_1/'.$nop.'/'.$para);

            } else {
                //redirect('qbank/pre_new_question/');
            }
        }
        if ($this->session->flashdata('qid')) {
            $data['qp'] = $this->qbank_model->get_question($this->session->flashdata('qid'));
        }
        $data['para'] = $para;
        $data['nop'] = $nop;
        // fetching category list
        $data['category_list'] = $this->qbank_model->category_list();
        // fetching level list
        $data['level_list'] = $this->qbank_model->level_list(1);

        $data['content'] = $this->load->view('admin/pages/add_question', $data, true);
        $this->load->view('admin/pages/add_question', $data);
    }

    function manage_qbank()
    {
        $data['title'] = 'Danh sách câu hỏi';
        $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
        $data['head'] = $this->load->view('admin/layouts/head', $data, true);
        $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);

        $data['category_list'] = $this->qbank_model->category_list();
        $data['level_list'] = $this->qbank_model->level_list(1);
        $data['questions'] = $this->qbank_model->mng_qt_list(0, 0, "", 15, 0);
        $data['num_question'] = $this->qbank_model->num_mng_qt(0, 0, "", 15, 0);
        $data['limit'] = 15;
        $data['page'] = 0;
        $data['cid'] = 0;
        $data['lid'] = 0;
        $data['num_page'] = ceil($data['num_question'] / $data['limit']);

        $data['content'] = $this->load->view('admin/pages/manage_qbank', $data, true);
        $this->load->view('admin/layouts/main', $data);
    }

    function create_quiz()
    {
        $user = $this->session->userdata('logged_in');
        $data['title'] = 'Thêm bài trắc nghiệm';
        // $data['topbar'] = $this->load->view('admin/elements/topbar',$data,true);
        $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
        $data['head'] = $this->load->view('admin/layouts/head', $data, true);
        $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);
        if ($user['su'] == 1) {
            $data['su'] == $user['su'];
            //	var_dump($user['su']);
            $data['limit'] = 10;
            $data['category_list'] = $this->qbank_model->category_list();
            $data['level_list'] = $this->qbank_model->level_list();
            $data['questions'] = $this->qbank_model->crq_qt_list(0, 0, '', 10, 0);
            $data['num_question'] = $this->qbank_model->num_crq_qt(0, 0, '', 10, 0);
            $data['categories'] = $this->qbank_model->category_list();
            $data['levels'] = $this->qbank_model->level_list();
            $data['num_page'] = ceil($data['num_question'] / 10);
            $data['group_list'] = $this->user_model->group_list();
            //	var_dump($data['questions']);
            $data['content'] = $this->load->view('admin/pages/create_quiz', $data, true);

            $this->load->view('admin/layouts/main', $data);
        }
    }

    function quiz_list($page = 1)
    {
        $user = $this->session->userdata('logged_in');
        $data['title'] = 'Danh sách bài trắc nghiệm';
        // $data['topbar'] = $this->load->view('admin/elements/topbar',$data,true);
        $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
        $data['head'] = $this->load->view('admin/layouts/head', $data, true);
        $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);

        //$data['vui_post']=$this->post_model->post_list($type_vui='vui.stem.vn');
        $data['post_tag'] = $this->post_model->post_list($type_tag = 'post_tag');
        //$data['post_cat']=$this->post_model->post_list($type_cat='category');
        $data['stcategories'] = $this->qbank_model->get_statistic_category();
        if ($user) {
            $data['user_name'] = $user['last_name'] . ' ' . $user['first_name'];
            $data['user_point'] = $this->user_model->get_user_points($user['uid']);
            $data['email'] = $user['email'];
            $data['phone'] = $user['contact_no'];
            $data['uid'] = $user['uid'];
            $data['user_code'] = $user['user_code'];
            $data['birthdate'] = $user['birthdate'];
            $data['link_photo'] = $user['photo'];
            $data['su'] = $user['su'];
        }
        $search = $_GET['search'];
        if (!$search)
            $s = "";
        else
            $s = $search;

        $cid = $_GET['cid'];
        if (!intval($cid)) {
            $cid = 0;
        }
        $lid = $_GET['lid'];
        if (!intval($lid)) {
            $lid = 0;
        }
        $sortby = $_GET['sortby'];

        $t = $this->api_model->quiz_list_login($cid, $lid, $s, $sortby, $page - 1);
        $data['quiz_list'] = $t['quiz'];
        $data['numpage'] = $t['numpage'];
        $data['page'] = $page;
        if ($data['numpage'] > 10) {
            if ($page < $data['numpage'] - 3 && $page > 4) {
                $data['pstart'] = $page - 3;
            } else {
                if ($page < 5) {
                    $data['pstart'] = 2;
                } else {
                    $data['pstart'] = $data['numpage'] - 7;
                }
            }
        }


        $data['nb_class'] = $this->api_model->nb_class_list_2('');
        $data['np_cl'] = ceil($data['nb_class'] / 5);
        $data['nb_students'] = $this->api_model->nb_student_list_2('');
        $data['np_std'] = ceil($data['nb_students'] / 5);
        $data['cid'] = $cid;
        $data['lid'] = $lid;
        $data['search'] = $search;
        $data['sortby'] = $sortby;
        $data['category_list'] = $this->qbank_model->category_list();
        $data['level_list'] = $this->qbank_model->level_list();
        $data['content'] = $this->load->view('admin/pages/quiz_list', $data, true);

        $this->load->view('admin/layouts/main', $data);
    }

    function edit_quiz($qid)
    {
        $user = $this->session->userdata('logged_in');
        $data['title'] = 'Sửa bài kiểm tra';
        $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
        $data['head'] = $this->load->view('admin/layouts/head', $data, true);
        $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);

        $data['quiz'] = $this->quiz_model->get_array_qids($qid);
        $data['created'] = $this->quiz_model->get_array_qids($qid)['inserted_by'];
        $data['limit'] = 10;
        $data['page'] = 0;
        $data['cid'] = 0;
        $data['lid'] = 0;
        $data['category_list'] = $this->qbank_model->category_list();
        $data['level_list'] = $this->qbank_model->level_list();
        $data['qids'] = $this->quiz_model->get_array_qids($qid)['qids'];
        $data['number_qbank'] = $this->quiz_model->num_quiz_in($data['qids'], 0, 0, '');
        $data['num_page'] = ceil($data['number_qbank'] / $data['limit']);
        $data['qbank'] = $this->quiz_model->get_quiz_in($data['qids'], 0, 0, '', 10, 0);
        $data['number_qbank_not'] = $this->quiz_model->num_quiz_not_in($data['qids'], 0, 0, '');
        $data['num_page_not'] = ceil($data['number_qbank_not'] / $data['limit']);
        $data['qbank_not'] = $this->quiz_model->get_quiz_not_in($data['qids'], 0, 0, '', 10, 0);

        $data['content'] = $this->load->view('admin/pages/edit_quiz', $data, true);
        $this->load->view('admin/layouts/main', $data);
    }
    function edit_news($id)
    {
        $user = $this->session->userdata("logged_in");
        if ($user['su'] == 1) {
            $data['new'] = $this->admin_model->get_new($id);

            $check = substr($data['new']['related_news'], 0, 2);

            if ($check == '' || $check == ' ' || $check == '  ') {
                $data['related_news'] = '';
                $id_new = -1;
            } else {
                $id_new = $data['new']['related_news'];
                $data['related_news'] = $this->admin_model->get_list_chon_v2($data['new']['related_news']);
            }
            $data['array_related'] = explode(",", $data['new']['related_news']);

            //Phân trang cho danh sách tin
            $data['list_news'] = $this->admin_model->list_edit_news(0, 10, $id_new);
            $total_rows = $this->admin_model->record_count();
            $total_page = ceil($total_rows / 10);
            $data['trang'] = $total_page;

            $data['title'] = 'Sửa tin tức';
            $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
            $data['head'] = $this->load->view('admin/layouts/head', $data, true);
            $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);

            // $data['list_news'] = $this->admin_model->list_news();

            $data['category_news'] = $this->admin_model->get_class_new();
            $data['content'] = $this->load->view('admin/pages/edit_news', $data, true);

            $this->load->view('admin/layouts/main', $data);
        } else {
            header('Location: ' . base_url() . 'index.php/admin/login');
        }
    }
    function update_new()
    {
        $user = $this->session->userdata("logged_in");
        if ($user['su'] == 1) {
            $data['mess'] = $this->admin_model->update_new();
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }
    function check_name_exist_update()
    {
        $user = $this->session->userdata("logged_in");
        if ($user['uid'] == 1) {
            $data['check'] = $this->admin_model->check_name_exist_update();
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }

    function admin_list()
    {
        $user = $this->session->userdata('logged_in');
        $data['title'] = 'Danh sách nhân viên';
        $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
        $data['head'] = $this->load->view('admin/layouts/head', $data, true);
        $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);
        if ($user) {
            $data['user'] = $this->admin_model->mng_user_list(0, 0, "", 15, 0);
            $data['num_user'] = $this->admin_model->num_mng_user(0, 0, "", 15, 0);
            $data['limit'] = 15;
            $data['page'] = 0;
            $data['cid'] = 0;
            $data['lid'] = 0;
            $data['num_page'] = ceil($data['num_user'] / $data['limit']);
        }
        $data['content'] = $this->load->view('admin/pages/admin_list', $data, true);

        $this->load->view('admin/layouts/main', $data);
    }

    function get_data_user()
    {
        $user = $this->session->userdata('logged_in');
        if ($user) {
            $inp = json_decode($this->input->raw_input_stream, true);
            $inp['search'] = htmlentities($inp['search'], ENT_COMPAT, 'UTF-8');
            $inp['users'] = $this->admin_model->mng_user_list($inp['uid'], $inp['su'], $inp['search'], $inp['limit'], $inp['page']);
            $inp['num_user'] = $this->admin_model->num_mng_user($inp['uid'], $inp['su'], $inp['search'], $inp['limit'], $inp['page']);
            $inp['num_page'] = ceil($inp['num_user'] / $inp['limit']);
            header('Content-Type: application/json');

            echo json_encode($inp);
        }
    }

    function delete_user($uid)
    {
        $user = $this->session->userdata('logged_in');
        if ($user) {
            $data = $this->admin_model->delete_user($uid);
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }

    function edit_user($uid)
    {
        $user = $this->session->userdata('logged_in');
        if ($user) {
            $email = $this->input->post('email');
            $first_name = $this->input->post('first_name');
            $su = $this->input->post('su');
            $err = '';
            $pass = '';
            if (!empty($this->input->post('password'))) {
                $password = $this->input->post('password');
                $pass = md5($password);
            }
            if ($this->admin_model->edit_user($uid, $email, $first_name, $su, $pass) == true) {
                $this->session->set_flashdata('message', 'Sửa tài khoản thành công!');
                $err = '0';
            } else {
                $err = '1';
            }
            echo $err;
        }
    }

    function addUser()
    {
        $user = $this->session->userdata('logged_in');
        if ($user) {
            $email = $this->input->post('email');
            $first_name = $this->input->post('first_name');
            $su = $this->input->post('su');
            $password = $this->input->post('password');
            $pass = md5($password);
            if ($this->admin_model->num_user_by_email($email) == 0) {
                if ($this->admin_model->add_user($email, $first_name, $su, $pass) == true) {
                    $this->session->set_flashdata('message', 'Thêm tài khoản thành công!');
                    echo '0';
                }
            } else {
                echo '1';
            }
        }
    }
    function thongke_point($time = '')
    {
        $user = $this->session->userdata('logged_in');
        $data['title'] = 'Thống kê điểm';
        $data['leftmenu'] = $this->load->view('admin/elements/leftmenu', $data, true);
        $data['head'] = $this->load->view('admin/layouts/head', $data, true);
        $data['foot'] = $this->load->view('admin/layouts/foot', $data, true);
        $querytime = '';
        $time = $this->input->post('time');
        if ($user) {
            if ($time == 1 || $time == '') {
                $limit = 10;
                $data['selected1'] = "selected";
                $querytime = "DATE_FORMAT(create_date, '%Y-%m-%d') = CURDATE()";
            }
            if ($time == 2) {
                $limit = 20;
                $data['selected2'] = "selected";
                $querytime = "YEARWEEK(create_date) = YEARWEEK(NOW())";
            }
            if ($time == 3) {
                $limit = 30;
                $data['selected3'] = "selected";
                $querytime = "MONTH(create_date)= MONTH(NOW()) AND YEAR(t.Date) = YEAR(NOW())";
            } 
            $data['point'] = $this->admin_model->danhsach_point($querytime, $limit);
        }

        $data['content'] = $this->load->view('admin/pages/thongke_point', $data, true);
        $this->load->view('admin/layouts/main', $data);
    }
}
