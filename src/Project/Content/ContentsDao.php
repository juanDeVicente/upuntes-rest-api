<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 05/03/2019
 * Time: 12:00
 */

namespace Project\Content;


use Project\Utils\ProjectDao;

class ContentsDao
{
	private $project_dao;

	public function __construct(ProjectDao $project_dao)
	{
		$this->project_dao = $project_dao;
	}

	/**
	 * Metodo que permite conseguir todos los contenidos del sistema
	 * @return todos los contenidos del sistema
	 */
	public function get_all_contents()
	{
		$sql = "SELECT * FROM content";
		return $this->project_dao->fetch_all($sql);
	}

	/**
	 * Método que perimte conseguir todos los contenidos de una asignatura
	 * @param $id_subject de la asginatura
	 * @return todos los contenidos de la asignatura
	 */
	public function get_all_contents_from_subject($id_subject)
	{
		$sql = "SELECT * FROM content WHERE id_subject=?";
		return $this->project_dao->fetch_all($sql, array($id_subject));
	}

	/**
	 * Método que permite conseguir todos los contenidos de un usuario
	 * @param $id_user_owner
	 * @return mixed
	 */
	public function get_all_contents_from_user($id_user_owner)
	{
		$sql = "SELECT * FROM content WHERE id_user_owner=?";
		return $this->project_dao->fetch_all($sql, array($id_user_owner));
	}
}
