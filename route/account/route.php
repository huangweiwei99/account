<?php

use think\facade\Route;

Route::resource('user', 'User');
Route::group('user', function () {
    Route::get('/:id/roles', 'User/edit');
    Route::get('/:user_id/role/:id', 'Role/read');
});
Route::resource('role', 'Role');
Route::resource('permission', 'Permission');

Route::group('auth', function () {
    Route::post('/login', 'Auth/login');
    Route::get('/logout', 'Auth/logout');
});

// Route::group('permission', function () {
//     Route::get('/', 'Permission/index');
// });
// Route::group('oa', function () {
//     Route::rule('/', 'Test/test', 'get');
// });
// Route::group('user', function () {
//     // Route::rule('/', 'User/index', 'GET');
//     // Route::rule('/create', 'User/create', 'GET');
//     // Route::rule('/', 'User/save', 'POST');
//     // Route::rule(':id', 'User/read', 'GET');
//     // Route::rule(':id/edit', 'User/edit', 'GET');
//     // Route::rule('/:id', 'User/update', 'PUT')->pattern(['id' => '[\d|\-]+']);
//     // Route::rule('/:id', 'User/delete', 'DELETE')->pattern(['id' => '[\d|\-]+']);
//     // Route::post('/login', 'Auth/login');
// });
// Route::group('roles', function () {
//     Route::rule('/', 'Role/index', 'GET');
//     Route::rule('/', 'Role/save', 'POST');
//     Route::rule(':id', 'Role/read', 'GET')->pattern(['id' => '[\d|\-]+']);
//     Route::rule('/:id', 'Role/update', 'PUT')->pattern(['id' => '[\d|\-]+']);
//     Route::rule('/:id', 'Role/delete', 'DELETE')->pattern(['id' => '[\d|\-]+']);
// });

// Route::miss(function () {

//     // $data = [
//     //         'code' => 404,
//     //         'error' => ['Not Found!'],
//     //         'type' => 'Route',
//     //         'time' => $_SERVER['REQUEST_TIME'],
//     // ];

//     // return json($data)->code(404);

// });
