<?php
require_once(FUEL_PATH.'models/base_module_model.php');

class Genre_model extends Base_module_model {

	function __construct()
	{
		parent::__construct('genre');
	}
	function getTracksForGenre($id,$uuid){
		// need to change this so that it gets a flag to see if the track can be played or shared.
		$this->db->select('artist_name,artist.uuid,tracks.id,tracks.plays,IFNULL(user_played.plays,0) as played,tracks.shares,filename,artist.image,IFNULL(playable,"yes") as playable',false);
		if ($id > 0){
			$this->db->where('genre',$id);
		} else {
			$this->db->where('genre is null');
		}
		$this->db->join('artist','tracks.artist_id = artist.id');
		$this->db->join('user_played','user_played.track_id = tracks.id and user_played.uuid = "' . $uuid . '"','LEFT');
		$data = $this->db->get('tracks')->result();
		return $data;
	}
}

