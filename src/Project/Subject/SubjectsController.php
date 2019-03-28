<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 18/03/2019
 * Time: 13:18
 */

namespace Project\Subject;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class SubjectsController
{
	private $dao;

	public function __construct(ContainerInterface $container)
	{
		$this->dao = new SubjectsDao($container['db']);
	}

	public function get_career_subjects(Request $request, Response $response, array $args)
	{
		return $response->withJson($this->dao->get_career_subjects($args['id_career']), 200);
	}

	public function get_all_subjects(Request $request, Response $response, array $args)
	{
		return $response->withJson($this->dao->get_all_subjects(), 200);
	}

	public function create_subject(Request $request, Response $response, array $args)
	{
		$post_args = $request->getParsedBody();
		$subject = new Subject(null, $post_args['id_career'], $post_args['year'], $post_args['name']);

		return $response->withJson($this->dao->create_subject($subject), 200);
	}
}
