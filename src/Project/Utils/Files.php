<?php


namespace Project\Utils;


use Slim\Http\UploadedFile;

class Files
{
	public static function move_uploaded_file($directory, UploadedFile $uploadedFile)
	{
		$extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
		$basename = bin2hex(random_bytes(8));
		$filename = sprintf('%s.%0.8s', $basename, $extension);

		$uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

		return $filename;
	}
	public static function remove_file($filename)
	{
		unlink($filename);
	}
}
