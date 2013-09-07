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
    
	function taskMessages($id, $user_id) {
            
            //check if user can see this task
		//get messages and their authors
		$this->db->select('messages.text, messages.date, users.id, users.name, users.surname');
		$this->db->from('messages');
		$this->db->join('users', 'users.id = messages.user_id', 'left');
		$this->db->where('task_id', $id);
		//$this -> db -> limit(1);
		
		$query = $this -> db -> get();
		
		if($query -> num_rows() > 0) {
			return $query->result();
		}
		else {
                    
			return false;
		}
            
	}
}