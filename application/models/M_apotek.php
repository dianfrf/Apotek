<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_apotek extends CI_Model{
  public function menambah()
  {
      $nama_obat=$this->input->post('nama_obat');
      $id_kategori=$this->input->post('id_kategori');
      $harga=$this->input->post('harga');
      $deskripsi=$this->input->post('deskripsi');

      $data_simpan = array('nama_obat'=>$nama_obat, 'id_kategori'=>$id_kategori, 'harga'=>$harga, 'deskripsi'=>$deskripsi);
      $this->db->insert('obat', $data_simpan);
      if ($this->db->affected_rows()>0) {
          return TRUE;
      }
      else {
          return FALSE;
      }
  }

  public function sikategori()
  {
    return $this->db->get('kategori')->result();
  }

  public function sipembeli()
  {
    return $this->db->get('pembeli')->result();
  }

  public function siadmin()
  {
    return $this->db->get('admin')->result();
  }

  public function menampilkan()
  {
      $tampilkan = $this->db->order_by('id_obat', 'asc')->join('kategori', 'kategori.id_kategori = obat.id_kategori')->get('obat')->result();
      return $tampilkan;
  }

  public function mengubah($id_obat, $nama_obat, $id_kategori, $harga, $deskripsi)
  {
      $hasil = $this->db->query("UPDATE obat SET nama_obat='$nama_obat', id_kategori='$id_kategori', harga='$harga', deskripsi='$deskripsi' WHERE id_obat='$id_obat'");
      return $hasil;
  }

  public function menghapus($id_obat)
  {
      $hasil = $this->db->query("DELETE FROM obat where id_obat='$id_obat'");
      return $hasil;
  }

  public function detail($d)
  {
    $tm_obat= $this->db
                  ->join('kategori', 'kategori.id_kategori = obat.id_kategori')
                  ->where('id_obat',$d)->get('obat')->row();
    return $tm_obat;
  }

}
