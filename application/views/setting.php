<?php $this->load->view('kasir/template/head'); ?>
<?php $this->load->view('kasir/template/navbar'); ?>
<main class="main" id="main">
	<section class="section dashboard">
		<?php if ($this->session->flashdata('passwordbeda')): ?>
			<div class="row d-flex justify-content-center">
				<div class="col-8">
					<p class="alert alert-danger alert-dismissible fade show text-center" role="alert">
		                   <?= $this->session->flashdata('passwordbeda'); ?>
			   			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		            </p>
				</div>
			</div>
		<?php endif ?>
		<?php if ($this->session->flashdata('upload_gagal')): ?>
			<div class="row d-flex justify-content-center">
				<div class="col-8">
					<p class="alert alert-danger alert-dismissible fade show text-center" role="alert">
		                   <?= $this->session->flashdata('upload_gagal'); ?>
			   			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		            </p>
				</div>
			</div>
		<?php endif ?>
		<?php if ($this->session->flashdata('berhasil_profil')): ?>
			<div class="row d-flex justify-content-center">
				<div class="col-8">
					<p class="alert alert-success alert-dismissible fade show text-center" role="alert">
		                   <?= $this->session->flashdata('berhasil_profil'); ?>
			   			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		            </p>
				</div>
			</div>
		<?php endif ?>
		<?php if ($this->session->flashdata('gagalkonfirmasi')): ?>
			<div class="row d-flex justify-content-center">
				<div class="col-8">
					<p class="alert alert-danger alert-dismissible fade show text-center" role="alert">
		                   <?= $this->session->flashdata('gagalkonfirmasi'); ?>
			   			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		            </p>
				</div>
			</div>
		<?php endif ?>
		<div class="row d-flex justify-content-center">
			<div class="col-4">
				<div class="card" data-aos="fade-right" data-aos-delay="">
					<div class="card-body">
						<h5 class="card-title">Foto Profil</h5>
						<img src="<?= base_url('upload/profil/' . $user->profil) ?>" style="max-width: 200px; border-radius:20px;" data-aos="fade-right" data-aos-delay="250" class="mb-3">
						<form action="<?= site_url('auth/profil_user/' . $user->id_user) ?>" method="POST" enctype="multipart/form-data">
							<input type="file" name="profil" class="form-control mb-3">
							<div class="d-flex justify-content-end">
								<button class="btn btn-outline-secondary" type="submit">Ubah Profil</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="card" data-aos="fade-right" data-aos-delay="100">
					<div class="card-body">
						<h5 class="card-title">Edit Pengguna</h5>
						<form action="<?= site_url('auth/edit_user/' . $user->id_user) ?>" method="POST" data-aos="fade-right" data-aos-delay="300">
							<input type="text" name="nama_user" value="<?= $user->nama_user; ?>" class="form-control mb-3">
							<div class="d-flex justify-content-end">
								<button class="btn btn-outline-secondary" type="submit" data-aos="fade-right" data-aos-delay="350">Ubah Nama</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card" data-aos="fade-right" data-aos-delay="200">
					<div class="card-body">
						<h5 class="card-title">Edit Password</h5>
						<form action="<?= site_url('auth/edit_password/' . $user->id_user) ?>" method="POST">
							<label data-aos="fade-right" data-aos-delay="400">Password lama</label>
							<input type="password" name="lama" class="form-control mb-3" data-aos="fade-right" data-aos-delay="400">
							<label data-aos="fade-right" data-aos-delay="450">Password baru</label>
							<input type="password" name="pertama" class="form-control mb-3" data-aos="fade-right" data-aos-delay="450">
							<label data-aos="fade-right" data-aos-delay="500">Konfirmasi password baru</label>
							<input type="password" name="kedua" class="form-control mb-3" data-aos="fade-right" data-aos-delay="500">
							<div class="d-flex justify-content-end">
								<button class="btn btn-outline-secondary" type="submit" data-aos="fade-right" data-aos-delay="550">Ubah Password</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php $this->load->view('kasir/template/end'); ?>