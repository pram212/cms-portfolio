<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\About;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Education;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Skill;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Home', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });



Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [HomeController::class, 'page'] );
Route::get('/home', [HomeController::class, 'page'] );
Route::get('/about', [AboutController::class, 'page']);

Route::get('/contact', function () {
    $contact = Contact::first();
    return Inertia::render('Contact', compact('contact'));
});

Route::get('/portfolio', function () {
    $portfolios = Portfolio::select('id', 'project_title', 'images')->get();
    return Inertia::render('Portfolio', compact('portfolios'));
});

Route::get('/portfolio-detail/{id}', function ($id) {
    $portfolio = Portfolio::find($id);
    return Inertia::render('PortfolioDetail', compact('portfolio'));
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'cms', 'as' => 'cms.' ],function() {
        Route::get('/', fn() => redirect('dashboard'));
        Route::get('home', [HomeController::class, 'index'])->name('home.index');
        Route::post('home', [HomeController::class, 'update'])->name('home.update');

        Route::group(['prefix' => 'about', 'as' => 'about.'], function() {
            Route::resource('about-me', AboutController::class);
            Route::resource('educations', EducationController::class);
        });

    });

});

Route::get("datatable-about", [AboutController::class, "datatableAbout" ]);

require __DIR__ . '/auth.php';
