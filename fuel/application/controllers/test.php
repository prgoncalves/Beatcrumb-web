<?php
define('TESTING', true);
class Test extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->libary('unit_test');
	}
	public function test(){
		echo('Testing');
	}
	public function testForgottenPassword(){
		echo("Calling testforgottenpassword");
		$this->load->model('user_model','user');
		echo("Model loaded and about to call function ");
		$result = $this->user->forgottenPassword('freds@freds.com','artist');
		$result = $this->user->forgottenPassword('dave_gill@blueyonder.co.uk','fan');
		echo($result);
	}
	public function getTracks(){
		echo("Loading model");
		$this->load->model('artist_model','artist');
		echo('Calling function to get tracks<br>');
		$result = $this->artist->tracks('41b20af3b53ded6ffed3e7ac39aad0df0af0835d0431b136e980113446c273099117ae5eca768107d1a6783df331c4403a4da08524eb72b6447b6e29181f9f21045f3696852941aa538a74fbe93272d99479f8a9de86bb2f6ece01c850d0e223abbdbfcf');
		foreach($result as $track){
			echo($track->filename);
			echo("<br>");
		}
	}
	public function getContacts(){
		$this->load->model('contacts_model','contacts');
		$result = $this->contacts->getContactsForUUID();
		var_dump($result);
	}
}
