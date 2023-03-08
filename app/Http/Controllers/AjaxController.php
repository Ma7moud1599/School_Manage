<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    // Get classrooms
    public function getclassrooms($id)
    {
        return Classroom::where("grade_id", $id)->pluck("Name_class", "id");
    }

    //Get sections
    public function Get_sections($id)
    {
        return Section::where("class_id", $id)->pluck("Name_section", "id");
    }
}
