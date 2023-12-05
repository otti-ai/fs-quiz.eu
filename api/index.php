<?php

// Include router class
include('Route.php');

Route::add('/',function(){
    $titel = 'FS-Quiz - API';
	$pagename = 'api';
	require('1/info.php');
});
Route::add('/api',function(){
    $titel = 'FS-Quiz - API';
	$pagename = 'api';
	require('1/info.php');
});

Route::pathNotFound(function($path) {
	http_response_code(404);
});

//status no apikey needed
Route::add('/([1])/systemStatus', function($api_version) {
    $addition = 'all';
    require($api_version. '/status/get.php');
}, 'get');

//quizzes
Route::add('/([1])/([0-9a-zA-Z]*)/quiz', function($api_version, $api_key) {
    $addition = 'list';
    require($api_version. '/quiz/get.php');
}, 'get');
Route::add('/2/quiz', function() {
    $addition = 'list';
    require('/quiz/get.php');
}, 'get');
//quizzes/1
Route::add('/([1])/([0-9a-zA-Z]*)/quiz/([0-9]*)', function($api_version, $api_key, $quiz_id) {
    $addition = 'single';
	require($api_version. '/quiz/get.php');
}, 'get');
//quizzes/1/details
Route::add('/([1])/([0-9a-zA-Z]*)/quiz/([0-9]*)/info', function($api_version, $api_key, $quiz_id) {
    $addition = 'details';
	require($api_version. '/quiz/get.php');
}, 'get');
//quizzes/1/questions
Route::add('/([1])/([0-9a-zA-Z]*)/quiz/([0-9]*)/questions', function($api_version, $api_key, $quiz_id) {
    $addition = 'questions';
	require($api_version. '/quiz/get.php');
}, 'get');
//quizzes/1/documents
Route::add('/([1])/([0-9a-zA-Z]*)/quiz/([0-9]*)/documents', function($api_version, $api_key, $quiz_id) {
    $addition = 'documents';
	require($api_version. '/quiz/get.php');
}, 'get');



//events
Route::add('/([1])/([0-9a-zA-Z]*)/event', function($api_version, $api_key) {
    $addition = 'list';
	require($api_version. '/event/get.php');
}, 'get');
//events/1
Route::add('/([1])/([0-9a-zA-Z]*)/event/([0-9]*)', function($api_version, $api_key, $event_id) {
    $addition = 'single';
	require($api_version. '/event/get.php');
}, 'get');
//events/1/quizzes
Route::add('/([1])/([0-9a-zA-Z]*)/event/([0-9]*)/quizzes', function($api_version, $api_key, $event_id) {
    $addition = 'quizzes';
	require($api_version. '/event/get.php');
}, 'get');



//questions
Route::add('/([1])/([0-9a-zA-Z]*)/question', function($api_version, $api_key) {
    $addition = 'list';
	require($api_version. '/question/get.php');
}, 'get');
//questions/all
Route::add('/([1])/([0-9a-zA-Z]*)/question/all', function($api_version, $api_key) {
    $addition = 'all';
	require($api_version. '/question/get.php');
}, 'get');
//questions/1
Route::add('/([1])/([0-9a-zA-Z]*)/question/([0-9]*)', function($api_version, $api_key, $question_id) {
    $addition = 'single';
	require($api_version. '/question/get.php');
}, 'get');
//questions/1/info
Route::add('/([1])/([0-9a-zA-Z]*)/question/([0-9]*)/info', function($api_version, $api_key, $question_id) {
    $addition = 'info';
	require($api_version. '/question/get.php');
}, 'get');
//questions/1/answer
Route::add('/([1])/([0-9a-zA-Z]*)/question/([0-9]*)/answers', function($api_version, $api_key, $question_id) {
    $addition = 'answer';
	require($api_version. '/question/get.php');
}, 'get');
//questions/1/img
Route::add('/([1])/([0-9a-zA-Z]*)/question/([0-9]*)/images', function($api_version, $api_key, $question_id) {
    $addition = 'img';
	require($api_version. '/question/get.php');
}, 'get');

