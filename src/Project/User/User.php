<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 05/03/2019
 * Time: 11:48
 */

namespace Project\User;


use Project\Utils\Model;

class User implements Model
{
	private $id;
	private $email;
	private $password;
	private $token;
	private $admin;

	public function __construct($id, $email, $password, $token, $admin)
	{
		$this->id = $id;
		$this->email = $email;
		$this->password = $password;
		$this->token = $token;
		$this->admin = $admin;
	}

	public function as_array()
	{
		return array($this->id, $this->email, $this->password, $this->token, $this->admin);
	}

	public static function model_data()
	{
		return array('id', 'email', 'password', 'token', 'admin');
	}
}
