<?php

class User
{
    public static function readAll()
    {
        $con=DB::getInstance();
        $data=$con->prepare('select a.id, a.name, a.email, b.name from user a inner join role b on b.role=a.role group by a.id');
        $data->execute();
        return $data->fetchAll();
    }

    public static function find($id)
    {
        $con=DB::getInstance();
        $data=$con->prepare('select a.id, a.name, a.email, b.name from user a inner join role b on b.role=a.role where a.id=:id group by a.id');
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

}