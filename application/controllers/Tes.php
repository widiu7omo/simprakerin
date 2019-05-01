<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Tools\FormGenerator;
require(APPPATH.'libraries/FormGenerator.php');
class Tes extends CI_Controller {

    public function index()
    {
    	$options = array(
    		array('name'=>'Zebra','value'=>'zebra'),
	        array('name'=>'Lion','value'=>'lion'));
        $formGenerator = new FormGenerator();
        $formGenerator->initialize('perusahaan','form-group','select',null,$options);
        echo $formGenerator->result();
        $formGenerator = new FormGenerator();
        $formGenerator->initialize('radio','form-group','text','password',null);
        echo $formGenerator->result();

    }

}

/* End of file Tes.php */
 ?>