<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}


	public function index()
	{
		// Menu Management is value of $title
		$data['title'] = 'Menu Management';
		// get data from session as value of $user
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		// select * from table user_menu as value of $menu for menu/index.php page
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu', 'Menu', 'required',['required' => 'Menu field is required &#129320']);

		if($this->form_validation->run() == false){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		// to load page in menu/index.php
		$this->load->view('menu/index', $data);
		$this->load->view('templates/footer');
		}else{
			if(empty($this->input->post('id'))){
				$this->db->insert('user_menu', ['menu' =>$this->input->post('menu')]);
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> New menu added! &#129395</div>');
				redirect('menu');
			}else{
				$menu = $this->input->post('menu');
				$id = $this->input->post('id');
				$this->db->set('menu', $menu);
				$this->db->where('id', $id);
				$this->db->update('user_menu');

				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Menu changed! &#129395</div>');
				redirect('menu');
			}
			
		}

	}

	public function edit($id)
	{
		$data['title'] = 'Edit Menu';
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		// get data thath will be edited
		$data['menu'] = $this->db->get_where('user_menu', ['id' => $id])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('menu/edit', $data);
		$this->load->view('templates/footer');	
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('user_menu');
		$affected_rows=$this->db->affected_rows();
		if($affected_rows > 0){
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Menu deleted! &#128293 </div>');
			redirect('menu');
		}

	}

	public function submenu()
	{
		$data['title'] = 'Submenu Management';
		// get data from session
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		// load Menu_menu model as menu
		$this->load->model('Menu_model','menu');
		// inserting value of getSubMenu() method as value of $subMenu for menu/submenu.php page
		$data['subMenu'] = $this->menu->getSubMenu();
		// select * from user_menu as value of $menu
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('submenu', 'Name', 'required',['required' => 'Submenu name field is required &#129320']);
		$this->form_validation->set_rules('menu_id', 'Menu', 'required',['required' => 'Menu field is required &#129320']);
		$this->form_validation->set_rules('url', 'Url', 'required',['required' => 'Submenu url field is required &#129320']);
		$this->form_validation->set_rules('icon', 'Icon', 'required',['required' => 'Submenu icon field is required &#129320']);

		if($this->form_validation->run() == false){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('menu/submenu', $data);
		$this->load->view('templates/footer');
		}else{
			if(empty($this->input->post('id'))){
				$data=[
					'submenu'=> $this->input->post('submenu'),
					'menu_id'=> $this->input->post('menu_id'),
					'url'=> $this->input->post('url'),
					'icon'=> $this->input->post('icon'),
					'is_active'=> $this->input->post('is_active')
				];
				$this->db->insert('user_sub_menu', $data);
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> New submenu added! &#129395</div>');
				redirect('menu/submenu');
			}else{
				$id = $this->input->post('id');
				$data = [
					'submenu' => $this->input->post('submenu'),
					'menu_id' => $this->input->post('menu_id'),
					'url' => $this->input->post('url'),
					'icon' => $this->input->post('icon'),
					'is_active' => $this->input->post('is_active')
				];

				$this->db->where('id', $id);
				$this->db->update('user_sub_menu', $data);

				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Submenu has been changed! &#129395</div>');
				redirect('menu/submenu');
			}
		}
	}

	public function editsubmenu($id)
	{
		$data['title'] = 'Edit Submenu';
		$data['user'] =
		// select from table user where email is email from session, show one row result
		$this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		// load Menu_menu model as menu
		$this->load->model('Menu_model','menu');
		// getSubMenu method with parameter $id
		$data['subMenu'] = $this->menu->getSubMenu_edit($id);
		// for menu field
		$data['menu'] = $this->db->get('user_menu')->result_array();
		// current menu
		$data['currentMenu'] = $this->db->get_where('user_menu', ['menu' => $data['subMenu']['menu']])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('menu/editsubmenu', $data);
		$this->load->view('templates/footer');

	}

	public function deletesubmenu($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('user_sub_menu');
		$affected_rows=$this->db->affected_rows();
		if($affected_rows > 0){
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Submenu deleted! &#128293</div>');
			redirect('menu/submenu');
		}

	}

}