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

    public static function deletepic()
    {
        
            $con=DB::getInstance();
            $imgs=$con->prepare('select * from picture where user_id=:id');
            $imgs->execute($_GET);
            return $imgs->fetchAll();
        
    }

    public static function delete()
    {
        $con=DB::getInstance();
        $data=$con->prepare('delete from user where id=:id');
        $data->execute($_GET);   
    }

    public static function encryptCookie($value)
    {
        $key = hex2bin(openssl_random_pseudo_bytes(4));

        $cipher = "aes-256-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
     
        $ciphertext = openssl_encrypt($value, $cipher, $key, $options=0, $iv);
     
        return( base64_encode($ciphertext . '::' . $iv. '::' .$key) );
    }

    public static function decryptCookie($ciphertext)
    {
        $cipher = "aes-256-cbc";

        list($encrypted_data, $iv,$key) = explode('::', base64_decode($ciphertext));
        return openssl_decrypt($encrypted_data, $cipher, $key, 0, $iv);
    }
}