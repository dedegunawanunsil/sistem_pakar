<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pakar extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		if(!isset($_SESSION['user_level']) || 
			$_SESSION['user_level'] != 'admin') redirect();
		$this->field = array('user_nama'=> 'User Name', 'user_level' => "Level");
		
	}
	function index() {
		$users = $this->db->get('users');
		$filter = array(
			'detail' => array(),
			'edit' => array('1', ),
			'hapus' => array('1', '2'),
		);
		$data = $this->load->view('pakar/daftar_penyakit',  
			array('data' => $users, 'field' => $this->field, 'url' => strtolower(__CLASS__), 'filter' => $filter)
		, TRUE);
		$this->load->view('template', array('data'=>$data));
	}
	function tambah()
	{
		$config = array(
			array('field' => 'user_nama', 'label' => 'Email', 'rules' => 'required|is_unique[users.user_nama]'),
			array('field' => 'user_level', 'label' => 'Level User', 'rules' => 'required'),
			array('field' => 'user_password', 'label' => 'Password', 'rules' => 'required'),
			array('field' => 'confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[user_password]'),
		);

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$data = $this->load->view('admin/pakar',''
			, TRUE);
			$this->load->view('template', array('data'=>$data));
		}
		else
		{
			$sql = "INSERT INTO users (user_nama, user_password, user_level) values (?, ?, ?)";
			$input = $this->db->query($sql, array($_POST['user_nama'], password_hash($_POST['user_password'], PASSWORD_BCRYPT), $_POST['user_level']));
			if ($input) {
				redirect('admin/pakar?input=success');
			} else {
				redirect('admin/pakar?input=fail');
			}
			
		}
	}
	function detail($id = '') 
	{
		if (trim($id) == '') {
			redirect('admin/pakar?detail=fail');
		}
		$users = $this->db->where('id', $id)->get('users')->row();
		$data = $this->load->view('admin/pakar_de',  
			array('data' => $users, 'field' => $this->field, 'url' => strtolower("detail"))
		, TRUE);
		$this->load->view('template', array('data'=>$data));
	}
	function edit($id = '') 
	{
		if (trim($id) == '') {
			redirect('admin/pakar?edit=fail');
		}
		$config = array(
			array('field' => 'user_nama', 'label' => 'Email', 'rules' => 'required'),
			array('field' => 'user_level', 'label' => 'Level User', 'rules' => 'required'),
			array('field' => 'confirm_password', 'label' => 'Confirm Password', 'rules' => 'matches[user_password]'),
		);

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$users = $this->db->where('id', $id)->get('users')->row();
			$data = $this->load->view('admin/pakar_de',  
				array('data' => $users, 'field' => $this->field, 'url' => strtolower("edit"))
			, TRUE);
			$this->load->view('template', array('data'=>$data));
		}
		else
		{
			if (trim($_POST['user_password']) != '') {
				$sql = "update users set user_password = ?, user_level = ? where user_nama = ?";
				$param = array(password_hash($_POST['user_password'], PASSWORD_BCRYPT), $_POST['user_level'], $_POST['user_nama']);
			} else {
				$sql = "update users set user_level = ? where user_nama = ?";
				$param = array($_POST['user_level'], $_POST['user_nama']);
			}
			$input = $this->db->query($sql, $param);
			if ($input) {
				redirect('admin/pakar?edit=success');
			} else {
				redirect('admin/pakar?edit=fail');
			}
			
		}		
	}
	function hapus($id = '') 
	{
		if (trim($id) == '') {
			redirect('admin/pakar?edit=fail');
		}
		else
		{
			$sql = "delete from users where id=?";
			$input = $this->db->query($sql, array($id));
			if ($input) {
				redirect('admin/pakar?hapus=success');
			} else {
				redirect('admin/pakar?hapus=fail');
			}
				
		}

	}
}