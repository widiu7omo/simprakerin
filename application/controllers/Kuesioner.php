<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Kuesioner extends CI_Controller {

    public function index()
    {
        $get = $this->input->get();
        if(isset($get['for'])){
            $this->load->view('kuesioner/kuesioner_mahasiswa');
        }
    }

}

/* End of file Kuesioner.php */
