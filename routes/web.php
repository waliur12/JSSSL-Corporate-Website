<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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

// Route::group(['middleware'=>"web"],function(){

// });

    Route::get('/welcome', function () {
        return view('welcome');
    });
    // Route::get('/comming-soon', function () {
    //     return view('comming_soon');
    // });



    Auth::routes();

    // Route::get('/home', 'HomeController@index')->name('home');
    // Route::get('admin/login', 'Auth\AuthController@showLoginForm');
    Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
        Route::get('/', function () {
            return redirect('admin/dashboard');
        });
        Route::get('/dashboard', 'ViewController@index')->name('main.page');
        Route::get('settings', 'ViewController@resetView')->name('reset.view');
        Route::get('profile', 'ViewController@profileView')->name('profile.view');
        // View All Pages==============================================================
        Route::get('social-media', 'ViewController@socialMedia')->name('media.view');
        Route::get('client-categories', 'ViewController@clientCat')->name('clientcat.view');
        Route::get('clients', 'ViewController@client')->name('client.view');
        Route::get('board-members', 'ViewController@boardMember')->name('boardmember.view');
        Route::get('founder-speech', 'ViewController@founderSpeech')->name('founderspeech.view');
        Route::get('terms-policies', 'ViewController@termsPolicies')->name('termsPolicies.view');
        Route::get('ethical-codes', 'ViewController@ethicalCode')->name('ethicalCode.view');
        Route::get('news', 'ViewController@news')->name('news.view');
        Route::get('events', 'ViewController@events')->name('events.view');
        Route::get('messages', 'ViewController@message')->name('message.view');
        Route::get('offices', 'ViewController@offices')->name('office.view');
        Route::get('main-office', 'ViewController@mainOffice')->name('mainoffice.view');
        Route::get('all-services', 'ViewController@services')->name('service.view');
        Route::get('sub-services-list', 'ViewController@subServices')->name('subservice.view');
        Route::get('user-management', 'ViewController@userManagement')->name('usermanage.view');
        Route::get('applications', 'CareerPageController@jobApplication')->name('job.application')->middleware('cors');
        Route::get('job/{id}/applicants/', 'CareerPageController@jobApplicants')->name('job.applicant');
        Route::get('jobs', 'CareerPageController@jobs')->name('jobs');
        Route::get('applicants-data', 'CareerPageController@applicantsDataTableByPackageNo')->name('applicants.datatable');

        // Route::get('applicant', 'CareerPageController@applicantByPackege')->name('jobs');

        Route::get('/hero-section', 'HomePageController@heroSection')->name('hero.section');
        Route::post('/hero-section/add', 'HomePageController@heroSectionStore')->name('hero.section.add');
        Route::post('hero-section/view', 'HomePageController@heroSectionShow')->name('hero.section.view');
        Route::post('hero-section/edit', 'HomePageController@heroSectionEdit')->name('hero.section.edit');
        Route::post('hero-section/update', 'HomePageController@heroSectionUpdate')->name('hero.section.update');
        Route::post('hero-section/delete', 'HomePageController@heroSectionDelete')->name('hero.section.delete');
    });

    Route::post('old-password', 'ViewController@oldPass')->name('reset.check');
    Route::post('profile/updated', 'ViewController@profileUpdate')->name('profile.update');
    Route::post('change-password', 'ViewController@newPass')->name('newPass.change');
    Route::get('profile-update/{id}/edit', 'ViewController@profileEdit');

    // Route::get('jobs', 'ViewController@jobs')->name('jobs.view');

    // Precedence ajax
    Route::get('max-precedence/{id}', 'ServiceController@serviceMax');
    Route::get('max-precedence-update/{id}', 'ServiceController@serviceMaxUpdate');
    Route::get('get-precedence/{id}', 'ServiceController@quickPass');
    Route::get('get-precedence-update/{id}', 'ServiceController@quickPassUpdate');

    // Social Media
    Route::post('social-media-add', 'SocialMediaController@store')->name('media.store');
    Route::get('mediadelete','SocialMediaController@destroy')->name('media.destroy');
    Route::get('social-media/{id}/edit', 'SocialMediaController@edit');
    Route::post('social-media/updated', 'SocialMediaController@updated')->name('media.updated');
    Route::get('social-media/{id}', 'SocialMediaController@viewMedia')->name('media.modal');



    // Client Categories
    Route::post('clientcat-add', 'ClientCategoriesController@store')->name('clientcat.store');
    Route::get('clientcatdelete','ClientCategoriesController@destroy')->name('clientcat.destroy');
    Route::get('clientcat/{id}/edit', 'ClientCategoriesController@edit');
    Route::post('clientcat/updated', 'ClientCategoriesController@updated')->name('clientcat.updated');
    Route::get('clientcat/{id}', 'ClientCategoriesController@viewClientCat')->name('clientcat.modal');

    // Client
    Route::post('client-add', 'ClientController@store')->name('client.store');
    Route::get('clientdelete','ClientController@destroy')->name('client.destroy');
    Route::get('client/{id}/edit', 'ClientController@edit');
    Route::post('client/updated', 'ClientController@updated')->name('client.updated');
    Route::get('client/{id}', 'ClientController@viewClient')->name('client.modal');

    // Board Member
    Route::post('member-add', 'BoardMemberController@store')->name('member.store');
    Route::get('memberdelete','BoardMemberController@destroy')->name('member.destroy');
    Route::get('member/{id}/edit', 'BoardMemberController@edit');
    Route::post('member/updated', 'BoardMemberController@updated')->name('member.updated');
    Route::get('member/{id}', 'BoardMemberController@viewBoardMember')->name('member.modal');

    // Founder Speech
    Route::post('founder-store', 'FounderSpeechController@store')->name('founder.store');
    Route::get('founderdelete','FounderSpeechController@destroy')->name('founder.destroy');
    Route::get('founder/{id}/edit', 'FounderSpeechController@edit');
    Route::post('founder/updated', 'FounderSpeechController@updated')->name('founder.updated');
    Route::get('founder/{id}', 'FounderSpeechController@viewFounderSpeech')->name('founder.modal');

    // Terms & Policy
    Route::post('terms-store', 'TermsPoliciesController@store')->name('terms.store');
    Route::get('termsdelete','TermsPoliciesController@destroy')->name('terms.destroy');
    Route::get('terms/{id}/edit', 'TermsPoliciesController@edit');
    Route::post('terms/updated', 'TermsPoliciesController@updated')->name('terms.updated');
    Route::get('terms/{id}', 'TermsPoliciesController@viewTerms')->name('terms.modal');

    // Ethical Codes
    Route::post('ethical-store', 'EthicalCodesController@store')->name('ethical.store');
    Route::get('ethicaldelete','EthicalCodesController@destroy')->name('ethical.destroy');
    Route::get('ethical/{id}/edit', 'EthicalCodesController@edit');
    Route::post('ethical/updated', 'EthicalCodesController@updated')->name('ethical.updated');
    Route::get('ethical/{id}', 'EthicalCodesController@viewEthical')->name('ethical.modal');

    // News
    Route::post('news-store', 'NewsController@store')->name('news.store');
    Route::get('newsdelete','NewsController@destroy')->name('news.destroy');
    Route::get('news/{id}/edit', 'NewsController@edit');
    Route::post('news/updated', 'NewsController@updated')->name('news.updated');
    Route::get('news/{id}', 'NewsController@viewNews')->name('news.modal');

    // User Management
    Route::post('users-store', 'UserController@store')->name('users.store');
    Route::get('userdelete','UserController@destroy')->name('users.destroy');
    Route::get('users/{id}/edit', 'UserController@edit');
    Route::post('users/updated', 'UserController@updated')->name('users.updated');
    Route::get('users/{id}', 'UserController@veiwUser')->name('users.modal');

    // Event
    Route::post('events-store', 'EventController@store')->name('events.store');
    Route::get('eventsdelete','EventController@destroy')->name('events.destroy');
    Route::get('events/{id}/edit', 'EventController@edit');
    Route::post('events/updated', 'EventController@updated')->name('events.updated');
    Route::get('events/{id}', 'EventController@viewEvent')->name('events.modal');

    // Message
    Route::get('messagesdelete','MessageController@destroy')->name('messages.destroy');
    Route::get('messages/{id}', 'MessageController@viewMessage')->name('messages.modal');

    // Office
    Route::post('offices-store', 'OfficeController@store')->name('offices.store');
    Route::get('officesdelete','OfficeController@destroy')->name('offices.destroy');
    Route::get('offices/{id}/edit', 'OfficeController@edit');
    Route::post('offices/updated', 'OfficeController@updated')->name('offices.updated');
    Route::get('offices/{id}', 'OfficeController@viewOffice')->name('offices.modal');

    //Main Office
    Route::get('main-office/{id}/edit', 'MainOfficeController@edit');
    Route::post('main-office/updated', 'MainOfficeController@updated')->name('mainoffice.updated');
    Route::get('main-office/{id}', 'MainOfficeController@viewOffice')->name('mainoffice.modal');

    // Service
    Route::post('services-store', 'ServiceController@store')->name('services.store');
    Route::get('servicesdelete','ServiceController@destroy')->name('services.destroy');
    Route::get('services/{id}/edit', 'ServiceController@edit');
    Route::post('services/updated', 'ServiceController@updated')->name('services.updated');
    Route::get('services/{id}', 'ServiceController@viewService')->name('services.modal');

    // Sub Service
    Route::post('sub-services-store', 'SubServiceController@store')->name('subservices.store');
    Route::get('subservicesdelete','SubServiceController@destroy')->name('subservices.destroy');
    Route::get('sub-services/{id}/edit', 'SubServiceController@edit');
    Route::post('sub-services/updated', 'SubServiceController@updated')->name('subservices.updated');
    Route::get('sub-services/{id}', 'SubServiceController@viewSubService')->name('subservices.modal');

