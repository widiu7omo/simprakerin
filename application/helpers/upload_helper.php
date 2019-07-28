<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//change name to snake case
if ( ! function_exists('do_upload'))
{
    function do_upload(){
        $ci=& get_instance();
<<<<<<< HEAD
            $config['upload_path']          = './file_upload/';
=======
            $config['upload_path']          = './uploads/';
>>>>>>> 5afebab207b07bf6bf315a9f7d03a7245fb91af8
            $config['allowed_types']        = 'xls|xlsx';
            $config['max_size']             = 10240;

            $ci->load->library('upload', $config);

            if ( ! $ci->upload->do_upload('file'))
            {
                $error = array('error' => $ci->upload->display_errors());
                // var_dump($error);
                return $error; 
                // $ci->load->view('upload_form', $error);
            }
            else
            {
                $data = array('upload_data' => $ci->upload->data());
                // var_dump($data);
                return $data;
                // $ci->load->view('upload_success', $data);
            }
        }
}
if ( ! function_exists('do_upload_doc'))
{
	function do_upload_doc(){
		$ci=& get_instance();
<<<<<<< HEAD
		$config['upload_path']          = './file_upload/bukti/';
=======
		$config['upload_path']          = './uploads/bukti/';
>>>>>>> 5afebab207b07bf6bf315a9f7d03a7245fb91af8
		$config['allowed_types']        = 'pdf|docx|doc';
		$config['max_size']             = 10240;

		$ci->load->library('upload', $config);

		if ( ! $ci->upload->do_upload('file'))
		{
			$error = array('error' => $ci->upload->display_errors());
			// var_dump($error);
			return $error;
			// $ci->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $ci->upload->data());
			// var_dump($data);
			return $data;
			// $ci->load->view('upload_success', $data);
		}
	}
}
?>