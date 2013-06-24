<?php

Route::put(ADM_URI.'/(:bundle)/ajax/sort', function()
{
    return Controller::call('mediafiles::backend.ajax@sort');
});