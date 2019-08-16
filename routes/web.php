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

Route::get('/', 'Marlin@index');
Route::get('/cekongkir', 'Marlin@cekongkir');
Route::post('/proses', 'Marlin@index_proses');

Route::get('citybyid/{id}',function($id){
	return city($id);
});

Route::get('biayakirim',function(){
	// cost($origin,$destination,$weight,$courier)
	$origin = $_GET['origin'];
	$destination = $_GET['destination'];
	$weight = $_GET['weight'];
	$courier = $_GET['courier'];
	// return $origin;
	return cost($origin,$destination,$weight,$courier);
});

