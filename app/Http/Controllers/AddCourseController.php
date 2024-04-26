<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Course;

class AddCourseController extends Controller
{
    function AddCourse(request $request) {
        $fields = $request->validate([
            "categoryId" => "required",
            "title" => "required",
            "description" => "required",
            "durationHours" => "required",
            "durationMinutes" => "required",
            "picUrl" => "required",
            "price"=> "required",
            

        ]);
       $course = Course::create([
            "instructorId" => Auth::user()->id,//$fields["instructorId"],
            "categoryId" => $fields["categoryId"],
            "title" => $fields["title"],
            "description" => $fields ["description"],
            "durationHours" => $fields ["durationHours"],
            "durationMinutes" => $fields ["durationMinutes"],
            "picUrl" => $fields ["picUrl"],
            "price" => $fields ["price"],
            
        ]);
        return response()->json($course, 201, [], JSON_PRETTY_PRINT);
        
    }
}
