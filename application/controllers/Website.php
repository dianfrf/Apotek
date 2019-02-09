<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller{
  public function index()
  {
      $this->load->view('login');
  }

  public function register()
  {
      $this->load->view('register');
  }

  public function simpan()
	{
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('nama_admin', 'Nama Lengkap', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			if ($this->form_validation->run() == TRUE) {
				$this->load->model('m_admin');
				if ($this->m_admin->masuk() == TRUE) {
					$this->session->set_flashdata('pesan', 'Sukses Simpan');
					redirect('website','refresh');
				}
				else {
					$this->session->set_flashdata('pesan', 'Gagal Simpan');
					redirect('website/register','refresh');
				}
			}
			else {
				$this->session->set_flashdata('pesan', validation_errors());
				redirect('website/register','refresh');
			}
		}
	}

  public function proses_login()
  {
      if ($this->input->post('login')) {
          $this->form_validation->set_rules('username', 'Username', 'trim|required');
          $this->form_validation->set_rules('password', 'Password', 'trim|required');
          if ($this->form_validation->run() == TRUE) {
              $this->load->model('m_admin');
              if ($this->m_admin->get_login()->num_rows()>0) {
                  $data = $this->m_admin->get_login()->row();
                  $array = array(
                      'login'           => TRUE,
                      'nama_admin'      => $data->nama_admin,
                      'username'        => $data->username,
                      'password'        => $data->password,
                      'id_admin'        => $data->id_admin
                  );
                  $this->session->set_userdata($array);
                  redirect('website/dashboard', 'refresh');
              }
              else {
                  $this->session->set_flashdata('pesan', 'Username dan Password Salah');
                  redirect('website','refresh');
              }
          }
          else {
              $this->session->set_flashdata('pesan', validation_errors());
              redirect('website','refresh');
          }
      }
  }

  public function dashboard()
  {
      $data['konten'] = "dashboard";
      $data['judul'] = "Apotek | Dashboard";
      $this->load->view('template', $data);
  }

  public function obat()
  {
      $data['konten'] = "obat";
      $data['judul'] = "Apotek | Obat";
      $this->load->model('m_apotek');
      $data['apotek'] = $this->m_apotek->menampilkan();
      $data['kategori']=$this->m_apotek->sikategori();
      $this->load->view('template', $data);
  }

  public function tambah()
  {
      if ($this->input->post('tambahdata')) {
          $this->load->model('m_apotek');
          if ($this->m_apotek->menambah() == true) {
              redirect('website/obat','refresh');
          }
          else {
              redirect('website/obat','refresh');
          }
      }
  }

  public function ubah()
  {
    if ($this->input->post('ubahdata')) {
        $id_obat=$this->input->post('id_obat');
      $nama_obat=$this->input->post('nama_obat');
      $id_kategori=$this->input->post('id_kategori');
      $harga=$this->input->post('harga');
      $deskripsi=$this->input->post('deskripsi');

      $this->load->model('m_apotek');
      $this->m_apotek->mengubah($id_obat, $nama_obat, $id_kategori, $harga, $deskripsi);
      redirect('website/obat', 'refresh');
    }
  }

  public function hapus($id_obat)
  {
      $this->load->model('m_apotek');
      $this->m_apotek->menghapus($id_obat);
      redirect('website/obat', 'refresh');
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('website','refresh');
  }

}
