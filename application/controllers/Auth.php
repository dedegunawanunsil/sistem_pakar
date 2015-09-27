<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
	}
	function index() {
		
	}
	function login() {
		//filtering access
		if (
			isset($_SESSION['user_level'])
		) {
			redirect($_SESSION['user_level'].'/dashboard');
		}
		$config = array(
			array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email'),
			array('field' => 'password', 'label' => 'password', 'rules' => 'required'),
		);
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() == FALSE 
		//Other Login Rule
		
		//-- 
		) {
			$data = $this->load->view('login', '', TRUE);
			$this->load->view('template', array('data'=>$data));
		}
		else
		{
			$sql = "select * from users where user_nama = ?";
			$email = $this->db->query($sql, array($_POST['email']));
			if ($email->num_rows()) {
				$_email = $email->row();
				if (!password_verify($_POST['password'], $_email->user_password)) {
					redirect("auth/login?fail=password");
				}
				else 
				{
					$_SESSION['user_id'] = $_email->id;
					$_SESSION['user_nama'] = $_email->user_nama;
					$_SESSION['user_level'] = $_email->user_level;
					redirect($_email->user_level.'/dashboard');
				}
			} else {
				redirect("auth/login?fail=email");
			}
			redirect('auth/login');
		}
	}
	function logout() {
		session_destroy();
		redirect('auth/login');
	}
}