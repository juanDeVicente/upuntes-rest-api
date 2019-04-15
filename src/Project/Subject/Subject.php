<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 18/03/2019
 * Time: 13:18
 */

namespace Project\Subject;


use Project\Utils\Model;

class Subject implements Model
{
	public $id_subject;
	public $id_career;
	public $year;
	public $name;

	public function __construct($id_subject, $id_career, $year, $name)
	{
		$this->id_subject = $id_subject;
		$this->id_career = $id_career;
		$this->year = $year;
		$this->name = $name;
	}

	public function as_array()
	{
		return array($this->id_career, $this->year, $this->name);
	}

	public static function model_data()
	{
		return '(id_career, year, name)';
	}
}
