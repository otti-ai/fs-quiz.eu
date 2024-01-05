<?php

// Include router class
include('Route.php');

Route::add('/',function(){
    $titel = 'FS-Quiz - API';
	$pagename = 'api';
	require('doku/doku.php');
});
Route::add('/api',function(){
    $titel = 'FS-Quiz - API';
	$pagename = 'api';
	require('doku/doku.php');
});

Route::add('/1/info',function(){
    $titel = 'FS-Quiz - API';
	$pagename = 'api';
    $api_version = 1;
	require('doku/doku.php');
});
Route::add('/2/info',function(){
    $titel = 'FS-Quiz - API';
	$pagename = 'api';
    $api_version = 2;
	require('doku/doku.php');
});
Route::pathNotFound(function($path) {
	http_response_code(404);
});

//status no apikey needed
Route::add('/1/systemStatus', function() {
    $addition = 'all';
    require('1/status/get.php');
}, 'get');

//quizzes
Route::add('/1/([0-9a-zA-Z]*)/quiz', function($api_key) {
    $addition = 'list';
    require('1/quiz/get.php');
}, 'get');
Route::add('/2/quiz', function() {
    $addition = 'list';
    require('2/get/quiz/get.php');
}, 'get');
//quizzes/1
Route::add('/1/([0-9a-zA-Z]*)/quiz/([0-9]*)', function($api_key, $quiz_id) {
    $addition = 'single';
	require('1/quiz/get.php');
}, 'get');
Route::add('/2/quiz/([0-9]*)', function($quiz_id) {
    $addition = 'single';
	require('2/get/quiz/get.php');
}, 'get');
//quizzes/1/details
Route::add('/1/([0-9a-zA-Z]*)/quiz/([0-9]*)/info', function($api_key, $quiz_id) {
    $addition = 'details';
	require('1/quiz/get.php');
}, 'get');
Route::add('/2/quiz/([0-9]*)/info', function($quiz_id) {
    $addition = 'details';
	require('2/get/quiz/get.php');
}, 'get');
//quizzes/1/questions
Route::add('/1/([0-9a-zA-Z]*)/quiz/([0-9]*)/questions', function($api_key, $quiz_id) {
    $addition = 'questions';
	require('1/quiz/get.php');
}, 'get');
Route::add('/2/quiz/([0-9]*)/questions', function($quiz_id) {
    $addition = 'questions';
	require('2/get/quiz/get.php');
}, 'get');
//quizzes/1/documents
Route::add('/1/([0-9a-zA-Z]*)/quiz/([0-9]*)/documents', function($api_key, $quiz_id) {
    $addition = 'documents';
	require('1/quiz/get.php');
}, 'get');
Route::add('/2/quiz/([0-9]*)/documents', function($quiz_id) {
    $addition = 'documents';
	require('2/get/quiz/get.php');
}, 'get');
//quizzes/1/events
Route::add('/2/quiz/([0-9]*)/events', function($quiz_id) {
    $addition = 'quizID';
	require('2/get/event/get.php');
}, 'get');

//events
Route::add('/1/([0-9a-zA-Z]*)/event', function($api_key) {
    $addition = 'list';
	require('1/event/get.php');
}, 'get');
Route::add('/2/event', function() {
    $addition = 'list';
	require('2/get/event/get.php');
}, 'get');
//events/1
Route::add('/1/([0-9a-zA-Z]*)/event/([0-9]*)', function($api_key, $event_id) {
    $addition = 'single';
	require('1/event/get.php');
}, 'get');
Route::add('/2/event/([0-9]*)', function( $event_id) {
    $addition = 'single';
	require('2/get/event/get.php');
}, 'get');
//events/1/quizzes
Route::add('/1/([0-9a-zA-Z]*)/event/([0-9]*)/quizzes', function($api_key, $event_id) {
    $addition = 'quizzes';
	require('1/event/get.php');
}, 'get');
Route::add('/2/event/([0-9]*)/quizzes', function($event_id) {
    $addition = 'quizzes';
	require('2/get/event/get.php');
}, 'get');
//events/all
Route::add('/2/event/all', function() {
    $addition = 'all';
	require('2/get/event/get.php');
}, 'get');



