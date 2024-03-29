<?php
class OAuthContacts extends CI_Controller{
	private $client_id='970479616026-84836s24nbai4h7n2ddpr6rt23gshbde.apps.googleusercontent.com';
	private $client_secret='R0DA9qGzXlHvB_zOSdYAFDB-';
	private $redirect_uri='https://beta.fitzos.com/oauth2callback';
	private $link = 'https://accounts.google.com/o/oauth2/auth?client_id=';
	private $maxResults = 200;
	public function index(){
		
	}
	public function __construct(){
		parent::__construct();
		$this->link = $this->link . $this->client_id . '&redirect_uri='.$this->redirect_uri .'&scope=https://www.google.com/m8/feeds/&response_type=code';
	}
	private function getAccessToken($auth_code){
		$fields=array(
				'code'=>  urlencode($auth_code),
				'client_id'=>  urlencode($this->client_id),
				'client_secret'=>  urlencode($this->client_secret),
				'redirect_uri'=>  urlencode($this->redirect_uri),
				'grant_type'=>  urlencode('authorization_code')
		);
		$post = '';
		foreach($fields as $key=>$value) {
			$post .= $key.'='.$value.'&';
		}
		$post = rtrim($post,'&');
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,'https://accounts.google.com/o/oauth2/token');
		curl_setopt($curl,CURLOPT_POST,5);
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,FALSE);
		$result = curl_exec($curl);
		curl_close($curl);
		
		return json_decode($result);
	}
	public function callback(){
		// capture the user..
		$uuid = $this->session->userdata('uuid');
		if (!empty($uuid)){
			$this->load->model('contacts_model','contacts');
			$auth_code = $_GET["code"];
			$response =  $this->getAccessToken($auth_code);
			$accesstoken = $response->access_token;
			$url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$this->maxResults.'&alt=json&v=3.0&oauth_token='.$accesstoken;
			$xmlresponse =  $this->getUrlContents($url);
			if((strlen(stristr($xmlresponse,'Authorization'))>0) && (strlen(stristr($xmlresponse,'Error '))>0)) //At times you get Authorization error from Google.
			{
				echo "<h2>OOPS !! Something went wrong. Please try reloading the page.</h2>";
				exit();
			}
			echo "<h3>Email Addresses:</h3>";
			$temp = json_decode($xmlresponse,true);
			foreach($temp['feed']['entry'] as $cnt) {
				$name = null;
				$email = null;
				if (isset($cnt['title']['$t']) && !empty($cnt['title']['$t'])){
					$name = $cnt['title']['$t'];
				}
				if (isset($cnt['gd$email']['0']['address']) && !empty($cnt['gd$email']['0']['address'])){
					$email = $cnt['gd$email']['0']['address'];
				}
				if (isset($name) && isset($email)){
					$this->contacts->create(array(
							'name'=>$name,
							'email'=>$email,
							'uuid'=>$uuid,
							'image'=>''
					));
				}
			}
			redirect('/');
		} else {
			echo("Access forbidden!");
		}
	}
	private function getUrlContents($url){
		$curl = curl_init();
		$userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
		
		curl_setopt($curl,CURLOPT_URL,$url);	//The URL to fetch. This can also be set when initializing a session with curl_init().
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);	//TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
		curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5);	//The number of seconds to wait while trying to connect.
		
		curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);	//The contents of the "User-Agent: " header to be used in a HTTP request.
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);	//To follow any "Location: " header that the server sends as part of the HTTP header.
		curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);	//To automatically set the Referer: field in requests where it follows a Location: redirect.
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);	//The maximum number of seconds to allow cURL functions to execute.
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);	//To stop cURL from verifying the peer's certificate.
		
		$contents = curl_exec($curl);
		curl_close($curl);
		return $contents;		
	}
	public function test(){
		echo('<h1>Test</h1>');
		echo("<a href='$this->link'>Click me</a>");
	}
}
