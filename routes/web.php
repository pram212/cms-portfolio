<?php

use App\Http\Controllers\ProfileController;
use App\Models\About;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Education;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Skill;
use Illuminate\Foundation\Application;
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

Route::get('/', fn () => Inertia::render('Home'));
Route::get('/home', fn () => Inertia::render('Home'));

Route::get('/about', function () {
    $educations = Education::all();
    $courses = Course::all();
    $skills = Skill::all();
    $services = Service::all();
    $about = About::first();

    return Inertia::render('About', compact('educations', 'courses', 'skills', 'services', 'about'));
});

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
});

require __DIR__ . '/auth.php';
