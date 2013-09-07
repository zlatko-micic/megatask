<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Home extends CI_Controller {
    function __construct() {
        parent::__construct();
    }

    function index() {
        if ($this->session->userdata('logged_in')) {
			
			//get session data
            $session_data = $this->session->userdata('logged_in');
            
            $this->template->load('template', 'home_view');
        }
        else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function logout() {
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('home', 'refresh');
	}

}