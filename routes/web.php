<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Models\User;

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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about-us', [App\Http\Controllers\HomeController::class, 'about_us'])->name('about-us');
Route::get('/contact-us', [App\Http\Controllers\HomeController::class, 'contact_us'])->name('contact-us');
Route::get('/carrers', [App\Http\Controllers\HomeController::class, 'carrers'])->name('carrers');
Route::get('/blog', [App\Http\Controllers\HomeController::class, 'blog'])->name('blog');
Route::get('/portfolio', [App\Http\Controllers\HomeController::class, 'portfolio'])->name('portfolio');

Route::prefix('admin')->group(function () 
{
      Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
      Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users');
      Route::get('/user-list', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('user-list');
      Route::get('/user-create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('user-create');
      Route::post('/user-store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('user-store');
      Route::get('/user/downloaduserPDF/{id}',[App\Http\Controllers\Admin\UserController::class, 'downloaduserPDF'])->name('downloaduserPDF');
      Route::get('/user/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user-edit');
      Route::post('/user/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('user-update');
      Route::get('/user/delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user-destroy');

      Route::get('/blogs', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('blogs');
      Route::get('/blog-create', [App\Http\Controllers\Admin\PostController::class, 'create'])->name('blog-create');
      Route::post('/blog-store', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('blog-store');
      Route::get('/blog/downloadPDF/{id}',[App\Http\Controllers\Admin\PostController::class, 'blogdownloadPDF'])->name('blog-downloadPDF');
      Route::get('/blog/edit/{id}', [App\Http\Controllers\Admin\PostController::class, 'edit'])->name('blog-edit');
      Route::put('/blog/update/{id}', [App\Http\Controllers\Admin\PostController::class, 'update'])->name('blog-update');
      Route::get('/blog/delete/{id}', [App\Http\Controllers\Admin\PostController::class, 'destroy'])->name('blog-destroy');

      Route::get('/blog-tag', [App\Http\Controllers\Admin\PostTagController::class, 'index'])->name('blog-tag');
      Route::get('/blogtag-create', [App\Http\Controllers\Admin\PostTagController::class, 'create'])->name('blogtag-create');
      Route::post('/blogtag-store', [App\Http\Controllers\Admin\PostTagController::class, 'store'])->name('blogtag-store');
      Route::get('/blogtag/downloadPDF/{id}',[App\Http\Controllers\Admin\PostTagController::class, 'blogtagdownloadPDF'])->name('blogtag-downloadPDF');
      Route::get('/blogtag/edit/{id}', [App\Http\Controllers\Admin\PostTagController::class, 'edit'])->name('blogtag-edit');
      Route::post('/blogtag/update/{id}', [App\Http\Controllers\Admin\PostTagController::class, 'update'])->name('blogtag-update');
      Route::get('/blogtag/delete/{id}', [App\Http\Controllers\Admin\PostTagController::class, 'destroy'])->name('blogtag-destroy');

      Route::get('/blog-categories', [App\Http\Controllers\Admin\PostCategoryController::class, 'index'])->name('blog-categories');
      Route::get('/category-create', [App\Http\Controllers\Admin\PostCategoryController::class, 'create'])->name('category-create');
      Route::post('/category-store', [App\Http\Controllers\Admin\PostCategoryController::class, 'store'])->name('category-store');
      Route::get('/category/downloadPDF/{id}',[App\Http\Controllers\Admin\PostCategoryController::class, 'categorydownloadPDF'])->name('category-downloadPDF');
      Route::get('/category/edit/{id}', [App\Http\Controllers\Admin\PostCategoryController::class, 'edit'])->name('category-edit');
      Route::put('/category/update/{id}', [App\Http\Controllers\Admin\PostCategoryController::class, 'update'])->name('category-update');
      Route::get('/category/delete/{id}', [App\Http\Controllers\Admin\PostCategoryController::class, 'destroy'])->name('category-destroy');

      
      Route::get('/course', [App\Http\Controllers\Admin\CourseController::class, 'index'])->name('course');
      Route::get('/course-create', [App\Http\Controllers\Admin\CourseController::class, 'create'])->name('course-create');
      Route::post('/course-store', [App\Http\Controllers\Admin\CourseController::class, 'store'])->name('course-store');
      Route::get('/course/downloadPDF/{id}',[App\Http\Controllers\Admin\CourseController::class, 'coursedownloadPDF'])->name('coursedownloadPDF');
      Route::get('/course/edit/{id}', [App\Http\Controllers\Admin\CourseController::class, 'edit'])->name('course-edit');
      Route::post('/course/update/{id}', [App\Http\Controllers\Admin\CourseController::class, 'update'])->name('course-update');
      Route::get('/course/delete/{id}', [App\Http\Controllers\Admin\CourseController::class, 'destroy'])->name('course-destroy');

      Route::get('/lessons', [App\Http\Controllers\Admin\LessonController::class, 'index'])->name('lessons');
      Route::get('/lessons-create/{id}', [App\Http\Controllers\Admin\LessonController::class, 'create'])->name('lessons-create');
      Route::post('/lessons-store', [App\Http\Controllers\Admin\LessonController::class, 'store'])->name('lessons.store');
      Route::get('/lessons-store/{id}', [App\Http\Controllers\Admin\LessonController::class, 'store'])->name('lessons-store');
      Route::get('/lessons/edit/{id}', [App\Http\Controllers\Admin\LessonController::class, 'edit'])->name('lessons-edit');
      Route::post('/lessons/update/{id}', [App\Http\Controllers\Admin\LessonController::class, 'update'])->name('lessons-update');
      Route::get('/lessons/delete/{id}', [App\Http\Controllers\Admin\LessonController::class, 'destroy'])->name('lessons-destroy');

      Route::get('/vocabulary', [App\Http\Controllers\Admin\VocabularyController::class, 'index'])->name('vocabulary');
      Route::get('/vocabulary-create', [App\Http\Controllers\Admin\VocabularyController::class, 'create'])->name('vocabulary-create');
      Route::post('/vocabulary-store', [App\Http\Controllers\Admin\VocabularyController::class, 'store'])->name('vocabulary-store');
      Route::get('/downloadPDF/{id}',[App\Http\Controllers\Admin\VocabularyController::class, 'downloadPDF'])->name('downloadPDF');
      Route::get('/vocabulary/edit/{id}', [App\Http\Controllers\Admin\VocabularyController::class, 'edit'])->name('vocabulary-edit');
      Route::post('/vocabulary/update/{id}', [App\Http\Controllers\Admin\VocabularyController::class, 'update'])->name('vocabulary-update');
      Route::get('/vocabulary/delete/{id}', [App\Http\Controllers\Admin\VocabularyController::class, 'destroy'])->name('vocabulary-destroy');

      Route::get('/tutorial', [App\Http\Controllers\Admin\TutorialController::class, 'index'])->name('tutorial');
      Route::get('/tutorial-create', [App\Http\Controllers\Admin\TutorialController::class, 'create'])->name('tutorial-create');
      Route::post('/tutorial-store', [App\Http\Controllers\Admin\TutorialController::class, 'store'])->name('tutorial-store');
      Route::get('/tutorial/downloadPDF/{id}',[App\Http\Controllers\Admin\TutorialController::class, 'tutorialdownloadPDF'])->name('tutorial-downloadPDF');
      Route::get('/tutorial/edit/{id}', [App\Http\Controllers\Admin\TutorialController::class, 'edit'])->name('tutorial-edit');
      Route::post('/tutorial/update/{id}', [App\Http\Controllers\Admin\TutorialController::class, 'update'])->name('tutorial-update');
      Route::get('/tutorial/delete/{id}', [App\Http\Controllers\Admin\TutorialController::class, 'destroy'])->name('tutorial-destroy');
      
      Route::get('/testmonial', [App\Http\Controllers\Admin\TestmonialController::class, 'index'])->name('testmonial');
      Route::get('/testmonial-create', [App\Http\Controllers\Admin\TestmonialController::class, 'create'])->name('testmonial-create');
      Route::post('/testmonial-store', [App\Http\Controllers\Admin\TestmonialController::class, 'store'])->name('testmonial-store');
      Route::get('/testmonial/edit/{id}', [App\Http\Controllers\Admin\TestmonialController::class, 'edit'])->name('testmonial-edit');
      Route::post('/testmonial/update/{id}', [App\Http\Controllers\Admin\TestmonialController::class, 'update'])->name('testmonial-update');
      Route::get('/testmonial/delete/{id}', [App\Http\Controllers\Admin\TestmonialController::class, 'destroy'])->name('testmonial-destroy');

      Route::get('/plan', [App\Http\Controllers\Admin\PlanController::class, 'index'])->name('plan');
      Route::get('/plan-create', [App\Http\Controllers\Admin\PlanController::class, 'create'])->name('plan-create');
      Route::post('/plan-store', [App\Http\Controllers\Admin\PlanController::class, 'store'])->name('plan-store');
      Route::get('/plan/edit/{id}', [App\Http\Controllers\Admin\PlanController::class, 'edit'])->name('plan-edit');
      Route::post('/plan/update/{id}', [App\Http\Controllers\Admin\PlanController::class, 'update'])->name('plan-update');
      Route::get('/plan/delete/{id}', [App\Http\Controllers\Admin\PlanController::class, 'destroy'])->name('plan-destroy');

      Route::get('/teaching-plan', [App\Http\Controllers\Admin\TeachingPlanController::class, 'index'])->name('teaching-plan');
      Route::get('/teaching-plan-create', [App\Http\Controllers\Admin\TeachingPlanController::class, 'create'])->name('teaching-plan-create');
      Route::post('/teaching-plan-store', [App\Http\Controllers\Admin\TeachingPlanController::class, 'store'])->name('teaching-plan-store');
      Route::get('/teaching-plan/edit/{id}', [App\Http\Controllers\Admin\TeachingPlanController::class, 'edit'])->name('teaching-plan-edit');
      Route::post('/teaching-plan/update/{id}', [App\Http\Controllers\Admin\TeachingPlanController::class, 'update'])->name('teaching-plan-update');
      Route::get('/teaching-plan/delete/{id}', [App\Http\Controllers\Admin\TeachingPlanController::class, 'destroy'])->name('teaching-plan-destroy');

      Route::get('/subject', [App\Http\Controllers\Admin\SubjectController::class, 'index'])->name('subject');
      Route::get('/subject-create', [App\Http\Controllers\Admin\SubjectController::class, 'create'])->name('subject-create');
      Route::post('/subject-store', [App\Http\Controllers\Admin\SubjectController::class, 'store'])->name('subject-store');
      Route::get('/subject/edit/{id}', [App\Http\Controllers\Admin\SubjectController::class, 'edit'])->name('subject-edit');
      Route::post('/subject/update/{id}', [App\Http\Controllers\Admin\SubjectController::class, 'update'])->name('subject-update');
      Route::get('/subject/delete/{id}', [App\Http\Controllers\Admin\SubjectController::class, 'destroy'])->name('subject-destroy');

      Route::get('/team', [App\Http\Controllers\Admin\TeamController::class, 'index'])->name('team');
      Route::get('/team-create', [App\Http\Controllers\Admin\TeamController::class, 'create'])->name('team-create');
      Route::post('/team-store', [App\Http\Controllers\Admin\TeamController::class, 'store'])->name('team-store');
      Route::get('/team/edit/{id}', [App\Http\Controllers\Admin\TeamController::class, 'edit'])->name('team-edit');
      Route::post('/team/update/{id}', [App\Http\Controllers\Admin\TeamController::class, 'update'])->name('team-update');
      Route::get('/team/delete/{id}', [App\Http\Controllers\Admin\TeamController::class, 'destroy'])->name('team-destroy');
      
      Route::get('/resumes', [App\Http\Controllers\Admin\ResumeController::class, 'index'])->name('resumes');
      Route::get('/portfolios', [App\Http\Controllers\Admin\PortfolioController::class, 'index'])->name('portfolios');

      Route::get('/proposals', [App\Http\Controllers\Admin\ProposalController::class, 'index'])->name('proposals');
      Route::get('/proposals/create', [App\Http\Controllers\Admin\ProposalController::class, 'create'])->name('proposals-create');
      

});






