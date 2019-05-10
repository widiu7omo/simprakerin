<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php $this->load->view( 'admin/_partials/header.php' );
$join           = [ 'tahun_akademik', 'tahun_akademik.id_tahun_akademik = tb_waktu.id_tahun_akademik', 'right join' ];
$tahun_akademik = datajoin( 'tb_waktu', null, 'tahun_akademik.tahun_akademik', $join );

$join       = [ 'tb_mahasiswa', 'tb_mhs_pilih_perusahaan.nim = tb_mahasiswa.nim', 'left outer' ];
$mahasiswas = datajoin( 'tb_mhs_pilih_perusahaan', null, 'nama_mahasiswa,tb_mhs_pilih_perusahaan.nim', $join );

$dosens = masterdata( 'tb_pegawai', 'status = "dosen"', 'nama_pegawai,nip_nik', true );

?>

<body>
<!-- Sidenav PHP-->
<?php $this->load->view( 'admin/_partials/sidenav.php' ); ?>
<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav PHP-->
	<?php $this->load->view( 'admin/_partials/topnav.php' );
	?>
    <!-- Header -->
    <!-- BreadCrumb PHP -->
	<?php $this->load->view( 'admin/_partials/breadcrumb.php' );
	?>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <!-- Card -->
        <div class="header-body">
            <!-- Table -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h4 class="card-title">Mahasiswa
                                Magang <?php echo $tahun_akademik[0]->tahun_akademik ?></h4>
                            <p class="card-text text-sm">*&nbsp;Drag dan Drop ke arah dosen yang diinginkan</p>
                            <ul class="list-group" id="mahasiswa">
								<?php foreach ( $mahasiswas as $mahasiswa ): ?>
                                    <li class="list-group-item"><?php echo "$mahasiswa->nama_mahasiswa ($mahasiswa->nim)" ?></li>
								<?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h4 class="card-title">Dosen </h4>
                            <p class="card-text text-sm">*&nbsp;Drag dan Drop ke arah mahasiswa untuk mengembalikan</p>
							<?php foreach ( $dosens as $dosen ): ?>
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo "$dosen->nama_pegawai" ?></h4>
                                        <p class="card-text">Taruh disini</p>
                                        <ul class="list-group list-group-flush" id="<?php echo "$dosen->nip_nik"?>">
                                        </ul>
                                    </div>
                                </div>
							<?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer PHP -->
		<?php $this->load->view( 'admin/_partials/footer.php' ); ?>
    </div>
</div>
<!-- Scripts PHP-->
<?php $this->load->view( 'admin/_partials/modal.php' ); ?>
<?php $this->load->view( 'admin/_partials/js.php' ); ?>
<?php
//	require APPPATH."libraries/hotreloader.php";
//	$reloader = new HotReloader();
//	$reloader->setRoot(__DIR__);
//	$reloader->currentConfig();
//	$reloader->init();
?>

<!-- Sortable Draggable -->
<script src="<?php echo base_url( 'assets/vendor/sortablejs/Sortable.js' ) ?>"></script>
<script src="<?php echo base_url( 'assets/vendor/sortablejs/jquery-sortable.js' ) ?>"></script>
<script>
    $('#mahasiswa').sortable({
        filter: '.done',
        group: {
            name: 'shared',
            pull: 'clone'
        },
        animation: 150,
        onEnd: (evt) => {
            // console.log($(evt.item))
            // console.log($(evt.clone))
            $(evt.clone).addClass(['done', 'disabled', 'bg-success', 'text-white']);
            $(evt.item).addClass(['my-1','text-left','badge','badge-pill','badge-primary','badge-md']);
            $(evt.item).removeClass('list-group-item');
            // console.log(evt.item.data('item'))
        }
    });
    <?php foreach ($dosens as $dosen): ?>
    $('#<?php echo $dosen->nip_nik ?>').sortable({
        group: {
            name: 'shared',
            // pull:'clone'
        },
        onEnd: (evt) => {
            //dragged item
            let dragged = $(evt.item);
            let draggedName = dragged.text();
            dragged.addClass('list-group-item');
            dragged.removeClass(['my-1','text-left','badge','badge-pill','badge-primary','badge-md']);
            //array from children of destination
            let items = $(evt.to).children();
            console.time('each');
            items.each((index, value) => {
                let item = $(value);
                console.log(item.text());
                let itemName = item.text();
                console.log(itemName === draggedName);

                if (itemName === draggedName) {
                    dragged.remove();
                    item.removeClass(['done', 'disabled', 'bg-success', 'text-white']);
                    item.css('background', 'white')
                }
            });
            console.timeEnd('each')
        },
        animation: 150
    });
    <?php endforeach; ?>
</script>
</body>

</html>
