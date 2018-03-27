<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('posts', function (Request $request) {
	
	$posts = App\Post::orderBy('created_at', 'desc');

	return response()->json([
		'posts' => $posts->take( $request->get('limit', 40) )->get(),
		'total' => $posts->count()
	]);

});
