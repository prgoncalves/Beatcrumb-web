<?php
require_once(FUEL_PATH.'models/base_module_model.php');

class Genre_model extends Base_module_model {

	function __construct()
	{
		parent::__construct('genre');
	}
	function getTracksForGenre($id,$uuid){
		// need to change this so that it gets a flag to see if the track can be played or shared.
		$this->db->select('artist_name,uuid,tracks.id,plays,shares,filename,artist.image,playable');
		$this->db->where('genre',$id);
		$this->db->join('artist','tracks.artist_id = artist.id');
		$this->db->join('user_played','user_played.track_id = tracks.id and user_played.uuid = "' . $uuid . '"','LEFT');
		$data = $this->db->get('tracks')->result();
		return $data;
	}
}

