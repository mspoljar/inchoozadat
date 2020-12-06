<?php

class ManagmentController extends AuthorizationController
{
    public function index()
    {
        $images=Pic::all();
        $this->view->render('private' . DIRECTORY_SEPARATOR . 'managment',[
            'user'=>User::find($_GET['id']),
            'images'=>$images
        ]);
    }
}