<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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


Route::get('/', 'CitizenController@getIndex')->name('home');

//CBSUA Alpha Test Routes
// Route::get('/', 'CbsuaController@getIndex')->name('home');
// Route::get('/register/eula', 'CbsuaController@geteula');
// Route::get('/register/form', 'CbsuaController@getform');
// Route::get('/register/verify', 'CbsuaController@getverify');
// Route::get('/register/download', 'CbsuaController@getdownload')->name('getSummary');

// Route::post('/register/postCode', 'CbsuaController@postCode');

// Route::get('/about/developer', 'CbsuaController@getAbout');

// Route::get('/test/mackyhoho/migrate', 'CbsuaController@getMigrate');
// Route::get('/test/mackyhoho/seed', 'CbsuaController@getSeed');
// Route::get('/test/mackyhoho/link', 'CbsuaController@getLink');


// Route::post('/ajaxMuni', 'CbsuaController@ajaxMuni');
// Route::post('/ajaxBrgy', 'CbsuaController@ajaxBrgy');
// Route::post('/ajaxZone', 'CbsuaController@ajaxZone');


//--- citizen registration form
// Route::get('/', 'CitizenController@getIndex');
Route::get('/eula', 'CitizenController@getEULA');
Route::get('/individual', 'CitizenController@getIndividual');
Route::get('/individual/verification', 'CitizenController@getVerification')->name('getVerification');
Route::get('/individual/summary', 'CitizenController@getSummary')->name('getSummary'); 

Route::post('/ajaxGetAddress', 'CitizenController@postAddress');
Route::post('/ajaxResend', 'CitizenController@ajaxResend')->name('ajaxResend.post');
Route::post('/ajaxCheckMobile', 'CitizenController@ajaxCheckMobile')->name('ajaxCheckMobile.post');

Route::post('/postCitizen', 'CitizenController@postCitizen');
Route::post('/postCode', 'CitizenController@postCode');


// //establishment registration form
// Route::get('/establishment', 'UserController@getEstablishment');
// Route::get('/establishment/admin', 'UserController@getEstablishmentAdmin');
// Route::get('/establishment/verification', 'UserController@getEstablishmentVerification');
// Route::get('/establishment/summary', 'UserController@getEstablishmentSummary');


//citizen - icard
Route::get('/citizen/i-card', 'CommonController@getIcard');
Route::get('/citizen/i-card/verification', 'CommonController@getIcardVerification');
Route::get('/citizen/i-card/download', 'CommonController@getIcardDownload');

Route::post('/common/id/ajaxCheckNumberID', 'CommonController@ajaxCheckNumberID');
Route::post('/common/id/ajaxCheckCodeID', 'CommonController@ajaxCheckCodeID');
Route::post('/common/id/ajaxResendCodeID', 'CommonController@ajaxResendCodeID');

//citizen - tracking
Route::get('/citizen/tracking', 'CommonController@getTracking');
Route::get('/citizen/tracking/verification', 'CommonController@getTrackingVerification');
Route::get('/citizen/tracking/record', 'CommonController@getTrackingRecord');
Route::get('/citizens/tracking/history', 'CommonController@getHistoryRecord');

Route::post('/common/tk/ajaxCheckNumberTracking', 'CommonController@ajaxCheckNumberTracking');
Route::post('/common/tk/ajaxCheckCodeTracking', 'CommonController@ajaxCheckCodeTracking');
Route::post('/common/tk/ajaxResendCodeTracking', 'CommonController@ajaxResendCodeTracking');

//-- map
Route::get('/citizen/map', 'CommonController@mapCitizen');
Route::post('/map/sync', 'CommonController@syncmap');
Route::post('/map/info', 'CommonController@mapinfo');
Route::get('/misu/selectTrace' ,'MisuController@selectTrace');


// Auth::routes();
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
    'confirm'  => false, 
  ]);
