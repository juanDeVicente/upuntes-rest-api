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

	public function get_all_contents()
	{
		$sql = "SELECT * FROM content";
		$this->project_dao->fetch_all($sql);
	}

	public function get_all_contents_from_subject($id_subject)
	{
		$sql = "SELECT * FROM content WHERE id_subject=?";
		$this->project_dao->fetch_all($sql, array($id_subject));
	}

	public function get_all_contents_from_user($id_user_owner)
	{
		$sql = "SELECT * FROM content WHERE id_user_owner=?";
		$this->project_dao->fetch_all($sql, array($id_user_owner));
	}
}
