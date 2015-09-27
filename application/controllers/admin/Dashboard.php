<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		if(!isset($_SESSION['user_level']) || 
			$_SESSION['user_level'] != 'admin') redirect();
	}
	function index() {
		$data = $this->load->view('admin/dashboard',  '', TRUE);
		$this->load->view('template', array('data'=>$data));
	}
}