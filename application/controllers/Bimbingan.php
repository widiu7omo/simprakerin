<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Bimbingan extends CI_Controller {

    public function index()
    {
        $level = $this->session->userdata('level');
        switch($level){
            case 'mahasiswa':
            $data['menus'] = array(
                array('name'=>'Konsultasi Bimbingan',
                    'href'=>site_url('bimbingan?m=konsultasi'),
                    'icon'=>'fas fa-id-badge',
                    'desc'=>'Konsultasi bimbingan kepada dosen pembimbing masing-masing yang diwajibkan tiap minggunya'),
                array('name'=>'Pengajuan Sidang',
                    'href'=>site_url('bimbingan?m=pengajuan'),
                    'icon'=>'fas fa-building',
                    'desc'=>'Pengajuan sidang wajib di konsultasikan kepada dosen pembimbing'),
            );
            break;
            case 'dosen':
            $data['menus'] = array(
                array('name'=>'Mahasiswa Bimbingan',
                    'href'=>site_url('bimbingan?m=bimbinganmhs'),
                    'desc'=>'Bimbingan Prakerin masing-masing dosen'),
                array('name'=>'Approval Sidang',
                    'href'=>site_url('bimbingan?m=approvesidang'),
                    'desc'=>'Persetujuan permintaan sidang mahasiswa oleh dosen pembimbing')
            );
            break;
            default:$data['menus']= [];
        }
        $this->load->view('user/bimbingan',$data);
    }

}

/* End of file Bimbingan.php */
 ?>