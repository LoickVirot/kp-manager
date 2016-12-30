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
			header('Location:/admin/');
		else
			$this->view('home', []);
	}
}
 ?>
