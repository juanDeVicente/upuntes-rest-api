<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 18/03/2019
 * Time: 13:17
 */

namespace Project\Rate;


use Project\Utils\ProjectDao;

class RatesDao
{
	private $project_dao;

	function __construct(ProjectDao $project_dao)
	{
		$this->project_dao = $project_dao;
	}

	function get_rates_from_content($id_content)
	{
		$sql = "SELECT * FROM RATE WHERE id_content=?";
		return $this->project_dao->fetch_all($sql, array($id_content));
	}

	function insert_rate(Rate $rate)
	{
		$sql = "INSERT INTO RATE VALUES (?. ? ,?)";
		return $this->project_dao->insert($sql, $rate . as_array());
	}
}
