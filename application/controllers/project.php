<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Project extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('projects','',TRUE);
		$this->load->library('form_validation');
	}
	
	function index() {
		if ($this->session->userdata('logged_in')) {
			//get session data
			$data['session_data'] = $this->session->userdata('logged_in');
			
			//check if user can see this project
			if ($this->projects->checkUserPrivilege($data['session_data']['user_id'], $this->uri->segment(2))) {
				//user is allowed to see tasks
				
				//validate form (new project create)
				$this->form_validation->set_rules('project', "Project ID", 'trim|required|is_natural_no_zero|callback_check_project_admin|xss_clean');
				$this->form_validation->set_rules('email', "E-mail", 'trim|required|valid_email|max_length[70]|xss_clean|callback_check_email_in_project');
				
				
				if ($this->form_validation->run() == FALSE) {
					//false. nothing happening
				}
				else {
					//send invitation
					
					//load model
					$this->load->model('user','',TRUE);
					
					//check if this email is registered and get id
					$user_reg = $this->user->is_email_registered($this->input->post('email'));
					
					
					if ($user_reg) {
						//email is registered. send an invitation
						$invitation_result = $this->user->projectInvite($user_reg[0]->id,$this->input->post('project'));
						if ($invitation_result) {
							echo ' invitation sent ';
						}
						else {
							echo 'problem writing into db';
						}
					}
					else {
						//email is not registered.
						$invitation_result = $this->user->sendInvite($this->input->post('email'),$this->input->post('project'));
						if ($invitation_result) {
							//inserted into db. send an email
							
							$this->load->library('email');
							
							$config = Array(
								'protocol' => 'smtp',
								'smtp_host' => 'ssl://smtp.googlemail.com',
								'smtp_port' => 465,
								'smtp_user' => 'emailaddress',
								'smtp_pass' => 'password',
								'mailtype'  => 'html', 
								'charset'   => 'iso-8859-1'
							);
							//$this->load->library('email', $config);
							//$this->email->set_newline("\r\n");

							$this->email->from('zlatkomicic@gmail.com', 'Zlatko Micic');
							$this->email->to($this->input->post('email'));
							$this->email->subject('Project invitation');
							$this->email->message('Text with link and invitation to create an account');
							//$this->email->message( $this->load->view( 'emailmessage', $data, true ) );

							if ($this->email->send()) {
								echo 'all ok.';
							}
							else {
								show_error($this->email->print_debugger());
								echo 'User in db and error sending an email';
							}
						}
						else {
							echo 'problem writing into db';
						}
					}
				}
				
				//get project details
				$data['project_details'] = $this->projects->projectDetails($this->uri->segment(2));
				
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
		$result = $this->projects->is_email_in_project($email,$project);
		
		if ($result) {
			//already in project
			$this->form_validation->set_message('check_email_in_project', 'Invitation already sent for ' .$email. ' ');
			return FALSE;
		}
		else {
			//not in project. check if invitation is sent
			
			$result = $this->projects->is_invitation_sent($email,$project);
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
		
		$result = $this->projects->is_project_admin($value,$session_data['user_id']);
		
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