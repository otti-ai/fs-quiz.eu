<?php

// Include router class
include('Route.php');

Route::add('/',function(){
    $titel = 'FS-Quiz - Home';
	$pagename = 'home';
	require('content/home.php');
});
Route::add('/privacy',function(){
    $titel = 'FS-Quiz - Privacy';
	$pagename = 'about';
    require('content/privacy.php');
});
Route::add('/legal-notice',function(){
    $titel = 'FS-Quiz - Legal notice';
	$pagename = 'about';
    require('content/legal-notice.php');
});
Route::add('/contact',function(){
    $titel = 'FS-Quiz - Contact';
	$pagename = 'about';
    require('content/contact.php');
});

Route::add('/home',function(){
    $titel = 'FS-Quiz - Home';
	$pagename = 'home';
	require('content/home.php');
});
Route::add('/quizzes',function(){
    $titel = 'FS-Quiz - Quizzes';
	$pagename = 'quizzes';
	require('content/quizzes.php');
});
Route::add('/search',function(){
    $titel = 'FS-Quiz - Search';
	$pagename = 'search';
	require('content/search.php');
});
Route::add('/about',function(){
    $titel = 'FS-Quiz - About';
	$pagename = 'about';
	require('content/about.php');
});
Route::add('/faq',function(){
    $titel = 'FS-Quiz - FAQ';
	$pagename = 'faq';
	require('content/faq.php');
});
Route::add('/changelog',function(){
    $titel = 'FS-Quiz - Changelog';
	$pagename = 'about';
	require('content/changelog.php');
});
Route::add('/quiz/([0-9]*)', function($quiz_id) {
	$titel = 'FS-Quiz - Quiz';
	$pagename = 'quizzes';
	require('content/quiz.php');
}, 'get');

//documents
Route::add('/search/documents/([0-9]*)', function($event) {
	$titel = 'FS-Quiz - Documents';
	$pagename = 'search';
	require('content/search/documents.php');
}, 'get');
Route::add('/search/documents/([0-9]*)/([0-9]*)', function($event,$year) {
	$titel = 'FS-Quiz - Documents';
	$pagename = 'search';
	require('content/search/documents.php');
}, 'get');
Route::add('/search/documents/([0-9]*)/([0-9]*)/([a-z]*)', function($event,$year,$type) {
	$titel = 'FS-Quiz - Documents';
	$pagename = 'search';
	require('content/search/documents.php');
}, 'get');
Route::add('/search/documents', function() {
	$titel = 'FS-Quiz - Documents';
	$pagename = 'search';
	require('content/search/documents.php');
});

//questions
Route::add('/search/questions', function() {
	$titel = 'FS-Quiz - Questions';
	$pagename = 'search';
	require('content/search/question.php');
});

Route::add('/question/([0-9]*)', function($question_id) {
	$titel = 'FS-Quiz - Question';
	$pagename = 'search';
	require('content/question.php');
});
Route::add('/bremergy/([0-9]*)', function($num) {
	require('bremergy/gruppe.php');
}, 'get');
Route::add('/master/admin',function(){
    $titel = 'FS-Quiz - Home';
	$pagename = 'home';
	require('bremergy/admin.php');
});

// Add base route (startpage)
Route::add('/api',function(){
    header("Location: http://api.fs-quiz.eu");
	exit();
});

Route::pathNotFound(function($path) {
  	$titel = 'FS-Quiz - 404';
	$pagename = '404';
	require('content/404.php');
});

Route::run('/');
?>