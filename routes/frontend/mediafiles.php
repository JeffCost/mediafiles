<?php

Route::get('downloads', function()
{
    return Controller::call('mediafiles::frontend.mediafiles@index');
});