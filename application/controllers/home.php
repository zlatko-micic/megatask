<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('user_model','',TRUE);
		$this->load->model('project_model','',TRUE);
		$this->load->model('task_model','',TRUE);
	}

	function index() {
		//page details
		$data['page_details']['id'] = 3;
		
		if ($this->session->userdata('logged_in')) {
			//user is logged in
			
			//get session data
			$data['session_data'] = $this->session->userdata('logged_in');
			
			//load project model
			

			//get all projects
			$data['my_projects'] = $this->project_model->userProjects($data['session_data']['user_id']);
			
			//get all pending projects
			$data['pending_projects'] = $this->project_model->pendingProjects($data['session_data']['user_id']);
			
			//is user working on task
			$data['now_woring_task'] = $this->user_model->isWorkingOnTask($data['session_data']['user_id']);
			
			//Tasks that have to be finished soon
			$data['due_task'] = $this->task_model->comingTasks($data['session_data']['user_id']);
			
			//load template
			$this->template->load('template', 'home_view', $data);
		
		}
		else {
			//If no session, redirect to login page
			$this->template->load('template', 'login_view');
		}
	}
	
	function logout() {
		$this->session->unset_userdata('logged_in');
		//session_destroy();
		$this->session->sess_destroy();
		$this->template->load('template', 'login_view' );
	}



}