//documents
Route::add('/([1])/([0-9a-zA-Z]*)/document', function($api_version, $api_key) {
    $addition = 'list';
	require($api_version. '/document/get.php');
}, 'get');
//documents/all
Route::add('/([1])/([0-9a-zA-Z]*)/document/all', function($api_version, $api_key) {
    $addition = 'all';
	require($api_version. '/document/get.php');
}, 'get');
//documents/1
Route::add('/([1])/([0-9a-zA-Z]*)/document/([0-9]*)', function($api_version, $api_key, $document_id) {
    $addition = 'single';
	require($api_version. '/document/get.php');
}, 'get');
//documents/quiz/1
Route::add('/([1])/([0-9a-zA-Z]*)/document/quiz/([0-9]*)', function($api_version, $api_key, $quiz_id) {
    $addition = 'quiz';
	require($api_version. '/document/get.php');
}, 'get');

//answer
Route::add('/([1])/([0-9a-zA-Z]*)/answer', function($api_version, $api_key) {
    $addition = 'list';
	require($api_version. '/answer/get.php');
}, 'get');
//answer/1
Route::add('/([1])/([0-9a-zA-Z]*)/answer/([0-9]*)', function($api_version, $api_key, $answer_id) {
    $addition = 'single';
	require($api_version. '/answer/get.php');
}, 'get');

//solution
Route::add('/([1])/([0-9a-zA-Z]*)/solution', function($api_version, $api_key) {
    $addition = 'list';
	require($api_version. '/solution/get.php');
}, 'get');
//solution/1
Route::add('/([1])/([0-9a-zA-Z]*)/solution/([0-9]*)', function($api_version, $api_key, $solution_id) {
    $addition = 'single';
	require($api_version. '/solution/get.php');
}, 'get');
//solution/1/images
Route::add('/([1])/([0-9a-zA-Z]*)/solution/([0-9]*)/images', function($api_version, $api_key, $solution_id) {
    $addition = 'img';
	require($api_version. '/solution/get.php');
}, 'get');
//solution/question/1
Route::add('/([1])/([0-9a-zA-Z]*)/solution/question/([0-9]*)', function($api_version, $api_key, $question_id) {
    $addition = 'question';
	require($api_version. '/solution/get.php');
}, 'get');


//images
Route::add('/([1])/([0-9a-zA-Z]*)/image', function($api_version, $api_key) {
    $addition = 'list';
	require($api_version. '/image/get.php');
}, 'get');
//images/1
Route::add('/([1])/([0-9a-zA-Z]*)/image/([0-9]*)', function($api_version, $api_key, $image_id) {
    $addition = 'single';
	require($api_version. '/image/get.php');
}, 'get');
//images/solution
Route::add('/([1])/([0-9a-zA-Z]*)/image/solution', function($api_version, $api_key) {
    $addition = 'solution';
	require($api_version. '/image/get.php');
}, 'get');
//images/question
Route::add('/([1])/([0-9a-zA-Z]*)/image/question', function($api_version, $api_key) {
    $addition = 'question';
	require($api_version. '/image/get.php');
}, 'get');


//last-qualifier
Route::add('/([1])/([0-9a-zA-Z]*)/last-qualifier', function($api_version, $api_key) {
    $addition = 'list';
	require($api_version. '/last-qualifier/get.php');
}, 'get');
//last-qualifier/1
Route::add('/([1])/([0-9a-zA-Z]*)/last-qualifier/([0-9]*)', function($api_version, $api_key, $last_qualifier_id) {
    $addition = 'single';
	require($api_version. '/last-qualifier/get.php');
}, 'get');
//last-qualifier/quiz/1
Route::add('/([1])/([0-9a-zA-Z]*)/last-qualifier/quiz/([0-9]*)', function($api_version, $api_key, $quiz_id) {
    $addition = 'quiz';
	require($api_version. '/last-qualifier/get.php');
}, 'get');

Route::run('/');
?>