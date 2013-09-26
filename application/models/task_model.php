<?php
Class Task_model extends CI_Model {
    
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
	
	function comingTasks($user_id) {
		/*
		 * Tasks that have to be finished soon 
		 */
		
		$this->db->select('tasks.id, tasks.title, tasks.due_date, projects.title as project');
		$this->db->from('tasks');
		$this->db->join('task_users', 'task_users.task_id = tasks.id', 'left');
		$this->db->join('projects', 'projects.id = tasks.project_id', 'left');
		$this->db->where('task_users.user_id', $user_id);
		$this->db->where('tasks.active', 1);
		$this->db->where('tasks.due_date !=','0000-00-00 00:00:00');
		$this->db->where('tasks.due_date <=','DATE_ADD(NOW(),INTERVAL 7 DAYS )');
		$this->db->order_by('tasks.due_date', 'asc');
		
		$query = $this->db-> get();
		
		if($query -> num_rows() > 0) {
			return $query->result();
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
			GROUP_CONCAT(DISTINCT(u.id)) as ids,
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
		$this->db->select('messages.text as textmessage, messages.date, users.id, users.name, users.surname, files.id as file_id, files.original_file_name');
		$this->db->from('messages');
		$this->db->join('users', 'users.id = messages.user_id', 'left');
		$this->db->join('files', 'files.message_id = messages.id', 'left');
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
		//get working hours and their users for particular task
		$this->db->select('working_hours.id,
			working_hours.started as date,
			working_hours.started,
			working_hours.finished,
			working_hours.description,
			users.id as user_id,
			users.name,
			users.surname,
			TIME_TO_SEC(TIMEDIFF(working_hours.finished,working_hours.started)) AS seconds,
			TIMEDIFF(working_hours.finished,working_hours.started) AS time_done', false);
		$this->db->from('working_hours');
		$this->db->join('users', 'users.id = working_hours.user_id', 'left');
		$this->db->where('working_hours.task_id', $id);
		$this->db->order_by('working_hours.started', 'desc');
		
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
	
	function createTask($title, $description, $user_id, $project_id, $priority, $due_date) {
		//create new task
		$data = array (
			'title' => $title,
			'description' => $description,
			'user_id' => $user_id,
			'project_id' => $project_id,
			'active' => 1,
			'priority' => $priority,
			'due_date' => $due_date,
		);
		
		$this->db->insert('tasks', $data);
		
		return ($this->db->affected_rows() < 1) ? false : true;
		
	}
	
	function addUser($user_id, $task_id) {
		//assign user for task
		$data = array (
			'user_id' => $user_id,
			'task_id' => $task_id
		);
		
		$this->db->insert('task_users', $data);
		
		return ($this->db->affected_rows() < 1) ? false : true;
		
	}
	
	function projectTasks($project_id) {
		//get all task for project
		$this->db->select('tasks.id,
			tasks.title,
			tasks.description,
			tasks.active,
			tasks.priority,
			tasks.due_date,
			GROUP_CONCAT(DISTINCT(task_users.user_id)) as user_ids');
		$this->db->from('tasks');
		$this->db->join('task_users', 'task_users.task_id = tasks.id', 'left');
		$this->db->where('tasks.project_id', $project_id);
		$this->db->group_by('tasks.id');
		
		$query = $this->db->get();
		
		if ($query -> num_rows() > 0) {
			return $query->result();
		}
		else {	
			return false;
		}
	}
	
	
	
}