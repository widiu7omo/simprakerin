<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {

    private $_table = 'tb_mahasiswa';
    
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

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }
    public function getById($id = null){
        return $this->db->get_where($this->_table,['nim'=>$id])->row();
    }
    public function insert(){
        $post = $this->input->post();
        $this->nim = $post['nim'];
        $this->id_tahun_akademik = $post['id_tahun_akademik'];
        $this->id_program_studi = $post['id_program_studi'];
        $this->username = $post['username'];
        $this->nama_mahasiswa = $post['nama_mahasiswa'];
        // $this->alamat_mhs = $post['alamat_mhs'];
        // $this->jenis_kelamin_mhs = $post['jenis_kelamin_mhs'];
        // $this->email_mhs = $post['email_mhs'];
        // $this->tempat_lahir_mhs = $post['tempat_lahir_mhs'];
        // $this->tanggal_lahir_mhs = $post['tanggal_lahir_mhs'];
        // $this->no_hp_mahasiswa = $post['no_hp_mahasiswa'];
        // $this->nama_orangtua_mhs = $post['nama_orangtua_mhs'];
        // $this->no_hp_orangtua_mhs = $post['no_hp_orangtua_mhs'];
        $this->akun_id = $post['akun_id'];
        $this->db->insert($this->_table,$this);
    }
    public function update(){
        $post = $this->input->post();
        $this->nim = $post['nim'];
        $this->id_tahun_akademik = $post['id_tahun_akademik'];
        $this->id_program_studi = $post['id_program_studi'];
        $this->username = $post['username'];
        $this->nama_mahasiswa = $post['nama_mahasiswa'];
        $this->alamat_mhs = $post['alamat_mhs'];
        $this->jenis_kelamin_mhs = $post['jenis_kelamin_mhs'];
        $this->email_mhs = $post['email_mhs'];
        $this->tempat_lahir_mhs = $post['tempat_lahir_mhs'];
        $this->tanggal_lahir_mhs = $post['tanggal_lahir_mhs'];
        $this->no_hp_mahasiswa = $post['no_hp_mahasiswa'];
        $this->nama_orangtua_mhs = $post['nama_orangtua_mhs'];
        $this->no_hp_orangtua_mhs = $post['no_hp_orangtua_mhs'];
        $this->akun_id = $post['akun_id'];
        $this->db->update($this->_table,$this,['nim'=>$post['id']]);
    }
    public function delete($id){
        $this->db->delete($this->_table,['nim'=>$id]);
    }
}

/* End of file Mahasiswa_model.php */
 ?>