<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php  $this->load->view('admin/_partials/header.php');?>
<!-- Custom Helper -->
<?php $this->load->helper('master_helper');
	$prodies = masterdata('tb_program_studi');
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
			<!-- Export -->
			<div class="row">
				<div class="col">
					<div class="card mb-5">
						<div class="card-header">
							<h3>Import Data Mahasiswa Magang</h3>
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="row">
									<div class="col-xl-12 col-lg-6 col-md-12">
										<div class="tab-content">
											<p>
												<a class="btn btn-primary" data-toggle="collapse"
													href="#collapseExample" role="button" aria-expanded="false"
													aria-controls="collapseExample">
													Import
												</a>
											</p>
											<div class="collapse" id="collapseExample">
												<div class="card card-body">
													<?php echo form_open_multipart('mahasiswa/import') ?>
													<div class="form-group">
														<label class="form-control-label"
															for="exampleFormControlSelect1">Tentukan Program
															Studi</label>
														<select class="form-control" id="exampleFormControlSelect1">
															<?php foreach ($prodies as $prodi): ?>
															<option value="<?php echo $prodi->id_program_studi ?>">
																<?php echo $prodi->nama_program_studi ?></option>
															<?php endforeach; ?>
														</select>
													</div>
													<div class="dropzone dropzone-multiple dz-clickable"
														data-toggle="dropzone" data-dropzone-multiple=""
														data-dropzone-url="<?php echo site_url('ajax/initimport') ?>">

														<ul
															class="dz-preview dz-preview-multiple list-group list-group-lg list-group-flush ">
														</ul>
														<div class="dz-default dz-message">
															<span>Drop files here to upload</span>
															<div class="spinner-border text-danger" role="status">
															<span class="sr-only">Loading...</span>
														</div>
														</div>
														
													</div>

													<div class="form-group sheet-form-name" style="display:none">
														<label class="form-control-label" for="sheet-name">Pilih Nama
															sheet yang akan di import</label>
														<select class="form-control" id="sheet-name">
															<?php foreach ($prodies as $prodi): ?>
															<option value="<?php echo $prodi->id_program_studi ?>">
																<?php echo $prodi->nama_program_studi ?></option>
															<?php endforeach; ?>
														</select>
													</div>

													<div class="text-md-right align-content-end mt-3 mb--4">
														<button id="btn_atur_tahun" type="submit"
															class="btn btn-success">Simpan</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


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
								<div class="col-4 text-right">
									<a href="<?php echo site_url('mahasiswa/create') ?>"
										class="btn btn-sm btn-primary">Add
										Mahasiswa</a>
								</div>
							</div>
						</div>
						<div class="table-responsive py-4">
							<table class="table table-flush" id="datatable-buttons">
								<thead class="thead-light">
									<tr role="row">
										<th style="width:30px">Aksi</th>
										<th>No</th>
										<th>ID</th>
										<th>Mahasiswa</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th style="width:30px">Aksi</th>
										<th>No</th>
										<th>ID</th>
										<th>Mahasiswa</th>
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
										<td><?php echo $mahasiswa->nim?></td>
										<td><?php echo $mahasiswa->nama_mahasiswa?></td>
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
	<?php $this->load->view('admin/_partials/modal.php');?>
	<?php $this->load->view('admin/_partials/js.php');?>
	<!-- Demo JS - remove this in your project -->
	<!-- <script src="../assets/js/demo.min.js"></script> -->
</body>

</html>
