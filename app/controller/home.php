<?php
/**
* Default controller
*/
class Home extends Controller
{

	function __construct()
	{

	}

	public function index()
	{
		include "../app/core/AuthManager.php";
		if (AuthManager::isUserLogged())
			$this->view('admin/index', []);
		else
			$this->view('home', []);
	}
}
 ?>
