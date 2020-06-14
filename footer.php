</div>
</div>
</div>
<script src="/assets/js/vendor-all.min.js"></script>
<script src="/assets/js/plugins/bootstrap.min.js"></script>
<script src="/assets/js/pcoded.min.js"></script>
<script src="/assets/js/plugins/apexcharts.min.js"></script>
<script src="/assets/js/plugins/jquery.peity.min.js"></script>
<script src="/assets/js/plugins/jquery.knob.min.js"></script>
<script src="/assets/js/pages/jquery.knob-custom.min.js"></script>
<script src="/assets/plugins/vendors/d3/d3.min.js"></script>
<script src="/assets/plugins/vendors/c3-master/c3.min.js"></script>
<script src="/assets/plugins/vendors/sparkline/jquery.sparkline.min.js"></script>
<script src="/assets/plugins/vendors/raphael/raphael-min.js"></script>
<script src="/assets/plugins/vendors/morrisjs/morris.js"></script>
<script src="/assets/js/pages/dashboard-server.js"></script>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="/assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<script>
    $('#user-list-table').DataTable();
</script>
<?php if (isset($error)) : ?>
        <script src="/assets/js/plugins/sweetalert.min.js"></script>
        <script>
            swal("Error", "<?php echo $error ?>", "error");
        </script>
    <?php endif; ?>

    <?php if (isset($success)) : ?>
        <script src="/assets/js/plugins/sweetalert.min.js"></script>
        <script>
            swal("Success", "<?php echo $success ?>", "success");
        </script>
    <?php endif; ?>
</body>

</html>