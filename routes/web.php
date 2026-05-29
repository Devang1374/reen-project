<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\heroController;
use App\Http\Controllers\mailController;
use App\Jobs\storePdf;
use Illuminate\Http\Request;

use App\Models\pages;

// auth dashboard routes
Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/heroBanner', [heroController::class,'heroBanner'])->name('heroBanner');
    Route::get('/features',[heroController::class,'features'])->name('features');
    Route::get('/portfolio',[heroController::class,'portfolio'])->name('portfolio');
    Route::get('/pages',[heroController::class,'pages'])->name('pages');
    Route::get('/feedBack',[heroController::class,'feedBack'])->name('feedBack');
});
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

//home page route
Route::get('/', [homeController::class, 'index'])->name('home');
Route::get('/contact',[homeController::class, 'contact']);


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::post('/sendmail', [mailController::class, 'sendMail'])->name('sendmail');


//ignore
Route::get('/tamp',function(){
    storeHeroBanner::dispatch("adfas",'hryuy','kjgg','qwer','vnvnv');
});

Route::view('/storePdf','storePdf');
Route::POST('/storePdfFile',function(Request $request){
    if(!$request->hasFile('myFile')){
        return back()->with('message','please provide a file');
    }

    $tamppath = $request->file('myFile')->store('tamp-files','local');

    storePdf::dispatch($tamppath);
    return back()->with('message','Thank Your For Sending file');
})->name('storePdfFile');

Route::get('/getHeros/{page:slug}',function(pages $page){
    return $page;
})->missing(function (){
    return redirect()->route('notFound');
});

Route::view('/notFound','notFound')->name('notFound');