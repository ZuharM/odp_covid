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
    <?php 
    $uri = $this->uri->segment(2); 
    $uri3 = $this->uri->segment(3); 
    ?>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li <?= $uri == '' ? 'class="active"' : ''; ?>>
        <a href="<?= base_url('admin'); ?>"><i class="fa fa-dashboard"></i> <span>Beranda</span></a>
      </li>
      <li class="treeview <?= $uri == 'kecamatans' || $uri == 'desas' ? 'active' : ''; ?>">
        <a href="#">
          <i class="fa fa-gear"></i> <span>Setting</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i> Bobot </a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Indikator </a></li>
        </ul>
      </li>
      <li class="treeview <?= $uri == 'area_transmisis' ? 'active' : ''; ?>">
        <a href="#">
          <i class="fa fa-university"></i> <span>Area Transmisi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?= $uri == 'area_transmisis' && ($uri3 == '' || $uri3 == 'index') ? 'class="active"' : ''; ?>><a href="<?= base_url('admin/area_transmisis'); ?>"><i class="fa fa-circle-o"></i> Wilayah </a></li>
          <li <?= $uri == 'area_transmisis' && $uri3 == 'detail' ? 'class="active"' : ''; ?>><a href="<?= base_url('admin/area_transmisis/detail'); ?>"><i class="fa fa-circle-o"></i> Wilayah Detail </a></li>
        </ul>
      </li>
      <li <?= $uri == '' ? 'class="active"' : ''; ?>>
        <a href="#"><i class="fa fa-user"></i> <span> User</span></a>
      </li>

      <li <?= $uri == 'laporans' || $uri == 'view' ? 'class="active"' : ''; ?>>
        <a href="<?= base_url('admin/laporans'); ?>"><i class="fa fa-book"></i> <span>Laporan</span></a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>