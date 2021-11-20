<?php
namespace Bitm\Brand;
use Bitm\Db\Db;
use Bitm\Utility\Message;
use Bitm\Utility\Utility;
use PDO;

class Brand
{
public $id = null;
public $brand_title = null;
public $picture = null;
public $brand_link = null;
public $is_active = null;
public $is_draft = null;
public $is_deleted = 0;
public $created_at = null;
public $modified_at = null;
public $conn = null;

function __construct(){
$this->conn = Db::connect();

}


function all(){

    //selection query
//$query = "SELECT * FROM brands WHERE is_deleted = 0 ORDER BY id DESC ";
 $query = "SELECT * FROM brands ORDER BY id DESC ";
$sth = $this->conn->prepare($query);
$sth->execute();
return $sth->fetchAll(PDO::FETCH_ASSOC);
}

function active(){


$query = "SELECT * FROM brands WHERE is_active = 1 ORDER BY id DESC ";
$sth = $this->conn->prepare($query);
$sth->execute();
return $brands = $sth->fetchAll(PDO::FETCH_ASSOC);
}
function inactive(){


$query = "SELECT * FROM brands WHERE is_active = 0 ORDER BY id DESC ";
$sth = $this->conn->prepare($query);
$sth->execute();
return $brands = $sth->fetchAll(PDO::FETCH_ASSOC);
}

function trash(){


$query = "SELECT * FROM brands WHERE is_deleted = 1 ORDER BY id DESC ";
$sth = $this->conn->prepare($query);
$sth->execute();
return $brands = $sth->fetchAll(PDO::FETCH_ASSOC);
}


function restore($id){
    if (empty($id)) {
        return;
        }
        $query = "UPDATE brands SET  is_deleted = 0 WHERE id=:id;";

        $sth = $this->conn->prepare($query);
        $sth->bindParam(':id',$id);
        return $sth->execute();
}
function activate($id){
    if (empty($id)) {
        return;
        }
        $query = "UPDATE brands SET  is_active = 1 WHERE id=:id;";

        $sth = $this->conn->prepare($query);
        $sth->bindParam(':id',$id);
        return $sth->execute();
}
function deactivate($id){
    if (empty($id)) {
        return;
        }
        $query = "UPDATE brands SET  is_active = 0 WHERE id=:id;";

        $sth = $this->conn->prepare($query);
        $sth->bindParam(':id',$id);
        return $sth->execute();
}

function store($data){

        $this->prepare($data);

        $query = "INSERT INTO `brands`  (`id`,
        `brand_title`, 
        `brand_link`, 
        `picture`,
        `is_draft`,
        `is_active`, 
        `is_deleted`, 
        `created_at`, 
        `modified_at`) VALUES (NULL,
        :brand_title, 
        :brand_link, 
        :picture, 
        is_draft,
         :is_active, 
        :is_deleted,
        :created_at, 
        :modified_at);";

        


$sth = $this->conn->prepare($query);


$sth->bindParam(':brand_title',$this->brand_title);
$sth->bindParam(':brand_link',$this->brand_link);
$sth->bindParam(':picture',$this->picture);
$sth->bindParam(':is_active',$this->is_active);
$sth->bindParam(':is_deleted',$this->is_deleted);
$sth->bindParam(':created_at',$this->created_at);
$sth->bindParam(':modified_at',$this->modified_at);


 //$sth->bindParam(':created_at',date('Y-m-d h:i:s', time()));
// $sth->bindParam(':modified_at',date('Y-m-d h:i:s', time()));
//$sth->bindParam(':promotional_message',$promotional_message);
//$sth->bindParam(':html_banner',$html_banner);
$result = $sth->execute();


return $result;




}

function show($id = null){
    if (empty($id)) {
            return;
            }

$query = 'SELECT * FROM brands WHERE id = :id';
$sth = $this->conn->prepare($query);
$sth->bindParam(':id',$id);
$sth->execute();
$brand = $sth->fetch(PDO::FETCH_ASSOC);



return $brand;

}

function search($data){

    

    
if (isset($data)){
    $searching = $data;
    $searching = preg_replace(" #[^0-9a-z]#", " ", $searching);
    $query = "SELECT * FROM brands WHERE brand_title LIKE '%$searching%' OR brand_link LIKE '%$searching%' ";
   
    $sth = $this->conn->prepare($query);
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
    
}

}




// function __toString(){

//     return $this->brand_title;
// }
function softdelelte($id = null){

    if (empty($id)) {
        return;
        }

        $query = "UPDATE brands SET  is_deleted = 1 WHERE id=:id;";

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

       
    $query = "DELETE FROM `brands` WHERE `brands`.`id` = :id;";
    $sth = $this->conn->prepare($query);
    $sth->bindParam(':id',$id);
    $result = $sth->execute();
     return $result;


}




function update($data){

if (empty($data)) {
   return;
}



//     if(array_key_exists('is_active',$data)){
//     $data['is_active'] = 1;
// }
// else{
//     $data['is_active']= 0;
// }


//prepare data
$this->prepare($data);
    


            $query = "UPDATE `brands` SET `brand_title` = :brand_title,
            `brand_link` = :brand_link, 
            `picture` = :picture,
            `is_active` = :is_active,
          
            `modified_at` = :modified_at WHERE `brands`.`id` = :id;";

$sth = $this->conn->prepare($query);
$sth->bindParam(':id',$this->id);
$sth->bindParam(':brand_title',$this->brand_title);
$sth->bindParam(':brand_link',$this->brand_link);
$sth->bindParam(':picture',$this->picture);
$sth->bindParam(':is_active',$this->is_active);
$sth->bindParam(':modified_at',$this->modified_at);
$result = $sth->execute();

return $result;

}

//prepare data
private function prepare($data){
 


    $this->brand_title = $data['brand_title'];
    $this->brand_link = $data['brand_link'];
    $this->is_active = $data['is_active'];
    $this->picture = $data['picture'];

    $this->modified_at = date('Y-m-d h:i:s', time());

    if (empty($data['is_active'])) {
    $data['is_active'] =1;}

       if (array_key_exists('id',$data) && !empty($data['id'])) {
        $this->id = $data['id'];
       }

    if(!$this->id){
            $this->created_at = date('Y-m-d h:i:s', time());
        }
        
  
}




}
    


?>