// ===============================================================================================================

    // career page starts here
    // career section start
    Route::get('/admin/career', 'CareerPageController::class@career')->name('career');
    Route::post('/career/add', 'CareerPageController::class@careerAdd')->name('career.add');
    Route::post('career/view', 'CareerPageController::class@careerView')->name('career.view');
    Route::post('career/edit', 'CareerPageController::class@careerEdit')->name('career.edit');
    Route::post('career/update', 'CareerPageController::class@careerEdit')->name('career.update');

    Route::post('career/delete', 'CareerPageController@careerDelete')->name('career.delete');
    // career section end

    // job section start

    Route::post('/job/add', 'CareerPageController@jobAdd')->name('job.add');
    Route::post('job/view', 'CareerPageController@jobView')->name('job.view');
    Route::post('job/edit', 'CareerPageController@jobEdit')->name('job.edit');
    Route::post('job/update', 'CareerPageController@jobUpdate')->name('job.update');
    Route::post('job/delete', 'CareerPageController@jobDelete')->name('job.delete');
    Route::post('job/precedence', 'CareerPageController@getMaxJobPrecedence')->name('job.precedence');
    Route::post('job/selected/status', 'CareerPageController@updateSelectedStatus')->name('job.applicant.selected.status');
    // job section end
    Route::post('upload/admit-card', 'CareerPageController@uploadAdmitCard')->name('upload.admit.card');
    Route::post('view/admit-card', 'CareerPageController@viewAdmitCard')->name('view.admit.card');
    
    // job section start

    Route::get('/pdf/view/{id}', 'CareerPageController@viewPdf')->name('pdf.view');
    Route::post('applicant/delete', 'CareerPageController@jobApplicantDelete')->name('job.applicant.delete');
    Route::post('save/candidate', 'CareerPageController@saveSelectedCandidate')->name('save.selected.candidate');
    Route::post('select/candidate', 'CareerPageController@selectCandidate')->name('select.candidate');
    Route::post('all/applicants', 'CareerPageController@getApplicantsBypackageNo')->name('package_no.applicants');
    Route::get('test', 'CareerPageController@test')->name('test');
    // job section end

