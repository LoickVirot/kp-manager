<?php

/**
 * Created by PhpStorm.
 * User: marty
 * Date: 09/12/16
 * Time: 13:31
 */
class admin extends Controller
{
    public function index()
    {
        $this->view('admin/index', []);
    }
}