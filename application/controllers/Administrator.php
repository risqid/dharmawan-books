<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}


	public function Index()
	{
		$data['title'] = 'Book Management';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['book'] = $this->db->get('book')->result_array();

		$this->form_validation->set_rules('title', 'Book title', 'required|trim', ['required' => 'Title field is required! &#129320']);
		$this->form_validation->set_rules('author', 'Book author', 'required|trim', ['required' => 'Author field is required! &#129320']);
		$this->form_validation->set_rules('price', 'Book price', 'required|trim', ['required' => 'Price field is required! &#129320']);

		if($this->form_validation->run() == false){
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('administrator/index', $data);
			$this->load->view('templates/footer');
		}else{
			if(empty($this->input->post('id'))){
			$upload_image = $_FILES['image']['name'];

			// cek jika ada gambar yang akan diupload
			if($upload_image){
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '5000';
				$config['upload_path'] = './assets/img/book/';

				$this->load->library('upload', $config);

				if($this->upload->do_upload('image')){
					$new_image = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}
				
			}
			$data = [
				'title' => $this->input->post('title'),
				'author' => $this->input->post('author'),
				'price' => $this->input->post('price'),
				'image' => $new_image	
			];

			$this->db->insert('book', $data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> New book added! &#129395</div>');
			redirect('administrator/index');	
			}else{
				$id = $this->input->post('id');
				$image = $this->db->get_where('book', ['id' => $id])->row_array();

				$data = [
					'title' => $this->input->post('title'),
					'author' => $this->input->post('author'),
					'price' => $this->input->post('price')
				];
				$upload_image = $_FILES['image']['name'];

				// cek jika ada gambar yang akan diupload
				if($upload_image){
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = '5000';
					$config['upload_path'] = './assets/img/book/';

					$this->load->library('upload', $config);

					if($this->upload->do_upload('image')){
						$old_image = $image['image'];
						unlink(FCPATH . 'assets/img/book/' . $old_image);
						$new_image = $this->upload->data('file_name');
						$this->db->set('image',$new_image);
					}else{
					echo $this->upload->display_errors();
					}
		
				}
				$this->db->where('id', $id);
				$this->db->update('book', $data);

				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Book has been changed! &#129395</div>');
				redirect('administrator/index');
			}
			
		}

	}

	public function editbook($id)
	{
		$data['title'] = 'Edit Book';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['book'] = $this->db->get_where('book', ['id' => $id])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('administrator/editbook', $data);
		$this->load->view('templates/footer');
	}

	public function deletebook($id)
	{	
		// select from book where id = $id tampilkan 1 row
		$data= $this->db->get_where('book', ['id' => $id])->row_array();
		// old image
		$old_image = $data['image'];
		// delete old image from directory assets/img/book
		unlink(FCPATH . 'assets/img/book/' . $old_image);

		$this->db->where('id', $id);
		$this->db->delete('book');
		$affected_rows =$this->db->affected_rows();
		if($affected_rows > 0){
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Book deleted! &#128293</div>');
			redirect('administrator/index');
		}

	}

	public function role()
	{	
		$data['title'] = 'Role';
		// get data from session as value of $user
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] =$this->db->get('user_role')->result_array();

		$this->form_validation->set_rules('role', 'Role name', 'required|trim');

		if($this->form_validation->run() == false){
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('administrator/role', $data);
			$this->load->view('templates/footer');
		}else{
			if(empty($this->input->post('id'))){
				$role = $this->input->post('role');
				$data = ['role' => $role];
				$this->db->insert('user_role', $data);
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Role added! &#129395 </div>');
				redirect('administrator/role');
			}else{
				$id = $this->input->post('id');
				$role = $this->input->post('role');
				$this->db->set('role', $role);
				$this->db->where('id', $id);
				$this->db->update('user_role');
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Role changed! &#129395 </div>');
				redirect('administrator/role');
			}
			
		}

	}

	public function editrole($id)
	{
		$data['title'] = 'Edit Role';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get_where('user_role', ['id' => $id])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('administrator/editrole', $data);
		$this->load->view('templates/footer');
	}	

	public function deleterole($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('user_role');
		$affected_rows =$this->db->affected_rows();
		if($affected_rows > 0){
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Role deleted! &#128293</div>');
			redirect('administrator/role');
		}	
	}

	public function roleAccess($role_id)
	{
		
		$data['title'] = 'Role Access';
		// get data from session as value of $user
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] =$this->db->get_where('user_role',['id' => 
			$role_id])->row_array();
		$data['menu'] = $this->db->get_where('user_menu', ['id !=' => 1])->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('administrator/roleaccess', $data);
		$this->load->view('templates/footer');
	}

	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if($result->num_rows() < 1){
			$this->db->insert('user_access_menu', $data);
		}else{
			$this->db->delete('user_access_menu', $data);
		}

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Access changed! &#129395 </div>');
	}

	

	public function order()
	{
		// $title='Dashboard'
		$data['title'] = 'Order Management';
		// get data from session as value of $user
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		// get user order data
		$data['user_order'] = $this->db->get('orders')->result_array();

		$this->form_validation->set_rules('id', 'Order ID', 'required|trim');
		$this->form_validation->set_rules('payment_status', 'Payment Status', 'required|trim');
		$this->form_validation->set_rules('delivery_status', 'Delivery Status', 'required|trim');

		if($this->form_validation->run() == false){
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('administrator/order', $data);
			$this->load->view('templates/footer');	
		}else{
			$order_id = $this->input->post('id');
			$payment_status = $this->input->post('payment_status');
			$delivery_status = $this->input->post('delivery_status');

			$update = [
				'payment_status' => $payment_status,
				'delivery_status' => $delivery_status
			];
			$this->db->set($update);
			$this->db->where('id', $order_id);
			$this->db->update('orders');
			$affected_rows =$this->db->affected_rows();
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Status updated! &#129395 </div>');
			redirect('administrator/order');

		}


	}


	public function editorder($id)
	{
		// $title='Dashboard'
		$data['title'] = 'Edit User Order';
		// get data from session as value of $user
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		// get user order data
		$data['user_order'] = $this->db->get_where('orders',['id' => $id])->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('administrator/editorder', $data);
		$this->load->view('templates/footer');
	}

	public function deleteorder($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('orders');
		$affected_rows =$this->db->affected_rows();
		if($affected_rows > 0){
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Order deleted! &#128293</div>');
			redirect('administrator/order');
		}	
	}

}