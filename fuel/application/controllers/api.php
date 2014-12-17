<?php
class Api extends CI_Controller{
	function __construct(){
		parent::__construct();
	}

	private function doTheMethodCall($class,$method,$data){
		$data['data'] = $data;
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
	}

	function r($model,$function){
		$data = $_REQUEST;
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
	}
	
	function index(){
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
		$modelName = $model . '_model';
		$this->load->model($modelName,$model);
		if (isset($this->$model)){
			$method = $this->_getRestMethod($verb,$id);
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