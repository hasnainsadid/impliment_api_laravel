<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\StudentController;

Route::redirect('/', 'student', 301);

Route::resource('student', StudentController::class);
