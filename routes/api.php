<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace'=> 'App\Http\Controllers'],function (){
    //navigation routes
    Route::post('navigation','NavigationController@index');
    //update
    Route::post('navigation/update/{id}','NavigationController@update');
    // store
    Route::post('navigation/create','NavigationController@store');
    // destroy
    route::get('navigation/destroy/{id}','NavigationController@destroy');

    //header routes
    Route::post('header','HeaderController@index');
    //update
    Route::post('header/update/{id}','HeaderController@update');
    // store
    Route::post('header/create','HeaderController@store');
    // destroy
    route::get('header/destroy/{id}','HeaderController@destroy');

    // team routes
    Route::post('team','TeamController@index');
    Route::post('team/by/{id}','TeamController@teamById');
    //update
    Route::post('team/update/{id}','TeamController@update');
    // store
    Route::post('team/create','TeamController@store');
    // destroy
    route::get('team/destroy/{id}','TeamController@destroy');

    // press routes
    Route::post('press','PressController@index');
    Route::post('press/by/{id}','PressController@pressById');
    //update
    Route::post('press/update/{id}','PressController@update');
    // store
    Route::post('press/create','PressController@store');
    // destroy
    route::get('press/destroy/{id}','PressController@destroy');

    // project categories routes
    Route::post('category','projectCategoriesController@index');
    //update
    Route::post('category/update/{id}','projectCategoriesController@update');
    // store
    Route::post('category/create','projectCategoriesController@store');
    // destroy
    route::get('category/destroy/{id}','projectCategoriesController@destroy');

    //project routes
    Route::post('project','projectController@index');
    //update
    Route::post('project/update/{id}','projectController@update');
    // store
    Route::post('project/create','projectController@store');
    // destroy
    route::get('project/destroy/{id}','projectController@destroy');

    //gallery routes
    Route::post('gallery','ProjectGalleryController@index');
    //update
    Route::post('gallery/update/{id}','ProjectGalleryController@update');
    // store
    Route::post('gallery/create','ProjectGalleryController@store');
    // destroy
    route::get('gallery/destroy/{id}','ProjectGalleryController@destroy');

    //Availability routes
    Route::post('availability','AvailabilityController@index');
    //update
    Route::post('availability/update/{id}','AvailabilityController@update');
    // store
    Route::post('availability/create','AvailabilityController@store');
    // destroy
    route::get('availability/destroy/{id}','AvailabilityController@destroy');

    //feature routes
    Route::post('feature','AvailabilityFeatureController@index');
    //update
    Route::post('feature/update/{id}','AvailabilityFeatureController@update');
    // store
    Route::post('feature/create','AvailabilityFeatureController@store');
    // destroy
    route::get('feature/destroy/{id}','AvailabilityFeatureController@destroy');

    //Gallery routes
    Route::post('A/gallery','AvailabilityGalleriesController@index');
    //update
    Route::post('A/gallery/update/{id}','AvailabilityGalleriesController@update');
    // store
    Route::post('A/gallery/create','AvailabilityGalleriesController@store');
    // destroy
    route::get('A/gallery/destroy/{id}','AvailabilityGalleriesController@destroy');

    //About routes
    Route::post('about','AboutController@index');
    //update
    Route::post('about/update/{id}','AboutController@update');
    // store
    Route::post('about/create','AboutController@store');
    // destroy
    route::get('about/destroy/{id}','AboutController@destroy');




});


