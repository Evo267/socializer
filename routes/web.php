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

Route::get('/', [
	'uses' => 'HomeController@index',
	'as' => 'index'
]);


//Auth::routes();

Route::group(['middleware' => 'web'], function(){

    Route::post('login/', [
        'uses' => 'LoginController@login',
        'as' => 'login.attempt'
    ]);

    Route::post('register/', [
        'uses' => 'LoginController@register',
        'as' => 'register.attempt'
    ]);

});

Route::group(['middleware' => 'auth'], function(){


    Route::get('/test', function(){
        $user = App\User::find(1);
        return $user->friends()->sortByDesc('messages');
    });

    Route::get('/logout', [
        'uses' => 'LoginController@logout',
        'as' => 'logout'
    ]);

	Route::resource('/posts', 'PostsController', ['only' => [
    	'store', 'update', 'destroy']
    ]);

    Route::resource('/comments', 'CommentsController', ['only' => [
    	'store', 'destroy'
    ]]);

    Route::resource('/events', 'EventsController', ['only' => [
    	'index', 'create', 'store', 'destroy', 'show'
    ]]);

    Route::get('/profile/{id}', [
    	'as' => 'profile.view',
    	'uses' => 'ProfileController@view'
    ]);

    Route::get('/profile/{id}/edit', [
        'as' => 'profile.edit',
        'uses' => 'ProfileController@edit'
    ]);

    Route::post('/profile/cover/update', [
        'uses' => 'ProfileController@changeCover',
        'as' => 'profile.changeCover'
    ]);

    Route::post('/profile/update', [
        'uses' => 'ProfileController@changeProfile',
        'as' => 'profile.changeProfile'
    ]);

    Route::get('/tag/{name}', [
    	'as' => 'tag.search',
    	'uses' => 'TagsController@search'
    ]);

    Route::get('/photos/{id}', [
    	'as' => 'photos',
    	'uses' => 'HomeController@photos'
    ]);

    Route::get('/friends/{id}', [
    	'as' => 'friends',
    	'uses' => 'HomeController@friends'
    ]);

    Route::get('/saved/',[
    	'as' => 'saved',
    	'uses' => 'HomeController@saved'
    ]);

    Route::get('/messages/', [
        'as' => 'messages',
        'uses' => 'MessageController@index'
    ]);

    Route::post('/online', [
        'as' => 'online',
        'uses' => 'HomeController@updateOnline'
    ]);

	Route::post('post/like', [
		'as' => 'post.like',
		'uses' => 'LikesController@LikePost'
	]);

	Route::post('post/info', [
		'as' => 'post.info',
		'uses' => 'PostsController@updateInfo'
	]);

	Route::post('search/friends', [
		'as' => 'search.post',
		'uses' => 'SearchController@search'
	]);

	Route::post('friend/add', [
		'as' => 'friend.add',
		'uses' => 'FriendsController@SendRequest'
	]);

	Route::post('friend/cancel', [
		'as' => 'friend.cancel',
		'uses' => 'FriendsController@CancelRequest'
	]);

	Route::post('friend/remove', [
		'as' => 'friend.remove',
		'uses' => 'FriendsController@RemoveFriend'
	]);

	Route::post('friend/accept', [
		'as' => 'friend.accept',
		'uses' => 'FriendsController@AcceptFriend'
	]);

	Route::post('save/post', [
		'as' => 'save.post',
		'uses' => 'SaveController@save'
	]);

    Route::post('message/friend', [
        'as' => 'message.start',
        'uses' => 'MessageController@startChat'
    ]);

    Route::post('message/send', [
        'as' => 'message.send',
        'uses' => 'MessageController@sendMsg'
    ]);

    Route::post('notifications/seen', [
        'as' => 'notifications.seen',
        'uses' => 'HomeController@notifications'
    ]);
});
