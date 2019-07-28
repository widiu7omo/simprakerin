<<<<<<< HEAD
<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//Do your magic here
		$this->load->model( 'akun_model' );
		$this->load->helper( array( 'master' ) );
	}

	public function index() {
		$post = $this->input->post();
		$get  = $this->input->get();
		//multilevel
		//if multilevel index are exist

		if ( isset( $get['in'] ) ) {
			//excute by modal multilevel
			if ( $get['in'] == 'multi' ) {
				$postAkun                                  = $post['level'];
				$decodeAkun                                = json_decode( $postAkun );
				$akun['tb_akun.username']                  = $decodeAkun[0];
				$akun['tb_master_level.nama_master_level'] = $decodeAkun[2];
				$password                                  = $decodeAkun[1];

				//call again when account have more than one level
				$isValidAkun = $this->checkAccount( $akun, $password );
				$this->session->set_userdata( 'level', $decodeAkun[2]);
				$this->session->set_userdata( 'app', 'simprakerin' );
				$this->session->set_userdata( 'id', $isValidAkun[0]->id );

				switch ( $isValidAkun[0]->level ) {
					case 'mahasiswa':
						$programstudi = masterdata( 'tb_mahasiswa', array( 'nim' => $isValidAkun[0]->id ), 'id_program_studi' );
						$this->session->set_userdata( 'prodi', $programstudi->id_program_studi );
						break;
					case 'dosen':
						$pegawai = masterdata( 'tb_pegawai', array( 'username' => $isValidAkun[0]->id ), 'tb_pegawai.nip_nik' );
						//                  $programstudi = masterdata( 'tb_pegawai',array('tb_pegawai.username'=>$isValidAkun[0]->id),'id_program_studi');
						break;
					case 'admin':
						$pegawai = masterdata( 'tb_pegawai', array( 'username' => $isValidAkun[0]->id ), 'tb_pegawai.nip_nik' );
						//                  $programstudi = masterdata( 'tb_pegawai',array('tb_pegawai.username'=>$isValidAkun[0]->id),'id_program_studi');
						break;
					default:
						$this->session->set_flashdata( 'fail', 'Gagal untuk Login, pastikan mengisi username dan password dengan benar' );
						redirect( site_url( 'login' ) );
				}
				if ( ! $isValidAkun['matching'] ) {
					$this->session->set_flashdata( 'fail', 'Gagal untuk Login, pastikan mengisi username dan password dengan benar' );
					redirect( site_url( 'login' ) );
				}
				redirect( site_url( 'main' ) );
			}
			//is in == true
			$akun['tb_akun.username'] = $post['username'];
			$password                 = $post['password'];
			$isValidAkun              = $this->checkAccount( $akun, $password );

			//must exactly only one account, when it's empty or more than one,it will throw to exception
			//dosen usernamenya adalah email
			//mahasiswa usernamenya nim
			if ( ! $isValidAkun['multi'] ) {
				$this->session->set_userdata( 'level', $isValidAkun[0]->level );
				$this->session->set_userdata( 'app', 'simprakerin' );
				$this->session->set_userdata( 'id', $isValidAkun[0]->id );
				switch ( $isValidAkun[0]->level ) {
					case 'mahasiswa':
						$programstudi_by_year = masterdata( '(select tm.*,tw.`id_tahun_akademik` as id_ta from tb_mahasiswa tm join tb_waktu tw on tm.id_tahun_akademik =tw.id_tahun_akademik) tb_mahasiswa', array( 'nim' => $isValidAkun[0]->id ), 'id_program_studi' );
						if(count( $programstudi_by_year) == 0){
							$this->session->set_flashdata( 'fail', 'Gagal untuk Login, Anda tidak dijinkan login pada semester ini' );
							redirect( site_url( 'login' ) );
						}
						$this->session->set_userdata( 'prodi', $programstudi_by_year->id_program_studi );
						break;
					case 'dosen':
						$pegawai = masterdata( 'tb_pegawai', array( 'username' => $isValidAkun[0]->id ), 'tb_pegawai.nip_nik' );
						//                  $programstudi = masterdata( 'tb_pegawai',array('tb_pegawai.username'=>$isValidAkun[0]->id),'id_program_studi');
						break;
					case 'admin':
						$pegawai = masterdata( 'tb_pegawai', array( 'username' => $isValidAkun[0]->id ), 'tb_pegawai.nip_nik' );
						//                  $programstudi = masterdata( 'tb_pegawai',array('tb_pegawai.username'=>$isValidAkun[0]->id),'id_program_studi');
						break;
					default:
						redirect( site_url( 'login' ) );
				}

				if ( $isValidAkun['matching'] ) {
					redirect( site_url( 'main' ) );
				}
				$this->session->set_flashdata( 'fail', 'Gagal untuk Login, pastikan mengisi username dan password dengan benar' );
				redirect( site_url( 'login' ) );
			} elseif ( $isValidAkun['multi'] ) {
				unset( $isValidAkun['multi'] );
				foreach ( $isValidAkun as $akun ) {
					$akun->userpass = $password;
				}
//				var_dump( $isValidAkun);
				$this->session->set_flashdata( 'multilevel', $isValidAkun );
				redirect( site_url( 'login?m=true' ) );

				return;
			} else {
				$this->session->set_flashdata( 'fail', 'Gagal untuk Login, pastikan mengisi username dan password dengan benar' );
				redirect( site_url( 'login' ) );

				return;
			}
		}
		//to check is akun exist or not
		if ( isset( $get['ajax'] ) ) {
			$response = $this->checkLogin( $post['username'] );
			echo json_encode( array( 'result' => isset( $response->username ) ? $response->username : null ) );

			return;
		}

		//last think, it must be return to view login
		$this->load->view( 'login' );
	}

	public function checkLogin( $username ) {
		return masterdata( 'tb_akun', array( 'username' => $username ) );
	}

	public function checkAccount( $akun, $password ) {
		//get account based or username ? row > 2 : ++ level
		$result = $this->akun_model->getAccount( $akun );
		//jika akun mempunyai level 1 saja, password akan di verifikasi
		if ( count( $result ) == 1 ) {
			// var_dump($result[0]->password);
			$result['multi'] = false;
			//checking is MD5 or hash
			if ( strlen( $result[0]->password ) == 32 ) {
				//is md5
				$result['matching'] = md5( $password ) == $result[0]->password ? true : false;
			} else {
				//is bcrypt
				$result['matching'] = password_verify( $password, $result[0]->password );
			}
		} //jika level lebih dari 1
		else {
			$result['multi'] = true;
		}
		//matching password by bcrypted and plaing password ONLY when result have row / rows
		//TODO:cleaning.

		return $result;
	}
