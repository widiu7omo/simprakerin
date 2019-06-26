<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Sync extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//Do your magic here
		$this->load->helper( 'master' );
		$this->load->model( 'akun_model' );
	}


	public $pegawais = array(
		[
			'nip'    => '1234',
			'nama'   => 'Danar Widi',
			'alamat' => 'Pabahanan',
			'jk'     => 'Laki-laki',
			'email'  => 'danar@dioinstant.com'
		],
		[
			'nip'    => '111',
			'nama'   => 'Rano Karno',
			'alamat' => 'Pelaihari',
			'jk'     => 'Laki-laki',
			'email'  => 'rano@dioinstant.com'
		]
	);

	public function index(){
		var_dump('exp');
		$kepegawaian =$this->load->database('kepegawaian',TRUE);
		$tables = $kepegawaian->query('show create table tb_user')->result();
		var_dump( $tables);
	}
	public function set_pegawai() {
		//insert into akun
		$objectPegawais = json_decode( json_encode( $this->pegawais ) );
		$this->akun_model->insert_batch( $objectPegawais, 'pegawai', [] );
		echo json_encode( ['status'=>'success import data pegawai']);
		//insert into pegawai
		//insert into level
	}

	public function retrive_pegawai() {
		//  fetcing data from another database
		//	$config['hostname'] = 'localhost';
		//	$config['username'] = 'myusername';
		//	$config['password'] = 'mypassword';
		//	$config['database'] = 'mydatabase';
		//	$config['dbdriver'] = 'mysqli';
		//	$config['dbprefix'] = '';
		//	$config['pconnect'] = FALSE;
		//	$config['db_debug'] = TRUE;
		//	$this->load->model( 'nama_model','',$config );
	}
}