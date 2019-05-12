<?php


namespace Project\Register;


use Project\Utils\ProjectDao;

class RegistriesDao
{
	private $project_dao;

	public function __construct(ProjectDao $project_dao)
	{
		$this->project_dao = $project_dao;
	}
	public function create_registry(Registry $registry)
	{
		$sql = "INSERT INTO registry " . Registry::model_data() ." VALUES(?, ?)";
		return $this->project_dao->insert($sql, $registry->as_array());
	}
	public function delete_register($id_registry)
	{
		$sql = "DELETE FROM registry WHERE id_registry=?";
		$this->project_dao->execute($sql, $id_registry);
	}
	public function get_registry_id($id_registry)
	{
		$sql = "SELECT * FROM registry WHERE id_registry=?";
		return $this->project_dao->fetch($sql, array($id_registry));
	}
	public function get_registry_token($token)
	{
		$sql = "SELECT * FROM registy WHERE token=?";
		return $this->project_dao->fetch($sql, array($token));
	}
	public function get_user_email($email)
	{
		$sql = "SELECT * from USER WHERE email=?";
		return $this->project_dao->fetch($sql, array($email));
	}
	public function registry_user($id_user)
	{
		$sql = "UPDATE user SET enabled=1 WHERE id_user=?";
		$this->project_dao->execute($sql, array($id_user));
	}
}
