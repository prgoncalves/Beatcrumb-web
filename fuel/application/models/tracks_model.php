<?php
class Tracks_model extends base_model{
	private $nonRestCalls = false;
	public function __construct(){
		$this->tableName = 'tracks';
		$this->keyField = 'id';
		parent::__construct();
	}
	public function setNonRest(){
		// allow non rest calls - Cant be called from API
		$this->nonRestCalls = true;
	}
	public function canPlayTrack($track,$uuid){
		if ($this->nonRestCalls){
			// See if the artist and the User is the same
			$this->db->select('artist.uuid');
			$this->db->where('tracks.id',$track);
			$this->db->join('artist','tracks.artist_id=artist.id');
			$artist = $this->db->get('tracks')->result();
			if (isset($artist[0])){
				if ($artist[0]->uuid == $uuid){
					return true;
				}
			}
			// see if the track is playable for fan
			$this->db->select('playable');
			$this->db->where('track_id',$track);
			$this->db->where('uuid',$uuid);
			$data = $this->db->get('user_played')->result();
			if (isset($data[0])){
				if ($data[0]->playable == 'Yes'){
					return true;
				} else {
					return false;
				}
			} else {
				return true;
			}
		} else {
			return false;
		}
	}
	public function getTrackDetails($track){
		if ($this->nonRestCalls){
			$this->db->where('id',$track);
			$result = $this->db->get('tracks')->result();
			if (isset($result[0])){
				return $result[0];
			} else {
				return null;
			}
		}
	}
	public function updateTrack($track){
		if ($this->nonRestCalls){
			$this->db->where('id',$track->id);
			$this->db->update('tracks',$track);
		}
	}
	public function setTrackUserPlayed($uuid,$track){
		if ($this->nonRestCalls){
			// get existing record
			$this->db->where('uuid',$uuid);
			$this->db->where('track_id',$track);
			$played = $this->db->get('user_played')->result();
			// if exists then update
			if (isset($played[0])){
				$played[0]->playable = 'No';
				$played[0]->plays += 1;
				$played[0]->shares = 0;
				$this->db->where('uuid',$uuid);
				$this->db->where('track_id',$track);
				$this->db->update('user_played',$played[0]);
			} else {
				// if not create
				$this->db->insert('user_played',array(
					'uuid'=>$uuid,
					'track_id'=>$track,
					'plays'=>1,
					'shares'=>0,
					'playable'=>'No'
				));
			}
		}
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
		// if we have result they are an artist..
		if (isset($result[0])){
			$artist = $result[0];
		} else {
			$result = $this->db->get_where('fan',array('uuid'=>$postData['uuid']))->result();
			if (isset($result[0])){
				$artist = $result[0];
			} else {
				return false;
			}
		}
		$this->load->library('email');
		$message = $this->load->view('emails/ShareEmail',array('data'=>$data,'postData'=>$postData,'artist'=>$artist),TRUE);
		$this->email->initialize(array('mailtype'=>'html'));
		$this->email->from('membership@beatcrumb.com');
		$this->email->to($data->email);
		$this->email->subject("Beatcrumb invite!");
		$this->email->message($message);
		return $this->email->send();
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
		// get the users uuid
		$uuid = $this->session->userdata('uuid');
		$contacts = $data['contacts'];
		$increase = count($contacts);
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
			// update the track with inreased share
			$this->increaseTrackShareCount($data['track'],$increase);
		}
		$this->setTrackPlayableAfterShare($uuid, $data['track'],$increase);
		return true;
	}
	private function setTrackPlayableAfterShare($uuid,$track,$increase){
			$this->db->where('uuid',$uuid);
			$this->db->where('track_id',$track);
			$played = $this->db->get('user_played')->result();
			if (isset($played[0])){
				$shares = $played[0]->shares + $increase;
				// update record
				if ($shares > 2){
					$played[0]->playable = 'Yes';
				}
				$played[0]->shares = $shares;
				$this->db->where('uuid',$uuid);
				$this->db->where('track_id',$track);
				$this->db->update('user_played',$played[0]);
			} else {
				// if not create
				$this->db->insert('user_played',array(
					'uuid'=>$uuid,
					'track_id'=>$track,
					'plays'=>0,
					'shares'=>$increase,
					'playable'=>'Yes'
				));
			}
	}
	private function increaseTrackPlayCount($id){
		$this->db->set('plays','plays+1',false);
		$this->db->where('id',$id);
		$this->db->update('tracks');
	}
	private function increaseTrackShareCount($id,$increase = 1){
		$this->db->set('shares',"shares+$increase",false);
		$this->db->where('id',$id);
		$this->db->update('tracks');
	}
	private function addUUIDToContact($id,$UUID){
		$this->db->where('id',$id);
		$this->db->update('contacts',array('contact_uuid'=>$UUID));
	}
	private function getInbox($uuid,$available = 'yes'){
		$this->db->select('tracks.id,artist_name,message,filename,artist.image,tracks.plays,tracks.shares,IFNULL(playable,"yes") as playable',false);
		$this->db->where('inbox.uuid',$uuid);
		$this->db->where('inbox.available',$available);
		$this->db->join('tracks','tracks.id=inbox.track_id');
		$this->db->join('artist','artist.id=tracks.artist_id');
		$this->db->join('user_played','user_played.track_id = tracks.id and user_played.uuid = "' . $uuid . '"','LEFT');
		return $this->db->get('inbox')->result();
	}
	public function inbox($data){
		$available = $this->getInbox($data['uuid'],'yes');
//		$notAvailable = $this->getInbox($data['uuid'],'no');;
		return array('available'=>$available);
	}
}