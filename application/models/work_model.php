<?php
Class Work_model extends CI_Model {
    
	function userAccess($user_id, $work_id) {
		//get all details of work
		$this->db->select('working_hours.id');
		$this->db->from('working_hours');
		$this->db->where('working_hours.id', $work_id);
		$this->db->where('working_hours.user_id', $user_id);
		$this->db->where('working_hours.finished !=', '0000-00-00 00:00:00');
		$this->db->limit(1);
		
		$query = $this->db-> get();
		
		return $query->num_rows() == 1 ? TRUE : FALSE;
	}
	
	function getDetails($user_id, $work_id) {
		//get all details of work
		$this->db->select('working_hours.id, 
							  working_hours.started, 
							  working_hours.finished,
							  working_hours.description,
							  tasks.id as task_id,
							  tasks.title as task_title,
							  projects.id as project_id,
							  projects.title as project_title');
		$this->db->from('working_hours');
		$this->db->join('tasks', 'tasks.id = working_hours.task_id', 'left');
		$this->db->join('projects', 'projects.id = tasks.project_id', 'left');
		$this->db->where('working_hours.id', $work_id);
		$this->db->where('working_hours.user_id', $user_id);
		$this->db->where('working_hours.finished !=', '0000-00-00 00:00:00');
		$this->db->limit(1);
		
		$query = $this->db-> get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		}
		else {
			return false;
		}
		
	}
	
	function updateWork($id, $started, $finished, $description) {
		//update work details
		$data = array('started' => $started,
			'finished' => $finished,
			'description' => $description);

		$this->db->where('id', $id);
		$this->db->update('working_hours', $data);

		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	
}