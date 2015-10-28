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
		$penyakit = $this->db->select('id, nm_penyakit')->get('penyakit');
		$data = $this->load->view('pakar/relasi',  
			array('penyakit' => $penyakit->result())
		, TRUE);
		$this->load->view('template', array('data'=>$data));
	}
	function _get_gejala_linked($id_penyakit = '') {
		$gejala = array();
		if (trim($id_penyakit) != '') {
			$gej = $this->db->select('g.*')->from('gejala g')
				->join('relasi r', 'g.id = r.kd_gejala AND r.kd_penyakit = "'.$id_penyakit.'"')->get();
			$gejala = $gej->result_array();
		}
		foreach ($gejala as $value) {
			printf("<li data-id='%s' draggable='true' >%s</li>\n", $value['id'], $value['nm_gejala']);
		}
		
	}
	function _get_gejala_not_linked($id_penyakit = '') {
		$gejala = array();
		if (trim($id_penyakit) != '') {
			$sql = "SELECT * FROM gejala WHERE  id NOT IN (SELECT kd_gejala FROM relasi WHERE kd_penyakit = ?)";
			$gej = $this->db->query($sql, array($id_penyakit));
			$gejala = $gej->result_array();
		}
		foreach ($gejala as $value) {
			printf("<li data-id='%s'  draggable='true'>%s</li>\n", $value['id'], $value['nm_gejala']);
		}
		
	}
	function get_table($id_penyakit = '') {
		if (trim($id_penyakit) != '') {
			echo '<div class="left col-md-6">
                Gejala yang terikat: 
                <ul class="target connected">';
            echo $this->_get_gejala_linked($id_penyakit);
            echo '    </ul>
            </div>
            <div class="right  col-md-6">
                Gejala yang tidak terikat : 
                <ul class="source connected">';
            echo $this->_get_gejala_not_linked($id_penyakit);
            echo '    </ul>
            </div>';
		}

	}
	function update_relasi($id_penyakit = '') {
		if (trim($id_penyakit) != '' && isset($_POST['data'])) {
			$id_penyakit = (int) $id_penyakit;
			$s = json_decode($_REQUEST['data']);
			$data = array();
			foreach ($s as $value) {
				$data[] = (int) $value;
			}
			$delete = $this->db->where('kd_penyakit', $id_penyakit)->where_not_in('kd_gejala', $data)->delete('relasi');
			$gej = $this->db->select('kd_gejala')
				->where('kd_penyakit', $id_penyakit)
				->get('relasi');
			$gej = $gej->result();
			foreach ($gej as $value) {
				$gejala[] = $value->kd_gejala;
			}
			$new = array();
			foreach ($data as $value) {
				if (!in_array($value, $gejala)) {
					$new[] = "( $id_penyakit, $value )";
				}
			}
			$insert = $this->db->query("INSERT INTO relasi (kd_penyakit, kd_gejala) VALUES ". implode(", ", $new));
		}
	}
}