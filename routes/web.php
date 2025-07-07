
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use Livewire\Volt\Volt;

Route::get('/', fn() => redirect()->route('pets.index'));
Route::view('/home', 'welcome')->name('home');


// Wszystkie trasy /pets dostępne tylko dla zalogowanych
Route::middleware(['auth'])->group(function () {
    Route::resource('pets', PetController::class);

    // Ustawienia dla zalogowanych
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::view('dashboard', 'dashboard')->middleware('verified')->name('dashboard');
});


require __DIR__.'/auth.php';
