<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        // $this->load->model('Model_dashboard');
    }
    
    public function index()
    {
        $this->load->view('admin/dashboard');
        
    }

}

/* End of file Dashboard.php */
 ?>