<<<<<<< HEAD
<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Main extends CI_Controller {

	public function index() {
		$level = $this->session->userdata( 'level' );
		switch ( $level ) {

			case 'admin':
				redirect( site_url( 'dashboard' ) );
				break;

			case 'prakerin':

				break;

			case 'koordinator prodi':
				redirect( site_url( 'dashboard' ) );
				break;

			case 'akademik':

				break;

			case 'dosen':
				//under development
				redirect( site_url( 'development' ) );
				break;

			case 'mahasiswa':
				redirect( site_url( 'user' ) );
				break;

			case 'pembimbing lapangan':

				break;

			default:
				redirect( site_url( 'blog/home' ) );
		}
	}
=======
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function index()
    {
        $level = $this->session->userdata('level');
        switch($level){
            
            case 'admin':
                redirect(site_url('dashboard'));
            break;

            case 'prakerin':

            break;

            case 'koordinator prodi':
				redirect(site_url('dashboard'));
            break;
            
            case 'akademik':

            break;

            case 'dosen':

            break;

            case 'mahasiswa':
                redirect(site_url('user'));
            break;

            case 'pembimbing lapangan':

            break;
            
            default: redirect(site_url('welcome'));
        }
    }
>>>>>>> 5afebab207b07bf6bf315a9f7d03a7245fb91af8

}

/* End of file Main.php */
<<<<<<< HEAD
?>
=======
 ?>
>>>>>>> 5afebab207b07bf6bf315a9f7d03a7245fb91af8
