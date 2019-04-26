<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_model extends CI_Model {

    private $_table = 'tb_akun';
    private $_primary_key = 'username';

    public $username;
    public $password;
    //add parameter here


    public function rules(){
        return[
            [
                'field'=>'username',
                'label'=>'Username',
                'rules'=>'required'
            ],
            [
                'field'=>'password',
                'label'=>'Password',
                'rules'=>'required'
            ],
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

        $this->username = $post['username'];
        $this->password = $post['password'];
        //add parameter here
        $this->db->insert($this->_table,$this);
    }

    public function make_account($datas = [],$dataName){
        $createdAccount = [];
        foreach($datas as $data){
            array_push($createdAccount,[
                'username'=>$data->{$dataName},
                'password'=>$data->{$dataName},
            ]);
        }
        return $createdAccount;
    }
    
    public function match_data($datas = [],$addtionalDatas = [],$replacers = [],$addtionalUnset=[]){
        //rename index data
        array_map(function($data) use ($replacers,$addtionalUnset){
            foreach($replacers as $replacer){
                //inject new index with same value
                $data->{$replacer['new']} = $data->{$replacer['old']};
                //delete old index
                unset($data->{$replacer['old']});
                if(count($addtionalUnset) != 0){
                    foreach($addtionalUnset as $unset){
                        unset($data->{$unset});
                    }
                }
            }
            return $data;
        },$datas);
        //inject addtional data
        foreach($datas as $data){
            foreach($addtionalDatas as $indexName => $dataName){
                $data->{$indexName} = $dataName;
            }
        }
        return $datas;
    }
    public function insert_batch($batchData,$importFor = null,$addtionalDatas){
        //load helper
        $this->load->helper('master_helper');
        // Batch data must array, at least contain username and password
        
        $statusImport = [];
        $statusImport['status'] = false;
        $key = null;
        $primaryTable = 'tb_akun';
        $addtionalTable = null;
        switch($importFor){
            case 'mahasiswa':
            $key = 'nim';
            $replacers = array(['old'=>'nama','new'=>'nama_mahasiswa']);
            $addtionalTable = 'tb_mahasiswa';
            $addtionalTable2 = 'tb_level';
            break;
            case 'pegawai':
            $key = 'nip';
            $addtionalTable = 'tb_pegawai';
            break;
        }
        //generate account with username and password default
        $accounts = $this->make_account($batchData,$key);
        //start tansaction
        $this->db->trans_start();
        $status = $this->db->insert_batch($primaryTable,$accounts);
        // var_dump($status);
        //status == TRUE,do insert to addtional Table
        if($status != false){
            $generatedDataMhs = $this->match_data($batchData,$addtionalDatas,$replacers);
            // var_dump($generatedData);
            //insert batch to mahasiswa
            $addtionalStatus = $this->db->insert_batch($addtionalTable,$generatedDataMhs);
            //insert batch to level
            //from batch nama we change, nim to username, and inject id master level
            $idLevelMhs = masterdata('tb_master_level',['nama_master_level'=>'mahasiswa']);
            $addtionalDataLevel['id_master_level'] = $idLevelMhs->id_master_level;
            $unsetData = ['id_program_studi','id_tahun_akademik','nama_mahasiswa'];
            $generatedDataLevel = $this->match_data($batchData,$addtionalDataLevel,[['old'=>'nim','new'=>'username']],$unsetData);
            $this->db->insert_batch($addtionalTable2,$generatedDataLevel);
            $statusImport[$primaryTable] = $status;
            if($addtionalStatus != false){
                $statusImport[$addtionalTable] = $addtionalStatus;
            }
        };
        $this->db->trans_complete();
        //if status transaction complete, return true
        if($this->db->trans_status() != false){
            $statusImport['status'] = true;
        }
        
        return $statusImport;
    }
    public function update(){
        $post = $this->input->post();

        $this->username = $post['username'];
        $this->password = $post['password'];
        //add parameter here
        $this->db->update($this->_table,$this,[$this->_primary_key=>$post['username']]);
    }

    public function delete($id){
        $this->db->delete($this->_table,[$this->_primary_key=>$id]);
    }

}
/* End of file suffix_model.php */ ?>