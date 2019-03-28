<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 18/03/2019
 * Time: 13:18
 */

namespace Project\Subject;


use Project\Utils\ProjectDao;

class SubjectsDao
{
	private $project_dao;

	public function __construct(ProjectDao $project_dao)
	{
		$this->project_dao = $project_dao;
	}

	public function get_career_subjects($id_career)
	{
		$sql = "SELECT * FROM SUBJECT WHERE id_carrer=?";
		return $this->project_dao->fetch_all($sql, array($id_career));
	}

	public function create_subject(Subject $subject)
	{
		$sql = "INSERT INTO SUBJECT VALUES (?, ?, ?, ?)";
		return $this->project_dao->insert($sql, $subject->as_array());
	}
	public function get_all_subjects()
	{
		$sql = "SELECT * FROM SUBJECT";
		return $this->project_dao->fetch_all($sql);
	}
}
