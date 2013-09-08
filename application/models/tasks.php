<?php
Class Tasks extends CI_Model {
    
	function checkUserPrivilege($user_id, $task_id) {
		/*
		 * check if user is allowed to see the task
		 * check if the user is part of the project 
		 */
		
		$this->db->select('tasks.id');
		$this->db->from('tasks');
		$this->db->join('projects', 'projects.id = tasks.project_id', 'left');
		$this->db->join('project_users', 'project_users.project_id = projects.id', 'left');
		$this->db->where('project_users.user_id', $user_id);
		$this->db->where('tasks.id', $task_id);
		
		$query = $this -> db -> get();
		
		if($query -> num_rows() > 0) {
			return TRUE;
		}
		else {
			return FALSE;
		}
		
	}
	
	function getTaskInfo($id) {
		//get main infos about task
		
		$this->db->select('tasks.id,
			tasks.name,
			tasks.description,
			tasks.date_created,
			tasks.done,
			tasks.priority,
			tasks.due,
			tasks.due_date,
			tasks.date_done,
			users.name as owner_name,
			users.surname as last_name,
			u_d.name as done_name,
			u_d.last_name as done_last_name,
			GROUP_CONCAT(DISTINCT(u.name)) as names,
			GROUP_CONCAT(DISTINCT(u.surname)) as last_names,
			GROUP_CONCAT(DISTINCT(u.avatar)) as avatars,
			GROUP_CONCAT(DISTINCT(a.name)) as attachments,
			GROUP_CONCAT(DISTINCT(a.original_name)) as attachments_names');
		$this->db->from('tasks');
		$this->db->join('users u', 'find_in_set(u.id, tasks.users)', 'left');
		$this->db->where('working_hours.task_id', $id);
		
		$query = $this->db->get();
		
		if ($query -> num_rows() > 0) {
			return $query->result();
		}
		else {	
			return false;
		}
	}
    
	function taskMessages($id, $user_id) {
		//get messages and their authors
		$this->db->select('messages.text, messages.date, users.id, users.name, users.surname');
		$this->db->from('messages');
		$this->db->join('users', 'users.id = messages.user_id', 'left');
		$this->db->where('task_id', $id);
		//$this -> db -> limit(1);
		
		$query = $this->db->get();
		
		if ($query -> num_rows() > 0) {
			return $query->result();
		}
		else {	
			return false;
		}
	}
	
	function taskWorkingHours($id) {
		//get working hours and their users
		$this->db->select('working_hours.id,
			working_hours.started as date,
			working_hours.started,
			working_hours.finished,
			working_hours.description,
			users.id as user_id,
			users.name,
			users.surname, TIMEDIFF(working_hours.finished,working_hours.started) AS time_done', false);
		$this->db->from('working_hours');
		$this->db->join('users', 'users.id = working_hours.user_id', 'left');
		$this->db->where('working_hours.task_id', $id);
		
		$query = $this->db->get();
		
		if ($query -> num_rows() > 0) {
			return $query->result();
		}
		else {	
			return false;
		}
	}
}