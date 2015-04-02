<?php
require_once(APPPATH.'libraries/base_model.php');
class user_model extends base_model{
	public function __construct(){
		$this->tableName = 'users';
		$this->keyField = 'id';
		parent::__construct();
	}
	public function login($username,$password){
		// check if fan
		$fan = $this->db->get_where('fan',array('username'=>$username,'password'=>$password))->result();
		if (isset($fan[0])){
			return array(
				'type'=>'fan',
				'uuid'=>$fan[0]->uuid
			);
		}
		// check if artist
		$artist = $this->db->get_where('artist',array('username'=>$username,'password'=>$password))->result();
		if (isset($artist[0])){
			return array(
				'type'=>'artist',
				'uuid'=>$artist[0]->uuid,
				'artist_name'=>$artist[0]->artist_name
			);
		}
		return null;
	}
	private function createPassword(){
		$alphabet = "BEATCRUMBPROFORMANCEabcdef!ghi-+jklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$password = array(); 
		$alphaLength = strlen($alphabet) - 1;
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$password[] = $alphabet[$n];
		}
		return implode($password); //turn the array into a string
	}
	private function updatePassword($user,$pass){
		$user->password = md5($pass);
		if (isset($user->artist_name)){
			// update artist
			$this->db->update('artist',$user,array('id'=>$user->id,'email'=>$user->email));
		} else {
			// update fan
			$this->db->update('fan',$user,array('id'=>$user->id,'email'=>$user->email));
		}
	}
	public function forgottenPassword($email,$type = 'fan'){
		// check they exist
		if ($type == 'fan'){
			$user = $this->db->get_where('fan',array('email'=>$email))->result();
		} else {
			$user = $this->db->get_where('artist',array('email'=>$email))->result();
		}
		if (isset($user[0])){
			// if they do then create new password
			$pass = $this->createPassword();
			// update db
			$this->updatePassword($user[0],$pass);
			// email new password to them
			$this->load->library('email');
			$message = $this->load->view('emails/forgottenPassword',array('data'=>$user[0],'password'=>$pass),TRUE);
			if (TESTING){
				var_dump($message);
			}
			$this->email->initialize(array('mailtype'=>'html'));
			$this->email->from('membership@beatcrumb.com');
			$this->email->to($user[0]->email);
			$this->email->subject("Beatcrumb Forgotten password!");
			$this->email->message($message);
			$this->email->send();
			return true;
		} else {
			// if they dont exist return false
			return false;
		}
	}
}
