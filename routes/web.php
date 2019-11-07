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

Route::get('/home', 'HomeController@index')->name('home');



//ADMINISTRADOR
Auth::routes();
Route::get('/home', 'Admin\HomeController@index')->name('home')->middleware('auth', 'role:admin');

//package
Route::post('admin/estado_home/', [
    'uses' => 'Admin\PackageController@estado_home',
    'as' => 'estado_home_path',
]);
Route::post('admin/is_package/', [
    'uses' => 'Admin\PackageController@is_package',
    'as' => 'is_package_path',
]);
Route::post('admin/is_tours/', [
    'uses' => 'Admin\PackageController@is_tours',
    'as' => 'is_tours_path',
]);

Route::get('admin/package/create', [
    'uses' => 'Admin\HomeController@create',
    'as' => 'admin_package_create_path',
]);
Route::post('admin/package/store', [
    'uses' => 'Admin\HomeController@store',
    'as' => 'admin_package_store_path',
]);
Route::get('admin/package/edit/{id}', [
    'uses' => 'Admin\HomeController@edit',
    'as' => 'admin_package_edit_path',
]);
Route::post('admin/package/update/{id}', [
    'uses' => 'Admin\HomeController@update',
    'as' => 'admin_package_update_path',
]);
Route::post('admin/package/duration', [
    'uses' => 'Admin\HomeController@duration',
    'as' => 'admin_package_duration_path',
]);
Route::get('admin/package/load/{id}/{duration}', [
    'uses' => 'Admin\HomeController@load',
    'as' => 'load_path',
]);
Route::delete('admin/package/edit/{id}', [
    'uses' => 'Admin\HomeController@destroy',
    'as' => 'admin_package_delete_path',
]);

Route::get('admin/package/image/image_upload', [
    'uses' => 'Admin\HomeController@image_upload',
    'as' => 'admin_upload_file_path',
]);
Route::post('admin/package/image/image_store', [
    'uses' => 'Admin\HomeController@image_store',
    'as' => 'admin_image_maps_store_path',
]);
Route::post('admin/package/image/image_delete', [
    'uses' => 'Admin\HomeController@image_delete',
    'as' => 'admin_image_delete_path',
]);

Route::post('admin/package/image/image_store_slider', [
    'uses' => 'Admin\HomeController@image_store_slider',
    'as' => 'admin_image_slider_store_path',
]);
Route::post('admin/package/image/image_delete_slider', [
    'uses' => 'Admin\HomeController@image_delete_slider',
    'as' => 'admin_image_slider_delete_path',
]);
Route::post('admin/package/image/image_delete_package_form', [
    'uses' => 'Admin\HomeController@image_delete_package_form',
    'as' => 'admin_image_delete_package_form_path',
]);
Route::post('admin/package/image/image_delete_map_package_form', [
    'uses' => 'Admin\HomeController@image_delete_map_package_form',
    'as' => 'admin_image_delete_map_package_form_path',
]);

//itinerary
Route::get('admin/itinerary', [
    'uses' => 'Admin\ItineraryController@index',
    'as' => 'admin_itinerary_index_path',
]);
Route::get('admin/itinerary/create', [
    'uses' => 'Admin\ItineraryController@create',
    'as' => 'admin_itinerary_create_path',
]);
Route::post('admin/itinerary/store', [
    'uses' => 'Admin\ItineraryController@store',
    'as' => 'admin_itinerary_store_path',
]);
Route::get('admin/itinerary/edit/{id}', [
    'uses' => 'Admin\ItineraryController@edit',
    'as' => 'admin_itinerary_edit_path',
]);
Route::post('admin/itinerary/update/{id}', [
    'uses' => 'Admin\ItineraryController@update',
    'as' => 'admin_itinerary_update_path',
]);
Route::delete('admin/itinerary/edit/{id}', [
    'uses' => 'Admin\ItineraryController@destroy',
    'as' => 'admin_itinerary_delete_path',
]);
Route::post('admin/itinerary/image/image_store', [
    'uses' => 'Admin\ItineraryController@image_store',
    'as' => 'admin_itinerary_image_store_path',
]);
Route::post('admin/itinerary/image/image_delete', [
    'uses' => 'Admin\ItineraryController@image_delete',
    'as' => 'admin_iitinerary_mage_delete_path',
]);
Route::post('admin/itinerary/image/image_delete_form', [
    'uses' => 'Admin\ItineraryController@image_delete_form',
    'as' => 'admin_iitinerary_image_delete_form_path',
]);
Route::get('admin/itinerary/image/image_list', [
    'uses' => 'Admin\ItineraryController@image_list',
    'as' => 'admin_itinerary_list_path',
]);
//destinations
Route::get('admin/destinations', [
    'uses' => 'Admin\DestinationsController@index',
    'as' => 'admin_destinations_index_path',
]);
Route::get('admin/destinations/create', [
    'uses' => 'Admin\DestinationsController@create',
    'as' => 'admin_destinations_create_path',
]);
Route::post('admin/destinations/store', [
    'uses' => 'Admin\DestinationsController@store',
    'as' => 'admin_destinations_store_path',
]);
Route::get('admin/destinations/edit/{id}', [
    'uses' => 'Admin\DestinationsController@edit',
    'as' => 'admin_destinations_edit_path',
]);
Route::post('admin/destinations/update/{id}', [
    'uses' => 'Admin\DestinationsController@update',
    'as' => 'admin_destinations_update_path',
]);
Route::delete('admin/destinations/edit/{id}', [
    'uses' => 'Admin\DestinationsController@destroy',
    'as' => 'admin_destinations_delete_path',
]);




