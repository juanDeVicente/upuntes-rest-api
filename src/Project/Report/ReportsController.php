<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 18/03/2019
 * Time: 13:18
 */

namespace Project\Report;


use Project\User\UsersDao;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ReportsController
{
	private $reports_dao;
	private $user_dao;

	public function __construct(ContainerInterface $container)
	{
		$this->reports_dao = new ReportsDao($container['db']);
		$this->user_dao = new UsersDao($container['db']);
	}

	/**
	 * Metodo GET para obtener todos los reportes del sistema
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response con todos los reportes en formato JSON
	 */
	public function get_all_reports(Request $request, Response $response, array $args)
	{
		if ($request_user_id = $request->getAttribute('token')->id) {
			$user = $this->user_dao->get_user_id($request_user_id);
			if ($user && $user->admin == 1)
				return $response->withJson($this->reports_dao->get_all_reports(), 200);
			return $response->withStatus(404);
		}
		return $response->withStatus(404);
	}

	/**
	 * Método GET para obtener todos los reportes de una asignatura
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response con todos los reportes de una asignatura en formato JSON
	 */
	public function get_reports_from_subject(Request $request, Response $response, array $args)
	{
		return $response->withJson($this->reports_dao->get_reports_from_subject($args['id_subject']));
	}

	/**
	 * Metodo POST que perimte introducir un reporte en el sistema
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return Response con el utlimo id de reporte introducido en formato JSON
	 */
	public function insert_report(Request $request, Response $response, array $args)
	{
		$id_user_reporting = $request->getAttribute('token')->id;
		$post_data = $request->getParsedBody();
		$report = new Report(
			$id_user_reporting,
			$post_data['id_content_reported'],
			null,
			$post_data['is_bad_content'],
			$post_data['is_wrong_content'],
			$post_data['no_subject_content'],
			date("Y-m-d H:i:s")
		);

		return $response->withJson($this->reports_dao->insert_report($report), 200);
	}

	public function delete_report(Request $request, Response $response, array $args)
	{
		if ($request_user_id = $request->getAttribute('token')->id) {
			$user = $this->user_dao->get_user_id($request_user_id);
			if ($user->admin == 1)
			{
				$this->reports_dao->delete_report($args['id_report']);
				return $response->withStatus(204);
			}
		}
		return $response->withStatus(404);
	}
}
