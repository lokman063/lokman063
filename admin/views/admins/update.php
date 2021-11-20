<?php

use Bitm\Admin\Admin;
use Bitm\Utility\Utility;
use Bitm\Utility\Message;
use Bitm\Utility\ImageUpload;

print_r($_REQUEST);
// print_r($_REQUEST); die();


include_once($_SERVER["DOCUMENT_ROOT"]."/phpcrud/bootstrap.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/phpcrud/security.php");
//collect the data


$data = $_POST;



$upload = new ImageUpload();
$is_uploaded = $upload->updateImage($_FILES,$data['pre_picture']);
$data['picture'] = $is_uploaded;


$admin = new Admin();
$result = $admin->update($data);

if($result){
    Message::set('Admin has been Updated successfully.');
    header("location:index.php");
}else{
    Message::set('Sorry.. There is a problem. Please try again later');
    //log
    header("location:edit.php");
}
































