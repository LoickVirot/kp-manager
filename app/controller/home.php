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
		$this->view('home', []);
	}
}
 ?>
