<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <?php $uri = $this->uri->segment(2); ?>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li <?= $uri == '' ? 'class="active"' : ''; ?>>
        <a href="<?= base_url('user'); ?>"><i class="fa fa-dashboard"></i> <span>Beranda</span></a>
      </li>
      <li <?= $uri == 'konsultasis' ? 'class="active"' : ''; ?>>
        <a href="<?= base_url('user/konsultasis'); ?>"><i class="fa fa-television"></i> <span>Konsultasi</span></a>
      </li>
      <li <?= $uri == 'laporans' ? 'class="active"' : ''; ?>>
        <a href="<?= base_url('user/laporans'); ?>"><i class="fa fa-book"></i> <span>Laporan</span></a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>