<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 18/03/2019
 * Time: 13:18
 */

namespace Project\Report;


use Project\Utils\ProjectDao;

class ReportsDao
{
	private $project_dao;

	public function __construct(ProjectDao $project_dao)
	{
		$this->project_dao = $project_dao;
	}

	public function get_all_reports()
	{
		$sql = "SELECT * FROM REPORT";
		return $this->project_dao->fetch_all($sql);
	}

	public function get_reports_from_subject($id_subject)
	{
		$sql = "SELECT * FROM REPORT WHERE id_subect=?";
		return $this->project_dao->fetch_all($sql, array($id_subject));
	}

	public function insert_report(Report $report)
	{
		$sql = "INSERT INTO REPORT VALUES (?, ?, ?, ?, ?, ?, ?)";
		return $this->project_dao->insert($sql, $report->as_array());
	}
}
