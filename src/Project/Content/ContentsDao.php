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
		$sql = "SELECT content.id_content, content.id_user_owner, content.content_filename, content.content_name, content.update_date, content.period, user.email FROM content JOIN user ON user.id_user=content.id_user_owner WHERE id_subject=?";
		return $this->project_dao->fetch_all($sql, array($id_subject));
	}

	/**
	 * Método que permite conseguir todos los contenidos de un usuario
	 * @param $id_user_owner
	 * @return mixed
	 */
	public function get_all_contents_from_user($id_user_owner)
	{
		$sql = "SELECT content.id_content, content.id_user_owner, content.content_filename, content.content_name, subject.name AS subject_name, career.name AS career_name FROM content JOIN subject ON content.id_subject=subject.id_subject JOIN career ON career.id_career=subject.id_career WHERE content.id_user_owner=?";
		return $this->project_dao->fetch_all($sql, array($id_user_owner));
	}
	public function insert_content(Content $content)
	{
		$sql = "INSERT INTO content". Content::model_data() ." VALUES(?, ?, ?, ?, ?, ?)";
		return $this->project_dao->insert($sql, $content->as_array());
	}
	public function get_content($id_content)
	{
		$sql = "SELECT * from content WHERE id_content=?";
		return $this->project_dao->fetch($sql, array($id_content));
	}
	public function delete_content($id_content)
	{
		$sql = "DELETE FROM content WHERE id_content=?";
		$this->project_dao->execute($sql, array($id_content));
	}
}
