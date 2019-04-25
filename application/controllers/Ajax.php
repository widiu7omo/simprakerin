<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Tools\Excel;
require APPPATH.'libraries/Excel.php';

class Ajax extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('prodi_model');
        $this->load->library('form_validation');
        $this->load->helper('upload_helper');
    }
    public function initImport(){
        $data = do_upload();
        $file = $data['upload_data'];
        $excel = new Excel;
        $type = ucfirst(substr($file['file_ext'],1));
        $sheetNames = $excel->readSheetName($file['full_path'],$type);
        echo json_encode($sheetNames);

        // $excel = new Excel;
        // $type = ucfirst(substr($file['file_ext'],1));
        // var_dump($type);
        // $sheetNames = $excel->readSheetName($file['full_path'],$type);
    }
}