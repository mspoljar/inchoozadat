<?php

class Pic
{
    public static function upload()
    {
        $route = BP . 'public' . DIRECTORY_SEPARATOR
            . 'images' . DIRECTORY_SEPARATOR .
            $_POST['name'] . '.jpg';
            $path=$_POST['name'];
        $con=DB::getInstance();
        $data=$con->prepare('insert into picture (picpath, user_id) values (:picpath, :user_id)');
        $data->execute([
            'picpath'=>$path,
            'user_id'=>$_POST['id']
        ]);
        move_uploaded_file($_FILES['pic']['tmp_name'], $route);
    }

    public static function all()
    {
        $con=DB::getInstance();
        $data=$con->prepare('select * from picture');
        $data->execute();
        return $data->fetchAll();
    }
}