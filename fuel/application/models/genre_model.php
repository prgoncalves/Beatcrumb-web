<?php
require_once(FUEL_PATH.'models/base_module_model.php');

class Genre_model extends Base_module_model {

	function __construct()
	{
		parent::__construct('genre');
	}
	function getTracksForGenre($id){
		$this->db->select('artist_name,uuid,tracks.id,plays,shares,filename,artist.image');
		$this->db->where('genre',$id);
		$this->db->join('artist','tracks.artist_id = artist.id');
		$data = $this->db->get('tracks')->result();
		return $data;
	}
}

