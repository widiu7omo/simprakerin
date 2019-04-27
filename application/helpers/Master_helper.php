<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('masterdata'))
{
    function masterdata($table,$where = null,$select = null)
    {
        $ci=& get_instance();
        if($where != null){
            return $ci->db->get_where($table,$where)->row();
        }
        
        return $ci->db->get($table)->result();
    }   
    function getCurrentTahun(){
        $ci=& get_instance();
        $ci->db->select('tb_waktu.id_waktu as id,tahun_akademik.tahun_akademik as now')->from('tb_waktu')->join('tahun_akademik','tb_waktu.id_tahun_akademik = tahun_akademik.id_tahun_akademik','INNER');
        return $ci->db->get()->row();
    }
}

/* End of file ModelName.php */
 ?>