<?php
Class User_model extends CI_Model {
    
	function login($username, $password) {
		$this->db->select('id, name, surname');
		$this->db->from('users');
		$this->db->where('email', $username);
		$this->db->where('password', $password);
		$this->db->limit(1);
		
		$query = $this->db-> get();
		
		if ($query -> num_rows() == 1) {
			return $query->result();
		}
		else {
			return false;
		}
	}
 
	function isWorkingOnTask($user_id) {
		//check if user is working on any task at the moment
		$this->db->select('working_hours.id,
						tasks.title,
						((-1000) * TIME_TO_SEC(TIMEDIFF(working_hours.started, NOW()))) as diff,
						TIMEDIFF(working_hours.started, NOW()) as time_diff'
						);
		$this->db->from('working_hours');
		$this->db->join('tasks', 'tasks.id = working_hours.task_id', 'left');
		$this->db->where('working_hours.user_id', $user_id);
		$this->db->where('working_hours.finished', '0000-00-00 00:00:00');
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		}
		else {
			return false;
		}
	}
	
	function startWorkingOnTask($user_id, $task_id) {
		$this->db->set('user_id', $user_id);
		$this->db->set('task_id', $task_id);
		$this->db->insert('working_hours');
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	function closeTask($user_id, $time) {
		//close any opened works
		$data = array('finished' => $time);

		$this->db->where('user_id', $user_id);
		$this->db->where('finished', '0000-00-00 00:00:00');
		$this->db->update('working_hours', $data);

		
		return ($this->db->affected_rows() != 1) ? false : true;
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
		//register a user
		$this->db->set('email', $email);
		$this->db->set('password', $password);
		$this->db->set('name', $name);
		$this->db->set('surname', $surname);
		$this->db->insert('users');
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	function projectInvite($user_id, $project_id, $date = '' , $date_a = '') {
		//invite registered user into a project
		$date = $date == '' ? date("Y-m-d H:i:s") : $date;
		$date_a = $date_a == '' ? '0000-00-00 00:00:00' : $date_a;
		
		$this->db->set('user_id', $user_id);
		$this->db->set('project_id', $project_id);
		$this->db->set('date_sent', $date);
		$this->db->set('date_accept', $date_a);
		$this->db->insert('project_users');
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	function checkUserInvitation($user_id, $invitation_id) {
		//check if the user is invited
		$this->db->select('id');
		$this->db->from('project_users');
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $invitation_id);
		$this -> db -> limit(1);
		
		$query = $this->db->get();
		
		if($query -> num_rows() > 0) {
			return $query->result();
		}
		else {
			return false;
		}
	}
	
	function acceptInvitation($invitation_id, $active) {
		//accept or reject invitation for project
		$data = array(
               'active' => $active
            );

		$this->db->where('id', $invitation_id);
		$this->db->update('project_users', $data);

		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	function sendInvite($email, $project_id) {
		//email invitation sent
		$this->db->set('email', $email);
		$this->db->set('project_id', $project_id);
		$this->db->insert('invitations');
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}	
	
	function getEmailInvitations($email) {
		//get all users invitation for his e-mail address
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
		//delete all users email invitations
		$this->db->where('email', $email);
		$this->db->delete('invitations');
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
}