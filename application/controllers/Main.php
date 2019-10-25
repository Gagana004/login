<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function index()
	{
		$data['title'] = 'Test';
		$this->load->view('login', $data);
	}

	function login_validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run())
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->load->model('model_model');
			if($this->main_model->can_login($username, $password))
			{
				$session_data = array(
					'username' => $username
				);
				$this->session->set_userdata($session_data);
				redirect(base_url(). 'main/enter');
			}
			else
			{
				$this->session->set_flashdata('error', 'Individual Username and Password');
				redirect(base_url(). 'main/index');
			}
		}
		else
		{
			$this->index();
		}

	}


	function enter()
	{
		if ($this->session->userdata('username') != '') 
		{
			echo "welcome";
		}
		else
		{
			redirect(base_url() . 'main/index');
		}
	}
}
