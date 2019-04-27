<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mahasiswa_model');
        $this->load->model('pegawai_model');
        $this->load->library('form_validation');
    }
    //dashboard user
    public function index()
    {
        $level = $this->session->userdata('level');
        switch($level){
            case 'mahasiswa':
            $data['mahasiswa'] = $this->mahasiswa_model->getById();
            $this->load->view('user/dashboard');
            break;
            case 'dosen':
            $data['dosen'] = $this->pegawai_model->getById();
            break;
            default: redirect(site_url('welcome'));//@TODO:change this, clean code
        }
        if($this->session->userdata('level') == 'mahasiswa'){
            
        }
        
    }
    public function create(){
        $changeHere = $this->changeHere;
        $validation = $this->form_validation;
        $validation->set_rules($changeHere->rules());
        if ($validation->run()) {
            $changeHere->insert();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view('changeHere');
    }
    public function edit($id = null){
        if (!isset($id)) redirect('changeHere');
        $changeHere = $this->changeHere;
        $validation = $this->form_validation;
        $validation->set_rules($changeHere->rules());
        if ($validation->run()) {
            $changeHere->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $data['changeHere'] = $changeHere->getById($id);
        if (!$data['changeHere']) show_404();
        $this->load->view('changeHere', $data);
    }
    public function remove($id = null){
        if (!isset($id)) show_404();
        if ($this->changeHere->delete($id)) {
            redirect(site_url('changeHere'));
        }
    }
} ?>
