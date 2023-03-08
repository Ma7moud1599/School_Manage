<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function index()
    {
        $subjects = Subject::get();
        return view('page.Subjects.index', compact('subjects'));
    }

    public function create()
    {
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('page.Subjects.create', compact('grades', 'teachers'));
    }


    public function store($request)
    {
        try {
            $subjects = new Subject();
            $subjects->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $subjects->grade_id = $request->grade_id;
            $subjects->classroom_id = $request->class_id;
            $subjects->teacher_id = $request->teacher_id;
            $subjects->save();
            flash()->addSuccess(trans('message.success'));
            return redirect()->route('subjects.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $subject = Subject::findorfail($id);
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('page.Subjects.edit', compact('subject', 'grades', 'teachers'));
    }

    public function update($request)
    {
        try {
            $subjects =  Subject::findorfail($request->id);
            $subjects->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $subjects->grade_id = $request->grade_id;
            $subjects->classroom_id = $request->class_id;
            $subjects->teacher_id = $request->teacher_id;
            $subjects->save();
            flash()->addSuccess(trans('message.Update'));
            return redirect()->route('subjects.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Subject::destroy($request->id);
            flash()->addError(trans('message.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
