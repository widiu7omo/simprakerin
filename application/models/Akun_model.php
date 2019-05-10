<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Akun_model extends CI_Model {

	private $_table = 'tb_akun';
	private $_primary_key = 'username';

	public $username;
	public $password;

	//add parameter here

	public function __construct() {
		parent::__construct();
		//Do your magic here
		$this->load->helper( array( 'master' ) );

	}

	public function rules() {
		return [
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required'
			],
		];
	}

	public function getAll() {
		return $this->db->get( $this->_table )->result();
	}

	public function getById( $id = null ) {
		return $this->db->get_where( $this->_table, [ $this->_primary_key => $id ] )->row();
	}

	public function getAccount( $akun ) {
		$result = null;
		// var_dump('reading');
		//why two, cause akun require only username and password
		if ( count( $akun ) != 0 ) {
			$result = $this->db->select( array(
				'tb_akun.username as id',
				'tb_master_level.nama_master_level as level',
				'tb_akun.password as password'
			) )
			                   ->from( 'tb_akun' )
			                   ->join( 'tb_level', 'tb_akun.username = tb_level.username', 'inner' )
			                   ->join( 'tb_master_level', 'tb_level.id_master_level = tb_master_level.id_master_level' )
			                   ->where( $akun )->get()->result();
		}

		return $result;
	}

	public function insert() {

		$post = $this->input->post();

		$this->username = $post['username'];
		$this->password = password_hash( $post['password'], PASSWORD_DEFAULT );
		//add parameter here
		$this->db->insert( $this->_table, $this );
	}

	public function make_account( $datas = [], $dataName ) {
		$createdAccount = [];
		ini_set( 'max_execution_time', 120 );
		foreach ( $datas as $data ) {
			array_push( $createdAccount, [
				'username' => $data->{$dataName},
				'password' => password_hash( $data->{$dataName}, PASSWORD_DEFAULT ),
			] );
		}

		return $createdAccount;
	}

	public function match_data( $datas = [], $addtionalDatas = [], $replacers = [], $addtionalUnset = [] ) {
		//rename index data
		array_map( function ( $data ) use ( $replacers, $addtionalUnset ) {
			foreach ( $replacers as $replacer ) {
				//inject new index with same value
				$data->{$replacer['new']} = $data->{$replacer['old']};
				//delete old index
				if ( ! $replacer['keep'] ) {
					unset( $data->{$replacer['old']} );
				}
				if ( count( $addtionalUnset ) != 0 ) {
					foreach ( $addtionalUnset as $unset ) {
						unset( $data->{$unset} );
					}
				}
			}

			return $data;
		}, $datas );
		//inject addtional data
		foreach ( $datas as $data ) {
			foreach ( $addtionalDatas as $indexName => $dataName ) {
				$data->{$indexName} = $dataName;
			}
		}

		return $datas;
	}

	public function insert_batch( $batchData, $importFor = null, $addtionalDatas = [] ) {
		// Batch data must array, at least contain username and password

		$statusImport           = [];
		$statusImport['status'] = false;
		$key                    = null;
		$primaryTable           = 'tb_akun';
		//addtional table
		$addtionalTable  = null;
		$addtionalTable2 = null;
		$addtionalTable3 = null;
		//replacer
		$replacers     = [];
		$replacerLevel = [];
		$replacerNotif = [];
		//unset data
		$unsetDataLevel = [];
		$unsetDataNotif = [];

		$addtionalDataLevel = [];
		$addtionalDataNotif = [];
		switch ( $importFor ) {
			case 'mahasiswa':
				$key            = 'nim';
				$replacers      = array(
					[ 'old' => 'nama', 'new' => 'nama_mahasiswa', 'keep' => false ],
					[ 'old' => 'nim', 'new' => 'username', 'keep' => true ]
				);
				$replacerLevel  = [
					[
						'old'  => 'nim',
						'new'  => 'username',
						'keep' => false
					]
				];
				$unsetDataLevel = [ 'id_program_studi', 'id_tahun_akademik', 'nama_mahasiswa' ];
				//fecting data needed
				$idLevelMhs                            = masterdata( 'tb_master_level', [ 'nama_master_level' => 'mahasiswa' ] );
				$addtionalDataLevel['id_master_level'] = $idLevelMhs->id_master_level;


				$addtionalDataNotif['pengirim'] = $this->session->userdata( 'level' ) ? $this->session->userdata( 'level' ) : null;
				$addtionalDataNotif['pesan']    = 'Silahkan melengkapi profil terlebih dahulu untuk bisa mengajukan permohonan magang';
				$addtionalDataNotif['hal']      = 'profil';
				$addtionalDataNotif['uri']      = 'user/profile';
				$unsetDataNotif                 = [ 'id_master_level' ];
				$replacerNotif                  = [
					[
						'old'  => 'username',
						'new'  => 'penerima',
						'keep' => false
					]
				];
				$addtionalTable                 = 'tb_mahasiswa';
				$addtionalTable2                = 'tb_level';
				$addtionalTable3                = 'tb_notification';

				break;
			case 'pegawai':
				//chage this config
				//key same as data id
				$key             = 'nip';
				$replacers       = array(
					[ 'old' => 'nama', 'new' => 'nama_pegawai', 'keep' => false ],
					[ 'old' => 'nip', 'new' => 'nip_nik', 'keep' => true ],
					[ 'old' => 'nip', 'new' => 'username', 'keep' => false ],
					[ 'old' => 'alamat', 'new' => 'alamat_pegawai', 'keep' => false ],
					[ 'old' => 'jk', 'new' => 'jk_pegawai', 'keep' => false ],
					[ 'old' => 'email', 'new' => 'email_pegawai', 'keep' => false ],
				);

				//fecting data needed
				$idLevelMhs                            = masterdata( 'tb_master_level', [ 'nama_master_level' => 'dosen' ] );
				$addtionalDataLevel['id_master_level'] = $idLevelMhs->id_master_level;

				$replacerLevel  = [
					[
						'old'  => 'nip_nik',
						'new'  => 'username',
						'keep' => false
					]
				];
				$unsetDataLevel = [ 'nama_pegawai', 'nip_nik', 'alamat_pegawai', 'jk_pegawai','email_pegawai'];

				$addtionalDataNotif['pengirim'] = $this->session->userdata( 'level' ) ? $this->session->userdata( 'level' ) : null;
				$addtionalDataNotif['pesan']    = 'Akun telah dibuat, silahkan melengkapi profil';
				$addtionalDataNotif['hal']      = 'profil';
				$addtionalDataNotif['uri']      = 'user/profile';
				$unsetDataNotif                 = [ 'id_master_level' ];
				$replacerNotif                  = [
					[
						'old'  => 'username',
						'new'  => 'penerima',
						'keep' => false
					]
				];

				$addtionalTable  = 'tb_pegawai';
				$addtionalTable2 = 'tb_level';
				$addtionalTable3 = 'tb_notification';
				break;
			default:
				return 0;
		}
		//generate account with username and password default
		$accounts = $this->make_account( $batchData, $key );
		//START TRANSACTION
		$this->db->trans_start();
		$status = $this->db->insert_batch( $primaryTable, $accounts );
		// var_dump($status);
		//status == TRUE,do insert to addtional Table

		//=========MATCH DATA METHOD ALWAYS GET DATA FROM RAW (BATCH DATA)
		if ( $status != false ) {

			//============insert batch to User (might be Mahasiswa, or Pegawai)
			//MATCHING DATA
			$generatedDataUser = $this->match_data( $batchData, $addtionalDatas, $replacers );

//			var_dump( $generatedDataUser);
			//perform insert batch to User(it can be mahasiswa or pegawai)
			//BATCH INSERT
			$addtionalStatus = $this->db->insert_batch( $addtionalTable, $generatedDataUser );


			//============insert batch to Level
			//MATCHING DATA
			$generatedDataLevel = $this->match_data( $batchData, $addtionalDataLevel, $replacerLevel, $unsetDataLevel );

//			var_dump( $generatedDataLevel);

			//BATCH INSERT
			$this->db->insert_batch( $addtionalTable2, $generatedDataLevel );

			//============insert batch to Notification
			//MATCHING DATA
			$generatedDataNotif = $this->match_data( $batchData, $addtionalDataNotif, $replacerNotif, $unsetDataNotif );

//			var_dump( $generatedDataNotif);

			//BATCH INSERT
			$this->db->insert_batch( $addtionalTable3, $generatedDataNotif );

			//GENERATE STATUS
			$statusImport[ $primaryTable ] = $status;
			if ( $addtionalStatus != false ) {
				$statusImport[ $addtionalTable ] = $addtionalStatus;
			}
		};
		//END TRANSACTION
		$this->db->trans_complete();
		//if status transaction complete, return true
		if ( $this->db->trans_status() != false ) {
			$statusImport['status'] = true;
		}

		return $statusImport;
	}

	public function update() {
		$post = $this->input->post();

		$this->username = $post['username'];
		$this->password = $post['password'];
		//add parameter here
		$this->db->update( $this->_table, $this, [ $this->_primary_key => $post['username'] ] );
	}

	public function delete( $id ) {
		$this->db->delete( $this->_table, [ $this->_primary_key => $id ] );
	}

}

/* End of file suffix_model.php */ ?>