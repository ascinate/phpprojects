<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?php echo base_url();?>files/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url();?>files/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url();?>files/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url();?>files/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>files/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>files/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>files/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url();?>files/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?php echo base_url();?>files/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?php echo base_url();?>files/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?php echo base_url();?>files/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url();?>files/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?php echo base_url();?>files/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url();?>files/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="<?php echo base_url();?>files/dist/js/pages/dashboard2.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>