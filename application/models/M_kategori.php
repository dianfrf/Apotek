<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kategori extends CI_Model{
  public function menambah()
  {
      $nama_kategori=$this->input->post('nama_kategori');

      $data_simpan = array('nama_kategori'=>$nama_kategori);
      $this->db->insert('kategori', $data_simpan);
      if ($this->db->affected_rows()>0) {
          return TRUE;
      }
      else {
          return FALSE;
      }
  }

  public function menampilkan()
  {
      $tampilkan = $this->db->order_by('id_kategori', 'asc')->get('kategori')->result();
      return $tampilkan;
  }

  public function mengubah($id_kategori, $nama_kategori)
  {
      $hasil = $this->db->query("UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id_kategori'");
      return $hasil;
  }

  public function menghapus($id_kategori)
  {
      $hasil = $this->db->query("DELETE FROM kategori where id_kategori='$id_kategori'");
      return $hasil;
  }

}
