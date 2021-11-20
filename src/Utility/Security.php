<?php 
session_start();
namespace Bitm\Utility;

class Security{

function __construct()
{
    if(array_key_exists('logged_in',$_SESSION) && !empty($_SESSION['logged_in'])){


    }else {
        $this_SESSION['logged_in'] ;
    }
    
    
    if(!$_SESSION['logged_in']){
        
      
    
       header('location:http://localhost/phpcrud/admin/views/access/login.php' );
    }

}
    

}