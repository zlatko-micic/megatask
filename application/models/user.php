<?php
Class User extends CI_Model {
    
	function login($username, $password) {
		$this -> db -> select('id, name');
		$this -> db -> from('users');
		$this -> db -> where('email', $username);
		$this -> db -> where('password', $password);
		$this -> db -> limit(1);
		
		$query = $this -> db -> get();
		
		if($query -> num_rows() == 1) {
			return $query->result();
		}
		else {
			return false;
		}
	}
 
	function is_email_registered($email) {
		$this -> db -> select('id');
		$this -> db -> from('users');
		$this -> db -> where('email', $email);
		$this -> db -> limit(1);
		
		$query = $this -> db -> get();
		
		if($query -> num_rows() == 1) {
			return $query->result();
		}
		else {
			return false;
		}
	}

	function register($email, $password, $name, $surname) {
		$this -> db -> set('email', $email);
		$this -> db -> set('password', $password);
		$this -> db -> set('name', $name);
		$this -> db -> set('surname', $surname);
		$this -> db -> insert('users');
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
 
}