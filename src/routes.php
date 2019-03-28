<?php

use Project\User\UsersController;
use Project\Content\ContentsController;
use Project\Career\CareersController;
use Project\Report\ReportsController;
use \Project\Rate\RatesController;
use \Project\Subject\SubjectsController;

// Routes

/*
$app->get('/', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    // Render index view
    return $this->renderer->render($response, 'login.html', $args);
});
*/
//Contents
$app->get('/content', ContentsController::class . ':download_content');
$app->post('/content', ContentsController::class . ':upload_content');
//Careers
$app->get('/careers', CareersController::class . ':get_all_careers');
$app->post('/careers', CareersController::class . ':insert_career');
//Rate
$app->get('/rate/{id}', RatesController::class . ':get_rates_from_content');
$app->post('/rate', RatesController::class . ':insert_rate');
//Reports
$app->get('/report', ReportsController::class . ':get_all_reports');
$app->get('/report/{id_subject}', ReportsController::class . ':get_reports_from_subject');
$app->post('/report', ReportsController::class . ':insert_report');
//Subject
$app->get('/subjects', SubjectsController::class . ':get_all_subjects');
$app->get('subject/{id_career}', SubjectsController::class . ':get_career_subjects');
$app->post('/subject', SubjectsController::class . ':create_subject');
//Users
$app->post('/user', UsersController::class . ':login_user');
