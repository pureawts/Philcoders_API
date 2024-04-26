<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    function getCategories() {
        $category = Categories::get();
        return response()->json($category, 200, [], JSON_PRETTY_PRINT);
    }
}
