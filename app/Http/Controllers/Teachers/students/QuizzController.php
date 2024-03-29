<?php

namespace App\Http\Controllers\Teachers\students;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Quizze;
use App\Models\Question;
use App\Models\Degree;

use App\Models\Subject;
use Illuminate\Http\Request;

class QuizzController extends Controller
{
    public function index()
    {
        $quizzes = Quizze::where('teacher_id', auth()->user()->id)->get();
        return view('page.Teachers.Quizzes.index', compact('quizzes'));
    }


    public function create()
    {
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id', auth()->user()->id)->get();
        return view('page.Teachers.Quizzes.create', $data);
    }


    public function store(Request $request)
    {
        try {
            $quizzes = new Quizze();
            $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->grade_id;
            $quizzes->classroom_id = $request->classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = auth()->user()->id;
            $quizzes->save();
            flash()->addSuccess(trans('message.success'));
            return redirect()->route('quizzes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $quizz = Quizze::findorFail($id);
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id', auth()->user()->id)->get();
        return view('page.Teachers.Quizzes.edit', $data, compact('quizz'));
    }

    public function show($id)
    {
        $questions = Question::where('quizze_id', $id)->get();
        $quizz = Quizze::findorFail($id);
        return view('page.Teachers.Questions.index', compact('questions', 'quizz'));
    }

    public function update(Request $request)
    {
        try {
            $quizz = Quizze::findorFail($request->id);
            $quizz->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizz->subject_id = $request->subject_id;
            $quizz->grade_id = $request->grade_id;
            $quizz->classroom_id = $request->classroom_id;
            $quizz->section_id = $request->section_id;
            $quizz->teacher_id = auth()->user()->id;
            $quizz->save();
            flash()->addSuccess(trans('message.Update'));
            return redirect()->route('quizzes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            Quizze::destroy($id);
            flash()->addError(trans('message.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function student_quizze($quizze_id)
    {
        $degrees = Degree::where('quizze_id', $quizze_id)->get();
        return view('page.Teachers.Quizzes.student_quizze', compact('degrees'));
    }

    public function repeat_quizze(Request $request)
    {
        Degree::where('student_id', $request->student_id)->where('quizze_id', $request->quizze_id)->delete();
        flash()->addSuccess(trans('message.test'));
        return redirect()->back();
    }
}
