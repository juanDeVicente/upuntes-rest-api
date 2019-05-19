<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 05/03/2019
 * Time: 12:00
 */


namespace Project\Content;

use Project\Utils\Files;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;


class ContentsController
{
	private $dao;
	private $contents_path;

	public function __construct(ContainerInterface $container)
	{
		$this->dao = new ContentsDao($container['db']);
		$this->contents_path = $container->get('settings')['content_path'] . '/user_contents/';
	}

	public function upload_content(Request $request, Response $response, array $args)
	{
		$user_owner_id = $request->getAttribute('token')->id;
		$post_args = $request->getParsedBody();
		$filename = Files::move_uploaded_file($this->contents_path, $request->getUploadedFiles()['content']);

		$content = $this->dao->insert_content(new Content(null, $post_args['content_name'], $filename, $post_args['id_subject'], $user_owner_id, date("Y-m-d H:i:s"), $post_args['period']));

		return $response->withJson($content, 201);
	}

	public function download_content(Request $request, Response $response, array $args)
	{
		$content = $this->dao->get_content($args['id_content']);
		$file = $this->contents_path . $content->content_filename;
		$response = $response->withHeader('Content-Description', 'File Transfer')
			->withHeader('Content-Type', 'application/octet-stream')
			->withHeader('Content-Disposition', 'attachment;filename="'.basename($file).'"')
			->withHeader('Expires', '0')
			->withHeader('Cache-Control', 'must-revalidate')
			->withHeader('Pragma', 'public')
			->withHeader('Content-Length', filesize($file));

		readfile($file);
		return $response;
	}

	public function get_all_contents_from_subject(Request $request, Response $response, array $args)
	{
		return $response->withJson($this->dao->get_all_contents_from_subject($args['id_subject']), 200);
	}
	public function delete_content(Request $request, Response $response, array $args){
		$content = $this->dao->get_content($args['id_content']);
		Files::remove_file($this->contents_path . $content->content_filename);
		$this->dao->delete_content($args['id_content']);
		return $response->withStatus(204);
	}

	public function get_all_contents_from_user(Request $request, Response $response, array $args)
	{
		$contents = $this->dao->get_all_contents_from_user($args['id_user']);
		return $response->withJson($contents, 200);
	}
}
