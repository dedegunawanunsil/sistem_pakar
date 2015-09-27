<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyakit extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		
	}
	function index() {
		$data = $this->load->view('daftar_penyakit',  array('user' => 'Deni D'), TRUE);
		$this->load->view('template', array('data'=>$data));
	}
	function pertanyaan() {
		$data = $this->load->view('pertanyaan', '', TRUE);
		$this->load->view('template', array('data'=>$data));
	}
	function analisa() {
		$data = $this->load->view('analisa', '', TRUE);
		$this->load->view('template', array('data'=>$data));
	}
	
}