<?php
class Activation extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function artist($uuid){
		$this->load->model('artist_model','artist');
		$updated = $this->artist->activate($uuid);
		if ($updated > 0){
			// show activation worked message
		} else {
			// show activation failed message
		}		
	}
	function fan($uuid){
		$this->load->model('fan_model','fan');
		$updated = $this->fan->activate($uuid);
		if ($updated > 0){
			// show activation worked message
		} else {
			// show activation failed message
		}
	}
}