Route::post('admin/destinations/image/image_destinations_slider_store', [
    'uses' => 'Admin\DestinationsController@image_destinations_slider_store',
    'as' => 'admin_image_destinations_slider_store_path',
]);
Route::post('admin/destinations/image/image_destinations_slider_delete', [
    'uses' => 'Admin\DestinationsController@image_destinations_slider_delete',
    'as' => 'admin_destinations_slider_delete_path',
]);
Route::post('admin/destinations/image/image_destinations_slider_form_delete', [
    'uses' => 'Admin\DestinationsController@image_destinations_slider_form_delete',
    'as' => 'admin_destinations_slider_form_delete_path',
]);

Route::post('admin/destinations/image/image_destinations_image_store', [
    'uses' => 'Admin\DestinationsController@image_destinations_image_store',
    'as' => 'admin_image_destinations_image_store_path',
]);
Route::post('admin/destinations/image/image_destinations_image_delete', [
    'uses' => 'Admin\DestinationsController@image_destinations_image_delete',
    'as' => 'admin_destinations_image_delete_path',
]);
Route::post('admin/destinations/image/image_delete_form', [
    'uses' => 'Admin\DestinationsController@image_destinations_image_form_delete',
    'as' => 'admin_destinations_image_form_delete_path',
]);




//included
Route::get('admin/included', [
    'uses' => 'Admin\IncludedController@index',
    'as' => 'admin_included_index_path',
]);
Route::post('admin/included/store', [
    'uses' => 'Admin\IncludedController@store',
    'as' => 'admin_included_store_path',
]);
Route::post('admin/included/update/{id}', [
    'uses' => 'Admin\IncludedController@update',
    'as' => 'admin_included_update_path',
]);
Route::delete('admin/included/edit/{id}', [
    'uses' => 'Admin\IncludedController@destroy',
    'as' => 'admin_included_delete_path',
]);
//not included
Route::get('admin/not-included', [
    'uses' => 'Admin\NotIncludedController@index',
    'as' => 'admin_not_included_index_path',
]);
Route::post('admin/not-included/store', [
    'uses' => 'Admin\NotIncludedController@store',
    'as' => 'admin_not_included_store_path',
]);
Route::post('admin/not-included/update/{id}', [
    'uses' => 'Admin\NotIncludedController@update',
    'as' => 'admin_not_included_update_path',
]);
Route::delete('admin/not-included/edit/{id}', [
    'uses' => 'Admin\NotIncludedController@destroy',
    'as' => 'admin_not_included_delete_path',
]);
//category
Route::get('admin/category', [
    'uses' => 'Admin\CategoryController@index',
    'as' => 'admin_category_index_path',
]);
Route::get('admin/category/edit/{id}', [
    'uses' => 'Admin\CategoryController@edit',
    'as' => 'admin_category_edit_path',
]);


Route::post('admin/category/image/image_category_slider_store', [
    'uses' => 'Admin\CategoryController@image_category_slider_store',
    'as' => 'admin_image_category_slider_store_path',
]);
Route::post('admin/category/image/image_category_slider_delete', [
    'uses' => 'Admin\CategoryController@image_category_slider_delete',
    'as' => 'admin_category_slider_delete_path',
]);
Route::post('admin/category/image/image_category_slider_form_delete', [
    'uses' => 'Admin\CategoryController@image_category_slider_form_delete',
    'as' => 'admin_category_slider_form_delete_path',
]);

