<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'My Profile';
		// get data from session
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$user_id = $data['user']['id'];
		$data['address'] = $this->db->get_where('shipping_address', ['user_id' => $user_id])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		// lo load page in user/index.php
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		$data['title'] = 'Edit Profile';
		// get data from session
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$user_id = $data['user']['id'];
		$data['address'] = $this->db->get_where('shipping_address', ['user_id' => $user_id ])->row_array();

		$this->form_validation->set_rules('name', 'Fullname', 'required|trim', ['required' => 'Full Name field is required! &#129320']);
		$this->form_validation->set_rules('address', 'Address', 'required|trim', ['required' => 'Address field is required! &#129320']);
		$this->form_validation->set_rules('sub_district', 'Sub District', 'required|trim', ['required' => 'Sub District field is required! &#129320']);
		$this->form_validation->set_rules('city', 'City', 'required|trim', ['required' => 'City field is required! &#129320']);
		$this->form_validation->set_rules('province', 'Province', 'required|trim', ['required' => 'Province field is required! &#129320']);
		$this->form_validation->set_rules('country', 'Country', 'required|trim', ['required' => 'Country field is required! &#129320']);
		$this->form_validation->set_rules('phone', 'Phone Number', 'required|trim', ['required' => 'Phone Number field is required! &#129320']);

		if($this->form_validation->run() == false){
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer');	
		}else{
			$email = $this->input->post('email');
			$name = $this->input->post('name');

			$upload_image = $_FILES['image']['name'];

			// cek jika ada gambar yang akan diupload
			if($upload_image){
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '5000';
				$config['upload_path'] = './assets/img/profile/';

				$this->load->library('upload', $config);

				if($this->upload->do_upload('image')){
					$old_image = $data['user']['image'];
					if($old_image != 'default.png'){
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}

					$new_image = $this->upload->data('file_name');
					$this->db->set('image',$new_image);
				}else{
					echo $this->upload->display_errors();
				}
		
			}
			$this->db->set('name', $name);
			$this->db->where('email', $email);
			$this->db->update('user');

			$address = $this->input->post('address');
			$sub_district = $this->input->post('sub_district');
			$city = $this->input->post('city');
			$province = $this->input->post('province');
			$country = $this->input->post('country');
			$phone = $this->input->post('phone');

			$this->db->set('address', $address);
			$this->db->set('sub_district' , $sub_district);
			$this->db->set('city' , $city);
			$this->db->set('province' , $province);
			$this->db->set('country' , $country);
			$this->db->set('phone' , $phone);
			$this->db->where('user_email', $data['user']['email']);
			$this->db->update('shipping_address');

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Your profile has been changed! &#129395</div>');
			redirect('user');
		}
		
	}


	public function changePassword()
	{
		$data['title'] = 'Change Password';
		// get data from session
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('current_password','Current Password', 'required|trim',['required' =>'Current Password is required! &#129320']);
		$this->form_validation->set_rules('new_password', 'New Password', 'required|trim|min_length[4]|matches[new_password2]',['required' =>'New Password is required! &#129320', 'min_length' => 'Password too sort! &#128580', 'matches' => "Password doesn't match! &#128556"]);
		$this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[4]|matches[new_password2]',['required' =>'Confirm New Password is required! &#129320','min_length' => 'Password too sort! &#128580']);

		if($this->form_validation->run() == false){
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
		// lo load page in user/index.php
			$this->load->view('user/changepassword', $data);
			$this->load->view('templates/footer');
		}else{
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password');
			if(!password_verify($current_password, $data['user']['password'])){
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Incorrect current password! &#129488</div>');
				redirect('user/changepassword');
			}else{
				if($current_password == $new_password){
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">New password cannot be the same as current password! &#129488</div>');
					redirect('user/changepassword');
				}else{
					// password ok
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');
					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password changed! &#129395</div>');
					redirect('user/changepassword');
				}
			}
		}

	}


}