//questions
Route::add('/1/([0-9a-zA-Z]*)/question', function($api_key) {
    $addition = 'list';
	require('1/question/get.php');
}, 'get');
Route::add('/2/question', function() {
    $addition = 'list';
	require('2/get/question/get.php');
}, 'get');
//questions/all
Route::add('/1/([0-9a-zA-Z]*)/question/all', function($api_key) {
    $addition = 'all';
	require('1/question/get.php');
}, 'get');
Route::add('/2/question/all', function() {
    $addition = 'all';
	require('2/get/question/get.php');
}, 'get');
//questions/1
Route::add('/1/([0-9a-zA-Z]*)/question/([0-9]*)', function($api_key, $question_id) {
    $addition = 'single';
	require('1/question/get.php');
}, 'get');
Route::add('/2/question/([0-9]*)', function($question_id) {
    $addition = 'single';
	require('2/get/question/get.php');
}, 'get');
//questions/1/info
Route::add('/1/([0-9a-zA-Z]*)/question/([0-9]*)/info', function($api_key, $question_id) {
    $addition = 'info';
	require('1/question/get.php');
}, 'get');
Route::add('/2/question/([0-9]*)/info', function($question_id) {
    $addition = 'info';
	require('2/get/question/get.php');
}, 'get');
//questions/1/answer
Route::add('/1/([0-9a-zA-Z]*)/question/([0-9]*)/answers', function($api_key, $question_id) {
    $addition = 'answer';
	require('1/question/get.php');
}, 'get');
Route::add('/2/question/([0-9]*)/answers', function($question_id) {
    $addition = 'answer';
	require('2/get/question/get.php');
}, 'get');
//questions/1/img
Route::add('/1/([0-9a-zA-Z]*)/question/([0-9]*)/images', function($api_key, $question_id) {
    $addition = 'img';
	require('1/question/get.php');
}, 'get');
Route::add('/2/question/([0-9]*)/images', function($question_id) {
    $addition = 'img';
	require('2/get/question/get.php');
}, 'get');

//documents
Route::add('/1/([0-9a-zA-Z]*)/document', function($api_key) {
    $addition = 'list';
	require('1/document/get.php');
}, 'get');
Route::add('/2/document', function() {
    $addition = 'list';
	require('2/get/document/get.php');
}, 'get');
//documents/all
Route::add('/1/([0-9a-zA-Z]*)/document/all', function($api_key) {
    $addition = 'all';
	require('1/document/get.php');
}, 'get');
Route::add('/2/document/all', function() {
    $addition = 'all';
	require('2/get/document/get.php');
}, 'get');
//documents/1
Route::add('/1/([0-9a-zA-Z]*)/document/([0-9]*)', function($api_key, $document_id) {
    $addition = 'single';
	require('1/document/get.php');
}, 'get');
Route::add('/2/document/([0-9]*)', function($document_id) {
    $addition = 'single';
	require('2/get/document/get.php');
}, 'get');
//documents/quiz/1
Route::add('/1/([0-9a-zA-Z]*)/document/quiz/([0-9]*)', function($api_key, $quiz_id) {
    $addition = 'quiz';
	require('1/document/get.php');
}, 'get');
Route::add('/2/document/quiz/([0-9]*)', function() {
    $addition = 'quiz';
	require('2/get/document/get.php');
}, 'get');

//answer
Route::add('/1/([0-9a-zA-Z]*)/answer', function($api_key) {
    $addition = 'list';
	require('1/answer/get.php');
}, 'get');
Route::add('/2/answer', function() {
    $addition = 'list';
	require('2/get/answer/get.php');
}, 'get');
//answer/1
Route::add('/1/([0-9a-zA-Z]*)/answer/([0-9]*)', function($api_key, $answer_id) {
    $addition = 'single';
	require('1/answer/get.php');
}, 'get');
Route::add('/2/answer/([0-9]*)', function($answer_id) {
    $addition = 'single';
	require('2/get/answer/get.php');
}, 'get');

//solution
Route::add('/1/([0-9a-zA-Z]*)/solution', function($api_key) {
    $addition = 'list';
	require('1/solution/get.php');
}, 'get');
Route::add('/2/solution', function() {
    $addition = 'list';
	require('2/get/solution/get.php');
}, 'get');
//solution/1
Route::add('/1/([0-9a-zA-Z]*)/solution/([0-9]*)', function($api_key, $solution_id) {
    $addition = 'single';
	require('1/solution/get.php');
}, 'get');
Route::add('/2/solution/([0-9]*)', function($solution_id) {
    $addition = 'single';
	require('2/get/solution/get.php');
}, 'get');
//solution/1/images
Route::add('/1/([0-9a-zA-Z]*)/solution/([0-9]*)/images', function($api_key, $solution_id) {
    $addition = 'img';
	require('1/solution/get.php');
}, 'get');
Route::add('/2/solution/([0-9]*)/images', function($solution_id) {
    $addition = 'img';
	require('2/get/solution/get.php');
}, 'get');
//solution/question/1
Route::add('/1/([0-9a-zA-Z]*)/solution/question/([0-9]*)', function($api_key, $question_id) {
    $addition = 'question';
	require('1/solution/get.php');
}, 'get');
Route::add('/2/solution/question/([0-9]*)', function($question_id) {
    $addition = 'question';
	require('2/get/solution/get.php');
}, 'get');


