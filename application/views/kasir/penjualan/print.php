<?php $this->load->view('kasir/template/head') ?>
<?php $this->load->view('kasir/template/navbar') ?>
<?php $this->load->view('kasir/template/sidebar') ?>
<main class="main" id="main">
    <section class="section dashboard">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-4">
                <div class="card p-3 mb-3" data-aos="fade-right">
                    <p class="mb-0">Print struk transaksi</p>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-4">
                <div class="card"  data-aos="fade-right" data-aos-delay="100">
                    <div class="card-body pt-4">
                        <div id="print">
                            <div class="text-center">
                                <img src="<?= base_url('assets/img/logo hitam.png') ?>" style="width: 200px;" class="mb-4">
                            </div>
                            <p class="text-center"><?= $transaksi[0]->id_transaksi; ?> | <?= $transaksi[0]->nama_user; ?></p>
                            <hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Barang</th>
                                        <th>Kategori</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($detail_transaksi as $detail): ?>
                                        <tr>
                                            <td><?= $detail->nama; ?></td>
                                            <td><?= $detail->kategori; ?></td>
                                            <td><?= $detail->jumlah; ?></td>
                                            <td><?= $detail->total; ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between">
                                <h5><b>Total :</b></h5>
                                <h5><b><?= $transaksi[0]->total; ?></b></h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5><b>Bayar :</b></h5>
                                <h5><b><?= $bayar; ?></b></h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5><b>Kembalian :</b></h5>
                                <h5><b><?= $kembalian; ?></b></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="<?= site_url('kasir/penjualan/back') ?>" class="btn btn-outline-secondary mx-3">Kembali</a>
                    <button class="btn btn-primary" onclick="printDiv('print')"><i class="ri ri-print"></i> Print</button>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    function printDiv(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.href = '<?= site_url('kasir/penjualan/back') ?>';
    }
</script>

<?php $this->load->view('kasir/template/end') ?>