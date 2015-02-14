<?php
class Activation extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function artist($uuid = null){
		$this->load->model('artist_model','artist');
		$updated = $this->artist->activate($uuid);
		$this->activateCheck($updated);
	}
	public function fan($uuid = null){
		$this->load->model('fan_model','fan');
		$updated = $this->fan->activate($uuid);
		$this->activateCheck($updated);
	}

	private function activateCheck($updated){
		if ($updated > 0){
			// show activation worked message
			$this->fuel->pages->render('activated');
		} else {
			// show activation failed message
			$this->fuel->pages->render('activation_error');
		}
	}
}
