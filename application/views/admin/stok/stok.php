<?php $this->load->view('admin/template/head'); ?>
<?php $this->load->view('admin/template/navbar'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>
<main class="main" id="main">
	<section class="section dashboard">
		<div class="row d-flex justify-content-center">
			<div class="col-8">
				<?php if ($this->session->flashdata('berhasil')): ?>
				<div class="row">
					<div class="col-12">
						<p class="alert alert-success alert-dismissible fade show text-center" role="alert">
			                   <?= $this->session->flashdata('berhasil'); ?>
				   			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			            </p>
					</div>
				<?php endif ?>
				<?php if ($this->session->flashdata('update_stok')): ?>
				<div class="row">
					<div class="col-12">
						<p class="alert alert-success alert-dismissible fade show text-center" role="alert">
			                   <?= $this->session->flashdata('update_stok'); ?>
				   			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			            </p>
					</div>
				<?php endif ?>
				<?php if ($this->session->flashdata('tambah_supplier')): ?>
				<div class="row">
					<div class="col-12">
						<p class="alert alert-success alert-dismissible fade show text-center" role="alert">
			                   <?= $this->session->flashdata('tambah_supplier'); ?>
				   			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			            </p>
					</div>
				<?php endif ?>
				<?php if ($this->session->flashdata('edit_supplier')): ?>
				<div class="row">
					<div class="col-12">
						<p class="alert alert-success alert-dismissible fade show text-center" role="alert">
			                   <?= $this->session->flashdata('edit_supplier'); ?>
				   			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			            </p>
					</div>
				<?php endif ?>
				<?php if ($this->session->flashdata('hapus_supplier')): ?>
				<div class="row">
					<div class="col-12">
						<p class="alert alert-success alert-dismissible fade show text-center" role="alert">
			                   <?= $this->session->flashdata('hapus_supplier'); ?>
				   			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			            </p>
					</div>
				<?php endif ?>
				<?php if ($this->session->flashdata('gagal')): ?>
				<div class="row">
					<div class="col-12">
						<p class="alert alert-success alert-dismissible fade show text-center" role="alert">
			                   <?= $this->session->flashdata('gagal'); ?>
				   			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			            </p>
					</div>
				<?php endif ?>
				<?php if ($this->session->flashdata('berhasil_hapus')): ?>
				<div class="row">
					<div class="col-12">
						<p class="alert alert-success alert-dismissible fade show text-center" role="alert">
			                   <?= $this->session->flashdata('berhasil_hapus'); ?>
				   			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			            </p>
					</div>
				</div>
				<?php endif ?>
			</div>
		</div>
		<div class="row d-flex justify-content-center">
			<div class="col-8">
				<div class="card"data-aos="fade-right" >
					<div class="card-body pt-3">
						<div class="d-flex justify-content-between mb-3">
							<h5>Riwayat Stok barang</h5>
							<div>
								<button class="btn btn-outline-secondary" data-bs-target="#listSupplier" data-bs-toggle="modal" data-aos="fade-right" data-aos-delay="100"><i class="ri-truck-fill"></i> Supplier</button>
								<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahStok" data-aos="fade-right" data-aos-delay="200">Tambah Stok</button>
								
							</div>
						</div>
						<table class="table datatable"data-aos="fade-right" data-aos-delay="300">
							<thead>
								<tr>
									<th>Kode Stok</th>
									<th>Barang</th>
									<th>Supplier</th>
									<th>Tambahan</th>
									<th>Pengeluaran</th>
									<th>Tanggal</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($stok as $s): ?>
									<tr>
										<td><?= $s->id_stok; ?></td>
										<td><?= $s->nama; ?></td>
										<td><?= $s->nama_supplier; ?></td>
										<td><?= $s->tambahan; ?></td>
										<td><?= $s->pengeluaran; ?></td>
										<td><?= $s->tanggal; ?></td>
										<td>
											<button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#edit<?= $s->id_stok; ?>">Edit</button>
											<button class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#detailStok<?= $s->id_stok; ?>">Detail</button>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<div class="modal fade" id="listSupplier" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">List Supplier</h1>
        <button class="btn btn-outline-secondary" data-bs-target="#tambahSupplier" data-bs-toggle="modal">+ Supplier</button>
      </div>
      <div class="modal-body">
        <table class="table datatable">
        	<thead>
        		<tr>
        			<th>Supplier</th>
        			<th>No HP</th>
        			<th>Alamat</th>
        			<th>Aksi</th>
        		</tr>
        	</thead>
        	<tbody>
        		<?php foreach ($supplier as $sup): ?>
        			<tr>
        				<td><?= $sup->nama_supplier?></td>
        				<td><?= $sup->no_hp?></td>
        				<td><?= $sup->alamat?></td>
        				<td class="d-flex justify-content-center align-items-center">
        					<button class="btn btn-outline-success" data-bs-target="#editSupplier" data-bs-toggle="modal">Edit</button>
        					<a href="<?= site_url('admin/stok/hapus_supplier/' . $sup->id_supplier) ?>" class="btn btn-outline-danger" onclick="return confirm('Apakah yakin akan menghapus supplier ini?')">Hapus</a>
        				</td>
        			</tr>
        		<?php endforeach ?>
        	</tbody>
        </table>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="tambahSupplier" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Tambah Supplier</h1>
        <button class="btn btn-outline-secondary" data-bs-target="#listSupplier" data-bs-toggle="modal"><i class="ri-arrow-left-line"></i> Kembali</button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('admin/stok/tambah_supplier') ?>" method="POST">
        	<label class="mb-1">Nama Supplier</label>
        	<input type="text" name="nama_supplier" class="form-control mb-3">
        	<label class="mb-1">No HP</label>
        	<input type="number" name="no_hp" class="form-control mb-3">
        	<label class="mb-1">Alamat</label>
        	<textarea name="alamat" class="form-control mb-3" placeholder="Alamat"></textarea>
        	<div class="d-flex justify-content-end">
        		<button type="submit" class="btn btn-primary">Tambahkan</button>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="editSupplier" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Edit Supplier</h1>
        <button class="btn btn-outline-secondary" data-bs-target="#listSupplier" data-bs-toggle="modal"><i class="ri-arrow-left-line"></i> Kembali</button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('admin/stok/edit_supplier/' . $sup->id_supplier) ?>" method="POST">
        	<label class="mb-1">Nama Supplier</label>
        	<input type="text" name="nama_supplier" class="form-control mb-3" value="<?= $sup->nama_supplier; ?>">
        	<label class="mb-1">No HP</label>
        	<input name="no_hp" class="form-control mb-3" value="<?= $sup->no_hp; ?>">
        	<label class="mb-1">Alamat</label>
        	<textarea name="alamat" class="form-control mb-3" placeholder="Alamat"><?= $sup->alamat; ?></textarea>
        	<div class="d-flex justify-content-end">
        		<button type="submit" class="btn btn-success">Ubah</button>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="tambahStok" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Stok</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
							<form action="" method="POST">
								<label>Barang</label>
								<select class="form-control mb-3" name="id_barang" required>
									<?php foreach ($barang as $b): ?>
										<option value="<?= $b->id_barang; ?>"><?= $b->nama; ?> ( Stok: <?= $b->stok; ?> )</option>
									<?php endforeach ?>
								</select>
								<label>Tambahan</label>
								<input type="number" name="tambahan" class="form-control mb-3" required>
								<label>Supplier</label>
								<select class="form-control mb-3" name="id_supplier" required>
									<?php foreach ($supplier as $s): ?>
										<option value="<?= $s->id_supplier; ?>"><?= $s->nama_supplier; ?></option>
									<?php endforeach ?>
								</select>
								<label>Pengeluaran</label>
								<input type="number" name="pengeluaran" class="form-control mb-3" required>
								<label>Keterangan</label>
								<textarea name="keterangan" class="form-control mb-3" placeholder="Tidak ada keterangan..."></textarea>
								<div class="text-end">
									<button type="submit" class="btn btn-primary">Tambahkan</button>
								</div>
							</form>
            </div>
            <div class="modal-footer">
            	
            </div>
        </div>
    </div>
</div>
<?php foreach ($stok as $s): ?>
	<!-- Modal -->
	<div class="modal fade" id="detailStok<?= $s->id_stok; ?>" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h1 class="modal-title fs-5" id="staticBackdropLabel">Keterangan <strong><?= $s->id_stok; ?></strong></h1>
	                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	            </div>
	            <div class="modal-body">
	                <p><?= $s->keterangan; ?></p>
	            </div>
	            <div class="modal-footer">
	            	<a href="<?= site_url('admin/stok/hapus/' . $s->id_stok) ?>">
	            		<button class="btn btn-outline-danger" onclick="confirm('Yakin akan menghapus data stok?')">
	            			Hapus
	            		</button>
	            	</a>
	            </div>
	        </div>
	    </div>
	</div>
<?php endforeach ?>

<?php foreach ($stok as $s): ?>
	<div class="modal fade" id="edit<?= $s->id_stok; ?>" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h1 class="modal-title fs-5">Ubah riwayat <strong><?= $s->id_stok; ?></strong></h1>
	                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	            </div>
	            <div class="modal-body">
	                <form action="<?= site_url('admin/stok/edit_riwayat/' . $s->id_stok) ?>" method="POST">
	                	<label>Barang</label>
										<select class="form-control mb-3" name="id_barang" required>
											<?php foreach ($barang as $b): ?>
												<option value="<?= $b->id_barang; ?>" <?php if ($s->id_barang === $b->id_barang){echo "selected";} ?>><?= $b->nama; ?> ( Stok: <?= $b->stok; ?> )</option>
											<?php endforeach ?>
										</select>
										<label>Tambahan</label>
										<input type="number" name="tambahan" class="form-control mb-3" required value="<?= htmlentities($s->tambahan) ?>">
										<label>Supplier</label>
										<select class="form-control mb-3" name="id_supplier" required>
											<?php foreach ($supplier as $sup): ?>
												<option value="<?= $s->id_supplier; ?>" <?php if ($s->id_supplier === $sup->id_supplier){echo "selected";} ?>><?= $sup->nama_supplier; ?></option>
											<?php endforeach ?>
										</select>
										<label>Pengeluaran</label>
										<input type="number" name="pengeluaran" class="form-control mb-3" required value="<?= htmlentities($s->pengeluaran) ?>">
										<label>Tanggal</label>
										<input type="date" name="tanggal" class="form-control mb-3" required>
										<label>Keterangan</label>
										<textarea name="keterangan" class="form-control mb-3" placeholder="Tidak ada keterangan..."><?= htmlentities($s->keterangan) ?></textarea>
										<div class="text-end">
											<button type="submit" class="btn btn-success">Ubah</button>
										</div>
	                </form>
	            </div>
	            <div class="modal-footer">
	            </div>
	        </div>
	    </div>
	</div>
<?php endforeach ?>
<?php $this->load->view('admin/template/end'); ?>






