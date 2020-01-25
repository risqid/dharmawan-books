<?php

function is_logged_in()
{
	// to call code igniter's libraries inside this function
	// ubtuk memanggil library code igniter di dalam fungsi ini
	$ci = get_instance();

	// if user hasn't logged in,then redirect to auth(login page)
	// prevent user from directly entering page by inputting using url
	if(!$ci->session->userdata('email')){
		redirect('auth');
	}else{
		$role_id = $ci->session->userdata('role_id');
		
		// get 1st segment from url, as value of $menu
		$menu = $ci->uri->segment(1);

		// select from user_menu where 'menu' = $menu
		$queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
		// var_dump($queryMenu);
		$menu_id = $queryMenu['id'];
		
		// select from user_access_menu where role_id and menu_id is in this session
		$userAccess = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);
		// var_dump($userAccess);
		if($userAccess->num_rows() < 1 ){
			redirect('auth/blocked');
		}
	}

	function check_access($role_id, $menu_id)
	{
		$ci = get_instance();

		$result = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id'=> $menu_id]);

		if($result->num_rows() > 0){
			return "checked='checked'";
		}
	}
}