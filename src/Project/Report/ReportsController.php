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

	public function get_all_reports(Request $request, Response $response, array $args)
	{
		return $response->withJson($this->dao->get_all_reports(), 200);
	}

	public function get_reports_from_subject(Request $request, Response $response, array $args)
	{
		return $response->withJson($this->dao->get_reports_from_subject($args['id_subject']));
	}

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
