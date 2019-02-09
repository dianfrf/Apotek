<div class="container-fluid" style="background-color: white">
  <h1>Transaksi</h1>
  <div class="row">
    <div class="col-md-6">
      <div class="box box-success">
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="table-responsive">
            <table class="table" id="mydata">
              <tr>
                <th>ID Obat</th>
                <th>Nama Obat</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th style="text-align:center">Aksi</th>
              </tr>
              <?php
                foreach($apotek as $i): ?>
              <tr>
                <td><?=$i->id_obat;?></td>
                <td><?=$i->nama_obat;?></td>
                <td><?=$i->nama_kategori;?></td>
                <td><?=$i->harga;?></td>
                <td style="text-align:center">
                    <a href="<?=base_url('index.php/cart/add_cart/'.$i->id_obat)?>" class="btn btn-success btn-sm">
                        <i class="glyphicon glyphicon-shopping-cart"></i> Pesan
                    </a>
                </td>
              </tr>
              <?php endforeach;?>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="table-responsive">
        <form action="<?=base_url('index.php/cart/simpan')?>" method="post">
          <table class="table">
            <tr>
              <th>ID Obat</th>
              <th>Nama Obat</th>
              <th>Kategori</th>
              <th>Jumlah</th>
              <th>Harga</th>
              <th>Sub Total</th>
              <th>Aksi</th>
            </tr>
            <?php
            foreach ($this->cart->contents() as $items) {
            ?>
            <tr>
              <td>
                <input type="hidden" name="id_obat[]" value="<?=$items['id']?>">
                <input type="hidden" name="qty[]" value="<?=$items['qty']?>">
                <?=$items['id']?></td>
              <td><?=$items['name']?></td>
              <td><?=$items['options']['Genre']?></td>
              <td><?=$items['qty']?></td>
              <td><?=$items['price']?></td>
              <td><?=$items['subtotal']?></td>
              <td>
                <a href="<?=base_url('index.php/cart/hapus_item/'.$items['rowid'])?>" onclick="return confirm('Apakah yakin?')" class="btn btn-danger">
                  <i class="glyphicon glyphicon-remove"></i>
                </a>
              </td>
            </tr>
            <?php }?>
            <tr>
              <input type="hidden" name="grandtotal" value="<?=$this->cart->total()?>">
              <td colspan="5">Grand Total</td>
              <td><?=$this->cart->total()?></td>
            </tr>
          </table>
          <div class="form-group">
            <label class="col-sm-4">Atas nama pembeli :</label>
            <div class="col-sm-8">
              <select class="form-control" name="id_pembeli" required>
                <option></option>
                <?php foreach ($pembeli as $p): ?>
                  <option value="<?=$p->id_pembeli?>">
                    <?=$p->nama_pembeli ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
              <input type="submit" name="simpan" value="Bayar" class="btn btn-primary" onclick="return confirm('Apakah yakin?')">
          </form>
      </div>
    </div>
  </div>
</div>
