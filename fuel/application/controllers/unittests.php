<?php
require_once('iTestCase.php');
require_once(BASEPATH.'/core/Model.php');
class unittests extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	private function _getAllControllersLoaded(){
		foreach(glob(APPPATH . 'controllers/*' . EXT) as $controller)
		{
			require_once($controller);
		}
	}

	private function _getAllModelsLoaded(){
		foreach(glob(APPPATH . 'models/*' . EXT) as $model)
		{
			require_once($model);
		}
	}

	public function index(){
		echo('<h1>Unit Tests</h1>');
		$this->_getAllControllersLoaded();
		$this->_getAllModelsLoaded();
		$classes = get_declared_classes();
		foreach($classes as $class){
			$reflect = new ReflectionClass($class);
			if ($reflect->implementsInterface('iTestCase')){
				echo("<strong>Testing $class</strong><br>");
				$controller = new $class;
//				$method = new ReflectionMethod($class, 'run_tests');
//				$method->invoke($controller);
			}
		}
	}
}