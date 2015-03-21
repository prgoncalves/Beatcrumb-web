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
					// save to the database too
					$this->db->insert('tracks',array(
						'artist_id'=>$artist->id,
						'filename'=>$file['name']
					));
					$worked = $this->db->affected_rows() > 0;
				}
				return $worked;
			} else {
				return null;
			}
		} else {
			return null;
		}
	}
}
