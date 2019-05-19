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

	/**
	 * Método que permite obtener todos los reportes del sistema
	 * @return todos los reportes
	 */
	public function get_all_reports()
	{
		$sql = "SELECT content.id_content, content.content_name, report.id_report, report.is_bad_content, report.is_wrong_content, report.no_subject_content, career.name AS career_name, subject.name AS subject_name, content.content_filename 
				FROM report 
				JOIN content ON report.id_content_reported=content.id_content 
				JOIN subject ON content.id_subject=subject.id_subject 
				JOIN career ON career.id_career=subject.id_career";
		return $this->project_dao->fetch_all($sql);
	}

	/**
	 * Método que permite obtener todos los reportes de una asignatura
	 * @param $id_subject de la asignatura
	 * @return los reportes de la asignatura
	 */
	public function get_reports_from_subject($id_subject)
	{
		$sql = "SELECT * FROM REPORT WHERE id_subect=?";
		return $this->project_dao->fetch_all($sql, array($id_subject));
	}

	/**
	 * Método que permite insertar un reporte en el sistema
	 * @param Report $report a insertar
	 * @return el último id del reporte introducido
	 */
	public function insert_report(Report $report)
	{
		$sql = "INSERT INTO REPORT VALUES (?, ?, ?, ?, ?, ?, ?)";
		return $this->project_dao->insert($sql, $report->as_array());
	}
	public function delete_report($id_report)
	{
		$sql = "DELETE FROM report WHERE id_report=?";
		$this->project_dao->execute($sql, array($id_report));
	}
}
