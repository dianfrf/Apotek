<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pembeli extends CI_Model{
  public function menambah()
  {
      $nama_pembeli=$this->input->post('nama_pembeli');
      $alamat=$this->input->post('alamat');
      $notelp=$this->input->post('notelp');

      $data_simpan = array('nama_pembeli'=>$nama_pembeli, 'alamat'=>$alamat, 'notelp'=>$notelp);
      $this->db->insert('pembeli', $data_simpan);
      if ($this->db->affected_rows()>0) {
          return TRUE;
      }
      else {
          return FALSE;
      }
  }

  public function menampilkan()
  {
      $tampilkan = $this->db->get('pembeli')->result();
      return $tampilkan;
  }

  public function mengubah($nama_pembeli, $alamat, $notelp)
  {
      $hasil = $this->db->query("UPDATE pembeli SET nama_pembeli='$nama_pembeli', alamat='$alamat', notelp='$notelp' WHERE nama_pembeli='$nama_pembeli'");
      return $hasil;
  }

  public function menghapus($id_pembeli)
  {
      $hasil = $this->db->query("DELETE FROM pembeli where id_pembeli='$id_pembeli'");
      return $hasil;
  }

}
