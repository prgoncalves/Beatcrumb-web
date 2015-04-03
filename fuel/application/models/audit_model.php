<?php
class Audit_model extends CI_Model{
	public function log($data){
		$this->db->insert('audit_log',$data);
	}
}