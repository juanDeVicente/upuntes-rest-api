<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 18/03/2019
 * Time: 13:17
 */

namespace Project\Rate;


use Project\Utils\Model;

class Rate implements Model
{
	private $id_content;
	private $id_user_rating;
	private $rate;

	public function __construct($id_content, $id_user_rating, $rate)
	{
		$this->id_content = $id_content;
		$this->id_user_rating = $id_user_rating;
		$this->rate = $rate;
	}

	public function as_array()
	{
		return array($this->id_content, $this->id_user_rating, $this->rate);
	}
	public static function model_data()
	{
		return array('id_content', 'id_user_rating', 'rate');
	}
}
