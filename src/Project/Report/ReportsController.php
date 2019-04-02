<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 18/03/2019
 * Time: 13:18
 */

namespace Project\Report;


use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ReportsController
{
	private $dao;

	public function __construct(ContainerInterface $container)
	{
		$this->dao = new ReportsDao($container['db']);
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
		return $response->withJson($this->dao->get_all_reports(), 200);
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
		return $response->withJson($this->dao->get_reports_from_subject($args['id_subject']));
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
		$post_data = $request->getParsedBody();
		$report = new Report(
			$post_data['id_user_reporting'],
			$post_data['id_content_reported'],
			null,
			$post_data['is_bad_content'],
			$post_data['is_wrong_content'],
			$post_data['no_subject_content'],
			$post_data['report_date']
		);

		return $response->withJson($this->dao->insert_report($report), 200);
	}

}
