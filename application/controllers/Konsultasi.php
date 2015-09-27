<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsultasi extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
	}
	function index() {
		
		$jenis_sapi = $this->db->get('jenis_sapi')->result();
		$varietas_sapi = $this->db->get('varietas_sapi')->result();
		$config = array(
			array('field' => 'nama_pemilik', 'label' => 'Nama Pemilik', 'rules' => 'required'),
			array('field' => 'jenis_sapi', 'label' => 'Jenis Sapi', 'rules' => 'required'),
			array('field' => 'varietas_sapi', 'label' => 'Varietas Sapi', 'rules' => 'required'),
			array('field' => 'kelamin_sapi', 'label' => 'Kelamin Sapi', 'rules' => 'required'),
			array('field' => 'usia', 'label' => 'Usia', 'rules' => 'required|integer'),
			array('field' => 'lokasi_pemeliharaan', 'label' => 'Lokasi Pemeliharaan', 'rules' => 'required'),
			array('field' => 'session_id_valid_requiered', 'label' => 'Session Valid', 'rules' => 'callback_check_session_id_valid'),
		);

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			if (isset($_SESSION['session_id_valid'])) {
				unset($_SESSION['session_id_valid']);
			}
			if (isset($_SESSION['start_konsultasi'])) {
				unset($_SESSION['start_konsultasi']);
			}
			$_SESSION['session_id_valid'] = md5(time().time());
			$data = $this->load->view('isi_dulu',  
				array('jenis_sapi' => $jenis_sapi, 
					'varietas_sapi' => $varietas_sapi, 'session_id_valid' => $_SESSION['session_id_valid'])
			, TRUE);
			$this->load->view('template', array('data'=>$data));
		} else {
			$sql = "INSERT INTO tmp_pasien(nama_pemilik, kelamin_sapi, varietas_sapi, jenis_sapi, usia, lokasi, session_id, tanggal) values (?, ?, ?, ?, ?, ?, ?, ?)";
			$status = $this->db->query($sql, array(@$_POST['nama_pemilik'], @$_POST['kelamin_sapi'], @$_POST['varietas_sapi'], @$_POST['jenis_sapi'], @$_POST['usia'], @$_POST['lokasi_pemeliharaan'], @$_POST['session_id_valid_requiered'], date("Y-m-d H:i:s"))
			);
			if($status) {
				redirect('konsultasi/pertanyaan');
			}
		}
		
	}
	function pertanyaan() {
		if (!isset($_SESSION['session_id_valid'])) {
			redirect('konsultasi');
		}

		//Susun algoritma disini 
		/*
		1. Init & Cek Apakah sudah dimulai 
			Masukkan relasi ke tmp_relasi
		*/
		if (!isset($_SESSION['start_konsultasi'])) {
			$_SESSION['start_konsultasi'] = md5(rand().time());
			$sql = "INSERT INTO tmp_relasi SELECT *, ? as session_id from relasi";
			$this->db->query($sql, array($_SESSION['session_id_valid']));
		} else {
			# code...
		}
		
		/*
		2. Ambil gejala secara terurut dari yang paling banyak muncul
			Jika tidak ada gejala selesai perulangan dan ambil penyakit terakhir sebagai hasil
		*/
		$sql = "SELECT kd_gejala from tmp_relasi where session_id = ? group by kd_gejala order by count(kd_gejala) desc";
		$gejala = $this->db->query($sql, array($_SESSION['session_id_valid']));
		if (!$gejala->num_rows()) {
			$sql = "SELECT kd_penyakit from tmp_analisa where session_id = ? order by id desc limit 1";
			$gejala = $this->db->query($sql, array($_SESSION['session_id_valid']))->row();
			unset($_SESSION['start_konsultasi']);
			if(@is_object($gejala)) {
				$_SESSION['hasil_konsultasi'] = $gejala->kd_penyakit;
			}
			else
			{
				$_SESSION['hasil_konsultasi'] = "0";
			}
			//var_dump($gejala);
			redirect('konsultasi/analisa'); 
		} else {
			$gejala = $gejala->row();
			$gejala = $gejala->kd_gejala;
			$sql = "SELECT * from gejala where id=?";
			$gejala = $this->db->query($sql, array($gejala))->row();

		}
		
		/*
		3. Tanyakan
			Jika benar, hapus penyakit yang tidak mengandung gejala
			Jika salah, hapus penyakit yang mengandung gejala
			Jangan lupa, hapus pertanyaan
		*/
		$data = $this->load->view('pertanyaan', 
			array('gejala'=> $gejala)
		, TRUE);
		$this->load->view('template', array('data'=>$data));
		

		
	}
	function act_pertanyaan() {
		if (!isset($_SESSION['start_konsultasi']) 
			|| isset($_SESSION['hasil_konsultasi'])
		) {
			exit(json_encode(array('url' => "fail", 'baris' => __LINE__)));
		}

		/*
		3. Tanyakan
			Jika benar, hapus penyakit yang tidak mengandung gejala
			Jika salah, hapus penyakit yang mengandung gejala
			Jangan lupa, hapus pertanyaan
		*/
		$config = array(
			array('field' => 'kd_gejala', 'label' => 'Kode Gejala', 'rules' => 'required'),
			array('field' => 'pilihan', 'label' => 'Pilihan', 'rules' => 'required')
		);

		$this->form_validation->set_rules($config);
		if ($this->form_validation->run()) {
			$gejala = $this->input->post('kd_gejala');
			$pilihan = $this->input->post('pilihan');
			$sql = "SELECT kd_penyakit from tmp_relasi where kd_gejala = ? and session_id = ? group by kd_penyakit";
			$kd_penyakit_arr = $this->db->query($sql, array($gejala, $_SESSION['session_id_valid']))->result();
			$kd_penyakit_arr_ = array();
			foreach ($kd_penyakit_arr as $value) {
				$kd_penyakit_arr_[] = (int) $value->kd_penyakit;
			}
			$kd_penyakit_arr = "(".implode(", ", $kd_penyakit_arr_).")";
			if ($pilihan == 'ya') {
				$sql = "DELETE FROM tmp_relasi where session_id = ? AND (kd_penyakit NOT IN $kd_penyakit_arr OR kd_gejala = ?)";
				$status = "Y";
			} else {
				$sql = "DELETE FROM tmp_relasi where session_id = ? AND (kd_penyakit IN $kd_penyakit_arr OR kd_gejala = ?)";
				$status = "N";
			}
			$return = $this->db->query($sql, array($_SESSION['session_id_valid'], $gejala));
		
			/*
			4. Ambil Penyakit 
				Jika ada masukkan ke tabel analisa sementara
				Jika tidak ada, selesai perulangan dan tidak ada penyakit di database
			*/
			$sql = "SELECT kd_penyakit from tmp_relasi where session_id = ? GROUP BY kd_penyakit";
			$penyakit = $this->db->query($sql, array($_SESSION['session_id_valid']));
			if ($penyakit->num_rows() ) {
				$penyakit = $penyakit->result();
				$penyakit_arr = array();
				foreach ($penyakit as $_penyakit) {
					$penyakit_arr[] = (int) $_penyakit->kd_penyakit;
				}
				$sql = "INSERT INTO tmp_analisa (session_id, kd_penyakit, kd_gejala, status) values (?,?,?,?)";
				$this->db->query($sql, array($_SESSION['session_id_valid'], json_encode($penyakit_arr), $gejala, $status));
				//Message if success
				//redirect('konsultasi/pertanyaan');
				echo json_encode(array('url' => base_url()."konsultasi/pertanyaan"));
			} else {
				unset($_SESSION['start_konsultasi']);
				if ($status == 'Y') {
					$sql = "SELECT kd_penyakit from tmp_analisa where session_id = ? order by id desc limit 1";
					$gejala = $this->db->query($sql, array($_SESSION['session_id_valid']))->row();
					$_SESSION['hasil_konsultasi'] = json_decode($gejala->kd_penyakit)[0];
				} else {
					$_SESSION['hasil_konsultasi'] = "0";
					
				}
				
				//redirect('konsultasi/analisa');
				echo json_encode(array('url' => base_url()."konsultasi/analisa")); 
			}
		} else {
			echo json_encode(array('url' => "fail"));
		}
		
	}
	function analisa() {
		if (!isset($_SESSION['session_id_valid'])
			|| !isset($_SESSION['hasil_konsultasi'])
		) {
			redirect('home');
		}
		$penyakit = $_SESSION['hasil_konsultasi'];
		$sql = "INSERT INTO analisa_hasil(nama_pemilik, kelamin_sapi,  varietas_sapi, jenis_sapi, usia, lokasi, session_id, tanggal, kd_penyakit) SELECT nama_pemilik, kelamin_sapi,  varietas_sapi, jenis_sapi, usia, lokasi, session_id, tanggal, ? AS kd_penyakit FROM tmp_pasien WHERE session_id = ? AND session_id not in ( select session_id from analisa_hasil)";
		$this->db->query($sql, array($penyakit, $_SESSION['session_id_valid']));
		$sql = "SELECT id from analisa_hasil where session_id = ?";
		$id = @$this->db->query($sql, array($_SESSION['session_id_valid']))->row()->id;
		if(!$id) {
			redirect('konsultasi/delete');
		}
		$data = $this->db->query("CALL getDetailRekaman(?)", array($id))->row();
		mysqli_next_result($this->db->conn_id);
		if ($data->kd_penyakit) {
			$gejala = $this->db->query("SELECT `gejala`.* FROM `gejala`  JOIN `relasi` ON `gejala`.`id` = `relasi`.`kd_gejala` AND `relasi`.`kd_penyakit` = '{$data->kd_penyakit}'")->result();
			$data = $this->load->view('analisa', 
				array('data' => $data, 'gejala' => $gejala)
			, TRUE);
		} else {
			$data = $this->load->view('analisa_gagal', 
				array('data' => $data)
			, TRUE);
		}
		
		$this->load->view('template', array('data'=>$data));
	}
	function delete() {
		if (isset($_SESSION['session_id_valid'])) {
			$sql = "delete from tmp_relasi where session_id = ?";
			$this->db->query($sql, array($_SESSION['session_id_valid']));
			$sql = "delete from tmp_pasien where session_id = ?";
			$this->db->query($sql, array($_SESSION['session_id_valid']));
			unset($_SESSION['session_id_valid']);
		}
		unset($_SESSION['hasil_konsultasi']);
		unset($_SESSION['start_konsultasi']);

		redirect('home');
	}
	function check_session_id_valid($str) {
		if ($str == $_SESSION['session_id_valid']) {
			return true;
		}
		else
		{
			return false;
		}
	}
	
}