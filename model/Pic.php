<?php

class Pic
{
    public static function upload()
    {
        $con=DB::getInstance();
        $con->beginTransaction();
        $data=$con->prepare('insert into picture (name, user_id) values (:name, :user_id)');
        $data->execute([
            'name'=>$_POST['name'],
            'user_id'=>$_POST['id']
        ]);
        $id=$con->lastInsertid();
        $data=$con->prepare('update picture set picpath=:picpath where id=:id');
        $data->execute([
            'picpath'=>$id,
            'id'=>$id
        ]);
        $con->commit();
        $route = BP . 'public' . DIRECTORY_SEPARATOR
            . 'images' . DIRECTORY_SEPARATOR .
            $id . '.jpg';
        move_uploaded_file($_FILES['pic']['tmp_name'], $route);
    }

    public static function all()
    {
        $con=DB::getInstance();
        $data=$con->prepare('select * from picture');
        $data->execute();
        return $data->fetchAll();
    }

    public static function delete()
    {
        $con=DB::getInstance();
        $data=$con->prepare('delete from picture where id=:id');
        $data->execute($_GET);
        unlink(BP . 'public' . DIRECTORY_SEPARATOR
        . 'images' . DIRECTORY_SEPARATOR .
        $_GET['id'] . '.jpg');
    }

    public static function count()
    {
        $con= DB::getInstance();
        $data=$con->prepare('select count(*) from picture');
        $data->execute();
        $number=$data->fetchColumn();
        return $number;
    }
}