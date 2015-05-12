<?php
class Tracks_model extends base_model{
	public function __construct(){
		$this->tableName = 'tracks';
		$this->keyField = 'id';
		parent::__construct();
	}
	public function share($data){
		$contacts = $data['contacts'];
		foreach($contacts as $contact){
			// create a share record for each contact
			// are they a member then add to inbox
			// not a member then send email
		}
	}
}