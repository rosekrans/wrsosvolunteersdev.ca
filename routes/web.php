<?php



Route::get('/', [
    'uses' => 'HomeController@index',
    //'uses' => 'MailController@getMail',
    'as' => 'home',
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/president_update',  function () {
        return view('president_update');
    })->name('president_update');
});

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function(){
    Route::get('create', [
        'uses' => 'ProfileController@create',
        'as' => 'profile.create',
        'middleware' => 'admin'
    ]);
    Route::post('store', [
        'uses' => 'ProfileController@store',
        'as' => 'profile.store',
        'middleware' => 'admin'
    ]);
    Route::get('{user_id}', [
        'uses' => 'ProfileController@show',
        'as' => 'profile.show'
    ]);
    Route::get('{user_id}/edit', [
        'uses' => 'ProfileController@edit',
        'as' => 'profile.edit'
    ]);
    Route::put('{user_id}', [
        'uses' => 'ProfileController@update',
        'as' => 'profile.update'
    ]);
    Route::get('delete/{id}', [
        'uses' => 'ProfileController@delete',
        'as' => 'profile.delete'
    ]);
    Route::get('searchPostalCodes/{term}',[
        'uses' => 'ProfileController@searchPostalCodes',
        'as' => 'profile.searchPostalCodes'
    ]);
});

Route::group(['prefix' => 'schedule', 'middleware' => 'auth'], function(){
    Route::get('create', [
        'uses' => 'ScheduleController@create',
        'as' => 'schedule.create'
    ]);
    Route::post('store', [
        'uses' => 'ScheduleController@store',
        'as' => 'schedule.store'
    ]);
    Route::get('{user_detail_id}/edit', [
        'uses' => 'ScheduleController@edit',
        'as' => 'schedule.edit'
    ]);
    Route::put('{user_detail_id}', [
        'uses' => 'ScheduleController@update',
        'as' => 'schedule.update'
    ]);
    Route::delete('{id}', [
        'uses' => 'ScheduleController@destroy',
        'as' => 'schedule.delete'
    ]);
});

Route::group(['prefix' => 'veterinarian', 'middleware' => 'auth'], function(){
    Route::get('', [
        'uses' => 'VeterinarianController@index',
        'as' => 'veterinarian.index'
    ]);
    Route::get('create', [
        'uses' => 'VeterinarianController@create',
        'as' => 'veterinarian.create'
    ]);
    Route::post('store', [
        'uses' => 'VeterinarianController@store',
        'as' => 'veterinarian.store'
    ]);
    Route::get('{id}', [
        'uses' => 'VeterinarianController@show',
        'as' => 'veterinarian.show'
    ]);
    Route::get('{id}/edit', [
        'uses' => 'VeterinarianController@edit',
        'as' => 'veterinarian.edit'
    ]);
    Route::put('{id}', [
        'uses' => 'VeterinarianController@update',
        'as' => 'veterinarian.update'
    ]);
    Route::get('delete/{id}', [
        'uses' => 'VeterinarianController@delete',
        'as' => 'veterinarian.delete'
    ]);
});

Route::group(['prefix' => 'rehabilitator', 'middleware' => 'auth'], function(){
    Route::get('', [
        'uses' => 'RehabilitatorController@index',
        'as' => 'rehabilitator.index'
    ]);
    Route::get('create', [
        'uses' => 'RehabilitatorController@create',
        'as' => 'rehabilitator.create'
    ]);
    Route::post('store', [
        'uses' => 'RehabilitatorController@store',
        'as' => 'rehabilitator.store'
    ]);
    Route::get('{id}', [
        'uses' => 'RehabilitatorController@show',
        'as' => 'rehabilitator.show'
    ]);
    Route::get('{id}/edit', [
        'uses' => 'RehabilitatorController@edit',
        'as' => 'rehabilitator.edit'
    ]);
    Route::put('{id}', [
        'uses' => 'RehabilitatorController@update',
        'as' => 'rehabilitator.update'
    ]);
    Route::get('delete/{id}', [
        'uses' => 'RehabilitatorController@delete',
        'as' => 'rehabilitator.delete'
    ]);
});

