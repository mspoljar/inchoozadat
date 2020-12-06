<?php

class User
{
    public static function readAll()
    {
        $con=DB::getInstance();
        $data=$con->prepare('select * from user');
        $data->execute();
        return $data->fetchAll();
    }

    public static function find($id)
    {
        $con=DB::getInstance();
        $data=$con->prepare('select * from user where id=:id');
        $data->execute(['id'=>$id]);
        return $data->fetch();
    }

    public static function register()
    {
        $con=DB::getInstance();
        $data=$con->prepare('insert into user(name,email,pass,role) values (:name, :email, :pass, 2)');
        unset($_POST['passag']);
        $_POST['pass']=password_hash($_POST['pass'],PASSWORD_BCRYPT);
        $data->execute($_POST);
    }

    public static function update()
    {
        $con=DB::getInstance();
        $data=$con->prepare('update user 
        set name=:name, email=:email, pass=:pass where id=:id');
        unset($_POST['passag']);
        $_POST['pass']=password_hash($_POST['pass'],PASSWORD_BCRYPT);
        $data->execute($_POST);
    }

}