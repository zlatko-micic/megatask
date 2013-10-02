<?php
Class File_model extends CI_Model {
    
	function checkUserPrivilege($user_id, $file_id) {
		//check if user is allowed to see this file
		
		$this->db->select('files.id, files.original_file_name, files.server_file_name');
		$this->db->from('files');
		$this->db->join('messages', 'messages.id = files.message_id', 'left');
		$this->db->join('tasks', 'tasks.id = messages.task_id', 'left');
		$this->db->join('task_users', 'task_users.task_id = tasks.id', 'left');
		$this->db->where('files.id', $file_id);
		$this->db->where('task_users.user_id', $user_id);
		
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return false;
		}
		
	}
	
}