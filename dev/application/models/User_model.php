<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model {
	
	protected $_table_name = 'user';
	protected $_primary_key = 'ID';
	protected $_order_by = 'ID';
	protected $_order_by_type = 'DESC';

	public $rules = array(
		'username' => array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|required|callback_password_check'
		)
	);	

	public $rules_register = array(
		'username' => array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|callback_username_check'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|required|min_length[5]'
		),
		'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|callback_email_check'
		), 
	);

	public $rules_update = array(
		'username' => array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required'
		), 
		'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email'
		), 
	);

	function __construct() {
		parent::__construct();
	}	
	
	function get_user($where = NULL, $limit = NULL, $offset= NULL, $single=FALSE, $select=NULL){
		$this->db->join('{PRE}post', '{PRE}user.ID  = {PRE}post.post_author', 'LEFT' );
		$this->db->group_by('{PRE}user.ID');
		return parent::get_by($where,$limit,$offset,$single,$select);
	}

	function get_user_detail($id=NULL){
		$this->db->select('{PRE}user.username, {PRE}user.email, {PRE}user.group, {PRE}user_detail.*');
		$this->db->join('{PRE}user_detail', '{PRE}user.ID  = {PRE}user_detail.user_id', 'LEFT' );
		return parent::get($id);
	}
}