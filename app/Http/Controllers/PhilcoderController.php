<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Course;

class PhilcoderController extends Controller
{
    function getCourses(Request $request) {
        $res = Course::join('users', 'users.id', '=', 'courses.instructorId')
        ->join('categories', 'categories.id', '=', 'courses.categoryId')
        ->select('users.name AS instructor_name',"courses.*","categories.category_name")
        ->where("users.user_type", "instructor")
        ->get();
        return response()->json($res,200, [], JSON_PRETTY_PRINT);
    
    }
    function getCourse($id) {
        $course = Course::where("id", $id) -> first();
        return response()->json($course, 200, [], JSON_PRETTY_PRINT);
    }
    function setCourse(request $request) {
        $fields = $request->validate([
            "Name" => "required",
            "Instructor" => "required",
            "Category" => "required",
            "Description" => "required",
            "DurationHours" => "required",
            "DurationMinutes" => "required",
            "Pic_Url" => "required",
            "Price"=> "required"

        ]);
       $course = Course::create([
            "Name" => $fields["Name"],
            "Instructor" => $fields ["Instructor"],
            "Category" => $fields ["Category"],
            "Description" => $fields ["Description"],
            "DurationHours" => $fields ["DurationHours"],
            "DurationMinutes" => $fields ["DurationMinutes"],
            "Pic_Url" => $fields ["Pic_Url"],
            "Price" => $fields ["Price"],
            
        ]);
        return response()->json($course, 201, [], JSON_PRETTY_PRINT);
        
    }
    function updateCourse(Request $request, $id) {
        $course = Course::where("id", $id)->first();
        if (!$course) {
            return response()->json([
                "message" => "Course does not exist",
            ], 404, [], JSON_PRETTY_PRINT);
        }

        $fields = $request->validate([
            "categoryId" => "required",
            "title" => "required",
            "description" => "required",
            "durationHours" => "required",
            "durationMinutes" => "required",
            "picUrl" => "required",
            "price" => "required"
        ]);
        
        $course->instructorId =  Auth::user()->id;
        $course->categoryId = $fields ["categoryId"];
        $course->title = $fields ["title"];
        $course->description = $fields ["description"];
        $course->durationHours = $fields ["durationHours"];
        $course->durationMinutes = $fields ["durationMinutes"];
        $course->picUrl = $fields ["picUrl"];
        $course->price = $fields ["price"];
        $course->save();
        return response()->json([
            "message" => "Course successfully updated",
            "course" => $course,
            "hasError" => false,
        ], 200, [], JSON_PRETTY_PRINT);
        return response()->json($course, 200, [], JSON_PRETTY_PRINT);
    }
    function deleteCourse(Request $request, $id) {
        $course = Course::where("id", $id)->first();
       
        if (!$course) {
            return response()->json([
                "message" => "Course does not exist",
            ], 404, [], JSON_PRETTY_PRINT);
        }
        $course->delete();

        return response()->json([
            "message" => "Course successfully deleted",
            "hasError" => false,
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
