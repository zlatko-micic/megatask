<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
	}

	function index() {
		if ($this->session->userdata('logged_in')) {
			//user is logged in
			
			//get session data
			$data['session_data'] = $this->session->userdata('logged_in');
			
			//vlidate form (new project create)
			$this->form_validation->set_rules('title', 'Project title', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() == FALSE) {
				// form not submited
				$this->template->load('template', 'home_view', $data);
			}
			else {
				//form is submited
				
				//insert project into DB
				$this->load->model('projects','',TRUE);
				
				if($this->projects->insertProject($this->input->post('title'), $data['session_data']['user_id'])) {
					/* project in db
					 * add this user in user_project tabele
					 */
					$project_id = $this->db->insert_id();
					$date =  date("Y-m-d H:i:s");
					if($this->projects->addUser($project_id, $data['session_data']['user_id'], 1, $date, 1, 0)) {
						//user added to project. redirect to page
						redirect('project/' . $project_id, 'refresh');
					}
					else {
						//problem adding admin of the project to users list
						
						die('error #1');
					}
					
					
				}
				else {
					//problem creating the project
					die('error #2');
				}
				
				
			}
		
		}
		else {
			//If no session, redirect to login page
			//redirect('login', 'refresh');
			$this->template->load('template', 'login_view' );
		}
	}
	
	function logout() {
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('home', 'refresh');
	}



}