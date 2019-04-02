<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 18/03/2019
 * Time: 13:17
 */

namespace Project\Career;


use Project\Utils\Model;

/**
 * Class Career que modela las carreras en el sistema
 * @package Project\Career
 */
class Career implements Model
{
	private $id_career;
	private $img_path;
	private $name;

	public function __construct($id_career, $img_path, $name)
	{
		$this->id_career = $id_career;
		$this->img_path = $img_path;
		$this->name = $name;
	}

	public function as_array()
	{
		return array($this->id_career, $this->img_path, $this->name);
	}
	public static function model_data()
	{
		return array('id_career', 'img_path', 'name');
	}
}
