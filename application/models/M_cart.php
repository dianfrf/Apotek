<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cart extends CI_Model{

  public function simpan_cart()
  {
      $object = array (
        'id_pembeli' => $this->input->post('id_pembeli'),
        'tgl_beli' => date('Y-m-d'),
        'grandtotal' => $this->input->post('grandtotal'),
        'bukti' => ''
      );
      $this->db->insert('transaksi', $object);
      $tm_transaksi = $this->db->order_by('id_transaksi', 'desc')
                          ->limit(1)
                          ->get('transaksi')
                          ->row();
      $hasil = array();
      for ($i=0 ; $i < count($this->input->post('id_obat')) ; $i++ ) {
          $hasil[] = array(
              'id_transaksi' => $tm_transaksi->id_transaksi,
              'id_obat' => $this->input->post('id_obat')[$i],
              'id_admin' => $this->input->post('id_admin'),
              'jumlah' => $this->input->post('qty')[$i]
          );
      }
      $proses =  $this->db->insert_batch('nota', $hasil);
      if ($proses) {
          return $tm_transaksi->id_transaksi;
      }
      else {
        return 0;
      }
  }

    public function get_total($id)
    {
      return $this->db->join('pembeli', 'pembeli.id_pembeli = transaksi.id_pembeli')
                      ->where('id_transaksi', $id)
                      ->get('transaksi')
                      ->row();
    }

    public function get_nota($id)
    {
      return $this->db->join('obat', 'obat.id_obat = nota.id_obat')
                      ->join('kategori', 'kategori.id_kategori = obat.id_kategori')
                      ->where('id_transaksi', $id)
                      ->get('nota')
                      ->result();
    }

    public function tm_pesan()
    {
      $tampilkan = $this->db->join('pembeli', 'pembeli.id_pembeli = transaksi.id_pembeli')
                            ->order_by('id_transaksi', 'desc')
                            ->get('transaksi')->result();
      return $tampilkan;
    }

    public function update_bukti($filename)
    {
        $object = array(
            'bukti' =>$filename
        );
        return $this->db->where('id_transaksi', $this->input->post('id_transaksi'))
                        ->update('transaksi', $object);
    }

}
