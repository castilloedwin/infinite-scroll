<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('posts', function (Request $request) {
	
	$posts = App\Post::orderBy('created_at', 'desc');

	return $posts->paginate(40);

});