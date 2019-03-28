<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 05/03/2019
 * Time: 11:52
 */

namespace Project\User;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;


class UsersController
{
	private $dao;

	public function __construct(ContainerInterface $container)
	{
		$this->dao = new UsersDao($container['db']);
	}

	/**
	 * Función que permite validar a un usuario introduciendo su email, tiene que ir a través de POST para temas de sequridad
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response
	 */
	function login_user(Request $request, Response $response, array $args)
	{
		$params = $request->getParsedBody();
		$user = $this->dao->get_user($params['$email']);

		if ($user == null)
			return $response->withJson('not existing email', 404);
		if (password_verify($params['password'], $user['password']))
			return $response->withJson('bad_password', 400);

		return $response->withJson($user, 200);
	}

	function update_user($new_id, array $user)
	{

	}
	function create_user(Request $request, Response $response, array $args)
	{

	}
}
