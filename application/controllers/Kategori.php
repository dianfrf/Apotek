<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller{
  public function index()
  {
      $data['konten'] = "kategori";
      $data['judul'] = "Apotek | Kategori";
      $this->load->model('m_kategori');
      $data['kategori'] = $this->m_kategori->menampilkan();
      $this->load->view('template', $data);
  }

  public function tambah()
  {
      if ($this->input->post('tambahdata')) {
          $this->load->model('m_kategori');
          if ($this->m_kategori->menambah() == true) {
              redirect('kategori','refresh');
          }
          else {
              redirect('kategori','refresh');
          }
      }
  }

  public function ubah($id_kategori)
  {
    if ($this->input->post('ubahdata')) {
      $nama_kategori=$this->input->post('nama_kategori');

      $this->load->model('m_kategori');
      $this->m_kategori->mengubah($id_kategori, $nama_kategori);
      redirect('kategori', 'refresh');
    }
  }

  public function hapus($id_kategori)
  {
      $this->load->model('m_kategori');
      $this->m_kategori->menghapus($id_kategori);
      redirect('kategori', 'refresh');
  }

}
