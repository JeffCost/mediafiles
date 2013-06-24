<?php

Route::post('/mediafiles/ajax/update_counter', function()
{
    return Controller::call('mediafiles::frontend.mediafiles@update_counter');
});