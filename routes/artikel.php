<?php
use App\Http\Controllers\ArtikelControllers;

Route::resource('articles', ArtikelControllers::class);
Route::get('admin/articles', [ArtikelControllers::class, 'adminIndex'])->name('admin.articles.index');