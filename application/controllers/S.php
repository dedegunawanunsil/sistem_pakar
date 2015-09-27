<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class S extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		//$this->load->library('simple_dom');
	}
	function index($query, $limit = 1) {
		$query = trim($query);
		$query = trim($query, "%20");
		if($query != '') {
			$data = $this->_cari($query, $limit);
		} else {
			$data = $this->load->view('terpopuler_statis', '', TRUE);
		}
		$data = $this->load->view('home_grabber',  array('data'=>$data), TRUE);
		$this->load->view('template', array('data'=>$data));
	}
	public function _remap($method, $limit = array()) {
		if($method != 'index') {
			if(is_array($limit)) {
				if(count($limit) < 1) {
					$limit = 1;
				} else {
					$limit = $limit[0];
				}
			}
			$this->index($method, $limit);
		}
		else 
		{
			if(is_array($limit)) {
				if(count($limit) < 1) {
					$query = '';
					$limit = 1;
				} else {
					$limit = $limit[0];
				}
			}
			$this->index($query, $limit);
		}
	}
	function _cari($query, $limit) {
		$cont = @file_get_contents("http://search.4shared.com/network/searchXml.jsp?q=".$query."&searchExtention=mp3&sortType=1&sortOrder=1&searchmode=3&start=".(($limit*10)-9) );
		//var_dump($cont);
		if(!$cont) return ("Mohon Maaf anda tidak bisa tersambung ke server, mungkin koneksi anda terputus");
		$xml = new SimpleXMLElement($cont);
		/* Search for <a><b><c> */
		
		$start = (string)$xml->xpath('/search-result/start')[0];
		$end = (string) $xml->xpath('/search-result/files-per-page')[0];
		$total_file = (string) $xml->xpath('/search-result/total-files')[0];
		$pages_total = (string) $xml->xpath('/search-result/pages-total')[0];
		$page_number = (string) $xml->xpath('/search-result/page-number')[0];
		$result_file = $xml->xpath('/search-result/result-files/file');
		$result = array();
		foreach ($result_file as $obj_f) {
			$x = array();
			$x['nama'] = $obj_f->name;
			$x['size'] = $obj_f->size;
			$x['url'] = $obj_f->url;
			$tanggal = $obj_f->{'upload-date'};
			$tanggal = explode(" ",$tanggal);
			$x['tanggal'] = $tanggal[1];
			$x['total_download'] = $obj_f->{'downloads-count'};
			
			
			$result[] = $x;
		}
		if($total_file) {
			
			return $this->load->view('hasil_pencarian', 
				array('start' => $start,
					'end' => $end,
					'total_file' => $total_file,
					'pages_total' => $pages_total,
					'data' => $result,
					'query' => $query,
					'page_number' => $page_number
				)
			, TRUE);
		}
		else
		{
			return $this->load->view('not_found', '', TRUE);
		}
	}
}