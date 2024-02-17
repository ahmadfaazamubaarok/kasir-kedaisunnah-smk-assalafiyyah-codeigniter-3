<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link <?php echo isset($halaman_dashboard) ? " " : "collapsed"; ?>" href="<?= site_url('admin/dashboard') ?>"  data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Home">
          <i class="ri-home-fill"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link <?php echo isset($halaman_barang) ? " " : "collapsed"; ?>" href="<?= site_url('admin/barang') ?>"  data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Barang">
          <i class="ri-dropbox-fill"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link <?php echo isset($halaman_laporan) ? " " : "collapsed"; ?>" href="<?= site_url('admin/transaksi') ?>"  data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Laporan">
          <i class="ri-history-fill"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link <?php echo isset($halaman_stok) ? " " : "collapsed"; ?>" href="<?= site_url('admin/stok') ?>"  data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Stok">
          <i class="ri-truck-fill"></i>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->