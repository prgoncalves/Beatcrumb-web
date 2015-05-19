<?php
require_once(FUEL_PATH.'models/base_module_model.php');

class Contacts_model extends base_model {

	public function __construct()
	{
		parent::__construct();
		$this->tableName = 'contacts';
		$this->keyField = 'id';
	}
	public function getContactsForUUID(){
		$uuid = $this->session->userdata('uuid');
		if (!empty($uuid)){
			$this->db->where('uuid',$uuid);
			$data = $this->db->get('contacts')->result();
			return $data;
		} else {
			return null;
		}
	} 
	public function findOneByUUID($uuid){
		$this->db->select('id,email,contact_uuid');
		$this->db->where('contact_uuid',$uuid);
		$result = $this->db->get('contacts')->result();
		if (isset($result[0])){
			return $result[0];
		} else {
			return null;
		}
	}
	public function create($data = array()){
		if (!empty($data)){
			$this->db->insert('contacts',$data);
			$id =  $this->db->insert_id();
			return $id;
		} else {
			return null;
		}
	}
}

