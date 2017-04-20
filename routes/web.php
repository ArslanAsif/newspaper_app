<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/exchangerate', function(){
    return view('exchangerate');
});

Route::get('/unsubscribe/{token}', 'HomeController@getUnsubscribe');

Route::get('/clear', 'HomeController@getClearCountry');

Route::get('/api/currencyconverter', 'HomeController@getCurrenctExchangeAjax');
Route::get('/links', 'HomeController@getImpLinks');

Route::get('/', 'HomeController@index');
Route::get('/latest', 'HomeController@getLatest');
Route::get('/ver/{country}', 'HomeController@getSetCountry');
Route::get('/tag/{id}', 'HomeController@getTag');
Route::get('/category/{category}', 'HomeController@category');
// Route::get('/category/media', 'HomeController@getMedia');
Route::get('/category/opinion', 'HomeController@getColumns');
Route::get('/category/column/author/{id}', 'HomeController@getUserColumns');
Route::get('/article/{id}', 'HomeController@article');
Route::post('/subscriber/add', 'HomeController@postAddSubscriber');
Route::get('/subscriber/confirm/{email}/{token}', 'HomeController@getAddSubscriber');
Route::get('/about', 'HomeController@getAboutUs');
Route::get('/aboutgcc', 'HomeController@getAboutGcc');
Route::get('/terms', 'HomeController@getTermsAndCondition');

Route::post('/article/{id}/comment', 'HomeController@post_comment');
Route::get('comment/{comment_id}/delete', 'HomeController@getDeleteComment');
Route::get('comment/{comment_id}/approve', 'HomeController@getCommentApprove');
Route::get('comment/{comment_id}/disapprove', 'HomeController@getCommentDisapprove');


Route::get('/user/submission', 'HomeController@usersubmission')->middleware('auth');
Route::post('news/add', 'HomeController@postAddNews')->middleware('auth');
// Route::post('news/add/user', 'HomeController@postAjaxAddNews')->middleware('auth');

Auth::routes();

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['admin']], function() {

    Route::get('/unapprovedcomments', 'NewsController@getUnapprovedComments');
    
    Route::get('/settings', 'SettingsController@index');
    Route::post('/settings/changepassword', 'SettingsController@postChangePassword');

    Route::group(['prefix' => 'dashboard'], function() {
        Route::get('/', 'DashboardController@index');
    });

    Route::get('newsletter', 'SubscriberController@getNewsletter');
    Route::get('newsletter/today', 'SubscriberController@getNewsletterToday');
    Route::get('newsletter/{id}', 'SubscriberController@getNewsletterFromArticle');
    Route::post('newsletter', 'SubscriberController@postNewsletter');
    Route::get('newsletter/send', 'SubscriberController@getSendNewsletter');

    Route::group(['prefix' => 'news'], function() {
        Route::get('/published', 'NewsController@index');
        Route::get('/unpublished', 'NewsController@getUnpublished');
        Route::get('/usersubmission', 'NewsController@getUserSubmission');
        Route::get('/add', 'NewsController@getAddNews');
        Route::get('/edit/{id}', 'NewsController@getEditNews');
        Route::post('/edit/{id}', 'NewsController@postEditNews');
        Route::get('/delete/{id}', 'NewsController@getDeleteNews');
        Route::post('/publish/{id}', 'NewsController@postPublishNews');
        Route::post('/unpublish/{id}', 'NewsController@postUnpublishNews');
        Route::post('/approve/{id}', 'NewsController@postApproveNews');

        Route::group(['prefix' => 'category'], function() {
            Route::get('/', 'CategoryController@index');
            Route::get('/add', 'CategoryController@getAddCategory');
            Route::post('/add', 'CategoryController@postAddCategory');
            Route::get('/edit/{id}', 'CategoryController@getEditCategory');
            Route::post('/edit/{id}', 'CategoryController@postEditCategory');
            Route::get('/delete/{id}', 'CategoryController@getDeleteCategory');
        });
    });

    Route::group(['prefix' => 'advertisement'], function() {
        Route::get('/', 'AdvertisementController@index');
        Route::get('/add', 'AdvertisementController@getAddAdvertisement');
        Route::post('/add', 'AdvertisementController@postAddAdvertisement');
        Route::get('/edit/{id}', 'AdvertisementController@getEditAdvertisement');
        Route::post('/edit/{id}', 'AdvertisementController@postEditAdvertisement');
        Route::get('/delete/{id}', 'AdvertisementController@getDeleteAdvertisement');
    });

    Route::group(['prefix' => 'user'], function() {
        Route::get('/', 'UserController@index');
        Route::get('/edit/{id}', 'UserController@postEditUser');
        Route::get('/ban/{id}', 'UserController@getbanUser');
    });

    Route::get('/subscriber', 'SubscriberController@index');
    Route::get('/deleteSubscriber/{id}', 'SubscriberController@deleteSubscriber');

    Route::group(['prefix' => 'about'], function () {
        Route::get('/aboutus', 'AboutController@getAboutUs');
        Route::post('/aboutus', 'AboutController@postAboutUs');
        Route::get('/aboutgcc', 'AboutController@getAboutGcc');
        Route::post('/aboutgcc', 'AboutController@postAboutGcc');
        Route::get('/contact', 'AboutController@getContactUs');
        Route::post('/contact', 'AboutController@postContactUs');
        Route::get('/terms', 'AboutController@getTerms');
        Route::post ('/terms', 'AboutController@postTerms');
        Route::get('/links/{country}', 'AboutController@getLinks');
        Route::post('/links', 'AboutController@postLinks');
    });
});


Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function() {
    Route::get('/{facebook}', 'SocialController@redirectToProvider');
    Route::get('/{facebook}/callback', 'SocialController@handleProviderCallback');

    Route::get('/{google}', 'AuthController@redirectToProvider');
    Route::get('/{google}/callback', 'SocialController@handleProviderCallback');

    Route::get('/{twitter}', 'SocialController@redirectToProvider');
    Route::get('/{twitter}/callback', 'SocialController@handleProviderCallback');
});
    