<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent:: __construct();
		$this->load->library('form_validation');
	}
	
	public function index()
	{
		// prevent user access to auth controller directly in url 
		if($this->session->userdata('email')){
			redirect('home');
		}

		// set rules for email field
		$this->form_validation->set_rules('email' ,'Email', 'trim|required|valid_email',
			['required' => 'Email field is required &#129320']);
		// set rules for password field
		$this->form_validation->set_rules('password' ,'Password', 'trim|required',
			['required' => 'Password field is required &#129320']);
		// if the form is blank, back to login page
		if($this->form_validation->run() == false){
		$data['title'] = 'Login Page';

		$this->load->view('templates/auth_header', $data);
		// lo load page in auth/login.php
		$this->load->view('auth/login');
		$this->load->view('templates/auth_footer');		
		}else{
		// if form validation is success
			$this->_login();

		}
	}

	private function _login()
	{
		// get data from form with method post
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		// get data from user table where email == $email
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		// if email inputted is exist
		if($user){
			// if user is activated
			if($user['is_active'] == 1){
				// if password correct
				if(password_verify($password, $user['password'])){
					$data = ['email' => $user['email'], 'role_id' => $user['role_id']];
					$this->session->set_userdata($data);
					if($user['role_id'] == 1){
						// update shipping address table to complete data
						$this->db->set('user_id', $user['id']);
						$this->db->where('user_email', $user['email']);
						$this->db->update('shipping_address');
						// redirect user to admin/index
						redirect('administrator');
					}else{
						// update shipping address table to complete data
						$this->db->set('user_id', $user['id']);
						$this->db->where('user_email', $user['name']);
						$this->db->update('shipping_address');
						// redirect user to home/index
						redirect('home');
					}
				// password incorrect
				}else{
					// to show a pop up message
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Incorrect password! &#129488</div>');
					redirect('auth');
				}
			// email hasn't activated
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email has not been activated! &#129488</div>');
			redirect('auth');
			}
		// user not exist
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email is not registered! 	&#129488</div>');
			redirect('auth');
		}
	}

	public function registration()
	{
		// prevent user access to auth controller directly in url 
		if($this->session->userdata('email')){
			redirect('home');
		}
		$this->form_validation->set_rules('name', 'Name', 'required|trim',
			// change default message for requires rule
			['required' => 'Name field is required &#129320']);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',['required' => 'Email field is required &#129320', 'valid_email' => 'Email field must contain a valid email address &#129300', 'is_unique' => 'This email has already registered &#129488']);
		$this->form_validation->set_rules('address', 'Address', 'required|trim',['required' => 'Address field is required &#129320']);
		$this->form_validation->set_rules('sub_district', 'Sub District', 'required|trim',['required' => 'Sub District field is required &#129320']);
		$this->form_validation->set_rules('city', 'City', 'required|trim',['required' => 'City field is required &#129320']);
		$this->form_validation->set_rules('province', 'Province', 'required|trim',['required' => 'Province field is required &#129320']);
		$this->form_validation->set_rules('country', 'Country', 'required|trim',['required' => 'Country field is required &#129320']);
		$this->form_validation->set_rules('phone', 'Phone', 'required|trim',['required' => 'Phone field is required &#129320']);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]',['required' => 'Password field is required! &#129320','matches' => "Password doesn't match! &#128556",'min_length' => 'Password too short! &#128580']);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		// if the form is blank, back to registration page
		if($this->form_validation->run() == false){
		$data['title'] = "Dharmawan Books";
		$this->load->view('templates/auth_header',$data);
		// lo load page in auth/registration.php
		$this->load->view('auth/registration');
		$this->load->view('templates/auth_footer');
		}else{
		// if form validation is success, insert to database
			// preparing data for inserting to database
			$data_user = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'image' => 'default.png',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 1,
				'date_created' => time()
			];
			// insert data from $data to database
			// database config can be changed in aplication/config/database.php
			$this->db->insert('user', $data_user);

			$data_user_address = [
				'user_id' => '',
				'name' => htmlspecialchars($this->input->post('name', true)),
				'address' => htmlspecialchars($this->input->post('address', true)),
				'sub_district' => htmlspecialchars($this->input->post('sub_district', true)),
				'city' => htmlspecialchars($this->input->post('city','true')),
				'province' => htmlspecialchars($this->input->post('province',true)),
				'country' => htmlspecialchars($this->input->post('country', true)),
				'phone' => htmlspecialchars($this->input->post('phone', true)),
			];
			$this->db->insert('shipping_address', $data_user_address);


			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Congratulation! &#129395 your account has been created. Please login</div>');
			// redirect to index page in auth controler which is auth/login
			redirect('auth');
		}	
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">You have been logged out &#128577</div>');
		// redirect to index page in auth controler(auth/login.php)
		redirect('auth');

	}


	public function blocked()
	{
		$this->load->view('auth/blocked');
	}

}