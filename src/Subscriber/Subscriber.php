<?php
namespace Bitm\Subscriber;
use Bitm\Db\Db;
use Bitm\Utility\Message;
use Bitm\Utility\Utility;
use PDO;

class Subscriber
{
public $id = null;
public $email = null;

public $is_active = null;
public $is_draft = null;
public $is_deleted = 0;
public $created_at = null;
public $modified_at = null;
public $conn = null;
function __construct(){
$this->conn = Db::connect();

}

function index(){
//selection query
//$query = "SELECT * FROM subscribers WHERE is_deleted = 0 ORDER BY id DESC ";
 $query = "SELECT * FROM subscribers ORDER BY id DESC ";
$sth = $this->conn->prepare($query);
$sth->execute();
return $sth->fetchAll(PDO::FETCH_ASSOC);
}






function store($data){


        $this->prepare($data);

        $query = "INSERT INTO `subscribers` (`id`, 
        `email`,
             `created_at`, 
        `modified_at`) VALUES (NULL,
        :email,
            :created_at,
        :modified_at);";



$sth = $this->conn->prepare($query);


$sth->bindParam(':email',$this->email);
$sth->bindParam(':created_at',$this->created_at);
$sth->bindParam(':modified_at',$this->modified_at);
$result = $sth->execute();


return $result;




}

function show($id = null){
    if (empty($id)) {
            return;
            }

$query = 'SELECT * FROM subscribers WHERE id = :id';
$sth = $this->conn->prepare($query);
$sth->bindParam(':id',$id);
$sth->execute();
$Category = $sth->fetch(PDO::FETCH_ASSOC);



return $Category;

}

function search($data){

    

    
if (isset($data)){
    $searching = $data;
    $searching = preg_replace(" #[^0-9a-z]#", " ", $searching);
    $query = "SELECT * FROM subscribers WHERE title LIKE '%$searching%' OR link LIKE '%$searching%' ";
   
    $sth = $this->conn->prepare($query);
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
    
}

}




// function __toString(){

//     return $this->title;
// }
function softdelelte($id = null){

    if (empty($id)) {
        return;
        }

        $query = "UPDATE subscribers SET  is_deleted = 1 WHERE id=:id;";

$sth = $this->conn->prepare($query);
$sth->bindParam(':id',$id);
$result = $sth->execute();
return $result;
}

function delete($id = null){

    //print_r($_REQUEST);die();
    if (empty($id)) {
        return;
        }

       
    $query = "DELETE FROM `subscribers` WHERE `subscribers`.`id` = :id;";
    $sth = $this->conn->prepare($query);
    $sth->bindParam(':id',$id);
    $result = $sth->execute();
     return $result;


}




function update($data){

if (empty($data)) {
   return;
}
//prepare data
$this->prepare($data);
    


     $query = "UPDATE `subscribers` SET `email` = :email,
                     `modified_at` = :modified_at WHERE `subscribers`.`id` = :id;";

$sth = $this->conn->prepare($query);
$sth->bindParam(':id',$this->id);
$sth->bindParam(':email',$this->email);
$sth->bindParam(':modified_at',$this->modified_at);
$result = $sth->execute();

return $result;

}

//prepare data
private function prepare($data){
 


    $this->email = $data['email'];
    $this->modified_at = date('Y-m-d h:i:s', time());



       if (array_key_exists('id',$data) && !empty($data['id'])) {
        $this->id = $data['id'];
       }

    if(!$this->id){
            $this->created_at = date('Y-m-d h:i:s', time());
        }
        

}




}
    


?>

