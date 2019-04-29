<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        !$this->session->userdata('level')?redirect(site_url('main')):null;
    }
    
    public function index()
    {
        //menu dynamic
        $level = $this->session->userdata('level');
        switch($level){
            case 'admin':
            $data['menus'] = array(
                array('name'=>'Kelola Data Perusahaan',
                    'href'=>site_url('perusahaan?m=manajemen'),
                    'icon'=>'fas fa-id-badge',
                    'desc'=>'Pengelolaan data perusahaan'),
                array('name'=>'Informasi Perusahaan',
                    'href'=>site_url('perusahaan?m=informasi'),
                    'icon'=>'fas fa-building',
                    'desc'=>'Detail informasi terkait perusahaan tempat magang kalian'),
                array('name'=>'Penilaian',
                    'href'=>site_url('perusahaan?m=penilaian'),
                    'icon'=>'fas fa-star',
                    'desc'=>'Penilaian yang diperoleh dari tempat magang yang bersangkutan')
            );
            break;
            default:$data['menus']= [];
        }
        //get variable
        //sub menu, with crud
        $get = $this->input->get();
        if(isset($get['m'])){
            //create object
            $inputs = new stdClass();
            $form = [];
            switch($get['m']){
                case 'manajemen':
                //create Form Generator class; still on myway
                    //  name =>'nama_perusahaan'
                    //  name =>'alamat_perusahaan'
                    //  name =>'telepon_perusahaan'
                    //  name =>'long_perusahaan'
                    //  name =>'lat_perusahaan'
                    //  name =>'kuota_pkl'
                    // array_push($form);
                break;
                case 'informasi':
                    $post = $this->input->post();
                    if(isset($post['insert'])){
                        $this->create_informasi($post);
                    }
                    if(isset($post['update'])){
                        $this->edit_informasi($post);
                    }
                    if(isset($post['delete'])){
                        $this->remove_informasi($post);
                    }
                break;
                case 'penilaian':
                    $post = $this->input->post();
                    if(isset($post['insert'])){
                        $this->create_manajemen($post);
                    }
                    if(isset($post['update'])){
                        $this->edit_manajemen($post);
                    }
                    if(isset($post['delete'])){
                        $this->remove_manajemen($post);
                    }
                break;
                default:redirect(site_url('perusahaan'));
            }
        }
        
        $this->load->view('admin/perusahaan',$data);

    }
    public function create_manajemen(){

    }
    public function edit_manajemen(){

    }
    public function remove_manajemen(){

    }
    public function create_informasi(){

    }
    public function edit_informasi(){

    }
    public function remove_informasi(){
        
    }
    public function create_penilaian(){

    }
    public function edit_penilaian(){

    }
    public function remove_penilaian(){
        
    }

}

/* End of file Magang.php */
 ?>