Route::post('admin/category/image/image_category_image_store', [
    'uses' => 'Admin\CategoryController@image_category_image_store',
    'as' => 'admin_image_category_image_store_path',
]);
Route::post('admin/category/image/image_category_image_delete', [
    'uses' => 'Admin\CategoryController@image_category_image_delete',
    'as' => 'admin_category_image_delete_path',
]);
Route::post('admin/category/image/image_delete_form', [
    'uses' => 'Admin\CategoryController@image_category_image_form_delete',
    'as' => 'admin_category_image_form_delete_path',
]);



Route::post('admin/category/store', [
    'uses' => 'Admin\CategoryController@store',
    'as' => 'admin_category_store_path',
]);
Route::post('admin/category/update/{id}', [
    'uses' => 'Admin\CategoryController@update',
    'as' => 'admin_category_update_path',
]);
Route::delete('admin/category/edit/{id}', [
    'uses' => 'Admin\CategoryController@destroy',
    'as' => 'admin_category_delete_path',
]);
//difficulty
Route::get('admin/difficulty', [
    'uses' => 'Admin\DifficultyController@index',
    'as' => 'admin_difficulty_index_path',
]);
Route::post('admin/difficulty/store', [
    'uses' => 'Admin\DifficultyController@store',
    'as' => 'admin_difficulty_store_path',
]);
Route::post('admin/difficulty/update/{id}', [
    'uses' => 'Admin\DifficultyController@update',
    'as' => 'admin_difficulty_update_path',
]);
Route::delete('admin/difficulty/edit/{id}', [
    'uses' => 'Admin\DifficultyController@destroy',
    'as' => 'admin_difficulty_delete_path',
]);
//video

Route::get('admin/video', [
    'uses' => 'Admin\VideoController@index',
    'as' => 'admin_video_index_path',
]);
Route::get('admin/video/create', [
    'uses' => 'Admin\VideoController@create',
    'as' => 'admin_video_create_path',
]);
Route::post('admin/video/store', [
    'uses' => 'Admin\VideoController@store',
    'as' => 'admin_video_store_path',
]);
Route::get('admin/video/edit/{id}', [
    'uses' => 'Admin\VideoController@edit',
    'as' => 'admin_video_edit_path',
]);
Route::post('admin/video/update/{id}', [
    'uses' => 'Admin\VideoController@update',
    'as' => 'admin_video_update_path',
]);
Route::delete('admin/video/edit/{id}', [
    'uses' => 'Admin\VideoController@destroy',
    'as' => 'admin_video_delete_path',
]);
Route::post('admin/video/image/image_store', [
    'uses' => 'Admin\VideoController@image_store',
    'as' => 'admin_video_image_store_path',
]);
Route::post('admin/video/image/image_delete', [
    'uses' => 'Admin\VideoController@image_delete',
    'as' => 'admin_video_image_delete_path',
]);
Route::post('admin/video/image/image_delete_form', [
    'uses' => 'Admin\VideoController@image_delete_form',
    'as' => 'admin_video_image_delete_form_path',
]);
Route::get('admin/video/image/image_list', [
    'uses' => 'Admin\VideoController@image_list',
    'as' => 'admin_video_list_path',
]);
//inquire
Route::get('admin/inquire', [
    'uses' => 'Admin\InquireController@list',
    'as' => 'admin_list_index_path',
]);
Route::get('admin/inquire/{id}', [
    'uses' => 'Admin\InquireController@index',
    'as' => 'admin_inquire_index_path',
]);
Route::post('admin/inquire/store', [
    'uses' => 'Admin\InquireController@store',
    'as' => 'admin_inquire_store_path',
]);
Route::get('admin/inquire/edit/{id}', [
    'uses' => 'Admin\InquireController@edit',
    'as' => 'admin_inquire_edit_index_path',
]);
Route::delete('admin/inquire/delete/{id}', [
    'uses' => 'Admin\InquireController@destroy',
    'as' => 'admin_inquire_delete_path',
]);
//testimonials
Route::get('admin/testimonial', [
    'uses' => 'Admin\TestimonialController@index',
    'as' => 'admin_testimonial_index_path',
]);
