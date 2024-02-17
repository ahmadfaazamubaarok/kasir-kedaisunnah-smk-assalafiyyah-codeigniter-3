<?php $this->load->view('admin/template/head') ?>
<?php $this->load->view('admin/template/navbar') ?>
<?php $this->load->view('admin/template/sidebar') ?>
<main class="main" id="main">
	<section class="section dashboard">
		<div class="row d-flex justify-content-center">
			<div class="col-md-8">
				<?php if ($this->session->flashdata('berhasil_hapus_kategori')): ?>
	                <h6 class="alert alert-success alert-dismissible fade show text-center" role="alert">
	                    <?= $this->session->flashdata('berhasil_hapus_kategori'); ?>
	                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                </h6>
	            <?php endif ?> 
	            <?php if ($this->session->flashdata('melebihi_batas')): ?>
	                <h6 class="alert alert-danger alert-dismissible fade show text-center" role="alert">
	                    <?= $this->session->flashdata('melebihi_batas'); ?>
	                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                </h6>
	            <?php endif ?> 
	            <?php if ($this->session->flashdata('upload_gagal')): ?>
	                <h6 class="alert alert-danger alert-dismissible fade show text-center" role="alert">
	                    <?= $this->session->flashdata('upload_gagal'); ?>
	                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                </h6>
	            <?php endif ?> 
	            <?php if ($this->session->flashdata('berhasil_ubah_kategori')): ?>
	                <h6 class="alert alert-success alert-dismissible fade show text-center" role="alert">
	                    <?= $this->session->flashdata('berhasil_ubah_kategori'); ?>
	                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                </h6>
	            <?php endif ?> 
	            <?php if ($this->session->flashdata('update_berhasil')): ?>
	                <h6 class="alert alert-success alert-dismissible fade show text-center" role="alert">
	                    <?= $this->session->flashdata('update_berhasil'); ?>
	                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                </h6>
	            <?php endif ?> 
	            <?php if ($this->session->flashdata('berhasil_tambah_kategori')): ?>
	                <h6 class="alert alert-success alert-dismissible fade show text-center" role="alert">
	                    <?= $this->session->flashdata('berhasil_tambah_kategori'); ?>
	                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                </h6>
	            <?php endif ?> 
	            <?php if ($this->session->flashdata('berhasil_insert')): ?>
	                <h6 class="alert alert-success alert-dismissible fade show text-center" role="alert">
	                    <?= $this->session->flashdata('berhasil_insert'); ?>
	                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                </h6>
	            <?php endif ?> 
				<div class="row mt-1 pt-0 px-1" style="overflow-y: auto; max-height: 80vh; border-radius: 5px; white-space: nowrap;">
					<div class="card">
						<div class="card-body d-flex justify-content-between pt-4">
							<h4>Data barang</h4>
							<div>
								<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#kategori" data-aos="fade-right" data-aos-delay="100">
								  Kategori
								</button>
								<div class="modal fade" id="kategori" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
								  <div class="modal-dialog modal-lg">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h1 class="modal-title fs-5" id="staticBackdropLabel">Kategori Barang</h1>
								        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								      </div>
								      <div class="modal-body">
								        <div class="row">
								        	<div class="col-lg-5">
								        		<div class="card">
								        			<div class="card-body pt-3">
								        				<table class="table">
								        					<tbody>
								        						<?php foreach ($kategori_barang as $kategori): ?>
								        							<tr>
								        								<td class="d-flex justify-content-between">
								        									<b><?= $kategori->kategori; ?></b>
								        									<div>
									        									<button class="btn btn-outline-success" data-bs-target="#<?= $kategori->id_kategori; ?>" data-bs-toggle="modal" ><i class="ri-ball-pen-fill"></i></button>
									        									<a href="<?= site_url('admin/barang/hapus_kategori/' . $kategori->id_kategori) ?>" class="btn btn-outline-danger" onclick="return confirm('Yakin akan menghapus kategori barang?')"><i class="ri-delete-bin-7-fill"></i></a>
								        									</div>
								        								</td>
								        							</tr>
								        						<?php endforeach ?>
								        					</tbody>
								        				</table>
								        			</div>
								        		</div>
								        	</div>
								        	<div class="col-lg-7">
								        		<div class="card">
								        			<div class="card-body pt-3">
								        				<h5>Tambah kategori</h5>
								        				<form action="<?= site_url('admin/barang/tambah_kategori') ?>" method="POST">
								        					<input type="text" name="kategori" required class="form-control mb-3" placeholder="Kategori baru">
								        					<div class="d-flex justify-content-end">
									        					<button type="submit" class="btn btn-primary">Tambahkan</button>
								        					</div>
								        				</form>
								        			</div>
								        		</div>
								        	</div>
								        </div>
								      </div>
								      <div class="modal-footer">
								      </div>
								    </div>
								  </div>
								</div>
								<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#barang" data-aos="fade-right" data-aos-delay="50">
									Tambah barang
								</button>
								<div class="modal fade" id="barang"data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Barang</h1>
								        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								      </div>
								      <div class="modal-body">
								        <div class="row">
								            <div class="col-lg-10">
								                <div class="card">
								                    <div class="card-body pt-4">
								                    	<h5 class="mb-3">Isikan Data Barang</h5>
								                        <form action="<?= site_url('admin/barang/tambah') ?>" method="POST" enctype="multipart/form-data">
								                            <input type="text" name="id_barang" placeholder="Kode Barang" class="form-control mb-3">
								                            <input type="text" name="nama" placeholder="Nama barang" class="form-control mb-3" required>
								                            <div class="row">
								                                <div class="col-lg-6">
								                                    <input type="number" name="harga_beli" placeholder="Harga beli" class="form-control mb-3" required>
								                                </div>
								                                <div class="col-lg-6">
								                                    <input type="number" name="harga" placeholder="Harga jual" class="form-control mb-3" required>
								                                </div>
								                            </div>                          
								                            <input type="number" name="stok" placeholder="Stok" class="form-control mb-3" required>
								                            <select name="kategori" class="form-control mb-3" required>
								                                <option>--Pilih Kategori--</option>
								                                <?php foreach ($kategori_barang as $kategori) : ?>
								                                    <option value="<?= $kategori->id_kategori; ?>"><?= $kategori->kategori; ?></option>
								                                <?php endforeach ?>
								                            </select>
								                            <input type="file" name="thumbnail" class="form-control mb-3" required accept=".png, .jpg, .jpeg" onchange="previewImage(event)">
								                            <div class="d-flex justify-content-end">
								                                <button class="btn btn-primary" type="submit">
								                                    Tambahkan
								                                </button>
								                            </div>
								                        </form>
								                    </div>
								                </div>
								            </div>
								            <div class="col-auto">
								            	<div class="card">
								            		<div class="card-body pt-4" id="image-preview-container">
								            			<img id="image-preview" src="#" style="max-width: 100%; max-height: 150px;">
								            		</div>
								            	</div>
								            </div>
								        </div>
								      </div>
								      <div class="modal-footer">
								      </div>
								    </div>
								  </div>
								</div>
							</div>
						</div>
						<?php if ($barang_barang): ?>							
						<div class="card-body pt-3">
							<table class="table datatable" data-aos="fade-right" data-aos-delay="200">
								<thead>
									<tr>
										<th>Thumbnail</th>
										<th>Kode Barang</th>
										<th>Nama Barang</th>
										<th>Harga Kulak</th>
										<th>Harga Jual</th>
										<th>Stok</th>
										<th>Kategori</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($barang_barang as $barang): ?>
										<tr>
											<td><img src="<?= base_url('upload/barang/' . $barang->thumbnail); ?>" style="width: 50px;"></td>
											<td><?= $barang->id_barang; ?></td>
											<td><?= $barang->nama; ?></td>
											<td><?= $barang->harga_beli; ?></td>
											<td><?= $barang->harga; ?></td>
											<td><?= $barang->stok; ?></td>
											<td><?= $barang->kategori; ?></td>
											<td>
												<button class="btn btn-success"href="<?= site_url('admin/barang/edit/' . $barang->id_barang) ?>"  data-bs-toggle="modal" data-bs-target="<?= '#'.$barang->id_barang; ?>"><i class="ri-ball-pen-fill"></i></button>
												<a href="<?= site_url('admin/barang/hapus/' . $barang->id_barang) ?>">
													<button onclick="return confirm('Yakin akan menghapus <?= $barang->nama ?>?')" class="btn btn-danger" >
														<i class="ri-delete-bin-7-fill"></i>
													</button>
												</a>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
						<?php endif ?>
					</div>					
				</div>
			</div>
		</div>
	</section>
