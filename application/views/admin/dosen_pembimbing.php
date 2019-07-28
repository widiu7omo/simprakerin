<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php $this->load->view( 'admin/_partials/header.php' );
$join           = [ 'tahun_akademik', 'tahun_akademik.id_tahun_akademik = tb_waktu.id_tahun_akademik', 'right join' ];
$tahun_akademik = datajoin( 'tb_waktu', null, 'tahun_akademik.tahun_akademik', $join );

$join       = [ 'tb_mahasiswa', 'tb_mhs_pilih_perusahaan.nim = tb_mahasiswa.nim', 'left outer' ];
$mahasiswas = datajoin( 'tb_mhs_pilih_perusahaan', null, 'nama_mahasiswa,tb_mhs_pilih_perusahaan.id_mhs_pilih_perusahaan,tb_mhs_pilih_perusahaan.nim', $join );

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
<!--        <form action=""></form>-->
        <div class="header-body">
            <div class="row align-items-center mb-3 text-white">
                <div class="col-8">
                    <h3 class="mb-0 text-white">Pembagian Dosen Pembimbing</h3>
                    <p class="text-sm mb-0">
                        Drag dan drop mahasiswa ke dosen yang bersangkutan
                    </p>
                </div>
                <div class="col-4 text-right">
                    <button id="simpan" class="btn btn-sm btn-neutral">Simpan</button>
                </div>
            </div>
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
                                    <li data-idpilih="<?php echo $mahasiswa->id_mhs_pilih_perusahaan?>" class="list-group-item"><?php echo "$mahasiswa->nama_mahasiswa ($mahasiswa->nim)" ?></li>
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
                                        <h4 class="card-title mb-0"><?php echo "$dosen->nama_pegawai" ?></h4>
                                        <p class="card-text mb-0 text-sm">Taruh disini</p>
                                        <ul class="list-group" id="<?php echo "$dosen->nip_nik" ?>">
                                            <li data-idpilih="14" class="my-1 text-left badge badge-pill badge-primary badge-md" draggable="false" style="">Adrianus Mboong (C1316003)</li>
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
<<<<<<< HEAD
<script src="<?php echo base_url( 'aset/vendor/sortablejs/Sortable.js' ) ?>"></script>
<script src="<?php echo base_url( 'aset/vendor/sortablejs/jquery-sortable.js' ) ?>"></script>
=======
<script src="<?php echo base_url( 'assets/vendor/sortablejs/Sortable.js' ) ?>"></script>
<script src="<?php echo base_url( 'assets/vendor/sortablejs/jquery-sortable.js' ) ?>"></script>
>>>>>>> 5afebab207b07bf6bf315a9f7d03a7245fb91af8
<script>
    let data_pembimbing_sementara = [];
    $("button#simpan").on('click',()=>{
        if(data_pembimbing_sementara.length!==0){
            console.log(data_pembimbing_sementara)
            $.ajax({
                url:"<?php echo site_url('dosen?m=pembimbing&q=bulk') ?>",
                data:{pembimbing:data_pembimbing_sementara},
                method:"POST"
            }).done(function (response) {
                console.log(response)
            }).fail(function (err) {
                console.log(err)
            })
        }
    });
    $('#mahasiswa').sortable({
        filter: '.done',
        group: {
            name: 'shared',
            pull: 'clone'
        },
        animation: 150,
        onEnd: (evt) => {
            let idpilih = $(evt.item).data('idpilih');
            let nip = $(evt.to).attr('id');
            // console.log(evt.to);
            // console.log(idpilih,nip);
            //if cancel drop to dosen, mean that it back to mahasiswa it selft, then cancel the operation
            if($(evt.to).attr('id') !== 'mahasiswa'){
                //passing to an array
                data_pembimbing_sementara.push({'nip_nik':nip,'id_mhs_pilih_perusahaan':idpilih});
                $(evt.clone).addClass(['done', 'disabled', 'bg-success', 'text-white']);
                $(evt.item).addClass(['my-1', 'text-left', 'badge', 'badge-pill', 'badge-primary', 'badge-md']);
                $(evt.item).removeClass('list-group-item');
            }
            console.log(data_pembimbing_sementara)

        }
    });
	<?php
	function get_only_nip( $dosen ) {
		return '#' . $dosen->nip_nik;
	}
	$nip_dosen = array_map( 'get_only_nip', $dosens );
	$joined_nip = join( ', ', $nip_dosen );
	?>
    //list dosen
    $("<?php echo $joined_nip ?>").sortable({
        group: {
            name: 'shared',
            // pull:'clone'
        },
        onEnd: (evt) => {
            //dragged item
            let dragged = $(evt.item);
            let draggedName = dragged.text();
            let dataIdPilih = dragged.data('idpilih');
            console.log(dataIdPilih);
            data_pembimbing_sementara = data_pembimbing_sementara.filter((value) =>{
               if(value.id_mhs_pilih_perusahaan !== dataIdPilih){
                   return value;
               }
            });
            console.log(data_pembimbing_sementara);
            dragged.addClass('list-group-item');
            dragged.removeClass(['my-1', 'text-left', 'badge', 'badge-pill', 'badge-primary', 'badge-md']);
            //array from children of destination
            let items = $(evt.to).children();
            // console.time('each');
            items.each((index, value) => {
                let item = $(value);
                // console.log(item.text());
                let itemName = item.text();
                // console.log(itemName === draggedName);

                if (itemName === draggedName) {

                    dragged.remove();
                    item.removeClass(['done', 'disabled', 'bg-success', 'text-white']);
                    item.css('background', 'white')
                }
            });
            // console.timeEnd('each')
        },
        animation: 150
    });

</script>
</body>

</html>