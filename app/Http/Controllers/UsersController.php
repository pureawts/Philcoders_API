<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    function getInstructor() {
        $instructor = User::where("user_type", "instructor") -> get();
        return response()->json($instructor, 200, [], JSON_PRETTY_PRINT);
    }
}
