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
			return 'fan';
		}
		// check if artist
		$artist = $this->db->get_where('artist',array('username'=>$username,'password'=>$password))->result();
		if (isset($artist[0])){
			return 'artist';
		}
		return null;
	}
}