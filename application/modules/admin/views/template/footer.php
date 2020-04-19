  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> <?= config_item('versi'); ?>
    </div>
    <strong>Copyright &copy; 2020 <a href="https://odp.io">Orang Dalam Pemantauan</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

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