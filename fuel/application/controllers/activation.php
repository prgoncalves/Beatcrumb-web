<?php
class Activation extends CI_Controller implements iTestCase{
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
	public function contacts($uuid = null){
		if (isset($uuid)){
			$session = array(
				'type'=>'contact',
				'contact_uuid'=>$uuid
			);
			$this->session->set_userdata($session);
			// get the contact
			$this->load->model('contacts_model');
			$contact = $this->contacts_model->findOneByUUID($uuid);
			// render the page if we have a contact
			if (isset($contact)){
				$this->fuel->pages->render('activation_contacts',array('contact'=>$contact));
			} else {
				$this->fuel->pages->render('activation_error');
			}
		} else {
			$this->fuel->pages->render('activation_error');
		}
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
	public function activator(){
		$data = $_POST;
		$data['contact_uuid'] = $this->session->userdata('contact_uuid');
		// activate account
		$this->load->model('user_model','user');
		$this->user->activateContact($data);
	}
	public function memberAlready(){
		$data = $_POST;
		$data['contact_uuid'] = $this->session->userdata('contact_uuid');
		// check account
		$this->load->model('user_model','user');
		$this->user->moveContact($data);
	}
	public function run_tests(){
		echo("<br><h2>Running Tests on Activation Controller</h2>");
	}
}
