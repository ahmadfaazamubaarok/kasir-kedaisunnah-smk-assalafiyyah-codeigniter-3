<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link <?php echo isset($halaman_dashboard) ? " " : "collapsed"; ?>" href="<?= site_url('kasir/dashboard') ?>"   data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Home">
          <i class="ri-home-fill"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link <?php echo isset($halaman_penjualan) ? " " : "collapsed"; ?>" href="<?= site_url('kasir/penjualan') ?>"   data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Penjualan">
          <i class="ri-shopping-cart-2-fill"></i>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->