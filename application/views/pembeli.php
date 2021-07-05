    <div class="container-fluid" style="background-color: white">
      <h1>Daftar Pembeli</h1>
      <div class="box box-success">
        <div class="box-header with-border">
          <div class="row">
            <div class="container-fluid">
              <div class="pull-right">
                <button type="submit" class="btn btn-success" name="" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> Tambah Pembeli</button>
                <br>
                <br>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="table-responsive">
            <table class="table" id="mydata">
              <tr>
                <th>ID Pembeli</th>
                <th>Nama Pembeli</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th style="text-align:center">Aksi</th>
              </tr>
              <?php
        				foreach($pembeli as $i): ?>
              <tr>
                <td><?=$i->id_pembeli;?></td>
                <td><?=$i->nama_pembeli;?></td>
                <td><?=$i->alamat;?></td>
                <td><?=$i->notelp;?></td>
                <td style="text-align:center">
                    <a data-toggle="modal" data-target="#modal_edit<?= $i->id_pembeli;?>" class="btn btn-info btn-sm">
                        <i class="glyphicon glyphicon-pencil"></i>Ubah
                    </a>
                    <a href="<?=base_url('pembeli/hapus/'.$i->id_pembeli)?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin?')">
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
          <h4 class="modal-title" id="myModalLabel">Tambah Pembeli</h4>
        </div>
        <div class="modal-body">
          <form action="<?=base_url('pembeli/tambah')?>" method="post" class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-3 control-label">Nama Pembeli</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Nama Pembeli" name="nama_pembeli">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Alamat</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Alamat" name="alamat">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Nomor Telepon</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Nomor Telepon" name="notelp">
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
        foreach($pembeli as $i):
    ?>
    <div class="modal fade" id="modal_edit<?= $i->id_pembeli?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Ubah Data Pembeli</h4>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url().'pembeli/ubah'?>" method="post" class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-3 control-label">Nama Pembeli</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Nama Pembeli" name="nama_pembeli" value="<?= $i->nama_pembeli;?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Alamat</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Alamat" name="alamat" value="<?= $i->alamat;?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Nomor Telepon</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Nomor Telepon" name="notelp" value="<?= $i->notelp;?>">
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
