<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_task_end extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('task_model');
	}
	
	function index() {
		if ($this->session->userdata('logged_in')) {
			//user is logged in
			
			//get session data
			$data['session_data'] = $this->session->userdata('logged_in');
			
			//validate form (new project create)
			$this->form_validation->set_rules('task_id', 'Task ID', 'trim|required|xss_clean|is_natural_no_zero');
			
			if ($this->form_validation->run() == FALSE) {
				// form not submited
				$json['success'] = false;
				$json['message'] = validation_errors();
			}
			else {
				//form is submited
				
				//check if user can close this task (is user assigned for task)
				if ($this->task_model->checkUserPrivilege($data['session_data']['user_id'], $this->input->post('task_id'))) {
					//user is assigned for task
					
					//check if task is completed
					if ($this->task_model->isCompleted($this->input->post('task_id'))) {
						$json['success'] = false;
						$json['message'] = "This task is already completed.";
					}
					else {
						$time_now = date("Y-m-d H:i:s");
						if ($this->task_model->closeTask($this->input->post('task_id'), $data['session_data']['user_id'], $time_now)) {
							$json['success'] = true;
						}
						else {
							$json['success'] = false;
							$json['message'] = "Something went wrong. Please try again.";
						}
					}
				}
				else {
					$json['success'] = false;
					$json['message'] = "You are not allowed to perform this operation.";
				}
			}
		}
		else {
			//no session, redirect to login page
			$json['success'] = false;
			$json['message'] = "You are logged out";
		}
		
		//echo the result
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($json);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */