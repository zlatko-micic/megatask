<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('tasks','',TRUE);
	}
	
	function index() {
		if ($this->session->userdata('logged_in')) {
			//get session data
			$session_data = $this->session->userdata('logged_in');
			
			//to do - do chekings on $this->uri->segment(2)
		
			//get messages
			$data['messages'] = $this->tasks->taskMessages($this->uri->segment(2), $this->session->userdata('user_id'));
			$data['user_id'] = $this->session->userdata('user_id');
			
			
			if ($this->tasks->checkUserPrivilege($session_data['user_id'], $this->uri->segment(2))) {
				//user is allowed to see this task
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