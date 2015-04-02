<?php
class Digital extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('leads_model','leads');
	}
	function index(){
		$this->load->view('digital/templates');
	}
}