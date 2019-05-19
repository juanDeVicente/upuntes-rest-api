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
$app->get('/download/{id_content}', ContentsController::class . ':download_content');
$app->get('/contents/{id_subject}', ContentsController::class . ':get_all_contents_from_subject')->add($authentication);
$app->get('/contents/user/{id_user}', ContentsController::class . ':get_all_contents_from_user')->add($authentication);
$app->post('/content', ContentsController::class . ':upload_content')->add($authentication);
$app->delete('/content/{id_content}', ContentsController::class . ':delete_content')->add($authentication);
//Careers
$app->get('/careers', CareersController::class . ':get_all_careers')->add($authentication);
$app->get('/career/{id_career}', CareersController::class . ':get_career')->add($authentication);
$app->post('/career', CareersController::class . ':insert_career')->add($authentication);
$app->get('/career/image/{img_path}', CareersController::class . ':get_career_image');
$app->delete('/career/{id_career}', CareersController::class . ':delete_career')->add($authentication);
$app->post('/career/{id_career}', CareersController::class . ':update_career')->add($authentication); //PUT no permite subir archivos https://discourse.slimframework.com/t/uploading-file-using-put/1053
//Rate
$app->get('/rate/{id}', RatesController::class . ':get_rates_from_content')->add($authentication);
$app->post('/rate', RatesController::class . ':insert_rate')->add($authentication);
//Reports
$app->get('/reports', ReportsController::class . ':get_all_reports')->add($authentication);
$app->get('/report/{id_subject}', ReportsController::class . ':get_reports_from_subject')->add($authentication);
$app->post('/report', ReportsController::class . ':insert_report')->add($authentication);
$app->delete('/report/{id_report}', ReportsController::class . ':delete_report')->add($authentication);
//Subject
$app->get('/subjects', SubjectsController::class . ':get_all_subjects')->add($authentication);
$app->get('/subjects/{id_career}', SubjectsController::class . ':get_career_subjects')->add($authentication);
$app->get('/subject/{id_subject}', SubjectsController::class . ':get_subject')->add($authentication);
$app->post('/subject', SubjectsController::class . ':create_subject')->add($authentication);
$app->delete('/subject/{id_subject}', SubjectsController::class . ':delete_subject')->add($authentication);
$app->put('/subject', SubjectsController::class . ':update_subject')->add($authentication);
//Users
$app->post('/user', UsersController::class . ':create_user');
$app->get('/user/{id_user}', UsersController::class . ':get_user')->add($authentication);
$app->post('/login', UsersController::class . ':login_user');
$app->delete('/user/{id_user}', UsersController::class . ':delete_user')->add($authentication);
//Registry
$app->get('/registry/{token}', RegistriesController::class . ':finish_registry');
