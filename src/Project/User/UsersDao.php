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

	function get_user_id($id_user)
	{
		$sql = "SELECT * FROM USER WHERE id_user=?";
		return $this->project_dao->fetch($sql, array($id_user));
	}

	function get_user($email)
	{
		$sql = "SELECT * from USER WHERE email =?";
		return $this->project_dao->fetch($sql, array($email));
	}

	function insert_user(User $user)
	{
		$sql = "INSERT INTO USER ". User::model_data() ." VALUES (?, ?, ?, ?)";
		return $this->project_dao->insert($sql, $user->as_array());
	}

	function update_user($user_id, $params)
	{
		$sql = "UPDATE USER SET id_user=?, email=?, password=?, admin=? WHERE id_user=?";
		return $this->project_dao->execute($sql, array_push($params, $user_id));

	}
	function delete_user($user_id)
	{
		$sql = "UPDATE USER SET enabled=0 WHERE id_user=?";
		return $this->project_dao->execute($sql, array($user_id));
	}
}
