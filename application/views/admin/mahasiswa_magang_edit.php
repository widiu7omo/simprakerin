<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php  $this->load->view('admin/_partials/header.php');?>
<?php $current_tahun_akademik = getCurrentTahun();
$program_studies = masterdata( 'tb_program_studi');
$id = $this->uri->segment(3);
$mahasiswa = masterdata( 'tb_mahasiswa',"nim = '$id'");
?>
<body>
<!-- Sidenav PHP-->
<?php $this->load->view('admin/_partials/sidenav.php');?>
<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav PHP-->
	<?php $this->load->view('admin/_partials/topnav.php');
	?>
    <!-- Header -->
    <!-- BreadCrumb PHP -->
	<?php $this->load->view('admin/_partials/breadcrumb.php');
	?>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">Input Mahasiswa Magang <?php echo $current_tahun_akademik->now?></h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <form method="POST" action="<?php echo site_url('mahasiswa/edit')?>">
                            <!-- Input groups with icon -->
                            <input type="hidden" name="id_tahun_akademik" value="<?php echo $current_tahun_akademik->tahun_id?>" id="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <select class="input-group-prepend form-control" name="id_program_studi" id="">
												<?php foreach ($program_studies as $program_study):?>
                                                    <option <?php echo  $program_study->id_program_studi == $mahasiswa->id_program_studi?'selected':null?> value="<?php echo $program_study->id_program_studi?>"><?php echo $program_study->nama_program_studi?></option>
												<?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input name="nim" value="<?php echo isset($mahasiswa->nim)?$mahasiswa->nim:null?>" class="form-control" placeholder="NIM" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
													<span class="input-group-text"><i
                                                                class="fas fa-envelope"></i></span>
                                            </div>
                                            <input name="nama_mahasiswa" value="<?php echo isset($mahasiswa->nama_mahasiswa)?$mahasiswa->nama_mahasiswa:null?>" class="form-control" placeholder="Nama Mahasiswa" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button name="save" type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer PHP -->
		<?php $this->load->view('admin/_partials/footer.php');?>
    </div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view('admin/_partials/js.php');
?>
<!-- Demo JS - remove this in your project -->
<<<<<<< HEAD
<!-- <script src="../aset/js/demo.min.js"></script> -->
=======
<!-- <script src="../assets/js/demo.min.js"></script> -->
>>>>>>> 5afebab207b07bf6bf315a9f7d03a7245fb91af8
</body>

</html>
