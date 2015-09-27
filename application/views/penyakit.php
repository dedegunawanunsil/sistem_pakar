<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsultasi extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		<div style="margin-top:10px;">
	<form action="#" method="post" class="jumbotron"  style="padding:40px !important;">
		<div class="row">
			<div class="col-md-8">			
				<div class="form-group">
					Apakah Sapi anda mengalami gejala <b>Nama Gejalanya Apa</b> ?
				</div>
			</div>
			<div class="col-md-2">
				<input type="radio" name="pilihan" value="ya">Ya
			</div>
			<div class="col-md-2">
				<input type="radio" name="pilihan" value="tidak">Tidak
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				<button type="submit" name="submit" class="btn btn-danger">Lanjut</button>
			</div>
		</div>
	</form>
</div>
	}
	function index() {
		$data = $this->load->view('isi_dulu',  array('user' => 'Deni D'), TRUE);
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