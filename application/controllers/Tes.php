<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Tools\FormGenerator;
require(APPPATH.'libraries/FormGenerator.php');
class Tes extends CI_Controller {

    public function index()
    {
        $formGenerator = new FormGenerator;
        FormGenerator::hey();
        echo $formGenerator->input('input','perusahaan',null,false);
    }

}

/* End of file Tes.php */
 ?>