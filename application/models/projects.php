<?php
Class Projects extends CI_Model {
	
	function projectDetails($project_id) {
		//get main infos about task
		
		$this->db->select('projects.id,
			projects.title,
			projects.date_created,
			users.id as owner_id,
			users.name as owner_name,
			users.surname as last_name,
			GROUP_CONCAT(DISTINCT(u.name)) as names,
			GROUP_CONCAT(DISTINCT(u.surname)) as last_names,
			GROUP_CONCAT(DISTINCT(u.id)) as ids');
		$this->db->from('projects');
		$this->db->join('users', 'users.id = projects.user_id ', 'left');
		$this->db->join('project_users', 'project_users.project_id = projects.id ', 'left');
		
		$this->db->join('users u', 'users.id = project_users.user_id ', 'left');
		
		$this->db->where('projects.id', $project_id);
		$this->db->where('project_users.project_id', $project_id);
		
		$query = $this->db->get();
		
		if ($query -> num_rows() > 0) {
			return $query->result();
		}
		else {	
			return false;
		}
	}
	
	function userProjects($user_id) {
		//get all project for user
		
		$this->db->select('projects.id,
			projects.title');
		$this->db->from('projects');
		$this->db->join('project_users', 'project_users.project_id = projects.id ', 'left');		
		$this->db->where('project_users.user_id', $user_id);
		
		$query = $this->db->get();
		
		if ($query -> num_rows() > 0) {
			return $query->result();
		}
		else {	
			return false;
		}
	}
	
	function insertProject($title, $user_id) {
		//Insert project in DB
		$data = array (
			'title' => $title,
			'user_id' => $user_id,
		);
		
		$this->db->insert('projects', $data);
		
		return ($this->db->affected_rows() < 1) ? false : true;
		
	}
	
	function addUser($project_id, $user_id, $active = 1, $date, $checked, $email_notification = 0) {
		//Insert user for project
		$data = array (
			'user_id' => $user_id,
			'project_id' => $project_id,
			'active' => $active,
			'date_accept' => $date,
			'checked' => $checked,
			'email_notification' => $email_notification
		);
		
		$this->db->insert('project_users', $data);
		
		return ($this->db->affected_rows() < 1) ? false : true;
		
	}
	
	function checkUserPrivilege($user_id, $project_id) {
		/*
		 * check if user is allowed to see the project
		 */
		
		$this->db->select('id');
		$this->db->from('project_users');
		$this->db->where('user_id', $user_id);
		$this->db->where('project_id', $project_id);
		
		$query = $this -> db -> get();
		
		if($query -> num_rows() > 0) {
			return TRUE;
		}
		else {
			return FALSE;
		}
		
	}
	
	function getWorkingHours($project_id) {
		/*
		 * check if user is allowed to see the project
		 */
		
		$this->db->select('working_hours.id,
			working_hours.started,
			working_hours.finished,
			working_hours.description,
			users.id as user_id,
			users.name,
			users.surname,
			DATE(working_hours.started) as date, 
			TIMEDIFF(working_hours.finished,working_hours.started) AS time_done,
			TIMESTAMPDIFF(SECOND,working_hours.started,working_hours.finished) as seconds', false);
		$this->db->from('working_hours');
		$this->db->join('users', 'users.id = working_hours.user_id', 'left');
		$this->db->join('tasks', 'tasks.id = working_hours.task_id', 'left');
		$this->db->join('projects', 'projects.id = tasks.project_id', 'left');
		$this->db->where('projects.id', $project_id);
		
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else {	
			return false;
		}
		
	}
	
	function is_email_in_project($email,$project) {
		$this->db->select('users.id');
		$this->db->from('users');
		$this->db->join('project_users', 'project_users.user_id = users.id', 'left');
		$this->db->where('users.email', $email);
		$this->db->where('project_users.project_id', $project);
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		if($query->num_rows() == 1) {
			return $query->result();
		}
		else {
			return false;
		}
	}
	
	function is_invitation_sent($email,$project) {
		$this->db->select('id');
		$this->db->from('invitations');
		$this->db->where('email', $email);
		$this->db->where('project_id', $project);
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		if($query->num_rows() == 1) {
			return $query->result();
		}
		else {
			return false;
		}
	}
	
	function is_project_admin($project,$user_id) {
		$this->db->select('id');
		$this->db->from('projects');
		$this->db->where('id', $project);
		$this->db->where('user_id', $user_id);
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		if($query->num_rows() == 1) {
			return $query->result();
		}
		else {
			return false;
		}
	}
	
}