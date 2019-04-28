<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Magang extends CI_Controller {

    public function index()
    {
        $level = $this->session->userdata('level');
        switch($level){
            case 'mahasiswa':
            $data['menus'] = array(
                array('name'=>'Pengajuan Magang',
                    'href'=>site_url('magang?m=pengajuan'),
                    'icon'=>'fas fa-id-badge',
                    'desc'=>'Ajukan pengajuan magang untuk memilih tempat magang yang diinginkan'),
                array('name'=>'Informasi Perusahaan',
                    'href'=>site_url('magang?m=perusahaan'),
                    'icon'=>'fas fa-building',
                    'desc'=>'Detail informasi terkait perusahaan tempat magang kalian'),
                array('name'=>'Penilaian',
                    'href'=>site_url('magang?m=penilaian'),
                    'icon'=>'fas fa-star',
                    'desc'=>'Penilaian yang diperoleh dari tempat magang yang bersangkutan')
            );
            break;
            case 'dosen':
            $data['menus'] = array(
                array('name'=>'Monev Prakerin',
                    'href'=>'https://monev.prakerin.politala.ac.id',
                    'desc'=>'Aplikasi monitoring tempat Praktik kerja lapangan'),
                array('name'=>'Kuesioner Dosen',
                    'href'=>site_url('kuesioner?m=dsn'),
                    'desc'=>'Kuesioner bagi dosen tentang bla bla bla')
            );
            break;
            default:$data['menus']= [];
        }
        $this->load->view('user/magang',$data);
        
    }

}

/* End of file Magang.php */
 ?>