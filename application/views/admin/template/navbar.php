<!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn" style="margin-right: 30px;"></i>
      <a href="" class="logo d-flex align-items-center">
        <img src="<?= base_url('assets/img/logo.png') ?>" alt="logo">
      </a>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?= base_url('upload/profil/' . $user->profil ) ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $user->nama_user ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= $user->nama_user ?></h6>
              <span>Peran : <?= $user->level ?></span>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= site_url('auth/setting/' . $user->id_user) ?>">
                <i class="ri-settings-3-fill"></i>
                <span>Setting</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= site_url('auth/logout') ?>">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->