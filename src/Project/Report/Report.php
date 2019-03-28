<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 18/03/2019
 * Time: 13:18
 */

namespace Project\Report;


use Project\Utils\Model;

class Report implements Model
{
	private $id_user_reporting;
	private $id_content_reported;
	private $id_report;
	private $is_bad_content;
	private $is_wrong_content;
	private $no_subject_content;
	private $report_date;

	public function __construct($id_user_reporting, $id_content_reported, $id_report, $is_bad_content, $is_wrong_content, $no_subject_content, $report_date)
	{

		$this->id_user_reporting = $id_user_reporting;
		$this->id_content_reported = $id_content_reported;
		$this->id_report = $id_report;
		$this->is_bad_content = $is_bad_content;
		$this->is_wrong_content = $is_wrong_content;
		$this->no_subject_content = $no_subject_content;
		$this->report_date = $report_date;
	}

	public function as_array()
	{
		return array($this->id_user_reporting,
			$this->id_content_reported,
			$this->id_report,
			$this->is_bad_content,
			$this->is_wrong_content,
			$this->no_subject_content,
			$this->report_date);
	}
	public static function model_data()
	{
		return array('id_user_reporting', 'id_content_reported', 'id_report', 'is_bad_content', 'is_wrong_content', 'no_subject_content', 'report_date');
	}
}
