<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_create_project extends CI_Controller {
	
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
			$this->form_validation->set_rules('title', 'Project title', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() == FALSE) {
				// form not submited
				$json['success'] = false;
				$json['message'] = validation_errors();
			}
			else {
				//form is submited
				
				//insert project into DB
				$this->load->model('project_model','',FALSE);
				
				if($this->project_model->insertProject($this->input->post('title'), $data['session_data']['user_id'])) {
					/* project in db
					 * add this user in user_project tabele
					 */
					$project_id = $this->db->insert_id();
					$date =  date("Y-m-d H:i:s");
					if($this->project_model->addUser($project_id, $data['session_data']['user_id'], 1, $date, 1, 0)) {
						//user added to project. send informations
						$json['success'] = true;
						$json['project_id'] = $project_id;
					}
					else {
						//problem adding admin of the project to users list
						$json['success'] = false;
						$json['message'] = "Project is created but with some problems. Please delete it and create another one.";
					}
					
					
				}
				else {
					//problem creating the project
					$json['success'] = false;
					$json['message'] = "There was a problem with creating a project. Please try again.";
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