Route::get('logout', 'LoginController@logout');
//admin - citizen
Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', 'AdminController@getDashboard')->name('adminDashboard');
    Route::get('/citizen/add-new', 'AdminController@getCitizenAddNew');
    Route::get('/citizen/id-card', 'AdminController@getCitizenId');
    Route::get('/citizen/records', 'AdminController@getCitizenRecord');
    Route::get('/citizen/getCitizenInfo', 'AdminController@getCitizenInfo');

    Route::get('/download/generatedFilter', 'AdminController@downloadFilterCitizen');
    Route::get('/download/generatedNoFilter', 'AdminController@downloadNoFilterCitizen');
    Route::post('/admin-citizen-add', 'AdminController@postCitizenAdd');
    Route::post('/admin-citizen-select', 'AdminController@postCitizenSelect');
    Route::post('/citizens-update', 'AdminController@postCitizenUpdate');
    Route::post('/ajaxPostBlockCitizen', 'AdminController@postBlockCitizen');
    Route::post('/ajaxPostUnBlockCitizen', 'AdminController@postUnBlockCitizen');
    Route::post('/citizen/generateInfo', 'AdminController@getGenerateDownload');
    

    //admin - establishment
    Route::get('/establishment/add-new', 'AdminController@getEstablishmentAddNew');
    Route::get('/establishment/records', 'AdminController@getEstablishmentRecords');
    Route::get('/establishment/scanner', 'AdminController@getScanner');

    Route::get('/download/es/information', 'AdminController@downloadES');
    Route::get('/admin/es/getESinfo', 'AdminController@getESinfo');
    
    Route::get('/admin/es/getScanInfo', 'AdminController@getESscanner');

    Route::post('/establishment/ajaxCheckMobile', 'AdminController@ajaxCheckMobileES');
    Route::post('/establishment/add', 'AdminController@EstablishmentAddNew');
    Route::post('/admin/es/select', 'AdminController@EstablishmentSelect');
    Route::post('/admin/es/update', 'AdminController@EstablishmentUpdate');
    Route::post('/admin/es/view', 'AdminController@EstablishmentView');
    Route::post('/ajax-default-scanner', 'AdminController@ScannerDefault');

    Route::get('/download/nofilter/scanner','AdminController@downloadScannerNoFilter');
    Route::get('/download/filter/scanner','AdminController@downloadScannerFilter');

    //admin - account
    Route::get('/admin/add-new', 'AdminController@getAdminAddNew');
    Route::get('/admin/records', 'AdminController@getAdminRecords');
    Route::get('/account/admin-table','AdminController@getAdminTable');
    Route::post('/account/ajaxCheckMobile', 'AdminController@ajaxCheckNumberAdmin');
    Route::post('/account/ajaxCheckAccount', 'AdminController@ajaxCheckUsername');
    Route::post('/account/add-new', 'AdminController@AdminAddNew');
    Route::post('/admin/account/select', 'AdminController@AccountSelect');
    Route::post('/admin/account/update', 'AdminController@AccountUpdate');

    //ctc - symptoms
    Route::get('/ctc/others/symptoms', 'ContactTracerController@getSymtoms');
    Route::get('/ctc/others/facility', 'ContactTracerController@getFacility');
    Route::get('/ctc/tagging', 'ContactTracerController@getTagging');
    Route::get('/ctc/monitor', 'ContactTracerController@getMonitor');
    Route::get('/ctc/symptoms-table', 'ContactTracerController@GetTableSymptoms');
    Route::get('/ctc/facility-table', 'ContactTracerController@GetTableFacility');
    Route::get('/ctc/tagging-table', 'ContactTracerController@GetTableTagging');
    Route::get('/ctc/monitor-table','ContactTracerController@GetTableMonitor');
    Route::get('/ctc/get-citizen/hastag', 'ContactTracerController@GetCitizenHasTag');
    Route::get('/ctc/get-citizen', 'ContactTracerController@GetCitizen');
    Route::post('/postSymptom', 'ContactTracerController@postNewSymptom');

    Route::post('/tag/add-new', 'ContactTracerController@postNewTag');
    
    Route::post('/monitor/add-new', 'ContactTracerController@postNewMonitor');
    
    Route::post('/monitor/view', 'ContactTracerController@postViewMonitor');

    Route::get('/download/nofilter/tagging', 'ContactTracerController@downloadNoFilterTagging');
    Route::get('/download/filter/tagging', 'ContactTracerController@downloadFilterTagging');

    Route::get('/download/nofilter/monitoring', 'ContactTracerController@downloadNoFilterMonitoring');
    Route::get('/download/filter/monitoring', 'ContactTracerController@downloadFilterMonitoring');

    //misu - tracing
    Route::get('/misu/tracing', 'MisuController@getTracing');
    Route::get('/misu/trace-name', 'MisuController@getTraceName');
    Route::get('/misu/trace/select', 'MisuController@selectTrace');

    Route::get('newtrace','ContactTracerController@newtrace');

});












