<<<<<<< HEAD
<script src="<?php echo base_url('aset/vendor/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/js-cookie/js.cookie.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/jquery.scrollbar/jquery.scrollbar.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/lavalamp/js/jquery.lavalamp.min.js') ?>"></script>
<!-- Optional JS -->
<script src="<?php echo base_url('aset/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/datatables.net-select/js/dataTables.select.min.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/dropzone/dist/min/dropzone.js') ?>"></script>
<script src="<?php echo base_url('aset/vendor/select2/select2.min.js') ?>"></script>
<!-- Argon JS -->
<script src="<?php echo base_url('aset/js/argonpro.js') ?>"></script>
<script>
    (function(d){
        let i = 1;
        let badge = document.getElementById('badge');
        let int = window.setInterval(function(){
            updateBadge(i++);
        }, 2000); //Update the badge ever 5 seconds
        let badgeNum;
        function updateBadge(alertNum){//To rerun the animation the element must be re-added back to the DOM
            let badgeChild = badge.children[0];
            if(badgeChild.className==='badge-num')
                badge.removeChild(badge.children[0]);

            badgeNum = document.createElement('div');
            badgeNum.setAttribute('class','badge-num');
            badgeNum.innerText = alertNum;
            let insertedElement = badge.insertBefore(badgeNum,badge.firstChild);
        }
    })(document);
</script>
=======
<script src="<?php echo base_url('assets/vendor/jquery/dist/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/js-cookie/js.cookie.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/lavalamp/js/jquery.lavalamp.min.js') ?>"></script>
<!-- Optional JS -->
<script src="<?php echo base_url('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables.net-select/js/dataTables.select.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/dropzone/dist/min/dropzone.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/select2/select2.min.js') ?>"></script>
<!-- Argon JS -->
<script src="<?php echo base_url('assets/js/argonpro.js') ?>"></script>
>>>>>>> 5afebab207b07bf6bf315a9f7d03a7245fb91af8

