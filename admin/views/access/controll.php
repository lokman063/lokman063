<?php
session_start();
include_once($_SERVER["DOCUMENT_ROOT"]."/phpcrud/vendor/autoload.php");

use Bitm\Utility\Message;
use Bitm\Utility\Utility;
use Bitm\Login\Login; 


$data = $_POST ;
$login = new Login();
$result = $login->login($data);


//$result = $login->login($data);










if($result){
    $_SESSION['logged_in']  = true;
    //header('location:'.$_SERVER['HTTP_REFERER']);
    header("location:http://localhost/phpcrud/admin/views/dashboard/index.php");
}else{
    $_SESSION['logged_in'] = false;
    header("location:http://localhost/phpcrud/admin/views/dashboard/index.php");
}