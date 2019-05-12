<?php


namespace Project\Register;


class Registry
{
	private $id_registry;
	private $id_user;
	private $token;

	public function __construct($id_registry, $id_user, $token)
	{
		$this->id_registry = $id_registry;
		$this->id_user = $id_user;
		$this->token = $token;
	}

	/**
	 * @return el id de registro
	 */
	public function get_id_registry()
	{
		return $this->id_registry;
	}

	/**
	 * @return el token asociado al registro
	 */
	public function get_token()
	{
		return $this->token;
	}

	public function as_array()
	{
		return array($this->id_user, $this->token);
	}
	public static function model_data()
	{
		return '(id_user, token)';
	}
}
