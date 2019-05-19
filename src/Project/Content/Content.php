<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 05/03/2019
 * Time: 11:55
 */

namespace Project\Content;


use Project\Utils\Model;

/**
 * Class Content que modela el contenido (apuntes) del sistema
 * @package Project\Content
 */
class Content implements Model
{
	private $id;
	private $content_name;
	private $content_filename;
	private $subject;
	private $user_owner_id;
	private $update_date;
	private $period;

	public function __construct($id, $content_name, $content_filename, $subject, $user_owner_id, $update_date, $period)
	{
		$this->id = $id;
		$this->content_name = $content_name;
		$this->content_filename = $content_filename;
		$this->subject = $subject;
		$this->user_owner_id = $user_owner_id;
		$this->update_date = $update_date;
		$this->period = $period;
	}

	public function as_array()
	{
		return array($this->content_name, $this->content_filename, $this->subject, $this->user_owner_id, $this->update_date, $this->period);
	}

	public static function model_data()
	{
		return '(content_name, content_filename, id_subject, id_user_owner, update_date, period)';
	}
}
