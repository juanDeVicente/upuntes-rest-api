<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 18/03/2019
 * Time: 13:17
 */

namespace Project\Career;


use Project\Utils\ProjectDao;

class CareersDao
{
	private $project_dao;

	public function __construct(ProjectDao $project_dao)
	{
		$this->project_dao = $project_dao;
	}

	public function get_all_careers()
	{
		$sql = "SELECT * from career";
		return $this->project_dao->fetch_all($sql);
	}

	public function insert_career(Career $career)
	{
		$sql = "INSERT INTO career". Career::model_data() ." VALUES(?, ?)";
		return $this->project_dao->insert($sql, $career->as_array());

	}
	public function get_career($id_career)
	{
		$sql = "SELECT * FROM career WHERE id_career=?";
		return $this->project_dao->fetch($sql, array($id_career));
	}

	public function delete_career($id_career)
	{
		$sql = "DELETE FROM career WHERE id_career=?";
		$this->project_dao->execute($sql, array($id_career));
	}
}
