<?php $this->load->view('kasir/template/head'); ?>
<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3" data-aos="fade-up">

                <div class="card-body">

                  <div class="pt-4 pb-2 text-center mb-4">
                    <img src="<?= base_url('assets/img/logo.png') ?>" style="width: 200px;">
                  </div>

                  <form class="row g-3 needs-validation mb-4" action="<?= site_url('auth/login') ?>" method="POST">

                    <div class="col-12">
                      <div class="input-group has-validation" data-aos="fade-right" data-aos-delay="100">
                        <input type="text" name="nama" class="form-control" id="yourUsername" required placeholder="Username">
                      </div>
                    </div>

                    <div class="col-12 mb-3" data-aos="fade-right" data-aos-delay="150">
                      <input type="password" name="password" class="form-control" id="yourPassword" required placeholder="Password">
                    </div>
                    <?php if ($this->session->flashdata('salah')): ?>
                      <div class="col-12">
                        <p class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                              <?= $this->session->flashdata('salah'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </p>
                      </div>
                    <?php endif ?>
                    <?php if ($this->session->flashdata('hak_akses_salah')): ?>
                      <div class="col-12">
                        <p class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                              <?= $this->session->flashdata('hak_akses_salah'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </p>
                      </div>
                    <?php endif ?>
                    <div class="col-12" data-aos="fade-right" data-aos-delay="200">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->
<?php $this->load->view('kasir/template/end'); ?>