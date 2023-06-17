<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_buku extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('username')) {
			echo "<script language=javascript>
				alert('Anda tidak berhak mengakses halaman ini!');
				window.location='" . base_url('login') . "';
				</script>";
		}
	}
	public function index()
	{
		$data['listing'] = $this->db->get('jenis_buku')->result();
		$this->load->view('jenis_buku_view', $data);
	}

	public function simpan()
	{
		$data = array('nama_buku' => 'Media Informasi 2010', 'penerbit' => 'Gautama');
		$this->db->insert('jenis_buku', $data);
	}

	public function store()
	{
		$this->load->view('jenis_buku_store');
	}

	public function save()
	{
		$data = array("jenis_buku" => $this->input->post('jenis_buku'));
		$store = $this->db->insert('jenis_buku', $data);
		if ($store) {
			redirect('jenis_buku');
		}
	}

	public function hapus()
	{
		$id = $this->uri->segment(3);
		$del = $this->db->delete('jenis_buku', array('id' => $id));
		if ($del) {
			redirect('jenis_buku');
		}
	}

	public function ubah()
	{
		$id = $this->uri->segment(3);
		$data['fetch'] = $this->db->get_where('jenis_buku', array('id' => $id))->row();
		$this->load->view('jenis_buku_edit', $data);
	}

	public function saveubah()
	{
		$id = $this->input->post('id');
		$data = array("jenis_buku" => $this->input->post('jenis_buku') );
		$ubah = $this->db->where('id', $id)->update('jenis_buku', $data);
		if ($ubah) {
			redirect('jenis_buku');
		}
	}
}
