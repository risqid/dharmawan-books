<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends  CI_Model
{
	// defining getSubMenu method
	public function getSubMenu()
	{
		// select * from user_sub_menu and select menu from user_menu join user_menu
		$query = "SELECT `user_sub_menu`.*, `user_menu`.`menu` FROM `user_sub_menu`
		JOIN `user_menu` ON `user_sub_menu`.`menu_id` = `user_menu`.`id`";
		
		return $this->db->query($query)->result_array();
	}

	// get submenu that will be edited
	public function getSubMenu_edit($id)
	{
		// select * from user_sub_menu and select menu from user_menu join user_menu
		$query = "SELECT `user_sub_menu`.*, `user_menu`.`menu` FROM `user_sub_menu`
		JOIN `user_menu` ON `user_sub_menu`.`menu_id` = `user_menu`.`id` WHERE `user_sub_menu`.`id` = $id";
		
		return $this->db->query($query)->row_array();
	}

}