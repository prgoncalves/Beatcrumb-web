<?php
require_once(APPPATH.'libraries/base_model.php');
class Artist_model extends base_model{
	public function __construct(){
		$this->tableName = 'artist';
		$this->keyField = 'id';
		parent::__construct();
	}
	public function create($data){
// 		var_dump($data);
		$query = array();
		if (is_array($data)){
			if (isset($data['username'])){
				$query['username'] = $data['username'];
			}
			if (isset($data['email'])){
				$query['email'] = $data['email'];
			}
		} else if (is_object($data)){
			if (isset($data->username)){
				$query['username'] = $data->username;
			}
			if (isset($data->email)){
				$query['email'] = $data->email;
			}
		}
		if (!empty($query)){
			$artist_exists = $this->find($query);
			if (isset($artist_exists[0])){
				var_dump($artist_exists[0]);
				return $artist_exists[0]->id;
			}			
		}
		$result = parent::create($data);
// 		echo($this->db->last_query());
		return $result->id;
	}
}
