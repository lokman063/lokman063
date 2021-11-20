<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/phpcrud/bootstrap.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/phpcrud/security.php");
use Bitm\Utility\Utility;
use Bitm\Utility\Message;
use Bitm\Admin\Admin;
//print_r($_SERVER['REQUEST_METHOD']); die();


    $id = $_GET['id'];
   
$Admin = new Admin();
$result = $Admin->delete($id);
//var_dump($result); die();
//redirect to index page
if($result){
   
    unlink($_SERVER['DOCUMENT_ROOT'] . '/phpcrud/uploads/'.$picture);
    Message::set('Admin has been Deleted successfully.');
    header("location:active.php");
}else{
    Message::set('Sorry.. There is a problem. Please try again later');
    //log
    header("location:index.php");
}








//header("location:index.php");
