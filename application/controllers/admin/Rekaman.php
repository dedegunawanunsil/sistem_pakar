<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekaman extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		if(!isset($_SESSION['user_level']) || 
			$_SESSION['user_level'] != 'admin') redirect();
		$this->field = array('nama_pemilik'=> 'Nama Pemilik', 'nm_penyakit' => "Nama Penyakit", 'usia' => "Usia Sapi (bln)");
	}
	function index()
	{
		$sql = "SELECT ah.id, ah.usia, ah.`nama_pemilik`, p.`nm_penyakit`  FROM analisa_hasil ah LEFT OUTER JOIN penyakit p ON ah.`kd_penyakit` = p.`id`";
		$users = $this->db->query($sql);
		$filter = array(
			'detail' => array(),
			'edit' => array('all', ),
			'hapus' => array(),
		);
		$data = $this->load->view('admin/rekaman',  
			array('data' => $users, 'field' => $this->field, 'url' => strtolower(__CLASS__), 'filter' => $filter)
		, TRUE);
		$this->load->view('template', array('data'=>$data));
	}
	function detail($id = '') 
	{
		if (trim($id) == '') {
			redirect('admin/pakar?detail=fail');
		}
		$sql = "CALL getDetailRekaman($id)";
		$users = $this->db->query($sql);
		$data = $this->load->view('admin/rekaman_d',  
			array('data' => $users->row(), 'field' => $this->field, 'url' => strtolower(__CLASS__))
		, TRUE);
		$this->load->view('template', array('data'=>$data));
	}
	function hapus($id = '') 
	{
		if (trim($id) == '') {
			redirect('admin/pakar?edit=fail');
		}
		else
		{
			$sql = "delete from analisa_hasil where id=?";
			$input = $this->db->query($sql, array($id));
			if ($input) {
				redirect('admin/rekaman?hapus=success');
			} else {
				redirect('admin/rekaman?hapus=fail');
			}
				
		}

	}
}