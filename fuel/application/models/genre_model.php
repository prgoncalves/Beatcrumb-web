<?php
require_once(FUEL_PATH.'models/base_module_model.php');

class Genre_model extends Base_module_model {

	function __construct()
	{
		parent::__construct('genre');
	}
	function getTracksForGenre($id){
		$this->db->where('genre',$id);
		$data = $this->db->get('tracks')->result();
		return $data;
	}
}

