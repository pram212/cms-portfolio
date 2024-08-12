<?php

use App\Http\Controllers\ContactController;
use App\Http\Resources\BiodataResource;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ContactResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\EducationResource;
use App\Http\Resources\ExperienceResource;
use App\Http\Resources\LinkResource;
use App\Http\Resources\PortfolioResource;
use App\Http\Resources\SkillResource;
use App\Models\Biodata;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Link;
use App\Models\Portfolio;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('educations', function() {
    $data = Education::orderBy('start', 'desc')->get();
    return EducationResource::collection($data);
});

Route::get('courses', function() {
    $data = Course::orderBy('start', 'desc')->get();
    return CourseResource::collection($data);
});

Route::get('experiences', function() {
    $data = Experience::orderBy('start', 'desc')->get();
    return ExperienceResource::collection($data);
});

Route::get('skills', function() {
    $data = Skill::all();
    return SkillResource::collection($data);
});

Route::get('portfolios', function() {
    $data = Portfolio::all();
    return PortfolioResource::collection($data);
});

Route::get('links', function() {
    $data = Link::all();
    return LinkResource::collection($data);
});

Route::get('clients', function() {
    $data = Client::all();
    return ClientResource::collection($data);
});

Route::get('contacts', function() {
    $data = Contact::first();
    return new ContactResource($data);
});

Route::get('biodata', function() {
    $data = Biodata::first();
    return new BiodataResource($data);
});

Route::post('send-message', [ContactController::class, 'sendMessage'])->name('api.send-message');
