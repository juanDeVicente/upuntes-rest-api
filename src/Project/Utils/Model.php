<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 27/03/2019
 * Time: 9:31
 */

namespace Project\Utils;


interface Model
{
	/**
	 * @return la instancia del modelo como un array
	 */
	public function as_array();

	/**
	 * @return los datos del modelo que se implementa
	 */
	public static function model_data();
}
