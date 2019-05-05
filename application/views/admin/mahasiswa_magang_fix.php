<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php  $this->load->view('admin/_partials/header.php');?>
<!-- Custom Helper -->
<?php $this->load->helper('master_helper');
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
						<div class="row align-items-center">
							<div class="col-8">
								<h3 class="mb-0">Mahasiswa</h3>
								<p class="text-sm mb-0">
									This is an example of user management. This is a minimal setup in order to get
									started fast.
								</p>
							</div>
						</div>
					</div>
					<div class="table-responsive py-4">
						<table class="table table-flush" id="datatable-buttons">
							<thead class="thead-light">
							<tr role="row">
								<th style="width:30px">Aksi</th>
								<th>No</th>
								<th>Mahasiswa</th>
								<th>Program Studi</th>
								<th>Perusahaan</th>
							</tr>
							</thead>
							<tfoot>
							<tr>
								<th style="width:30px">Aksi</th>
								<th>No</th>
								<th>Mahasiswa</th>
								<th>Program Studi</th>
								<th>Perusahaan</th>
							</tr>
							</tfoot>
							<tbody>
							<?php foreach ($mahasiswas as $key => $mahasiswa): ?>
								<tr role="row" class="odd">
									<td>
										<a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
										   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fas fa-ellipsis-v"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
											<a class="dropdown-item"
											   href="<?php echo site_url('mahasiswa/edit/'.$mahasiswa->nim) ?>">Edit</a>
											<a class="dropdown-item" href="#"
											   onclick="deleteConfirm('<?php echo site_url('mahasiswa/remove/'.$mahasiswa->nim) ?>')">Hapus</a>
										</div>
									</td>
									<td class="sorting_1"><?php echo $key +1?></td>
									<td><?php echo $mahasiswa->nama_mahasiswa?></td>
									<td><?php echo $mahasiswa->nama_program_studi?></td>
									<td><?php echo $mahasiswa->nama_perusahaan?></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer PHP -->
		<?php $this->load->view('admin/_partials/footer.php');?>
	</div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view('admin/_partials/js.php');?>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../assets/js/demo.min.js"></script> -->
</body>

</html>
