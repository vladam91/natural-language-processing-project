<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

/**
 * Putanje kojima ima pristup samo administrator
 *
 */
Route::get('/admin-panel', 'AdminController@adminPanel');
Route::get('/user/delete/{user}', 'AdminController@deleteUser');
Route::get('/user/ban/{user}', 'AdminController@banUser');
Route::get('/user/unban/{user}', 'AdminController@unbanUser');
Route::get('user/role/{user}', 'AdminController@getRole');
Route::post('user/role/edit/{user}', 'AdminController@editRole');
Route::get('/admin/delete/text/{post}', 'AdminController@deleteTextPost');

/**
 * Putanje za text
 *
 */
Route::get('/createtext','AutorController@getTextForm');
Route::post('/create-post','AutorController@uploadText');
Route::get('/text-tutorials', 'TextTutorialsController@getTextTutorials');
Route::get('/text-post/{post}', 'TextTutorialsController@getPost');
Route::get('/text-posts/type/free', 'TextTutorialsController@getAllFreePosts');
Route::get('/text-posts/type/paid', 'TextTutorialsController@getAllPaidPosts');
Route::get('/text-posts/cat/{category}', 'TextTutorialsController@getPostsByCategory');
Route::get('/text-posts/delete/{post}', 'TextTutorialsController@deletePost');
Route::get('/text-posts/user/{user}', 'TextTutorialsController@getAllPostsByUser');
Route::post('/text-posts/create/comment/{post}', 'TextTutorialsController@createComment');
Route::post('/text-posts/search/', 'TextTutorialsController@searchPosts');
Route::get('/text-post-comment/delete/{comment}', 'TextTutorialsController@deleteTextPostComment');


/**
* Putanje za video
*
*/


Route::get('/createvideo','AutorController@getVideoForm');
Route::post('/create-videopost','AutorController@uploadVideo');
Route::get('/video-tutorials', 'VideoTutorialsController@getVideoTutorials');
Route::get('/video-post/{post}', 'VideoTutorialsController@getvideoPost');
Route::get('/video-posts/type/free', 'VideoTutorialsController@getAllFreePosts');
Route::get('/video-posts/type/paid', 'VideoTutorialsController@getAllPaidPosts');
Route::get('/video-posts/cat/{category}', 'VideoTutorialsController@getPostsByCategory');
Route::get('/video-posts/delete/{post}', 'VideoTutorialsController@deleteVideoPost');
Route::get('/video-posts/user/{user}', 'VideoTutorialsController@getAllPostsByUser');
Route::post('/video-posts/create/comment/{post}', 'VideoTutorialsController@createComment');
Route::post('/video-posts/search/', 'VideoTutorialsController@searchPosts');
Route::get('/video-post-comment/delete/{comment}', 'VideoTutorialsController@deleteVideoPostComment');



/**
 * Putanje za subscripiton
 *
 */
Route::get('/subscription/', 'SubscriptionController@getSubscription');
Route::post('/subscription/create/', 'SubscriptionController@createSubscription');
Route::get('/subscription/cancel/', 'SubscriptionController@cancelSubscription');
Route::get('/subscription/resume/', 'SubscriptionController@resumeSubscription');


/**
 * Putanje za user profile management
 *
 */
Route::get('/change-user-password', 'UserManagementController@getChangeUserPassword');
Route::post('/change-user-password', 'UserManagementController@submitChangeUserPassword');

/**
 * ERROR PUTANJE
 *
 */
Route::get('/banned', 'ErrorController@getBanned');


/**
 *
 * Putanje za dodatne stranice
 */

Route::get('about', 'InfoPageController@getAbout');