Route::group(['prefix' => 'other', 'middleware' => 'auth'], function(){
    Route::get('', [
        'uses' => 'OtherContactController@index',
        'as' => 'other.index'
    ]);
    Route::get('create', [
        'uses' => 'OtherContactController@create',
        'as' => 'other.create'
    ]);
    Route::post('store', [
        'uses' => 'OtherContactController@store',
        'as' => 'other.store'
    ]);
    Route::get('{id}', [
        'uses' => 'OtherContactController@show',
        'as' => 'other.show'
    ]);
    Route::get('{id}/edit', [
        'uses' => 'OtherContactController@edit',
        'as' => 'other.edit'
    ]);
    Route::put('{id}', [
        'uses' => 'OtherContactController@update',
        'as' => 'other.update'
    ]);
    Route::get('delete/{id}', [
        'uses' => 'OtherContactController@delete',
        'as' => 'other.delete'
    ]);
});

Route::group(['prefix' => 'membership', 'middleware' => 'auth'], function(){
    Route::get('', [
        'uses' => 'MembershipController@index',
        'as' => 'membership.index'
    ]);
    Route::get('create', [
        'uses' => 'MembershipController@create',
        'as' => 'membership.create'
    ]);
    Route::post('store', [
        'uses' => 'MembershipController@store',
        'as' => 'membership.store'
    ]);
    Route::get('{id}', [
        'uses' => 'MembershipController@show',
        'as' => 'membership.show'
    ]);
    Route::get('{id}/edit', [
        'uses' => 'MembershipController@edit',
        'as' => 'membership.edit'
    ]);
    Route::put('{id}', [
        'uses' => 'MembershipController@update',
        'as' => 'membership.update'
    ]);
    Route::get('delete/{id}', [
        'uses' => 'MembershipController@delete',
        'as' => 'membership.delete'
    ]);
});

Route::group(['prefix' => 'report', 'middleware' => 'auth'], function(){
    Route::get('', [
        'uses' => 'ReportController@index',
        'as' => 'report.index'
    ]);
});

Route::get('volunteer', [
    'uses' => 'VolunteerController@index',
    'as' => 'volunteer.index',
    'middleware' => 'auth'
]);

Route::get('administrative', [
    'uses' => 'AdministrativeController@index',
    'as' => 'administrative.index',
    'middleware' => 'auth'
]);

Route::group(['prefix' => 'document', 'middleware' => 'auth'], function(){
    Route::get('', [
        'uses' => 'DocumentController@index',
        'as' => 'document.index'
    ]);
    Route::get('scan/{dir}', [
        'uses' => 'DocumentController@scan',
        'as' => 'document.scan'
    ]);
    Route::post('uploadFile', [
        'uses' => 'DocumentController@uploadFile',
        'as' => 'document.uploadFile',
        'middleware' => 'admin'
    ]);
    Route::get('deleteFile', [
        'uses' => 'DocumentController@deleteFile',
        'as' => 'document.deleteFile',
        'middleware' => 'admin'
    ]);
    Route::post('createFolder', [
        'uses' => 'DocumentController@createFolder',
        'as' => 'document.createFolder',
        'middleware' => 'admin'
    ]);
    Route::get('deleteFolder', [
        'uses' => 'DocumentController@deleteFolder',
        'as' => 'document.deleteFolder',
        'middleware' => 'admin'
    ]);
});

Route::group(['prefix' => 'call_log', 'middleware' => 'auth'], function(){
    Route::get('', [
        'uses' => 'CallLogController@index',
        'as' => 'call_log.index'
    ]);
    Route::get('create', [
        'uses' => 'CallLogController@create',
        'as' => 'call_log.create'
    ]);
    Route::post('store', [
        'uses' => 'CallLogController@store',
        'as' => 'call_log.store'
    ]);
    Route::get('{id}', [
        'uses' => 'CallLogController@show',
        'as' => 'call_log.show'
    ]);
    Route::get('{id}/edit', [
        'uses' => 'CallLogController@edit',
        'as' => 'call_log.edit'
    ]);
    Route::put('{id}', [
        'uses' => 'CallLogController@update',
        'as' => 'call_log.update'
    ]);
    Route::get('{id}/delete', [
        'uses' => 'CallLogController@delete',
        'as' => 'call_log.delete'
    ]);

    Route::get('searchSpecies/{term}',[
        'uses' => 'CallLogController@searchSpecies',
        'as' => 'call_log.searchSpecies'
    ]);

    Route::get('searchVolunteers/{term}',[
        'uses' => 'CallLogController@searchVolunteers',
        'as' => 'call_log.searchVolunteers'
    ]);
});

Auth::routes();
