<?php
class Activation extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function artist($uuid){
		$this->load->model('artist_model','artist');
		$updated = $this->artist->activate($uuid);
		$this->activateCheck($updated);
	}
	public function fan($uuid){
		$this->load->model('fan_model','fan');
		$updated = $this->fan->activate($uuid);
		$this->activateCheck($updated);
	}

	private function activateCheck($updated){
		if ($updated > 0){
			// show activation worked message
			$this->load->view('activated');
		} else {
			// show activation failed message
			$this->load->view('activation_error');
		}
	}
}
