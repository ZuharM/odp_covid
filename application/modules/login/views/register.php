<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Register System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=config_item('base_theme')?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=config_item('base_theme')?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=config_item('base_theme')?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=config_item('base_theme')?>dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=config_item('base_theme')?>plugins/iCheck/square/blue.css">

    <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?=config_item('base_theme')?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="shortcut icon" href="<?=config_item('img_dir')?>favicon_posyandu.png">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?= base_url() ?>"><b>Register</b>System</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Register a new membership</p>
    <font class="info"><?=$this->session->flashdata('pesan');?></font>
    <div id="konfirmasi"></div>
    <form action="<?= base_url('login/register_proses') ?>" method="post" name="fr" id="f_register">
      <div class="form-group has-feedback">
        <input type="text" id="nik" name="nik" class="form-control" placeholder="Masukan NIK" required>
        <span class="glyphicon glyphicon-plus form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" required>
        <span class="glyphicon glyphicon-plus form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Masukan Tempat Lahir" required>
        <span class="glyphicon glyphicon-plus form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <div class="input-group date">
          <input type="text" class="form-control pull-right" name="tanggal_lahir" id="datepicker_baru" placeholder="Masukan Tanggal Lahir" required>
          <span class="glyphicon glyphicon-plus form-control-feedback"></span>
        </div>
      </div>

      <div class="form-group has-feedback">
        <textarea class="form-control" name="alamat" rows="2" placeholder="Masukan Alamat"></textarea>
        <span class="glyphicon glyphicon-plus form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <?= form_dropdown('darah', $darah, '', 'class="form-control" required'); ?>
      </div>

      <div class="form-group has-feedback">
        <?= form_dropdown('agama', $agama, '', 'class="form-control" required'); ?>
      </div>

      <div class="form-group has-feedback">
        <?= form_dropdown('status_kawin', $status_kawin, '', 'class="form-control" required'); ?>
      </div>

      <div class="form-group has-feedback">
        <input type="number" id="no_hp" name="no_hp" class="form-control" placeholder="Masukan No HP">
        <span class="glyphicon glyphicon-plus form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" placeholder="Masukan Pekerjaan">
        <span class="glyphicon glyphicon-plus form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="email" id="email" name="email" class="form-control" placeholder="Masukan Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <hr>
      <div class="form-group has-feedback">
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
        <span class="glyphicon glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <a href="<?= base_url('login') ?>" class="text-center">I already have a membership</a>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?=config_item('base_theme')?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=config_item('base_theme')?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- bootstrap datepicker -->
<script src="<?=config_item('base_theme')?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>
  $(function () {
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
