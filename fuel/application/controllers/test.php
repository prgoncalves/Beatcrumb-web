<?php
define('TESTING', true);
class Test extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('unit_test');
	}
	public function testLogin(){
		$this->load->model('user_model','user');
		$result = $this->user->login('s',md5('s'));
		$this->unit->run($result,'is_array','Testing login...');
	}
	public function index(){
		$this->load->model('user_model','user');
		$this->test();
		// Order of these is important.
		$this->testLogin();
		$this->getContacts();
		$this->testForgottenPassword();
		$this->getTracks();
		$this->testArtistCreation();
		echo $this->unit->report();
	}
	public function test(){
		$this->unit->run(true,true,'Just testing the test system!');
	}
	public function testForgottenPassword(){
		$this->load->model('user_model','user');
		$result = $this->user->forgottenPassword('x@x.com','artist');
		$this->unit->run(false,$result,'Testing forgotten password on an account that does not exist');
	}
	public function getTracks(){
		$this->load->model('artist_model','artist');
		$result = $this->artist->tracks('41b20af3b53ded6ffed3e7ac39aad0df0af0835d0431b136e980113446c273099117ae5eca768107d1a6783df331c4403a4da08524eb72b6447b6e29181f9f21045f3696852941aa538a74fbe93272d99479f8a9de86bb2f6ece01c850d0e223abbdbfcf');
		$this->unit->run($result,'is_array','Testing the fetching of tracks!',print_r($result,true));
	}
	public function getContacts(){
		$this->load->model('contacts_model','contacts');
		$result = $this->contacts->getContactsForUUID();
		$this->unit->run($result,'is_array','Testing the fetching of contacts!',print_r($result,true));
	}
	public function testArtistCreation(){
		$this->load->model('artist_model','artist');
		// remove any previous test record
		$this->artist->deleteArtist('dave_gill@blueyonder.co.uk','Belzebub');
		$data = new TestObject();
		$data->username = 'Belzebub';
		$data->artist_name = 'dhasgdhjgsadjg';
		$data->email = 'dave_gill@blueyonder.co.uk';
		$result = $this->artist->create($data);
		$this->unit->run($result,'is_numeric','Create an artist test');
		$this->unit->run($result > 0,true,'Artist ID is > 0');
	}
}

class TestObject{

}