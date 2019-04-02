<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 18/03/2019
 * Time: 13:17
 */

namespace Project\Rate;


use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class RatesController
{
	private $dao;

	public function __construct(ContainerInterface $container)
	{
		$this->dao = new RatesDao($container['db']);
	}

	/**
	 * Método GET que permite obtener todas las calificaciones que tiene un contenido
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response
	 */
	public function get_rates_from_content(Request $request, Response $response, array $args)
	{
		return $response->withJson($this->dao->get_rates_from_content($args['id_content']), 200);
	}

	/**
	 * Metodo POST que perimte insertar un contenido
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response
	 */
	public function insert_rate(Request $request, Response $response, array $args)
	{
		$post_params = $request->getParsedBody();
		$rate = $this->dao->insert_rate(new Rate(
			$post_params['id_content'],
			$post_params['id_user_rating'],
			$post_params['rate']
		));

		return $response->withJson($rate, 200);
	}
}
