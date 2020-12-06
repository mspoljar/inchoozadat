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
    if(!isset($_POST['email']) || !isset($_POST['pass'])){
        $this->view->render('login',[
            'msg'=>'Login info is not set'
        ]);
        return;
    }

    if(trim($_POST['email'])==='' || 
        trim($_POST['pass'])===''){
            $this->view->render('login',[
                'msg'=>'Login info is required'
            ]);
            return;
        }

    $con=DB::getInstance();
    $data=$con->prepare('select * from user where email=:email');
    $data->execute(['email'=>$_POST['email']]);
    $result=$data->fetch();
    if($result==null){
        $this->view->render('login',[
            'msg'=>'Unregistered user please register'
        ]);
        return;
    }

    if(!password_verify($_POST['pass'],$result->pass)){
        $this->view->render('login',[
            'msg'=>'Wrong mail and password combination try again'
        ]);
        return;
    }

    unset($result->pass);
    $_SESSION['user']=$result;
    $man=new ManagmentController();
    $man->index();
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

public function logout()
{
    unset($_SESSION['user']);
    session_destroy();
    $this->index();
}

public function test()
{
    $test=password_hash('12345',PASSWORD_BCRYPT);
    $this->view->render('test',[
        'test'=>$test
    ]);
}
}

