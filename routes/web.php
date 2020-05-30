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
// 認証系ルーティング
Auth::routes();

// 飲食店検索ページ
Route::get('/restaurant', 'RestaurantController@index')->name('restaurant.index');

// トップページ
Route::get('/', 'ArticleController@index')->name('articles.index');

// 記事CRUD機能処理
Route::resource('/articles', 'ArticleController')->except(['index','show'])->middleware('auth');
Route::resource('/articles', 'ArticleController')->only(['show']);

// 記事お気に入り機能
Route::prefix('articles')->name('articles.')->group(function () {
  // 記事をお気に入り登録する処理
  Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth');
  // 記事のお気に入り登録を解除する処理
  Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth');
});

// タグから記事を一覧表示する
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');

// ユーザーページ
Route::prefix('users')->name('users.')->group(function (){
  // ユーザーページ表示
  Route::get('/{name}', 'UserController@show')->name('show');
  // ユーザー情報編集ページ表示
  Route::get('/{name}/edit', 'UserController@edit')->name('edit');
  // ユーザー情報編集処理
  Route::post('/{name}/update', 'UserController@update')->name('update');
  // いいねした記事表示
  Route::get('/{name}/likes', 'UserController@likes')->name('likes');
  // フォローしている人一覧ページ表示
  Route::get('/{name}/followings', 'UserController@followings')->name('followings');
  // フォロワー一覧ページ表示
  Route::get('/{name}/followers', 'UserController@followers')->name('followers');

  // フォロー関係のページはログイン後にしか見れないようにする
  Route::middleware('auth')->group(function (){
    Route::put('/{name}/follow', 'UserController@follow')->name('follow');
    Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
  });
});
