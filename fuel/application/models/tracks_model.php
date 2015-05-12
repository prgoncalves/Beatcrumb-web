<?php
class Tracks_model extends base_model{
	public function __construct(){
		$this->tableName = 'tracks';
		$this->keyField = 'id';
		parent::__construct();
	}
	private function addTrackToInbox($uuid,$track,$message=''){
		$this->db->insert('inbox',array(
			'track_id'=>$track,
			'uuid'=>$uuid,
			'available'=>'yes',
			'shared'=>0,
			'message'=>$message,
			'timestamp'=>date('Y-m-d H:i:s')
		));
		return $this->db->insert_id();
	}
	private function sendShareEmail($data){
		// TODO: Send correct email for sharing
		// TODO: Build link for password activation
		$this->load->library('email');
		$message = $this->load->view('emails/BlankEmailTemplate',array('data'=>$data,'message'=>'Sharing message'),TRUE);
		$this->email->initialize(array('mailtype'=>'html'));
		$this->email->from('membership@beatcrumb.com');
		$this->email->to($data->email);
		$this->email->subject("Beatcrumb invite!");
		$this->email->message($message);
		$this->email->send();
	}
	public function share($data){
		$contacts = $data['contacts'];
		foreach($contacts as $contact){
			// get contact record and join it to a fan or artist
			$this->db->select('contacts.email,contacts.name,if (artist.uuid is null,fan.activated,artist.activated)as activated,if (artist.uuid is null,fan.uuid,artist.uuid)as uuid',false);
			$this->db->where('contacts.id',$contact);
			$this->db->join('artist','artist.email = contacts.email','left');
			$this->db->join('fan','fan.email = contacts.email','left');
			$contactdata = $this->db->get('contacts')->result();
			if (isset($contactdata[0]->uuid)){ // a member
				// check if activated
				if ($contactdata[0]->activated == 'No'){
					// if not email
					$this->sendShareEmail($data);
				} 
				// add track to inbox
				$this->addTrackToInbox($contactdata[0]->uuid,$data['track'],$data['message']);
			} else {// not a member
				// create account
				$this->load->model('fan_model','fan');
				$fan = $this->fan->createForShare($contactdata[0]);
				// add to inbox
				$this->addTrackToInbox($fan->uuid,$data['track'],$data['message']);
				// send email with link for activation
				$this->sendShareEmail($data);
			}
		}
		return true;
	}
}