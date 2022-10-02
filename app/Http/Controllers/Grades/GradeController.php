<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $Grades = Grade::all();

        return view('page.Grades.Grades', compact('Grades'));
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
    public function store(StoreRequest $request)
    {
        // if (Grade::where('Name->ar', $request->Name)->orwhere('Name->en', $request->Name_en)->exists()) {

        //     return redirect()->back()->withErrors(trans('Grades_trans.exists'));
        // }

        try {
            $validated = $request->validated();

            $grade = new Grade(); // This is an Eloquent model

            $grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];

            $grade->Nots = $request->Nots;

            $grade->save();

            flash()->addSuccess(trans('message.success'));

            return redirect()->route('Grades.index');
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
    public function update(StoreRequest $request)
    {
        try {
            $validated = $request->validated();
            $Grades = Grade::findOrFail($request->id);
            $Grades->update([
                $Grades->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
                $Grades->Nots = $request->Nots,
            ]);
            flash()->addSuccess(trans('message.Update'));

            return redirect()->route('Grades.index');
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
        $MyClass_id = Classroom::where('Grade_id', $request->id)->pluck('Grade_id');

        if ($MyClass_id->count() == 0) {
            $Grades = Grade::findOrFail($request->id)->delete();
            flash()->addError(trans('message.Delete'));

            return redirect()->route('Grades.index');
        } else {
            flash()->addError(trans('Grades_trans.delete_Grade_Error'));

            return redirect()->route('Grades.index');
        }
    }
}