=======
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('akun_model');
        $this->load->helper(array('master'));
    }
    
    public function index()
    {
        $post = $this->input->post();
        $get = $this->input->get();
        //multilevel
        //if multilevel index are exist
        
        if(isset($get['in'])){
            //excute by modal multilevel
            if($get['in'] == 'multi'){
//                var_dump('hey from multilevel');
                $postAkun = $post['level'];
                $decodeAkun = json_decode($postAkun);
                $akun['tb_akun.username'] = $decodeAkun[0];
                $akun['tb_master_level.nama_master_level'] = $decodeAkun[2];
                $password = $decodeAkun[1];
                // var_dump($akun);

                //call again when account have more than one level
                $isValidAkun = $this->checkAccount($akun,$password);
                // var_dump($isValidAkun);
                // var_dump($isValidAkun);
                if(isset($isValidAkun['status']) && $isValidAkun == true){
                    $this->session->set_userdata('level',$isValidAkun[0]->level);
                    $this->session->set_userdata('id',$isValidAkun[0]->id);
                    //add program studi to session if user is mahasiswa
                    if($isValidAkun[0]->level == 'mahasiswa'){
                        $programstudi = masterdata( 'tb_mahasiswa',['nim'=>$isValidAkun[0]->id],'id_program_studi');
                        $this->session->set_userdata( 'prodi',$programstudi->id_program_studi );
                    }
                    redirect(site_url('main'));
                }
                else {
                    $this->session->set_flashdata('fail','Gagal untuk Login, pastikan mengisi username dan password dengan benar');
                    redirect(site_url('login'));
                }
                return;
            }
            $akun['tb_akun.username'] = $post['username'];
            $password = $post['password'];
            $isValidAkun = $this->checkAccount($akun,$password);
            // var_dump($isValidAkun);
            
            //must exactly only one account, when it's emtpy or more than one,it will throw to exception
            if($isValidAkun['status']){
                $this->session->set_userdata('level',$isValidAkun[0]->level);
                $this->session->set_userdata('id',$isValidAkun[0]->id);
                if($isValidAkun[0]->level == 'mahasiswa'){
                    $programstudi = masterdata( 'tb_mahasiswa',['nim'=>$isValidAkun[0]->id],'id_program_studi');
                    $this->session->set_userdata( 'prodi',$programstudi->id_program_studi );
                }
                redirect(site_url('main'));
                return;
            }
            if(!$isValidAkun['status']){
                unset($isValidAkun['status']);
                $this->session->set_flashdata('multilevel',$isValidAkun);
                redirect(site_url('login?m=true'));
                return;
            }
            else {
                $this->session->set_flashdata('fail','Gagal untuk Login, pastikan mengisi username dan password dengan benar');
                redirect(site_url('login'));
                return;
            }
        }
        if(isset($get['ajax'])){
            $response = $this->checkLogin($post['username']);
            echo json_encode(array('result'=>isset($response->username)?$response->username:null));
            return;
        }
        $this->load->view('login'); 
    }
    public function checkLogin($username){
        return masterdata('tb_akun',['username'=>$username]);
    }
    public function checkAccount($akun,$password){
        //get account based or username ? row > 2 : ++ level
        $result = $this->akun_model->getAccount($akun);
        //if row more than one set status to false
        //IF result count account more than 1
        if(count($result) > 1){
            $result['status'] = false;
            return $result;
        }
        //matching password by bcrypted and plaing password ONLY when result have row / rows
        //TODO:cleaning.
        //IF result count account === 1
        if(count($result) == 1){
            // var_dump($result[0]->password);
            $result['status'] = password_verify($password,$result[0]->password);
        }
        // var_dump($result);
        return $result;
    }
>>>>>>> 5afebab207b07bf6bf315a9f7d03a7245fb91af8

}

/* End of file Login.php */
<<<<<<< HEAD
?>
=======
 ?>
>>>>>>> 5afebab207b07bf6bf315a9f7d03a7245fb91af8
