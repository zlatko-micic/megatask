<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_work extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('work_model','',TRUE);
		$this->load->model('project_model','',TRUE);
		$this->load->library('form_validation');
	}
	
	function index() {
		//page details
		$data['page_details']['id'] = 8;
		
		if ($this->session->userdata('logged_in')) {
			//get session data
			$data['session_data'] = $this->session->userdata('logged_in');
			
			/*
			 * check if user can edit this work
			 * get all informations about work
			 */
			
			
			
			
			if ($this->work_model->userAccess($data['session_data']['user_id'], $this->uri->segment(2))) {
				//user is allowed to see and change details
				
				$this->form_validation->set_rules('started', "Started", 'trim|required|xss_clean|callback_checkDateTime');
				$this->form_validation->set_rules('ended', "Ended", 'trim|required|xss_clean|callback_checkDateTime');
				$this->form_validation->set_rules('description', "Description", 'trim|xss_clean');
				
				if ($this->form_validation->run()) {
					//success! change data
					
					$edit_result = $this->work_model->updateWork($this->uri->segment(2),
							$this->input->post('started'),
							$this->input->post('ended'),
							$this->input->post('description'));
					
					if ($edit_result) {
						$data['change']['suscces'] = true;
						$data['change']['message'] = 'Changes saved.';
					}
					else {
						$data['change']['suscces'] = false;
						$data['change']['message'] = 'There was a problem. Please try again.';
					}
					
					
				}
				else {
					//submit fail
					$data['change']['suscces'] = false;
					$data['change']['message'] = validation_errors();
				}
				
				//get all details
				$data['working_details'] = $this->work_model->getDetails($data['session_data']['user_id'], $this->uri->segment(2));
				
				//get all projects
				$data['my_projects'] = $this->project_model->userProjects($data['session_data']['user_id']);
				
				$this->template->load('template', 'edit_work_view', $data);
			}
			else {
				//not allowed. redirect to home
				redirect('/', 'refresh');
			}
			
		}
		else {
			//not logged in
			redirect('login', 'refresh');
		}
	}
	
	function checkDateTime($value) {		
		if (checkDateTime($value)) { 
			return true;
		}
		else {
			$this->form_validation->set_message('checkDateTime', 'Not valid datetime format');
			return false;
		}
	}

}