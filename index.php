<?php

// Include router class
include('Route.php');

// Add base route (startpage)
Route::add('/',function(){
    $titel = 'FS-Quiz - Home';
	$pagename = 'home';
	require('content/home.php');
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
Route::add('/quiz/([a-z]*)/([ced]*)/([0-9]*[tv]*)', function($event,$engine,$year) {
	$titel = 'FS-Quiz - Quiz';
	$pagename = 'quizzes';
	require('content/quiz.php');
}, 'get');
//documents
Route::add('/search/documents/([a-z]*)/([0-9]*[q]*)', function($event,$year) {
	$titel = 'FS-Quiz - Documents';
	$pagename = 'search';
	require('content/search/documents.php');
}, 'get');
Route::add('/search/documents', function() {
	$titel = 'FS-Quiz - Documents';
	$pagename = 'search';
	require('content/search/documents.php');
});
Route::add('/search/question', function() {
	$titel = 'FS-Quiz - Question';
	$pagename = 'search';
	require('content/search/question.php');
});
Route::add('/bremergy/([0-9]*)', function($num) {
	require('bremergy/gruppe.php');
}, 'get');
Route::add('/master/admin',function(){
    $titel = 'FS-Quiz - Home';
	$pagename = 'home';
	require('bremergy/admin.php');
});
Route::pathNotFound(function($path) {
  $titel = 'FS-Quiz - 404';
	$pagename = '404';
	require('content/404.php');
});

Route::run('/');
?>