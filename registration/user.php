<?php
class User {
	var $ID;
	var $Email;
	var $Password;
	var $Role;
	
	function __construct($email, $password, $role){
		$this->Email = $email;
		$this->Password = $password;
		$this->Role = $role;
	}
}	
?>