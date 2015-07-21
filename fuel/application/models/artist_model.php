<?php
require_once(APPPATH.'libraries/base_model.php');
class Artist_model extends base_model{
	public function __construct(){
		$this->tableName = 'artist';
		$this->keyField = 'id';
		parent::__construct();
	}
	public function create($data){
		$bytes = openssl_random_pseudo_bytes(100);
		$hex = bin2hex($bytes);
		$query = array();
		$data->uuid      = $hex;
		$data->activated = 'No';
		if (isset($data->username)){
			$query['username'] = $data->username;
		}
		if (isset($data->email)){
			$query['email'] = $data->email;
			}
		// check if email and username setup
		if (!empty($query)){
			$artist_exists = $this->find($query);
			if (isset($artist_exists[0])){
//				var_dump($artist_exists[0]);
				return null;
			}
		}
		// check if artist name used
		if (isset($data->artist_name)){
			$artist_exists = $this->find(array('artist_name'=>$data->artist_name));
			if (isset($artist_exists[0])){
				return null;
			}
		}
		$result = parent::create($data);
		$this->load->library('email');
		$message = $this->load->view('emails/ArtistActivation',array('data'=>$result),TRUE);
		$this->email->initialize(array('mailtype'=>'html'));
		$this->email->from('membership@beatcrumb.com');
		$this->email->to($result->email);
		$this->email->subject("Beatcrumb activation!");
		$this->email->message($message);
		$this->email->send();
// 		echo($this->db->last_query());
		return $result->id;
	}
	public function upload($data){
		$result = $this->db->get_where('artist',array('uuid'=>$data['uuid']))->result();
		if ($result[0]){
			$artist = $result[0];
			$file = $_FILES['track'];
			$destination = ASSETS_FOLDER.'artists/'.$artist->id;
			if (file_exists($destination)){
				if (!is_dir($destination)){
					$worked = false;
				} else {
					$worked = true;
				}
			} else {
				// create it
				$worked = mkdir($destination,0755,true);
			}
			if ($worked){
				$worked = move_uploaded_file($file['tmp_name'], $destination . '/'. $file['name']);
				if ($worked){
					// put the data together
					$record = array(
						'artist_id'=>$artist->id,
						'filename'=>$file['name'],
					);
					// check if already in the db
					$result = $this->db->get_where('tracks',$record)->result();
					if (isset($result[0])){
						$worked = false;
					} else {
						// save to the database too
						$record['genre']=$data['genre'];
						$this->db->insert('tracks',$record);
						$worked = $this->db->affected_rows() > 0;
					}
				}
				return $worked;
			} else {
				return null;
			}
		} else {
			return null;
		}
	}
	public function tracks($uuid){
		$artists = $this->db->get_where('artist',array('uuid'=>$uuid))->result();
		if (isset($artists[0])){
			$artist = $artists[0];
			$results = $this->db->get_where('tracks',array('artist_id'=>$artist->id))->result();
			return $results;
		} else {
			return null;
		}
	}
	public function getArtistTrack($uuid,$filename){
		$this->db->select('artist.id');
		$this->db->where('artist.uuid',$uuid);
		$this->db->where('filename',$filename);
		$this->db->join('tracks','artist.id = tracks.artist_id');
		$result = $this->db->get('artist')->result();
		return $result;
	}
	public function deleteArtist($email,$username){
		$this->db->where('email',$email);
		$this->db->where('username',$username);
		$this->db->delete('artist');
	}
}
