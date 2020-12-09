<?php


class PicController extends AuthorizationController
{
    public function index()
    {
        $this->view->render('private' . DIRECTORY_SEPARATOR . 'picupload');
    }

    public function upload()
    {
      
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = ['uploadimageType' => strtolower(pathinfo($_FILES['pic']['name'],PATHINFO_EXTENSION))];
            $ext = array("png","jpg","jpeg","PNG","JPG","JPEG");
            if(!in_array($data['uploadimageType'],$ext) ) {
              $this->view->render('private' . DIRECTORY_SEPARATOR . 'picupload',[
                'msg'=>'Upload a valid image file'
              ]);
            }else {
              Pic::upload();
            }   
          }
          header('location: /managment/index?id=' . $_SESSION['user']->id);          

    }

    public function delete()
    {
      Pic::delete();
      header('location: /managment/index?id=' . $_SESSION['user']->id);
    }

}