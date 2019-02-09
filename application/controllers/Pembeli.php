<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembeli extends CI_Controller{

  public function index()
  {
      $data['konten'] = "pembeli";
      $data['judul'] = "Apotek | Pembeli";
      $this->load->model('m_pembeli');
      $data['pembeli'] = $this->m_pembeli->menampilkan();
      $this->load->view('template', $data);
  }

  public function tambah()
  {
      if ($this->input->post('tambahdata')) {
          $this->load->model('m_pembeli');
          if ($this->m_pembeli->menambah() == true) {
              redirect('pembeli','refresh');
          }
          else {
              redirect('pembeli','refresh');
          }
      }
  }

  public function ubah()
  {
      $nama_pembeli=$this->input->post('nama_pembeli');
      $alamat=$this->input->post('alamat');
      $notelp=$this->input->post('notelp');

      $this->load->model('m_pembeli');
      $this->m_pembeli->mengubah($nama_pembeli, $alamat, $notelp);
      redirect('pembeli', 'refresh');
  }

  public function hapus($id_pembeli)
  {
      $this->load->model('m_pembeli');
      $this->m_pembeli->menghapus($id_pembeli);
      redirect('pembeli', 'refresh');
  }

}
