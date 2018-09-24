<?php

/**
 * Welcome to Luthier-CI!
 *
 * This is your main route file. Put all your HTTP-Based routes here using the static
 * Route class methods
 *
 * Examples:
 *
 *    Route::get('foo', 'bar@baz');
 *      -> $route['foo']['GET'] = 'bar/baz';
 *
 *    Route::post('bar', 'baz@fobie', [ 'namespace' => 'cats' ]);
 *      -> $route['bar']['POST'] = 'cats/baz/foobie';
 *
 *    Route::get('blog/{slug}', 'blog@post');
 *      -> $route['blog/(:any)'] = 'blog/post/$1'
 */

Route::get('/', 'Main@index')->name('homepage');


Route::group('auth', function(){
    Route::get('/','Auth@index');
    Route::get('login','Auth@login');
    Route::post('login','Auth@login');
    Route::get('logged_in','Auth@logged_in');
    Route::get('logout','Auth@logout');
    Route::get('change_password','Auth@change_password');
    Route::post('change_password','Auth@change_password');
    Route::get('forgot_password','Auth@forgot_password');
    Route::post('forgot_password','Auth@forgot_password');
});

Route::group('feedback', function(){
    Route::get('/','Feedback@add');
    Route::post('add','Feedback@add');
    Route::get('datatable','Feedback@datatable');
});
Route::group('chapter', function(){
    Route::get('/','Chapter@index');
    Route::post('add','Feedback@add');
});
Route::group('admin', ['namespace' => 'admin','middleware' => ['AuthMiddleware']],function(){
    Route::group('feedback', function(){
        Route::post('edit','Feedback@edit');
        Route::get('delete/{id}','Feedback@del');
        Route::get('change_status/{id}','Feedback@changeStatus');
        Route::get('datatable','Feedback@datatable')->name('feedbacksTable');
    });
    Route::group('chapter', function(){
        Route::post('edit','Chapter@edit');
        Route::get('delete/{id}','Chapter@del');
        Route::get('datatable','Chapter@datatable')->name('chapersTable');
    });
    Route::group('user', function(){
        Route::post('add','User@add');
        Route::get('delete/{id}','User@del');
        Route::get('datatable','User@datatable')->name('usersTable');
    });
});
Route::set('404_override', function(){
    show_404();
});

Route::set('translate_uri_dashes',FALSE);