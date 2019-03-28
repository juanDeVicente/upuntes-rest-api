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

	public function fetch_all($sql, $params = null)
	{
		$stm = $this->connection->prepare($sql);
		$stm->execute($params);
		return $stm->fetchAll();
	}

	public function fetch($sql, $params = null)
	{
		$stm = $this->connection->prepare($sql);
		$stm->execute($params);
		return $stm->fetch();
	}

	public function execute($sql, $params = null)
	{
		$stm = $this->connection->prepare($sql);
		$stm->execute($params);
	}

	public function insert($sql, $params = null)
	{
		$stm = $this->connection->prepare($sql);
		$stm->execute($params);
		return $this->connection->lastInsertId();
	}
}
