<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );
require_once APPPATH . "../vendor/autoload.php";

use Auth0\SDK\Auth0;

class Auth extends CI_Controller {

//private $client_id = 'wYQ9wTW3fhA3BKVdhsNUcfbpp2I2ZA1r';
//private $domain = 'ssopolitala.auth0.com';
//private $client_secret = 'lQn8TkkLVGAZsTnZcXD3bi6Rcq4L1T5NxwyFKYyQChWxDMcj3GDvyhcxtHJsZC9q';
//private $redirect_uri = 'http://simpkl.politala.ac.dio/';
//private $audience = '';
	private $auth0 = null;
	private $client_id = 'lQij03edNRYZQ723uqZ0uJxijddBM3Ot';
	private $domain = 'dioinstant.auth0.com';
	private $client_secret = 'skJpUII-F9ln79pmVc4QW7cvQ0LkcwEGPvi-HOYbabSI2neVmwWDCzbaN6ZqUQv_';
	private $redirect_uri = 'http://simpkl.politala.ac.dio/';
	private $audience = '';
	/**
	 * @var array|null
	 */
	private $userInfo;

	public function __construct() {
		parent::__construct();
		if ( $this->audience == '' ) {
			$this->audience = 'https://' . $this->domain . '/userinfo';
		}

		try {
			$this->auth0 = new Auth0( array(
				'domain'                => $this->domain,
				'client_id'             => $this->client_id,
				'client_secret'         => $this->client_secret,
				'redirect_uri'          => $this->redirect_uri,
				'persist_id_token'      => true,
				'persist_access_token'  => true,
				'persist_refresh_token' => true,
			) );
		} catch ( \Auth0\SDK\Exception\CoreException $e ) {
		}
	}

	// kalau sdhlogin,kedashboard,kalaubelum login sso
	public function index() {
		$user = $this->getUser();
		var_dump($user);

		if ( !$user ) {
			$this->login();
		} else {
			$query = $this->db->where( 'sso', $this->userInfo['sub'] )->get( 'user' );

			$result_user = $query->row();
			// var_dump(strpos( $this->userInfo['sub'],'google-oauth2'));

			//jika sudah login akan diarahkan pada masing-masing jabatan
////			if ( ! empty( $result_user ) ) {
////				$user = $this->db->select( 'name' )->from( 'user' )->where( 'id', $result_user->id )->get()->row();
////				if ( empty( $user ) ) {
////					redirect( 'auth/verifikasi' );
////				}
////				$user                = @$user->nama;
////				$userData['id']      = $result_user->id;
////				$userData['email']   = $result_user->email;
////				$userData['sso']     = $result_user->sso;
////				$userData['role_id'] = $result_user->role_id;
////				$role_id             = $result_user->role_id;
////
////				// var_dump($role_id);
////
////				// $this->session->set_userdata('loggedIn', true);
////				// $this->session->set_userdata($userData);
////				$this->session->set_userdata( $userData );
////				if ( $role_id == 1 ) {
////					redirect( 'admin' );
////				} else {
////					redirect( 'user' );
////				}
////				// die();
////			} else {
////
////				echo "<script>
////            alert ('Akun Belum Terdaftar')
////
////            </script>";
//
//				return false;
//			}
		}
	}

	public function login() {
		$this->auth0->login();
	}

	public function reset() {
		//reset password
		$this->userInfo = $this->getUser();

		$email = $this->userInfo['name'];

		$curl = curl_init();
		curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, 0 );
		curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, 0 );

		curl_setopt_array( $curl, array(
			CURLOPT_URL            => "https://ssopolitala.auth0.com/dbconnections/change_password",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => "",
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 30,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => "POST",
			CURLOPT_POSTFIELDS     => "{\"client_id\": \"wYQ9wTW3fhA3BKVdhsNUcfbpp2I2ZA1r\",\"email\": \"$email\",\"connection\": \"Username-Password-Authentication\"}",
			CURLOPT_HTTPHEADER     => array(
				"content-type: application/json"
			),
		) );

		$response = curl_exec( $curl );
		$err      = curl_error( $curl );

		curl_close( $curl );

		if ( $err ) {
			echo "cURL Error #:" . $err;
		} else {
			// if($this->session->userdata('level')=='mahasiswa'){
			//     echo "<script>alert('Cek email anda untuk mengganti Password.'); location.href='".base_url("mahasiswa")."';</script>";
			// }else if($this->session->userdata('level')=='dosen'){
			//     echo "<script>alert('Cek email anda untuk mengganti Password.'); location.href='".base_url("dosen")."';</script>";
			// }else if($this->session->userdata('level')=='tendik'){
			//     echo "<script>alert('Cek email anda untuk mengganti Password.'); location.href='".base_url("tendik")."';</script>";
			// }else if($this->session->userdata('level')=='p4mp'){
			//     echo "<script>alert('Cek email anda untuk mengganti Password.'); location.href='".base_url("p4mp")."';</script>";
			// }
		}
	}

	public function logout() {
		// var_dump($this->session->userdata());
		// var_dump('<br>','<br>','<br>',$this->auth0);
		$this->auth0->logout();
		session_destroy();

		// $this->auth0=null;
		// var_dump('<br>','<br>','<br>',$this->auth0);
		// var_dump($this->session->userdata());
		// die();
		// redirect('https://'.$this->domain.'/v2/logout?client_id='.$this->client_id.'&retunTo=http://siakad.ssopolitala.com/');
		//   redirect('https://ssopolitala.auth0.com/v2/logout');
		//  redirect ('http://siakad.ssopolitala.com/');
		/*redirect('http://localhost/kuis_p4mp/login/logout');*/
		redirect( 'https://' . $this->domain . '/v2/logout?client_id=' . $this->client_id . '&retunTo=http://localhost/bkd/' );
	}

	public function getUser() {
		return $this->auth0->getUser();
	}

}
