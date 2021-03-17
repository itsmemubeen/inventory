<!-- ================== BEGIN BASE JS ================== -->


<!--[if lt IE 9]>
<script src="assets/backend/crossbrowserjs/html5shiv.js"></script>
<script src="assets/backend/crossbrowserjs/respond.min.js"></script>
<script src="assets/backend/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="public/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->


<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script src="public/plugins/parsley/dist/parsley.js"></script>

<script src="public/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="public/plugins/bootstrap-select/bootstrap-select.min.js"></script>


<!-- ================== END PAGE LEVEL JS ================== -->


<!-- Sweet Alert Notification -->
<?php if ($this->session->flashdata('flash_message') != ""): ?>
    <script>
        swal({
            title: "Done",
            text: "<?php echo $this->session->flashdata('flash_message'); ?>",
            timer: 1500,
            showConfirmButton: false,
            type: 'success'
        });
    </script>
<?php endif; ?>

<script type="text/javascript">
    $(".selectpicker").selectpicker();
</script>
</body>
</html>