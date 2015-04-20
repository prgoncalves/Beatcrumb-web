<?php
require_once(FUEL_PATH.'models/base_module_model.php');

class Contacts_model extends Base_module_model {

	public function __construct()
	{
		parent::__construct('contacts');
	}
	public function getContactsForUUID(){
		$uuid = $this->session->userdata('uuid');
		$this->db->where('uuid',$uuid);
		$data = $this->db->get('contacts')->result();
		return $data;
	} 
}

