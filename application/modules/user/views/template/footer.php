  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> <?= config_item('versi'); ?>
    </div>
    <strong>Copyright &copy; 2020 <a href="https://odp.io">Orang Dalam Pemantauan</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?=config_item('base_theme')?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=config_item('base_theme')?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?=config_item('base_theme')?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=config_item('base_theme')?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=config_item('base_theme')?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=config_item('base_theme')?>dist/js/demo.js"></script>

<!-- DataTables -->
<script src="<?=config_item('base_theme')?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=config_item('base_theme')?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- bootstrap datepicker -->
<script src="<?=config_item('base_theme')?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>
  var base_url = "<?= config_item('base_url')?>";
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

    //Date picker
    $('#datepicker').datepicker({
      orientation: "bottom auto",
      autoclose: true,
      format: 'dd-mm-yyyy'
    })

    $('#datepicker_baru').datepicker({
      orientation: "bottom auto",
      autoclose: true,
      format: 'yyyy-mm-dd'
    })

  })
</script>
</body>
</html>