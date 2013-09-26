<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class A_join_project extends CI_Controller {
	
	public function index() {
		$this->home();
		$this->load->library('form_validation');
		$this->load->model('user_model','',TRUE);
	}
	
	function home() {
		if ($this->session->userdata('logged_in')) {
			//user is logged in
			
			$this->load->library('form_validation');
			
			//get session data
			$data['session_data'] = $this->session->userdata('logged_in');
			
			//validate form (new project create)
			$this->form_validation->set_rules('accept', 'Response', 'trim|required|xss_clean|is_natural_no_zero|');
			$this->form_validation->set_rules('invitation', 'Project id', 'trim|required|is_natural_no_zero|xss_clean|callback_checkUserInvitation');
			
			if ($this->form_validation->run() == FALSE) { // form not submited
				$json['success'] = false;
				$json['message'] = validation_errors();
			}
			else { //form is submited
				
				//update invitation details
				if($this->user_model->acceptInvitation($this->input->post('invitation'), $this->input->post('accept'))) {
					$json['success'] = true;
					$json['message'] = $this->input->post('invitation') . " xxx ". $this->input->post('accept');
				}
				else {
					//problem creating the project
					$json['success'] = false;
					$json['message'] = "There was a problem. Please try again.";
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
		print json_encode($json);
	}
	
	function checkUserInvitation($value) {
		
		$session_data = $this->session->userdata('logged_in');
		$this->load->model('user_model','',TRUE);
		
		$result = $this->user_model->checkUserInvitation($session_data['user_id'],$value);
		
		if ($result) {
			//is invited
			return TRUE;
		}
		else {
			//not invited
			$this->form_validation->set_message('checkUserInvitation', 'Wrong parameters');
			return FALSE;
		}
	}
}