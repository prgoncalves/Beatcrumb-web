<?php
require_once(APPPATH.'libraries/base_model.php');
class Fan_model extends base_model{
	public function __construct(){
		$this->tableName = 'fan';
		$this->keyField = 'id';
		parent::__construct();
	}
	public function create($data){
		$bytes = openssl_random_pseudo_bytes(100);
		$hex = bin2hex($bytes);
		$query = array();
		$data->uuid      = $hex;
		$data->activated = 'No';
		if (isset($data->username)){
			$query['username'] = $data->username;
		}
		if (isset($data->email)){
			$query['email'] = $data->email;
			}
		// check if email and username setup
		if (!empty($query)){
			$fan_exists = $this->find($query);
			if (isset($fan_exists[0])){
				return null;
			}			
		}
		$result = parent::create($data);
		$this->load->library('email');
		$message = $this->load->view('emails/FanActivation',array('data'=>$result),TRUE);
		$this->email->initialize(array('mailtype'=>'html'));
		$this->email->from('membership@beatcrumb.com');
		$this->email->to($result->email);
		$this->email->subject("Beatcrumb activation!");
		$this->email->message($message);
		$this->email->send();
// 		echo($this->db->last_query());
		return $result->id;
	}
	public function createForShare($data){
		$bytes = openssl_random_pseudo_bytes(100);
		$hex = bin2hex($bytes);
		$data->uuid      = $hex;
		$data->activated = 'No';
		unset($data->name);
		$result = parent::create($data);
		return $result;		
	}
}
