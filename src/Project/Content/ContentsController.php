<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 05/03/2019
 * Time: 12:00
 */


namespace Project\Content;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;


class ContentsController
{
	private $dao;

	public function __construct(ContainerInterface $container)
	{
		$this->dao = new ContentsDao($container['db']);
	}

	public function upload_content(Request $request, Response $response, array $args)
	{

	}

	public function download_content(Request $request, Response $response, array $args)
	{
		$get_params = $request->getQueryParams();
	}

	public function get_all_contents_from_subject(Request $request, Response $response, array $args)
	{
		return $response->withJson($this->dao->get_all_contents_from_subject($args['id_subject']), 200);
	}
}
