<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('project_model','',TRUE);
		$this->load->model('task_model','',TRUE);
		$this->load->library('form_validation');
		$this->load->model('user_model','',TRUE);
	}
	
	function index() {
		//page details
		$data['page_details']['id'] = 4;
		
		if ($this->session->userdata('logged_in')) {
			//get session data
			$data['session_data'] = $this->session->userdata('logged_in');
			
			//check if user can see this project
			if ($this->project_model->checkUserPrivilege($data['session_data']['user_id'], $this->uri->segment(2))) {
				//user is allowed to see tasks
				
				//validate form (invite user)
				$this->form_validation->set_rules('project', "Project ID", 'trim|required|is_natural_no_zero|callback_check_project_admin|xss_clean');
				$this->form_validation->set_rules('email', "E-mail", 'trim|required|valid_email|max_length[70]|xss_clean|callback_check_email_in_project');
				
				//get project details
				$data['project_details'] = $this->project_model->projectDetails($this->uri->segment(2));
					
				if ($this->form_validation->run() == FALSE) {
					//false. nothing happening
				}
				else {
					//send invitation
					
					//load model
					$this->load->model('user_model','',TRUE);
					
					//check if this email is registered and get id
					$user_reg = $this->user_model->is_email_registered($this->input->post('email'));
					
					
					if ($user_reg) {
						//email is registered. send an invitation
						$invitation_result = $this->user_model->projectInvite($user_reg[0]->id,$this->input->post('project'));
						if ($invitation_result) {
							$data['invitation_sending']['success'] = true ;
							$data['invitation_sending']['message'] = 'Invitation sent' ;
						}
						else {
							$data['invitation_sending']['success'] = false ;
							$data['invitation_sending']['message'] = 'problem writing into db';
						}
					}
					else {
						//email is not registered.
						$invitation_result = $this->user_model->sendInvite($this->input->post('email'),$this->input->post('project'));
						if ($invitation_result) {
							//inserted into db. send an email
							
							$this->load->library('email');
							
							$config = Array(
								//'protocol' => 'smtp',
								//'smtp_host' => 'ssl://smtp.googlemail.com',
								//'smtp_port' => 465,
								//'smtp_user' => 'user',
								//'smtp_pass' => 'pass',
								'mailtype'  => 'html',
								'protocol' => 'mail',
								'wordwrap' => FALSE,
								'charset' => 'utf-8',
								'crlf' => "\r\n",
								'newline' => "\r\n"
							);
							$this->load->library('email', $config);
							//$this->email->set_newline("\r\n");

							$this->email->from('zlatkomicic@gmail.com', 'Megatask');
							$this->email->to($this->input->post('email'));
							$this->email->subject('Project invitation');
							$this->email->message( $this->load->view( 'emailmessage_view', $data, true ) );

							if ($this->email->send()) {
								$data['invitation_sending']['success'] = true ;
								$data['invitation_sending']['message'] = 'Invitation sent';
							}
							else {
								$data['invitation_sending']['success'] = false ;
								$data['invitation_sending']['message'] = 'User in db and error sending an email';
								$data['invitation_sending']['message'] .= show_error($this->email->print_debugger());
							}
						}
						else {
							$data['invitation_sending']['success'] = false ;
							$data['invitation_sending']['message'] = 'problem writing into db';
						}
					}
				}
				
				//create an array with details of users who are in project
				$a_project_users_names = explode(',',$data['project_details'][0]->names);
				$a_project_users_last_names = explode(',',$data['project_details'][0]->last_names);
				$a_project_users_ids = explode(',',$data['project_details'][0]->ids);
				
				$a_temp = array();
				foreach ($a_project_users_names as $key => $row) {
					$a_temp[$key]['name'] = $row;
					$a_temp[$key]['last_name'] = $a_project_users_last_names[$key];
					$a_temp[$key]['id'] = $a_project_users_ids[$key];
				}
				
				
				$data['project_details'][0]->users = $a_temp;
				
				//get all projects
				$data['my_projects'] = $this->project_model->userProjects($data['session_data']['user_id']);
				
				//get all tasks
				$data['project_tasks'] = $this->task_model->projectTasks($this->uri->segment(2));
				
				//check if user is inside the task
				if ($data['project_tasks']) {
					foreach ($data['project_tasks'] as $key => $project_tasks) {
						$a_users = explode(',',$project_tasks->user_ids);

						$data['project_tasks'][$key]->admin = in_array($data['session_data']['user_id'],$a_users) ? 1 : 0;
					}	
				}
				
				//is user working on task
				$data['now_woring_task'] = $this->user_model->isWorkingOnTask($data['session_data']['user_id']);
				
				$this->template->load('template', 'project_view', $data);
			}
			else {
				//not allowed. redirec to home
				redirect('/', 'refresh');
			}
			
		}
		else {
			//not logged in
			redirect('login', 'refresh');
		}
	}
	
	function check_email_in_project($email) {
		$project = $this->input->post('project');
		$result = $this->project_model->is_email_in_project($email,$project);
		
		if ($result) {
			//already in project
			$this->form_validation->set_message('check_email_in_project', 'Invitation already sent for ' .$email. ' ');
			return FALSE;
		}
		else {
			//not in project. check if invitation is sent
			
			$result = $this->project_model->is_invitation_sent($email,$project);
			if ($result) {
				//invitation already sent
				$this->form_validation->set_message('check_email_in_project', 'Invitation already sent for ' .$email. ' ');
				return FALSE;
			}
			else {
				return TRUE;
			}
		}
	}
	
	function check_project_admin($value) {
		
		$session_data = $this->session->userdata('logged_in');
		
		$result = $this->project_model->is_project_admin($value,$session_data['user_id']);
		
		if ($result) {
			//is admin
			return TRUE;
		}
		else {
			//not an admin
			$this->form_validation->set_message('check_project_admin', 'You are not allowed to send an invitations for this project');
			return FALSE;
		}
	}
	
}