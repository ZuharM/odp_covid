<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login System</title>
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
    <a href="<?= base_url() ?>"><b>Login</b>System</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <font class="info"><?=$this->session->flashdata('pesan');?></font>
    <div id="konfirmasi"></div>
    <form action="" method="post" name="fl" id="f_login" onsubmit="return login();">
      <div class="form-group has-feedback">
        <input type="text" id="username" name="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <a href="<?= base_url('login/register') ?>" class="text-center">Register a new membership</a>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?=config_item('base_theme')?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=config_item('base_theme')?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script type="text/javascript">
  var base_url  = "<?= config_item('base_url'); ?>";
  function login(e) {
    e = e || window.event;
    var data  = $('#f_login').serialize();
    $("#konfirmasi").html("<div class='alert alert-info'><i class='fa fa-refresh'></i> Checking...</div>")
    $.ajax({
      type: "POST",
      data: data,
      dataType: "json",
      cache: false,
      url: base_url+"login/cek_login",
      success: function(response){
        if(response.status == 0){
          $("#konfirmasi").html(response.keterangan);
        } else {
          $("#konfirmasi").html(response.keterangan);
          window.location.assign(response.link); 
        }
      }
    });
    return false;
  }
</script>

</body>
</html>
