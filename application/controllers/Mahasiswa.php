<?php 

use Tools\Excel;
require APPPATH.'libraries/Excel.php';
defined('BASEPATH') OR exit('No direct script access allowed');
// Use upload Library and Excel library

class Mahasiswa extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('upload');
        $this->load->model('mahasiswa_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $get = $this->input->get();
        switch (isset($get['m'])?$get['m']:null) {
            case 'magang':
                # code...
                $data['mahasiswas'] = $this->mahasiswa_model->getAll();//need filter only magang
                $this->load->view('admin/mahasiswa_magang',$data);
                break;
            case 'sidang':
                # code...
                $data['mahasiswas'] = $this->mahasiswa_model->getAll();
                $this->load->view('admin/mahasiswa_sidang',$data);
                break;
            default:
                # code...
                $this->load->view('admin/mahasiswa');
                break;
        }
        
    }
    public function create(){
        $mahasiswa = $this->mahasiswa_model;
        $validation = $this->form_validation;
        $validation->set_rules($mahasiswa->rules());
        if ($validation->run()) {
            $mahasiswa->insert();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(current_url());
        }
        $this->load->view('admin/mahasiswa_tambah');
    }
    public function edit($id = null){
        if (!isset($id)) redirect('mahasiswa');
        $mahasiswa = $this->mahasiswa_model;
        $validation = $this->form_validation;
        $validation->set_rules($mahasiswa->rules());
        if ($validation->run()) {
            $mahasiswa->update();
            $this->session->set_flashdata('success', 'Berhasil dirubah');
        }
        $data['mahasiswa'] = $mahasiswa->getById($id);
        if (!$data['mahasiswa']) show_404();
        $this->load->view('admin/mahasiswa_edit', $data);
    }
    public function remove($id = null){
        if (!isset($id)) show_404();
        if ($this->mahasiswa_model->delete($id)) {
            redirect(site_url('mahasiswa'));
        }
    }
    public function import(){
        $data = do_upload();
        $file = $data['upload_data'];
        var_dump($file);
        $excel = new Excel;
        $type = ucfirst(substr($file['file_ext'],1));
        var_dump($type);
        $sheetNames = $excel->readSheetName($file['full_path'],$type);
    }
    
} ?>