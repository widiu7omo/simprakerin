<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_foto extends CI_Model {
    
    public function tampil_foto($id_foto = NULL){
        if($id_foto != NULL){ 
            $query = $this->db->select('*')
                ->where('id_foto', $id_foto)
                ->where('kategori_foto', 'galeri')
                ->get('tabel_foto');
        }else{
            $query = $this->db->select('*')
                ->from('tabel_foto')
                ->where('kategori_foto', 'galeri')
                ->get();
        }
        return $query->result();
    } 
    
    public function simpan_foto($data){
        $query = $this->db->insert('tabel_foto', $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function edit_foto($data, $id_foto){
        $query = $this->db->update("tabel_foto", $data, $id_foto);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function hapus_foto($id_foto){
        $query = $this->db->delete('tabel_foto', $id_foto);
        if($query){
            return true;
        }else{
            return false;
        }
    }
}
?>