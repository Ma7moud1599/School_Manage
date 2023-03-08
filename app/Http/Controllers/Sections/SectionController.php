<?php

namespace App\Http\Controllers\sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Teacher;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $grades = Grade::with(['sections'])->get();

        $list_grades = Grade::all();

        $teachers = Teacher::all();

        return view('page.sections.sections', compact('grades', 'list_grades', 'teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SectionRequest $request)
    {
        try {
            $validated = $request->validated();
            $sections = new Section();

            $sections->Name_section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $sections->grade_id = $request->grade_id;
            $sections->class_id = $request->class_id;
            $sections->Status = 1;
            $sections->save();
            $sections->teachers()->attach($request->teacher_id);

            flash()->addSuccess(trans('message.success'));

            return redirect()->route('sections.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(SectionRequest $request)
    {
        try {
            $validated = $request->validated();
            $sections = Section::findOrFail($request->id);

            $sections->Name_section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $sections->grade_id = $request->grade_id;
            $sections->class_id = $request->class_id;

            if (isset($request->Status)) {
                $sections->Status = 1;
            } else {
                $sections->Status = 2;
            }

            // update pivot tABLE
            if (isset($request->teacher_id)) {
                $sections->teachers()->sync($request->teacher_id);
            } else {
                $sections->teachers()->sync(array());
            }

            $sections->save();
            flash()->addSuccess(trans('message.Update'));

            return redirect()->route('sections.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        Section::findOrFail($request->id)->delete();
        flash()->addError(trans('message.Delete'));

        return redirect()->route('sections.index');
    }

    public function getclasses($id)
    {
        $list_classes = Classroom::where('grade_id', $id)->pluck('Name_class', 'id');

        return $list_classes;
    }
}
