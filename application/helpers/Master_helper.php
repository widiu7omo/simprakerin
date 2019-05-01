<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('masterdata')) {
	function masterdata( $table, $where = null, $select = null, $resultArray = false ) {
		$ci =& get_instance();
		if ( $select != null ) {
			$ci->db->select( $select );
		}

		if ( $where != null ) {
			if ( $resultArray ) {
				return $ci->db->get_where( $table, $where )->result();
			}

			return $ci->db->get_where( $table, $where )->row();
		}

		return $ci->db->get( $table )->result();
	}

	function getCurrentTahun() {
		$ci =& get_instance();
		$ci->db->select( 'tb_waktu.id_waktu as id,tahun_akademik.tahun_akademik as now' )->from( 'tb_waktu' )->join( 'tahun_akademik', 'tb_waktu.id_tahun_akademik = tahun_akademik.id_tahun_akademik', 'INNER' );

		return $ci->db->get()->row();
	}

	function datajoin( $table, $where = null, $select = null, $join = null ) {
		$ci =& get_instance();
		if ( $select != null ) {
			$ci->db->select( $select );
		}
		if ( $where != null ) {
			$ci->db->where( $where );
		}
		if ( $join != null ) {
			$ci->db->join( $join[0], $join[1], $join[2] );
		}

		return $ci->db->get( $table )->result();

	}
}
/* End of file ModelName.php */
 ?>