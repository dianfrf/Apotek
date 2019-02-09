    <div class="container-fluid" style="background-color: white">
      <h1>Daftar Obat</h1>
      <div class="box box-success">
        <div class="box-header with-border">
          <div class="row">
            <div class="container-fluid">
              <div class="pull-right">
                <button type="submit" class="btn btn-success" name="" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> Tambah Obat</button>
                <br>
                <br>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="table-responsive">
            <table class="table" id="example">
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
                    <a data-toggle="modal" data-target="#detail<?= $i->id_obat;?>"><button class="btn btn-success btn-sm">Detail</button></a>
                    <a data-toggle="modal" data-target="#modal_edit<?= $i->id_obat;?>" class="btn btn-info btn-sm">
                        <i class="glyphicon glyphicon-pencil"></i>Ubah
                    </a>
                    <a href="<?=base_url('index.php/website/hapus/'.$i->id_obat)?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin?')">
                        <i class="glyphicon glyphicon-remove"></i>Hapus
                    </a>
                </td>
              </tr>
              <?php endforeach;?>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Tambah Obat</h4>
        </div>
        <div class="modal-body">
          <form action="<?=base_url('index.php/website/tambah')?>" method="post" class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-3 control-label">Nama Obat</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Nama Obat" name="nama_obat">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Kategori</label>
              <div class="col-sm-8">
                <select class="form-control" name="id_kategori" required>
                  <option></option>
                  <?php foreach ($kategori as $k): ?>
                    <option value="<?=$k->id_kategori?>">
                      <?=$k->nama_kategori ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Harga</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Harga Obat" name="harga">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Deskripsi</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Deskripsi" name="deskripsi">
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="Simpan" name="tambahdata">
          </form>
        </div>
      </div>
    </div>
    </div>

    <?php
        foreach($apotek as $i):
    ?>
    <div class="modal fade" id="modal_edit<?= $i->id_obat?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Ubah Data Obat</h4>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url().'index.php/website/ubah'?>" method="post" class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-3 control-label">Nama Obat</label>
              <div class="col-sm-8">
                  <input type="hidden" name="id_obar" value="<?= $i->id_obat;?>">
                <input type="text" class="form-control" placeholder="Nama Obat" name="nama_obat" value="<?= $i->nama_obat;?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Kategori</label>
              <div class="col-sm-8">
                <select class="form-control" name="id_kategori" required>
                  <option></option>
                  <?php foreach ($kategori as $k): ?>
                    <option value="<?=$k->id_kategori?>">
                      <?=$k->nama_kategori ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Harga</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Harga" name="harga" value="<?= $i->harga;?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Deskripsi</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Deskripsi" name="deskripsi" value="<?= $i->deskripsi;?>">
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="Ubah" name="ubahdata">
          </form>
        </div>
      </div>
    </div>
    </div>
    <?php endforeach;?>

    <?php
        foreach($apotek as $i):
    ?>
    <div class="modal fade" id="detail<?=$i->id_obat?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Detail Obat</h4>
        </div>
        <div class="modal-body">
          <form action="" method="post" class="form-horizontal">
            <div class="container-fluid" style="background-color:white; padding: 12px">
                <h2 style="text-align:center"><?=$i->nama_obat;?></h2>
                  <div class="row">
                    <div class="col-md-4">
                      <h3>Kategori</h3>
                      <h3>Harga</h3>
                    </div>
                    <div class="col-md-8">
                      <h3>: <?=$i->nama_kategori?></h3>
                      <h3>: Rp. <?=$i->harga?></h3>
                    </div>
                  </div>
                  <h4>Deskripsi</h4>
                  <p style="text-align:justify"><?=$i->deskripsi?></p>
            </div>
          </form>
        </div>
      </div>
    </div>
    </div>
    <?php endforeach;?>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#example').DataTable();
      });

    </script>
