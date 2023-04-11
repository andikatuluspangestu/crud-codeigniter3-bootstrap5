<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller{

  public function __construct()
  {
    parent::__construct();

    // Memanggil Model Mahasiswa
    $this->load->model('Mahasiswa_model');

  }

  // Method Menampilkan Data
  function index()
  {

    // Judul
    $data['title'] = 'Data Mahasiswa';

    $this->load->model('Mahasiswa_model');

    // Mengambil data dari model
    $data['mahasiswa'] =
    $this->Mahasiswa_model->get_all()->result();

    // Mengirim data ke view
    $this->load->view('mahasiswa/template/header', $data);
    $this->load->view('mahasiswa/index', $data);
    $this->load->view('mahasiswa/template/footer');
  }

  // Method Menampilkan Form Tambah Data
  function add()
  {
    // Judul
    $data['title'] = 'Tambah Data Mahasiswa';

    // Mengirim data ke view
    $this->load->view('mahasiswa/template/header', $data);
    $this->load->view('mahasiswa/add', $data);
    $this->load->view('mahasiswa/template/footer');
  }

  // Method Menambahkan Data
  function insert()
  {
    // Mengambil data dari form
    $data = [
      'nama'  => $this->input->post('nama'),
      'nim'   => $this->input->post('nim'),
      'kelas' => $this->input->post('kelas'),
    ];

    // Menambah data ke database
    $this->Mahasiswa_model->insert($data);

    // Set Flashdata untuk menampilkan pesan berhasil dan mengembalikan ke halaman awal
    $this->session->set_flashdata('message', 'Data berhasil ditambahkan');
    redirect('mahasiswa');
  }

  // Method Menampilkan Form Edit Data
  function edit()
  {
    // Judul
    $data['title'] = 'Edit Data Mahasiswa';

    // Mengambil data dari model
    $data['mahasiswa'] = $this->Mahasiswa_model->edit($this->uri->segment(3));

    // Mengirim data ke view
    $this->load->view('mahasiswa/template/header', $data);
    $this->load->view('mahasiswa/edit', $data);
    $this->load->view('mahasiswa/template/footer');
  }

  // Method Mengubah Data
  function update()
  {
    // Mengambil data dari form
    $data = [
      'id'    => $this->input->post('id'),
      'nama'  => $this->input->post('nama'),
      'nim'   => $this->input->post('nim'),
      'kelas' => $this->input->post('kelas'),
    ];

    // Mengambil id dari form
    $id = $this->input->post('id');

    // Mengubah data di database
    $this->Mahasiswa_model->update($id, $data);

    // Set Flashdata untuk menampilkan pesan berhasil dan mengembalikan ke halaman awal
    $this->session->set_flashdata('message', 'Data berhasil diubah');
    redirect('mahasiswa');

  }

  // Method Menghapus Data
  function delete()
  {
    // Menghapus data dari database
    $this->Mahasiswa_model->delete($this->uri->segment(3));

    // Mengembalikan ke halaman awal
    redirect('mahasiswa');
  }

}