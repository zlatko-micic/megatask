<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_delete_task extends CI_Controller {
	
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
			$this->form_validation->set_rules('task_id', 'Task ID', 'trim|required|is_natural_no_zero|xss_clean');
			
			if ($this->form_validation->run() == FALSE) {
				// form not submited
				$json['success'] = false;
				$json['message'] = validation_errors();
			}
			else {
				//form is submited
				
				//load model
				$this->load->model('task_model','',FALSE);
				
				if($this->task_model->checkUserAdminPrivilege($this->input->post('task_id'), $data['session_data']['user_id'])) {
					/* 
					 * user is admin of this task
					 * can delete it
					 */
					
					if($this->task_model->deleteTask($this->input->post('task_id'))) {
						//task deleted
						$json['success'] = true;
					}
					else {
						$json['success'] = false;
						$json['message'] = 'Something went worng';
						
					}
				}
				else {
					//problem creating the project
					$json['success'] = false;
					$json['message'] = "You don't have permission to do this.";
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