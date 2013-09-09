<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('tasks','',TRUE);
	}
	
	function index() {
		if ($this->session->userdata('logged_in')) {
			
			//get session data
			$data['session_data'] = $this->session->userdata('logged_in');
			
			//to do - do chekings on $this->uri->segment(2)
			
			//check if user is allowed to see this task
			if ($this->tasks->checkUserPrivilege($data['session_data']['user_id'], $this->uri->segment(2))) {
				//user is allowed to see this task
				
				//get messages
				$data['messages'] = $this->tasks->taskMessages($this->uri->segment(2), $this->session->userdata('user_id'));
				
				//get working hours
				$data['working_hours'] = $this->tasks->taskWorkingHours($this->uri->segment(2));
					
				//die($data['messages'][0]->name);		
				$this->template->load('template', 'task_view', $data);
				
			}
			else {
				//user is NOT allowed to see this task
				redirect('home', 'refresh');
			}
		}
		else {
			//not logged in
			redirect('login', 'refresh');
		}
	}

}