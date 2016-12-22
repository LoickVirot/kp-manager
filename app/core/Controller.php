<?php
/**
*	Manage calls of core classes
*/
class Controller
{

	function __construct()
	{

	}
	/**
	*	Call a model file
	* @param string $model Name of called file
	* @return Object
	**/
	public function model($model)
	{
		require_once '../app/model/'.$model.'.php';
		return new $model();
	}

	/**
	*	Call a view file
	* @param string $view Name of called file
	* @param array $data Data to transfert to tyhe view
	**/
	public function view($view, $data = [])
	{
		ob_start();
		require_once '../app/view/'.$view.'.php';
		$content = ob_get_clean();
		$app = require_once '../app/config/app.php';
		require_once '../app/view/default/template.php';
	}
}
 ?>
