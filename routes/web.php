<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
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
use Google\Service\Drive\DriveFile;
use Google\Service\Drive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

Route::get('/show-gdrive', function() {

});

Route::get('/upload-gdrive', function(Request $request) {
    try {
        //code...
        $driveService = app(Drive::class);
    
        $fileMetadata = new DriveFile([
            'name' => 'Foto Aing',
            'parents' => ['1SQUQ21NJe-8IcehtEiG_1es30wq8xMG1']
            // 'mimeType' => 'application/vnd.google-apps.spreadsheet',
        ]);
    
        $content = File::get(public_path('/img/foto2.jpg'));
    
        $file = $driveService->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => 'image/jpeg',
            'uploadType' => 'multipart',
            'fields' => 'id',
        ]);
    
        return response()->json(['file_id' => $file->id]);
    } catch (\Exception $th) {
        throw $th;
    }
});

Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [HomeController::class, 'page'] );
Route::get('/home', [HomeController::class, 'page'] );
Route::get('/about', [AboutController::class, 'page']);
Route::get('/contact', [ContactController::class, 'page']);
Route::get('/portfolio', [PortfolioController::class, 'page']);
Route::post('/contact/send-message', [ContactController::class, 'sendMessage'])->name('send-message');

Route::get('/portfolio-detail/{id}', [PortfolioController::class, 'pageDetail']);

Route::get('/new-layout', function() {
    return Inertia::render('NewLayout');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'cms', 'as' => 'cms.' ],function() {
        Route::get('/', fn() => redirect('dashboard'));
        Route::get('home', [HomeController::class, 'index'])->name('home.index');
        Route::post('home', [HomeController::class, 'update'])->name('home.update');
        Route::resource('contact', ContactController::class);
        Route::resource('portfolios', PortfolioController::class);

        Route::group(['prefix' => 'about', 'as' => 'about.'], function() {
            Route::resource('about-me', AboutController::class);
            Route::resource('educations', EducationController::class);
            Route::resource('skills', SkillController::class);
            Route::resource('courses', CourseController::class);
            Route::resource('experiences', ExperienceController::class);
        });

    });

});

Route::get("datatable-about", [AboutController::class, "datatableAbout" ]);

require __DIR__ . '/auth.php';
