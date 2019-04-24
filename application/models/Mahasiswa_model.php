<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {

    private $_table = 'tb_mahasiswa';
    private $_primary_key = 'nim';
    
    public $nim;
    public $id_tahun_akademik;
    public $id_program_studi;
    public $username;
    public $nama_mahasiswa;
    public $alamat_mhs;
    public $jenis_kelamin_mhs;
    public $email_mhs;
    public $tempat_lahir_mhs;
    public $tanggal_lahir_mhs;
    public $no_hp_mahasiswa;
    public $nama_orangtua_mhs;
    public $no_hp_orangtua_mhs;
    public $akun_id;
  
    //add parameter here

    public function rules(){
        return[
            [
                'field'=>'nim',
                'label'=>'Nim',
                'rules'=>'required'
            ],
            [
                'field'=>'id_tahun_akademik',
                'label'=>'IdTahunAkademik',
                'rules'=>'required'
            ],
            [
                'field'=>'id_program_studi',
                'label'=>'IdProgramStudi',
                'rules'=>'required'
            ],
            [
                'field'=>'nama_mahasiswa',
                'label'=>'NamaMahasiswa',
                'rules'=>'required'
            ]
        ];
    }

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }

    public function getById($id = null){
        return $this->db->get_where($this->_table,[$this->_primary_key=>$id])->row();
    }

    public function insert(){

        $post = $this->input->post();
        $this->nim = $post['nim'];
        $this->id_tahun_akademik = $post['id_tahun_akademik'];
        $this->id_program_studi = $post['id_program_studi'];
        $this->username = $post['username'];
        $this->nama_mahasiswa = $post['nama_mahasiswa'];
        $this->alamat_mhs = isset($post['alamat_mhs'])?$post['alamat_mhs']:null;
        $this->jenis_kelamin_mhs = isset($post['jenis_kelamin_mhs'])?$post['jenis_kelamin_mhs']:null;
        $this->email_mhs = isset($post['email_mhs'])?$post['email_mhs']:null;
        $this->tempat_lahir_mhs = isset($post['tempat_lahir_mhs'])?$post['tempat_lahir_mhs']:null;
        $this->tanggal_lahir_mhs = isset($post['tanggal_lahir_mhs'])?$post['tanggal_lahir_mhs']:null;
        $this->no_hp_mahasiswa = isset($post['no_hp_mahasiswa'])?$post['no_hp_mahasiswa']:null;
        $this->nama_orangtua_mhs = isset($post['nama_orangtua_mhs'])?$post['nama_orangtua_mhs']:null;
        $this->no_hp_orangtua_mhs = isset($post['no_hp_orangtua_mhs'])?$post['no_hp_orangtua_mhs']:null;
        $this->akun_id = $post['akun_id'];
        //add parameter here
        $this->db->insert($this->_table,$this);
    }

    public function update(){
        $post = $this->input->post();

        $this->nim = $post['nim'];
        $this->id_tahun_akademik = $post['id_tahun_akademik'];
        $this->id_program_studi = $post['id_program_studi'];
        $this->username = $post['username'];
        $this->nama_mahasiswa = $post['nama_mahasiswa'];
        $this->alamat_mhs = isset($post['alamat_mhs'])?$post['alamat_mhs']:null;
        $this->jenis_kelamin_mhs = isset($post['jenis_kelamin_mhs'])?$post['jenis_kelamin_mhs']:null;
        $this->email_mhs = isset($post['email_mhs'])?$post['email_mhs']:null;
        $this->tempat_lahir_mhs = isset($post['tempat_lahir_mhs'])?$post['tempat_lahir_mhs']:null;
        $this->tanggal_lahir_mhs = isset($post['tanggal_lahir_mhs'])?$post['tanggal_lahir_mhs']:null;
        $this->no_hp_mahasiswa = isset($post['no_hp_mahasiswa'])?$post['no_hp_mahasiswa']:null;
        $this->nama_orangtua_mhs = isset($post['nama_orangtua_mhs'])?$post['nama_orangtua_mhs']:null;
        $this->no_hp_orangtua_mhs = isset($post['no_hp_orangtua_mhs'])?$post['no_hp_orangtua_mhs']:null;
        $this->akun_id = $post['akun_id'];
        //add parameter here
        $this->db->update($this->_table,$this,[$this->_primary_key=>$post['id']]);
    }

    public function delete($id){
        return $this->db->delete($this->_table,[$this->_primary_key=>$id]);
    }

}
/* End of file suffix_model.php */ ?>