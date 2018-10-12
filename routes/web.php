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
    // return view('welcome');
    return view('users.login');
})->where('vue_capture', '[\/\w\.-]*');
Route::get('/register', function () {
    // return view('welcome');
});
Route::view('home', 'magazine.home');

Auth::routes();

Route::group(['middleware' => ['web', 'auth']], function () {
    //  authentication meddleware
    Route::resource('users', 'Admin\UsersController');
    Route::resource('roles', 'Admin\RolesController');
    Route::get('excel_upload', 'Admin\UploadCSVController@uploadData');
    Route::resource('uploadCSV', 'Admin\UploadCSVController');
});
// Route::patch('/roles',[
//     'as' => 'user.index',
//     'uses' => 'HomeController@index'
// ]);
// Route::patch('/users',[
//     'as' => 'user.index',
//     'uses' => 'HomeController@index'
// ]);

// Route::get('/roles', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('getp', function () {
    $a = $pdf = \PDF::loadView('pdf');
    return $pdf->download('invoice.pdf');
});
Route::get('pdf/{id}', 'Admin\UploadCSVController@pdfGenerate');

Route::get('downloadpdf', 'Admin\UploadCSVController@downloadpdf');

Route::get('/preview/book1/{pageId}/{userId}', 'BookPDF\Book1Controller@preview');
Route::get('/preview/book2/{pageId}/{userId}', 'BookPDF\Book2Controller@preview');
Route::get('/preview/book3/{pageId}/{userId}', 'BookPDF\Book3Controller@preview');

Route::get('getpdf', function () {
    $bookData = \DB::table('users_books')
                    ->where('user_id', 2)
                    ->where('book_id', 1)
                    ->first();
    $bookData->front_cover = $bookData->front_cover ? unserialize($bookData->front_cover) : '';
    $bookData->inside_front_cover = $bookData->inside_front_cover ? unserialize($bookData->inside_front_cover) : '';
    $bookData->inside_back_cover = $bookData->inside_back_cover ? unserialize($bookData->inside_back_cover) : '';
    $bookData->back_cover = $bookData->back_cover!='' ? unserialize($bookData->back_cover) : '';
    return view('magazine.generatePDFBook_2', compact('bookData'));
});
