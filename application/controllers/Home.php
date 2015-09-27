<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}
	function index() {
		if(isset($_SESSION['user_level'])) redirect($_SESSION['user_level']."/dashboard");
		$data = $this->load->view('selamat_datang',  '', TRUE);
		$this->load->view('template', array('data'=>$data));
	}
	function faq() {
		$data = $this->load->view('faq', '', TRUE);
		$this->load->view('template', array('data'=>$data));
	}
	function not_found() {
		$data = $this->load->view('not_found', '', TRUE);
		$this->load->view('template', array('data'=>$data));
	}
	
}