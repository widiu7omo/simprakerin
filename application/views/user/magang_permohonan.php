<!DOCTYPE html>
<html>

<!-- Head PHP -->
<?php $this->load->view( 'user/_partials/header.php' ); ?>
<?php $this->load->helper(['master','progress']);
    $nim = $this->session->userdata('id');
    $where = "(status = 'proses' or status = 'terima' or status = 'cetak') AND nim = '{$nim}'";
    $join = ['tb_perusahaan','tb_perusahaan_sementara.id_perusahaan = tb_perusahaan.id_perusahaan','left outer'];
    $select = ['tb_perusahaan.nama_perusahaan','tb_perusahaan_sementara.status'];
    $approval = datajoin( 'tb_perusahaan_sementara', $where, $select,$join);
//    var_dump($countApproval);
    $exist = false;
    if(count($approval) == 1 || count($approval) > 1){
        $exist = true;
    }
    function getTempMhs($id){
	    $joins[0] = ['tb_perusahaan','tb_perusahaan_sementara.id_perusahaan = tb_perusahaan.id_perusahaan','left outer'];
	    $joins[1] = ['tb_mahasiswa','tb_perusahaan_sementara.nim = tb_mahasiswa.nim','left outer'];
	    $select = ['nama_mahasiswa'];
	    $where = "tb_perusahaan_sementara.id_perusahaan = {$id} 
	              AND (tb_perusahaan_sementara.status = 'proses'
	               OR tb_perusahaan_sementara.status = 'cetak'
	               OR tb_perusahaan_sementara.status = 'terima')";
        return datajoin( 'tb_perusahaan_sementara', $where, $select,$joins,null);
    }

?>
<body class="g-sidenav-hidden">
<!-- Sidenav PHP-->
<?php $this->load->view( 'user/_partials/sidenav.php' ); ?>
<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav PHP-->
	<?php $this->load->view( 'user/_partials/topnav.php' );
	?>
    <!-- Header -->
    <!-- BreadCrumb PHP -->
	<?php $this->load->view( 'user/_partials/breadcrumb.php' ); ?>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <!-- Card -->
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card text-white bg-gradient-secondary">
                        <img class="card-img-top" src="holder.js/100px180/" alt="">
                        <div class="card-body">
                            <h4 class="card-title">Status Pengajuan Magang</h4>
                            <h4 class="h5 small">Tujuan:&nbsp; <?php echo $exist?(isset($approval[0])?$approval[0]->nama_perusahaan:null):'Belum mengajukan'?></h4>
                            <h4 class="h5 small">Status:&nbsp; <?php echo $exist?'Di'.(isset($approval[0])?$approval[0]->status:null):'N/A'?></h4>
                            <div class="progress-wrapper">
                                <div class="progress-info">
                                    <div class="progress-label">
                                        <span><?php echo $exist?(isset($approval[0])?$approval[0]->nama_perusahaan:null):'Belum mengajukan'?></span>
                                        <span>Diterima</span>
                                        <span>Ditolak</span>
                                    </div>
                                    <div class="progress-percentage">
                                        <span><?php echo getProgress(isset($approval[0])?$approval[0]->status:null)?>%</span>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-default" role="progressbar" aria-valuenow="<?php echo getProgress( isset($approval[0])?$approval[0]->status:null)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo getProgress( isset($approval[0])?$approval[0]->status:null)?>%;"></div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
	                <?php if ($this->session->flashdata('status')): ?>
                        <div class="alert alert-<?php echo $this->session->userdata('status')['type'] == 'success'?'success':'danger'?> alert-dismissible fade show" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text"><strong><?php echo ucfirst($this->session->userdata('status')['type']) ?>!
								&nbsp;</strong><?php echo $this->session->flashdata('status')['message']; ?></span><br>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
	                <?php endif; ?>
                </div>
            </div>
            <div class="row">
				<?php foreach ( $perusahaans as $index => $perusahaan ): ?>
                    <div class="col-md-4 col-xs-12 col-sm-12">
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header py-2">
                                <!-- Title -->
                                <div class="row">
                                    <div class="col"><h5 class="h3 mb-0">Perusahaan</h5></div>
                                    <div class="col-auto">
                                        <div class="badge badge-info">
                                            Kuota&nbsp;<?php echo $perusahaan->kuota_pkl ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body py-2">
                                <p class="card-text mb-2"><?php echo $perusahaan->nama_perusahaan ?></p>
	                            <?php $tempMhs = getTempMhs($perusahaan->id_perusahaan);
	                            $countTempMhs = (int) count($tempMhs);
	                            $countKuota = (int) $perusahaan->kuota_pkl;
	                            $diff = $countKuota-$countTempMhs;
	                            ?>
                                <div class="h5 badge badge-<?php echo $diff==0?'danger':($diff==1?'warning':'success')?>">Status : <?php echo $diff==0? 'Kuota Penuh':'Tersisa '.$diff.' Slot'?></div>
                                <div class="accordion mb-2" id="accordionExample">
                                    <div class="card p-0 m-0 shadow-none">
                                        <div class="card-header border-0 p-0 m-0" id="headingOne"
                                             data-toggle="collapse"
                                             data-target="#collapse-<?php echo $index?>" aria-expanded="false"
                                             aria-controls="collapseOne">
                                            <h5 class="mb-0">Detail</h5>
                                        </div>
                                        <div id="collapse-<?php echo $index?>" class="collapse" aria-labelledby="headingOne"
                                             data-parent="#accordionExample">
                                            <div class="card-body p-0 m-0">
                                                <ul class="my-0 py-0">
	                                                <?php foreach ($tempMhs as $temp_mh):?>
                                                    <li class="my-0 py-0"><span class="small"><?php echo $temp_mh->nama_mahasiswa?></span></li>
	                                                <?php endforeach;?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer py-2">
                                <form action="<?php echo site_url( 'magang?m=pengajuan&q=i' ) ?>" method="post">
                                    <input type="hidden" name="id_perusahaan"
                                           value="<?php echo $perusahaan->id_perusahaan ?>">
                                    <button style="display:<?php echo $exist?'none':($diff==0?'none':'block');?>" type="submit" name="insert" class=" float-right btn btn-sm btn-primary">
                                        Ajukan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

				<?php endforeach; ?>
            </div>

        </div>
        <!-- Footer PHP -->
		<?php $this->load->view( 'user/_partials/footer.php' ); ?>
    </div>

</div>
<!-- Scripts PHP-->
<?php $this->load->view( 'user/_partials/modal.php' ); ?>
<?php $this->load->view( 'user/_partials/js.php' ); ?>
<!-- Demo JS - remove this in your project -->
<!-- <script src="../assets/js/demo.min.js"></script> -->
</body>

</html>
