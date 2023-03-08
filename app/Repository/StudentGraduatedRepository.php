<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentGraduatedRepository implements StudentGraduatedRepositoryInterface
{
    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('page.Students.Graduated.index', compact('students'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('page.Students.Graduated.create', compact('grades'));
    }

    public function SoftDelete($request)
    {
        $students = student::where('grade_id', $request->grade_id)->where('classroom_id', $request->classroom_id)->where('section_id', $request->section_id)->get();

        if ($students->count() < 1) {
            return redirect()->back()->with('error_Graduated', __(trans('message.error_Graduated')));
        }

        foreach ($students as $student) {
            $ids = explode(',', $student->id);
            student::whereIn('id', $ids)->Delete();
        }

        flash()->addSuccess(trans('message.success'));
        return redirect()->route('Graduated.index');
    }

    public function ReturnData($request)
    {
        student::onlyTrashed()->where('id', $request->id)->first()->restore();
        flash()->addSuccess(trans('message.success'));
        return redirect()->back();
    }

    public function destroy($request)
    {
        student::onlyTrashed()->where('id', $request->id)->first()->forceDelete();
        flash()->addError(trans('message.Delete'));
        return redirect()->back();
    }
}
