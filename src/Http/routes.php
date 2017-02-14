<?php

Route::post('envol', 'Cbouvat\Envol\Http\Controllers\EnvolController@hook')->middleware('api');
