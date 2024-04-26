<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        "instructorId",
        "categoryId" ,
        "title",
        "description" ,
        "durationHours",
        "durationMinutes",
        "picUrl",
        "price",
        "status",
    ];
}
