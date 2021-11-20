<?php
namespace Bitm\Login;
use Bitm\Db\Db;
use Bitm\Utility\Message;
use Bitm\Utility\Utility;
use PDO;

class Login
{
public $id = null;
public $email = null;
private $passaword = null;
public $conn = null;

function __construct(){
$this->conn = Db::connect();

}

function login($data){
   
    $email = $data['email'];
     $password = $data['password'];
    
$query = "SELECT * FROM admins WHERE email = '$email' ";
$sth = $this->conn->prepare($query);
$sth->bindParam(':email',$email);
$sth->bindParam(':password',$password);
$sth->execute();
return $result = $sth->fetch(PDO::FETCH_ASSOC);
 

  





}
public function prepare($data){
  
    $this->email = $data['email'];
    $this->password = $data['password'];
  
}





}
    


?>

