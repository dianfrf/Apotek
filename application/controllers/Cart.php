<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller{
  public function index()
  {
    $data['konten'] = "transaksi";
    $data['judul'] = "Apotek | Transaksi";
    $this->load->model('m_apotek');
    $data['apotek'] = $this->m_apotek->menampilkan();
    $data['kategori']=$this->m_apotek->sikategori();
    $data['pembeli'] = $this->m_apotek->sipembeli();
    $data['admin'] = $this->m_apotek->siadmin();
    $this->load->view('template', $data);
  }

  public function add_cart($id)
  {
      $this->load->model('m_apotek');
      $detail=$this->m_apotek->detail($id);

      $data = array(
        'id'      => $detail->id_obat,
        'qty'     => 1,
        'price'   => $detail->harga,
        'name'    => $detail->nama_obat,
        'options' => array('Genre' => $detail->nama_kategori)
      );
      $this->cart->insert($data);
      redirect('cart', 'refresh');
  }

  public function hapus_item($id)
  {
    $data = array(
      'rowid'      => $id,
      'qty'     => 0
    );
    $this->cart->update($data);
    redirect('cart');
  }

  public function simpan()
  {
    if ($this->input->post('simpan')) {
        if ($this->input->post('simpan')) {
          $this->load->model('m_cart');
          $id_transaksi = $this->m_cart->simpan_cart();
          if ($id_transaksi > 0) {
              $this->cart->destroy();
              redirect('cart/pembayaran/'.$id_transaksi, 'refresh');
          }
          else {
              redirect('cart');
          }
        }
    }
  }

  public function pembayaran($id)
  {
      $this->load->model('m_cart');
      $data['nota']=$this->m_cart->get_total($id);
      $data['judul'] = "Apotek | Pembayaran";
      $this->load->view('pembayaran', $data, FALSE);
  }

  public function pesanan()
  {
      $this->load->model('m_cart');
      $data['pesanan'] = $this->m_cart->tm_pesan();
      $data['konten'] = "pesanan";
      $data['judul'] = "Apotek | Riwayat";
      $this->load->view('template', $data);
  }

  public function proses_upload($id_transaksi)
  {
      $config['upload_path'] = './assets/nota/';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['file_name'] = 'nota'.$id_transaksi;
      $config['max_size'] = '';
      $config['max_width'] = '';
      $config['max_height'] = '';

      $this->load->library('upload' , $config);

      if (! $this->upload->do_upload('bukti')) {
          $this->session->set_flashdata('pesan',$this->upload->display_errors());
          redirect('cart/pesanan', 'refresh');
      }
      else {
          $this->load->model('m_cart');
          if ($this->m_cart->update_bukti($this->upload->data('file_name'))) {
              $this->session->set_flashdata('pesan', 'Suskes upload bukti pembayaran.');
              redirect('cart/pesanan', 'refresh');
          }
      }
  }

  public function hapus($id_transaksi)
  {
    $this->db->where('id_transaksi', $id_transaksi)->delete('transaksi');
    redirect('cart/pesanan', 'refresh');
  }

}
