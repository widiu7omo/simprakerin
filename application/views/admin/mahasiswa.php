<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php  $this->load->view('admin/_partials/header.php');?>

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
			<!-- Card -->
			<div class="header-body">
				<!-- Card stats -->
				<div class="row">
					<div class="col-xl-3 col-lg-6">
						<div class="card card-stats mb-4 mb-xl-0">
							<a href="<?php echo site_url('mahasiswa?m=magang') ?>">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title text-uppercase text-muted mb-0">Mahasiswa</h5>
											<span class="h2 font-weight-bold mb-0">Magang</span>
										</div>
										<div class="col-auto">
											<div class="icon icon-shape bg-danger text-white rounded-circle shadow">
												<i class="fas fa-user-graduate"></i>
											</div>
										</div>
									</div>
									<p class="mt-3 mb-0 text-muted text-sm">
										<span class="text-wrap">Daftar mahasiswa yang berhak untuk melaksanakan
											magang</span>
									</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6">
						<div class="card card-stats mb-4 mb-xl-0">
							<a href="<?php echo site_url('mahasiswa?m=sidang') ?>">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title text-uppercase text-muted mb-0">Mahasiswa</h5>
											<span class="h2 font-weight-bold mb-0">Sidang</span>
										</div>
										<div class="col-auto">
											<div class="icon icon-shape bg-warning text-white rounded-circle shadow">
												<i class="fas fa-chalkboard-teacher"></i>
											</div>
										</div>
									</div>
									<p class="mt-3 mb-0 text-muted text-sm">
										<span class="text-wrap">Mahasiswa yang berhak dan tidak berhak untuk
											melaksanakan sidang</span>
									</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6">
						<div class="card card-stats mb-4 mb-xl-0">
							<a href="<?php echo site_url('mahasiswa?m=pengajuan') ?>">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title text-uppercase text-muted mb-0">Mahasiswa</h5>
											<span class="h2 font-weight-bold mb-0">Pengajuan Magang</span>
										</div>
										<div class="col-auto">
											<div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
												<i class="fas fa-users"></i>
											</div>
										</div>
									</div>
									<p class="mt-3 mb-0 text-muted text-sm">
										<!-- <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i></span> -->
										<span class="text-wrap">Daftar perserta pengajuan magang seluruh program
											studi</span>
									</p>
								</div>
							</a>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6">
						<div class="card card-stats mb-4 mb-xl-0">
							<div class="card-body">
								<div class="row">
									<div class="col">
										<h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
										<span class="h2 font-weight-bold mb-0">49,65%</span>
									</div>
									<div class="col-auto">
										<div class="icon icon-shape bg-info text-white rounded-circle shadow">
											<i class="fas fa-percent"></i>
										</div>
									</div>
								</div>
								<p class="mt-3 mb-0 text-muted text-sm">
									<span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
									<span class="text-nowrap">Since last month</span>
								</p>
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
	<?php $this->load->view('admin/_partials/js.php');?>
	<?php
//	require APPPATH."libraries/hotreloader.php";
//	$reloader = new HotReloader();
//	$reloader->setRoot(__DIR__);
//	$reloader->currentConfig();
//	$reloader->init();
	?>
	<!-- Demo JS - remove this in your project -->
	<!-- <script src="../assets/js/demo.min.js"></script> -->
</body>

</html>
