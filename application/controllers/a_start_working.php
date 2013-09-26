<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class A_start_working extends CI_Controller {
	
	public function index() {
		$this->home();
		$this->load->library('form_validation');
		//parent::__construct();
	}
	
	function home() {
		if ($this->session->userdata('logged_in')) {
			//user is logged in
			
			$this->load->library('form_validation');
			
			//get session data
			$data['session_data'] = $this->session->userdata('logged_in');
			
			//validate form (new project create)
			$this->form_validation->set_rules('task', 'Task id', 'trim|required|xss_clean|is_natural_no_zero');
			
			if ($this->form_validation->run() == FALSE) {
				// form not submited
				$json['success'] = false;
				$json['message'] = validation_errors();
			}
			else {
				//check if working on another task
				$this->load->model('user_model','',FALSE);
				$this->load->model('task_model','',FALSE);
				
				$result = $this->user_model->isWorkingOnTask($data['session_data']['user_id']);
				if ($result) {
					//already working on task
					$json['success'] = false;
					$json['message'] = "You are already working on task ". $result[0]->title;
					
					$json['diff'] = intval($result[0]->diff);
				}
				else {
					//check if user is allowed to work on this task
					if ($this->task_model->checkUserPrivilege($data['session_data']['user_id'], $this->input->post('task'))) {
						if ($this->user_model->startWorkingOnTask($data['session_data']['user_id'], $this->input->post('task'))) {
							$json['success'] = true;
						}
						else {
							$json['success'] = false;
							$json['message'] = "There was an error. Please try again";
						}
						
					}
					else {
						$json['success'] = false;
						$json['message'] = "You are not allowed to work on this task";
					}
					
					
					
					
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
	
	function stop() {
		if ($this->session->userdata('logged_in')) {
			//user is logged in
			
			$data['session_data'] = $this->session->userdata('logged_in');
			
			$this->load->model('user_model','',FALSE);
			
			$result = $this->user_model->isWorkingOnTask($data['session_data']['user_id']);
			
			if ($result) {
					//already working on task
					
					$json['diff'] = intval($result[0]->diff);
					
					$time_now = date("Y-m-d H:i:s");
					
					$close_result = $this->user_model->closeTask($data['session_data']['user_id'], $time_now );
					
					if ($close_result)  {
						$json['success'] = true;
					}
					else {
						$json['success'] = false;
						$json['message'] = "Something went wrong";
					}
					
			}
			else {
				$json['success'] = false;
				$json['message'] = "No opened tasks";
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