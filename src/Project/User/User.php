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
	private $email;
	private $password;
	private $admin;
	private $enabled;

	public function __construct($email, $password, $admin, $enabled)
	{
		$this->email = $email;
		$this->password = $password;
		$this->admin = $admin;
		$this->enabled = $enabled;
	}

	public function as_array()
	{
		return array($this->email, $this->password, $this->admin, $this->enabled);
	}

	public static function model_data()
	{
		return '(email, password, admin, enabled)';
	}
}
