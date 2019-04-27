<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('akun_model');
        $this->load->helper('master_helper');
    }
    
    public function index()
    {
        $post = $this->input->post();
        $get = $this->input->get();
        if(isset($get['in'])){
            $akun['tb_akun.username'] = $post['username'];
            $akun['tb_akun.password'] = $post['password'];
            $isValidAkun = $this->checkAccount($akun);
            // var_dump($isValidAkun);
            //must exactly only one account, when it's emtpy or more than one,it will throw to exception
            if(count($isValidAkun) == 1){
                $this->session->set_userdata('level',$isValidAkun->level);
                $this->session->set_userdata('id',$isValidAkun->id);
                redirect(site_url('main'));
                return;
            }
            else {
                $this->session->set_flashdata('fail','Gagal untuk Login, pastikan mengisi username dan password dengan benar');
                redirect(site_url('login'));
                return;
            }
        }
        if(isset($get['ajax'])){
            $response = $this->checkLogin($post['username']);
            echo json_encode(array('result'=>isset($response->username)?$response->username:null));
            return;
        }
        $this->load->view('login'); 
    }
    public function checkLogin($username){
        return masterdata('tb_akun',['username'=>$username]);
    }
    public function checkAccount($akun){
        return $this->akun_model->getAccount($akun);
    }

}

/* End of file Login.php */
 ?>