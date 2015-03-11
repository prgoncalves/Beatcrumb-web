<?php 
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
		echo($result);
	}
}