//images
Route::add('/1/([0-9a-zA-Z]*)/image', function($api_key) {
    $addition = 'list';
	require('1/image/get.php');
}, 'get');
Route::add('/2/image', function() {
    $addition = 'list';
	require('2/get/image/get.php');
}, 'get');
//images/1
Route::add('/1/([0-9a-zA-Z]*)/image/([0-9]*)', function($api_key, $image_id) {
    $addition = 'single';
	require('1/image/get.php');
}, 'get');
Route::add('/2/image/([0-9]*)', function($image_id) {
    $addition = 'single';
	require('2/get/image/get.php');
}, 'get');
//images/solution
Route::add('/1/([0-9a-zA-Z]*)/image/solution', function($api_key) {
    $addition = 'solution';
	require('1/image/get.php');
}, 'get');
Route::add('/2/image/solution', function() {
    $addition = 'solution';
	require('2/get/image/get.php');
}, 'get');
//images/question
Route::add('/1/([0-9a-zA-Z]*)/image/question', function($api_key) {
    $addition = 'question';
	require('1/image/get.php');
}, 'get');
Route::add('/2/image/question', function() {
    $addition = 'question';
	require('2/get/image/get.php');
}, 'get');


//last-qualifier
Route::add('/1/([0-9a-zA-Z]*)/last-qualifier', function($api_key) {
    $addition = 'list';
	require('1/last-qualifier/get.php');
}, 'get');
Route::add('/2/last-qualifier', function() {
    $addition = 'list';
	require('2/get/last-qualifier/get.php');
}, 'get');
//last-qualifier/1
Route::add('/1/([0-9a-zA-Z]*)/last-qualifier/([0-9]*)', function($api_key, $last_qualifier_id) {
    $addition = 'single';
	require('1/last-qualifier/get.php');
}, 'get');
Route::add('/2/last-qualifier/([0-9]*)', function($last_qualifier_id) {
    $addition = 'single';
	require('2/get/last-qualifier/get.php');
}, 'get');
//last-qualifier/quiz/1
Route::add('/1/([0-9a-zA-Z]*)/last-qualifier/quiz/([0-9]*)', function($api_key, $quiz_id) {
    $addition = 'quiz';
	require('1/last-qualifier/get.php');
}, 'get');
Route::add('/2/last-qualifier/quiz/([0-9]*)', function($quiz_id) {
    $addition = 'quiz';
	require('2/get/last-qualifier/get.php');
}, 'get');

//statistic
Route::add('/2/statistic', function() {
    $addition = 'list';
	require('2/get/statistic/get.php');
}, 'get');
//statistic/2023-12-12
Route::add('/2/statistic/(\d{4}-(0?[1-9]|1[0-2])-(0?[1-9]|[12][0-9]|3[01]))', function($date) {
    $addition = 'single';
	require('2/get/statistic/get.php');
}, 'get');
//statistic/2023-12-12/views
Route::add('/2/statistic/(\d{4}-(0?[1-9]|1[0-2])-(0?[1-9]|[12][0-9]|3[01]))/views', function($date) {
    $addition = 'views';
	require('2/get/statistic/get.php');
}, 'get');
//statistic/2023-12-12/calls
Route::add('/2/statistic/(\d{4}-(0?[1-9]|1[0-2])-(0?[1-9]|[12][0-9]|3[01]))/calls', function($date) {
    $addition = 'calls';
	require('2/get/statistic/get.php');
}, 'get');
//statistic/2023-12/views
Route::add('/2/statistic/(\d{4}-(0?[1-9]|1[0-2]))/views', function($date) {
    $addition = 'views';
	require('2/get/statistic/get.php');
}, 'get');
//statistic/2023-12/calls
Route::add('/2/statistic/(\d{4}-(0?[1-9]|1[0-2]))/calls', function($date) {
    $addition = 'calls';
	require('2/get/statistic/get.php');
}, 'get');
//statistic/2023/views
Route::add('/2/statistic/(\d{4})/views', function($date) {
    $addition = 'views';
	require('2/get/statistic/get.php');
}, 'get');
//statistic/2023/calls
Route::add('/2/statistic/(\d{4})/calls', function($date) {
    $addition = 'calls';
	require('2/get/statistic/get.php');
}, 'get');

Route::run('/');
?>