<?php

class IndexController extends Controller
{
public function index()
{
    $this->view->render('home');
}

public function login()
{
    $this->view->render('login');
}

public function authorization()
{
    $data=$_POST;
    $this->view->render('test',['data'=>$data]);
}

public function register()
{
    $this->view->render('register');
}
public function registernew()
{
    User::register();
    $this->view->render('regfinish');
}
}

