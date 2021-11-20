<?php


include_once($_SERVER["DOCUMENT_ROOT"]."/phpcrud/bootstrap.php");
use Bitm\Utility\Message;
use Bitm\Utility\Utility;
use Bitm\Subscriber\Subscriber;


//collect the data

$data = $_POST;






$subscribers = new Subscriber();

$result = $subscribers->store($data);



            

if($result){
Message::set('Subscriber has been added successfully.');
header("location:http://localhost/phpcrud/front/index.php");
}else{
    Message::set('Sorry.. There is a problem. Please try again later');
    //log
    header("location:http://localhost/phpcrud/front/index.php");
}