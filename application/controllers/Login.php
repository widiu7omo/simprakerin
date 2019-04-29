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
        //multilevel
        //if multilevel index are exist
        
        if(isset($get['in'])){
            if($get['in'] == 'multi'){
                $postAkun = $post['level'];
                $decodeAkun = json_decode($postAkun);
                $akun['tb_akun.username'] = $decodeAkun[0];
                $akun['tb_master_level.nama_master_level'] = $decodeAkun[2];
                $password = $decodeAkun[1];
                // var_dump($akun);

                //call again when account have more than one level
                $isValidAkun = $this->checkAccount($akun,$password);
                // var_dump($isValidAkun);
                // var_dump($isValidAkun);
                if(isset($isValidAkun['status']) && $isValidAkun == true){
                    $this->session->set_userdata('level',$isValidAkun[0]->level);
                    $this->session->set_userdata('id',$isValidAkun[0]->id);
                    redirect(site_url('main'));
                }
                else {
                    $this->session->set_flashdata('fail','Gagal untuk Login, pastikan mengisi username dan password dengan benar');
                    redirect(site_url('login'));
                }
                return ;
            }
            $akun['tb_akun.username'] = $post['username'];
            $password = $post['password'];
            $isValidAkun = $this->checkAccount($akun,$password);
            // var_dump($isValidAkun);
            
            //must exactly only one account, when it's emtpy or more than one,it will throw to exception
            if($isValidAkun['status']){
                $this->session->set_userdata('level',$isValidAkun[0]->level);
                $this->session->set_userdata('id',$isValidAkun[0]->id);
                redirect(site_url('main'));
                return;
            }
            if(!$isValidAkun['status']){
                unset($isValidAkun['status']);
                $this->session->set_flashdata('multilevel',$isValidAkun);
                redirect(site_url('login?m=true'));
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
    public function checkAccount($akun,$password){
        //get account based or username ? row > 2 : ++ level
        $result = $this->akun_model->getAccount($akun);
        //if row more than one set status to false
        //IF result count account more than 1
        if(count($result) > 1){
            $result['status'] = false;
            return $result;
        }
        //matching password by bcrypted and plaing password ONLY when result have row / rows
        //TODO:cleaning.
        //IF result count account === 1
        if(count($result) == 1){
            // var_dump($result[0]->password);
            $result['status'] = password_verify($password,$result[0]->password);
        }
        // var_dump($result);
        return $result;
    }

}

/* End of file Login.php */
 ?>
