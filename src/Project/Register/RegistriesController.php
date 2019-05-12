<?php


namespace Project\Register;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class RegistriesController
{
	private $dao;
	private $email_sender;

	public function __construct(ContainerInterface $container)
	{
		$this->dao = new RegistriesDao($container['db']);
		$this->email_sender = $container['email_sender'];
	}

	public function create_registry(Request $request, Response $response, array $args)
	{
		$post_args = $request->getParsedBody();
		$registry = new Registry(null, $post_args['email'], uniqid());
		$this->dao->create_registry($registry);

		return $response->withStatus(201);
	}

	public function get_registry(Request $request, Response $response, array $args)
	{
		$registry = $this->dao->get_registry_token($args['token']);
		if (!$registry)
			return $response->withStatus(400);

		return $response->withJson($registry, 200);
	}

	public function finish_registry(Request $request, Response $response, array $args)
	{
		$post_args = $request->getParsedBody();
		$registry = $this->dao->get_registry_id($post_args['registry_id']);

		if (!$registry)
			return $response->withStatus(400);

		$user = $this->dao->get_user_email($registry['email']);
		$this->dao->registry_user($user->id);

		return $response->withStatus(201);

	}
}
