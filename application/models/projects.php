<?php
Class Projects extends CI_Model {
    
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
	
}