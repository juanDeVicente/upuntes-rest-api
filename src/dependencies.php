<?php

use PHPMailer\PHPMailer\PHPMailer;
use Project\Utils\MySqlProjectDao;


$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
	$settings = $c->get('settings')['renderer'];
	return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
	$settings = $c->get('settings')['logger'];
	$logger = new Monolog\Logger($settings['name']);
	$logger->pushProcessor(new Monolog\Processor\UidProcessor());
	$logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
	return $logger;
};

//database
$container['db'] = function ($c) {
	$db = new PDO("mysql:host=localhost;dbname=upuntes; charset=UTF8", "root", "");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	return new MySqlProjectDao($db);
};

//autenticacion
$container['authentication'] = function ($c) {
	return new \Slim\Middleware\JwtAuthentication([
		"secure" => false,
		"secret" => "mysecret",
	]);
};
$container['email_sender'] = function ($c) {
	$mail = new PHPMailer(false);
	$mail->SMTPDebug = 0;
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'upuntes@gmail.com';
	$mail->Password = '';
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);
	$mail->isHTML(true);

	return $mail;
};
