<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends  CI_Model
{
	// defining getSubMenu method
	public function getUserOrder($id)
	{
		// select * from user_sub_menu and select menu from user_menu join user_menu
		$query = "SELECT `orders`.*, `book`.`title` FROM `orders`
		JOIN `book` ON `orders`.`book_id` = `book`.`id` WHERE `user_id` = $id ";
		
		return $this->db->query($query)->result_array();
	}

}