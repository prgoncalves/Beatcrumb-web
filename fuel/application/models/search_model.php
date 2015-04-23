<?php
require_once(APPPATH.'libraries/base_model.php');
class Search_model extends base_model{
	public function search($data){
		// artists
		$this->db->select('uuid');
		$this->db->like('artist_name',$data['criteria']);
		$artists = $this->db->get('artist')->result();
		// tracks
		$this->db->select('artist.uuid,tracks.id');
		$this->db->like('filename',$data['criteria']);
		$this->db->join('artist','artist.id = tracks.artist_id');
		$tracks = $this->db->get('tracks')->result();
		return array(
			'artists'=>$artists,
			'tracks'=>$tracks
		);
	}
}