<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}


	public function index()
	{
		$data['title'] = 'Books';
		// get data from session
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		// search button clicked
		if(isset($_POST['search'])){
			$keyword = $this->input->post('keyword');
			$this->db->like('title', $keyword);
			$this->db->or_like('author', $keyword);
			$data['book'] = $this->db->get('book')->result_array();
			$result = $data['book'];
			if(empty($result)){
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Book with that keyword is not found </div>');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Book found</div>');
			}
		}else{
			$data['book'] = $this->db->get('book')->result_array();
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> This is all available books</div>');
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar_home', $data);
		$this->load->view('home/index', $data);
		$this->load->view('templates/footer');
	}

	public function shippingAddress($id)
	{
		$data['title'] = 'Shipping Address';
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$user_id = $data['user']['id'];
		$data['address'] = $this->db->get_where('shipping_address', ['user_id' => $user_id])->row_array();

		$data['book'] = $this->db->get_where('book', ['id' => $id])->row_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('home/shippingaddress', $data);
		$this->load->view('templates/footer');

	}

	public function orderInformation()
	{
		$data['title'] = 'Order Information';
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$user_id = $data['user']['id'];
		$data['address'] = $this->db->get_where('shipping_address', ['user_id' => $user_id])->row_array();

		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('sub_district', 'Sub_district', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('province', 'Province', 'trim|required');
		$this->form_validation->set_rules('country', 'Country', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');

		if($this->form_validation->run() == false){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Shipping address form can not be empty &#129488 </div>');
			redirect('home');
		}else{
			$order_data = [
				'user_id' => $data['user']['id'],
				'book_id' => $this->input->post('book_id'),
				'date' => time(),
				'payment_status' => 'pending',
				'delivery_status' => 'on proccess',
				'total' => $this->input->post('price'),
				'shipping_address_id' => $data['address']['id']
			];
			$this->db->insert('orders', $order_data);
			if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Your order is successfull! &#129395!</div>');
			}
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('home/orderinformation', $data);
			$this->load->view('templates/footer');
		}

	}

	public function payment()
	{
		$data['title'] = 'Payment';
		// get data from session as value of $user
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		// select max id from orders where user_id = $user_id
		$user_id = $data['user']['id'];
		$this->db->select_max('id');
		$data['order_id'] = $this->db->get_where('orders', ['user_id' => $user_id])->row_array();

		// select from orders where id = $order_id
		$order_id = $data['order_id']['id'];
		$data['order_information'] = $this->db->get_where('orders', ['id' => $order_id ])->row_array();

		// select from shipping_address where id = $user_id
		$data['address'] = $this->db->get_where('shipping_address', ['user_id' => $user_id ])->row_array();

		// select from book where id = 
		$book_id = $data['order_information']['book_id'];
		$data['book'] = $this->db->get_where('book', ['id' => $book_id ])->row_array(); 

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('home/payment', $data);
		$this->load->view('templates/footer');
	}

	public function myOrder()
	{
		$data['title'] = 'My Order';
		// get data from session as value of $user
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		// select user order data
		$id = $data['user']['id'];
		$this->load->model('Order_model','order');
		$data['user_order'] = $this->order->getUserOrder($id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('home/myorder', $data);
		$this->load->view('templates/footer');
	}

	public function cancelOrder($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('orders');
		$affected_rows=$this->db->affected_rows();
		if($affected_rows > 0){
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Your order has been canceled! &#128293</div>');
			redirect('home/myorder');
		}
	}

	public function paymentconfirmation()
	{

		$this->form_validation->set_rules('orders_id', 'Order ID' , 'required|trim');

		$upload_file = $_FILES['file']['name'];

			// cek jika ada gambar yang akan diupload
			if($upload_file){
				$config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
				$config['max_size'] = '5000';
				$config['upload_path'] = './payment_confirmation_file/';

				$this->load->library('upload', $config);

				if($this->upload->do_upload('file')){
					$file = $this->upload->data('file_name');
					
				}else{
					echo $this->upload->display_errors();
				}
			}

		if( empty($file)){
		$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> file form is required </div>');
		redirect('home/myorder');
		}else{
			$data = [
				'orders_id' => $this->input->post('orders_id'),
				'file' => $file
			];
			$this->db->insert('payment_confirmation', $data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Payment confirmation success! &#129395 now please wait our team to check your confirmation file and update your payment status</div>');
			redirect('home/myorder');
		}

	}

	public function borrow($id)
	{
		$data['title'] = 'Borrow Book';
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$user_id = $data['user']['id'];
		$data['address'] = $this->db->get_where('shipping_address', ['user_id' => $user_id])->row_array();

		$data['book'] = $this->db->get_where('book', ['id' => $id])->row_array();

		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('home/borrow', $data);
		$this->load->view('templates/footer');

	}


	public function borrowInformation()
	{
		$data['title'] = 'Borrow Information';
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$user_id = $data['user']['id'];
		$data['address'] = $this->db->get_where('shipping_address', ['user_id' => $user_id])->row_array();

		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('sub_district', 'Sub_district', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');

		if($this->form_validation->run() == false){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Shipping address form can not be empty &#129488 </div>');
			redirect('home');
		}else{
			$borrow_data = [
				'user_id' => $data['user']['id'],
				'book_id' => $this->input->post('book_id'),
				'date' => time(),
				'time' => $this->input->post('time')
			];
			$this->db->insert('borrowed', $borrow_data);
			if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Your request is successfull! &#129395
					<p> Now You can pick the book in our library by showing your borrow id</p> </div>');
			}

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('home/borrowinformation', $data);
			$this->load->view('templates/footer');
		}

	}

	public function borrowed()
	{
		$data['title'] = 'Borrow Id';
		// get data from session as value of $user
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		// select max id from borrowed where user_id = $user_id
		$user_id = $data['user']['id'];
		$this->db->select_max('id');
		$data['borrow_id'] = $this->db->get_where('borrowed', ['user_id' => $user_id])->row_array();

		// select from borrowed where id = $borrow_id
		$borrow_id = $data['borrow_id']['id'];
		$data['borrow_information'] = $this->db->get_where('borrowed', ['id' => $borrow_id ])->row_array();

		// select from book where id = 
		$book_id = $data['borrow_information']['book_id'];
		$data['book'] = $this->db->get_where('book', ['id' => $book_id ])->row_array(); 

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('home/borrowed', $data);
		$this->load->view('templates/footer');
	}

}