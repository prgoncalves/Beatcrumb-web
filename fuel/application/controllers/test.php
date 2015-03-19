<?php 
define('TESTING', true);
class Test extends CI_Controller{
	function __construct(){
		parent::__construct();
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
}
