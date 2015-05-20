<?php
require_once(APPPATH.'libraries/base_model.php');
class user_model extends base_model{
	public function __construct(){
		$this->tableName = 'users';
		$this->keyField = 'id';
		parent::__construct();
	}
	public function login($username,$password){
		// check if fan
		$fan = $this->db->get_where('fan',array('username'=>$username,'password'=>$password))->result();
		if (isset($fan[0])){
			$session = array(
				'type'=>'fan',
				'uuid'=>$fan[0]->uuid
			);
			$this->session->set_userdata($session);
			return array('type'=>'fan'); 
		}
		// check if artist
		$artist = $this->db->get_where('artist',array('username'=>$username,'password'=>$password))->result();
		if (isset($artist[0])){
			$session = array(
					'type'=>'artist',
					'uuid'=>$artist[0]->uuid,
					'artist_name'=>$artist[0]->artist_name,
			);
			$this->session->set_userdata($session);
			return array(
				'type'=>'artist',
				'artist_name'=>$artist[0]->artist_name,
				'email'=>$artist[0]->email,
				'image'=>$artist[0]->image,
			);
		}
		return null;
	}
	public function logout($uuid){
		$this->session->sess_destroy();
	}
	private function createPassword(){
		$alphabet = "BEATCRUMBPROFORMANCEabcdef!ghi-+jklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$password = array(); 
		$alphaLength = strlen($alphabet) - 1;
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$password[] = $alphabet[$n];
		}
		return implode($password); //turn the array into a string
	}
	private function updatePassword($user,$pass){
		$user->password = md5($pass);
		if (isset($user->artist_name)){
			// update artist
			$this->db->update('artist',$user,array('id'=>$user->id,'email'=>$user->email));
		} else {
			// update fan
			$this->db->update('fan',$user,array('id'=>$user->id,'email'=>$user->email));
		}
	}
	public function forgottenPassword($email,$type = 'fan'){
		// check they exist
		if ($type == 'fan'){
			$user = $this->db->get_where('fan',array('email'=>$email))->result();
		} else {
			$user = $this->db->get_where('artist',array('email'=>$email))->result();
		}
		if (isset($user[0])){
			// if they do then create new password
			$pass = $this->createPassword();
			// update db
			$this->updatePassword($user[0],$pass);
			// email new password to them
			$this->load->library('email');
			$message = $this->load->view('emails/forgottenPassword',array('data'=>$user[0],'password'=>$pass),TRUE);
			$this->email->initialize(array('mailtype'=>'html'));
			$this->email->from('membership@beatcrumb.com');
			$this->email->to($user[0]->email);
			$this->email->subject("Beatcrumb Forgotten password!");
			$this->email->message($message);
			$this->email->send();
			return true;
		} else {
			// if they dont exist return false
			return false;
		}
	}
	public function settings($data){
		$uuid = $data['uuid'];
		$settings = null;
		if (isset($uuid) && !empty($uuid)){
			// check if fan or artist
			$artist = $this->db->get_where('artist',array('uuid'=>$uuid))->result();
			$fan = $this->db->get_where('fan',array('uuid'=>$uuid))->result();
			if (isset($artist[0])){
				$this->db->select('artist_name,email');
				$this->db->where('uuid',$uuid);
				$settings=$this->db->get('artist')->result();
				$partFolder = 'profiles/'.$artist[0]->id;
			}
			if (isset($fan[0])){
				$this->db->select('email');
				$this->db->where('uuid',$uuid);
				$settings=$this->db->get('fan')->result();
				$partFolder = 'fan/'.$fan[0]->id;
			}
			// check if we have an image file
			if (isset($_FILES['image'])){
				$file = $_FILES['image'];
			}
			if (isset($file)){
				$destination = ASSETS_FOLDER.$partFolder;
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
					// update the database.
					$data['image'] = $partFolder.'/'.$file['name'];					
				}
			}
			// check if posting
			if (isset($artist[0]) && isset($data['artist_name'])){
				// update artist and email
				$this->db->where('uuid',$uuid);
				$this->db->update('artist',array('artist_name'=>$data['artist_name'],'email'=>$data['email'],'image'=>$data['image']));
				$this->db->select('artist_name,email');
				$this->db->where('uuid',$uuid);
				$settings=$this->db->get('artist')->result();
			} else if(isset($fan[0]) && isset($data['email'])){
				// update  email
				$this->db->where('uuid',$uuid);
				$this->db->update('fan',array('email'=>$data['email'],'image'=>$data['image']));
				$this->db->select('email');
				$this->db->where('uuid',$uuid);
				$settings=$this->db->get('fan')->result();
			}
		}
		return $settings[0];
	}
	public function activateContact($data){
		$this->db->where('uuid',$data['contact_uuid']);
		$this->db->update('fan',array('activated'=>'Yes','username'=>$data['username'],'password'=>$data['password']));
		return ($this->db->affected_rows() > 0);
	}
}
