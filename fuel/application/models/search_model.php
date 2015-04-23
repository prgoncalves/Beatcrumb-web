<?php
require_once(APPPATH.'libraries/base_model.php');
class Search_model extends base_model{
	public function search($criteria){
		// artists
		$this->db->select('uuid');
		$this->db->like('artist_name',$criteria);
		$artists = $this->db->get('artist')->result();
		// tracks
		$this->db->select('artist.uuid,tracks.id');
		$this->db->like('filename',$criteria);
		$this->db->join('artist','artist.id = tracks.artist_id');
		$tracks = $this->db->get('tracks')->result();
		return array(
			'artists'=>$artists,
			'tracks'=>$tracks
		);
	}
}