<?php
/**
 * Created by PhpStorm.
 * User: juand
 * Date: 18/03/2019
 * Time: 13:17
 */

namespace Project\Career;

use Project\Utils\Files;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;

class CareersController
{
	private $dao;
	private $career_images_path;

	public function __construct(ContainerInterface $container)
	{
		$this->dao = new CareersDao($container['db']);
		$this->career_images_path = $container->get('settings')['content_path'] . '/career_images/';
	}

	public function get_all_careers(Request $request, Response $response, array $args)
	{
		$careers = $this->dao->get_all_careers();
		return $response->withJson($careers, 200);
	}

	public function insert_career(Request $request, Response $response, array $args)
	{
		$post_params = $request->getParsedBody();
		$filename = Files::move_uploaded_file($this->career_images_path, $request->getUploadedFiles()['image']);

		$career = $this->dao->insert_career(new Career(
			null,
			$filename,
			$post_params['career_name']
		));

		return $response->withJson($career, 200);
	}

	public function get_career_image(Request $request, Response $response, array $args)
	{
		$filename = $this->career_images_path . $args['img_path'];
		$response->write(file_get_contents($filename));

		return $response->withHeader('Content-Type', 'image/svg+xml');
	}

	public function delete_career(Request $request, Response $response, array $args)
	{
		$career = $this->dao->get_career($args['id_career']);
		Files::remove_file($this->career_images_path . $career->img_path);

		$this->dao->delete_career($career->id_career);
		return $response->withStatus(204);
	}
	public function update_career(Request $request, Response $response, array $args)
	{
		$put_args = $request->getParsedBody();
		$career = $this->dao->get_career($args['id_career']);
		$filename = Files::move_uploaded_file($this->career_images_path, $request->getUploadedFiles()['image']);
		Files::remove_file($this->career_images_path . $career->img_path);
		$this->dao->update_career(new Career($args['id_career'], $filename, $put_args['career_name']));
		return $response->withStatus(201);
	}

	public function get_career(Request $request, Response $response, array $args)
	{
		return $response->withJson($this->dao->get_career($args['id_career']), 200);
	}
}
