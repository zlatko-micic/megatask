<?php
Class User extends CI_Model {
    
	function login($username, $password) {
		$this -> db -> select('id, name');
		$this -> db -> from('users');
		$this -> db -> where('email', $username);
		$this -> db -> where('password', $password);
		$this -> db -> limit(1);
		
		$query = $this -> db -> get();
		
		if ($query -> num_rows() == 1) {
			return $query->result();
		}
		else {
			return false;
		}
	}
 
	function is_email_registered($email) {
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('email', $email);
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		}
		else {
			return false;
		}
	}

	function register($email, $password, $name, $surname) {
		$this->db->set('email', $email);
		$this->db->set('password', $password);
		$this->db->set('name', $name);
		$this->db->set('surname', $surname);
		$this->db->insert('users');
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	function projectInvite($user_id, $project_id, $date = '' , $date_a = '') {
		$date = $date == '' ? date("Y-m-d H:i:s") : $date;
		$date_a = $date_a == '' ? '0000-00-00 00:00:00' : $date_a;
		
		$this->db->set('user_id', $user_id);
		$this->db->set('project_id', $project_id);
		$this->db->set('date_sent', $date);
		$this->db->set('date_accept', $date_a);
		$this->db->insert('project_users');
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	function sendInvite($email, $project_id) {
		$this->db->set('email', $email);
		$this->db->set('project_id', $project_id);
		$this->db->insert('invitations');
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}	
	
	function getEmailInvitations($email) {
		$this->db->select('project_id');
		$this->db->select('date_sent');
		$this->db->from('invitations');
		$this->db->where('email', $email);
		
		$query = $this->db->get();
		
		if($query -> num_rows() > 0) {
			return $query->result();
		}
		else {
			return false;
		}
	}
	
	function deleteEmailInvitations($email) {
		$this->db->where('email', $email);
		$this->db->delete('mytable');
		
		$query = $this->db->get();
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
}