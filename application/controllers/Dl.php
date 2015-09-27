<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dl extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('simple_dom');
		$this->load->library('snoopy');
	}
	function index() {
		if(!isset($_REQUEST['url'])) {
			redirect();
		}
		else
		{
			$url = $_REQUEST['url'];
			$referer = "http://www.google.com/firefox?client=firefox-a&rls=org.mozilla:fr:official";
			$this->snoopy->agent = "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.18) Gecko/20110614 Firefox/3.6.18";
			$this->snoopy->referer = $referer;
			$this->snoopy->fetch($url);
			
			$html = $this->snoopy->results;
			//$html = @file_get_html($url);
			$html = str_get_html($html);
			if($html) {
				$link = @$html->find('.jsD1PreviewUrl', 0)->value;
				$judul = @$html->find('#d1_trackNameLabel', 0)->plaintext;
				if($link) {
					//var_dump($link);
					//$data = "";
					//var_dump($link);
					$data = $this->load->view('terima_kasih', array('judul' => $judul, 'link' => $link), TRUE);
					$this->load->view('template', array('data'=>$data));
				}
			}
			else
			{
				echo "Mohon maaf ada masalah dengan server<br/>\r\n";
			}
		}
	}
	
}