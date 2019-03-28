<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 05/03/2019
 * Time: 11:52
 */

namespace Project\User;

use Project\Utils\ProjectDao;

class UsersDao
{
	private $project_dao;

	public function __construct(ProjectDao $project_dao)
	{
		$this->project_dao = $project_dao;
	}

	function get_user($email)
	{
		$sql = "SELECT * from USER WHERE email =?";
		return $this->project_dao->fetch($sql, array($email));
	}

	function insert_user(User $user)
	{
		$sql = "INSERT INTO USER ( "+ User::model_data() +" ) VALUES (?, ?, ?, ?, ?)";
		return $this->project_dao->insert($sql, $user->as_array());
	}
}
