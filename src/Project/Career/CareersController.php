<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 18/03/2019
 * Time: 13:17
 */

namespace Project\Career;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class CareersController
{
	private $dao;

	public function __construct(ContainerInterface $container)
	{
		$this->dao = new CareersDao($container['db']);
	}

	public function get_all_careers(Request $request, Response $response, array $args)
	{
		$careers = $this->dao->get_all_careers();
		return $response->withJson($careers, 200);
	}

	public function insert_career(Request $request, Response $response, array $args)
	{
		$post_params = $request->getParsedBody();

		//TODO falta guardar la imagen que se recoja en el formulario

		$career = $this->dao->insert_career(new Career(
			null,
			$post_params['img_path'],
			$post_params['name']
		));

		return $response->withJson($career, 200);
	}
}
