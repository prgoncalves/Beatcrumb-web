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
	public function index($uuid = null,$filename = null,$user=null){
		if (!empty($uuid) && !empty($filename)){
			$this->logStuff(null,'GetTrack','For Artist Only!',"Artist is $uuid,Filename is $filename");
			// get artist
			$this->load->model('artist_model','artist');
			// check db for track
			$track = $this->artist->getArtistTrack($uuid,$filename);
			// see if the file exists
			if (!empty($track[0])){
				$this->downloadTrack($track[0]->id,$filename);				
			} else {
				echo('Track not found!');
			}
		} else {
			// render a page and tell them to go away...
			echo('I would like to help but I really can not');
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