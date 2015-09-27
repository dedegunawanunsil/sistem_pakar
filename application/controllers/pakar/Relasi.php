<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relasi extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		if(!isset($_SESSION['user_level']) || 
			$_SESSION['user_level'] != 'pakar') redirect();
	}
	function index() {
		$penyakit = $this->db->get('gejala');
		$field = array('nm_gejala'=> 'Nama Gejala');
		$data = $this->load->view('pakar/daftar_penyakit',  
			array('data' => $penyakit, 'field' => $field, 'url' => strtolower(__CLASS__))
		, TRUE);
		$this->load->view('template', array('data'=>$data));
	}
	
}