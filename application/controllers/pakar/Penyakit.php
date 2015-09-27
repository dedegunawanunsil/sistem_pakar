<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyakit extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		if(!isset($_SESSION['user_level']) || 
			$_SESSION['user_level'] != 'pakar') redirect();
	}
	function index() {
		$penyakit = $this->db->get('penyakit');
		$field = array('nm_penyakit'=> 'Nama Penyakit');
		$data = $this->load->view('pakar/daftar_penyakit',  
			array('data' => $penyakit, 'field' => $field, 'url' => strtolower(__CLASS__))
		, TRUE);
		$this->load->view('template', array('data'=>$data));
	}
	function detail($id = '') {
		if(trim($id) == '') redirect($_SESSION['user_level']."/".__CLASS__);
		$sql = "SELECT * from penyakit where id=?";
		$penyakit = $this->db->query($sql, array($id));
		$data = $this->load->view('pakar/edit_penyakit',  
			array('url' => @explode("::", __METHOD__)[1], 'data'=> $penyakit->row())
		, TRUE);
		$this->load->view('template', array('data'=>$data));
	}
	function edit($id = '') {
		if(trim($id) == '') redirect($_SESSION['user_level']."/".__CLASS__);
		$config = array(
			array('field' => 'nm_penyakit', 'label' => 'Nama Penyakit', 'rules' => 'required')
		);

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$sql = "SELECT * from penyakit where id=?";
			$penyakit = $this->db->query($sql, array($id));
			$data = $this->load->view('pakar/edit_penyakit',  
				array('url' => @explode("::", __METHOD__)[1], 'data'=> $penyakit->row())
			, TRUE);
			$this->load->view('template', array('data'=>$data));
		}
		else
		{
			
			$sql = "UPDATE  penyakit SET nm_penyakit = ?, nm_latin = ?, definisi = ?, solusi = ? where id=?";
			$param = array($this->input->post('nm_penyakit'), $this->input->post('nm_latin'),$this->input->post('definisi'),$this->input->post('solusi'), $id);
			$input = $this->db->query($sql, $param);
			if ($input) {
				redirect($_SESSION['user_level']."/".strtolower(__CLASS__)."?edit=success");
			} else {
				redirect($_SESSION['user_level']."/".strtolower(__CLASS__)."?edit=fail");
			}
			
		}
		
	}
	function hapus($id = '') {
		if(trim($id) == '') redirect($_SESSION['user_level']."/".__CLASS__);
		
		$delete = $this->db->where('id', $id)->delete('penyakit');
		$del = $this->db->where('kd_penyakit', $id)->delete('relasi');
		if ($delete & $del) {
			$delete = "Berhasil";
		} else {
			$delete = "Gagal";
		}
		
		$data = "Data anda ".$delete." dihapus<br/><a href='".base_url()."pakar/penyakit' >Kembali</a>";
		$this->load->view('template', array('data'=>$data));
	}
	function tambah() {
		$config = array(
			array('field' => 'nm_penyakit', 'label' => 'Nama Penyakit', 'rules' => 'required')
		);

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$data = $this->load->view('pakar/edit_penyakit',  
				array('url' => @explode("::", __METHOD__)[1])
			, TRUE);
			$this->load->view('template', array('data'=>$data));
		}
		else
		{
			
			$sql = "INSERT INTO penyakit (nm_penyakit, nm_latin, definisi, solusi) VALUES (?,?,?,?)";
			$param = array($this->input->post('nm_penyakit'), $this->input->post('nm_latin'),$this->input->post('definisi'),$this->input->post('solusi'));
			$input = $this->db->query($sql, $param);
			if ($input) {
				redirect($_SESSION['user_level']."/".strtolower(__CLASS__)."?tambah=success");
			} else {
				redirect($_SESSION['user_level']."/".strtolower(__CLASS__)."?tambah=fail");
			}
			
		}
	}
}