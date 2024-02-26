<?php $this->load->view('kasir/template/head') ?>
<?php $this->load->view('kasir/template/navbar') ?>
<?php $this->load->view('kasir/template/sidebar') ?>
<main class="main" id="main">
    <section class="section dashboard">
        <div class="row">
            <div class="col-xl-8">
                <div class="row mx-3">
                    <?php if ($this->session->flashdata('bayar_kurang')): ?>
                        <h6 class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('bayar_kurang'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </h6>
                    <?php endif ?>            
                    <?php if ($this->session->flashdata('stok_kurang')): ?>
                        <h6 class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('stok_kurang'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </h6>
                    <?php endif ?>            
                    <?php if ($this->session->flashdata('transaksi_berhasil')): ?>
                        <h6 class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('transaksi_berhasil'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </h6>
                    <?php endif ?>  
                    <?php if ($this->session->flashdata('tidak_ketemu')): ?>
                        <h6 class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('tidak_ketemu'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </h6>
                    <?php endif ?>           
                </div>
                <div class="row mx-3">
                    <div class="card mb-0 py-3 d-flex justify-content-between flex-row">
                        <form action="" method="POST" class="w-100 px-3">
                            <input type="text" name="id_barang" class="form-control" placeholder="Scan Kode Barang" id="id_barang">
                        </form>
                        <div  class="">
                            <button class="btn btn-outline-secondary px-3" data-bs-toggle="modal" data-bs-target="#cariBarang">
                                <i class="bi bi-search"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="cariBarang" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Cari barang</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Thumbnail</th>
                                                        <th>Barang</th>
                                                        <th>Harga</th>
                                                        <th>Stok</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($barang_barang as $barang): ?>
                                                        <tr>
                                                            <td><img src="<?= base_url() . 'upload/barang/' . $barang->thumbnail ?>" style="width: 50px;"></td>
                                                            <td><?= $barang->nama; ?></td>
                                                            <td><?= $barang->harga; ?></td>
                                                            <td><?= $barang->stok; ?></td>
                                                            <td>
                                                                <form action="" method="POST">
                                                                    <input type="hidden" name="id_barang" value="<?= $barang->id_barang; ?>">
                                                                    <button class="btn btn-primary" type="submit">Pilih</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-1 pt-3 px-1" style="overflow-y: auto; max-height: 80vh; border-radius: 5px;">
                    <?php foreach($barang_barang as $barang) : ?>
                        <div class="col-sm-3 mx-0">
                            <form action="" method="POST">
                                <input type="hidden" value="<?= $barang->id_barang; ?>" name="id_barang">
                                <button type="submit" class="btn">
                                    <div class="card mx-0">
                                        <div>
                                            <img src="<?= base_url('upload/barang/' . $barang->thumbnail) ?>" alt="<?= $barang->thumbnail ?>" class="card-img-top" style="position: relative;">
                                            <div class="badge bg-<?php if ($barang->stok > 0){echo 'info';}else{echo 'danger';} ?> mt-2 mx-2" style="position: absolute; top: 0; right: 0;"><?= $barang->stok; ?></div>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="mt-3"><?= $barang->nama ?></div>
                                            <b>Rp<?= number_format($barang->harga); ?></b>
                                        </div>
                                    </div>
                                </button>
                            </form>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-3">Barang Dipilih</h5>
                        <div class="d-flex justify-content-between flex-column" style="min-height: 75vh;">
                            <table class="table " id="cart-table">
                                <?php if (count($pesanan) > 0) : ?>
                                    <tr>
                                        <th>Nama</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-end">Jumlah</th>
                                    </tr>
                                   <?php foreach ($pesanan as $pesan) : ?>
                                        <tr>
                                            <td><?= $pesan['nama']; ?></td>
                                            <td class="text-end"><?= number_format($pesan['subtotal']); ?></td>
                                            <td class="d-flex justify-content-end">
                                                <form action="<?= site_url('kasir/penjualan/kurang_pesanan') ?>" method="POST">
                                                    <input type="hidden" name="id_barang" value="<?= $pesan['id_barang']; ?>">
                                                    <button type="submit" class="btn btn-outline-secondary mx-2">-</button>
                                                </form>
                                                <?= number_format($pesan['jumlah']); ?>
                                                <form action="<?= site_url('kasir/penjualan/tambah_pesanan') ?>" method="POST">
                                                    <input type="hidden" name="id_barang" value="<?= $pesan['id_barang']; ?>">
                                                    <button type="submit" class="btn btn-primary mx-2">+</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <p class="text-center mt-3">Belum ada barang yang dipilih...</p>
                                <?php endif ?>
                            </table>
                            <div class="p-3 card mb-0">
                                <div>
                                    <div class="d-flex justify-content-between">
                                        <h5>Jumlah :</h5>
                                        <h5><?php if (isset($total_jumlah)) { echo number_format($total_jumlah); } else { echo "0"; } ?></h5>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h3><b>Total Harga :</b></h3>
                                        <h3 >Rp <?php if (isset($total_harga)) { echo number_format($total_harga); } else { echo "0"; } ?></h3>
                                        <input type="hidden" name="total_harga">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="<?= site_url('kasir/penjualan/kosong_pesanan') ?>" class="btn btn-outline-secondary w-100">Batal</a>
                                    <button class="btn btn-primary w-100" style="margin-left: 10px;" data-bs-toggle="modal" data-bs-target="#transaksi">Lanjut</button>
                                    <div class="modal fade" id="transaksi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Transaksi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card p-3 mb-3 bg-danger text-white">
                                                                <div class="d-flex justify-content-between">
                                                                    <h3>Total Harga :</h3>
                                                                    <h3><b>Rp <?php if (isset($total_harga)) { echo number_format($total_harga); } else { echo "0"; } ?></b></h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-9">
                                                            <div class="card">
                                                                <div class="card-body pt-3">
                                                                    <table class="table " id="cart-table">
                                                                        <?php if (isset($pesanan)) : ?>
                                                                        <tr>
                                                                            <th>Thumbnail</th>
                                                                            <th>Barang</th>
                                                                            <th>Harga</th>
                                                                            <th>Jumlah</th>
                                                                            <th class="text-end">Total</th>
                                                                        </tr>
                                                                           <?php foreach ($pesanan as $pesan) : ?>
                                                                                <tr>
                                                                                    <td><img src="<?= base_url('upload/barang/') . $pesan['thumbnail']; ?>" style="width: 50px;"></td>
                                                                                    <td><?= $pesan['nama']; ?></td>
                                                                                    <td><?= number_format($pesan['harga']); ?></td>
                                                                                    <td><?= number_format($pesan['jumlah']); ?></td>
                                                                                    <td class="text-end"><?= number_format($pesan['subtotal']); ?></td>
                                                                                </tr>
                                                                            <?php endforeach ?>
                                                                        <?php else : ?>
                                                                            <p class="text-center mt-3">Belum ada barang yang dipilih...</p>
                                                                        <?php endif ?>
                                                                    </table>
                                                                    <div class="d-flex justify-content-between mb-0">
                                                                        <h4>Jumlah : </h4>
                                                                        <h4><b><?php if (isset($total_jumlah)) { echo $total_jumlah; } else { echo "0"; } ?></b></h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="card">
                                                                <div class="card-body pt-3">
                                                                    <form action="<?= site_url('kasir/penjualan/transaksi') ?>" method="POST" class="">
                                                                        <p class="alert alert-danger alert-dismissible fade show text-center" role="alert" style="display: none;" id="kurang" data-aos="zoom-in">
                                                                              Uang pembayaran Kurang!
                                                                        </p>
                                                                        <input type="hidden" id="total_harga" value="<?= $total_harga; ?>">
                                                                        <div>
                                                                            <label class="mx1 mb-2">Bayar</label>
                                                                            <input type="number" id="bayar" name="bayar" class="form-control mx-1 mb-3" placeholder="Bayar" required oninput="hitungKembalian()">
                                                                        </div>
                                                                        <div>
                                                                            <label class="mx1 mb-2">Kembalian</label>
                                                                            <input type="number" id="kembalian" name="kembalian" class="form-control mx-1 mb-3" placeholder="Kembalian" readonly>
                                                                        </div>
                                                                        <div class="text-end">
                                                                            <button type="submit" class="btn btn-primary mx-1" id="submit">Bayar</button>
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
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    function hitungKembalian() {
      // Mendapatkan nilai input "Bayar"
      var bayarInput = document.getElementById('bayar').value;

      // Mendapatkan nilai tersembunyi "total_harga"
      var totalHarga = document.getElementById('total_harga').value;

      // Konversi nilai menjadi tipe data numerik
      bayarInput = parseFloat(bayarInput);
      totalHarga = parseFloat(totalHarga);

      if (totalHarga > bayarInput) {
        document.getElementById('submit').disabled = true;
        document.getElementById('kurang').style.display = 'block';
      } else {
        document.getElementById('submit').disabled = false;
        document.getElementById('kurang').style.display = 'none';
      }

      // Jika nilai "Bayar" tidak kosong
      if (bayarInput !== '') {
        // Menghitung kembalian
        var kembalian = bayarInput - totalHarga;

        // Menetapkan nilai kembalian pada input "Kembalian"
        document.getElementById('kembalian').value = kembalian;
      } else {
        // Jika nilai "Bayar" kosong, kembalian diatur menjadi 0
        document.getElementById('kembalian').value = 0;
      }
    }
</script>

  <script>
        // Menetapkan fokus ke elemen input dengan id "nama" saat halaman dimuat
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("id_barang").focus();
        });
    </script>
<?php $this->load->view('kasir/template/end') ?>


