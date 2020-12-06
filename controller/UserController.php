<?php 

class UserController extends AuthorizationController
{

    public function index()
    {
        $this->view->render('private' . DIRECTORY_SEPARATOR . 'myaccount',[
            'user'=>User::find($_GET['id'])
        ]);
    }

    public function change()
    {
        $user=User::find($_GET['id']);
        $this->view->render('private' . DIRECTORY_SEPARATOR . 'changeuser',[
            'user'=>$user
        ]);
    }

    public function update()
    {
        
        if($_POST['pass']!=$_POST['passag']){
            $user=User::find($_POST['id']);
        $this->view->render('private' . DIRECTORY_SEPARATOR . 'changeuser',[
            'user'=>$user,
            'msg'=>'Passwords do not match, enter them again'
        ]);
        }else{
        $user=User::update();
        header('location: /managment/index');
        }
        /*
        $this->view->render('test',[
            'user'=>$_POST
        ]);
            */
    }
}