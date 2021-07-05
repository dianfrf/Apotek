<div class="container-fluid" style="background-color: white">
  <h1>Daftar Pesanan</h1>
  <div class="box box-success">
    <div class="table-responsive">
      <table class="table">
        <tr>
          <th>No Nota</th>
          <th>Nama Pembeli</th>
          <th>Tanggal Beli</th>
          <th>Grandtotal</th>
          <th>Detail</th>
          <th style="text-align:center">Status</th>
        </tr>
        <?php
        foreach ($pesanan as $psn): ?>
          <tr>
            <td><?=$psn->id_transaksi?></td>
            <td><?=$psn->nama_pembeli?></td>
            <td><?=$psn->tgl_beli?></td>
            <td><?="Rp. ".number_format($psn->grandtotal)?></td>
            <td><a data-toggle="modal" data-target="#modaldet<?= $psn->id_transaksi;?>" style="text-decoration:none" class="btn btn-info">Lihat Barang</a></td>
            <td style="text-align:center">
              <?php
              if ($psn->bukti == false): ?>
                  <a data-toggle="modal" data-target="#modalkon<?= $psn->id_transaksi;?>" style="text-decoration:none" class="btn btn-success">Konfirmasi</a> |
                  <a href="<?=base_url('cart/hapus/'.$psn->id_transaksi)?>" style="text-decoration:none" class="btn btn-danger" onclick="return confirm('Apakah yakin?')">Batalkan</a>
              <?php else: ?> Lunas
              <?php endif ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>

<?php foreach ($pesanan as $psn): ?>
<div class="modal fade" id="modaldet<?=$psn->id_transaksi?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Detail Barang yang dipesan <?=$psn->nama_pembeli?></h4>
      </div>
      <div class="modal-body">

        <?php foreach ($this->m_cart->get_nota($psn->id_transaksi) as $i): ?>
          <table class="table table-hover table-striped">
            <div class="row">
              <div class="col-md-3">ID Obat</div>
              <div class="col-md-9"><?=$i->id_obat?></div>
            </div>
            <div class="row">
              <div class="col-md-3">Nama Obat</div>
              <div class="col-md-9"><?=$i->nama_obat?></div>
            </div>
            <div class="row">
              <div class="col-md-3">Kategori</div>
              <div class="col-md-9"><?=$i->nama_kategori?></div>
            </div>
            <div class="row">
              <div class="col-md-3">Jumlah</div>
              <div class="col-md-9"><?=$i->jumlah?></div>
            </div>
            <div class="row">
              <div class="col-md-3">Harga</div>
              <div class="col-md-9"><?="Rp. ".number_format($i->harga)?></div>
            </div>
            <div class="row">
              <div class="col-md-3">Total</div>
              <div class="col-md-9"><?= "Rp. ".number_format(($i->harga*$i->jumlah))?></div>
            </div>
          </table>
          <br>
        <?php endforeach ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endforeach ?>

<?php foreach ($pesanan as $psn): ?>
<div class="modal fade" id="modalkon<?= $psn->id_transaksi;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-title" id="myModalLabel">Upload Bukti Pembayaran</h4>
    </div>
    <div class="modal-body">
      <form action="<?=base_url('cart/proses_upload/'.$psn->id_transaksi)?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_transaksi" value="<?=$psn->id_transaksi?>">
        <input type="file" name="bukti">
        <br>
    </div>
    <div class="modal-footer">
      <input type="submit" name="upload" value="Upload Bukti Pembayaran" class="btn btn-primary">
      </form>
    </div>
  </div>
</div>
</div>
<?php endforeach; ?>
