<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ManageGeneralSettings; // <--- MAKE SURE THIS IS HERE
use App\Livewire\ManageHomePage;        // <--- MAKE SURE THIS IS HERE
use App\Livewire\ManageAboutPage;
use App\Livewire\ManageServicesPage;
use App\Livewire\ManageProjectsPage;
use App\Livewire\ManageNewsPage;
use App\Livewire\ManageContactPage;
use App\Livewire\ManageDonatePage;


Route::get('/', function () {
    return view('welcome');
});

// Full page Livewire components
Route::get('/admin/settings', ManageGeneralSettings::class);
Route::get('/admin/home', ManageHomePage::class);
Route::get('/admin/about', ManageAboutPage::class);
Route::get('/admin/services', ManageServicesPage::class);
Route::get('/admin/booking', \App\Livewire\ManageBookingPage::class);
Route::get('/admin/projects', ManageProjectsPage::class);
Route::get('/admin/news', ManageNewsPage::class);
Route::get('/admin/gallery', \App\Livewire\ManageGalleryPage::class);
Route::get('/admin/contact', ManageContactPage::class);
Route::get('/admin/volunteer', \App\Livewire\ManageVolunteerPage::class);
Route::get('/admin/donate', ManageDonatePage::class);
