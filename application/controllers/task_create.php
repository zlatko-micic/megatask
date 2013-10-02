<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task_create extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('project_model','',TRUE);
		$this->load->model('task_model','',TRUE);
		$this->load->model('user_model','',TRUE);
		$this->load->library('form_validation');
	}
	
	function index() {
		//page details
		$data['page_details']['id'] = 6;
		
		if ($this->session->userdata('logged_in')) {
			//get session data
			$data['session_data'] = $this->session->userdata('logged_in');
			
			//check if user can create a task for this project
			if ($this->project_model->checkUserPrivilege($data['session_data']['user_id'], $this->uri->segment(2))) {
				//user is allowed to create
				
				//validate form (create task)
				$this->form_validation->set_rules('title', "Task title", 'trim|required|min_length[3]|xss_clean');
				$this->form_validation->set_rules('description', "Title description", 'trim|xss_clean');
				//$this->form_validation->set_rules('project', "Project", 'trim|xss_clean|required|is_natural_no_zero');
				$this->form_validation->set_rules('due_date', "Due date", 'trim|xss_clean|callback_checkDateTime');
				$this->form_validation->set_rules('task_user[]', "Task user", 'trim|required|xss_clean|is_natural_no_zero|callback_checkProjectUsers');
				
				if ($this->form_validation->run() == FALSE) {
					//false. nothing happening
				}
				else {
					//create task
					
					$due_date = $this->input->post('due_date') != '' ? $this->input->post('due_date') : '0000-00-00 00:00:00';
					if ($this->task_model->createTask($this->input->post('title'),
												$this->input->post('description'),
												$data['session_data']['user_id'],
												$this->uri->segment(2),
												1,
												$due_date)) {
						//task created
						$task_id = $this->db->insert_id();
						
						$task_users = $this->input->post('task_user');
						
						foreach ($task_users as $row) {
							$this->task_model->addUser($row, $task_id);
						}
						
						//redirect to this task
						redirect('/task/'. $task_id , 'refresh');
					}
					else {
						//error creating task
						$data['error_message'] = 'There was an error and we could not creat a task!';
					}
				}
				
				$data['post_string'] = array(
					's_title' => $this->input->post('title'),
					's_description' => $this->input->post('description'),
					's_due_date' => $this->input->post('due_date'),
					'a_task_user' => $this->input->post('task_user')
				 );
				
				 $data['post_string']['a_task_user'] = is_array($this->input->post('task_user')) ? $this->input->post('task_user') : array();
				
				
				//get all projects
				$data['my_projects'] = $this->project_model->userProjects($data['session_data']['user_id']);
				
				//get project informations
				$data['project_info'] = $this->project_model->projectDetails($this->uri->segment(2));
				
				//get all users of this project
				$data['project_users'] = $this->project_model->projectUsers($this->uri->segment(2));
				
				//is user working on task
				$data['now_woring_task'] = $this->user_model->isWorkingOnTask($data['session_data']['user_id']);
				
				$this->template->load('template', 'task_create_view', $data);
			}
			else {
				//not allowed to create. redirect to home
				redirect('/', 'refresh');
			}
			
		}
		else {
			//not logged in
			redirect('login', 'refresh');
		}
	}
	
	function checkDateTime($value) {		
		if (!isset($value)) {
			//date/time not set
			return TRUE;
		}
		else {
			//date-time set
			if (checkDateTime($value)) { 
				return true;
			}
			else {
				$this->form_validation->set_message('checkDateTime', 'Not valid datetime format');
				return false;
			}
		}
	}
	
	function checkProjectUsers($value) {	
		//check if users id is in project
		$project = $this->uri->segment(2);
				
		$result = $this->project_model->checkUserPrivilege($value, $project);
		
		if ($result) {
			return TRUE;
		}
		else {
			$this->form_validation->set_message('checkProjectUsers', 'User error');
			return false;
		}
	}

}