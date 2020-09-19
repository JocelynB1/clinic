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
    return view('home');
});

/*
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});*/
Auth::routes();
Route::group(['middleware' => ['auth']], function () {

Route::get('/home', 'HomeController@index')->name('home');
Route::get('patients/createPrevious','PatientController@createPrevious')->name('patients.createPrevious');
Route::get('patients/searchByName','PatientController@searchByName')->name('patients.searchByName');
Route::get('patients/searchByPhoneNumber','PatientController@searchByPhoneNumber')->name('patients.searchByPhoneNumber');
Route::get('patients/review/{id}','PatientController@review');
Route::get('showAllPatientData/{patient}','PatientController@showAllPatientData');
Route::get('showPatientVitals/{id}','PatientController@showPatientVitals');
Route::get('showPatientLabs/{id}','PatientController@showPatientLabs');
Route::get('showPatientVisits/{id}','PatientController@showPatientVisits');
Route::get('showPatientConsultations/{id}','PatientController@showPatientConsultations');
Route::get('folderExport/{id}','PatientController@export');
Route::resource('patients', 'PatientController');
Route::any('patients/search', 'PatientController@search')->name('patients.search');
Route::any('score', 'ConsultationController@score');
Route::any('consultations/search', 'ConsultationController@search')->name('consultations.search');
Route::any('epirxisk', 'ConsultationController@epirxisk')->name('consultations.epirxisk');
Route::any('getPatientsByRiskFactor', 'ReportController@getPatientsByRiskFactor')->name('reports.getPatientsByRiskFactor');
Route::any('getPatientsByRiskLevel', 'ReportController@getPatientsByRiskLevel')->name('reports.getPatientsByRiskLevel');
Route::any('getPatientsWhoHaveNotAttendedForSixMonths', 'ReportController@getPatientsWhoHaveNotAttendedForSixMonths')->name('reports.getPatientsWhoHaveNotAttendedForSixMonths');
Route::any('getGenderPerPeriod', 'ReportController@getGenderPerPeriod')->name('reports.getGenderPerPeriod');
Route::any('getBpCategoryPerPeriod', 'ReportController@getBpCategoryPerPeriod')->name('reports.getBpCategoryPerPeriod');
Route::any('getPatientsByAgePerPeriod', 'ReportController@getPatientsByAgePerPeriod')->name('reports.getPatientsByAgePerPeriod');
Route::any('setPatientsByRiskFactor', 'ReportController@setPatientsByRiskFactor')->name('reports.setPatientsByRiskFactor');
Route::any('setPatientsByRiskLevel', 'ReportController@setPatientsByRiskLevel')->name('reports.setPatientsByRiskLevel');
Route::any('setPatientsByAgePerPeriod', 'ReportController@setPatientsByAgePerPeriod')->name('reports.setPatientsByAgePerPeriod');
Route::any('setGenderPerPeriod', 'ReportController@setGenderPerPeriod')->name('reports.setGenderPerPeriod');
Route::any('setBpCategoryPerPeriod', 'ReportController@setBpCategoryPerPeriod')->name('reports.setBpCategoryPerPeriod');
Route::any('getPatientsPerPeriod', 'ReportController@getPatientsPerPeriod')->name('reports.getPatientsPerPeriod');
Route::any('getDisposalsPerPeriod', 'ReportController@getDisposalsPerPeriod')->name('reports.getDisposalsPerPeriod');
Route::any('setPatientsPerPeriod', 'ReportController@setPatientsPerPeriod')->name('reports.setPatientsPerPeriod');
Route::any('setDisposalsPerPeriod', 'ReportController@setDisposalsPerPeriod')->name('reports.setDisposalsPerPeriod');
Route::any('showPatientDetails', 'ReportController@showPatientDetails')->name('reports._show_patient_details');

Route::resource('visits', 'VisitController');
Route::resource('labs', 'LabController');
Route::resource('vitals', 'VitalController');
Route::resource('consultations', 'ConsultationController');
});
