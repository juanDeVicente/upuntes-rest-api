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

	/**
	 * Acceso a la base de datos para obtener las asignaturas de una carrera
	 * @param $id_career de la carrera a obtener las asignaturas
	 * @return las asignaturas de una carrera
	 */
	public function get_career_subjects($id_career)
	{
		$sql = "SELECT * FROM SUBJECT WHERE id_career=?";
		return $this->project_dao->fetch_all($sql, array($id_career));
	}

	/**
	 * Acceso a la base de datos para introducir una asignatura en el sistema
	 * @param Subject $subject a introducir en la base de datos
	 * @return la asignatura introducida
	 */
	public function create_subject(Subject $subject)
	{
		$sql = "INSERT INTO SUBJECT " . Subject::model_data() . " VALUES (?, ?, ?)";
		return $this->project_dao->insert($sql, $subject->as_array()				);
	}

	/**
	 * @return todas las asignaturas del sistema
	 */
	public function get_all_subjects()
	{
		$sql = "SELECT * FROM SUBJECT";
		return $this->project_dao->fetch_all($sql);
	}

	public function get_subject($id_subject)
	{
		$sql = "SELECT * FROM subject WHERE id_subject=?";
		return $this->project_dao->fetch($sql, array($id_subject));
	}

	public function delete_subject($id_subject)
	{
		$sql = "DELETE FROM SUBJECT WHERE id_subject=?";
		$this->project_dao->execute($sql, array($id_subject));
	}

	public function update_subject(Subject $subject)
	{
		$sql = "UPDATE SUBJECT SET name=?, year=? WHERE id_subject=?";
		$this->project_dao->execute($sql, array($subject->name, $subject->year, $subject->id_subject));

		return $this->get_subject($subject->id_subject);
	}
}