// career page ends here
// // Jobs===================================================================================================
    // Route::post('job-add', 'JobController@store')->name('job.store');
    // Route::get('jobdelete','JobController@destroy')->name('job.destroy');
    // Route::get('job/{id}/edit', 'JobController@edit');
    // Route::post('job/updated', 'JobController@updated')->name('job.updated');
    // Route::get('job/{id}', 'JobController@viewJob')->name('job.modal');

// =========================================
//                                          Front End
// =========================================


Route::get('/', 'FrontController@index')->name('home.page');
// career comment 10-09
// Route::get('/career', 'CareerController@career')->name('career.page');
// Route::get('job/{id}/apply', 'CareerController@careerDetails')->name('careerdetails.page');
// Route::post('portfolio-rest-items/store','CareerController@store')->name('jobapplied.store');
// Route::get('applicant-detailsinfo/{id}', 'CareerController@viewApplicant')->name('clientcat.modal');
// Route::get('/contact/us', 'FrontController@contactUs')->name('contact.us');

Route::get('/about-us', 'FrontController@aboutUs')->name('about.us');
Route::get('/terms-policy', 'FrontController@termsPolicy')->name('terms.policy');
Route::get('/ethical-code-conduct', 'FrontController@ethicalCode')->name('ethical.code');
Route::get('/services', 'FrontController@services')->name('service.index');
Route::get('/training-school', 'FrontController@trainingSchool')->name('training.school');
Route::get('/our-clients', 'FrontController@ourClients')->name('our.client');
Route::get('/news-events', 'FrontController@newsEvents')->name('news.event');
Route::get('/news/{news}/details', 'FrontController@newsDetails')->name('news.details');
Route::get('/event/{event}/details', 'FrontController@eventDetails')->name('event.details');
Route::get('/contact-us', 'FrontController@contactUs')->name('contact.us');
Route::post('message/store', 'FrontController@messageStore')->name('message.store');

Route::post('download/admin-card','CareerController@downloadAdmitCard')->name('admit.card.download');

Route::get('download/{id}','CareerController@download')->name('download');
Route::get('download_admit/{id}','CareerPageController@downloadAdmit')->name('download_admit');

// // results routes
// Route::get('/results', 'CareerController@results')->name('results.page');
//  Route::get('job/{id}/result', 'CareerController@jobResult')->name('jobresult.page');


Route::get('notices', 'FrontController@notice')->name('notice');
Route::get('notices/{data}', 'FrontController@noticeDetails')->name('notice.details');

Route::get('/clear-cache', function () {

    $configCache = Artisan::call('config:cache');
    $clearCache  = Artisan::call('cache:clear');
    // return what you want
    return "Finished";
});

