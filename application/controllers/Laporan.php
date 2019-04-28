<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function index()
    {
        $level = $this->session->userdata('level');
        switch($level){
            case 'mahasiswa':
            $data['menus'] = array(
                array('name'=>'Upload Berkas',
                    'href'=>site_url('laporan?m=upload'),
                    'icon'=>'fas fa-id-badge',
                    'desc'=>'Upload berkas terkait laporan magang'),
                array('name'=>'Laporan Finishing',
                    'href'=>site_url('magang?m=finishing'),
                    'icon'=>'fas fa-building',
                    'desc'=>'Laporan magang yang sudah fix untuk di ajukan sidang'),
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