<?php

use Illuminate\Support\Facades\Process;
use App\Jobs\ProcessPodcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/add-jobs-to-queue', function () {
    

    for ($i=0; $i < 10; $i++) { 
        ProcessPodcast::dispatch();
    }

    return 'done';
});

Route::get('/restart-queue', function () {
    


    return 'queue restarted';
});


Route::get('/restart-daemon', function () {
    


 
    $result = Process::run('sudo -S supervisorctl restart daemon-ID:804179');

    dd($result,  $result->output());
 
    return $result->output();


    //return 'daemon restarted';
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
