<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 19/03/2019
 * Time: 9:17
 */

namespace Project\Utils;


class MySqlProjectDao implements ProjectDao
{
	private $connection;

	public function __construct(\PDO $connection)
	{
		$this->connection = $connection;
	}

	/**
	 * Método para realizar una consulta SQL y devolver todos los valores encontrados
	 * @param $sql la query SQL
	 * @param null $params a introducir para realizar la consulta SQL
	 * @return array de todos los elementos encontrados en la consulta
	 */
	public function fetch_all($sql, $params = null)
	{
		$stm = $this->connection->prepare($sql);
		$stm->execute($params);
		return $stm->fetchAll();
	}

	/**
	 * Método para realizar una consulta SQL y devolver el primer elemento encontrado
	 * @param $sql la query SQL
	 * @param null $params a introducir para realizar la consulta SQL
	 * @return el primer elemento encontrado
	 */
	public function fetch($sql, $params = null)
	{
		$stm = $this->connection->prepare($sql);
		$stm->execute($params);
		return $stm->fetch();
	}

	/**
	 * Metodo que permite ejecutar una sentencia SQL
	 * @param $sql la query SQL
	 * @param null $params a introducir para realizar la consulta SQL
	 */
	public function execute($sql, $params = null)
	{
		$stm = $this->connection->prepare($sql);
		$stm->execute($params);
	}

	/**
	 * Metodo que permite insertar datos en SQL
	 * @param $sql la query SQL
	 * @param null $params a introducir para realizar la consulta SQL
	 * @return string con el ultimo id insertado
	 */
	public function insert($sql, $params = null)
	{
		$stm = $this->connection->prepare($sql);
		$stm->execute($params);
		return $this->connection->lastInsertId();
	}
}
