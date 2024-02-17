<?php $this->load->view('admin/template/head') ?>
<?php $this->load->view('admin/template/navbar') ?>
<?php $this->load->view('admin/template/sidebar') ?>
<main class="main" id="main">
	<section class="section dashboard">
	    <div class="row">
	    	<div class="col-lg-9">
	    		<?php if (isset($laporan_penjualan)): ?>
	    			<p class="alert alert-success alert-dismissible fade show text-center" role="alert" data-aos="fade-right">
                        Menampilkan laporan pada periode:
                        <br>
                        <strong><?= $waktu_awal; ?></strong> s/d <strong><?= $waktu_akhir; ?></strong>
	    				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </p>
	    			<div class="row mb-0">
            			<div class="col-xxl-4 col-md-6">
            				<div class="card info-card sales-card" data-aos="fade-right" data-aos-delay="200">
				           		<div class="card-body">
            				    <h5 class="card-title">Jumlah Penjualan</h5>
				           			<div class="d-flex align-items-center">
            				    	  	<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            				    	  	  	<i class="bi bi bi-cart"></i>
            				    	  	</div>
            				    	  	<div class="ps-3">
            				    	    	<h6><?= number_format($jumlah_penjualan); ?></h6>
				           				</div>
            				    	</div>
            				  	</div>
				           	</div>
            			</div>
	    				<div class="col-xxl-4 col-md-6">
            				<div class="card info-card customers-card" data-aos="fade-right" data-aos-delay="300">
				           		<div class="card-body">
            				    <h5 class="card-title">Total Transaksi</h5>
				           			<div class="d-flex align-items-center">
            				    	  	<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            				    	  	  	Rp
            				    	  	</div>
            				    	  	<div class="ps-3">
            				    	    	<h6><?= number_format($total_transaksi); ?></h6>
				           				</div>
            				    	</div>
            				  	</div>
				           	</div>
            			</div>
            			<div class="col-xxl-4 col-md-6">
            				<div class="card info-card revenue-card" data-aos="fade-right" data-aos-delay="400">
				           		<div class="card-body">
            				    <h5 class="card-title">Total Pendapatan</h5>
				           			<div class="d-flex align-items-center">
            				    	  	<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            				    	  	  	Rp
            				    	  	</div>
            				    	  	<div class="ps-3">
            				    	    	<h6><?= number_format($total_laba); ?></h6>
				           				</div>
            				    	</div>
            				  	</div>
				           	</div>
            			</div>
	    			</div>
	    			<div class="row">
	    				<div class="col-12">
	    					<div class="card" data-aos="fade-right" data-aos-delay="500">
	    						<div class="card-body pt-4">
					    			<?php if ($this->session->flashdata('hapus')): ?>
					    				<p class="alert alert-success alert-dismissible fade show text-center" role="alert" data-aos="fade-right">
					    					<?= $this->session->flashdata('hapus'); ?>
					    					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					    				</p>
					    			<?php endif ?>
	    							<table class="datatable">
	    								<thead>
		    								<tr>
		    									<th>Kode</th>
		    									<th>User</th>
		    									<th>Total</th>
		    									<th>Laba</th>
		    									<th>Tanggal</th>
		    									<th class="text-end">Detail</th>
		    								</tr>
	    								</thead>
	    								<tbody>
		    								<?php foreach ($laporan_penjualan as $laporan) : ?>

											   <tr>
												    <td><?= $laporan['transaksi']->id_transaksi; ?></td>
												    <td><?= $laporan['transaksi']->nama_user; ?></td>
												    <td><?= $laporan['transaksi']->total; ?></td>
												    <td><?= $laporan['transaksi']->laba; ?></td>
												    <td><?= $laporan['transaksi']->tanggal; ?></td>
											       <td class="d-flex justify-content-end">
											           <button class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#detailTransaksi<?= $laporan['transaksi']->id_transaksi; ?>">Detail</button>
											       </td>
											   </tr>
											<?php endforeach ?>
	    								</tbody>
	    							</table>
	    						</div>
	    					</div>
	    				</div>
	    			</div>
	    		<?php else : ?>
	    			<?php if ($this->session->flashdata('tidak_ketemu')): ?>
	    				<p class="alert alert-danger alert-dismissible fade show text-center" role="alert" data-aos="fade-right">
	    					<?= $this->session->flashdata('tidak_ketemu'); ?>
	    					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	    				</p>
	    			<?php else: ?>
	    				<p class="alert alert-info alert-dismissible fade show text-center" role="alert" data-aos="fade-right">
                    	    Silakan isi form filter terlebih dahulu!
                    	</p>
	    			<?php endif ?>
	    		<?php endif ?>
	    	</div>
	    	<div class="col-lg-3">
	    		<?php if (isset($laporan_penjualan)): ?>
	    			<div class="card" data-aos="fade-right">
	    				<div class="card-body pt-3">
	    					<form action="<?= site_url('admin/transaksi/ekspor_excel') ?>" method="POST">
	    						<input type="hidden" name="waktu_awal" value="<?= $waktu_awal; ?>">
	    						<input type="hidden" name="waktu_akhir" value="<?= $waktu_akhir; ?>">
	    						<button type="submit" class="btn btn-success"><i class="ri-file-excel-fill"></i> Ekspor file Excel</button>
	    					</form>
	    				</div>
	    			</div>
				  <?php foreach ($laporan_penjualan as $laporan): ?>
				   <!-- Modal -->
				   <div class="modal fade" id="detailTransaksi<?= $laporan['transaksi']->id_transaksi; ?>" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				       <div class="modal-dialog modal-dialog-centered modal-lg">
				           <div class="modal-content">
				               <div class="modal-header">
				                   <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Transaksi <?= $laporan['transaksi']->id_transaksi; ?></h1>
				                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				               </div>
				               <div class="modal-body">
				                   <table class="table table-striped">
				                       <thead>
				                           <tr>
				                           	   <th class="text-center">Thumbnail</th>
				                               <th class="text-center">Barang</th>
				                               <th class="text-center">Jumlah</th>
				                               <th class="text-center">Total</th>
				                           </tr>
				                       </thead>
				                       <tbody>
				                           <?php foreach ($laporan['detail_transaksi'] as $detail): ?>
				                               <tr>
				                               	   <td class="text-center"><img src="<?= base_url('upload/barang/') . $detail->thumbnail ?>" style="width: 50px;"></td>
				                                   <td class="text-center"><?= $detail->nama; ?></td>
				                                   <td class="text-center"><?= $detail->jumlah; ?></td>
				                                   <td class="text-center"><?= $detail->total; ?></td>
				                               </tr>
				                           <?php endforeach ?>
				                       </tbody>
				                   </table>
				               </div>
				               <div class="modal-footer">
				               	<form action="<?= site_url('admin/transaksi/hapus/' . $laporan['transaksi']->id_transaksi) ?>" method="POST">
				               		<input type="hidden" name="waktu_awal" value="<?= $waktu_awal; ?>">
				               		<input type="hidden" name="waktu_akhir" value="<?= $waktu_akhir; ?>">
				               		<button class="btn btn-outline-danger" type="submit" onclick="confirm('Yakin akan menghapus data transaksi?')">
				               			Hapus
				               		</button>
				               	</form>
				               </div>
				           </div>
				       </div>
				   </div>
				  <?php endforeach ?>
	    		<?php endif ?>
	    		<div class="card" data-aos="fade-right" data-aos-delay="100">
	    			<form action="" method="POST">
	    				<div class="card-body pt-3">
			    			<h5 class="card-title">Filter laporan penjualan</h5>
	    					<div class="mb-3">
	    						<label class="form-label">Dari :</label>
	    						<input type="date" name="waktu_awal" class="form-control">
	    					</div>
	    					<div class="mb-3">
	    						<label class="form-label">Sampai :</label>
	    						<input type="date" name="waktu_akhir" class="form-control">
	    					</div>
	    				</div>
    					<div class="d-flex justify-content-end card-body">
    						<button type="submit" class="btn btn-primary" data-aos="fade-right" data-aos-delay="200">Filter</button>
    					</div>
	    			</form>
	    		</div>
	    	</div>
	    </div>
    </section>
  </main>
<?php $this->load->view('admin/template/end') ?>