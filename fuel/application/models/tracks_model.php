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
	private function sendShareEmail($data,$postData = null){
		// get the artist details sending the crumb
		$result = $this->db->get_where('artist',array('uuid'=>$postData['uuid']))->result();
		$artist = $result[0];
		$this->load->library('email');
		$message = $this->load->view('emails/ShareEmail',array('data'=>$data,'postData'=>$postData,'artist'=>$artist),TRUE);
		$this->email->initialize(array('mailtype'=>'html'));
		$this->email->from('membership@beatcrumb.com');
		$this->email->to($data->email);
		$this->email->subject("Beatcrumb invite!");
		$this->email->message($message);
		$this->email->send();
	}
	private function shareWithMember($contact,$contactdata,$data){
		if (isset($contactdata[0]->contact_uuid) && !empty($contactdata[0]->contact_uuid)){
			// if contact attached to a user then add to inbox
			$this->addTrackToInbox($contactdata[0]->contact_uuid,$data['track'],$data['message']);
		} else {
			// if nbo uuid on contact then add uuid to contact
			$this->addUUIDToContact($contact,$contactdata[0]->uuid);
			$contactdata[0]->contact_uuid = $contactdata[0]->uuid;
			// add track to inbox
			$this->addTrackToInbox($contactdata[0]->uuid,$data['track'],$data['message']);
		}
		// check if activated
		if ($contactdata[0]->activated == 'No'){
			// if not email
			$this->sendShareEmail($contactdata[0],$data);
		}
	}
	private function shareWithNonMember($contact,$contactdata,$data){
		// create account
		$this->load->model('fan_model','fan');
		$fan = $this->fan->createForShare($contactdata[0]);
		// add uuid to contact
		$this->addUUIDToContact($contact,$fan->uuid);
		$contactdata[0]->contact_uuid = $fan->uuid;
		// add to inbox
		$this->addTrackToInbox($fan->uuid,$data['track'],$data['message']);
		// send email with link for activation
		$this->sendShareEmail($contactdata[0],$data);
	}
	public function share($data){
		$contacts = $data['contacts'];
		foreach($contacts as $contact){
			// get contact record and join it to a fan or artist
			$this->db->select('contacts.email,contacts.name,contacts.contact_uuid,if (artist.uuid is null,fan.activated,artist.activated)as activated,if (artist.uuid is null,fan.uuid,artist.uuid)as uuid',false);
			$this->db->where('contacts.id',$contact);
			$this->db->join('artist','artist.email = contacts.email','left');
			$this->db->join('fan','fan.email = contacts.email','left');
			$contactdata = $this->db->get('contacts')->result();
			if (isset($contactdata[0]->uuid)){ // a member
				$this->shareWithMember($contact,$contactdata, $data);
			} else {// not a member
				$this->shareWithNonMember($contact, $contactdata, $data);
			}
		}
		return true;
	}
	private function addUUIDToContact($id,$UUID){
		$this->db->where('id',$id);
		$this->db->update('contacts',array('contact_uuid'=>$UUID));
	}
	public function inbox($data){
		$this->db->where('uuid',$data['uuid']);
		$this->db->where('available','yes');
		$available = $this->db->get('inbox')->result();
		$this->db->where('uuid',$data['uuid']);
		$this->db->where('available','no');
		$notAvailable = $this->db->get('inbox')->result();
		return array('available'=>$available,'notAvailable'=>$notAvailable);		
	}
}