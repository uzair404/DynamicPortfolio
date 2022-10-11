<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactDetailsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\WorkController;

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

Route::get('/', [EditController::class, 'index']);
// contact
Route::post('/contact', [ContactController::class, 'contact']);

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/edit', [EditController::class, 'edit'])->name('edit');
    
    // save
    // Route::post('/navedit', [EditController::class, 'save_nav']);
    Route::post('/heroedit', [EditController::class, 'save_hero']);
    Route::post('/aboutedit', [AboutController::class, 'save_about']);
    
    
    // manage sections 
    Route::post('/add_section', [SectionController::class, 'add_section']);
    Route::post('/manage_sections', [SectionController::class, 'manage_section']);
    
    // skill section
    Route::post('/add_skill', [AboutController::class, 'add_skill']);
    Route::post('/delete_skill', [AboutController::class, 'delete_skill']);
    
    // navbar section
    Route::post('/add_nav', [NavController::class, 'add_nav']);
    Route::post('/delete_nav', [NavController::class, 'delete_nav']);
    Route::post('/navbar_heading', [NavController::class, 'navbar_heading']);
    
    // contact section
    Route::post('/save-contact', [ContactDetailsController::class, 'save_contact_details']);
    
    // services section
    Route::post('/save-services', [ServicesController::class, 'save_services']);
    Route::post('/edit-service', [ServicesController::class, 'edit_service']);
    Route::get('/delete-service/{id}', [ServicesController::class, 'delete_service']);

    // work section
    Route::post('/save-work', [WorkController::class, 'save_work']);
    Route::post('/edit-work', [WorkController::class, 'edit_work']);
    Route::get('/delete-work/{id}', [WorkController::class, 'delete_work']);

    // update social links
    Route::post('/update-social', [ContactDetailsController::class, 'update_social']);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';



