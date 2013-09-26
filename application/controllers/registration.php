<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Registration extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->load->model('user_model','',TRUE);
	}
	
	function index() {
		//page details
		$data['page_details']['id'] = 1;
		
		if ($this->session->userdata('logged_in')) {
			//already logged in
			redirect('home', 'refresh');
		}
		else {
			//not logged in
			$this->form_validation->set_rules('email', "E-mail", 'trim|required|valid_email|max_length[70]|is_unique[users.email]|xss_clean');
			$this->form_validation->set_rules('name', "Name", 'trim|required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('surname', "Surname", 'trim|required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('password', "Password", 'trim|required|matches[password2]|xss_clean');
			$this->form_validation->set_rules('password2', "Repeated pasword", 'trim|required|xss_clean');
			$this->form_validation->set_rules('captcha', "Captcha", 'trim|required|callback_check_captcha|xss_clean');          
			
			// Get the user's entered captcha value from the form
			$userCaptcha = set_value('captcha');
			
			// Get the actual captcha value that we stored in the session (see below)
			$word = $this->session->userdata('captchaWord');
			
			// Check if form (and captcha) passed validation
			if ($this->form_validation->run()) {
				//successful form submition
                            
			   $password = hash('sha256', $this->input->post('password')); 
			   $result = $this->user_model->register($this->input->post('email'), 
												$password, 
												$this->input->post('name'), 
												$this->input->post('surname'));
						
				if ($result) {
					//data inserted into db
					$user_id = $this->db->insert_id();
					
					//unset captcha
					$this->session->unset_userdata('captchaWord');
					
					//check if there are any invitations for this email
					$invitations_result = $this->user_model->getEmailInvitations($this->input->post('email'));
					
					if ($invitations_result) {
						foreach ($invitations_result as $invitation) {
							$this->user_model->projectInvite($user_id,$invitation->project_id, $invitation->date_sent, date("Y-m-d H:i:s"));
						}
						
						//delete all invitations
						$this->user_model->deleteEmailInvitations($this->input->post('email'));
					}
					
					$data['registration']['message'] = 'Your account has been successfully created! Please login to continue.';
					//load template
					$this->template->load('template', 'login_view', $data);
				}	
			}
			else {
				// not successful
				$vals = array(
					'img_path' => 'images/captcha/',
					'img_url' => 'http://localhost:8888/megatask/images/captcha/'
				);
				
				// Generate the captcha
				$data['captcha'] = create_captcha($vals);
				
				// Store the captcha value in a session to retrieve later
				$this->session->set_userdata('captcha_word', $data['captcha']['word']);
				
				$data['post_string'] = array(
					's_name' => $this->input->post('name'),
					's_surname' => $this->input->post('surname'),
					's_email' => $this->input->post('email'),
					's_password' => $this->input->post('pword')
				 );
                                        
                                
				// Load the captcha view containing the form (located under the 'views' folder)
				$this->template->load('template', 'registration_view', $data);
			}
		}
	}
        

	function check_captcha($value) {
		if (strtolower($value) != strtolower($this->session->userdata('captcha_word'))) {
			// Captcha is wrong
			$this->form_validation->set_message('check_captcha', 'The %s was wrong, please try again');
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
}