<?php

use Project\User\UsersController;
use Project\Content\ContentsController;
use Project\Career\CareersController;
use Project\Report\ReportsController;
use \Project\Rate\RatesController;
use \Project\Subject\SubjectsController;
use \Project\Register\RegistriesController;

// Routes

/*
$app->get('/', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    // Render index view
    return $this->renderer->render($response, 'login.html', $args);
});
*/
$authentication = $app->getContainer()->get('authentication'); //Para que el usuario tenga que estar autenticado
//Contents
$app->get('/content', ContentsController::class . ':download_content')->add($authentication);
$app->get('/contents/{id_subject}', ContentsController::class . ':get_all_contents_from_subject');
$app->post('/content', ContentsController::class . ':upload_content');
//Careers
$app->get('/careers', CareersController::class . ':get_all_careers')->add($authentication);
$app->get('/career/{id_career}', CareersController::class . ':get_career');
$app->post('/career', CareersController::class . ':insert_career');
$app->get('/career/image/{img_path}', CareersController::class . ':get_career_image');
$app->delete('/career/{id_career}', CareersController::class . ':delete_career');
//Rate
$app->get('/rate/{id}', RatesController::class . ':get_rates_from_content');
$app->post('/rate', RatesController::class . ':insert_rate');
//Reports
$app->get('/report', ReportsController::class . ':get_all_reports');
$app->get('/report/{id_subject}', ReportsController::class . ':get_reports_from_subject');
$app->post('/report', ReportsController::class . ':insert_report');
//Subject
$app->get('/subjects', SubjectsController::class . ':get_all_subjects');
$app->get('/subjects/{id_career}', SubjectsController::class . ':get_career_subjects');
$app->get('/subject/{id_subject}', SubjectsController::class . ':get_subject');
$app->post('/subject', SubjectsController::class . ':create_subject');
$app->delete('/subject/{id_subject}', SubjectsController::class . ':delete_subject');
$app->put('/subject', SubjectsController::class . ':update_subject')->add($authentication);
//Users
$app->post('/user', UsersController::class . ':create_user');
$app->get('/user/{id_user}', UsersController::class . ':get_user')->add($authentication);
$app->post('/login', UsersController::class . ':login_user');
//Registry
$app->get('/registry/{token}', RegistriesController::class . ':get_registry');
