<?php

class DB {
    public static $connection;
    public function __construct(){
        if(!isset(self::$connection)){
            try{
				self::$connection=new PDO("mysql:host=localhost;dbname=igeo2017", "tijana", "chadmajkl", 
						array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)); // uzimati podatke iz config.php
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
        }
    }

    public function __destruct(){
        self::$connection = null;
    }
}	

$conn = new DB();

//$me = new Member();
//$me->id = 3;
//echo $conn->getTeamId('Serbia')[0]->id;
//echo $conn->getTeamleaderCount(1);
//echo json_encode($conn->getTeamPhoto(1));
//echo json_encode($conn->getMemberInfo(3));
//echo $conn->getMembers(1)[1]->country;
//echo json_encode($conn->addMember(3, $me));
//echo json_encode($conn->deleteMember(5));
//echo json_encode($conn->uploadPhoto(1, 'tijanaaaSlika.jpg'));
//echo $conn->getTeam("tijjana@hotmail.com", "chad")[0]->email; 
?>