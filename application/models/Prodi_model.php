<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi_model extends CI_Model {

    private $_table = 'tb_program_studi';

    public $primary_key = 'id_program_studi';
    public $id_program_studi;
    public $nama_program_studi;
  
    //add parameter here

    public function rules(){
        return[
            [
                'field'=>'prodi',
                'label'=>'Program Studi',
                'rules'=>'required'
            ],
        ];
    }

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }

    public function getById($id = null){
        return $this->db->get_where($this->_table,[$this->primary_key=>$id])->row();
    }

    public function insert(){

        $post = $this->input->post();
        
        $this->id_program_studi = $post['id'];
        $this->nama_program_studi = $post['nama'];
        //add parameter here
        $this->db->insert($this->_table,$this);
    }

    public function update(){
        $post = $this->input->post();

        $this->changeHere = $post['ChangeHere'];
        //add parameter here
        $this->db->update($this->_table,$this,['ChangeHere'=>$post['ChangeHere']]);
    }

    public function delete($id){
        $this->db->delete($this->_table,['changeHere'=>$id]);
    }

}
/* End of file suffix_model.php */ ?>