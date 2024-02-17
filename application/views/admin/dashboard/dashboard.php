<?php $this->load->view('admin/template/head') ?>
<?php $this->load->view('admin/template/navbar') ?>
<?php $this->load->view('admin/template/sidebar') ?>
<main class="main" id="main">
	<section class="section dashboard">
		<div class="row d-flex justify-content-center">
			<div class="col-4">
				<div class="card" data-aos="fade-up">
					<div class="card-body pt-4 text-center">
	                    <img src="<?= base_url('assets/img/logo.png') ?>" style="width: 200px;" class="mb-4">
						<h3>Selamat datang <strong><?= $user->nama_user; ?></strong></h3>
						<p>Kamu terakhir login pada : <?= $user->last_login; ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php $this->load->view('admin/template/end') ?>