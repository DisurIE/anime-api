<?php

use App\Framework\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/users', function () {
    return User::query()->paginate(100);
});
