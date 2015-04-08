<?php
class Api extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('audit_model','audit');
	}

	private function logStuff($user = null,$action=null,$message=null,$data=null){
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
	
	private function doTheMethodCall($class,$method,$data){
		$data['data'] = $data;
		try {
			$r = new ReflectionMethod($class.'_model', $method);
			$pass = array();
			foreach($r->getParameters() as $param){
				if (isset($data[$param->getName()])){
					$pass[] = $data[$param->getName()];
				} else {
					if($param->isOptional()){
						$pass[] = $param->getDefaultValue();
					}
				}
			}
			$result = $r->invokeArgs($this->$class, $pass);
			return $result;
		} catch (Exception $e) {
			// not brilliant catching and doing nowt but it means the call will not fail when a method doe snot exist
			return null;
		}
	}

	function r($model,$function){
		$uuid = $this->session->userdata('uuid');
		if (!empty($uuid) || ($function == 'login' || $function == 'forgottenPassword')){
			$data = $_REQUEST;
			$data['uuid'] = $uuid;
			$this->logStuff($uuid,$model.'->'.$function,'API CALL',$data);
			// var_dump($data);
			$modelName = $model . '_model';
			$this->load->model($modelName,$model);
			if (isset($this->$model)){
				$result = $this->doTheMethodCall($model, $function, $data);
			} else {
				$result = null;
			}
			//		echo(json_encode($result));
			if (isset($result)){
				$this->_respond('OK', 'API Call worked',$result);
			} else {
				$this->_respond('ERR', 'API Call worked but no data');
			}
		} else {
			$this->_respond('LOG', 'NOT Logged IN');
		}
	}
	
	function index(){
		$this->logStuff('','API INDEX PAGE','WARNING',json_encode($this->session->userdata()));
		echo "<h1>Hello, what are you doing here?</h1>";
		echo "<p>You really should not be here looking at this... Please go away!</p>";
	}

	private function _getRestMethod($verb,$id = null){
		if ($verb === 'DELETE'){
			return 'delete';
		}
		if ($verb === 'PUT'){
			return 'update';
		}
		if ($verb === 'POST'){
			return 'create';
		}
		if ($verb === 'GET'){
			if (isset($id)){
				return 'findOneById';
			} else {
				return 'findAll';
			}
		}
	}

	function rest($model,$id = null){
		date_default_timezone_set('Europe/London');
		$put = file_get_contents("php://input");
		$verb = $_SERVER['REQUEST_METHOD'];
		if ($verb === 'PUT' || $verb === 'POST'){
			$data = json_decode($put);
		} else {
			$data = $_REQUEST;
		}
		if (is_array($data)  && isset($data['id'])){
			$id = $data['id'];
		}
		$method = $this->_getRestMethod($verb,$id);
		$uuid = $this->session->userdata('uuid');
		if (!empty($uuid) || ($method == 'create' && ($model == 'fan' || $model == 'artist'))){
			$data['uuid'] = $uuid;
			$modelName = $model . '_model';
			$this->load->model($modelName,$model);
			if (isset($this->$model)){
				$this->logStuff($uuid,$model.'->'.$method,'REST CALL',$data);
				if ($verb === 'POST' || $verb === 'PUT'){
					$result = $this->$model->$method($data);
				} else {
					$result = $this->$model->$method($id);
				}
			} else {
				$result =  null;
			}
			if (isset($result)){
				$this->_respond('OK', 'API Call worked',$result);
			} else {
				$this->_respond('ERR', 'API Call failed');
			}
		} else {
			$this->_respond('LOG', 'NOT Logged IN');
		}
	}

	private function _respond($status,$message,$result = null){
		$returnData = array(
				'Status'=>$status,
				'Message'=>$message,
				'Result'=>$result
		);
		echo json_encode($returnData);
	}
}