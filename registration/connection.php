<?php

class DB {
    public static $connection;
    public function __construct(){
        if(!isset(self::$connection)){
            try{
				self::$connection=new PDO("mysql:host=localhost;dbname=eprint", "tijana", "chadmajkl", 
						array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)); // uzimati podatke iz config.php
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
        }
    }

    public function __destruct(){
        self::$connection = null;
    }
	
	public function checkMailOccupancy($email){
		$query = self::$connection->prepare("select * from users where Email=:email;");
		$query->bindParam(':email',$email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
		echo "COUNT: " . count($result) . "<br>Compare:" . count($result) == 0 . "<br>";
        return $result;
	}
	
	public function insertUser($email, $pass){
		try{
			$query = self::$connection->prepare("insert into users (Email, Password, Role)
					values (:email, :pass, :role);");
			$role = 2;
			$query->bindParam(':email',$email, PDO::PARAM_STR);
			$query->bindParam(':pass',$pass, PDO::PARAM_STR);
			$query->bindParam(':role', $role, PDO::PARAM_INT);
			$query->execute();
			if($query->rowCount() > 0){
				return true;
			} else {
				print_r(self::$connection->errorInfo());
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
	
	public function loginCheck($email, $pass){
		try{
			$query = self::$connection->prepare("select * from users where Email=:email;");
			$query->bindParam(':email',$email, PDO::PARAM_STR);
			$query->execute();
			$row_count = $query->rowCount();
			if($row_count === 1){
				$query = self::$connection->prepare("select * from users where Email=:email and Password=:pass;");
				$query->bindParam(':email',$email, PDO::PARAM_STR);
				$query->bindParam(':pass',$pass, PDO::PARAM_STR);
				$query->execute();
				$row_count = $query->rowCount();
				if($row_count === 1){
					return $query->fetchAll(PDO::FETCH_OBJ);
				} else if($row_count === 0){
					return 0; /*pogresna lozinka*/
				}
			} else if($row_count === 0){
				return null; /*ne postoji u bazi*/
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
			return null;
		}		
	}
}	

$conn = new DB();

//echo $conn->insertUser('tijjana@hotmail.com', 'chadmajkl');
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