<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('admin.add-blog');
// });

Route::group(['middleware' => ['auth:web']], function(){
    Route::view("/admin/create", 'admin.add-admin');
    Route::view("/admin/add-blog", 'admin.add-blog');

    Route::post('/admin/create-post', 'BlogController@add_blog');
    Route::post('/admin/edit-post/{id}', 'BlogController@edit_request'); 
    
    Route::get("/admin_logout", 'UserController@logout');
    Route::get("/admin/allposts", 'BlogController@all_posts');
    Route::get("/admin/comments", 'BlogController@all_comments');
    Route::get("/admin/edit/{id}", 'BlogController@edit_post');
    Route::get("/admin/delete/{id}", 'BlogController@delete_post');
    Route::get("/admin/comment/{id}", 'BlogController@view_comment');
    Route::get("/admin/publish/{id}", 'BlogController@publish_comment');
    Route::get("/admin/delete-comment/{id}", 'BlogController@delete_comment');
    Route::get("/admin/view-post/{id}", 'BlogController@view_post');
    
});

//Route::get("/", 'BlogController@index_posts');
Route::get("/recent", 'BlogController@recent_posts');
Route::get("/older", 'BlogController@older_posts');
Route::get("/view/{id}", 'BlogController@view_post');
Route::get("/search/{tag}", 'BlogController@search_tag');
Route::get('/search', 'BlogController@search_blog');
// Route::get("/tags", 'BlogController@fetch_tags');

Route::view("/admin_register", 'admin.add-admin');
Route::view("/admin_login", 'admin.login')->name('admin_login');
Route::view("/admin", 'admin.login');
Route::view("/", 'homepage');


//route for creating new admin
Route::post('/create_admin', 'UserController@create_admin');
Route::post('/login_admin', 'UserController@login_admin');
Route::post('/comment', 'BlogController@add_comment');



