<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 05/03/2019
 * Time: 11:52
 */

namespace Project\User;

use DateTime;
use Exception;
use Firebase\JWT\JWT;
use Project\Register\RegistriesDao;
use Project\Register\Registry;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;


class UsersController
{
	private $users_dao;
	private $registries_dao;

	private $email_sender;

	private function generate_token_session($id)
	{
		$now = new DateTime();
		$future = new DateTime("now +1 year");

		$payload = [
			"iat" => $now->getTimeStamp(),
			"exp" => $future->getTimeStamp(),
			"jti" => base64_encode(random_bytes(16)),
			"iss" => 'localhost:80',  // Issuer
			"id" => $id,
		];

		$secret = 'mysecret';
		$token = JWT::encode($payload, $secret, "HS256");

		return $token;
	}

	public function send_mail($email, $registry_token)
	{
		$this->email_sender->setFrom('upuntes@gmail.com', 'Upuntes');
		$this->email_sender->addAddress($email);
		$this->email_sender->Body = 'Bienvenido a U-puntes!<br> Para finalizar tu registro utiliza el siguiente <a href="http://localhost:4200/registry/' . $registry_token . '">enlace</a>';
		$this->email_sender->send();
	}

	public function __construct(ContainerInterface $container)
	{
		$this->users_dao = new UsersDao($container['db']);
		$this->registries_dao = new RegistriesDao($container['db']);

		$this->email_sender = $container['email_sender'];
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
		$user = $this->users_dao->get_user($params['email']);

		if ($user == null)
			return $response->withJson('Not existing email', 404);
		if (!password_verify($params['password'], $user->password))
			return $response->withJson('bad_password', 400);
		if(!$user->enabled)
			return $response->withJson('not_enabled_user', 400);

		$user->token = $this->generate_token_session($user->id_user);

		return $response->withJson($user, 200);
	}

	function update_user(Request $request, Response $response, array $args)
	{
		if ($request_user_id = $request->getAttribute('token')->id) {
			$user_id = $args['id'];
			if ($request_user_id === $user_id) {
				$params = $request->getParsedBody();
				$user = $this->users_dao->update_user($user_id, $params);
				return $response->withJson($user);
			}
			return $response->withStatus(401);
		}
		return $response->withStatus(404);
	}
	function delete_user(Request $request, Response $response, array $args)
	{
		if ($request_user_id = $request->getAttribute('token')->id) {
			$user = $this->users_dao->get_user_id($request_user_id);
			if ($user->admin == 1) {
				$this->users_dao->delete_user($args['id_user']);
				return $response->withStatus(204);
			}
		}
		return $response->withStatus(404);
	}
	function create_user(Request $request, Response $response, array $args)
	{
		$post_args = $request->getParsedBody();
		$id = -1;
		try {
			$id = $this->users_dao->insert_user(new User($post_args['email'], password_hash($post_args['password'], PASSWORD_DEFAULT), 0, false));
		}
		catch (Exception $e){
			return $response->withStatus(404);
		}


		$user = $this->users_dao->get_user($post_args['email']);

		$registry = new Registry(null, $id, uniqid());
		$this->registries_dao->create_registry($registry);

		$this->send_mail($user->email, $registry->get_token());

		return $response->withJson($user, 200);
	}

	public function get_user(Request $request, Response $response, array $args)
	{
		return $response->withJson($this->users_dao->get_user_id($args['id_user']), 200);
	}
}
