<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simple_dom {
	protected $_ci;
	function __construct() {
		$this->_ci =& get_instance();
		include_once FCPATH."/simple_html_dom.php";
	}
}