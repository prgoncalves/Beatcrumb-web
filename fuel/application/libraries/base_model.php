<?php
class base_model extends CI_Model{
	protected $tableName; 
	protected $keyField;
	function __construct(){
		parent::__construct();
	}
	public function delete($id){
		if ($id){
			$this->db->where($this->keyField,$id)->delete($this->tableName);
			return $this->db->affected_rows();
		} else {
			return null;
		}
	}
	public function update($data){
		$keyfield = $this->keyField;
		if (is_array($data)) {
			$keyValue = $data[$keyfield];
		} else {

			$keyValue = $data->$keyfield;			
		}
		$this->db->where($this->keyField,$keyValue);
		$this->db->update($this->tableName,$data);
		if (is_array($data)) {
			return $this->findOneById($data[$keyfield]);
		} else {
			return $this->findOneById($data->$keyfield);
		}
	}
	public function activate($uuid){
		$this->db->where('uuid',$uuid);
		$this->db->set('activated','Yes');
		$this->db->update($this->tableName);
		return $this->db->affected_rows();
	}
	public function create($data){
		$this->db->insert($this->tableName,$data);
		$id =  $this->db->insert_id();
		return $this->findOneById($id);
	}
	public function findOneById($id){
		$result = $this->db->where($this->keyField,$id)->get($this->tableName);
		$data = $result->result();
		if (isset($data) && !empty($data)){
			return $data[0];
		} else {
			return null;
		}
	}
	public function findAll(){
		$result = $this->db->get($this->tableName);
		return $result->result();
	}
	public function find($query){
		$this->db->where($query);
		$result = $this->db->get($this->tableName);
		return $result->result();
	}
	public function findOneByQuery($query){
		$result = $this->find($query);
		return $result[0];
	}
}

class project_model extends base_model{
	public function findAllForProject($projectId){
		$this->db->where('project_id',$projectId);
		$result = $this->db->get($this->tableName);
		return $result->result();			
	}
}
