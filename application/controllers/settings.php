<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_model','',TRUE);
		$this->load->model('project_model','',TRUE);
	}
	
	function index() {
		//page details
		$data['page_details']['id'] = 9;
		
		if ($this->session->userdata('logged_in')) {
			
			//get session data
			$data['session_data'] = $this->session->userdata('logged_in');

			//get all projects
			$data['my_projects'] = $this->project_model->userProjects($data['session_data']['user_id']);

			//is user working on task
			$data['now_woring_task'] = $this->user_model->isWorkingOnTask($data['session_data']['user_id']);

			$this->template->load('template', 'settings_view', $data);
			
		}
		else {
			//not logged in
			redirect('login', 'refresh');
		}
	}
}