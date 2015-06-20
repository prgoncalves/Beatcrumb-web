<?php
class Tracks extends CI_Controller{
	private function logStuff($user = null,$action=null,$message=null,$data=null){
		$this->load->model('audit_model','audit');
		$log = array(
			'user'=>$user,
			'date'=>date('Y-m-d H:i:s'),
			'ip'=>$_SERVER['REMOTE_ADDR'],
			'action'=>$action,
			'message'=>$message,
			'data'=>json_encode($data)		
		);
		$this->audit->log($log);
	}
	public function index($filename = null){
		$uuid = $this->session->userdata('uuid');
		if (!empty($uuid) && !empty($filename)){
			$this->logStuff($uuid,'GetTrack','For Artist Only!',"Artist is $uuid,Filename is $filename");
			// get artist
			$this->load->model('artist_model','artist');
			// check db for track
			$track = $this->artist->getArtistTrack($uuid,$filename);
			// see if the file exists
			if (!empty($track[0])){
				$this->downloadTrack($track[0]->id,$filename);				
			} else {
				show_404('track/index','Track not found!');
			}
		} else {
			// render a page and tell them to go away...
			show_404('track/index','Access denial');
		}
	}
	
	public function play($track,$artist){
		// get the users uuid
		$uuid = $this->session->userdata('uuid');
		if (!empty($uuid) && !empty($track) && !empty($artist)){
			// check to see if they can play
			$this->load->model('tracks_model','tracks');
			$this->tracks->setNonRest();
			$playable = $this->tracks->canPlayTrack($track,$uuid);
			if ($playable){
				// get track to download
				$trackData = $this->tracks->getTrackDetails($track);
				// increase play counts
				if (isset($trackData->plays)){
					$trackData->plays += 1;
				}	else {
					$trackData->plays = 1;
				}
				// set so user cannot play without sharing
				$this->tracks->setTrackUserPlayed($uuid,$track);
				// if can download file to play
				$this->downloadTrack($trackData->artist_id, $trackData->filename);
			} else {
				// send 404 if they cannot
				show_404('track/play','Track not playable');
			}
		} else {
			show_404('track/play','Not all params to play track');
		}
	}
	
	private function downloadTrack($artistId,$filename){
		$pathToFile = ASSETS_FOLDER.'artists/'.$artistId .'/'.$filename;
		$modules = apache_get_modules();
		if (file_exists($pathToFile)){
			if (in_array('mod_xsendfile', $modules)) {
				// If mod_xsendfile is loaded, use X-Sendfile to deliver.. (optional: I have this as failover to use PHP readfile() if mod_xsendfile is unavailable)
				header ('X-Sendfile: ' . $pathToFile);
				header("Content-Length: ". (string)(filesize($pathToFile)) ."");
				header ('Content-Type: audio/mpeg');
				header ('Content-Disposition: attachment; filename="' . $filename . '"');
				exit;
			} else {
				$this->load->helper('download');
				// Otherwise, use the traditional PHP way..
				$data = file_get_contents($pathToFile);
				force_download($filename,$data);
			}
		} else {
			echo($filename .' not found');
		}
	}
}