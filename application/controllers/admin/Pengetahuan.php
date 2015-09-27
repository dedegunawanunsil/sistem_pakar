<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengetahuan extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		if(!isset($_SESSION['user_level']) || 
			$_SESSION['user_level'] != 'admin') redirect();
		
	}
	function index() {

		$data = $this->load->view('admin/pengetahuan',  
			array('data' => $this->_mapping_gejala_())
		, TRUE);
		$this->load->view('template', array('data'=>$data));
	}
	function _mapping_gejala_()
	{
		$penyakit = array(
			'used' => array(),
			'unused' => array()
		);
		$gejala = array(
			'used' => array(),
			'unused' => array()
		);
		$sql = "SELECT *, IF(id IN (SELECT kd_penyakit FROM relasi GROUP BY kd_penyakit), '1', '0') AS aya FROM penyakit";
		$_data_penyakit = $this->db->query($sql)->result();
		foreach ($_data_penyakit as $value) {
			if ($value->aya != '1') {
				$penyakit['unused'][$value->id] = $value;
			} else {
				$penyakit['used'][$value->id] = $value; 

			}
			
		}
		$sql = "SELECT gejala.*, IF(relasi.kd_penyakit IS NOT NULL, relasi.kd_penyakit, '0') AS aya FROM gejala left outer join relasi on gejala.id = relasi.kd_gejala ";
		$_data_gejala = $this->db->query($sql)->result();
		foreach ($_data_gejala as $value) {
			if (!$value->aya) {
				$gejala['unused'][$value->id] = $value;
			} else {
				$gejala['used'][$value->aya][$value->id] = $value; 

			}			
		}
		return array('penyakit'=> $penyakit, 'gejala'=> $gejala);
	}
}