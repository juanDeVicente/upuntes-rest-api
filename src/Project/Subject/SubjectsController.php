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

	/**
	 * Método GET que devuelve las asignaturas de una carrera ordenadas por año académico
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response
	 */
	public function get_career_subjects(Request $request, Response $response, array $args)
	{
		$subjects_group_by_year = array();

		foreach ($this->dao->get_career_subjects($args['id_career']) as $subject)
			$subjects_group_by_year[$subject->year][] = $subject;

		return $response->withJson($subjects_group_by_year, 200);
	}

	/**
	 * Método GET que devuelve todas las asignaturas en general
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response
	 */
	public function get_all_subjects(Request $request, Response $response, array $args)
	{
		return $response->withJson($this->dao->get_all_subjects(), 200);
	}

	/**
	 * Método POST que pemite introducir una asignatura en el sistema
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response
	 */
	public function create_subject(Request $request, Response $response, array $args)
	{
		$post_args = $request->getParsedBody();
		$subject = new Subject(null, $post_args['id_career'], $post_args['year'], $post_args['name']);

		return $response->withJson($this->dao->create_subject($subject), 200);
	}

	public function get_subject(Request $request, Response $response, array $args)
	{
		return $response->withJson($this->dao->get_subject($args['id_subject']), 200);
	}
	public function delete_subject(Request $request, Response $response, array $args)
	{
		$this->dao->delete_subject($args['id_subject']);
		return $response->withStatus(204);
	}
}
