<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FamilyMembersController;  
use App\Http\Controllers\CashAidController;
use App\Http\Controllers\MaterialAidController;
use App\Http\Controllers\VisitController;  
use App\Http\Controllers\CheckListController;  
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Models\HomeStatus;
use app\Models\SyrianGovernorate;
use App\Models\Donor;
use App\Http\Controllers\AidController;
use App\Http\Controllers\GroupMaterialAidController;  
use App\Http\Controllers\GroupCashAidController;
use App\Http\Controllers\GroupMaterialAidNameController;  


//
Route::middleware(['auth'])->group(function () {
    // Home route
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Route for loading the search form  
    //Route::get('/families/search', [FamilyController::class, 'showFamilySearchForm'])->name('families.search_form');  

    // Route for submitting the search  
    Route::get('/families/full_details', [FamilyController::class, 'full_details'])->name('families.full_details');  

    // Route::get('/families/full_details', [FamilyController::class, 'full_details'])  
    //     ->name('families.full_details');

    // Route::get('/families/search', [FamilyController::class, 'showFamilySearchForm'])->name('families.search_form');

    //Donors
    Route::get('/Donors/create', [DonorController::class, 'create'])->name('Donors.create');
    Route::post('/Donors/add', [DonorController::class, 'add'])->name('Donors.add');
    Route::get('/Donors/index', [DonorController::class, 'index'])->name('Donors.index');
    Route::delete('/Donors/index/{id}', [DonorController::class, 'Delete'])->name('Donor.Delete');
    Route::get('/Donors/edit/{id}', [DonorController::class, 'edit'])->name('Donor.edit');
    Route::post('/Donors/edit/{id}', [DonorController::class, 'update'])->name('Donor.update');


    // Families
    Route::get('families/create', [FamilyController::class, 'create'])->name('families.create');
    Route::post('families/add', [FamilyController::class, 'add'])->name('families.add');
    Route::get('families/index', [FamilyController::class,'index'])->name('families.index');
    // Editing Families
    Route::get('families/edit/{ID}', [FamilyController::class, 'edit'])->name('families.edit');
    Route::post('families/edit/{ID}', [FamilyController::class, 'update'])->name('families.update');
    Route::delete('/delete-family/{Family_ID}', [FamilyController::class, 'Delete'])->name('families.Delete');


    // Family Members
    Route::get('/family_members/create/{family_id}', [FamilyMembersController::class, 'create'])->name('family_members.create');  
    Route::post('/family_members/add', [FamilyMembersController::class, 'add'])->name('family_members.add');
    Route::get('/family_members/index', [FamilyMembersController::class, 'index'])->name('family_members.index');
    Route::get('/family_members/details/{family_id}', [FamilyMembersController::class, 'details'])->name('family_members.details');
    // Editing a family member
    Route::get('/family_members/edit/{ID}', [FamilyMembersController::class, 'edit'])->name('family_members.edit');
    Route::post('/family_members/edit/{ID}', [FamilyMembersController::class, 'update'])->name('family_members.update');
    Route::delete('/family_members/{ID}', [FamilyMembersController::class, 'Delete'])->name('family_members.Delete');


    // Cash Aid
    Route::get('/CashAid/create/{family_id}', [CashAidController::class, 'create'])->name('CashAid.create');  
    Route::post('/CashAid/add', [CashAidController::class, 'add'])->name('CashAid.add');
    Route::get('/CashAid/index', [CashAidController::class,'index'])->name('CashAid.index');
    Route::get('/CashAid/details/{family_id}', [CashAidController::class, 'details'])->name('CashAid.details');

    // Editing Cash Aid
    Route::get('/CashAid/edit/{ID}', [CashAidController::class, 'edit'])->name('CashAid.edit');
    Route::post('/CashAid/edit/{ID}', [CashAidController::class, 'update'])->name('CashAid.update');  
    Route::delete('/CashAid/{ID}', [CashAidController::class, 'delete'])->name('CashAid.delete');

    // Mateial Aid
    Route::get('/MaterialAid/create/{family_id}', [MaterialAidController::class, 'create'])->name('MaterialAid.create');
    Route::post('/MaterialAid/add', [MaterialAidController::class, 'add'])->name('MaterialAid.add');
    Route::get('/MaterialAid/index', [MaterialAidController::class, 'index'])->name('MaterialAid.index');
    Route::get('/MaterialAid/details/{family_id}', [MaterialAidController::class, 'details'])->name('MaterialAid.details');

    // Editing Material Aid
    Route::get('/MaterialAid/edit/{ID}', [MaterialAidController::class, 'edit'])->name('MaterialAid.edit');
    Route::post('/MaterialAid/update/{ID}', [MaterialAidController::class, 'update'])->name('MaterialAid.update');
    Route::delete('/MaterialAid/delete/{ID}', [MaterialAidController::class, 'delete'])->name('MaterialAid.delete');


    // Define a GET route that listens for requests to '/get-applicant-name'.
    // When this route is accessed, it will trigger the 'getApplicantName' method
    // of the 'FamilyController' class.
    //Route::get('/get-applicant-name/{Family_ID}', [FamilyController::class, 'getApplicantName'])->name('getApplicantName');


    // Check Duplicate Family_ID
    Route::post('/check-family-id', [FamilyController::class, 'checkFamilyID'])->name('check.Family_ID');



    Route::prefix('visits')->group(function () {  
        Route::get('create', [VisitController::class, 'create'])->name('visits.create');  
        Route::post('add', [VisitController::class, 'add'])->name('visits.add');  
        
    });



    Route::get('/visits/{familyId}', [VisitController::class, 'getFamilyVists'])->name('visits.getFamilyVists');
    Route::get('/visits', [VisitController::class, 'index'])->name('visits.index');
    Route::get('/visits/details/{visitID}', [VisitController::class, 'details'])->name('visits.details');
    Route::get('/full_visits', [VisitController::class, 'full_visits'])->name('visits.full_visits');

    Route::get('/get-applicant-name/{Family_ID}', [VisitController::class, 'getApplicantName']);


    // CheckList routes
    Route::get('/checklists/create', [CheckListController::class, 'create'])->name('checklists.create');
    Route::post('/checklists', [CheckListController::class, 'add'])->name('checklists.add');

    Route::get('/checklists/edit/{id}', [CheckListController::class, 'edit'])->name('checklists.edit');  
    Route::post('/checklists/edit/{id}', [CheckListController::class, 'update'])->name('checklists.update');

    Route::delete('/checklists/Delete/{id}', [CheckListController::class, 'delete'])->name('checklists.delete');
    Route::get('/checklists', [CheckListController::class, 'index'])->name('checklists.index');


    Route::get('users/create', [UserController::class,'create'])->name('users.create');
    Route::post('users/add', [UserController::class,'add'])->name('users.add');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/edit/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('users/index', [UserController::class, 'index'])->name('users.index');


    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


    // Route::get('/aid/applicant/{family_id}', [AidController::class, 'getApplicantByFamilyId'])->name('aid.applicant');
    // Route::get('/aid/create/{family_id}', [AidController::class, 'create'])->name('aid.create');
    // Route::post('/aid/add', [AidController::class, 'add'])->name('aid.add');
    // Route::get('/aid', [AidController::class, 'index'])->name('aid.index');


    Route::get('/aid/index', [AidController::class, 'index'])->name('aid.index');

    Route::get('/aid/create/{family_id}', [CashAidController::class, 'create'])->name('aid.create');
    Route::post('/aid/add', [CashAidController::class, 'add'])->name('aid.add');
    Route::post('/aid/add_material', [MaterialAidController::class, 'add'])->name('aid.add_material');





    Route::get('GroupMaterialAid/create', [GroupMaterialAidController::class, 'create'])->name('GroupMaterialAid.create');  
    Route::post('GroupMaterialAid/add', [GroupMaterialAidController::class, 'add'])->name('GroupMaterialAid.add');
    Route::get('GroupMaterialAid/index', [GroupMaterialAidController::class, 'index'])->name('GroupMaterialAid.index');
    Route::get('GroupMaterialAid/index2', [GroupMaterialAidController::class, 'index2'])->name('GroupMaterialAid.index2');

    
    Route::get('GroupCashAid/create', [GroupCashAidController::class, 'create'])->name('GroupCashAid.create');  
    Route::post('GroupCashAid/add', [GroupCashAidController::class, 'add'])->name('GroupCashAid.add');
    Route::get('GroupCashAid/index', [GroupCashAidController::class, 'index'])->name('GroupCashAid.index');
    Route::get('GroupCashAid/index2', [GroupCashAidController::class, 'index2'])->name('GroupCashAid.index2');

//Route::post('GroupMaterialAid/store', [GroupMaterialAidController::class, 'store'])->name('GroupMaterialAid.store');

// Route::get('/MaterialAidGroupName/create', [GroupMaterialAidNameController::class, 'create'])->name('MaterialAidGroupName.create');  
// Route::post('/MaterialAidGroupName/add', [GroupMaterialAidNameController::class, 'add'])->name('MaterialAidGroupName.add');


// Route::put('/GroupMaterialAid/{id}', [MaterialAidController::class, 'updateStatus']);

// لتحديث الحالة في جدول mateial Aid
Route::post('/update-material-aid-status', [GroupMaterialAidController::class, 'updateAidStatus']);

// لتحديث الحالة في جدول Cash Aid
Route::post('/update-aid-status', [GroupCashAidController::class, 'updateAidStatus']);

});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route::middleware(['auth'])->group(function () {
//     Route::resource('users', UserController::class);
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// });

