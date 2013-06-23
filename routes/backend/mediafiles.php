<?php

Route::get(ADM_URI.'/(:bundle)', function()
{
    return Controller::call('mediafiles::backend.mediafiles@index');
});

Route::get(ADM_URI.'/(:bundle)/(:num)/edit', function($id)
{
    return Controller::call('mediafiles::backend.mediafiles@edit', array($id));
});

Route::get(ADM_URI.'/(:bundle)/new', function()
{
    return Controller::call('mediafiles::backend.mediafiles@new');
});

Route::post(ADM_URI.'/(:bundle)', function()
{
    return Controller::call('mediafiles::backend.mediafiles@create');
});

Route::put(ADM_URI.'/(:bundle)/(:num)', function($id)
{
    return Controller::call('mediafiles::backend.mediafiles@update', array($id));
});

Route::delete(ADM_URI.'/(:bundle)/(:num)', function($id)
{
    return Controller::call('mediafiles::backend.mediafiles@destroy', array($id));
});
