<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php  $this->load->view('admin/_partials/header.php');?>
<!-- Custom Helper -->
<?php $this->load->helper('master_helper');
$prodies = masterdata('tb_program_studi');
$currentTahun = masterdata('tb_waktu');?>
<style>
	td.details-control::before{
		font-family: "Font Awesome 5 Free"; font-weight: 900; content: "\f0d7";
	}
	tr.shown td.details-control::before {
		font-family: "Font Awesome 5 Free"; font-weight: 900; content: "\f0d8";
	}
</style>
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
						<div class="row align-items-center">
							<div class="col-8">
								<h3 class="mb-0">Cetak Pengajuan Magang</h3>
								<p class="text-sm mb-0">
									Pencetakan Surat Permohonan Magang
								</p>
								<button class="btn btn-sm btn-success"></button>
								<button class="btn btn-sm btn-danger"></button>
								<button class="btn btn-sm btn-info"></button>

							</div>
						</div>
					</div>
					<div class=" py-4">
						<?php var_dump( $permohonan)?>
					</div>

					<div class="card-body">
						<div class="row">
							<div class="col">
								<div class="alert alert-success alert-dismissible" role="alert">
									<div class="alert-text">Surat berhasil tercetak.</div>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>

								<a href="<?php echo site_url('mahasiswa?m=pengajuan')?>" class="btn btn-info">Kembali</a>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('admin/_partials/footer.php');?>
	</div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view('admin/_partials/modal.php');?>
<?php $this->load->view('admin/_partials/loading.php'); ?>
<?php $this->load->view('admin/_partials/js.php');?>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../assets/js/demo.min.js"></script> -->
</body>

</html>