</main>
<?php foreach ($kategori_barang as $kategori): ?>
	<div class="modal fade" id="<?= $kategori->id_kategori; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalToggleLabel2">Ubah kategori</h5>
	        <button class="btn btn-secondary" data-bs-target="#kategori" data-bs-toggle="modal" data-bs-dismiss="modal">Kembali</button>
	      </div>
	      <div class="modal-body">
	        <div class="card">
				<div class="card-body pt-3">
					<h5>Tambah kategori</h5>
					<form action="<?= site_url('admin/barang/edit_kategori/' . $kategori->id_kategori) ?>" method="POST">
						<input type="text" name="kategori" required class="form-control mb-3" value="<?= $kategori->kategori; ?>">
						<div class="d-flex justify-content-end">
							<button type="submit" class="btn btn-success">Ubah</button>
						</div>
					</form>
				</div>
			</div>
	      </div>
	      <div class="modal-footer">
	      </div>
	    </div>
	  </div>
	</div>
<?php endforeach ?>
<?php foreach ($barang_barang as $barang): ?>
	<div class="modal fade" id="<?= $barang->id_barang; ?>"data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit <?= $barang->nama; ?></h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	            <div class="col-lg-10">
	                <div class="card">
	                    <div class="card-body pt-4">
	                        <form action="<?= site_url('admin/barang/edit/' . $barang->id_barang) ?>" method="POST" enctype="multipart/form-data">
	                            <label>Nama Barang</label>
	                            <input type="text" name="nama" placeholder="Nama barang" class="form-control mb-3" required value="<?= html_escape($barang->nama) ?>">
	                            <div class="row">
	                                <div class="col-lg-6">
	                                    <label>Harga Beli</label>
	                                    <input type="number" name="harga_beli" placeholder="Harga beli" class="form-control mb-3" required value="<?= html_escape($barang->harga_beli) ?>">
	                                </div>
	                                <div class="col-lg-6">
	                                    <label>Harga Jual</label>
	                                    <input type="number" name="harga" placeholder="Harga jual" class="form-control mb-3" required value="<?= html_escape($barang->harga) ?>">
	                                </div>
	                            </div> 
	                            <label>Stok</label>                         
	                            <input type="number" name="stok" placeholder="Stok" class="form-control mb-3" disabled value="<?= html_escape($barang->stok) ?>">
	                            <select name="kategori" class="form-control mb-3" required>
	                                <option>--Pilih Kategori--</option>
	                                <?php foreach ($kategori_barang as $kategori) : ?>
	                                    <option value="<?= $kategori->id_kategori; ?>" <?php if ($kategori->id_kategori === $barang->id_kategori) { echo 'selected';} else {echo $barang->id_kategori;} ?>><?= $kategori->kategori; ?></option>
	                                <?php endforeach ?>
	                            </select>
	                            <label>Thumbnail</label>
	                            <input type="file" name="thumbnail" class="form-control mb-3" accept=".png, .jpg, .jpeg" onchange="previewImage(event)">
	                            <div class="d-flex justify-content-end">
	                                <button class="btn btn-success" type="submit">
	                                    Ubah data
	                                </button>
	                            </div>
	                        </form>
	                    </div>
	                </div>
	            </div>
	            <div class="col-auto">
	            	<div class="card">
	            		<div class="card-body pt-4" id="image-preview-container">
	            			<img id="image-preview" src="#" style="max-width: 100%; max-height: 150px;">
	            		</div>
	            	</div>
	            </div>
	        </div>
	      </div>
	      <div class="modal-footer">
	      </div>
	    </div>
	  </div>
	</div>
	
<?php endforeach ?>

<!-- Tambahkan script untuk preview gambar -->
<script>
    function previewImage(event) {
        var input = event.target;
        var imagePreview = document.getElementById('image-preview');

        var reader = new FileReader();

        reader.onload = function() {
            imagePreview.src = reader.result;
            document.getElementById('image-preview-container').style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    }
</script>
<script>
    function previewImage(event) {
        var input = event.target;
        var imagePreview = document.getElementById('image-preview');

        var reader = new FileReader();

        reader.onload = function() {
            imagePreview.src = reader.result;
            document.getElementById('image-preview-container').style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    }
</script>
<?php $this->load->view('admin/template/end') ?>