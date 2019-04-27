<html>
<?php $this->load->view('_partials/header.php');?>

<body class="bg-default g-sidenav-hidden">
	<!-- Navabr -->
	<?php $this->load->view('_partials/topnav');?>
	<!-- Main content -->
	<div class="main-content">
		<!-- Header -->
		<div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
			<div class="container">
				<div class="header-body text-center mb-7">
					<div class="row justify-content-center">
						<div class="col-xl-5 col-lg-6 col-md-8 px-5">
							<h1 class="text-white">Welcome!</h1>
							<p class="text-lead text-white">Selamat datang di Sistem Informasi Praktik Kerja Lapangan
								Politeknik Negeri Tanah Laut</p>
						</div>
					</div>
				</div>
			</div>
			<!-- Separator -->
			<?php $this->load->view('_partials/separator.php');?>
		</div>
		<!-- Page content -->
		<div class="container mt--8 pb-5">
			<div class="row justify-content-center">
				<div class="col-lg-5 col-md-7">
					<div class="card bg-secondary border-0 mb-0">
						<div class="card-header bg-transparent pb-5">
							<div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
							<div class="btn-wrapper text-center">
								<a href="#" class="btn btn-neutral btn-icon">
									<span class="btn-inner--icon"><img
											src="../../assets/img/icons/common/github.svg"></span>
									<span class="btn-inner--text">Github</span>
								</a>
								<a href="#" class="btn btn-neutral btn-icon">
									<span class="btn-inner--icon"><img
											src="../../assets/img/icons/common/google.svg"></span>
									<span class="btn-inner--text">Google</span>
								</a>
							</div>
						</div>
						<div class="card-body px-lg-5 py-lg-5">
							<div class="text-center text-muted mb-4">
								<small>Or sign in with credentials</small>
							</div>
							<?php if ($this->session->flashdata('fail')): ?>
							<div class="alert alert-danger alert-dismissible fade show " role="alert">
								<span class="alert-icon"><i class="fas fa-exclamation-triangle"></i></span>
								<span class="alert-text"><small><strong>Fail!
										&nbsp;</strong><?php echo $this->session->flashdata('fail'); ?></small></span>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<?php endif; ?>
							<form role="form" method="POST" action="<?php echo site_url('login?in=true') ?>">
								<div class="form-group mb-3" id="divusername">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="ni ni-email-83"></i></span>
										</div>
										<input class="form-control" placeholder="NIM" name="username" type="username"
											id="username" autofocus>
									</div>
								</div>
								<div class="form-group">
									<div class="input-group input-group-merge input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
										</div>
										<input class="form-control" placeholder="Password" type="password"
											name="password">
									</div>
								</div>
								<div class="custom-control custom-control-alternative custom-checkbox">
									<input class="custom-control-input" id=" customCheckLogin" type="checkbox">
									<label class="custom-control-label" for=" customCheckLogin">
										<span class="text-muted">Remember me</span>
									</label>
								</div>
								<div class="text-center">
									<button type="submit" id="btn-sign" class="btn btn-primary my-4">Sign in</button>
								</div>
							</form>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-6">
							<a href="#" class="text-light"><small>Forgot password?</small></a>
						</div>
						<div class="col-6 text-right">
							<a href="#" class="text-light"><small>Create new account</small></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<?php  $this->load->view('_partials/footer');?>
	<!-- Argon Scripts -->
	<?php $this->load->view('_partials/js');?>
	<script>
		$('#username').focus(() => {
			console.log('blur')
			$('#notif').remove()
			$('#btn-sign').prop('disabled', false)
		})
		$('#username').blur(() => {
			$.ajax({
				url: '<?php echo site_url('login?ajax=true') ?>',
				method: 'POST',
				datatype: 'JSON',
				data: {
					username: $('input[name=username]').val()
				},
				success: (data) => {
					var jsonData = JSON.parse(data)
					if (jsonData.result === null) {
						$('#divusername').append(
							'<small class="text-danger" id="notif">Maaf akun anda tidak ditemukan</small>'
							)
						$('#btn-sign').prop('disabled', true)
					}
				},
				error: (err) => {
					console.log(err)
				}
			})

		})

	</script>
</body>

</html>
