<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Magang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['perusahaan_model','pengajuan_model']);
		$this->load->helper(['notification','master']);
		!$this->session->userdata('level')?redirect(site_url('main')):null;
		$id = $this->session->userdata('id');
		$mahasiswa = masterdata( 'tb_mahasiswa',['nim'=>$id],['alamat_mhs','email_mhs','jenis_kelamin_mhs'],false);
		($mahasiswa->alamat_mhs == null || $mahasiswa->email_mhs == null || $mahasiswa->jenis_kelamin_mhs == null)?redirect(site_url('user/profile')):null;
		//Do your magic here
	}
    public function index()
    {
        $level = $this->session->userdata('level');
        switch($level){
            case 'mahasiswa':
            $data['menus'] = array(
                array('name'=>'Pengajuan Magang',
                    'href'=>site_url('magang?m=pengajuan'),
                    'icon'=>'fas fa-id-badge',
                    'desc'=>'Ajukan pengajuan magang untuk memilih tempat magang yang diinginkan'),
	            array('name'=>'Pengajuan Perusahaan baru',
	                  'href'=>site_url('magang?m=perusahaanbaru'),
	                  'icon'=>'fas fa-star',
	                  'desc'=>'Penilaian yang diperoleh dari tempat magang yang bersangkutan'),
                array('name'=>'Informasi Perusahaan',
                    'href'=>site_url('magang?m=perusahaan'),
                    'icon'=>'fas fa-building',
                    'desc'=>'Detail informasi terkait perusahaan tempat magang kalian'),
                array('name'=>'Penilaian',
                    'href'=>site_url('magang?m=penilaian'),
                    'icon'=>'fas fa-star',
                    'desc'=>'Penilaian yang diperoleh dari tempat magang yang bersangkutan'),

            );
            break;
            case 'dosen':
            $data['menus'] = array(
                array('name'=>'Monev Prakerin',
                    'href'=>'https://monev.prakerin.politala.ac.id',
                    'desc'=>'Aplikasi monitoring tempat Praktik kerja lapangan'),
                array('name'=>'Kuesioner Dosen',
                    'href'=>site_url('kuesioner?m=dsn'),
                    'desc'=>'Kuesioner bagi dosen tentang bla bla bla')
            );
            break;
            default:show_error("Access Denied. You Do Not Have The Permission To Access This Page On This
            Server",403,"Forbidden, you don't have pemission");
        }

	    //get variable
	    //sub menu, with crud
	    $get = $this->input->get();
	    if(isset($get['m'])){
		    switch($get['m']){
			    case 'pengajuan':
				    if(isset($get['q']) && $get['q'] == 'i'){
					    return $this->create_pengajuan();
				    }
				    if(isset($get['q']) && $get['q'] == 'u'){
					    return $this->edit_pengajuan();
				    }
				    if(isset($get['q']) && $get['q'] == 'd'){
					    return $this->remove_pengajuan();
				    }
				    return $this->index_pengajuan();

				    break;
			    case 'perusahaan':
				    $post = $this->input->post();
				    if(isset($post['insert'])){
					    $this->create_perusahaan($post);
				    }
				    if(isset($post['update'])){
					    $this->edit_perusahaan($post);
				    }
				    if(isset($post['delete'])){
					    $this->remove_perusahaan($post);
				    }
				    break;
			    case 'penilaian':
				    $post = $this->input->post();
				    if(isset($post['insert'])){
					    $this->create_pengajuan($post);
				    }
				    if(isset($post['update'])){
					    $this->edit_pengajuan($post);
				    }
				    if(isset($post['delete'])){
					    $this->remove_pengajuan($post);
				    }
				    break;
			    default:redirect(site_url('magang'));
		    }
	    }
        $this->load->view('user/magang',$data);

    }
	public function index_pengajuan(){
		$level = $this->session->userdata('level');
		$prodi = $this->session->userdata('prodi');
		switch ($level){
			case 'mahasiswa':
				//get data perusahaan based on prody and status
				$select = ['id_perusahaan','nama_perusahaan','kuota_pkl'];
				$where = ['status_perusahaan'=>'whitelist','id_program_studi'=>$prodi];
				$data['perusahaans'] = $this->perusahaan_model->getAll($select,$where,null);
				break;
			case 'prakerin':
				break;
			case 'koordinator prodi':
				break;
			default:$data['perusahaans'] = $this->perusahaan_model->getAll();
		}
		$this->load->view( 'user/magang_permohonan',$data);
	}
	public function create_pengajuan(){
		$post = $this->input->post();
		if(isset($post['insert'])){
			$id = $this->session->userdata('id');
			$mahasiswa = masterdata( 'tb_mahasiswa',['nim'=>$id],'nama_mahasiswa');
			$pengajuan = $this->pengajuan_model;
			if($pengajuan->insert()){
				$pesan = $mahasiswa->nama_mahasiswa." ({$id})".' mengajukan permohonan magang';
				$uri = 'mahasiswa?m=pengajuan';
				set_notification($id ,'admin', $pesan, 'pengajuan magang',$uri);
				$this->session->set_flashdata( 'status', ['message'=>'Pengajuan sedang diproses','type'=>'success'] );
				}
			else{
				$this->session->set_flashdata( 'status', ['message'=>'Maaf, sementara ini belum bisa melakukan pengajuan','type'=>'fail']);
			}
			redirect(site_url('magang?m=pengajuan'));
		}


	}
	public function edit_manajemen(){
		$id = $this->input->get('id');
		$post = $this->input->post();
		if(isset($post['update'])){
			$perusahaan = $this->perusahaan_model;
			$validation = $this->form_validation;
			$validation->set_rules($perusahaan->rules());
			if($validation->run() == false){
				$this->session->set_flashdata( 'status', ['message'=>'Gagal memvalidasi data','type'=>'danger'] );
			}
			else{
				$perusahaan->update()?
					$this->session->set_flashdata( 'status', ['message'=>'Data Perusahaan berhasil dirubah','type'=>'success'] ):
					$this->session->set_flashdata( 'status', ['message'=>'Data Perusahaan gagal dirubah','type'=>'fail']);
			}
			redirect(site_url("magang?m=pengajuan&q=u&id={$id}"));
		}

		if(isset( $id)){
			$perusahaan = $this->perusahaan_model;
			$join = ['tb_program_studi','tb_perusahaan.id_program_studi = tb_program_studi.id_program_studi','left outer'];
			$select = ['tb_perusahaan.*','tb_program_studi.nama_program_studi'];
			$data['perusahaan'] = $perusahaan->getById($id,$select,$join);
		}

		$this->load->view('user/perusahaan_manajemen_edit',$data);
	}
	public function remove_manajemen(){
		$id = $this->input->get( 'id' );
		if(!isset($id)) show_404();
		$this->perusahaan_model->delete($id)?
			$this->session->set_flashdata( 'status', ['message'=>'Data Perusahaan berhasil dihapus','type'=>'success'] ):
			$this->session->set_flashdata( 'status', ['message'=>'Data Perusahaan gagal dihapus','type'=>'fail']);
		redirect(site_url('magang?m=pengajuan'));



	}
	public function create_perusahaan(){

	}
	public function edit_perusahaan(){

	}
	public function remove_perusahaan(){

	}
	public function create_penilaian(){

	}
	public function edit_penilaian(){

	}
	public function remove_penilaian(){

	}



}

/* End of file Magang.php */
 ?>