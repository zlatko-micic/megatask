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
		
		$this->db->select('tasks.id as task_id,
			tasks.title,
			tasks.description,
			tasks.date_created,
			tasks.active,
			tasks.priority,
			tasks.due_date,
			tasks.date_finished,
			users.name as admin_name,
			users.surname as admin_lastname,
			u_d.name as done_name,
			u_d.surname as done_last_name,
			projects.id as project_id,
			projects.title as project,
			GROUP_CONCAT(DISTINCT(u.name)) as names,
			GROUP_CONCAT(DISTINCT(u.surname)) as last_names');
		$this->db->from('tasks');
		$this->db->join('users', 'users.id = tasks.user_id', 'left');
		$this->db->join('users u_d', 'u_d.id = tasks.finished_by', 'left');
		$this->db->join('task_users', 'task_users.task_id = tasks.id ', 'left');
		$this->db->join('projects', 'projects.id = tasks.project_id', 'left');
		$this->db->join('users u', 'u.id = task_users.user_id', 'left');
		
		$this->db->where('tasks.id', $id);
		
		$query = $this->db->get();
		
		if ($query -> num_rows() > 0) {
			return $query->result();
		}
		else {	
			return false;
		}
	}
    
	function taskMessages($id) {
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
	
	function setMessage($message,$user_id,$task_id) {
		//set users message
		$this->db->set('text', $message);
		$this->db->set('user_id', $user_id);
		$this->db->set('task_id', $task_id);
		$this->db->insert('messages');
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	function setMessageFile($name,$server_name,$message_id) {
		//set users message
		$this->db->set('original_file_name', $name);
		$this->db->set('server_file_name', $server_name);
		$this->db->set('message_id', $message_id);
		$this->db->insert('files');
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
}