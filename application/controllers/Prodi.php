<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('prodi_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['prodi'] = $this->prodi_model->getAll();
        $this->load->view('admin/prodi');
    }
    public function create(){
        $prodi = $this->prodi_model;
        $validation = $this->form_validation;
        $validation->set_rules($prodi->rules());
        if ($validation->run()) {
            $prodi->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view('admin/prodi_tambah');
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