<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class changeHere_model extends CI_Model {

    private $_table = 'changeHere';

    public $changeHere;
    //add parameter here
    public function getAll(){
        return $this->db->get($this->_table)->result();
    }

    public function getById($id = null){
        return $this->db->get_where($this->_table,['changeHere'=>$id])->row();
    }

    public function insert(){

        $post = $this->input->post();

        $this->changeHere = $post['ChangeHere'];
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