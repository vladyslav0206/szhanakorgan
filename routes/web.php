<?php


/******* Admin page *******/
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'web'
], function() {

    Route::any('/login', 'AuthController@login');
    Route::get('/logout', 'AuthController@logout');

    Route::post('/booked_result', 'MenuController@getResult');

    Route::post('news/is_show', 'NewsController@changeIsShow');
    Route::resource('news', 'NewsController');

    Route::post('news/is_show', 'NewsController@changeIsShow');

    Route::resource('rooms', 'RoomsController');
    Route::resource('specialists', 'SpecialistsController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('services', 'ServicesController');
    Route::resource('menu', 'MenuController');
    Route::resource('statictext', 'StaticTextController');
    Route::resource('feedback', 'FeedBackController');
    Route::resource('gallery', 'GalleryController');
    Route::resource('images', 'ImagesController');

    Route::get('index', 'IndexController@index');
    Route::get('count', 'IndexController@getOrderCount');
    Route::get('url', 'IndexController@getUrl');

    Route::post('rubric/is_show', 'RubricController@changeIsShow');
    Route::resource('rubric', 'RubricController');
    
    Route::post('comment/is_show', 'CommentController@changeIsShow');
    Route::resource('comment', 'CommentController');

    Route::post('contact/is_show', 'ContactController@changeIsShow');
    Route::resource('contact', 'ContactController');

    Route::post('journal/is_show', 'JournalController@changeIsShow');
    Route::resource('journal', 'JournalController');

    Route::post('moderator/is_show', 'ModeratorController@changeIsBan');
    Route::resource('moderator', 'ModeratorController');
    
    Route::post('user/is_show', 'UserController@changeIsBan');
    Route::resource('user', 'UserController');
    Route::any('password', 'UserController@password');
    
    Route::post('page/is_show', 'PageController@changeIsShow');
    Route::resource('page', 'PageController');

    Route::post('info/is_show', 'InfoController@changeIsShow');
    Route::resource('info', 'InfoController');
    
    Route::post('banner/is_show', 'BannerController@changeIsShow');
    Route::resource('banner', 'BannerController');

    Route::post('audio/is_show', 'AudioController@changeIsShow');
    Route::post('audio/upload', 'AudioController@uploadAudio');
    Route::resource('audio', 'AudioController');
});


/******* Main page *******/
Route::group([
    'middleware' => 'web'
], function() {
    Route::post('image/upload', 'ImageController@uploadImage');
    Route::get('media/{file_name}', 'ImageController@getImage')->where('file_name', '.*');

    Route::get('/book', 'BookController@getBook');
    Route::post('/book', 'BookController@postBook');
    Route::get('/admin/book', 'BookController@showBook');
    Route::post('/admin/book', 'BookController@checkBook');
    Route::delete('/admin/book/{id}', 'BookController@destroy');
});


/******* Index *******/
Route::group([
    'middleware' => 'web',
    'namespace' => 'Index',
], function() {

    Route::get('/', 'IndexController@index');
    Route::get('/gallery', 'IndexController@getGallery');
    Route::get('/rooms', 'IndexController@getRooms');
    Route::get('/about', 'IndexController@getAbout');
    Route::get('/services', 'IndexController@getServices');
    Route::get('/service/{id}', 'IndexController@getService');
    Route::get('/leisure', 'IndexController@getLeisure');
    //Route::get('/leisures/{id}', 'IndexController@getLeisures');
    Route::get('/contacts', 'IndexController@getContacts');
//    Route::get('/treatment', 'IndexController@getTreatment');
    Route::get('/toktamys', 'IndexController@getToktamys');
    Route::get('/specialist/{id}', 'IndexController@getSpecialist');
    Route::get('/pitanie', 'IndexController@getPitanie');
    Route::get('/page/{url}/{id}', 'IndexController@getPage');


    Route::group([
        'prefix' => 'ajax'
    ], function() {
        Route::post('contact', 'IndexController@sendMessage');
        Route::post('comment', 'CommentController@addComment');
        Route::get('comment', 'CommentController@getCommentListByNews');
        Route::get('money', 'IndexController@getMoneyList');
        Route::get('user', 'IndexController@addUser');
        Route::get('activation', 'IndexController@activation');
        Route::get('login', 'IndexController@login');
    });

    Route::group([
        'prefix' => 'cron'
    ], function() {
        Route::get('currency', 'CronController@getCurrency');
        Route::get('whether', 'CronController@getWhether');
        Route::get('latin', 'CronController@convertToQazLatin');
    });

//    Route::get('{url}', 'NewsController@showRubricByUrl');

});